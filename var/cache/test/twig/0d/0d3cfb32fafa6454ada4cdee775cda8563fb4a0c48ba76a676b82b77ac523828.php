<?php

/* SonataAdminBundle:CRUD:base_filter_field.html.twig */
class __TwigTemplate_c8f2758c4e5b375f39820473b8d05499228772d0a938ed56ffaa921bf8a8a5a6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'label' => array($this, 'block_label'),
            'field' => array($this, 'block_field'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_aa878f22589639ae75b450d0f17a6bcd267e1563c9e9165063f2b3746bbc2578 = $this->env->getExtension("native_profiler");
        $__internal_aa878f22589639ae75b450d0f17a6bcd267e1563c9e9165063f2b3746bbc2578->enter($__internal_aa878f22589639ae75b450d0f17a6bcd267e1563c9e9165063f2b3746bbc2578_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_filter_field.html.twig"));

        // line 11
        echo "

<div>
    ";
        // line 14
        $this->displayBlock('label', $context, $blocks);
        // line 22
        echo "
    <div class=\"sonata-ba-field";
        // line 23
        if ($this->getAttribute($this->getAttribute((isset($context["filter_form"]) ? $context["filter_form"] : $this->getContext($context, "filter_form")), "vars", array()), "errors", array())) {
            echo " sonata-ba-field-error";
        }
        echo "\">
        ";
        // line 24
        $this->displayBlock('field', $context, $blocks);
        // line 25
        echo "    </div>
</div>
";
        
        $__internal_aa878f22589639ae75b450d0f17a6bcd267e1563c9e9165063f2b3746bbc2578->leave($__internal_aa878f22589639ae75b450d0f17a6bcd267e1563c9e9165063f2b3746bbc2578_prof);

    }

    // line 14
    public function block_label($context, array $blocks = array())
    {
        $__internal_4b652f1426c6ccbdf317ec9086a42f19fcf7d1f89e7ba05528e3bab1a40938c1 = $this->env->getExtension("native_profiler");
        $__internal_4b652f1426c6ccbdf317ec9086a42f19fcf7d1f89e7ba05528e3bab1a40938c1->enter($__internal_4b652f1426c6ccbdf317ec9086a42f19fcf7d1f89e7ba05528e3bab1a40938c1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "label"));

        // line 15
        echo "        ";
        if ($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["filter"]) ? $context["filter"] : null), "fielddescription", array(), "any", false, true), "options", array(), "any", false, true), "name", array(), "any", true, true)) {
            // line 16
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["filter_form"]) ? $context["filter_form"] : $this->getContext($context, "filter_form")), 'label', (twig_test_empty($_label_ = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["filter"]) ? $context["filter"] : $this->getContext($context, "filter")), "fielddescription", array()), "options", array()), "name", array())) ? array() : array("label" => $_label_)));
            echo "
        ";
        } else {
            // line 18
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["filter_form"]) ? $context["filter_form"] : $this->getContext($context, "filter_form")), 'label');
            echo "
        ";
        }
        // line 20
        echo "        <br>
    ";
        
        $__internal_4b652f1426c6ccbdf317ec9086a42f19fcf7d1f89e7ba05528e3bab1a40938c1->leave($__internal_4b652f1426c6ccbdf317ec9086a42f19fcf7d1f89e7ba05528e3bab1a40938c1_prof);

    }

    // line 24
    public function block_field($context, array $blocks = array())
    {
        $__internal_8632221fa864c75b6acb8478f0df554bb97c515cc1623f91ceda4e0381f4e2f3 = $this->env->getExtension("native_profiler");
        $__internal_8632221fa864c75b6acb8478f0df554bb97c515cc1623f91ceda4e0381f4e2f3->enter($__internal_8632221fa864c75b6acb8478f0df554bb97c515cc1623f91ceda4e0381f4e2f3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["filter_form"]) ? $context["filter_form"] : $this->getContext($context, "filter_form")), 'widget');
        
        $__internal_8632221fa864c75b6acb8478f0df554bb97c515cc1623f91ceda4e0381f4e2f3->leave($__internal_8632221fa864c75b6acb8478f0df554bb97c515cc1623f91ceda4e0381f4e2f3_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_filter_field.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 24,  72 => 20,  66 => 18,  60 => 16,  57 => 15,  51 => 14,  42 => 25,  40 => 24,  34 => 23,  31 => 22,  29 => 14,  24 => 11,);
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
/* */
/* <div>*/
/*     {% block label %}*/
/*         {% if filter.fielddescription.options.name is defined %}*/
/*             {{ form_label(filter_form, filter.fielddescription.options.name) }}*/
/*         {% else %}*/
/*             {{ form_label(filter_form) }}*/
/*         {% endif %}*/
/*         <br>*/
/*     {% endblock %}*/
/* */
/*     <div class="sonata-ba-field{% if filter_form.vars.errors %} sonata-ba-field-error{% endif %}">*/
/*         {% block field %}{{ form_widget(filter_form) }}{% endblock %}*/
/*     </div>*/
/* </div>*/
/* */
