<?php

/* SonataAdminBundle:Core:create_button.html.twig */
class __TwigTemplate_6b9f2b95c89eb68224cd001b826458bdf4d29a1061ebf2d4b9ed1e3882ac4bec extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 15
        $this->parent = $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:Core:create_button.html.twig", 15);
        $this->blocks = array(
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:Button:create_button.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_085302733a6fd6f2fc4de96b851f6b4b7e7867c52ce348b28cdf0b17117505da = $this->env->getExtension("native_profiler");
        $__internal_085302733a6fd6f2fc4de96b851f6b4b7e7867c52ce348b28cdf0b17117505da->enter($__internal_085302733a6fd6f2fc4de96b851f6b4b7e7867c52ce348b28cdf0b17117505da_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Core:create_button.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_085302733a6fd6f2fc4de96b851f6b4b7e7867c52ce348b28cdf0b17117505da->leave($__internal_085302733a6fd6f2fc4de96b851f6b4b7e7867c52ce348b28cdf0b17117505da_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Core:create_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  11 => 15,);
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
/* {# DEPRECATED #}*/
/* {# This file is kept here for backward compatibility - Rather use SonataAdminBundle:Button:create_button.html.twig #}*/
/* */
/* {% extends 'SonataAdminBundle:Button:create_button.html.twig' %}*/
