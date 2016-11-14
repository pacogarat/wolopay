<?php

/* TwigBundle:Exception:error.css.twig */
class __TwigTemplate_1ccabbeafa857b860d19a318636bc7cd3bf5f5b87f0ed976ab0c971dab9c33f6 extends Twig_Template
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
        $__internal_f0dbfa4085a2046a3abd82e798dadcb429f0b00818fcf572c1758c97afdbe9d1 = $this->env->getExtension("native_profiler");
        $__internal_f0dbfa4085a2046a3abd82e798dadcb429f0b00818fcf572c1758c97afdbe9d1->enter($__internal_f0dbfa4085a2046a3abd82e798dadcb429f0b00818fcf572c1758c97afdbe9d1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.css.twig"));

        // line 1
        echo "/*
";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "css", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "css", null, true);
        echo "

*/
";
        
        $__internal_f0dbfa4085a2046a3abd82e798dadcb429f0b00818fcf572c1758c97afdbe9d1->leave($__internal_f0dbfa4085a2046a3abd82e798dadcb429f0b00818fcf572c1758c97afdbe9d1_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.css.twig";
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
