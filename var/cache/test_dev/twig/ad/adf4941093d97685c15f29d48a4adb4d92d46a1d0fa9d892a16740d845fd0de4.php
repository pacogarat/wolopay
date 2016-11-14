<?php

/* ::base_bootstrap.html.twig */
class __TwigTemplate_79a70c2e0b2cf0c742a13910dcc422f2fde3c96dc7c8dee89e6e5069b3c58fd4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "::base_bootstrap.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'head_extra' => array($this, 'block_head_extra'),
            'body' => array($this, 'block_body'),
            'page_container' => array($this, 'block_page_container'),
            'javascripts' => array($this, 'block_javascripts'),
            'javascrips_extra' => array($this, 'block_javascrips_extra'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_5c05b4d6a5c8d142c58c38db75b14fdfc36c6375cfa99568dd2a34233f453a87 = $this->env->getExtension("native_profiler");
        $__internal_5c05b4d6a5c8d142c58c38db75b14fdfc36c6375cfa99568dd2a34233f453a87->enter($__internal_5c05b4d6a5c8d142c58c38db75b14fdfc36c6375cfa99568dd2a34233f453a87_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base_bootstrap.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5c05b4d6a5c8d142c58c38db75b14fdfc36c6375cfa99568dd2a34233f453a87->leave($__internal_5c05b4d6a5c8d142c58c38db75b14fdfc36c6375cfa99568dd2a34233f453a87_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_52766f98e2a8d7746dfcd627da3dddc31a5521f7599efcdb54c8b45d615cba89 = $this->env->getExtension("native_profiler");
        $__internal_52766f98e2a8d7746dfcd627da3dddc31a5521f7599efcdb54c8b45d615cba89->enter($__internal_52766f98e2a8d7746dfcd627da3dddc31a5521f7599efcdb54c8b45d615cba89_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">

    ";
        // line 6
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "1376e32_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32_0") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32_bootstrap_extra_1.css");
            // line 9
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "1376e32"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 11
        echo "
    ";
        // line 12
        $this->displayBlock('head_extra', $context, $blocks);
        // line 13
        echo "
";
        
        $__internal_52766f98e2a8d7746dfcd627da3dddc31a5521f7599efcdb54c8b45d615cba89->leave($__internal_52766f98e2a8d7746dfcd627da3dddc31a5521f7599efcdb54c8b45d615cba89_prof);

    }

    // line 12
    public function block_head_extra($context, array $blocks = array())
    {
        $__internal_e07ff009e48a32820f3caedc7f1b4400bc2695e929f259d829f03e4655436570 = $this->env->getExtension("native_profiler");
        $__internal_e07ff009e48a32820f3caedc7f1b4400bc2695e929f259d829f03e4655436570->enter($__internal_e07ff009e48a32820f3caedc7f1b4400bc2695e929f259d829f03e4655436570_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head_extra"));

        echo "";
        
        $__internal_e07ff009e48a32820f3caedc7f1b4400bc2695e929f259d829f03e4655436570->leave($__internal_e07ff009e48a32820f3caedc7f1b4400bc2695e929f259d829f03e4655436570_prof);

    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        $__internal_e9c4ab234d3d7cdb19ef4f9c84fa8880a5198f4a294c04d924e7e1e545c9efc1 = $this->env->getExtension("native_profiler");
        $__internal_e9c4ab234d3d7cdb19ef4f9c84fa8880a5198f4a294c04d924e7e1e545c9efc1->enter($__internal_e9c4ab234d3d7cdb19ef4f9c84fa8880a5198f4a294c04d924e7e1e545c9efc1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 17
        echo "    ";
        $this->displayBlock('page_container', $context, $blocks);
        
        $__internal_e9c4ab234d3d7cdb19ef4f9c84fa8880a5198f4a294c04d924e7e1e545c9efc1->leave($__internal_e9c4ab234d3d7cdb19ef4f9c84fa8880a5198f4a294c04d924e7e1e545c9efc1_prof);

    }

    public function block_page_container($context, array $blocks = array())
    {
        $__internal_bef3035017c6722d93c71230ecee9fc14b846b1c902db0a040e748377dfa1fb2 = $this->env->getExtension("native_profiler");
        $__internal_bef3035017c6722d93c71230ecee9fc14b846b1c902db0a040e748377dfa1fb2->enter($__internal_bef3035017c6722d93c71230ecee9fc14b846b1c902db0a040e748377dfa1fb2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        echo "";
        
        $__internal_bef3035017c6722d93c71230ecee9fc14b846b1c902db0a040e748377dfa1fb2->leave($__internal_bef3035017c6722d93c71230ecee9fc14b846b1c902db0a040e748377dfa1fb2_prof);

    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_cf9ae9c15141ed9ef9545fbbf9367e26d7f2ff1d79dd183ede8aedb77a6a5a65 = $this->env->getExtension("native_profiler");
        $__internal_cf9ae9c15141ed9ef9545fbbf9367e26d7f2ff1d79dd183ede8aedb77a6a5a65->enter($__internal_cf9ae9c15141ed9ef9545fbbf9367e26d7f2ff1d79dd183ede8aedb77a6a5a65_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 21
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    ";
        // line 22
        $this->displayBlock('javascrips_extra', $context, $blocks);
        
        $__internal_cf9ae9c15141ed9ef9545fbbf9367e26d7f2ff1d79dd183ede8aedb77a6a5a65->leave($__internal_cf9ae9c15141ed9ef9545fbbf9367e26d7f2ff1d79dd183ede8aedb77a6a5a65_prof);

    }

    public function block_javascrips_extra($context, array $blocks = array())
    {
        $__internal_828c9223bb1c01afc53b23b5f90b787452c2e1ad07d7095bf0d58d24b8a1941f = $this->env->getExtension("native_profiler");
        $__internal_828c9223bb1c01afc53b23b5f90b787452c2e1ad07d7095bf0d58d24b8a1941f->enter($__internal_828c9223bb1c01afc53b23b5f90b787452c2e1ad07d7095bf0d58d24b8a1941f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascrips_extra"));

        echo "";
        
        $__internal_828c9223bb1c01afc53b23b5f90b787452c2e1ad07d7095bf0d58d24b8a1941f->leave($__internal_828c9223bb1c01afc53b23b5f90b787452c2e1ad07d7095bf0d58d24b8a1941f_prof);

    }

    public function getTemplateName()
    {
        return "::base_bootstrap.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 22,  124 => 21,  118 => 20,  99 => 17,  93 => 16,  81 => 12,  73 => 13,  71 => 12,  68 => 11,  54 => 9,  50 => 6,  45 => 3,  39 => 2,  11 => 1,);
    }
}
/* {% extends "::base.html.twig" %}*/
/* {% block stylesheets %}*/
/* */
/*     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">*/
/* */
/*     {% stylesheets*/
/*         "css_glob/bootstrap_extra.css"*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/* */
/*     {% block head_extra '' %}*/
/* */
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% block page_container '' %}*/
/* {% endblock %}*/
/* */
/* {% block javascripts %}*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/*     {% block javascrips_extra '' %}*/
/* {% endblock %}*/
/* */
