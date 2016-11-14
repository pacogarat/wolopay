<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;


use AppBundle\Entity\SMSCode;
use AppBundle\Entity\Transaction;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Lexik\Bundle\TranslationBundle\Translation\Translator;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @Route("/sms")
 */
class SMSController extends AbstractSMSController
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var Translator
     * @Inject("translator")
     */
    public $translator;

    const LOG_NAME = 'sms_mo_mt_code';

    private $ALLOWED_IPS = array('193.219.96.0/24','213.139.25.142','80.28.132.254','127.0.0.1');

    /**
     * @Route("/logic_mo_mt_code/{_locale}/{transaction_id}/{payment_process_id}", name="sms_logic_mo_mt_code" )
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function logicMoMtCodeAction(Request $request, Transaction $transaction, $payment_process_id, $_locale)
    {
        return parent::logicMoMtCodeRender($request, $transaction, $payment_process_id, $_locale);
    }

    /**
     * @Route("/ipn_static", name="sms_ipn")
     */
    public function ipnStaticAction(Request $request)
    {

        if (!UtilHelper::ipv4_in_array($request->getClientIp(), $this->ALLOWED_IPS)){
            throw new BadRequestHttpException("This IP (".$request->getClientIp().") is not allowed ");
        }

        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'in');

        $this->logger->addInfo("NEW payment with params: ". print_r($request->query->all(), true));

        $operator = $request->get('operadora');
        $text = $this->getSmsAliasFormat($request->get('texto'));
        $mobile = $request->get('movil');
        $country = $request->get('country');
        $host = $request->get('host');
        $externalTransactionId = $request->get('id_mensaje');

        $sms = $this->em->getRepository("AppBundle:SMS")->findOneByAliasAndCountryAndSmsShortCodeAndOperatorShortName(
            $text, $country, $host, $operator
        );

        if (!$sms)
            throw new BadRequestHttpException("This parameters alias: $text, country: $country, operator: $operator, short Number: $host,  haven't sms configured ");

        $newCode=null;
        while (true)
        {
            $newCode = rand ( 10000 , 999999);

            if (!$this->em->getRepository("AppBundle:SMSCode")->find($newCode))
                break;
        }

        $smsCode = new SMSCode();
        $smsCode
            ->setAmount($sms->getAmount())
            ->setCurrency($sms->getPayMethodProviderHasCountry()->getCurrency())
            ->setOperator($sms->getOperator())
            ->setMobile($mobile)
            ->setCode($newCode)
            ->setExternalTransactionId('NVIASMS_'.$externalTransactionId)
        ;

        $this->em->persist($smsCode);
        $this->em->flush();
        $this->logger->addInfo("Saved $newCode with amount ". $sms->getAmount());

        $msg = $this->translator->trans($sms->getMobileTextSingUpLabel()->getKey(), ['#CODE#' => $newCode, '#PIN#' => $newCode], $sms->getMobileTextSingUpLabel()->getDomain());

        if (!$msg || $msg==$sms->getMobileTextSingUpLabel()->getKey())
        {
            $this->logger->addError("Response message of sms is empty, translate it! domain: ". $sms->getMobileTextSingUpLabel()->getKey());
            $msg = $this->translator->trans('sms.logic_mo_mt_code.sing_up_text', ['#CODE#' => $newCode, '#PIN#' => $newCode], $sms->getMobileTextSingUpLabel()->getDomain());
        }

        $this->logger->addInfo("Message was responded $msg");

        return new Response("OK $msg");
    }

    private function getSmsAliasFormat($text, $maxSubKeywords=0, $delimiter=" ")
    {
        $text = trim(strtoupper($text));

        $pos = strpos($text, ' ');
        if ($pos !== false)
        {
            if ($maxSubKeywords==0){
                $text = substr($text,0 , $pos);
            }else{
                $txtArr = explode($delimiter,$text,$maxSubKeywords+1);
                $text = $txtArr[0];
                for($i=1;$i<=$maxSubKeywords;$i++){
                    $text .= " " . $txtArr[$i];
                }
            }
        }

        return $text;
    }


}
