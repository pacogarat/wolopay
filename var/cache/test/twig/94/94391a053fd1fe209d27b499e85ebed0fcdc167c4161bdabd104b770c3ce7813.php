<?php

/* SonataAdminBundle:CRUD:list_inner_row.html.twig */
class __TwigTemplate_d83e9a5ddd016a0a09a0e68268a0e759190f64465ec2c1ee77e0940269e7bd69 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_list_inner_row.html.twig", "SonataAdminBundle:CRUD:list_inner_row.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_list_inner_row.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_bc75a3e10a0c75fddb4a8f6ad42e552fa5e78202721a902ba6e1caecc9b0cfc6 = $this->env->getExtension("native_profiler");
        $__internal_bc75a3e10a0c75fddb4a8f6ad42e552fa5e78202721a902ba6e1caecc9b0cfc6->enter($__internal_bc75a3e10a0c75fddb4a8f6ad42e552fa5e78202721a902ba6e1caecc9b0cfc6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_inner_row.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_bc75a3e10a0c75fddb4a8f6ad42e552fa5e78202721a902ba6e1caecc9b0cfc6->leave($__internal_bc75a3e10a0c75fddb4a8f6ad42e552fa5e78202721a902ba6e1caecc9b0cfc6_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_inner_row.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_list_inner_row.html.twig' %}*/
/* */
