<?php

namespace AppBundle\Tests\Functional\Controller\Api;


use AppBundle\DataFixtures\ORM\LoadCompany;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Tests\Lib\FunctionalTestCase;
use Uploadable\Fixture\Entity\Article;

class PromoControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testPostPromoUseOk()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('POST', $this->router->generate('api_promo_code_create_a_purchase_by_promo'),
                array(
                    'gamer_id' => $transacion->getGamer()->getGamerExternalId(),
                    'promo_code' => 'demo',
                )
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($response->gamer->gamer_external_id, $transacion->getGamer()->getGamerExternalId());
    }

    public function testAUpdatePromoKO()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        $transacion = $this->createTransaction($user);

        $this->client->request('GET', $this->router->generate('api_promo_code_is_valid',
            array(
                'gamer_id' => $transacion->getGamer()->getGamerExternalId(),
                'promo_code' => 'demo',
            ))
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $this->assertNotNull($response->code);
    }

    public function testAPostPromoOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        /** @var Article[] $articles */
        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($user->getApp()->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);

        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_promo_code_create_promo', []),
            array(
                'article_id' => $articles[0]->getId(),
                'promo_code' => 'demoRAND'
            )
        );

//        die($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }


    /*
      DOESNT WORK IN TEST... ???¿?

    public function testAPostPromoKOAuthorizationByJWT()
    {


        $this->setHeaderWSSEInvalidToClientRequest();
        $user = $this->setJWTokenValidToClientRequest();
        /* @var Article[] $articles
        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($user->getApp()->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);

        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_promo_code_create_promo', []),
            array(
                'article_id' => $articles[0]->getId(),
                'promo_code' => 'demoRAND'
            )
        );

        die($this->client->getResponse()->getContent());

        $this->assertEquals(403, $this->client->getResponse()->getStatusCode());
    }
*/

    public function testAPostPromoFullOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        /** @var Article[] $articles */
        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($user->getApp()->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);
        $transaction = $this->createTransaction($user);
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        $begin = new \DateTime();
        $end = new \DateTime("+6 months");

        $this->client->request('POST',
            $this->router->generate('api_promo_code_create_promo', []),
            array(
                'article_id' => $articles[0]->getId(),
                'promo_code' => 'demoRAND',
                'gamers_ids' => $transaction->getGamer()->getGamerExternalId(),
                'n_total_uses' => 2,
                'n_uses_per_gamer' => 1,
                'begin_at' => $begin->format(DATE_ISO8601),
                'end_at' => $end->format(DATE_ISO8601),
            )
        );

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testAPostPromoPromoRepeatedKO()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        /** @var Article[] $articles */
        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($user->getApp()->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);

        $credentials = $this->setHeaderWSSEValidToClientRequest();
        $this->client->request('POST',
            $this->router->generate('api_promo_code_create_promo', []),
            array(
                'article_id' => $articles[0]->getId(),
                'promo_code' => 'demo'
            )
        );

//                die($this->client->getResponse()->getContent());

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }


    public function testAUpdatePromoOK()
    {
        $user = $this->setHeaderWSSEValidToClientRequest();
        /** @var Article[] $articles */
        $articles = $this->em->getRepository("AppBundle:Article")->findByAppAndArticleCategory($user->getApp()->getId(), ArticleCategoryEnum::FREE_PAYMENT_ID);
        $transaction = $this->createTransaction($user);
        $credentials = $this->setHeaderWSSEValidToClientRequest();

        $begin = new \DateTime();
        $end = new \DateTime("+6 months");

        $this->client->request('POST',
            $this->router->generate('api_promo_code_create_promo'),
            array(
                'article_id' => $articles[0]->getId(),
                'promo_code' => 'demoRAND',
                'gamers_ids' => $transaction->getGamer()->getGamerExternalId(),
                'n_total_uses' => 2,
                'n_uses_per_gamer' => 1,
                'begin_at' => $begin->format(DATE_ISO8601),
                'end_at' => $end->format(DATE_ISO8601),
            )
        );
//        die($this->client->getResponse()->getContent());
        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($response->n_total_uses, 2);
        $this->assertEquals($response->n_uses_per_user, 1);

        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('PUT',
            $this->router->generate('api_promo_code_update_promo', ['promo_code' => 'demoRAND']),
            array(
                'article_id' => $articles[0]->getId(),
                'gamers_ids' => $transaction->getGamer()->getGamerExternalId(),
                'n_total_uses' => 3,
                'n_uses_per_gamer' => 4,
                'begin_at' => $begin->format(DATE_ISO8601),
                'end_at' => $end->format(DATE_ISO8601),
            )
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($response->n_total_uses, 3);
        $this->assertEquals($response->n_uses_per_user, 4);

    }


} 