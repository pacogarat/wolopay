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
        $__internal_6ed4c643678275fe18e23cef74f316a8486960fc47e20d8b2bda754d2a45cc6b = $this->env->getExtension("native_profiler");
        $__internal_6ed4c643678275fe18e23cef74f316a8486960fc47e20d8b2bda754d2a45cc6b->enter($__internal_6ed4c643678275fe18e23cef74f316a8486960fc47e20d8b2bda754d2a45cc6b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base_bootstrap.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6ed4c643678275fe18e23cef74f316a8486960fc47e20d8b2bda754d2a45cc6b->leave($__internal_6ed4c643678275fe18e23cef74f316a8486960fc47e20d8b2bda754d2a45cc6b_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_2c98a7afbfb70d0b4e2353c031cd2222e810e6114d266daf02291b5b4e4f706c = $this->env->getExtension("native_profiler");
        $__internal_2c98a7afbfb70d0b4e2353c031cd2222e810e6114d266daf02291b5b4e4f706c->enter($__internal_2c98a7afbfb70d0b4e2353c031cd2222e810e6114d266daf02291b5b4e4f706c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_2c98a7afbfb70d0b4e2353c031cd2222e810e6114d266daf02291b5b4e4f706c->leave($__internal_2c98a7afbfb70d0b4e2353c031cd2222e810e6114d266daf02291b5b4e4f706c_prof);

    }

    // line 12
    public function block_head_extra($context, array $blocks = array())
    {
        $__internal_f584a79bcc2802b547a2c8ea389456101c5b6d48d40d6e91790020e89fb0ef7c = $this->env->getExtension("native_profiler");
        $__internal_f584a79bcc2802b547a2c8ea389456101c5b6d48d40d6e91790020e89fb0ef7c->enter($__internal_f584a79bcc2802b547a2c8ea389456101c5b6d48d40d6e91790020e89fb0ef7c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head_extra"));

        echo "";
        
        $__internal_f584a79bcc2802b547a2c8ea389456101c5b6d48d40d6e91790020e89fb0ef7c->leave($__internal_f584a79bcc2802b547a2c8ea389456101c5b6d48d40d6e91790020e89fb0ef7c_prof);

    }

    // line 16
    public function block_body($context, array $blocks = array())
    {
        $__internal_172c5b3b3d15fb49a2832aec70acea8890515a256ad8e1d759a2a50d86ed4c59 = $this->env->getExtension("native_profiler");
        $__internal_172c5b3b3d15fb49a2832aec70acea8890515a256ad8e1d759a2a50d86ed4c59->enter($__internal_172c5b3b3d15fb49a2832aec70acea8890515a256ad8e1d759a2a50d86ed4c59_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 17
        echo "    ";
        $this->displayBlock('page_container', $context, $blocks);
        
        $__internal_172c5b3b3d15fb49a2832aec70acea8890515a256ad8e1d759a2a50d86ed4c59->leave($__internal_172c5b3b3d15fb49a2832aec70acea8890515a256ad8e1d759a2a50d86ed4c59_prof);

    }

    public function block_page_container($context, array $blocks = array())
    {
        $__internal_c2986f1d2c0f811f9a63760585bdea8236c5bc0a9111c2e0f82b909b325fcd4a = $this->env->getExtension("native_profiler");
        $__internal_c2986f1d2c0f811f9a63760585bdea8236c5bc0a9111c2e0f82b909b325fcd4a->enter($__internal_c2986f1d2c0f811f9a63760585bdea8236c5bc0a9111c2e0f82b909b325fcd4a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        echo "";
        
        $__internal_c2986f1d2c0f811f9a63760585bdea8236c5bc0a9111c2e0f82b909b325fcd4a->leave($__internal_c2986f1d2c0f811f9a63760585bdea8236c5bc0a9111c2e0f82b909b325fcd4a_prof);

    }

    // line 20
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_03ee61f1a77618ce8108d99c99e09678171ac32139a2ec6b055c458b902b938a = $this->env->getExtension("native_profiler");
        $__internal_03ee61f1a77618ce8108d99c99e09678171ac32139a2ec6b055c458b902b938a->enter($__internal_03ee61f1a77618ce8108d99c99e09678171ac32139a2ec6b055c458b902b938a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 21
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    ";
        // line 22
        $this->displayBlock('javascrips_extra', $context, $blocks);
        
        $__internal_03ee61f1a77618ce8108d99c99e09678171ac32139a2ec6b055c458b902b938a->leave($__internal_03ee61f1a77618ce8108d99c99e09678171ac32139a2ec6b055c458b902b938a_prof);

    }

    public function block_javascrips_extra($context, array $blocks = array())
    {
        $__internal_2a5c9c368b48d3d86c230c0318505d3381f4337632ce20e59aaea271c3c549a7 = $this->env->getExtension("native_profiler");
        $__internal_2a5c9c368b48d3d86c230c0318505d3381f4337632ce20e59aaea271c3c549a7->enter($__internal_2a5c9c368b48d3d86c230c0318505d3381f4337632ce20e59aaea271c3c549a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascrips_extra"));

        echo "";
        
        $__internal_2a5c9c368b48d3d86c230c0318505d3381f4337632ce20e59aaea271c3c549a7->leave($__internal_2a5c9c368b48d3d86c230c0318505d3381f4337632ce20e59aaea271c3c549a7_prof);

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
