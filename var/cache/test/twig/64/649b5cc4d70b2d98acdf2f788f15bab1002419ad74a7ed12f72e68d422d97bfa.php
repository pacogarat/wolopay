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
        $__internal_a7258c7978a20a9a89e302c1c63366e4b64e71b1c2a4f56702e16090da884bb0 = $this->env->getExtension("native_profiler");
        $__internal_a7258c7978a20a9a89e302c1c63366e4b64e71b1c2a4f56702e16090da884bb0->enter($__internal_a7258c7978a20a9a89e302c1c63366e4b64e71b1c2a4f56702e16090da884bb0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.rdf.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/exception.xml.twig", "TwigBundle:Exception:exception.rdf.twig", 1)->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")))));
        
        $__internal_a7258c7978a20a9a89e302c1c63366e4b64e71b1c2a4f56702e16090da884bb0->leave($__internal_a7258c7978a20a9a89e302c1c63366e4b64e71b1c2a4f56702e16090da884bb0_prof);

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
