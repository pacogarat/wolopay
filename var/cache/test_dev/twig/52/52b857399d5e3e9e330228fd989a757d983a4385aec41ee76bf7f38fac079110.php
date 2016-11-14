<?php

/* FOSUserBundle:Group:show.html.twig */
class __TwigTemplate_2c14d099607a5096fc31ff2790a2681c973008c74bc084b7733979b7a73ba605 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Group:show.html.twig", 1);
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
        $__internal_b6a1f99473ef15b84714a586746ba7dfe6ebca5ec453b89fc1268c074caabf54 = $this->env->getExtension("native_profiler");
        $__internal_b6a1f99473ef15b84714a586746ba7dfe6ebca5ec453b89fc1268c074caabf54->enter($__internal_b6a1f99473ef15b84714a586746ba7dfe6ebca5ec453b89fc1268c074caabf54_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b6a1f99473ef15b84714a586746ba7dfe6ebca5ec453b89fc1268c074caabf54->leave($__internal_b6a1f99473ef15b84714a586746ba7dfe6ebca5ec453b89fc1268c074caabf54_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_93939def71132fe08439534570376936e1a12eb9411feb86596a56e7e9c35770 = $this->env->getExtension("native_profiler");
        $__internal_93939def71132fe08439534570376936e1a12eb9411feb86596a56e7e9c35770->enter($__internal_93939def71132fe08439534570376936e1a12eb9411feb86596a56e7e9c35770_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:show_content.html.twig", "FOSUserBundle:Group:show.html.twig", 4)->display($context);
        
        $__internal_93939def71132fe08439534570376936e1a12eb9411feb86596a56e7e9c35770->leave($__internal_93939def71132fe08439534570376936e1a12eb9411feb86596a56e7e9c35770_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:show.html.twig";
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
/* {% include "FOSUserBundle:Group:show_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
