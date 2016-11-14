<?php


namespace AppBundle\Command;

use AppBundle\Entity\Country;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use AppBundle\Entity\PayMethod;
use AppBundle\Entity\PayMethodHasProvider;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\CurrencyService;
use Application\Sonata\MediaBundle\Entity\Media;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Lexik\Bundle\TranslationBundle\Manager\TransUnitManager;
use Monolog\Logger;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * @Service("command.xsolla_sync")
 * @Tag("console.command")
 */
class XsollaSyncCommand extends Command
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /**
     * @Inject("command.currency_exchange")
     * @var CurrencyService
     */
    public $currencyService;

    /**
     * @Inject("lexik_translation.trans_unit.manager")
     * @var TransUnitManager
     */
    public $transUnitManager;

    /**
     * @Inject("sonata.media.manager.media")
     * @var MediaManager
     */
    public $mediaManager;

    /**
     * @Inject("%locale_available%")
     * @var []
     */
    public $localeAvailable;

    /**
     * @Inject("%email_info_wolopay%")
     * @var String
     */
    public $emailInfo;

    public $SKIP_COUNTRIES = ['CZ', 'FR'];

    const URL_SING_UP_TRANSLATIONS = 'https://developers.fortumo.com/country-details/';

    /**
     * @var []
     */
    public $smsInserted=[];

    protected function configure()
    {
        $this
            ->setName('xsolla:paymethods:sync')
            ->setDescription('Syncronize PayMethodHasProviders ...')
            ->addArgument('n_pay_methods', InputArgument::OPTIONAL, 'Number of PayMethods', 10)
            ->addArgument('countries', InputArgument::IS_ARRAY, 'Countries', [
                    'ALL_COUNTRIES'
                ])
        ;
    }

    private function getWebPage($countryId, $nPayMethods)
    {
        return file_get_contents("https://secure.xsolla.com/paystation2/?marketplace=paydesk&project=4783&v1=XsollaUser&v2=&v3=&out=$nPayMethods&currency=&email=support%40xsolla.com&phone=&hidden=out%2Cv1%2Ccurrency&local=&country=$countryId&pid=26&theme=115");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $countries = $input->getArgument('countries');
        if ($countries[0]=="ALL_COUNTRIES"){
            $country_list = $this->em->getRepository("AppBundle:Country")->findAll();
            $arr_countries = UtilHelper::getIdsArrayFromObjects($country_list);
        }else{
            $arr_countries = $countries;
        }
        $nPayMethods = $input->getArgument('n_pay_methods');

        $output->writeln("Starting process of ". count($arr_countries)  ." countries ");
        foreach ($arr_countries  as $countryId)
        {
            if ($countryId=="DF") continue;
            if ($countryId=="A1") continue;
            if (($countryId[0]=="X")) continue;

            $output->writeln("Starting process of country ". $countryId );
            $result = $this->sync($this->getWebPage($countryId, $nPayMethods), $countryId, $output);

            foreach ($result as $pmpc)
                $output->writeln("Created ".$pmpc->getPayMethod()->getName());
        }
        $output->writeln("End process of ". count($arr_countries)  ." countries ");

    }

    /**
     * @param $html
     * @param $countryId
     * @param OutputInterface $output
     * @return PayMethodProviderHasCountry[]
     */
    public function sync($html, $countryId, OutputInterface $output)
    {
        preg_match('/var recommendedListData.*?\=(.*);/', $html, $matches);
        $recommendedList = json_decode($matches[1]);
        $added = [];

        $xsollaProvider = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name'=>'Xsolla']);

        $lap=0;
        foreach ($recommendedList->instances as $payMethodHtml)
        {
            $lap++;

            $invalidate = [
                'Visa',
                'Visa / Mastercard',
                'Paypal',
                'PaySafe',
                'Ukash',
                'Rixty',
                'Mobile payment',
                'NETELLER'.
                'Skrill',
                'Maestro',
                'JCB',
                'UnionPay',
                'Mastercard'
            ];

            $output->writeln("Starting to process: ". $payMethodHtml->name);

            if ( $this->existInArray($invalidate, $payMethodHtml->name))
                continue;


            // 1 Cash payments
            // 2 online payments
            // 4=mobile
            // 7 Credit card
            // 5 prepaid
            if (in_array("4", $payMethodHtml->cat)) {
                $output->writeln("Skipping " . $payMethodHtml->name . " for being mobile");
                continue;
            }


            $type = $payMethodHtml->cat[0];

            if ($type === 0)
                $type = $payMethodHtml->cat[1];

            $payCategoryId = $articleCategoryId = null;

            switch ($type){
                case 4:
                case 1:
                    $payCategoryId = PayCategoryEnum::CASH_ID;
                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
                    break;
                case 2:
                    $payCategoryId = PayCategoryEnum::PROVIDER_METHOD_ID;
                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
                    break;
                case 3:
                    $payCategoryId = PayCategoryEnum::BANK_TRANSFER_ID;
                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
                    break;
//                case 4:
//                    $payCategoryId = PayCategoryEnum::MOBILE_ID;
//                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
//                    break;
                case 7:
                    $payCategoryId = PayCategoryEnum::CREDIT_CARD_ID;
                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
                    break;
                case 5:
                    $payCategoryId = PayCategoryEnum::PREPAID_CARD_ID;
                    $articleCategoryId = ArticleCategoryEnum::SINGLE_PAYMENT_ID;
                    break;
                default:
                    $this->logger->addError("Unknown payment category xsolla $type, ".$payMethodHtml->name);
                    break;
            }

            if (!$payCategoryId){
                $output->writeln("Skipping " . $payMethodHtml->name . ": category error");
                continue;
            }


            $payMethod=$this->em->getRepository("AppBundle:PayMethod")->findOneBy(['name'=>$payMethodHtml->name]);

            if ($payMethod && ($pmpc=$this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->
            findOneByPayMethodIdAndProviderIdAndCountryId($payMethod->getId(),$xsollaProvider->getId(),$countryId))){
                $output->writeln("Skipping " . $payMethodHtml->name . ": pmpc already exists;" .
                    "id=". $pmpc->getId()
                );
                continue;
            }

            if (!$payMethod) {
                $media = new Media();

                $fileTemp = sys_get_temp_dir() . '/file_' . rand(1, 9999) . '.png';
                copy('' . $payMethodHtml->imgUrl, $fileTemp);
                $media->setBinaryContent($fileTemp);
                $media->setContext(PayMethod::SONATA_CONTEXT);
                $media->setProviderName('sonata.media.provider.image');
                $this->mediaManager->save($media, false);

                // echo $payMethod->name." ".$type."\n";
                $payMethod = new PayMethod();
                $payMethod
                    ->setName($payMethodHtml->name)
                    ->setPayCategory($this->em->getRepository("AppBundle:PayCategory")->find($payCategoryId))
                    ->setArticleCategory($this->em->getRepository("AppBundle:ArticleCategory")->find($articleCategoryId))
                    ->setImgIcon($media);

                $this->em->persist($payMethod);
                $this->em->flush();
            }

            $pmp = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findOneByPayMethodIdAndProviderId($payMethod->getId(),$xsollaProvider->getId());
            if (!$pmp)
            {
                //pmp
                $pmp= new PayMethodHasProvider();
                $pmp
                    ->setPayMethod($payMethod)
                    ->setProvider($xsollaProvider)
//                    ->setFeeProviderPercent(0) //Unknown
                    ->setOrder($lap)
                    ->setExtraOptions(['external_provider_id' => $payMethodHtml->id])
                    ->setPaymentServiceCategory(
                        $this->em->getRepository("AppBundle:PaymentServiceCategory")->find(PaymentServiceCategoryEnum::XSOLLA_IPN)
                    )
                ;

                $this->em->persist($pmp);
                $this->em->flush();
            }

            $country = $this->em->getRepository("AppBundle:Country")->find($countryId);

            if (!$this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodIdAndProviderIdAndCountryId(
                $payMethod->getId(),
                $xsollaProvider->getId(),
                $countryId
            )){
                $pmpc= new PayMethodProviderHasCountry();
                $pmpc
                    ->setPayMethodHasProvider($pmp)
                    ->setCountry($country)
                    // I assume that if they are the best paymethods for this country he must accept his local currency
                    ->setCurrency($country->getCurrency())
                    ->setDefault(true)
                ;

                $this->em->persist($pmpc);
                $this->em->flush();

                $added[]=$pmpc;
            }



        }

        return $added;
    }

    private function existInArray(array $array, $searchIn)
    {
        foreach ($array as $str)
        {
            if (preg_match ("#$str#i", $searchIn))
                return true;
        }
        return false;
    }

    private function writeCLI($msg, OutputInterface $output=null)
    {
        if ($output)
            $output->writeln($msg);
    }

}
