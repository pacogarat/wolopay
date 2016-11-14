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
        $__internal_ada3b11128fe43e10c2218f1e458a108ceb157e1612f2afca46c7edcd27c4449 = $this->env->getExtension("native_profiler");
        $__internal_ada3b11128fe43e10c2218f1e458a108ceb157e1612f2afca46c7edcd27c4449->enter($__internal_ada3b11128fe43e10c2218f1e458a108ceb157e1612f2afca46c7edcd27c4449_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Payment/done:default.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ada3b11128fe43e10c2218f1e458a108ceb157e1612f2afca46c7edcd27c4449->leave($__internal_ada3b11128fe43e10c2218f1e458a108ceb157e1612f2afca46c7edcd27c4449_prof);

    }

    // line 2
    public function block_content($context, array $blocks = array())
    {
        $__internal_60451d0d464a4727e77b2aee9551b8d708e52cddc2361c1ca3d17e95a886c7c0 = $this->env->getExtension("native_profiler");
        $__internal_60451d0d464a4727e77b2aee9551b8d708e52cddc2361c1ca3d17e95a886c7c0->enter($__internal_60451d0d464a4727e77b2aee9551b8d708e52cddc2361c1ca3d17e95a886c7c0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

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
        
        $__internal_60451d0d464a4727e77b2aee9551b8d708e52cddc2361c1ca3d17e95a886c7c0->leave($__internal_60451d0d464a4727e77b2aee9551b8d708e52cddc2361c1ca3d17e95a886c7c0_prof);

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
