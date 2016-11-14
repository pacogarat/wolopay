<?php

/*
 * This file is part of the Sonata project.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\Enum\LanguageEnum;
use AppBundle\Entity\Gamer;
use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class TransactionDemoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $queryBuilderArticle=[];
        $queryBuilder=[];
        $queryBuilderCss=[];

        if ($options['app'])
        {
            $queryBuilder['query_builder']= function(EntityRepository $er ) use ($options) {
                return $er->createQueryBuilder('a')
                    ->where('a.app = :appId')
                    ->andWhere('a.active = 1')
                    ->setParameter('appId', $options['app']->getId() );
            };

            $queryBuilderArticle['query_builder']= function(EntityRepository $er ) use ($options) {
                return $er->createQueryBuilder('a')
                    ->join('a.item','i')
                    ->where('a.app = :appId')
                    ->andWhere('a.active = 1')
                    ->andWhere('i.active = 1')
                    ->setParameter('appId', $options['app']->getId() );
            };

        }

        $queryBuilderCss['query_builder']= function(EntityRepository $er ) use ($options) {
            return $er->createQueryBuilder('a')
                ->where('a.active = 1')
                ;
        };

        $formBuilder
            ->add('gamer', TextType::class, [ 'mapped' => false, 'label' => 'form.demo.gamer.label', 'attr' => ['value'=> uniqid("DEMO_") ] ])
            ->add('gamer_email', EmailType::class, ['mapped' => false, 'constraints' => new Email(), 'required' => false, 'description' => 'form.demo.email.label', 'data' => 'demo-'.time().'@wolopay.com'])
            ->add('css', null, array_merge(['label' => 'form.demo.css.label', 'required' => false,], $queryBuilderCss))
            ->add('levelCategory', null, ['label' => 'form.demo.level_category.label'])
            ->add('languageDefault', null, ['label' => 'form.demo.language.label'])
            ->add('countriesAvailable', null, ['required'=> false, 'label' => 'form.demo.countries.label'])
            ->add('selectedArticle', null, array_merge(['required'=> false, 'label' => 'form.demo.selected_article.label'], $queryBuilderArticle))
            ->add('selectedAppTab', null, array_merge(['required'=> false, 'label' => 'form.demo.selected_tab_category.label']))

            ->add('appTabsAvailable', null, ['required'=> false, 'label' => 'form.demo.methods.label'])
            ->add('articlesAvailable', null, array_merge(['required'=> false, 'label' => 'form.demo.articles.label'], $queryBuilderArticle))
            ->add('payMethodsAvailable', null, ['required'=> false, 'label' => 'form.demo.pay_methods.label'])
            ->add('customParam', null, ['required'=> false, 'label' => 'form.demo.custom_param.label'])
            ->add('url_notification', UrlType::class, [ 'required' => false, 'description' => 'form.demo.url_notification.label'])
            ->add('return', null, ['required'=> false, 'label' => 'form.demo.return.label'])
            ->add('externalStore', null, ['required'=> false])
            ->add('fixedCountry', null, ['required'=> false, 'label' => 'form.demo.fixed_country.label'])
            ->add('fixedLanguage', null, ['required'=> false, 'label' => 'form.demo.fixed_language.label'])
            ->add('firstPayMethods', null, ['required'=> false, 'label' => 'form.demo.first_pay_methods.label'])
            ->add('tutorialEnabled', null, ['required'=> false, 'label' => 'form.demo.tutorial_enabled.label'//, 'data' => true
                ])

            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                    $gamer_email = $event->getForm()->get('gamer_email')->getData();
                    $gamerId = $event->getForm()->get('gamer')->getData();
                    /** @var Transaction $transaction */
                    $transaction = $event->getData();

                    $transaction->setGamer(new Gamer($transaction->getApp(), $gamerId));
                    if ($gamer_email)
                        $transaction->getGamer()->setEmail($gamer_email);
                })
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options) {
                /** @var Transaction $transaction */
                $transaction = $event->getData();

                $transaction->setLanguageDefault($options['em']->getRepository("AppBundle:Language")->find(LanguageEnum::ENGLISH));

                if ($options['app'])
                    $transaction->setApp($options['app']);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'AppBundle\Entity\Transaction',
                'app'        => null,
                'em'         => null,
            ));
    }
}