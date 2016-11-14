<?php

/* AppBundle:AppShop/Error:begin_payment_error.html.twig */
class __TwigTemplate_602172637fd1d06cd9aa19474223a7eca904f55df46e013e6b1e86be8f766ab7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "AppBundle:AppShop/Error:begin_payment_error.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a874f6b900734c4845715c94a4a2ecea5915651db069b3896fec634c691b8562 = $this->env->getExtension("native_profiler");
        $__internal_a874f6b900734c4845715c94a4a2ecea5915651db069b3896fec634c691b8562->enter($__internal_a874f6b900734c4845715c94a4a2ecea5915651db069b3896fec634c691b8562_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Error:begin_payment_error.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a874f6b900734c4845715c94a4a2ecea5915651db069b3896fec634c691b8562->leave($__internal_a874f6b900734c4845715c94a4a2ecea5915651db069b3896fec634c691b8562_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_76c6677182ec003caad3cf96c4b2927bb05f206d7fd298c2d26e59c4b44dadc8 = $this->env->getExtension("native_profiler");
        $__internal_76c6677182ec003caad3cf96c4b2927bb05f206d7fd298c2d26e59c4b44dadc8->enter($__internal_76c6677182ec003caad3cf96c4b2927bb05f206d7fd298c2d26e59c4b44dadc8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <style>
        body{
            background: #fff;
        }
    </style>
<div style=\"text-align: center\">
    <h1 style=\"position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;\">";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.begin.error"), "html", null, true);
        echo "</h1>
    <img src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/errors/payment_begin_error.jpg")), "html", null, true);
        echo "\" style=\"margin-top: 40px; max-width: 100%\">
</div>
";
        
        $__internal_76c6677182ec003caad3cf96c4b2927bb05f206d7fd298c2d26e59c4b44dadc8->leave($__internal_76c6677182ec003caad3cf96c4b2927bb05f206d7fd298c2d26e59c4b44dadc8_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Error:begin_payment_error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 11,  48 => 10,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body %}*/
/*     <style>*/
/*         body{*/
/*             background: #fff;*/
/*         }*/
/*     </style>*/
/* <div style="text-align: center">*/
/*     <h1 style="position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;">{{ 'payment.begin.error' | trans  }}</h1>*/
/*     <img src="{{ absolute_url(asset('bundles/app/app_shop/img/errors/payment_begin_error.jpg')) }}" style="margin-top: 40px; max-width: 100%">*/
/* </div>*/
/* {% endblock %}*/
