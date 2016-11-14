<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


use AppBundle\Entity\Enum\CountryEnum;

class PurchaseTest extends AbstractWolopaySDK
{

    public function setUp()
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    /**
     * @group E2E
     */
    public function testSimpleOK()
    {
        $wolopayApi = $this->getApiWolopayObjectDemo();

        $article = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($this->getApp())[0];

        $purchase = $wolopayApi->makePurchaseWithVirtualCurrencies($gamerId='user13', $level=3, $article->getId(), CountryEnum::SPAIN);

        if (!$purchase->id){
            throw new \Exception("Error result are incorrect");
        }

    }

} 