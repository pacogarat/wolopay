<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appTestUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appTestUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/log')) {
            if (0 === strpos($pathinfo, '/login')) {
                // fos_user_security_login
                if ($pathinfo === '/login') {
                    if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                        goto not_fos_user_security_login;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::loginAction',  '_route' => 'fos_user_security_login',);
                }
                not_fos_user_security_login:

                // fos_user_security_check
                if ($pathinfo === '/login_check') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_fos_user_security_check;
                    }

                    return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::checkAction',  '_route' => 'fos_user_security_check',);
                }
                not_fos_user_security_check:

            }

            // fos_user_security_logout
            if ($pathinfo === '/logout') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_security_logout;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\SecurityController::logoutAction',  '_route' => 'fos_user_security_logout',);
            }
            not_fos_user_security_logout:

        }

        if (0 === strpos($pathinfo, '/resetting')) {
            // fos_user_resetting_request
            if ($pathinfo === '/resetting/request') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_request;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::requestAction',  '_route' => 'fos_user_resetting_request',);
            }
            not_fos_user_resetting_request:

            // fos_user_resetting_send_email
            if ($pathinfo === '/resetting/send-email') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_fos_user_resetting_send_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::sendEmailAction',  '_route' => 'fos_user_resetting_send_email',);
            }
            not_fos_user_resetting_send_email:

            // fos_user_resetting_check_email
            if ($pathinfo === '/resetting/check-email') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_resetting_check_email;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::checkEmailAction',  '_route' => 'fos_user_resetting_check_email',);
            }
            not_fos_user_resetting_check_email:

            // fos_user_resetting_reset
            if (0 === strpos($pathinfo, '/resetting/reset') && preg_match('#^/resetting/reset/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_resetting_reset;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_resetting_reset')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\ResettingController::resetAction',));
            }
            not_fos_user_resetting_reset:

        }

        if (0 === strpos($pathinfo, '/group')) {
            // fos_user_group_list
            if ($pathinfo === '/group/list') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_list;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::listAction',  '_route' => 'fos_user_group_list',);
            }
            not_fos_user_group_list:

            // fos_user_group_new
            if ($pathinfo === '/group/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_group_new;
                }

                return array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::newAction',  '_route' => 'fos_user_group_new',);
            }
            not_fos_user_group_new:

            // fos_user_group_show
            if (preg_match('#^/group/(?P<groupName>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_show;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_group_show')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::showAction',));
            }
            not_fos_user_group_show:

            // fos_user_group_edit
            if (preg_match('#^/group/(?P<groupName>[^/]++)/edit$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_fos_user_group_edit;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_group_edit')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::editAction',));
            }
            not_fos_user_group_edit:

            // fos_user_group_delete
            if (preg_match('#^/group/(?P<groupName>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_fos_user_group_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_user_group_delete')), array (  '_controller' => 'FOS\\UserBundle\\Controller\\GroupController::deleteAction',));
            }
            not_fos_user_group_delete:

        }

        if (0 === strpos($pathinfo, '/backoffice')) {
            // sonata_admin_redirect
            if (rtrim($pathinfo, '/') === '/backoffice') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'sonata_admin_redirect');
                }

                return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'sonata_admin_dashboard',  'permanent' => 'true',  '_route' => 'sonata_admin_redirect',);
            }

            // sonata_admin_dashboard
            if ($pathinfo === '/backoffice/dashboard') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::dashboardAction',  '_route' => 'sonata_admin_dashboard',);
            }

            if (0 === strpos($pathinfo, '/backoffice/core')) {
                // sonata_admin_retrieve_form_element
                if ($pathinfo === '/backoffice/core/get-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:retrieveFormFieldElementAction',  '_route' => 'sonata_admin_retrieve_form_element',);
                }

                // sonata_admin_append_form_element
                if ($pathinfo === '/backoffice/core/append-form-field-element') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:appendFormFieldElementAction',  '_route' => 'sonata_admin_append_form_element',);
                }

                // sonata_admin_short_object_information
                if (0 === strpos($pathinfo, '/backoffice/core/get-short-object-description') && preg_match('#^/backoffice/core/get\\-short\\-object\\-description(?:\\.(?P<_format>html|json))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_admin_short_object_information')), array (  '_controller' => 'sonata.admin.controller.admin:getShortObjectDescriptionAction',  '_format' => 'html',));
                }

                // sonata_admin_set_object_field_value
                if ($pathinfo === '/backoffice/core/set-object-field-value') {
                    return array (  '_controller' => 'sonata.admin.controller.admin:setObjectFieldValueAction',  '_route' => 'sonata_admin_set_object_field_value',);
                }

            }

            // sonata_admin_search
            if ($pathinfo === '/backoffice/search') {
                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CoreController::searchAction',  '_route' => 'sonata_admin_search',);
            }

            // sonata_admin_retrieve_autocomplete_items
            if ($pathinfo === '/backoffice/core/get-autocomplete-items') {
                return array (  '_controller' => 'sonata.admin.controller.admin:retrieveAutocompleteItemsAction',  '_route' => 'sonata_admin_retrieve_autocomplete_items',);
            }

            if (0 === strpos($pathinfo, '/backoffice/app')) {
                // admin_app_bundle_App_list
                if ($pathinfo === '/backoffice/app/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_list',  '_route' => 'admin_app_bundle_App_list',);
                }

                // admin_app_bundle_App_create
                if ($pathinfo === '/backoffice/app/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_create',  '_route' => 'admin_app_bundle_App_create',);
                }

                // admin_app_bundle_App_batch
                if ($pathinfo === '/backoffice/app/batch') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_batch',  '_route' => 'admin_app_bundle_App_batch',);
                }

                // admin_app_bundle_App_edit
                if (preg_match('#^/backoffice/app/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_App_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_edit',));
                }

                // admin_app_bundle_App_delete
                if (preg_match('#^/backoffice/app/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_App_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_delete',));
                }

                // admin_app_bundle_App_show
                if (preg_match('#^/backoffice/app/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_App_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_show',));
                }

                // admin_app_bundle_App_export
                if ($pathinfo === '/backoffice/app/export') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_export',  '_route' => 'admin_app_bundle_App_export',);
                }

                // admin_app_bundle_App_import_to_sandbox
                if (preg_match('#^/backoffice/app/(?P<appId>[^/]++)/import\\-to\\-sandbox$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_App_import_to_sandbox')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::importToSandboxAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_import_to_sandbox',));
                }

                // admin_app_bundle_App_edit_apmpc
                if (preg_match('#^/backoffice/app/(?P<appId>[^/]++)/edit_apmpc$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_App_edit_apmpc')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\AppAdminController::editApmpcAction',  '_sonata_admin' => 'nvia_shop_app.admin.app',  '_sonata_name' => 'admin_app_bundle_App_edit_apmpc',));
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/A')) {
                if (0 === strpos($pathinfo, '/backoffice/AppShopAdmin')) {
                    // admin_app_bundle_AppShop_list
                    if ($pathinfo === '/backoffice/AppShopAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_list',  '_route' => 'admin_app_bundle_AppShop_list',);
                    }

                    // admin_app_bundle_AppShop_create
                    if ($pathinfo === '/backoffice/AppShopAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_create',  '_route' => 'admin_app_bundle_AppShop_create',);
                    }

                    // admin_app_bundle_AppShop_batch
                    if ($pathinfo === '/backoffice/AppShopAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_batch',  '_route' => 'admin_app_bundle_AppShop_batch',);
                    }

                    // admin_app_bundle_AppShop_edit
                    if (preg_match('#^/backoffice/AppShopAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShop_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_edit',));
                    }

                    // admin_app_bundle_AppShop_delete
                    if (preg_match('#^/backoffice/AppShopAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShop_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_delete',));
                    }

                    // admin_app_bundle_AppShop_show
                    if (preg_match('#^/backoffice/AppShopAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShop_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_show',));
                    }

                    // admin_app_bundle_AppShop_export
                    if ($pathinfo === '/backoffice/AppShopAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop',  '_sonata_name' => 'admin_app_bundle_AppShop_export',  '_route' => 'admin_app_bundle_AppShop_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/ArticleAdmin')) {
                    // admin_app_bundle_Article_list
                    if ($pathinfo === '/backoffice/ArticleAdmin/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_list',  '_route' => 'admin_app_bundle_Article_list',);
                    }

                    // admin_app_bundle_Article_create
                    if ($pathinfo === '/backoffice/ArticleAdmin/create') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_create',  '_route' => 'admin_app_bundle_Article_create',);
                    }

                    // admin_app_bundle_Article_batch
                    if ($pathinfo === '/backoffice/ArticleAdmin/batch') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_batch',  '_route' => 'admin_app_bundle_Article_batch',);
                    }

                    // admin_app_bundle_Article_edit
                    if (preg_match('#^/backoffice/ArticleAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Article_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_edit',));
                    }

                    // admin_app_bundle_Article_delete
                    if (preg_match('#^/backoffice/ArticleAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Article_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_delete',));
                    }

                    // admin_app_bundle_Article_show
                    if (preg_match('#^/backoffice/ArticleAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Article_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_show',));
                    }

                    // admin_app_bundle_Article_export
                    if ($pathinfo === '/backoffice/ArticleAdmin/export') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_export',  '_route' => 'admin_app_bundle_Article_export',);
                    }

                    // admin_app_bundle_Article_import_csv
                    if (preg_match('#^/backoffice/ArticleAdmin/(?P<appId>[^/]++)/importcsv$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Article_import_csv')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ArticleAdminController::importCsvAction',  '_sonata_admin' => 'nvia_shop_app.admin.article',  '_sonata_name' => 'admin_app_bundle_Article_import_csv',));
                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/ItemAdmin')) {
                // admin_app_bundle_Item_list
                if ($pathinfo === '/backoffice/ItemAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_list',  '_route' => 'admin_app_bundle_Item_list',);
                }

                // admin_app_bundle_Item_create
                if ($pathinfo === '/backoffice/ItemAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_create',  '_route' => 'admin_app_bundle_Item_create',);
                }

                // admin_app_bundle_Item_batch
                if ($pathinfo === '/backoffice/ItemAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_batch',  '_route' => 'admin_app_bundle_Item_batch',);
                }

                // admin_app_bundle_Item_edit
                if (preg_match('#^/backoffice/ItemAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Item_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_edit',));
                }

                // admin_app_bundle_Item_delete
                if (preg_match('#^/backoffice/ItemAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Item_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_delete',));
                }

                // admin_app_bundle_Item_show
                if (preg_match('#^/backoffice/ItemAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Item_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_show',));
                }

                // admin_app_bundle_Item_export
                if ($pathinfo === '/backoffice/ItemAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.item',  '_sonata_name' => 'admin_app_bundle_Item_export',  '_route' => 'admin_app_bundle_Item_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/A')) {
                if (0 === strpos($pathinfo, '/backoffice/AppShopHasArticlesAdmin')) {
                    // admin_app_bundle_AppShopHasArticles_list
                    if ($pathinfo === '/backoffice/AppShopHasArticlesAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_list',  '_route' => 'admin_app_bundle_AppShopHasArticles_list',);
                    }

                    // admin_app_bundle_AppShopHasArticles_create
                    if ($pathinfo === '/backoffice/AppShopHasArticlesAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_create',  '_route' => 'admin_app_bundle_AppShopHasArticles_create',);
                    }

                    // admin_app_bundle_AppShopHasArticles_batch
                    if ($pathinfo === '/backoffice/AppShopHasArticlesAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_batch',  '_route' => 'admin_app_bundle_AppShopHasArticles_batch',);
                    }

                    // admin_app_bundle_AppShopHasArticles_edit
                    if (preg_match('#^/backoffice/AppShopHasArticlesAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShopHasArticles_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_edit',));
                    }

                    // admin_app_bundle_AppShopHasArticles_delete
                    if (preg_match('#^/backoffice/AppShopHasArticlesAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShopHasArticles_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_delete',));
                    }

                    // admin_app_bundle_AppShopHasArticles_show
                    if (preg_match('#^/backoffice/AppShopHasArticlesAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppShopHasArticles_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_show',));
                    }

                    // admin_app_bundle_AppShopHasArticles_export
                    if ($pathinfo === '/backoffice/AppShopHasArticlesAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.app_shop_has_articles',  '_sonata_name' => 'admin_app_bundle_AppShopHasArticles_export',  '_route' => 'admin_app_bundle_AppShopHasArticles_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/ArticleHasPMPCAdmin')) {
                    // admin_app_bundle_ArticleHasPMPC_list
                    if ($pathinfo === '/backoffice/ArticleHasPMPCAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_list',  '_route' => 'admin_app_bundle_ArticleHasPMPC_list',);
                    }

                    // admin_app_bundle_ArticleHasPMPC_create
                    if ($pathinfo === '/backoffice/ArticleHasPMPCAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_create',  '_route' => 'admin_app_bundle_ArticleHasPMPC_create',);
                    }

                    // admin_app_bundle_ArticleHasPMPC_batch
                    if ($pathinfo === '/backoffice/ArticleHasPMPCAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_batch',  '_route' => 'admin_app_bundle_ArticleHasPMPC_batch',);
                    }

                    // admin_app_bundle_ArticleHasPMPC_edit
                    if (preg_match('#^/backoffice/ArticleHasPMPCAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ArticleHasPMPC_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_edit',));
                    }

                    // admin_app_bundle_ArticleHasPMPC_delete
                    if (preg_match('#^/backoffice/ArticleHasPMPCAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ArticleHasPMPC_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_delete',));
                    }

                    // admin_app_bundle_ArticleHasPMPC_show
                    if (preg_match('#^/backoffice/ArticleHasPMPCAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ArticleHasPMPC_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_show',));
                    }

                    // admin_app_bundle_ArticleHasPMPC_export
                    if ($pathinfo === '/backoffice/ArticleHasPMPCAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.article_has_pmpc',  '_sonata_name' => 'admin_app_bundle_ArticleHasPMPC_export',  '_route' => 'admin_app_bundle_ArticleHasPMPC_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/ShopCssAdmin')) {
                // admin_app_bundle_ShopCss_list
                if ($pathinfo === '/backoffice/ShopCssAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_list',  '_route' => 'admin_app_bundle_ShopCss_list',);
                }

                // admin_app_bundle_ShopCss_create
                if ($pathinfo === '/backoffice/ShopCssAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_create',  '_route' => 'admin_app_bundle_ShopCss_create',);
                }

                // admin_app_bundle_ShopCss_batch
                if ($pathinfo === '/backoffice/ShopCssAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_batch',  '_route' => 'admin_app_bundle_ShopCss_batch',);
                }

                // admin_app_bundle_ShopCss_edit
                if (preg_match('#^/backoffice/ShopCssAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ShopCss_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_edit',));
                }

                // admin_app_bundle_ShopCss_delete
                if (preg_match('#^/backoffice/ShopCssAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ShopCss_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_delete',));
                }

                // admin_app_bundle_ShopCss_show
                if (preg_match('#^/backoffice/ShopCssAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ShopCss_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_show',));
                }

                // admin_app_bundle_ShopCss_export
                if ($pathinfo === '/backoffice/ShopCssAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.shop_css',  '_sonata_name' => 'admin_app_bundle_ShopCss_export',  '_route' => 'admin_app_bundle_ShopCss_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/OfferProgrammerAdmin')) {
                // admin_app_bundle_OfferProgrammer_list
                if ($pathinfo === '/backoffice/OfferProgrammerAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_list',  '_route' => 'admin_app_bundle_OfferProgrammer_list',);
                }

                // admin_app_bundle_OfferProgrammer_create
                if ($pathinfo === '/backoffice/OfferProgrammerAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_create',  '_route' => 'admin_app_bundle_OfferProgrammer_create',);
                }

                // admin_app_bundle_OfferProgrammer_batch
                if ($pathinfo === '/backoffice/OfferProgrammerAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_batch',  '_route' => 'admin_app_bundle_OfferProgrammer_batch',);
                }

                // admin_app_bundle_OfferProgrammer_edit
                if (preg_match('#^/backoffice/OfferProgrammerAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_OfferProgrammer_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_edit',));
                }

                // admin_app_bundle_OfferProgrammer_delete
                if (preg_match('#^/backoffice/OfferProgrammerAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_OfferProgrammer_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_delete',));
                }

                // admin_app_bundle_OfferProgrammer_show
                if (preg_match('#^/backoffice/OfferProgrammerAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_OfferProgrammer_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_show',));
                }

                // admin_app_bundle_OfferProgrammer_export
                if ($pathinfo === '/backoffice/OfferProgrammerAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_shop_app.admin.offer_programmer',  '_sonata_name' => 'admin_app_bundle_OfferProgrammer_export',  '_route' => 'admin_app_bundle_OfferProgrammer_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/TransactionAdmin')) {
                // admin_app_bundle_Transaction_list
                if ($pathinfo === '/backoffice/TransactionAdmin/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_list',  '_route' => 'admin_app_bundle_Transaction_list',);
                }

                // admin_app_bundle_Transaction_create
                if ($pathinfo === '/backoffice/TransactionAdmin/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_create',  '_route' => 'admin_app_bundle_Transaction_create',);
                }

                // admin_app_bundle_Transaction_batch
                if ($pathinfo === '/backoffice/TransactionAdmin/batch') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_batch',  '_route' => 'admin_app_bundle_Transaction_batch',);
                }

                // admin_app_bundle_Transaction_edit
                if (preg_match('#^/backoffice/TransactionAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Transaction_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_edit',));
                }

                // admin_app_bundle_Transaction_delete
                if (preg_match('#^/backoffice/TransactionAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Transaction_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_delete',));
                }

                // admin_app_bundle_Transaction_show
                if (preg_match('#^/backoffice/TransactionAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Transaction_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_show',));
                }

                // admin_app_bundle_Transaction_export
                if ($pathinfo === '/backoffice/TransactionAdmin/export') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_export',  '_route' => 'admin_app_bundle_Transaction_export',);
                }

                // admin_app_bundle_Transaction_log
                if (preg_match('#^/backoffice/TransactionAdmin/(?P<id>[^/]++)/log$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Transaction_log')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\TransactionAdminController::logAction',  '_sonata_admin' => 'nvia_app_shop.admin.transaction',  '_sonata_name' => 'admin_app_bundle_Transaction_log',));
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/P')) {
                if (0 === strpos($pathinfo, '/backoffice/Payment')) {
                    if (0 === strpos($pathinfo, '/backoffice/PaymentAdmin')) {
                        // admin_app_bundle_Payment_list
                        if ($pathinfo === '/backoffice/PaymentAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_list',  '_route' => 'admin_app_bundle_Payment_list',);
                        }

                        // admin_app_bundle_Payment_create
                        if ($pathinfo === '/backoffice/PaymentAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_create',  '_route' => 'admin_app_bundle_Payment_create',);
                        }

                        // admin_app_bundle_Payment_batch
                        if ($pathinfo === '/backoffice/PaymentAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_batch',  '_route' => 'admin_app_bundle_Payment_batch',);
                        }

                        // admin_app_bundle_Payment_edit
                        if (preg_match('#^/backoffice/PaymentAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Payment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_edit',));
                        }

                        // admin_app_bundle_Payment_delete
                        if (preg_match('#^/backoffice/PaymentAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Payment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_delete',));
                        }

                        // admin_app_bundle_Payment_show
                        if (preg_match('#^/backoffice/PaymentAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Payment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_show',));
                        }

                        // admin_app_bundle_Payment_export
                        if ($pathinfo === '/backoffice/PaymentAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment',  '_sonata_name' => 'admin_app_bundle_Payment_export',  '_route' => 'admin_app_bundle_Payment_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/PaymentServiceCategoryAdmin')) {
                        // admin_app_bundle_PaymentServiceCategory_list
                        if ($pathinfo === '/backoffice/PaymentServiceCategoryAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_list',  '_route' => 'admin_app_bundle_PaymentServiceCategory_list',);
                        }

                        // admin_app_bundle_PaymentServiceCategory_create
                        if ($pathinfo === '/backoffice/PaymentServiceCategoryAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_create',  '_route' => 'admin_app_bundle_PaymentServiceCategory_create',);
                        }

                        // admin_app_bundle_PaymentServiceCategory_batch
                        if ($pathinfo === '/backoffice/PaymentServiceCategoryAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_batch',  '_route' => 'admin_app_bundle_PaymentServiceCategory_batch',);
                        }

                        // admin_app_bundle_PaymentServiceCategory_edit
                        if (preg_match('#^/backoffice/PaymentServiceCategoryAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PaymentServiceCategory_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_edit',));
                        }

                        // admin_app_bundle_PaymentServiceCategory_delete
                        if (preg_match('#^/backoffice/PaymentServiceCategoryAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PaymentServiceCategory_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_delete',));
                        }

                        // admin_app_bundle_PaymentServiceCategory_show
                        if (preg_match('#^/backoffice/PaymentServiceCategoryAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PaymentServiceCategory_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_show',));
                        }

                        // admin_app_bundle_PaymentServiceCategory_export
                        if ($pathinfo === '/backoffice/PaymentServiceCategoryAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.payment_service_category',  '_sonata_name' => 'admin_app_bundle_PaymentServiceCategory_export',  '_route' => 'admin_app_bundle_PaymentServiceCategory_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/PurchaseNotificationAdmin')) {
                    // admin_app_bundle_PurchaseNotification_list
                    if ($pathinfo === '/backoffice/PurchaseNotificationAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_list',  '_route' => 'admin_app_bundle_PurchaseNotification_list',);
                    }

                    // admin_app_bundle_PurchaseNotification_create
                    if ($pathinfo === '/backoffice/PurchaseNotificationAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_create',  '_route' => 'admin_app_bundle_PurchaseNotification_create',);
                    }

                    // admin_app_bundle_PurchaseNotification_batch
                    if ($pathinfo === '/backoffice/PurchaseNotificationAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_batch',  '_route' => 'admin_app_bundle_PurchaseNotification_batch',);
                    }

                    // admin_app_bundle_PurchaseNotification_edit
                    if (preg_match('#^/backoffice/PurchaseNotificationAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PurchaseNotification_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_edit',));
                    }

                    // admin_app_bundle_PurchaseNotification_delete
                    if (preg_match('#^/backoffice/PurchaseNotificationAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PurchaseNotification_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_delete',));
                    }

                    // admin_app_bundle_PurchaseNotification_show
                    if (preg_match('#^/backoffice/PurchaseNotificationAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PurchaseNotification_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_show',));
                    }

                    // admin_app_bundle_PurchaseNotification_export
                    if ($pathinfo === '/backoffice/PurchaseNotificationAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase_notification',  '_sonata_name' => 'admin_app_bundle_PurchaseNotification_export',  '_route' => 'admin_app_bundle_PurchaseNotification_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/Promo')) {
                    if (0 === strpos($pathinfo, '/backoffice/PromoAdmin')) {
                        // admin_app_bundle_Promo_list
                        if ($pathinfo === '/backoffice/PromoAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_list',  '_route' => 'admin_app_bundle_Promo_list',);
                        }

                        // admin_app_bundle_Promo_create
                        if ($pathinfo === '/backoffice/PromoAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_create',  '_route' => 'admin_app_bundle_Promo_create',);
                        }

                        // admin_app_bundle_Promo_batch
                        if ($pathinfo === '/backoffice/PromoAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_batch',  '_route' => 'admin_app_bundle_Promo_batch',);
                        }

                        // admin_app_bundle_Promo_edit
                        if (preg_match('#^/backoffice/PromoAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Promo_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_edit',));
                        }

                        // admin_app_bundle_Promo_delete
                        if (preg_match('#^/backoffice/PromoAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Promo_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_delete',));
                        }

                        // admin_app_bundle_Promo_show
                        if (preg_match('#^/backoffice/PromoAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Promo_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_show',));
                        }

                        // admin_app_bundle_Promo_export
                        if ($pathinfo === '/backoffice/PromoAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo',  '_sonata_name' => 'admin_app_bundle_Promo_export',  '_route' => 'admin_app_bundle_Promo_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/PromoCodeAdmin')) {
                        // admin_app_bundle_PromoCode_list
                        if ($pathinfo === '/backoffice/PromoCodeAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_list',  '_route' => 'admin_app_bundle_PromoCode_list',);
                        }

                        // admin_app_bundle_PromoCode_create
                        if ($pathinfo === '/backoffice/PromoCodeAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_create',  '_route' => 'admin_app_bundle_PromoCode_create',);
                        }

                        // admin_app_bundle_PromoCode_batch
                        if ($pathinfo === '/backoffice/PromoCodeAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_batch',  '_route' => 'admin_app_bundle_PromoCode_batch',);
                        }

                        // admin_app_bundle_PromoCode_edit
                        if (preg_match('#^/backoffice/PromoCodeAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PromoCode_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_edit',));
                        }

                        // admin_app_bundle_PromoCode_delete
                        if (preg_match('#^/backoffice/PromoCodeAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PromoCode_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_delete',));
                        }

                        // admin_app_bundle_PromoCode_show
                        if (preg_match('#^/backoffice/PromoCodeAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PromoCode_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_show',));
                        }

                        // admin_app_bundle_PromoCode_export
                        if ($pathinfo === '/backoffice/PromoCodeAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.promo_code',  '_sonata_name' => 'admin_app_bundle_PromoCode_export',  '_route' => 'admin_app_bundle_PromoCode_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/AppApiCredentialsAdmin')) {
                // admin_app_bundle_AppApiCredentials_list
                if ($pathinfo === '/backoffice/AppApiCredentialsAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_list',  '_route' => 'admin_app_bundle_AppApiCredentials_list',);
                }

                // admin_app_bundle_AppApiCredentials_create
                if ($pathinfo === '/backoffice/AppApiCredentialsAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_create',  '_route' => 'admin_app_bundle_AppApiCredentials_create',);
                }

                // admin_app_bundle_AppApiCredentials_batch
                if ($pathinfo === '/backoffice/AppApiCredentialsAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_batch',  '_route' => 'admin_app_bundle_AppApiCredentials_batch',);
                }

                // admin_app_bundle_AppApiCredentials_edit
                if (preg_match('#^/backoffice/AppApiCredentialsAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppApiCredentials_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_edit',));
                }

                // admin_app_bundle_AppApiCredentials_delete
                if (preg_match('#^/backoffice/AppApiCredentialsAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppApiCredentials_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_delete',));
                }

                // admin_app_bundle_AppApiCredentials_show
                if (preg_match('#^/backoffice/AppApiCredentialsAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_AppApiCredentials_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_show',));
                }

                // admin_app_bundle_AppApiCredentials_export
                if ($pathinfo === '/backoffice/AppApiCredentialsAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_api.admin.app_api_credentials',  '_sonata_name' => 'admin_app_bundle_AppApiCredentials_export',  '_route' => 'admin_app_bundle_AppApiCredentials_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/Client')) {
                if (0 === strpos($pathinfo, '/backoffice/ClientAdmin')) {
                    // admin_app_bundle_Client_list
                    if ($pathinfo === '/backoffice/ClientAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_list',  '_route' => 'admin_app_bundle_Client_list',);
                    }

                    // admin_app_bundle_Client_create
                    if ($pathinfo === '/backoffice/ClientAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_create',  '_route' => 'admin_app_bundle_Client_create',);
                    }

                    // admin_app_bundle_Client_batch
                    if ($pathinfo === '/backoffice/ClientAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_batch',  '_route' => 'admin_app_bundle_Client_batch',);
                    }

                    // admin_app_bundle_Client_edit
                    if (preg_match('#^/backoffice/ClientAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Client_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_edit',));
                    }

                    // admin_app_bundle_Client_delete
                    if (preg_match('#^/backoffice/ClientAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Client_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_delete',));
                    }

                    // admin_app_bundle_Client_show
                    if (preg_match('#^/backoffice/ClientAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Client_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_show',));
                    }

                    // admin_app_bundle_Client_export
                    if ($pathinfo === '/backoffice/ClientAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_common.admin.client',  '_sonata_name' => 'admin_app_bundle_Client_export',  '_route' => 'admin_app_bundle_Client_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/ClientUser')) {
                    if (0 === strpos($pathinfo, '/backoffice/ClientUserAdmin')) {
                        // admin_app_bundle_ClientUser_list
                        if ($pathinfo === '/backoffice/ClientUserAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_list',  '_route' => 'admin_app_bundle_ClientUser_list',);
                        }

                        // admin_app_bundle_ClientUser_create
                        if ($pathinfo === '/backoffice/ClientUserAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_create',  '_route' => 'admin_app_bundle_ClientUser_create',);
                        }

                        // admin_app_bundle_ClientUser_batch
                        if ($pathinfo === '/backoffice/ClientUserAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_batch',  '_route' => 'admin_app_bundle_ClientUser_batch',);
                        }

                        // admin_app_bundle_ClientUser_edit
                        if (preg_match('#^/backoffice/ClientUserAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUser_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_edit',));
                        }

                        // admin_app_bundle_ClientUser_delete
                        if (preg_match('#^/backoffice/ClientUserAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUser_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_delete',));
                        }

                        // admin_app_bundle_ClientUser_show
                        if (preg_match('#^/backoffice/ClientUserAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUser_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_show',));
                        }

                        // admin_app_bundle_ClientUser_export
                        if ($pathinfo === '/backoffice/ClientUserAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_common.admin.client_user',  '_sonata_name' => 'admin_app_bundle_ClientUser_export',  '_route' => 'admin_app_bundle_ClientUser_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/ClientUserNotificationAdmin')) {
                        // admin_app_bundle_ClientUserNotification_list
                        if ($pathinfo === '/backoffice/ClientUserNotificationAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_list',  '_route' => 'admin_app_bundle_ClientUserNotification_list',);
                        }

                        // admin_app_bundle_ClientUserNotification_create
                        if ($pathinfo === '/backoffice/ClientUserNotificationAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_create',  '_route' => 'admin_app_bundle_ClientUserNotification_create',);
                        }

                        // admin_app_bundle_ClientUserNotification_batch
                        if ($pathinfo === '/backoffice/ClientUserNotificationAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_batch',  '_route' => 'admin_app_bundle_ClientUserNotification_batch',);
                        }

                        // admin_app_bundle_ClientUserNotification_edit
                        if (preg_match('#^/backoffice/ClientUserNotificationAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserNotification_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_edit',));
                        }

                        // admin_app_bundle_ClientUserNotification_delete
                        if (preg_match('#^/backoffice/ClientUserNotificationAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserNotification_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_delete',));
                        }

                        // admin_app_bundle_ClientUserNotification_show
                        if (preg_match('#^/backoffice/ClientUserNotificationAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserNotification_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_show',));
                        }

                        // admin_app_bundle_ClientUserNotification_export
                        if ($pathinfo === '/backoffice/ClientUserNotificationAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_common.admin.client_user_notification',  '_sonata_name' => 'admin_app_bundle_ClientUserNotification_export',  '_route' => 'admin_app_bundle_ClientUserNotification_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/P')) {
                if (0 === strpos($pathinfo, '/backoffice/PayMethodAdmin')) {
                    // admin_app_bundle_PayMethod_list
                    if ($pathinfo === '/backoffice/PayMethodAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_list',  '_route' => 'admin_app_bundle_PayMethod_list',);
                    }

                    // admin_app_bundle_PayMethod_create
                    if ($pathinfo === '/backoffice/PayMethodAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_create',  '_route' => 'admin_app_bundle_PayMethod_create',);
                    }

                    // admin_app_bundle_PayMethod_batch
                    if ($pathinfo === '/backoffice/PayMethodAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_batch',  '_route' => 'admin_app_bundle_PayMethod_batch',);
                    }

                    // admin_app_bundle_PayMethod_edit
                    if (preg_match('#^/backoffice/PayMethodAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethod_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_edit',));
                    }

                    // admin_app_bundle_PayMethod_delete
                    if (preg_match('#^/backoffice/PayMethodAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethod_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_delete',));
                    }

                    // admin_app_bundle_PayMethod_show
                    if (preg_match('#^/backoffice/PayMethodAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethod_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_show',));
                    }

                    // admin_app_bundle_PayMethod_export
                    if ($pathinfo === '/backoffice/PayMethodAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method',  '_sonata_name' => 'admin_app_bundle_PayMethod_export',  '_route' => 'admin_app_bundle_PayMethod_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/ProviderAdmin')) {
                    // admin_app_bundle_Provider_list
                    if ($pathinfo === '/backoffice/ProviderAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_list',  '_route' => 'admin_app_bundle_Provider_list',);
                    }

                    // admin_app_bundle_Provider_create
                    if ($pathinfo === '/backoffice/ProviderAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_create',  '_route' => 'admin_app_bundle_Provider_create',);
                    }

                    // admin_app_bundle_Provider_batch
                    if ($pathinfo === '/backoffice/ProviderAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_batch',  '_route' => 'admin_app_bundle_Provider_batch',);
                    }

                    // admin_app_bundle_Provider_edit
                    if (preg_match('#^/backoffice/ProviderAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Provider_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_edit',));
                    }

                    // admin_app_bundle_Provider_delete
                    if (preg_match('#^/backoffice/ProviderAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Provider_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_delete',));
                    }

                    // admin_app_bundle_Provider_show
                    if (preg_match('#^/backoffice/ProviderAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Provider_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_show',));
                    }

                    // admin_app_bundle_Provider_export
                    if ($pathinfo === '/backoffice/ProviderAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_export',  '_route' => 'admin_app_bundle_Provider_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/PayMethod')) {
                    if (0 === strpos($pathinfo, '/backoffice/PayMethodHasProviderAdmin')) {
                        // admin_app_bundle_PayMethodHasProvider_list
                        if ($pathinfo === '/backoffice/PayMethodHasProviderAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_list',  '_route' => 'admin_app_bundle_PayMethodHasProvider_list',);
                        }

                        // admin_app_bundle_PayMethodHasProvider_create
                        if ($pathinfo === '/backoffice/PayMethodHasProviderAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_create',  '_route' => 'admin_app_bundle_PayMethodHasProvider_create',);
                        }

                        // admin_app_bundle_PayMethodHasProvider_batch
                        if ($pathinfo === '/backoffice/PayMethodHasProviderAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_batch',  '_route' => 'admin_app_bundle_PayMethodHasProvider_batch',);
                        }

                        // admin_app_bundle_PayMethodHasProvider_edit
                        if (preg_match('#^/backoffice/PayMethodHasProviderAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodHasProvider_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_edit',));
                        }

                        // admin_app_bundle_PayMethodHasProvider_delete
                        if (preg_match('#^/backoffice/PayMethodHasProviderAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodHasProvider_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_delete',));
                        }

                        // admin_app_bundle_PayMethodHasProvider_show
                        if (preg_match('#^/backoffice/PayMethodHasProviderAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodHasProvider_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_show',));
                        }

                        // admin_app_bundle_PayMethodHasProvider_export
                        if ($pathinfo === '/backoffice/PayMethodHasProviderAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_has_provider',  '_sonata_name' => 'admin_app_bundle_PayMethodHasProvider_export',  '_route' => 'admin_app_bundle_PayMethodHasProvider_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/PayMethodProviderHasCountryAdmin')) {
                        // admin_app_bundle_PayMethodProviderHasCountry_list
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_list',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_list',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_create
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_create',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_create',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_batch
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_batch',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_batch',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_edit
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_edit',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_delete
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_delete',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_show
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_show',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_export
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_export',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/SMS')) {
                if (0 === strpos($pathinfo, '/backoffice/SMSA')) {
                    if (0 === strpos($pathinfo, '/backoffice/SMSAdmin')) {
                        // admin_app_bundle_SMS_list
                        if ($pathinfo === '/backoffice/SMSAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_list',  '_route' => 'admin_app_bundle_SMS_list',);
                        }

                        // admin_app_bundle_SMS_create
                        if ($pathinfo === '/backoffice/SMSAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_create',  '_route' => 'admin_app_bundle_SMS_create',);
                        }

                        // admin_app_bundle_SMS_batch
                        if ($pathinfo === '/backoffice/SMSAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_batch',  '_route' => 'admin_app_bundle_SMS_batch',);
                        }

                        // admin_app_bundle_SMS_edit
                        if (preg_match('#^/backoffice/SMSAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMS_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_edit',));
                        }

                        // admin_app_bundle_SMS_delete
                        if (preg_match('#^/backoffice/SMSAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMS_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_delete',));
                        }

                        // admin_app_bundle_SMS_show
                        if (preg_match('#^/backoffice/SMSAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMS_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_show',));
                        }

                        // admin_app_bundle_SMS_export
                        if ($pathinfo === '/backoffice/SMSAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms',  '_sonata_name' => 'admin_app_bundle_SMS_export',  '_route' => 'admin_app_bundle_SMS_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/SMSAliasAdmin')) {
                        // admin_app_bundle_SMSAlias_list
                        if ($pathinfo === '/backoffice/SMSAliasAdmin/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_list',  '_route' => 'admin_app_bundle_SMSAlias_list',);
                        }

                        // admin_app_bundle_SMSAlias_create
                        if ($pathinfo === '/backoffice/SMSAliasAdmin/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_create',  '_route' => 'admin_app_bundle_SMSAlias_create',);
                        }

                        // admin_app_bundle_SMSAlias_batch
                        if ($pathinfo === '/backoffice/SMSAliasAdmin/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_batch',  '_route' => 'admin_app_bundle_SMSAlias_batch',);
                        }

                        // admin_app_bundle_SMSAlias_edit
                        if (preg_match('#^/backoffice/SMSAliasAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSAlias_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_edit',));
                        }

                        // admin_app_bundle_SMSAlias_delete
                        if (preg_match('#^/backoffice/SMSAliasAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSAlias_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_delete',));
                        }

                        // admin_app_bundle_SMSAlias_show
                        if (preg_match('#^/backoffice/SMSAliasAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSAlias_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_show',));
                        }

                        // admin_app_bundle_SMSAlias_export
                        if ($pathinfo === '/backoffice/SMSAliasAdmin/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_alias',  '_sonata_name' => 'admin_app_bundle_SMSAlias_export',  '_route' => 'admin_app_bundle_SMSAlias_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/SMSOperatorAdmin')) {
                    // admin_app_bundle_SMSOperator_list
                    if ($pathinfo === '/backoffice/SMSOperatorAdmin/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_list',  '_route' => 'admin_app_bundle_SMSOperator_list',);
                    }

                    // admin_app_bundle_SMSOperator_create
                    if ($pathinfo === '/backoffice/SMSOperatorAdmin/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_create',  '_route' => 'admin_app_bundle_SMSOperator_create',);
                    }

                    // admin_app_bundle_SMSOperator_batch
                    if ($pathinfo === '/backoffice/SMSOperatorAdmin/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_batch',  '_route' => 'admin_app_bundle_SMSOperator_batch',);
                    }

                    // admin_app_bundle_SMSOperator_edit
                    if (preg_match('#^/backoffice/SMSOperatorAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSOperator_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_edit',));
                    }

                    // admin_app_bundle_SMSOperator_delete
                    if (preg_match('#^/backoffice/SMSOperatorAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSOperator_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_delete',));
                    }

                    // admin_app_bundle_SMSOperator_show
                    if (preg_match('#^/backoffice/SMSOperatorAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_SMSOperator_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_show',));
                    }

                    // admin_app_bundle_SMSOperator_export
                    if ($pathinfo === '/backoffice/SMSOperatorAdmin/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.sms_operator',  '_sonata_name' => 'admin_app_bundle_SMSOperator_export',  '_route' => 'admin_app_bundle_SMSOperator_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/VoiceAdmin')) {
                // admin_app_bundle_Voice_list
                if ($pathinfo === '/backoffice/VoiceAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_list',  '_route' => 'admin_app_bundle_Voice_list',);
                }

                // admin_app_bundle_Voice_create
                if ($pathinfo === '/backoffice/VoiceAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_create',  '_route' => 'admin_app_bundle_Voice_create',);
                }

                // admin_app_bundle_Voice_batch
                if ($pathinfo === '/backoffice/VoiceAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_batch',  '_route' => 'admin_app_bundle_Voice_batch',);
                }

                // admin_app_bundle_Voice_edit
                if (preg_match('#^/backoffice/VoiceAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Voice_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_edit',));
                }

                // admin_app_bundle_Voice_delete
                if (preg_match('#^/backoffice/VoiceAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Voice_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_delete',));
                }

                // admin_app_bundle_Voice_show
                if (preg_match('#^/backoffice/VoiceAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Voice_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_show',));
                }

                // admin_app_bundle_Voice_export
                if ($pathinfo === '/backoffice/VoiceAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.voice',  '_sonata_name' => 'admin_app_bundle_Voice_export',  '_route' => 'admin_app_bundle_Voice_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/PurchaseAdmin')) {
                // admin_app_bundle_Purchase_list
                if ($pathinfo === '/backoffice/PurchaseAdmin/list') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::listAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_list',  '_route' => 'admin_app_bundle_Purchase_list',);
                }

                // admin_app_bundle_Purchase_create
                if ($pathinfo === '/backoffice/PurchaseAdmin/create') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::createAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_create',  '_route' => 'admin_app_bundle_Purchase_create',);
                }

                // admin_app_bundle_Purchase_batch
                if ($pathinfo === '/backoffice/PurchaseAdmin/batch') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::batchAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_batch',  '_route' => 'admin_app_bundle_Purchase_batch',);
                }

                // admin_app_bundle_Purchase_edit
                if (preg_match('#^/backoffice/PurchaseAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Purchase_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::editAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_edit',));
                }

                // admin_app_bundle_Purchase_delete
                if (preg_match('#^/backoffice/PurchaseAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Purchase_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::deleteAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_delete',));
                }

                // admin_app_bundle_Purchase_show
                if (preg_match('#^/backoffice/PurchaseAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Purchase_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::showAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_show',));
                }

                // admin_app_bundle_Purchase_export
                if ($pathinfo === '/backoffice/PurchaseAdmin/export') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::exportAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_export',  '_route' => 'admin_app_bundle_Purchase_export',);
                }

                // admin_app_bundle_Purchase_cancel
                if (preg_match('#^/backoffice/PurchaseAdmin/(?P<id>[^/]++)/cancel$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Purchase_cancel')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\PurchaseAdminController::cancelAction',  '_sonata_admin' => 'nvia_app_shop.admin.purchase',  '_sonata_name' => 'admin_app_bundle_Purchase_cancel',));
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/ClientUserHasAppAdmin')) {
                // admin_app_bundle_ClientUserHasApp_list
                if ($pathinfo === '/backoffice/ClientUserHasAppAdmin/list') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_list',  '_route' => 'admin_app_bundle_ClientUserHasApp_list',);
                }

                // admin_app_bundle_ClientUserHasApp_create
                if ($pathinfo === '/backoffice/ClientUserHasAppAdmin/create') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_create',  '_route' => 'admin_app_bundle_ClientUserHasApp_create',);
                }

                // admin_app_bundle_ClientUserHasApp_batch
                if ($pathinfo === '/backoffice/ClientUserHasAppAdmin/batch') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_batch',  '_route' => 'admin_app_bundle_ClientUserHasApp_batch',);
                }

                // admin_app_bundle_ClientUserHasApp_edit
                if (preg_match('#^/backoffice/ClientUserHasAppAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserHasApp_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_edit',));
                }

                // admin_app_bundle_ClientUserHasApp_delete
                if (preg_match('#^/backoffice/ClientUserHasAppAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserHasApp_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_delete',));
                }

                // admin_app_bundle_ClientUserHasApp_show
                if (preg_match('#^/backoffice/ClientUserHasAppAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_ClientUserHasApp_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_show',));
                }

                // admin_app_bundle_ClientUserHasApp_export
                if ($pathinfo === '/backoffice/ClientUserHasAppAdmin/export') {
                    return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.client_user_has_app',  '_sonata_name' => 'admin_app_bundle_ClientUserHasApp_export',  '_route' => 'admin_app_bundle_ClientUserHasApp_export',);
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/app')) {
                if (0 === strpos($pathinfo, '/backoffice/app/offer')) {
                    // admin_app_offer_list
                    if ($pathinfo === '/backoffice/app/offer/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_list',  '_route' => 'admin_app_offer_list',);
                    }

                    // admin_app_offer_create
                    if ($pathinfo === '/backoffice/app/offer/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_create',  '_route' => 'admin_app_offer_create',);
                    }

                    // admin_app_offer_batch
                    if ($pathinfo === '/backoffice/app/offer/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_batch',  '_route' => 'admin_app_offer_batch',);
                    }

                    // admin_app_offer_edit
                    if (preg_match('#^/backoffice/app/offer/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_offer_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_edit',));
                    }

                    // admin_app_offer_delete
                    if (preg_match('#^/backoffice/app/offer/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_offer_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_delete',));
                    }

                    // admin_app_offer_show
                    if (preg_match('#^/backoffice/app/offer/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_offer_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_show',));
                    }

                    // admin_app_offer_export
                    if ($pathinfo === '/backoffice/app/offer/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.offer',  '_sonata_name' => 'admin_app_offer_export',  '_route' => 'admin_app_offer_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/app_has_pay_method_provider_country')) {
                    // admin_app_has_pay_method_provider_country_list
                    if ($pathinfo === '/backoffice/app_has_pay_method_provider_country/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_list',  '_route' => 'admin_app_has_pay_method_provider_country_list',);
                    }

                    // admin_app_has_pay_method_provider_country_create
                    if ($pathinfo === '/backoffice/app_has_pay_method_provider_country/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_create',  '_route' => 'admin_app_has_pay_method_provider_country_create',);
                    }

                    // admin_app_has_pay_method_provider_country_batch
                    if ($pathinfo === '/backoffice/app_has_pay_method_provider_country/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_batch',  '_route' => 'admin_app_has_pay_method_provider_country_batch',);
                    }

                    // admin_app_has_pay_method_provider_country_edit
                    if (preg_match('#^/backoffice/app_has_pay_method_provider_country/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_has_pay_method_provider_country_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_edit',));
                    }

                    // admin_app_has_pay_method_provider_country_delete
                    if (preg_match('#^/backoffice/app_has_pay_method_provider_country/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_has_pay_method_provider_country_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_delete',));
                    }

                    // admin_app_has_pay_method_provider_country_show
                    if (preg_match('#^/backoffice/app_has_pay_method_provider_country/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_has_pay_method_provider_country_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_show',));
                    }

                    // admin_app_has_pay_method_provider_country_export
                    if ($pathinfo === '/backoffice/app_has_pay_method_provider_country/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.app_has_pay_method_provider_country',  '_sonata_name' => 'admin_app_has_pay_method_provider_country_export',  '_route' => 'admin_app_has_pay_method_provider_country_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/app/s')) {
                    if (0 === strpos($pathinfo, '/backoffice/app/subscription')) {
                        // admin_app_subscription_list
                        if ($pathinfo === '/backoffice/app/subscription/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_list',  '_route' => 'admin_app_subscription_list',);
                        }

                        // admin_app_subscription_create
                        if ($pathinfo === '/backoffice/app/subscription/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_create',  '_route' => 'admin_app_subscription_create',);
                        }

                        // admin_app_subscription_batch
                        if ($pathinfo === '/backoffice/app/subscription/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_batch',  '_route' => 'admin_app_subscription_batch',);
                        }

                        // admin_app_subscription_edit
                        if (preg_match('#^/backoffice/app/subscription/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_subscription_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_edit',));
                        }

                        // admin_app_subscription_delete
                        if (preg_match('#^/backoffice/app/subscription/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_subscription_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_delete',));
                        }

                        // admin_app_subscription_show
                        if (preg_match('#^/backoffice/app/subscription/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_subscription_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_show',));
                        }

                        // admin_app_subscription_export
                        if ($pathinfo === '/backoffice/app/subscription/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.subscription',  '_sonata_name' => 'admin_app_subscription_export',  '_route' => 'admin_app_subscription_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/app/single')) {
                        if (0 === strpos($pathinfo, '/backoffice/app/singlepayment')) {
                            // admin_app_singlepayment_list
                            if ($pathinfo === '/backoffice/app/singlepayment/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_list',  '_route' => 'admin_app_singlepayment_list',);
                            }

                            // admin_app_singlepayment_create
                            if ($pathinfo === '/backoffice/app/singlepayment/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_create',  '_route' => 'admin_app_singlepayment_create',);
                            }

                            // admin_app_singlepayment_batch
                            if ($pathinfo === '/backoffice/app/singlepayment/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_batch',  '_route' => 'admin_app_singlepayment_batch',);
                            }

                            // admin_app_singlepayment_edit
                            if (preg_match('#^/backoffice/app/singlepayment/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlepayment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_edit',));
                            }

                            // admin_app_singlepayment_delete
                            if (preg_match('#^/backoffice/app/singlepayment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlepayment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_delete',));
                            }

                            // admin_app_singlepayment_show
                            if (preg_match('#^/backoffice/app/singlepayment/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlepayment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_show',));
                            }

                            // admin_app_singlepayment_export
                            if ($pathinfo === '/backoffice/app/singlepayment/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.single_payment',  '_sonata_name' => 'admin_app_singlepayment_export',  '_route' => 'admin_app_singlepayment_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/backoffice/app/singlefreepayment')) {
                            // admin_app_singlefreepayment_list
                            if ($pathinfo === '/backoffice/app/singlefreepayment/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_list',  '_route' => 'admin_app_singlefreepayment_list',);
                            }

                            // admin_app_singlefreepayment_create
                            if ($pathinfo === '/backoffice/app/singlefreepayment/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_create',  '_route' => 'admin_app_singlefreepayment_create',);
                            }

                            // admin_app_singlefreepayment_batch
                            if ($pathinfo === '/backoffice/app/singlefreepayment/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_batch',  '_route' => 'admin_app_singlefreepayment_batch',);
                            }

                            // admin_app_singlefreepayment_edit
                            if (preg_match('#^/backoffice/app/singlefreepayment/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlefreepayment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_edit',));
                            }

                            // admin_app_singlefreepayment_delete
                            if (preg_match('#^/backoffice/app/singlefreepayment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlefreepayment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_delete',));
                            }

                            // admin_app_singlefreepayment_show
                            if (preg_match('#^/backoffice/app/singlefreepayment/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlefreepayment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_show',));
                            }

                            // admin_app_singlefreepayment_export
                            if ($pathinfo === '/backoffice/app/singlefreepayment/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.single_free_payment',  '_sonata_name' => 'admin_app_singlefreepayment_export',  '_route' => 'admin_app_singlefreepayment_export',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/backoffice/app/singlecustompayment')) {
                            // admin_app_singlecustompayment_list
                            if ($pathinfo === '/backoffice/app/singlecustompayment/list') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_list',  '_route' => 'admin_app_singlecustompayment_list',);
                            }

                            // admin_app_singlecustompayment_create
                            if ($pathinfo === '/backoffice/app/singlecustompayment/create') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_create',  '_route' => 'admin_app_singlecustompayment_create',);
                            }

                            // admin_app_singlecustompayment_batch
                            if ($pathinfo === '/backoffice/app/singlecustompayment/batch') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_batch',  '_route' => 'admin_app_singlecustompayment_batch',);
                            }

                            // admin_app_singlecustompayment_edit
                            if (preg_match('#^/backoffice/app/singlecustompayment/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlecustompayment_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_edit',));
                            }

                            // admin_app_singlecustompayment_delete
                            if (preg_match('#^/backoffice/app/singlecustompayment/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlecustompayment_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_delete',));
                            }

                            // admin_app_singlecustompayment_show
                            if (preg_match('#^/backoffice/app/singlecustompayment/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_singlecustompayment_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_show',));
                            }

                            // admin_app_singlecustompayment_export
                            if ($pathinfo === '/backoffice/app/singlecustompayment/export') {
                                return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.single_custom_payment',  '_sonata_name' => 'admin_app_singlecustompayment_export',  '_route' => 'admin_app_singlecustompayment_export',);
                            }

                        }

                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/app/affiliate')) {
                    // admin_app_affiliate_list
                    if ($pathinfo === '/backoffice/app/affiliate/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_list',  '_route' => 'admin_app_affiliate_list',);
                    }

                    // admin_app_affiliate_create
                    if ($pathinfo === '/backoffice/app/affiliate/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_create',  '_route' => 'admin_app_affiliate_create',);
                    }

                    // admin_app_affiliate_batch
                    if ($pathinfo === '/backoffice/app/affiliate/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_batch',  '_route' => 'admin_app_affiliate_batch',);
                    }

                    // admin_app_affiliate_edit
                    if (preg_match('#^/backoffice/app/affiliate/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_affiliate_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_edit',));
                    }

                    // admin_app_affiliate_delete
                    if (preg_match('#^/backoffice/app/affiliate/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_affiliate_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_delete',));
                    }

                    // admin_app_affiliate_show
                    if (preg_match('#^/backoffice/app/affiliate/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_affiliate_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_show',));
                    }

                    // admin_app_affiliate_export
                    if ($pathinfo === '/backoffice/app/affiliate/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.affiliate',  '_sonata_name' => 'admin_app_affiliate_export',  '_route' => 'admin_app_affiliate_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/app/fin')) {
                    if (0 === strpos($pathinfo, '/backoffice/app/fininvoice')) {
                        // admin_app_fininvoice_list
                        if ($pathinfo === '/backoffice/app/fininvoice/list') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::listAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_list',  '_route' => 'admin_app_fininvoice_list',);
                        }

                        // admin_app_fininvoice_create
                        if ($pathinfo === '/backoffice/app/fininvoice/create') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::createAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_create',  '_route' => 'admin_app_fininvoice_create',);
                        }

                        // admin_app_fininvoice_batch
                        if ($pathinfo === '/backoffice/app/fininvoice/batch') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::batchAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_batch',  '_route' => 'admin_app_fininvoice_batch',);
                        }

                        // admin_app_fininvoice_edit
                        if (preg_match('#^/backoffice/app/fininvoice/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fininvoice_edit')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::editAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_edit',));
                        }

                        // admin_app_fininvoice_delete
                        if (preg_match('#^/backoffice/app/fininvoice/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fininvoice_delete')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::deleteAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_delete',));
                        }

                        // admin_app_fininvoice_show
                        if (preg_match('#^/backoffice/app/fininvoice/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_fininvoice_show')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::showAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_show',));
                        }

                        // admin_app_fininvoice_export
                        if ($pathinfo === '/backoffice/app/fininvoice/export') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\InvoiceController::exportAction',  '_sonata_admin' => 'app.admin.fin_invoice',  '_sonata_name' => 'admin_app_fininvoice_export',  '_route' => 'admin_app_fininvoice_export',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/backoffice/app/finmovement')) {
                        // admin_app_finmovement_list
                        if ($pathinfo === '/backoffice/app/finmovement/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_list',  '_route' => 'admin_app_finmovement_list',);
                        }

                        // admin_app_finmovement_create
                        if ($pathinfo === '/backoffice/app/finmovement/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_create',  '_route' => 'admin_app_finmovement_create',);
                        }

                        // admin_app_finmovement_batch
                        if ($pathinfo === '/backoffice/app/finmovement/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_batch',  '_route' => 'admin_app_finmovement_batch',);
                        }

                        // admin_app_finmovement_edit
                        if (preg_match('#^/backoffice/app/finmovement/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_finmovement_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_edit',));
                        }

                        // admin_app_finmovement_delete
                        if (preg_match('#^/backoffice/app/finmovement/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_finmovement_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_delete',));
                        }

                        // admin_app_finmovement_show
                        if (preg_match('#^/backoffice/app/finmovement/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_finmovement_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_show',));
                        }

                        // admin_app_finmovement_export
                        if ($pathinfo === '/backoffice/app/finmovement/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.fin_movement',  '_sonata_name' => 'admin_app_finmovement_export',  '_route' => 'admin_app_finmovement_export',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/app/clientdocument')) {
                    // admin_app_clientdocument_list
                    if ($pathinfo === '/backoffice/app/clientdocument/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_list',  '_route' => 'admin_app_clientdocument_list',);
                    }

                    // admin_app_clientdocument_create
                    if ($pathinfo === '/backoffice/app/clientdocument/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_create',  '_route' => 'admin_app_clientdocument_create',);
                    }

                    // admin_app_clientdocument_batch
                    if ($pathinfo === '/backoffice/app/clientdocument/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_batch',  '_route' => 'admin_app_clientdocument_batch',);
                    }

                    // admin_app_clientdocument_edit
                    if (preg_match('#^/backoffice/app/clientdocument/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clientdocument_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_edit',));
                    }

                    // admin_app_clientdocument_delete
                    if (preg_match('#^/backoffice/app/clientdocument/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clientdocument_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_delete',));
                    }

                    // admin_app_clientdocument_show
                    if (preg_match('#^/backoffice/app/clientdocument/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_clientdocument_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_show',));
                    }

                    // admin_app_clientdocument_export
                    if ($pathinfo === '/backoffice/app/clientdocument/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.client_document',  '_sonata_name' => 'admin_app_clientdocument_export',  '_route' => 'admin_app_clientdocument_export',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/sonata/media')) {
                if (0 === strpos($pathinfo, '/backoffice/sonata/media/media')) {
                    // admin_sonata_media_media_list
                    if ($pathinfo === '/backoffice/sonata/media/media/list') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_list',  '_route' => 'admin_sonata_media_media_list',);
                    }

                    // admin_sonata_media_media_create
                    if ($pathinfo === '/backoffice/sonata/media/media/create') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_create',  '_route' => 'admin_sonata_media_media_create',);
                    }

                    // admin_sonata_media_media_batch
                    if ($pathinfo === '/backoffice/sonata/media/media/batch') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_batch',  '_route' => 'admin_sonata_media_media_batch',);
                    }

                    // admin_sonata_media_media_edit
                    if (preg_match('#^/backoffice/sonata/media/media/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_edit',));
                    }

                    // admin_sonata_media_media_delete
                    if (preg_match('#^/backoffice/sonata/media/media/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_delete',));
                    }

                    // admin_sonata_media_media_show
                    if (preg_match('#^/backoffice/sonata/media/media/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_media_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_show',));
                    }

                    // admin_sonata_media_media_export
                    if ($pathinfo === '/backoffice/sonata/media/media/export') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.media',  '_sonata_name' => 'admin_sonata_media_media_export',  '_route' => 'admin_sonata_media_media_export',);
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/sonata/media/gallery')) {
                    // admin_sonata_media_gallery_list
                    if ($pathinfo === '/backoffice/sonata/media/gallery/list') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_list',  '_route' => 'admin_sonata_media_gallery_list',);
                    }

                    // admin_sonata_media_gallery_create
                    if ($pathinfo === '/backoffice/sonata/media/gallery/create') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_create',  '_route' => 'admin_sonata_media_gallery_create',);
                    }

                    // admin_sonata_media_gallery_batch
                    if ($pathinfo === '/backoffice/sonata/media/gallery/batch') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_batch',  '_route' => 'admin_sonata_media_gallery_batch',);
                    }

                    // admin_sonata_media_gallery_edit
                    if (preg_match('#^/backoffice/sonata/media/gallery/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_edit')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_edit',));
                    }

                    // admin_sonata_media_gallery_delete
                    if (preg_match('#^/backoffice/sonata/media/gallery/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_delete')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_delete',));
                    }

                    // admin_sonata_media_gallery_show
                    if (preg_match('#^/backoffice/sonata/media/gallery/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_gallery_show')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_show',));
                    }

                    // admin_sonata_media_gallery_export
                    if ($pathinfo === '/backoffice/sonata/media/gallery/export') {
                        return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryAdminController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery',  '_sonata_name' => 'admin_sonata_media_gallery_export',  '_route' => 'admin_sonata_media_gallery_export',);
                    }

                    if (0 === strpos($pathinfo, '/backoffice/sonata/media/galleryhasmedia')) {
                        // admin_sonata_media_galleryhasmedia_list
                        if ($pathinfo === '/backoffice/sonata/media/galleryhasmedia/list') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_list',  '_route' => 'admin_sonata_media_galleryhasmedia_list',);
                        }

                        // admin_sonata_media_galleryhasmedia_create
                        if ($pathinfo === '/backoffice/sonata/media/galleryhasmedia/create') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_create',  '_route' => 'admin_sonata_media_galleryhasmedia_create',);
                        }

                        // admin_sonata_media_galleryhasmedia_batch
                        if ($pathinfo === '/backoffice/sonata/media/galleryhasmedia/batch') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_batch',  '_route' => 'admin_sonata_media_galleryhasmedia_batch',);
                        }

                        // admin_sonata_media_galleryhasmedia_edit
                        if (preg_match('#^/backoffice/sonata/media/galleryhasmedia/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_edit',));
                        }

                        // admin_sonata_media_galleryhasmedia_delete
                        if (preg_match('#^/backoffice/sonata/media/galleryhasmedia/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_delete',));
                        }

                        // admin_sonata_media_galleryhasmedia_show
                        if (preg_match('#^/backoffice/sonata/media/galleryhasmedia/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_sonata_media_galleryhasmedia_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_show',));
                        }

                        // admin_sonata_media_galleryhasmedia_export
                        if ($pathinfo === '/backoffice/sonata/media/galleryhasmedia/export') {
                            return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'sonata.media.admin.gallery_has_media',  '_sonata_name' => 'admin_sonata_media_galleryhasmedia_export',  '_route' => 'admin_sonata_media_galleryhasmedia_export',);
                        }

                    }

                }

            }

            if (0 === strpos($pathinfo, '/backoffice/lexik/translation/transunit')) {
                // admin_lexik_translation_transunit_list
                if ($pathinfo === '/backoffice/lexik/translation/transunit/list') {
                    return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::listAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_list',  '_route' => 'admin_lexik_translation_transunit_list',);
                }

                // admin_lexik_translation_transunit_create
                if ($pathinfo === '/backoffice/lexik/translation/transunit/create') {
                    return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::createAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_create',  '_route' => 'admin_lexik_translation_transunit_create',);
                }

                // admin_lexik_translation_transunit_batch
                if ($pathinfo === '/backoffice/lexik/translation/transunit/batch') {
                    return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::batchAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_batch',  '_route' => 'admin_lexik_translation_transunit_batch',);
                }

                // admin_lexik_translation_transunit_edit
                if (preg_match('#^/backoffice/lexik/translation/transunit/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_lexik_translation_transunit_edit')), array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::editAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_edit',));
                }

                // admin_lexik_translation_transunit_delete
                if (preg_match('#^/backoffice/lexik/translation/transunit/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_lexik_translation_transunit_delete')), array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::deleteAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_delete',));
                }

                // admin_lexik_translation_transunit_show
                if (preg_match('#^/backoffice/lexik/translation/transunit/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_lexik_translation_transunit_show')), array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::showAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_show',));
                }

                // admin_lexik_translation_transunit_export
                if ($pathinfo === '/backoffice/lexik/translation/transunit/export') {
                    return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::exportAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_export',  '_route' => 'admin_lexik_translation_transunit_export',);
                }

                if (0 === strpos($pathinfo, '/backoffice/lexik/translation/transunit/c')) {
                    // admin_lexik_translation_transunit_clear_cache
                    if ($pathinfo === '/backoffice/lexik/translation/transunit/clear_cache') {
                        return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::clearCacheAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_clear_cache',  '_route' => 'admin_lexik_translation_transunit_clear_cache',);
                    }

                    // admin_lexik_translation_transunit_create_trans_unit
                    if ($pathinfo === '/backoffice/lexik/translation/transunit/create_trans_unit') {
                        return array (  '_controller' => 'Ibrows\\SonataTranslationBundle\\Controller\\TranslationCRUDController::createTransUnitAction',  '_sonata_admin' => 'ibrows_sonata_translation.admin.orm',  '_sonata_name' => 'admin_lexik_translation_transunit_create_trans_unit',  '_route' => 'admin_lexik_translation_transunit_create_trans_unit',);
                    }

                }

            }

        }

        // fos_js_routing_js
        if (0 === strpos($pathinfo, '/js/routing') && preg_match('#^/js/routing(?:\\.(?P<_format>js|json))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'fos_js_routing_js')), array (  '_controller' => 'fos_js_routing.controller:indexAction',  '_format' => 'js',));
        }

        if (0 === strpos($pathinfo, '/translator')) {
            // lexik_translation_overview
            if (rtrim($pathinfo, '/') === '/translator') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lexik_translation_overview;
                }

                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'lexik_translation_overview');
                }

                return array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\TranslationController::overviewAction',  '_route' => 'lexik_translation_overview',);
            }
            not_lexik_translation_overview:

            if (0 === strpos($pathinfo, '/translator/grid')) {
                // lexik_translation_grid
                if ($pathinfo === '/translator/grid') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_lexik_translation_grid;
                    }

                    return array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\TranslationController::gridAction',  '_route' => 'lexik_translation_grid',);
                }
                not_lexik_translation_grid:

                // lexik_translation_grid_only_two_columns
                if (preg_match('#^/translator/grid/(?P<locale>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_lexik_translation_grid_only_two_columns;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'lexik_translation_grid_only_two_columns')), array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\TranslationController::gridOnlyTwoColumnsAction',));
                }
                not_lexik_translation_grid_only_two_columns:

            }

            // lexik_translation_new
            if ($pathinfo === '/translator/new') {
                if (!in_array($this->context->getMethod(), array('GET', 'POST', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'POST', 'HEAD'));
                    goto not_lexik_translation_new;
                }

                return array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\TranslationController::newAction',  '_route' => 'lexik_translation_new',);
            }
            not_lexik_translation_new:

            // lexik_translation_invalidate_cache
            if ($pathinfo === '/translator/invalidate-cache') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_lexik_translation_invalidate_cache;
                }

                return array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\TranslationController::invalidateCacheAction',  '_route' => 'lexik_translation_invalidate_cache',);
            }
            not_lexik_translation_invalidate_cache:

            if (0 === strpos($pathinfo, '/translator/api/translations')) {
                // lexik_translation_list
                if ($pathinfo === '/translator/api/translations') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_lexik_translation_list;
                    }

                    return array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\RestController::listAction',  '_route' => 'lexik_translation_list',);
                }
                not_lexik_translation_list:

                // lexik_translation_profiler
                if (0 === strpos($pathinfo, '/translator/api/translations/profiler') && preg_match('#^/translator/api/translations/profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_lexik_translation_profiler;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'lexik_translation_profiler')), array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\RestController::listByProfileAction',));
                }
                not_lexik_translation_profiler:

                // lexik_translation_update
                if (preg_match('#^/translator/api/translations/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_lexik_translation_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'lexik_translation_update')), array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\RestController::updateAction',));
                }
                not_lexik_translation_update:

                // lexik_translation_delete_locale
                if (preg_match('#^/translator/api/translations/(?P<id>[^/]++)/(?P<locale>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_lexik_translation_delete_locale;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'lexik_translation_delete_locale')), array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\RestController::deleteTranslationAction',));
                }
                not_lexik_translation_delete_locale:

                // lexik_translation_delete
                if (preg_match('#^/translator/api/translations/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'DELETE') {
                        $allow[] = 'DELETE';
                        goto not_lexik_translation_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'lexik_translation_delete')), array (  '_controller' => 'Lexik\\Bundle\\TranslationBundle\\Controller\\RestController::deleteAction',));
                }
                not_lexik_translation_delete:

            }

        }

        if (0 === strpos($pathinfo, '/backoffice/media')) {
            if (0 === strpos($pathinfo, '/backoffice/media/gallery')) {
                // sonata_media_gallery_index
                if (rtrim($pathinfo, '/') === '/backoffice/media/gallery') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'sonata_media_gallery_index');
                    }

                    return array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::indexAction',  '_route' => 'sonata_media_gallery_index',);
                }

                // sonata_media_gallery_view
                if (0 === strpos($pathinfo, '/backoffice/media/gallery/view') && preg_match('#^/backoffice/media/gallery/view/(?P<id>.*)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_gallery_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\GalleryController::viewAction',));
                }

            }

            // sonata_media_view
            if (0 === strpos($pathinfo, '/backoffice/media/view') && preg_match('#^/backoffice/media/view/(?P<id>[^/]++)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_view')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::viewAction',  'format' => 'reference',));
            }

            // sonata_media_download
            if (0 === strpos($pathinfo, '/backoffice/media/download') && preg_match('#^/backoffice/media/download/(?P<id>.*)(?:/(?P<format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'sonata_media_download')), array (  '_controller' => 'Sonata\\MediaBundle\\Controller\\MediaController::downloadAction',  'format' => 'reference',));
            }

        }

        if (0 === strpos($pathinfo, '/api/v1')) {
            if (0 === strpos($pathinfo, '/api/v1/test')) {
                // api_default_get_test
                if (preg_match('#^/api/v1/test(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_default_get_test;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_default_get_test')), array (  '_controller' => 'AppBundle\\Controller\\Api\\DefaultController::getTestAction',  '_format' => 'json',));
                }
                not_api_default_get_test:

                // api_default_get_test_param_converter
                if (0 === strpos($pathinfo, '/api/v1/tests') && preg_match('#^/api/v1/tests/(?P<country>[^/]++)/param/converter(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_default_get_test_param_converter;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_default_get_test_param_converter')), array (  '_controller' => 'AppBundle\\Controller\\Api\\DefaultController::getTestParamConverterAction',  '_format' => 'json',));
                }
                not_api_default_get_test_param_converter:

            }

            // api_country_get_countries
            if (0 === strpos($pathinfo, '/api/v1/country') && preg_match('#^/api/v1/country(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_country_get_countries;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_country_get_countries')), array (  '_controller' => 'AppBundle\\Controller\\Api\\CountryController::getCountriesAction',  '_format' => 'json',));
            }
            not_api_country_get_countries:

            if (0 === strpos($pathinfo, '/api/v1/article')) {
                // api_article_get_articles
                if (preg_match('#^/api/v1/article(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_article_get_articles;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_article_get_articles')), array (  '_controller' => 'AppBundle\\Controller\\Api\\ArticleController::getArticlesAction',  '_format' => 'json',));
                }
                not_api_article_get_articles:

                // api_article_get_articles_by_country
                if (0 === strpos($pathinfo, '/api/v1/articles/country') && preg_match('#^/api/v1/articles/country/(?P<country>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_article_get_articles_by_country;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_article_get_articles_by_country')), array (  '_controller' => 'AppBundle\\Controller\\Api\\ArticleController::getArticlesByCountryAction',  '_format' => 'json',));
                }
                not_api_article_get_articles_by_country:

            }

            // api_article_get_calculate_price_shopping_cart
            if (0 === strpos($pathinfo, '/api/v1/calculate_price_cart') && preg_match('#^/api/v1/calculate_price_cart/(?P<transaction_id>[^/]++)/(?P<country>[^/]++)/(?P<articles_ids>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_article_get_calculate_price_shopping_cart;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_article_get_calculate_price_shopping_cart')), array (  '_controller' => 'AppBundle\\Controller\\Api\\ArticleController::getCalculatePriceShoppingCartAction',  '_format' => 'json',));
            }
            not_api_article_get_calculate_price_shopping_cart:

            // api_article_tab_get_tabs
            if (0 === strpos($pathinfo, '/api/v1/tab') && preg_match('#^/api/v1/tab(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_article_tab_get_tabs;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_article_tab_get_tabs')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TabController::getTabsAction',  '_format' => 'json',));
            }
            not_api_article_tab_get_tabs:

            if (0 === strpos($pathinfo, '/api/v1/paymethod')) {
                // api_pay_method_get_pay_methods_with_amount_fixed
                if (0 === strpos($pathinfo, '/api/v1/paymethod/amount-fixed') && preg_match('#^/api/v1/paymethod/amount\\-fixed(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_pay_method_get_pay_methods_with_amount_fixed;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pay_method_get_pay_methods_with_amount_fixed')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PayMethodController::getPayMethodsWithAmountFixedAction',  '_format' => 'json',));
                }
                not_api_pay_method_get_pay_methods_with_amount_fixed:

                // api_pay_method_get_pay_methods
                if (preg_match('#^/api/v1/paymethod(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_pay_method_get_pay_methods;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pay_method_get_pay_methods')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PayMethodController::getPayMethodsAction',  '_format' => 'json',));
                }
                not_api_pay_method_get_pay_methods:

            }

            // api_pay_method_get_direct_pay_methods_by_country
            if (0 === strpos($pathinfo, '/api/v1/direct_payment/paymethods/country') && preg_match('#^/api/v1/direct_payment/paymethods/country/(?P<country>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_pay_method_get_direct_pay_methods_by_country;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_pay_method_get_direct_pay_methods_by_country')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PayMethodController::getDirectPayMethodsByCountryAction',  '_format' => 'json',));
            }
            not_api_pay_method_get_direct_pay_methods_by_country:

            if (0 === strpos($pathinfo, '/api/v1/transaction')) {
                // api_transaction_create_transaction
                if (preg_match('#^/api/v1/transaction(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_transaction_create_transaction;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_create_transaction')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::createTransactionAction',  '_format' => 'json',));
                }
                not_api_transaction_create_transaction:

                if (0 === strpos($pathinfo, '/api/v1/transaction_')) {
                    // api_transaction_create_transaction_custom
                    if (0 === strpos($pathinfo, '/api/v1/transaction_simple') && preg_match('#^/api/v1/transaction_simple(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_transaction_create_transaction_custom;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_create_transaction_custom')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::createTransactionCustomAction',  '_format' => 'json',));
                    }
                    not_api_transaction_create_transaction_custom:

                    // api_transaction_create_transaction_custom_widget
                    if (0 === strpos($pathinfo, '/api/v1/transaction_widget') && preg_match('#^/api/v1/transaction_widget(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_transaction_create_transaction_custom_widget;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_create_transaction_custom_widget')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::createTransactionCustomWidgetAction',  '_format' => 'json',));
                    }
                    not_api_transaction_create_transaction_custom_widget:

                }

                // api_transaction_get_transaction
                if (preg_match('#^/api/v1/transaction/(?P<transaction_id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_transaction_get_transaction;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_get_transaction')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::getTransactionAction',  '_format' => 'json',));
                }
                not_api_transaction_get_transaction:

                // api_transaction_get_transaction_info
                if (0 === strpos($pathinfo, '/api/v1/transaction_info') && preg_match('#^/api/v1/transaction_info/(?P<transaction_id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_transaction_get_transaction_info;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_get_transaction_info')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::getTransactionInfoAction',  '_format' => 'json',));
                }
                not_api_transaction_get_transaction_info:

            }

            // api_transaction_post_virtual_currency_exchange
            if (0 === strpos($pathinfo, '/api/v1/virtual_currency/exchange') && preg_match('#^/api/v1/virtual_currency/exchange(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_transaction_post_virtual_currency_exchange;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_post_virtual_currency_exchange')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::postVirtualCurrencyExchangeAction',  '_format' => 'json',));
            }
            not_api_transaction_post_virtual_currency_exchange:

            if (0 === strpos($pathinfo, '/api/v1/trans')) {
                // update_gacha_notification
                if (0 === strpos($pathinfo, '/api/v1/trans3action') && preg_match('#^/api/v1/trans3action/(?P<transaction_id>[^/]++)/notification/pdahga/(?P<pdahga_id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PATCH') {
                        $allow[] = 'PATCH';
                        goto not_update_gacha_notification;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'update_gacha_notification')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PurchaseNotificationController::updateGachaNotificationAction',  '_format' => 'json',));
                }
                not_update_gacha_notification:

                // get_notification
                if (0 === strpos($pathinfo, '/api/v1/transaction/notification') && preg_match('#^/api/v1/transaction/notification/(?P<notification_id>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_get_notification;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_notification')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PurchaseNotificationController::getNotificationAction',  '_format' => 'json',));
                }
                not_get_notification:

            }

            if (0 === strpos($pathinfo, '/api/v1/promo_code')) {
                // api_promo_code_is_valid
                if (0 === strpos($pathinfo, '/api/v1/promo_code/check/gamer') && preg_match('#^/api/v1/promo_code/check/gamer/(?P<gamer_id>.+?)/promo_code/(?P<promo_code>.+?)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_promo_code_is_valid;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_is_valid')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::isValidAction',  '_format' => 'json',));
                }
                not_api_promo_code_is_valid:

                // api_promo_code_create_promo
                if (preg_match('#^/api/v1/promo_code(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_promo_code_create_promo;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_create_promo')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::createPromoAction',  '_format' => 'json',));
                }
                not_api_promo_code_create_promo:

                // api_promo_code_create_a_purchase_by_promo
                if (0 === strpos($pathinfo, '/api/v1/promo_code/use') && preg_match('#^/api/v1/promo_code/use(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_promo_code_create_a_purchase_by_promo;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_create_a_purchase_by_promo')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::createAPurchaseByPromoAction',  '_format' => 'json',));
                }
                not_api_promo_code_create_a_purchase_by_promo:

                // api_promo_code_update_promo
                if (preg_match('#^/api/v1/promo_code/(?P<promo_code>.+?)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PUT') {
                        $allow[] = 'PUT';
                        goto not_api_promo_code_update_promo;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_update_promo')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::updatePromoAction',  '_format' => 'json',));
                }
                not_api_promo_code_update_promo:

            }

            if (0 === strpos($pathinfo, '/api/v1/gamer')) {
                // api_gamer_post_gamer
                if (preg_match('#^/api/v1/gamer(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_gamer_post_gamer;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_gamer_post_gamer')), array (  '_controller' => 'AppBundle\\Controller\\Api\\GamerController::postGamerAction',  '_format' => 'json',));
                }
                not_api_gamer_post_gamer:

                // api_gamer_patch_gamer
                if (preg_match('#^/api/v1/gamer/(?P<gamer_id>.+?)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'PATCH') {
                        $allow[] = 'PATCH';
                        goto not_api_gamer_patch_gamer;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_gamer_patch_gamer')), array (  '_controller' => 'AppBundle\\Controller\\Api\\GamerController::patchGamerAction',  '_format' => 'json',));
                }
                not_api_gamer_patch_gamer:

            }

            // item_tab_get_item_tabs
            if (0 === strpos($pathinfo, '/api/v1/item_tab') && preg_match('#^/api/v1/item_tab(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_item_tab_get_item_tabs;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'item_tab_get_item_tabs')), array (  '_controller' => 'AppBundle\\Controller\\Api\\ItemTabController::getItemTabsAction',  '_format' => 'json',));
            }
            not_item_tab_get_item_tabs:

            // get_wallet_conf_by_country
            if (0 === strpos($pathinfo, '/api/v1/wallet/info/country') && preg_match('#^/api/v1/wallet/info/country/(?P<country>[^/\\.]++)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_get_wallet_conf_by_country;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_wallet_conf_by_country')), array (  '_controller' => 'AppBundle\\Controller\\Api\\WalletController::getWalletConfByCountryAction',  '_format' => 'json',));
            }
            not_get_wallet_conf_by_country:

        }

        if (0 === strpos($pathinfo, '/shop')) {
            if (0 === strpos($pathinfo, '/shop/payment')) {
                if (0 === strpos($pathinfo, '/shop/payment/begin')) {
                    // payment_wallet
                    if (0 === strpos($pathinfo, '/shop/payment/begin/wallet_transaction') && preg_match('#^/shop/payment/begin/wallet_transaction/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/(?P<pay_method_id>[^/]++)/(?P<country>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_wallet')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::walletCreateProcessAction',));
                    }

                    // payment_begin_simple_transaction
                    if (0 === strpos($pathinfo, '/shop/payment/begin/simple_transaction') && preg_match('#^/shop/payment/begin/simple_transaction/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_begin_simple_transaction')), array (  'article_title' => '',  'article_description' => '',  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::beginSimpleTransactionAction',));
                    }

                    // payment_begin
                    if (preg_match('#^/shop/payment/begin/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)/(?P<article_ids>[^/]++)/(?P<country>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_begin')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::beginAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/shop/payment/i')) {
                    if (0 === strpos($pathinfo, '/shop/payment/ipn')) {
                        // cancel_subscription
                        if (0 === strpos($pathinfo, '/shop/payment/ipn/cancel') && preg_match('#^/shop/payment/ipn/cancel/(?P<transaction_id>[^/]++)/subscription/(?P<subscription_id>[^/]++)/(?P<security>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'cancel_subscription')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::ipnCancelSubscription',));
                        }

                        // payment_ipn_static
                        if (0 === strpos($pathinfo, '/shop/payment/ipn_static') && preg_match('#^/shop/payment/ipn_static/(?P<service_id>[^/]++)/?$#s', $pathinfo, $matches)) {
                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'payment_ipn_static');
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_ipn_static')), array (  '_format' => 'json',  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::ipnStaticAction',));
                        }

                        // payment_ipn
                        if (preg_match('#^/shop/payment/ipn/(?P<payment_process_id>[^/]++)/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<security_random>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_ipn')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::ipnAction',));
                        }

                    }

                    // intermediate_step
                    if (0 === strpos($pathinfo, '/shop/payment/intermediate-step') && preg_match('#^/shop/payment/intermediate\\-step/(?P<payment_process_id>[^/]++)/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<security_random>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'intermediate_step')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::intermediateStepAction',));
                    }

                }

                // payment_refund
                if (0 === strpos($pathinfo, '/shop/payment/refund') && preg_match('#^/shop/payment/refund/(?P<purchase_id>[^/]++)/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<security_random>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_refund')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::RefundAction',));
                }

                if (0 === strpos($pathinfo, '/shop/payment/done')) {
                    // payment_done
                    if (preg_match('#^/shop/payment/done/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/(?P<payment_process_id>[^/]++)/(?P<security_random>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_done')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::doneAction',));
                    }

                    // payment_done_static
                    if (0 === strpos($pathinfo, '/shop/payment/done_static') && preg_match('#^/shop/payment/done_static/(?P<serviceId>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'payment_done_static');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_done_static')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::doneStaticAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/shop/payment/cancel')) {
                    // payment_cancel_static
                    if (0 === strpos($pathinfo, '/shop/payment/cancel_static') && preg_match('#^/shop/payment/cancel_static/(?P<serviceId>[^/]++)/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'payment_cancel_static');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_cancel_static')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::cancelStaticAction',));
                    }

                    // payment_cancel
                    if (preg_match('#^/shop/payment/cancel/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/(?P<payment_process_id>[^/]++)/(?P<security_random>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_cancel')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentController::cancelAction',));
                    }

                }

            }

            // payment_email_required_form
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/requirements/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)/email$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_email_required_form')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentRequirementsController::emailAction',));
            }

            // payment_steam_id_required_form
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/requirements/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)/steamId$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_steam_id_required_form')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentRequirementsController::steamIdAction',));
            }

            // payment_steam_id_callback_required_form
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/requirements/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)/steamId/callback$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'payment_steam_id_callback_required_form')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentRequirementsController::steamCallbackAction',));
            }

            // dynamic_required_form
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/requirements/(?P<_locale>[^/]++)/(?P<pmpc_id>[^/]++)/dynamic$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'dynamic_required_form')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\PaymentRequirementsController::genericRequirementsAction',));
            }

            // shop_index
            if (preg_match('#^/shop/(?P<transaction_id>[^\\.\\/]+?)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'shop_index')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\ShopController::indexAction',));
            }

            // shop_index_js
            if (preg_match('#^/shop/(?P<transaction_id>[^\\.]+?)\\.script$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'shop_index_js')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\ShopController::indexJsAction',));
            }

            // shop_finished
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/finished$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'shop_finished')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\ShopController::finishedAction',));
            }

            // feed_back
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/feedback$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'feed_back')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\ShopController::feedbackAction',));
            }

            // gamer_update_data
            if (preg_match('#^/shop/(?P<transaction_id>[^/]++)/(?P<_locale>[^/]++)/gamer\\-update\\-data$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gamer_update_data')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\ShopController::gamerUpdateDataAction',));
            }

            // support_gamer
            if (0 === strpos($pathinfo, '/shop/support') && preg_match('#^/shop/support/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'support_gamer')), array (  '_controller' => 'AppBundle\\Controller\\AppShop\\SupportController::gamerAction',));
            }

            // hosted_credit_card
            if (0 === strpos($pathinfo, '/shop/credit-card/credit_card') && preg_match('#^/shop/credit\\-card/credit_card/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<payment_process_id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'hosted_credit_card')), array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\CreditCardController::creditCardAction',));
            }

            // hosted_mol_thailand
            if (0 === strpos($pathinfo, '/shop/mol-thailand') && preg_match('#^/shop/mol\\-thailand/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<payment_process_id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'hosted_mol_thailand')), array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\MOLThailandController::indexAction',));
            }

            if (0 === strpos($pathinfo, '/shop/sms')) {
                if (0 === strpos($pathinfo, '/shop/sms_fortuno')) {
                    // fortuno_sms_logic_mo_mt_code
                    if (0 === strpos($pathinfo, '/shop/sms_fortuno/logic_mo_mt_code') && preg_match('#^/shop/sms_fortuno/logic_mo_mt_code/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<payment_process_id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'fortuno_sms_logic_mo_mt_code')), array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\FortunoSMSController::logicMoMtCodeAction',));
                    }

                    // fortuno_billing
                    if ($pathinfo === '/shop/sms_fortuno/billing') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\FortunoSMSController::billingAction',  '_route' => 'fortuno_billing',);
                    }

                    // fortuno_sms_ipn
                    if ($pathinfo === '/shop/sms_fortuno/ipn_static') {
                        return array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\FortunoSMSController::ipnStaticAction',  '_route' => 'fortuno_sms_ipn',);
                    }

                }

                // sms_logic_mo_mt_code
                if (0 === strpos($pathinfo, '/shop/sms/logic_mo_mt_code') && preg_match('#^/shop/sms/logic_mo_mt_code/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<payment_process_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'sms_logic_mo_mt_code')), array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\SMSController::logicMoMtCodeAction',));
                }

                // sms_ipn
                if ($pathinfo === '/shop/sms/ipn_static') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\SMSController::ipnStaticAction',  '_route' => 'sms_ipn',);
                }

            }

            if (0 === strpos($pathinfo, '/shop/voice')) {
                // voice_vo_vt_code
                if (0 === strpos($pathinfo, '/shop/voice/logic_vo_vt_code') && preg_match('#^/shop/voice/logic_vo_vt_code/(?P<_locale>[^/]++)/(?P<transaction_id>[^/]++)/(?P<payment_process_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'voice_vo_vt_code')), array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\VoiceController::logicVoVtCodeAction',));
                }

                // voice_ipn
                if ($pathinfo === '/shop/voice/ipn_static') {
                    return array (  '_controller' => 'AppBundle\\Controller\\PaymentHosted\\NviaPayMethods\\VoiceController::ipnStaticAction',  '_route' => 'voice_ipn',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/backoffice')) {
            if (0 === strpos($pathinfo, '/backoffice/billing')) {
                if (0 === strpos($pathinfo, '/backoffice/billing/pending')) {
                    // billing_invoices_pending_list
                    if ($pathinfo === '/backoffice/billing/pending/list') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BillingInvoiceAdminController::indexAction',  '_route' => 'billing_invoices_pending_list',);
                    }

                    // billing_invoices_pending_count
                    if ($pathinfo === '/backoffice/billing/pending/count') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\BillingInvoiceAdminController::countAction',  '_route' => 'billing_invoices_pending_count',);
                    }

                    // billing_invoices_pending_approve
                    if (0 === strpos($pathinfo, '/backoffice/billing/pending/approve') && preg_match('#^/backoffice/billing/pending/approve/(?P<client_id>[^/]++)/(?P<date_reference>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_invoices_pending_approve')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BillingInvoiceAdminController::approveAction',));
                    }

                    // billing_invoices_pending_decline
                    if (0 === strpos($pathinfo, '/backoffice/billing/pending/decline') && preg_match('#^/backoffice/billing/pending/decline/(?P<client_id>[^/]++)/(?P<date_reference>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_invoices_pending_decline')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BillingInvoiceAdminController::declineAction',));
                    }

                }

                // billing_invoices_regenerate
                if (0 === strpos($pathinfo, '/backoffice/billing/regenerate') && preg_match('#^/backoffice/billing/regenerate/(?P<client_id>[^/]++)/(?P<date_reference>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_invoices_regenerate')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\BillingInvoiceAdminController::regenerateAction',));
                }

            }

            if (0 === strpos($pathinfo, '/backoffice/stats_')) {
                if (0 === strpos($pathinfo, '/backoffice/stats_pay_to_')) {
                    if (0 === strpos($pathinfo, '/backoffice/stats_pay_to_clients')) {
                        // stats_pay_to_clients_summary
                        if ($pathinfo === '/backoffice/stats_pay_to_clients/summary') {
                            return array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsToPayClientsController::indexAction',  '_route' => 'stats_pay_to_clients_summary',);
                        }

                        // stats_pay_to_clients_data
                        if (0 === strpos($pathinfo, '/backoffice/stats_pay_to_clients/data') && preg_match('#^/backoffice/stats_pay_to_clients/data/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'stats_pay_to_clients_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsToPayClientsController::dataAction',));
                        }

                    }

                    // stats_pay_to_provider_data
                    if (0 === strpos($pathinfo, '/backoffice/stats_pay_to_providers/data') && preg_match('#^/backoffice/stats_pay_to_providers/data/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'stats_pay_to_provider_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsToPayClientsController::dataProvidersAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/backoffice/stats_vat')) {
                    // stats_vat_index
                    if (rtrim($pathinfo, '/') === '/backoffice/stats_vat') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'stats_vat_index');
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsVatToPayController::indexAction',  '_route' => 'stats_vat_index',);
                    }

                    if (0 === strpos($pathinfo, '/backoffice/stats_vat/data')) {
                        // stats_vat_data
                        if (preg_match('#^/backoffice/stats_vat/data/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'stats_vat_data')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsVatToPayController::dataAction',));
                        }

                        // stats_vat_data2
                        if (0 === strpos($pathinfo, '/backoffice/stats_vat/dataEur') && preg_match('#^/backoffice/stats_vat/dataEur/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'stats_vat_data2')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\StatsVatToPayController::dataEurAction',));
                        }

                    }

                }

            }

        }

        // newGamerNotification
        if (0 === strpos($pathinfo, '/ClientsHelper/IDCGames/newGamerNotification') && preg_match('#^/ClientsHelper/IDCGames/newGamerNotification/(?P<app>[^/]++)/(?P<gamer>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'newGamerNotification')), array (  '_controller' => 'AppBundle\\Controller\\ClientsHelper\\IDCGamesHelper::receiveNewGamerNotification',));
        }

        // home
        if (preg_match('#^/(?P<_locale>(en))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'home')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::indexAction',));
        }

        // try_control_panel
        if ($pathinfo === '/try-control-panel') {
            return array (  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::adminViewpAction',  '_route' => 'try_control_panel',);
        }

        // singup
        if (preg_match('#^/(?P<_locale>(en|es))/sing\\-up$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'singup')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::singUpAction',));
        }

        // example
        if (preg_match('#^/(?P<_locale>[^/]++)/example$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'example')), array (  '_locale' => 'en',  'lightbox' => false,  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::exampleAction',));
        }

        // example_light_box
        if (preg_match('#^/(?P<_locale>[^/]++)/example\\-light\\-box$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'example_light_box')), array (  '_locale' => 'en',  'lightbox' => true,  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::exampleAction',));
        }

        // example_payment_widget
        if (preg_match('#^/(?P<_locale>[^/]++)/example\\-payment\\-widget$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'example_payment_widget')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::examplePaymentWidgetAction',));
        }

        // legal
        if (preg_match('#^/(?P<_locale>[^/]++)/legal$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'legal')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::legalAction',));
        }

        // faq
        if (preg_match('#^/(?P<_locale>[^/]++)/FAQ$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'faq')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::faqAction',));
        }

        // legal_notice
        if (preg_match('#^/(?P<_locale>[^/]++)/legal\\-notice$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'legal_notice')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::legalNoticeAction',));
        }

        // terms_conditions
        if (preg_match('#^/(?P<_locale>[^/]++)/terms\\-&\\-conditions$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'terms_conditions')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::termsConditionsAction',));
        }

        // privacy_policy
        if (preg_match('#^/(?P<_locale>[^/]++)/privacy\\-policy$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'privacy_policy')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::privacyPolicyAction',));
        }

        if (0 === strpos($pathinfo, '/d')) {
            if (0 === strpos($pathinfo, '/demo')) {
                // demo_index
                if ($pathinfo === '/demo') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Others\\DemoController::indexAction',  '_route' => 'demo_index',);
                }

                // test_demo
                if ($pathinfo === '/demo_test') {
                    return array (  '_controller' => 'AppBundle\\Controller\\Others\\DemoController::testAction',  '_route' => 'test_demo',);
                }

            }

            if (0 === strpos($pathinfo, '/doc')) {
                if (0 === strpos($pathinfo, '/doc/in')) {
                    // documentation_index
                    if ($pathinfo === '/doc/index') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Others\\DocumentationController::indexDocumentationAction',  '_route' => 'documentation_index',);
                    }

                    // documentation_inshort
                    if ($pathinfo === '/doc/inshort') {
                        return array (  '_controller' => 'AppBundle\\Controller\\Others\\DocumentationController::inshortAction',  '_route' => 'documentation_inshort',);
                    }

                }

                // api_doc
                if (0 === strpos($pathinfo, '/doc/api') && preg_match('#^/doc/api(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_doc')), array (  'view' => 'default',  '_controller' => 'AppBundle\\Controller\\Others\\DocumentationController::apiAction',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/info')) {
            if (0 === strpos($pathinfo, '/info/apc')) {
                // info_apc
                if ($pathinfo === '/info/apc') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_info_apc;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Others\\InfoController::apcAction',  '_route' => 'info_apc',);
                }
                not_info_apc:

                // info_apc_clear
                if ($pathinfo === '/info/apc/clear') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_info_apc_clear;
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\Others\\InfoController::apcClearAction',  '_route' => 'info_apc_clear',);
                }
                not_info_apc_clear:

            }

            // info_nginx_clear
            if ($pathinfo === '/info/nginx/clear') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_info_nginx_clear;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Others\\InfoController::nginxClearAction',  '_route' => 'info_nginx_clear',);
            }
            not_info_nginx_clear:

            // info_php
            if ($pathinfo === '/info/php') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_info_php;
                }

                return array (  '_controller' => 'AppBundle\\Controller\\Others\\InfoController::phpInfoAction',  '_route' => 'info_php',);
            }
            not_info_php:

        }

        // pretty_json
        if ($pathinfo === '/pretty-json') {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_pretty_json;
            }

            return array (  '_controller' => 'AppBundle\\Controller\\Others\\OthersController::jsonPretty',  '_route' => 'pretty_json',);
        }
        not_pretty_json:

        if (0 === strpos($pathinfo, '/t')) {
            // tororo
            if ($pathinfo === '/tororo') {
                return array (  '_controller' => 'AppBundle\\Controller\\Others\\OthersController::tororoAction',  '_route' => 'tororo',);
            }

            // tiri
            if ($pathinfo === '/tiriri') {
                return array (  '_controller' => 'AppBundle\\Controller\\Others\\OthersController::tiririAction',  '_route' => 'tiri',);
            }

        }

        // payment_pg_notification_test
        if ($pathinfo === '/pg_notification_to_app_test') {
            return array (  '_controller' => 'AppBundle\\Controller\\Others\\TestNotificationController::pgNotificationToAppTestAction',  '_route' => 'payment_pg_notification_test',);
        }

        // internal_payment_notification_test
        if ($pathinfo === '/internal_payment_notification') {
            return array (  '_controller' => 'AppBundle\\Controller\\Others\\TestNotificationController::internalPaymentNotificationTestAction',  '_route' => 'internal_payment_notification_test',);
        }

        if (0 === strpos($pathinfo, '/translations')) {
            // translations_domain_language
            if (0 === strpos($pathinfo, '/translations/g') && preg_match('#^/translations/g/(?P<domainName>[^/]++)/(?P<language>[^/\\.]++)\\.json$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'translations_domain_language')), array (  '_controller' => 'AppBundle\\Controller\\Others\\TranslationsAngularController::translationByDomainAndLanguageAction',));
            }

            // translations_shop_common
            if (0 === strpos($pathinfo, '/translations/shop') && preg_match('#^/translations/shop/(?P<domainName>[^/]++)/(?P<language>[^/\\.]++)\\.json$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'translations_shop_common')), array (  '_controller' => 'AppBundle\\Controller\\Others\\TranslationsAngularController::shopCommonAction',));
            }

        }

        if (0 === strpos($pathinfo, '/widgets/direct')) {
            // widget_selected_pmpc
            if (preg_match('#^/widgets/direct/(?P<transaction_id>[^/]++)(?:/(?P<pmpc_id>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'widget_selected_pmpc')), array (  'pmpc_id' => NULL,  '_controller' => 'AppBundle\\Controller\\Others\\WidgetsController::selectPMPCAction',));
            }

            // widget_select_pmpc
            if (preg_match('#^/widgets/direct/(?P<transaction_id>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'widget_select_pmpc')), array (  'pmpc_id' => NULL,  '_controller' => 'AppBundle\\Controller\\Others\\WidgetsController::selectPMPCAction',));
            }

        }

        if (0 === strpos($pathinfo, '/external-stores/facebook')) {
            // facebook_products_info
            if (0 === strpos($pathinfo, '/external-stores/facebook/product_info') && preg_match('#^/external\\-stores/facebook/product_info/(?P<article_id>[^/]++)/(?P<level_category_id>[^/]++)/(?P<country>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'facebook_products_info')), array (  '_controller' => 'AppBundle\\Controller\\ExternalStores\\FacebookController::productInfoAction',));
            }

            // facebook_products_pricing
            if ($pathinfo === '/external-stores/facebook/dynamic_pricing') {
                return array (  '_controller' => 'AppBundle\\Controller\\ExternalStores\\FacebookController::dynamicPricingAction',  '_route' => 'facebook_products_pricing',);
            }

        }

        if (0 === strpos($pathinfo, '/admin')) {
            if (0 === strpos($pathinfo, '/admin/api')) {
                if (0 === strpos($pathinfo, '/admin/api/a')) {
                    if (0 === strpos($pathinfo, '/admin/api/app')) {
                        // admin_get_apps
                        if ($pathinfo === '/admin/api/apps') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_get_apps;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::getAllAction',  '_route' => 'admin_get_apps',);
                        }
                        not_admin_get_apps:

                        // admin_get_app
                        if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_get_app;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_get_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::getAction',));
                        }
                        not_admin_get_app:

                        // admin_app_new
                        if ($pathinfo === '/admin/api/app') {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_app_new;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::postAppAction',  '_route' => 'admin_app_new',);
                        }
                        not_admin_app_new:

                        // admin_app_is_configured
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/is_configured$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_is_configured')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::isConfiguredAction',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/api/auto_configuration/app')) {
                        // admin_app_auto_configuration
                        if (preg_match('#^/admin/api/auto_configuration/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_app_auto_configuration;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_auto_configuration')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::getAutoConfigurationAction',));
                        }
                        not_admin_app_auto_configuration:

                        // app_clientadmin_app_getautoconfigurationpost
                        if (preg_match('#^/admin/api/auto_configuration/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_app_clientadmin_app_getautoconfigurationpost;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_app_getautoconfigurationpost')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::getAutoConfigurationPostAction',));
                        }
                        not_app_clientadmin_app_getautoconfigurationpost:

                        // app_clientadmin_app_virtualcurrencyimagepost
                        if (preg_match('#^/admin/api/auto_configuration/app/(?P<app>[^/]++)/currency_image$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_app_clientadmin_app_virtualcurrencyimagepost;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_app_virtualcurrencyimagepost')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::virtualCurrencyImagePostAction',));
                        }
                        not_app_clientadmin_app_virtualcurrencyimagepost:

                    }

                    if (0 === strpos($pathinfo, '/admin/api/app')) {
                        // admin_ips_get_all_blacklisted
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/ips/blacklisted$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_ips_get_all_blacklisted;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_ips_get_all_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::getIpsBlacklistedAction',));
                        }
                        not_admin_ips_get_all_blacklisted:

                        // admin_ips_set_blacklisted
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/ips/blacklisted$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_ips_set_blacklisted;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_ips_set_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppController::setIpBlacklistedAction',));
                        }
                        not_admin_ips_set_blacklisted:

                        if (0 === strpos($pathinfo, '/admin/api/app_shop_has_a')) {
                            // admin_get_app_shop_has_tabs
                            if (0 === strpos($pathinfo, '/admin/api/app_shop_has_app_tabs') && preg_match('#^/admin/api/app_shop_has_app_tabs/(?P<app_id>[^/]++)$#s', $pathinfo, $matches)) {
                                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                    $allow = array_merge($allow, array('GET', 'HEAD'));
                                    goto not_admin_get_app_shop_has_tabs;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_get_app_shop_has_tabs')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppShopHasAppTabController::getAllAction',));
                            }
                            not_admin_get_app_shop_has_tabs:

                            // admin_app_shop_has_articles_by_app
                            if (0 === strpos($pathinfo, '/admin/api/app_shop_has_articles/app') && preg_match('#^/admin/api/app_shop_has_articles/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_shop_has_articles_by_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppShopHasArticleController::appShopHasArticlesByAppIdAction',));
                            }

                        }

                    }

                    // admin_app_shop_has_articles_by_id
                    if (0 === strpos($pathinfo, '/admin/api/article/app_shop_has_articles/article') && preg_match('#^/admin/api/article/app_shop_has_articles/article/(?P<articleId>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_shop_has_articles_by_id')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppShopHasArticleController::getAppShopHasArticleById',));
                    }

                    if (0 === strpos($pathinfo, '/admin/api/app_tab')) {
                        // admin_get_tabs
                        if (0 === strpos($pathinfo, '/admin/api/app_tabs') && preg_match('#^/admin/api/app_tabs/(?P<app_id>[^/]++)$#s', $pathinfo, $matches)) {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_get_tabs;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_get_tabs')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppTabController::getAllAction',));
                        }
                        not_admin_get_tabs:

                        if (0 === strpos($pathinfo, '/admin/api/app_tab/app')) {
                            // admin_post_tabs_photo
                            if (preg_match('#^/admin/api/app_tab/app/(?P<app_id>[^/]++)/photo(?:/(?P<app_tab_id>[^/]++))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_post_tabs_photo;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_post_tabs_photo')), array (  'app_tab_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppTabController::postPhotoAction',));
                            }
                            not_admin_post_tabs_photo:

                            // admin_post_tabs_photo_new
                            if (preg_match('#^/admin/api/app_tab/app/(?P<app_id>[^/]++)/photo/$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'POST') {
                                    $allow[] = 'POST';
                                    goto not_admin_post_tabs_photo_new;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_post_tabs_photo_new')), array (  'app_tab_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppTabController::postPhotoAction',));
                            }
                            not_admin_post_tabs_photo_new:

                            // admin_delete_tabs_photo
                            if (preg_match('#^/admin/api/app_tab/app/(?P<app_id>[^/]++)/photo(?:/(?P<app_tab_id>[^/]++))?$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'DELETE') {
                                    $allow[] = 'DELETE';
                                    goto not_admin_delete_tabs_photo;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_delete_tabs_photo')), array (  'app_tab_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\AppTabController::deletePhotoAction',));
                            }
                            not_admin_delete_tabs_photo:

                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/api/article')) {
                        // admin_get_article_categories
                        if ($pathinfo === '/admin/api/article_categories') {
                            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                                $allow = array_merge($allow, array('GET', 'HEAD'));
                                goto not_admin_get_article_categories;
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleCategoryController::getAllAction',  '_route' => 'admin_get_article_categories',);
                        }
                        not_admin_get_article_categories:

                        // admin_articles_by_filters
                        if (0 === strpos($pathinfo, '/admin/api/article/simple') && preg_match('#^/admin/api/article/simple/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_by_filters')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articlesSimpleByAppIdAction',));
                        }

                        // admin_articles_by_app
                        if (0 === strpos($pathinfo, '/admin/api/article/app') && preg_match('#^/admin/api/article/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_by_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articlesByAppIdAction',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/api/app')) {
                        // admin_article_gacha_create
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/article_gacha/$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_article_gacha_create;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_gacha_create')), array (  'article_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::createOrUpdateArticleGacha',));
                        }
                        not_admin_article_gacha_create:

                        // admin_article_gacha_update
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/article_gacha(?:/(?P<article_id>[^/]++))?$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'POST') {
                                $allow[] = 'POST';
                                goto not_admin_article_gacha_update;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_article_gacha_update')), array (  'article_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::createOrUpdateArticleGacha',));
                        }
                        not_admin_article_gacha_update:

                        // admin_articles_delete
                        if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/article/(?P<article_id>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_admin_articles_delete;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::deleteArticleAction',));
                        }
                        not_admin_articles_delete:

                    }

                    if (0 === strpos($pathinfo, '/admin/api/article')) {
                        if (0 === strpos($pathinfo, '/admin/api/article/sync')) {
                            // admin_articles_sync_special_pay_methods
                            if (0 === strpos($pathinfo, '/admin/api/article/sync/special_pay_methods/app') && preg_match('#^/admin/api/article/sync/special_pay_methods/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_admin_articles_sync_special_pay_methods;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_sync_special_pay_methods')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articleSyncSpecialPayMethodsAction',));
                            }
                            not_admin_articles_sync_special_pay_methods:

                            // admin_articles_sync_prices
                            if (0 === strpos($pathinfo, '/admin/api/article/sync/prices/app') && preg_match('#^/admin/api/article/sync/prices/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_admin_articles_sync_prices;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_sync_prices')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articleSyncPricesAction',));
                            }
                            not_admin_articles_sync_prices:

                            // admin_articles_sync_shops
                            if (0 === strpos($pathinfo, '/admin/api/article/sync/shops/app') && preg_match('#^/admin/api/article/sync/shops/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                                if ($this->context->getMethod() != 'PUT') {
                                    $allow[] = 'PUT';
                                    goto not_admin_articles_sync_shops;
                                }

                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_sync_shops')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articleSyncShopsAction',));
                            }
                            not_admin_articles_sync_shops:

                        }

                        // admin_articles
                        if (preg_match('#^/admin/api/article/(?P<app>[^/]++)/(?P<shops_ids>[^/]++)/(?P<countries_ids>[^/]++)/(?P<_locale>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articleByAppAndShopsAndCountriesAction',));
                        }

                        // admin_articles_sync
                        if (0 === strpos($pathinfo, '/admin/api/article/sync_amounts') && preg_match('#^/admin/api/article/sync_amounts/(?P<item_id>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_articles_sync')), array (  'item' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ArticleController::articleSyncAmountsAction',));
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/c')) {
                    // app_clientadmin_clientuser_setlanguage
                    if (0 === strpos($pathinfo, '/admin/api/client_user/language/set') && preg_match('#^/admin/api/client_user/language/set/(?P<language_id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_clientuser_setlanguage')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ClientUserController::setLanguageAction',));
                    }

                    if (0 === strpos($pathinfo, '/admin/api/country')) {
                        if (0 === strpos($pathinfo, '/admin/api/country/cost_of_life')) {
                            // admin_cost_of_life
                            if (preg_match('#^/admin/api/country/cost_of_life/(?P<amount>[^/]++)/(?P<country_id>[^/]++)/(?P<country_id_wanted>[^/]++)$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cost_of_life')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::costOfLifeAction',));
                            }

                            // admin_pretty_cost_of_life
                            if (0 === strpos($pathinfo, '/admin/api/country/cost_of_life/virtual') && preg_match('#^/admin/api/country/cost_of_life/virtual/(?P<amount>[^/]++)/(?P<country_id>[^/]++)/(?P<country_id_wanted>[^/]++)$#s', $pathinfo, $matches)) {
                                return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pretty_cost_of_life')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::costOfLifeVirtualAction',));
                            }

                        }

                        // admin_exchange
                        if (0 === strpos($pathinfo, '/admin/api/country/exchange') && preg_match('#^/admin/api/country/exchange/(?P<amount>[^/]++)/(?P<country_id>[^/]++)/(?P<country_id_wanted>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_exchange')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::exchangeVirtualAction',));
                        }

                        // admin_countries
                        if (preg_match('#^/admin/api/country/(?P<app>[^/]++)/(?P<shops_ids>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_countries')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::shopsAction',));
                        }

                        // admin_countries_all
                        if ($pathinfo === '/admin/api/country') {
                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::getAllAction',  '_route' => 'admin_countries_all',);
                        }

                        // admin_countries_standard_all
                        if ($pathinfo === '/admin/api/country/standard') {
                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::getAllStandardAction',  '_route' => 'admin_countries_standard_all',);
                        }

                        // admin_country_app
                        if (preg_match('#^/admin/api/country/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_admin_country_app;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_country_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::updateAction',));
                        }
                        not_admin_country_app:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/app')) {
                    // admin_country_get_all_blacklisted
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/country/blacklisted$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_country_get_all_blacklisted;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_country_get_all_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::getBlacklistedAction',));
                    }
                    not_admin_country_get_all_blacklisted:

                    // admin_country_set_blacklisted
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/country/(?P<countryId>[^/]++)/blacklisted$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_country_set_blacklisted;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_country_set_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::setGamerBlacklistedAction',));
                    }
                    not_admin_country_set_blacklisted:

                }

                if (0 === strpos($pathinfo, '/admin/api/c')) {
                    // admin_credentials
                    if (0 === strpos($pathinfo, '/admin/api/credentials') && preg_match('#^/admin/api/credentials/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_credentials')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CredentialsController::transactionsAction',));
                    }

                    // currencies_all
                    if ($pathinfo === '/admin/api/currency') {
                        return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CurrencyController::costOfLifeAction',  '_route' => 'currencies_all',);
                    }

                }

            }

            // test_js
            if ($pathinfo === '/admin/test/js') {
                return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\DefaultController::testJsAction',  '_route' => 'test_js',);
            }

            // admin_home
            if (rtrim($pathinfo, '/') === '/admin') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'admin_home');
                }

                return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\DefaultController::indexAction',  '_route' => 'admin_home',);
            }

            // app_clientadmin_default_loadshoptest
            if (0 === strpos($pathinfo, '/admin/load/shop/test') && preg_match('#^/admin/load/shop/test/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_default_loadshoptest')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\DefaultController::loadShopTestAction',));
            }

            if (0 === strpos($pathinfo, '/admin/api')) {
                // app_clientadmin_default_roles
                if (0 === strpos($pathinfo, '/admin/api/roles') && preg_match('#^/admin/api/roles/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_default_roles')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\DefaultController::rolesAction',));
                }

                // admin_documents_merchant
                if (rtrim($pathinfo, '/') === '/admin/api/documents') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_documents_merchant');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\DocumentsController::getDocuments',  '_route' => 'admin_documents_merchant',);
                }

                // admin_invoices_merchant
                if (rtrim($pathinfo, '/') === '/admin/api/invoices') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'admin_invoices_merchant');
                    }

                    return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\FiInvoiceController::getInvoices',  '_route' => 'admin_invoices_merchant',);
                }

                if (0 === strpos($pathinfo, '/admin/api/app')) {
                    // admin_gamer_get_all_for_testing
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/gamers/for_testing$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_gamer_get_all_for_testing;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_gamer_get_all_for_testing')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\GamerController::getForTestingAction',));
                    }
                    not_admin_gamer_get_all_for_testing:

                    // admin_gamer_set_for_testing
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/gamers/(?P<gamerExternalId>[^/]++)/for_testing$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_gamer_set_for_testing;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_gamer_set_for_testing')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\GamerController::setGamerForTestingAction',));
                    }
                    not_admin_gamer_set_for_testing:

                    // admin_gamer_get_all_blacklisted
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/gamers/blacklisted$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_gamer_get_all_blacklisted;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_gamer_get_all_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\GamerController::getBlacklistedAction',));
                    }
                    not_admin_gamer_get_all_blacklisted:

                    // admin_gamer_set_blacklisted
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/gamers/(?P<gamerExternalId>[^/]++)/blacklisted$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_gamer_set_blacklisted;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_gamer_set_blacklisted')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\GamerController::setGamerBlacklistedAction',));
                    }
                    not_admin_gamer_set_blacklisted:

                }

                if (0 === strpos($pathinfo, '/admin/api/item')) {
                    // admin_items_list
                    if (preg_match('#^/admin/api/item/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_items_list;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_items_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemController::listAction',));
                    }
                    not_admin_items_list:

                    // admin_items_delete
                    if (preg_match('#^/admin/api/item/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_items_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_items_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemController::deleteAction',));
                    }
                    not_admin_items_delete:

                    // admin_items_create
                    if (preg_match('#^/admin/api/item/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_items_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_items_create')), array (  'item' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemController::updateOrCreateAction',));
                    }
                    not_admin_items_create:

                    // admin_items_update
                    if (preg_match('#^/admin/api/item/(?P<app>[^/]++)/(?P<item_id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_items_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_items_update')), array (  'item' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemController::updateOrCreateAction',));
                    }
                    not_admin_items_update:

                }

                if (0 === strpos($pathinfo, '/admin/api/app')) {
                    // admin_items_category_list
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/item_tab$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_items_category_list;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_items_category_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemTabController::listAction',));
                    }
                    not_admin_items_category_list:

                    // admin_delete_item_tab_photo
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/item_tab/(?P<item_tab>[^/]++)/photo$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_delete_item_tab_photo;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_delete_item_tab_photo')), array (  'item_tab' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemTabController::deletePhotoAction',));
                    }
                    not_admin_delete_item_tab_photo:

                    // admin_post_item_tab_sync
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/item_tab/sync$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_post_item_tab_sync;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_post_item_tab_sync')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemTabController::syncAction',));
                    }
                    not_admin_post_item_tab_sync:

                    // admin_post_item_tab_photo
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/item_tab/photo(?:/(?P<item_tab>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_post_item_tab_photo;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_post_item_tab_photo')), array (  'item_tab' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemTabController::postPhotoAction',));
                    }
                    not_admin_post_item_tab_photo:

                    // admin_post_item_tab_photo_new
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/item_tab/photo/$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_post_item_tab_photo_new;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_post_item_tab_photo_new')), array (  'item_tab' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ItemTabController::postPhotoAction',));
                    }
                    not_admin_post_item_tab_photo_new:

                }

                if (0 === strpos($pathinfo, '/admin/api/language')) {
                    // admin_language_all
                    if ($pathinfo === '/admin/api/language') {
                        return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\LanguageController::getAllAction',  '_route' => 'admin_language_all',);
                    }

                    // admin_language_app
                    if (preg_match('#^/admin/api/language/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_admin_language_app;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_language_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\LanguageController::updateAction',));
                    }
                    not_admin_language_app:

                }

                // admin_app_shops_categories_list
                if (0 === strpos($pathinfo, '/admin/api/app_shops_categories') && preg_match('#^/admin/api/app_shops_categories/(?P<app_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_shops_categories_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\LevelCategoryController::listAction',));
                }

                if (0 === strpos($pathinfo, '/admin/api/notify')) {
                    if (0 === strpos($pathinfo, '/admin/api/notify/notifications')) {
                        // app_clientadmin_notify_notifications
                        if ($pathinfo === '/admin/api/notify/notifications') {
                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\NotifyController::notificationsAction',  '_route' => 'app_clientadmin_notify_notifications',);
                        }

                        // app_clientadmin_notify_notificationmarkasread
                        if (0 === strpos($pathinfo, '/admin/api/notify/notifications/read') && preg_match('#^/admin/api/notify/notifications/read/(?P<client_user_notification_id>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_notify_notificationmarkasread')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\NotifyController::notificationMarkAsReadAction',));
                        }

                        // app_clientadmin_notify_deleteall
                        if (preg_match('#^/admin/api/notify/notifications/(?P<date>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'DELETE') {
                                $allow[] = 'DELETE';
                                goto not_app_clientadmin_notify_deleteall;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_clientadmin_notify_deleteall')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\NotifyController::deleteAllAction',));
                        }
                        not_app_clientadmin_notify_deleteall:

                    }

                    // app_clientadmin_notify_tasks
                    if ($pathinfo === '/admin/api/notify/tasks.html') {
                        return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\NotifyController::tasksAction',  '_route' => 'app_clientadmin_notify_tasks',);
                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/offer')) {
                    // admin_offer_list
                    if (preg_match('#^/admin/api/offer/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_offer_list;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_offer_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\OfferController::listAction',));
                    }
                    not_admin_offer_list:

                    // admin_offer_delete
                    if (preg_match('#^/admin/api/offer/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_offer_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_offer_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\OfferController::deleteAction',));
                    }
                    not_admin_offer_delete:

                    // admin_offer_details
                    if (preg_match('#^/admin/api/offer/(?P<app>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_offer_details;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_offer_details')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\OfferController::getDetailsAction',));
                    }
                    not_admin_offer_details:

                    // admin_offer_create
                    if (preg_match('#^/admin/api/offer/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_offer_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_offer_create')), array (  'offer_programmer_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\OfferController::createAndUpdateAction',));
                    }
                    not_admin_offer_create:

                    // admin_offer_update
                    if (preg_match('#^/admin/api/offer/(?P<app>[^/]++)(?:/(?P<offer_programmer_id>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_admin_offer_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_offer_update')), array (  'offer_programmer_id' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\OfferController::createAndUpdateAction',));
                    }
                    not_admin_offer_update:

                }

                if (0 === strpos($pathinfo, '/admin/api/pay_')) {
                    // admin_get_pay_categories
                    if ($pathinfo === '/admin/api/pay_categories') {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_get_pay_categories;
                        }

                        return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayCategoryController::getAllAction',  '_route' => 'admin_get_pay_categories',);
                    }
                    not_admin_get_pay_categories:

                    if (0 === strpos($pathinfo, '/admin/api/pay_methods')) {
                        // api_admin_pay_methods
                        if (rtrim($pathinfo, '/') === '/admin/api/pay_methods') {
                            if (substr($pathinfo, -1) !== '/') {
                                return $this->redirect($pathinfo.'/', 'api_admin_pay_methods');
                            }

                            return array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsController::payMethodsAllAction',  '_route' => 'api_admin_pay_methods',);
                        }

                        // api_admin_pay_methods_specials_by_app
                        if (0 === strpos($pathinfo, '/admin/api/pay_methods/specials/app') && preg_match('#^/admin/api/pay_methods/specials/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_specials_by_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsController::payMethodsSpecialAction',));
                        }

                        // api_admin_pay_methods_by_app
                        if (0 === strpos($pathinfo, '/admin/api/pay_methods/app') && preg_match('#^/admin/api/pay_methods/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_by_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsController::payMethodsAction',));
                        }

                        // api_admin_pay_methods_with_filters_count
                        if (0 === strpos($pathinfo, '/admin/api/pay_methods/count/app') && preg_match('#^/admin/api/pay_methods/count/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_with_filters_count')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsController::payMethodsWithFiltersCount',));
                        }

                        // api_admin_pay_methods_sync_by_app
                        if (0 === strpos($pathinfo, '/admin/api/pay_methods/sync/app') && preg_match('#^/admin/api/pay_methods/sync/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            if ($this->context->getMethod() != 'PUT') {
                                $allow[] = 'PUT';
                                goto not_api_admin_pay_methods_sync_by_app;
                            }

                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_sync_by_app')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsController::syncPayMethodsAction',));
                        }
                        not_api_admin_pay_methods_sync_by_app:

                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/app')) {
                    // api_admin_pay_methods_credentials_available
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/pay_method_credentials/available$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_admin_pay_methods_credentials_available;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_credentials_available')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsCredentialsController::getListAvailableAction',));
                    }
                    not_api_admin_pay_methods_credentials_available:

                    // api_admin_pay_methods_credentials
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/pay_method_credentials$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_admin_pay_methods_credentials;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_credentials')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsCredentialsController::getListAction',));
                    }
                    not_api_admin_pay_methods_credentials:

                    // api_admin_pay_methods_credentials_delete
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/pay_method_credentials/(?P<client_provider_credentials_id>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_api_admin_pay_methods_credentials_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_credentials_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsCredentialsController::deletePayMethodAction',));
                    }
                    not_api_admin_pay_methods_credentials_delete:

                    // api_admin_pay_methods_credentials_provider
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/pay_method_credentials/(?P<providerId>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_api_admin_pay_methods_credentials_provider;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_admin_pay_methods_credentials_provider')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PayMethodsCredentialsController::postPayMethodAction',));
                    }
                    not_api_admin_pay_methods_credentials_provider:

                    // admin_promo_code_list
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo\\-codes$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_code_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::activeSubscriptionAction',));
                    }

                    // admin_promo_code_copy
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo_code/(?P<promoCodeId>[^/]++)/copy$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_promo_code_copy;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_code_copy')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::copyPromoCodeAction',));
                    }
                    not_admin_promo_code_copy:

                    // admin_promo_code_create
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo/(?P<promoId>[^/]++)/promo_code$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_promo_code_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_code_create')), array (  'promoCodeId' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::createUpdatePromoCodeAction',));
                    }
                    not_admin_promo_code_create:

                    // admin_promo_code_update
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo/(?P<promoId>[^/]++)/promo_code(?:/(?P<promoCodeId>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_admin_promo_code_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_code_update')), array (  'promoCodeId' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::createUpdatePromoCodeAction',));
                    }
                    not_admin_promo_code_update:

                    // admin_promo_code_delete3
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo_code/(?P<promoCodeId>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_promo_code_delete3;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_code_delete3')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::deletePromoAction',));
                    }
                    not_admin_promo_code_delete3:

                    // admin_promos_list
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promos$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_admin_promos_list;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promos_list')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoController::getPromosAction',));
                    }
                    not_admin_promos_list:

                    // admin_promo_create
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_promo_create;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_create')), array (  'promoId' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoController::createPromoAction',));
                    }
                    not_admin_promo_create:

                    // admin_promo_update
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo(?:/(?P<promoId>[^/]++))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'PUT') {
                            $allow[] = 'PUT';
                            goto not_admin_promo_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_update')), array (  'promoId' => NULL,  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoController::createPromoAction',));
                    }
                    not_admin_promo_update:

                    // admin_promo_delete
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo/(?P<promoId>[^/]++)$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'DELETE') {
                            $allow[] = 'DELETE';
                            goto not_admin_promo_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_promo_delete')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoController::deletePromoAction',));
                    }
                    not_admin_promo_delete:

                    // admin_purchase_notifications
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/notifications/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchase_notifications')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchaseNotificationsController::notificationsAction',));
                    }

                    // admin_purchase_notifications_force_resend
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/notifications/(?P<notificationId>[^/]++)/force_resend/$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_admin_purchase_notifications_force_resend;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchase_notifications_force_resend')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchaseNotificationsController::resendPurchaseNotificationAction',));
                    }
                    not_admin_purchase_notifications_force_resend:

                }

                // admin_purchases
                if (0 === strpos($pathinfo, '/admin/api/purchases') && preg_match('#^/admin/api/purchases/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchases')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchasesController::statsAction',));
                }

                if (0 === strpos($pathinfo, '/admin/api/app')) {
                    // admin_purchase_cancel
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/purchase/(?P<purchase_id>[^/]++)/cancel$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchase_cancel')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchasesController::cancelPurchaseAction',));
                    }

                    // admin_purchase_reactivate
                    if (preg_match('#^/admin/api/app/(?P<app_id>[^/]++)/purchase/(?P<purchase_id>[^/]++)/reactivate$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchase_reactivate')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchasesController::reactivatePurchaseAction',));
                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/s')) {
                    if (0 === strpos($pathinfo, '/admin/api/shop')) {
                        // admin_css_all
                        if (0 === strpos($pathinfo, '/admin/api/shop_templates/app') && preg_match('#^/admin/api/shop_templates/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_css_all')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ShopCSSController::cssAction',));
                        }

                        // admin_app_shops
                        if (0 === strpos($pathinfo, '/admin/api/shops/app') && preg_match('#^/admin/api/shops/app/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_shops')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\ShopsController::shopsAction',));
                        }

                    }

                    if (0 === strpos($pathinfo, '/admin/api/stats')) {
                        // admin_stats_user_level_by_app
                        if (0 === strpos($pathinfo, '/admin/api/stats/user_levels/app') && preg_match('#^/admin/api/stats/user_levels/app/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_user_level_by_app')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::getUserLevelsAction',));
                        }

                        // admin_stats_payment_methods_by_app
                        if (0 === strpos($pathinfo, '/admin/api/stats/payment_methods/app') && preg_match('#^/admin/api/stats/payment_methods/app/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_payment_methods_by_app')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::getPayMethodsAction',));
                        }

                        // admin_stats_articles_shops
                        if (0 === strpos($pathinfo, '/admin/api/stats/articles_shops/app') && preg_match('#^/admin/api/stats/articles_shops/app/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_articles_shops')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::getArticlesByShop',));
                        }

                        // admin_stats_continents_countries
                        if (0 === strpos($pathinfo, '/admin/api/stats/continents_countries/app') && preg_match('#^/admin/api/stats/continents_countries/app/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_continents_countries')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::getContinentsCountries',));
                        }

                        // admin_stats_transactions_purchases
                        if (0 === strpos($pathinfo, '/admin/api/stats/transaction_purchases/app') && preg_match('#^/admin/api/stats/transaction_purchases/app/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_transactions_purchases')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::getTransactionPurchases',));
                        }

                        // admin_stats_by_apps
                        if (0 === strpos($pathinfo, '/admin/api/stats/apps') && preg_match('#^/admin/api/stats/apps/(?P<apps>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>(months|weeks|days|auto)))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_stats_by_apps')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::statsAppsAction',));
                        }

                        // admin_pay_method_stats_by_apps
                        if (0 === strpos($pathinfo, '/admin/api/stats/pay_methods/apps') && preg_match('#^/admin/api/stats/pay_methods/apps/(?P<apps>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)(?:/(?P<date_format>[^/]++))?$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_pay_method_stats_by_apps')), array (  'date_format' => 'months',  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\StatsController::statsPayMethodsAppsAction',));
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/admin/api/a')) {
                    // admin_active_subscriptions
                    if (0 === strpos($pathinfo, '/admin/api/app') && preg_match('#^/admin/api/app/(?P<app>[^/]++)/subscriptions/active/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_active_subscriptions')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\SubscriptionsController::activeSubscriptionAction',));
                    }

                    // admin_active_subscriptions_cancel
                    if (0 === strpos($pathinfo, '/admin/api/active-subscriptions/cancel') && preg_match('#^/admin/api/active\\-subscriptions/cancel/(?P<app>[^/]++)/(?P<subscription_id>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_active_subscriptions_cancel')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\SubscriptionsController::cancelSubscriptionAction',));
                    }

                }

                // admin_transactions
                if (0 === strpos($pathinfo, '/admin/api/transactions') && preg_match('#^/admin/api/transactions/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_transactions')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\TransactionsController::transactionsAction',));
                }

            }

        }

        if (0 === strpos($pathinfo, '/ws')) {
            // _webservice_call
            if (preg_match('#^/ws/(?P<webservice>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not__webservice_call;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => '_webservice_call')), array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::CallAction',  '_format' => 'xml',));
            }
            not__webservice_call:

            // _webservice_definition
            if (preg_match('#^/ws/(?P<webservice>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not__webservice_definition;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => '_webservice_definition')), array (  '_controller' => 'BeSimple\\SoapBundle\\Controller\\SoapWebServiceController::DefinitionAction',  '_format' => 'xml',));
            }
            not__webservice_definition:

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
