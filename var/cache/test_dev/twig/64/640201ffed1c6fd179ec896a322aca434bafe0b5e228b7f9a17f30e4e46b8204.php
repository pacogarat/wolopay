<?php

/* SonataAdminBundle:CRUD:show.html.twig */
class __TwigTemplate_bdd3bcc4af8237bbbd7aac0e46c89c862e013aa4a3540b6c93fd0077f8ee79a4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show.html.twig", "SonataAdminBundle:CRUD:show.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a88a6eae640af319413c2e8abef5f589404b765ef867202b34e666e99157054a = $this->env->getExtension("native_profiler");
        $__internal_a88a6eae640af319413c2e8abef5f589404b765ef867202b34e666e99157054a->enter($__internal_a88a6eae640af319413c2e8abef5f589404b765ef867202b34e666e99157054a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a88a6eae640af319413c2e8abef5f589404b765ef867202b34e666e99157054a->leave($__internal_a88a6eae640af319413c2e8abef5f589404b765ef867202b34e666e99157054a_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_show.html.twig' %}*/
/* */
