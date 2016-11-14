<?php

namespace AppBundle\Payment\PayMethod\PayPal;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Payment\Bean\PaymentExtraCostBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use PayPal\Api as ApiPaypal;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("shop.payment.paypal_t_ipn_pay_method")
 *
 * To test
 * user: moroso@wolopay.com
 * password: morosoperrypaypal
 *
 * sandbox.paypal.com Using ipn
 *
 */
class PayPalIpnBasicPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface
{
    /** @var string  */
    protected $providerlive;

    /** @var string  */
    protected $providerEmail;

    const URL_SANDBOX = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    const URL_LIVE    = 'https://www.paypal.com/cgi-bin/webscr';
    const PREFIX_EXTERNAL_TRANSACTION = 'PAYPAL_';

    const API_CLIENT_ID_LIVE = 'ATSyZCO6xG6yyiSAnQ6Z5mkk4mONRsw-2jDsKkBr343i8H2pCOcIkF-hjbtdWd7miw52hoeF5mus6drW';
    const API_SECRET_LIVE = 'EHMcXCnG83i6X9ROR6h34w-GCaN5LBdGG9bAF_UrF5OPksIz6AiIl_NtBed2jR0h0Q1RB6bGvLf9FHFM';

    public static $availableLanguages = [ 'AU','AT','BE','BR','CA','CH','CN','DE','ES','GB','FR','IT','NL','PL','PT','RU','US'];

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.paypal.live%"),
     *    "email"  = @Inject("%payments.paypal.email%"),
     * })
     */
    function __construct($live, $email)
    {
        $this->providerEmail = $email;
        $this->providerlive  = $live;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $lang = strtoupper($this->locale);

        if (in_array($paymentDetails->getLanguage()->getId(), self::$availableLanguages))
            $lang = $paymentDetails->getLanguage()->getId();

        $postParameters = [
            'cmd'        => '_cart',
            'upload'     => '1',
            'business'   => $this->providerEmail,
            'rm'         => '2',
            'lc'         => $lang,

            'amount'         => $paymentDetails->getAmount(),
            'currency_code'  => $paymentInteract->getCurrencyPaymentISO(),

            'notify_url'    => $paymentInteract->getUrlIpn(),
            'cancel_return' => $paymentInteract->getUrlKo(),
            'return'        => $paymentInteract->getUrlOk(),

            // hack to rare characters
            'charset'       => 'utf-8',
        ];

        $i=1;

        if ($paymentProcess instanceof SingleCustomPayment)
        {
            //            $postParameters['item_desc_1'] = $paymentProcess->getArticleDescription();
            $postParameters['item_name_1']   =  $paymentProcess->getArticleTitle();
            $postParameters['amount_1']      = $paymentProcess->getPaymentDetail()->getAmount();
            $postParameters['item_number_1'] = '1';

        }else{

            foreach ($paymentDetails->getPaymentDetailHasArticles() as $ppdha)
            {
                $postParameters['item_name_'.$i] = $paymentInteract->getNameTranslation($ppdha);
                //            $postParameters['L_PAYMENTREQUEST_0_DESC'.$i] = $paymentInteract->getDescLabelTranslation($ppdha->getAppShopHasArticle());
                $postParameters['amount_'.$i] = $this->forceTwoDecimals($ppdha->getAmount());
                $postParameters['item_number_'.$i] = $ppdha->getArticlesQuantity();

                $i++;
            }
        }

        $this->logger->addInfo('Parameters sent: '.urldecode(http_build_query($postParameters)));

        $paymentInteract->setRequestResult($this->getUrlPaypal(), 'POST', $postParameters);
    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
//        if (!$this->verifyPaymentWasSentByPayPal($paymentInteract))
//            return ;

        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $status = trim(strtolower($request->get('payment_status')));
        $this->logger->addInfo("Payment status by PayPal: ". $status);

        $this->processInSpecialCases($paymentInteract, $request, $paymentProcess);

        if ($status === "completed" ){

            if ($paymentInteract->validatePrice($request->get('mc_gross'), $request->get('mc_currency'), $paymentProcess))
            {
                $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$request->request->get('txn_id'),
                    new PaymentFeeBean(
                        $request->get('mc_fee'),
                        $this->em->getRepository('AppBundle:Currency')->find($request->get('mc_currency')),
                        null,
                        null,
                        null,
                        null,
                        $request->get('exchange_rate')
                    )
                );
            }

        }else if ($status === "pending" ){

            $paymentInteract->setPaymentPending($request->get('pending_reason'));

        }else if ($status === "failed" ){

            $paymentInteract->setPaymentFailed('Failed');

        }else if ($status === "denied" ){

            $paymentInteract->setPaymentCancelled('Denied');
        }else{

            $this->logger->addAlert("Payment status unknown: '".$request->get('payment_status')."'");
        }

        $this->logger->addDebug("end paypalipnbasicmethod.php");
    }

    protected function processInSpecialCases(PaymentIpnInteract $paymentInteract, Request $request, PaymentProcessInterface $payment)
    {
        $currency = $payment->getPaymentDetail()->getCurrency();

        if (strtolower($request->get('txn_type') === "new_case"))
        {
            $paymentInteract->setPaymentDispute($payment);
        }

        if (strtolower($request->get('payment_status')) === "reversed"){

            $paymentInteract->setPaymentCancelled(strtolower($request->get('reason_code')));
            if ($extraCost = $request->get('mc_fee'))
            {
                $paymentInteract->setExtraCost(
                    new PurchaseExtraCostBean(null, $extraCost, $extraCost, $extraCost),
                    strtolower($request->get('reason_code'))
                );
            }

        }else if (strtolower($request->get('payment_status')) === "canceled_reversal"){

            $paymentInteract->setPaymentUnBlocked($payment);
            if ($extraCost = $request->get('mc_fee'))
            {
                $paymentInteract->setExtraCost(
                    new PurchaseExtraCostBean(null, $extraCost, $extraCost, $extraCost),
                    strtolower($request->get('reason_code'))
                );
            }
        }
    }

    protected function verifyPaymentWasSentByPayPal(PaymentIpnInteract $paymentInteract)
    {
        $post = $paymentInteract->getRequest()->request->all();
        $post['cmd'] = '_notify-validate';

        $requestVerification = $this->guzzle->post($this->getUrlPaypal(), [], $post);
        $responseVerification = $requestVerification->send();

        $this->logger->info("Verification payment. url ".$this->getUrlPaypal());

        if (strcmp ($responseVerification->getBody(), "VERIFIED") != 0)
        {
            $paymentInteract->setPaymentAttemptHack("paypal not verified! response was ". $responseVerification->getBody());
            return false;
        }

        $this->logger->info("Verification passed");

        return true;
    }

    /**
     * @return array
     */
    protected function getUrlPaypal()
    {
        return $this->providerlive ? self::URL_LIVE : self::URL_SANDBOX;
    }

}