<?php

/* SonataDoctrineORMAdminBundle:CRUD:show_orm_one_to_many.html.twig */
class __TwigTemplate_6f3df9949a5a06207763ca933779d7079e5f305c18e4ea590c5f25ba313e2a6f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataDoctrineORMAdminBundle:CRUD:show_orm_one_to_many.html.twig", 12);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a7c64fc88efae2fa55e0a9ffbccab7f18c85b33895c61e16c74b25068490373d = $this->env->getExtension("native_profiler");
        $__internal_a7c64fc88efae2fa55e0a9ffbccab7f18c85b33895c61e16c74b25068490373d->enter($__internal_a7c64fc88efae2fa55e0a9ffbccab7f18c85b33895c61e16c74b25068490373d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:show_orm_one_to_many.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a7c64fc88efae2fa55e0a9ffbccab7f18c85b33895c61e16c74b25068490373d->leave($__internal_a7c64fc88efae2fa55e0a9ffbccab7f18c85b33895c61e16c74b25068490373d_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_bdbf9cc12f5a259d207ddbff67ead168df067c5ca4077bfa6d607d0691196067 = $this->env->getExtension("native_profiler");
        $__internal_bdbf9cc12f5a259d207ddbff67ead168df067c5ca4077bfa6d607d0691196067->enter($__internal_bdbf9cc12f5a259d207ddbff67ead168df067c5ca4077bfa6d607d0691196067_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <ul class=\"sonata-ba-show-one-to-many\">
    ";
        // line 16
        if ((($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasassociationadmin", array()) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "isGranted", array(0 => "EDIT"), "method")) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "hasRoute", array(0 => "edit"), "method"))) {
            // line 17
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 18
                echo "            <li><a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "name", array()), 1 => $context["element"], 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "parameters", array())), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement($context["element"], (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "</a></li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "    ";
        } else {
            // line 21
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 22
                echo "            <li>";
                echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement($context["element"], (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
                echo "</li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    ";
        }
        // line 25
        echo "    </ul>
";
        
        $__internal_bdbf9cc12f5a259d207ddbff67ead168df067c5ca4077bfa6d607d0691196067->leave($__internal_bdbf9cc12f5a259d207ddbff67ead168df067c5ca4077bfa6d607d0691196067_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:show_orm_one_to_many.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 25,  78 => 24,  69 => 22,  64 => 21,  61 => 20,  50 => 18,  45 => 17,  43 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:base_show_field.html.twig' %}*/
/* */
/* {% block field%}*/
/*     <ul class="sonata-ba-show-one-to-many">*/
/*     {% if field_description.hasassociationadmin and field_description.associationadmin.isGranted('EDIT') and field_description.associationadmin.hasRoute('edit') %}*/
/*         {% for element in value%}*/
/*             <li><a href="{{ field_description.associationadmin.generateObjectUrl(field_description.options.route.name, element, field_description.options.route.parameters) }}">{{ element|render_relation_element(field_description) }}</a></li>*/
/*         {% endfor %}*/
/*     {% else %}*/
/*         {% for element in value%}*/
/*             <li>{{ element|render_relation_element(field_description) }}</li>*/
/*         {% endfor %}*/
/*     {% endif %}*/
/*     </ul>*/
/* {% endblock %}*/
/* */
