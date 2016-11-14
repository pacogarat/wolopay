<?php

/* SonataIntlBundle:CRUD:show_date.html.twig */
class __TwigTemplate_09eb23b4356ea21ee1c3c09c929e10124672f584b12ab6345ad0b16ab5418f58 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataIntlBundle:CRUD:show_date.html.twig", 12);
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
        $__internal_74cf9e3c8b0097de91ccbf17c779f0681f304dc0c84bf322303fb78c7f8ac455 = $this->env->getExtension("native_profiler");
        $__internal_74cf9e3c8b0097de91ccbf17c779f0681f304dc0c84bf322303fb78c7f8ac455->enter($__internal_74cf9e3c8b0097de91ccbf17c779f0681f304dc0c84bf322303fb78c7f8ac455_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:show_date.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_74cf9e3c8b0097de91ccbf17c779f0681f304dc0c84bf322303fb78c7f8ac455->leave($__internal_74cf9e3c8b0097de91ccbf17c779f0681f304dc0c84bf322303fb78c7f8ac455_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_9786a84461bc63d5624616806f6177b1d2e8e832f904b827c158847bc660cef5 = $this->env->getExtension("native_profiler");
        $__internal_9786a84461bc63d5624616806f6177b1d2e8e832f904b827c158847bc660cef5->enter($__internal_9786a84461bc63d5624616806f6177b1d2e8e832f904b827c158847bc660cef5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

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
        
        $__internal_9786a84461bc63d5624616806f6177b1d2e8e832f904b827c158847bc660cef5->leave($__internal_9786a84461bc63d5624616806f6177b1d2e8e832f904b827c158847bc660cef5_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:show_date.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 23,  56 => 22,  53 => 21,  50 => 20,  47 => 19,  45 => 18,  42 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
