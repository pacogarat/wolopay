<?php

/* SonataAdminBundle:CRUD:edit_text.html.twig */
class __TwigTemplate_b95ac5a5c4a6138faec0f6aa2815391ecca0c304c9f4a56fe1e1d41b5c8c23df extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_text.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_701b73fe8b62930c85918e4110e0ac49f9949811a1c9729313840b8e6ee634f5 = $this->env->getExtension("native_profiler");
        $__internal_701b73fe8b62930c85918e4110e0ac49f9949811a1c9729313840b8e6ee634f5->enter($__internal_701b73fe8b62930c85918e4110e0ac49f9949811a1c9729313840b8e6ee634f5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_text.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_701b73fe8b62930c85918e4110e0ac49f9949811a1c9729313840b8e6ee634f5->leave($__internal_701b73fe8b62930c85918e4110e0ac49f9949811a1c9729313840b8e6ee634f5_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_9942fe0dcbdb7d74650e00f17471b2b266c640a9e461a8b5f951dc55af59976e = $this->env->getExtension("native_profiler");
        $__internal_9942fe0dcbdb7d74650e00f17471b2b266c640a9e461a8b5f951dc55af59976e->enter($__internal_9942fe0dcbdb7d74650e00f17471b2b266c640a9e461a8b5f951dc55af59976e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_9942fe0dcbdb7d74650e00f17471b2b266c640a9e461a8b5f951dc55af59976e->leave($__internal_9942fe0dcbdb7d74650e00f17471b2b266c640a9e461a8b5f951dc55af59976e_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_text.html.twig";
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
