<?php

/* <script type='text/javascript' src='{{asset_url}}'></script> */
class __TwigTemplate_206761d3188ff23eaeb7f9ef820f4fd08aa2df90e076f8ffae2c896770381965 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e2481ecc6316db117b87a9918b56072adfda7ac6fe597cf3316364880860ba65 = $this->env->getExtension("native_profiler");
        $__internal_e2481ecc6316db117b87a9918b56072adfda7ac6fe597cf3316364880860ba65->enter($__internal_e2481ecc6316db117b87a9918b56072adfda7ac6fe597cf3316364880860ba65_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "<script type='text/javascript' src='{{asset_url}}'></script>"));

        // line 1
        echo "<script type='text/javascript' src='";
        echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
        echo "'></script>";
        
        $__internal_e2481ecc6316db117b87a9918b56072adfda7ac6fe597cf3316364880860ba65->leave($__internal_e2481ecc6316db117b87a9918b56072adfda7ac6fe597cf3316364880860ba65_prof);

    }

    public function getTemplateName()
    {
        return "<script type='text/javascript' src='{{asset_url}}'></script>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <script type='text/javascript' src='{{asset_url}}'></script>*/
