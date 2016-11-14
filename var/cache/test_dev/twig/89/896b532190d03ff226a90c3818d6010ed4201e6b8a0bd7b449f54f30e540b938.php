<?php

/* SonataIntlBundle:CRUD:list_percent.html.twig */
class __TwigTemplate_f4b7391db02297a7cf338891b215a08f90fed4293a6d1d68c5b43e0ae08d155f extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataIntlBundle:CRUD:list_percent.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_61c0abc70a24be1b3ae8a14d60df5b92a4daf9ffdf6b9d61795a3f6d198412e0 = $this->env->getExtension("native_profiler");
        $__internal_61c0abc70a24be1b3ae8a14d60df5b92a4daf9ffdf6b9d61795a3f6d198412e0->enter($__internal_61c0abc70a24be1b3ae8a14d60df5b92a4daf9ffdf6b9d61795a3f6d198412e0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:list_percent.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_61c0abc70a24be1b3ae8a14d60df5b92a4daf9ffdf6b9d61795a3f6d198412e0->leave($__internal_61c0abc70a24be1b3ae8a14d60df5b92a4daf9ffdf6b9d61795a3f6d198412e0_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_3aa6362fda013a186cef25e18183d11c76b377b9be766b1456e6be0532ee9ee4 = $this->env->getExtension("native_profiler");
        $__internal_3aa6362fda013a186cef25e18183d11c76b377b9be766b1456e6be0532ee9ee4->enter($__internal_3aa6362fda013a186cef25e18183d11c76b377b9be766b1456e6be0532ee9ee4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

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
            echo $this->env->getExtension('sonata_intl_number')->formatPercent((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["attributes"]) ? $context["attributes"] : $this->getContext($context, "attributes")), (isset($context["textAttributes"]) ? $context["textAttributes"] : $this->getContext($context, "textAttributes")), (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")));
        }
        
        $__internal_3aa6362fda013a186cef25e18183d11c76b377b9be766b1456e6be0532ee9ee4->leave($__internal_3aa6362fda013a186cef25e18183d11c76b377b9be766b1456e6be0532ee9ee4_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:list_percent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 22,  52 => 21,  49 => 20,  46 => 19,  44 => 18,  41 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {%- if value is null -%}*/
/*         &nbsp;*/
/*     {%- else -%}*/
/*         {% set attributes = field_description.options.attributes|default({}) %}*/
/*         {% set textAttributes = field_description.options.textAttributes|default({}) %}*/
/*         {% set locale = field_description.options.locale|default(null) %}*/
/* */
/*         {{ value | number_format_percent(attributes, textAttributes, locale) }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
