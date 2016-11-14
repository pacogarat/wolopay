<?php


namespace AppBundle\Command;

use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CurrencyEnum;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @Service("command.currency_exchange")
 * @Tag("console.command")
 */
class CurrencyExchangeCommand extends Command
{
    /** @var EntityManager */
    private $em;

    /** @var Logger */
    private  $logger;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /*Check:https://dolartoday.com/ (https://cf51b142862dt8d03.wordssl.net/custom/rate.js )*/
    private $SKIP_CURRENCIES = ['VEF', 'UZS', 'SKK', 'CUC', 'EEK', 'GHC', 'TMM', 'ZWD'];

    /**
     * @InjectParams({
     *    "em" = @Inject("doctrine.orm.default_entity_manager"),
     *    "logger" = @Inject("logger")
     * })
     */
    function __construct($em, Logger $logger)
    {
        $this->em = $em;
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('currency:exchange:update')
            ->setDescription('Call yahoo api to get exchange')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Currency[] $currencies */
        $currencies = $this->em->getRepository("AppBundle:Currency")->findAll();

        foreach ($currencies as $currency)
        {
            try{

                if (in_array($currency->getId(), $this->SKIP_CURRENCIES) )
                    continue;

                $output->writeln("Trying to get exchange of currency: '<info>".$currency->getId()."</info>'");

                $euro = explode(',',
                    $this->getResponseFromUrl("http://download.finance.yahoo.com/d/quotes.csv?s=".$currency->getId()."EUR=X&f=sl1&e=.csv")
                );

                $dollar = explode(',',
                    $this->getResponseFromUrl("http://download.finance.yahoo.com/d/quotes.csv?s=".$currency->getId()."USD=X&f=sl1&e=.csv")
                );
                $gbp = explode(',',
                    $this->getResponseFromUrl("http://download.finance.yahoo.com/d/quotes.csv?s=".$currency->getId()."GBP=X&f=sl1&e=.csv")
                );

                if (count($euro)>1 && $euro[1] > 0)
                    $currency->setExchangeRateEur((float) $euro[1]);
                else
                    $this->errorInACurrency($currency, $euro, CurrencyEnum::EURO);

                if (count($dollar)>1 && $dollar[1] > 0)
                    $currency->setExchangeRateUsd((float) $dollar[1]);
                else
                    $this->errorInACurrency($currency, $dollar, CurrencyEnum::DOLLAR);

                if (count($gbp)>1 && $gbp[1] > 0)
                    $currency->setExchangeRateGbp((float) $gbp[1]);
                else
                    $this->errorInACurrency($currency, $gbp, CurrencyEnum::POUND_STERLING);

                $output->writeln("Values EUR: ".$currency->getExchangeRateEur().", USD: ".$currency->getExchangeRateUsd().", GBP: ".$currency->getExchangeRateGbp());

            }catch (\Exception $e){

                $this->em->detach($currency);
                $this->logger->addError("Some error ".$e->getMessage());
            }

            $this->em->flush();
        }

        $this->em->getCache()->evictEntity('AppBundle:Currency', 'currency_region');
    }

    private function  errorInACurrency (Currency $currency, $response, $currencyAsked)
    {
        // trying to make reverser engine
        $inverse = explode(',',
            $this->getResponseFromUrl("http://download.finance.yahoo.com/d/quotes.csv?s=$currencyAsked".$currency->getId()."=X&f=sl1&e=.csv")
        );

        $this->logger->addDebug("Trying inverse engine");

        if (count($inverse)>1 && $inverse[1] > 0)
        {
            $value = 1 / $inverse[1];

            switch ($currencyAsked)
            {
                case CurrencyEnum::EURO:
                    $currency->setExchangeRateEur($value);
                    return;
                    break;
                case CurrencyEnum::DOLLAR:
                    $currency->setExchangeRateUsd($value);
                    return;
                    break;
                case CurrencyEnum::POUND_STERLING:
                    $currency->setExchangeRateGbp($value);
                    return;
                    break;

            }
        }

        $this->logger->addError("error to parse currency ".$currency->getId()." ".$currency->getName().", response: ".
            implode(',', $response));

    }

    private function getResponseFromUrl($url)
    {
        $request = $this->guzzle->get($url);
        $response = $request->send();

        return $response->getBody(true);
    }

}
