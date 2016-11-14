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
        $__internal_00e9b5e2e9bc0b7aea55a68301d0b6b256514b37f088f90d4dac7110430d4fe7 = $this->env->getExtension("native_profiler");
        $__internal_00e9b5e2e9bc0b7aea55a68301d0b6b256514b37f088f90d4dac7110430d4fe7->enter($__internal_00e9b5e2e9bc0b7aea55a68301d0b6b256514b37f088f90d4dac7110430d4fe7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/AppShop/Payment/payment_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_00e9b5e2e9bc0b7aea55a68301d0b6b256514b37f088f90d4dac7110430d4fe7->leave($__internal_00e9b5e2e9bc0b7aea55a68301d0b6b256514b37f088f90d4dac7110430d4fe7_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_b9c24fbfce9573fd7adef280bda09cc8bfa9a090f7f61a7322236a5e756eecab = $this->env->getExtension("native_profiler");
        $__internal_b9c24fbfce9573fd7adef280bda09cc8bfa9a090f7f61a7322236a5e756eecab->enter($__internal_b9c24fbfce9573fd7adef280bda09cc8bfa9a090f7f61a7322236a5e756eecab_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_b9c24fbfce9573fd7adef280bda09cc8bfa9a090f7f61a7322236a5e756eecab->leave($__internal_b9c24fbfce9573fd7adef280bda09cc8bfa9a090f7f61a7322236a5e756eecab_prof);

    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        $__internal_f85e84b48e2462064a19cda6a256a62eb39a399ab69bc12643296fdc99c0b719 = $this->env->getExtension("native_profiler");
        $__internal_f85e84b48e2462064a19cda6a256a62eb39a399ab69bc12643296fdc99c0b719->enter($__internal_f85e84b48e2462064a19cda6a256a62eb39a399ab69bc12643296fdc99c0b719_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_f85e84b48e2462064a19cda6a256a62eb39a399ab69bc12643296fdc99c0b719->leave($__internal_f85e84b48e2462064a19cda6a256a62eb39a399ab69bc12643296fdc99c0b719_prof);

    }

    // line 23
    public function block_content($context, array $blocks = array())
    {
        $__internal_53078fbb381b2db7920f23ce9c357498180d57ed9a655d8d968448e5bdb1bca9 = $this->env->getExtension("native_profiler");
        $__internal_53078fbb381b2db7920f23ce9c357498180d57ed9a655d8d968448e5bdb1bca9->enter($__internal_53078fbb381b2db7920f23ce9c357498180d57ed9a655d8d968448e5bdb1bca9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        echo "";
        
        $__internal_53078fbb381b2db7920f23ce9c357498180d57ed9a655d8d968448e5bdb1bca9->leave($__internal_53078fbb381b2db7920f23ce9c357498180d57ed9a655d8d968448e5bdb1bca9_prof);

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
