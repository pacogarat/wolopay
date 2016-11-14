<?php


namespace AppBundle\Controller\PaymentHosted;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\PurchaseByPinGenericType;
use AppBundle\Payment\Util\PaymentProcessService;
use AppBundle\Service\ArticleService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Router;


/**
 * @Route("/mol-thailand")
 */
class MOLThailandController extends AbstractPaymentHosted
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var string
     * @Inject("%payments.mol_thailand.live%")
     */
    public $providerLive;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    const LOG_NAME = 'mol_thailand';

    const URL_SANDBOX = 'https://mp.molthailand.com/web-test/index.php?r=command/verify';
    const URL_LIVE = 'https://mp.molthailand.com/web/index.php?r=command/verify';

    const SECRET_PIN = '7fedb35585dca278b8e831128efe7aed';

    const MERCHANT_ID = 'datasmsth';
    const GAME_ID     = 184;

    /**
     * @Route("/{_locale}/{transaction_id}/{payment_process_id}", name="hosted_mol_thailand" )
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function indexAction(Request $request, Transaction $transaction, $payment_process_id, $_locale)
    {
        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'i');

        $paymentProcess = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $pmpc = $this->paymentProcessService->getPayMethodProviderHasCountry($paymentProcess);

        $form = $this->createForm(new PurchaseByPinGenericType());

        if ($request->getMethod() === 'POST')
        {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                $pin = $form->getData()['pin'];
                $serial = $form->getData()['serial'];

                if (!$pmpc->getPayMethodHasProvider()->getExtraOptions()['external_provider_id'])
                    throw new \Exception('external provider id not configured in pmp:'.$pmpc->getPayMethodHasProvider()->getId());

                $parameters = [
                    'merchantid' => self::MERCHANT_ID,
                    'mref_id'    => $externalTransactionId = $paymentProcess->getId().'_'.time(),
                    'gameid'     => self::GAME_ID,
                    'cus_id'     => $paymentDetails->getTransaction()->getGamer()->getId(),
                    'channel'    => 'molpoint', //todo $pmpc->getPayMethodHasProvider()->getExtraOptions()['external_provider_id'],
                    'serial_no'  => $serial,
                    'pin_no'     => $pin,
                    'back_url'   => $this->generateUrlIpn($paymentProcess),
                    'signature'  => $this->generateSignature($externalTransactionId )
                ];

                $requestGuzz = $this->guzzle->post($this->getUrlProvider(), null, $parameters);
                $response = $requestGuzz->send();

                $responseJson = $response->json();

                if ($responseJson['reason_code'] === '000')
                {
                    return $this->generateUrlDone($paymentProcess);
                }

                $this->logger->addWarning("Pin $pin or Serial $serial is invalid '");
                    $form->addError(new FormError("Invalid Pin/Serial"));
            }
        }
        $appShopHasArticles = $paymentProcess->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getAppShopHasArticle();
        $itemsQuantity = $paymentProcess->getPaymentDetail()->getPaymentDetailHasArticles()[0]->getItemsQuantity();

        $articleNameTranslated = ArticleService::getTranslation($appShopHasArticles, $request->getLocale(), $appShopHasArticles->getNameCurrentLabel());

        return $this->render('@App/PaymentHosted/generic/genericPurchaseByPin.html.twig', array(
            'appp'        => $appShopHasArticles->getAppShop()->getApp(),
            'articleName' => $articleNameTranslated,
            'form'        => $form->createView(),
            'pmpc'        => $pmpc,
            'appShopHasArticle' => $appShopHasArticles
        ));
    }

    private function generateSignature($orderId)
    {
        return md5(self::MERCHANT_ID . $orderId. self::SECRET_PIN);
    }

    private function generateUrlDone(PaymentProcessInterface $paymentProcessInterface)
    {
        $paymentDetail = $paymentProcessInterface->getPaymentDetail();

        $commonParams = [
            'payment_process_id' => $paymentProcessInterface->getId(),
            'transaction_id'     => $paymentDetail->getTransaction()->getId(),
            '_locale'            => $paymentDetail->getLanguage()->getId(),
        ];

        return $this->router->generate('payment_done',   array_merge($commonParams, ['security_random' => $paymentDetail->getSecurityRandomDone()]), true);
    }

    private function generateUrlIpn(PaymentProcessInterface $paymentProcessInterface)
    {
        $paymentDetail = $paymentProcessInterface->getPaymentDetail();

        $commonParams = [
            'payment_process_id' => $paymentProcessInterface->getId(),
            'transaction_id'     => $paymentDetail->getTransaction()->getId(),
            '_locale'            => $paymentDetail->getLanguage()->getId(),
        ];

        return $this->router->generate('payment_ipn',
            array_merge($commonParams, ['security_random' => $paymentDetail->getSecurityRandomIpn()]), true
        );
    }

    /**
     * @return array
     */
    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }
} 