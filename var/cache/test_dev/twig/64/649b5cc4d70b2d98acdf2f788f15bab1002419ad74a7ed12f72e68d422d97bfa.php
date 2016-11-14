<?php

/* TwigBundle:Exception:exception.rdf.twig */
class __TwigTemplate_b13851c24c9a711eb62b28032d121e78c1fe0267f1a74bdb72a31c55b9dc066b extends Twig_Template
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
        $__internal_3cc0a451117a33b87e366837f25b83fb400aa8d8ae4a03279c5e768b4dc293f0 = $this->env->getExtension("native_profiler");
        $__internal_3cc0a451117a33b87e366837f25b83fb400aa8d8ae4a03279c5e768b4dc293f0->enter($__internal_3cc0a451117a33b87e366837f25b83fb400aa8d8ae4a03279c5e768b4dc293f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.rdf.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/exception.xml.twig", "TwigBundle:Exception:exception.rdf.twig", 1)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        
        $__internal_3cc0a451117a33b87e366837f25b83fb400aa8d8ae4a03279c5e768b4dc293f0->leave($__internal_3cc0a451117a33b87e366837f25b83fb400aa8d8ae4a03279c5e768b4dc293f0_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.rdf.twig";
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
