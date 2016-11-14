<?php

/* @App/Others/Default/termsConditions/terms_conditions_layout.html.twig */
class __TwigTemplate_96c3aa7fda54a44702a88719b3d95ae4a06236c8d160550c2dbb703eac80213a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f00c4ceaa461a212838e937a5343b1f320d3334a90a5c3737037faa6612b2a26 = $this->env->getExtension("native_profiler");
        $__internal_f00c4ceaa461a212838e937a5343b1f320d3334a90a5c3737037faa6612b2a26->enter($__internal_f00c4ceaa461a212838e937a5343b1f320d3334a90a5c3737037faa6612b2a26_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f00c4ceaa461a212838e937a5343b1f320d3334a90a5c3737037faa6612b2a26->leave($__internal_f00c4ceaa461a212838e937a5343b1f320d3334a90a5c3737037faa6612b2a26_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_d6c0c4775487baf233bdcb7e52f26d68572c5c9a6455fbc6730964c2529e9e24 = $this->env->getExtension("native_profiler");
        $__internal_d6c0c4775487baf233bdcb7e52f26d68572c5c9a6455fbc6730964c2529e9e24->enter($__internal_d6c0c4775487baf233bdcb7e52f26d68572c5c9a6455fbc6730964c2529e9e24_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_d6c0c4775487baf233bdcb7e52f26d68572c5c9a6455fbc6730964c2529e9e24->leave($__internal_d6c0c4775487baf233bdcb7e52f26d68572c5c9a6455fbc6730964c2529e9e24_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_f5b9f6945b19372c798722235314ca481355a8334425b9d3e176c3f6027ef36f = $this->env->getExtension("native_profiler");
        $__internal_f5b9f6945b19372c798722235314ca481355a8334425b9d3e176c3f6027ef36f->enter($__internal_f5b9f6945b19372c798722235314ca481355a8334425b9d3e176c3f6027ef36f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <style>
        body{
            font-size: 1.6em;
        }
        h1{
            margin: 40px 0;
        }
        h3{
            margin: 30px 0 30px;
        }
    </style>
    <div class=\"container voffset3\">
        ";
        // line 16
        $this->displayBlock('page', $context, $blocks);
        // line 17
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_f5b9f6945b19372c798722235314ca481355a8334425b9d3e176c3f6027ef36f->leave($__internal_f5b9f6945b19372c798722235314ca481355a8334425b9d3e176c3f6027ef36f_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_9fd1e55904d148ea9ac0d50317111b7a7cc6274683449217fe0851f97566a989 = $this->env->getExtension("native_profiler");
        $__internal_9fd1e55904d148ea9ac0d50317111b7a7cc6274683449217fe0851f97566a989->enter($__internal_9fd1e55904d148ea9ac0d50317111b7a7cc6274683449217fe0851f97566a989_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_9fd1e55904d148ea9ac0d50317111b7a7cc6274683449217fe0851f97566a989->leave($__internal_9fd1e55904d148ea9ac0d50317111b7a7cc6274683449217fe0851f97566a989_prof);

    }

    public function getTemplateName()
    {
        return "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 16,  69 => 17,  67 => 16,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block title %}{% endblock %}*/
/* {% block page_container %}*/
/*     <style>*/
/*         body{*/
/*             font-size: 1.6em;*/
/*         }*/
/*         h1{*/
/*             margin: 40px 0;*/
/*         }*/
/*         h3{*/
/*             margin: 30px 0 30px;*/
/*         }*/
/*     </style>*/
/*     <div class="container voffset3">*/
/*         {% block page '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
