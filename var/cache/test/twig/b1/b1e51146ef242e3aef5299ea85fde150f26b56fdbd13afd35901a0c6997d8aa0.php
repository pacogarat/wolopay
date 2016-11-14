<?php

/* FOSUserBundle:Profile:edit.html.twig */
class __TwigTemplate_4e9e9a649d1126ea90e74dbc510f9e6da135a70318abcb92a97a3ae26a7dd174 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Profile:edit.html.twig", 1);
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
        $__internal_b4e09e1927f9c26571704796380d9d9379c176932bb77a53cd8713039c0fa3ca = $this->env->getExtension("native_profiler");
        $__internal_b4e09e1927f9c26571704796380d9d9379c176932bb77a53cd8713039c0fa3ca->enter($__internal_b4e09e1927f9c26571704796380d9d9379c176932bb77a53cd8713039c0fa3ca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b4e09e1927f9c26571704796380d9d9379c176932bb77a53cd8713039c0fa3ca->leave($__internal_b4e09e1927f9c26571704796380d9d9379c176932bb77a53cd8713039c0fa3ca_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_fe25d24189fea456f15fd3ff00af2e4d74ae614befda7f207b0a8cc5e4910a1b = $this->env->getExtension("native_profiler");
        $__internal_fe25d24189fea456f15fd3ff00af2e4d74ae614befda7f207b0a8cc5e4910a1b->enter($__internal_fe25d24189fea456f15fd3ff00af2e4d74ae614befda7f207b0a8cc5e4910a1b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Profile:edit_content.html.twig", "FOSUserBundle:Profile:edit.html.twig", 4)->display($context);
        
        $__internal_fe25d24189fea456f15fd3ff00af2e4d74ae614befda7f207b0a8cc5e4910a1b->leave($__internal_fe25d24189fea456f15fd3ff00af2e4d74ae614befda7f207b0a8cc5e4910a1b_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:edit.html.twig";
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
/* {% include "FOSUserBundle:Profile:edit_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
