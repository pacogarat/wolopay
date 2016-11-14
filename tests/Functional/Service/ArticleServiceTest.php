<?php


namespace AppBundle\Tests\Functional\Payment\Actions;


use AppBundle\DataFixtures\Specific\LoadSinglePurchaseBasic;
use AppBundle\DataFixtures\Specific\LoadSubscriptionPurchaseBasic;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Service\ArticleService;
use AppBundle\Tests\Lib\FunctionalTestCase;

class ArticleServiceTest extends FunctionalTestCase
{
    /** @var ArticleService */
    private $articleService;

    public function setUp()
    {
        parent::setUp();
        $this->articleService = $this->container->get('shop_app.article');
    }

    public function testBasicOk()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneBy(['gamerExternalId' => 32]);
        $article = $this->em->getRepository("AppBundle:Article")
            ->findOneBy(['itemsQuantity'=>100, 'app' => $this->getApp(), 'articleCategory'=> $this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID) ]);

        $this->assertTrue($this->articleService->isArticleValid($article, $gamer));
    }

    public function testBasicOkExclude1SinglePaymentNPurchasesPerClient()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $article = $this->em->getRepository("AppBundle:Article")
            ->findOneBy(['itemsQuantity'=>100, 'app' => $this->getApp(), 'articleCategory'=> $this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID) ]);

        $article->setNPurchasesPerClient(1);
        $this->em->flush();

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneBy(['gamerExternalId' => 32]);

        $this->assertFalse($this->articleService->isArticleValid($article, $gamer));
    }

    public function testBasicOkExclude1SubscriptionPaymentNPurchasesPerClient()
    {
        $this->loadAllFixtures([new LoadSubscriptionPurchaseBasic()]);
        $article = $this->em->getRepository("AppBundle:Article")
            ->findOneBy(['itemsQuantity'=>100, 'app' => $this->getApp(), 'articleCategory'=> $this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SUBSCRIPTION_PAYMENT_ID) ]);

        $article->setNPurchasesPerClient(1);
        $this->em->flush();

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneBy(['gamerExternalId' => 32]);

        $this->assertFalse($this->articleService->isArticleValid($article, $gamer));
    }

    public function testPaymentNPurchasesTotal()
    {
        $this->loadAllFixtures([new LoadSinglePurchaseBasic()]);
        $article = $this->em->getRepository("AppBundle:Article")
            ->findOneBy(['itemsQuantity'=>100, 'app' => $this->getApp(), 'articleCategory'=> $this->em->getRepository("AppBundle:ArticleCategory")->find(ArticleCategoryEnum::SINGLE_PAYMENT_ID) ]);

        $article
            ->setNPurchasesTotal(1)
            ->setTimesBought(1)
        ;
        $this->em->flush();

        $gamer = $this->em->getRepository("AppBundle:Gamer")->findOneBy(['gamerExternalId' => 32]);

        $this->assertFalse($this->articleService->isArticleValid($article, $gamer));
    }

}