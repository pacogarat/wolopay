<?php

/* WebProfilerBundle:Collector:router.html.twig */
class __TwigTemplate_ec430a0aa48e9130080a00d14d593d68f3ccec39378a6fab5a0ce1de88f686f1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "WebProfilerBundle:Collector:router.html.twig", 1);
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
        $__internal_7f7d93123ab1baa58734769577234343668a879f3bc27f8128f9b43ae95ea45b = $this->env->getExtension("native_profiler");
        $__internal_7f7d93123ab1baa58734769577234343668a879f3bc27f8128f9b43ae95ea45b->enter($__internal_7f7d93123ab1baa58734769577234343668a879f3bc27f8128f9b43ae95ea45b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Collector:router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7f7d93123ab1baa58734769577234343668a879f3bc27f8128f9b43ae95ea45b->leave($__internal_7f7d93123ab1baa58734769577234343668a879f3bc27f8128f9b43ae95ea45b_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_93c44b7af011d64f3450e78147084e78a3c4fb82bc2d3322b2cab4684028394e = $this->env->getExtension("native_profiler");
        $__internal_93c44b7af011d64f3450e78147084e78a3c4fb82bc2d3322b2cab4684028394e->enter($__internal_93c44b7af011d64f3450e78147084e78a3c4fb82bc2d3322b2cab4684028394e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_93c44b7af011d64f3450e78147084e78a3c4fb82bc2d3322b2cab4684028394e->leave($__internal_93c44b7af011d64f3450e78147084e78a3c4fb82bc2d3322b2cab4684028394e_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_5ca0c87ce80088082eae0df53fa4fa04fec1839072caa87bdf79340ef11c2734 = $this->env->getExtension("native_profiler");
        $__internal_5ca0c87ce80088082eae0df53fa4fa04fec1839072caa87bdf79340ef11c2734->enter($__internal_5ca0c87ce80088082eae0df53fa4fa04fec1839072caa87bdf79340ef11c2734_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_5ca0c87ce80088082eae0df53fa4fa04fec1839072caa87bdf79340ef11c2734->leave($__internal_5ca0c87ce80088082eae0df53fa4fa04fec1839072caa87bdf79340ef11c2734_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_0b9c8631a84d339ca820af5720c2f1796251329204bfd590e01a9ca3959ac8b7 = $this->env->getExtension("native_profiler");
        $__internal_0b9c8631a84d339ca820af5720c2f1796251329204bfd590e01a9ca3959ac8b7->enter($__internal_0b9c8631a84d339ca820af5720c2f1796251329204bfd590e01a9ca3959ac8b7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_0b9c8631a84d339ca820af5720c2f1796251329204bfd590e01a9ca3959ac8b7->leave($__internal_0b9c8631a84d339ca820af5720c2f1796251329204bfd590e01a9ca3959ac8b7_prof);

    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:router.html.twig";
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
