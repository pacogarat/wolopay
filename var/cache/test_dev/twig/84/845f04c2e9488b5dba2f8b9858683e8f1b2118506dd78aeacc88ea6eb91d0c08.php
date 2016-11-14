<?php

/* SonataAdminBundle:CRUD:edit_file.html.twig */
class __TwigTemplate_8448e5c4157b1d6f245eb909e140dcbfe3302de5eed918b7678ac8433f51e6da extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_file.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ddb0e13854c77b1eb385b53e14ce5d47f645cdfba5c0284679d9d7b9d12a9500 = $this->env->getExtension("native_profiler");
        $__internal_ddb0e13854c77b1eb385b53e14ce5d47f645cdfba5c0284679d9d7b9d12a9500->enter($__internal_ddb0e13854c77b1eb385b53e14ce5d47f645cdfba5c0284679d9d7b9d12a9500_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_file.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ddb0e13854c77b1eb385b53e14ce5d47f645cdfba5c0284679d9d7b9d12a9500->leave($__internal_ddb0e13854c77b1eb385b53e14ce5d47f645cdfba5c0284679d9d7b9d12a9500_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_a0564980cdfb5d6d6db79cb7b9d579fea2770e8999788de4820f884a7e1a0d8c = $this->env->getExtension("native_profiler");
        $__internal_a0564980cdfb5d6d6db79cb7b9d579fea2770e8999788de4820f884a7e1a0d8c->enter($__internal_a0564980cdfb5d6d6db79cb7b9d579fea2770e8999788de4820f884a7e1a0d8c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_a0564980cdfb5d6d6db79cb7b9d579fea2770e8999788de4820f884a7e1a0d8c->leave($__internal_a0564980cdfb5d6d6db79cb7b9d579fea2770e8999788de4820f884a7e1a0d8c_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_file.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 14,  18 => 12,);
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
/* {% extends base_template %}*/
/* */
/* {% block field %}{{ form_widget(field_element, {'attr': {'class' : 'title'}}) }}{% endblock %}*/
/* */
