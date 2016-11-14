<?php


namespace AppBundle\Service;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Exception\NviaShowCustomResponseErrorException;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("common.ip_info")
 */
class IPInfoService
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /** @var  Logger */
    private $logger;

    static $ipsRequested=[];

    /**
     * @InjectParams({
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "templating" = @Inject("templating")
     * })
     */
    function __construct(EntityManager $em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * @param $ip
     * @throws \AppBundle\Exception\NviaShowCustomResponseErrorException
     * @return \AppBundle\Entity\Country|null
     */
    public function getCountryFromIp($ip)
    {
        try{

            // to work in local ...
            if ($ip === '127.0.0.1')
                return $this->em->getRepository("AppBundle:Country")->find(CountryEnum::SPAIN);

            if (($xml = $this->getInfoExternal($ip)) && $xml->ISO_COUNTRY)
            {
                $iso = (string) ($xml->ISO_COUNTRY == 'EU' ? CountryEnum::OTHER_EUROPE : $xml->ISO_COUNTRY);

                if (!$country = $this->em->getRepository("AppBundle:Country")->find($iso))
                {
                    if ($iso)
                        $this->logger->addError("Country $iso Need to be inserted in DB");
                }

                return $country;
            }

            return null;


        }catch (NviaShowCustomResponseErrorException $e){
            throw $e;
        }catch (\Exception $e){

            $this->logger->addWarning("Error http://ad.adschemist.com/capability?ip=$ip, error: ".$e->getMessage());

            return null;
        }

    }


    private function getInfoExternal($ip)
    {
        if (array_key_exists($ip, self::$ipsRequested) && self::$ipsRequested[$ip])
            return self::$ipsRequested[$ip];

        // improve with timeout in a future?
        self::$ipsRequested[$ip] = simplexml_load_file("http://ad.adschemist.com/capability?ip=" . $ip);

        return self::$ipsRequested[$ip];
    }

} 