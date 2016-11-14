<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Client;
use AppBundle\Entity\ClientUser;
use AppBundle\Entity\Enum\RoleEnum;
use FOS\UserBundle\Model\UserManagerInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ClientUserAdmin extends AbstractParentAdmin
{
    protected $baseRouteName = 'admin_app_bundle_ClientUser';
    protected $baseRoutePattern = 'ClientUserAdmin';
    /** @var UserManagerInterface */
    protected  $userManager;
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('username')
            ->add('email')
            ->add('enabled')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('name')
            ->add('language')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('client.nameCompany')
            ->add('username')
            ->add('name')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                    'copy' => array(
                        'template' => '@App/Sonata/ClientUser/copy_button.html.twig'
                    ),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        /** @var ClientUser $subject */
        $subject = $this->getSubject();

        if(!$this -> getRoot() -> getSubject() instanceof Client)
        {
            if ( !$subject || !$subject->getId())
                $formMapper
                    ->add('client');
            else
                $formMapper
                    ->add('client', null, ['read_only' => true, 'disabled' => true]);
        }

        $formMapper
            ->add('username')
            ->add('name')
            ->add('email')
            ->add('language')
            ->add('country')
            ->add('clientUserHasApps', 'sonata_type_collection', array('by_reference' => false), array('edit' => 'inline', 'inline' => 'table'))
            ->add('plainPassword', 'text', array('required' => false))
            ->add('roles')
            ->add('enabled', null, array('required' => false))
            ->add('locked', null, array('required' => false))
            ->add('expired', null, array('required' => false))
            ->add('credentialsExpired', null, array('required' => false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('username')
            ->add('usernameCanonical')
            ->add('email')
            ->add('emailCanonical')
            ->add('enabled')
            ->add('salt')
            ->add('password')
            ->add('lastLogin')
            ->add('locked')
            ->add('expired')
            ->add('expiresAt')
            ->add('confirmationToken')
            ->add('passwordRequestedAt')
            ->add('roles')
            ->add('credentialsExpired')
            ->add('credentialsExpireAt')
            ->add('id')
            ->add('name')
            ->add('language')
        ;
    }

    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }

    public function getNewInstance()
    {
        $request = $this->getRequest();
        if ($copyId = $request->get('copy_id'))
        {
            $em = $this->getEntityManager();

            $newObject = $em->getRepository("AppBundle:ClientUser")->find($copyId);
            $obj = clone($newObject);
            $obj->setValuesOnCloneManually();
            return $obj;
        }
        /** @var ClientUser $clientUser */
        $clientUser = parent::getNewInstance();
        $clientUser->addRole(RoleEnum::ADMIN_MANAGE_PROJECTS );

        return $clientUser;
    }

}
