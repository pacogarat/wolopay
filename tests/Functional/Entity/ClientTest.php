<?php


namespace AppBundle\Tests\Functional\Entity;


use AppBundle\Entity\ClientHasProviderCredential;
use AppBundle\Tests\Lib\FunctionalTestCase;

class ClientTest extends FunctionalTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->loadAllFixtures();
    }

    public function testProviderClientCredentialsForAppGeneral()
    {
        $client = $this->em->getRepository("AppBundle:Client")->findAll()[0];
        $provider = $this->em->getRepository("AppBundle:Provider")->findAll()[0];
        $app = $this->em->getRepository("AppBundle:App")->findOneBy(['name' => 'Demo']);

        $clientHasProviderCredential = new ClientHasProviderCredential($client, $provider);

        $this->em->persist($clientHasProviderCredential);
        $this->em->flush();

        $this->assertEquals($client->getProviderClientCredentialsForApp($provider, $app), $clientHasProviderCredential);

    }

    public function testProviderClientCredentialsForAppSpecific()
    {
        $client = $this->em->getRepository("AppBundle:Client")->findAll()[0];
        $provider = $this->em->getRepository("AppBundle:Provider")->findAll()[0];
        $app = $this->em->getRepository("AppBundle:App")->findOneBy(['name' => 'Demo']);

        $clientHasProviderCredential = new ClientHasProviderCredential($client, $provider);
        $clientHasProviderCredentialApp = new ClientHasProviderCredential($client, $provider);
        $clientHasProviderCredentialApp->addApp($app);

        $this->em->persist($clientHasProviderCredential);
        $this->em->persist($clientHasProviderCredentialApp);
        $this->em->flush();

        $this->assertEquals($client->getProviderClientCredentialsForApp($provider, $app), $clientHasProviderCredentialApp);
    }

} 