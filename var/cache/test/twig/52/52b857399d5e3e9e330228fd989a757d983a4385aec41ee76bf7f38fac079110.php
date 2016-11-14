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
        $__internal_03e592e36ff0141f58868e1c13eea82e1cc2d7f76e61ffd69c1daca037232d08 = $this->env->getExtension("native_profiler");
        $__internal_03e592e36ff0141f58868e1c13eea82e1cc2d7f76e61ffd69c1daca037232d08->enter($__internal_03e592e36ff0141f58868e1c13eea82e1cc2d7f76e61ffd69c1daca037232d08_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_03e592e36ff0141f58868e1c13eea82e1cc2d7f76e61ffd69c1daca037232d08->leave($__internal_03e592e36ff0141f58868e1c13eea82e1cc2d7f76e61ffd69c1daca037232d08_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_5024217cfff333517af7d441bc1e055ecb41040439e7cfca7e6439602a5a916c = $this->env->getExtension("native_profiler");
        $__internal_5024217cfff333517af7d441bc1e055ecb41040439e7cfca7e6439602a5a916c->enter($__internal_5024217cfff333517af7d441bc1e055ecb41040439e7cfca7e6439602a5a916c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:show_content.html.twig", "FOSUserBundle:Group:show.html.twig", 4)->display($context);
        
        $__internal_5024217cfff333517af7d441bc1e055ecb41040439e7cfca7e6439602a5a916c->leave($__internal_5024217cfff333517af7d441bc1e055ecb41040439e7cfca7e6439602a5a916c_prof);

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
