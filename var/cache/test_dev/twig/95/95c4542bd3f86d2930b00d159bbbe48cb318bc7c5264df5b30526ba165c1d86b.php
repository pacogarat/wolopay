<?php

/* SonataAdminBundle:CRUD:list_trans.html.twig */
class __TwigTemplate_65fc343ce34d9bfdfe7934cbb5a13df59c99660894dbeb6055eed2975eef09f0 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_trans.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f28d6fcfbe760e8b17beb6ff870c83d5e42795205f3eb1d5b81e513f99bb033b = $this->env->getExtension("native_profiler");
        $__internal_f28d6fcfbe760e8b17beb6ff870c83d5e42795205f3eb1d5b81e513f99bb033b->enter($__internal_f28d6fcfbe760e8b17beb6ff870c83d5e42795205f3eb1d5b81e513f99bb033b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_trans.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f28d6fcfbe760e8b17beb6ff870c83d5e42795205f3eb1d5b81e513f99bb033b->leave($__internal_f28d6fcfbe760e8b17beb6ff870c83d5e42795205f3eb1d5b81e513f99bb033b_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_e9232a697b8a396fdb81c766a6ef33fa60b05103e7d8775885a87100b2c43583 = $this->env->getExtension("native_profiler");
        $__internal_e9232a697b8a396fdb81c766a6ef33fa60b05103e7d8775885a87100b2c43583->enter($__internal_e9232a697b8a396fdb81c766a6ef33fa60b05103e7d8775885a87100b2c43583_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        if ( !$this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "catalogue", array(), "any", true, true)) {
            // line 16
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "html", null, true);
            echo "
    ";
        } else {
            // line 18
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), array(), $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "catalogue", array())), "html", null, true);
            echo "
    ";
        }
        
        $__internal_e9232a697b8a396fdb81c766a6ef33fa60b05103e7d8775885a87100b2c43583->leave($__internal_e9232a697b8a396fdb81c766a6ef33fa60b05103e7d8775885a87100b2c43583_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_trans.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 18,  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/* {% block field%}*/
/*     {% if field_description.options.catalogue is not defined %}*/
/*         {{value|trans}}*/
/*     {% else %}*/
/*         {{value|trans({}, field_description.options.catalogue)}}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
