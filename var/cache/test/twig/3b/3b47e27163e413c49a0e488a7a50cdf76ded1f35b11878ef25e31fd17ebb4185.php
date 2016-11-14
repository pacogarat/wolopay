<?php

/* TwigBundle:Exception:exception.css.twig */
class __TwigTemplate_e67cc6f5098405c21bab04e5ebcfe7b326f13044d707de9e4bc7b48601f833e4 extends Twig_Template
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
        $__internal_22c5a4a513ed6ff8433a5947001da9da98ee383921211c1e0b1a170947cd0a40 = $this->env->getExtension("native_profiler");
        $__internal_22c5a4a513ed6ff8433a5947001da9da98ee383921211c1e0b1a170947cd0a40->enter($__internal_22c5a4a513ed6ff8433a5947001da9da98ee383921211c1e0b1a170947cd0a40_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.css.twig"));

        // line 1
        echo "/*
";
        // line 2
        $this->loadTemplate("@Twig/Exception/exception.txt.twig", "TwigBundle:Exception:exception.css.twig", 2)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        // line 3
        echo "*/
";
        
        $__internal_22c5a4a513ed6ff8433a5947001da9da98ee383921211c1e0b1a170947cd0a40->leave($__internal_22c5a4a513ed6ff8433a5947001da9da98ee383921211c1e0b1a170947cd0a40_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 3,  25 => 2,  22 => 1,);
    }
}
/* /**/
/* {% include '@Twig/Exception/exception.txt.twig' with { 'exception': exception } %}*/
/* *//* */
/* */
