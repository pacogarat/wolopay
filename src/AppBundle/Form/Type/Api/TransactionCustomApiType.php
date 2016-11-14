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
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class TransactionCustomApiType extends AbstractApiType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
        * @RequestParam(name="gamer_id", nullable=false, description="Id of your user")
        * @RequestParam(name="country", nullable=false, description="Country")
        * @RequestParam(name="amount", nullable=false,description="Amount")
        * @RequestParam(name="currency", nullable=false,description="Currency")
        * @RequestParam(name="pay_method_id", nullable=false, description="Pay method, Only single pay methods see docs")
        * @RequestParam(name="article_title", description="Article title")
        * @RequestParam(name="article_description", description="Article Description")
        * @RequestParam(name="custom_param", nullable=true, description="Custom param for each payment notification")
        * @RequestParam(name="url_notification", nullable=true, description="Url to notify payments (to override configured one)")
        * @RequestParam(name="test", default=false, description="If it`s enabled this transaction won't appear in admin section")
        */

        $builder
            ->add('gamer_id', TextType::class, ['property_path' => 'gamer', 'required' => true, 'description' => 'Id of your user'])
            ->add('gamer_email', TextType::class, ['mapped' => false, 'constraints' => new Email(), 'required' => false, 'description' => 'Some pay methods need email'])
            ->add('country', null, ['property_path' => 'customCountry', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Country'])
            ->add('amount', null, ['property_path' => 'customAmount', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Amount'])
            ->add('currency', TextType::class, ['property_path' => 'customCurrency', 'required' => true, 'constraints' => new NotBlank(),'description' => 'Currency'])
            ->add('pay_method_id', null, ['property_path' => 'customPayMethod', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Pay method, See direct payment valid'])
            ->add('article_title', null, ['property_path' => 'customArticleTitle', 'required' => true, 'constraints' => new NotBlank(), 'description' => 'Article title'])
            ->add('article_description', null, ['property_path' => 'customArticleDescription', 'required' => false, 'description' => 'Article Description'])
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
            $builder->get('currency')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Currency'));
            $builder->get('country')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:Country'));
            $builder->get('pay_method_id')->addModelTransformer(new IdToStringGenericTransformer($em, 'AppBundle:PayMethod'));
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
