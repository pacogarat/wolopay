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
        $__internal_26fce3f47b9e1bc7b17d484c2ad82544a8c04cf41671356549e21ef0aa39a528 = $this->env->getExtension("native_profiler");
        $__internal_26fce3f47b9e1bc7b17d484c2ad82544a8c04cf41671356549e21ef0aa39a528->enter($__internal_26fce3f47b9e1bc7b17d484c2ad82544a8c04cf41671356549e21ef0aa39a528_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/NviaPayMethods:layout_nvia_methods.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_26fce3f47b9e1bc7b17d484c2ad82544a8c04cf41671356549e21ef0aa39a528->leave($__internal_26fce3f47b9e1bc7b17d484c2ad82544a8c04cf41671356549e21ef0aa39a528_prof);

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
