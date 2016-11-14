<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_b245ceb08d4a7a5c91b7c2a6df11c1499e730132859ec724be039cc4e01cd512 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d83f07f1a180a5c773c3093a02d4de3ecddd64a6bf33ac41dd26453577404d22 = $this->env->getExtension("native_profiler");
        $__internal_d83f07f1a180a5c773c3093a02d4de3ecddd64a6bf33ac41dd26453577404d22->enter($__internal_d83f07f1a180a5c773c3093a02d4de3ecddd64a6bf33ac41dd26453577404d22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d83f07f1a180a5c773c3093a02d4de3ecddd64a6bf33ac41dd26453577404d22->leave($__internal_d83f07f1a180a5c773c3093a02d4de3ecddd64a6bf33ac41dd26453577404d22_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_ead4c873cdf3578ca61fc6d311d261e3b373f5bac7dd093af5251a4a0c7e9a84 = $this->env->getExtension("native_profiler");
        $__internal_ead4c873cdf3578ca61fc6d311d261e3b373f5bac7dd093af5251a4a0c7e9a84->enter($__internal_ead4c873cdf3578ca61fc6d311d261e3b373f5bac7dd093af5251a4a0c7e9a84_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_ead4c873cdf3578ca61fc6d311d261e3b373f5bac7dd093af5251a4a0c7e9a84->leave($__internal_ead4c873cdf3578ca61fc6d311d261e3b373f5bac7dd093af5251a4a0c7e9a84_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_fa7200d07045a979f0e4e79ac55d435474c7705df6d9db30f72838811218fc18 = $this->env->getExtension("native_profiler");
        $__internal_fa7200d07045a979f0e4e79ac55d435474c7705df6d9db30f72838811218fc18->enter($__internal_fa7200d07045a979f0e4e79ac55d435474c7705df6d9db30f72838811218fc18_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_fa7200d07045a979f0e4e79ac55d435474c7705df6d9db30f72838811218fc18->leave($__internal_fa7200d07045a979f0e4e79ac55d435474c7705df6d9db30f72838811218fc18_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_de5d12f5622d7bf9374c7d2170b9e5aeddbf581a6db570ac9d96c1d3c44ad0a0 = $this->env->getExtension("native_profiler");
        $__internal_de5d12f5622d7bf9374c7d2170b9e5aeddbf581a6db570ac9d96c1d3c44ad0a0->enter($__internal_de5d12f5622d7bf9374c7d2170b9e5aeddbf581a6db570ac9d96c1d3c44ad0a0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_de5d12f5622d7bf9374c7d2170b9e5aeddbf581a6db570ac9d96c1d3c44ad0a0->leave($__internal_de5d12f5622d7bf9374c7d2170b9e5aeddbf581a6db570ac9d96c1d3c44ad0a0_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
