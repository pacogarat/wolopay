<?php

/* AppBundle:Sonata/CRUD:list__action_purchases_notification.html.twig */
class __TwigTemplate_3f65bb4dc10438d92626ea2414ac11ffd835aa38cdb4f33f9d8b3479debe4629 extends Twig_Template
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
        $__internal_299c6cf640d94f037f5f80121dd96c6d2eda2aaa2b809322752092669e7db484 = $this->env->getExtension("native_profiler");
        $__internal_299c6cf640d94f037f5f80121dd96c6d2eda2aaa2b809322752092669e7db484->enter($__internal_299c6cf640d94f037f5f80121dd96c6d2eda2aaa2b809322752092669e7db484_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_purchases_notification.html.twig"));

        // line 1
        echo "
<a href=\"";
        // line 2
        echo $this->env->getExtension('routing')->getPath("admin_app_bundle_PurchaseNotification_list");
        echo "?filter[purchases][value]=";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()), "html", null, true);
        echo "\" class=\"btn btn-sm btn-default edit_link\" title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action_edit", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
    <i class=\"glyphicon glyphicon-euro\"></i>
    Purchases
</a>
";
        
        $__internal_299c6cf640d94f037f5f80121dd96c6d2eda2aaa2b809322752092669e7db484->leave($__internal_299c6cf640d94f037f5f80121dd96c6d2eda2aaa2b809322752092669e7db484_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/CRUD:list__action_purchases_notification.html.twig";
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
/* <a href="{{ path('admin_app_bundle_PurchaseNotification_list') }}?filter[purchases][value]={{ object.id }}" class="btn btn-sm btn-default edit_link" title="{{ 'action_edit'|trans({}, 'SonataAdminBundle') }}">*/
/*     <i class="glyphicon glyphicon-euro"></i>*/
/*     Purchases*/
/* </a>*/
/* */
