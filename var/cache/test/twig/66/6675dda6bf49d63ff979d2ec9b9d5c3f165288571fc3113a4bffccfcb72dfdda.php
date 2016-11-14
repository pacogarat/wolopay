<?php

/* SonataAdminBundle:CRUD:list_currency.html.twig */
class __TwigTemplate_0a7f4213ee69ae5a7ddd28589ea31b3202157e82f37b25020775d9b114b787fc extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_currency.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_64f7c54fa8b74b47a8a9fc4f85f8edb4ceaaf39eb95f613f51fd56b4a573e99a = $this->env->getExtension("native_profiler");
        $__internal_64f7c54fa8b74b47a8a9fc4f85f8edb4ceaaf39eb95f613f51fd56b4a573e99a->enter($__internal_64f7c54fa8b74b47a8a9fc4f85f8edb4ceaaf39eb95f613f51fd56b4a573e99a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_currency.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_64f7c54fa8b74b47a8a9fc4f85f8edb4ceaaf39eb95f613f51fd56b4a573e99a->leave($__internal_64f7c54fa8b74b47a8a9fc4f85f8edb4ceaaf39eb95f613f51fd56b4a573e99a_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_a79a2dc03e5f4fba663c41f57d18f3c44762b92d8d95a24d7af7792330e58191 = $this->env->getExtension("native_profiler");
        $__internal_a79a2dc03e5f4fba663c41f57d18f3c44762b92d8d95a24d7af7792330e58191->enter($__internal_a79a2dc03e5f4fba663c41f57d18f3c44762b92d8d95a24d7af7792330e58191_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        if ( !(null === (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
            // line 16
            echo "        ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["field_description"]) ? $context["field_description"] : $this->getContext($context, "field_description")), "options", array()), "currency", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "
    ";
        }
        
        $__internal_a79a2dc03e5f4fba663c41f57d18f3c44762b92d8d95a24d7af7792330e58191->leave($__internal_a79a2dc03e5f4fba663c41f57d18f3c44762b92d8d95a24d7af7792330e58191_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_currency.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {% if value is not null %}*/
/*         {{ field_description.options.currency }} {{ value }}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
