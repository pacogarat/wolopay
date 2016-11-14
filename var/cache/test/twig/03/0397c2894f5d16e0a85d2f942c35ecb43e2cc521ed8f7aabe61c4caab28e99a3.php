<?php

/* FOSUserBundle:Resetting:passwordAlreadyRequested.html.twig */
class __TwigTemplate_08db635d749e69fb6f19537defb9a95bf828283a0d06ed13a4812087f090b3f5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:passwordAlreadyRequested.html.twig", 1);
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
        $__internal_bd934c4e69706fddeee23fe0e951090c9f2e3ee53be7030435b9408b1fc557bb = $this->env->getExtension("native_profiler");
        $__internal_bd934c4e69706fddeee23fe0e951090c9f2e3ee53be7030435b9408b1fc557bb->enter($__internal_bd934c4e69706fddeee23fe0e951090c9f2e3ee53be7030435b9408b1fc557bb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:passwordAlreadyRequested.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_bd934c4e69706fddeee23fe0e951090c9f2e3ee53be7030435b9408b1fc557bb->leave($__internal_bd934c4e69706fddeee23fe0e951090c9f2e3ee53be7030435b9408b1fc557bb_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_2b9faf7326195af16494408d63ea2aa1674c3f17fd9270452281674c51c859b2 = $this->env->getExtension("native_profiler");
        $__internal_2b9faf7326195af16494408d63ea2aa1674c3f17fd9270452281674c51c859b2->enter($__internal_2b9faf7326195af16494408d63ea2aa1674c3f17fd9270452281674c51c859b2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "<p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.password_already_requested", array(), "FOSUserBundle"), "html", null, true);
        echo "</p>
";
        
        $__internal_2b9faf7326195af16494408d63ea2aa1674c3f17fd9270452281674c51c859b2->leave($__internal_2b9faf7326195af16494408d63ea2aa1674c3f17fd9270452281674c51c859b2_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:passwordAlreadyRequested.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/* <p>{{ 'resetting.password_already_requested'|trans }}</p>*/
/* {% endblock fos_user_content %}*/
/* */
