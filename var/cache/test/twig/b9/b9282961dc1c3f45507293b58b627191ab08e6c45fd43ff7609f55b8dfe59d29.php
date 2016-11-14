<?php

/* AppBundle:Sonata/Transaction/list:category.html.twig */
class __TwigTemplate_671105d970ba68d84f82f0ca3a3a8b8aa2a3b3366815b65fd071c8429132111e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_field.html.twig", "AppBundle:Sonata/Transaction/list:category.html.twig", 1);
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
        $__internal_c7f1e4db85464cddbe1e21f2d72af20b64f8cd6999f145c792f84cca9f631a53 = $this->env->getExtension("native_profiler");
        $__internal_c7f1e4db85464cddbe1e21f2d72af20b64f8cd6999f145c792f84cca9f631a53->enter($__internal_c7f1e4db85464cddbe1e21f2d72af20b64f8cd6999f145c792f84cca9f631a53_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Transaction/list:category.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c7f1e4db85464cddbe1e21f2d72af20b64f8cd6999f145c792f84cca9f631a53->leave($__internal_c7f1e4db85464cddbe1e21f2d72af20b64f8cd6999f145c792f84cca9f631a53_prof);

    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        $__internal_5047352235a4da325adeeab3f2ffb359feb0e2f9dce08478d268fe3ae9b0662e = $this->env->getExtension("native_profiler");
        $__internal_5047352235a4da325adeeab3f2ffb359feb0e2f9dce08478d268fe3ae9b0662e->enter($__internal_5047352235a4da325adeeab3f2ffb359feb0e2f9dce08478d268fe3ae9b0662e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 4
        echo "    <span class=\"label
        ";
        // line 5
        if ((($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::COMPLETED_ID")) || ($this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) == 201))) {
            // line 6
            echo "label-success
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 7
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::FAILED_ID"))) {
            // line 8
            echo "label-danger
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 9
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::PENDING_PAYMENT_ID"))) {
            // line 10
            echo "label-info
        ";
        } elseif (($this->getAttribute($this->getAttribute(        // line 11
(isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "id", array()) === constant("AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::BLOCKED_ID"))) {
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
        
        $__internal_5047352235a4da325adeeab3f2ffb359feb0e2f9dce08478d268fe3ae9b0662e->leave($__internal_5047352235a4da325adeeab3f2ffb359feb0e2f9dce08478d268fe3ae9b0662e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Transaction/list:category.html.twig";
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
/*         {% if (object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::COMPLETED_ID') or object.statusCategory.id == 201) -%}*/
/*             label-success*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::FAILED_ID')  -%}*/
/*             label-danger*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::PENDING_PAYMENT_ID')  -%}*/
/*             label-info*/
/*         {% elseif object.statusCategory.id is constant('AppBundle\\Entity\\Enum\\TransactionStatusCategoryEnum::BLOCKED_ID')  -%}*/
/*             label-warning*/
/*         {% else %}*/
/*             label-default*/
/*         {% endif %}*/
/*     ">*/
/*         {{ object.statusCategory.name }}*/
/*     </span>*/
/* {% endblock %}*/
