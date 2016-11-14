<?php

/* SonataMediaBundle:MediaAdmin:inner_row_media.html.twig */
class __TwigTemplate_62a94b651c647ae2559792faa47fd7712a09f5f1c04d3e01ecdab9c608b7e4aa extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_flat_inner_row.html.twig", "SonataMediaBundle:MediaAdmin:inner_row_media.html.twig", 12);
        $this->blocks = array(
            'row' => array($this, 'block_row'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_flat_inner_row.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_170638e163b16a47326c26b521f7efb48292ff6febdc672aa63bbccf38c85e7d = $this->env->getExtension("native_profiler");
        $__internal_170638e163b16a47326c26b521f7efb48292ff6febdc672aa63bbccf38c85e7d->enter($__internal_170638e163b16a47326c26b521f7efb48292ff6febdc672aa63bbccf38c85e7d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:MediaAdmin:inner_row_media.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_170638e163b16a47326c26b521f7efb48292ff6febdc672aa63bbccf38c85e7d->leave($__internal_170638e163b16a47326c26b521f7efb48292ff6febdc672aa63bbccf38c85e7d_prof);

    }

    // line 14
    public function block_row($context, array $blocks = array())
    {
        $__internal_985d8f6052ece2fc6ceaa181c521cec03cf25fd73435e6b0d38907cf21112a91 = $this->env->getExtension("native_profiler");
        $__internal_985d8f6052ece2fc6ceaa181c521cec03cf25fd73435e6b0d38907cf21112a91->enter($__internal_985d8f6052ece2fc6ceaa181c521cec03cf25fd73435e6b0d38907cf21112a91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "row"));

        // line 15
        echo "
    <div class=\"col-sm-12\">
        <div class=\"pull-left\">
            ";
        // line 18
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "edit"), "method"))) {
            // line 19
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "method"), "html", null, true);
            echo "\" style=\"float: left; margin-right: 6px;\">";
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "admin", array("width" => 90));
            echo "</a>
            ";
        } else {
            // line 21
            echo "                ";
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "admin", array("height" => 90));
            // line 22
            echo "            ";
        }
        // line 23
        echo "        </div>
        <span class=\"badge pull-right\">";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "providerName", array()), array(), "SonataMediaBundle"), "html", null, true);
        echo "</span>
        ";
        // line 25
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "EDIT", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "edit"), "method"))) {
            // line 26
            echo "            <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "edit", 1 => array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "method"), "html", null, true);
            echo "\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "name", array()), "html", null, true);
            echo "</strong></a>
        ";
        } else {
            // line 28
            echo "            <strong>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "name", array()), "html", null, true);
            echo "</strong>
        ";
        }
        // line 30
        echo "

        <br />
        ";
        // line 33
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "width", array())) {
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "width", array()), "html", null, true);
            if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "height", array())) {
                echo "x";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "height", array()), "html", null, true);
            }
            echo "px";
        }
        // line 34
        echo "        ";
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "length", array()) > 0)) {
            // line 35
            echo "            (";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "length", array()), "html", null, true);
            echo ")
        ";
        }
        // line 37
        echo "
        <br />

        ";
        // line 40
        if ( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "authorname", array()))) {
            // line 41
            echo "           ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "authorname", array()), "html", null, true);
            echo "
        ";
        }
        // line 43
        echo "
        ";
        // line 44
        if (( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "copyright", array())) &&  !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "authorname", array())))) {
            // line 45
            echo "            ~
        ";
        }
        // line 47
        echo "
        ";
        // line 48
        if ( !twig_test_empty($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "copyright", array()))) {
            // line 49
            echo "            &copy; ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "copyright", array()), "html", null, true);
            echo "
        ";
        }
        // line 51
        echo "
        ";
        // line 53
        echo "        ";
        // line 54
        echo "        ";
        // line 55
        echo "            ";
        // line 56
        echo "        ";
        // line 57
        echo "
    </div>
";
        
        $__internal_985d8f6052ece2fc6ceaa181c521cec03cf25fd73435e6b0d38907cf21112a91->leave($__internal_985d8f6052ece2fc6ceaa181c521cec03cf25fd73435e6b0d38907cf21112a91_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:inner_row_media.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  152 => 57,  150 => 56,  148 => 55,  146 => 54,  144 => 53,  141 => 51,  135 => 49,  133 => 48,  130 => 47,  126 => 45,  124 => 44,  121 => 43,  115 => 41,  113 => 40,  108 => 37,  102 => 35,  99 => 34,  89 => 33,  84 => 30,  78 => 28,  70 => 26,  68 => 25,  64 => 24,  61 => 23,  58 => 22,  55 => 21,  47 => 19,  45 => 18,  40 => 15,  34 => 14,  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:base_list_flat_inner_row.html.twig' %}*/
/* */
/* {% block row %}*/
/* */
/*     <div class="col-sm-12">*/
/*         <div class="pull-left">*/
/*             {% if admin.isGranted('EDIT', object) and admin.hasRoute('edit') %}*/
/*                 <a href="{{ admin.generateUrl('edit', {'id' : object|sonata_urlsafeid }) }}" style="float: left; margin-right: 6px;">{% thumbnail object, 'admin' with {'width': 90} %}</a>*/
/*             {% else %}*/
/*                 {% thumbnail object, 'admin' with {'height': 90} %}*/
/*             {% endif %}*/
/*         </div>*/
/*         <span class="badge pull-right">{{ object.providerName|trans({}, 'SonataMediaBundle') }}</span>*/
/*         {% if admin.isGranted('EDIT', object) and admin.hasRoute('edit') %}*/
/*             <a href="{{ admin.generateUrl('edit', {'id' : object|sonata_urlsafeid }) }}"><strong>{{ object.name }}</strong></a>*/
/*         {% else %}*/
/*             <strong>{{ object.name }}</strong>*/
/*         {% endif %}*/
/* */
/* */
/*         <br />*/
/*         {% if object.width %} {{ object.width }}{% if object.height %}x{{ object.height }}{% endif %}px{% endif %}*/
/*         {% if object.length > 0 %}*/
/*             ({{ object.length }})*/
/*         {% endif %}*/
/* */
/*         <br />*/
/* */
/*         {% if object.authorname is not empty %}*/
/*            {{ object.authorname }}*/
/*         {% endif %}*/
/* */
/*         {% if object.copyright is not empty and object.authorname is not empty %}*/
/*             ~*/
/*         {% endif %}*/
/* */
/*         {% if object.copyright is not empty %}*/
/*             &copy; {{ object.copyright }}*/
/*         {% endif  %}*/
/* */
/*         {#{% set enabled_field_description = admin.getListFieldDescription('enabled') %}#}*/
/*         {#{% set url = path('sonata_admin_set_object_field_value', { 'context': 'list', 'field': enabled_field_description.name, 'objectId': admin.id(object), 'code': admin.code(object) })  %}#}*/
/*         {#<span {% block field_span_attributes %}class="x-editable" data-type="{{ enabled_field_description.type|sonata_xeditable_type }}" data-value="{{ object.enabled }}" data-title="{{ enabled_field_description.label|trans({}, enabled_field_description.translationDomain) }}" data-pk="{{ admin.id(object) }}" data-url="{{ url }}" {% endblock %}>#}*/
/*             {#{{ block('field') }}#}*/
/*         {#</span>#}*/
/* */
/*     </div>*/
/* {% endblock %}*/
/* */
