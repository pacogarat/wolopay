<?php

/* FOSUserBundle:Group:list.html.twig */
class __TwigTemplate_106c66b9e5536671da942042732ddf5b5f0e2605a6f0df9cef1c505cec0d1943 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Group:list.html.twig", 1);
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
        $__internal_afff7f4365f38859c9008bd52cc67130dfac39234fde2246eefa42a91b4adeed = $this->env->getExtension("native_profiler");
        $__internal_afff7f4365f38859c9008bd52cc67130dfac39234fde2246eefa42a91b4adeed->enter($__internal_afff7f4365f38859c9008bd52cc67130dfac39234fde2246eefa42a91b4adeed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:list.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_afff7f4365f38859c9008bd52cc67130dfac39234fde2246eefa42a91b4adeed->leave($__internal_afff7f4365f38859c9008bd52cc67130dfac39234fde2246eefa42a91b4adeed_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_bd4d89b2c2e3bb2aff2b5298079e6e73cc5163e87ad0c53096747b0a7f0e2112 = $this->env->getExtension("native_profiler");
        $__internal_bd4d89b2c2e3bb2aff2b5298079e6e73cc5163e87ad0c53096747b0a7f0e2112->enter($__internal_bd4d89b2c2e3bb2aff2b5298079e6e73cc5163e87ad0c53096747b0a7f0e2112_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:list_content.html.twig", "FOSUserBundle:Group:list.html.twig", 4)->display($context);
        
        $__internal_bd4d89b2c2e3bb2aff2b5298079e6e73cc5163e87ad0c53096747b0a7f0e2112->leave($__internal_bd4d89b2c2e3bb2aff2b5298079e6e73cc5163e87ad0c53096747b0a7f0e2112_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:list.html.twig";
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
/* {% include "FOSUserBundle:Group:list_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
