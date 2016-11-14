<?php


namespace AppBundle\Tests\E2E;


use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Tests\Lib\E2ETestCase;

abstract class AbstractE2EShop  extends E2ETestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    function getUrlOfNewTransaction($appName='Demo')
    {
        $app         = $this->getApp();
        $transaction = $this->createTransaction($app->getAppApiHasCredential());


        return $this->router->generate("shop_index", ['transaction_id' => $transaction->getId()]);
    }

    public function verifySinglePaymentPurchase()
    {
        $this->verifyPurchasesNumbers(1, 1);
    }

    public function verifyPurchasesNumbers($nPurchases, $nNotifications)
    {
        $this->waitUntilPaymentProcessEnd();
        $this->assertEquals($nPurchases, count( $this->em->getRepository("AppBundle:Purchase")->findAll()));
        $this->assertEquals($nNotifications, count( $this->em->getRepository("AppBundle:PurchaseNotification")->findAll()));
    }

    public function waitUntilPaymentProcessEnd()
    {
        $attempts=20;
        $transactions = $this->em->getRepository("AppBundle:Transaction")->findAll();
        $transaction = $transactions[0];
        $exit = true;

        while($exit)
        {
            $attempts--;

            $this->em->refresh($transaction);

            $invalidStates = [
                TransactionStatusCategoryEnum::PROCESSING_PAYMENT_ID,
                TransactionStatusCategoryEnum::BEGIN_ID,
                TransactionStatusCategoryEnum::SHOPPING_ID,
            ];

            if (in_array($transaction->getStatusCategory()->getId(), $invalidStates) == false )
                $exit = false;

            if ($attempts < 1)
                break;

            sleep(2);
        }

        if ($exit)
            throw new \Exception("TEST: payment is not ended");
    }

    protected function getDynamicPageOptions($codeFile)
    {
        $codes = file($codeFile, FILE_IGNORE_NEW_LINES);
        $this->setNextDynamicLine($codeFile);

        foreach ($codes as $line)
        {
            $arr = explode("|",$line);
            if (count($arr) < 2)
                continue;

            if ($arr[0]=='X')
                return $arr;
        }

        return null;
    }

    protected function setNextDynamicLine($codeFile)
    {
        $codes = file($codeFile);
        $tmp='';
        $next=false;
        foreach ($codes as $line)
        {
            $arr = explode("|",$line);
            if ($arr[0]=='X')
            {
                $tmp.=substr($line, 1);
                $next=true;
            }else if ($next){
                $tmp.='X'.$line;
                $next=false;
            }else
                $tmp .= $line;

        }

        file_put_contents($codeFile, $tmp);
    }


} 