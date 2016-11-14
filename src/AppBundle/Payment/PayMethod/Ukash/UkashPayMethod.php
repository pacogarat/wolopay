<?php

namespace AppBundle\Payment\PayMethod\Ukash;

use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Service("shop.payment.ukash_ipn_pay_method")
 *
 * To test need to ask pins, you can hold it in this path
 * src/AppBundle/Tests/E2E/PageActions/PayMethod/codes/ukash.txt
 */
class UkashPayMethod  extends AbstractPayMethod implements PayMethodIpnExecutionInterface
{
    /** @var string  */
    protected $providerLive;

    /** @var string  */
    protected $providerUser;

    /** @var string  */
    protected $providerPassword;

    public static $availableLanguages = [ 'EN' ];

    const URL_SANDBOX = 'https://processing.staging.ukash.com/RPPGateway/Process.asmx';
    const URL_LIVE    = 'https://processing.ukash.com/RPPGateway/process.asmx';

    const URL_WEB_SANDBOX = 'https://direct.staging.ukash.com/hosted/entry.aspx';
    const URL_WEB_LIVE    = 'https://direct.ukash.com/hosted/entry.aspx';

    const PREFIX_EXTERNAL_TRANSACTION = 'UKASH_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.ukash.live%"),
     *    "user"  = @Inject("%payments.ukash.user%"),
     *    "password"  = @Inject("%payments.ukash.password%"),
     * })
     */
    function __construct($live, $user, $password)
    {
        $this->providerLive = $live;

        $this->providerUser     = $user;
        $this->providerPassword = $password;
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();

        $lang = strtoupper($this->locale);

        if (in_array(strtoupper($paymentDetails->getLanguage()->getId()), self::$availableLanguages))
            $lang = strtoupper($paymentDetails->getLanguage()->getId());

        $postValues = [
            'BrandID'               => $this->providerUser,
            'SecurityToken'         => $this->providerPassword,
            'LanguageCode'          => $lang,
            'MerchantTransactionID' => substr($paymentProcess->getId(), -20), // because ukash has a length restriction
            'MerchantCurrency'      => $paymentInteract->getCurrencyPaymentISO(),
            'ConsumerID'            => $paymentDetails->getTransaction()->getGamer()->getId(),
            'URL_Success'           => $paymentInteract->getUrlOk(),
            'URL_Fail'              => $paymentInteract->getUrlKo(),
            'URL_Notification'      => $paymentInteract->getUrlIpn(),
            'TransactionValue'      => $this->forceTwoDecimals($paymentInteract->getAmountFloat()) ,
        ];

        $this->logger->addInfo('Parameters sent: '.http_build_query($postValues));

        try{
            $url = $this->getUrlProvider().'/GetUniqueTransactionID';
            $paymentInteract->setSubRequestDone($url, $postValues);

            $request  = $this->guzzle->post($url, null, $postValues);
            $response = $request->send();

            $apiResponseTxt = $response->getBody(true);


            $xml = new \SimpleXmlElement($apiResponseTxt);

            //Decode the xml strings value
            $decodedString = utf8_decode(urldecode($xml));

            $paymentInteract->setSubRequestDoneResponse($decodedString , $response->getStatusCode(), false, true);

            //Reloaded the decoded string, as XML.
            $xml = new \SimpleXmlElement($decodedString);

            //Extract the UTID from the XML object
            $nodes = $xml->xpath('/UKashRPP/UTID');

            if (!$UTID = (string)$nodes[0])
                throw new \Exception('getting ukash id, api response: '. $apiResponseTxt);

            $paymentInteract->setRequestResult($this->getUrlIframe().'?UTID='.$UTID, 'GET');

        }catch (\Exception $e){
            $this->logger->addError("Cant be generate url rixty: ".$e->getMessage());
        }

    }

    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        if (!$paymentExternalId = $this->verifyStatus($paymentInteract))
            return;

        $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION.$paymentExternalId);
    }

    protected function verifyStatus(PaymentIpnInteract $paymentInteract)
    {
        $post = $paymentInteract->getRequest()->request->all();

        if (!$post['UTID'])
            throw new BadRequestHttpException('Post value UTID is required');

        $urlRequest = $this->getUrlProvider().'/GetTransactionStatus';
        $postRequest = [
            'BrandID' => $this->providerUser,
            'SecurityToken' => $this->providerPassword,
            'UTID' => $post['UTID']
        ];

        $paymentInteract->setSubRequestDone($urlRequest, $postRequest);

        $requestVerification = $this->guzzle->post($urlRequest, [], $postRequest);
        $responseVerification = $requestVerification->send();

        $responseTxt = $responseVerification->getBody(true);


        //Convert the string value to XML
        $xml = new \SimpleXmlElement($responseTxt);

        //Decode the xml strings value
        $decodedstring = utf8_decode(urldecode($xml));
        $paymentInteract->setSubRequestDoneResponse($decodedstring, $responseVerification->getStatusCode(), false, true);

        //Reloaded the decoded string, as XML.
        $xml = new \SimpleXmlElement($decodedstring);

        //Extract the Error Description from the XML object
        $nodes = $xml->xpath('/UKashRPP/TransactionCode');
        $TransactionCode = (string) $nodes[0];

        if ($TransactionCode != '0')
        {
            $this->logger->addError("Transaction code isn't 0, his value is: '$TransactionCode'");
            return false;
        }

        //Return the UTID value to the calling function.
        $nodes = $xml->xpath('/UKashRPP/UkashTransactionID');
        return (string)$nodes[0];
    }

    /**
     * @return array
     */
    protected function getUrlProvider()
    {
        return $this->providerLive ? self::URL_LIVE : self::URL_SANDBOX;
    }

    /**
     * @return array
     */
    protected function getUrlIframe()
    {
        return $this->providerLive ? self::URL_WEB_LIVE : self::URL_WEB_SANDBOX;
    }

}