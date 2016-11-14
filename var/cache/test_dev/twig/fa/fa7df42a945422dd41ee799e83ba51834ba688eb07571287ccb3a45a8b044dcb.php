<?php

/* SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_one.html.twig */
class __TwigTemplate_60b40b3766eaf88343f1332cab9dcc8d5d86e2abd656ffcf05b42bc5e23a6f06 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_one.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_63ba0a6c36944b2a0c7489287461600d30667086328710290930ea7a20cf7f58 = $this->env->getExtension("native_profiler");
        $__internal_63ba0a6c36944b2a0c7489287461600d30667086328710290930ea7a20cf7f58->enter($__internal_63ba0a6c36944b2a0c7489287461600d30667086328710290930ea7a20cf7f58_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_one.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_63ba0a6c36944b2a0c7489287461600d30667086328710290930ea7a20cf7f58->leave($__internal_63ba0a6c36944b2a0c7489287461600d30667086328710290930ea7a20cf7f58_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_b30b00e9506e38749f08dadc09264c04c1c440c171ee606ab069317c3d6308ac = $this->env->getExtension("native_profiler");
        $__internal_b30b00e9506e38749f08dadc09264c04c1c440c171ee606ab069317c3d6308ac->enter($__internal_b30b00e9506e38749f08dadc09264c04c1c440c171ee606ab069317c3d6308ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        if ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) {
            // line 16
            echo "        ";
            if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasAssociationAdmin", array()) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "hasRoute", array(0 => "edit"), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "isGranted", array(0 => "EDIT", 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "method"))) {
                // line 17
                echo "            <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "name", array()), 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "parameters", array())), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "</a>
        ";
            } else {
                // line 19
                echo "            ";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "
        ";
            }
            // line 21
            echo "    ";
        }
        
        $__internal_b30b00e9506e38749f08dadc09264c04c1c440c171ee606ab069317c3d6308ac->leave($__internal_b30b00e9506e38749f08dadc09264c04c1c440c171ee606ab069317c3d6308ac_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_one.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 21,  53 => 19,  45 => 17,  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/* {% extends admin.getTemplate('base_list_field') %}*/
/* */
/* {% block field %}*/
/*     {% if value %}*/
/*         {% if field_description.hasAssociationAdmin and field_description.associationadmin.hasRoute('edit') and field_description.associationadmin.isGranted('EDIT', value) %}*/
/*             <a href="{{ field_description.associationadmin.generateObjectUrl(field_description.options.route.name, value, field_description.options.route.parameters) }}">{{ value|render_relation_element(field_description) }}</a>*/
/*         {% else %}*/
/*             {{ value|render_relation_element(field_description) }}*/
/*         {% endif %}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
