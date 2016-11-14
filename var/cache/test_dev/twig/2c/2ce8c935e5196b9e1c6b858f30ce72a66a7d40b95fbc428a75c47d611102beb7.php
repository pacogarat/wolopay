<?php

/* FOSUserBundle:Resetting:request.html.twig */
class __TwigTemplate_b8bb479b1c31842054fc1af4a759e72977fb658ff5634cab6bdfa5ed5f20cd38 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:request.html.twig", 1);
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
        $__internal_5daf96483ff1114f181bd779cc63516cabb4d170ab87c7a0222c92a4916bc9ad = $this->env->getExtension("native_profiler");
        $__internal_5daf96483ff1114f181bd779cc63516cabb4d170ab87c7a0222c92a4916bc9ad->enter($__internal_5daf96483ff1114f181bd779cc63516cabb4d170ab87c7a0222c92a4916bc9ad_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:request.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5daf96483ff1114f181bd779cc63516cabb4d170ab87c7a0222c92a4916bc9ad->leave($__internal_5daf96483ff1114f181bd779cc63516cabb4d170ab87c7a0222c92a4916bc9ad_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_5f70246fd1d317e2b93b9e077b74af3ff26d9e51bcc9e8df987ca4c00a6554e4 = $this->env->getExtension("native_profiler");
        $__internal_5f70246fd1d317e2b93b9e077b74af3ff26d9e51bcc9e8df987ca4c00a6554e4->enter($__internal_5f70246fd1d317e2b93b9e077b74af3ff26d9e51bcc9e8df987ca4c00a6554e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Resetting:request_content.html.twig", "FOSUserBundle:Resetting:request.html.twig", 4)->display($context);
        
        $__internal_5f70246fd1d317e2b93b9e077b74af3ff26d9e51bcc9e8df987ca4c00a6554e4->leave($__internal_5f70246fd1d317e2b93b9e077b74af3ff26d9e51bcc9e8df987ca4c00a6554e4_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:request.html.twig";
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
/* {% include "FOSUserBundle:Resetting:request_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
