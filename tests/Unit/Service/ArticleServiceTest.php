<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use AppBundle\Entity\Article;
use AppBundle\Entity\ArticleGachaHasArticle;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\PaymentDetailArticlesHasGivenArticle;
use AppBundle\Entity\Repository\PaymentDetailArticlesHasGivenArticleRepository;
use AppBundle\Payment\Util\CalculateFee;
use AppBundle\Service\ArticleService;
use AppBundle\Tests\Unit\AbstractUnit;
use Symfony\Component\DependencyInjection\Container;


class ArticleServiceTest  extends AbstractUnit
{
    /** @var ArticleServiceFake  */
    private $articleServiceFake;

    public function setUp()
    {
        parent::setUp();

//        $this->articleServiceFake = new ArticleServiceFake($this->em, $this->logger, $this->currencyService);
    }

    public function createGivenArticleGachaBoxProvider()
    {
        // Articles in gacha, ids 1, 2, 3

        return array(
            'new stack' => array(),
            'only 1 remaining'=> [1,1,1, ['1'=> 0, '2'=> 1, '3'=> 1], 2, null, null, ['1'=> 0, '2'=> 0, '3'=> 1],  3],
            'restart stack'=> [1,1,1, ['1'=> 0, '2'=> 0, '3'=> 1], 3, null, null, ['1'=> 1, '2'=> 1, '3'=> 1],  null],
            'In same time with 5 hours to reset'=> [1,1,1, ['1'=> 0, '2'=> 1, '3'=> 1], 3, 5, new \DateTime('-3 hours'), ['1'=> 0, '2'=> 1, '3'=> 0],  null],
            'Reset time exceeded'=> [1,1,1, ['1'=> 0, '2'=> 1, '3'=> 1], 3, 5, new \DateTime('-6 hours'), ['1'=> 1, '2'=> 1, '3'=> 1],  null],
            'Not available articles'=> [1,1,1, ['5'=> 0, '6'=> 1, '7'=> 1], 5, null, null, ['1'=> 1, '2'=> 1, '3'=> 1],  null],
        );
    }

    /**
     * @dataProvider createGivenArticleGachaBoxProvider
     */
    public function testCreateGivenArticleGachaBox(
        $amountToGive1 = 1,
        $amountToGive2 = 1,
        $amountToGive3 = 1,
        $returnOldState = null,
        $lastArticleIdUsed = null,
        $nHoursGachaReset = null,
        $gachaInitialDateOldState = null,
        $resultExpected = ['1' => 1, '2' => 1, '3' => 1],
        $objectGivenId = null
    )
    {
        $gamer = $this->getMockBuilder(Gamer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $calculateFeeMock = $this->getMockBuilder(CalculateFee::class)
            ->disableOriginalConstructor()
            ->getMock();

        $articleParentMock = $this->getMockBuilder(Article::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gacha1 = $this->getMockBuilder(ArticleGachaHasArticle::class)
            ->disableOriginalConstructor()
            ->getMock();

        $gacha2 = clone($gacha1);
        $gacha3 = clone($gacha1);

        $gacha1->method('getAmountToGive')->willReturn($amountToGive1);
        $gacha2->method('getAmountToGive')->willReturn($amountToGive2);
        $gacha3->method('getAmountToGive')->willReturn($amountToGive3);

        $possibleArticle1 = $this->getMockBuilder(Article::class)
            ->disableOriginalConstructor()
            ->getMock();

        $possibleArticle2 = clone($possibleArticle1);
        $possibleArticle3 = clone($possibleArticle1);

        $possibleArticle1->method('getId')->willReturn('1');
        $possibleArticle2->method('getId')->willReturn('2');
        $possibleArticle3->method('getId')->willReturn('3');

        $gacha1->method('getPossibleArticle')->willReturn($possibleArticle1);
        $gacha2->method('getPossibleArticle')->willReturn($possibleArticle2);
        $gacha3->method('getPossibleArticle')->willReturn($possibleArticle3);

        $articleParentMock->method('getArticlesGacha')->willReturn([$gacha1, $gacha2, $gacha3]);
        $articleParentMock->method('getHoursToResetGacha')->willReturn($nHoursGachaReset);

        $paymentDetailArticlesHasGivenArticleMock = null;

        if ($returnOldState)
        {
            $articleGiven = $this->getMockBuilder(Article::class)
                ->disableOriginalConstructor()
                ->getMock();

            $articleGiven
                ->method('getId')
                ->willReturn($lastArticleIdUsed)
            ;

            $paymentDetailArticlesHasGivenArticleMock = $this->getMockBuilder(PaymentDetailArticlesHasGivenArticle::class)
                ->disableOriginalConstructor()
                ->getMock();

            $paymentDetailArticlesHasGivenArticleMock->method('getRemainingForUserHistory')->willReturn($returnOldState);
            $paymentDetailArticlesHasGivenArticleMock->method('getArticle')->willReturn($articleGiven);
            $paymentDetailArticlesHasGivenArticleMock->method('getGachaInitialDate')->willReturn($gachaInitialDateOldState);
        }


        $paymentDetailArticlesHasGivenArticleRepository = $this->getMockBuilder(PaymentDetailArticlesHasGivenArticleRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $paymentDetailArticlesHasGivenArticleRepository
            ->method('findLastBoxGachaByGamerIdAndArticleId')
            ->willReturn($paymentDetailArticlesHasGivenArticleMock);

        $this->em->method('getRepository')->willReturn($paymentDetailArticlesHasGivenArticleRepository);

        $this->articleServiceFake = new ArticleServiceFake($this->em, $this->logger, $this->currencyService, $calculateFeeMock);

        $paymentDetailArticlesHasGivenArticle = $this->articleServiceFake->createGivenArticleGachaBox($articleParentMock, $gamer);
        $this->assertSame($resultExpected, $paymentDetailArticlesHasGivenArticle->getRemainingForUserHistory());

        if ($objectGivenId)
            $this->assertEquals($objectGivenId, $paymentDetailArticlesHasGivenArticle->getArticle()->getId());
    }

}

class ArticleServiceFake extends ArticleService
{
    /**
     * @inheritdoc
     */
    public function createGivenArticleGachaBox()
    {
        $args = func_get_args();
        return call_user_func_array('parent::createGivenArticleGachaBox', $args);
    }


}