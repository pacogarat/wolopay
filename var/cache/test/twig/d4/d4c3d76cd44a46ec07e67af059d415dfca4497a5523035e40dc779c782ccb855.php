<?php

/* SonataAdminBundle:CRUD:list__select.html.twig */
class __TwigTemplate_d1feedabe73d554a1e27c824dba4771890f68e5e2b25c8d9293e06c7c3934a62 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list__select.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_fe25de61ea88eed1499da0b99dff4147fbe361e1b0deca7514efd938cb9653ac = $this->env->getExtension("native_profiler");
        $__internal_fe25de61ea88eed1499da0b99dff4147fbe361e1b0deca7514efd938cb9653ac->enter($__internal_fe25de61ea88eed1499da0b99dff4147fbe361e1b0deca7514efd938cb9653ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list__select.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fe25de61ea88eed1499da0b99dff4147fbe361e1b0deca7514efd938cb9653ac->leave($__internal_fe25de61ea88eed1499da0b99dff4147fbe361e1b0deca7514efd938cb9653ac_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_546327ed360844c18206edaccd1f3c129f6f64ad4553ed011f009120be3c46de = $this->env->getExtension("native_profiler");
        $__internal_546327ed360844c18206edaccd1f3c129f6f64ad4553ed011f009120be3c46de->enter($__internal_546327ed360844c18206edaccd1f3c129f6f64ad4553ed011f009120be3c46de_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <a class=\"btn btn-default\" href=\"#\">
        <i class=\"glyphicon glyphicon-arrow-right\"></i>
        ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("list_select", array(), "SonataAdminBundle"), "html", null, true);
        echo "
    </a>
";
        
        $__internal_546327ed360844c18206edaccd1f3c129f6f64ad4553ed011f009120be3c46de->leave($__internal_546327ed360844c18206edaccd1f3c129f6f64ad4553ed011f009120be3c46de_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list__select.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 17,  39 => 15,  33 => 14,  18 => 12,);
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
/*     <a class="btn btn-default" href="#">*/
/*         <i class="glyphicon glyphicon-arrow-right"></i>*/
/*         {{ 'list_select'|trans({}, 'SonataAdminBundle') }}*/
/*     </a>*/
/* {% endblock %}*/
/* */
