<?php

namespace AppBundle\Payment\PayMethod\Tigo;

use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Exception\NviaException;
use AppBundle\Payment\PayMethod\AbstractPayMethod;
use AppBundle\Payment\PayMethod\Exceptions\DynamicRequiredPayMethodException;
use AppBundle\Payment\PayMethod\Interact\PaymentIpnInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPrepareInteract;
use AppBundle\Payment\PayMethod\Interact\PaymentPreviousStepsInteract;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodExecutionInUrlCancel;
use AppBundle\Payment\PayMethod\Interfaces\PayMethodIpnExecutionInterface;
use AppBundle\Payment\PayMethod\Interfaces\PreviousStepInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;


/**
 * @Service("shop.payment.tigo_ipn_pay_method")
 *
 * Web report transactions http://190.129.208.178:96/comercio/faces/views/transacciones.xhtml
 *
 */
class TigoIpnPayMethod extends AbstractPayMethod  implements PayMethodIpnExecutionInterface, PreviousStepInterface, PayMethodExecutionInUrlCancel
{
    /** @var string  */
    protected $providerLive;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var TwigEngine */
    protected $templating;

    const KEY_ENCRYPT_PRODUCTION = 'CNHL0P3TWJWUYU6PNTB1CZYP';
    const KEY_ENCRYPT_SANDBOX = 'YAKZ7NCJ2FA9MLCM9FPGXXIX';

    const IDENTIFIER_PRODUCTION = 'ab5ac183781fd89be3fccbc2676826cc36a1a8b3290117ac49ea94ae0b800e8a3a075cdef9c22597bd8192c60105894e64aceffc42f67c1128268943ccd4756d';
    const IDENTIFIER_SANDBOX = '9c943c8410e93f63411c1d6b5d90334fa427f6f08377c22587092a4e3df348e450a27e63ff0e47c2bac4b1fdef278ff3da82a3031b2687a06071bd75f325fab1';

    const URL_SANDBOX = 'https://190.129.208.178:8181/vipagos/faces/payment.xhtml?';
 //   const URL_PRODUCTION = 'https://vipagos.com.bo/vipagos/faces/payment.xhtml';
    const URL_PRODUCTION = 'https://pasarela.tigomoney.com.bo/vipagos/faces/payment.xhtml';
/* David: 2016-05-30
 https://pasarela.tigomoney.com.bo/comercio
https://pasarela.tigomoney.com.bo/vipagos/faces/payment.xhtml
https://pasarela.tigomoeny.com.bo/PasarelaServices/CustomerServices?wsdl
*/


    public static $availableLanguages = [ 'en' => 'en_US', 'br' => 'pt_BR', 'es' => 'es_ES', 'pt' => 'pt_PT', 'tr' => 'tr_TR'];
    public static $ipsAvailable = [ '200.147.106.24', '200.147.106.25', '200.147.106.65', '200.147.106.66'];

    const PREFIX_EXTERNAL_TRANSACTION = 'TIGO_';

    /**
     * @InjectParams({
     *    "live"   = @Inject("%payments.tigo.live%"),
     *    "validator"   = @Inject("validator"),
     *    "templating"  = @Inject("templating")
     * })
     */
    function __construct($live, ValidatorInterface $validator, TwigEngine $templating)
    {
        $this->providerLive  = $live;
        $this->validator = $validator;
        $this->templating = $templating;
    }

    /**
     * @param PaymentPreviousStepsInteract $previous
     * @throws \AppBundle\Payment\PayMethod\Exceptions\DynamicRequiredPayMethodException
     * @return mixed
     */
    public function executePreviousStep(PaymentPreviousStepsInteract $previous)
    {
        $transaction = $previous->getTransaction();
        $gamer = $transaction->getGamer();

        $validatorRequirements = ['tigo'];

        $errors = $this->validator->validate($gamer, null, $validatorRequirements);

        if (count($errors))
            throw new DynamicRequiredPayMethodException($validatorRequirements);
    }

    public function executePaymentPrepare(PaymentPrepareInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $gamer = $paymentDetails->getTransaction()->getGamer();

        $txtPvItems = '';
        $i = 0;
        foreach($paymentDetails->getPaymentDetailHasArticles() as $pdha)
        {
            $i++;
            $txtPvItems.="*i$i|".$pdha->getArticlesQuantity().'|'.$paymentInteract->getNameTranslation($pdha)
                .'|'.$pdha->getArticleUnitaryAmount().'|'.$pdha->getAmount();
        }

        // We need create order Id because tigo only accept integer WTF :S
        $orderId = time().rand(1000000, 9999999);

        $extraData = $paymentDetails->getExtraData();
        $extraData['order_id'] = $orderId;


        $paymentDetails->setExtraData($extraData);

        $params = [
            'pv_nroDocumento' => $paymentProcess->getGamer()->getId(),
            'pv_linea'        => $gamer->getTigoMobileNumber(), // Tigo Money del cliente.
            'pv_monto'        => $paymentDetails->getAmount(),
            'pv_orderId'      => $orderId,
            'pv_nombre'       => mb_strimwidth($gamer->getName().' '.$gamer->getSurname(), 0, 97, '...'),
            'pv_confirmacion' => 'Gracias',
            'pv_notificacion' => '',
            'pv_urlCorrecto'  => $paymentInteract->getUrlIpn(),
            'pv_urlError'     => $paymentInteract->getUrlKo(),
            'pv_items'        => $txtPvItems,
            'pv_razonSocial'  => 'Wolopay',
            'pv_nit'          => '',
        ];

        $hash = '';

        foreach ($params as $key => $value)
            $hash.="$key=$value;";

        $hash = substr($hash, 0, strlen($hash)-1);
        $this->logger->addInfo('Params to encrypt: '.$hash);

        $params = ['key' => $this->getIdentifier(), 'parametros' => $this->encrypt($hash)];

        $paymentInteract->setRequestResult($this->getUrl(),'POST', $params);
    }

    private function getResponseFromTigo($responseEncoded)
    {
        if (!$responseEncoded )
            throw new NviaException('Need "r" param');

        $responseDecoded = $this->decrypt($responseEncoded);

        $this->logger->addInfo("Response decoded: $responseEncoded");

        $responseArr = explode ("&",$responseDecoded);
        $transactionExternalId = $codRes = $message = null;

        foreach ($responseArr as $arr)
        {
            list($key, $value) = explode( '=', $arr);

            if ($key == "codRes")
                $codRes = $value;
            elseif ($key == "mensaje")
                $message = $value;
            elseif ($key == "orderId")
                $transactionExternalId = $value;
        }

        $errorMsg = "Se ha producido un error en el cobro";

        switch ($codRes) {
            case "0":
                $errorMsg = null;
                break;
            case "4":
                $errorMsg = "Comercio no Registrado";
                break;
            case "7":
                $errorMsg = "Acceso Denegado por favor intente nuevamente y verifique los datos incorporados";
                break;
            case "8":
                $errorMsg = "PIN no valido, vuelva a intentar";
                break;
            case "11":
                $errorMsg = "Tiempo de respuesta excedido, por favor inicie la transaccion nuevamente";
                break;
            case "14":
                $errorMsg = "Billetera Movil destino no registrada, favor verifique sus datos";
                break;
            case "17":
                $errorMsg = "Monto no valido, verifique los datos proporcionados";
                break;
            case "19":
                $errorMsg = "Comercio no habilitado para el pago, favor comunicarse con el comercio";
                break;
            case "23":
                $errorMsg = "El monto introducido es menor al requerido, favor verifique los datos";
                break;
            case "24":
                $errorMsg = "El monto introducido es mayor al requerido, favor verifique los datos";
                break;
            case "1001":
                $errorMsg = "Los fondos en su Billetera movil son insuficientes, para cargar su billetera vaya al Punto Tigo Money mas cercano, marque *555#";
                break;
            case "1002":
                $errorMsg = "No ingresaste tu PIN, tu transaccion no pudo ser completada, inicia la transaccion nuevamente y verifica en transacciones por completar";
                break;
            case "1003":
                $errorMsg = "No disponible";
                break;
            case "1004":
                $errorMsg = "Estimado Cliente llego a su limite de monto transaccionado, si tiene alguna consulta comuniquese con el *555";
                break;
            case "1012":
                $errorMsg = "Estimado Cliente excedio su limite de intentos de introducir su PIN, por favor comuniquese con el *555 para solicitar su nuevo PIN";
                break;
            case "560":
                $errorMsg = "Su transaccion no fue completada favor intente nuevamente en 1 minuto";
                break;
        }

        return [$codRes, $message, $transactionExternalId, $errorMsg];
    }


    public function executePaymentIpn(PaymentIpnInteract $paymentInteract)
    {
        $paymentProcess = $paymentInteract->getPaymentProcess();
        $paymentDetails = $paymentProcess->getPaymentDetail();
        $transaction = $paymentDetails->getTransaction();
        $request        = $paymentInteract->getRequest();


        list($codRes, $message, $transactionExternalId, $errorMsg) = $this->getResponseFromTigo($request->get('r'));


        $valid = false;
        $errorMsg = "Se ha producido un error en el cobro";

        if ($codRes== '0') {
            $this->logger->addInfo("Cod Res valid: $codRes");

            $paymentInteract->setPaymentCompleted(self::PREFIX_EXTERNAL_TRANSACTION . $transactionExternalId);
            $paymentInteract->setResponseDirectly(
                new RedirectResponse($this->generateUrlPaymentDone($paymentProcess))
            );
        }else{

            $this->logger->addInfo("Cod Res invalid: $codRes");
            $paymentInteract->setPaymentFailed($errorMsg);

            $paymentInteract->setResponseDirectly(
                new RedirectResponse($this->generateUrlPaymentCancel($paymentProcess, ['description' => $errorMsg, 'title' => 'Se ha producido un error']))
            );
        }

    }

    private function encrypt($hash)
    {
        $hash = str_replace(' ', '+', $hash);
        $encryptedWithPadding = mcrypt_encrypt(MCRYPT_3DES, $this->getEncryptKey(), $hash, MCRYPT_MODE_ECB);
        $encrypted = rtrim($encryptedWithPadding, "\0");

        return base64_encode($encrypted);
    }

    private function decrypt($hash)
    {
        return mcrypt_decrypt(MCRYPT_3DES, $this->getEncryptKey(), base64_decode( str_replace(' ', '+', $hash)), MCRYPT_MODE_ECB);
    }

    private function getEncryptKey()
    {
        if ($this->providerLive)
            return self::KEY_ENCRYPT_PRODUCTION;
        else
            return self::KEY_ENCRYPT_SANDBOX;
    }

    private function getIdentifier()
    {
        if ($this->providerLive)
            return self::IDENTIFIER_PRODUCTION;
        else
            return self::IDENTIFIER_SANDBOX;
    }

    private function getUrl()
    {
        if ($this->providerLive)
            return self::URL_PRODUCTION;
        else
            return self::URL_SANDBOX;
    }

    /**
     * @param \AppBundle\Entity\PaymentProcessInterface $paymentProcess
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return bool
     */
    public function executeInUrlCancel(PaymentProcessInterface $paymentProcess, Request $request)
    {
        list($codRes, $message, $transactionExternalId, $errorMessage) = $this->getResponseFromTigo($request->get('r'));
        return $this->templating->renderResponse(
            '@App/AppShop/Payment/cancel/default.html.twig',
            ['title' => 'Se ha producido un error', 'description' => $errorMessage, 'state' => 'cancel']
        );
    }
}