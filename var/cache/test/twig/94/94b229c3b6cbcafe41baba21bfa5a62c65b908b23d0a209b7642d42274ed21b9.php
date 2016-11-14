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
        $__internal_3e0e635f725a46a1f9881d0a23e912821313c7284f3e780c59d84cca9ecd7ca4 = $this->env->getExtension("native_profiler");
        $__internal_3e0e635f725a46a1f9881d0a23e912821313c7284f3e780c59d84cca9ecd7ca4->enter($__internal_3e0e635f725a46a1f9881d0a23e912821313c7284f3e780c59d84cca9ecd7ca4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_array.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3e0e635f725a46a1f9881d0a23e912821313c7284f3e780c59d84cca9ecd7ca4->leave($__internal_3e0e635f725a46a1f9881d0a23e912821313c7284f3e780c59d84cca9ecd7ca4_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_43b008a0656e92c2e63fdc604fc4f681c8b7d517289429451c26c5aec0612007 = $this->env->getExtension("native_profiler");
        $__internal_43b008a0656e92c2e63fdc604fc4f681c8b7d517289429451c26c5aec0612007->enter($__internal_43b008a0656e92c2e63fdc604fc4f681c8b7d517289429451c26c5aec0612007_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <span class=\"edit\">
        ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        echo "
    </span>
";
        
        $__internal_43b008a0656e92c2e63fdc604fc4f681c8b7d517289429451c26c5aec0612007->leave($__internal_43b008a0656e92c2e63fdc604fc4f681c8b7d517289429451c26c5aec0612007_prof);

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
