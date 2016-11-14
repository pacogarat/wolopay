<?php

/* knp_menu_base.html.twig */
class __TwigTemplate_3c1c10e1c979490b885c608849191455522f4b1410341037d8204b3a648d1833 extends Twig_Template
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
        $__internal_c6e202af8a21df9d6d811776e79e06a926b73fa15763f9bb5a0fddf5ca0d78f7 = $this->env->getExtension("native_profiler");
        $__internal_c6e202af8a21df9d6d811776e79e06a926b73fa15763f9bb5a0fddf5ca0d78f7->enter($__internal_c6e202af8a21df9d6d811776e79e06a926b73fa15763f9bb5a0fddf5ca0d78f7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "knp_menu_base.html.twig"));

        // line 1
        if ($this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "compressed", array())) {
            $this->displayBlock("compressed_root", $context, $blocks);
        } else {
            $this->displayBlock("root", $context, $blocks);
        }
        
        $__internal_c6e202af8a21df9d6d811776e79e06a926b73fa15763f9bb5a0fddf5ca0d78f7->leave($__internal_c6e202af8a21df9d6d811776e79e06a926b73fa15763f9bb5a0fddf5ca0d78f7_prof);

    }

    public function getTemplateName()
    {
        return "knp_menu_base.html.twig";
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
/* {% if options.compressed %}{{ block('compressed_root') }}{% else %}{{ block('root') }}{% endif %}*/
/* */
