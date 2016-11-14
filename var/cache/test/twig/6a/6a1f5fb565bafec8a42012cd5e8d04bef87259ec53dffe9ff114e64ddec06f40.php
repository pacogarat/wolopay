<?php

/* SonataAdminBundle:CRUD:edit_boolean.html.twig */
class __TwigTemplate_af130cf8eee8c8ba6675af069d9c4b47125719cd36ae4a3485f218c5ad4f3573 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'field' => array($this, 'block_field'),
            'label' => array($this, 'block_label'),
            'errors' => array($this, 'block_errors'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e2da8853cef0b403032a85a6f673713abaff32337b69fcb22310bfbb5333009e = $this->env->getExtension("native_profiler");
        $__internal_e2da8853cef0b403032a85a6f673713abaff32337b69fcb22310bfbb5333009e->enter($__internal_e2da8853cef0b403032a85a6f673713abaff32337b69fcb22310bfbb5333009e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_boolean.html.twig"));

        // line 11
        echo "
<div>
    <div class=\"sonata-ba-field ";
        // line 13
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), "vars", array()), "errors", array())) > 0)) {
            echo "sonata-ba-field-error";
        }
        echo "\">
        ";
        // line 14
        $this->displayBlock('field', $context, $blocks);
        // line 15
        echo "        ";
        $this->displayBlock('label', $context, $blocks);
        // line 23
        echo "
        <div class=\"sonata-ba-field-error-messages\">
            ";
        // line 25
        $this->displayBlock('errors', $context, $blocks);
        // line 26
        echo "        </div>

    </div>
</div>
";
        
        $__internal_e2da8853cef0b403032a85a6f673713abaff32337b69fcb22310bfbb5333009e->leave($__internal_e2da8853cef0b403032a85a6f673713abaff32337b69fcb22310bfbb5333009e_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_a3653365648240009597f0ee7e1fad99fc34e9fff2016c0c3db6068ad669cd91 = $this->env->getExtension("native_profiler");
        $__internal_a3653365648240009597f0ee7e1fad99fc34e9fff2016c0c3db6068ad669cd91->enter($__internal_a3653365648240009597f0ee7e1fad99fc34e9fff2016c0c3db6068ad669cd91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget');
        
        $__internal_a3653365648240009597f0ee7e1fad99fc34e9fff2016c0c3db6068ad669cd91->leave($__internal_a3653365648240009597f0ee7e1fad99fc34e9fff2016c0c3db6068ad669cd91_prof);

    }

    // line 15
    public function block_label($context, array $blocks = array())
    {
        $__internal_7a599842e473e5d87c5ff10d553540fca428af2c49d73f46118912d4a4003425 = $this->env->getExtension("native_profiler");
        $__internal_7a599842e473e5d87c5ff10d553540fca428af2c49d73f46118912d4a4003425->enter($__internal_7a599842e473e5d87c5ff10d553540fca428af2c49d73f46118912d4a4003425_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "label"));

        // line 16
        echo "            ";
        if ($this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : null), "options", array(), "any", false, true), "name", array(), "any", true, true)) {
            // line 17
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'label', (twig_test_empty($_label_ = $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "name", array())) ? array() : array("label" => $_label_)));
            echo "
            ";
        } else {
            // line 19
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'label');
            echo "
            ";
        }
        // line 21
        echo "            <br>
        ";
        
        $__internal_7a599842e473e5d87c5ff10d553540fca428af2c49d73f46118912d4a4003425->leave($__internal_7a599842e473e5d87c5ff10d553540fca428af2c49d73f46118912d4a4003425_prof);

    }

    // line 25
    public function block_errors($context, array $blocks = array())
    {
        $__internal_22df7adc7e159605174d0069c3ced6b346740cecbf31b595546574513508598d = $this->env->getExtension("native_profiler");
        $__internal_22df7adc7e159605174d0069c3ced6b346740cecbf31b595546574513508598d->enter($__internal_22df7adc7e159605174d0069c3ced6b346740cecbf31b595546574513508598d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "errors"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'errors');
        
        $__internal_22df7adc7e159605174d0069c3ced6b346740cecbf31b595546574513508598d->leave($__internal_22df7adc7e159605174d0069c3ced6b346740cecbf31b595546574513508598d_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_boolean.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 25,  90 => 21,  84 => 19,  78 => 17,  75 => 16,  69 => 15,  57 => 14,  46 => 26,  44 => 25,  40 => 23,  37 => 15,  35 => 14,  29 => 13,  25 => 11,);
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
/* <div>*/
/*     <div class="sonata-ba-field {% if field_element.vars.errors|length > 0 %}sonata-ba-field-error{% endif %}">*/
/*         {% block field %}{{ form_widget(field_element) }}{% endblock %}*/
/*         {% block label %}*/
/*             {% if field_description.options.name is defined %}*/
/*                 {{ form_label(field_element, field_description.options.name) }}*/
/*             {% else %}*/
/*                 {{ form_label(field_element) }}*/
/*             {% endif %}*/
/*             <br>*/
/*         {% endblock %}*/
/* */
/*         <div class="sonata-ba-field-error-messages">*/
/*             {% block errors %}{{ form_errors(field_element) }}{% endblock %}*/
/*         </div>*/
/* */
/*     </div>*/
/* </div>*/
/* */
