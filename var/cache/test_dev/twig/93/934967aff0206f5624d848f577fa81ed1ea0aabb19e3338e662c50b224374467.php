<?php

/* @App/AppShop/Payment/payment_layout.html.twig */
class __TwigTemplate_b7f8bdf686ef1bc3a27f5651e08a4b652ef4a64be68402f15278214085f77910 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("::base.html.twig", "@App/AppShop/Payment/payment_layout.html.twig", 2);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b135801187271c324296eef4373d31abb2c32eb1d30319521643b81a35bda6e1 = $this->env->getExtension("native_profiler");
        $__internal_b135801187271c324296eef4373d31abb2c32eb1d30319521643b81a35bda6e1->enter($__internal_b135801187271c324296eef4373d31abb2c32eb1d30319521643b81a35bda6e1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/AppShop/Payment/payment_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b135801187271c324296eef4373d31abb2c32eb1d30319521643b81a35bda6e1->leave($__internal_b135801187271c324296eef4373d31abb2c32eb1d30319521643b81a35bda6e1_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_06c0c9e824e9fc30864b0ec43fb15afa3c33103b0b4b09af9d832c904a91a239 = $this->env->getExtension("native_profiler");
        $__internal_06c0c9e824e9fc30864b0ec43fb15afa3c33103b0b4b09af9d832c904a91a239->enter($__internal_06c0c9e824e9fc30864b0ec43fb15afa3c33103b0b4b09af9d832c904a91a239_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 4
        echo "
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("css_glob/reset.css"), "html", null, true);
        echo "\">

    ";
        // line 7
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "02763b7_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_02763b7_0") : $this->env->getExtension('asset')->getAssetUrl("css/02763b7_reset_1.css");
            // line 10
            echo "    <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
            // asset "02763b7_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_02763b7_1") : $this->env->getExtension('asset')->getAssetUrl("css/02763b7_done_2.css");
            echo "    <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "02763b7"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_02763b7") : $this->env->getExtension('asset')->getAssetUrl("css/02763b7.css");
            echo "    <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 12
        echo "
    <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

";
        
        $__internal_06c0c9e824e9fc30864b0ec43fb15afa3c33103b0b4b09af9d832c904a91a239->leave($__internal_06c0c9e824e9fc30864b0ec43fb15afa3c33103b0b4b09af9d832c904a91a239_prof);

    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        $__internal_cc47220aba227a3c646907e950d230579932c49cbf893cab90415b5732807589 = $this->env->getExtension("native_profiler");
        $__internal_cc47220aba227a3c646907e950d230579932c49cbf893cab90415b5732807589->enter($__internal_cc47220aba227a3c646907e950d230579932c49cbf893cab90415b5732807589_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 17
        echo "    <div id=\"container\">
        <img id=\"img-state\" src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl((("bundles/app/app_shop/img/payment/state_" . (isset($context["state"]) ? $context["state"] : $this->getContext($context, "state"))) . ".png"))), "html", null, true);
        echo "\" >

        <div id=\"main\">
            <div id=\"content\">

                ";
        // line 23
        $this->displayBlock('content', $context, $blocks);
        // line 24
        echo "
            </div>
            <div id=\"contributors\">
                <img src=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/logo_113x25.png")), "html", null, true);
        echo "\">

                ";
        // line 29
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "app", array(), "any", true, true) && $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "logo", array()))) {
            // line 30
            echo "                    <img src=\"";
            echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
            echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "logo", array()), "done");
            echo "\">
                ";
        }
        // line 32
        echo "            </div>
        </div>
    </div>
";
        
        $__internal_cc47220aba227a3c646907e950d230579932c49cbf893cab90415b5732807589->leave($__internal_cc47220aba227a3c646907e950d230579932c49cbf893cab90415b5732807589_prof);

    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
        $__internal_7d99984269dc87bc9f9e4d7fe93d4ab1fdf0c4ab0834cfc452e3c0d4a85ee4a4 = $this->env->getExtension("native_profiler");
        $__internal_7d99984269dc87bc9f9e4d7fe93d4ab1fdf0c4ab0834cfc452e3c0d4a85ee4a4->enter($__internal_7d99984269dc87bc9f9e4d7fe93d4ab1fdf0c4ab0834cfc452e3c0d4a85ee4a4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        echo "";
        
        $__internal_7d99984269dc87bc9f9e4d7fe93d4ab1fdf0c4ab0834cfc452e3c0d4a85ee4a4->leave($__internal_7d99984269dc87bc9f9e4d7fe93d4ab1fdf0c4ab0834cfc452e3c0d4a85ee4a4_prof);

    }

    public function getTemplateName()
    {
        return "@App/AppShop/Payment/payment_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  132 => 23,  122 => 32,  115 => 30,  113 => 29,  108 => 27,  103 => 24,  101 => 23,  93 => 18,  90 => 17,  84 => 16,  74 => 12,  54 => 10,  50 => 7,  45 => 5,  42 => 4,  36 => 3,  11 => 2,);
    }
}
/* {% trans_default_domain "final_view" %}*/
/* {% extends '::base.html.twig' %}*/
/* {% block stylesheets %}*/
/* */
/*     <link rel="shortcut icon" type="image/x-icon" href="{{ asset('css_glob/reset.css') }}">*/
/* */
/*     {% stylesheets 'css_glob/reset.css'*/
/*     "bundles/app/app_shop/css/payment/done.less"*/
/*     %}*/
/*     <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/* */
/*     <link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>*/
/* */
/* {% endblock %}*/
/* {% block body %}*/
/*     <div id="container">*/
/*         <img id="img-state" src="{{ absolute_url(asset('bundles/app/app_shop/img/payment/state_'  ~ state ~ '.png')) }}" >*/
/* */
/*         <div id="main">*/
/*             <div id="content">*/
/* */
/*                 {% block content '' %}*/
/* */
/*             </div>*/
/*             <div id="contributors">*/
/*                 <img src="{{ absolute_url(asset('img/logo_113x25.png')) }}">*/
/* */
/*                 {% if (app.user.app  is defined ) and (app.user.app.logo) %}*/
/*                     <img src="{{domain_main}}{% path app.user.app.logo, 'done' %}">*/
/*                 {% endif %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
