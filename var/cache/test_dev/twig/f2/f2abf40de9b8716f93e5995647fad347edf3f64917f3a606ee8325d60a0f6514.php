<?php

/* SonataAdminBundle:CRUD:show_currency.html.twig */
class __TwigTemplate_e301fa5c01ffd67e8b587abb82b32da5ab08683b938342c9fd7b7c8d434ced49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataAdminBundle:CRUD:show_currency.html.twig", 12);
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
        $__internal_78c045fb7ebb568d0bd1d9eb19e39421faeca6bd27f0295289b07be298017b7a = $this->env->getExtension("native_profiler");
        $__internal_78c045fb7ebb568d0bd1d9eb19e39421faeca6bd27f0295289b07be298017b7a->enter($__internal_78c045fb7ebb568d0bd1d9eb19e39421faeca6bd27f0295289b07be298017b7a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_currency.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_78c045fb7ebb568d0bd1d9eb19e39421faeca6bd27f0295289b07be298017b7a->leave($__internal_78c045fb7ebb568d0bd1d9eb19e39421faeca6bd27f0295289b07be298017b7a_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_039395a53812bddbdcaa86ff00ce7b44710637c2f7ac3d0ab7b1ca6cb03b19aa = $this->env->getExtension("native_profiler");
        $__internal_039395a53812bddbdcaa86ff00ce7b44710637c2f7ac3d0ab7b1ca6cb03b19aa->enter($__internal_039395a53812bddbdcaa86ff00ce7b44710637c2f7ac3d0ab7b1ca6cb03b19aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        if ( !(null === (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "currency", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "
    ";
        }
        
        $__internal_039395a53812bddbdcaa86ff00ce7b44710637c2f7ac3d0ab7b1ca6cb03b19aa->leave($__internal_039395a53812bddbdcaa86ff00ce7b44710637c2f7ac3d0ab7b1ca6cb03b19aa_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_currency.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/*     {% if value is not null %}*/
/*         {{ field_description.options.currency }} {{ value }}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
