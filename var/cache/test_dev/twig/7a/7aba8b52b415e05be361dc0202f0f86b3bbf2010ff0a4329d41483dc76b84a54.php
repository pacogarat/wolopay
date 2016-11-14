<?php

/* WebProfilerBundle:Profiler:ajax_layout.html.twig */
class __TwigTemplate_fac43dcd7771bd281e21fc6148b525e2dfcc68fda425310ac26cc9bf7789c731 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e9312d790d6609235af03d8f75257f1dd03c9efeaee8eec25eee569c06ec66e4 = $this->env->getExtension("native_profiler");
        $__internal_e9312d790d6609235af03d8f75257f1dd03c9efeaee8eec25eee569c06ec66e4->enter($__internal_e9312d790d6609235af03d8f75257f1dd03c9efeaee8eec25eee569c06ec66e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Profiler:ajax_layout.html.twig"));

        // line 1
        $this->displayBlock('panel', $context, $blocks);
        
        $__internal_e9312d790d6609235af03d8f75257f1dd03c9efeaee8eec25eee569c06ec66e4->leave($__internal_e9312d790d6609235af03d8f75257f1dd03c9efeaee8eec25eee569c06ec66e4_prof);

    }

    public function block_panel($context, array $blocks = array())
    {
        $__internal_0f4e67379f28fe56afb160cce9a9898f60ab6112ac0edd5bbebc296f0d1f96a6 = $this->env->getExtension("native_profiler");
        $__internal_0f4e67379f28fe56afb160cce9a9898f60ab6112ac0edd5bbebc296f0d1f96a6->enter($__internal_0f4e67379f28fe56afb160cce9a9898f60ab6112ac0edd5bbebc296f0d1f96a6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        echo "";
        
        $__internal_0f4e67379f28fe56afb160cce9a9898f60ab6112ac0edd5bbebc296f0d1f96a6->leave($__internal_0f4e67379f28fe56afb160cce9a9898f60ab6112ac0edd5bbebc296f0d1f96a6_prof);

    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:ajax_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }
}
/* {% block panel '' %}*/
/* */
