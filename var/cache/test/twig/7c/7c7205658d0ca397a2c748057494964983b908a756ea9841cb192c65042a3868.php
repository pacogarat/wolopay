<?php

/* SonataMediaBundle:MediaAdmin:list_image.html.twig */
class __TwigTemplate_8513b7e58289105b3c9def0fae634f7ce81eb9ef528b0fd9597d2556f8d57419 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "SonataMediaBundle:MediaAdmin:list_image.html.twig", 12);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a2297d4c11c1992e77a9f6ea113635944b15af8be9d8c4f2e3578cf01c469284 = $this->env->getExtension("native_profiler");
        $__internal_a2297d4c11c1992e77a9f6ea113635944b15af8be9d8c4f2e3578cf01c469284->enter($__internal_a2297d4c11c1992e77a9f6ea113635944b15af8be9d8c4f2e3578cf01c469284_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:MediaAdmin:list_image.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a2297d4c11c1992e77a9f6ea113635944b15af8be9d8c4f2e3578cf01c469284->leave($__internal_a2297d4c11c1992e77a9f6ea113635944b15af8be9d8c4f2e3578cf01c469284_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_15acd17d314c5e6a0448e2ba284e795f93da94d4312d76204b7ce2bc2425c6cf = $this->env->getExtension("native_profiler");
        $__internal_15acd17d314c5e6a0448e2ba284e795f93da94d4312d76204b7ce2bc2425c6cf->enter($__internal_15acd17d314c5e6a0448e2ba284e795f93da94d4312d76204b7ce2bc2425c6cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "method"), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name", array())), "admin", array("width" => 75, "height" => 60));
        echo "</a>
";
        
        $__internal_15acd17d314c5e6a0448e2ba284e795f93da94d4312d76204b7ce2bc2425c6cf->leave($__internal_15acd17d314c5e6a0448e2ba284e795f93da94d4312d76204b7ce2bc2425c6cf_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:list_image.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 15,  34 => 14,  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:base_list_field.html.twig' %}*/
/* */
/* {% block field%}*/
/*     <a href="{{ admin.generateUrl('edit', {'id' : object|sonata_urlsafeid }) }}">{% thumbnail attribute(object, field_description.name ), 'admin' with {'width': 75, 'height': 60} %}</a>*/
/* {% endblock %}*/
/* */
