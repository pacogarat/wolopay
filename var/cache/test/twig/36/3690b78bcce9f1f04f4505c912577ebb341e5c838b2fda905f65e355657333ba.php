<?php

/* IbrowsSonataTranslationBundle:CRUD:base_inline_translation_field.html.twig */
class __TwigTemplate_cc39b418a33560451776963e8f997d28c24c307c2535e653a098ec9614d41ddd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_6b67b2959ff360d07a4e1a3a5f01b6b499a0f3c5f9f18e456dc373464e3c085f = $this->env->getExtension("native_profiler");
        $__internal_6b67b2959ff360d07a4e1a3a5f01b6b499a0f3c5f9f18e456dc373464e3c085f->enter($__internal_6b67b2959ff360d07a4e1a3a5f01b6b499a0f3c5f9f18e456dc373464e3c085f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle:CRUD:base_inline_translation_field.html.twig"));

        // line 11
        echo "
<td class=\"sonata-ba-list-field sonata-ba-list-field-";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "type", array()), "html", null, true);
        echo "\" objectId=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\">
";
        // line 13
        $context["locale"] = $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "locale", array());
        // line 14
        $context["translation"] = null;
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "translations", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["trans"]) {
            // line 16
            echo "    ";
            if (($this->getAttribute($context["trans"], "locale", array()) == (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")))) {
                // line 17
                echo "        ";
                $context["translation"] = $context["trans"];
                // line 18
                echo "    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trans'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        $context["id"] = (((("transunit" . "-") . $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array())) . "-") . (isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")));
        // line 21
        $context["pk"] = (($this->getAttribute((isset($context["translation"]) ? $context["translation"] : null), "id", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["translation"]) ? $context["translation"] : null), "id", array()), "")) : (""));
        // line 22
        $context["content"] = (($this->getAttribute((isset($context["translation"]) ? $context["translation"] : null), "content", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["translation"]) ? $context["translation"] : null), "content", array()), "")) : (""));
        // line 23
        echo "<a href=\"#\" id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\" data-pk=\"";
        echo twig_escape_filter($this->env, (isset($context["pk"]) ? $context["pk"] : $this->getContext($context, "pk")), "html", null, true);
        echo "\">";
        // line 24
        $this->displayBlock('field', $context, $blocks);
        // line 25
        echo "</a>

";
        // line 27
        if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method")) {
            // line 28
            $context["options"] = $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "editable", array());
            // line 29
            echo "<script>
    jQuery('#";
            // line 30
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "').editable({
        mode: \"";
            // line 31
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "mode", array()), "html", null, true);
            echo "\",
        type: \"";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "type", array()), "html", null, true);
            echo "\",
        emptytext: \"";
            // line 33
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "emptytext", array()), "html", null, true);
            echo "\",
        placement: \"";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "placement", array()), "html", null, true);
            echo "\",
        url: ";
            // line 35
            echo twig_jsonencode_filter($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "name", array()), 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "parameters", array())), "method"));
            echo ",
        name: ";
            // line 36
            echo twig_jsonencode_filter($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "key", array()));
            echo ",
        params: function(params) {
            // make sure pk is always loaded from element
            params.pk = jQuery(this).attr('data-pk');
            params.locale = ";
            // line 40
            echo twig_jsonencode_filter((isset($context["locale"]) ? $context["locale"] : $this->getContext($context, "locale")));
            echo ";
            return params;
        },
        error: function(response) {
            response = JSON.parse(response.responseText);
            return response ? response.message : response;
        },
        success: function(response, newValue) {
            jQuery(this).attr('data-pk', response.pk);
            return response;
        },
        value: ";
            // line 51
            echo twig_jsonencode_filter((isset($context["content"]) ? $context["content"] : $this->getContext($context, "content")));
            echo "
    });
</script>
";
        }
        // line 55
        echo "</td>
";
        
        $__internal_6b67b2959ff360d07a4e1a3a5f01b6b499a0f3c5f9f18e456dc373464e3c085f->leave($__internal_6b67b2959ff360d07a4e1a3a5f01b6b499a0f3c5f9f18e456dc373464e3c085f_prof);

    }

    // line 24
    public function block_field($context, array $blocks = array())
    {
        $__internal_3acbb09d71710adbb1fe1706dc9095968a7d2123ec9fe3b577b0b509d09c2f42 = $this->env->getExtension("native_profiler");
        $__internal_3acbb09d71710adbb1fe1706dc9095968a7d2123ec9fe3b577b0b509d09c2f42->enter($__internal_3acbb09d71710adbb1fe1706dc9095968a7d2123ec9fe3b577b0b509d09c2f42_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo twig_escape_filter($this->env, (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content")), "html", null, true);
        
        $__internal_3acbb09d71710adbb1fe1706dc9095968a7d2123ec9fe3b577b0b509d09c2f42->leave($__internal_3acbb09d71710adbb1fe1706dc9095968a7d2123ec9fe3b577b0b509d09c2f42_prof);

    }

    public function getTemplateName()
    {
        return "IbrowsSonataTranslationBundle:CRUD:base_inline_translation_field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 24,  130 => 55,  123 => 51,  109 => 40,  102 => 36,  98 => 35,  94 => 34,  90 => 33,  86 => 32,  82 => 31,  78 => 30,  75 => 29,  73 => 28,  71 => 27,  67 => 25,  65 => 24,  59 => 23,  57 => 22,  55 => 21,  53 => 20,  46 => 18,  43 => 17,  40 => 16,  36 => 15,  34 => 14,  32 => 13,  26 => 12,  23 => 11,);
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
/* <td class="sonata-ba-list-field sonata-ba-list-field-{{ field_description.type }}" objectId="{{ admin.id(object) }}">*/
/* {% set locale = field_description.options.locale %}*/
/* {% set translation = null %}*/
/* {% for trans in object.translations %}*/
/*     {% if trans.locale == locale %}*/
/*         {% set translation = trans %}*/
/*     {% endif %}*/
/* {% endfor %}*/
/* {% set id = 'transunit'~'-'~object.id~'-'~locale %}*/
/* {% set pk = translation.id|default('') %}*/
/* {% set content = translation.content|default('') %}*/
/* <a href="#" id="{{ id }}" data-pk="{{ pk }}">*/
/*     {%- block field %}{{ content }}{% endblock -%}*/
/* </a>*/
/* */
/* {% if admin.isGranted('EDIT', object) %}*/
/* {% set options = field_description.options.editable %}*/
/* <script>*/
/*     jQuery('#{{ id }}').editable({*/
/*         mode: "{{ options.mode }}",*/
/*         type: "{{ options.type }}",*/
/*         emptytext: "{{ options.emptytext }}",*/
/*         placement: "{{ options.placement }}",*/
/*         url: {{ admin.generateObjectUrl(field_description.options.route.name, object, field_description.options.route.parameters)|json_encode|raw }},*/
/*         name: {{ object.key|json_encode|raw }},*/
/*         params: function(params) {*/
/*             // make sure pk is always loaded from element*/
/*             params.pk = jQuery(this).attr('data-pk');*/
/*             params.locale = {{ locale|json_encode|raw }};*/
/*             return params;*/
/*         },*/
/*         error: function(response) {*/
/*             response = JSON.parse(response.responseText);*/
/*             return response ? response.message : response;*/
/*         },*/
/*         success: function(response, newValue) {*/
/*             jQuery(this).attr('data-pk', response.pk);*/
/*             return response;*/
/*         },*/
/*         value: {{ content|json_encode|raw }}*/
/*     });*/
/* </script>*/
/* {% endif %}*/
/* </td>*/
/* */
