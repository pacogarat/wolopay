<?php

/* AppBundle:Sonata/CRUD:list__action_payments.html.twig */
class __TwigTemplate_599e740c31c7f8cd09e78a1aa1546cb6cfd229f3da3c0ef514cb0e818fb60385 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7c7de1caa92a12cc62fad0eb8e15bd8d201719f04c226b4f1642889bc93c747a = $this->env->getExtension("native_profiler");
        $__internal_7c7de1caa92a12cc62fad0eb8e15bd8d201719f04c226b4f1642889bc93c747a->enter($__internal_7c7de1caa92a12cc62fad0eb8e15bd8d201719f04c226b4f1642889bc93c747a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_payments.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo $this->env->getExtension('routing')->getPath("admin_app_bundle_Payment_list");
        echo "?filter[paymentDetail__transaction__id][value]=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-euro\"></i>
    Payments
</a>
";
        
        $__internal_7c7de1caa92a12cc62fad0eb8e15bd8d201719f04c226b4f1642889bc93c747a->leave($__internal_7c7de1caa92a12cc62fad0eb8e15bd8d201719f04c226b4f1642889bc93c747a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/CRUD:list__action_payments.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 2,  22 => 1,);
    }
}
/* */
/* <a href="{{ path('admin_app_bundle_Payment_list') }}?filter[paymentDetail__transaction__id][value]={{ object.id }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-euro"></i>*/
/*     Payments*/
/* </a>*/
/* */