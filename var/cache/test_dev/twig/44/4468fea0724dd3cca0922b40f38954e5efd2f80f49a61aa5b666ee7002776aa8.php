<?php

/* SonataAdminBundle:CRUD:list_datetime.html.twig */
class __TwigTemplate_754559a1e6d22e0b1095f70b7d50e7fc68d3f899fd1ff1f53a290b39fd38e6aa extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_datetime.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_fd22232e7cf3cce5a91eafd5ae6b5468fc62b72d8f946e0a18f1735e809cc3c5 = $this->env->getExtension("native_profiler");
        $__internal_fd22232e7cf3cce5a91eafd5ae6b5468fc62b72d8f946e0a18f1735e809cc3c5->enter($__internal_fd22232e7cf3cce5a91eafd5ae6b5468fc62b72d8f946e0a18f1735e809cc3c5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_datetime.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fd22232e7cf3cce5a91eafd5ae6b5468fc62b72d8f946e0a18f1735e809cc3c5->leave($__internal_fd22232e7cf3cce5a91eafd5ae6b5468fc62b72d8f946e0a18f1735e809cc3c5_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_17658bcc1937f7914dd7e69a247e487c24a676604d975f923a9d0354a39bc408 = $this->env->getExtension("native_profiler");
        $__internal_17658bcc1937f7914dd7e69a247e487c24a676604d975f923a9d0354a39bc408->enter($__internal_17658bcc1937f7914dd7e69a247e487c24a676604d975f923a9d0354a39bc408_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "&nbsp;";
        } elseif ($this->getAttribute($this->getAttribute(        // line 17
(isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "format", array(), "any", true, true)) {
            // line 18
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "format", array())), "html", null, true);
        } else {
            // line 20
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "html", null, true);
        }
        
        $__internal_17658bcc1937f7914dd7e69a247e487c24a676604d975f923a9d0354a39bc408->leave($__internal_17658bcc1937f7914dd7e69a247e487c24a676604d975f923a9d0354a39bc408_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_datetime.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 20,  45 => 18,  43 => 17,  41 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {%- elseif field_description.options.format is defined -%}*/
/*         {{ value|date(field_description.options.format) }}*/
/*     {%- else -%}*/
/*         {{ value|date }}*/
/*     {%- endif -%}*/
/* {% endblock %}*/
/* */
