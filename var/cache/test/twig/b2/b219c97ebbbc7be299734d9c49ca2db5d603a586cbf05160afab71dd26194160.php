<?php

/* TwigBundle:Exception:error.js.twig */
class __TwigTemplate_38bdea722204bc605eb11aeaba2225967e71b21283f456982e5d3d88c78eda95 extends Twig_Template
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
        $__internal_24423eabe628e32e73cb0d89dc3894526439992b28e16ea154a59c8f1a44db8b = $this->env->getExtension("native_profiler");
        $__internal_24423eabe628e32e73cb0d89dc3894526439992b28e16ea154a59c8f1a44db8b->enter($__internal_24423eabe628e32e73cb0d89dc3894526439992b28e16ea154a59c8f1a44db8b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.js.twig"));

        // line 1
        echo "/*
";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "js", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "js", null, true);
        echo "

*/
";
        
        $__internal_24423eabe628e32e73cb0d89dc3894526439992b28e16ea154a59c8f1a44db8b->leave($__internal_24423eabe628e32e73cb0d89dc3894526439992b28e16ea154a59c8f1a44db8b_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.js.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 2,  22 => 1,);
    }
}
/* /**/
/* {{ status_code }} {{ status_text }}*/
/* */
/* *//* */
/* */
