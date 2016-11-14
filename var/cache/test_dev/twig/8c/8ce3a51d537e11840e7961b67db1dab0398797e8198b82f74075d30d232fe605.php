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
        $__internal_bc48d92bea08ea44ff9312b6b60c555191d5d22cf99307bff053b705d4677022 = $this->env->getExtension("native_profiler");
        $__internal_bc48d92bea08ea44ff9312b6b60c555191d5d22cf99307bff053b705d4677022->enter($__internal_bc48d92bea08ea44ff9312b6b60c555191d5d22cf99307bff053b705d4677022_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.rdf.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/error.xml.twig", "TwigBundle:Exception:error.rdf.twig", 1)->display($context);
        
        $__internal_bc48d92bea08ea44ff9312b6b60c555191d5d22cf99307bff053b705d4677022->leave($__internal_bc48d92bea08ea44ff9312b6b60c555191d5d22cf99307bff053b705d4677022_prof);

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
