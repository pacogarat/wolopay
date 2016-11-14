<?php

/* FOSUserBundle:Resetting:request.html.twig */
class __TwigTemplate_b8bb479b1c31842054fc1af4a759e72977fb658ff5634cab6bdfa5ed5f20cd38 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:request.html.twig", 1);
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
        $__internal_51a210d49cdf55abf491bd7a668cf49a4274b8f5895d9d5e2022e3376b150ae1 = $this->env->getExtension("native_profiler");
        $__internal_51a210d49cdf55abf491bd7a668cf49a4274b8f5895d9d5e2022e3376b150ae1->enter($__internal_51a210d49cdf55abf491bd7a668cf49a4274b8f5895d9d5e2022e3376b150ae1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:request.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_51a210d49cdf55abf491bd7a668cf49a4274b8f5895d9d5e2022e3376b150ae1->leave($__internal_51a210d49cdf55abf491bd7a668cf49a4274b8f5895d9d5e2022e3376b150ae1_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_ed898e051e9c212dbaef87f71ed93bcf811e1b4c052cbfef7b7c3952fef20cdc = $this->env->getExtension("native_profiler");
        $__internal_ed898e051e9c212dbaef87f71ed93bcf811e1b4c052cbfef7b7c3952fef20cdc->enter($__internal_ed898e051e9c212dbaef87f71ed93bcf811e1b4c052cbfef7b7c3952fef20cdc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Resetting:request_content.html.twig", "FOSUserBundle:Resetting:request.html.twig", 4)->display($context);
        
        $__internal_ed898e051e9c212dbaef87f71ed93bcf811e1b4c052cbfef7b7c3952fef20cdc->leave($__internal_ed898e051e9c212dbaef87f71ed93bcf811e1b4c052cbfef7b7c3952fef20cdc_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:request.html.twig";
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
/* {% include "FOSUserBundle:Resetting:request_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
