<?php

/* TwigBundle:Exception:error.atom.twig */
class __TwigTemplate_efefb3b9d474b03d746a1c1f49da17182e96940a30b11636d1c3d2b9a943cdb7 extends Twig_Template
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
        $__internal_17cce23afc54f43146a1a8811d0c9813e6ab4e1bf4510166e60dd01973ddfefb = $this->env->getExtension("native_profiler");
        $__internal_17cce23afc54f43146a1a8811d0c9813e6ab4e1bf4510166e60dd01973ddfefb->enter($__internal_17cce23afc54f43146a1a8811d0c9813e6ab4e1bf4510166e60dd01973ddfefb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.atom.twig"));

        // line 1
        $this->loadTemplate("@Twig/Exception/error.xml.twig", "TwigBundle:Exception:error.atom.twig", 1)->display($context);
        
        $__internal_17cce23afc54f43146a1a8811d0c9813e6ab4e1bf4510166e60dd01973ddfefb->leave($__internal_17cce23afc54f43146a1a8811d0c9813e6ab4e1bf4510166e60dd01973ddfefb_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.atom.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* {% include '@Twig/Exception/error.xml.twig' %}*/
/* */
