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
        $__internal_bba57a87cf41dd8050aa271090c0681afed8042d8057ad1211aad1b793cd817e = $this->env->getExtension("native_profiler");
        $__internal_bba57a87cf41dd8050aa271090c0681afed8042d8057ad1211aad1b793cd817e->enter($__internal_bba57a87cf41dd8050aa271090c0681afed8042d8057ad1211aad1b793cd817e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_log.html.twig"));

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
        
        $__internal_bba57a87cf41dd8050aa271090c0681afed8042d8057ad1211aad1b793cd817e->leave($__internal_bba57a87cf41dd8050aa271090c0681afed8042d8057ad1211aad1b793cd817e_prof);

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
