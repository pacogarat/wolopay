<?php

/* FOSUserBundle:Resetting:checkEmail.html.twig */
class __TwigTemplate_83e892c690af54c951b197fa5552b19432d02f1678eff26b0635ca8654f95063 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:checkEmail.html.twig", 1);
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
        $__internal_d6677b2b315b5d7332cf89b2a7aee87d0d4e2f5c86c7317e60282536555c0b4c = $this->env->getExtension("native_profiler");
        $__internal_d6677b2b315b5d7332cf89b2a7aee87d0d4e2f5c86c7317e60282536555c0b4c->enter($__internal_d6677b2b315b5d7332cf89b2a7aee87d0d4e2f5c86c7317e60282536555c0b4c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:checkEmail.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d6677b2b315b5d7332cf89b2a7aee87d0d4e2f5c86c7317e60282536555c0b4c->leave($__internal_d6677b2b315b5d7332cf89b2a7aee87d0d4e2f5c86c7317e60282536555c0b4c_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_51e845238880604a10ab8c1ab7700a587d49a90b7a1b1f7ef8800649037aa21a = $this->env->getExtension("native_profiler");
        $__internal_51e845238880604a10ab8c1ab7700a587d49a90b7a1b1f7ef8800649037aa21a->enter($__internal_51e845238880604a10ab8c1ab7700a587d49a90b7a1b1f7ef8800649037aa21a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "<p>
";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.check_email", array("%email%" => (isset($context["email"]) ? $context["email"] : $this->getContext($context, "email"))), "FOSUserBundle"), "html", null, true);
        echo "
</p>
";
        
        $__internal_51e845238880604a10ab8c1ab7700a587d49a90b7a1b1f7ef8800649037aa21a->leave($__internal_51e845238880604a10ab8c1ab7700a587d49a90b7a1b1f7ef8800649037aa21a_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:checkEmail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 7,  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/* <p>*/
/* {{ 'resetting.check_email'|trans({'%email%': email}) }}*/
/* </p>*/
/* {% endblock %}*/
/* */
