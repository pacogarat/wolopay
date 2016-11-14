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
        $__internal_1267b61e66cf89e0c88121a824538d7d4b253eb8037f05c2b1304efa910afe8f = $this->env->getExtension("native_profiler");
        $__internal_1267b61e66cf89e0c88121a824538d7d4b253eb8037f05c2b1304efa910afe8f->enter($__internal_1267b61e66cf89e0c88121a824538d7d4b253eb8037f05c2b1304efa910afe8f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_show_field.html.twig"));

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
        
        $__internal_1267b61e66cf89e0c88121a824538d7d4b253eb8037f05c2b1304efa910afe8f->leave($__internal_1267b61e66cf89e0c88121a824538d7d4b253eb8037f05c2b1304efa910afe8f_prof);

    }

    // line 12
    public function block_name($context, array $blocks = array())
    {
        $__internal_2bc5841d07ce118c53267bf173ac4aee876d1f4ffe40710bdd2992139bd3cf2f = $this->env->getExtension("native_profiler");
        $__internal_2bc5841d07ce118c53267bf173ac4aee876d1f4ffe40710bdd2992139bd3cf2f->enter($__internal_2bc5841d07ce118c53267bf173ac4aee876d1f4ffe40710bdd2992139bd3cf2f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "name"));

        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "trans", array(0 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "label", array()), 1 => array(), 2 => $this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "translationDomain", array())), "method"), "html", null, true);
        
        $__internal_2bc5841d07ce118c53267bf173ac4aee876d1f4ffe40710bdd2992139bd3cf2f->leave($__internal_2bc5841d07ce118c53267bf173ac4aee876d1f4ffe40710bdd2992139bd3cf2f_prof);

    }

    // line 13
    public function block_field($context, array $blocks = array())
    {
        $__internal_9be1ce1ddc307279f4f246feecff3f913b4a19910655d25318972812130cffd2 = $this->env->getExtension("native_profiler");
        $__internal_9be1ce1ddc307279f4f246feecff3f913b4a19910655d25318972812130cffd2->enter($__internal_9be1ce1ddc307279f4f246feecff3f913b4a19910655d25318972812130cffd2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "safe", array())) {
            echo (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"));
        } else {
            echo nl2br(twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true));
        }
        
        $__internal_9be1ce1ddc307279f4f246feecff3f913b4a19910655d25318972812130cffd2->leave($__internal_9be1ce1ddc307279f4f246feecff3f913b4a19910655d25318972812130cffd2_prof);

    }

    // line 15
    public function block_field_compare($context, array $blocks = array())
    {
        $__internal_a42d3c2a765ea708bb08e26a41f75fb5edfa60048e847cff565755e0549501fa = $this->env->getExtension("native_profiler");
        $__internal_a42d3c2a765ea708bb08e26a41f75fb5edfa60048e847cff565755e0549501fa->enter($__internal_a42d3c2a765ea708bb08e26a41f75fb5edfa60048e847cff565755e0549501fa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field_compare"));

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
        
        $__internal_a42d3c2a765ea708bb08e26a41f75fb5edfa60048e847cff565755e0549501fa->leave($__internal_a42d3c2a765ea708bb08e26a41f75fb5edfa60048e847cff565755e0549501fa_prof);

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
