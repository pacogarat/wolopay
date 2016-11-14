<?php

namespace AppBundle\Tests\Unit\Payment\Service\Helper;

use AppBundle\Entity\App;
use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\CommissionBaseEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\VatCategoryEnum;
use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\Provider;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\Transaction;
use AppBundle\Entity\VatCategory;
use AppBundle\Payment\Bean\AmountBean;
use AppBundle\Payment\Bean\PaymentFeeBean;
use AppBundle\Payment\Util\CalculateFee;


class CalculateFeeTest  extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CalculateFee
     */
    private $calculateFee;

    public function setUp()
    {
        parent::setUp();

        $logger = $this->getMockBuilder('\\Monolog\\Logger')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $currServ = $this->getMockBuilder('\\AppBundle\\Service\\CurrencyService')
            ->disableOriginalConstructor()
            ->setMethods(null)
            ->getMock()
        ;

        $this->calculateFee = new CalculateFee($logger,$currServ);

    }

    /**
     * @dataProvider testsEUR
     */
    public function testGen(
        $wolo_commissionFixedFee,
        $purch_amountPaid,
        $pmpc_percent,
        $wolo_commissionBase,
        Currency $purch_currency,
        Currency $wolo_commissionCurrency,
        Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat,
        $pmpc_country_vat_percent,
        $pmpc_fixedFee=0,
        $pmpc_minimal = 0,
        $pmpc_priceSentNet = false,
        $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0,
        $wolo_commissionMin=0,
        $wolo_commissionMax=0.10,
        $expectedAmountProvider=0,
        $expectedAmountWolo=0,
        $expectedAmountGame=0,
        $expectedTaxAmount=0
    )
    {
        $pmpc_country = new Country('DF');
        $pmpc_country
            ->setVatCategory(new VatCategory($pmpc_country_applies_vat ? VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID : VatCategoryEnum::NONE_ID))
            ->setVat($pmpc_country_vat_percent)
            ->setName('Other')
        ;

        if ($purch_currency->getId()==CurrencyEnum::EURO){
            $purch_currency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($purch_currency->getId()==CurrencyEnum::DOLLAR){
            $purch_currency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($purch_currency->getId()==CurrencyEnum::POUND_STERLING){
            $purch_currency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($wolo_commissionCurrency->getId()==CurrencyEnum::EURO){
            $wolo_commissionCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::DOLLAR){
            $wolo_commissionCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $wolo_commissionCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($pmpc_commissionsCurrency->getId()==CurrencyEnum::EURO){
            $pmpc_commissionsCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::DOLLAR){
            $pmpc_commissionsCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $pmpc_commissionsCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }


        $pmpc = $this->getPreparePayMethodProviderHasCountry(
            $pmpc_percent,
            $pmpc_commissionsCurrency,
            $pmpc_fixedFee,
            $pmpc_minimal,
            $pmpc_priceSentNet,
            $pmpc_feeCalculatedWithNet,
            $pmpc_country
        );
        $purchase = $this->getMyPurchase(
            $purch_amountPaid,
            $purch_currency,
            $wolo_commissionBase,
            $wolo_commissionCurrency,
            $wolo_commissionPercent,
            $wolo_commissionFixedFee,
            $wolo_commissionMin,
            $wolo_commissionMax,
            $pmpc_country
        );

        $paymentFeeBean = null;

        $this->execute($purchase, $pmpc, $paymentFeeBean);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals($expectedAmountProvider, $purchase->getAmountProvider(), 'Amount Provider');
        $this->assertEquals($expectedTaxAmount, $purchase->getAmountTax(), 'Tax Amount', 0.00001);
        $this->assertEquals($expectedAmountWolo, $purchase->getAmountWolo(), 'Amount Wolo');
        $this->assertEquals($expectedAmountGame,$purchase->getAmountGame(), 'Amount Game', 0.00001);
    }


    /**
     * @dataProvider testsEUR_withPaymentBean
     */
    public function testGenWithPaymentBean(
        $wolo_commissionFixedFee,
        $purch_amountPaid,
        $pmpc_percent,
        $wolo_commissionBase,
        Currency $purch_currency,
        Currency $wolo_commissionCurrency,
        Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat,
        $pmpc_country_vat_percent,
        $pmpc_fixedFee=0,
        $pmpc_minimal = 0,
        $pmpc_priceSentNet = false,
        $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0,
        $wolo_commissionMin=0,
        $wolo_commissionMax=0.10,
        $expectedAmountProvider=0,
        $expectedAmountWolo=0,
        $expectedAmountGame=0,
        $expectedTaxAmount=0,
        $paymentFeeBeanTotal=0,
        $paymentFeeBeanPercent=0,
        $paymentFeeBeanFixed=0,
        $paymentFeeBeanMin=0,
        $paymentFeeBeanExtra=0,
        Currency $paymentFeeBeanCurr=null
    )
    {
        $pmpc_country = new Country('DF');
        $pmpc_country
            ->setVatCategory(new VatCategory($pmpc_country_applies_vat ? VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID : VatCategoryEnum::NONE_ID))
            ->setVat($pmpc_country_vat_percent)
            ->setName('Other')
        ;

        if ($purch_currency->getId()==CurrencyEnum::EURO){
            $purch_currency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($purch_currency->getId()==CurrencyEnum::DOLLAR){
            $purch_currency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($purch_currency->getId()==CurrencyEnum::POUND_STERLING){
            $purch_currency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($wolo_commissionCurrency->getId()==CurrencyEnum::EURO){
            $wolo_commissionCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::DOLLAR){
            $wolo_commissionCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $wolo_commissionCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($pmpc_commissionsCurrency->getId()==CurrencyEnum::EURO){
            $pmpc_commissionsCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::DOLLAR){
            $pmpc_commissionsCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $pmpc_commissionsCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }


        $pmpc = $this->getPreparePayMethodProviderHasCountry(
            $pmpc_percent,
            $pmpc_commissionsCurrency,
            $pmpc_fixedFee,
            $pmpc_minimal,
            $pmpc_priceSentNet,
            $pmpc_feeCalculatedWithNet,
            $pmpc_country
        );
        $purchase = $this->getMyPurchase(
            $purch_amountPaid,
            $purch_currency,
            $wolo_commissionBase,
            $wolo_commissionCurrency,
            $wolo_commissionPercent,
            $wolo_commissionFixedFee,
            $wolo_commissionMin,
            $wolo_commissionMax,
            $pmpc_country
        );

        $paymentFeeBean = new PaymentFeeBean(
            $paymentFeeBeanTotal,$paymentFeeBeanCurr, $paymentFeeBeanPercent,$paymentFeeBeanFixed,$paymentFeeBeanMin,$paymentFeeBeanExtra);

        $this->execute($purchase, $pmpc, $paymentFeeBean);

        // assert that your calculator added the numbers correctly!
        $this->assertEquals($expectedAmountProvider, $purchase->getAmountProvider(), 'Amount Provider');
        $this->assertEquals($expectedTaxAmount, $purchase->getAmountTax(), 'Tax Amount', 0.00001);
        $this->assertEquals($expectedAmountWolo, $purchase->getAmountWolo(), 'Amount Wolo');
        $this->assertEquals($expectedAmountGame,$purchase->getAmountGame(), 'Amount Game', 0.00001);
    }


    /**
     * @dataProvider testsEUR_withPaymentAndAmountBean
     */
    public function testGenWithPaymentAndAmountBean(
        $wolo_commissionFixedFee,
        $purch_amountPaid,
        $pmpc_percent,
        $wolo_commissionBase,
        Currency $purch_currency,
        Currency $wolo_commissionCurrency,
        Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat,
        $pmpc_country_vat_percent,
        $pmpc_fixedFee=0,
        $pmpc_minimal = 0,
        $pmpc_priceSentNet = false,
        $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0,
        $wolo_commissionMin=0,
        $wolo_commissionMax=0.10,
        $expectedAmountProvider=0,
        $expectedAmountWolo=0,
        $expectedAmountGame=0,
        $expectedTaxAmount=0,
        $paymentFeeBeanTotal=0,
        $paymentFeeBeanPercent=0,
        $paymentFeeBeanFixed=0,
        $paymentFeeBeanMin=0,
        $paymentFeeBeanExtra=0,
        Currency $paymentFeeBeanCurr=null,
        $vatAmountBean=null,
        $providerPaysVat=false
    )
    {
        $pmpc_country = new Country('DF');
        $pmpc_country
            ->setVatCategory(new VatCategory($pmpc_country_applies_vat ? VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID : VatCategoryEnum::NONE_ID))
            ->setVat($pmpc_country_vat_percent)
            ->setName('Other')
        ;

        if ($purch_currency->getId()==CurrencyEnum::EURO){
            $purch_currency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($purch_currency->getId()==CurrencyEnum::DOLLAR){
            $purch_currency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($purch_currency->getId()==CurrencyEnum::POUND_STERLING){
            $purch_currency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($wolo_commissionCurrency->getId()==CurrencyEnum::EURO){
            $wolo_commissionCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::DOLLAR){
            $wolo_commissionCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($wolo_commissionCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $wolo_commissionCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        if ($pmpc_commissionsCurrency->getId()==CurrencyEnum::EURO){
            $pmpc_commissionsCurrency->setExchangeRateEur(1)->setExchangeRateGbp(0.7993)->setExchangeRateUsd(1.3572);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::DOLLAR){
            $pmpc_commissionsCurrency->setExchangeRateUsd(1)->setExchangeRateGbp(0.5889)->setExchangeRateEur(0.7368);
        }elseif($pmpc_commissionsCurrency->getId()==CurrencyEnum::POUND_STERLING){
            $pmpc_commissionsCurrency->setExchangeRateGbp(1)->setExchangeRateEur(1.2511)->setExchangeRateUsd(1.6981);
        }

        $paymentFeeBean = new PaymentFeeBean(
            $paymentFeeBeanTotal,$paymentFeeBeanCurr, $paymentFeeBeanPercent,$paymentFeeBeanFixed,$paymentFeeBeanMin,$paymentFeeBeanExtra);

        $amountBean = new AmountBean(null,null,false,false,null,null,$vatAmountBean);

        $pmpc = $this->getPreparePayMethodProviderHasCountry(
            $pmpc_percent,
            $pmpc_commissionsCurrency,
            $pmpc_fixedFee,
            $pmpc_minimal,
            $pmpc_priceSentNet,
            $pmpc_feeCalculatedWithNet,
            $pmpc_country,
            $providerPaysVat
        );
        $purchase = $this->getMyPurchase(
            $purch_amountPaid,
            $purch_currency,
            $wolo_commissionBase,
            $wolo_commissionCurrency,
            $wolo_commissionPercent,
            $wolo_commissionFixedFee,
            $wolo_commissionMin,
            $wolo_commissionMax,
            $pmpc_country,
            $amountBean->vatAmount
        );


        $this->execute($purchase, $pmpc, $paymentFeeBean);

        $this->assertEquals($expectedAmountProvider, $purchase->getAmountProvider(), 'Amount Provider', 0.0001);
        $this->assertEquals($expectedTaxAmount, $purchase->getAmountTax(), 'Tax Amount', 0.0001);
        $this->assertEquals($expectedAmountWolo, $purchase->getAmountWolo(), 'Amount Wolo',0.0001);
        $this->assertEquals($expectedAmountGame,$purchase->getAmountGame(), 'Amount Game', 0.0001);
    }





    public function testsEUR()
    {
        /*
        $wolo_commissionFixedFee,
        $purch_amountPaid,$pmpc_percent,$wolo_commissionBase,
        Currency $purch_currency, Currency $wolo_commissionCurrency, Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat, $pmpc_country_vat_percent,
        $pmpc_fixedFee=0, $pmpc_minimal = 0, $pmpc_priceSentNet = false, $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0, $wolo_commissionMin=0, $wolo_commissionMax=0.10,
        $expectedAmountProvider=0, $expectedAmountWolo=0, $expectedAmountGame=0, $expectedTaxAmount=0
         */
                return array(
                    array(0.1,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 0,null, 0.1 ,0.69,0.1,7.47446280991736,1.73553719008264),
                    array(0.1,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 0,null,0.1,0.5,0.1,7.66446280991736,1.73553719008264),
                    array(0.1,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 0,null,0.1,1,0.1,7.16446280991736,1.73553719008264),
                    array(0.05,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 5,null,null,0.69,0.428723140495868,7.14573966942149,1.73553719008264),
                    array(0.05,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 5,null,null,0.5,0.438223140495868,7.32623966942149,1.73553719008264),
                    array(0.05,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 5,null,null,1,0.413223140495868,6.85123966942149,1.73553719008264),
                    array(0.05,10,3.4,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 5,null,null,0.69,0.55,7.02446280991736,1.73553719008264),
                    array(0.05,10,0,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 5,null,null,0.5,0.55,7.21446280991736,1.73553719008264),
                    array(0.05,10,0,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 5,null,null,1,0.55,6.71446280991736,1.73553719008264),

                    array(0.1,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,0,false,false, 0,null,0.1,0.69,0.1,9.21,0),
                    array(0.1,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.5,0,false,false, 0,null,0.1,0.5,0.1,9.4,0),
                    array(0.1,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,1,false,false, 0,null,0.1,1,0.1,8.9,0),
                    array(0.05,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,0,false,false, 5,null,null,0.69,0.5155,8.7945,0),
                    array(0.05,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.5,0,false,false, 5,null,null,0.5,0.525,8.975,0),
                    array(0.05,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,1,false,false, 5, null,null ,1,0.5,8.5,0),
                    array(0.05,10,3.4,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,0,false,false, 5,null,null,0.69,0.55,8.76,0),
                    array(0.05,10,0,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.5,0,false,false, 5,null,null,0.5,0.55,8.95,0),
                    array(0.05,10,0,CommissionBaseEnum::ENDUSERPRICE,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),0,0,0.35,1,false,false, 5,null,null,1,0.55,8.45,0)
                );
    }

    public function testsEUR_withPaymentBean(){
        /*
        $wolo_commissionFixedFee,
        $purch_amountPaid,$pmpc_percent,$wolo_commissionBase,
        Currency $purch_currency, Currency $wolo_commissionCurrency, Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat, $pmpc_country_vat_percent,
        $pmpc_fixedFee=0, $pmpc_minimal = 0, $pmpc_priceSentNet = false, $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0, $wolo_commissionMin=0, $wolo_commissionMax=0.10,
        $expectedAmountProvider=0, $expectedAmountWolo=0, $expectedAmountGame=0, $expectedTaxAmount=0
        $paymentFeeBeanTotal=0, $paymentFeeBeanPercent=0, $paymentFeeBeanFixed=0, $paymentFeeBeanMin=0,
        $paymentFeeBeanExtra=0, Currency $paymentFeeBeanCurr=null
         */

        return array(
            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,1.2,0.0706446280991736,6.99381818181818,1.73553719008264,0,0,0,1.2,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,1.2,0.0706446280991736,6.99381818181818,1.73553719008264,0,0,0,1.2,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,1.2,0.0706446280991736,6.99381818181818,1.73553719008264,0,0,0,1.2,0,new Currency('EUR')),

            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,0.44,0.0782446280991736,7.74621818181818,1.73553719008264,0,0,0.1,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,0.1,0.0816446280991736,8.08281818181818,1.73553719008264,0,0,0.1,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,1,0.0726446280991736,7.19181818181818,1.73553719008264,0,0,0.1,0,0,new Currency('EUR')),

            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,1.35,0.0691446280991736,6.84531818181818,1.73553719008264,0,10,0,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,1.5,0.0676446280991736,6.69681818181818,1.73553719008264,0,10,0,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,1.35,0.0691446280991736,6.84531818181818,1.73553719008264,0,10,0,0,0,new Currency('EUR')),

            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,1.4,0.0686446280991736,6.79581818181818,1.73553719008264,1.4,0,0,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,1.4,0.0686446280991736,6.79581818181818,1.73553719008264,1.4,0,0,0,0,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,1.4,0.0686446280991736,6.79581818181818,1.73553719008264,1.4,0,0,0,0,new Currency('EUR')),

            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,1.19,0.0707446280991736,7.00371818181818,1.73553719008264,0,0,0,0,0.5,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,1,0.0726446280991736,7.19181818181818,1.73553719008264,0,0,0,0,0.5,new Currency('EUR')),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,1.5,0.0676446280991736,6.69681818181818,1.73553719008264,0,0,0,0,0.5,new Currency('EUR')),

        );
}

    public function testsEUR_withPaymentAndAmountBean(){
        /*
        $wolo_commissionFixedFee,
        $purch_amountPaid,$pmpc_percent,$wolo_commissionBase,
        Currency $purch_currency, Currency $wolo_commissionCurrency, Currency $pmpc_commissionsCurrency,
        $pmpc_country_applies_vat, $pmpc_country_vat_percent,
        $pmpc_fixedFee=0, $pmpc_minimal = 0, $pmpc_priceSentNet = false, $pmpc_feeCalculatedWithNet = false,
        $wolo_commissionPercent=0, $wolo_commissionMin=0, $wolo_commissionMax=0.10,
        $expectedAmountProvider=0, $expectedAmountWolo=0, $expectedAmountGame=0, $expectedTaxAmount=0
        $paymentFeeBeanTotal=0, $paymentFeeBeanPercent=0, $paymentFeeBeanFixed=0, $paymentFeeBeanMin=0,
        $paymentFeeBeanExtra=0, Currency $paymentFeeBeanCurr=null,
        $vatAmountBean=null,
        providerpaysvat=false
         */

        return array(
            array(0,10,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.05,0.1,4.1755,0.058245,5.766255,0,4.1755,0,0.35,0,0,new Currency('EUR'),1.7355,true),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.05,0.1,4.1755,0.058245,5.766255,0,4.1755,0,0.5,0,0,new Currency('EUR'),1.7355,true),
            array(0,10,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.05,0.1,4.1755,0.058245,5.766255,0,4.1755,0,0.35,0,0,new Currency('EUR'),1.7355,true),
            array(0.1,40,3.4,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,0,false,false, 1,0.1,0.1,7.9421,0.1,31.9579,0,7.9421,0,0.35,0,0,new Currency('EUR'),6.9421,true),
            array(0.1,40,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.5,0,false,false, 1,0.1,0.1,7.9421,0.1,31.9579,0,7.9421,0,0.5,0,0,new Currency('EUR'),6.9421,true),
            array(0.1,40,0,CommissionBaseEnum::WOLOPAYNET,new Currency('EUR'),new Currency('EUR'),new Currency('EUR'),1,21,0.35,1,false,false, 1,0.1,0.1,7.9421,0.1,31.9579,0,7.9421,0,0.35,0,0,new Currency('EUR'),6.9421,true),

        );

    }

    private function execute($purchase, $pmpc, $paymentFeeBean)
    {
        $this->calculateFee->calculateByPurchase($purchase, $pmpc, $paymentFeeBean);
    }

    private function getPreparePayMethodProviderHasCountry(
        $percent,
        Currency $currency,
        $fixedFee = 0,
        $minimal = 0,
        $priceSentNet = false,
        $feeCalculatedWithNet = false,
        Country $country,
        $paysVat=false
    ) {
        $pmpc = new PayMethodProviderHasCountry();
        $provider = new Provider();
        $provider->setFreeVat($paysVat);

        $pmp  = new PayMethodHasProvider();
        $pmp
            ->setFeeProviderPercent($percent)
            ->setFeeProviderFixed($fixedFee)
            ->setFeeProviderMinimal($minimal)
            ->setPriceSentNet($priceSentNet)
            ->setFeeCalculatedWithNet($feeCalculatedWithNet)
            ->setFeeCurrency($currency)
            ->setProvider($provider)
        ;

        $pmpc
            ->setPayMethodHasProvider($pmp)
            ->setCountry($country)
        ;

        return $pmpc;
    }

    /**
     * @dataProvider additionProvider
     */
    private function getMyPurchase(
        $amountPaid,
        Currency $currencyPaid,
        $commissionBase,
        Currency $commissionCurrency,
        $commissionPercent,
        $commissionFixedFee,
        $commissionMin,
        $commissionMax,
        Country $country,
        $vatPaidByProvider=null
    ) {
        $app = new App();
        $app->setCommissionBase($commissionBase)
            ->setCommissionCurrency($commissionCurrency)
            ->setCommissionPercent($commissionPercent)
            ->setCommissionFixedFee($commissionFixedFee)
            ->setCommissionMin($commissionMin)
            ->setCommissionMax($commissionMax);

        $transaction = new Transaction();

        $transaction->setCountryDetected($country);

        $purchase = new Purchase();
        $purchase
            ->setApp($app)
            ->setAmountTotal($amountPaid)
            ->setCurrency($currencyPaid)
            ->setTransaction($transaction)
            ->setAmountTaxPaidByProvider($vatPaidByProvider)
        ;

        return $purchase;
    }


    public function testsGetAmountOffsetToTaxProvider()
    {
        return [
            'VAT_FROM_BUYER_COUNTRY_ID normal'  => [20, 50, 40],
            'VAT_FROM_BUYER_COUNTRY_ID another' => [7, 21, 8.86],
            'VAT_NONE_ID another'               => [7, 21, 7, VatCategoryEnum::NONE_ID],
        ];
    }

    /**
     * @dataProvider testsGetAmountOffsetToTaxProvider
     */
    public function testsGetAmountOffsetToTax(
        $amount,
        $vatPercent,
        $amountExpected,
        $vatCategoryId = VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID
    )
    {
        $currency = new Currency(CurrencyEnum::EURO);
        $currency->setDecimalPlaces(2);

        $country = new Country(CountryEnum::SPAIN);
        $country
            ->setVat($vatPercent)
            ->setVatCategory(new VatCategory($vatCategoryId))
            ->setCurrency($currency)
        ;

        $result = $this->calculateFee->getAmountOffsetToVat($amount, $currency, $country);

        $this->assertEquals($result, $amountExpected);
    }

}