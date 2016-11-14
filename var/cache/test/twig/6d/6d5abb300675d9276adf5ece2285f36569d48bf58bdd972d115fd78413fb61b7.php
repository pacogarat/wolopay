<?php

/* AppBundle:AppShop/Payment/done:default.html.twig */
class __TwigTemplate_7b0560338bc0e5822885ddbd6895420593ce09c5aae102ccb538c52ae388138a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/AppShop/Payment/payment_layout.html.twig", "AppBundle:AppShop/Payment/done:default.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/AppShop/Payment/payment_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7661debe5c26b42e8ac9bbb88560a6d8778842d29d9eafeffa00bb168dbdef9a = $this->env->getExtension("native_profiler");
        $__internal_7661debe5c26b42e8ac9bbb88560a6d8778842d29d9eafeffa00bb168dbdef9a->enter($__internal_7661debe5c26b42e8ac9bbb88560a6d8778842d29d9eafeffa00bb168dbdef9a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Payment/done:default.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7661debe5c26b42e8ac9bbb88560a6d8778842d29d9eafeffa00bb168dbdef9a->leave($__internal_7661debe5c26b42e8ac9bbb88560a6d8778842d29d9eafeffa00bb168dbdef9a_prof);

    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        $__internal_53dbf536eab8e3e292f8810a3c2579413e381c52981fcf73911e14c79681a4ee = $this->env->getExtension("native_profiler");
        $__internal_53dbf536eab8e3e292f8810a3c2579413e381c52981fcf73911e14c79681a4ee->enter($__internal_53dbf536eab8e3e292f8810a3c2579413e381c52981fcf73911e14c79681a4ee_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 3
        echo "    <h1>";
        echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.done.standard.title"), "html", null, true));
        echo "</h1>
    <div id=\"description\">
        ";
        // line 5
        echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.done.standard.description"), "html", null, true));
        echo "
    </div>
";
        
        $__internal_53dbf536eab8e3e292f8810a3c2579413e381c52981fcf73911e14c79681a4ee->leave($__internal_53dbf536eab8e3e292f8810a3c2579413e381c52981fcf73911e14c79681a4ee_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Payment/done:default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 5,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends '@App/AppShop/Payment/payment_layout.html.twig' %}*/
/* {% block content %}*/
/*     <h1>{{ 'payment.done.standard.title' | trans | nl2br }}</h1>*/
/*     <div id="description">*/
/*         {{ 'payment.done.standard.description' | trans |nl2br }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
