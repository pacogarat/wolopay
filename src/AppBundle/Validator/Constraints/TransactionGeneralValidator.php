<?php


namespace AppBundle\Validator\Constraints;


use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\ExternalStoreEnum;
use AppBundle\Entity\Transaction;
use AppBundle\Service\CountryService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Service("transaction.validator.value_current")
 * @Tag("validator.constraint_validator", attributes={"alias": "transaction_general_validation"})
 */
class TransactionGeneralValidator extends ConstraintValidator
{
    private $em;
    /** @var  Transaction */
    private $transaction;

    /** @var CountryService */
    private $countryService;

    /**
     * @InjectParams({
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "countryService" = @Inject("country"),
     * })
     */
    function __construct(EntityManager $em, CountryService $countryService)
    {
        $this->em     = $em;
        $this->countryService = $countryService;
    }

    public function validate($object, Constraint $constraint)
    {
        /** @var Transaction $parentObject */
        $root = $this->context->getRoot();

        if ($root instanceof Transaction)
            $this->transaction = $root;            // Executing validator directly from Transaction
        else if ($root instanceof \Symfony\Component\Form\Form)
            $this->transaction = $root->getData(); // Form Type
        else
            throw new \Exception('wrong root type');

        $this->validateValueCurrent();
        $this->verifyAppShopCorrespondToAppShopIfNullSet();
        $this->verifyArticlesAvailableForThisConfiguration();
        $this->customTransactionValidPayMethod();
        $this->validateCssModular();
        $this->articleVirtualCurrency();
        $this->validateExternalStore();
        $this->validateArticleSelectedTabAndAppTabSelected();
    }

    private function validateValueCurrent()
    {
        if ($this->transaction instanceof Transaction && $this->transaction->getValueCurrent())
        {
            $levelCategory = $this->em
                ->getRepository('AppBundle:AppShop')
                ->findOneByAppIdAndLevelGamer($this->transaction->getApp()->getId(), $this->transaction->getValueCurrent())
            ;

            if (!$levelCategory)
            {
                $this->context->buildViolation('Haven\'t shops for this gamer_level configuration')
                    ->atPath('valueCurrent')
                    ->addViolation();
            }
        }
    }

    private function validateCssModular()
    {
        if ($this->transaction instanceof Transaction && $this->transaction->getFirstPayMethods())
        {
            if (!$shopCss = $this->transaction->getCss())
            {
                $appShop = $this->em
                    ->getRepository('AppBundle:AppShop')
                    ->findOneByAppIdAndLevelGamer($this->transaction->getApp()->getId(), $this->transaction->getValueCurrent())
                ;

                if (!$appShop)
                    return;

                $shopCss =  $appShop->getCss();
            }

            if (!$shopCss->getModular())
            {
                $this->context->buildViolation('You can\'t use firstPayMethods because your theme '.$shopCss->getName().' is not modular')
                    ->atPath('firstPayMethods')
                    ->addViolation();
            }
        }
    }

    private function verifyArticlesAvailableForThisConfiguration()
    {
        if ($this->transaction instanceof Transaction && !$this->transaction->getCli() && ($this->transaction->getValueCurrent() !== null || $this->transaction->getLevelCategory()))
        {

            $levelCategory = $this->transaction->getLevelCategory();

            if (!$levelCategory && $this->transaction->getValueCurrent())
            {
                $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelGamer(
                    $this->transaction->getApp()->getId(), $this->transaction->getValueCurrent()
                );

                if ($appShop)
                {
                    $levelCategory = $appShop->getLevelCategory();
                    $this->transaction->setLevelCategory($levelCategory);
                }
            }

            if (!$this->transaction->getLevelCategory())
            {
                return ;
            }

            $countries = $this->countryService->getCountriesClientAvailableByTransaction($this->transaction);

            if (count($countries) <= 0)
            {
                $this->context->buildViolation('Haven\'t articles for this configuration')->addViolation();
            }
        }
    }

    private function verifyAppShopCorrespondToAppShopIfNullSet()
    {
        if ($this->transaction instanceof Transaction && !$this->transaction->getCli() && $this->transaction->getValueCurrent() !== null)
        {
            $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelGamer(
                $this->transaction->getApp()->getId(), $this->transaction->getValueCurrent()
            );

            if ($this->transaction->getLevelCategory())
            {
                if ($this->transaction->getLevelCategory()->getId() !== $appShop->getLevelCategory()->getId())
                {
                    $this->context->buildViolation('Haven\'t articles for this gamer level doesnt correspond to this shop')->addViolation();
                }

            }

        }

    }

    private function customTransactionValidPayMethod()
    {
        if ($this->transaction instanceof Transaction && $this->transaction->getCustomPayMethod() && $this->transaction->getCustomCountry())
        {
            $pmps = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findByPayMethodIdAndCanBeCustomTransaction(
                $this->transaction->getCustomPayMethod()->getId(), true
            );

            if (count($pmps) === 0)
            {
                $this->context->buildViolation('This pay method doesn\'t exist')
                    ->atPath('customPayMethod')
                    ->addViolation();

                return;
            }
            // we assume that pmp has oly one pay_method for transaction simple with CanBeCustomTransaction
            $pmp = $pmps[0];

            $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
                $this->transaction->getCustomPayMethod()->getId(), $pmp->getProvider()->getId(), $this->transaction->getCustomCountry()->getId()
            );

            if (!$pmpc)
            {
                $this->context->buildViolation('This pay method doesn\'t exist')
                    ->atPath('customPayMethod')
                    ->addViolation();

                return;
            }

            if (!$pmp->getCanBeCustomTransaction())
            {
                $this->context->buildViolation('Only direct payment is available')
                    ->atPath('customPayMethod')
                    ->addViolation();
            }
        }
    }

    private function articleVirtualCurrency()
    {
        if ($this->transaction instanceof Transaction && $this->transaction->getArticleVirtualCurrency())
        {
            if ($this->transaction->getArticleVirtualCurrency()->getArticleCategory()->getId() === ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
            {
                $this->context->buildViolation('Not valid for \'subscriptions\' articles')
                    ->atPath('articleVirtualCurrency')
                    ->addViolation();
            }

            if (!$this->transaction->getApp()->hasVirtualCurrencyEnabled())
            {
                $this->context->buildViolation('This app haven\'t enabled virtual currency')
                    ->atPath('articleVirtualCurrency')
                    ->addViolation();
            }

            if ($this->transaction->getCountryVirtualCurrency())
            {
                $appShop = $this->em
                    ->getRepository('AppBundle:AppShop')
                    ->findOneByAppIdAndLevelGamer($this->transaction->getApp()->getId(), $this->transaction->getValueCurrent())
                ;

                if (!$appShop)
                    return;

                $countryConfigured = $this->countryService->getCountryConfiguredAndCloserFromApp($this->transaction->getApp(), [$appShop->getLevelCategory()->getId()], $this->transaction->getCountryVirtualCurrency());

                if (!$countryConfigured)
                {
                    $this->context->buildViolation('This article doesnt exist in this LevelCategory/Country')
                        ->atPath('countryVirtualCurrency')
                        ->addViolation();
                }

                $appShopHasArticle = $this->em->getRepository("AppBundle:AppShopHasArticle")->findOneByIdAndLevelCategory(
                    $countryConfigured->getId(),
                    $this->transaction->getArticleVirtualCurrency()->getId(),
                    $appShop->getLevelCategory()->getId()
                );

                if (!$appShopHasArticle)
                {
                    $this->context->buildViolation('This article doesnt exist in this LevelCategory/Country')
                        ->atPath('articleVirtualCurrency')
                        ->addViolation();
                }
            }

        }
    }

    private function validateExternalStore()
    {
        if ($this->transaction instanceof Transaction && $this->transaction->getExternalStore())
        {
            if (!in_array($this->transaction->getExternalStore(), ExternalStoreEnum::$ALL_AVAILABLE))
            {
                $this->context->buildViolation('This external store ('.$this->transaction->getExternalStore().') is not available')
                    ->atPath('external_store')
                    ->addViolation();
            }
        }
    }

    private function validateArticleSelectedTabAndAppTabSelected()
    {
        if ($this->transaction instanceof Transaction)
        {
            if ($this->transaction->getSelectedAppTab() && $this->transaction->getSelectedArticle())
            {
                $levelCategory = $this->transaction->getLevelCategory();

                if (!$levelCategory)
                {
                    $appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelGamer(
                        $this->transaction->getApp()->getId(), $this->transaction->getValueCurrent()
                    );

                    if (!$appShop)
                        return;

                    $levelCategory = $appShop->getLevelCategory();
                }

                $appShopHasAppTabs = $this->em->getRepository("AppBundle:AppShopHasAppTab")
                    ->findByAppIdAndCountryAndLevelCategoryAndLevelCategoryIdAndStatus(
                        $this->transaction->getApp()->getId(),
                        null,
                        $this->transaction->getCountriesAvailable()->toArray(),
                        $levelCategory->getId(),
                        $this->transaction->getAppTabsAvailable()->toArray(),
                        [$this->transaction->getSelectedArticle()],
                        $this->transaction->getPayMethodsAvailable()->toArray(),
                        $this->transaction->getExternalStore()
                    );

                $flag = false;

                foreach ($appShopHasAppTabs as $appShopHasAppTab)
                {
                    if ($appShopHasAppTab->getAppTab()->getId() == $this->transaction->getSelectedAppTab()->getId())
                    {
                        $flag = true;
                        break;
                    }
                }

                if (!$flag)
                {
                    $this->context->buildViolation('This select tab category not exist for the "selected_article_id"')
                        ->atPath('selected_tab_category_id')
                        ->addViolation();
                }
            }
        }
    }
} 