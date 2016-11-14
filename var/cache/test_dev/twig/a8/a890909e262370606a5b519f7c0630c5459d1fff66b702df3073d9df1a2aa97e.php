<?php

/* SonataIntlBundle:CRUD:show_decimal.html.twig */
class __TwigTemplate_551bca9d9a46f8a5e2abcba38974064b50b03b15b5152a84e1da79678d8e63c6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataIntlBundle:CRUD:show_decimal.html.twig", 12);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c5b608b5e8e949d89375af54a242390cb62388c6b674f296464f6df01832c1a7 = $this->env->getExtension("native_profiler");
        $__internal_c5b608b5e8e949d89375af54a242390cb62388c6b674f296464f6df01832c1a7->enter($__internal_c5b608b5e8e949d89375af54a242390cb62388c6b674f296464f6df01832c1a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:show_decimal.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c5b608b5e8e949d89375af54a242390cb62388c6b674f296464f6df01832c1a7->leave($__internal_c5b608b5e8e949d89375af54a242390cb62388c6b674f296464f6df01832c1a7_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_12a14aaf36cf7e6c473189057513055a69da6efff68b957716e2447e1ed014ef = $this->env->getExtension("native_profiler");
        $__internal_12a14aaf36cf7e6c473189057513055a69da6efff68b957716e2447e1ed014ef->enter($__internal_12a14aaf36cf7e6c473189057513055a69da6efff68b957716e2447e1ed014ef_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if ((null === (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            $context["attributes"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "attributes", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "attributes", array()), array())) : (array()));
            // line 19
            echo "        ";
            $context["textAttributes"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "textAttributes", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "textAttributes", array()), array())) : (array()));
            // line 20
            echo "        ";
            $context["locale"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "locale", array()), null)) : (null));
            // line 21
            echo "
        ";
            // line 22
            echo $this->env->getExtension('sonata_intl_number')->formatDecimal((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["attributes"]) ? $context["attributes"] : $this->getContext($context, "attributes")), (isset($context["textAttributes"]) ? $context["textAttributes"] : $this->getContext($context, "textAttributes")), (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")));
        }
        
        $__internal_12a14aaf36cf7e6c473189057513055a69da6efff68b957716e2447e1ed014ef->leave($__internal_12a14aaf36cf7e6c473189057513055a69da6efff68b957716e2447e1ed014ef_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:show_decimal.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 22,  53 => 21,  50 => 20,  47 => 19,  45 => 18,  42 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:base_show_field.html.twig' %}*/
/* */
/* {% block field %}*/
/*     {%- if value is null -%}*/
/*         &nbsp;*/
/*     {%- else -%}*/
/*         {% set attributes = field_description.options.attributes|default({}) %}*/
/*         {% set textAttributes = field_description.options.textAttributes|default({}) %}*/
/*         {% set locale = field_description.options.locale|default(null) %}*/
/* */
/*         {{ value | number_format_decimal(attributes, textAttributes, locale) }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
