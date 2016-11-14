<?php


namespace AppBundle\Payment\Util\ArticleExtraCost\ExtraCostsRules;


use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\Country;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ArticleExtraCostComposite extends AbstractExtraCostRule
{
    /** @var AbstractExtraCostRule[]|\SplObjectStorage */
    private $childs;

    public function __construct(ContainerInterface $containerInterface)
    {
        parent::__construct($containerInterface);

        $this->childs = new \SplObjectStorage();
    }

    /**
     * @param AbstractExtraCostRule $c
     * @return mixed
     */
    public function add(AbstractExtraCostRule $c)
    {
        $this->childs->attach($c);
    }

    /**
     * @param AbstractExtraCostRule $c
     * @return mixed
     */
    public function remove(AbstractExtraCostRule $c)
    {
        $this->childs->detach($c);
    }

    public function injectTempPrice(AppShopHasArticle $appShopHasArticle, Country $countryClient)
    {
        foreach ($this->childs as $child)
        {
            if ($child->injectTempPrice($appShopHasArticle, $countryClient))
            {
                $this->logger->addDebug('ExtraCost: '.get_class($child)." [APPLY]");
            }else{

                $this->logger->addDebug('ExtraCost: '.get_class($child).' [N/A]');
            }
        }
    }
}