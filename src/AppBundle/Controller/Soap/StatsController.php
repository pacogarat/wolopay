<?php

namespace AppBundle\Controller\Soap;



use AppBundle\Entity\App;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Helper\StatsHelper;
use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Soap\Header("apiUser", phpType = "string")
 * @Soap\Header("apiSecret", phpType = "string")
 */
class StatsController
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var App
     */
    private $app;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @Soap\Method("purchases")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Param("dateFormat", phpType = "string")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function purchasesAction(\DateTime $dateFrom, \DateTime $dateTo, $dateFormat)
    {
        $this->validateDateFormat($dateFormat);
        return $this->em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByMonths($this->app, $dateFrom, $dateTo, false, $dateFormat);
    }

    /**
     * @Soap\Method("purchasesByCountry")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Param("dateFormat", phpType = "string")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function purchasesByCountryAction(\DateTime $dateFrom, \DateTime $dateTo, $dateFormat)
    {
        $this->validateDateFormat($dateFormat);
        return StatsHelper::sumAllGroupSubArray(
            $this->em->getRepository("AppBundle:Purchase")->statsByAppIdAndDateRangeAndGroupByCountry([$this->app], $dateFrom, $dateTo, CurrencyEnum::EURO, $dateFormat)
        );
    }

    /**
     * @Soap\Method("transactions")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Param("dateFormat", phpType = "string")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function transactionsAction(\DateTime $dateFrom, \DateTime $dateTo, $dateFormat)
    {
        $this->validateDateFormat($dateFormat);
        return $this->em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonths($this->app, $dateFrom, $dateTo, $dateFormat);
    }

    /**
     * @Soap\Method("uniqueUsers")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Param("dateFormat", phpType = "string")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function uniqueUsersAction(\DateTime $dateFrom, \DateTime $dateTo, $dateFormat)
    {
        $this->validateDateFormat($dateFormat);
        return $this->em->getRepository("AppBundle:Transaction")->statsByAppIdAndDateRangeAndGroupByMonthsAndGamer($this->app, $dateFrom, $dateTo, $dateFormat);
    }

    /**
     * @Soap\Method("providers")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function providersAction(\DateTime $dateFrom, \DateTime $dateTo)
    {
        return
            StatsHelper::takeFirstItemAsKeyAndSecondItemAsValue(
                $this->em->getRepository("AppBundle:Purchase")->statsPieByAppIdAndDateRangeAndGroupByPayMethodAndPayCategory($this->app, $dateFrom, $dateTo)
        );
    }

    /**
     * @Soap\Method("articles")
     * @Soap\Param("dateFrom", phpType = "dateTime")
     * @Soap\Param("dateTo", phpType = "dateTime")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Float[]")
     * @throws \BeSimple\SoapServer\Exception\ReceiverSoapFault
     */
    public function articlesAction(\DateTime $dateFrom, \DateTime $dateTo)
    {
        return
            StatsHelper::takeFirstItemAsKeyAndSecondItemAsValue(
                $this->em->getRepository("AppBundle:Purchase")->statsPieByAppIdAndDateRangeAndGroupByArticles($this->app, $dateFrom, $dateTo)
            );
    }

    /**
     * @param $dateFormat
     * @throws \SoapFault
     * @return bool
     */
    private function validateDateFormat($dateFormat)
    {
        if (!in_array($dateFormat, ['days', 'months', 'weeks']))
            throw new \SoapFault('INVALID_DATE_FORMAT', 'Invalid date Format (days|months|weeks)');

        return true;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        parent::setContainer($container);
        $this->checkApiKeyHeader();

    }

    private function checkApiKeyHeader()
    {
        /** @var \BeSimple\SoapBundle\Util\Collection $soapHeaders */
        $soapHeaders = $this->container->get('request')->getSoapHeaders();

        if (!$soapHeaders->has('apiUser') || !$soapHeaders->has('apiSecret'))
            throw new \SoapFault("INVALID_API_KEY", "The apiUser/apiSecret is invalid.");

        $apiUser = $soapHeaders->get('apiUser')->getData();
        $apiSecret = $soapHeaders->get('apiSecret')->getData();

        if ($apiUser == 'demo' && $apiSecret == 'demo')
        {
            $this->app = $this->em->getRepository("AppBundle:App")->findOneBy(['name' => 'Demo']);
            return;
        }

        $credentials = $this->em->getRepository("AppBundle:AppApiCredentials")->findByCodeKeyAndSecretKey(
            $soapHeaders->get('apiUser')->getData(),
            $soapHeaders->get('apiSecret')->getData()
        );

        if (!$credentials)
            throw new \SoapFault("INVALID_API_KEY", "The apiUser/apiSecret is invalid.");

        $this->app = $credentials->getApp();
    }

}
