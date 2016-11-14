<?php

/* SonataAdminBundle:CRUD:base_show.html.twig */
class __TwigTemplate_876805d54ea94ac433b714af6c1563d311ae04d1da44a8f048a67297f39ac27d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'show' => array($this, 'block_show'),
            'show_title' => array($this, 'block_show_title'),
            'show_field' => array($this, 'block_show_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:base_show.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_898e7c830e4fb0b4e0751e42f923cde37d9b816c63119c154560e19c89df5de6 = $this->env->getExtension("native_profiler");
        $__internal_898e7c830e4fb0b4e0751e42f923cde37d9b816c63119c154560e19c89df5de6->enter($__internal_898e7c830e4fb0b4e0751e42f923cde37d9b816c63119c154560e19c89df5de6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_show.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_898e7c830e4fb0b4e0751e42f923cde37d9b816c63119c154560e19c89df5de6->leave($__internal_898e7c830e4fb0b4e0751e42f923cde37d9b816c63119c154560e19c89df5de6_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_4f8b7abb45f5ac8a3fd4cee39205bb70715853cc2543e30fa2c9cbc603dcf338 = $this->env->getExtension("native_profiler");
        $__internal_4f8b7abb45f5ac8a3fd4cee39205bb70715853cc2543e30fa2c9cbc603dcf338->enter($__internal_4f8b7abb45f5ac8a3fd4cee39205bb70715853cc2543e30fa2c9cbc603dcf338_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig", "SonataAdminBundle:CRUD:base_show.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:history_button.html.twig", "SonataAdminBundle:CRUD:base_show.html.twig", 16)->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:base_show.html.twig", 17)->display($context);
        echo "</li>
    <li>";
        // line 18
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:base_show.html.twig", 18)->display($context);
        echo "</li>
";
        
        $__internal_4f8b7abb45f5ac8a3fd4cee39205bb70715853cc2543e30fa2c9cbc603dcf338->leave($__internal_4f8b7abb45f5ac8a3fd4cee39205bb70715853cc2543e30fa2c9cbc603dcf338_prof);

    }

    // line 21
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_e6449920673d8057f275e03004363b0f1b492e331c82d143294ea609cc1a6f20 = $this->env->getExtension("native_profiler");
        $__internal_e6449920673d8057f275e03004363b0f1b492e331c82d143294ea609cc1a6f20->enter($__internal_e6449920673d8057f275e03004363b0f1b492e331c82d143294ea609cc1a6f20_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
        
        $__internal_e6449920673d8057f275e03004363b0f1b492e331c82d143294ea609cc1a6f20->leave($__internal_e6449920673d8057f275e03004363b0f1b492e331c82d143294ea609cc1a6f20_prof);

    }

    // line 23
    public function block_show($context, array $blocks = array())
    {
        $__internal_3cda1637c9b12369d4cf5df70771d1a0ebad16e000c20404f356c638fb2faab3 = $this->env->getExtension("native_profiler");
        $__internal_3cda1637c9b12369d4cf5df70771d1a0ebad16e000c20404f356c638fb2faab3->enter($__internal_3cda1637c9b12369d4cf5df70771d1a0ebad16e000c20404f356c638fb2faab3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "show"));

        // line 24
        echo "    <div class=\"sonata-ba-view\">

        ";
        // line 26
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.show.top", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

        ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "showgroups", array()));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["name"] => $context["view_group"]) {
            // line 29
            echo "            <table class=\"table table-bordered\">
                ";
            // line 30
            if ($context["name"]) {
                // line 31
                echo "                    <thead>
                        ";
                // line 32
                $this->displayBlock('show_title', $context, $blocks);
                // line 39
                echo "                    </thead>
                ";
            }
            // line 41
            echo "
                <tbody>
                    ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["view_group"], "fields", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["field_name"]) {
                // line 44
                echo "                        ";
                $this->displayBlock('show_field', $context, $blocks);
                // line 51
                echo "                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_name'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 52
            echo "                </tbody>
            </table>
        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['view_group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 55
        echo "
        ";
        // line 56
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.show.bottom", array("admin" => (isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "object" => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")))));
        echo "

    </div>
";
        
        $__internal_3cda1637c9b12369d4cf5df70771d1a0ebad16e000c20404f356c638fb2faab3->leave($__internal_3cda1637c9b12369d4cf5df70771d1a0ebad16e000c20404f356c638fb2faab3_prof);

    }

    // line 32
    public function block_show_title($context, array $blocks = array())
    {
        $__internal_727c7603b24671cbc5764c7aaad07445390692679d7522861e53b7c9826c89ac = $this->env->getExtension("native_profiler");
        $__internal_727c7603b24671cbc5764c7aaad07445390692679d7522861e53b7c9826c89ac->enter($__internal_727c7603b24671cbc5764c7aaad07445390692679d7522861e53b7c9826c89ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "show_title"));

        // line 33
        echo "                            <tr class=\"sonata-ba-view-title\">
                                <th colspan=\"2\">
                                    ";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => (isset($context["name"]) ? $context["name"] : $this->getContext($context, "name"))), "method"), "html", null, true);
        echo "
                                </th>
                            </tr>
                        ";
        
        $__internal_727c7603b24671cbc5764c7aaad07445390692679d7522861e53b7c9826c89ac->leave($__internal_727c7603b24671cbc5764c7aaad07445390692679d7522861e53b7c9826c89ac_prof);

    }

    // line 44
    public function block_show_field($context, array $blocks = array())
    {
        $__internal_fe5966b20858379eb75c9d42c65f115020cdd66bbbad26e99ee4b19aebc3612b = $this->env->getExtension("native_profiler");
        $__internal_fe5966b20858379eb75c9d42c65f115020cdd66bbbad26e99ee4b19aebc3612b->enter($__internal_fe5966b20858379eb75c9d42c65f115020cdd66bbbad26e99ee4b19aebc3612b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "show_field"));

        // line 45
        echo "                            <tr class=\"sonata-ba-view-container\">
                                ";
        // line 46
        if ($this->getAttribute((isset($context["elements"]) ? $context["elements"] : null), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array", true, true)) {
            // line 47
            echo "                                    ";
            echo $this->env->getExtension('sonata_admin')->renderViewElement($this->env, $this->getAttribute((isset($context["elements"]) ? $context["elements"] : $this->getContext($context, "elements")), (isset($context["field_name"]) ? $context["field_name"] : $this->getContext($context, "field_name")), array(), "array"), (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")));
            echo "
                                ";
        }
        // line 49
        echo "                            </tr>
                        ";
        
        $__internal_fe5966b20858379eb75c9d42c65f115020cdd66bbbad26e99ee4b19aebc3612b->leave($__internal_fe5966b20858379eb75c9d42c65f115020cdd66bbbad26e99ee4b19aebc3612b_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  229 => 49,  223 => 47,  221 => 46,  218 => 45,  212 => 44,  201 => 35,  197 => 33,  191 => 32,  180 => 56,  177 => 55,  161 => 52,  147 => 51,  144 => 44,  127 => 43,  123 => 41,  119 => 39,  117 => 32,  114 => 31,  112 => 30,  109 => 29,  92 => 28,  87 => 26,  83 => 24,  77 => 23,  65 => 21,  56 => 18,  52 => 17,  48 => 16,  43 => 15,  37 => 14,  22 => 12,);
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
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:create_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block tab_menu %}{{ knp_menu_render(admin.sidemenu(action), {'currentClass' : 'active', 'template': admin_pool.getTemplate('tab_menu_template')}, 'twig') }}{% endblock %}*/
/* */
/* {% block show %}*/
/*     <div class="sonata-ba-view">*/
/* */
/*         {{ sonata_block_render_event('sonata.admin.show.top', { 'admin': admin, 'object': object }) }}*/
/* */
/*         {% for name, view_group in admin.showgroups %}*/
/*             <table class="table table-bordered">*/
/*                 {% if name %}*/
/*                     <thead>*/
/*                         {% block show_title %}*/
/*                             <tr class="sonata-ba-view-title">*/
/*                                 <th colspan="2">*/
/*                                     {{ admin.trans(name) }}*/
/*                                 </th>*/
/*                             </tr>*/
/*                         {% endblock %}*/
/*                     </thead>*/
/*                 {% endif %}*/
/* */
/*                 <tbody>*/
/*                     {% for field_name in view_group.fields %}*/
/*                         {% block show_field %}*/
/*                             <tr class="sonata-ba-view-container">*/
/*                                 {% if elements[field_name] is defined %}*/
/*                                     {{ elements[field_name]|render_view_element(object) }}*/
/*                                 {% endif %}*/
/*                             </tr>*/
/*                         {% endblock %}*/
/*                     {% endfor %}*/
/*                 </tbody>*/
/*             </table>*/
/*         {% endfor %}*/
/* */
/*         {{ sonata_block_render_event('sonata.admin.show.bottom', { 'admin': admin, 'object': object }) }}*/
/* */
/*     </div>*/
/* {% endblock %}*/
/* */
