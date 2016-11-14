<?php

/* SonataAdminBundle:CRUD:show_time.html.twig */
class __TwigTemplate_3349a577533cd8f804a3326e05dfa900c4a657b17abd95b04c3bd9409c5d340d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataAdminBundle:CRUD:show_time.html.twig", 12);
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
        $__internal_47a5e09a097a2628a6a5a587167e06c5ba3d9ae2e9ced8a45d045867e85804e4 = $this->env->getExtension("native_profiler");
        $__internal_47a5e09a097a2628a6a5a587167e06c5ba3d9ae2e9ced8a45d045867e85804e4->enter($__internal_47a5e09a097a2628a6a5a587167e06c5ba3d9ae2e9ced8a45d045867e85804e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_time.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_47a5e09a097a2628a6a5a587167e06c5ba3d9ae2e9ced8a45d045867e85804e4->leave($__internal_47a5e09a097a2628a6a5a587167e06c5ba3d9ae2e9ced8a45d045867e85804e4_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_49060396b31496f190845316ce78838b8ab1a64ad0e1ac733ba3cfd160d68ff0 = $this->env->getExtension("native_profiler");
        $__internal_49060396b31496f190845316ce78838b8ab1a64ad0e1ac733ba3cfd160d68ff0->enter($__internal_49060396b31496f190845316ce78838b8ab1a64ad0e1ac733ba3cfd160d68ff0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "H:i:s"), "html", null, true);
        }
        
        $__internal_49060396b31496f190845316ce78838b8ab1a64ad0e1ac733ba3cfd160d68ff0->leave($__internal_49060396b31496f190845316ce78838b8ab1a64ad0e1ac733ba3cfd160d68ff0_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_time.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 18,  42 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/*         {{ value|date('H:i:s') }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
