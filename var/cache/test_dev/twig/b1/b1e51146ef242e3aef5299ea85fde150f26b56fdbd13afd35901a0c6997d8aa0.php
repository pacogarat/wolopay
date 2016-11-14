<?php

/* FOSUserBundle:Profile:edit.html.twig */
class __TwigTemplate_4e9e9a649d1126ea90e74dbc510f9e6da135a70318abcb92a97a3ae26a7dd174 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Profile:edit.html.twig", 1);
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
        $__internal_68f05d50f2b90d7bee282b06e9eb217522c600174f9f3393e1a7715f34940886 = $this->env->getExtension("native_profiler");
        $__internal_68f05d50f2b90d7bee282b06e9eb217522c600174f9f3393e1a7715f34940886->enter($__internal_68f05d50f2b90d7bee282b06e9eb217522c600174f9f3393e1a7715f34940886_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_68f05d50f2b90d7bee282b06e9eb217522c600174f9f3393e1a7715f34940886->leave($__internal_68f05d50f2b90d7bee282b06e9eb217522c600174f9f3393e1a7715f34940886_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_c9b9a5869aff9ed9c46fe9ae1a207af27a48499fb082984f9c5eb6b3d321d5ed = $this->env->getExtension("native_profiler");
        $__internal_c9b9a5869aff9ed9c46fe9ae1a207af27a48499fb082984f9c5eb6b3d321d5ed->enter($__internal_c9b9a5869aff9ed9c46fe9ae1a207af27a48499fb082984f9c5eb6b3d321d5ed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Profile:edit_content.html.twig", "FOSUserBundle:Profile:edit.html.twig", 4)->display($context);
        
        $__internal_c9b9a5869aff9ed9c46fe9ae1a207af27a48499fb082984f9c5eb6b3d321d5ed->leave($__internal_c9b9a5869aff9ed9c46fe9ae1a207af27a48499fb082984f9c5eb6b3d321d5ed_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:edit.html.twig";
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
/* {% include "FOSUserBundle:Profile:edit_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
