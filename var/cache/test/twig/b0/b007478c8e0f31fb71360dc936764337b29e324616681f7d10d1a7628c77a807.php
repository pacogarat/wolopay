<?php

/* SonataAdminBundle:Pager:results.html.twig */
class __TwigTemplate_68db9e3f9022d5637de0462a5af60a76354f7c5c38b4c97adcc863a8abbc9888 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:Pager:base_results.html.twig", "SonataAdminBundle:Pager:results.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:Pager:base_results.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_1814d900375b760363fe83e2d89b2ce35aa1df3b2f149476c2485fd50b34783b = $this->env->getExtension("native_profiler");
        $__internal_1814d900375b760363fe83e2d89b2ce35aa1df3b2f149476c2485fd50b34783b->enter($__internal_1814d900375b760363fe83e2d89b2ce35aa1df3b2f149476c2485fd50b34783b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Pager:results.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1814d900375b760363fe83e2d89b2ce35aa1df3b2f149476c2485fd50b34783b->leave($__internal_1814d900375b760363fe83e2d89b2ce35aa1df3b2f149476c2485fd50b34783b_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Pager:results.html.twig";
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
/* {% extends 'SonataAdminBundle:Pager:base_results.html.twig' %}*/
/* */
