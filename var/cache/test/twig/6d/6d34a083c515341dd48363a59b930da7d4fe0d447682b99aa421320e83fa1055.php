<?php

/* SonataAdminBundle:CRUD:list_array.html.twig */
class __TwigTemplate_10f836c49c77aed0962c447eb270c2176e269a8c94451a7e07fab4c4641ad64c extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_array.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ba6b288077211cd2c222ff7c3d7c0ef247303bd98f460dbf3c839bb7e68bf319 = $this->env->getExtension("native_profiler");
        $__internal_ba6b288077211cd2c222ff7c3d7c0ef247303bd98f460dbf3c839bb7e68bf319->enter($__internal_ba6b288077211cd2c222ff7c3d7c0ef247303bd98f460dbf3c839bb7e68bf319_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_array.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ba6b288077211cd2c222ff7c3d7c0ef247303bd98f460dbf3c839bb7e68bf319->leave($__internal_ba6b288077211cd2c222ff7c3d7c0ef247303bd98f460dbf3c839bb7e68bf319_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_62022f7b68c0189ed9ef8735517f8dc5b94ccf7bbc0d8997e9abe6a66036b4b0 = $this->env->getExtension("native_profiler");
        $__internal_62022f7b68c0189ed9ef8735517f8dc5b94ccf7bbc0d8997e9abe6a66036b4b0->enter($__internal_62022f7b68c0189ed9ef8735517f8dc5b94ccf7bbc0d8997e9abe6a66036b4b0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 16
            echo "        [";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo " => ";
            echo twig_escape_filter($this->env, $context["val"], "html", null, true);
            echo "]
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_62022f7b68c0189ed9ef8735517f8dc5b94ccf7bbc0d8997e9abe6a66036b4b0->leave($__internal_62022f7b68c0189ed9ef8735517f8dc5b94ccf7bbc0d8997e9abe6a66036b4b0_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_array.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {% for key, val in value %}*/
/*         [{{ key }} => {{ val }}]*/
/*     {% endfor %}*/
/* {% endblock %}*/
/* */
