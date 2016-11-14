<?php

/* SonataIntlBundle:CRUD:list_date.html.twig */
class __TwigTemplate_8eba7532dab84e90a7da88060e215c660d99f1e0a6af8f82e70d56dc0fdb832c extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataIntlBundle:CRUD:list_date.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3c353ebfff6f55341f44a1c87a487f09c61e4aa38ee7b63f46a1b50ceff6d977 = $this->env->getExtension("native_profiler");
        $__internal_3c353ebfff6f55341f44a1c87a487f09c61e4aa38ee7b63f46a1b50ceff6d977->enter($__internal_3c353ebfff6f55341f44a1c87a487f09c61e4aa38ee7b63f46a1b50ceff6d977_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:list_date.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3c353ebfff6f55341f44a1c87a487f09c61e4aa38ee7b63f46a1b50ceff6d977->leave($__internal_3c353ebfff6f55341f44a1c87a487f09c61e4aa38ee7b63f46a1b50ceff6d977_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_78408cff6366f5ad559281ca35856a1b7201319dc92562d18981a842ca1e438e = $this->env->getExtension("native_profiler");
        $__internal_78408cff6366f5ad559281ca35856a1b7201319dc92562d18981a842ca1e438e->enter($__internal_78408cff6366f5ad559281ca35856a1b7201319dc92562d18981a842ca1e438e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            $context["pattern"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "pattern", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "pattern", array()), null)) : (null));
            // line 19
            echo "        ";
            $context["locale"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale", array()), null)) : (null));
            // line 20
            echo "        ";
            $context["timezone"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "timezone", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "timezone", array()), null)) : (null));
            // line 21
            echo "        ";
            $context["dateType"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "dateType", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "dateType", array()), null)) : (null));
            // line 22
            echo "
        ";
            // line 23
            echo $this->env->getExtension('sonata_intl_datetime')->formatDate((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["pattern"]) ? $context["pattern"] : $this->getContext($context, "pattern")), (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")), (isset($context["timezone"]) ? $context["timezone"] : $this->getContext($context, "timezone")), (isset($context["dateType"]) ? $context["dateType"] : $this->getContext($context, "dateType")));
        }
        
        $__internal_78408cff6366f5ad559281ca35856a1b7201319dc92562d18981a842ca1e438e->leave($__internal_78408cff6366f5ad559281ca35856a1b7201319dc92562d18981a842ca1e438e_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:list_date.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 23,  55 => 22,  52 => 21,  49 => 20,  46 => 19,  44 => 18,  41 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/* {% block field%}*/
/*     {%- if value is empty -%}*/
/*         &nbsp;*/
/*     {%- else -%}*/
/*         {% set pattern = field_description.options.pattern|default(null) %}*/
/*         {% set locale = field_description.options.locale|default(null) %}*/
/*         {% set timezone = field_description.options.timezone|default(null) %}*/
/*         {% set dateType = field_description.options.dateType|default(null) %}*/
/* */
/*         {{ value | format_date(pattern, locale, timezone, dateType) }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
