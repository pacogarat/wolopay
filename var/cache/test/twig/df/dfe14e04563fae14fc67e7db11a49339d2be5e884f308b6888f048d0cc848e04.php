<?php

/* AppBundle:Sonata/CRUD:list__action_log.html.twig */
class __TwigTemplate_258558bdc0eb8c25365408430e5351c3d9f23a8c68cf4a7e0b3b783436c89c72 extends Twig_Template
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
        $__internal_65c1df2f1d0ef8efb9bb46f382cfbddb083dc23fd7e436dbb97b5c7be0a9e0f8 = $this->env->getExtension("native_profiler");
        $__internal_65c1df2f1d0ef8efb9bb46f382cfbddb083dc23fd7e436dbb97b5c7be0a9e0f8->enter($__internal_65c1df2f1d0ef8efb9bb46f382cfbddb083dc23fd7e436dbb97b5c7be0a9e0f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_log.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "log", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-list-alt\"></i>
    Log
</a>
";
        
        $__internal_65c1df2f1d0ef8efb9bb46f382cfbddb083dc23fd7e436dbb97b5c7be0a9e0f8->leave($__internal_65c1df2f1d0ef8efb9bb46f382cfbddb083dc23fd7e436dbb97b5c7be0a9e0f8_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/CRUD:list__action_log.html.twig";
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
/* <a href="{{ admin.generateObjectUrl('log', object) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-list-alt"></i>*/
/*     Log*/
/* </a>*/
/* */
