<?php

/* AppBundle:Sonata/Payment/list:category.html.twig */
class __TwigTemplate_a142469ebed51f0b5ff3ba3bad7bb3cd1a7df07ab447b10b53cc4ffe17053b7d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Sonata/Payment/list:category.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_5ea6e0147825ad14c25d9cb74c25b6590f8fb5cc1ac4d9f33bde3c97c7585d99 = $this->env->getExtension("native_profiler");
        $__internal_5ea6e0147825ad14c25d9cb74c25b6590f8fb5cc1ac4d9f33bde3c97c7585d99->enter($__internal_5ea6e0147825ad14c25d9cb74c25b6590f8fb5cc1ac4d9f33bde3c97c7585d99_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Payment/list:category.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5ea6e0147825ad14c25d9cb74c25b6590f8fb5cc1ac4d9f33bde3c97c7585d99->leave($__internal_5ea6e0147825ad14c25d9cb74c25b6590f8fb5cc1ac4d9f33bde3c97c7585d99_prof);

    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        $__internal_8337353161af4cf918cb14418aa83c48109747ef1872f4a1d936b89e0f01fa72 = $this->env->getExtension("native_profiler");
        $__internal_8337353161af4cf918cb14418aa83c48109747ef1872f4a1d936b89e0f01fa72->enter($__internal_8337353161af4cf918cb14418aa83c48109747ef1872f4a1d936b89e0f01fa72_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 4
        echo "    <span class=\"label
        ";
        // line 5
        if (($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::COMPLETED_ID"))) {
            // line 6
            echo "label-success
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 7
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::FAILED_ID"))) {
            // line 8
            echo "label-danger
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 9
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::PENDING_ID"))) {
            // line 10
            echo "label-info
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 11
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::BLOCKED_ID"))) {
            // line 12
            echo "label-warning
        ";
        } else {
            // line 14
            echo "            label-default
        ";
        }
        // line 16
        echo "    \">
        ";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "name", array()), "html", null, true);
        echo "
    </span>
";
        
        $__internal_8337353161af4cf918cb14418aa83c48109747ef1872f4a1d936b89e0f01fa72->leave($__internal_8337353161af4cf918cb14418aa83c48109747ef1872f4a1d936b89e0f01fa72_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Payment/list:category.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 17,  68 => 16,  64 => 14,  60 => 12,  58 => 11,  55 => 10,  53 => 9,  50 => 8,  48 => 7,  45 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:base_list_field.html.twig' %}*/
/* */
/* {% block field%}*/
/*     <span class="label*/
/*         {% if object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::COMPLETED_ID') -%}*/
/*             label-success*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::FAILED_ID')  -%}*/
/*             label-danger*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::PENDING_ID')  -%}*/
/*             label-info*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\PaymentStatusCategoryEnum::BLOCKED_ID')  -%}*/
/*             label-warning*/
/*         {% else %}*/
/*             label-default*/
/*         {% endif %}*/
/*     ">*/
/*         {{ object.statusCategory.name }}*/
/*     </span>*/
/* {% endblock %}*/
