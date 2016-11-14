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
        $__internal_02002fe51b0edbd62dc2ee6075234edc6bf17fa26599ffd071dadfc3687c86f9 = $this->env->getExtension("native_profiler");
        $__internal_02002fe51b0edbd62dc2ee6075234edc6bf17fa26599ffd071dadfc3687c86f9->enter($__internal_02002fe51b0edbd62dc2ee6075234edc6bf17fa26599ffd071dadfc3687c86f9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_currency.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_02002fe51b0edbd62dc2ee6075234edc6bf17fa26599ffd071dadfc3687c86f9->leave($__internal_02002fe51b0edbd62dc2ee6075234edc6bf17fa26599ffd071dadfc3687c86f9_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_6cedb5b14929fe3337f6b965612ac9bfd81f92162203571113c85c886f0570e5 = $this->env->getExtension("native_profiler");
        $__internal_6cedb5b14929fe3337f6b965612ac9bfd81f92162203571113c85c886f0570e5->enter($__internal_6cedb5b14929fe3337f6b965612ac9bfd81f92162203571113c85c886f0570e5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

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
        
        $__internal_6cedb5b14929fe3337f6b965612ac9bfd81f92162203571113c85c886f0570e5->leave($__internal_6cedb5b14929fe3337f6b965612ac9bfd81f92162203571113c85c886f0570e5_prof);

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
