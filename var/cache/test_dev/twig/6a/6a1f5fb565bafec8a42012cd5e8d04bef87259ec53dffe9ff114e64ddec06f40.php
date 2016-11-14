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
        $__internal_357e663381b2857aedc8f9fae822bd2238721553e83dfd8a38b8aa4149967893 = $this->env->getExtension("native_profiler");
        $__internal_357e663381b2857aedc8f9fae822bd2238721553e83dfd8a38b8aa4149967893->enter($__internal_357e663381b2857aedc8f9fae822bd2238721553e83dfd8a38b8aa4149967893_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_boolean.html.twig"));

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
        
        $__internal_357e663381b2857aedc8f9fae822bd2238721553e83dfd8a38b8aa4149967893->leave($__internal_357e663381b2857aedc8f9fae822bd2238721553e83dfd8a38b8aa4149967893_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_0136ae5f97ea843cc9ec3dfd5ac7d32281c1f283b4f1b35f5592401c1765c342 = $this->env->getExtension("native_profiler");
        $__internal_0136ae5f97ea843cc9ec3dfd5ac7d32281c1f283b4f1b35f5592401c1765c342->enter($__internal_0136ae5f97ea843cc9ec3dfd5ac7d32281c1f283b4f1b35f5592401c1765c342_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget');
        
        $__internal_0136ae5f97ea843cc9ec3dfd5ac7d32281c1f283b4f1b35f5592401c1765c342->leave($__internal_0136ae5f97ea843cc9ec3dfd5ac7d32281c1f283b4f1b35f5592401c1765c342_prof);

    }

    // line 15
    public function block_label($context, array $blocks = array())
    {
        $__internal_0aee54180abcab4931350ce3fae1d657f183ac0e6b5c14ea39c2959d7c631679 = $this->env->getExtension("native_profiler");
        $__internal_0aee54180abcab4931350ce3fae1d657f183ac0e6b5c14ea39c2959d7c631679->enter($__internal_0aee54180abcab4931350ce3fae1d657f183ac0e6b5c14ea39c2959d7c631679_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "label"));

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
        
        $__internal_0aee54180abcab4931350ce3fae1d657f183ac0e6b5c14ea39c2959d7c631679->leave($__internal_0aee54180abcab4931350ce3fae1d657f183ac0e6b5c14ea39c2959d7c631679_prof);

    }

    // line 25
    public function block_errors($context, array $blocks = array())
    {
        $__internal_e291f3c2ca7adad2e78422377192ca7fcb2ace631c3fc0cd99c9414e8851aea2 = $this->env->getExtension("native_profiler");
        $__internal_e291f3c2ca7adad2e78422377192ca7fcb2ace631c3fc0cd99c9414e8851aea2->enter($__internal_e291f3c2ca7adad2e78422377192ca7fcb2ace631c3fc0cd99c9414e8851aea2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "errors"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'errors');
        
        $__internal_e291f3c2ca7adad2e78422377192ca7fcb2ace631c3fc0cd99c9414e8851aea2->leave($__internal_e291f3c2ca7adad2e78422377192ca7fcb2ace631c3fc0cd99c9414e8851aea2_prof);

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
