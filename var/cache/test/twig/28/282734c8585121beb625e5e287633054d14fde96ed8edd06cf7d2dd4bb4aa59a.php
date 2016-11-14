<?php

/* SonataAdminBundle:CRUD:edit_string.html.twig */
class __TwigTemplate_56afe0b02585cfbc7f6e4a03ec594b2a0e1efcc4ff05efe5c8ac641bdc6e2df8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_string.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c88d84a22aad18dcc63cb51b299ef4f02bf28175de8b9b4cad013cde8b9fa8d9 = $this->env->getExtension("native_profiler");
        $__internal_c88d84a22aad18dcc63cb51b299ef4f02bf28175de8b9b4cad013cde8b9fa8d9->enter($__internal_c88d84a22aad18dcc63cb51b299ef4f02bf28175de8b9b4cad013cde8b9fa8d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_string.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c88d84a22aad18dcc63cb51b299ef4f02bf28175de8b9b4cad013cde8b9fa8d9->leave($__internal_c88d84a22aad18dcc63cb51b299ef4f02bf28175de8b9b4cad013cde8b9fa8d9_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_5b9ffc37506c2013ebeae7311a75332ea84e9b1f9e4343dbf885aa18b4e80852 = $this->env->getExtension("native_profiler");
        $__internal_5b9ffc37506c2013ebeae7311a75332ea84e9b1f9e4343dbf885aa18b4e80852->enter($__internal_5b9ffc37506c2013ebeae7311a75332ea84e9b1f9e4343dbf885aa18b4e80852_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_5b9ffc37506c2013ebeae7311a75332ea84e9b1f9e4343dbf885aa18b4e80852->leave($__internal_5b9ffc37506c2013ebeae7311a75332ea84e9b1f9e4343dbf885aa18b4e80852_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_string.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 14,  18 => 12,);
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
/* {% extends base_template %}*/
/* */
/* {% block field %}{{ form_widget(field_element, {'attr': {'class' : 'title'}}) }}{% endblock %}*/
/* */
