<?php

namespace AppBundle\Command;


use AppBundle\Entity\App;
use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\AppShopArticleHasPMPC;
use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Service\AppShopHasArticleService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Service("command.app_paymethods_add")
 * @Tag("console.command")
 */
class PayMethodsAppAddCommand extends Command
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

    protected function configure()
    {
        $this
            ->setName('app:paymethods:add')
            ->setDescription('Add PayMethodHasProvidersHasCountry to App ...')
            ->addArgument('appId', InputArgument::REQUIRED, 'Id of the App')
            ->addArgument('providerName', InputArgument::REQUIRED, 'Name of the payment provider')
            ->addArgument('countryId',  InputArgument::OPTIONAL, 'Country to add paymethods in')
            ->addArgument('debug',  InputArgument::OPTIONAL, 'set 1 to output info about insertions',0)
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
        $providerName = $input->getArgument('providerName');
        $provider = $this->em->getRepository("AppBundle:Provider")->findOneBy(["name"=>$providerName, "active"=>true]);
        $appId = $input->getArgument('appId');
        $countryId = $input->getArgument("countryId");
        if(!($app = $this->em->getRepository("AppBundle:App")->find($appId))){
            $output->writeln("End of process. App does not exist");
            return;
        }

        if (!$app->getActive()) {
            $output->writeln("End of process. App not active");
            return;
        }

        $output->writeln("Config: AppId=$appId; ProviderName=$providerName;countryId="
            . $input->getArgument("countryId") . ";debug=" . $input->getArgument('debug'));


        /** @var PayMethodHasProvider[] $pmps */
        $pmps=$this->em->getRepository("AppBundle:PayMethodHasProvider")->findByProviderId($provider->getId());

        $added=0;

        $countBefore = $this->em->getRepository("AppBundle:AppShopArticleHasPMPC")->countByApp($app->getId());
        $app->getCountries();
        foreach ($pmps as $pmp)
        {
//            /** @var \Doctrine\Common\Collections\ArrayCollection $countries */
//            $countries=$data['countries'];

            // refresh to clear
            $pmp = $this->em->getRepository("AppBundle:PayMethodHasProvider")->find($pmp->getId());
            $app = $this->em->getRepository("AppBundle:App")->find($app->getId());
            $articles = [];
            // end refresh

            foreach ($app->getCountries() as $pmpcCountry)
            {
                $pmpc= $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
                    $pmp->getPayMethod()->getId(), $pmp->getProvider()->getId(), $pmpcCountry->getId()
                );

                if (!$pmpc)
                    continue;

                if ($countryId && ($pmpcCountry->getId()!==$countryId))
                    continue;

                $exist = $app->hasPayMethodProviderCountry($pmpc);
                if (!$exist ){
                    $added++;
                    $app->addAppHasPayMethodProviderCountry(new AppHasPayMethodProviderCountry($pmpc, $app));
                }
            }


            $this->em->flush();
            $this->em->clear();
            gc_collect_cycles();

        }

        $articleService = $this->appShopHasArticleService;

        $articleService->syncAllAppShopHasArticlesWithAppTabIfEnabled($app);

        $countAfter = $this->em->getRepository("AppBundle:AppShopArticleHasPMPC")->countByApp($app->getId());

        $output->writeln("End of process. $countBefore PMPC before. $countAfter PMPC after ");
    }

    private function writeCLI($msg, OutputInterface $output=null)
    {
        if ($output)
            $output->writeln($msg);
    }




} 