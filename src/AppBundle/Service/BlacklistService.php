<?php
/**
 * Created by MGDSoftware. 28/08/2015
 */

namespace AppBundle\Service;
use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Transaction;
use AppBundle\Helper\UtilHelper;
use AppBundle\Traits\StopWatchTrait;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Service("app.blacklist")
 */
class BlacklistService {
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /** @var Logger */
    private $logger;

    /** @var IPInfoService */
    private $ipInfoService;

    private $isProduction;
    protected $container;

    use StopWatchTrait;

    /**
     * @InjectParams({
     *    "isProduction" = @Inject("%is_production%"),
     *    "ipInfoService" = @Inject("common.ip_info"),
     *    "logger" = @Inject("logger"),
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "container" = @Inject("service_container"),
     * })
     */
    function __construct(EntityManager $em, Logger $logger, IPInfoService $ipInfoService, $isProduction, ContainerInterface $container)
    {
        $this->em     = $em;
        $this->logger = $logger;
        $this->ipInfoService = $ipInfoService;
        $this->isProduction = $isProduction;
        $this->container = $container;
    }

    /**
     * @param Transaction $transaction
     * @param Request $request
     * @param string $iip
     * @return TransactionStatusCategoryEnum
     */
    public  function isForbiddenByBlackLists(Transaction $transaction, Request $request=null, $iip=null)
    {
        $ip = $country = null;
        if ($iip) $ip=$iip;

        $this->stopWatchStart(['InfoService']);

        if ($request)
            $ip = $request->getClientIp();

        if ($transaction->getCountryDetected())
            $country = $transaction->getCountryDetected();
        elseif ($ip)
            $country = $this->ipInfoService->getCountryFromIp($ip);

        if ($country && $country->getId() === CountryEnum::PROXY)
            return TransactionStatusCategoryEnum::BLACKLISTED_COUNTRY;

        $this->stopWatchStop(['InfoService']);

        $app = $transaction->getApp();
        $gamer = $transaction->getGamer();

        $this->stopWatchStart(['blacklist ALL', 'blacklist by country']);

        if ($country && $this->isCountryBlacklistedForApp($country, $app))
            return TransactionStatusCategoryEnum::BLACKLISTED_COUNTRY;

        $this->stopWatchStop('blacklist by country');
        $this->stopWatchStart('blacklist by gamer');

        if ($gamer && $this->isGamerForbiddenForApp($gamer, $app))
            return TransactionStatusCategoryEnum::BLACKLISTED_GAMER;

        $this->stopWatchStop('blacklist by gamer');
        $this->stopWatchStart('blacklist by ip');

        if ($ip && $this->isIPBlacklistedForApp($ip, $app))
            return TransactionStatusCategoryEnum::BLACKLISTED_IP;

        $this->stopWatchStop(['blacklist by ip', 'blacklist ALL']);

        return false;
    }



    public function isCountryBlacklistedForApp(Country $country, App $app){
        if ($this->isProduction && $country->getId()=='XZ') return true;

        return $app->hasBlacklistedCountry($country->getId());
    }

    public function isGamerForbiddenForApp(Gamer $gamer, App $app){
        return $app->hasBlacklistedGamer($gamer->getId());
    }

    public function isIPBlacklistedForApp($ip, App $app)
    {
        if (!$app->getBlacklistedIPs())
            return false;

        $bl = $app->hasBlacklistedIP($ip) ;

        if ($bl) {
            return true;
        }
        else
        {
            foreach ($app->getBlacklistedRanges() as $range => $values){
                if (UtilHelper::ipv4_in_range($ip,$range)){
                    return true;
                }
            }
        }
        return false;
    }
}