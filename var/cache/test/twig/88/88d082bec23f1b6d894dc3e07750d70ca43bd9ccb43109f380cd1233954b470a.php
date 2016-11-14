<?php

/* AppBundle:Sonata/Article:new_article__action_import.html.twig */
class __TwigTemplate_3d0196842aa437c62faaae6381d7c9833d21f0df7de7d182e1253f9206d6a8f1 extends Twig_Template
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
        $__internal_b4efba3fdf5fbb3b3c75a9bb2c23244727364ec7c8095ab910e2200aa1c1146e = $this->env->getExtension("native_profiler");
        $__internal_b4efba3fdf5fbb3b3c75a9bb2c23244727364ec7c8095ab910e2200aa1c1146e->enter($__internal_b4efba3fdf5fbb3b3c75a9bb2c23244727364ec7c8095ab910e2200aa1c1146e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Article:new_article__action_import.html.twig"));

        // line 1
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_Article_import_csv", array("appId" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-hdd\"></i>
    Import Articles
</a>
";
        
        $__internal_b4efba3fdf5fbb3b3c75a9bb2c23244727364ec7c8095ab910e2200aa1c1146e->leave($__internal_b4efba3fdf5fbb3b3c75a9bb2c23244727364ec7c8095ab910e2200aa1c1146e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Article:new_article__action_import.html.twig";
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
/* <a href="{{ path('admin_app_bundle_Article_import_csv', {'appId': object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-hdd"></i>*/
/*     Import Articles*/
/* </a>*/
/* */
