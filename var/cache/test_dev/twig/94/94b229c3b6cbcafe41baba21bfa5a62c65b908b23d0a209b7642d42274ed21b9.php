<?php

/* SonataAdminBundle:CRUD:edit_array.html.twig */
class __TwigTemplate_cb6e6ce68c5f87ef38d192d1674d729f75cc1a8db6a55a08122715da9da86552 extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_array.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c26de06acf11c5dc9019a16e53c1cd23bc56407fa645ef238cc35a2f371cc101 = $this->env->getExtension("native_profiler");
        $__internal_c26de06acf11c5dc9019a16e53c1cd23bc56407fa645ef238cc35a2f371cc101->enter($__internal_c26de06acf11c5dc9019a16e53c1cd23bc56407fa645ef238cc35a2f371cc101_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_array.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c26de06acf11c5dc9019a16e53c1cd23bc56407fa645ef238cc35a2f371cc101->leave($__internal_c26de06acf11c5dc9019a16e53c1cd23bc56407fa645ef238cc35a2f371cc101_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_702ca04b5d137df479078d4788830d3dfc1c6f56d1cea4b23893704daf56629f = $this->env->getExtension("native_profiler");
        $__internal_702ca04b5d137df479078d4788830d3dfc1c6f56d1cea4b23893704daf56629f->enter($__internal_702ca04b5d137df479078d4788830d3dfc1c6f56d1cea4b23893704daf56629f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <span class=\"edit\">
        ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        echo "
    </span>
";
        
        $__internal_702ca04b5d137df479078d4788830d3dfc1c6f56d1cea4b23893704daf56629f->leave($__internal_702ca04b5d137df479078d4788830d3dfc1c6f56d1cea4b23893704daf56629f_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_array.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/* {% block field %}*/
/*     <span class="edit">*/
/*         {{ form_widget(field_element, {'attr': {'class' : 'title'}}) }}*/
/*     </span>*/
/* {% endblock %}*/
/* */
