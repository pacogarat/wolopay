<?php

/* AppBundle:Sonata/Purchase:cancel_payment_action.html.twig */
class __TwigTemplate_dfb107a8578ddb0e122c4e7bd44be53afc3fdeb55e87a1139358637d099e323c extends Twig_Template
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
        $__internal_e5ed74e7d037101e840cd00c068d8946457b1e52a03d77d9a3fc7eda889d4bbb = $this->env->getExtension("native_profiler");
        $__internal_e5ed74e7d037101e840cd00c068d8946457b1e52a03d77d9a3fc7eda889d4bbb->enter($__internal_e5ed74e7d037101e840cd00c068d8946457b1e52a03d77d9a3fc7eda889d4bbb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Purchase:cancel_payment_action.html.twig"));

        // line 1
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("admin_app_bundle_Purchase_cancel", array("id" => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()))), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-remove\"></i>
    Cancel Purchase
</a>
";
        
        $__internal_e5ed74e7d037101e840cd00c068d8946457b1e52a03d77d9a3fc7eda889d4bbb->leave($__internal_e5ed74e7d037101e840cd00c068d8946457b1e52a03d77d9a3fc7eda889d4bbb_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Purchase:cancel_payment_action.html.twig";
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
/* <a href="{{ path('admin_app_bundle_Purchase_cancel', {id: object.id}) }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-remove"></i>*/
/*     Cancel Purchase*/
/* </a>*/
/* */
