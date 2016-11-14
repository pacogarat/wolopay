<?php

/* SonataAdminBundle:Pager:links.html.twig */
class __TwigTemplate_cfc105771c357429cd40277ba296ecbca915c17b2ac92580ec4a07fe49bcded5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:Pager:base_links.html.twig", "SonataAdminBundle:Pager:links.html.twig", 12);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:Pager:base_links.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_50a3f684503867b34771447118cc6940afd1ed3518125fe1fce991841d86e1fa = $this->env->getExtension("native_profiler");
        $__internal_50a3f684503867b34771447118cc6940afd1ed3518125fe1fce991841d86e1fa->enter($__internal_50a3f684503867b34771447118cc6940afd1ed3518125fe1fce991841d86e1fa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Pager:links.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_50a3f684503867b34771447118cc6940afd1ed3518125fe1fce991841d86e1fa->leave($__internal_50a3f684503867b34771447118cc6940afd1ed3518125fe1fce991841d86e1fa_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Pager:links.html.twig";
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
/* {% extends 'SonataAdminBundle:Pager:base_links.html.twig' %}*/
/* */
