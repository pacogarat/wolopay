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
        $__internal_f3da84e66185e60524109a50a8505c05d39489b47c6a62ac65bd7e8d2f136ea9 = $this->env->getExtension("native_profiler");
        $__internal_f3da84e66185e60524109a50a8505c05d39489b47c6a62ac65bd7e8d2f136ea9->enter($__internal_f3da84e66185e60524109a50a8505c05d39489b47c6a62ac65bd7e8d2f136ea9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Core:create_button.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f3da84e66185e60524109a50a8505c05d39489b47c6a62ac65bd7e8d2f136ea9->leave($__internal_f3da84e66185e60524109a50a8505c05d39489b47c6a62ac65bd7e8d2f136ea9_prof);

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
