<?php


namespace AppBundle\Payment\Util\ArticleExtraCost\ExtraCostsRules;


use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractExtraCostRule
{
    /** @var Logger */
    protected $logger;

    /** @var ContainerInterface */
    protected $container;

    /** @var EntityManagerInterface */
    protected $em;

    function __construct(ContainerInterface $containerInterface)
    {
        $this->container = $containerInterface;
        $this->logger = $containerInterface->get('logger');
        $this->em = $containerInterface->get('doctrine.orm.default_entity_manager');
    }

    /**
     * @param \AppBundle\Entity\AppShopHasArticle $appShopHasArticle
     * @param \AppBundle\Entity\Country $countryClient
     * @return mixed
     */
    abstract public function injectTempPrice(AppShopHasArticle $appShopHasArticle, Country $countryClient);

} 