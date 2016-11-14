<?php

/* SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_many.html.twig */
class __TwigTemplate_4bed5e849216e948aa416766f1e68937d25ae509f38321bf259fb2596714002e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
            'relation_link' => array($this, 'block_relation_link'),
            'relation_value' => array($this, 'block_relation_value'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_many.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_25c918c95af187de3c0cd8a0a890c525c9d8ca620b556d12b29e0cde2a7e6560 = $this->env->getExtension("native_profiler");
        $__internal_25c918c95af187de3c0cd8a0a890c525c9d8ca620b556d12b29e0cde2a7e6560->enter($__internal_25c918c95af187de3c0cd8a0a890c525c9d8ca620b556d12b29e0cde2a7e6560_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_many.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_25c918c95af187de3c0cd8a0a890c525c9d8ca620b556d12b29e0cde2a7e6560->leave($__internal_25c918c95af187de3c0cd8a0a890c525c9d8ca620b556d12b29e0cde2a7e6560_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_c3439a558c43bac38dd90611b9e7b9bd0d9ee79099d2b146f173adb550285d44 = $this->env->getExtension("native_profiler");
        $__internal_c3439a558c43bac38dd90611b9e7b9bd0d9ee79099d2b146f173adb550285d44->enter($__internal_c3439a558c43bac38dd90611b9e7b9bd0d9ee79099d2b146f173adb550285d44_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        if (($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "hasassociationadmin", array()) && $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "hasRoute", array(0 => "edit"), "method"))) {
            // line 16
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 17
                if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "isGranted", array(0 => "EDIT", 1 => (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))), "method")) {
                    // line 18
                    $this->displayBlock("relation_link", $context, $blocks);
                } else {
                    // line 20
                    $this->displayBlock("relation_value", $context, $blocks);
                }
                // line 22
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                // line 23
                echo "        ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 24
            echo "    ";
        } else {
            // line 25
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 26
                echo "            ";
                $this->displayBlock("relation_value", $context, $blocks);
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                // line 27
                echo "        ";
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 28
            echo "    ";
        }
        
        $__internal_c3439a558c43bac38dd90611b9e7b9bd0d9ee79099d2b146f173adb550285d44->leave($__internal_c3439a558c43bac38dd90611b9e7b9bd0d9ee79099d2b146f173adb550285d44_prof);

    }

    // line 31
    public function block_relation_link($context, array $blocks = array())
    {
        $__internal_0e4be1139f3c3d96882f77f1324b80b71fcb891e0d937058fa7c71c26ab5ea64 = $this->env->getExtension("native_profiler");
        $__internal_0e4be1139f3c3d96882f77f1324b80b71fcb891e0d937058fa7c71c26ab5ea64->enter($__internal_0e4be1139f3c3d96882f77f1324b80b71fcb891e0d937058fa7c71c26ab5ea64_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "relation_link"));

        // line 32
        echo "<a href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "associationadmin", array()), "generateObjectUrl", array(0 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "name", array()), 1 => (isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), 2 => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "route", array()), "parameters", array())), "method"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
        echo "</a>";
        
        $__internal_0e4be1139f3c3d96882f77f1324b80b71fcb891e0d937058fa7c71c26ab5ea64->leave($__internal_0e4be1139f3c3d96882f77f1324b80b71fcb891e0d937058fa7c71c26ab5ea64_prof);

    }

    // line 35
    public function block_relation_value($context, array $blocks = array())
    {
        $__internal_919db09bafccd191e650b2abc8a4a2c36a9c738401153aa128b085b9f00b0a55 = $this->env->getExtension("native_profiler");
        $__internal_919db09bafccd191e650b2abc8a4a2c36a9c738401153aa128b085b9f00b0a55->enter($__internal_919db09bafccd191e650b2abc8a4a2c36a9c738401153aa128b085b9f00b0a55_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "relation_value"));

        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('sonata_admin')->renderRelationElement((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), (isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description"))), "html", null, true);
        
        $__internal_919db09bafccd191e650b2abc8a4a2c36a9c738401153aa128b085b9f00b0a55->leave($__internal_919db09bafccd191e650b2abc8a4a2c36a9c738401153aa128b085b9f00b0a55_prof);

    }

    public function getTemplateName()
    {
        return "SonataDoctrineORMAdminBundle:CRUD:list_orm_many_to_many.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  160 => 36,  154 => 35,  143 => 32,  137 => 31,  129 => 28,  115 => 27,  109 => 26,  91 => 25,  88 => 24,  74 => 23,  70 => 22,  67 => 20,  64 => 18,  62 => 17,  44 => 16,  41 => 15,  35 => 14,  20 => 12,);
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
/*     {% if field_description.hasassociationadmin and field_description.associationadmin.hasRoute('edit') %}*/
/*         {% for element in value%}*/
/*             {%- if field_description.associationadmin.isGranted('EDIT', value) -%}*/
/*                 {{ block('relation_link') }}*/
/*             {%- else -%}*/
/*                 {{ block('relation_value') }}*/
/*             {%- endif -%}*/
/*             {% if not loop.last %}, {% endif %}*/
/*         {% endfor %}*/
/*     {% else %}*/
/*         {% for element in value%}*/
/*             {{ block('relation_value') }}{% if not loop.last %}, {% endif %}*/
/*         {% endfor %}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
/* {%- block relation_link -%}*/
/*     <a href="{{ field_description.associationadmin.generateObjectUrl(field_description.options.route.name, element, field_description.options.route.parameters) }}">{{ element|render_relation_element(field_description) }}</a>*/
/* {%- endblock -%}*/
/* */
/* {%- block relation_value -%}*/
/*     {{ element|render_relation_element(field_description) }}*/
/* {%- endblock -%}*/
/* */
