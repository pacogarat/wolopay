<?php


namespace AppBundle\Tests\Functional\Entity;


use AppBundle\Tests\Lib\FunctionalTestCase;

class ClientDepositTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function test()
    {
        $client = $this->em->getRepository("AppBundle:Client")->findAll()[0];

        $deposit = $client->getDepositCurrent();
        $this->assertNotNull($deposit);

        $newDeposit = $deposit->endThisAndCreateNew();
        $this->em->persist($newDeposit);
        $this->em->flush();

        $this->assertEquals($newDeposit, $client->getDepositCurrent());
    }

} 