<?php

/* AppBundle:Sonata/App:app_import_to_sandbox_action.html.twig */
class __TwigTemplate_96ea2a41312843055b0173702ecbfa35bafa08f703aa84c5ac7d213d6dbe2f6b extends Twig_Template
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
        $__internal_ac44b4665cce4ff7277dee2bc623b9842863a487d982c7055502603b30f18219 = $this->env->getExtension("native_profiler");
        $__internal_ac44b4665cce4ff7277dee2bc623b9842863a487d982c7055502603b30f18219->enter($__internal_ac44b4665cce4ff7277dee2bc623b9842863a487d982c7055502603b30f18219_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/App:app_import_to_sandbox_action.html.twig"));

        // line 1
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_App_import_to_sandbox", array("appId" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-hdd\"></i>
    Import to sandbox
</a>
";
        
        $__internal_ac44b4665cce4ff7277dee2bc623b9842863a487d982c7055502603b30f18219->leave($__internal_ac44b4665cce4ff7277dee2bc623b9842863a487d982c7055502603b30f18219_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/App:app_import_to_sandbox_action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <a href="{{ path('admin_app_bundle_App_import_to_sandbox', {'appId': object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-hdd"></i>*/
/*     Import to sandbox*/
/* </a>*/
/* */
