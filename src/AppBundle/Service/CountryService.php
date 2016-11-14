<?php


namespace AppBundle\Service;

use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;


/**
 * @Service("country")
 */
class CountryService
{
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;

    /**
     * @InjectParams({
     *    "em" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    function __construct(EntityManager $em)
    {
        $this->em     = $em;
    }

    public function getPriceCostOfLifeSimple($amount, $countryIdAmount, $countryIdWanted)
    {
        if (!$amountCountry = $this->em->getRepository("AppBundle:Country")->find($countryIdAmount))
            throw new \Exception("invalid id country $countryIdAmount");

        $result = $this->getPriceCostOfLife($amount, $amountCountry, $countryIdWanted);

        return $result;
    }

    public function getPriceCostOfLife($amount, Country $amountCountry, $countryIdWanted)
    {
        if ($amountCountry->getId() === $countryIdWanted)
            return $amount;

        $countryWanted = $this->em->getRepository("AppBundle:Country")->find($countryIdWanted);

        return $amount * $countryWanted->getCostOfLiving() / $amountCountry->getCostOfLiving();
    }

    /**
     * @param Transaction $transaction
     * @return \AppBundle\Entity\Country[]
     */
    public function getCountriesClientAvailableByTransaction(Transaction $transaction)
    {
        $countries = $transaction->getApp()->getCountries();

        if (!$transaction->getCountriesAvailable()->isEmpty())
            $countries = $transaction->getCountriesAvailable();

        $countries = $this->getCountriesClientFromConfiguredCountries($countries, $transaction->getApp());

        return $this->em->getRepository("AppBundle:Country")->findByAppIdAndLevelCategoryAndArticlesStatusInCountriesAvailable(
            false,
            $transaction->getApp()->getId(),
            [$transaction->getLevelCategory()->getId()],
            $countries,
            $transaction->getArticlesAvailable()->toArray(),
            $transaction->getPayMethodsAvailable()->toArray(),
            true,
            false,
            $transaction->getExternalStore()
        );
    }

    /**
     * @param \AppBundle\Entity\Country[] $countries
     * @return \AppBundle\Entity\Country[]
     */
    private function getCountriesClientFromConfiguredCountries($countries)
    {
        $continentsIds = [];
        $countriesIds = [];
        $all = false;

        foreach ($countries as $c)
        {
            if ($c->getId() == CountryEnum::OTHER)
            {
                $all = true;
                break;
            }

            if (in_array($c->getId(), CountryEnum::$OTHERS_ALL))
                $continentsIds []= $c->getContinent();
            else
                $countriesIds []= $c->getId();
        }

        if ($all)
            $countries = $this->em->getRepository("AppBundle:Country")->findAllStandard();
        else
            $countries = $this->em->getRepository("AppBundle:Country")->findStandardsByCountriesOrContinents($countriesIds, $continentsIds);

        return $countries;
    }

    /**
     * @param Transaction $transaction
     * @param Country $country
     * @return Country
     */
    public function getCountryConfiguredAndCloserFromTransaction(Transaction $transaction, Country $country = null)
    {
        $countries = $this->em->getRepository("AppBundle:Country")->findByAppIdAndLevelCategoryAndArticlesStatusInCountriesAvailable(
            true,
            $transaction->getApp()->getId(),
            [$transaction->getLevelCategory()->getId()],
            $transaction->getCountriesAvailable()->toArray(),
            $transaction->getArticlesAvailable()->toArray(),
            $transaction->getPayMethodsAvailable()->toArray(),
            true,
            false,
            $transaction->getExternalStore()
        );

        return $this->getCountryCloserFromCountries($countries, $country);
    }

    public function getCountryConfiguredAndCloserFromApp(App $app, array $levelCategories, Country $country = null)
    {
        $countries = $this->em->getRepository("AppBundle:Country")->findByAppIdAndLevelCategoryAndArticlesStatusInCountriesAvailable(
            true,
            $app->getId(),
            $levelCategories
        );

        return $this->getCountryCloserFromCountries($countries, $country);
    }

    /**
     * @param Country[] $countries
     * @param Country $country
     * @return Country|null
     */
    public function getCountryCloserFromCountries($countries, $country)
    {
        /**
         * @param $id
         * @return Country|null
         */
        $hasCountry =  function ($id) use ($countries)
        {
            foreach ($countries as $country)
            {
                if ($country->getId() == $id)
                    return $country;
            }
            return false;
        };

        if($country)
        {
            if ($countryR = $hasCountry($country->getId()))
                return $countryR;

            $otherId = CountryEnum::getOtherIdFromCountry($country);

            if ($otherId && $countryR = $hasCountry($otherId))
                return $countryR;
        }

        if ($countryR = $hasCountry(CountryEnum::OTHER))
            return $countryR;

        return null;
    }


} 