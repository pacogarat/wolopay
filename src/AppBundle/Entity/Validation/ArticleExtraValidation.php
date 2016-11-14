<?php


namespace AppBundle\Entity\Validation;


use AppBundle\Entity\Article;
use AppBundle\Entity\Enum\PayCategoryEnum;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @deprecated WARNING: This class is not used
 */
class ArticleExtraValidation
{
    /**
     * @param \Doctrine\ORM\PersistentCollection $pcs
     * @param ExecutionContextInterface $context
     */
    public static function validateAmountByCountry($pcs, ExecutionContextInterface $context)
    {
        if ($pcs->isEmpty())
            return;


        if (!method_exists($pcs, 'getOwner'))
            return;

        /** @var Article $object */
        $object = $pcs->getOwner();
        $validate =  [];

        foreach ($object->getAppShopHasArticles() as $shopArticles)
        {
            if (in_array($shopArticles->getCountry()->getId(),$validate))
                continue;

            $validate[] = $shopArticles->getCountry()->getId();

            $flag = false;
            foreach ($object->getArticleAmounts() as $amounts)
            {
                if ($shopArticles->getCountry()->getId() == $amounts->getCountry()->getId())
                {
                    $flag = true;
                    break;
                }
            }

            if (!$flag)
            {
                // Values from country can be null because SMS VOICE PROMO ... is auto set because his amount is fixed
                $flag = false;
                foreach ($object->getArticleHasPMPCs() as $pmpc)
                {
                    if (false === in_array($pmpc->getPayMethodProviderHasCountry()->getPayMethod()->getPayCategory()->getId(),[PayCategoryEnum::MOBILE_ID, PayCategoryEnum::VOICE_ID, PayCategoryEnum::PROMO_CODE_ID] ))
                    {
                        $flag = true;
                        break;
                    }
                }

                if ($flag)
                {
                    $context->buildViolation(
                        $shopArticles.', haven\'t amount for "'.$shopArticles->getCountry().'" country ',
                        array()
                    )->addViolation();
                }
            }

        }



        foreach ($object->getArticleHasPMPCs() as $pmpcs)
        {

            if ($pmpcs->getPayMethodProviderHasCountry()->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::MOBILE_ID
                && !$pmpcs->getPayMethodProviderHasCountry()->getPayMethodHasProvider()->getIsOurImplementation()
            )
            {

                if ($pmpcs->getSms()->isEmpty())
                {
                    $context->buildViolation($pmpcs.' needs set SMS')->addViolation();
                }else{

                    foreach ($pmpcs->getSms() as $sms)
                    {
                        if (!$pmpcs->getPayMethodProviderHasCountry()->getSms()->contains($sms))
                        {
                            $context->buildViolation($pmpcs.' not exist in "paymethodprovider_has_country", SMS')->addViolation();
                        }
                    }

                }

            }

            if ($pmpcs->getPayMethodProviderHasCountry()->getPayMethod()->getPayCategory()->getId() == PayCategoryEnum::VOICE_ID)
            {

                if (!$pmpcs->getVoice())
                {
                    $context->buildViolation($pmpcs.' needs set Voice')->addViolation();
                }else{
                    if (!$pmpcs->getPayMethodProviderHasCountry()->getVoice()->contains($pmpcs->getVoice()))
                    {
                        $context->buildViolation($pmpcs.' not exist in "paymethodprovider_has_country", VOICE')->addViolation();
                    }
                }

            }
        }
    }
} 