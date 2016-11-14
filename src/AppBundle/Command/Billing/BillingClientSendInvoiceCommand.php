<?php


namespace AppBundle\Command\Billing;

use AppBundle\Entity\FinInvoice;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\EmailService;
use AppBundle\Traits\ConsoleLog;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * @Service("app.billing.client.send_invoice_command")
 * @Tag("console.command")
 */
class BillingClientSendInvoiceCommand extends Command
{
    use ConsoleLog;

    /**
     * @Inject("common.currency")
     * @var CurrencyService
     */
    public $currencyService;

    /**
     * @Inject("app.emails")
     * @var EmailService
     */
    public $emailService;

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


    protected function configure()
    {
        $this
            ->setName('billing:client:send_invoice_to_client')
            ->setDescription('Send invoice to client')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outPut is declared in Trait
        $this->output = $output;

        $this->sendEmails();
        $this->removeDeclined();

        $this->em->flush();

    }

    protected function sendEmails()
    {
        $findInvoices = $this->em->getRepository("AppBundle:FinInvoice")->findRemainingForward();

        $code = '';

        $invoices = [];
        $documents = [];

        $sendEmail = function ($invoices, $documents) {

            if (!$invoices)
                return;

            $this->emailService->sendClientAfterApproval($invoices, $documents, '');

            /** @var FinInvoice[] $invoices */
            foreach ($invoices as $invoice)
            {
                $invoice
                    ->setForwardedForClientToAt(new \DateTime())
                    ->setRequireApproval(false)
                ;
            }

            $this->addInfo("Invoinces send to: ".$invoices[0]->getExternalCompanyNotWolopay()->getNameCompany().", date Reference: ".$invoices[0]->getReferenceDate()->format('m Y'));
        };

        foreach ($findInvoices as $invoice)
        {
            try{
                $currentCode = $invoice->getReferenceDate()->format('m-Y').$invoice->getExternalCompanyNotWolopay()->getId();
                if ($code !== $currentCode)
                {
                    $sendEmail($invoices, $documents);

                    $invoices  = [];
                    $documents = [];
                    $code      = $currentCode;
                }

                $invoices []= $invoice;

                foreach ($invoice->getClientDocuments() as $document)
                    $documents []= $document;

            }catch (\Exception $e){
                $this->addError($e->getMessage());
            }
        }

        $sendEmail($invoices, $documents);
    }

    protected function removeDeclined()
    {
        $declines = $this->em->getRepository("AppBundle:FinInvoice")->findDeclined(new \DateTime('+1 day'));

        foreach ($declines as $declined)
        {
            $this->em->remove($declined);
        }
    }


}
