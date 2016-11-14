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
        $__internal_3471bc83b23ba208ab17183d121343b712c11d8f721218b201e0421e728eb427 = $this->env->getExtension("native_profiler");
        $__internal_3471bc83b23ba208ab17183d121343b712c11d8f721218b201e0421e728eb427->enter($__internal_3471bc83b23ba208ab17183d121343b712c11d8f721218b201e0421e728eb427_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:passwordAlreadyRequested.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3471bc83b23ba208ab17183d121343b712c11d8f721218b201e0421e728eb427->leave($__internal_3471bc83b23ba208ab17183d121343b712c11d8f721218b201e0421e728eb427_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_ae46cb0d53b1235b5c60987c7407f02c142cbe750ec0b13e7ae525a86d2efafd = $this->env->getExtension("native_profiler");
        $__internal_ae46cb0d53b1235b5c60987c7407f02c142cbe750ec0b13e7ae525a86d2efafd->enter($__internal_ae46cb0d53b1235b5c60987c7407f02c142cbe750ec0b13e7ae525a86d2efafd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "<p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.password_already_requested", array(), "FOSUserBundle"), "html", null, true);
        echo "</p>
";
        
        $__internal_ae46cb0d53b1235b5c60987c7407f02c142cbe750ec0b13e7ae525a86d2efafd->leave($__internal_ae46cb0d53b1235b5c60987c7407f02c142cbe750ec0b13e7ae525a86d2efafd_prof);

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
