<?php

namespace AppBundle\Tests\Functional\Controller\Api;



use AppBundle\Entity\Gamer;
use AppBundle\Tests\Lib\FunctionalTestCase;


class GamerControllerTest extends FunctionalTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testAllDataOK()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('POST', $this->router->generate('api_gamer_post_gamer'),
            [
                'gamer_id' => 'id',
                'name' => 'name',
                'surname' => 'surname',
                'email' => 'a@a.com',
            ]
        );

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());

        $this->assertEquals('id', $response->gamer_external_id);
        $this->assertEquals('name', $response->name);
        $this->assertEquals('surname', $response->surname);
        $this->assertEquals('a@a.com', $response->email);
    }

    public function testWrongEmail400Ko()
    {
        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('POST', $this->router->generate('api_gamer_post_gamer'),
            [
                'gamer_id' => 'id',
                'name' => 'name',
                'surname' => 'surname',
                'email' => 'WRONGEMAIL',
            ]
        );

//                die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());

    }


    public function testUpdatedOK()
    {
        $gamer = new Gamer($this->getApp(),'random');
        $gamer
            ->setEmail('email@email.com')
        ;

        $this->em->persist($gamer);
        $this->em->flush();

        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('PATCH', $this->router->generate('api_gamer_patch_gamer',['gamer_id' => 'random']),
            ['email' => 'email@changed.com',]
        );

        $this->em->refresh($gamer);
        $this->assertEquals('email@changed.com', $gamer->getEmail());

//        die($this->client->getResponse()->getContent());

        $response = json_decode($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function testUpdatedKO()
    {
        $gamer = new Gamer($this->getApp(),'random');
        $gamer
            ->setEmail('email@email.com')
        ;

        $this->em->persist($gamer);
        $this->em->flush();

        $this->setHeaderWSSEValidToClientRequest();

        $this->client->request('PATCH', $this->router->generate('api_gamer_patch_gamer',['gamer_id' => 'random']),
            ['email' => 'WRONGEMAIL',]
        );

        $this->em->refresh($gamer);
        $this->assertEquals('email@email.com', $gamer->getEmail());

        $response = json_decode($this->client->getResponse()->getContent());
        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

} 