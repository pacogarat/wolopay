<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/css/bootstrap')) {
            // _assetic_bootstrap_css
            if ($pathinfo === '/css/bootstrap.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css',);
            }

            if (0 === strpos($pathinfo, '/css/bootstrap_')) {
                // _assetic_bootstrap_css_0
                if ($pathinfo === '/css/bootstrap_bootstrap_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_0',);
                }

                // _assetic_bootstrap_css_1
                if ($pathinfo === '/css/bootstrap_form_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_1',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/bootstrap')) {
                // _assetic_bootstrap_js
                if ($pathinfo === '/js/bootstrap.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js',);
                }

                if (0 === strpos($pathinfo, '/js/bootstrap_')) {
                    // _assetic_bootstrap_js_0
                    if ($pathinfo === '/js/bootstrap_transition_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_0',);
                    }

                    // _assetic_bootstrap_js_1
                    if ($pathinfo === '/js/bootstrap_alert_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_1',);
                    }

                    // _assetic_bootstrap_js_2
                    if ($pathinfo === '/js/bootstrap_button_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_2',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_c')) {
                        // _assetic_bootstrap_js_3
                        if ($pathinfo === '/js/bootstrap_carousel_4.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_3',);
                        }

                        // _assetic_bootstrap_js_4
                        if ($pathinfo === '/js/bootstrap_collapse_5.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_4',);
                        }

                    }

                    // _assetic_bootstrap_js_5
                    if ($pathinfo === '/js/bootstrap_dropdown_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_5',);
                    }

                    // _assetic_bootstrap_js_6
                    if ($pathinfo === '/js/bootstrap_modal_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_6',);
                    }

                    // _assetic_bootstrap_js_7
                    if ($pathinfo === '/js/bootstrap_tooltip_8.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_7',);
                    }

                    // _assetic_bootstrap_js_8
                    if ($pathinfo === '/js/bootstrap_popover_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_8',);
                    }

                    // _assetic_bootstrap_js_9
                    if ($pathinfo === '/js/bootstrap_scrollspy_10.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_9',);
                    }

                    // _assetic_bootstrap_js_10
                    if ($pathinfo === '/js/bootstrap_tab_11.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_10',);
                    }

                    // _assetic_bootstrap_js_11
                    if ($pathinfo === '/js/bootstrap_affix_12.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_11',);
                    }

                    // _assetic_bootstrap_js_12
                    if ($pathinfo === '/js/bootstrap_bc-bootstrap-collection_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_12',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/jquery')) {
                // _assetic_jquery
                if ($pathinfo === '/js/jquery.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_jquery',);
                }

                // _assetic_jquery_0
                if ($pathinfo === '/js/jquery_jquery.min_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_jquery_0',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/css')) {
            if (0 === strpos($pathinfo, '/css/1376e32')) {
                // _assetic_1376e32
                if ($pathinfo === '/css/1376e32.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '1376e32',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_1376e32',);
                }

                // _assetic_1376e32_0
                if ($pathinfo === '/css/1376e32_bootstrap_extra_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '1376e32',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_1376e32_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/982ccd5')) {
                // _assetic_982ccd5
                if ($pathinfo === '/css/982ccd5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_982ccd5',);
                }

                if (0 === strpos($pathinfo, '/css/982ccd5_')) {
                    // _assetic_982ccd5_0
                    if ($pathinfo === '/css/982ccd5_bootstrap_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_982ccd5_0',);
                    }

                    // _assetic_982ccd5_1
                    if ($pathinfo === '/css/982ccd5_wolopay_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_982ccd5_1',);
                    }

                    // _assetic_982ccd5_2
                    if ($pathinfo === '/css/982ccd5_font-awesome_3.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_982ccd5_2',);
                    }

                    if (0 === strpos($pathinfo, '/css/982ccd5_smartadmin-')) {
                        // _assetic_982ccd5_3
                        if ($pathinfo === '/css/982ccd5_smartadmin-production_4.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_982ccd5_3',);
                        }

                        // _assetic_982ccd5_4
                        if ($pathinfo === '/css/982ccd5_smartadmin-skins_5.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 4,  '_format' => 'css',  '_route' => '_assetic_982ccd5_4',);
                        }

                        // _assetic_982ccd5_5
                        if ($pathinfo === '/css/982ccd5_smartadmin-rtl.min_6.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 5,  '_format' => 'css',  '_route' => '_assetic_982ccd5_5',);
                        }

                    }

                    // _assetic_982ccd5_6
                    if ($pathinfo === '/css/982ccd5_demo.min_7.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 6,  '_format' => 'css',  '_route' => '_assetic_982ccd5_6',);
                    }

                    // _assetic_982ccd5_7
                    if ($pathinfo === '/css/982ccd5_select.min_8.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '982ccd5',  'pos' => 7,  '_format' => 'css',  '_route' => '_assetic_982ccd5_7',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/21f79be')) {
                // _assetic_21f79be
                if ($pathinfo === '/js/21f79be.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_21f79be',);
                }

                if (0 === strpos($pathinfo, '/js/21f79be_')) {
                    // _assetic_21f79be_0
                    if ($pathinfo === '/js/21f79be_highcharts_motion_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_21f79be_0',);
                    }

                    // _assetic_21f79be_1
                    if ($pathinfo === '/js/21f79be_select.min_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_21f79be_1',);
                    }

                    // _assetic_21f79be_2
                    if ($pathinfo === '/js/21f79be_ckeditor_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_21f79be_2',);
                    }

                    // _assetic_21f79be_3
                    if ($pathinfo === '/js/21f79be_angular-ckeditor.min_4.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_21f79be_3',);
                    }

                    // _assetic_21f79be_4
                    if ($pathinfo === '/js/21f79be_loading-bar.min_5.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_21f79be_4',);
                    }

                    // _assetic_21f79be_5
                    if ($pathinfo === '/js/21f79be_ng-upload.min_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_21f79be_5',);
                    }

                    // _assetic_21f79be_6
                    if ($pathinfo === '/js/21f79be_sortable.min_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_21f79be_6',);
                    }

                    if (0 === strpos($pathinfo, '/js/21f79be_moment')) {
                        // _assetic_21f79be_7
                        if ($pathinfo === '/js/21f79be_moment.min_8.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_21f79be_7',);
                        }

                        // _assetic_21f79be_8
                        if ($pathinfo === '/js/21f79be_moment-timezone-with-data-2010-2020.min_9.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_21f79be_8',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/js/21f79be_angular-translate')) {
                        // _assetic_21f79be_9
                        if ($pathinfo === '/js/21f79be_angular-translate.min_10.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_21f79be_9',);
                        }

                        // _assetic_21f79be_10
                        if ($pathinfo === '/js/21f79be_angular-translate-loader-static-files.min_11.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_21f79be_10',);
                        }

                    }

                    // _assetic_21f79be_11
                    if ($pathinfo === '/js/21f79be_validate.min_12.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_21f79be_11',);
                    }

                    // _assetic_21f79be_12
                    if ($pathinfo === '/js/21f79be_datetimepicker-tpls-0.11_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_21f79be_12',);
                    }

                    if (0 === strpos($pathinfo, '/js/21f79be_a')) {
                        // _assetic_21f79be_13
                        if ($pathinfo === '/js/21f79be_angular-animate.min_14.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 13,  '_format' => 'js',  '_route' => '_assetic_21f79be_13',);
                        }

                        // _assetic_21f79be_14
                        if ($pathinfo === '/js/21f79be_app.config_15.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 14,  '_format' => 'js',  '_route' => '_assetic_21f79be_14',);
                        }

                    }

                    // _assetic_21f79be_15
                    if ($pathinfo === '/js/21f79be_jquery.ui.touch-punch.min_16.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 15,  '_format' => 'js',  '_route' => '_assetic_21f79be_15',);
                    }

                    // _assetic_21f79be_16
                    if ($pathinfo === '/js/21f79be_bootstrap.min_17.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 16,  '_format' => 'js',  '_route' => '_assetic_21f79be_16',);
                    }

                    // _assetic_21f79be_17
                    if ($pathinfo === '/js/21f79be_SmartNotification.min_18.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 17,  '_format' => 'js',  '_route' => '_assetic_21f79be_17',);
                    }

                    // _assetic_21f79be_18
                    if ($pathinfo === '/js/21f79be_jarvis.widget.min_19.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 18,  '_format' => 'js',  '_route' => '_assetic_21f79be_18',);
                    }

                    // _assetic_21f79be_19
                    if ($pathinfo === '/js/21f79be_bootstrap-slider.min_20.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 19,  '_format' => 'js',  '_route' => '_assetic_21f79be_19',);
                    }

                    // _assetic_21f79be_20
                    if ($pathinfo === '/js/21f79be_jquery.mb.browser.min_21.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 20,  '_format' => 'js',  '_route' => '_assetic_21f79be_20',);
                    }

                    // _assetic_21f79be_21
                    if ($pathinfo === '/js/21f79be_fastclick.min_22.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 21,  '_format' => 'js',  '_route' => '_assetic_21f79be_21',);
                    }

                    // _assetic_21f79be_22
                    if ($pathinfo === '/js/21f79be_angular-route_23.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 22,  '_format' => 'js',  '_route' => '_assetic_21f79be_22',);
                    }

                    // _assetic_21f79be_23
                    if ($pathinfo === '/js/21f79be_ui-utils.min_24.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 23,  '_format' => 'js',  '_route' => '_assetic_21f79be_23',);
                    }

                    // _assetic_21f79be_24
                    if ($pathinfo === '/js/21f79be_app_25.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 24,  '_format' => 'js',  '_route' => '_assetic_21f79be_24',);
                    }

                    // _assetic_21f79be_25
                    if ($pathinfo === '/js/21f79be_ng.app_26.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 25,  '_format' => 'js',  '_route' => '_assetic_21f79be_25',);
                    }

                    // _assetic_21f79be_26
                    if ($pathinfo === '/js/21f79be_ui_interpolate_27.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 26,  '_format' => 'js',  '_route' => '_assetic_21f79be_26',);
                    }

                    if (0 === strpos($pathinfo, '/js/21f79be_part_')) {
                        if (0 === strpos($pathinfo, '/js/21f79be_part_2')) {
                            if (0 === strpos($pathinfo, '/js/21f79be_part_28_')) {
                                // _assetic_21f79be_27
                                if ($pathinfo === '/js/21f79be_part_28_active_subscriptions_ctrl_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 27,  '_format' => 'js',  '_route' => '_assetic_21f79be_27',);
                                }

                                // _assetic_21f79be_28
                                if ($pathinfo === '/js/21f79be_part_28_credentials_ctrl_2.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 28,  '_format' => 'js',  '_route' => '_assetic_21f79be_28',);
                                }

                                // _assetic_21f79be_29
                                if ($pathinfo === '/js/21f79be_part_28_dashboard_ctrl_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 29,  '_format' => 'js',  '_route' => '_assetic_21f79be_29',);
                                }

                                // _assetic_21f79be_30
                                if ($pathinfo === '/js/21f79be_part_28_language_ctrl_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 30,  '_format' => 'js',  '_route' => '_assetic_21f79be_30',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_28_m')) {
                                    // _assetic_21f79be_31
                                    if ($pathinfo === '/js/21f79be_part_28_main_ctrl_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 31,  '_format' => 'js',  '_route' => '_assetic_21f79be_31',);
                                    }

                                    // _assetic_21f79be_32
                                    if ($pathinfo === '/js/21f79be_part_28_messages_ctrl_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 32,  '_format' => 'js',  '_route' => '_assetic_21f79be_32',);
                                    }

                                }

                                // _assetic_21f79be_33
                                if ($pathinfo === '/js/21f79be_part_28_notifications_ctrl_7.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 33,  '_format' => 'js',  '_route' => '_assetic_21f79be_33',);
                                }

                                // _assetic_21f79be_34
                                if ($pathinfo === '/js/21f79be_part_28_purchases_ctrl_8.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 34,  '_format' => 'js',  '_route' => '_assetic_21f79be_34',);
                                }

                                // _assetic_21f79be_35
                                if ($pathinfo === '/js/21f79be_part_28_transactions_ctrl_9.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 35,  '_format' => 'js',  '_route' => '_assetic_21f79be_35',);
                                }

                                // _assetic_21f79be_36
                                if ($pathinfo === '/js/21f79be_part_28_user_notifications_ctrl_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 36,  '_format' => 'js',  '_route' => '_assetic_21f79be_36',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/21f79be_part_29_')) {
                                // _assetic_21f79be_37
                                if ($pathinfo === '/js/21f79be_part_29_articles_shops_ctrl_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 37,  '_format' => 'js',  '_route' => '_assetic_21f79be_37',);
                                }

                                // _assetic_21f79be_38
                                if ($pathinfo === '/js/21f79be_part_29_continents_countries_ctrl_2.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 38,  '_format' => 'js',  '_route' => '_assetic_21f79be_38',);
                                }

                                // _assetic_21f79be_39
                                if ($pathinfo === '/js/21f79be_part_29_payment_method_ctrl_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 39,  '_format' => 'js',  '_route' => '_assetic_21f79be_39',);
                                }

                                // _assetic_21f79be_40
                                if ($pathinfo === '/js/21f79be_part_29_transactions_purchases_ctrl_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 40,  '_format' => 'js',  '_route' => '_assetic_21f79be_40',);
                                }

                                // _assetic_21f79be_41
                                if ($pathinfo === '/js/21f79be_part_29_user_level_ctrl_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 41,  '_format' => 'js',  '_route' => '_assetic_21f79be_41',);
                                }

                                // _assetic_21f79be_42
                                if ($pathinfo === '/js/21f79be_part_29_pay_methods_ctrl_6.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 42,  '_format' => 'js',  '_route' => '_assetic_21f79be_42',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_29_localization_')) {
                                    // _assetic_21f79be_43
                                    if ($pathinfo === '/js/21f79be_part_29_localization_ckeditor_generic_ctrl_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 43,  '_format' => 'js',  '_route' => '_assetic_21f79be_43',);
                                    }

                                    // _assetic_21f79be_44
                                    if ($pathinfo === '/js/21f79be_part_29_localization_generic_ctrl_8.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 44,  '_format' => 'js',  '_route' => '_assetic_21f79be_44',);
                                    }

                                }

                                // _assetic_21f79be_45
                                if ($pathinfo === '/js/21f79be_part_29_documents_ctrl_9.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 45,  '_format' => 'js',  '_route' => '_assetic_21f79be_45',);
                                }

                                // _assetic_21f79be_46
                                if ($pathinfo === '/js/21f79be_part_29_invoices_ctrl_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 46,  '_format' => 'js',  '_route' => '_assetic_21f79be_46',);
                                }

                                // _assetic_21f79be_47
                                if ($pathinfo === '/js/21f79be_part_29_pay_methods_credentials_ctrl_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 47,  '_format' => 'js',  '_route' => '_assetic_21f79be_47',);
                                }

                                // _assetic_21f79be_48
                                if ($pathinfo === '/js/21f79be_part_29_configure_12.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 48,  '_format' => 'js',  '_route' => '_assetic_21f79be_48',);
                                }

                                // _assetic_21f79be_49
                                if ($pathinfo === '/js/21f79be_part_29_list_ctrl_13.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 49,  '_format' => 'js',  '_route' => '_assetic_21f79be_49',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/js/21f79be_part_3')) {
                            if (0 === strpos($pathinfo, '/js/21f79be_part_30_')) {
                                if (0 === strpos($pathinfo, '/js/21f79be_part_30_blacklisted_')) {
                                    if (0 === strpos($pathinfo, '/js/21f79be_part_30_blacklisted_c')) {
                                        // _assetic_21f79be_50
                                        if ($pathinfo === '/js/21f79be_part_30_blacklisted_countries_ctrl_1.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 50,  '_format' => 'js',  '_route' => '_assetic_21f79be_50',);
                                        }

                                        // _assetic_21f79be_51
                                        if ($pathinfo === '/js/21f79be_part_30_blacklisted_ctrl_2.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 51,  '_format' => 'js',  '_route' => '_assetic_21f79be_51',);
                                        }

                                    }

                                    // _assetic_21f79be_52
                                    if ($pathinfo === '/js/21f79be_part_30_blacklisted_gamers_ctrl_3.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 52,  '_format' => 'js',  '_route' => '_assetic_21f79be_52',);
                                    }

                                    // _assetic_21f79be_53
                                    if ($pathinfo === '/js/21f79be_part_30_blacklisted_ips_ctrl_4.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 53,  '_format' => 'js',  '_route' => '_assetic_21f79be_53',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_30_configurator_')) {
                                    // _assetic_21f79be_54
                                    if ($pathinfo === '/js/21f79be_part_30_configurator_container_ctrl_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 54,  '_format' => 'js',  '_route' => '_assetic_21f79be_54',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/21f79be_part_30_configurator_select_')) {
                                        // _assetic_21f79be_55
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_0_pre_configure_ctrl_6.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 55,  '_format' => 'js',  '_route' => '_assetic_21f79be_55',);
                                        }

                                        // _assetic_21f79be_56
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_1_countries_ctrl_7.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 56,  '_format' => 'js',  '_route' => '_assetic_21f79be_56',);
                                        }

                                        // _assetic_21f79be_57
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_2_language_ctrl_8.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 57,  '_format' => 'js',  '_route' => '_assetic_21f79be_57',);
                                        }

                                        // _assetic_21f79be_58
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_3_items_ctrl_9.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 58,  '_format' => 'js',  '_route' => '_assetic_21f79be_58',);
                                        }

                                        // _assetic_21f79be_59
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_4_articles_ctrl_10.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 59,  '_format' => 'js',  '_route' => '_assetic_21f79be_59',);
                                        }

                                        // _assetic_21f79be_60
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_5_paymethods_ctrl_11.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 60,  '_format' => 'js',  '_route' => '_assetic_21f79be_60',);
                                        }

                                        // _assetic_21f79be_61
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_6_articles_and_shops_ctrl_12.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 61,  '_format' => 'js',  '_route' => '_assetic_21f79be_61',);
                                        }

                                        // _assetic_21f79be_62
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_7_prices_ctrl_13.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 62,  '_format' => 'js',  '_route' => '_assetic_21f79be_62',);
                                        }

                                        // _assetic_21f79be_63
                                        if ($pathinfo === '/js/21f79be_part_30_configurator_select_8_sms_ctrl_14.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 63,  '_format' => 'js',  '_route' => '_assetic_21f79be_63',);
                                        }

                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_30_offer_')) {
                                    // _assetic_21f79be_64
                                    if ($pathinfo === '/js/21f79be_part_30_offer_container_ctrl_15.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 64,  '_format' => 'js',  '_route' => '_assetic_21f79be_64',);
                                    }

                                    // _assetic_21f79be_65
                                    if ($pathinfo === '/js/21f79be_part_30_offer_list_ctrl_16.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 65,  '_format' => 'js',  '_route' => '_assetic_21f79be_65',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/21f79be_part_30_offer_select_')) {
                                        // _assetic_21f79be_66
                                        if ($pathinfo === '/js/21f79be_part_30_offer_select_1_shop_ctrl_17.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 66,  '_format' => 'js',  '_route' => '_assetic_21f79be_66',);
                                        }

                                        // _assetic_21f79be_67
                                        if ($pathinfo === '/js/21f79be_part_30_offer_select_2_countries_ctrl_18.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 67,  '_format' => 'js',  '_route' => '_assetic_21f79be_67',);
                                        }

                                        // _assetic_21f79be_68
                                        if ($pathinfo === '/js/21f79be_part_30_offer_select_3_articles_ctrl_19.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 68,  '_format' => 'js',  '_route' => '_assetic_21f79be_68',);
                                        }

                                        // _assetic_21f79be_69
                                        if ($pathinfo === '/js/21f79be_part_30_offer_select_4_time_ctrl_20.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 69,  '_format' => 'js',  '_route' => '_assetic_21f79be_69',);
                                        }

                                        // _assetic_21f79be_70
                                        if ($pathinfo === '/js/21f79be_part_30_offer_select_5_offer_ctrl_21.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 70,  '_format' => 'js',  '_route' => '_assetic_21f79be_70',);
                                        }

                                    }

                                }

                                // _assetic_21f79be_71
                                if ($pathinfo === '/js/21f79be_part_30_promo_list_ctrl_22.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 71,  '_format' => 'js',  '_route' => '_assetic_21f79be_71',);
                                }

                                // _assetic_21f79be_72
                                if ($pathinfo === '/js/21f79be_part_30_shop_test_ctrl_23.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 72,  '_format' => 'js',  '_route' => '_assetic_21f79be_72',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/21f79be_part_31_')) {
                                // _assetic_21f79be_73
                                if ($pathinfo === '/js/21f79be_part_31_bs_popover_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 73,  '_format' => 'js',  '_route' => '_assetic_21f79be_73',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_31_c')) {
                                    // _assetic_21f79be_74
                                    if ($pathinfo === '/js/21f79be_part_31_click_once_2.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 74,  '_format' => 'js',  '_route' => '_assetic_21f79be_74',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/21f79be_part_31_co')) {
                                        // _assetic_21f79be_75
                                        if ($pathinfo === '/js/21f79be_part_31_compile_3.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 75,  '_format' => 'js',  '_route' => '_assetic_21f79be_75',);
                                        }

                                        // _assetic_21f79be_76
                                        if ($pathinfo === '/js/21f79be_part_31_country_flag_4.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 76,  '_format' => 'js',  '_route' => '_assetic_21f79be_76',);
                                        }

                                    }

                                    // _assetic_21f79be_77
                                    if ($pathinfo === '/js/21f79be_part_31_currency_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 77,  '_format' => 'js',  '_route' => '_assetic_21f79be_77',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_31_d')) {
                                    // _assetic_21f79be_78
                                    if ($pathinfo === '/js/21f79be_part_31_datepicker_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 78,  '_format' => 'js',  '_route' => '_assetic_21f79be_78',);
                                    }

                                    // _assetic_21f79be_79
                                    if ($pathinfo === '/js/21f79be_part_31_dialog_confirmation_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 79,  '_format' => 'js',  '_route' => '_assetic_21f79be_79',);
                                    }

                                }

                                // _assetic_21f79be_80
                                if ($pathinfo === '/js/21f79be_part_31_has_permissions_8.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 80,  '_format' => 'js',  '_route' => '_assetic_21f79be_80',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_31_label_edit_')) {
                                    // _assetic_21f79be_81
                                    if ($pathinfo === '/js/21f79be_part_31_label_edit_9.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 81,  '_format' => 'js',  '_route' => '_assetic_21f79be_81',);
                                    }

                                    // _assetic_21f79be_82
                                    if ($pathinfo === '/js/21f79be_part_31_label_edit_ckeditor_10.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 82,  '_format' => 'js',  '_route' => '_assetic_21f79be_82',);
                                    }

                                }

                                // _assetic_21f79be_83
                                if ($pathinfo === '/js/21f79be_part_31_on_finish_render_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 83,  '_format' => 'js',  '_route' => '_assetic_21f79be_83',);
                                }

                                // _assetic_21f79be_84
                                if ($pathinfo === '/js/21f79be_part_31_purchase_status_12.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 84,  '_format' => 'js',  '_route' => '_assetic_21f79be_84',);
                                }

                                // _assetic_21f79be_85
                                if ($pathinfo === '/js/21f79be_part_31_sparkline_13.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 85,  '_format' => 'js',  '_route' => '_assetic_21f79be_85',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_31_t')) {
                                    // _assetic_21f79be_86
                                    if ($pathinfo === '/js/21f79be_part_31_table_below_14.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 86,  '_format' => 'js',  '_route' => '_assetic_21f79be_86',);
                                    }

                                    // _assetic_21f79be_87
                                    if ($pathinfo === '/js/21f79be_part_31_transaction_status_15.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 87,  '_format' => 'js',  '_route' => '_assetic_21f79be_87',);
                                    }

                                }

                                // _assetic_21f79be_88
                                if ($pathinfo === '/js/21f79be_part_31_valid_file_16.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 88,  '_format' => 'js',  '_route' => '_assetic_21f79be_88',);
                                }

                                // _assetic_21f79be_89
                                if ($pathinfo === '/js/21f79be_part_31_wizard_next_button_17.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 89,  '_format' => 'js',  '_route' => '_assetic_21f79be_89',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/21f79be_part_32_')) {
                                if (0 === strpos($pathinfo, '/js/21f79be_part_32_a')) {
                                    // _assetic_21f79be_90
                                    if ($pathinfo === '/js/21f79be_part_32_addPercent_1.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 90,  '_format' => 'js',  '_route' => '_assetic_21f79be_90',);
                                    }

                                    // _assetic_21f79be_91
                                    if ($pathinfo === '/js/21f79be_part_32_api_get_translation_2.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 91,  '_format' => 'js',  '_route' => '_assetic_21f79be_91',);
                                    }

                                }

                                // _assetic_21f79be_92
                                if ($pathinfo === '/js/21f79be_part_32_csv_object_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 92,  '_format' => 'js',  '_route' => '_assetic_21f79be_92',);
                                }

                                // _assetic_21f79be_93
                                if ($pathinfo === '/js/21f79be_part_32_debug_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 93,  '_format' => 'js',  '_route' => '_assetic_21f79be_93',);
                                }

                                // _assetic_21f79be_94
                                if ($pathinfo === '/js/21f79be_part_32_http_code_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 94,  '_format' => 'js',  '_route' => '_assetic_21f79be_94',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_32_n')) {
                                    // _assetic_21f79be_95
                                    if ($pathinfo === '/js/21f79be_part_32_nl2br_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 95,  '_format' => 'js',  '_route' => '_assetic_21f79be_95',);
                                    }

                                    // _assetic_21f79be_96
                                    if ($pathinfo === '/js/21f79be_part_32_numberIfItIsPossible_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 96,  '_format' => 'js',  '_route' => '_assetic_21f79be_96',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_32_replace_')) {
                                    // _assetic_21f79be_97
                                    if ($pathinfo === '/js/21f79be_part_32_replace_8.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 97,  '_format' => 'js',  '_route' => '_assetic_21f79be_97',);
                                    }

                                    // _assetic_21f79be_98
                                    if ($pathinfo === '/js/21f79be_part_32_replace_our_vars_9.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 98,  '_format' => 'js',  '_route' => '_assetic_21f79be_98',);
                                    }

                                }

                                // _assetic_21f79be_99
                                if ($pathinfo === '/js/21f79be_part_32_true_false_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 99,  '_format' => 'js',  '_route' => '_assetic_21f79be_99',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_32_unique_')) {
                                    // _assetic_21f79be_100
                                    if ($pathinfo === '/js/21f79be_part_32_unique_11.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 100,  '_format' => 'js',  '_route' => '_assetic_21f79be_100',);
                                    }

                                    // _assetic_21f79be_101
                                    if ($pathinfo === '/js/21f79be_part_32_unique_with_array_children_12.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 101,  '_format' => 'js',  '_route' => '_assetic_21f79be_101',);
                                    }

                                }

                            }

                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_')) {
                                if (0 === strpos($pathinfo, '/js/21f79be_part_33_a')) {
                                    // _assetic_21f79be_102
                                    if ($pathinfo === '/js/21f79be_part_33_alerts_1.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 102,  '_format' => 'js',  '_route' => '_assetic_21f79be_102',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_')) {
                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_a')) {
                                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_app')) {
                                                if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_app_')) {
                                                    if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_app_shop')) {
                                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_app_shop_has_a')) {
                                                            // _assetic_21f79be_103
                                                            if ($pathinfo === '/js/21f79be_part_33_api_app_shop_has_app_tabs_2.js') {
                                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 103,  '_format' => 'js',  '_route' => '_assetic_21f79be_103',);
                                                            }

                                                            // _assetic_21f79be_104
                                                            if ($pathinfo === '/js/21f79be_part_33_api_app_shop_has_articles_3.js') {
                                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 104,  '_format' => 'js',  '_route' => '_assetic_21f79be_104',);
                                                            }

                                                        }

                                                        // _assetic_21f79be_105
                                                        if ($pathinfo === '/js/21f79be_part_33_api_app_shops_4.js') {
                                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 105,  '_format' => 'js',  '_route' => '_assetic_21f79be_105',);
                                                        }

                                                    }

                                                    // _assetic_21f79be_106
                                                    if ($pathinfo === '/js/21f79be_part_33_api_app_tabs_5.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 106,  '_format' => 'js',  '_route' => '_assetic_21f79be_106',);
                                                    }

                                                }

                                                // _assetic_21f79be_107
                                                if ($pathinfo === '/js/21f79be_part_33_api_apps_6.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 107,  '_format' => 'js',  '_route' => '_assetic_21f79be_107',);
                                                }

                                            }

                                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_article')) {
                                                // _assetic_21f79be_108
                                                if ($pathinfo === '/js/21f79be_part_33_api_article_categories_7.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 108,  '_format' => 'js',  '_route' => '_assetic_21f79be_108',);
                                                }

                                                // _assetic_21f79be_109
                                                if ($pathinfo === '/js/21f79be_part_33_api_articles_8.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 109,  '_format' => 'js',  '_route' => '_assetic_21f79be_109',);
                                                }

                                            }

                                        }

                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_c')) {
                                            // _assetic_21f79be_110
                                            if ($pathinfo === '/js/21f79be_part_33_api_client_user_9.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 110,  '_format' => 'js',  '_route' => '_assetic_21f79be_110',);
                                            }

                                            // _assetic_21f79be_111
                                            if ($pathinfo === '/js/21f79be_part_33_api_countries_10.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 111,  '_format' => 'js',  '_route' => '_assetic_21f79be_111',);
                                            }

                                            // _assetic_21f79be_112
                                            if ($pathinfo === '/js/21f79be_part_33_api_credentials_11.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 112,  '_format' => 'js',  '_route' => '_assetic_21f79be_112',);
                                            }

                                        }

                                        // _assetic_21f79be_113
                                        if ($pathinfo === '/js/21f79be_part_33_api_documents_12.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 113,  '_format' => 'js',  '_route' => '_assetic_21f79be_113',);
                                        }

                                        // _assetic_21f79be_114
                                        if ($pathinfo === '/js/21f79be_part_33_api_gamers_13.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 114,  '_format' => 'js',  '_route' => '_assetic_21f79be_114',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_i')) {
                                            // _assetic_21f79be_115
                                            if ($pathinfo === '/js/21f79be_part_33_api_invoices_14.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 115,  '_format' => 'js',  '_route' => '_assetic_21f79be_115',);
                                            }

                                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_item')) {
                                                // _assetic_21f79be_116
                                                if ($pathinfo === '/js/21f79be_part_33_api_item_tabs_15.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 116,  '_format' => 'js',  '_route' => '_assetic_21f79be_116',);
                                                }

                                                // _assetic_21f79be_117
                                                if ($pathinfo === '/js/21f79be_part_33_api_items_16.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 117,  '_format' => 'js',  '_route' => '_assetic_21f79be_117',);
                                                }

                                            }

                                        }

                                        // _assetic_21f79be_118
                                        if ($pathinfo === '/js/21f79be_part_33_api_languages_17.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 118,  '_format' => 'js',  '_route' => '_assetic_21f79be_118',);
                                        }

                                        // _assetic_21f79be_119
                                        if ($pathinfo === '/js/21f79be_part_33_api_notifications_18.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 119,  '_format' => 'js',  '_route' => '_assetic_21f79be_119',);
                                        }

                                        // _assetic_21f79be_120
                                        if ($pathinfo === '/js/21f79be_part_33_api_offers_19.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 120,  '_format' => 'js',  '_route' => '_assetic_21f79be_120',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_p')) {
                                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_pay_')) {
                                                // _assetic_21f79be_121
                                                if ($pathinfo === '/js/21f79be_part_33_api_pay_categories_20.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 121,  '_format' => 'js',  '_route' => '_assetic_21f79be_121',);
                                                }

                                                if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_pay_methods_')) {
                                                    // _assetic_21f79be_122
                                                    if ($pathinfo === '/js/21f79be_part_33_api_pay_methods_21.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 122,  '_format' => 'js',  '_route' => '_assetic_21f79be_122',);
                                                    }

                                                    // _assetic_21f79be_123
                                                    if ($pathinfo === '/js/21f79be_part_33_api_pay_methods_provider_has_country_22.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 123,  '_format' => 'js',  '_route' => '_assetic_21f79be_123',);
                                                    }

                                                }

                                            }

                                            if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_promo_')) {
                                                // _assetic_21f79be_124
                                                if ($pathinfo === '/js/21f79be_part_33_api_promo_23.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 124,  '_format' => 'js',  '_route' => '_assetic_21f79be_124',);
                                                }

                                                // _assetic_21f79be_125
                                                if ($pathinfo === '/js/21f79be_part_33_api_promo_codes_24.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 125,  '_format' => 'js',  '_route' => '_assetic_21f79be_125',);
                                                }

                                            }

                                            // _assetic_21f79be_126
                                            if ($pathinfo === '/js/21f79be_part_33_api_purchases_25.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 126,  '_format' => 'js',  '_route' => '_assetic_21f79be_126',);
                                            }

                                        }

                                        // _assetic_21f79be_127
                                        if ($pathinfo === '/js/21f79be_part_33_api_roles_26.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 127,  '_format' => 'js',  '_route' => '_assetic_21f79be_127',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/21f79be_part_33_api_s')) {
                                            // _assetic_21f79be_128
                                            if ($pathinfo === '/js/21f79be_part_33_api_shop_templates_27.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 128,  '_format' => 'js',  '_route' => '_assetic_21f79be_128',);
                                            }

                                            // _assetic_21f79be_129
                                            if ($pathinfo === '/js/21f79be_part_33_api_sms_28.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 129,  '_format' => 'js',  '_route' => '_assetic_21f79be_129',);
                                            }

                                            // _assetic_21f79be_130
                                            if ($pathinfo === '/js/21f79be_part_33_api_stats_29.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 130,  '_format' => 'js',  '_route' => '_assetic_21f79be_130',);
                                            }

                                            // _assetic_21f79be_131
                                            if ($pathinfo === '/js/21f79be_part_33_api_subscription_30.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 131,  '_format' => 'js',  '_route' => '_assetic_21f79be_131',);
                                            }

                                        }

                                        // _assetic_21f79be_132
                                        if ($pathinfo === '/js/21f79be_part_33_api_transactions_31.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 132,  '_format' => 'js',  '_route' => '_assetic_21f79be_132',);
                                        }

                                        // _assetic_21f79be_133
                                        if ($pathinfo === '/js/21f79be_part_33_api_user_notifications_32.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 133,  '_format' => 'js',  '_route' => '_assetic_21f79be_133',);
                                        }

                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_33_c')) {
                                    // _assetic_21f79be_134
                                    if ($pathinfo === '/js/21f79be_part_33_common_functions_trans_purch_notify_33.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 134,  '_format' => 'js',  '_route' => '_assetic_21f79be_134',);
                                    }

                                    // _assetic_21f79be_135
                                    if ($pathinfo === '/js/21f79be_part_33_csv_util_34.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 135,  '_format' => 'js',  '_route' => '_assetic_21f79be_135',);
                                    }

                                }

                                // _assetic_21f79be_136
                                if ($pathinfo === '/js/21f79be_part_33_dialogs_35.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 136,  '_format' => 'js',  '_route' => '_assetic_21f79be_136',);
                                }

                                // _assetic_21f79be_137
                                if ($pathinfo === '/js/21f79be_part_33_flot_36.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 137,  '_format' => 'js',  '_route' => '_assetic_21f79be_137',);
                                }

                                // _assetic_21f79be_138
                                if ($pathinfo === '/js/21f79be_part_33_http_interceptor_37.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 138,  '_format' => 'js',  '_route' => '_assetic_21f79be_138',);
                                }

                                if (0 === strpos($pathinfo, '/js/21f79be_part_33_lo')) {
                                    // _assetic_21f79be_139
                                    if ($pathinfo === '/js/21f79be_part_33_load_more_scroll_38.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 139,  '_format' => 'js',  '_route' => '_assetic_21f79be_139',);
                                    }

                                    // _assetic_21f79be_140
                                    if ($pathinfo === '/js/21f79be_part_33_log_time_39.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 140,  '_format' => 'js',  '_route' => '_assetic_21f79be_140',);
                                    }

                                }

                                // _assetic_21f79be_141
                                if ($pathinfo === '/js/21f79be_part_33_permissions_40.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 141,  '_format' => 'js',  '_route' => '_assetic_21f79be_141',);
                                }

                                // _assetic_21f79be_142
                                if ($pathinfo === '/js/21f79be_part_33_rows_calculator_41.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 142,  '_format' => 'js',  '_route' => '_assetic_21f79be_142',);
                                }

                                // _assetic_21f79be_143
                                if ($pathinfo === '/js/21f79be_part_33_table_below_42.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 143,  '_format' => 'js',  '_route' => '_assetic_21f79be_143',);
                                }

                                // _assetic_21f79be_144
                                if ($pathinfo === '/js/21f79be_part_33_utils_my_43.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 144,  '_format' => 'js',  '_route' => '_assetic_21f79be_144',);
                                }

                                // _assetic_21f79be_145
                                if ($pathinfo === '/js/21f79be_part_33_watchers_44.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 145,  '_format' => 'js',  '_route' => '_assetic_21f79be_145',);
                                }

                            }

                        }

                    }

                    // _assetic_21f79be_146
                    if ($pathinfo === '/js/21f79be_ng.directives_34.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21f79be',  'pos' => 146,  '_format' => 'js',  '_route' => '_assetic_21f79be_146',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/3a730bc')) {
                // _assetic_3a730bc
                if ($pathinfo === '/js/3a730bc.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_3a730bc',);
                }

                if (0 === strpos($pathinfo, '/js/3a730bc_')) {
                    // _assetic_3a730bc_0
                    if ($pathinfo === '/js/3a730bc_angular-mocks_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_3a730bc_0',);
                    }

                    // _assetic_3a730bc_1
                    if ($pathinfo === '/js/3a730bc_highcharts_motion_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_3a730bc_1',);
                    }

                    // _assetic_3a730bc_2
                    if ($pathinfo === '/js/3a730bc_select.min_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_3a730bc_2',);
                    }

                    // _assetic_3a730bc_3
                    if ($pathinfo === '/js/3a730bc_ckeditor_4.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_3a730bc_3',);
                    }

                    // _assetic_3a730bc_4
                    if ($pathinfo === '/js/3a730bc_angular-ckeditor.min_5.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_3a730bc_4',);
                    }

                    // _assetic_3a730bc_5
                    if ($pathinfo === '/js/3a730bc_ng-grid.min_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_3a730bc_5',);
                    }

                    // _assetic_3a730bc_6
                    if ($pathinfo === '/js/3a730bc_loading-bar.min_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_3a730bc_6',);
                    }

                    // _assetic_3a730bc_7
                    if ($pathinfo === '/js/3a730bc_ng-upload.min_8.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_3a730bc_7',);
                    }

                    // _assetic_3a730bc_8
                    if ($pathinfo === '/js/3a730bc_sortable.min_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_3a730bc_8',);
                    }

                    if (0 === strpos($pathinfo, '/js/3a730bc_moment')) {
                        // _assetic_3a730bc_9
                        if ($pathinfo === '/js/3a730bc_moment.min_10.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_3a730bc_9',);
                        }

                        // _assetic_3a730bc_10
                        if ($pathinfo === '/js/3a730bc_moment-timezone-with-data-2010-2020.min_11.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_3a730bc_10',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/js/3a730bc_angular-translate')) {
                        // _assetic_3a730bc_11
                        if ($pathinfo === '/js/3a730bc_angular-translate.min_12.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_3a730bc_11',);
                        }

                        // _assetic_3a730bc_12
                        if ($pathinfo === '/js/3a730bc_angular-translate-loader-static-files.min_13.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_3a730bc_12',);
                        }

                    }

                    // _assetic_3a730bc_13
                    if ($pathinfo === '/js/3a730bc_datetimepicker-tpls-0.11_14.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 13,  '_format' => 'js',  '_route' => '_assetic_3a730bc_13',);
                    }

                    if (0 === strpos($pathinfo, '/js/3a730bc_a')) {
                        // _assetic_3a730bc_14
                        if ($pathinfo === '/js/3a730bc_angular-animate.min_15.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 14,  '_format' => 'js',  '_route' => '_assetic_3a730bc_14',);
                        }

                        // _assetic_3a730bc_15
                        if ($pathinfo === '/js/3a730bc_app.config_16.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 15,  '_format' => 'js',  '_route' => '_assetic_3a730bc_15',);
                        }

                    }

                    // _assetic_3a730bc_16
                    if ($pathinfo === '/js/3a730bc_jquery.ui.touch-punch.min_17.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 16,  '_format' => 'js',  '_route' => '_assetic_3a730bc_16',);
                    }

                    // _assetic_3a730bc_17
                    if ($pathinfo === '/js/3a730bc_bootstrap.min_18.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 17,  '_format' => 'js',  '_route' => '_assetic_3a730bc_17',);
                    }

                    // _assetic_3a730bc_18
                    if ($pathinfo === '/js/3a730bc_SmartNotification.min_19.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 18,  '_format' => 'js',  '_route' => '_assetic_3a730bc_18',);
                    }

                    // _assetic_3a730bc_19
                    if ($pathinfo === '/js/3a730bc_jarvis.widget.min_20.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 19,  '_format' => 'js',  '_route' => '_assetic_3a730bc_19',);
                    }

                    // _assetic_3a730bc_20
                    if ($pathinfo === '/js/3a730bc_bootstrap-slider.min_21.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 20,  '_format' => 'js',  '_route' => '_assetic_3a730bc_20',);
                    }

                    // _assetic_3a730bc_21
                    if ($pathinfo === '/js/3a730bc_jquery.mb.browser.min_22.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 21,  '_format' => 'js',  '_route' => '_assetic_3a730bc_21',);
                    }

                    // _assetic_3a730bc_22
                    if ($pathinfo === '/js/3a730bc_fastclick.min_23.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 22,  '_format' => 'js',  '_route' => '_assetic_3a730bc_22',);
                    }

                    // _assetic_3a730bc_23
                    if ($pathinfo === '/js/3a730bc_angular-route_24.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 23,  '_format' => 'js',  '_route' => '_assetic_3a730bc_23',);
                    }

                    // _assetic_3a730bc_24
                    if ($pathinfo === '/js/3a730bc_ui-utils.min_25.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 24,  '_format' => 'js',  '_route' => '_assetic_3a730bc_24',);
                    }

                    // _assetic_3a730bc_25
                    if ($pathinfo === '/js/3a730bc_app_26.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 25,  '_format' => 'js',  '_route' => '_assetic_3a730bc_25',);
                    }

                    // _assetic_3a730bc_26
                    if ($pathinfo === '/js/3a730bc_ng.app_27.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 26,  '_format' => 'js',  '_route' => '_assetic_3a730bc_26',);
                    }

                    // _assetic_3a730bc_27
                    if ($pathinfo === '/js/3a730bc_ui_interpolate_28.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 27,  '_format' => 'js',  '_route' => '_assetic_3a730bc_27',);
                    }

                    if (0 === strpos($pathinfo, '/js/3a730bc_part_')) {
                        if (0 === strpos($pathinfo, '/js/3a730bc_part_29_')) {
                            // _assetic_3a730bc_28
                            if ($pathinfo === '/js/3a730bc_part_29_active_subscriptions_ctrl_1.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 28,  '_format' => 'js',  '_route' => '_assetic_3a730bc_28',);
                            }

                            // _assetic_3a730bc_29
                            if ($pathinfo === '/js/3a730bc_part_29_credentials_ctrl_2.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 29,  '_format' => 'js',  '_route' => '_assetic_3a730bc_29',);
                            }

                            // _assetic_3a730bc_30
                            if ($pathinfo === '/js/3a730bc_part_29_dashboard_ctrl_3.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 30,  '_format' => 'js',  '_route' => '_assetic_3a730bc_30',);
                            }

                            // _assetic_3a730bc_31
                            if ($pathinfo === '/js/3a730bc_part_29_language_ctrl_4.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 31,  '_format' => 'js',  '_route' => '_assetic_3a730bc_31',);
                            }

                            if (0 === strpos($pathinfo, '/js/3a730bc_part_29_m')) {
                                // _assetic_3a730bc_32
                                if ($pathinfo === '/js/3a730bc_part_29_main_ctrl_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 32,  '_format' => 'js',  '_route' => '_assetic_3a730bc_32',);
                                }

                                // _assetic_3a730bc_33
                                if ($pathinfo === '/js/3a730bc_part_29_messages_ctrl_6.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 33,  '_format' => 'js',  '_route' => '_assetic_3a730bc_33',);
                                }

                            }

                            // _assetic_3a730bc_34
                            if ($pathinfo === '/js/3a730bc_part_29_notifications_ctrl_7.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 34,  '_format' => 'js',  '_route' => '_assetic_3a730bc_34',);
                            }

                            // _assetic_3a730bc_35
                            if ($pathinfo === '/js/3a730bc_part_29_purchases_ctrl_8.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 35,  '_format' => 'js',  '_route' => '_assetic_3a730bc_35',);
                            }

                            // _assetic_3a730bc_36
                            if ($pathinfo === '/js/3a730bc_part_29_transactions_ctrl_9.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 36,  '_format' => 'js',  '_route' => '_assetic_3a730bc_36',);
                            }

                            // _assetic_3a730bc_37
                            if ($pathinfo === '/js/3a730bc_part_29_user_notifications_ctrl_10.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 37,  '_format' => 'js',  '_route' => '_assetic_3a730bc_37',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/js/3a730bc_part_3')) {
                            if (0 === strpos($pathinfo, '/js/3a730bc_part_30_')) {
                                // _assetic_3a730bc_38
                                if ($pathinfo === '/js/3a730bc_part_30_articles_shops_ctrl_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 38,  '_format' => 'js',  '_route' => '_assetic_3a730bc_38',);
                                }

                                // _assetic_3a730bc_39
                                if ($pathinfo === '/js/3a730bc_part_30_continents_countries_ctrl_2.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 39,  '_format' => 'js',  '_route' => '_assetic_3a730bc_39',);
                                }

                                // _assetic_3a730bc_40
                                if ($pathinfo === '/js/3a730bc_part_30_payment_method_ctrl_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 40,  '_format' => 'js',  '_route' => '_assetic_3a730bc_40',);
                                }

                                // _assetic_3a730bc_41
                                if ($pathinfo === '/js/3a730bc_part_30_transactions_purchases_ctrl_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 41,  '_format' => 'js',  '_route' => '_assetic_3a730bc_41',);
                                }

                                // _assetic_3a730bc_42
                                if ($pathinfo === '/js/3a730bc_part_30_user_level_ctrl_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 42,  '_format' => 'js',  '_route' => '_assetic_3a730bc_42',);
                                }

                                // _assetic_3a730bc_43
                                if ($pathinfo === '/js/3a730bc_part_30_pay_methods_ctrl_6.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 43,  '_format' => 'js',  '_route' => '_assetic_3a730bc_43',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_30_localization_')) {
                                    // _assetic_3a730bc_44
                                    if ($pathinfo === '/js/3a730bc_part_30_localization_ckeditor_generic_ctrl_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 44,  '_format' => 'js',  '_route' => '_assetic_3a730bc_44',);
                                    }

                                    // _assetic_3a730bc_45
                                    if ($pathinfo === '/js/3a730bc_part_30_localization_generic_ctrl_8.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 45,  '_format' => 'js',  '_route' => '_assetic_3a730bc_45',);
                                    }

                                }

                                // _assetic_3a730bc_46
                                if ($pathinfo === '/js/3a730bc_part_30_documents_ctrl_9.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 46,  '_format' => 'js',  '_route' => '_assetic_3a730bc_46',);
                                }

                                // _assetic_3a730bc_47
                                if ($pathinfo === '/js/3a730bc_part_30_invoices_ctrl_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 47,  '_format' => 'js',  '_route' => '_assetic_3a730bc_47',);
                                }

                                // _assetic_3a730bc_48
                                if ($pathinfo === '/js/3a730bc_part_30_pay_methods_credentials_ctrl_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 48,  '_format' => 'js',  '_route' => '_assetic_3a730bc_48',);
                                }

                                // _assetic_3a730bc_49
                                if ($pathinfo === '/js/3a730bc_part_30_configure_12.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 49,  '_format' => 'js',  '_route' => '_assetic_3a730bc_49',);
                                }

                                // _assetic_3a730bc_50
                                if ($pathinfo === '/js/3a730bc_part_30_list_ctrl_13.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 50,  '_format' => 'js',  '_route' => '_assetic_3a730bc_50',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/3a730bc_part_31_')) {
                                if (0 === strpos($pathinfo, '/js/3a730bc_part_31_blacklisted_')) {
                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_31_blacklisted_c')) {
                                        // _assetic_3a730bc_51
                                        if ($pathinfo === '/js/3a730bc_part_31_blacklisted_countries_ctrl_1.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 51,  '_format' => 'js',  '_route' => '_assetic_3a730bc_51',);
                                        }

                                        // _assetic_3a730bc_52
                                        if ($pathinfo === '/js/3a730bc_part_31_blacklisted_ctrl_2.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 52,  '_format' => 'js',  '_route' => '_assetic_3a730bc_52',);
                                        }

                                    }

                                    // _assetic_3a730bc_53
                                    if ($pathinfo === '/js/3a730bc_part_31_blacklisted_gamers_ctrl_3.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 53,  '_format' => 'js',  '_route' => '_assetic_3a730bc_53',);
                                    }

                                    // _assetic_3a730bc_54
                                    if ($pathinfo === '/js/3a730bc_part_31_blacklisted_ips_ctrl_4.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 54,  '_format' => 'js',  '_route' => '_assetic_3a730bc_54',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_31_configurator_')) {
                                    // _assetic_3a730bc_55
                                    if ($pathinfo === '/js/3a730bc_part_31_configurator_container_ctrl_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 55,  '_format' => 'js',  '_route' => '_assetic_3a730bc_55',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_31_configurator_select_')) {
                                        // _assetic_3a730bc_56
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_0_pre_configure_ctrl_6.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 56,  '_format' => 'js',  '_route' => '_assetic_3a730bc_56',);
                                        }

                                        // _assetic_3a730bc_57
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_1_countries_ctrl_7.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 57,  '_format' => 'js',  '_route' => '_assetic_3a730bc_57',);
                                        }

                                        // _assetic_3a730bc_58
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_2_language_ctrl_8.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 58,  '_format' => 'js',  '_route' => '_assetic_3a730bc_58',);
                                        }

                                        // _assetic_3a730bc_59
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_3_items_ctrl_9.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 59,  '_format' => 'js',  '_route' => '_assetic_3a730bc_59',);
                                        }

                                        // _assetic_3a730bc_60
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_4_articles_ctrl_10.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 60,  '_format' => 'js',  '_route' => '_assetic_3a730bc_60',);
                                        }

                                        // _assetic_3a730bc_61
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_5_paymethods_ctrl_11.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 61,  '_format' => 'js',  '_route' => '_assetic_3a730bc_61',);
                                        }

                                        // _assetic_3a730bc_62
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_6_articles_and_shops_ctrl_12.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 62,  '_format' => 'js',  '_route' => '_assetic_3a730bc_62',);
                                        }

                                        // _assetic_3a730bc_63
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_7_prices_ctrl_13.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 63,  '_format' => 'js',  '_route' => '_assetic_3a730bc_63',);
                                        }

                                        // _assetic_3a730bc_64
                                        if ($pathinfo === '/js/3a730bc_part_31_configurator_select_8_sms_ctrl_14.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 64,  '_format' => 'js',  '_route' => '_assetic_3a730bc_64',);
                                        }

                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_31_offer_')) {
                                    // _assetic_3a730bc_65
                                    if ($pathinfo === '/js/3a730bc_part_31_offer_container_ctrl_15.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 65,  '_format' => 'js',  '_route' => '_assetic_3a730bc_65',);
                                    }

                                    // _assetic_3a730bc_66
                                    if ($pathinfo === '/js/3a730bc_part_31_offer_list_ctrl_16.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 66,  '_format' => 'js',  '_route' => '_assetic_3a730bc_66',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_31_offer_select_')) {
                                        // _assetic_3a730bc_67
                                        if ($pathinfo === '/js/3a730bc_part_31_offer_select_1_shop_ctrl_17.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 67,  '_format' => 'js',  '_route' => '_assetic_3a730bc_67',);
                                        }

                                        // _assetic_3a730bc_68
                                        if ($pathinfo === '/js/3a730bc_part_31_offer_select_2_countries_ctrl_18.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 68,  '_format' => 'js',  '_route' => '_assetic_3a730bc_68',);
                                        }

                                        // _assetic_3a730bc_69
                                        if ($pathinfo === '/js/3a730bc_part_31_offer_select_3_articles_ctrl_19.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 69,  '_format' => 'js',  '_route' => '_assetic_3a730bc_69',);
                                        }

                                        // _assetic_3a730bc_70
                                        if ($pathinfo === '/js/3a730bc_part_31_offer_select_4_time_ctrl_20.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 70,  '_format' => 'js',  '_route' => '_assetic_3a730bc_70',);
                                        }

                                        // _assetic_3a730bc_71
                                        if ($pathinfo === '/js/3a730bc_part_31_offer_select_5_offer_ctrl_21.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 71,  '_format' => 'js',  '_route' => '_assetic_3a730bc_71',);
                                        }

                                    }

                                }

                                // _assetic_3a730bc_72
                                if ($pathinfo === '/js/3a730bc_part_31_promo_list_ctrl_22.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 72,  '_format' => 'js',  '_route' => '_assetic_3a730bc_72',);
                                }

                                // _assetic_3a730bc_73
                                if ($pathinfo === '/js/3a730bc_part_31_shop_test_ctrl_23.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 73,  '_format' => 'js',  '_route' => '_assetic_3a730bc_73',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/3a730bc_part_32_')) {
                                // _assetic_3a730bc_74
                                if ($pathinfo === '/js/3a730bc_part_32_bs_popover_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 74,  '_format' => 'js',  '_route' => '_assetic_3a730bc_74',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_32_c')) {
                                    // _assetic_3a730bc_75
                                    if ($pathinfo === '/js/3a730bc_part_32_click_once_2.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 75,  '_format' => 'js',  '_route' => '_assetic_3a730bc_75',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_32_co')) {
                                        // _assetic_3a730bc_76
                                        if ($pathinfo === '/js/3a730bc_part_32_compile_3.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 76,  '_format' => 'js',  '_route' => '_assetic_3a730bc_76',);
                                        }

                                        // _assetic_3a730bc_77
                                        if ($pathinfo === '/js/3a730bc_part_32_country_flag_4.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 77,  '_format' => 'js',  '_route' => '_assetic_3a730bc_77',);
                                        }

                                    }

                                    // _assetic_3a730bc_78
                                    if ($pathinfo === '/js/3a730bc_part_32_currency_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 78,  '_format' => 'js',  '_route' => '_assetic_3a730bc_78',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_32_d')) {
                                    // _assetic_3a730bc_79
                                    if ($pathinfo === '/js/3a730bc_part_32_datepicker_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 79,  '_format' => 'js',  '_route' => '_assetic_3a730bc_79',);
                                    }

                                    // _assetic_3a730bc_80
                                    if ($pathinfo === '/js/3a730bc_part_32_dialog_confirmation_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 80,  '_format' => 'js',  '_route' => '_assetic_3a730bc_80',);
                                    }

                                }

                                // _assetic_3a730bc_81
                                if ($pathinfo === '/js/3a730bc_part_32_has_permissions_8.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 81,  '_format' => 'js',  '_route' => '_assetic_3a730bc_81',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_32_label_edit_')) {
                                    // _assetic_3a730bc_82
                                    if ($pathinfo === '/js/3a730bc_part_32_label_edit_9.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 82,  '_format' => 'js',  '_route' => '_assetic_3a730bc_82',);
                                    }

                                    // _assetic_3a730bc_83
                                    if ($pathinfo === '/js/3a730bc_part_32_label_edit_ckeditor_10.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 83,  '_format' => 'js',  '_route' => '_assetic_3a730bc_83',);
                                    }

                                }

                                // _assetic_3a730bc_84
                                if ($pathinfo === '/js/3a730bc_part_32_on_finish_render_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 84,  '_format' => 'js',  '_route' => '_assetic_3a730bc_84',);
                                }

                                // _assetic_3a730bc_85
                                if ($pathinfo === '/js/3a730bc_part_32_purchase_status_12.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 85,  '_format' => 'js',  '_route' => '_assetic_3a730bc_85',);
                                }

                                // _assetic_3a730bc_86
                                if ($pathinfo === '/js/3a730bc_part_32_sparkline_13.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 86,  '_format' => 'js',  '_route' => '_assetic_3a730bc_86',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_32_t')) {
                                    // _assetic_3a730bc_87
                                    if ($pathinfo === '/js/3a730bc_part_32_table_below_14.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 87,  '_format' => 'js',  '_route' => '_assetic_3a730bc_87',);
                                    }

                                    // _assetic_3a730bc_88
                                    if ($pathinfo === '/js/3a730bc_part_32_transaction_status_15.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 88,  '_format' => 'js',  '_route' => '_assetic_3a730bc_88',);
                                    }

                                }

                                // _assetic_3a730bc_89
                                if ($pathinfo === '/js/3a730bc_part_32_valid_file_16.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 89,  '_format' => 'js',  '_route' => '_assetic_3a730bc_89',);
                                }

                                // _assetic_3a730bc_90
                                if ($pathinfo === '/js/3a730bc_part_32_wizard_next_button_17.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 90,  '_format' => 'js',  '_route' => '_assetic_3a730bc_90',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/3a730bc_part_33_')) {
                                if (0 === strpos($pathinfo, '/js/3a730bc_part_33_a')) {
                                    // _assetic_3a730bc_91
                                    if ($pathinfo === '/js/3a730bc_part_33_addPercent_1.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 91,  '_format' => 'js',  '_route' => '_assetic_3a730bc_91',);
                                    }

                                    // _assetic_3a730bc_92
                                    if ($pathinfo === '/js/3a730bc_part_33_api_get_translation_2.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 92,  '_format' => 'js',  '_route' => '_assetic_3a730bc_92',);
                                    }

                                }

                                // _assetic_3a730bc_93
                                if ($pathinfo === '/js/3a730bc_part_33_csv_object_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 93,  '_format' => 'js',  '_route' => '_assetic_3a730bc_93',);
                                }

                                // _assetic_3a730bc_94
                                if ($pathinfo === '/js/3a730bc_part_33_debug_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 94,  '_format' => 'js',  '_route' => '_assetic_3a730bc_94',);
                                }

                                // _assetic_3a730bc_95
                                if ($pathinfo === '/js/3a730bc_part_33_http_code_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 95,  '_format' => 'js',  '_route' => '_assetic_3a730bc_95',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_33_n')) {
                                    // _assetic_3a730bc_96
                                    if ($pathinfo === '/js/3a730bc_part_33_nl2br_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 96,  '_format' => 'js',  '_route' => '_assetic_3a730bc_96',);
                                    }

                                    // _assetic_3a730bc_97
                                    if ($pathinfo === '/js/3a730bc_part_33_numberIfItIsPossible_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 97,  '_format' => 'js',  '_route' => '_assetic_3a730bc_97',);
                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_33_replace_')) {
                                    // _assetic_3a730bc_98
                                    if ($pathinfo === '/js/3a730bc_part_33_replace_8.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 98,  '_format' => 'js',  '_route' => '_assetic_3a730bc_98',);
                                    }

                                    // _assetic_3a730bc_99
                                    if ($pathinfo === '/js/3a730bc_part_33_replace_our_vars_9.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 99,  '_format' => 'js',  '_route' => '_assetic_3a730bc_99',);
                                    }

                                }

                                // _assetic_3a730bc_100
                                if ($pathinfo === '/js/3a730bc_part_33_true_false_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 100,  '_format' => 'js',  '_route' => '_assetic_3a730bc_100',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_33_unique_')) {
                                    // _assetic_3a730bc_101
                                    if ($pathinfo === '/js/3a730bc_part_33_unique_11.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 101,  '_format' => 'js',  '_route' => '_assetic_3a730bc_101',);
                                    }

                                    // _assetic_3a730bc_102
                                    if ($pathinfo === '/js/3a730bc_part_33_unique_with_array_children_12.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 102,  '_format' => 'js',  '_route' => '_assetic_3a730bc_102',);
                                    }

                                }

                            }

                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_')) {
                                if (0 === strpos($pathinfo, '/js/3a730bc_part_34_a')) {
                                    // _assetic_3a730bc_103
                                    if ($pathinfo === '/js/3a730bc_part_34_alerts_1.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 103,  '_format' => 'js',  '_route' => '_assetic_3a730bc_103',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_')) {
                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_a')) {
                                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_app')) {
                                                if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_app_')) {
                                                    if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_app_shop')) {
                                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_app_shop_has_a')) {
                                                            // _assetic_3a730bc_104
                                                            if ($pathinfo === '/js/3a730bc_part_34_api_app_shop_has_app_tabs_2.js') {
                                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 104,  '_format' => 'js',  '_route' => '_assetic_3a730bc_104',);
                                                            }

                                                            // _assetic_3a730bc_105
                                                            if ($pathinfo === '/js/3a730bc_part_34_api_app_shop_has_articles_3.js') {
                                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 105,  '_format' => 'js',  '_route' => '_assetic_3a730bc_105',);
                                                            }

                                                        }

                                                        // _assetic_3a730bc_106
                                                        if ($pathinfo === '/js/3a730bc_part_34_api_app_shops_4.js') {
                                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 106,  '_format' => 'js',  '_route' => '_assetic_3a730bc_106',);
                                                        }

                                                    }

                                                    // _assetic_3a730bc_107
                                                    if ($pathinfo === '/js/3a730bc_part_34_api_app_tabs_5.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 107,  '_format' => 'js',  '_route' => '_assetic_3a730bc_107',);
                                                    }

                                                }

                                                // _assetic_3a730bc_108
                                                if ($pathinfo === '/js/3a730bc_part_34_api_apps_6.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 108,  '_format' => 'js',  '_route' => '_assetic_3a730bc_108',);
                                                }

                                            }

                                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_article')) {
                                                // _assetic_3a730bc_109
                                                if ($pathinfo === '/js/3a730bc_part_34_api_article_categories_7.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 109,  '_format' => 'js',  '_route' => '_assetic_3a730bc_109',);
                                                }

                                                // _assetic_3a730bc_110
                                                if ($pathinfo === '/js/3a730bc_part_34_api_articles_8.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 110,  '_format' => 'js',  '_route' => '_assetic_3a730bc_110',);
                                                }

                                            }

                                        }

                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_c')) {
                                            // _assetic_3a730bc_111
                                            if ($pathinfo === '/js/3a730bc_part_34_api_client_user_9.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 111,  '_format' => 'js',  '_route' => '_assetic_3a730bc_111',);
                                            }

                                            // _assetic_3a730bc_112
                                            if ($pathinfo === '/js/3a730bc_part_34_api_countries_10.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 112,  '_format' => 'js',  '_route' => '_assetic_3a730bc_112',);
                                            }

                                            // _assetic_3a730bc_113
                                            if ($pathinfo === '/js/3a730bc_part_34_api_credentials_11.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 113,  '_format' => 'js',  '_route' => '_assetic_3a730bc_113',);
                                            }

                                        }

                                        // _assetic_3a730bc_114
                                        if ($pathinfo === '/js/3a730bc_part_34_api_documents_12.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 114,  '_format' => 'js',  '_route' => '_assetic_3a730bc_114',);
                                        }

                                        // _assetic_3a730bc_115
                                        if ($pathinfo === '/js/3a730bc_part_34_api_gamers_13.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 115,  '_format' => 'js',  '_route' => '_assetic_3a730bc_115',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_i')) {
                                            // _assetic_3a730bc_116
                                            if ($pathinfo === '/js/3a730bc_part_34_api_invoices_14.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 116,  '_format' => 'js',  '_route' => '_assetic_3a730bc_116',);
                                            }

                                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_item')) {
                                                // _assetic_3a730bc_117
                                                if ($pathinfo === '/js/3a730bc_part_34_api_item_tabs_15.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 117,  '_format' => 'js',  '_route' => '_assetic_3a730bc_117',);
                                                }

                                                // _assetic_3a730bc_118
                                                if ($pathinfo === '/js/3a730bc_part_34_api_items_16.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 118,  '_format' => 'js',  '_route' => '_assetic_3a730bc_118',);
                                                }

                                            }

                                        }

                                        // _assetic_3a730bc_119
                                        if ($pathinfo === '/js/3a730bc_part_34_api_languages_17.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 119,  '_format' => 'js',  '_route' => '_assetic_3a730bc_119',);
                                        }

                                        // _assetic_3a730bc_120
                                        if ($pathinfo === '/js/3a730bc_part_34_api_notifications_18.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 120,  '_format' => 'js',  '_route' => '_assetic_3a730bc_120',);
                                        }

                                        // _assetic_3a730bc_121
                                        if ($pathinfo === '/js/3a730bc_part_34_api_offers_19.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 121,  '_format' => 'js',  '_route' => '_assetic_3a730bc_121',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_p')) {
                                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_pay_')) {
                                                // _assetic_3a730bc_122
                                                if ($pathinfo === '/js/3a730bc_part_34_api_pay_categories_20.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 122,  '_format' => 'js',  '_route' => '_assetic_3a730bc_122',);
                                                }

                                                if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_pay_methods_')) {
                                                    // _assetic_3a730bc_123
                                                    if ($pathinfo === '/js/3a730bc_part_34_api_pay_methods_21.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 123,  '_format' => 'js',  '_route' => '_assetic_3a730bc_123',);
                                                    }

                                                    // _assetic_3a730bc_124
                                                    if ($pathinfo === '/js/3a730bc_part_34_api_pay_methods_provider_has_country_22.js') {
                                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 124,  '_format' => 'js',  '_route' => '_assetic_3a730bc_124',);
                                                    }

                                                }

                                            }

                                            if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_promo_')) {
                                                // _assetic_3a730bc_125
                                                if ($pathinfo === '/js/3a730bc_part_34_api_promo_23.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 125,  '_format' => 'js',  '_route' => '_assetic_3a730bc_125',);
                                                }

                                                // _assetic_3a730bc_126
                                                if ($pathinfo === '/js/3a730bc_part_34_api_promo_codes_24.js') {
                                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 126,  '_format' => 'js',  '_route' => '_assetic_3a730bc_126',);
                                                }

                                            }

                                            // _assetic_3a730bc_127
                                            if ($pathinfo === '/js/3a730bc_part_34_api_purchases_25.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 127,  '_format' => 'js',  '_route' => '_assetic_3a730bc_127',);
                                            }

                                        }

                                        // _assetic_3a730bc_128
                                        if ($pathinfo === '/js/3a730bc_part_34_api_roles_26.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 128,  '_format' => 'js',  '_route' => '_assetic_3a730bc_128',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/3a730bc_part_34_api_s')) {
                                            // _assetic_3a730bc_129
                                            if ($pathinfo === '/js/3a730bc_part_34_api_shop_templates_27.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 129,  '_format' => 'js',  '_route' => '_assetic_3a730bc_129',);
                                            }

                                            // _assetic_3a730bc_130
                                            if ($pathinfo === '/js/3a730bc_part_34_api_sms_28.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 130,  '_format' => 'js',  '_route' => '_assetic_3a730bc_130',);
                                            }

                                            // _assetic_3a730bc_131
                                            if ($pathinfo === '/js/3a730bc_part_34_api_stats_29.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 131,  '_format' => 'js',  '_route' => '_assetic_3a730bc_131',);
                                            }

                                            // _assetic_3a730bc_132
                                            if ($pathinfo === '/js/3a730bc_part_34_api_subscription_30.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 132,  '_format' => 'js',  '_route' => '_assetic_3a730bc_132',);
                                            }

                                        }

                                        // _assetic_3a730bc_133
                                        if ($pathinfo === '/js/3a730bc_part_34_api_transactions_31.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 133,  '_format' => 'js',  '_route' => '_assetic_3a730bc_133',);
                                        }

                                        // _assetic_3a730bc_134
                                        if ($pathinfo === '/js/3a730bc_part_34_api_user_notifications_32.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 134,  '_format' => 'js',  '_route' => '_assetic_3a730bc_134',);
                                        }

                                    }

                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_34_c')) {
                                    // _assetic_3a730bc_135
                                    if ($pathinfo === '/js/3a730bc_part_34_common_functions_trans_purch_notify_33.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 135,  '_format' => 'js',  '_route' => '_assetic_3a730bc_135',);
                                    }

                                    // _assetic_3a730bc_136
                                    if ($pathinfo === '/js/3a730bc_part_34_csv_util_34.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 136,  '_format' => 'js',  '_route' => '_assetic_3a730bc_136',);
                                    }

                                }

                                // _assetic_3a730bc_137
                                if ($pathinfo === '/js/3a730bc_part_34_dialogs_35.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 137,  '_format' => 'js',  '_route' => '_assetic_3a730bc_137',);
                                }

                                // _assetic_3a730bc_138
                                if ($pathinfo === '/js/3a730bc_part_34_flot_36.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 138,  '_format' => 'js',  '_route' => '_assetic_3a730bc_138',);
                                }

                                // _assetic_3a730bc_139
                                if ($pathinfo === '/js/3a730bc_part_34_http_interceptor_37.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 139,  '_format' => 'js',  '_route' => '_assetic_3a730bc_139',);
                                }

                                if (0 === strpos($pathinfo, '/js/3a730bc_part_34_lo')) {
                                    // _assetic_3a730bc_140
                                    if ($pathinfo === '/js/3a730bc_part_34_load_more_scroll_38.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 140,  '_format' => 'js',  '_route' => '_assetic_3a730bc_140',);
                                    }

                                    // _assetic_3a730bc_141
                                    if ($pathinfo === '/js/3a730bc_part_34_log_time_39.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 141,  '_format' => 'js',  '_route' => '_assetic_3a730bc_141',);
                                    }

                                }

                                // _assetic_3a730bc_142
                                if ($pathinfo === '/js/3a730bc_part_34_permissions_40.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 142,  '_format' => 'js',  '_route' => '_assetic_3a730bc_142',);
                                }

                                // _assetic_3a730bc_143
                                if ($pathinfo === '/js/3a730bc_part_34_rows_calculator_41.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 143,  '_format' => 'js',  '_route' => '_assetic_3a730bc_143',);
                                }

                                // _assetic_3a730bc_144
                                if ($pathinfo === '/js/3a730bc_part_34_table_below_42.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 144,  '_format' => 'js',  '_route' => '_assetic_3a730bc_144',);
                                }

                                // _assetic_3a730bc_145
                                if ($pathinfo === '/js/3a730bc_part_34_utils_my_43.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 145,  '_format' => 'js',  '_route' => '_assetic_3a730bc_145',);
                                }

                                // _assetic_3a730bc_146
                                if ($pathinfo === '/js/3a730bc_part_34_watchers_44.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 146,  '_format' => 'js',  '_route' => '_assetic_3a730bc_146',);
                                }

                            }

                        }

                    }

                    // _assetic_3a730bc_147
                    if ($pathinfo === '/js/3a730bc_ng.directives_35.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 147,  '_format' => 'js',  '_route' => '_assetic_3a730bc_147',);
                    }

                    // _assetic_3a730bc_148
                    if ($pathinfo === '/js/3a730bc_part_37_unique_test_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3a730bc',  'pos' => 148,  '_format' => 'js',  '_route' => '_assetic_3a730bc_148',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/css/4a8b964')) {
            // _assetic_4a8b964
            if ($pathinfo === '/css/4a8b964.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_4a8b964',);
            }

            if (0 === strpos($pathinfo, '/css/4a8b964_')) {
                // _assetic_4a8b964_0
                if ($pathinfo === '/css/4a8b964_animate.min_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_4a8b964_0',);
                }

                // _assetic_4a8b964_1
                if ($pathinfo === '/css/4a8b964_ionicons_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_4a8b964_1',);
                }

                if (0 === strpos($pathinfo, '/css/4a8b964_styles_')) {
                    // _assetic_4a8b964_2
                    if ($pathinfo === '/css/4a8b964_styles_3.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => 2,  '_format' => 'css',  '_route' => '_assetic_4a8b964_2',);
                    }

                    // _assetic_4a8b964_3
                    if ($pathinfo === '/css/4a8b964_styles_media_4.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => 3,  '_format' => 'css',  '_route' => '_assetic_4a8b964_3',);
                    }

                }

                // _assetic_4a8b964_4
                if ($pathinfo === '/css/4a8b964_bootstrap_extra_5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '4a8b964',  'pos' => 4,  '_format' => 'css',  '_route' => '_assetic_4a8b964_4',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/7d6e405')) {
                // _assetic_7d6e405
                if ($pathinfo === '/js/7d6e405.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '7d6e405',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_7d6e405',);
                }

                if (0 === strpos($pathinfo, '/js/7d6e405_')) {
                    // _assetic_7d6e405_0
                    if ($pathinfo === '/js/7d6e405_scripts_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '7d6e405',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_7d6e405_0',);
                    }

                    // _assetic_7d6e405_1
                    if ($pathinfo === '/js/7d6e405_lightbox_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '7d6e405',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_7d6e405_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/18c6d89')) {
                // _assetic_18c6d89
                if ($pathinfo === '/js/18c6d89.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '18c6d89',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_18c6d89',);
                }

                if (0 === strpos($pathinfo, '/js/18c6d89_jquery')) {
                    // _assetic_18c6d89_0
                    if ($pathinfo === '/js/18c6d89_jquery-ui-1.9.1.custom.min_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '18c6d89',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_18c6d89_0',);
                    }

                    // _assetic_18c6d89_1
                    if ($pathinfo === '/js/18c6d89_jquery.tocify.min_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '18c6d89',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_18c6d89_1',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/css')) {
            if (0 === strpos($pathinfo, '/css/02763b7')) {
                // _assetic_02763b7
                if ($pathinfo === '/css/02763b7.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '02763b7',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_02763b7',);
                }

                if (0 === strpos($pathinfo, '/css/02763b7_')) {
                    // _assetic_02763b7_0
                    if ($pathinfo === '/css/02763b7_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '02763b7',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_02763b7_0',);
                    }

                    // _assetic_02763b7_1
                    if ($pathinfo === '/css/02763b7_done_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '02763b7',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_02763b7_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/ce25196')) {
                // _assetic_ce25196
                if ($pathinfo === '/css/ce25196.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ce25196',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_ce25196',);
                }

                // _assetic_ce25196_0
                if ($pathinfo === '/css/ce25196_theme_iframe_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ce25196',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_ce25196_0',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js/angular-animate.min.js')) {
            // _assetic_0a8308c
            if ($pathinfo === '/js/angular-animate.min.js.map') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '0a8308c',  'pos' => NULL,  '_format' => 'map',  '_route' => '_assetic_0a8308c',);
            }

            // _assetic_0a8308c_0
            if ($pathinfo === '/js/angular-animate.min.js_angular-animate.min.js_1.map') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '0a8308c',  'pos' => 0,  '_format' => 'map',  '_route' => '_assetic_0a8308c_0',);
            }

        }

        if (0 === strpos($pathinfo, '/css')) {
            if (0 === strpos($pathinfo, '/css/e1b1b9b')) {
                // _assetic_e1b1b9b
                if ($pathinfo === '/css/e1b1b9b.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e1b1b9b',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_e1b1b9b',);
                }

                // _assetic_e1b1b9b_0
                if ($pathinfo === '/css/e1b1b9b_reset_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e1b1b9b',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_e1b1b9b_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/77e719d')) {
                // _assetic_77e719d
                if ($pathinfo === '/css/77e719d.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '77e719d',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_77e719d',);
                }

                // _assetic_77e719d_0
                if ($pathinfo === '/css/77e719d_theme_default_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '77e719d',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_77e719d_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/11cf3a2')) {
                // _assetic_11cf3a2
                if ($pathinfo === '/css/11cf3a2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '11cf3a2',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_11cf3a2',);
                }

                // _assetic_11cf3a2_0
                if ($pathinfo === '/css/11cf3a2_theme_wood_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '11cf3a2',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_11cf3a2_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/bc6fbf8')) {
                // _assetic_bc6fbf8
                if ($pathinfo === '/css/bc6fbf8.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bc6fbf8',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_bc6fbf8',);
                }

                // _assetic_bc6fbf8_0
                if ($pathinfo === '/css/bc6fbf8_theme_berserk_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bc6fbf8',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_bc6fbf8_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/0fcec71')) {
                // _assetic_0fcec71
                if ($pathinfo === '/css/0fcec71.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0fcec71',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_0fcec71',);
                }

                // _assetic_0fcec71_0
                if ($pathinfo === '/css/0fcec71_theme_berserk_halloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0fcec71',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_0fcec71_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/9678912')) {
                // _assetic_9678912
                if ($pathinfo === '/css/9678912.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 9678912,  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_9678912',);
                }

                if (0 === strpos($pathinfo, '/css/9678912_')) {
                    // _assetic_9678912_0
                    if ($pathinfo === '/css/9678912_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 9678912,  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_9678912_0',);
                    }

                    // _assetic_9678912_1
                    if ($pathinfo === '/css/9678912_theme_berserk_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 9678912,  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_9678912_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/58e8f0c')) {
                // _assetic_58e8f0c
                if ($pathinfo === '/css/58e8f0c.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '58e8f0c',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_58e8f0c',);
                }

                if (0 === strpos($pathinfo, '/css/58e8f0c_')) {
                    // _assetic_58e8f0c_0
                    if ($pathinfo === '/css/58e8f0c_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '58e8f0c',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_58e8f0c_0',);
                    }

                    // _assetic_58e8f0c_1
                    if ($pathinfo === '/css/58e8f0c_theme_berserk_modular_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '58e8f0c',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_58e8f0c_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/8b5edd4')) {
                // _assetic_8b5edd4
                if ($pathinfo === '/css/8b5edd4.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5edd4',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_8b5edd4',);
                }

                if (0 === strpos($pathinfo, '/css/8b5edd4_')) {
                    // _assetic_8b5edd4_0
                    if ($pathinfo === '/css/8b5edd4_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5edd4',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_8b5edd4_0',);
                    }

                    // _assetic_8b5edd4_1
                    if ($pathinfo === '/css/8b5edd4_berserk_modular_without_background_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5edd4',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_8b5edd4_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/5')) {
                if (0 === strpos($pathinfo, '/css/55cef0b')) {
                    // _assetic_55cef0b
                    if ($pathinfo === '/css/55cef0b.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '55cef0b',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_55cef0b',);
                    }

                    if (0 === strpos($pathinfo, '/css/55cef0b_')) {
                        // _assetic_55cef0b_0
                        if ($pathinfo === '/css/55cef0b_reset_1.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '55cef0b',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_55cef0b_0',);
                        }

                        // _assetic_55cef0b_1
                        if ($pathinfo === '/css/55cef0b_theme_berserk_valentines_day_modular_2.css') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '55cef0b',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_55cef0b_1',);
                        }

                    }

                }

                if (0 === strpos($pathinfo, '/css/541c109')) {
                    // _assetic_541c109
                    if ($pathinfo === '/css/541c109.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '541c109',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_541c109',);
                    }

                    // _assetic_541c109_0
                    if ($pathinfo === '/css/541c109_theme_berserk_black_friday_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '541c109',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_541c109_0',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/1d70f66')) {
                // _assetic_1d70f66
                if ($pathinfo === '/css/1d70f66.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '1d70f66',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_1d70f66',);
                }

                // _assetic_1d70f66_0
                if ($pathinfo === '/css/1d70f66_theme_idc_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '1d70f66',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_1d70f66_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/b6b9745')) {
                // _assetic_b6b9745
                if ($pathinfo === '/css/b6b9745.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b6b9745',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_b6b9745',);
                }

                // _assetic_b6b9745_0
                if ($pathinfo === '/css/b6b9745_theme_idc_modular_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b6b9745',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_b6b9745_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/da8b913')) {
                // _assetic_da8b913
                if ($pathinfo === '/css/da8b913.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'da8b913',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_da8b913',);
                }

                // _assetic_da8b913_0
                if ($pathinfo === '/css/da8b913_theme_idc_haloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'da8b913',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_da8b913_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/244ca58')) {
                // _assetic_244ca58
                if ($pathinfo === '/css/244ca58.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '244ca58',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_244ca58',);
                }

                // _assetic_244ca58_0
                if ($pathinfo === '/css/244ca58_theme_idc_black_friday_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '244ca58',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_244ca58_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/9d88f54')) {
                // _assetic_9d88f54
                if ($pathinfo === '/css/9d88f54.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '9d88f54',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_9d88f54',);
                }

                if (0 === strpos($pathinfo, '/css/9d88f54_')) {
                    // _assetic_9d88f54_0
                    if ($pathinfo === '/css/9d88f54_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '9d88f54',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_9d88f54_0',);
                    }

                    // _assetic_9d88f54_1
                    if ($pathinfo === '/css/9d88f54_theme_idc_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '9d88f54',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_9d88f54_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/174ca9e')) {
                // _assetic_174ca9e
                if ($pathinfo === '/css/174ca9e.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '174ca9e',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_174ca9e',);
                }

                // _assetic_174ca9e_0
                if ($pathinfo === '/css/174ca9e_theme_idc_valentines_day_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '174ca9e',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_174ca9e_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/800e3b5')) {
                // _assetic_800e3b5
                if ($pathinfo === '/css/800e3b5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '800e3b5',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_800e3b5',);
                }

                // _assetic_800e3b5_0
                if ($pathinfo === '/css/800e3b5_theme_metal_assault_modular_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '800e3b5',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_800e3b5_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/0262f7a')) {
                // _assetic_0262f7a
                if ($pathinfo === '/css/0262f7a.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0262f7a',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_0262f7a',);
                }

                // _assetic_0262f7a_0
                if ($pathinfo === '/css/0262f7a_theme_tron_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0262f7a',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_0262f7a_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/af97ce5')) {
                // _assetic_af97ce5
                if ($pathinfo === '/css/af97ce5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'af97ce5',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_af97ce5',);
                }

                // _assetic_af97ce5_0
                if ($pathinfo === '/css/af97ce5_theme_battle_space_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'af97ce5',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_af97ce5_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/31a759a')) {
                // _assetic_31a759a
                if ($pathinfo === '/css/31a759a.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '31a759a',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_31a759a',);
                }

                if (0 === strpos($pathinfo, '/css/31a759a_')) {
                    // _assetic_31a759a_0
                    if ($pathinfo === '/css/31a759a_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '31a759a',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_31a759a_0',);
                    }

                    // _assetic_31a759a_1
                    if ($pathinfo === '/css/31a759a_theme_battle_space_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '31a759a',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_31a759a_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/caa96d8')) {
                // _assetic_caa96d8
                if ($pathinfo === '/css/caa96d8.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'caa96d8',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_caa96d8',);
                }

                // _assetic_caa96d8_0
                if ($pathinfo === '/css/caa96d8_theme_battle_space_halloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'caa96d8',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_caa96d8_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/6e16898')) {
                // _assetic_6e16898
                if ($pathinfo === '/css/6e16898.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '6e16898',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_6e16898',);
                }

                // _assetic_6e16898_0
                if ($pathinfo === '/css/6e16898_theme_battle_space_black_friday_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '6e16898',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_6e16898_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/dab6c4e')) {
                // _assetic_dab6c4e
                if ($pathinfo === '/css/dab6c4e.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'dab6c4e',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_dab6c4e',);
                }

                // _assetic_dab6c4e_0
                if ($pathinfo === '/css/dab6c4e_theme_battlespace_valentines_day_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'dab6c4e',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_dab6c4e_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/0a715d0')) {
                // _assetic_0a715d0
                if ($pathinfo === '/css/0a715d0.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0a715d0',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_0a715d0',);
                }

                // _assetic_0a715d0_0
                if ($pathinfo === '/css/0a715d0_theme_paper_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0a715d0',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_0a715d0_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/a69d3a8')) {
                // _assetic_a69d3a8
                if ($pathinfo === '/css/a69d3a8.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'a69d3a8',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_a69d3a8',);
                }

                // _assetic_a69d3a8_0
                if ($pathinfo === '/css/a69d3a8_theme_ragnarok_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'a69d3a8',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_a69d3a8_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/28ed825')) {
                // _assetic_28ed825
                if ($pathinfo === '/css/28ed825.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '28ed825',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_28ed825',);
                }

                // _assetic_28ed825_0
                if ($pathinfo === '/css/28ed825_theme_ragnarok_halloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '28ed825',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_28ed825_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/0702ef9')) {
                // _assetic_0702ef9
                if ($pathinfo === '/css/0702ef9.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0702ef9',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_0702ef9',);
                }

                // _assetic_0702ef9_0
                if ($pathinfo === '/css/0702ef9_theme_ragnarok_black_friday_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '0702ef9',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_0702ef9_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/b6af769')) {
                // _assetic_b6af769
                if ($pathinfo === '/css/b6af769.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b6af769',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_b6af769',);
                }

                if (0 === strpos($pathinfo, '/css/b6af769_')) {
                    // _assetic_b6af769_0
                    if ($pathinfo === '/css/b6af769_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'b6af769',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_b6af769_0',);
                    }

                    // _assetic_b6af769_1
                    if ($pathinfo === '/css/b6af769_theme_ragnarok_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'b6af769',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_b6af769_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/81998cf')) {
                // _assetic_81998cf
                if ($pathinfo === '/css/81998cf.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '81998cf',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_81998cf',);
                }

                // _assetic_81998cf_0
                if ($pathinfo === '/css/81998cf_theme_ragnarok_valentines_day_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '81998cf',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_81998cf_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/7dfeef5')) {
                // _assetic_7dfeef5
                if ($pathinfo === '/css/7dfeef5.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '7dfeef5',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_7dfeef5',);
                }

                // _assetic_7dfeef5_0
                if ($pathinfo === '/css/7dfeef5_theme_korner_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '7dfeef5',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_7dfeef5_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/24a865f')) {
                // _assetic_24a865f
                if ($pathinfo === '/css/24a865f.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '24a865f',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_24a865f',);
                }

                // _assetic_24a865f_0
                if ($pathinfo === '/css/24a865f_theme_korner_halloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '24a865f',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_24a865f_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/9aa8147')) {
                // _assetic_9aa8147
                if ($pathinfo === '/css/9aa8147.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '9aa8147',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_9aa8147',);
                }

                // _assetic_9aa8147_0
                if ($pathinfo === '/css/9aa8147_theme_korner_black_friday_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '9aa8147',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_9aa8147_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/3afcbae')) {
                // _assetic_3afcbae
                if ($pathinfo === '/css/3afcbae.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '3afcbae',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_3afcbae',);
                }

                if (0 === strpos($pathinfo, '/css/3afcbae_')) {
                    // _assetic_3afcbae_0
                    if ($pathinfo === '/css/3afcbae_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3afcbae',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_3afcbae_0',);
                    }

                    // _assetic_3afcbae_1
                    if ($pathinfo === '/css/3afcbae_theme_korner_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '3afcbae',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_3afcbae_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/e9bec84')) {
                // _assetic_e9bec84
                if ($pathinfo === '/css/e9bec84.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e9bec84',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_e9bec84',);
                }

                // _assetic_e9bec84_0
                if ($pathinfo === '/css/e9bec84_theme_korner_valentines_day_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e9bec84',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_e9bec84_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/189e42a')) {
                // _assetic_189e42a
                if ($pathinfo === '/css/189e42a.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '189e42a',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_189e42a',);
                }

                // _assetic_189e42a_0
                if ($pathinfo === '/css/189e42a_theme_torofun_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '189e42a',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_189e42a_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/e620769')) {
                // _assetic_e620769
                if ($pathinfo === '/css/e620769.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e620769',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_e620769',);
                }

                // _assetic_e620769_0
                if ($pathinfo === '/css/e620769_theme_cronix_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'e620769',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_e620769_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/ac2df86')) {
                // _assetic_ac2df86
                if ($pathinfo === '/css/ac2df86.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ac2df86',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_ac2df86',);
                }

                // _assetic_ac2df86_0
                if ($pathinfo === '/css/ac2df86_theme_cronix_halloween_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'ac2df86',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_ac2df86_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/47ebb70')) {
                // _assetic_47ebb70
                if ($pathinfo === '/css/47ebb70.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '47ebb70',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_47ebb70',);
                }

                // _assetic_47ebb70_0
                if ($pathinfo === '/css/47ebb70_theme_cronix_black_friday_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '47ebb70',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_47ebb70_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/b250541')) {
                // _assetic_b250541
                if ($pathinfo === '/css/b250541.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'b250541',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_b250541',);
                }

                if (0 === strpos($pathinfo, '/css/b250541_')) {
                    // _assetic_b250541_0
                    if ($pathinfo === '/css/b250541_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'b250541',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_b250541_0',);
                    }

                    // _assetic_b250541_1
                    if ($pathinfo === '/css/b250541_theme_cronix_christmas_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'b250541',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_b250541_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/5c89ae8')) {
                // _assetic_5c89ae8
                if ($pathinfo === '/css/5c89ae8.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '5c89ae8',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_5c89ae8',);
                }

                // _assetic_5c89ae8_0
                if ($pathinfo === '/css/5c89ae8_theme_cronix_valentines_day_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '5c89ae8',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_5c89ae8_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/9294e47')) {
                // _assetic_9294e47
                if ($pathinfo === '/css/9294e47.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '9294e47',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_9294e47',);
                }

                if (0 === strpos($pathinfo, '/css/9294e47_')) {
                    // _assetic_9294e47_0
                    if ($pathinfo === '/css/9294e47_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '9294e47',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_9294e47_0',);
                    }

                    // _assetic_9294e47_1
                    if ($pathinfo === '/css/9294e47_theme_azt_modular_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '9294e47',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_9294e47_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/d2268ce')) {
                // _assetic_d2268ce
                if ($pathinfo === '/css/d2268ce.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'd2268ce',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_d2268ce',);
                }

                if (0 === strpos($pathinfo, '/css/d2268ce_')) {
                    // _assetic_d2268ce_0
                    if ($pathinfo === '/css/d2268ce_reset_1.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'd2268ce',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_d2268ce_0',);
                    }

                    // _assetic_d2268ce_1
                    if ($pathinfo === '/css/d2268ce_theme_azt_valentines_day_modular_2.css') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'd2268ce',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_d2268ce_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/css/c6b9b1b')) {
                // _assetic_c6b9b1b
                if ($pathinfo === '/css/c6b9b1b.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'c6b9b1b',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_c6b9b1b',);
                }

                // _assetic_c6b9b1b_0
                if ($pathinfo === '/css/c6b9b1b_theme_early_access_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'c6b9b1b',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_c6b9b1b_0',);
                }

            }

            if (0 === strpos($pathinfo, '/css/2e1bb33')) {
                // _assetic_2e1bb33
                if ($pathinfo === '/css/2e1bb33.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '2e1bb33',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_2e1bb33',);
                }

                // _assetic_2e1bb33_0
                if ($pathinfo === '/css/2e1bb33_theme_early_access_wom_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '2e1bb33',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_2e1bb33_0',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/21b8632')) {
                // _assetic_21b8632
                if ($pathinfo === '/js/21b8632.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '21b8632',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_21b8632',);
                }

                if (0 === strpos($pathinfo, '/js/21b8632_chosen')) {
                    // _assetic_21b8632_0
                    if ($pathinfo === '/js/21b8632_chosen.jquery.min_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21b8632',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_21b8632_0',);
                    }

                    // _assetic_21b8632_1
                    if ($pathinfo === '/js/21b8632_chosen_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '21b8632',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_21b8632_1',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/8b5157e')) {
                // _assetic_8b5157e
                if ($pathinfo === '/js/8b5157e.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_8b5157e',);
                }

                if (0 === strpos($pathinfo, '/js/8b5157e_')) {
                    // _assetic_8b5157e_0
                    if ($pathinfo === '/js/8b5157e_libraries_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_8b5157e_0',);
                    }

                    // _assetic_8b5157e_1
                    if ($pathinfo === '/js/8b5157e_fos_js_routes_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_8b5157e_1',);
                    }

                    // _assetic_8b5157e_2
                    if ($pathinfo === '/js/8b5157e_jquery.touchSwipe.min_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_8b5157e_2',);
                    }

                    // _assetic_8b5157e_3
                    if ($pathinfo === '/js/8b5157e_TweenMax.min_4.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_8b5157e_3',);
                    }

                    if (0 === strpos($pathinfo, '/js/8b5157e_angular-translate')) {
                        // _assetic_8b5157e_4
                        if ($pathinfo === '/js/8b5157e_angular-translate.min_5.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_8b5157e_4',);
                        }

                        // _assetic_8b5157e_5
                        if ($pathinfo === '/js/8b5157e_angular-translate-loader-static-files.min_6.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_8b5157e_5',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/js/8b5157e_chosen')) {
                        // _assetic_8b5157e_6
                        if ($pathinfo === '/js/8b5157e_chosen.jquery.min_7.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_8b5157e_6',);
                        }

                        // _assetic_8b5157e_7
                        if ($pathinfo === '/js/8b5157e_chosen_8.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_8b5157e_7',);
                        }

                    }

                    // _assetic_8b5157e_8
                    if ($pathinfo === '/js/8b5157e_humanize-duration_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_8b5157e_8',);
                    }

                    // _assetic_8b5157e_9
                    if ($pathinfo === '/js/8b5157e_angular-timer_10.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_8b5157e_9',);
                    }

                    // _assetic_8b5157e_10
                    if ($pathinfo === '/js/8b5157e_moment.min_11.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_8b5157e_10',);
                    }

                    // _assetic_8b5157e_11
                    if ($pathinfo === '/js/8b5157e_angular-animate.min_12.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_8b5157e_11',);
                    }

                    // _assetic_8b5157e_12
                    if ($pathinfo === '/js/8b5157e_Slider_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_8b5157e_12',);
                    }

                    if (0 === strpos($pathinfo, '/js/8b5157e_part_1')) {
                        // _assetic_8b5157e_13
                        if ($pathinfo === '/js/8b5157e_part_14_ng.app_1.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 13,  '_format' => 'js',  '_route' => '_assetic_8b5157e_13',);
                        }

                        if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.')) {
                            if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.a')) {
                                // _assetic_8b5157e_14
                                if ($pathinfo === '/js/8b5157e_part_15_ng.actions_ctrl_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 14,  '_format' => 'js',  '_route' => '_assetic_8b5157e_14',);
                                }

                                if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.article')) {
                                    // _assetic_8b5157e_15
                                    if ($pathinfo === '/js/8b5157e_part_15_ng.article_tab_ctrl_2.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 15,  '_format' => 'js',  '_route' => '_assetic_8b5157e_15',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.articles_')) {
                                        // _assetic_8b5157e_16
                                        if ($pathinfo === '/js/8b5157e_part_15_ng.articles_ctrl_3.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 16,  '_format' => 'js',  '_route' => '_assetic_8b5157e_16',);
                                        }

                                        // _assetic_8b5157e_17
                                        if ($pathinfo === '/js/8b5157e_part_15_ng.articles_pmpca_ctrl_4.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 17,  '_format' => 'js',  '_route' => '_assetic_8b5157e_17',);
                                        }

                                    }

                                }

                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.f')) {
                                // _assetic_8b5157e_18
                                if ($pathinfo === '/js/8b5157e_part_15_ng.feedback_ctrl_5.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 18,  '_format' => 'js',  '_route' => '_assetic_8b5157e_18',);
                                }

                                // _assetic_8b5157e_19
                                if ($pathinfo === '/js/8b5157e_part_15_ng.finished_ctrl_6.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 19,  '_format' => 'js',  '_route' => '_assetic_8b5157e_19',);
                                }

                                // _assetic_8b5157e_20
                                if ($pathinfo === '/js/8b5157e_part_15_ng.footer_ctrl_7.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 20,  '_format' => 'js',  '_route' => '_assetic_8b5157e_20',);
                                }

                            }

                            // _assetic_8b5157e_21
                            if ($pathinfo === '/js/8b5157e_part_15_ng.gacha_ctrl_8.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 21,  '_format' => 'js',  '_route' => '_assetic_8b5157e_21',);
                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.me')) {
                                // _assetic_8b5157e_22
                                if ($pathinfo === '/js/8b5157e_part_15_ng.menu_ctrl_9.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 22,  '_format' => 'js',  '_route' => '_assetic_8b5157e_22',);
                                }

                                // _assetic_8b5157e_23
                                if ($pathinfo === '/js/8b5157e_part_15_ng.messages_ctrl_10.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 23,  '_format' => 'js',  '_route' => '_assetic_8b5157e_23',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.p')) {
                                // _assetic_8b5157e_24
                                if ($pathinfo === '/js/8b5157e_part_15_ng.pay_methods_fixed_amount_ctrl_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 24,  '_format' => 'js',  '_route' => '_assetic_8b5157e_24',);
                                }

                                // _assetic_8b5157e_25
                                if ($pathinfo === '/js/8b5157e_part_15_ng.promo_code_ctrl_12.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 25,  '_format' => 'js',  '_route' => '_assetic_8b5157e_25',);
                                }

                            }

                            // _assetic_8b5157e_26
                            if ($pathinfo === '/js/8b5157e_part_15_ng.register_cash_ctrl_13.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 26,  '_format' => 'js',  '_route' => '_assetic_8b5157e_26',);
                            }

                            // _assetic_8b5157e_27
                            if ($pathinfo === '/js/8b5157e_part_15_ng.shopping_cart_ctrl_14.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 27,  '_format' => 'js',  '_route' => '_assetic_8b5157e_27',);
                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_15_ng.t')) {
                                // _assetic_8b5157e_28
                                if ($pathinfo === '/js/8b5157e_part_15_ng.transaction_status_ctrl_15.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 28,  '_format' => 'js',  '_route' => '_assetic_8b5157e_28',);
                                }

                                // _assetic_8b5157e_29
                                if ($pathinfo === '/js/8b5157e_part_15_ng.tutorial_ctrl_16.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 29,  '_format' => 'js',  '_route' => '_assetic_8b5157e_29',);
                                }

                            }

                        }

                        if (0 === strpos($pathinfo, '/js/8b5157e_part_16_ng.')) {
                            // _assetic_8b5157e_30
                            if ($pathinfo === '/js/8b5157e_part_16_ng.calculate_price_directive_1.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 30,  '_format' => 'js',  '_route' => '_assetic_8b5157e_30',);
                            }

                            // _assetic_8b5157e_31
                            if ($pathinfo === '/js/8b5157e_part_16_ng.tooltip_directive_2.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 31,  '_format' => 'js',  '_route' => '_assetic_8b5157e_31',);
                            }

                        }

                        if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.')) {
                            if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.a')) {
                                // _assetic_8b5157e_32
                                if ($pathinfo === '/js/8b5157e_part_17_ng.alerts_service_1.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 32,  '_format' => 'js',  '_route' => '_assetic_8b5157e_32',);
                                }

                                if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.api_')) {
                                    if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.api_a')) {
                                        // _assetic_8b5157e_33
                                        if ($pathinfo === '/js/8b5157e_part_17_ng.api_app_shop_has_articles_service_2.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 33,  '_format' => 'js',  '_route' => '_assetic_8b5157e_33',);
                                        }

                                        if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.api_article_')) {
                                            // _assetic_8b5157e_34
                                            if ($pathinfo === '/js/8b5157e_part_17_ng.api_article_pmpca_service_3.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 34,  '_format' => 'js',  '_route' => '_assetic_8b5157e_34',);
                                            }

                                            // _assetic_8b5157e_35
                                            if ($pathinfo === '/js/8b5157e_part_17_ng.api_article_tabs_service_4.js') {
                                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 35,  '_format' => 'js',  '_route' => '_assetic_8b5157e_35',);
                                            }

                                        }

                                    }

                                    // _assetic_8b5157e_36
                                    if ($pathinfo === '/js/8b5157e_part_17_ng.api_country_service_5.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 36,  '_format' => 'js',  '_route' => '_assetic_8b5157e_36',);
                                    }

                                    // _assetic_8b5157e_37
                                    if ($pathinfo === '/js/8b5157e_part_17_ng.api_item_category_service_6.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 37,  '_format' => 'js',  '_route' => '_assetic_8b5157e_37',);
                                    }

                                    // _assetic_8b5157e_38
                                    if ($pathinfo === '/js/8b5157e_part_17_ng.api_notification_service_7.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 38,  '_format' => 'js',  '_route' => '_assetic_8b5157e_38',);
                                    }

                                    if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.api_p')) {
                                        // _assetic_8b5157e_39
                                        if ($pathinfo === '/js/8b5157e_part_17_ng.api_pay_methods_fixed_amount_service_8.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 39,  '_format' => 'js',  '_route' => '_assetic_8b5157e_39',);
                                        }

                                        // _assetic_8b5157e_40
                                        if ($pathinfo === '/js/8b5157e_part_17_ng.api_promo_code_service_9.js') {
                                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 40,  '_format' => 'js',  '_route' => '_assetic_8b5157e_40',);
                                        }

                                    }

                                    // _assetic_8b5157e_41
                                    if ($pathinfo === '/js/8b5157e_part_17_ng.api_transaction_status_service_10.js') {
                                        return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 41,  '_format' => 'js',  '_route' => '_assetic_8b5157e_41',);
                                    }

                                }

                                // _assetic_8b5157e_42
                                if ($pathinfo === '/js/8b5157e_part_17_ng.article_helper_11.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 42,  '_format' => 'js',  '_route' => '_assetic_8b5157e_42',);
                                }

                            }

                            // _assetic_8b5157e_43
                            if ($pathinfo === '/js/8b5157e_part_17_ng.device_12.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 43,  '_format' => 'js',  '_route' => '_assetic_8b5157e_43',);
                            }

                            // _assetic_8b5157e_44
                            if ($pathinfo === '/js/8b5157e_part_17_ng.find_object_service_13.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 44,  '_format' => 'js',  '_route' => '_assetic_8b5157e_44',);
                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.h')) {
                                // _assetic_8b5157e_45
                                if ($pathinfo === '/js/8b5157e_part_17_ng.handle_transaction_status_service_14.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 45,  '_format' => 'js',  '_route' => '_assetic_8b5157e_45',);
                                }

                                // _assetic_8b5157e_46
                                if ($pathinfo === '/js/8b5157e_part_17_ng.http_interceptor_service_15.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 46,  '_format' => 'js',  '_route' => '_assetic_8b5157e_46',);
                                }

                            }

                            // _assetic_8b5157e_47
                            if ($pathinfo === '/js/8b5157e_part_17_ng.page_transition_service_16.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 47,  '_format' => 'js',  '_route' => '_assetic_8b5157e_47',);
                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.r')) {
                                // _assetic_8b5157e_48
                                if ($pathinfo === '/js/8b5157e_part_17_ng.reset_vars_service_17.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 48,  '_format' => 'js',  '_route' => '_assetic_8b5157e_48',);
                                }

                                // _assetic_8b5157e_49
                                if ($pathinfo === '/js/8b5157e_part_17_ng.routing_service_18.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 49,  '_format' => 'js',  '_route' => '_assetic_8b5157e_49',);
                                }

                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_17_ng.s')) {
                                // _assetic_8b5157e_50
                                if ($pathinfo === '/js/8b5157e_part_17_ng.sliders_service_19.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 50,  '_format' => 'js',  '_route' => '_assetic_8b5157e_50',);
                                }

                                // _assetic_8b5157e_51
                                if ($pathinfo === '/js/8b5157e_part_17_ng.state_service_20.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 51,  '_format' => 'js',  '_route' => '_assetic_8b5157e_51',);
                                }

                            }

                        }

                        // _assetic_8b5157e_52
                        if ($pathinfo === '/js/8b5157e_part_18_ng.facebook_1.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 52,  '_format' => 'js',  '_route' => '_assetic_8b5157e_52',);
                        }

                        if (0 === strpos($pathinfo, '/js/8b5157e_part_19_ng.')) {
                            // _assetic_8b5157e_53
                            if ($pathinfo === '/js/8b5157e_part_19_ng.find_filter_directive_1.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 53,  '_format' => 'js',  '_route' => '_assetic_8b5157e_53',);
                            }

                            // _assetic_8b5157e_54
                            if ($pathinfo === '/js/8b5157e_part_19_ng.number_fixed_len_filter_2.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 54,  '_format' => 'js',  '_route' => '_assetic_8b5157e_54',);
                            }

                            if (0 === strpos($pathinfo, '/js/8b5157e_part_19_ng.r')) {
                                // _assetic_8b5157e_55
                                if ($pathinfo === '/js/8b5157e_part_19_ng.range_filter_3.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 55,  '_format' => 'js',  '_route' => '_assetic_8b5157e_55',);
                                }

                                // _assetic_8b5157e_56
                                if ($pathinfo === '/js/8b5157e_part_19_ng.replace_filter_4.js') {
                                    return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 56,  '_format' => 'js',  '_route' => '_assetic_8b5157e_56',);
                                }

                            }

                            // _assetic_8b5157e_57
                            if ($pathinfo === '/js/8b5157e_part_19_ng.unique_filter_5.js') {
                                return array (  '_controller' => 'assetic.controller:render',  'name' => '8b5157e',  'pos' => 57,  '_format' => 'js',  '_route' => '_assetic_8b5157e_57',);
                            }

                        }

                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

        }

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

                    // admin_app_bundle_Provider_insert_all_pmpc_to_apps
                    if (preg_match('#^/backoffice/ProviderAdmin/(?P<providerId>[^/]++)/insert\\-all\\-pmpcs\\-to\\-apps$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_Provider_insert_all_pmpc_to_apps')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::insertAllPmpcToAppsAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.provider',  '_sonata_name' => 'admin_app_bundle_Provider_insert_all_pmpc_to_apps',));
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
                            return array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::listAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_list',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_list',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_create
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/create') {
                            return array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::createAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_create',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_create',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_batch
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/batch') {
                            return array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::batchAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_batch',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_batch',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_edit
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_edit')), array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::editAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_edit',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_delete
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_delete')), array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::deleteAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_delete',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_show
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_show')), array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::showAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_show',));
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_export
                        if ($pathinfo === '/backoffice/PayMethodProviderHasCountryAdmin/export') {
                            return array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::exportAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_export',  '_route' => 'admin_app_bundle_PayMethodProviderHasCountry_export',);
                        }

                        // admin_app_bundle_PayMethodProviderHasCountry_move
                        if (preg_match('#^/backoffice/PayMethodProviderHasCountryAdmin/(?P<id>[^/]++)/move/(?P<position>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_bundle_PayMethodProviderHasCountry_move')), array (  '_controller' => 'Pix\\SortableBehaviorBundle\\Controller\\SortableAdminController::moveAction',  '_sonata_admin' => 'nvia_pay_method_config.admin.pay_method_provider_has_country',  '_sonata_name' => 'admin_app_bundle_PayMethodProviderHasCountry_move',));
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

                if (0 === strpos($pathinfo, '/backoffice/app/job')) {
                    // admin_app_job_list
                    if ($pathinfo === '/backoffice/app/job/list') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::listAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_list',  '_route' => 'admin_app_job_list',);
                    }

                    // admin_app_job_create
                    if ($pathinfo === '/backoffice/app/job/create') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::createAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_create',  '_route' => 'admin_app_job_create',);
                    }

                    // admin_app_job_batch
                    if ($pathinfo === '/backoffice/app/job/batch') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::batchAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_batch',  '_route' => 'admin_app_job_batch',);
                    }

                    // admin_app_job_edit
                    if (preg_match('#^/backoffice/app/job/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_job_edit')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::editAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_edit',));
                    }

                    // admin_app_job_delete
                    if (preg_match('#^/backoffice/app/job/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_job_delete')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::deleteAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_delete',));
                    }

                    // admin_app_job_show
                    if (preg_match('#^/backoffice/app/job/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_app_job_show')), array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::showAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_show',));
                    }

                    // admin_app_job_export
                    if ($pathinfo === '/backoffice/app/job/export') {
                        return array (  '_controller' => 'Sonata\\AdminBundle\\Controller\\CRUDController::exportAction',  '_sonata_admin' => 'app.admin.job',  '_sonata_name' => 'admin_app_job_export',  '_route' => 'admin_app_job_export',);
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
                    // api_transaction_create_transaction_direct_articles
                    if (0 === strpos($pathinfo, '/api/v1/transaction_articles') && preg_match('#^/api/v1/transaction_articles(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_transaction_create_transaction_direct_articles;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_transaction_create_transaction_direct_articles')), array (  '_controller' => 'AppBundle\\Controller\\Api\\TransactionController::createTransactionDirectArticlesAction',  '_format' => 'json',));
                    }
                    not_api_transaction_create_transaction_direct_articles:

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
                if (0 === strpos($pathinfo, '/api/v1/promo_code/check') && preg_match('#^/api/v1/promo_code/check/(?P<promo_code>.+?)(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_promo_code_is_valid;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_is_valid')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::isValidAction',  '_format' => 'json',));
                }
                not_api_promo_code_is_valid:

                // api_promo_code_create_promo_code
                if (preg_match('#^/api/v1/promo_code(?:\\.(?P<_format>xml|json|html))?$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_promo_code_create_promo_code;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_promo_code_create_promo_code')), array (  '_controller' => 'AppBundle\\Controller\\Api\\PromoCodeController::createPromoCodeAction',  '_format' => 'json',));
                }
                not_api_promo_code_create_promo_code:

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

        }

        if (0 === strpos($pathinfo, '/shop')) {
            if (0 === strpos($pathinfo, '/shop/payment')) {
                if (0 === strpos($pathinfo, '/shop/payment/begin')) {
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

            if (0 === strpos($pathinfo, '/backoffice/p')) {
                // pmpc_admin_move
                if (0 === strpos($pathinfo, '/backoffice/pay_method_provider_has_country/move') && preg_match('#^/backoffice/pay_method_provider_has_country/move/(?P<pmpc_id>[^/]++)/(?P<position>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'pmpc_admin_move')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\PayMethodProviderHasCountryAdminController::indexAction',));
                }

                // insert_all_pmpc_to_apps
                if (0 === strpos($pathinfo, '/backoffice/provider/insert_all_pmpc_to_apps') && preg_match('#^/backoffice/provider/insert_all_pmpc_to_apps/(?P<provider_id>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'insert_all_pmpc_to_apps')), array (  '_controller' => 'AppBundle\\Controller\\Admin\\ProviderAdminController::indexAction',));
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
        if (preg_match('#^/(?P<_locale>(en|es))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'home')), array (  '_locale' => 'en',  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::indexAction',));
        }

        // try_control_panel
        if ($pathinfo === '/try-control-panel') {
            return array (  '_controller' => 'AppBundle\\Controller\\Others\\DefaultController::adminViewpAction',  '_route' => 'try_control_panel',);
        }

        // singup
        if (preg_match('#^/(?P<_locale>(en|es))/sign\\-up$#s', $pathinfo, $matches)) {
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
                        // admin_cost_of_life
                        if (0 === strpos($pathinfo, '/admin/api/country/cost_of_life') && preg_match('#^/admin/api/country/cost_of_life/(?P<amount>[^/]++)/(?P<country_id>[^/]++)/(?P<country_id_wanted>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_cost_of_life')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::costOfLifeAction',));
                        }

                        // admin_exchange
                        if (0 === strpos($pathinfo, '/admin/api/country/exchange') && preg_match('#^/admin/api/country/exchange/(?P<amount>[^/]++)/(?P<country_id>[^/]++)/(?P<country_id_wanted>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_exchange')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CountryController::exchangeAction',));
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

                // admin_credentials
                if (0 === strpos($pathinfo, '/admin/api/credentials') && preg_match('#^/admin/api/credentials/(?P<app>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_credentials')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\CredentialsController::transactionsAction',));
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

                    // promo_codes_tocsv
                    if (preg_match('#^/admin/api/app/(?P<app>[^/]++)/promo/(?P<promoId>[^/]++)/codes/toCsv/?$#s', $pathinfo, $matches)) {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'promo_codes_tocsv');
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'promo_codes_tocsv')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PromoCodeController::promoCodesToCsv',));
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

                if (0 === strpos($pathinfo, '/admin/api/purchases')) {
                    // admin_purchases_toCsv
                    if (0 === strpos($pathinfo, '/admin/api/purchases/toCsv') && preg_match('#^/admin/api/purchases/toCsv/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchases_toCsv')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchasesController::purchasesToCSVAction',));
                    }

                    // admin_purchases
                    if (preg_match('#^/admin/api/purchases/(?P<app>[^/]++)/(?P<date_from>[^/]++)/(?P<date_to>[^/]++)/(?P<currency>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_purchases')), array (  '_controller' => 'AppBundle\\Controller\\ClientAdmin\\PurchasesController::statsAction',));
                    }

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
