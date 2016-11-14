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
        $__internal_6b32e95e2b0b64f0359ccfee42cd60169ad6663c59b39f900de1aa7f354d054b = $this->env->getExtension("native_profiler");
        $__internal_6b32e95e2b0b64f0359ccfee42cd60169ad6663c59b39f900de1aa7f354d054b->enter($__internal_6b32e95e2b0b64f0359ccfee42cd60169ad6663c59b39f900de1aa7f354d054b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6b32e95e2b0b64f0359ccfee42cd60169ad6663c59b39f900de1aa7f354d054b->leave($__internal_6b32e95e2b0b64f0359ccfee42cd60169ad6663c59b39f900de1aa7f354d054b_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_89484654c583142df1d239e6a76f04282419f5453d045f3bdd54ba2f4c939945 = $this->env->getExtension("native_profiler");
        $__internal_89484654c583142df1d239e6a76f04282419f5453d045f3bdd54ba2f4c939945->enter($__internal_89484654c583142df1d239e6a76f04282419f5453d045f3bdd54ba2f4c939945_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_89484654c583142df1d239e6a76f04282419f5453d045f3bdd54ba2f4c939945->leave($__internal_89484654c583142df1d239e6a76f04282419f5453d045f3bdd54ba2f4c939945_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_ad256c84b07c7481c9e4099fd7270d1c7ce229e52f8dad94705d44f64207d0d2 = $this->env->getExtension("native_profiler");
        $__internal_ad256c84b07c7481c9e4099fd7270d1c7ce229e52f8dad94705d44f64207d0d2->enter($__internal_ad256c84b07c7481c9e4099fd7270d1c7ce229e52f8dad94705d44f64207d0d2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_ad256c84b07c7481c9e4099fd7270d1c7ce229e52f8dad94705d44f64207d0d2->leave($__internal_ad256c84b07c7481c9e4099fd7270d1c7ce229e52f8dad94705d44f64207d0d2_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_bf146b2b7bda946ce5aa676c1ed7b92c9691558f38bf21f385dd5ba200cea1b5 = $this->env->getExtension("native_profiler");
        $__internal_bf146b2b7bda946ce5aa676c1ed7b92c9691558f38bf21f385dd5ba200cea1b5->enter($__internal_bf146b2b7bda946ce5aa676c1ed7b92c9691558f38bf21f385dd5ba200cea1b5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_bf146b2b7bda946ce5aa676c1ed7b92c9691558f38bf21f385dd5ba200cea1b5->leave($__internal_bf146b2b7bda946ce5aa676c1ed7b92c9691558f38bf21f385dd5ba200cea1b5_prof);

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
