<?php

namespace AppBundle\Entity\Repository;

use AppBundle\Entity\SMS;

class SMSRepository extends AbstractRepository
{
    /**
     * @param string $payMethodProviderHasCountry
     * @return SMS[]
     */
    public function findByPayMethodProviderHasCountry($payMethodProviderHasCountry) {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
            WHERE
                sms.payMethodProviderHasCountry = :payMethodProviderHasCountry
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'payMethodProviderHasCountry' => $payMethodProviderHasCountry,
                )
            )->getResult()
        ;
    }

    /**
     * @param string $payMethodProviderHasCountry
     * @param $amount
     * @return SMS[]
     */
    public function findByPayMethodProviderHasCountryAndAmount($payMethodProviderHasCountry, $amount) {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
            WHERE
                sms.payMethodProviderHasCountry = :payMethodProviderHasCountry
                AND sms.amount = :amount
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

    /**
     * @param $alias
     * @param $countryId
     * @param $smsShortNumber
     * @param $operatorShortName
     * @return SMS
     */
    public function findOneByAliasAndCountryAndSmsShortCodeAndOperatorShortName($alias, $countryId, $smsShortNumber, $operatorShortName)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
            LEFT JOIN sms.smsAlias aliases
            JOIN sms.payMethodProviderHasCountry pmpc
            JOIN sms.operator operator

            WHERE
                (aliases.alias = :alias OR sms.aliasDefault = :alias)
                AND sms.shortNumber = :smsShortNumber
                AND pmpc.country = :countryId
                AND operator.shortName = :operatorShortName
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'alias'             => $alias,
                    'countryId'         => $countryId,
                    'smsShortNumber'    => $smsShortNumber,
                    'operatorShortName' => $operatorShortName,
                )
            )
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param $alias
     * @param $countryId
     * @param $smsShortNumber
     * @param $operatorId
     * @return SMS
     */
    public function findOneByAliasAndCountryAndSmsShortCodeAndOperatorId($alias, $countryId, $smsShortNumber, $operatorId)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
            LEFT JOIN sms.smsAlias aliases
            JOIN sms.payMethodProviderHasCountry pmpc
            JOIN sms.operator operator

            WHERE
                (aliases.alias = :alias OR sms.aliasDefault = :alias)
                AND sms.shortNumber = :smsShortNumber
                AND pmpc.country = :countryId
                AND operator.id = :operatorId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'alias'          => $alias,
                    'countryId'      => $countryId,
                    'smsShortNumber' => $smsShortNumber,
                    'operatorId'     => $operatorId,
                )
            )
            ->getOneOrNullResult()
            ;
    }

    /**
     * @param $countryId
     * @param $operatorId
     * @return SMS[]
     */
    public function findByCountryIdAndOperatorId($countryId, $operatorId)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
            JOIN sms.operator operator
            JOIN sms.payMethodProviderHasCountry pmpc

            WHERE
                pmpc.country = :countryId
                AND operator.id= :operatorId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'countryId'      => $countryId,
                    'operatorId'     => $operatorId,
                )
            )
            ->getResult()
            ;
    }

    /**
     * @param $countryId
     * @return SMS[]
     */
    public function findByCountryId($countryId)
    {
        $sql = "
            SELECT sms
            FROM AppBundle:SMS sms
             JOIN sms.payMethodProviderHasCountry pmpc

            WHERE
                pmpc.country = :countryId
        ";

        return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameters(
                array(
                    'countryId'      => $countryId,
                  )
            )
            ->getResult()
            ;
    }
}
