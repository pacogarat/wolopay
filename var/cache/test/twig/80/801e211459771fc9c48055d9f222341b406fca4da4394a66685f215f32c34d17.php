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
        $__internal_8fbc6282c6da4293e926aca8712ef90c92cfb8cafde973379cad89f3ae7eabf9 = $this->env->getExtension("native_profiler");
        $__internal_8fbc6282c6da4293e926aca8712ef90c92cfb8cafde973379cad89f3ae7eabf9->enter($__internal_8fbc6282c6da4293e926aca8712ef90c92cfb8cafde973379cad89f3ae7eabf9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/App:import_to_sandbox.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8fbc6282c6da4293e926aca8712ef90c92cfb8cafde973379cad89f3ae7eabf9->leave($__internal_8fbc6282c6da4293e926aca8712ef90c92cfb8cafde973379cad89f3ae7eabf9_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_db902d4f8715ed6120f08e2d8651fc583eaa4495c8005ca603fc3805616737f8 = $this->env->getExtension("native_profiler");
        $__internal_db902d4f8715ed6120f08e2d8651fc583eaa4495c8005ca603fc3805616737f8->enter($__internal_db902d4f8715ed6120f08e2d8651fc583eaa4495c8005ca603fc3805616737f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "
    ";
        // line 5
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "

";
        
        $__internal_db902d4f8715ed6120f08e2d8651fc583eaa4495c8005ca603fc3805616737f8->leave($__internal_db902d4f8715ed6120f08e2d8651fc583eaa4495c8005ca603fc3805616737f8_prof);

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
