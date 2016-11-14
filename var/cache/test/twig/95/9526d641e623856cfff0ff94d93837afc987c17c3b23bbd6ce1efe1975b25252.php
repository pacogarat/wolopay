<?php

/* AppBundle:Sonata/Article:new_article__action_copy.html.twig */
class __TwigTemplate_6669d6b963e0b4a8640a8a9f8c41b4e9cec0550c2ba43a02c1b5375def309461 extends Twig_Template
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
        $__internal_4a9508e22e5cfded03e62b8edcc6ff2d1835166b6b489746508128883190879c = $this->env->getExtension("native_profiler");
        $__internal_4a9508e22e5cfded03e62b8edcc6ff2d1835166b6b489746508128883190879c->enter($__internal_4a9508e22e5cfded03e62b8edcc6ff2d1835166b6b489746508128883190879c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Article:new_article__action_copy.html.twig"));

        // line 1
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_Article_create", array("copy" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-log-in\"></i>
    Copy Article
</a>
";
        
        $__internal_4a9508e22e5cfded03e62b8edcc6ff2d1835166b6b489746508128883190879c->leave($__internal_4a9508e22e5cfded03e62b8edcc6ff2d1835166b6b489746508128883190879c_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Article:new_article__action_copy.html.twig";
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
/* <a href="{{ path('admin_app_bundle_Article_create', {'copy': object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-log-in"></i>*/
/*     Copy Article*/
/* </a>*/
/* */
