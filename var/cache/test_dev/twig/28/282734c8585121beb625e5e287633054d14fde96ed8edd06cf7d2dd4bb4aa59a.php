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
        $__internal_c68ccf566cb37d35b77d069a2717778964e5cd7e9d5942158b5bc50687e037be = $this->env->getExtension("native_profiler");
        $__internal_c68ccf566cb37d35b77d069a2717778964e5cd7e9d5942158b5bc50687e037be->enter($__internal_c68ccf566cb37d35b77d069a2717778964e5cd7e9d5942158b5bc50687e037be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_string.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c68ccf566cb37d35b77d069a2717778964e5cd7e9d5942158b5bc50687e037be->leave($__internal_c68ccf566cb37d35b77d069a2717778964e5cd7e9d5942158b5bc50687e037be_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_9758a416b27aef4ed76eaa1f487b97d293e140761b4d19c7fa24577f1641bb70 = $this->env->getExtension("native_profiler");
        $__internal_9758a416b27aef4ed76eaa1f487b97d293e140761b4d19c7fa24577f1641bb70->enter($__internal_9758a416b27aef4ed76eaa1f487b97d293e140761b4d19c7fa24577f1641bb70_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_9758a416b27aef4ed76eaa1f487b97d293e140761b4d19c7fa24577f1641bb70->leave($__internal_9758a416b27aef4ed76eaa1f487b97d293e140761b4d19c7fa24577f1641bb70_prof);

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
