<?php

namespace AppBundle\Admin;

use AppBundle\Command\NginxClearCacheCommand;
use AppBundle\Entity\Job;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class JobAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('createdAt')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('description', null, ['attr' => [ 'class' => 'ckeditor' ]])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('description')
            ->add('createdAt')
        ;
    }

    /**
     * @param Job $object
     * @throws \RuntimeException
     * @return mixed|void
     */
    public function postPersist($object)
    {
        $this->removeHomeCache();
    }

    /**
     * @param Job $object
     * @throws \RuntimeException
     * @return mixed|void
     */
    public function postUpdate($object)
    {
        $this->removeHomeCache();
    }

    private function removeHomeCache()
    {
        $container = $this->getConfigurationPool()->getContainer();
        if (!$container->getParameter('is_production'))
            return;

        /** @var NginxClearCacheCommand $nginxClearCache */
        $nginxClearCache = $container->get('command.nginx_clear_cache');
        $nginxClearCache->clearCache();
    }
}
