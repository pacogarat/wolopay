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
        $__internal_4bc17650d2d827bd35ef392b30c847053d71959f9413c911a0f9f17f052c1c57 = $this->env->getExtension("native_profiler");
        $__internal_4bc17650d2d827bd35ef392b30c847053d71959f9413c911a0f9f17f052c1c57->enter($__internal_4bc17650d2d827bd35ef392b30c847053d71959f9413c911a0f9f17f052c1c57_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:ChangePassword:changePassword.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4bc17650d2d827bd35ef392b30c847053d71959f9413c911a0f9f17f052c1c57->leave($__internal_4bc17650d2d827bd35ef392b30c847053d71959f9413c911a0f9f17f052c1c57_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_66656911c4a16c63be9d75b202bd2535ddd80ba08676eb7a7bfd8dda7c0b9a46 = $this->env->getExtension("native_profiler");
        $__internal_66656911c4a16c63be9d75b202bd2535ddd80ba08676eb7a7bfd8dda7c0b9a46->enter($__internal_66656911c4a16c63be9d75b202bd2535ddd80ba08676eb7a7bfd8dda7c0b9a46_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:ChangePassword:changePassword_content.html.twig", "FOSUserBundle:ChangePassword:changePassword.html.twig", 4)->display($context);
        
        $__internal_66656911c4a16c63be9d75b202bd2535ddd80ba08676eb7a7bfd8dda7c0b9a46->leave($__internal_66656911c4a16c63be9d75b202bd2535ddd80ba08676eb7a7bfd8dda7c0b9a46_prof);

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
