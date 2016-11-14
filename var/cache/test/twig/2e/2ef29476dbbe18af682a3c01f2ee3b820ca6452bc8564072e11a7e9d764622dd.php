<?php

/* FOSUserBundle:Registration:register.html.twig */
class __TwigTemplate_fd85550556a11921ee7ed24093c25cb390d4669642761c11aa535afa457e4b08 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Registration:register.html.twig", 1);
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
        $__internal_64bed9f93a8e550fdb4ee2c6947a6c7dfb8052226695a95546268e0a0c2bc97d = $this->env->getExtension("native_profiler");
        $__internal_64bed9f93a8e550fdb4ee2c6947a6c7dfb8052226695a95546268e0a0c2bc97d->enter($__internal_64bed9f93a8e550fdb4ee2c6947a6c7dfb8052226695a95546268e0a0c2bc97d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:register.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_64bed9f93a8e550fdb4ee2c6947a6c7dfb8052226695a95546268e0a0c2bc97d->leave($__internal_64bed9f93a8e550fdb4ee2c6947a6c7dfb8052226695a95546268e0a0c2bc97d_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_7c7733058ece040618da057d1e00e507fd51e8f9963fb381ba5fd7759f1963b9 = $this->env->getExtension("native_profiler");
        $__internal_7c7733058ece040618da057d1e00e507fd51e8f9963fb381ba5fd7759f1963b9->enter($__internal_7c7733058ece040618da057d1e00e507fd51e8f9963fb381ba5fd7759f1963b9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Registration:register_content.html.twig", "FOSUserBundle:Registration:register.html.twig", 4)->display($context);
        
        $__internal_7c7733058ece040618da057d1e00e507fd51e8f9963fb381ba5fd7759f1963b9->leave($__internal_7c7733058ece040618da057d1e00e507fd51e8f9963fb381ba5fd7759f1963b9_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:register.html.twig";
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
/* {% include "FOSUserBundle:Registration:register_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
