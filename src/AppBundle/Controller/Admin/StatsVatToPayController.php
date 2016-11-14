<?php

namespace AppBundle\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/stats_vat")
 */
class StatsVatToPayController extends AbstractSonataController
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var \JMS\Serializer\Serializer
     * @Inject("serializer")
     */
    public $serialize;

    /**
     * @Route("/", name="stats_vat_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return [
            'base_template' => $this->getBaseTemplate(),
            'admin_pool'    => $this->container->get('sonata.admin.pool'),
        ];
    }

    /**
     * @Route("/data/{date_from}/{date_to}", name="stats_vat_data")
     */
    public function dataAction(Request $request, \DateTime $date_from, \DateTime $date_to)
    {
        $sql = "
            Select
                DATE_FORMAT(pu.created_at,'%Y-%m') as month,
                cont.name as continent,
                co.name as country,
                pro.name as provider,
                pm.name as pay_method,
                CONCAT (pu.tax_percent, '%') as country_vat,
                pu.currency_id as currency,
                cu.symbol as symbol,
                AVG(pu.exchange_rate_eur) as averageExchangeEur,
                SUM(pu.amount_tax) as fee,
                SUM(pu.amount_total) as withVat,
                SUM(pu.amount_total - pu.amount_tax) as withoutVat,
                SUM(pu.amount_total - pu.amount_provider) as withVatWithoutProvider
            from purchase pu
                inner join transaction tr on (pu.transaction_id=tr.id)
                inner join country co on (tr.country_detected_id = co.id )
                inner join continent cont on (co.continent_id = cont.id)
                inner join pay_method pm on (pu.pay_method_id = pm.id )
                inner join currency cu on (pu.currency_id = cu.id )
                inner join provider pro on (pu.provider_id = pro.id )
            where
                pu.test <> 1
                AND p.usedAppProviderCredentials <> 1
                AND pu.created_at >= '".$date_from->format("Y-m-d")." 00:00:00' AND pu.created_at < '".$date_to->format("Y-m-d")." 00:00:00'
                AND pro.free_vat=0
                AND tr.id like 'WOT_%' AND pu.id like 'WOP_%'
                  group by month, pu.country_id, pu.currency_id, pu.pay_method_id, pu.tax_percent
                  order by cont.name, co.name, pu.tax_percent
                ";


        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $c1="color1";
        $c2="color2";
        $prevCountry="";
        $cDef = $c2;
        foreach ($result as $index => $row)
        {
            if ($row['country'] <> $prevCountry){
                $cDef= ($cDef==$c1)?$c2:$c1;
                $prevCountry = $row['country'];
            }
            $result[$index]['color'] = $cDef;
        }


        return new JsonResponse($result);
    }

    /**
     * @Route("/dataEur/{date_from}/{date_to}", name="stats_vat_data2")
     */
    public function dataEurAction(Request $request, \DateTime $date_from, \DateTime $date_to)
    {
        $sql = "
            SELECT
                DATE_FORMAT(pu.created_at,'%Y-%m') as month,
                cont.name as continent,
                co.name as country,
                pro.name as provider,
                pm.name as pay_method,
                CONCAT (pu.tax_percent, '%') as country_vat,
                'EUR' as currency,
                '€' as symbol,
                AVG(pu.exchange_rate_eur) as averageExchangeEur,
                SUM(pu.amount_tax*pu.exchange_rate_eur) as fee,
                SUM(pu.amount_total*pu.exchange_rate_eur) as withVat,
                SUM((pu.amount_total - pu.amount_tax)*pu.exchange_rate_eur) as withoutVat,
                SUM((pu.amount_total - pu.amount_provider)*pu.exchange_rate_eur) as withVatWithoutProvider
            FROM purchase pu
                inner join transaction tr on (pu.transaction_id=tr.id)
                inner join country co on (tr.country_detected_id = co.id )
                inner join continent cont on (co.continent_id = cont.id)
                inner join pay_method pm on (pu.pay_method_id = pm.id )
                inner join currency cu on (pu.currency_id = cu.id )
                inner join provider pro on (pu.provider_id = pro.id )
            WHERE
                pu.test <> 1
                AND pu.was_canceled <> 1
                AND pu.created_at >= '".$date_from->format("Y-m-d")." 00:00:00' AND pu.created_at < '".$date_to->format("Y-m-d")." 00:00:00'
                AND pro.free_vat=0
                AND tr.id like 'WOT_%' AND  pu.id like 'WOP_%'
                  group by month, pu.country_id, pu.currency_id, pu.pay_method_id, pu.tax_percent
                  order by cont.name, co.name, pu.tax_percent
                ";


        $stmt = $this->em->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $c1="color1";
        $c2="color2";
        $prevCountry="";
        $cDef = $c2;
        foreach ($result as $index => $row)
        {
            if ($row['country'] <> $prevCountry){
                $cDef= ($cDef==$c1)?$c2:$c1;
                $prevCountry = $row['country'];
            }
            $result[$index]['color'] = $cDef;
        }


        return new JsonResponse($result);
    }
}
