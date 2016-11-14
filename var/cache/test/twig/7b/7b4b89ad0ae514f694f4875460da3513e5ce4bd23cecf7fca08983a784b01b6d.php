<?php

/* AppBundle:AppShop/Error:proxy_not_allowed.html.twig */
class __TwigTemplate_c7c4734f3da67acf5a130443f540bed6bf14c7fba8bcd2f5d181adb078be65c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "AppBundle:AppShop/Error:proxy_not_allowed.html.twig", 1);
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
        $__internal_b941db8710757d28365f10977539324bf6119024a7f5ffef5f3e8f2fa188ed9d = $this->env->getExtension("native_profiler");
        $__internal_b941db8710757d28365f10977539324bf6119024a7f5ffef5f3e8f2fa188ed9d->enter($__internal_b941db8710757d28365f10977539324bf6119024a7f5ffef5f3e8f2fa188ed9d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Error:proxy_not_allowed.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b941db8710757d28365f10977539324bf6119024a7f5ffef5f3e8f2fa188ed9d->leave($__internal_b941db8710757d28365f10977539324bf6119024a7f5ffef5f3e8f2fa188ed9d_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_dfbe319021d22a9bdc6fd6d5a9df4802ba86443faa9f057d91458d7eb5e6bdb4 = $this->env->getExtension("native_profiler");
        $__internal_dfbe319021d22a9bdc6fd6d5a9df4802ba86443faa9f057d91458d7eb5e6bdb4->enter($__internal_dfbe319021d22a9bdc6fd6d5a9df4802ba86443faa9f057d91458d7eb5e6bdb4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "<div style=\"text-align: center\">
    <h1 style=\"position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;\">";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(((array_key_exists("error_message", $context)) ? (_twig_default_filter((isset($context["error_message"]) ? $context["error_message"] : $this->getContext($context, "error_message")), "payment.begin.error")) : ("payment.begin.error"))), "html", null, true);
        echo "</h1>
    <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/errors/payment_begin_error.jpg")), "html", null, true);
        echo "\" style=\"margin-top: 40px; max-width: 100%\">
</div>
";
        
        $__internal_dfbe319021d22a9bdc6fd6d5a9df4802ba86443faa9f057d91458d7eb5e6bdb4->leave($__internal_dfbe319021d22a9bdc6fd6d5a9df4802ba86443faa9f057d91458d7eb5e6bdb4_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Error:proxy_not_allowed.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body %}*/
/* <div style="text-align: center">*/
/*     <h1 style="position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;">{{ error_message | default('payment.begin.error') | trans  }}</h1>*/
/*     <img src="{{ absolute_url(asset('bundles/app/app_shop/img/errors/payment_begin_error.jpg')) }}" style="margin-top: 40px; max-width: 100%">*/
/* </div>*/
/* {% endblock %}*/
