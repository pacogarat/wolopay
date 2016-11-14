<?php

/* AppBundle:Sonata/App:edit_pmpc_to_all_articles.html.twig */
class __TwigTemplate_41018f5330dc784acb4d8ead8b00169754e958adf689bb90710836bb7573df77 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "AppBundle:Sonata/App:edit_pmpc_to_all_articles.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_8c570ef94489ac807bb566b134473c72a8fe71f11a6c6a0bd2aea93fba1c53b0 = $this->env->getExtension("native_profiler");
        $__internal_8c570ef94489ac807bb566b134473c72a8fe71f11a6c6a0bd2aea93fba1c53b0->enter($__internal_8c570ef94489ac807bb566b134473c72a8fe71f11a6c6a0bd2aea93fba1c53b0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/App:edit_pmpc_to_all_articles.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8c570ef94489ac807bb566b134473c72a8fe71f11a6c6a0bd2aea93fba1c53b0->leave($__internal_8c570ef94489ac807bb566b134473c72a8fe71f11a6c6a0bd2aea93fba1c53b0_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_e004e3ffdb79b8b55fb9ac2d65c84a84373297fd2b63b43414ff778c4049256d = $this->env->getExtension("native_profiler");
        $__internal_e004e3ffdb79b8b55fb9ac2d65c84a84373297fd2b63b43414ff778c4049256d->enter($__internal_e004e3ffdb79b8b55fb9ac2d65c84a84373297fd2b63b43414ff778c4049256d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "
    ";
        // line 5
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
    if Articles are empty, all of them will be selected by default
";
        
        $__internal_e004e3ffdb79b8b55fb9ac2d65c84a84373297fd2b63b43414ff778c4049256d->leave($__internal_e004e3ffdb79b8b55fb9ac2d65c84a84373297fd2b63b43414ff778c4049256d_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/App:edit_pmpc_to_all_articles.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:action.html.twig' %}*/
/* */
/* {% block content %}*/
/* */
/*     {{ form(form) }}*/
/*     if Articles are empty, all of them will be selected by default*/
/* {% endblock %}*/
