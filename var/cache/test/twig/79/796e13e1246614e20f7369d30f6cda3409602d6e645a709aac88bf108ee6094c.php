<?php

/* AppBundle:AppShop/Payment/cancel:default.html.twig */
class __TwigTemplate_ccf126e63ab26fbe4b151b755a4daa5c2eea12c2c096cbd5a25253dcd0437c5a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/AppShop/Payment/payment_layout.html.twig", "AppBundle:AppShop/Payment/cancel:default.html.twig", 1);
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
        $__internal_fa5433a33fd8d13b878e52754147e366953755af8e4ac2e8b817ff0d676897af = $this->env->getExtension("native_profiler");
        $__internal_fa5433a33fd8d13b878e52754147e366953755af8e4ac2e8b817ff0d676897af->enter($__internal_fa5433a33fd8d13b878e52754147e366953755af8e4ac2e8b817ff0d676897af_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Payment/cancel:default.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fa5433a33fd8d13b878e52754147e366953755af8e4ac2e8b817ff0d676897af->leave($__internal_fa5433a33fd8d13b878e52754147e366953755af8e4ac2e8b817ff0d676897af_prof);

    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        $__internal_75fdee1b209cf8c34f33b1f0b368d699b5c97964ad033270fb2c48030b96bb07 = $this->env->getExtension("native_profiler");
        $__internal_75fdee1b209cf8c34f33b1f0b368d699b5c97964ad033270fb2c48030b96bb07->enter($__internal_75fdee1b209cf8c34f33b1f0b368d699b5c97964ad033270fb2c48030b96bb07_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 3
        echo "    <h1>";
        echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(((array_key_exists("title", $context)) ? (_twig_default_filter((isset($context["title"]) ? $context["title"] : $this->getContext($context, "title")), "payment.cancel.standard.title")) : ("payment.cancel.standard.title"))), "html", null, true));
        echo "</h1>
    <div id=\"description\">
        ";
        // line 5
        echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(((array_key_exists("description", $context)) ? (_twig_default_filter((isset($context["description"]) ? $context["description"] : $this->getContext($context, "description")), "payment.cancel.standard.description")) : ("payment.cancel.standard.description"))), "html", null, true));
        echo "
    </div>
";
        
        $__internal_75fdee1b209cf8c34f33b1f0b368d699b5c97964ad033270fb2c48030b96bb07->leave($__internal_75fdee1b209cf8c34f33b1f0b368d699b5c97964ad033270fb2c48030b96bb07_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Payment/cancel:default.html.twig";
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
/*     <h1>{{ title | default('payment.cancel.standard.title') | trans | nl2br }}</h1>*/
/*     <div id="description">*/
/*         {{ description | default('payment.cancel.standard.description') | trans | nl2br }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
