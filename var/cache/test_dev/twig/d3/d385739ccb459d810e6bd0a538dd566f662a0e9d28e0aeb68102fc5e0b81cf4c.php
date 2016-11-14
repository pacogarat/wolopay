<?php

/* SonataAdminBundle:CRUD:acl.html.twig */
class __TwigTemplate_60f968f00393a673da2b98e76d4f5d0500101d1f1562841d32e1aa6215000b7a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_acl.html.twig", "SonataAdminBundle:CRUD:acl.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_acl.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_760c7c843657f1e3a346c0751b16bc74c621b4b32c29d6574e1de8a237de27f9 = $this->env->getExtension("native_profiler");
        $__internal_760c7c843657f1e3a346c0751b16bc74c621b4b32c29d6574e1de8a237de27f9->enter($__internal_760c7c843657f1e3a346c0751b16bc74c621b4b32c29d6574e1de8a237de27f9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:acl.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_760c7c843657f1e3a346c0751b16bc74c621b4b32c29d6574e1de8a237de27f9->leave($__internal_760c7c843657f1e3a346c0751b16bc74c621b4b32c29d6574e1de8a237de27f9_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:acl.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_acl.html.twig' %}*/
/* */
