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
        $__internal_470c89756bf5aaeb2e09e4a3d2d2fb2a31a82ec50d421ae4d2ebc1a77547f02a = $this->env->getExtension("native_profiler");
        $__internal_470c89756bf5aaeb2e09e4a3d2d2fb2a31a82ec50d421ae4d2ebc1a77547f02a->enter($__internal_470c89756bf5aaeb2e09e4a3d2d2fb2a31a82ec50d421ae4d2ebc1a77547f02a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_edit.html.twig"));

        // line 37
        $context["form_helper"] = $this->loadTemplate("SonataAdminBundle:CRUD:base_edit_form_macro.html.twig", "SonataAdminBundle:CRUD:base_edit.html.twig", 37);
        // line 12
        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_470c89756bf5aaeb2e09e4a3d2d2fb2a31a82ec50d421ae4d2ebc1a77547f02a->leave($__internal_470c89756bf5aaeb2e09e4a3d2d2fb2a31a82ec50d421ae4d2ebc1a77547f02a_prof);

    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        $__internal_a6ca3f2121485439a11a31dd775e45e1f5e85365a17215b6ae4648448e626ce3 = $this->env->getExtension("native_profiler");
        $__internal_a6ca3f2121485439a11a31dd775e45e1f5e85365a17215b6ae4648448e626ce3->enter($__internal_a6ca3f2121485439a11a31dd775e45e1f5e85365a17215b6ae4648448e626ce3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

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
        
        $__internal_a6ca3f2121485439a11a31dd775e45e1f5e85365a17215b6ae4648448e626ce3->leave($__internal_a6ca3f2121485439a11a31dd775e45e1f5e85365a17215b6ae4648448e626ce3_prof);

    }

    // line 22
    public function block_navbar_title($context, array $blocks = array())
    {
        $__internal_5442f5f327fb1089eb52064bea8d04a1fa785e8a29c83348a6bb29e013a13a74 = $this->env->getExtension("native_profiler");
        $__internal_5442f5f327fb1089eb52064bea8d04a1fa785e8a29c83348a6bb29e013a13a74->enter($__internal_5442f5f327fb1089eb52064bea8d04a1fa785e8a29c83348a6bb29e013a13a74_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "navbar_title"));

        // line 23
        echo "    ";
        $this->displayBlock("title", $context, $blocks);
        echo "
";
        
        $__internal_5442f5f327fb1089eb52064bea8d04a1fa785e8a29c83348a6bb29e013a13a74->leave($__internal_5442f5f327fb1089eb52064bea8d04a1fa785e8a29c83348a6bb29e013a13a74_prof);

    }

    // line 26
    public function block_actions($context, array $blocks = array())
    {
        $__internal_82decdffae6230d30d1201985dd54aca4fdba356b0e8e8c52d15f63d36a8e802 = $this->env->getExtension("native_profiler");
        $__internal_82decdffae6230d30d1201985dd54aca4fdba356b0e8e8c52d15f63d36a8e802->enter($__internal_82decdffae6230d30d1201985dd54aca4fdba356b0e8e8c52d15f63d36a8e802_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

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
        
        $__internal_82decdffae6230d30d1201985dd54aca4fdba356b0e8e8c52d15f63d36a8e802->leave($__internal_82decdffae6230d30d1201985dd54aca4fdba356b0e8e8c52d15f63d36a8e802_prof);

    }

    // line 34
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_1f33c514f72e1e20890bd40c928dd6fb4ed8512a07b0da68f52dde4cffeb38b9 = $this->env->getExtension("native_profiler");
        $__internal_1f33c514f72e1e20890bd40c928dd6fb4ed8512a07b0da68f52dde4cffeb38b9->enter($__internal_1f33c514f72e1e20890bd40c928dd6fb4ed8512a07b0da68f52dde4cffeb38b9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
        
        $__internal_1f33c514f72e1e20890bd40c928dd6fb4ed8512a07b0da68f52dde4cffeb38b9->leave($__internal_1f33c514f72e1e20890bd40c928dd6fb4ed8512a07b0da68f52dde4cffeb38b9_prof);

    }

    // line 39
    public function block_form($context, array $blocks = array())
    {
        $__internal_3257fb6b4b1cdc3c13dafc406232a6a43085a70b3f1b705a736cb37da1ad4ab7 = $this->env->getExtension("native_profiler");
        $__internal_3257fb6b4b1cdc3c13dafc406232a6a43085a70b3f1b705a736cb37da1ad4ab7->enter($__internal_3257fb6b4b1cdc3c13dafc406232a6a43085a70b3f1b705a736cb37da1ad4ab7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        // line 40
        echo "    ";
        $this->displayBlock("parentForm", $context, $blocks);
        echo "
";
        
        $__internal_3257fb6b4b1cdc3c13dafc406232a6a43085a70b3f1b705a736cb37da1ad4ab7->leave($__internal_3257fb6b4b1cdc3c13dafc406232a6a43085a70b3f1b705a736cb37da1ad4ab7_prof);

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
