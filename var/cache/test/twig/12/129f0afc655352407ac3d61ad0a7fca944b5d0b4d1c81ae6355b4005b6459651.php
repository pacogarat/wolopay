<?php

/* SonataAdminBundle:CRUD:list_percent.html.twig */
class __TwigTemplate_7f535f1615f8071ea367bf50682016de7962ff108787b0605f2f251d052fd157 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_percent.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b12011e5ad40450f628b5a2cd8b32a9f379b9c910a3cf26a2600006a8ded86bd = $this->env->getExtension("native_profiler");
        $__internal_b12011e5ad40450f628b5a2cd8b32a9f379b9c910a3cf26a2600006a8ded86bd->enter($__internal_b12011e5ad40450f628b5a2cd8b32a9f379b9c910a3cf26a2600006a8ded86bd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_percent.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b12011e5ad40450f628b5a2cd8b32a9f379b9c910a3cf26a2600006a8ded86bd->leave($__internal_b12011e5ad40450f628b5a2cd8b32a9f379b9c910a3cf26a2600006a8ded86bd_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_9641092cb23aaf4c940e9f96b9f1d0a236f5f82742d58add06d15524046b4310 = $this->env->getExtension("native_profiler");
        $__internal_9641092cb23aaf4c940e9f96b9f1d0a236f5f82742d58add06d15524046b4310->enter($__internal_9641092cb23aaf4c940e9f96b9f1d0a236f5f82742d58add06d15524046b4310_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context["value"] = ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")) * 100);
        // line 16
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo " %
";
        
        $__internal_9641092cb23aaf4c940e9f96b9f1d0a236f5f82742d58add06d15524046b4310->leave($__internal_9641092cb23aaf4c940e9f96b9f1d0a236f5f82742d58add06d15524046b4310_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_percent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends admin.getTemplate('base_list_field') %}*/
/* */
/* {% block field %}*/
/*     {% set value = value * 100 %}*/
/*     {{ value }} %*/
/* {% endblock %}*/
/* */
