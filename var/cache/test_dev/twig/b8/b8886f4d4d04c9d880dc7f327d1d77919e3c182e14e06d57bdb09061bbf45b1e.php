<?php

/* AppBundle:ClientAdmin/Default/includes:left-panel.html.twig */
class __TwigTemplate_dd5bd739c6fd9772c965934a085f5bcd8224c4835b7e55053d42eac87fbd2b62 extends Twig_Template
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
        $__internal_f9ca06e566eaf8aca569499fc0f4270bf8e7c0d0da2c3897de907f01e927f4ba = $this->env->getExtension("native_profiler");
        $__internal_f9ca06e566eaf8aca569499fc0f4270bf8e7c0d0da2c3897de907f01e927f4ba->enter($__internal_f9ca06e566eaf8aca569499fc0f4270bf8e7c0d0da2c3897de907f01e927f4ba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:ClientAdmin/Default/includes:left-panel.html.twig"));

        // line 1
        echo "<!-- User info -->
<div class=\"login-info\" >
    <span> <!-- User image size is adjusted inside CSS, it should stay as is -->

        <a href=\"javascript:void(0);\" id=\"show-shortcut\" tooltip-placement=\"right\" tooltip=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "name", array()), "html", null, true);
        echo "\">
            <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/client_admin/img/avatars/male.png"), "html", null, true);
        echo "\" class=\"online\" >
            <span id=\"nav_name_user\">
                ";
        // line 8
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "name", array()), "html", null, true);
        echo "
            </span>
        </a>

    </span>
</div>

<!-- end user info -->

";
        // line 18
        echo "
";
        // line 23
        echo "<navigation>
    <nav:item data-view=\"/dashboard\" data-icon=\"fa fa-lg fa-fw fa-home\" title=\"menu.dashboard\"></nav:item>

    <nav:group data-icon=\"fa fa-lg fa-fw fa-bar-chart-o\" title=\"menu.analitycs\" has-permission=\"ROLE_ADMIN_ANALITYCS\">
        <nav:item data-view=\"/analytics/transactions-purchases\" title=\"menu.analytics.transactions_purchases\"></nav:item>
        <nav:item data-view=\"/analytics/user-levels\" title=\"menu.analytics.users_levels\"></nav:item>
        <nav:item data-view=\"/analytics/payment-methods\" title=\"menu.analytics.payment_methods\"></nav:item>
        <nav:item data-view=\"/analytics/continents-countries\" title=\"menu.analytics.continents_countries\"></nav:item>
        <nav:item data-view=\"/analytics/articles-shops\" title=\"menu.analytics.articles_shops\"></nav:item>
    </nav:group>

    <nav:item data-view=\"/transactions\" data-icon=\"fa fa-lg fa-fw fa-list-alt\" has-permission=\"ROLE_ADMIN_TRANSACTIONS\" title=\"menu.transactions\"></nav:item>
    <nav:item data-view=\"/purchases\" data-icon=\"fa fa-lg fa-fw fa-bullseye\" has-permission=\"ROLE_ADMIN_PURCHASES\" title=\"menu.purchases\"></nav:item>
    <nav:item data-view=\"/active-subscriptions\" data-icon=\"fa fa-lg fa-fw fa-recycle\" has-permission=\"ROLE_ADMIN_SUBSCRIPTIONS\" title=\"menu.active_subscriptions\"></nav:item>
    <nav:item data-view=\"/notifications\" data-icon=\"fa fa-lg fa-fw fa-bell-o\" has-permission=\"ROLE_ADMIN_NOTIFICATIONS\" title=\"menu.notifications\"></nav:item>
    <nav:item data-view=\"/configuration/shop/test\" data-icon=\"fa fa-lg  fa-fw fa-car\" title=\"menu.config.shop_test\" has-permission=\"ROLE_ADMIN_SHOP_TEST\"></nav:item>

    <nav:group data-icon=\"fa fa-lg fa-fw fa-gear\" title=\"menu.configuration\" has-permission=\"ROLE_ADMIN_CONFIGURE\">
        <nav:item data-view=\"/configuration/configurator/wizard\" title=\"menu.config.configurator\"></nav:item>
        <nav:item data-view=\"/configuration/offers/list\" title=\"menu.config.offers\"></nav:item>

        <nav:item data-view=\"/configuration/promo-codes/list\" title=\"menu.config.promo_codes\"></nav:item>
        <nav:item data-view=\"/configuration/blacklist/index\" title=\"menu.config.blacklist\"></nav:item>
    </nav:group>
    <nav:item data-view=\"/credentials\" data-icon=\"fa fa-lg fa-fw fa-key\" has-permission=\"ROLE_ADMIN_CREDENTIALS\" title=\"menu.credentials\"></nav:item>
    <nav:group data-icon=\"fa fa-lg fa-fw fa-code\" title=\"menu.documentation\" >
        <nav:item data-view=\"/docs/payment-methods\" title=\"menu.pay_methods\"></nav:item>
    </nav:group>

    ";
        // line 53
        echo "    <nav:item data-view=\"/projects/list\" title=\"menu.projects\" style=\"display:none\"></nav:item>


</navigation>
<span class=\"minifyme\" data-action=\"minifyMenu\"> <i class=\"fa fa-arrow-circle-left hit\"></i> </span>";
        
        $__internal_f9ca06e566eaf8aca569499fc0f4270bf8e7c0d0da2c3897de907f01e927f4ba->leave($__internal_f9ca06e566eaf8aca569499fc0f4270bf8e7c0d0da2c3897de907f01e927f4ba_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:ClientAdmin/Default/includes:left-panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 53,  52 => 23,  49 => 18,  37 => 8,  32 => 6,  28 => 5,  22 => 1,);
    }
}
/* <!-- User info -->*/
/* <div class="login-info" >*/
/*     <span> <!-- User image size is adjusted inside CSS, it should stay as is -->*/
/* */
/*         <a href="javascript:void(0);" id="show-shortcut" tooltip-placement="right" tooltip="{{ app.user.name }}">*/
/*             <img src="{{ asset('bundles/app/client_admin/img/avatars/male.png') }}" class="online" >*/
/*             <span id="nav_name_user">*/
/*                 {{ app.user.name }}*/
/*             </span>*/
/*         </a>*/
/* */
/*     </span>*/
/* </div>*/
/* */
/* <!-- end user info -->*/
/* */
/* {#<!-- NAVIGATION : This navigation is also responsive#}*/
/* */
/* {#To make this navigation dynamic please make sure to link the node#}*/
/* {#(the reference to the nav > ul) after page load. Or the navigation#}*/
/* {#will not initialize.#}*/
/* {#-->#}*/
/* <navigation>*/
/*     <nav:item data-view="/dashboard" data-icon="fa fa-lg fa-fw fa-home" title="menu.dashboard"></nav:item>*/
/* */
/*     <nav:group data-icon="fa fa-lg fa-fw fa-bar-chart-o" title="menu.analitycs" has-permission="ROLE_ADMIN_ANALITYCS">*/
/*         <nav:item data-view="/analytics/transactions-purchases" title="menu.analytics.transactions_purchases"></nav:item>*/
/*         <nav:item data-view="/analytics/user-levels" title="menu.analytics.users_levels"></nav:item>*/
/*         <nav:item data-view="/analytics/payment-methods" title="menu.analytics.payment_methods"></nav:item>*/
/*         <nav:item data-view="/analytics/continents-countries" title="menu.analytics.continents_countries"></nav:item>*/
/*         <nav:item data-view="/analytics/articles-shops" title="menu.analytics.articles_shops"></nav:item>*/
/*     </nav:group>*/
/* */
/*     <nav:item data-view="/transactions" data-icon="fa fa-lg fa-fw fa-list-alt" has-permission="ROLE_ADMIN_TRANSACTIONS" title="menu.transactions"></nav:item>*/
/*     <nav:item data-view="/purchases" data-icon="fa fa-lg fa-fw fa-bullseye" has-permission="ROLE_ADMIN_PURCHASES" title="menu.purchases"></nav:item>*/
/*     <nav:item data-view="/active-subscriptions" data-icon="fa fa-lg fa-fw fa-recycle" has-permission="ROLE_ADMIN_SUBSCRIPTIONS" title="menu.active_subscriptions"></nav:item>*/
/*     <nav:item data-view="/notifications" data-icon="fa fa-lg fa-fw fa-bell-o" has-permission="ROLE_ADMIN_NOTIFICATIONS" title="menu.notifications"></nav:item>*/
/*     <nav:item data-view="/configuration/shop/test" data-icon="fa fa-lg  fa-fw fa-car" title="menu.config.shop_test" has-permission="ROLE_ADMIN_SHOP_TEST"></nav:item>*/
/* */
/*     <nav:group data-icon="fa fa-lg fa-fw fa-gear" title="menu.configuration" has-permission="ROLE_ADMIN_CONFIGURE">*/
/*         <nav:item data-view="/configuration/configurator/wizard" title="menu.config.configurator"></nav:item>*/
/*         <nav:item data-view="/configuration/offers/list" title="menu.config.offers"></nav:item>*/
/* */
/*         <nav:item data-view="/configuration/promo-codes/list" title="menu.config.promo_codes"></nav:item>*/
/*         <nav:item data-view="/configuration/blacklist/index" title="menu.config.blacklist"></nav:item>*/
/*     </nav:group>*/
/*     <nav:item data-view="/credentials" data-icon="fa fa-lg fa-fw fa-key" has-permission="ROLE_ADMIN_CREDENTIALS" title="menu.credentials"></nav:item>*/
/*     <nav:group data-icon="fa fa-lg fa-fw fa-code" title="menu.documentation" >*/
/*         <nav:item data-view="/docs/payment-methods" title="menu.pay_methods"></nav:item>*/
/*     </nav:group>*/
/* */
/*     {# hidden to auto add in breadcrum #}*/
/*     <nav:item data-view="/projects/list" title="menu.projects" style="display:none"></nav:item>*/
/* */
/* */
/* </navigation>*/
/* <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>*/
