<?php

/* FOSUserBundle:Resetting:reset.html.twig */
class __TwigTemplate_e5178d0b3395bde6af388c633b2080cb2a7f73ef73289619c4239d3bfea1f761 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:reset.html.twig", 1);
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
        $__internal_837cfa4a5bdfa26dbad881ed0c50a04263935240497f04e23ac37e1a7058b8d5 = $this->env->getExtension("native_profiler");
        $__internal_837cfa4a5bdfa26dbad881ed0c50a04263935240497f04e23ac37e1a7058b8d5->enter($__internal_837cfa4a5bdfa26dbad881ed0c50a04263935240497f04e23ac37e1a7058b8d5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:reset.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_837cfa4a5bdfa26dbad881ed0c50a04263935240497f04e23ac37e1a7058b8d5->leave($__internal_837cfa4a5bdfa26dbad881ed0c50a04263935240497f04e23ac37e1a7058b8d5_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_b1fd01ec77bbad61c309ea86953c3bc42cf5939cad6b593456a164bd2d6e7fa1 = $this->env->getExtension("native_profiler");
        $__internal_b1fd01ec77bbad61c309ea86953c3bc42cf5939cad6b593456a164bd2d6e7fa1->enter($__internal_b1fd01ec77bbad61c309ea86953c3bc42cf5939cad6b593456a164bd2d6e7fa1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Resetting:reset_content.html.twig", "FOSUserBundle:Resetting:reset.html.twig", 4)->display($context);
        
        $__internal_b1fd01ec77bbad61c309ea86953c3bc42cf5939cad6b593456a164bd2d6e7fa1->leave($__internal_b1fd01ec77bbad61c309ea86953c3bc42cf5939cad6b593456a164bd2d6e7fa1_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:reset.html.twig";
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
/* {% include "FOSUserBundle:Resetting:reset_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
