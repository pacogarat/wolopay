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
        $__internal_dcd200c78030ba6459a3dfd9507b956833bf61105c0fe81fa29cede3c74b76dd = $this->env->getExtension("native_profiler");
        $__internal_dcd200c78030ba6459a3dfd9507b956833bf61105c0fe81fa29cede3c74b76dd->enter($__internal_dcd200c78030ba6459a3dfd9507b956833bf61105c0fe81fa29cede3c74b76dd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list__select.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_dcd200c78030ba6459a3dfd9507b956833bf61105c0fe81fa29cede3c74b76dd->leave($__internal_dcd200c78030ba6459a3dfd9507b956833bf61105c0fe81fa29cede3c74b76dd_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_11276079c2304ce81ce4ae34524f940131c4f9a9a62910f0279c49f516345a38 = $this->env->getExtension("native_profiler");
        $__internal_11276079c2304ce81ce4ae34524f940131c4f9a9a62910f0279c49f516345a38->enter($__internal_11276079c2304ce81ce4ae34524f940131c4f9a9a62910f0279c49f516345a38_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <a class=\"btn btn-default\" href=\"#\">
        <i class=\"glyphicon glyphicon-arrow-right\"></i>
        ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("list_select", array(), "SonataAdminBundle"), "html", null, true);
        echo "
    </a>
";
        
        $__internal_11276079c2304ce81ce4ae34524f940131c4f9a9a62910f0279c49f516345a38->leave($__internal_11276079c2304ce81ce4ae34524f940131c4f9a9a62910f0279c49f516345a38_prof);

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
