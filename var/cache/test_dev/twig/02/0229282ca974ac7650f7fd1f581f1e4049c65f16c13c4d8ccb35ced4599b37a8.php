<?php

/* SonataAdminBundle:Form:filter_admin_fields.html.twig */
class __TwigTemplate_707a9d648923aba06d9bd063c47c9965b16686f8d3541cc06528a58ee6ce6f1d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("form_div_layout.html.twig", "SonataAdminBundle:Form:filter_admin_fields.html.twig", 12);
        $this->blocks = array(
            'choice_widget_collapsed' => array($this, 'block_choice_widget_collapsed'),
            'textarea_widget' => array($this, 'block_textarea_widget'),
            'form_widget_simple' => array($this, 'block_form_widget_simple'),
            'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
            'checkbox_widget' => array($this, 'block_checkbox_widget'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "form_div_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_869db9c14d2c2098b277ccf246f2b141952e8b6291998c9ec4cec5b0f3c85b7e = $this->env->getExtension("native_profiler");
        $__internal_869db9c14d2c2098b277ccf246f2b141952e8b6291998c9ec4cec5b0f3c85b7e->enter($__internal_869db9c14d2c2098b277ccf246f2b141952e8b6291998c9ec4cec5b0f3c85b7e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Form:filter_admin_fields.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_869db9c14d2c2098b277ccf246f2b141952e8b6291998c9ec4cec5b0f3c85b7e->leave($__internal_869db9c14d2c2098b277ccf246f2b141952e8b6291998c9ec4cec5b0f3c85b7e_prof);

    }

    // line 18
    public function block_choice_widget_collapsed($context, array $blocks = array())
    {
        $__internal_4d52f57606450139cd1e5b550d2abb3c4c838bdb866f1215bc44f38ee661b5e9 = $this->env->getExtension("native_profiler");
        $__internal_4d52f57606450139cd1e5b550d2abb3c4c838bdb866f1215bc44f38ee661b5e9->enter($__internal_4d52f57606450139cd1e5b550d2abb3c4c838bdb866f1215bc44f38ee661b5e9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget_collapsed"));

        // line 19
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 20
        echo "    ";
        $this->displayParentBlock("choice_widget_collapsed", $context, $blocks);
        echo "
";
        
        $__internal_4d52f57606450139cd1e5b550d2abb3c4c838bdb866f1215bc44f38ee661b5e9->leave($__internal_4d52f57606450139cd1e5b550d2abb3c4c838bdb866f1215bc44f38ee661b5e9_prof);

    }

    // line 23
    public function block_textarea_widget($context, array $blocks = array())
    {
        $__internal_901f9bbd495dbd0794e90d3134d115c4eb9ed4211cd79423203e63de2e4f3b68 = $this->env->getExtension("native_profiler");
        $__internal_901f9bbd495dbd0794e90d3134d115c4eb9ed4211cd79423203e63de2e4f3b68->enter($__internal_901f9bbd495dbd0794e90d3134d115c4eb9ed4211cd79423203e63de2e4f3b68_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "textarea_widget"));

        // line 24
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 25
        echo "    ";
        $this->displayParentBlock("textarea_widget", $context, $blocks);
        echo "
";
        
        $__internal_901f9bbd495dbd0794e90d3134d115c4eb9ed4211cd79423203e63de2e4f3b68->leave($__internal_901f9bbd495dbd0794e90d3134d115c4eb9ed4211cd79423203e63de2e4f3b68_prof);

    }

    // line 28
    public function block_form_widget_simple($context, array $blocks = array())
    {
        $__internal_b1b2150cb7cb15fa2eac76f5c3e0eb295258512f3779fc5e54a976b0ae07ee6c = $this->env->getExtension("native_profiler");
        $__internal_b1b2150cb7cb15fa2eac76f5c3e0eb295258512f3779fc5e54a976b0ae07ee6c->enter($__internal_b1b2150cb7cb15fa2eac76f5c3e0eb295258512f3779fc5e54a976b0ae07ee6c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_widget_simple"));

        // line 29
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => ((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control")));
        // line 30
        echo "    ";
        $this->displayParentBlock("form_widget_simple", $context, $blocks);
        echo "
";
        
        $__internal_b1b2150cb7cb15fa2eac76f5c3e0eb295258512f3779fc5e54a976b0ae07ee6c->leave($__internal_b1b2150cb7cb15fa2eac76f5c3e0eb295258512f3779fc5e54a976b0ae07ee6c_prof);

    }

    // line 33
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        $__internal_739349e0d18d883e78ed30eeb1f469551294e13f1fd743486ad0488e94ef412a = $this->env->getExtension("native_profiler");
        $__internal_739349e0d18d883e78ed30eeb1f469551294e13f1fd743486ad0488e94ef412a->enter($__internal_739349e0d18d883e78ed30eeb1f469551294e13f1fd743486ad0488e94ef412a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget_expanded"));

        // line 34
        echo "    ";
        ob_start();
        // line 35
        echo "        ";
        $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => (($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : (""))));
        // line 36
        echo "        ";
        $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => (($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), "class", array()) . " ") . (((array_key_exists("widget_type", $context) && ((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != ""))) ? ((((((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) ? ("checkbox") : ("radio")) . "-") . (isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")))) : ("")))));
        // line 37
        echo "        ";
        if ((isset($context["expanded"]) ? $context["expanded"] : $this->getContext($context, "expanded"))) {
            // line 38
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : (""))));
            // line 39
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
        ";
        }
        // line 41
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 42
            echo "            ";
            if ((array_key_exists("widget_type", $context) && ((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != "inline"))) {
                // line 43
                echo "                <div class=\"";
                echo (((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) ? ("checkbox") : ("radio"));
                echo "\">
            ";
            }
            // line 45
            echo "            <label";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
            ";
            // line 46
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'widget', array("attr" => array("class" => (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_class", array()), "")) : ("")))));
            echo "
            ";
            // line 47
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["child"], "vars", array()), "label", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
            </label>
            ";
            // line 49
            if ((array_key_exists("widget_type", $context) && ((isset($context["widget_type"]) ? $context["widget_type"] : $this->getContext($context, "widget_type")) != "inline"))) {
                // line 50
                echo "                </div>
            ";
            }
            // line 52
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 53
        echo "        ";
        $this->displayBlock("form_message", $context, $blocks);
        echo "
        ";
        // line 54
        if ((isset($context["expanded"]) ? $context["expanded"] : $this->getContext($context, "expanded"))) {
            // line 55
            echo "            </div>
        ";
        }
        // line 57
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_739349e0d18d883e78ed30eeb1f469551294e13f1fd743486ad0488e94ef412a->leave($__internal_739349e0d18d883e78ed30eeb1f469551294e13f1fd743486ad0488e94ef412a_prof);

    }

    // line 60
    public function block_checkbox_widget($context, array $blocks = array())
    {
        $__internal_cdfffbdf8a55ef88a932663ce712bf1ccce51829aa26219256d34589a4bf7a05 = $this->env->getExtension("native_profiler");
        $__internal_cdfffbdf8a55ef88a932663ce712bf1ccce51829aa26219256d34589a4bf7a05->enter($__internal_cdfffbdf8a55ef88a932663ce712bf1ccce51829aa26219256d34589a4bf7a05_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "checkbox_widget"));

        // line 61
        echo "    ";
        ob_start();
        // line 62
        echo "        ";
        if (( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false) && twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label"))))) {
            // line 63
            echo "            ";
            $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
            // line 64
            echo "        ";
        }
        // line 65
        echo "        ";
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 66
            echo "            <div class=\"checkbox\">
        ";
        }
        // line 68
        echo "
        ";
        // line 69
        if (((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array()))) && array_key_exists("label_render", $context))) {
            // line 70
            echo "            <label class=\"";
            if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
                echo "checkbox-inline";
            }
            echo "\">
        ";
        }
        // line 72
        echo "
        <input type=\"checkbox\" ";
        // line 73
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : $this->getContext($context, "checked"))) {
            echo " checked=\"checked\"";
        }
        echo "/>
        ";
        // line 74
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 75
            echo "            ";
            if ((array_key_exists("label_render", $context) && twig_in_filter((isset($context["widget_checkbox_label"]) ? $context["widget_checkbox_label"] : $this->getContext($context, "widget_checkbox_label")), array(0 => "both", 1 => "widget")))) {
                // line 76
                echo "                ";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                echo "
                </label>
            ";
            }
            // line 79
            echo "        ";
        }
        // line 80
        echo "        ";
        if ((($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()) != null) && !twig_in_filter("choice", $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()), "vars", array()), "block_prefixes", array())))) {
            // line 81
            echo "            </div>
            ";
            // line 82
            $this->displayBlock("form_message", $context, $blocks);
            echo "
        ";
        }
        // line 84
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_cdfffbdf8a55ef88a932663ce712bf1ccce51829aa26219256d34589a4bf7a05->leave($__internal_cdfffbdf8a55ef88a932663ce712bf1ccce51829aa26219256d34589a4bf7a05_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Form:filter_admin_fields.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  271 => 84,  266 => 82,  263 => 81,  260 => 80,  257 => 79,  250 => 76,  247 => 75,  245 => 74,  233 => 73,  230 => 72,  222 => 70,  220 => 69,  217 => 68,  213 => 66,  210 => 65,  207 => 64,  204 => 63,  201 => 62,  198 => 61,  192 => 60,  184 => 57,  180 => 55,  178 => 54,  173 => 53,  167 => 52,  163 => 50,  161 => 49,  156 => 47,  152 => 46,  136 => 45,  130 => 43,  127 => 42,  122 => 41,  116 => 39,  113 => 38,  110 => 37,  107 => 36,  104 => 35,  101 => 34,  95 => 33,  85 => 30,  82 => 29,  76 => 28,  66 => 25,  63 => 24,  57 => 23,  47 => 20,  44 => 19,  38 => 18,  11 => 12,);
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
/* {% extends 'form_div_layout.html.twig' %}*/
/* */
/* {#*/
/*     Inspired from MopaBootstrapBundle: https://github.com/phiamo/MopaBootstrapBundle*/
/* #}*/
/* */
/* {% block choice_widget_collapsed %}*/
/*     {% set attr = attr|merge({'class': attr.class|default('') ~ ' form-control'}) %}*/
/*     {{ parent() }}*/
/* {% endblock choice_widget_collapsed %}*/
/* */
/* {% block textarea_widget %}*/
/*     {% set attr = attr|merge({'class': attr.class|default('') ~ ' form-control'}) %}*/
/*     {{ parent() }}*/
/* {% endblock textarea_widget %}*/
/* */
/* {% block form_widget_simple %}*/
/*     {% set attr = attr|merge({'class': attr.class|default('') ~ ' form-control'}) %}*/
/*     {{ parent() }}*/
/* {% endblock form_widget_simple %}*/
/* */
/* {% block choice_widget_expanded %}*/
/*     {% spaceless %}*/
/*         {% set label_attr = label_attr|merge({'class': (label_attr.class|default(''))}) %}*/
/*         {% set label_attr = label_attr|merge({'class': (label_attr.class ~ ' ' ~ (widget_type is defined and widget_type != '' ? (multiple ? 'checkbox' : 'radio') ~ '-' ~ widget_type : ''))}) %}*/
/*         {% if expanded %}*/
/*             {% set attr = attr|merge({'class': attr.class|default('')}) %}*/
/*             <div {{ block('widget_container_attributes') }}>*/
/*         {% endif %}*/
/*         {% for child in form %}*/
/*             {% if widget_type is defined and widget_type != 'inline' %}*/
/*                 <div class="{{ multiple ? 'checkbox' : 'radio' }}">*/
/*             {% endif %}*/
/*             <label{% for attrname, attrvalue in label_attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>*/
/*             {{ form_widget(child, {'attr': {'class': attr.widget_class|default('')}}) }}*/
/*             {{ child.vars.label|trans({}, translation_domain) }}*/
/*             </label>*/
/*             {% if widget_type is defined and widget_type != 'inline' %}*/
/*                 </div>*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*         {{ block('form_message') }}*/
/*         {% if expanded %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock choice_widget_expanded %}*/
/* */
/* {% block checkbox_widget %}*/
/*     {% spaceless %}*/
/*         {% if label is not same as(false) and label is empty %}*/
/*             {% set label = name|humanize %}*/
/*         {% endif %}*/
/*         {% if form.parent != null and 'choice' not in form.parent.vars.block_prefixes %}*/
/*             <div class="checkbox">*/
/*         {% endif %}*/
/* */
/*         {% if form.parent != null and 'choice' not in form.parent.vars.block_prefixes and label_render is defined %}*/
/*             <label class="{% if inline is defined and inline %}checkbox-inline{% endif %}">*/
/*         {% endif %}*/
/* */
/*         <input type="checkbox" {{ block('widget_attributes') }}{% if value is defined %} value="{{ value }}"{% endif %}{% if checked %} checked="checked"{% endif %}/>*/
/*         {% if form.parent != null and 'choice' not in form.parent.vars.block_prefixes %}*/
/*             {% if label_render is defined and widget_checkbox_label in ['both', 'widget'] %}*/
/*                 {{ label|trans({}, translation_domain) }}*/
/*                 </label>*/
/*             {% endif %}*/
/*         {% endif %}*/
/*         {% if form.parent != null and 'choice' not in form.parent.vars.block_prefixes %}*/
/*             </div>*/
/*             {{ block('form_message') }}*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock checkbox_widget %}*/
/* */
