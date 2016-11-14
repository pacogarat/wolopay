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
        $__internal_4ae52281f5c763fece5458d39046775e38a0293ff570579fffd1d8a6f42ea7c5 = $this->env->getExtension("native_profiler");
        $__internal_4ae52281f5c763fece5458d39046775e38a0293ff570579fffd1d8a6f42ea7c5->enter($__internal_4ae52281f5c763fece5458d39046775e38a0293ff570579fffd1d8a6f42ea7c5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:MediaAdmin:list_image.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4ae52281f5c763fece5458d39046775e38a0293ff570579fffd1d8a6f42ea7c5->leave($__internal_4ae52281f5c763fece5458d39046775e38a0293ff570579fffd1d8a6f42ea7c5_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_be83e7ab244b0fd426dc1ea0dfe88b22560a5aa717d128a82263146e642c908f = $this->env->getExtension("native_profiler");
        $__internal_be83e7ab244b0fd426dc1ea0dfe88b22560a5aa717d128a82263146e642c908f->enter($__internal_be83e7ab244b0fd426dc1ea0dfe88b22560a5aa717d128a82263146e642c908f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "method"), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "name", array())), "admin", array("width" => 75, "height" => 60));
        echo "</a>
";
        
        $__internal_be83e7ab244b0fd426dc1ea0dfe88b22560a5aa717d128a82263146e642c908f->leave($__internal_be83e7ab244b0fd426dc1ea0dfe88b22560a5aa717d128a82263146e642c908f_prof);

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
