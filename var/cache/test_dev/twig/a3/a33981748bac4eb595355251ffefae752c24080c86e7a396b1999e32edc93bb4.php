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
        $__internal_a95422f57e7d781c4335cbf6cebcc6a7c380bc35a77512f866e7bd1e5024dccf = $this->env->getExtension("native_profiler");
        $__internal_a95422f57e7d781c4335cbf6cebcc6a7c380bc35a77512f866e7bd1e5024dccf->enter($__internal_a95422f57e7d781c4335cbf6cebcc6a7c380bc35a77512f866e7bd1e5024dccf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_time.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a95422f57e7d781c4335cbf6cebcc6a7c380bc35a77512f866e7bd1e5024dccf->leave($__internal_a95422f57e7d781c4335cbf6cebcc6a7c380bc35a77512f866e7bd1e5024dccf_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_f5816fbdc07c931b90153cb3dc4418abc110e29050ae3a1853f7cfcf36f2dc00 = $this->env->getExtension("native_profiler");
        $__internal_f5816fbdc07c931b90153cb3dc4418abc110e29050ae3a1853f7cfcf36f2dc00->enter($__internal_f5816fbdc07c931b90153cb3dc4418abc110e29050ae3a1853f7cfcf36f2dc00_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } else {
            // line 18
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "H:i:s"), "html", null, true);
        }
        
        $__internal_f5816fbdc07c931b90153cb3dc4418abc110e29050ae3a1853f7cfcf36f2dc00->leave($__internal_f5816fbdc07c931b90153cb3dc4418abc110e29050ae3a1853f7cfcf36f2dc00_prof);

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
