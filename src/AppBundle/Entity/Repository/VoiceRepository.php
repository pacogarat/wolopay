<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Voice;

class VoiceRepository extends AbstractRepository
{
    /**
     * @param $number
     * @return Voice
     */
    public function findByNumber($number)
    {
        $sql = "
            SELECT voice
            FROM AppBundle:Voice voice
            WHERE
                voice.number = :number
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'number' => $number,
                )
            )
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $payMethodProviderHasCountry
     * @param $amount
     * @return Voice[]
     */
    public function findByPayMethodProviderHasCountryAndAmount($payMethodProviderHasCountry, $amount) {
        $sql = "
            SELECT voice
            FROM AppBundle:Voice voice
            WHERE
                voice.payMethodProviderHasCountry = :payMethodProviderHasCountry
                AND voice.amount = :amount
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'payMethodProviderHasCountry' => $payMethodProviderHasCountry,
                    'amount' => $amount,
                )
            )->getResult()
            ;
    }
}
