<?php


namespace AppBundle\Controller\Admin;


use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class StatsToPayClientsController extends AbstractSonataController
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @Route("/stats_pay_to_clients/summary", name="stats_pay_to_clients_summary")
     * @Template()
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return [
            'base_template' => $this->getBaseTemplate(),
            'admin_pool'    => $this->container->get('sonata.admin.pool'),
//            'query'         => $request->get('q'),
//            'groups'        => $this->getAdminPool()->getDashboardGroups()
        ];
    }

    /**
     * @Route("/stats_pay_to_clients/data/{date_from}/{date_to}", name="stats_pay_to_clients_data")
     *
     * @param Request $request
     * @param \DateTime $date_from
     * @param \DateTime $date_to
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dataAction(Request $request, \DateTime $date_from, \DateTime $date_to)
    {
        $sql = "
            Select
                p.id, p.createdAt, a.name as name, pm.name as paymethod, (p.amountTotal * p.exchangeRateEur) as total_amount,
                (p.amountTotal * p.exchangeRateEur) / (p.amountTotal) as exchange_ratio

            FROM AppBundle:Purchase p
                JOIN p.app a
                JOIN p.payMethod pm
            where
                p.test <> 1
                AND p.usedAppProviderCredentials <> 1
                AND p.createdAt >= :dateFrom AND p.createdAt < :dateTo

            ORDER BY p.createdAt
        ";
        //        die($sql);
        $result = $this->em
            ->createQuery($sql)
            ->setParameters(['dateFrom' => $date_from, 'dateTo' => $date_to])
            ->getArrayResult()
        ;

        foreach ($result as $index => $row)
        {
            $result[$index]['total_amount'] = floatval($result[$index]['total_amount']);
            $result[$index]['exchange_ratio'] = floatval($result[$index]['exchange_ratio']);
            $result[$index]['createdAt'] = $result[$index]['createdAt']->format('Y-m-d H:i:s');
        }


        return new JsonResponse($result);
    }


    /**
     * @Route("/stats_pay_to_providers/data/{date_from}/{date_to}", name="stats_pay_to_provider_data")
     *
     * @param Request $request
     * @param \DateTime $date_from
     * @param \DateTime $date_to
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dataProvidersAction(Request $request, \DateTime $date_from, \DateTime $date_to)
    {
        $sql = "
            Select
                p.id, p.createdAt, pro.name as provider, (p.amountTotal * p.exchangeRateEur) as total_amount,
                (p.amountTotal - p.amountProvider) * p.exchangeRateEur as pay_from_providers_eur,
                (p.amountTotal - p.amountProvider) * c.exchangeRateEur as pay_from_providers_eur_current_exchange,
                co.id as countryDetected


            FROM AppBundle:Purchase p
                JOIN p.app a
                JOIN p.provider pro
                JOIN p.currency c
                JOIN p.transaction t
                LEFT JOIN t.countryDetected co

            WHERE
                p.test <> 1
                AND p.usedAppProviderCredentials <> 1
                AND t.id like 'WOT_%' and p.id like 'WOP_%'
                AND p.createdAt >= :dateFrom AND p.createdAt < :dateTo

            GROUP BY p.id

            ORDER BY p.createdAt

        ";
        //        die($sql);
        $result = $this->em
            ->createQuery($sql)
            ->setParameters(['dateFrom' => $date_from, 'dateTo' => $date_to])
            ->getArrayResult()
        ;

        foreach ($result as $index => $row)
        {
            $result[$index]['total_amount'] = floatval($result[$index]['total_amount']);
            $result[$index]['pay_from_providers_eur'] = floatval($result[$index]['pay_from_providers_eur']);
            $result[$index]['pay_from_providers_eur_current_exchange'] = floatval($result[$index]['pay_from_providers_eur_current_exchange']);
            $result[$index]['createdAt'] = $result[$index]['createdAt']->format('Y-m-d H:i:s');
            $result[$index]['country'] = $result[$index]['countryDetected'];
        }


        return new JsonResponse($result);
    }

}