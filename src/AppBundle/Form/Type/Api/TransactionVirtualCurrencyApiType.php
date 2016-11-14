<?php

namespace AppBundle\Form\Type\Api;


use AppBundle\Entity\App;
use AppBundle\Entity\Transaction;
use AppBundle\Form\DataTransformer\BooleanToStringViewTransformer;
use AppBundle\Form\DataTransformer\GamerExternalIdToStringCreateIfNotExistTransformer;
use AppBundle\Form\DataTransformer\IdToStringGenericTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class TransactionVirtualCurrencyApiType extends AbstractApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gamer_id', TextType::class, ['property_path' => 'gamer', 'description' => 'Id of your user'])
            ->add('article_id', TextType::class, ['property_path' => 'articleVirtualCurrency', 'description' => 'Article Id', 'constraints' => new NotNull()])
            ->add('country', TextType::class, ['property_path' => 'countryVirtualCurrency', 'description' => 'Country shop', 'constraints' => new NotNull()])
            ->add('gamer_level', null, ['property_path' => 'valueCurrent', 'data' => 5, 'empty_data' => 5, 'description' => 'Gamer level from your gamer, default: 5'])
            ->add('gamer_ip', TextType::class, ['mapped'=>false, 'description' => 'IP from your gamer, default: null',  'empty_data' => 'N/A', 'data'=>'', 'required' => false])
            ->add('gamer_country', TextType::class, ['property_path' => 'countryDetected', 'description' => 'country from your gamer -even if same than IP\'s, default: null'])
            ->add('custom_param', TextType::class, ['property_path' => 'customParam', 'required' => false, 'description' => 'Custom param for each payment notification'])
            ->add('test', null, ['required' => false, 'empty_data' => false, 'description' => 'If it`s enabled this transaction won\'t appear in admin section'])
            ->add('url_notification', TextType::class , [ 'property_path' => 'urlNotification', 'required' => false, 'description' => 'Override App url notification, if you want to add extra params use custom_param'])
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options) {

                    /** @var Transaction $transaction */
                $transaction = $event->getData();
                if ($options['em'] && $options['app'] )
                {
                    /** @var \Doctrine\ORM\EntityManager $em */
                    $em = $options['em'];

                    $transaction
                        ->setApp($options['app'])
                        ->setApiCrendetials($options['app']->getAppApiHasCredential())
                    ;

                }
            })
        ;

        if ($options['em'] && $options['app'] )
        {
            /** @var App $app */
            $app = $options['app'];
            /** @var \Doctrine\ORM\EntityManager $em */
            $em = $options['em'];

            $builder->get('gamer_id')->addModelTransformer(new GamerExternalIdToStringCreateIfNotExistTransformer($em, $app));
            $builder->get('article_id')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Article'));
            $builder->get('country')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Country'));
            $builder->get('gamer_country')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Country'));
            $builder->get('test')->addViewTransformer(new BooleanToStringViewTransformer());
        }

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Transaction',
                'em' => null,
                'app' => null,
                'countryService' => null
            ))
            ->setAllowedTypes('em', ['Doctrine\Common\Persistence\ObjectManager', 'null']) // null for apidoc
            ->setAllowedTypes('app', ['AppBundle\Entity\App', 'null']) // null for apidoc
        ;

        parent::configureOptions($resolver);
    }

}
