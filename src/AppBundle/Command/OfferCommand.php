<?php

namespace AppBundle\Command;


use AppBundle\Entity\Offer;
use AppBundle\Entity\OfferProgrammer;
use AppBundle\Helper\UtilHelper;
use AppBundle\Payment\Event\PaymentCompletedEvent;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("command.shop.offer.sync")
 * @Tag("console.command")
 * @Tag("kernel.event_listener", attributes = {"event" = "shop.payment.completed"})
 */
class OfferCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    protected function configure()
    {
        $this
            ->setName('shop:offer:sync')
            ->setDescription('Synchronize table offer programmer with AppHasArticles')
            ->addArgument('offerProgrammerId', InputArgument::OPTIONAL, 'filter by offer programmer id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($programmerId = $input->getArgument('offerProgrammerId'))
        {
            if (!$offerProgrammer = $this->em->getRepository("AppBundle:OfferProgrammer")->findBy(['id'=>$programmerId, 'isActive'=>true]))
                throw new \Exception("Offer programmer doesn't found");

            $programmers = [$offerProgrammer];
        }else{
            $programmers = $this->em->getRepository("AppBundle:OfferProgrammer")->findBy(['isActive'=>true]);
        }

        $added = $removed = 0;

        foreach ($programmers as $programmer)
        {
            list($addedNow, $removedNow) = $this->reconfigureAllOffers($programmer->getId());
            $added+=$addedNow;
            $removed+=$removedNow;
        }

        $output->write("Offers added: $added \nOffers removed: $removed");
    }

    public function reconfigureAllOfferProgrammersRelatedByArticleId($articleId)
    {
        $offerProgrammers = $this->em->getRepository("AppBundle:OfferProgrammer")->findByArticles($articleId);

        foreach ($offerProgrammers as $programmer)
            $this->reconfigureAllOffers($programmer->getId());

        $this->em->flush();

        return $offerProgrammers ;
    }

    /**
     * @param OfferProgrammer[] $offerProgrammers
     */
    public function reconfigureAllOffersByOfferProgrammers($offerProgrammers)
    {
        foreach ($offerProgrammers as $programmer)
            $this->reconfigureAllOffers($programmer->getId());

        $this->em->flush();
    }

    public function reconfigureAllOffers($programmerId)
    {
        $removed = $this->removeAllOffers($programmerId);
        $added   = $this->addOffers($programmerId);

        return [$added, $removed];
    }

    public function removeAllOffers($programmerId)
    {
        $offerRemoved=0;

        $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByOfferProgrammerId($programmerId);

        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            $this->em->remove($appShopHasArticle->getOffer());
            $appShopHasArticle->setOffer(null);

            $offerRemoved++;
        }

        $this->em->flush();

        return $offerRemoved;
    }

    public function programmerExceedLimitPurchases(OfferProgrammer $offerProgrammer)
    {
        if ($offerProgrammer->getLimitPurchases() && $offerProgrammer->getLimitPurchases() <= $offerProgrammer->getTimesUsed())
            return true;

        return false;
    }

    protected function isValidOfferDates(\DateTime $offerFrom=null, \DateTime $offerTo=null, $timeZone = null)
    {
        $now = new \DateTime('now');
        if ($timeZone)
        {
            $local = new \DateTime('now', new \DateTimeZone($timeZone));
            $now->add(\DateInterval::createFromDateString($local->getOffset(). ' seconds'));
        }

        if ($offerFrom != null &&  $offerFrom->getTimestamp() > $now->getTimestamp())
        {
            return false;
        }

        if ($offerTo != null && $offerTo->getTimestamp() <= $now->getTimestamp())
        {
            return false;
        }

        return true;
    }

    private function addOffers($programmerId)
    {
        $offerAdded=0;
        $offerProgrammer = $this->em->getRepository("AppBundle:OfferProgrammer")->find($programmerId);

        if (!$offerProgrammer->getIsActive())
            return $offerAdded;

        if ($this->programmerExceedLimitPurchases($offerProgrammer))
            return $offerAdded;

        if (!$offerProgrammer->getLocalTime() &&
            $this->isValidOfferDates($offerProgrammer->getOfferFrom(), $offerProgrammer->getOfferTo()) == FALSE)
        {
            return $offerAdded;
        }

        $appShopHasArticles = $this->em->getRepository("AppBundle:AppShopHasArticle")->findByArticlesIdsAndAppShopIdsAndCountriesIds(
            UtilHelper::getIdsArrayFromObjects($offerProgrammer->getArticles()),
            UtilHelper::getIdsArrayFromObjects($offerProgrammer->getAppShops()),
            UtilHelper::getIdsArrayFromObjects($offerProgrammer->getCountries())
        );

        foreach ($appShopHasArticles as $appShopHasArticle)
        {
            if ($offerProgrammer->getLocalTime())
            {
                if ($this->isValidOfferDates($offerProgrammer->getOfferFrom(), $offerProgrammer->getOfferTo(), $appShopHasArticle->getCountry()->getTimeZone()) == false)
                    continue;
            }

            $amount = $appShopHasArticle->getCurrentAmount() - ($appShopHasArticle->getCurrentAmount() * $offerProgrammer->getAmountPercentDiscount() /100);

            if ($offerProgrammer->getPrettyPrice())
            {
                $amount = UtilHelper::prettyPrice(
                    $amount,
                    $appShopHasArticle->getCountry()->getCurrency()->getDecimalPlaces(),
                    $appShopHasArticle->getCountry()->getDecimalFormat()
                );
            }

            $number = round($appShopHasArticle->getCurrentItemsQuantity() + ($appShopHasArticle->getCurrentItemsQuantity() * $offerProgrammer->getQuantityExtraPercent() /100));

            $offer = new Offer();
            $offer
                ->setAmount($amount)
                ->setItemsQuantity($number)
                ->setAppShopHasArticle($appShopHasArticle)
                ->setNameLabel($offerProgrammer->getNameLabel())
                ->setDescriptionLabel($offerProgrammer->getDescriptionLabel())
                ->setDescriptionShortLabel($offerProgrammer->getDescriptionShortLabel())
                ->setImage($offerProgrammer->getOfferImg())
                ->setOfferProgrammer($offerProgrammer)
            ;

            $this->em->persist($appShopHasArticle);
            $this->em->persist($offer);
            $offerAdded++;

        }

        $this->em->flush();

        return $offerAdded;
    }

    public function onShopPaymentCompleted(PaymentCompletedEvent $paymentCompletedEvent)
    {
        if ($paymentCompletedEvent->getPurchase()->getTest())
            return;

        $paymentDetailHasArticles = $paymentCompletedEvent->getPaymentProcess()->getPaymentDetail()->getPaymentDetailHasArticles();
        foreach ($paymentDetailHasArticles as $paymentDetailHasArticle)
        {
            $offerProgrammer = $paymentDetailHasArticle->getOfferProgrammer();

            if ($offerProgrammer)
            {
                $offerProgrammer->addTimesUsed();
                if ($this->programmerExceedLimitPurchases($offerProgrammer))
                    $this->reconfigureAllOffers($offerProgrammer->getId());
            }

        }

        $this->em->flush();

    }
} 