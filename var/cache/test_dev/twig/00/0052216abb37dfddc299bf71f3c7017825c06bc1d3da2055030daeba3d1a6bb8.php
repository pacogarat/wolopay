<?php

/* AppBundle:Sonata/SMS:list__action_copy.html.twig */
class __TwigTemplate_8e58ee48be34766ad2c30852d7ca21e92b90ceb0b57c3893474701d639fee97d extends Twig_Template
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
        $__internal_b44ed0fc844e15f532fd0d349d68e56944b5b765bd12f8806fa4e0b185773407 = $this->env->getExtension("native_profiler");
        $__internal_b44ed0fc844e15f532fd0d349d68e56944b5b765bd12f8806fa4e0b185773407->enter($__internal_b44ed0fc844e15f532fd0d349d68e56944b5b765bd12f8806fa4e0b185773407_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/SMS:list__action_copy.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_SMS_create", array("copy_id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-file\"></i>
    Copy
</a>
";
        
        $__internal_b44ed0fc844e15f532fd0d349d68e56944b5b765bd12f8806fa4e0b185773407->leave($__internal_b44ed0fc844e15f532fd0d349d68e56944b5b765bd12f8806fa4e0b185773407_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/SMS:list__action_copy.html.twig";
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
/* <a href="{{ path('admin_app_bundle_SMS_create', { 'copy_id' : object.id }) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-file"></i>*/
/*     Copy*/
/* </a>*/
/* */
