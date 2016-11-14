<?php

/* SonataAdminBundle:CRUD:show_percent.html.twig */
class __TwigTemplate_cbf57df128bfdf6137d38be67c4f2a5e5afba1d88d7d80cfdb9f1878e5491376 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "SonataAdminBundle:CRUD:show_percent.html.twig", 12);
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
        $__internal_2342086b3d1fd95c0dc5374a0461ffa4652e3d12ffe170c3586458020bafd0f8 = $this->env->getExtension("native_profiler");
        $__internal_2342086b3d1fd95c0dc5374a0461ffa4652e3d12ffe170c3586458020bafd0f8->enter($__internal_2342086b3d1fd95c0dc5374a0461ffa4652e3d12ffe170c3586458020bafd0f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_percent.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2342086b3d1fd95c0dc5374a0461ffa4652e3d12ffe170c3586458020bafd0f8->leave($__internal_2342086b3d1fd95c0dc5374a0461ffa4652e3d12ffe170c3586458020bafd0f8_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_ada28684710c8627b1186598571f137af4c18496f5db7a535239b441a2b0e52a = $this->env->getExtension("native_profiler");
        $__internal_ada28684710c8627b1186598571f137af4c18496f5db7a535239b441a2b0e52a->enter($__internal_ada28684710c8627b1186598571f137af4c18496f5db7a535239b441a2b0e52a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context["value"] = ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")) * 100);
        // line 16
        echo "    ";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo " %
";
        
        $__internal_ada28684710c8627b1186598571f137af4c18496f5db7a535239b441a2b0e52a->leave($__internal_ada28684710c8627b1186598571f137af4c18496f5db7a535239b441a2b0e52a_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_percent.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 16,  40 => 15,  34 => 14,  11 => 12,);
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
/* {% block field %}*/
/*     {% set value = value * 100 %}*/
/*     {{ value }} %*/
/* {% endblock %}*/
/* */
