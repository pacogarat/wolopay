<?php

namespace AppBundle\Controller\AppShop;

use AppBundle\Entity\AppTab;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\ExternalStoreEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Enum\RoleEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Language;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaException;
use AppBundle\Exception\NviaShowCustomResponseErrorException;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Event\TransactionStartedEvent;
use AppBundle\Service\BlacklistService;
use AppBundle\Service\CountryService;
use AppBundle\Service\FormHelper;
use AppBundle\Service\IPInfoService;
use AppBundle\Traits\StopWatchTrait;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\Serializer\SerializationContext;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Translation\Translator;

/**
 * @Route("/")
 */
class ShopController extends Controller
{
    use StopWatchTrait;

    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Inject("common.ip_info")
     * @var IPInfoService
     */
    private $ipInfoService;
    
    /**
     * @Inject("logger")
     * @var Logger
     */
    private $logger;

    /**
     * @Inject("app.blacklist")
     * @var BlacklistService
     */
    private $blacklistService;

    /**
     * @var CountryService
     * @Inject("country")
     */
    private $countryService;

    /**
     * @Inject("translator")
     * @var Translator
     */
    private $translator;

    /**
     * @Inject("app.form_helper")
     * @var FormHelper
     */
    private $formHelper;


    private function indexCommon(Transaction $transaction, Request $request)
    {
        $this->stopWatchStart('validations');

        if (in_array(RoleEnum::TRANSACTION_FINISHED, $transaction->getRoles()) )
            return $this->redirect($this->get('router')->generate('shop_finished', ['transaction_id' => $transaction->getId()]));

        if ($transaction->getCustomAmount() !== null)
            throw new BadRequestHttpException('Is a invalid transaction (CustomAmount) only valid on directPayment');

        $em  = $this->getDoctrine()->getManager();

        $this->stopWatchStop('validations');
        $this->stopWatchStart('localize client');

        /** @var Country $countryConfigured */
        list($countryClient, $countryConfigured, $countriesAvailable) = $this->getCountryDefault($transaction, $request);

        if (!$countryClient)
            $this->logger->addError("Not country found"); //change warning in the future

        $langDefault = $this->getLanguageDefault($transaction, $countryClient);

        if ($reason=$this->blacklistService->isForbiddenByBlackLists($transaction, $request))
        {
            $transaction
                ->setStatusCategory(
                    $em->getRepository('AppBundle:TransactionStatusCategory')
                        ->find($reason)
                );

            $em->flush();

            $this->errorStatusCategoryThrowExceptionErrorsWithPersonalMsg($transaction, $langDefault);
        }

        if ($transaction->getStatusCategory()->getId() == TransactionStatusCategoryEnum::BEGIN_ID)
        {
            $transaction->setGamerIp($request->getClientIp());
            $transaction->setCountryDetected($this->ipInfoService->getCountryFromIp($request->getClientIp()));
            $this->logger->addInfo("Country Detected: ". ($transaction->getCountryDetected() ? $transaction->getCountryDetected()->getId(): 'unknown'));
            $transaction
                ->setStatusCategory(
                    $em->getRepository('AppBundle:TransactionStatusCategory')
                        ->find(TransactionStatusCategoryEnum::SHOPPING_ID)
                );
            $this->container->get('event_dispatcher')->dispatch(TransactionStartedEvent::EVENT,
                new TransactionStartedEvent($transaction, $request, $countryClient));
        }

        $this->stopWatchStop('localize client');

        $em->flush();

        $faceBookAppId = $externalStore_pmp = null;

        if ($transaction->getExternalStore() === ExternalStoreEnum::FACEBOOK)
        {
            $providerFacebook = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name' => ProviderEnum::FACEBOOK_NAME]);
            $clientCredentials = $transaction->getApp()->getProviderClientCredentials($providerFacebook);

            if (!$clientCredentials)
                return new Response("alert('you must set facebook credentials in wolopay admin');");

            $faceBookAppId = $clientCredentials->getDetails()['app_id'];
        }

        if ($transaction->getExternalStore())
        {
            $externalStore_pmp = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByGeneralPMPCOrId(
                $transaction->getExternalStore(), $countryConfigured->getId())->getPayMethodHasProvider();
        }

        return array(
            'countriesAvailable'      => $countriesAvailable,
            'jwtString'               => $this->generateStringJwt($transaction),
            'countryDefault'          => $countryClient,
            'fixedCountry'            => $transaction->getFixedCountry(),
            'articleTabDefault'       => ( $countryConfigured ? $this->getAppTabDefault($transaction, $countryConfigured, $countryClient, $transaction->getSelectedAppTab(), $transaction->getSelectedArticle()) : null) ,
            'languageDefault'         => $langDefault,
            'languages'               => $transaction->getApp()->getLanguages(),
            'nodeServer'              => $this->getIpNodeServer(),
            'shopCss'                 => $this->getShopCss($transaction),
            'transaction'             => $transaction,
            'articleSerializeContext' => SerializationContext::create()->setGroups(array('Default', 'IgnoreTranslations')),
            'appSerializeContext'     => SerializationContext::create()->setGroups(array('Basic', 'IgnoreTranslations')),
            'appTabContext'           => SerializationContext::create()->setGroups(array('Default', 'IgnoreTranslations')),
            'loadedByJs'              => false,
            'facebook_app_id'         => $faceBookAppId,
            'externalStore_pmpContext'=>  SerializationContext::create()->setGroups(array('externalStore')),
            'externalStore_pmp'       => $externalStore_pmp
        );
    }

    /**
     * @Route("/{transaction_id}", name="shop_index", requirements={"transaction_id":"[^\.\/]+?"})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function indexAction(Transaction $transaction, Request $request)
    {
        $ret = $this->indexCommon($transaction, $request);
        if ($ret instanceof Response )
            return $ret;

        return $this->render(
            '@App/AppShop/Shop/custom/' . ($transaction->getCss()->getTemplateLayout() ?: '../index.html.twig'),
            $ret
        );
    }


    /**
     * @Route("/{transaction_id}.script", name="shop_index_js", requirements={"transaction_id":"[^\.]+?"})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function indexJsAction(Transaction $transaction, Request $request)
    {
        $params = $this->indexCommon($transaction, $request);
        $params['loadedByJs'] = true;

        if ($params instanceof RedirectResponse)
        {
            return new Response($this->renderView('@App/AppShop/Shop/widget/index_js_transaction_ended.html.twig'));
        }

        $params['htmlTemplate'] = true;

        $dynamic = $this->renderView('@App/AppShop/Shop/widget/index_js_dynamic.html.twig', $params);

        $env = $this->container->get('kernel')->getEnvironment();

        $widgetJsTemp = $this->container->getParameter('kernel.root_dir') .'/../var/cache/'.$env.'/show_shop.js';
        $widgetHTMLTemp = $this->container->getParameter('kernel.root_dir') .'/../web/cache/show_shop.html';

        if (file_exists($widgetJsTemp) && $env !== 'dev')
        {
            $static = file_get_contents($widgetJsTemp);

        }else{

            $static = $this->renderView('@App/AppShop/Shop/widget/index_js_static.html.twig', $params);

            if ($transaction->getExternalStore() === ExternalStoreEnum::FACEBOOK)
            {
                $static .= $this->renderView('@App/AppShop/Shop/external_stores/facebook_static.html.twig', $params);
            }

            if ($env !== 'dev')
            {
                $temp = sys_get_temp_dir().'/show_shop.js';
                file_put_contents($temp, $static);
                $js = new AssetCollection([new FileAsset($temp)], [$this->get('assetic.filter.uglifyjs2')]);
                $static = $js->dump();
            }

            file_put_contents($widgetJsTemp, $static);
            file_put_contents($widgetHTMLTemp ,$this->renderView('@App/AppShop/Shop/index.html.twig', $params));

        }

        return new Response('(function(){'.$dynamic.$static.'}());', 200, ['Content-Type' => 'text/javascript']);
    }

    private function generateStringJwt(Transaction $transaction)
    {
        $jwt = $this->get('lexik_jwt_authentication.jwt_encoder');

        $tokenString = $jwt->encode(
            array('username' => $transaction->getApiCrendetials()->getCodeKey())
        );

        return sprintf('Bearer %s', $tokenString);
    }

    private function getAppTabDefault(Transaction $transaction, Country $countryConfigured, Country $countryClient, AppTab $tabPreselected = null,
        Article $articlePreselected = null)
    {
        $appShopHasTabs = $this->getDoctrine()->getRepository("AppBundle:AppShopHasAppTab")
            ->findByAppIdAndCountryAndLevelCategoryAndLevelCategoryIdAndStatus(
                $transaction->getApp()->getId(),
                $countryConfigured->getId(),
                $countryClient->getId(),
                $transaction->getLevelCategory()->getId(),
                $transaction->getAppTabsAvailable()->toArray(),
                $transaction->getArticlesAvailable()->toArray(),
                $transaction->getPayMethodsAvailable()->toArray(),
                $transaction->getExternalStore()
            );

        if (!$appShopHasTabs)
            throw new NviaException("Haven't tabs available");

        if ($tabPreselected)
        {
            foreach ($appShopHasTabs as $appShopHasTab)
            {
                if ($appShopHasTab->getAppTab()->getId() === $tabPreselected->getId())
                    return $appShopHasTab;
            }
        }

        if ($articlePreselected)
        {
            foreach ($appShopHasTabs as $appShopHasTab)
            {
                if (
                    (in_array($articlePreselected->getArticleCategory()->getId(), UtilHelper::getIdsArrayFromObjects($appShopHasTab->getAppTab()->getArticleCategories())))
                )
                {
                    return $appShopHasTab;
                }

            }
        }

        return $appShopHasTabs[0];
    }

    /**
     * @param Transaction $transaction
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    private function getCountryDefault(Transaction $transaction, Request $request)
    {
        $countries = $this->countryService->getCountriesClientAvailableByTransaction($transaction);

        $getCountriesAvailable = function (Country $cUsed = null) use ($countries, $transaction) {

            if (!$cUsed)
                return null;

            if ($transaction->getFixedCountry())
                return [$cUsed];

            return $countries;
        };

        if (count($countries) <= 0 )
            throw new \Exception("Not countries available from transaction: \"".$transaction->getId()."\"");

        $countryByIp = $transaction->getCountryDetected();

        $this->stopWatchStart('getCountryFromIp');

        if (!$countryByIp)
            $countryByIp = $this->ipInfoService->getCountryFromIp($request->getClientIp());

        $this->stopWatchStop('getCountryFromIp');

        $countryConfigured = $this->countryService->getCountryConfiguredAndCloserFromTransaction($transaction, $countryByIp);

        if ($countryConfigured && $countryByIp)
            return [$countryByIp, $countryConfigured, $getCountriesAvailable($countryByIp)];

        if ($countryConfigured && !in_array($countryConfigured->getId(), CountryEnum::$OTHERS_ALL) )
            return [$countryConfigured, $countryConfigured, $getCountriesAvailable($countryConfigured)];

        if ($countryConfigured)
        {
            if ($countryConfigured->getId() === CountryEnum::OTHER)
            {
                foreach ($countries as $c)
                {
                    $actualCountryConfigured = $this->countryService->getCountryCloserFromCountries($transaction->getApp()->getCountries(), $c);

                    if ($actualCountryConfigured && $actualCountryConfigured->getId() == $countryConfigured->getId())
                        return [$c, $countryConfigured, $getCountriesAvailable($c)];
                }

            }else{

                foreach ($countries as $c)
                {
                    if ($c->getContinent()->getId() === $countryConfigured->getContinent()->getId())
                        return [$c, $countryConfigured, $getCountriesAvailable($c)];
                }
            }
        }

        if ($transaction->getFixedCountry())
            return [null, null, null];

        $countrySelectedRandom = $countries[0];

        $countryConfigured = $this->countryService->getCountryConfiguredAndCloserFromTransaction($transaction, $countrySelectedRandom);
        return [$countrySelectedRandom, $countryConfigured, $getCountriesAvailable($countryConfigured)];
    }

    private function  getLanguages()
    {
        $parameters = $this->container->getParameter('locale_available');
        return $this->getDoctrine()->getRepository("AppBundle:Language")->findByIds($parameters);
    }

    private function getLanguageDefault(Transaction $transaction, Country $countryDefault=null)
    {
        $languageAvailable = UtilHelper::getIdsArrayFromObjects($transaction->getApp()->getLanguages());

        if ($transaction->getLanguageDefault() && in_array($transaction->getLanguageDefault()->getId(), $languageAvailable))
            return $transaction->getLanguageDefault();

        if ($transaction->getCountryDetected() && in_array($transaction->getCountryDetected()->getLanguage()->getId(), $languageAvailable))
            return $transaction->getCountryDetected()->getLanguage();

        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
        {
            $browserLanguage = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if (in_array($browserLanguage, $languageAvailable))
                return $this->getDoctrine()->getRepository("AppBundle:Language")->find($browserLanguage);
        }

        if ($countryDefault)
        {
            if (in_array($countryDefault->getLanguage()->getId(), $languageAvailable))
                return $countryDefault->getLanguage();
        }

        $locale = $this->container->getParameter('locale');
        return $this->getDoctrine()->getRepository("AppBundle:Language")->find($locale);
    }

    private function  getIpNodeServer()
    {
        return UtilHelper::removePortFromUrlIfExist($this->container->getParameter('domain_main')) . ':'.
            $this->container->getParameter('node_port');
    }

    /**
     * @param Transaction $transaction
     * @return \AppBundle\Entity\ShopCss
     */
    private function getShopCss(Transaction $transaction)
    {
        if ($transaction->getCss())
            return $transaction->getCss();

        /** @var Transaction $user */
        $user = $this->getUser();
        return $user->getCss();
    }

    /**
     * @Route("/{transaction_id}/finished", name="shop_finished")
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Security("has_role('ROLE_TRANSACTION_FINISHED')")
     * @Template()
     */
    public function finishedAction(Transaction $transaction, Request $request)
    {
        $langDefault = $this->getLanguageDefault($transaction, null);
        $this->errorStatusCategoryThrowExceptionErrorsWithPersonalMsg($transaction, $langDefault);

        return array(
            'jwtString'       => $this->generateStringJwt($transaction),
            'languageDefault' => $langDefault,
            'languages'       => $this->getLanguages(),
            'nodeServer'      => $this->getIpNodeServer(),
            'shopCss'         => $this->getShopCss($transaction),
            'transaction'     => $transaction,
            'completed'       => true,
            'appSerializeContext'     => SerializationContext::create()->setGroups(array('Basic')),
        );
    }

    private function errorStatusCategoryThrowExceptionErrorsWithPersonalMsg(Transaction $transaction, Language $language)
    {
        $statusId = $transaction->getStatusCategory()->getId();
        if (in_array($statusId, TransactionStatusCategoryEnum::getErrorsWithPersonalErrorMsg()))
        {
            $txt = $this->translator->trans(
                "errors.message_$statusId",
                ['{[{end_user_support_email}]}' => $transaction->getApp()->getEndUserSupportEmail()],
                null,
                $language->getId()
            );

            throw new NviaShowCustomResponseErrorException('@App/AppShop/Error/proxy_not_allowed.html.twig', ["error_message"=>$txt], $statusId);
        }
    }


    /**
     * @Route("/{transaction_id}/feedback", name="feed_back", options={"expose"=true})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function feedbackAction(Transaction $transaction, Request $request)
    {
        $reason_type=$request->get('reason_type');
        $suggest = $request->get('suggest');
        $pmUWBP = $request->get('pay_method_u_will_be_paid');
        $payMethodFailed = $request->get('pay_methods_failed');

        $message = \Swift_Message::newInstance()
            ->setSubject('Feedback, Game:'.$transaction->getApp()->getName().', Gamer: '.$transaction->getGamer()->getGamerExternalId())
            ->setFrom($this->container->getParameter('email_app'))
            ->setTo($this->container->getParameter('email_support_gamer'))
            ->setBody('

            Game:'.$transaction->getApp()->getName().'
            Gamer: '.$transaction->getGamer()->getGamerExternalId().'
            TransactionId: '.$transaction->getId().'
            ip: '.$request->getClientIp().'
            Browser: '.$request->headers->get('User-Agent').'

            Reason Type: '.$reason_type.'
            '.($pmUWBP ? 'Paymethod u will be paid: '.$pmUWBP : '' ).'
            '.($payMethodFailed ? 'PayMethods failed: '.$payMethodFailed : '').'
            Suggest: '.$suggest.'
            ')
        ;

        $this->logger->addInfo("Send survey. reason_type: $suggest, pmUWBP $pmUWBP, payMethodFailed: $payMethodFailed");

        return new Response($this->get("mailer")->send($message));
    }

    /**
     * @Route("/{transaction_id}/{_locale}/gamer-update-data", name="gamer_update_data", options={"expose"=true})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Template()
     */
    public function gamerUpdateDataAction(Transaction $transaction, Request $request)
    {
        $gamer = $transaction->getGamer();

        $groups = ['CanBeUpdatedByUser'];

        $formBuilder = $this->createFormBuilder($gamer, ['validation_groups' => $groups]);
        $formBuilder
            ->add('name')
            ->add('surname')
            ->add('email')
        ;
        $formBuilder = $this->formHelper->createFormWithOnlyGroups($gamer, $groups, $formBuilder, true);
        $formBuilder->add('captcha', 'captcha');
        $form = $formBuilder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->get('session')->getFlashBag()->add('success', 'form.generic.success');
            $this->em->flush();
        }

        return array(
            'form' => $form->createView(),
            'transaction' => $transaction,
        );
    }

}
