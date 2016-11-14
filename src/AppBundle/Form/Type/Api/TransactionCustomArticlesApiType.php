<?php

namespace AppBundle\Form\Type\Api;


use AppBundle\Entity\App;
use AppBundle\Entity\Transaction;
use AppBundle\Form\DataTransformer\ArrayIdsToCSVGenericTransformer;
use AppBundle\Form\DataTransformer\BooleanToStringViewTransformer;
use AppBundle\Form\DataTransformer\GamerExternalIdToStringCreateIfNotExistTransformer;
use AppBundle\Form\DataTransformer\IdToStringGenericTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class TransactionCustomArticlesApiType extends AbstractApiType
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
        * @RequestParam(name="country", nullable=false, description="Country")
        * @RequestParam(name="pay_method_id", nullable=false, description="Pay method, Only single pay methods see docs")
        * @RequestParam(name="articles", nullable=false, description="Comma separated list of article ids (no spaces)")
        * @RequestParam(name="gamer_email", nullable=true, description="Email of your user. Some payment methods ask for it")
        * @RequestParam(name="custom_param", nullable=true, description="Custom param for each payment notification")
        * @RequestParam(name="url_notification", nullable=true, description="Url to notify payments (to override configured one)")
        * @RequestParam(name="test", default=false, description="If it`s enabled this transaction won't appear in admin section")
        */

        $builder
            ->add('gamer_id', TextType::class, ['property_path' => 'gamer', 'required' => true, 'description' => 'Id of your user'])
            ->add('gamer_level', null, ['property_path' => 'valueCurrent', 'data' => 5, 'empty_data' => 5, 'required' => false, 'description' => 'Gamer level from your gamer, default: 5'])
            ->add('country', null, ['property_path' => 'customCountry', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Country'])
            ->add('pay_method_id', null, ['property_path' => 'customPayMethod', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Pay method, See direct payment valid'])
            ->add('articles', TextType::class, ['mapped' => false, 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Comma separated list of article ids'])
            ->add('gamer_email', TextType::class, ['mapped' => false, 'constraints' => new Email(), 'required' => false, 'description' => 'Some pay methods need email'])
            ->add('custom_param', null, ['property_path' => 'customParam', 'required' => false, 'description' => 'Custom param for each payment notification'])
            ->add('url_notification', TextType::class , [ 'property_path' => 'urlNotification', 'required' => false, 'description' => 'Override App url notification, if you want to add extra params use custom_param'])
            ->add('test', null, ['property_path' => 'test', 'required' => false, 'description' => 'If it`s enabled this transaction won\'t appear in admin section'])
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

            $builder->get('gamer_id')->addModelTransformer(new GamerExternalIdToStringCreateIfNotExistTransformer($em, $app));
            $builder->get('country')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Country'));
            $builder->get('pay_method_id')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:PayMethod'));
            //$builder->get('articles')->addModelTransformer(new ArrayIdsToCSVGenericTransformer($em, 'AppBundle:Article'));
            $builder->get('test')->addViewTransformer(new BooleanToStringViewTransformer());
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
