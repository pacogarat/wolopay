<?php

/* SonataAdminBundle:CRUD:base_acl.html.twig */
class __TwigTemplate_a2b024ada65e9c55b212ca7f699b8bcb9bdaeebde1aac4fa66326b4bee9a59e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'form' => array($this, 'block_form'),
            'formactions' => array($this, 'block_formactions'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:base_acl.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9bdde0b98480c157afe6778b11f9406925e80a1198a62c17a4bec80685db7adf = $this->env->getExtension("native_profiler");
        $__internal_9bdde0b98480c157afe6778b11f9406925e80a1198a62c17a4bec80685db7adf->enter($__internal_9bdde0b98480c157afe6778b11f9406925e80a1198a62c17a4bec80685db7adf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_acl.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9bdde0b98480c157afe6778b11f9406925e80a1198a62c17a4bec80685db7adf->leave($__internal_9bdde0b98480c157afe6778b11f9406925e80a1198a62c17a4bec80685db7adf_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_c9f1a8eb270965a8bc8c6f158e6e8851448211b20f509a6ef0aafc18bc48887e = $this->env->getExtension("native_profiler");
        $__internal_c9f1a8eb270965a8bc8c6f158e6e8851448211b20f509a6ef0aafc18bc48887e->enter($__internal_c9f1a8eb270965a8bc8c6f158e6e8851448211b20f509a6ef0aafc18bc48887e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig", "SonataAdminBundle:CRUD:base_acl.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:history_button.html.twig", "SonataAdminBundle:CRUD:base_acl.html.twig", 16)->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->loadTemplate("SonataAdminBundle:Button:show_button.html.twig", "SonataAdminBundle:CRUD:base_acl.html.twig", 17)->display($context);
        echo "</li>
    <li>";
        // line 18
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:base_acl.html.twig", 18)->display($context);
        echo "</li>
";
        
        $__internal_c9f1a8eb270965a8bc8c6f158e6e8851448211b20f509a6ef0aafc18bc48887e->leave($__internal_c9f1a8eb270965a8bc8c6f158e6e8851448211b20f509a6ef0aafc18bc48887e_prof);

    }

    // line 21
    public function block_form($context, array $blocks = array())
    {
        $__internal_f2f0b6d2bde77b4f39b658faa73ffdfe4f6f5b09da1c414dc2cf98c5f598aa96 = $this->env->getExtension("native_profiler");
        $__internal_f2f0b6d2bde77b4f39b658faa73ffdfe4f6f5b09da1c414dc2cf98c5f598aa96->enter($__internal_f2f0b6d2bde77b4f39b658faa73ffdfe4f6f5b09da1c414dc2cf98c5f598aa96_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        // line 22
        echo "    <form class=\"form-horizontal\"
              action=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "acl", 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "uniqid", array()), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo "
              method=\"POST\"
              ";
        // line 25
        if ( !$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getOption", array(0 => "html5_validate"), "method")) {
            echo "novalidate=\"novalidate\"";
        }
        // line 26
        echo "              >
        ";
        // line 27
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
            // line 28
            echo "            <div class=\"sonata-ba-form-error\">
                ";
            // line 29
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
            </div>
        ";
        }
        // line 32
        echo "
        <table class=\"table\">
            <thead>
                <tr>
                    <th>";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_username", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    ";
        // line 37
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : $this->getContext($context, "permissions")));
        foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
            // line 38
            echo "                    <th>";
            echo twig_escape_filter($this->env, $context["permission"], "html", null, true);
            echo "</th>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "                </tr>
            </thead>
            <tbody>
            ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["users"]) ? $context["users"] : $this->getContext($context, "users")));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 44
            echo "                <tr>
                    <td>";
            // line 45
            echo twig_escape_filter($this->env, $context["user"], "html", null, true);
            echo "</td>
                    ";
            // line 46
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : $this->getContext($context, "permissions")));
            foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                // line 47
                echo "                    <td>";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), ($this->getAttribute($context["user"], "id", array()) . $context["permission"]), array(), "array"), 'widget');
                echo "</td>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "            </tbody>
        </table>

        ";
        // line 54
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

        ";
        // line 56
        $this->displayBlock('formactions', $context, $blocks);
        // line 61
        echo "    </form>
";
        
        $__internal_f2f0b6d2bde77b4f39b658faa73ffdfe4f6f5b09da1c414dc2cf98c5f598aa96->leave($__internal_f2f0b6d2bde77b4f39b658faa73ffdfe4f6f5b09da1c414dc2cf98c5f598aa96_prof);

    }

    // line 56
    public function block_formactions($context, array $blocks = array())
    {
        $__internal_f82efa61cf57c57a110db464f22b85d47e12ca1e61305c1775f3ef2701c02f18 = $this->env->getExtension("native_profiler");
        $__internal_f82efa61cf57c57a110db464f22b85d47e12ca1e61305c1775f3ef2701c02f18->enter($__internal_f82efa61cf57c57a110db464f22b85d47e12ca1e61305c1775f3ef2701c02f18_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "formactions"));

        // line 57
        echo "            <div class=\"well well-small form-actions\">
                <input class=\"btn btn-primary\" type=\"submit\" name=\"btn_create_and_edit\" value=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_acl", array(), "SonataAdminBundle"), "html", null, true);
        echo "\">
            </div>
        ";
        
        $__internal_f82efa61cf57c57a110db464f22b85d47e12ca1e61305c1775f3ef2701c02f18->leave($__internal_f82efa61cf57c57a110db464f22b85d47e12ca1e61305c1775f3ef2701c02f18_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_acl.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  185 => 58,  182 => 57,  176 => 56,  168 => 61,  166 => 56,  161 => 54,  156 => 51,  149 => 49,  140 => 47,  136 => 46,  132 => 45,  129 => 44,  125 => 43,  120 => 40,  111 => 38,  107 => 37,  103 => 36,  97 => 32,  91 => 29,  88 => 28,  86 => 27,  83 => 26,  79 => 25,  72 => 23,  69 => 22,  63 => 21,  54 => 18,  50 => 17,  46 => 16,  41 => 15,  35 => 14,  20 => 12,);
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
/*     <li>{% include 'SonataAdminBundle:Button:edit_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:history_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:show_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block form %}*/
/*     <form class="form-horizontal"*/
/*               action="{{ admin.generateUrl('acl', {'id': admin.id(object), 'uniqid': admin.uniqid, 'subclass': app.request.get('subclass')}) }}" {{ form_enctype(form) }}*/
/*               method="POST"*/
/*               {% if not admin_pool.getOption('html5_validate') %}novalidate="novalidate"{% endif %}*/
/*               >*/
/*         {% if form.vars.errors|length > 0 %}*/
/*             <div class="sonata-ba-form-error">*/
/*                 {{ form_errors(form) }}*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         <table class="table">*/
/*             <thead>*/
/*                 <tr>*/
/*                     <th>{{ "td_username"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                     {% for permission in permissions %}*/
/*                     <th>{{ permission }}</th>*/
/*                     {% endfor %}*/
/*                 </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for user in users %}*/
/*                 <tr>*/
/*                     <td>{{ user }}</td>*/
/*                     {% for permission in permissions %}*/
/*                     <td>{{ form_widget(form[user.id ~ permission]) }}</td>*/
/*                     {% endfor %}*/
/*                 </tr>*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/* */
/*         {{ form_rest(form) }}*/
/* */
/*         {% block formactions %}*/
/*             <div class="well well-small form-actions">*/
/*                 <input class="btn btn-primary" type="submit" name="btn_create_and_edit" value="{{ 'btn_update_acl'|trans({}, 'SonataAdminBundle') }}">*/
/*             </div>*/
/*         {% endblock formactions %}*/
/*     </form>*/
/* {% endblock %}*/
/* */
