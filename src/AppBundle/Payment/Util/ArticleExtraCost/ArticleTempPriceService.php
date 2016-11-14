<?php


namespace AppBundle\Payment\Util\ArticleExtraCost;

use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Country;
use AppBundle\Payment\Util\ArticleExtraCost\ExtraCostsRules\ArticleExtraCostByVatRule;
use AppBundle\Payment\Util\ArticleExtraCost\ExtraCostsRules\ArticleExtraCostComposite;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Service("app.article_temp_price")
 */
class ArticleTempPriceService
{
    /**
     * @var ContainerInterface
     * @Inject("service_container")
     */
    public $container;

    /**
     * @param AppShopHasArticle[] $appShopHasArticles
     * @param Country $countryClient
     */
    public function injectTempPrices($appShopHasArticles, Country $countryClient)
    {
        foreach ($appShopHasArticles as $appShopHasArticle)
            $this->injectTempPrice($appShopHasArticle, $countryClient);
    }

    public function injectTempPrice(AppShopHasArticle $appShopHasArticle, Country $countryClient)
    {
        $appShopHasArticle->clearTempForcePrices();

        $composite = new ArticleExtraCostComposite($this->container);

        // empty for now :S

        $composite->injectTempPrice($appShopHasArticle, $countryClient);
    }

} 