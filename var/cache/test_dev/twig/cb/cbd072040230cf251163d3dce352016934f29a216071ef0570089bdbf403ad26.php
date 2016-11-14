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
        $__internal_fcdedc807bdc7ba30b5a06f4f234f40ff34105416bb488e0c2074cec02f1af01 = $this->env->getExtension("native_profiler");
        $__internal_fcdedc807bdc7ba30b5a06f4f234f40ff34105416bb488e0c2074cec02f1af01->enter($__internal_fcdedc807bdc7ba30b5a06f4f234f40ff34105416bb488e0c2074cec02f1af01_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.atom.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/exception.xml.twig", "TwigBundle:Exception:exception.atom.twig", 1)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        
        $__internal_fcdedc807bdc7ba30b5a06f4f234f40ff34105416bb488e0c2074cec02f1af01->leave($__internal_fcdedc807bdc7ba30b5a06f4f234f40ff34105416bb488e0c2074cec02f1af01_prof);

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
