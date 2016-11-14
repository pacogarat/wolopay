<?php

namespace AppBundle\Entity\Repository;



use AppBundle\Entity\ClientHasProviderCredential;

class ClientHasProviderCredentialRepository extends AbstractRepository
{
    /**
     * @param $appId
     * @param $providerId
     * @return ClientHasProviderCredential
     */
    public function findOneByAppIdAndProviderId($appId, $providerId)
    {
        $sql="SELECT c
            FROM AppBundle:ClientHasProviderCredential c
            JOIN c.client cli
            JOIN cli.apps a
            WHERE
                c.provider = :providerId
                AND a.id = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('providerId' => $providerId, 'app' => $appId))
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $appId
     * @param string $providerName
     * @return ClientHasProviderCredential
     */
    public function findOneByAppIdAndProviderName($appId, $providerName)
    {
        $sql="SELECT c
            JOIN AppBundle:ClientHasProviderCredential c
            JOIN c.apps a
            JOIN c.provider prov
            WHERE
                prov.name = :providerName
                AND a.id = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('providerName' => $providerName, 'app' => $appId))
            ->getOneOrNullResult()
            ;
    }


    /**
     * @param $appId
     * @return ClientHasProviderCredential[]
     */
    public function findByAppId($appId)
    {
        $sql="SELECT c
            FROM AppBundle:ClientHasProviderCredential c
            JOIN c.client cli
            JOIN cli.apps a
            WHERE

                a.id = :app
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(array('app' => $appId))
            ->getResult()
        ;
    }
} 