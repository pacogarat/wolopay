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
        $__internal_038a01f0660bddf049ae88f1784422a3b5828345e253340a032039de68c71eae = $this->env->getExtension("native_profiler");
        $__internal_038a01f0660bddf049ae88f1784422a3b5828345e253340a032039de68c71eae->enter($__internal_038a01f0660bddf049ae88f1784422a3b5828345e253340a032039de68c71eae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "exception" => $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray", array()))));
        echo "
";
        
        $__internal_038a01f0660bddf049ae88f1784422a3b5828345e253340a032039de68c71eae->leave($__internal_038a01f0660bddf049ae88f1784422a3b5828345e253340a032039de68c71eae_prof);

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
