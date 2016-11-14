<?php

namespace AppBundle\Controller\Others;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\SMSLogicCategoryEnum;
use AppBundle\Entity\SMS;
use AppBundle\Payment\PayMethod\ExternalStores\ChromeStore;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Lexik\Bundle\TranslationBundle\Entity\TransUnitRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\CsvResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OthersController extends Controller
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var Symfony\Component\HttpFoundation\Session
     * @Inject("session")
     */
    public $session;

    /**
     * @var CurrencyService
     * @Inject("common.currency")
     */
    public $currencyService;

    /**
    * @Route("/pretty-json", name="pretty_json")
    * @Method(methods={"GET"})
    */
    public function jsonPretty(Request $request)
    {
       return new JsonResponse($request->query->all());
    }


    /**
     * @Route("/tororo", name="tororo")
     */
    public function tororoAction(Request $request){

        $m=microtime(true);
        $s=sprintf("%08d%05d\n",floor($m),($m-floor($m))*1000000);

        return new Response($s);
    }
    /**
     * @Route("/tiriri", name="tiri")
     */
    public function tiririAction(Request $request)
    {
        $appId = 'METALA56c5e55b3b26a';
        $dateFrom = "2016-05-10 22:00:00";
        $dateTo = "2016-05-18 21:59:59";
        $currencyResult = "EUR";

        $change = ($currencyResult == CurrencyEnum::DOLLAR ? ' p.exchangeRateUsd ' :
            ($currencyResult == CurrencyEnum::POUND_STERLING ? ' p.exchangeRateGbp ' : ' p.exchangeRateEur '));


        $sql="
            SELECT  p.id as purchaseId,
                    DATE_FORMAT(p.createdAt,'%Y-%m-%d') as purchaseDate,
                    DATE_FORMAT(p.createdAt,'%H:%i:%s') as purchaseTime,
                    t.id as transaction,
                    DATE_FORMAT(t.beginAt,'%Y-%m-%d') as transactionDate,
                    DATE_FORMAT(t.beginAt,'%H:%i:%s') as transactionTime,
                    pm.name as payMethod, g.gamerExternalId as gamer, c.id as countryId, c.name as countryName,
                    IDENTITY (p.currency) as currencyId,
                    ROUND( (p.amountTaxPaidByProvider + p.amountTax)/(p.amountTotal-(p.amountTaxPaidByProvider + p.amountTax))*100,1) as taxPercent,
                    ROUND( p.amountTotal, 2) as amountTotal,
                    ROUND( (p.amountTaxPaidByProvider + p.amountTax), 2) as amountTax,
                    ROUND( p.amountTax, 2)   as amountTaxReceived,
                    ROUND( p.amountTaxPaidByProvider, 2) as amountTaxPaidByProvider,
                    ROUND( p.amountProvider, 2)  as totalAmountProviderIncludingTaxes,
                    ROUND( p.amountProvider-p.amountTaxPaidByProvider, 2)  as totalAmountProviderWithoutTaxes,
                    ROUND( p.amountWolo, 2) as amountWolopay,
                    ROUND( p.amountGame, 2) as amountGame,
                    $change,
                    ROUND( p.amountTotal * $change, 2) as amountTotalEur,
                    ROUND( (p.amountTax+p.amountTaxPaidByProvider) * $change, 2)  as amountTaxEur,
                    ROUND( p.amountTax   * $change, 2)  as amount_taxReceivedEur,
                    ROUND( p.amountTaxPaidByProvider * $change, 2)  as amountTaxPaidByProviderEur,
                    ROUND( p.amountProvider * $change, 2)  as total_amountProviderIncludingTaxesEur,
                    ROUND( (p.amountProvider-p.amountTaxPaidByProvider)*$change, 2)  as totalAmountProviderWithoutTaxesEur,
                    ROUND( p.amountWolo  * $change, 2)  as amountWolopayEur,
                    ROUND( p.amountGame  * $change, 2)  as amountGameEur,
                    ROUND( (1-(p.amountGame /(p.amountTotal-(p.amountTaxPaidByProvider + p.amountTax))))*100 ,2) as finalPaymethodFeePercent
            FROM
              AppBundle:Purchase p
              JOIN p.transaction t
              JOIN p.gamer g
              JOIN p.country c
              JOIN p.payMethod pm
          WHERE
              t.app = :appId AND
              (
                    (p.id is null AND t.beginAt between :dateFrom AND :dateTo)
                OR  (p.id is not null AND p.createdAt between :dateFrom AND :dateTo)
              )
        ";


        $sqlResult = $em->createQuery($sql)
            ->setParameters(['appId' => $appId, 'dateFrom'=>$dateFrom, 'dateTo'=>$dateTo])
            ->getArrayResult()
        ;
        $headerArr =array();
        $r2 = array();
        $ll="";
        $sal="";
        $header = "purchaseId,purchaseDate,purchaseTime,transactionId,transactionDate,tranasctionTime,payMethod,gamer,countryId,countryName,currency,taxPercent,".
        "amountPaid,amountTax,amountTaxReceived,amountTaxPaidByProvider,amountProviderIncludingTaxes,amountProviderWithoutTaxes,amountWolopay,amountGame, exchangeRate,".
        "amountPaidEur,amountTaxEur,amountTaxReceivedEur,amountTaxPaidByProviderEur,amountProviderIncludingTaxesEur,amountProviderWithoutTaxesEur,amountWolopayEur,amountGameEur,".
        "finalPaymethodFeePercent";

        $headerArr = explode(",",$header);
        array_push($r2,$headerArr );

        $sal=$header . "\r\n";
        foreach ($sqlResult as $key=>&$line){
            array_push($r2,$line);
        }
        return new CsvResponse($r2);
    }

    /*
    * @Route("/f", name="import_m3ovil")
    * @Method(methods={"GET"})

   public function yolo(Request $request)
   {
       $trolo = $this->guzzle->get('https://google.es');
       echo $trolo->getUrl();
   }
   */

    /* Deactivated
     * @Route("/import_movil", name="import_movil")
     * @Method(methods={"POST"})
     */
    public function importMovilAction(Request $request)
    {
        /**
         * Execute this query to autoimport
         *
         * SELECT Pais.ShortName, Operadora.ShortName, SMS.* , Pais.Name, Operadora.Name
         * FROM pasarela.SMS_Operadora
         * inner join Operadora on (SMS_Operadora.IdOperadora = Operadora.IdOperadora)
         * inner join SMS on (SMS.IdMedioPago = SMS_Operadora.IdMedioPago)
         * inner join MedioPago on (SMS.IdMedioPago = MedioPago.IdMedioPago)
         * inner join Pais on (Pais.CodigoPais = MedioPago.CodigoPais)
         * where SMS.idLogica = 6
         * AND MedioPago.idCategoria = 1
         * and Operadora.ShortName is not null
         *
         * order by SMS.ShortCode

         */

        $csv = $request->getContent();

        $rows = explode("\n", str_replace("\n\r", "\n", $csv));
        /** @var TransUnitRepository $transunit */
        $transunit  = $this->em->getRepository('LexikTranslationBundle:TransUnit');
        $textSingUp = $transunit->findOneBy(['key' => 'sms.mobile_text_sing_up.write_pin']);
        $textLegal  = $transunit->findOneBy(['key' => 'sms.legal_text.standard']);

        $mocategory = $this->em->getRepository('AppBundle:SMSLogicCategory')->find(
            SMSLogicCategoryEnum::MO_AND_MT_AND_CODE
        );
        $created    = 0;
        $updated    = 0;

        foreach ($rows as $row) {
            $vals = array_map('trim', str_getcsv($row));
            if (count($vals) < 5) {
                continue;
            }

            $countryId         = $vals[0];
            $operatorShortName = $vals[1];
            $shortNumber       = $vals[4];
            $amount            = $vals[5];
            $currencyId        = $vals[6];
            $legalKeyCSV       = $vals[11];

            if ($currencyId == 'Baht')
                $currencyId = 'THB';

            if ($currencyId == 'Bs' || $currencyId == 'BSF')
                $currencyId = 'VEF';

            if (!$currency = $this->em->getRepository("AppBundle:Currency")->find($currencyId))
                die("Currency doesnt found '$currencyId'");

            if (!$country = $this->em->getRepository('AppBundle:Country')->find($countryId))
                die('Invalid country ' . $countryId);

            $sms = $this->em->getRepository(
                'AppBundle:SMS'
            )->findOneByAliasAndCountryAndSmsShortCodeAndOperatorShortName(
                'WOLO',
                $country->getId(),
                $shortNumber,
                $operatorShortName
            );

            if (!$sms) {
                $sms      = new SMS();
                $operator = $this->em->getRepository('AppBundle:SMSOperator')->findOneByShortNameAndCountry(
                    $operatorShortName,
                    $country->getId()
                );

                if (!$operator)
                    die('Invalid opeator ' . $operatorShortName . ", " . $country->getId());

                $providerId = 5; //nvia

                $pmpc = $this->em->getRepository(
                    'AppBundle:PayMethodProviderHasCountry'
                )->findOneByPayMethodNameAndProviderIdAndCountryId(
                    PayMethodEnum::SMS_NAME,
                    PayCategoryEnum::MOBILE_ID,
                    ArticleCategoryEnum::SINGLE_PAYMENT_ID,
                    $providerId,
                    $country->getId()
                );

                if (!$pmpc)
                    die(PayCategoryEnum::MOBILE_ID . ", " . ArticleCategoryEnum::SINGLE_PAYMENT_ID . ", $providerId, " . $country->getId(
                        ));

                $sms->setAliasDefault('WOLO')->setOperator($operator)->setLegalTextLabel(
                        $textLegal
                    )->setMobileTextSingUpLabel($textSingUp)->setPayMethodProviderHasCountry(
                        $pmpc
                    )->setSmsLogicCategory($mocategory)->setShortNumber($shortNumber);
                $created++;
            } else {
                $updated++;
            }

            if ($legalKeyCSV) {
                $keyLegalGenerated = 'sms.legal_text.' . $legalKeyCSV;

                if (!$textLegal = $transunit->findOneBy(['key' => $keyLegalGenerated])) {
                    $textLegal = new TransUnit();
                    $textLegal->setKey($keyLegalGenerated);
                    $textLegal->setDomain('sms');

                    $this->em->persist($textLegal);
                    $this->em->flush();
                }

                $sms->setLegalTextLabel($textLegal);
            }


            /** @var CurrencyService $currencyService */
            $currencyService = $this->container->get('common.currency');
            $sms->setAmount(
                $currencyService->getExchangeSimple($amount, $currencyId, $country->getCurrency()->getId())
            );

            $this->em->persist($sms);
            $this->em->flush();

        }

        return new Response("Created $created, Updated $updated");
    }
}
