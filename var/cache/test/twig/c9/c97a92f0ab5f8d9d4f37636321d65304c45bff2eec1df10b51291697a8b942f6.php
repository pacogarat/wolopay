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
        $__internal_1510107d63385f1a83571086473fb9bed8e10aed8fb333e32bb06bbafed2b614 = $this->env->getExtension("native_profiler");
        $__internal_1510107d63385f1a83571086473fb9bed8e10aed8fb333e32bb06bbafed2b614->enter($__internal_1510107d63385f1a83571086473fb9bed8e10aed8fb333e32bb06bbafed2b614_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_time.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1510107d63385f1a83571086473fb9bed8e10aed8fb333e32bb06bbafed2b614->leave($__internal_1510107d63385f1a83571086473fb9bed8e10aed8fb333e32bb06bbafed2b614_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_16b99a6eace8a59c833a6053ff2d7be61ccf02c5030f1d7ba2c57f39668eac8a = $this->env->getExtension("native_profiler");
        $__internal_16b99a6eace8a59c833a6053ff2d7be61ccf02c5030f1d7ba2c57f39668eac8a->enter($__internal_16b99a6eace8a59c833a6053ff2d7be61ccf02c5030f1d7ba2c57f39668eac8a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "H:i:s"), "html", null, true);
        }
        
        $__internal_16b99a6eace8a59c833a6053ff2d7be61ccf02c5030f1d7ba2c57f39668eac8a->leave($__internal_16b99a6eace8a59c833a6053ff2d7be61ccf02c5030f1d7ba2c57f39668eac8a_prof);

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
