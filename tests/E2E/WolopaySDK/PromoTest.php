<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


use AppBundle\Entity\Enum\ArticleCategoryEnum;

class PromoTest extends AbstractWolopaySDK
{

    public function setUp($env='test')
    {
        parent::setUp('test_dev');
        $this->loadAllFixtures();
    }

    /**
     * @group E2E
     */
    public function testCreateSimpleOK()
    {
        $app=$this->getApp();
        $wolopayApi = $this->getApiWolopayObjectDemo();

        $articles=$this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($app->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);


        if (!$wolopayApi->createPromotionalCode( $promoCode='MY_CODE', $articles[0]->getId())){

            throw new \Exception("Error");
        }
    }

    /**
     * @group E2E
     */
    public function testUseSimpleOK()
    {
        $app=$this->getApp();
        $wolopayApi = $this->getApiWolopayObjectDemo();

        $articles=$this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($app->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);

        if (!$wolopayApi->createPromotionalCode( $promoCode='MY_CODE', $articles[0]->getId())){
            throw new \Exception("Error");
        }

        $gamerId='3123';
        if (!$wolopayApi->createGamer( $gamerId ))
        {
            throw new \Exception("Error");
        }

        if (!$wolopayApi->usePromotionalCodeByGamerId( $promoCode='MY_CODE', $gamerId)){

            throw new \Exception("Error");
        }
    }

    /**
     * @group E2E
     */
    public function testUseSimpleUseOK()
    {
        $app=$this->getApp();
        $wolopayApi = $this->getApiWolopayObjectDemo();
        $articles=$this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($app->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);

        if (!$wolopayApi->createPromotionalCode( $promoCode='MY_CODE', $articles[0]->getId())){
            throw new \Exception("Error");
        }

        $gamerId='3123';
        if (!$wolopayApi->createGamer( $gamerId ))
        {
            throw new \Exception("Error");
        }

        if (!$wolopayApi->usePromotionalCodeByGamerId( $promoCode='MY_CODE', $gamerId = '3123')){

            throw new \Exception("Error");
        }

    }
} 