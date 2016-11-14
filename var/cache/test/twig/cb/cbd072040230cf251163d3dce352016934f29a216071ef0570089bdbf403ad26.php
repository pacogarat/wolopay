<?php

/* TwigBundle:Exception:exception.atom.twig */
class __TwigTemplate_5ca125894a7f45e73007c849c85de2bbfdcc963ec9e0cacd04d111352e5df509 extends Twig_Template
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
        $__internal_225831f335cfe17aba12ff7314835f8593895f988a3a3c22e565ed9515cb1e2b = $this->env->getExtension("native_profiler");
        $__internal_225831f335cfe17aba12ff7314835f8593895f988a3a3c22e565ed9515cb1e2b->enter($__internal_225831f335cfe17aba12ff7314835f8593895f988a3a3c22e565ed9515cb1e2b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.atom.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/exception.xml.twig", "TwigBundle:Exception:exception.atom.twig", 1)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        
        $__internal_225831f335cfe17aba12ff7314835f8593895f988a3a3c22e565ed9515cb1e2b->leave($__internal_225831f335cfe17aba12ff7314835f8593895f988a3a3c22e565ed9515cb1e2b_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.atom.twig";
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
/* {% include '@Twig/Exception/exception.xml.twig' with { 'exception': exception } %}*/
/* */
