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
        $__internal_2e0bfea0e5ead658533979e9ebdd8d1e1dd838a61a60f1eed71fcdc3c5e8a206 = $this->env->getExtension("native_profiler");
        $__internal_2e0bfea0e5ead658533979e9ebdd8d1e1dd838a61a60f1eed71fcdc3c5e8a206->enter($__internal_2e0bfea0e5ead658533979e9ebdd8d1e1dd838a61a60f1eed71fcdc3c5e8a206_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2e0bfea0e5ead658533979e9ebdd8d1e1dd838a61a60f1eed71fcdc3c5e8a206->leave($__internal_2e0bfea0e5ead658533979e9ebdd8d1e1dd838a61a60f1eed71fcdc3c5e8a206_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_cb315f603a5b5c03ee66f19dd03e18036679d2c7133bb2f37339a690a7a5a232 = $this->env->getExtension("native_profiler");
        $__internal_cb315f603a5b5c03ee66f19dd03e18036679d2c7133bb2f37339a690a7a5a232->enter($__internal_cb315f603a5b5c03ee66f19dd03e18036679d2c7133bb2f37339a690a7a5a232_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Profile:show_content.html.twig", "FOSUserBundle:Profile:show.html.twig", 4)->display($context);
        
        $__internal_cb315f603a5b5c03ee66f19dd03e18036679d2c7133bb2f37339a690a7a5a232->leave($__internal_cb315f603a5b5c03ee66f19dd03e18036679d2c7133bb2f37339a690a7a5a232_prof);

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
