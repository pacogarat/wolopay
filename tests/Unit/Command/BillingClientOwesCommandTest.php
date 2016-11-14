<?php

namespace AppBundle\Tests\Unit\Command;


use AppBundle\Command\Billing\BillingClientOwesCommand;
use AppBundle\Entity\Client;
use AppBundle\Entity\ClientDeposit;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;

class FakeBillingClientOwesCommandTest extends BillingClientOwesCommand
{
    public function calculateDeposit(Client $client, $profits)
    {
        return parent::calculateDeposit($client, $profits);
    }
}

class BillingClientOwesCommandTest  extends \PHPUnit_Framework_TestCase
{

    /** @var FakeBillingClientOwesCommandTest */
    private $billingClientOwesCommand;


    public function setUp()
    {
        $this->billingClientOwesCommand = new FakeBillingClientOwesCommandTest();
        $this->billingClientOwesCommand->logger = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
        $this->billingClientOwesCommand->em = $this->getMockBuilder(\Doctrine\ORM\EntityManager::class)->disableOriginalConstructor()->getMock();
    }

    public function testCalculateDepositOK()
    {
        $client = $this->createClient(10, 50, 60, 10);
        /** @var ClientDeposit $deposit */
        list($extraPay, $deposit) = $this->billingClientOwesCommand->calculateDeposit($client, 100);

        $this->assertEquals($deposit->getAmountLimitCover(), 100);
        $this->assertEquals($deposit->getAmountBalance(), 110);
        $this->assertEquals($deposit->getAmountBalanceRequirement(), 110);
        $this->assertEquals($deposit->getAmountIncreaseIfLimitExceed(), 10);

        $this->assertEquals($extraPay, 100);

    }

    public function testCalculateDepositPendingOK()
    {
        $client = $this->createClient(10, 100, 90, 10);
        /** @var ClientDeposit $deposit */
        list($extraPay, $deposit) = $this->billingClientOwesCommand->calculateDeposit($client, 90);

        $this->assertEquals($deposit->getAmountLimitCover(), 90);
        $this->assertEquals($deposit->getAmountBalance(), 100);
        $this->assertEquals($deposit->getAmountBalanceRequirement(), 100);
        $this->assertEquals($deposit->getAmountIncreaseIfLimitExceed(), 10);

        $this->assertEquals($extraPay, 90);
    }

    private function createClient($balance, $balanceRequirement, $limitCover, $increaseIfExceed)
    {
        $clientDeposit = new ClientDeposit();
        $clientDeposit
            ->setAmountBalance($balance)
            ->setAmountBalanceRequirement($balanceRequirement)
            ->setAmountLimitCover($limitCover)
            ->setAmountIncreaseIfLimitExceed($increaseIfExceed)
        ;

        $clientMock = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $clientMock
            ->expects($this->any())
            ->method('getDepositCurrent')
            ->will($this->returnValue($clientDeposit))
        ;

        return $clientMock;
    }

} 