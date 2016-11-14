<?php


namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleCategory;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Item;
use AppBundle\Form\Type\ArticleImportType;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class ArticleAdminController extends CRUDController
{

    public function importCsvAction($appId, Request $request)
    {

        die("NOT ACTIVEEEEEEEEEEEEEE");



        /** @var EntityManager $em */
        $em=$this->getDoctrine()->getManager();

        if (!$app = $em->getRepository("AppBundle:App")->find($appId))
            throw new \Exception("app is wrong '$appId'");

        $form = $this->createForm(new ArticleImportType(), null, array(
                'app' => $app,
            ));


        $form->handleRequest($request);

        if ($form->isValid())
        {

            $article= null;
            $postObjects=[];
            $data = $form->getData();
            /** @var ArticleCategory $articleCategory */
            $articleCategory = $data['articleCategory'];

            $articleCategoryArr = [ArticleCategoryEnum::SINGLE_PAYMENT_ID];

            if ($articleCategory->getId() == ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID)
                $articleCategoryArr = [ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID];

            $payMethodsDefault = $em->getRepository("AppBundle:PayMethodProviderHasCountry")->findByAppAndArticleCategoryId(
                $app->getId(), $articleCategoryArr
            );

            /** @var Item $item */
            $item = $data['item'];
            $rows = explode("\n",str_replace("\n\r", "\n", $data['csv']));

            /** @var Article $lastArticle */
            $lastArticle = null;

            $appShops = $em->getRepository("AppBundle:AppShop")->findByApp($app->getId());
            $articlesCreated = 0;
            $articlesUpdated = 0;
            $providerSMSNvia = $em->getRepository("AppBundle:Provider")->findOneBy(['name'=>'nvia']);

            foreach ($rows as $row)
            {
                $vals = array_map('trim', str_getcsv($row));
                if (!$quantity = (int) $vals[0])
                    continue;

                if ($quantity == -1)
                    $quantity=1;

                $countryId  = (string) $vals[3];
                $description = (string) $vals[4];
                $currencyId = (string) $vals[2];
                $currencyId = ($currencyId == 'BSF' ? 'VEF' : $currencyId);

                if (!$country = $em->getRepository("AppBundle:Country")->find($countryId))
                    throw new \Exception("country doesnt found '$countryId'");

                if (!$currency = $em->getRepository("AppBundle:Currency")->find($currencyId))
                    throw new \Exception("Currency doesnt found '$currencyId'");

                $amount = (string) $vals[1];

                if (!$article = $em->getRepository("AppBundle:Article")->findOneByAppAndItemsQuantityAndItemIdAndArticleCategory($app->getId(), $quantity, $item->getId(), $articleCategory->getId() ))
                {

                    if ($lastArticle && $lastArticle->getItemsQuantity() == $quantity )
                        $article = $lastArticle;
                    else{

                        $article = new Article();
                        $article
                            ->setApp($app)
                            ->setArticleCategory($articleCategory)
                            ->setItem($item)
                            ->setItemsQuantity($quantity)
                        ;
                        $articlesCreated++;
                    }

                }else{

                    $articlesUpdated++;
                    if ($lastArticle && $lastArticle->getItemsQuantity() == $quantity )
                        $article = $lastArticle;

                }

                $articleAmount=null;
                foreach ($article->getArticleAmounts() as $aAmount)
                {
                    if ($aAmount->getCountry()->getId() == $countryId)
                        $articleAmount = $aAmount;
                }

                if (!$articleAmount)
                {
                    $articleAmount = new ArticleAmount($article, $country);
                    $article->addArticleAmount($articleAmount);
                    $em->persist($articleAmount);
                }

                /** @var CurrencyService $currencyService */
                $currencyService = $this->container->get('common.currency');
                $articleAmount->setAmount(
                    $currencyService->getExchangeSimple($amount, $currencyId, $country->getCurrency()->getId())
                );

                foreach ($appShops as $aShop)
                {
                    $articleShopHasArticle=null;

                    foreach ($article->getAppShopHasArticles() as $aShopHasArticles)
                    {
                        if ($aShopHasArticles->getAppShop()->getId() == $aShop->getId() && $aShopHasArticles->getCountry()->getId() === $country->getId())
                            $articleShopHasArticle = $aShopHasArticles;
                    }

                    if (!$articleShopHasArticle)
                    {
                        $articleShopHasArticle = new AppShopHasArticles($country, $article, $aShop);

                        $em->persist($articleShopHasArticle);
                    }

                    foreach ($article->getArticleAmounts() as $aAmount)
                    {
                        if ($aAmount->getCountry()->getId() == $articleShopHasArticle->getCountry()->getId())
                            $articleShopHasArticle->setArticleAmount($aAmount);
                    }

                }

                if (strpos($description, 'Voz') === false && strpos($description, 'SMS') === false)
                {
                    if ($article->getArticleHasPMPCs()->isEmpty())
                    {
                        foreach ($payMethodsDefault as $pm)
                        {
                            $article->addArticleHasPMPC(new ArticleHasPMPC($pm, $article));
                        }
                    }
                }else{
                    if (strpos($description, 'SMS') !== false)
                    {
                        $shortCode = (string) $vals[8];
                        $smsAmount = (float) $vals[9];
                        $smsAmountCurrencyId = (string) $vals[10];
                        $smsShortName = (string) $vals[11];

                        $sms = $em->getRepository("AppBundle:SMS")->findOneByAliasAndCountryAndSmsShortCodeAndOperatorShortName(
                            'WOLO', $country->getId(), $shortCode, $smsShortName
                        );

                        if (!$sms)
                            throw new \Exception('SMS not found, parameters: '.'WOLO'.','. $country->getId().','. $shortCode.','. $smsShortName);

                        $pmpc=$em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodNameAndProviderIdAndCountryId(
                            PayMethodEnum::SMS_NAME, PayCategoryEnum::MOBILE_ID, ArticleCategoryEnum::SINGLE_PAYMENT_ID, $providerSMSNvia->getId(), $country->getId()
                        );

                        if (!$pmpc)
                            throw new \Exception('pmpc not found, parameters: '.PayCategoryEnum::MOBILE_ID.','. ArticleCategoryEnum::SINGLE_PAYMENT_ID.','. $providerSMSNvia->getId().','. $country->getId());

                        $hasSms=false;

                        foreach ($article->getArticleHasPMPCs() as $aPMPC)
                        {
                            if ($aPMPC->getPayMethodProviderHasCountry()->getId() == $pmpc->getId())
                            {
                                $request->getSession()->getFlashBag()->add('notice',"real price $smsAmount $smsAmountCurrencyId, price now ".$sms->getAmount().' '.$pmpc->getCurrency()->getId());

                                foreach ($aPMPC->getSms() as $sm)
                                {
                                    if ($sm->getId() === $sms->getId())
                                    {
                                        $hasSms=true;
                                        break;
                                    }
                                }

                                if ($hasSms == false)
                                {
                                    $aPMPC->addSm($sms);
                                    $hasSms=true;
                                }
                            }
                        }

                        if ($hasSms == false)
                        {
                            $articleHasPMPC = new ArticleHasPMPC($pmpc, $article);
                            $articleHasPMPC->addSm($sms);

                            $em->persist($articleHasPMPC);
                            $article->addArticleHasPMPC($articleHasPMPC);
                        }

                    }
                }

                $em->persist($article);

                if ($lastArticle && $lastArticle !== $article)
                    $postObjects[]=$lastArticle;

                $lastArticle=$article;
            }

            $em->flush();
            $this->addFlash('success', "Articles created $articlesCreated, rows updated: $articlesUpdated");

            if ($lastArticle !== $article)
                $postObjects[]=$lastArticle;
        }

        return $this->render('@App/Sonata/Article/import_via_csv.html.twig', array(
                'action'   => 'import',
                'form'     => $form->createView()
            ));
    }


} 