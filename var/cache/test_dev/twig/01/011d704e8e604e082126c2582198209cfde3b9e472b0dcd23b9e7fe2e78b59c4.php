<?php

/* IbrowsSonataTranslationBundle:CRUD:list.html.twig */
class __TwigTemplate_2038dfb3055560a9b0d41f8f0dc8258952cdbe1b3f69244339ddd7f0b4d025a1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:list.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 1);
        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0ff25511fd1d6e4bc0c9da3abd6223f19ac0f217e5dd24531c3e27f731dd9787 = $this->env->getExtension("native_profiler");
        $__internal_0ff25511fd1d6e4bc0c9da3abd6223f19ac0f217e5dd24531c3e27f731dd9787->enter($__internal_0ff25511fd1d6e4bc0c9da3abd6223f19ac0f217e5dd24531c3e27f731dd9787_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle:CRUD:list.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0ff25511fd1d6e4bc0c9da3abd6223f19ac0f217e5dd24531c3e27f731dd9787->leave($__internal_0ff25511fd1d6e4bc0c9da3abd6223f19ac0f217e5dd24531c3e27f731dd9787_prof);

    }

    // line 3
    public function block_actions($context, array $blocks = array())
    {
        $__internal_dc63d10ff145c2dca1a30c821d03e28f019914ecbfcbfd23f7ec47cab3da5b0f = $this->env->getExtension("native_profiler");
        $__internal_dc63d10ff145c2dca1a30c821d03e28f019914ecbfcbfd23f7ec47cab3da5b0f->enter($__internal_dc63d10ff145c2dca1a30c821d03e28f019914ecbfcbfd23f7ec47cab3da5b0f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <li>";
        $this->loadTemplate("IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 5)->display($context);
        echo "</li>
        ";
        // line 6
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method"))) {
            // line 7
            echo "            <li>";
            $this->loadTemplate("SonataAdminBundle:Core:create_button.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 7)->display($context);
            echo "</li>
        ";
        }
        // line 9
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_dc63d10ff145c2dca1a30c821d03e28f019914ecbfcbfd23f7ec47cab3da5b0f->leave($__internal_dc63d10ff145c2dca1a30c821d03e28f019914ecbfcbfd23f7ec47cab3da5b0f_prof);

    }

    public function getTemplateName()
    {
        return "IbrowsSonataTranslationBundle:CRUD:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  50 => 7,  48 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:list.html.twig' %}*/
/* */
/* {% block actions %}*/
/*     {% spaceless %}*/
/*         <li>{% include 'IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig' %}</li>*/
/*         {% if admin.hasRoute('create') and admin.isGranted('CREATE')%}*/
/*             <li>{% include 'SonataAdminBundle:Core:create_button.html.twig' %}</li>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock %}*/
