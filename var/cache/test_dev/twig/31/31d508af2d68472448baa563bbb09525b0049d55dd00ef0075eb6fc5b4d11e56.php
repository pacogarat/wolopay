<?php

/* SonataAdminBundle:CRUD:show_compare.html.twig */
class __TwigTemplate_0eb5c046ad272db98200c0c411c3ba6e8eaa97bf01b17b19efe7f8da8fc21590 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_compare.html.twig", "SonataAdminBundle:CRUD:show_compare.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_compare.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e5632ae94c4666a983d58b7959fb95de32d10e0fbbfd525c4517461c3721c89c = $this->env->getExtension("native_profiler");
        $__internal_e5632ae94c4666a983d58b7959fb95de32d10e0fbbfd525c4517461c3721c89c->enter($__internal_e5632ae94c4666a983d58b7959fb95de32d10e0fbbfd525c4517461c3721c89c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:show_compare.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e5632ae94c4666a983d58b7959fb95de32d10e0fbbfd525c4517461c3721c89c->leave($__internal_e5632ae94c4666a983d58b7959fb95de32d10e0fbbfd525c4517461c3721c89c_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:show_compare.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_show_compare.html.twig' %}*/
/* */
