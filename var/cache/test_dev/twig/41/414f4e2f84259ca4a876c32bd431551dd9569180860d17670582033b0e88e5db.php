<?php

/* AppBundle:Sonata/Article:new_article__action_log.html.twig */
class __TwigTemplate_c4c09f13c35096ecdb76cc4e9067ce5a4dfa9ee6d7d790f36215b3c2ab9f2547 extends Twig_Template
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
        $__internal_381c6ccb7adf4c4085a2d5e3ada7db12c7c11eb114c9f48b7979495bc588514d = $this->env->getExtension("native_profiler");
        $__internal_381c6ccb7adf4c4085a2d5e3ada7db12c7c11eb114c9f48b7979495bc588514d->enter($__internal_381c6ccb7adf4c4085a2d5e3ada7db12c7c11eb114c9f48b7979495bc588514d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Article:new_article__action_log.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_Article_create", array("appId" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-list-alt\"></i>
    Add Article
</a>
";
        
        $__internal_381c6ccb7adf4c4085a2d5e3ada7db12c7c11eb114c9f48b7979495bc588514d->leave($__internal_381c6ccb7adf4c4085a2d5e3ada7db12c7c11eb114c9f48b7979495bc588514d_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Article:new_article__action_log.html.twig";
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
/* <a href="{{ path('admin_app_bundle_Article_create', {'appId' : object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-list-alt"></i>*/
/*     Add Article*/
/* </a>*/
/* */
