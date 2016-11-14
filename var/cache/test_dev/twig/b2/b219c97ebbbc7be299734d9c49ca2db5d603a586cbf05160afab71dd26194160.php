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
        $__internal_cce77e4f0649ef79b51111a38e065d37678a690fcb25e0f3e9d55fb12e041d6e = $this->env->getExtension("native_profiler");
        $__internal_cce77e4f0649ef79b51111a38e065d37678a690fcb25e0f3e9d55fb12e041d6e->enter($__internal_cce77e4f0649ef79b51111a38e065d37678a690fcb25e0f3e9d55fb12e041d6e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.js.twig"));

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
        
        $__internal_cce77e4f0649ef79b51111a38e065d37678a690fcb25e0f3e9d55fb12e041d6e->leave($__internal_cce77e4f0649ef79b51111a38e065d37678a690fcb25e0f3e9d55fb12e041d6e_prof);

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
