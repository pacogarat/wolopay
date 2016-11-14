<?php

namespace AppBundle\Payment\PayMethod\PaySafeCard;

use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use AppBundle\Payment\PayMethod\PaySafeCard\Lib\SOPGClassicMerchantClient;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Service("shop.payment.paysafecard_ipn_pay_method")
 *
 * To test need to ask pins, you can hold it in this path
 * src/AppBundle/Tests/E2E/PageActions/PayMethod/codes/paysafecard.txt
 */
class PaySafeCardPayMethod extends AbstractPayMethod implements PayMethodIpnExecutionInterface, PayMethodVerifyCredentialsInterface
{
    /** @var string  */
    protected $providerlive;

    /** @var string  */
    protected $providerUser;

    /** @var string  */
    protected $providerPassword;

    const PREFIX_EXTERNAL_TRANSACTION = 'PAYSAFEC_';

    /**
     * @InjectParams({
     *    "locale" = @Inject("%locale%"),
     *
     *    "live"   = @Inject("%payments.paysafecard.live%"),
     *    "user"  = @Inject("%payments.paysafecard.user%"),
     *    "password"  = @Inject("%payments.paysafecard.password%"),
     * })
     */
    function __construct($locale, $live, $user, $password)
    {
        $this->locale       = $locale;
        $this->providerlive = $live;

        $this->providerUser     = $user;
        $this->providerPassword = $password;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $credentialsDetailsArr = $this->getProviderClientCredentialsIfItIsNeeded(
            $this->providerlive,
            $paymentDetails,
            $this->getShapeProviderClientCredentials()
        );

        $soapPaySafeCard = $this->createObjectPaySafeCard($credentialsDetailsArr['client_id'], $credentialsDetailsArr['secret']);

        $soapPaySafeCard->setCustomer(
            $this->forceTwoDecimals($paymentDetails->getAmount()),
            $paymentDetails->getCurrency()->getId(),
            $paymentProcess->getId(),
            $paymentDetails->getTransaction()->getGamer()->getId()
        );

        $soapPaySafeCard->setUrl(
            rawurlencode($paymentInteract->getUrlOk()),
            rawurlencode($paymentInteract->getUrlKo()),
            rawurlencode($paymentInteract->getUrlIpn())
        );

        if (!$paymentPanel = $soapPaySafeCard->createDisposition())
        {
            $this->logger->addError("Cant generate PaySafeCard link to buy: ". $soapPaySafeCard->getLog());
            return;
        }

        $paymentInteract->setRequestResult($paymentPanel, 'GET');

    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $request        = $paymentInteract->getRequest();
        $paymentProcess = $paymentInteract->getPaymentProcess();

        $soapPaySafeCard = $this->createObjectPaySafeCard();
        $externalTransactionId=$request->get('mtid');
        //get current status
        $status = $soapPaySafeCard->getSerialNumbers($externalTransactionId, $paymentProcess->getPaymentDetail()->getCurrency()->getId(), '');
        //If the return is 'execute', the amount can be debited (executeDebit)
        if ($status !== 'execute')
        {
            $this->logger->addError("Can be execute verification. status = '$status', ". $soapPaySafeCard->getLog('all'));
            $paymentInteract->setPaymentFailed();
            return;
        }

        $testexecute = $soapPaySafeCard->executeDebit($this->forceTwoDecimals($paymentProcess->getPaymentDetail()->getAmount()));

        if ($testexecute !== true)
        {
            $paymentInteract->setPaymentAttemptHack("Soap Validation PaySafeCard");
            return;
        }

        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$externalTransactionId);

        $this->logger->addDebug("end paysafecard.php");
    }

    /**
     * @param null $providerUser
     * @param null $providerPassword
     * @param null $forceToLive
     * @return SOPGClassicMerchantClient
     */
    private function createObjectPaySafeCard($providerUser = null, $providerPassword = null, $forceToLive = null)
    {
        $debug       = (($this->providerlive || $forceToLive) == false);
        $mode        = (($this->providerlive || $forceToLive) ? 'live' : 'test');
        $autoCorrect = false;
        $sysLang     = 'en';

        $obj = new SOPGClassicMerchantClient($debug, $sysLang, $autoCorrect, $mode, $this->logger );
        $obj->merchant( $providerUser?: $this->providerUser, $providerPassword ?: $this->providerPassword );
        $obj->setShoplabel('Wolopay');

        return $obj;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {
        try{
            $soapPaySafeCard = $this->createObjectPaySafeCard($credentialsArray['client_id'], $credentialsArray['secret'], true);
            $soapPaySafeCard->setCustomer(
                '20.20',
                'EUR',
                uniqid(),
                'test'
            );

            $soapPaySafeCard->setUrl(
                'https://wolopay.com',
                'https://wolopay.com',
                'https://wolopay.com'
            );

            if (!$paymentPanel = $soapPaySafeCard->createDisposition())
                return false;

        }catch (\Exception $e){

            return false;
        }

        return true;
    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return ['client_id' => null, 'secret' => null];
    }
}