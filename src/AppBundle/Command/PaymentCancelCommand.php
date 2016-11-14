<?php


namespace AppBundle\Command;

use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Payment;
use AppBundle\Entity\SubscriptionEventualityPayment;
use AppBundle\Payment\Actions\PaymentCancelled;
use AppBundle\Payment\Actions\SubscriptionCancelled;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;


/**
 * @Service("command.payment_cancel")
 * @Tag("console.command")
 */
class PaymentCancelCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @Inject("shop.payment.cancelled")
     * @var PaymentCancelled
     */
    public $paymentCancelled;

    /**
     * @Inject("shop.subscription.canceled")
     * @var SubscriptionCancelled
     */
    public $subscriptionCancelled;

    protected function configure()
    {
        $this
            ->setName('app:payment:cancel')
            ->setDescription('Cancel payment')
            ->addArgument('payment_id')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!$payment = $this->em->getRepository("AppBundle:Payment")->find($input->getArgument('payment_id')))
            throw new BadRequestHttpException("payment is invalid");

        $this->cancelPayment($payment);
    }

    public function cancelPayment(Payment $payment)
    {
        $this->paymentCancelled->execute($payment);

        if ($payment instanceof SubscriptionEventualityPayment)
            $this->subscriptionCancelled->execute($payment->getSubscriptionEventuality()->getSubscription());
    }

}
