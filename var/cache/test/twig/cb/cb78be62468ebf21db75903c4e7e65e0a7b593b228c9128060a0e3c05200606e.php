<?php

/* AppBundle:Sonata/Article:new_edit_pmpc_to_all_articles_action.html.twig */
class __TwigTemplate_605b5eb7799fb95147e8258a514ce991a8d06aeb1004e48254b67117c0f55c43 extends Twig_Template
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
        $__internal_6a2eb7ef9603183cc9c0df4d4a671f173418f09bf1c09f478b8afcdcefcf4431 = $this->env->getExtension("native_profiler");
        $__internal_6a2eb7ef9603183cc9c0df4d4a671f173418f09bf1c09f478b8afcdcefcf4431->enter($__internal_6a2eb7ef9603183cc9c0df4d4a671f173418f09bf1c09f478b8afcdcefcf4431_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Article:new_edit_pmpc_to_all_articles_action.html.twig"));

        // line 1
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_App_edit_apmpc", array("appId" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-euro\"></i>
    Edit APMPC
</a>
";
        
        $__internal_6a2eb7ef9603183cc9c0df4d4a671f173418f09bf1c09f478b8afcdcefcf4431->leave($__internal_6a2eb7ef9603183cc9c0df4d4a671f173418f09bf1c09f478b8afcdcefcf4431_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Article:new_edit_pmpc_to_all_articles_action.html.twig";
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
/* <a href="{{ path('admin_app_bundle_App_edit_apmpc', {'appId': object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-euro"></i>*/
/*     Edit APMPC*/
/* </a>*/
/* */
