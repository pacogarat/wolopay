<?php

/* SonataAdminBundle:CRUD:history.html.twig */
class __TwigTemplate_e8c44904406dc841ed0a3f93a9f856c579977a241deb1d391904e1520773cf81 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_history.html.twig", "SonataAdminBundle:CRUD:history.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_history.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ab60e427f76c54ecac05329121004ddbf2b285cd33225a0678052dbc6922fccf = $this->env->getExtension("native_profiler");
        $__internal_ab60e427f76c54ecac05329121004ddbf2b285cd33225a0678052dbc6922fccf->enter($__internal_ab60e427f76c54ecac05329121004ddbf2b285cd33225a0678052dbc6922fccf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:history.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ab60e427f76c54ecac05329121004ddbf2b285cd33225a0678052dbc6922fccf->leave($__internal_ab60e427f76c54ecac05329121004ddbf2b285cd33225a0678052dbc6922fccf_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:history.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_history.html.twig' %}*/
/* */
