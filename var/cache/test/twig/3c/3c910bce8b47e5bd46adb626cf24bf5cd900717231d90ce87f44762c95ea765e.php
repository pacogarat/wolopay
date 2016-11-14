<?php

/* SonataAdminBundle:CRUD:edit.html.twig */
class __TwigTemplate_0a99b5276db485c6c47391ecf6da58a551e934560c03369f56d646186fd3b0d0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig", "SonataAdminBundle:CRUD:edit.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_dcd5960fdbbe817aa109a3f06cead230650c4e872c1b22b49352e300bb3e5a91 = $this->env->getExtension("native_profiler");
        $__internal_dcd5960fdbbe817aa109a3f06cead230650c4e872c1b22b49352e300bb3e5a91->enter($__internal_dcd5960fdbbe817aa109a3f06cead230650c4e872c1b22b49352e300bb3e5a91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_dcd5960fdbbe817aa109a3f06cead230650c4e872c1b22b49352e300bb3e5a91->leave($__internal_dcd5960fdbbe817aa109a3f06cead230650c4e872c1b22b49352e300bb3e5a91_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit.html.twig";
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
/* {% extends 'SonataAdminBundle:CRUD:base_edit.html.twig' %}*/
/* */
