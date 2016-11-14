<?php

/* SonataAdminBundle:CRUD:delete.html.twig */
class __TwigTemplate_d83b8d07a1c019843127e895774c597316dc9742d03614f680753560fbabde81 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:delete.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_26ebb64ee83b059bd74c9cc1d58187cd9783726beed0206e7699984c50e77d57 = $this->env->getExtension("native_profiler");
        $__internal_26ebb64ee83b059bd74c9cc1d58187cd9783726beed0206e7699984c50e77d57->enter($__internal_26ebb64ee83b059bd74c9cc1d58187cd9783726beed0206e7699984c50e77d57_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:delete.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_26ebb64ee83b059bd74c9cc1d58187cd9783726beed0206e7699984c50e77d57->leave($__internal_26ebb64ee83b059bd74c9cc1d58187cd9783726beed0206e7699984c50e77d57_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_6de7e96b3f593cd9c63daa26c80a58508ca2e20ca39905afd8cb37ab8e0a873b = $this->env->getExtension("native_profiler");
        $__internal_6de7e96b3f593cd9c63daa26c80a58508ca2e20ca39905afd8cb37ab8e0a873b->enter($__internal_6de7e96b3f593cd9c63daa26c80a58508ca2e20ca39905afd8cb37ab8e0a873b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:delete.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig", "SonataAdminBundle:CRUD:delete.html.twig", 16)->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:delete.html.twig", 17)->display($context);
        echo "</li>
";
        
        $__internal_6de7e96b3f593cd9c63daa26c80a58508ca2e20ca39905afd8cb37ab8e0a873b->leave($__internal_6de7e96b3f593cd9c63daa26c80a58508ca2e20ca39905afd8cb37ab8e0a873b_prof);

    }

    // line 20
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_d0e5454d224e4d3ac83d5d782e87b9b189e1e7107bfb7329cbbbdf2bd6f8bf9f = $this->env->getExtension("native_profiler");
        $__internal_d0e5454d224e4d3ac83d5d782e87b9b189e1e7107bfb7329cbbbdf2bd6f8bf9f->enter($__internal_d0e5454d224e4d3ac83d5d782e87b9b189e1e7107bfb7329cbbbdf2bd6f8bf9f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
        
        $__internal_d0e5454d224e4d3ac83d5d782e87b9b189e1e7107bfb7329cbbbdf2bd6f8bf9f->leave($__internal_d0e5454d224e4d3ac83d5d782e87b9b189e1e7107bfb7329cbbbdf2bd6f8bf9f_prof);

    }

    // line 22
    public function block_content($context, array $blocks = array())
    {
        $__internal_4597f02dac4cc4cb4abf7b4f1ff99ba0ca49b6ed090fc0c66415efdd0fdd55bb = $this->env->getExtension("native_profiler");
        $__internal_4597f02dac4cc4cb4abf7b4f1ff99ba0ca49b6ed090fc0c66415efdd0fdd55bb->enter($__internal_4597f02dac4cc4cb4abf7b4f1ff99ba0ca49b6ed090fc0c66415efdd0fdd55bb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 23
        echo "    <div class=\"sonata-ba-delete\">

        <div class=\"box box-danger\">
            <div class=\"box-header\">
                <h3 class=\"box-title\">";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_delete", array(), "SonataAdminBundle"), "html", null, true);
        echo "</h3>
            </div>
            <div class=\"box-body\">
                ";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_delete_confirmation", array("%object%" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "toString", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")), "SonataAdminBundle"), "html", null, true);
        echo "
            </div>
            <div class=\"box-footer clearfix\">
                <form method=\"POST\" action=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "delete", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\">
                    <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                    <input type=\"hidden\" name=\"_sonata_csrf_token\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\">

                    <button type=\"submit\" class=\"btn btn-danger\"><i class=\"glyphicon glyphicon-trash\"></i> ";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_delete", array(), "SonataAdminBundle"), "html", null, true);
        echo "</button>
                    ";
        // line 38
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "edit"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
            // line 39
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
            echo "

                        <a class=\"btn btn-success\" href=\"";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "edit", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
            echo "\">
                            <i class=\"glyphicon glyphicon-edit\"></i>
                            ";
            // line 43
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_edit", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a>
                    ";
        }
        // line 45
        echo "                </form>
            </div>
        </div>
    </div>
";
        
        $__internal_4597f02dac4cc4cb4abf7b4f1ff99ba0ca49b6ed090fc0c66415efdd0fdd55bb->leave($__internal_4597f02dac4cc4cb4abf7b4f1ff99ba0ca49b6ed090fc0c66415efdd0fdd55bb_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:delete.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 45,  122 => 43,  117 => 41,  111 => 39,  109 => 38,  105 => 37,  100 => 35,  95 => 33,  89 => 30,  83 => 27,  77 => 23,  71 => 22,  59 => 20,  50 => 17,  46 => 16,  41 => 15,  35 => 14,  20 => 12,);
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
/* {% block actions %}*/
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:edit_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:create_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block tab_menu %}{{ knp_menu_render(admin.sidemenu(action), {'currentClass' : 'active', 'template': admin_pool.getTemplate('tab_menu_template')}, 'twig') }}{% endblock %}*/
/* */
/* {% block content %}*/
/*     <div class="sonata-ba-delete">*/
/* */
/*         <div class="box box-danger">*/
/*             <div class="box-header">*/
/*                 <h3 class="box-title">{{ 'title_delete'|trans({}, 'SonataAdminBundle') }}</h3>*/
/*             </div>*/
/*             <div class="box-body">*/
/*                 {{ 'message_delete_confirmation'|trans({'%object%': admin.toString(object)}, 'SonataAdminBundle') }}*/
/*             </div>*/
/*             <div class="box-footer clearfix">*/
/*                 <form method="POST" action="{{ admin.generateObjectUrl('delete', object) }}">*/
/*                     <input type="hidden" name="_method" value="DELETE">*/
/*                     <input type="hidden" name="_sonata_csrf_token" value="{{ csrf_token }}">*/
/* */
/*                     <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> {{ 'btn_delete'|trans({}, 'SonataAdminBundle') }}</button>*/
/*                     {% if admin.hasRoute('edit') and admin.isGranted('EDIT', object) %}*/
/*                         {{ 'delete_or'|trans({}, 'SonataAdminBundle') }}*/
/* */
/*                         <a class="btn btn-success" href="{{ admin.generateObjectUrl('edit', object) }}">*/
/*                             <i class="glyphicon glyphicon-edit"></i>*/
/*                             {{ 'link_action_edit'|trans({}, 'SonataAdminBundle') }}</a>*/
/*                     {% endif %}*/
/*                 </form>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
