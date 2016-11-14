<?php

/* SonataIntlBundle:CRUD:show_datetime.html.twig */
class __TwigTemplate_5be79151ea0a08db6469a401fc3a65173fd78ba248340a3f3807cd3b77d786ee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataIntlBundle:CRUD:show_datetime.html.twig", 12);
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
        $__internal_fc2d862a2d2b3913f4e9ea5ba0e1d3b52575227cef7a503aa68db9b8a5e4985a = $this->env->getExtension("native_profiler");
        $__internal_fc2d862a2d2b3913f4e9ea5ba0e1d3b52575227cef7a503aa68db9b8a5e4985a->enter($__internal_fc2d862a2d2b3913f4e9ea5ba0e1d3b52575227cef7a503aa68db9b8a5e4985a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:show_datetime.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fc2d862a2d2b3913f4e9ea5ba0e1d3b52575227cef7a503aa68db9b8a5e4985a->leave($__internal_fc2d862a2d2b3913f4e9ea5ba0e1d3b52575227cef7a503aa68db9b8a5e4985a_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_566b3ea588a67ed3cd0cd3a91785170f96590947e7a60692482f8f8c2ce69e08 = $this->env->getExtension("native_profiler");
        $__internal_566b3ea588a67ed3cd0cd3a91785170f96590947e7a60692482f8f8c2ce69e08->enter($__internal_566b3ea588a67ed3cd0cd3a91785170f96590947e7a60692482f8f8c2ce69e08_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

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
            echo "        ";
            $context["timeType"] = (($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "timeType", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "timeType", array()), null)) : (null));
            // line 23
            echo "
        ";
            // line 24
            echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["pattern"]) ? $context["pattern"] : $this->getContext($context, "pattern")), (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")), (isset($context["timezone"]) ? $context["timezone"] : $this->getContext($context, "timezone")), (isset($context["dateType"]) ? $context["dateType"] : $this->getContext($context, "dateType")), (isset($context["timeType"]) ? $context["timeType"] : $this->getContext($context, "timeType")));
        }
        
        $__internal_566b3ea588a67ed3cd0cd3a91785170f96590947e7a60692482f8f8c2ce69e08->leave($__internal_566b3ea588a67ed3cd0cd3a91785170f96590947e7a60692482f8f8c2ce69e08_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:show_datetime.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 24,  59 => 23,  56 => 22,  53 => 21,  50 => 20,  47 => 19,  45 => 18,  42 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/*     {%- if value is empty -%}*/
/*         &nbsp;*/
/*     {%- else -%}*/
/*         {% set pattern = field_description.options.pattern|default(null) %}*/
/*         {% set locale = field_description.options.locale|default(null) %}*/
/*         {% set timezone = field_description.options.timezone|default(null) %}*/
/*         {% set dateType = field_description.options.dateType|default(null) %}*/
/*         {% set timeType = field_description.options.timeType|default(null) %}*/
/* */
/*         {{ value | format_datetime(pattern, locale, timezone, dateType, timeType) }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
