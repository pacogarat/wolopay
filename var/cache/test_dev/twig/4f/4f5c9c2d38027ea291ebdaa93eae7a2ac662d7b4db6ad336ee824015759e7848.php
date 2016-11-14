<?php

/* AppBundle:Sonata/ClientUser:copy_button.html.twig */
class __TwigTemplate_30a0202e152196e09e8ccf471d01269ac90da17a69a885bd0ff355ca703b1d21 extends Twig_Template
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
        $__internal_2071fb2494ee8095ad36bc34ab023c3664259e4e08fa1a8641206c9ebde12f9f = $this->env->getExtension("native_profiler");
        $__internal_2071fb2494ee8095ad36bc34ab023c3664259e4e08fa1a8641206c9ebde12f9f->enter($__internal_2071fb2494ee8095ad36bc34ab023c3664259e4e08fa1a8641206c9ebde12f9f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/ClientUser:copy_button.html.twig"));

        // line 2
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_ClientUser_create", array("copy_id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"fa fa-copy\"></i>
    Copy
</a>
";
        
        $__internal_2071fb2494ee8095ad36bc34ab023c3664259e4e08fa1a8641206c9ebde12f9f->leave($__internal_2071fb2494ee8095ad36bc34ab023c3664259e4e08fa1a8641206c9ebde12f9f_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/ClientUser:copy_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 2,);
    }
}
/* {# object \AppBundle\Entity\ClientUser #}*/
/* <a href="{{ path('admin_app_bundle_ClientUser_create', {'copy_id': object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="fa fa-copy"></i>*/
/*     Copy*/
/* </a>*/
/* */
