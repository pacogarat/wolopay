<?php

namespace AppBundle\Form\Type\Api;

use AppBundle\Entity\App;
use AppBundle\Entity\Transaction;
use AppBundle\Form\DataTransformer\AppTabCSVTransformer;
use AppBundle\Form\DataTransformer\AppTabTransformer;
use AppBundle\Form\DataTransformer\ArrayIdsToCSVGenericTransformer;
use AppBundle\Form\DataTransformer\BooleanToStringViewTransformer;
use AppBundle\Form\DataTransformer\GamerExternalIdToStringCreateIfNotExistTransformer;
use AppBundle\Form\DataTransformer\IdToStringGenericTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class TransactionApiType extends AbstractApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
         * @RequestParam(name="gamer_id", nullable=false, description="Id of your user")
        * @RequestParam(name="gamer_level", requirements="\d+", default="5", description="Gamer level from your game")
        * @RequestParam(name="gamer_email", requirements="^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$", nullable=true, description="Some pay methods need email")
        * @RequestParam(name="default_language", nullable=true, description="Default language, http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes 2 letters")
        * @RequestParam(name="countries", nullable=true, description="Countries available CSV format, http://en.wikipedia.org/wiki/ISO_3166-1")
        * @RequestParam(name="fixed_country", default="1", description="Fix country by ip boolean, values 0, 1")
        * @RequestParam(name="tab_category_ids", nullable=true, description="Tab categories")
        * @RequestParam(name="theme", nullable=true, description="Theme")
        * @RequestParam(name="articles", nullable=true, description="Articles Available CSV Format")
        * @RequestParam(name="selected_article_id", nullable=true, description="Article is preselected")
        * @RequestParam(name="selected_tab_category_id", nullable=true, description="Preselect article tab method")
        * @RequestParam(name="pay_methods", nullable=true, description="Filter pay methods available CSV format see the doc to verify each id provider")
        * @RequestParam(name="custom_param", nullable=true, description="Custom param for each payment notification")
        * @RequestParam(name="return", nullable=true, description="When gamer finish his purchase, you can show your own custom page")
        * @RequestParam(name="tutorial_enabled", nullable=true, description="Tutorial enabled")
        * @RequestParam(name="test", default=false, description="If it`s enabled this transaction won't appear in admin section")

         */

        $builder
            ->add('gamer_id', TextType::class, ['property_path' => 'gamer', 'required' => true, 'description' => 'Id of your user'])
            ->add('gamer_level', null, ['property_path' => 'valueCurrent', 'data' => 5, 'empty_data' => 5, 'required' => false, 'description' => 'Gamer level from your gamer, default: 5'])
            ->add('gamer_email', TextType::class, ['mapped' => false, 'constraints' => new Email(), 'required' => false, 'description' => 'Some pay methods need email'])
            ->add('default_language', TextType::class, ['property_path' => 'languageDefault', 'required' => false, 'description' => 'Default language, http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes 2 letters'])
            ->add('fixed_country', CheckboxType::class,  ['property_path' => 'fixedCountry', 'required'=>false, 'empty_data' => true, 'description' => 'Fixed country by ip boolean, values 0, 1, default: 1'])
            ->add('fixed_language', CheckboxType::class,  ['property_path' => 'fixedLanguage', 'required'=>false, 'empty_data' => false, 'description' => 'Fixed country by ip boolean, values 0, 1'])
            ->add('countries', TextType::class, ['property_path' => 'countriesAvailable', 'required' => false, 'description' => 'Countries available CSV format, http://en.wikipedia.org/wiki/ISO_3166-1'])
            ->add('tab_categories', TextType::class, ['property_path' => 'appTabsAvailable', 'required' => false, 'description' => 'Tab categories'])
            ->add('theme', TextType::class, ['property_path' => 'css', 'required' => false, 'description' => 'Theme'])
            ->add('articles', TextType::class, ['property_path' => 'articlesAvailable', 'required' => false, 'description' => 'Articles Available CSV Format'])
            ->add('selected_article_id', TextType::class, ['property_path' => 'selectedArticle', 'required' => false, 'description' => 'Article is preselected'])
            ->add('selected_tab_category_id', TextType::class, ['property_path' => 'selectedAppTab', 'required' => false, 'description' => 'Preselect article tab method'])
            ->add('pay_methods', TextType::class, ['property_path' => 'payMethodsAvailable', 'required' => false, 'description' => 'Filter pay methods available CSV format see the doc to verify each id provider'])
            ->add('custom_param', TextType::class, ['property_path' => 'customParam', 'required' => false, 'description' => 'Custom param for each payment notification'])
            ->add('return', UrlType::class , [ 'required' => false, 'description' => 'When gamer finish his purchase, you can show your own custom page'])
            ->add('url_notification', TextType::class , [ 'property_path' => 'urlNotification', 'required' => false, 'description' => 'Override App url notification, if you want to add extra params use custom_param'])
            ->add('tutorial_enabled', CheckboxType::class, ['required'=> false, 'property_path' => 'tutorialEnabled', 'description' => 'Tutorial enabled'])
            ->add('first_pay_methods', CheckboxType::class, ['required'=> false, 'property_path' => 'firstPayMethods', 'description' => 'Switch payment order to choose payMethod  in first step and after choose product'])
            ->add('external_store', TextType::class, ['required'=> false, 'property_path' => 'externalStore', 'description' => 'External store like Facebook'])
            ->add('test', CheckboxType::class, ['required' => false, 'description' => 'If it`s enabled this transaction won\'t appear in admin section'])

            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $gamer_email = $event->getForm()->get('gamer_email')->getData();

                /** @var Transaction $transaction */
                $transaction = $event->getData();
                if ($gamer_email && $transaction->getGamer())
                {
                    $transaction->getGamer()->setEmail($gamer_email);
                }

            });


        ;

        if ($options['em'] && $options['app'] )
        {
            /** @var App $app */
            $app = $options['app'];
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $options['em'];

            $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($app) {
                /** @var Transaction $transaction */
                $transaction = $event->getData();
                $transaction->setApp($app);
                $transaction->setApiCrendetials($app->getAppApiHasCredential());
            });

            // Transformations o_O
            $builder->get('gamer_id')->addModelTransformer(new GamerExternalIdToStringCreateIfNotExistTransformer($em, $app));
            $builder->get('default_language')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Language'));
            $builder->get('countries')->addModelTransformer(new ArrayIdsToCSVGenericTransformer($em, 'AppBundle:Country'));

            $builder->get('theme')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:ShopCss', 'name'));
            $builder->get('articles')->addModelTransformer(new ArrayIdsToCSVGenericTransformer($em, 'AppBundle:Article'));
            $builder->get('selected_article_id')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Article'));

            $builder->get('tab_categories')->addModelTransformer(new AppTabCSVTransformer($app, $em));
            $builder->get('selected_tab_category_id')->addModelTransformer(new AppTabTransformer($app, $em));

            $builder->get('pay_methods')->addModelTransformer(new ArrayIdsToCSVGenericTransformer($em, 'AppBundle:PayMethod'));

            $builder->get('test')->addViewTransformer(new BooleanToStringViewTransformer());
            $builder->get('tutorial_enabled')->addViewTransformer(new BooleanToStringViewTransformer());
            $builder->get('first_pay_methods')->addViewTransformer(new BooleanToStringViewTransformer());
            $builder->get('fixed_country')->addViewTransformer(new BooleanToStringViewTransformer());
            $builder->get('fixed_language')->addViewTransformer(new BooleanToStringViewTransformer());

        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Transaction',
                'em' => null,
                'app' => null
            ))
            ->setAllowedTypes('em', ['Doctrine\Common\Persistence\ObjectManager', 'null'])
            ->setAllowedTypes('app', ['AppBundle\Entity\App', 'null'])
        ;

        parent::configureOptions($resolver);
    }

}
