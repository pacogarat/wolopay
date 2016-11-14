<?php

/* TwigBundle:Exception:error.json.twig */
class __TwigTemplate_9ea38c1b7951ca8e1dc9a29bedfefc3ef0430f52bc51bc1753e84e452793b5fc extends Twig_Template
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
        $__internal_c2e3c519d759eac11ef26ee535c117fbba808c9b0beff707b24561138e8685f0 = $this->env->getExtension("native_profiler");
        $__internal_c2e3c519d759eac11ef26ee535c117fbba808c9b0beff707b24561138e8685f0->enter($__internal_c2e3c519d759eac11ef26ee535c117fbba808c9b0beff707b24561138e8685f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")))));
        echo "
";
        
        $__internal_c2e3c519d759eac11ef26ee535c117fbba808c9b0beff707b24561138e8685f0->leave($__internal_c2e3c519d759eac11ef26ee535c117fbba808c9b0beff707b24561138e8685f0_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.json.twig";
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
/* {{ { 'error': { 'code': status_code, 'message': status_text } }|json_encode|raw }}*/
/* */
