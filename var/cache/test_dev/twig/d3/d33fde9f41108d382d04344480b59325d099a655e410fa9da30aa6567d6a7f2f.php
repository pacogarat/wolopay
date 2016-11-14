<?php

/* SonataAdminBundle:CRUD:show_array.html.twig */
class __TwigTemplate_2f0bd299e05817505706ce333d1280191f79fa0064e5b8f6fc955f79feccba82 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataAdminBundle:CRUD:show_array.html.twig", 12);
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
        $__internal_395b7923fda1174ca977e913c61e588e05955839646c8ebc765a1d762bac315f = $this->env->getExtension("native_profiler");
        $__internal_395b7923fda1174ca977e913c61e588e05955839646c8ebc765a1d762bac315f->enter($__internal_395b7923fda1174ca977e913c61e588e05955839646c8ebc765a1d762bac315f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_array.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_395b7923fda1174ca977e913c61e588e05955839646c8ebc765a1d762bac315f->leave($__internal_395b7923fda1174ca977e913c61e588e05955839646c8ebc765a1d762bac315f_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_af7be47ba1c130ba34c7e389250749aca0d2d2aee522ea4aee1252349d03a69b = $this->env->getExtension("native_profiler");
        $__internal_af7be47ba1c130ba34c7e389250749aca0d2d2aee522ea4aee1252349d03a69b->enter($__internal_af7be47ba1c130ba34c7e389250749aca0d2d2aee522ea4aee1252349d03a69b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 16
            echo "        ";
            if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "safe", array())) {
                // line 17
                echo "            [";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo " => ";
                echo $context["val"];
                echo "]
        ";
            } else {
                // line 19
                echo "            [";
                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                echo " => ";
                echo twig_escape_filter($this->env, $context["val"], "html", null, true);
                echo "]
        ";
            }
            // line 21
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_af7be47ba1c130ba34c7e389250749aca0d2d2aee522ea4aee1252349d03a69b->leave($__internal_af7be47ba1c130ba34c7e389250749aca0d2d2aee522ea4aee1252349d03a69b_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_array.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 21,  56 => 19,  48 => 17,  45 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/*     {% for key, val in value %}*/
/*         {% if field_description.options.safe %}*/
/*             [{{ key }} => {{ val|raw }}]*/
/*         {% else %}*/
/*             [{{ key }} => {{ val }}]*/
/*         {% endif %}*/
/*     {% endfor %}*/
/* {% endblock %}*/
/* */
