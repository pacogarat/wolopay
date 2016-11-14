<?php

/* FOSUserBundle:ChangePassword:changePassword.html.twig */
class __TwigTemplate_59674f6dab8c7886d9acc35b3575614393aa5e9bb54a33535e330f4a789fe4bb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:ChangePassword:changePassword.html.twig", 1);
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
        $__internal_8a4eb796a55bbdf4321d8a6efae1de1ac486d2be5783c0e3fd7151a8ae8ae2dd = $this->env->getExtension("native_profiler");
        $__internal_8a4eb796a55bbdf4321d8a6efae1de1ac486d2be5783c0e3fd7151a8ae8ae2dd->enter($__internal_8a4eb796a55bbdf4321d8a6efae1de1ac486d2be5783c0e3fd7151a8ae8ae2dd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:ChangePassword:changePassword.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8a4eb796a55bbdf4321d8a6efae1de1ac486d2be5783c0e3fd7151a8ae8ae2dd->leave($__internal_8a4eb796a55bbdf4321d8a6efae1de1ac486d2be5783c0e3fd7151a8ae8ae2dd_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_05aebf43e1a63f481bc23de38b1f2772fd55bd79ebe20da79654c06372a19c8b = $this->env->getExtension("native_profiler");
        $__internal_05aebf43e1a63f481bc23de38b1f2772fd55bd79ebe20da79654c06372a19c8b->enter($__internal_05aebf43e1a63f481bc23de38b1f2772fd55bd79ebe20da79654c06372a19c8b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:ChangePassword:changePassword_content.html.twig", "FOSUserBundle:ChangePassword:changePassword.html.twig", 4)->display($context);
        
        $__internal_05aebf43e1a63f481bc23de38b1f2772fd55bd79ebe20da79654c06372a19c8b->leave($__internal_05aebf43e1a63f481bc23de38b1f2772fd55bd79ebe20da79654c06372a19c8b_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:ChangePassword:changePassword.html.twig";
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
/* {% include "FOSUserBundle:ChangePassword:changePassword_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
