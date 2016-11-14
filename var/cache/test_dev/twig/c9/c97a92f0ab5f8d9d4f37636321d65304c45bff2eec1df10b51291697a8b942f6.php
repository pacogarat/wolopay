<?php

/* SonataAdminBundle:CRUD:list_time.html.twig */
class __TwigTemplate_aa0f0b74f6cd7fea0a770ace5e9c6397af15a879cd089f7d1f42af87b90ef3c4 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_time.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3c1e9c3f4ee077c45e5c1b9272f34b79fc50db3fff8dcc86280e8de663ab3d8d = $this->env->getExtension("native_profiler");
        $__internal_3c1e9c3f4ee077c45e5c1b9272f34b79fc50db3fff8dcc86280e8de663ab3d8d->enter($__internal_3c1e9c3f4ee077c45e5c1b9272f34b79fc50db3fff8dcc86280e8de663ab3d8d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_time.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3c1e9c3f4ee077c45e5c1b9272f34b79fc50db3fff8dcc86280e8de663ab3d8d->leave($__internal_3c1e9c3f4ee077c45e5c1b9272f34b79fc50db3fff8dcc86280e8de663ab3d8d_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_fc0fce6121dafe4d0636349040e10c3fdfec3d6a5642eb2cdcd80915276de290 = $this->env->getExtension("native_profiler");
        $__internal_fc0fce6121dafe4d0636349040e10c3fdfec3d6a5642eb2cdcd80915276de290->enter($__internal_fc0fce6121dafe4d0636349040e10c3fdfec3d6a5642eb2cdcd80915276de290_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "H:i:s"), "html", null, true);
        }
        
        $__internal_fc0fce6121dafe4d0636349040e10c3fdfec3d6a5642eb2cdcd80915276de290->leave($__internal_fc0fce6121dafe4d0636349040e10c3fdfec3d6a5642eb2cdcd80915276de290_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_time.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 18,  41 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {%- if value is empty -%}*/
/*         &nbsp;*/
/*     {%- else -%}*/
/*         {{ value|date('H:i:s') }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
