<?php

/* AppBundle:PaymentHosted/NviaPayMethods:layout_nvia_methods.html.twig */
class __TwigTemplate_a5b33575a5a8c6ae7cfae65dbb60aa56f35386e2ee1358ca7045caea6d725213 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/PaymentHosted/layout_pay_method_hosted.html.twig", "AppBundle:PaymentHosted/NviaPayMethods:layout_nvia_methods.html.twig", 1);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/PaymentHosted/layout_pay_method_hosted.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_28e6cddf9a28fde52cb25c0592bba8779c8ecf20711f62f0b06fdc0b760e51ee = $this->env->getExtension("native_profiler");
        $__internal_28e6cddf9a28fde52cb25c0592bba8779c8ecf20711f62f0b06fdc0b760e51ee->enter($__internal_28e6cddf9a28fde52cb25c0592bba8779c8ecf20711f62f0b06fdc0b760e51ee_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/NviaPayMethods:layout_nvia_methods.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_28e6cddf9a28fde52cb25c0592bba8779c8ecf20711f62f0b06fdc0b760e51ee->leave($__internal_28e6cddf9a28fde52cb25c0592bba8779c8ecf20711f62f0b06fdc0b760e51ee_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PaymentHosted/NviaPayMethods:layout_nvia_methods.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  11 => 1,);
    }
}
/* {% extends '@App/PaymentHosted/layout_pay_method_hosted.html.twig' %}*/
