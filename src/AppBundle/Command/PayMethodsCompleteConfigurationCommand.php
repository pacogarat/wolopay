<?php

namespace AppBundle\Command;


use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Form\Type\PayMethodCompleteConfigurationType;
use AppBundle\Form\Type\PayMethodProviderHasCountryCompleteConfigurationType;
use AppBundle\Service\AppShopHasArticleService;
use AppBundle\Traits\ConsoleLog;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Matthias\SymfonyConsoleForm\Console\Formatter\Format;
use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use Monolog\Logger;
use Sensio\Bundle\GeneratorBundle\Command\Helper\QuestionHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("command.paymethods_complete_configuration")
 * @Tag("console.command")
 */
class PayMethodsCompleteConfigurationCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("app_shop_has_article")
     * @var AppShopHasArticleService
     */
    public $appShopHasArticleService;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    use ConsoleLog;

    protected function configure()
    {
        $this
            ->setName('paymethods:configure:pay_method_has_provider')
            ->setDescription('Configure payMethods recent inserted')
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
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');
        $question = new ConfirmationQuestion(Format::forQuestion('Add Other PMPC:', false));

        /** @var $formHelper FormHelper $formHelper */
        $formHelper = $this->getHelper('form');
        /** @var PayMethodHasProvider $pmp */
        $pmp = $formHelper->interactUsingForm(new PayMethodCompleteConfigurationType(), $input, $output);
        $options = ['provider_id' => $pmp->getProvider()->getId()];

        do{
            $pmpc = $formHelper->interactUsingForm(new PayMethodProviderHasCountryCompleteConfigurationType(), $input, $output, $options);
            $pmp->addPayMethodProviderHasCountry($pmpc);
            $this->em->persist($pmpc);

        }while ($questionHelper->ask($input, $output, $question));

        $this->em->persist($pmp);

        $this->em->flush();

    }

} 