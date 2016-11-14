<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_89827400945fbcc93316c59bcf009dcc43bf62cb4274dc008c44bb1bab792d24 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_86c29b07c9c2cc845b8b55d2f489a5d627d36cd8d2c6572191cede39fea74f39 = $this->env->getExtension("native_profiler");
        $__internal_86c29b07c9c2cc845b8b55d2f489a5d627d36cd8d2c6572191cede39fea74f39->enter($__internal_86c29b07c9c2cc845b8b55d2f489a5d627d36cd8d2c6572191cede39fea74f39_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_86c29b07c9c2cc845b8b55d2f489a5d627d36cd8d2c6572191cede39fea74f39->leave($__internal_86c29b07c9c2cc845b8b55d2f489a5d627d36cd8d2c6572191cede39fea74f39_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_5d1159090122a4ad05002b73fb516a6b3ba17aac42ee7fd07ded5904517990cb = $this->env->getExtension("native_profiler");
        $__internal_5d1159090122a4ad05002b73fb516a6b3ba17aac42ee7fd07ded5904517990cb->enter($__internal_5d1159090122a4ad05002b73fb516a6b3ba17aac42ee7fd07ded5904517990cb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_5d1159090122a4ad05002b73fb516a6b3ba17aac42ee7fd07ded5904517990cb->leave($__internal_5d1159090122a4ad05002b73fb516a6b3ba17aac42ee7fd07ded5904517990cb_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_c5f26d51e580992fa088b108b56e10b705eaab79d8e96d3b438850c0538f80ae = $this->env->getExtension("native_profiler");
        $__internal_c5f26d51e580992fa088b108b56e10b705eaab79d8e96d3b438850c0538f80ae->enter($__internal_c5f26d51e580992fa088b108b56e10b705eaab79d8e96d3b438850c0538f80ae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_c5f26d51e580992fa088b108b56e10b705eaab79d8e96d3b438850c0538f80ae->leave($__internal_c5f26d51e580992fa088b108b56e10b705eaab79d8e96d3b438850c0538f80ae_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_be5c1b1f9e8f10307a54c22cf81c4a17cbb048aac83b71b8e37720e91400f940 = $this->env->getExtension("native_profiler");
        $__internal_be5c1b1f9e8f10307a54c22cf81c4a17cbb048aac83b71b8e37720e91400f940->enter($__internal_be5c1b1f9e8f10307a54c22cf81c4a17cbb048aac83b71b8e37720e91400f940_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_be5c1b1f9e8f10307a54c22cf81c4a17cbb048aac83b71b8e37720e91400f940->leave($__internal_be5c1b1f9e8f10307a54c22cf81c4a17cbb048aac83b71b8e37720e91400f940_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
