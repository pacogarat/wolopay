<?php

/* SonataAdminBundle:CRUD:edit_integer.html.twig */
class __TwigTemplate_18e35aca31557e62a67164f51b113fbf87175c62a14e6e9dfc6f66758e99b68f extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_integer.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_47be180307a10a0245ced64aaa7f898de78d807f5e778ecc39fab050fe12a0af = $this->env->getExtension("native_profiler");
        $__internal_47be180307a10a0245ced64aaa7f898de78d807f5e778ecc39fab050fe12a0af->enter($__internal_47be180307a10a0245ced64aaa7f898de78d807f5e778ecc39fab050fe12a0af_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_integer.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_47be180307a10a0245ced64aaa7f898de78d807f5e778ecc39fab050fe12a0af->leave($__internal_47be180307a10a0245ced64aaa7f898de78d807f5e778ecc39fab050fe12a0af_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_c2b4ee152369bc473535aab441a0940550c99e67407f4fced37674d296432dca = $this->env->getExtension("native_profiler");
        $__internal_c2b4ee152369bc473535aab441a0940550c99e67407f4fced37674d296432dca->enter($__internal_c2b4ee152369bc473535aab441a0940550c99e67407f4fced37674d296432dca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_c2b4ee152369bc473535aab441a0940550c99e67407f4fced37674d296432dca->leave($__internal_c2b4ee152369bc473535aab441a0940550c99e67407f4fced37674d296432dca_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_integer.html.twig";
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
