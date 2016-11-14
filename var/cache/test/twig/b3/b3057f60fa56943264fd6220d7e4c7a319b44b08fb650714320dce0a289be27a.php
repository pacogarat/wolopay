<?php

/* AppBundle:ClientAdmin/Default/includes:header.html.twig */
class __TwigTemplate_51ca3bcecc96a68368a4915917941944842a2c6b801600be782e271630a49c02 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_51f690feb53ad7a86a5b908cf39d789ddc41b8274ac84388da137ce8b9a854ae = $this->env->getExtension("native_profiler");
        $__internal_51f690feb53ad7a86a5b908cf39d789ddc41b8274ac84388da137ce8b9a854ae->enter($__internal_51f690feb53ad7a86a5b908cf39d789ddc41b8274ac84388da137ce8b9a854ae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:ClientAdmin/Default/includes:header.html.twig"));

        // line 1
        echo "<div id=\"logo-group\">

    <!-- PLACE YOUR LOGO HERE -->
    <span id=\"logo\"> <img src=\"";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/client_admin/img/logo.png"), "html", null, true);
        echo "\" alt=\"Wolopay\"> </span>
    <!-- END LOGO PLACEHOLDER -->
    <span data-ng-controller=\"ActivityDemoCtrl\">
        <span id=\"activity\" class=\"activity-dropdown ng-scope ng-isolate-scope\" ng-click=\"activityShow = !activityShow\" ng-init=\"activityShow=false\"  data-icon=\"fa fa-user\" data-total=\"total\">
            <i ng-class=\"icon\" class=\"fa fa-user\"></i>
            <b class=\"badge bounceIn animated\" ng-class=\"totalNotifications > 0 ? 'bg-color-red' : ''\" ng-cloak=\"\">{[{ totalNotifications }]}</b>
        </span>

        <div class=\"ajax-dropdown\" ng-class=\"{'active block': activityShow}\">
            <div class=\"btn-group btn-group-justified\" data-toggle=\"buttons\">
                <label class=\"btn btn-default ng-scope ng-isolate-scope active\" data-ng-repeat=\"item in items\">
                    <input type=\"radio\" name=\"activity\">
                    <span data-translate=\"notifications\"></span><span> ({[{ nNotifications || \"0\" }]})</span>
                </label>
            </div>
            <div class=\"ajax-notifications custom-scroll\">
                <ul class=\"notification-body\">
                    <li ng-repeat=\"notification in notifications\" ng-click=\"open(notification)\" >
                        <span ng-class=\"{unread: notification.unread, read: !notification.unread}\">
                            <a href=\"javascript:void(0);\" class=\"msg\">

                                <em ng-if=\"notification.type == 'info'\" class=\"badge padding-5 no-border-radius bg-color-green air air-top-left margin-top-5\">
                                    <i class=\"fa fa-check fa-fw fa-2x\"></i>
                                </em>

                                <em ng-if=\"notification.type == 'warning'\" class=\"badge padding-5 no-border-radius bg-color-yellow air air-top-left margin-top-5\">
                                    <i class=\"fa fa-exclamation fa-fw fa-2x\"></i>
                                </em>

                                <em ng-if=\"notification.type == 'error'\" class=\"badge padding-5 no-border-radius bg-color-red air air-top-left margin-top-5\">
                                    <i class=\"fa fa-minus-circle fa-fw fa-2x\"></i>
                                </em>

                                <span class=\"subject\">{[{ notification.title }]}</span>
                                <span class=\"msg-body\">{[{ notification.message }]}</span>
                                <div style=\"color:#aaa; text-align: right; font-size: 0.7em;margin-top: 7px\">{[{ notification.created_at | date:'yyyy-MM-dd HH:mm:ss' }]}</div>
                            </a>
                        </span>
                        <!--MODAL WINDOW-->
                        <script type=\"text/ng-template\" id=\"notificationModal.html\">
                            <div class=\"modal-header\">
                                <h2 class=\"text-center\">{[{ notification.title}]}</h2>
                            </div>
                            <div class=\"modal-body\" style=\"padding-bottom: 30px\">
                                <p ng-bind-html=\"notification.message |nl2br \">
                                </p>
                            </div>
                        </script>
                    </li>
                </ul>
            </div>
            <span class=\"ng-binding\"> {[{ footerContent }]}

                <button type=\"button\" data-loading-text=\"Loading...\" data-ng-click=\"refreshCallback()\" class=\"btn btn-xs btn-default pull-right\" data-activty-refresh-button=\"\">
                    <i class=\"fa fa-refresh\"></i>
                </button>
                <button type=\"button\" data-loading-text=\"Loading...\" data-ng-click=\"clearNotificationsCallback()\" class=\"btn btn-xs btn-default pull-right\" data-activty-refresh-button=\"\" style=\"margin-right: 8px\">
                    <i class=\"fa fa-trash-o\"></i>
                </button>
            </span>
        </div>

    </span>
</div>

<!-- projects dropdown -->
<div class=\"project-context\">

    <span class=\"label\"><span data-translate=\"applications\"></span>:</span>
    <span class=\"project-selector\" class=\"popoverw-trigger-element dropdown-toggle\"  data-toggle=\"dropdown\">
        <span ng-cloak class=\"ng-cloack no-wrap\">{[{ app.name }]}</span>
        <i class=\"fa fa-angle-down\"></i>
    </span>

    <!-- Suggestion: populate this list with fetch and push technique -->
    <ul class=\"dropdown-menu\">
        <li ng-repeat=\"ap in apps\">
            <a href=\"javascript:void(0);\" ng-click=\"\$root.app = ap\">{[{ ap.name }]}</a>
        </li>
    </ul>



<!-- end dropdown-menu-->
</div>
";
        // line 89
        if ($this->env->getExtension('security')->isGranted("ROLE_ADMIN_MANAGE_PROJECTS")) {
            // line 90
            echo "
    <div style=\"position: relative\">

        <div class=\"btn-header popoverw-trigger-element dropdown-toggle\" data-toggle=\"dropdown\">
            <span>
                <a class=\"btn-header\" href=\"#/projects/list\">
                    <i class=\"fa fa-gear\"></i>
                </a>
            </span>
        </div>

        <!-- Suggestion: populate this list with fetch and push technique -->

        <ul class=\"dropdown-menu\" >
            <li>
                <a href=\"#/projects/list\" translate=\"client.configure.projects\"></a>
            </li>
            <li>
                <a href=\"#/merchant/pay-methods-credentials\" translate=\"client.configure.paymethods_credentials\"></a>
            </li>
            <li has-permission=\"ROLE_ADMIN_INVOICES\">
                <a href=\"#/merchant/documents/index\" translate=\"client.configure.documents\"></a>
            </li>
        </ul>
    </div>

";
        }
        // line 117
        echo "<!-- end projects dropdown -->

<!-- pulled right: nav area -->
<div class=\"pull-right\">

    <!-- collapse menu button -->
    <div id=\"hide-menu\" class=\"btn-header pull-right\">
        <span>
            <a href=\"javascript:void(0);\" data-action=\"toggleMenu\" title=\"Collapse Menu\">
                <i class=\"fa fa-reorder\"></i>
            </a>
        </span>
    </div>
    <!-- end collapse menu -->

    <!-- Top menu profile link : this shows only when top menu is active -->
    <ul id=\"mobile-profile-img\" class=\"header-dropdown-list hidden-xs padding-5\">
        <li class=\"\">
            <a href=\"#\" class=\"dropdown-toggle no-margin userdropdown\" data-toggle=\"dropdown\">
                <img src=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/client_admin/img/avatars/male.png"), "html", null, true);
        echo "\" class=\"online\"/>
            </a>
            <ul class=\"dropdown-menu pull-right\">
                <li>
                    <a href=\"javascript:void(0);\" class=\"padding-10 padding-top-0 padding-bottom-0\">
                        <i class=\"fa fa-cog\"></i> Setting
                    </a>
                </li>
                <li class=\"divider\"></li>
                <li>
                    <a href=\"#/misc/other/profile\" class=\"padding-10 padding-top-0 padding-bottom-0\">
                        <i class=\"fa fa-user\"></i> <u>P</u>rofile
                    </a>
                </li>
                <li class=\"divider\"></li>
                <li>
                    <a href=\"javascript:void(0);\" class=\"padding-10 padding-top-0 padding-bottom-0\" data-action=\"toggleShortcut\">
                        <i class=\"fa fa-arrow-down\"></i> <u>S</u>hortcut
                    </a>
                </li>
                <li class=\"divider\"></li>
                <li>
                    <a href=\"javascript:void(0);\" class=\"padding-10 padding-top-0 padding-bottom-0\" data-action=\"launchFullscreen\">
                        <i class=\"fa fa-arrows-alt\"></i> Full <u>S</u>creen
                    </a>
                </li>
                <li class=\"divider\"></li>
                <li>
                    <a href=\"/logout\" class=\"padding-10 padding-top-5 padding-bottom-5\" data-action=\"userLogout\">
                        <i class=\"fa fa-sign-out fa-lg\"></i> <strong><u>L</u>ogout</strong></a>
                </li>
            </ul>
        </li>
    </ul>

    <!-- logout button -->
    <div id=\"logout\" class=\"btn-header transparent pull-right\">
        <span> <a href=\"/logout\" data-action=\"userLogout\">
                <i class=\"fa fa-sign-out\"></i></a> </span>
    </div>
    <!-- end logout button -->

    <!-- search mobile button (this is hidden till mobile view port) -->
    ";
        // line 180
        echo "        ";
        // line 181
        echo "    ";
        // line 182
        echo "    <!-- end search mobile button -->

    <!-- input: search field -->
    ";
        // line 186
        echo "        ";
        // line 187
        echo "        ";
        // line 188
        echo "            ";
        // line 189
        echo "        ";
        // line 190
        echo "        ";
        // line 191
        echo "    ";
        // line 192
        echo "    <!-- end input: search field -->

    <!-- fullscreen button -->
    <div id=\"fullscreen\" class=\"btn-header transparent pull-right\">
        <span> <a href=\"javascript:void(0);\" data-action=\"launchFullscreen\" title=\"Full Screen\">
                <i class=\"fa fa-arrows-alt\"></i></a> </span>
    </div>
    <!-- end fullscreen button -->

    <!-- multiple lang dropdown : find all flags in the image folder -->
    <ul data-lang-menu=\"\" class=\"header-dropdown-list hidden-xs\" data-ng-controller=\"LangController\" style=\"margin-right: 20px\">
        <li>
            <a href=\"\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                <img alt=\"\" class=\"flag flag-{[{ language.id }]}\" src=\"";
        // line 205
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/1x1.png"), "html", null, true);
        echo "\">
                <span ng-cloak> {[{ language.name}]} </span> <i class=\"fa fa-angle-down\"></i>
            </a>
            <ul class=\"dropdown-menu pull-right\">
                <li data-ng-class=\"{active: lang == currentLang}\" data-ng-repeat=\"lang in languages\">
                    <a href=\"\" data-ng-click=\"setLang(lang)\">
                        <img class=\"flag flag-{[{ lang.id }]}\" src=\"";
        // line 211
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/1x1.png"), "html", null, true);
        echo "\"/> {[{ lang.name }]}
                        ({[{ lang.local_name }]})
                    </a>
                </li>
            </ul>
        </li>
    </ul>

</div>
<!-- end pulled right: nav area -->";
        
        $__internal_51f690feb53ad7a86a5b908cf39d789ddc41b8274ac84388da137ce8b9a854ae->leave($__internal_51f690feb53ad7a86a5b908cf39d789ddc41b8274ac84388da137ce8b9a854ae_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:ClientAdmin/Default/includes:header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  258 => 211,  249 => 205,  234 => 192,  232 => 191,  230 => 190,  228 => 189,  226 => 188,  224 => 187,  222 => 186,  217 => 182,  215 => 181,  213 => 180,  167 => 136,  146 => 117,  117 => 90,  115 => 89,  27 => 4,  22 => 1,);
    }
}
/* <div id="logo-group">*/
/* */
/*     <!-- PLACE YOUR LOGO HERE -->*/
/*     <span id="logo"> <img src="{{ asset('bundles/app/client_admin/img/logo.png')}}" alt="Wolopay"> </span>*/
/*     <!-- END LOGO PLACEHOLDER -->*/
/*     <span data-ng-controller="ActivityDemoCtrl">*/
/*         <span id="activity" class="activity-dropdown ng-scope ng-isolate-scope" ng-click="activityShow = !activityShow" ng-init="activityShow=false"  data-icon="fa fa-user" data-total="total">*/
/*             <i ng-class="icon" class="fa fa-user"></i>*/
/*             <b class="badge bounceIn animated" ng-class="totalNotifications > 0 ? 'bg-color-red' : ''" ng-cloak="">{[{ totalNotifications }]}</b>*/
/*         </span>*/
/* */
/*         <div class="ajax-dropdown" ng-class="{'active block': activityShow}">*/
/*             <div class="btn-group btn-group-justified" data-toggle="buttons">*/
/*                 <label class="btn btn-default ng-scope ng-isolate-scope active" data-ng-repeat="item in items">*/
/*                     <input type="radio" name="activity">*/
/*                     <span data-translate="notifications"></span><span> ({[{ nNotifications || "0" }]})</span>*/
/*                 </label>*/
/*             </div>*/
/*             <div class="ajax-notifications custom-scroll">*/
/*                 <ul class="notification-body">*/
/*                     <li ng-repeat="notification in notifications" ng-click="open(notification)" >*/
/*                         <span ng-class="{unread: notification.unread, read: !notification.unread}">*/
/*                             <a href="javascript:void(0);" class="msg">*/
/* */
/*                                 <em ng-if="notification.type == 'info'" class="badge padding-5 no-border-radius bg-color-green air air-top-left margin-top-5">*/
/*                                     <i class="fa fa-check fa-fw fa-2x"></i>*/
/*                                 </em>*/
/* */
/*                                 <em ng-if="notification.type == 'warning'" class="badge padding-5 no-border-radius bg-color-yellow air air-top-left margin-top-5">*/
/*                                     <i class="fa fa-exclamation fa-fw fa-2x"></i>*/
/*                                 </em>*/
/* */
/*                                 <em ng-if="notification.type == 'error'" class="badge padding-5 no-border-radius bg-color-red air air-top-left margin-top-5">*/
/*                                     <i class="fa fa-minus-circle fa-fw fa-2x"></i>*/
/*                                 </em>*/
/* */
/*                                 <span class="subject">{[{ notification.title }]}</span>*/
/*                                 <span class="msg-body">{[{ notification.message }]}</span>*/
/*                                 <div style="color:#aaa; text-align: right; font-size: 0.7em;margin-top: 7px">{[{ notification.created_at | date:'yyyy-MM-dd HH:mm:ss' }]}</div>*/
/*                             </a>*/
/*                         </span>*/
/*                         <!--MODAL WINDOW-->*/
/*                         <script type="text/ng-template" id="notificationModal.html">*/
/*                             <div class="modal-header">*/
/*                                 <h2 class="text-center">{[{ notification.title}]}</h2>*/
/*                             </div>*/
/*                             <div class="modal-body" style="padding-bottom: 30px">*/
/*                                 <p ng-bind-html="notification.message |nl2br ">*/
/*                                 </p>*/
/*                             </div>*/
/*                         </script>*/
/*                     </li>*/
/*                 </ul>*/
/*             </div>*/
/*             <span class="ng-binding"> {[{ footerContent }]}*/
/* */
/*                 <button type="button" data-loading-text="Loading..." data-ng-click="refreshCallback()" class="btn btn-xs btn-default pull-right" data-activty-refresh-button="">*/
/*                     <i class="fa fa-refresh"></i>*/
/*                 </button>*/
/*                 <button type="button" data-loading-text="Loading..." data-ng-click="clearNotificationsCallback()" class="btn btn-xs btn-default pull-right" data-activty-refresh-button="" style="margin-right: 8px">*/
/*                     <i class="fa fa-trash-o"></i>*/
/*                 </button>*/
/*             </span>*/
/*         </div>*/
/* */
/*     </span>*/
/* </div>*/
/* */
/* <!-- projects dropdown -->*/
/* <div class="project-context">*/
/* */
/*     <span class="label"><span data-translate="applications"></span>:</span>*/
/*     <span class="project-selector" class="popoverw-trigger-element dropdown-toggle"  data-toggle="dropdown">*/
/*         <span ng-cloak class="ng-cloack no-wrap">{[{ app.name }]}</span>*/
/*         <i class="fa fa-angle-down"></i>*/
/*     </span>*/
/* */
/*     <!-- Suggestion: populate this list with fetch and push technique -->*/
/*     <ul class="dropdown-menu">*/
/*         <li ng-repeat="ap in apps">*/
/*             <a href="javascript:void(0);" ng-click="$root.app = ap">{[{ ap.name }]}</a>*/
/*         </li>*/
/*     </ul>*/
/* */
/* */
/* */
/* <!-- end dropdown-menu-->*/
/* </div>*/
/* {% if is_granted('ROLE_ADMIN_MANAGE_PROJECTS') %}*/
/* */
/*     <div style="position: relative">*/
/* */
/*         <div class="btn-header popoverw-trigger-element dropdown-toggle" data-toggle="dropdown">*/
/*             <span>*/
/*                 <a class="btn-header" href="#/projects/list">*/
/*                     <i class="fa fa-gear"></i>*/
/*                 </a>*/
/*             </span>*/
/*         </div>*/
/* */
/*         <!-- Suggestion: populate this list with fetch and push technique -->*/
/* */
/*         <ul class="dropdown-menu" >*/
/*             <li>*/
/*                 <a href="#/projects/list" translate="client.configure.projects"></a>*/
/*             </li>*/
/*             <li>*/
/*                 <a href="#/merchant/pay-methods-credentials" translate="client.configure.paymethods_credentials"></a>*/
/*             </li>*/
/*             <li has-permission="ROLE_ADMIN_INVOICES">*/
/*                 <a href="#/merchant/documents/index" translate="client.configure.documents"></a>*/
/*             </li>*/
/*         </ul>*/
/*     </div>*/
/* */
/* {% endif %}*/
/* <!-- end projects dropdown -->*/
/* */
/* <!-- pulled right: nav area -->*/
/* <div class="pull-right">*/
/* */
/*     <!-- collapse menu button -->*/
/*     <div id="hide-menu" class="btn-header pull-right">*/
/*         <span>*/
/*             <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu">*/
/*                 <i class="fa fa-reorder"></i>*/
/*             </a>*/
/*         </span>*/
/*     </div>*/
/*     <!-- end collapse menu -->*/
/* */
/*     <!-- Top menu profile link : this shows only when top menu is active -->*/
/*     <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">*/
/*         <li class="">*/
/*             <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">*/
/*                 <img src="{{ asset('bundles/app/client_admin/img/avatars/male.png') }}" class="online"/>*/
/*             </a>*/
/*             <ul class="dropdown-menu pull-right">*/
/*                 <li>*/
/*                     <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0">*/
/*                         <i class="fa fa-cog"></i> Setting*/
/*                     </a>*/
/*                 </li>*/
/*                 <li class="divider"></li>*/
/*                 <li>*/
/*                     <a href="#/misc/other/profile" class="padding-10 padding-top-0 padding-bottom-0">*/
/*                         <i class="fa fa-user"></i> <u>P</u>rofile*/
/*                     </a>*/
/*                 </li>*/
/*                 <li class="divider"></li>*/
/*                 <li>*/
/*                     <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut">*/
/*                         <i class="fa fa-arrow-down"></i> <u>S</u>hortcut*/
/*                     </a>*/
/*                 </li>*/
/*                 <li class="divider"></li>*/
/*                 <li>*/
/*                     <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen">*/
/*                         <i class="fa fa-arrows-alt"></i> Full <u>S</u>creen*/
/*                     </a>*/
/*                 </li>*/
/*                 <li class="divider"></li>*/
/*                 <li>*/
/*                     <a href="/logout" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout">*/
/*                         <i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>*/
/*                 </li>*/
/*             </ul>*/
/*         </li>*/
/*     </ul>*/
/* */
/*     <!-- logout button -->*/
/*     <div id="logout" class="btn-header transparent pull-right">*/
/*         <span> <a href="/logout" data-action="userLogout">*/
/*                 <i class="fa fa-sign-out"></i></a> </span>*/
/*     </div>*/
/*     <!-- end logout button -->*/
/* */
/*     <!-- search mobile button (this is hidden till mobile view port) -->*/
/*     {#<div id="search-mobile" class="btn-header transparent pull-right">#}*/
/*         {#<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>#}*/
/*     {#</div>#}*/
/*     <!-- end search mobile button -->*/
/* */
/*     <!-- input: search field -->*/
/*     {#<form action="#/misc/search" class="header-search pull-right">#}*/
/*         {#<input id="search-fld" type="text" name="param" data-translate="search" placeholder="">#}*/
/*         {#<button type="submit">#}*/
/*             {#<i class="fa fa-search"></i>#}*/
/*         {#</button>#}*/
/*         {#<a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>#}*/
/*     {#</form>#}*/
/*     <!-- end input: search field -->*/
/* */
/*     <!-- fullscreen button -->*/
/*     <div id="fullscreen" class="btn-header transparent pull-right">*/
/*         <span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen">*/
/*                 <i class="fa fa-arrows-alt"></i></a> </span>*/
/*     </div>*/
/*     <!-- end fullscreen button -->*/
/* */
/*     <!-- multiple lang dropdown : find all flags in the image folder -->*/
/*     <ul data-lang-menu="" class="header-dropdown-list hidden-xs" data-ng-controller="LangController" style="margin-right: 20px">*/
/*         <li>*/
/*             <a href="" class="dropdown-toggle" data-toggle="dropdown">*/
/*                 <img alt="" class="flag flag-{[{ language.id }]}" src="{{ asset("img/1x1.png") }}">*/
/*                 <span ng-cloak> {[{ language.name}]} </span> <i class="fa fa-angle-down"></i>*/
/*             </a>*/
/*             <ul class="dropdown-menu pull-right">*/
/*                 <li data-ng-class="{active: lang == currentLang}" data-ng-repeat="lang in languages">*/
/*                     <a href="" data-ng-click="setLang(lang)">*/
/*                         <img class="flag flag-{[{ lang.id }]}" src="{{ asset("img/1x1.png") }}"/> {[{ lang.name }]}*/
/*                         ({[{ lang.local_name }]})*/
/*                     </a>*/
/*                 </li>*/
/*             </ul>*/
/*         </li>*/
/*     </ul>*/
/* */
/* </div>*/
/* <!-- end pulled right: nav area -->*/