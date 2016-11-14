<?php


namespace AppBundle\Controller\Admin;

use AppBundle\Entity\AppHasPayMethodProviderCountry;
use AppBundle\Entity\PayMethodHasProvider;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;

class AppAdminController extends CRUDController
{
    public function editApmpcAction($appId, Request $request)
    {
        set_time_limit ( 150 );
        $stopwatch = $this->get('debug.stopwatch');


        /** @var EntityManager $em */
        $em=$this->getDoctrine()->getManager();

        $em->getConnection()->getConfiguration()->setSQLLogger(null);

        if (!$app=$em->getRepository("AppBundle:App")->find($appId))
            throw new \Exception("app doesn't found");

        if ($this->has('debug.stopwatch')) {
            $stopwatch = $this->get('debug.stopwatch');
            $stopwatch->start('form_config');
        }

        $queryBuilderApp= function(EntityRepository $er ) use ($appId) {
            return $er->createQueryBuilder('a')
                ->where('a.app = :appId')
                ->setParameter('appId', $appId );
        };

        $form = $this->createFormBuilder()
            ->add('pmp', 'entity', ['class' => 'AppBundle:PayMethodHasProvider', 'multiple'=> true])
//            ->add('articles', 'entity', ['class' => 'AppBundle:Article', 'query_builder' => $queryBuilderApp, 'multiple'=> true, 'required'=> false])
            ->add('countries', 'entity', ['class' => 'AppBundle:Country',  'multiple'=> true, 'required'=> false])
            ->add('remove', 'checkbox', ['required'=> false])
            ->add('submit', 'submit')
            ->getForm();


        $form->handleRequest($request);

        if ($form->isValid())
        {
            $data=$form->getData();

            /** @var PayMethodHasProvider[] $pmps */
            $pmps=$data['pmp'];
            $remove=$data['remove'];
            /** @var \Doctrine\Common\Collections\ArrayCollection $countries */
            $countries=$data['countries'];

            $added=$removed=0;

            $countBefore = count($app->getAppHasPayMethodProviderCountry());

            foreach ($pmps as $pmp)
            {
                $pmpcs = $em->getRepository("AppBundle:PayMethodProviderHasCountry")->findBy(['payMethodHasProvider' => $pmp->getId()]);

                foreach ($pmpcs as $pmpc)
                {
                    if (!$pmpc)
                        continue;

                    if ($countries->isEmpty() == false && $countries->contains($pmpc->getCountry()) == false)
                        continue;

                    $exist = $app->hasPayMethodProviderCountry($pmpc);

                    if ($exist && $remove)
                    {
                        $removed++;
                        $app->removeAppHasPayMethodProviderCountry($exist);

                    }else if (!$exist && !$remove){

                        $added++;
                        $app->addAppHasPayMethodProviderCountry(new AppHasPayMethodProviderCountry($pmpc, $app));
                    }
                }
            }

            $em->flush();

            $articleService = $this->get('app_shop_has_article');

            $articleService->syncAllAppShopHasArticlesWithAppTabIfEnabled($app);

            $countAfter = count($app->getAppHasPayMethodProviderCountry());

            $this->addFlash('success', "PMPC before $countBefore, after $countAfter".($remove ? ", Payments removed to App $removed" : ", Payments added to App $added"));
        }

        return $this->render('@App/Sonata/App/edit_pmpc_to_all_articles.html.twig', array(
                'action' => 'edit_apmpc',
                'form'   => $form->createView()
            ));
    }


    public function importToSandboxAction($appId, Request $request)
    {
        //useless
        /** @var EntityManager $em */
        $em=$this->getDoctrine()->getManager();

        if (!$app=$em->getRepository("AppBundle:App")->find($appId))
            throw new \Exception("app doesn't found");

        $queryBuilderApp= function(EntityRepository $er ) use ($appId) {
            return $er->createQueryBuilder('a')
                ->join('a.clientUserHasApps', 'c')
                ->where('c.app = :appId')
                ->setParameter('appId', $appId );
        };

        $form = $this->createFormBuilder()
            ->add('client', 'entity', ['class' => 'AppBundle:ClientUser', 'query_builder' => $queryBuilderApp ])
            ->add('submit', 'submit')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $values = [
                $app->getAppApiHasCredential()->getCodeKey(),
                $app->getAppApiHasCredential()->getSecretKey(),
                $app->getName(),
                $app->getUrlNotificationPayment(),
                $app->getUrlNotificationSubscription(),
                $app->getUrlExtra(),
                $app->getUrlHomeSite(),
            ];

            file_put_contents(sys_get_temp_dir().'/serialize_app_credentials.txt', implode(",", $values));

        }



        return $this->render('@App/Sonata/App/import_to_sandbox.html.twig', array(
                'action' => 'import',
                'form'   => $form->createView()
            ));
    }
}