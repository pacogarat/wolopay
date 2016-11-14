<?php

/* SonataAdminBundle:CRUD:show_percent.html.twig */
class __TwigTemplate_cbf57df128bfdf6137d38be67c4f2a5e5afba1d88d7d80cfdb9f1878e5491376 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataAdminBundle:CRUD:show_percent.html.twig", 12);
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
        $__internal_b31766227e81cd036e250ec816745daaac0b7a1ca4c52f85b2608d6be25b5261 = $this->env->getExtension("native_profiler");
        $__internal_b31766227e81cd036e250ec816745daaac0b7a1ca4c52f85b2608d6be25b5261->enter($__internal_b31766227e81cd036e250ec816745daaac0b7a1ca4c52f85b2608d6be25b5261_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_percent.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b31766227e81cd036e250ec816745daaac0b7a1ca4c52f85b2608d6be25b5261->leave($__internal_b31766227e81cd036e250ec816745daaac0b7a1ca4c52f85b2608d6be25b5261_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_9dafd6616c3ff08b434bf25d9b2d7cb52b1025f1ea54b9fd0fa04f23a9113589 = $this->env->getExtension("native_profiler");
        $__internal_9dafd6616c3ff08b434bf25d9b2d7cb52b1025f1ea54b9fd0fa04f23a9113589->enter($__internal_9dafd6616c3ff08b434bf25d9b2d7cb52b1025f1ea54b9fd0fa04f23a9113589_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context["value"] = ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")) * 100);
        // line 16
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo " %
";
        
        $__internal_9dafd6616c3ff08b434bf25d9b2d7cb52b1025f1ea54b9fd0fa04f23a9113589->leave($__internal_9dafd6616c3ff08b434bf25d9b2d7cb52b1025f1ea54b9fd0fa04f23a9113589_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_percent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 16,  40 => 15,  34 => 14,  11 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends 'SonataAdminBundle:CRUD:base_show_field.html.twig' %}*/
/* */
/* {% block field %}*/
/*     {% set value = value * 100 %}*/
/*     {{ value }} %*/
/* {% endblock %}*/
/* */
