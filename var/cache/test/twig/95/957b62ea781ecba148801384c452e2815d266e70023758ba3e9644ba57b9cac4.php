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
        $__internal_0be615648e27c04e49a8b03e25c0dd576b8ec7ab64ce1d2b6f566eec5f60f9ff = $this->env->getExtension("native_profiler");
        $__internal_0be615648e27c04e49a8b03e25c0dd576b8ec7ab64ce1d2b6f566eec5f60f9ff->enter($__internal_0be615648e27c04e49a8b03e25c0dd576b8ec7ab64ce1d2b6f566eec5f60f9ff_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:list.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0be615648e27c04e49a8b03e25c0dd576b8ec7ab64ce1d2b6f566eec5f60f9ff->leave($__internal_0be615648e27c04e49a8b03e25c0dd576b8ec7ab64ce1d2b6f566eec5f60f9ff_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_927a5e17d2762d843eeb56eed4a43c694b39b829a4be424bcfc40703d862d794 = $this->env->getExtension("native_profiler");
        $__internal_927a5e17d2762d843eeb56eed4a43c694b39b829a4be424bcfc40703d862d794->enter($__internal_927a5e17d2762d843eeb56eed4a43c694b39b829a4be424bcfc40703d862d794_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:list_content.html.twig", "FOSUserBundle:Group:list.html.twig", 4)->display($context);
        
        $__internal_927a5e17d2762d843eeb56eed4a43c694b39b829a4be424bcfc40703d862d794->leave($__internal_927a5e17d2762d843eeb56eed4a43c694b39b829a4be424bcfc40703d862d794_prof);

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
