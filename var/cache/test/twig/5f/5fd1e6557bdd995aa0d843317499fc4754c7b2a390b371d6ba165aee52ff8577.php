<?php

/* SonataAdminBundle:CRUD:base_show_field.html.twig */
class __TwigTemplate_d3ba58337dada5a385e5bb94eaa7c55e521970705c08e4f0f1251b8aa4d88448 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'name' => array($this, 'block_name'),
            'field' => array($this, 'block_field'),
            'field_compare' => array($this, 'block_field_compare'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_005366370eefcc305c935ae2383eb00a4c2109507f7954357826f218546275a6 = $this->env->getExtension("native_profiler");
        $__internal_005366370eefcc305c935ae2383eb00a4c2109507f7954357826f218546275a6->enter($__internal_005366370eefcc305c935ae2383eb00a4c2109507f7954357826f218546275a6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_show_field.html.twig"));

        // line 11
        echo "
<th";
        // line 12
        if (((array_key_exists("is_diff", $context)) ? (_twig_default_filter((isset($context["is_diff"]) ? $context["is_diff"] : $this->getContext($context, "is_diff")), false)) : (false))) {
            echo " class=\"diff\"";
        }
        echo ">";
        $this->displayBlock('name', $context, $blocks);
        echo "</th>
<td>";
        // line 13
        $this->displayBlock('field', $context, $blocks);
        echo "</td>

";
        // line 15
        $this->displayBlock('field_compare', $context, $blocks);
        
        $__internal_005366370eefcc305c935ae2383eb00a4c2109507f7954357826f218546275a6->leave($__internal_005366370eefcc305c935ae2383eb00a4c2109507f7954357826f218546275a6_prof);

    }

    // line 12
    public function block_name($context, array $blocks = array())
    {
        $__internal_387116f791c5e0d532cb8785daf806d144c2b65b341455d297f27a6ef5b9cce4 = $this->env->getExtension("native_profiler");
        $__internal_387116f791c5e0d532cb8785daf806d144c2b65b341455d297f27a6ef5b9cce4->enter($__internal_387116f791c5e0d532cb8785daf806d144c2b65b341455d297f27a6ef5b9cce4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "name"));

        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "label", array()), 1 => array(), 2 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "translationDomain", array())), "method"), "html", null, true);
        
        $__internal_387116f791c5e0d532cb8785daf806d144c2b65b341455d297f27a6ef5b9cce4->leave($__internal_387116f791c5e0d532cb8785daf806d144c2b65b341455d297f27a6ef5b9cce4_prof);

    }

    // line 13
    public function block_field($context, array $blocks = array())
    {
        $__internal_1ce490d5e6b25a1c4724baec0386775369b1b58bdbe0336635d88acc647baf68 = $this->env->getExtension("native_profiler");
        $__internal_1ce490d5e6b25a1c4724baec0386775369b1b58bdbe0336635d88acc647baf68->enter($__internal_1ce490d5e6b25a1c4724baec0386775369b1b58bdbe0336635d88acc647baf68_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "safe", array())) {
            echo (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"));
        } else {
            echo nl2br(twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true));
        }
        
        $__internal_1ce490d5e6b25a1c4724baec0386775369b1b58bdbe0336635d88acc647baf68->leave($__internal_1ce490d5e6b25a1c4724baec0386775369b1b58bdbe0336635d88acc647baf68_prof);

    }

    // line 15
    public function block_field_compare($context, array $blocks = array())
    {
        $__internal_695e4f57f308ee1adbf36455fbf7eb39366f8abd8c6bce90707ad15a5493f748 = $this->env->getExtension("native_profiler");
        $__internal_695e4f57f308ee1adbf36455fbf7eb39366f8abd8c6bce90707ad15a5493f748->enter($__internal_695e4f57f308ee1adbf36455fbf7eb39366f8abd8c6bce90707ad15a5493f748_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field_compare"));

        // line 16
        echo "    ";
        if (array_key_exists("value_compare", $context)) {
            // line 17
            echo "        <td>
            ";
            // line 18
            $context["value"] = (isset($context["value_compare"]) ? $context["value_compare"] : $this->getContext($context, "value_compare"));
            // line 19
            echo "            ";
            $this->displayBlock("field", $context, $blocks);
            echo "
        </td>
    ";
        }
        
        $__internal_695e4f57f308ee1adbf36455fbf7eb39366f8abd8c6bce90707ad15a5493f748->leave($__internal_695e4f57f308ee1adbf36455fbf7eb39366f8abd8c6bce90707ad15a5493f748_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 19,  88 => 18,  85 => 17,  82 => 16,  76 => 15,  60 => 13,  48 => 12,  41 => 15,  36 => 13,  28 => 12,  25 => 11,);
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
/* <th{% if(is_diff|default(false)) %} class="diff"{% endif %}>{% block name %}{{ admin.trans(field_description.label, {}, field_description.translationDomain) }}{% endblock %}</th>*/
/* <td>{% block field %}{% if field_description.options.safe %}{{ value|raw }}{% else %}{{ value|nl2br }}{% endif %}{% endblock %}</td>*/
/* */
/* {% block field_compare %}*/
/*     {% if(value_compare is defined) %}*/
/*         <td>*/
/*             {% set value = value_compare %}*/
/*             {{ block('field') }}*/
/*         </td>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
