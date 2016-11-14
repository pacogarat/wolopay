<?php


namespace AppBundle\Command;

use AppBundle\Entity\Country;
use AppBundle\Entity\Currency;
use AppBundle\Entity\Enum\ArticleCategoryEnum;
use AppBundle\Entity\Enum\CountryEnum;
use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Enum\PayCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use AppBundle\Entity\Enum\SMSLogicCategoryEnum;
use AppBundle\Entity\PayMethodProviderHasCountry;
use AppBundle\Entity\SMS;
use AppBundle\Service\CurrencyService;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Lexik\Bundle\TranslationBundle\Manager\TransUnitManager;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Translation\Translator;


/**
 * @Service("command.fortuno_sync")
 * @Tag("console.command")
 */
class FortunoSyncCommand extends Command
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
     * @Inject("translator")
     * @var Translator
     */
    public $translator;

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

    public $SKIP_COUNTRIES = ['CZ', 'FR', 'ES'];

    //const URL_SING_UP_TRANSLATIONS = 'https://developers.fortumo.com/country-details/';
    //const URL_SING_UP_TRANSLATIONS = 'https://developers.fortumo.com/going-live/country-regulations/';
    const URL_SING_UP_TRANSLATIONS = 'https://docs.google.com/spreadsheets/d/1Aulo0Bx_9rmco4UlZkNkk27Ef8GCBgPGAUqLS5yjqjk/pubhtml/sheet?headers=false&gid=1487816497';

    const URL_API_XML = 'https://api.fortumo.com/api/services/2/';
    public $SERVICES_IDS = ['72914db1c38a93d49a29d18d87f95e39.c250f1f0a884ca9d585db2c84335bc91',
                            '0c62d67b99c059bc373dac101ec5af65.c250f1f0a884ca9d585db2c84335bc91',
                            '9ac08658361a0d6364e3e3afa2faf5ec.c250f1f0a884ca9d585db2c84335bc91',
                            'c49fca034360f49ea70abcfb6f298274.c250f1f0a884ca9d585db2c84335bc91',
                            'a8f3b0e687d69c4e27bbf47c7fe7f2e4.c250f1f0a884ca9d585db2c84335bc91',
        '8bb78ced8ec7df8fca1addd0aa6a5659.c250f1f0a884ca9d585db2c84335bc91'
    ];

    /**
     * @var []
     */
    public $smsInserted=[];

    protected function configure()
    {
        $this
            ->setName('fortuno:paymethods:sync')
            ->setDescription('Syncronize prices and legal text ...')
        ;
    }

    private function getXmlFromApi($service_id)
    {
        $url = static::URL_API_XML . $service_id . ".xml";
        return simplexml_load_file($url);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Exception
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->SERVICES_IDS as $service_id) {
            $this->writeCLI("Processing $service_id", $output);
            $this->syncPrices($this->getXmlFromApi($service_id), $input, $output);
        }
        $this->syncSingUpTextMessages($str = file_get_contents(static::URL_SING_UP_TRANSLATIONS), $input, $output);
        $this->translator->removeLocalesCacheFiles($this->localeAvailable);
    }

    private function writeCLI($msg, OutputInterface $output=null)
    {
        if ($output)
            $output->writeln($msg);
    }

    public function syncSingUpTextMessages($html, InputInterface $input=null, OutputInterface $output=null)
    {
        $crawler = new Crawler($html);

        $table = $crawler->filterXPath('//body/div/div/div/table/tbody/*');

        $isRightColumn=false;
        /** @var \DOMElement $tr */
        foreach ($table as $tr)
        {
            $tds=$tr->childNodes;

            $countryNameTable= trim($tds->item(1)->nodeValue);
//            $this->writeCLI("DVD Country = $countryNameTable ", $output);

            $messageText= trim($tds->item(6)->nodeValue);
            $messageText = str_replace(['[Add your support contact here]', '[Add the price here]', ' [Add the item/service name here]'],
                                        [ $this->emailInfo, '{[{amount}]}', ' '], $messageText);

            if ($messageText=='Example reply message format')
            {
                $isRightColumn=true;
                continue;
            }

            if (!$isRightColumn)
                continue;

//            $this->writeCLI("DVD MT = $messageText ", $output);

            $translationLoaded = false;

            /** @var SMS[] $objs */
            foreach ($this->smsInserted as $countryName => $objs)
            {
                if ($countryName != $countryNameTable)
                    continue;

                $translationKey = 'sms.mobile_text_sing_up.fortuno_'.strtolower(str_replace(' ','_',$countryName));

                $languageId = $objs[0]->getPayMethodProviderHasCountry()->getCountry()->getLanguage()->getId();

                if (!$transunit = $this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['key' => $translationKey]))
                {
                    $transunit=$this->transUnitManager->create($translationKey, 'sms');

                    if (in_array($languageId, $this->localeAvailable))
                        $this->transUnitManager->addTranslation($transunit, $languageId, $messageText);

                    $this->transUnitManager->addTranslation($transunit, 'en', $messageText);
                }else{
                    if (in_array($languageId, $this->localeAvailable))
                        $this->transUnitManager->updateTranslation($transunit, $languageId, $messageText);

                    $this->transUnitManager->updateTranslation($transunit, 'en', $messageText);
                }

                $this->em->flush();
                foreach ($objs as $obj)
                {
                    $obj->setMobileTextSingUpLabel($transunit);
                }
                $translationLoaded = true;
                break;
            }
            if (!$translationLoaded) $this->logger->addDebug("Translations not loaded by country $countryNameTable");
        }

        if (!$isRightColumn)
            $this->logger->addCritical("Invalid translations column see external web modifications on: ". static::URL_SING_UP_TRANSLATIONS);

        $this->em->flush();
    }

    public function syncPrices($xml, InputInterface $input=null, OutputInterface $output=null)
    {
        if(!$providerFortuno = $this->em->getRepository("AppBundle:Provider")->findOneBy(['name' => 'Fortuno']))
            throw new \Exception("Didn't find 'Fortuno' provider ");

        $enLang = $this->em->getRepository("AppBundle:Language")->find(LanguageEnum::ENGLISH);

        foreach ($xml->service->countries->country as $countryXml)
        {
            $countryId     = (string) $countryXml['code'];
            $countryActive = ($countryXml['approved'] == 'true' ? true : false);
            $countryName   = (string) $countryXml['name'];
            $vat           = (string) $countryXml['vat']; // not used

            $priceXml     =  $countryXml->prices->price;
            $price        = floatval((string) $priceXml['amount']);
            $currencyId   = (string) $priceXml['currency'];

            if (in_array($countryId, $this->SKIP_COUNTRIES))
            {
                $this->writeCLI("$countryId was used by nvia \n", $output);
                continue;
            }

            if (!$currencyId){
                $this->writeCLI("Empty Currency in country $countryName (pricePoint $priceXml, price $price) \n", $output);
                continue;
            }

            $mcc = $priceXml->message_profile->operator[0]->codes->code[0]['mcc'];
            if (!$mcc)
                $mcc=0;

            if (!$currency = $this->em->getRepository("AppBundle:Currency")->find($currencyId))
                throw new \Exception("Unknown currency: $currencyId");

            if (!$country = $this->em->getRepository("AppBundle:Country")->find($countryId))
            {
                $country = new Country($countryId);
                $country
                    ->setName($countryName)
                    ->setCurrency($currency)
                    ->setLanguage($enLang)
                    ->setVat($vat)
                    ->setMCC($mcc)
                ;

                $this->logger->addAlert("Auto inserted country $countryId with language EN verify it");

                $this->em->persist($country);
                $this->em->flush();
            }

            if (!$countryActive)
            {
                $this->writeCLI("This country: $countryId is inactive", $output);
                continue;
            }

            $messageProfileXML = $priceXml->message_profile;
            $shortCode = $messageProfileXML['shortcode'];
            $alias     = $messageProfileXML['keyword'];

            $legalTextXML=$countryXml->promotional_text;

            $legalTextLocal = $legalTextXML->local;
            $legalTextEnglish = ($legalTextXML->english ? $legalTextXML->english : $legalTextXML->local);

            $keyTranslation = 'sms.legal_text.fortune_'.$shortCode;

            $languageId=$country->getLanguage()->getId();

            if (!$transunit = $this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['key' => $keyTranslation]))
            {
                $transunit=$this->transUnitManager->create($keyTranslation, 'sms');
                if (in_array($languageId, $this->localeAvailable))
                    $this->transUnitManager->addTranslation($transunit, $languageId, $legalTextLocal);

                $this->transUnitManager->addTranslation($transunit, 'en', $legalTextEnglish);

            }else{

                if (in_array($languageId, $this->localeAvailable))
                    $this->transUnitManager->updateTranslation($transunit, $languageId, $legalTextLocal);

                $this->transUnitManager->updateTranslation($transunit, 'en', $legalTextEnglish);
            }

            foreach ($messageProfileXML->operator as $operator)
            {
                $operatorName = $operator['code'];
                $revenue = floatval($operator['revenue']);

                if (!$operator = $this->em->getRepository("AppBundle:SMSOperator")->findOneByLikeNameAndCountry("$operatorName", $countryId)) {
                    //throw new \Exception("operator name '$operatorName' to country '$countryId' doesn't exist");
                    $this->writeCLI("WARNING: operator name '$operatorName' to country '$countryId'", $output);
                    continue;
                }

                if ($smsXs = $this->em->getRepository("AppBundle:SMS")->findByCountryIdAndOperatorId($countryId, $operator->getId()))
                {
                    $smsX = $smsXs[0];
                    if ($countryId != CountryEnum::SPAIN && $smsX->getPayMethodProviderHasCountry()->getProvider()->getName() == 'Nvia')
                    {
                        $this->writeCLI("$countryId ".$operator->getShortName(). " was used by nvia \n", $output);
                        continue;
                    }
                }
//                echo "OperatorName: $operatorName, Revenue: $revenue\n";

                $sms = $this->em->getRepository("AppBundle:SMS")->findOneByAliasAndCountryAndSmsShortCodeAndOperatorShortName(
                    $alias, $countryId, $shortCode, $operator->getShortName()
                );

                if (!$sms)
                {
                    $pmpc = $this->em->getRepository("AppBundle:PayMethodProviderHasCountry")->findOneByPayMethodNameAndProviderIdAndCountryId(
                        PayMethodEnum::SMS_NAME, PayCategoryEnum::MOBILE_ID, ArticleCategoryEnum::SINGLE_PAYMENT_ID, $providerFortuno->getId(), $countryId
                    );

                    if (!$pmpc)
                    {
                        $pmps = $this->em->getRepository("AppBundle:PayMethodHasProvider")->findByPayCategoryIdAndArticleCategoryIdAndProvider(
                            PayCategoryEnum::MOBILE_ID, ArticleCategoryEnum::SINGLE_PAYMENT_ID, $providerFortuno->getId()
                        );

                        $pmp = $pmps[0];

                        $pmpc = new PayMethodProviderHasCountry();
                        $pmpc
                            ->setPayMethodHasProvider($pmp)
                            ->setCountry($country)
                            ->setCurrency($currency)
                        ;

                        $this->writeCLI("new PMP $countryId $currencyId", $output);
                    }

                    $this->em->persist($pmpc);
                    $this->em->flush();

                    $sms = new SMS();
                    $sms
                        ->setSmsLogicCategory($this->em->getRepository("AppBundle:SMSLogicCategory")->find(SMSLogicCategoryEnum::MO_AND_MT_AND_CODE))
                        ->setMobileTextSingUpLabel($this->em->getRepository("LexikTranslationBundle:TransUnit")->findOneBy(['key' => 'sms.mobile_text_sing_up.write_pin']))
                        ->setPayMethodProviderHasCountry($pmpc)
                        ->setOperator($operator)
                    ;

                    $pmpc
                        ->addSMS($sms)
                        ->setFeeProviderPercent(round($revenue*100/$price))
                    ;
                }else{
                    $pmpc = $sms->getPayMethodProviderHasCountry();
                }

                $sms
                    ->setAliasDefault($alias)
                    ->setAmount($price)
                    ->setLegalTextLabel($transunit)
                    ->setPayMethodProviderHasCountry($pmpc)
                    ->setShortNumber($shortCode)
                ;

                $this->writeCLI("Created/Updated $shortCode $countryId ".$operator->getName(), $output);

                $this->em->persist($pmpc);
                $this->em->persist($sms);
                $this->em->flush();

                $this->smsInserted[$countryName][]=$sms;

            }
        }
    }

}
