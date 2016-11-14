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
        $__internal_e5f130a574b653f401266135cd572e8777b20e22d57d9eccc07751a12dc26370 = $this->env->getExtension("native_profiler");
        $__internal_e5f130a574b653f401266135cd572e8777b20e22d57d9eccc07751a12dc26370->enter($__internal_e5f130a574b653f401266135cd572e8777b20e22d57d9eccc07751a12dc26370_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/CRUD:list__action_purchases_notification.html.twig"));

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
        
        $__internal_e5f130a574b653f401266135cd572e8777b20e22d57d9eccc07751a12dc26370->leave($__internal_e5f130a574b653f401266135cd572e8777b20e22d57d9eccc07751a12dc26370_prof);

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
