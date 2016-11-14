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
        $__internal_c1111f6ada51c4a65a18b3828e4fc6ab969145fa2ca5b50e9626b91a06d8a264 = $this->env->getExtension("native_profiler");
        $__internal_c1111f6ada51c4a65a18b3828e4fc6ab969145fa2ca5b50e9626b91a06d8a264->enter($__internal_c1111f6ada51c4a65a18b3828e4fc6ab969145fa2ca5b50e9626b91a06d8a264_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.css.twig"));

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
        
        $__internal_c1111f6ada51c4a65a18b3828e4fc6ab969145fa2ca5b50e9626b91a06d8a264->leave($__internal_c1111f6ada51c4a65a18b3828e4fc6ab969145fa2ca5b50e9626b91a06d8a264_prof);

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
