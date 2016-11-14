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
        $__internal_853b01773aeb3cd56164c135927e81f557e78df3860041c160bdbd7200ff62cb = $this->env->getExtension("native_profiler");
        $__internal_853b01773aeb3cd56164c135927e81f557e78df3860041c160bdbd7200ff62cb->enter($__internal_853b01773aeb3cd56164c135927e81f557e78df3860041c160bdbd7200ff62cb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Profiler:ajax_layout.html.twig"));

        // line 1
        $this->displayBlock('panel', $context, $blocks);
        
        $__internal_853b01773aeb3cd56164c135927e81f557e78df3860041c160bdbd7200ff62cb->leave($__internal_853b01773aeb3cd56164c135927e81f557e78df3860041c160bdbd7200ff62cb_prof);

    }

    public function block_panel($context, array $blocks = array())
    {
        $__internal_3395a98a0a36ec5bf2576377d7f99aebd1a572e42d4c3651c93221e055c74a33 = $this->env->getExtension("native_profiler");
        $__internal_3395a98a0a36ec5bf2576377d7f99aebd1a572e42d4c3651c93221e055c74a33->enter($__internal_3395a98a0a36ec5bf2576377d7f99aebd1a572e42d4c3651c93221e055c74a33_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        echo "";
        
        $__internal_3395a98a0a36ec5bf2576377d7f99aebd1a572e42d4c3651c93221e055c74a33->leave($__internal_3395a98a0a36ec5bf2576377d7f99aebd1a572e42d4c3651c93221e055c74a33_prof);

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
