<?php

/* FOSUserBundle:Profile:show.html.twig */
class __TwigTemplate_edefbcd498d68a19ed9cc95fefc5b188c34bf4923c728c13fbb81f267ac24f31 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Profile:show.html.twig", 1);
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
        $__internal_888722351b746dc3a6f68be59f4d0c5671fe2da7142911b0d2a9dc5c41338911 = $this->env->getExtension("native_profiler");
        $__internal_888722351b746dc3a6f68be59f4d0c5671fe2da7142911b0d2a9dc5c41338911->enter($__internal_888722351b746dc3a6f68be59f4d0c5671fe2da7142911b0d2a9dc5c41338911_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_888722351b746dc3a6f68be59f4d0c5671fe2da7142911b0d2a9dc5c41338911->leave($__internal_888722351b746dc3a6f68be59f4d0c5671fe2da7142911b0d2a9dc5c41338911_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_40b5efaef91e7685287fd2674f4d03cbb00ede0739cf8f8e4e86349179fbf523 = $this->env->getExtension("native_profiler");
        $__internal_40b5efaef91e7685287fd2674f4d03cbb00ede0739cf8f8e4e86349179fbf523->enter($__internal_40b5efaef91e7685287fd2674f4d03cbb00ede0739cf8f8e4e86349179fbf523_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Profile:show_content.html.twig", "FOSUserBundle:Profile:show.html.twig", 4)->display($context);
        
        $__internal_40b5efaef91e7685287fd2674f4d03cbb00ede0739cf8f8e4e86349179fbf523->leave($__internal_40b5efaef91e7685287fd2674f4d03cbb00ede0739cf8f8e4e86349179fbf523_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:show.html.twig";
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
/* {% include "FOSUserBundle:Profile:show_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
