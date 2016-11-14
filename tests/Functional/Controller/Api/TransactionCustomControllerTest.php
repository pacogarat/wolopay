<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\TransactionStatusCategoryEnum;
use AppBundle\Entity\PayMethod;
use AppBundle\Tests\Lib\FunctionalTestCase;


class TransactionCustomControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testCreateCustomTransactionOK()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $gamerId = 3;
        $paypalPM = $this->em->getRepository("AppBundle:PayMethod")->findOneByPayCategoryIdAndArticleCategoryIdAndName(
            PayCategoryEnum::PROVIDER_METHOD_ID, ArticleCategoryEnum::SINGLE_PAYMENT_ID, PayMethodEnum::PAYPAL_SINGLE_NAME
        );

        $articleTitle = 'Article title';
        $articleDescription = 'Article description';

        $this->client->request('POST', $this->router->generate('api_transaction_create_transaction_custom'),
            [
                'gamer_id'       => $gamerId,
                'country'        => CountryEnum::SPAIN,
                'amount'         => 2.98,
                'currency'       => CurrencyEnum::EURO,
                'pay_method_id'     => $paypalPM->getId(),
                'article_title'  => $articleTitle,
                'article_description' => $articleDescription,
            ]
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $transactions = $this->em->getRepository("AppBundle:Transaction")->findAll();
        $transaction = $transactions[0];

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($articleTitle, $transaction->getCustomArticleTitle());
        $this->assertEquals($articleDescription, $transaction->getCustomArticleDescription());
        $this->assertEquals(TransactionStatusCategoryEnum::SHOPPING_ID, $transaction->getStatusCategory()->getId());
        $this->assertCount(1, $transactions);

        $this->client->request('GET', $response->url);

//         die($this->client->getResponse()->getContent());
//
//        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

} 