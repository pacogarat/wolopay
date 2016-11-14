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
        $__internal_cd1507d30dc60a08f5ab9d387a1141c01b32badbafc0b656b069ea8fe1cf60e7 = $this->env->getExtension("native_profiler");
        $__internal_cd1507d30dc60a08f5ab9d387a1141c01b32badbafc0b656b069ea8fe1cf60e7->enter($__internal_cd1507d30dc60a08f5ab9d387a1141c01b32badbafc0b656b069ea8fe1cf60e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.js.twig"));

        // line 1
        echo "/*
";
        // line 2
        $this->loadTemplate("@Twig/Exception/exception.txt.twig", "TwigBundle:Exception:exception.js.twig", 2)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        // line 3
        echo "*/
";
        
        $__internal_cd1507d30dc60a08f5ab9d387a1141c01b32badbafc0b656b069ea8fe1cf60e7->leave($__internal_cd1507d30dc60a08f5ab9d387a1141c01b32badbafc0b656b069ea8fe1cf60e7_prof);

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
