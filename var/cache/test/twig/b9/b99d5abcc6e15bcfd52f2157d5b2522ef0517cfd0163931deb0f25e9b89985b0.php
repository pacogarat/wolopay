<?php

/* SonataAdminBundle:CRUD:base_edit.html.twig */
class __TwigTemplate_fac746deb12520371c63494345f3c6ea4785f8a1e8406775c2a978f0128da7c1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $_trait_0 = $this->loadTemplate("SonataAdminBundle:CRUD:base_edit_form.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 36);
        // line 36
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."SonataAdminBundle:CRUD:base_edit_form.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        if (!isset($_trait_0_blocks["form"])) {
            throw new Twig_Error_Runtime(sprintf('Block "form" is not defined in trait "SonataAdminBundle:CRUD:base_edit_form.html.twig".'));
        }

        $_trait_0_blocks["parentForm"] = $_trait_0_blocks["form"]; unset($_trait_0_blocks["form"]);

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
                'navbar_title' => array($this, 'block_navbar_title'),
                'actions' => array($this, 'block_actions'),
                'tab_menu' => array($this, 'block_tab_menu'),
                'form' => array($this, 'block_form'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:base_edit.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_745415259e36d33d0516f11d24899992270d54120f5bbd1526129190a1b1d1be = $this->env->getExtension("native_profiler");
        $__internal_745415259e36d33d0516f11d24899992270d54120f5bbd1526129190a1b1d1be->enter($__internal_745415259e36d33d0516f11d24899992270d54120f5bbd1526129190a1b1d1be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_edit.html.twig"));

        // line 37
        $context["form_helper"] = $this->loadTemplate("SonataAdminBundle:CRUD:base_edit_form_macro.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 37);
        // line 12
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_745415259e36d33d0516f11d24899992270d54120f5bbd1526129190a1b1d1be->leave($__internal_745415259e36d33d0516f11d24899992270d54120f5bbd1526129190a1b1d1be_prof);

    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        $__internal_b913b8d5fe5e10cdc32a573ef07049342e7d2acc763ad6fc01ee047d92650c5b = $this->env->getExtension("native_profiler");
        $__internal_b913b8d5fe5e10cdc32a573ef07049342e7d2acc763ad6fc01ee047d92650c5b->enter($__internal_b913b8d5fe5e10cdc32a573ef07049342e7d2acc763ad6fc01ee047d92650c5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 15
        echo "    ";
        if ( !(null === $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
            // line 16
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_edit", array("%name%" => twig_truncate_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "toString", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), 15)), "SonataAdminBundle"), "html", null, true);
            echo "
    ";
        } else {
            // line 18
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_create", array(), "SonataAdminBundle"), "html", null, true);
            echo "
    ";
        }
        
        $__internal_b913b8d5fe5e10cdc32a573ef07049342e7d2acc763ad6fc01ee047d92650c5b->leave($__internal_b913b8d5fe5e10cdc32a573ef07049342e7d2acc763ad6fc01ee047d92650c5b_prof);

    }

    // line 22
    public function block_navbar_title($context, array $blocks = array())
    {
        $__internal_3845f171ecdec1227fbc05f8b8d2f22bb5654cc85c9188aa794f8a90f3ae5b07 = $this->env->getExtension("native_profiler");
        $__internal_3845f171ecdec1227fbc05f8b8d2f22bb5654cc85c9188aa794f8a90f3ae5b07->enter($__internal_3845f171ecdec1227fbc05f8b8d2f22bb5654cc85c9188aa794f8a90f3ae5b07_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "navbar_title"));

        // line 23
        echo "    ";
        $this->displayBlock("title", $context, $blocks);
        echo "
";
        
        $__internal_3845f171ecdec1227fbc05f8b8d2f22bb5654cc85c9188aa794f8a90f3ae5b07->leave($__internal_3845f171ecdec1227fbc05f8b8d2f22bb5654cc85c9188aa794f8a90f3ae5b07_prof);

    }

    // line 26
    public function block_actions($context, array $blocks = array())
    {
        $__internal_3f5ff1eaca98d8c0efc5d65cc9a9c2da64f3ad71cc4e8c749e59cd9a57802962 = $this->env->getExtension("native_profiler");
        $__internal_3f5ff1eaca98d8c0efc5d65cc9a9c2da64f3ad71cc4e8c749e59cd9a57802962->enter($__internal_3f5ff1eaca98d8c0efc5d65cc9a9c2da64f3ad71cc4e8c749e59cd9a57802962_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 27
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:show_button.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 27)->display($context);
        echo "</li>
    <li>";
        // line 28
        $this->loadTemplate("SonataAdminBundle:Button:history_button.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 28)->display($context);
        echo "</li>
    <li>";
        // line 29
        $this->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 29)->display($context);
        echo "</li>
    <li>";
        // line 30
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 30)->display($context);
        echo "</li>
    <li>";
        // line 31
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 31)->display($context);
        echo "</li>
";
        
        $__internal_3f5ff1eaca98d8c0efc5d65cc9a9c2da64f3ad71cc4e8c749e59cd9a57802962->leave($__internal_3f5ff1eaca98d8c0efc5d65cc9a9c2da64f3ad71cc4e8c749e59cd9a57802962_prof);

    }

    // line 34
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_b0fb4929b212ee087ef9e1c602d9e12cf242935652ec3c4d96652a06d25f0f89 = $this->env->getExtension("native_profiler");
        $__internal_b0fb4929b212ee087ef9e1c602d9e12cf242935652ec3c4d96652a06d25f0f89->enter($__internal_b0fb4929b212ee087ef9e1c602d9e12cf242935652ec3c4d96652a06d25f0f89_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
        
        $__internal_b0fb4929b212ee087ef9e1c602d9e12cf242935652ec3c4d96652a06d25f0f89->leave($__internal_b0fb4929b212ee087ef9e1c602d9e12cf242935652ec3c4d96652a06d25f0f89_prof);

    }

    // line 39
    public function block_form($context, array $blocks = array())
    {
        $__internal_96be20999f7f4297f1b6fac4c074fc7df158d487db1f1bbfe32fbb4b171477f0 = $this->env->getExtension("native_profiler");
        $__internal_96be20999f7f4297f1b6fac4c074fc7df158d487db1f1bbfe32fbb4b171477f0->enter($__internal_96be20999f7f4297f1b6fac4c074fc7df158d487db1f1bbfe32fbb4b171477f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        // line 40
        echo "    ";
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
";
        
        $__internal_96be20999f7f4297f1b6fac4c074fc7df158d487db1f1bbfe32fbb4b171477f0->leave($__internal_96be20999f7f4297f1b6fac4c074fc7df158d487db1f1bbfe32fbb4b171477f0_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  150 => 40,  144 => 39,  132 => 34,  123 => 31,  119 => 30,  115 => 29,  111 => 28,  106 => 27,  100 => 26,  90 => 23,  84 => 22,  73 => 18,  67 => 16,  64 => 15,  58 => 14,  51 => 12,  49 => 37,  40 => 12,  12 => 36,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends base_template %}*/
/* */
/* {% block title %}*/
/*     {% if admin.id(object) is not null %}*/
/*         {{ "title_edit"|trans({'%name%': admin.toString(object)|truncate(15) }, 'SonataAdminBundle') }}*/
/*     {% else %}*/
/*         {{ "title_create"|trans({}, 'SonataAdminBundle') }}*/
/*     {% endif %}*/
/* {% endblock%}*/
/* */
/* {% block navbar_title %}*/
/*     {{ block('title') }}*/
/* {% endblock %}*/
/* */
/* {% block actions %}*/
/*     <li>{% include 'SonataAdminBundle:Button:show_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:history_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:acl_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:create_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block tab_menu %}{{ knp_menu_render(admin.sidemenu(action), {'currentClass' : 'active', 'template': admin_pool.getTemplate('tab_menu_template')}, 'twig') }}{% endblock %}*/
/* */
/* {% use 'SonataAdminBundle:CRUD:base_edit_form.html.twig' with form as parentForm %}*/
/* {% import "SonataAdminBundle:CRUD:base_edit_form_macro.html.twig" as form_helper %}*/
/* */
/* {% block form %}*/
/*     {{ block('parentForm') }}*/
/* {% endblock %}*/
/* */
