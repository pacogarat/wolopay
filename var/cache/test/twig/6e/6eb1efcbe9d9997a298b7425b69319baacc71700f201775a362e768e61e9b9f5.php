<?php

/* FOSUserBundle:Group:edit.html.twig */
class __TwigTemplate_e7ccd23e230c42ec270680fd1dd8540e3c15645b92ab248f24f60aaa03978132 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Group:edit.html.twig", 1);
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
        $__internal_9ffe0bd94ace92893403661cc75b863803ddf4ce4c3247dab0844d082de8bcec = $this->env->getExtension("native_profiler");
        $__internal_9ffe0bd94ace92893403661cc75b863803ddf4ce4c3247dab0844d082de8bcec->enter($__internal_9ffe0bd94ace92893403661cc75b863803ddf4ce4c3247dab0844d082de8bcec_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9ffe0bd94ace92893403661cc75b863803ddf4ce4c3247dab0844d082de8bcec->leave($__internal_9ffe0bd94ace92893403661cc75b863803ddf4ce4c3247dab0844d082de8bcec_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_2042959a6fc4a929ec594d8121750921f3ba73a5fcfc2a616739f4089b81d12a = $this->env->getExtension("native_profiler");
        $__internal_2042959a6fc4a929ec594d8121750921f3ba73a5fcfc2a616739f4089b81d12a->enter($__internal_2042959a6fc4a929ec594d8121750921f3ba73a5fcfc2a616739f4089b81d12a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:edit_content.html.twig", "FOSUserBundle:Group:edit.html.twig", 4)->display($context);
        
        $__internal_2042959a6fc4a929ec594d8121750921f3ba73a5fcfc2a616739f4089b81d12a->leave($__internal_2042959a6fc4a929ec594d8121750921f3ba73a5fcfc2a616739f4089b81d12a_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:edit.html.twig";
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
/* {% include "FOSUserBundle:Group:edit_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
