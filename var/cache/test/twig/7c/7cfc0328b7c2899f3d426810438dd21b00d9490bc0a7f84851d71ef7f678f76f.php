<?php

/* TwigBundle:Exception:exception.js.twig */
class __TwigTemplate_5c590bc2d088b5ad1c5fcc66ca807f50e4ceff7773d23437c8a6da1b02cca134 extends Twig_Template
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
        $__internal_16e1121ce8d8fe76329de3de9f571d51ee8ff20e26dd829b8bcc3401bf89c745 = $this->env->getExtension("native_profiler");
        $__internal_16e1121ce8d8fe76329de3de9f571d51ee8ff20e26dd829b8bcc3401bf89c745->enter($__internal_16e1121ce8d8fe76329de3de9f571d51ee8ff20e26dd829b8bcc3401bf89c745_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.js.twig"));

        // line 1
        echo "/*
";
        // line 2
        $this->loadTemplate("@Twig/Exception/exception.txt.twig", "TwigBundle:Exception:exception.js.twig", 2)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        // line 3
        echo "*/
";
        
        $__internal_16e1121ce8d8fe76329de3de9f571d51ee8ff20e26dd829b8bcc3401bf89c745->leave($__internal_16e1121ce8d8fe76329de3de9f571d51ee8ff20e26dd829b8bcc3401bf89c745_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.js.twig";
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
