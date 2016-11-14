<?php

/* SonataAdminBundle:CRUD:list_string.html.twig */
class __TwigTemplate_909c9392db7e412fb444ed5401f231299b1eff2942c2c4fc46c620154baf0a17 extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_string.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e736b2d13c5e01b23a81e442c0f04a1a4096d37757443c659ed2ca2189c8a71a = $this->env->getExtension("native_profiler");
        $__internal_e736b2d13c5e01b23a81e442c0f04a1a4096d37757443c659ed2ca2189c8a71a->enter($__internal_e736b2d13c5e01b23a81e442c0f04a1a4096d37757443c659ed2ca2189c8a71a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_string.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e736b2d13c5e01b23a81e442c0f04a1a4096d37757443c659ed2ca2189c8a71a->leave($__internal_e736b2d13c5e01b23a81e442c0f04a1a4096d37757443c659ed2ca2189c8a71a_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_string.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  9 => 12,);
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
/* {% extends admin.getTemplate('base_list_field') %}*/
/* */
