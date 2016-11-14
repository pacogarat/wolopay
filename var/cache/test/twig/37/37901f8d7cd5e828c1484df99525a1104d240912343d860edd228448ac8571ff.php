<?php

/* TwigBundle:Exception:exception.json.twig */
class __TwigTemplate_49a4ce85b98d214ffdde02c84cf171f9cba52c712e34bf71c8a81de263551575 extends Twig_Template
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
        $__internal_8a17db69fc212db51262c66d87be42ff6cc6280d43adc81264cb018c0ecfb844 = $this->env->getExtension("native_profiler");
        $__internal_8a17db69fc212db51262c66d87be42ff6cc6280d43adc81264cb018c0ecfb844->enter($__internal_8a17db69fc212db51262c66d87be42ff6cc6280d43adc81264cb018c0ecfb844_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "exception" => $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray", array()))));
        echo "
";
        
        $__internal_8a17db69fc212db51262c66d87be42ff6cc6280d43adc81264cb018c0ecfb844->leave($__internal_8a17db69fc212db51262c66d87be42ff6cc6280d43adc81264cb018c0ecfb844_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.json.twig";
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
/* {{ { 'error': { 'code': status_code, 'message': status_text, 'exception': exception.toarray } }|json_encode|raw }}*/
/* */
