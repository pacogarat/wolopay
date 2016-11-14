<?php

/* SonataAdminBundle:CRUD:list_percent.html.twig */
class __TwigTemplate_7f535f1615f8071ea367bf50682016de7962ff108787b0605f2f251d052fd157 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_percent.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e05abbfe6b945b7e1d6d47dd4bb4113a5f3b771cadf38f5ffa4368c31a318618 = $this->env->getExtension("native_profiler");
        $__internal_e05abbfe6b945b7e1d6d47dd4bb4113a5f3b771cadf38f5ffa4368c31a318618->enter($__internal_e05abbfe6b945b7e1d6d47dd4bb4113a5f3b771cadf38f5ffa4368c31a318618_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_percent.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e05abbfe6b945b7e1d6d47dd4bb4113a5f3b771cadf38f5ffa4368c31a318618->leave($__internal_e05abbfe6b945b7e1d6d47dd4bb4113a5f3b771cadf38f5ffa4368c31a318618_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_d99806923826a6619757ab61e4f287863c2b01765d114e51e3dece6d80dfc7dd = $this->env->getExtension("native_profiler");
        $__internal_d99806923826a6619757ab61e4f287863c2b01765d114e51e3dece6d80dfc7dd->enter($__internal_d99806923826a6619757ab61e4f287863c2b01765d114e51e3dece6d80dfc7dd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context["value"] = ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")) * 100);
        // line 16
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo " %
";
        
        $__internal_d99806923826a6619757ab61e4f287863c2b01765d114e51e3dece6d80dfc7dd->leave($__internal_d99806923826a6619757ab61e4f287863c2b01765d114e51e3dece6d80dfc7dd_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_percent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {% set value = value * 100 %}*/
/*     {{ value }} %*/
/* {% endblock %}*/
/* */
