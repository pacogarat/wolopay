<?php

/* AppBundle:Sonata/App:import_to_sandbox.html.twig */
class __TwigTemplate_98da843d25103a1c178ef7589681b2210524b07e090c6ee948ac424a55449907 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "AppBundle:Sonata/App:import_to_sandbox.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7bedc235fb6555120ac5890be9d825e7c62a17bb4673d4561caa49039a0f6a14 = $this->env->getExtension("native_profiler");
        $__internal_7bedc235fb6555120ac5890be9d825e7c62a17bb4673d4561caa49039a0f6a14->enter($__internal_7bedc235fb6555120ac5890be9d825e7c62a17bb4673d4561caa49039a0f6a14_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/App:import_to_sandbox.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7bedc235fb6555120ac5890be9d825e7c62a17bb4673d4561caa49039a0f6a14->leave($__internal_7bedc235fb6555120ac5890be9d825e7c62a17bb4673d4561caa49039a0f6a14_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_ce82d27e549ed66ef361d1f08951f9387b333b34a4c7665897a45e8dbc3acb22 = $this->env->getExtension("native_profiler");
        $__internal_ce82d27e549ed66ef361d1f08951f9387b333b34a4c7665897a45e8dbc3acb22->enter($__internal_ce82d27e549ed66ef361d1f08951f9387b333b34a4c7665897a45e8dbc3acb22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "
    ";
        // line 5
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "

";
        
        $__internal_ce82d27e549ed66ef361d1f08951f9387b333b34a4c7665897a45e8dbc3acb22->leave($__internal_ce82d27e549ed66ef361d1f08951f9387b333b34a4c7665897a45e8dbc3acb22_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/App:import_to_sandbox.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:action.html.twig' %}*/
/* */
/* {% block content %}*/
/* */
/*     {{ form(form) }}*/
/* */
/* {% endblock %}*/
