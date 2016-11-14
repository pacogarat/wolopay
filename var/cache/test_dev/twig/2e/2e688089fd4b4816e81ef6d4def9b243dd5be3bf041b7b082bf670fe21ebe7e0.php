<?php

/* AppBundle:Sonata/CRUD:list__action_purchases.html.twig */
class __TwigTemplate_be450ad4689bf1958e026a4cd1b8925d6d19cfac9ce8bb32472460f9448ff9db extends Twig_Template
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
        $__internal_98fee8ea45095f65fed5307f8794c1f25faacfac1d8baf8dff992ce3cfc512b5 = $this->env->getExtension("native_profiler");
        $__internal_98fee8ea45095f65fed5307f8794c1f25faacfac1d8baf8dff992ce3cfc512b5->enter($__internal_98fee8ea45095f65fed5307f8794c1f25faacfac1d8baf8dff992ce3cfc512b5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_purchases.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo $this->env->getExtension('routing')->getPath("admin_app_bundle_Purchase_list");
        echo "?filter[transaction][value]=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-euro\"></i>
    Purchases
</a>
";
        
        $__internal_98fee8ea45095f65fed5307f8794c1f25faacfac1d8baf8dff992ce3cfc512b5->leave($__internal_98fee8ea45095f65fed5307f8794c1f25faacfac1d8baf8dff992ce3cfc512b5_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/CRUD:list__action_purchases.html.twig";
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
/* <a href="{{ path('admin_app_bundle_Purchase_list') }}?filter[transaction][value]={{ object.id }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-euro"></i>*/
/*     Purchases*/
/* </a>*/
/* */
