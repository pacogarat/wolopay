<?php

namespace AppBundle\Command;


use AppBundle\Entity\App;
use AppBundle\Util\WSSEUtil;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @Service("api.command.wsse")
 * @Tag("console.command")
 */
class WSSECommand extends Command
{
    private $em;

    /**
     * @InjectParams({
     *      "em" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em                  = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('api:wsse:create')
            ->setDescription('Create header WSSE')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var App $demo */
        $demo = $this->em->getRepository("AppBundle:App")->findOneBy(['name'=>'demo']);
        $wsse = WSSEUtil::generateHeaderWSSE($demo->getAppApiHasCredential()->getCodeKey(), $demo->getAppApiHasCredential()->getSecretKey());
        $output->writeln("X-WSSE: $wsse");
    }
} 