<?php


namespace AppBundle\Command;

use AppBundle\Entity\Purchase;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Payment\Event\PurchaseExtraCostEvent;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Service("shop_app.business_intelligent_resend")
 * @Tag("console.command")
 */
class BusinessIntelligentResendExtraCostCommand extends BusinessIntelligentCommand
{
    protected function configure()
    {
        $this
            ->setName('shop:business_intelligent:sync_extra_cost')
            ->setDescription('Send msg to business Intelligent')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $purchases = $this->em->getRepository("AppBundle:Purchase")->findExtraCosts();

        foreach ($purchases as $purchase)
        {
            if ($purchase->getAmountTotal() == -7.5)
            {
                $output->writeln($this->onShopPurchaseExtraCost(new PurchaseExtraCostEvent($purchase)));

            }else{
                $output->writeln(
                    $this->onShopPaymentCancelled(
                        new PaymentCancelledEvent(
                            $purchase->getExtraCostFromParent()->getPayment(),
                            null,
                            true,
                            'Refund',
                            true,
                            $purchase
                        )
                    )
                );
            }
        }
    }

} 