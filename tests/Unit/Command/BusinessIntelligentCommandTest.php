<?php

namespace AppBundle\Tests\Unit\Command;


use AppBundle\Command\BusinessIntelligentCommand;
use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LevelCategoryEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\LevelCategory;
use AppBundle\Entity\ShopCss;
use AppBundle\Entity\Transaction;
use AppBundle\Service\CurrencyService;
use AppBundle\Service\IPInfoService;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

class FakeBusinessIntelligentCommand extends BusinessIntelligentCommand
{
    public function createMessageToTransactionStarted($transaction, $request)
    {
        return parent::createMessageToTransactionStarted($transaction, $request);
    }
}

class BusinessIntelligentCommandTest  extends \PHPUnit_Framework_TestCase
{

    /** @var FakeBusinessIntelligentCommand */
    private $businessIntelligent ;


    public function setUp()
    {
        $this->businessIntelligent = new FakeBusinessIntelligentCommand(
            $this->getMockBuilder(\Doctrine\ORM\EntityManager::class)->disableOriginalConstructor()->getMock(),
            $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock(),
            true,
            $this->getMockBuilder(CurrencyService::class)->disableOriginalConstructor()->getMock(),
            '',
            '',
            $this->getMockBuilder(IPInfoService::class)->disableOriginalConstructor()->getMock(),
            ''
        );

    }

    private function basicTransaction()
    {
        $shopCss = new ShopCss();
        $shopCss->setName('Shop Name');

        $app = new App();
        $app->setId('3');

        $gamer = new Gamer($app, '123');
        $gamer->setId('4');

        $levelCategory = new LevelCategory(LevelCategoryEnum::ROOKIE_ID);
        $levelCategory->setName('Rookie');

        $transaction = new Transaction();
        $transaction
            ->setApp($app)
            ->setLevelCategory($levelCategory)
            ->setValueCurrent(10)
            ->setGamer($gamer)
            ->setCss($shopCss)
        ;

        return $transaction;
    }

    public function testSimpleOK()
    {
        $transaction = $this->basicTransaction();
        $this->executeAndVerify($transaction, new Request());
    }

    public function testSimpleWithCountryDetectedOK()
    {
        $request = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $request->method('getClientIp')->willReturn('122.22.2.2');

        $country = new Country(CountryEnum::SPAIN);
        $country->setTimeZone('Europe/Madrid');


        $transaction = $this->basicTransaction();
        $transaction->setCountryDetected($country);

        $msg = $this->executeAndVerify($transaction, $request);

        $this->assertNotContains('||' ,$msg);
    }

    public function executeAndVerify(Transaction $transaction , Request $request)
    {

        $msg = $this->businessIntelligent->createMessageToTransactionStarted($transaction, $request);

//                echo $msg;die;

        $this->assertNotContains('{' ,$msg);
        $this->assertNotContains('}' ,$msg);

        return $msg;
    }

} 