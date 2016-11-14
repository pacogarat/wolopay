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
        $__internal_219cfecb9fb59f6e429a01dac7f0b483c9df8a801c36e6d6d1f821e3c9fde325 = $this->env->getExtension("native_profiler");
        $__internal_219cfecb9fb59f6e429a01dac7f0b483c9df8a801c36e6d6d1f821e3c9fde325->enter($__internal_219cfecb9fb59f6e429a01dac7f0b483c9df8a801c36e6d6d1f821e3c9fde325_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:history.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_219cfecb9fb59f6e429a01dac7f0b483c9df8a801c36e6d6d1f821e3c9fde325->leave($__internal_219cfecb9fb59f6e429a01dac7f0b483c9df8a801c36e6d6d1f821e3c9fde325_prof);

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
