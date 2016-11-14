<?php

/* @App/AppShop/layout_secondary.html.twig */
class __TwigTemplate_911085e2e2cadacaad06f95c277e6486500cef12a93b339312d73481213eb0e2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/AppShop/layout_secondary.html.twig", 1);
        $this->blocks = array(
            'page_container' => array($this, 'block_page_container'),
            'title' => array($this, 'block_title'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9e6134f308d070cf4e896518de6fb24dddb75e9a384ecee7a6a6749d15cf5dce = $this->env->getExtension("native_profiler");
        $__internal_9e6134f308d070cf4e896518de6fb24dddb75e9a384ecee7a6a6749d15cf5dce->enter($__internal_9e6134f308d070cf4e896518de6fb24dddb75e9a384ecee7a6a6749d15cf5dce_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/AppShop/layout_secondary.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9e6134f308d070cf4e896518de6fb24dddb75e9a384ecee7a6a6749d15cf5dce->leave($__internal_9e6134f308d070cf4e896518de6fb24dddb75e9a384ecee7a6a6749d15cf5dce_prof);

    }

    // line 2
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_e7bac88535a9e48d37fb25f93f99c60a1e74fc8eee9aa921a760f1444f170cda = $this->env->getExtension("native_profiler");
        $__internal_e7bac88535a9e48d37fb25f93f99c60a1e74fc8eee9aa921a760f1444f170cda->enter($__internal_e7bac88535a9e48d37fb25f93f99c60a1e74fc8eee9aa921a760f1444f170cda_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 3
        echo "        <div class=\"container\">

            <div class=\"row voffset2\">
                <div class=\"col-sm-6\" >
                    <h2>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</h2>
                </div>
                <div class=\"col-sm-3 col-sm-offset-2\" >
                    <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/logo_180x40.png")), "html", null, true);
        echo "\" style=\"margin: 17px 0 0 0\">
                </div>
            </div>
            <div class=\"row voffset3\">
                ";
        // line 14
        $this->loadTemplate("@App/Partials/flash_msgs.html.twig", "@App/AppShop/layout_secondary.html.twig", 14)->display($context);
        // line 15
        echo "            </div>
            ";
        // line 16
        $this->displayBlock('page', $context, $blocks);
        // line 17
        echo "        </div>

";
        
        $__internal_e7bac88535a9e48d37fb25f93f99c60a1e74fc8eee9aa921a760f1444f170cda->leave($__internal_e7bac88535a9e48d37fb25f93f99c60a1e74fc8eee9aa921a760f1444f170cda_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_ac20ee017fc61c5cb542218f46bc36e3241a81ed3955f8e59658243ea36952ed = $this->env->getExtension("native_profiler");
        $__internal_ac20ee017fc61c5cb542218f46bc36e3241a81ed3955f8e59658243ea36952ed->enter($__internal_ac20ee017fc61c5cb542218f46bc36e3241a81ed3955f8e59658243ea36952ed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "";
        
        $__internal_ac20ee017fc61c5cb542218f46bc36e3241a81ed3955f8e59658243ea36952ed->leave($__internal_ac20ee017fc61c5cb542218f46bc36e3241a81ed3955f8e59658243ea36952ed_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_5268afc9fa3bc7c7af728e2fa5679e54244ce6f3b7e8c2c6affe052a23e14f26 = $this->env->getExtension("native_profiler");
        $__internal_5268afc9fa3bc7c7af728e2fa5679e54244ce6f3b7e8c2c6affe052a23e14f26->enter($__internal_5268afc9fa3bc7c7af728e2fa5679e54244ce6f3b7e8c2c6affe052a23e14f26_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_5268afc9fa3bc7c7af728e2fa5679e54244ce6f3b7e8c2c6affe052a23e14f26->leave($__internal_5268afc9fa3bc7c7af728e2fa5679e54244ce6f3b7e8c2c6affe052a23e14f26_prof);

    }

    public function getTemplateName()
    {
        return "@App/AppShop/layout_secondary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 16,  77 => 7,  68 => 17,  66 => 16,  63 => 15,  61 => 14,  54 => 10,  48 => 7,  42 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block page_container %}*/
/*         <div class="container">*/
/* */
/*             <div class="row voffset2">*/
/*                 <div class="col-sm-6" >*/
/*                     <h2>{% block title '' %}</h2>*/
/*                 </div>*/
/*                 <div class="col-sm-3 col-sm-offset-2" >*/
/*                     <img src="{{ absolute_url(asset('img/logo_180x40.png')) }}" style="margin: 17px 0 0 0">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row voffset3">*/
/*                 {% include '@App/Partials/flash_msgs.html.twig' %}*/
/*             </div>*/
/*             {% block page '' %}*/
/*         </div>*/
/* */
/* {% endblock %}*/
/* */
