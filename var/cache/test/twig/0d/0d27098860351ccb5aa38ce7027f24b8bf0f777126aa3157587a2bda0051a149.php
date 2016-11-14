<?php

/* FOSUserBundle:Resetting:reset.html.twig */
class __TwigTemplate_e5178d0b3395bde6af388c633b2080cb2a7f73ef73289619c4239d3bfea1f761 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:reset.html.twig", 1);
        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_13ca70700e5341a96fe6b089ed60e608960dec026fd8f4093e5a5dfd38ba5ebf = $this->env->getExtension("native_profiler");
        $__internal_13ca70700e5341a96fe6b089ed60e608960dec026fd8f4093e5a5dfd38ba5ebf->enter($__internal_13ca70700e5341a96fe6b089ed60e608960dec026fd8f4093e5a5dfd38ba5ebf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:reset.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_13ca70700e5341a96fe6b089ed60e608960dec026fd8f4093e5a5dfd38ba5ebf->leave($__internal_13ca70700e5341a96fe6b089ed60e608960dec026fd8f4093e5a5dfd38ba5ebf_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_752f4501c9c162344b859338ca28884be5f3c38975e133915ba8a678da4de71e = $this->env->getExtension("native_profiler");
        $__internal_752f4501c9c162344b859338ca28884be5f3c38975e133915ba8a678da4de71e->enter($__internal_752f4501c9c162344b859338ca28884be5f3c38975e133915ba8a678da4de71e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Resetting:reset_content.html.twig", "FOSUserBundle:Resetting:reset.html.twig", 4)->display($context);
        
        $__internal_752f4501c9c162344b859338ca28884be5f3c38975e133915ba8a678da4de71e->leave($__internal_752f4501c9c162344b859338ca28884be5f3c38975e133915ba8a678da4de71e_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:reset.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% block fos_user_content %}*/
/* {% include "FOSUserBundle:Resetting:reset_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
