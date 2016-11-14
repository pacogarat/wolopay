<?php

/* SonataAdminBundle:CRUD:list.html.twig */
class __TwigTemplate_73936866308d109ddb986566d1de4d9039bb585b1c1f0587956cc320eba52ff2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list.html.twig", "SonataAdminBundle:CRUD:list.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9331321d3a44fc0f88b5ae7637419d11d6c837f95529044ae761228b48b280b1 = $this->env->getExtension("native_profiler");
        $__internal_9331321d3a44fc0f88b5ae7637419d11d6c837f95529044ae761228b48b280b1->enter($__internal_9331321d3a44fc0f88b5ae7637419d11d6c837f95529044ae761228b48b280b1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9331321d3a44fc0f88b5ae7637419d11d6c837f95529044ae761228b48b280b1->leave($__internal_9331321d3a44fc0f88b5ae7637419d11d6c837f95529044ae761228b48b280b1_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:base_list.html.twig' %}*/
/* */
