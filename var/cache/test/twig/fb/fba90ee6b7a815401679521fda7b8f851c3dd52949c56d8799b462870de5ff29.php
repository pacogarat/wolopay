<?php

/* SonataAdminBundle:CRUD:batch_confirmation.html.twig */
class __TwigTemplate_b489a8392df95b2bdd342d9bbd056567223d6b21b3168ebbd5fa77e61788301c extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:batch_confirmation.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_22a1dacf01f08dfa93fdbd90f2143085c5c352ff3cc72b1523ab540d08ce5df4 = $this->env->getExtension("native_profiler");
        $__internal_22a1dacf01f08dfa93fdbd90f2143085c5c352ff3cc72b1523ab540d08ce5df4->enter($__internal_22a1dacf01f08dfa93fdbd90f2143085c5c352ff3cc72b1523ab540d08ce5df4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:batch_confirmation.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_22a1dacf01f08dfa93fdbd90f2143085c5c352ff3cc72b1523ab540d08ce5df4->leave($__internal_22a1dacf01f08dfa93fdbd90f2143085c5c352ff3cc72b1523ab540d08ce5df4_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_ae8a26624a520363049e94f3b94b2b52d7eda6e2fc9d28c045014bf11ca1af09 = $this->env->getExtension("native_profiler");
        $__internal_ae8a26624a520363049e94f3b94b2b52d7eda6e2fc9d28c045014bf11ca1af09->enter($__internal_ae8a26624a520363049e94f3b94b2b52d7eda6e2fc9d28c045014bf11ca1af09_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:batch_confirmation.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:batch_confirmation.html.twig", 16)->display($context);
        echo "</li>
";
        
        $__internal_ae8a26624a520363049e94f3b94b2b52d7eda6e2fc9d28c045014bf11ca1af09->leave($__internal_ae8a26624a520363049e94f3b94b2b52d7eda6e2fc9d28c045014bf11ca1af09_prof);

    }

    // line 19
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_3f4c5b8124f7d8298705bf848e792c9df21310f8c40834c303ac5ba8b21acdfd = $this->env->getExtension("native_profiler");
        $__internal_3f4c5b8124f7d8298705bf848e792c9df21310f8c40834c303ac5ba8b21acdfd->enter($__internal_3f4c5b8124f7d8298705bf848e792c9df21310f8c40834c303ac5ba8b21acdfd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
        
        $__internal_3f4c5b8124f7d8298705bf848e792c9df21310f8c40834c303ac5ba8b21acdfd->leave($__internal_3f4c5b8124f7d8298705bf848e792c9df21310f8c40834c303ac5ba8b21acdfd_prof);

    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        $__internal_b055c99240d4016929612d421b5fbd9c4dbbe529ff5e7012d93ee7178b623367 = $this->env->getExtension("native_profiler");
        $__internal_b055c99240d4016929612d421b5fbd9c4dbbe529ff5e7012d93ee7178b623367->enter($__internal_b055c99240d4016929612d421b5fbd9c4dbbe529ff5e7012d93ee7178b623367_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 22
        echo "    <div class=\"sonata-ba-delete\">
        <h1>";
        // line 23
        echo $this->env->getExtension('translator')->getTranslator()->trans("title_batch_confirmation", array("%action%" => (isset($context["action_label"]) ? $context["action_label"] : $this->getContext($context, "action_label"))), "SonataAdminBundle");
        echo "</h1>

        ";
        // line 25
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "all_elements", array())) {
            // line 26
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("message_batch_all_confirmation", array(), "SonataAdminBundle"), "html", null, true);
            echo "
        ";
        } else {
            // line 28
            echo "            ";
            echo $this->env->getExtension('translator')->getTranslator()->transChoice("message_batch_confirmation", twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "idx", array())), array("%count%" => twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "idx", array()))), "SonataAdminBundle");
            // line 29
            echo "        ";
        }
        // line 30
        echo "
        <div class=\"well well-small form-actions\">
            <form action=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "batch", 1 => array("filter" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "filterParameters", array()))), "method"), "html", null, true);
        echo "\" method=\"POST\" >
                <input type=\"hidden\" name=\"confirmation\" value=\"ok\">
                <input type=\"hidden\" name=\"data\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, twig_jsonencode_filter((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data"))), "html", null, true);
        echo "\">
                <input type=\"hidden\" name=\"_sonata_csrf_token\" value=\"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\">

                <div style=\"display: none\">
                    ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
                </div>

                <button type=\"submit\" class=\"btn btn-danger\">";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_execute_batch_action", array(), "SonataAdminBundle"), "html", null, true);
        echo "</button>

                ";
        // line 43
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "list"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "LIST"), "method"))) {
            // line 44
            echo "                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("delete_or", array(), "SonataAdminBundle"), "html", null, true);
            echo "

                    <a class=\"btn btn-success\" href=\"";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
            echo "\">
                        <i class=\"glyphicon glyphicon-th-list\"></i> ";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("link_action_list", array(), "SonataAdminBundle"), "html", null, true);
            echo "
                    </a>
                ";
        }
        // line 50
        echo "            </form>
        </div>
    </div>
";
        
        $__internal_b055c99240d4016929612d421b5fbd9c4dbbe529ff5e7012d93ee7178b623367->leave($__internal_b055c99240d4016929612d421b5fbd9c4dbbe529ff5e7012d93ee7178b623367_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:batch_confirmation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 50,  137 => 47,  133 => 46,  127 => 44,  125 => 43,  120 => 41,  114 => 38,  108 => 35,  104 => 34,  99 => 32,  95 => 30,  92 => 29,  89 => 28,  83 => 26,  81 => 25,  76 => 23,  73 => 22,  67 => 21,  55 => 19,  46 => 16,  41 => 15,  35 => 14,  20 => 12,);
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
/*     <li>{% include 'SonataAdminBundle:Button:create_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block tab_menu %}{{ knp_menu_render(admin.sidemenu(action), {'currentClass' : 'active', 'template': admin_pool.getTemplate('tab_menu_template')}, 'twig') }}{% endblock %}*/
/* */
/* {% block content %}*/
/*     <div class="sonata-ba-delete">*/
/*         <h1>{% trans with {'%action%': action_label} from 'SonataAdminBundle' %}title_batch_confirmation{% endtrans %}</h1>*/
/* */
/*         {% if data.all_elements %}*/
/*             {{ 'message_batch_all_confirmation'|trans({}, 'SonataAdminBundle') }}*/
/*         {% else %}*/
/*             {% transchoice data.idx|length with {'%count%': data.idx|length} from 'SonataAdminBundle' %}message_batch_confirmation{% endtranschoice %}*/
/*         {% endif %}*/
/* */
/*         <div class="well well-small form-actions">*/
/*             <form action="{{ admin.generateUrl('batch', {'filter': admin.filterParameters}) }}" method="POST" >*/
/*                 <input type="hidden" name="confirmation" value="ok">*/
/*                 <input type="hidden" name="data" value="{{ data|json_encode }}">*/
/*                 <input type="hidden" name="_sonata_csrf_token" value="{{ csrf_token }}">*/
/* */
/*                 <div style="display: none">*/
/*                     {{ form_rest(form) }}*/
/*                 </div>*/
/* */
/*                 <button type="submit" class="btn btn-danger">{{ 'btn_execute_batch_action'|trans({}, 'SonataAdminBundle') }}</button>*/
/* */
/*                 {% if admin.hasRoute('list') and admin.isGranted('LIST') %}*/
/*                     {{ 'delete_or'|trans({}, 'SonataAdminBundle') }}*/
/* */
/*                     <a class="btn btn-success" href="{{ admin.generateUrl('list') }}">*/
/*                         <i class="glyphicon glyphicon-th-list"></i> {{ 'link_action_list'|trans({}, 'SonataAdminBundle') }}*/
/*                     </a>*/
/*                 {% endif %}*/
/*             </form>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
