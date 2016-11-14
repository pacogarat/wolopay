<?php

namespace AppBundle\Controller\PaymentHosted\NviaPayMethods;


use AppBundle\Entity\SMSCode;
use AppBundle\Entity\Transaction;
use AppBundle\Exception\NviaException;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Lexik\Bundle\TranslationBundle\Translation\Translator;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

/**
 * @Route("/sms_fortuno")
 */
class FortunoSMSController extends AbstractSMSController
{
    const SECRET = 'ee7188f634bd6ac94f893f030eeba97d';
    const SECRET_8bb78ced8ec7df8fca1addd0aa6a5659 = 'ee7188f634bd6ac94f893f030eeba97d'; //DEFAULT
    const SECRET_72914db1c38a93d49a29d18d87f95e39 = '038f7df0cb6491c1b4b9fa3dbc0df58e'; //TXT WOLO30 (PL)
    const SECRET_0c62d67b99c059bc373dac101ec5af65 = 'db2760b264dd0c9eee40f21b6e7251ec'; //TXT WOLO11 (PL)
    const SECRET_9ac08658361a0d6364e3e3afa2faf5ec = '96f57c7001aaa7fdbe616c292d402f06'; //TXT WOLO2 (PL)
    const SECRET_c49fca034360f49ea70abcfb6f298274 = 'c943ed50717f453909b345a9e5a7745a'; //TXT WOLO23 (PL)
    const SECRET_a8f3b0e687d69c4e27bbf47c7fe7f2e4 = '975517e1662cd2b8928fe3747f26d708'; //TXT WOLO4 (PL)


    const LOG_NAME = 'sms_fortuno_mo_mt_code';

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

    /**
     * @Route("/logic_mo_mt_code/{_locale}/{transaction_id}/{payment_process_id}", name="fortuno_sms_logic_mo_mt_code" )
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     */
    public function logicMoMtCodeAction(Request $request, Transaction $transaction, $payment_process_id, $_locale)
    {
        return parent::logicMoMtCodeRender($request, $transaction, $payment_process_id, $_locale);
    }


    /**
     * @Route("/billing", name="fortuno_billing")
     */
    public function billingAction(Request $request)
    {
        $this->addSpecialLogByPayMethod(self::LOG_NAME.'_billing', 'in');
        $this->logger->addInfo(http_build_query($request->query->all()));

        return new Response();
    }

    /**
     * @Route("/ipn_static", name="fortuno_sms_ipn")
     */
    public function ipnStaticAction(Request $request)
    {
        if($request->server->get('REMOTE_ADDR') && !in_array($request->server->get('REMOTE_ADDR'),
            array('79.125.125.1', '79.125.5.205',
                '79.125.5.95', '54.72.6.126', '54.72.6.27', '54.72.6.17', '54.72.6.23'))
            && strpos(__FILE__, 'miguel.pay-gateway.net')== -1
        ) {
            throw new BadCredentialsException("Unknown IP");
        }

        if(!$this->checkSignature($request)) {
            throw new BadRequestHttpException("Invalid signature");
        }

        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'in');

        $this->logger->addInfo("NEW payment with params: ". print_r($request->query->all(), true));

        $sender = $request->get('sender');
        $operatorName = $request->get('operator');
        $countryId = $request->get('country');
        $shortCode = $request->get('shortcode');
        $keyword = trim(strtoupper($request->get('keyword')));
        $message = $request->get('message');
        $externalTransactionId = $request->get('message_id'); //unique id

        if (!$smsOperator = $this->em->getRepository("AppBundle:SMSOperator")->findOneByLikeNameAndCountry($operatorName, $countryId))
            throw new NviaException("cant find operator: '$operatorName' for country: '$countryId''");

        $sms = $this->em->getRepository("AppBundle:SMS")->findOneByAliasAndCountryAndSmsShortCodeAndOperatorId(
            $keyword, $countryId, $shortCode, $smsOperator->getId()
        );

        if (!$sms)
            throw new BadRequestHttpException("This parameters alias: $keyword, country: $countryId, operatorId: ".$smsOperator->getId().", short Number: $shortCode,  haven't sms configured ");

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
            ->setMobile($sender)
            ->setCode($newCode)
            ->setExternalTransactionId('FORTUNO_'.$externalTransactionId)
        ;

        $this->em->persist($smsCode);
        $this->em->flush();
        $this->logger->addInfo("Saved $newCode with amount ". $sms->getAmount());

        $msg = "Code: $newCode. ";
        $msg .= $this->translator->trans($sms->getMobileTextSingUpLabel()->getKey(),
            [
                '#CODE#' => $newCode, '#PIN#' => $newCode,
                '{[{amount}]}' => $sms->getAmount().$sms->getPayMethodProviderHasCountry()->getCurrency()->getSymbol()
            ],
            $sms->getMobileTextSingUpLabel()->getDomain()
        );

        if (!$msg || $msg==$sms->getMobileTextSingUpLabel()->getKey())
        {
            $this->logger->addError("Response message of sms is empty, translate it! domain: ". $sms->getMobileTextSingUpLabel()->getKey());
            $msg = "Code: $newCode. ";
            $msg = $this->translator->trans('sms.logic_mo_mt_code.sing_up_text', ['#CODE#' => $newCode, '#PIN#' => $newCode], $sms->getMobileTextSingUpLabel()->getDomain());
        }

        $this->logger->addInfo("Message was responded $msg");

        return new Response($msg);
    }

    private function checkSignature(Request $request)
    {
        $params_array = $request->query->all();
        ksort($params_array);

        $str = '';
        foreach ($params_array as $k=>$v)
        {
            if($k != 'sig') {
                $str .= "$k=$v";
            }

        }

        $ref = new \ReflectionClass($this);
        $constName = 'SECRET_'.$request->get('service_id');
        $secret = $ref->getConstant($constName);

        $str .= $secret;
        $signature = md5($str);

        return ($params_array['sig'] == $signature);
    }
}
