<?php

/* AppBundle:Sonata:type_array_json.html.twig */
class __TwigTemplate_d338de763edb36985299f1cb5e737442d3a1578cefd4f1ac43c7cc6285986017 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Sonata:type_array_json.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9f16decd5e6a39ec5335869782c959a77bc67c03f57d728d7307c4724c49ee81 = $this->env->getExtension("native_profiler");
        $__internal_9f16decd5e6a39ec5335869782c959a77bc67c03f57d728d7307c4724c49ee81->enter($__internal_9f16decd5e6a39ec5335869782c959a77bc67c03f57d728d7307c4724c49ee81_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata:type_array_json.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9f16decd5e6a39ec5335869782c959a77bc67c03f57d728d7307c4724c49ee81->leave($__internal_9f16decd5e6a39ec5335869782c959a77bc67c03f57d728d7307c4724c49ee81_prof);

    }

    // line 4
    public function block_field($context, array $blocks = array())
    {
        $__internal_a66143851a69fe27acf06f137f1286c9a8a36e752717ce5abc83cc749f0d0ddf = $this->env->getExtension("native_profiler");
        $__internal_a66143851a69fe27acf06f137f1286c9a8a36e752717ce5abc83cc749f0d0ddf->enter($__internal_a66143851a69fe27acf06f137f1286c9a8a36e752717ce5abc83cc749f0d0ddf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 5
        echo "    <div style=\"overflow-x: scroll; width: 1100px;\">
        <pre style=\"width: 10000px;\">";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('app_print_r')->printRFilter((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "html", null, true);
        echo "</pre>
    </div>
";
        
        $__internal_a66143851a69fe27acf06f137f1286c9a8a36e752717ce5abc83cc749f0d0ddf->leave($__internal_a66143851a69fe27acf06f137f1286c9a8a36e752717ce5abc83cc749f0d0ddf_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata:type_array_json.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 6,  40 => 5,  34 => 4,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:base_show_field.html.twig' %}*/
/* */
/* */
/* {% block field %}*/
/*     <div style="overflow-x: scroll; width: 1100px;">*/
/*         <pre style="width: 10000px;">{{ value | print_r  }}</pre>*/
/*     </div>*/
/* {% endblock %}*/
