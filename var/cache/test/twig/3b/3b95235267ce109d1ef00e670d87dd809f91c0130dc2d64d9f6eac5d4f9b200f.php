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
        $__internal_610090af221d4b2335904114bdd96f290c644701a67b6eda6b52234b7593662c = $this->env->getExtension("native_profiler");
        $__internal_610090af221d4b2335904114bdd96f290c644701a67b6eda6b52234b7593662c->enter($__internal_610090af221d4b2335904114bdd96f290c644701a67b6eda6b52234b7593662c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Collector:router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_610090af221d4b2335904114bdd96f290c644701a67b6eda6b52234b7593662c->leave($__internal_610090af221d4b2335904114bdd96f290c644701a67b6eda6b52234b7593662c_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_94b2f876fa4a79c7a865053c19b4c82d9e7028e3faf6d5547b34e37425851eff = $this->env->getExtension("native_profiler");
        $__internal_94b2f876fa4a79c7a865053c19b4c82d9e7028e3faf6d5547b34e37425851eff->enter($__internal_94b2f876fa4a79c7a865053c19b4c82d9e7028e3faf6d5547b34e37425851eff_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_94b2f876fa4a79c7a865053c19b4c82d9e7028e3faf6d5547b34e37425851eff->leave($__internal_94b2f876fa4a79c7a865053c19b4c82d9e7028e3faf6d5547b34e37425851eff_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_ecfe4cbfc63aad4f1d0d46fdac3e62e8a1ca8c6eb06b91c83f93a4e0ffbf92f1 = $this->env->getExtension("native_profiler");
        $__internal_ecfe4cbfc63aad4f1d0d46fdac3e62e8a1ca8c6eb06b91c83f93a4e0ffbf92f1->enter($__internal_ecfe4cbfc63aad4f1d0d46fdac3e62e8a1ca8c6eb06b91c83f93a4e0ffbf92f1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_ecfe4cbfc63aad4f1d0d46fdac3e62e8a1ca8c6eb06b91c83f93a4e0ffbf92f1->leave($__internal_ecfe4cbfc63aad4f1d0d46fdac3e62e8a1ca8c6eb06b91c83f93a4e0ffbf92f1_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_04bffba1d407949f6e12fbc4a5adcb77d3e2a1770d21ef709f1779d77c5f035e = $this->env->getExtension("native_profiler");
        $__internal_04bffba1d407949f6e12fbc4a5adcb77d3e2a1770d21ef709f1779d77c5f035e->enter($__internal_04bffba1d407949f6e12fbc4a5adcb77d3e2a1770d21ef709f1779d77c5f035e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_04bffba1d407949f6e12fbc4a5adcb77d3e2a1770d21ef709f1779d77c5f035e->leave($__internal_04bffba1d407949f6e12fbc4a5adcb77d3e2a1770d21ef709f1779d77c5f035e_prof);

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
