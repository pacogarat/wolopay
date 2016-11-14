<?php


namespace AppBundle\Service;

use AppBundle\Command\OfferCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\AppShop;
use AppBundle\Entity\Article;
use AppBundle\Entity\Country;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Helper\UtilHelper;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Monolog\Logger;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;


/**
 * @Service("shop_app.offer")
 */
class OfferService
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
     * @var OfferCommand
     * @Inject("command.shop.offer.sync")
     */
    public $offerCommand;

    /** @Inject("%kernel.environment%")   */
    public $env;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    /**
     * @param \AppBundle\Entity\OfferProgrammer $offerProgrammer
     * @param App $app
     * @param $name
     * @param AppShop[] $appShops
     * @param Country[] $countries
     * @param Article[] $articles
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param $timeIsLocal
     * @param $amountExtra
     * @param $numberExtra
     * @param $limitPurchases
     * @param $limitPerUser
     * @param $prettyPrice
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $nameLabel
     * @param \Lexik\Bundle\TranslationBundle\Entity\TransUnit $descriptionLabel
     * @param \Application\Sonata\MediaBundle\Entity\Media $img
     * @param bool $autoLoad
     * @throws \Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException
     * @throws \Exception
     * @return OfferProgrammer
     */
    public function createOrUpdate(OfferProgrammer $offerProgrammer =null, App $app, $name, array $appShops, array $countries, array $articles, array $articlesExtra, \DateTime $dateFrom,
        \DateTime $dateTo, $timeIsLocal, $amountExtra, $numberExtra, $limitPurchases, $limitPerUser, $prettyPrice, $offset= null,
        TransUnit $nameLabel = null, TransUnit $descriptionLabel = null, Media $img = null, $autoLoad = true
    )
    {
        // validations
        foreach ($appShops as $shop)
        {
            if($shop->getApp()->getId() != $app->getId())
                throw new \Exception("The shop:".$shop->getId()." is incorrect because it does not belong to the application");
        }

        foreach (array_merge($articles, $articlesExtra) as $article)
        {
            if($article->getApp()->getId() != $app->getId())
                throw new \Exception("The article:".$article->getId()." is incorrect because it does not belong to the application");
        }

        $values = $this->em->getRepository("AppBundle:OfferProgrammer")->findIfExistOtherOfferInSamePeriod(
            UtilHelper::getIdsArrayFromObjects($articles),
            UtilHelper::getIdsArrayFromObjects($appShops),
            UtilHelper::getIdsArrayFromObjects($countries),
            $dateFrom,
            $dateTo,
            $offerProgrammer
        );

        if ($values)
            throw new UnprocessableEntityHttpException("Because some articles have different offer at the same time");

        if (!$offerProgrammer)
            $offerProgrammer = new OfferProgrammer();

        $offerProgrammer
            ->setApp($app)
            ->setAppShops($appShops)
            ->setArticles($articles)
            ->setArticlesExtra($articlesExtra)
            ->setCountries($countries)
            ->setName($name)
            ->setNameLabel($nameLabel)
            ->setDescriptionLabel($descriptionLabel)
            ->setOfferFrom($dateFrom)
            ->setOfferTo($dateTo)
            ->setOfferImg($img)
            ->setQuantityExtraPercent($numberExtra)
            ->setAmountPercentDiscount($amountExtra)
            ->setLocalTime($timeIsLocal)
            ->setLimitPerUser($limitPerUser)
            ->setLimitPurchases($limitPurchases)
            ->setPrettyPrice($prettyPrice)
        ;

        if ($offerProgrammer->getLocalTime())
        {
            $dateFrom->add(\DateInterval::createFromDateString($offset. ' seconds'));
            $dateTo->add(\DateInterval::createFromDateString($offset. ' seconds'));

            $offerProgrammer->setOffset($offset);
        }else{
            $offerProgrammer->setOffset(null);
        }

        $this->em->persist($offerProgrammer);
        $this->em->flush();

        if ($autoLoad)
            $this->offerCommand->reconfigureAllOffers($offerProgrammer->getId());

        return $offerProgrammer;
    }

    public function delete(OfferProgrammer $programmer)
    {
        $this->offerCommand->removeAllOffers($programmer->getId());
        $programmer->setIsActive(false);
        
        //$this->em->remove($programmer);
        $this->em->flush();
    }

} 