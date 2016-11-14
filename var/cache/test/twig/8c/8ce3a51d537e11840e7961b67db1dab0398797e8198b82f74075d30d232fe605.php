<?php

/* TwigBundle:Exception:error.rdf.twig */
class __TwigTemplate_63a30c5450755f07742e1dfebf9ce21c6de816d869b7b67fcdd362796e898499 extends Twig_Template
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
        $__internal_a40944e6330f246b1c80c69d32d40bb155fcea136da530ccd3efa05021dd6735 = $this->env->getExtension("native_profiler");
        $__internal_a40944e6330f246b1c80c69d32d40bb155fcea136da530ccd3efa05021dd6735->enter($__internal_a40944e6330f246b1c80c69d32d40bb155fcea136da530ccd3efa05021dd6735_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.rdf.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/error.xml.twig", "TwigBundle:Exception:error.rdf.twig", 1)->display($context);
        
        $__internal_a40944e6330f246b1c80c69d32d40bb155fcea136da530ccd3efa05021dd6735->leave($__internal_a40944e6330f246b1c80c69d32d40bb155fcea136da530ccd3efa05021dd6735_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.rdf.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* {% include '@Twig/Exception/error.xml.twig' %}*/
/* */
