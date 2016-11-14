<?php

/* SonataAdminBundle:CRUD:history_revision_timestamp.html.twig */
class __TwigTemplate_e34ded4142ea1e4624448e1aa6045ea00a7a63b4ed8ed6d3d9caf6b43314cf0f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e5fbb97890fd97761c68cbf136043a5c08c7ae06a92dc2ac048584ba37f8f1d6 = $this->env->getExtension("native_profiler");
        $__internal_e5fbb97890fd97761c68cbf136043a5c08c7ae06a92dc2ac048584ba37f8f1d6->enter($__internal_e5fbb97890fd97761c68cbf136043a5c08c7ae06a92dc2ac048584ba37f8f1d6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:history_revision_timestamp.html.twig"));

        // line 11
        echo "
";
        // line 12
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "timestamp", array())), "html", null, true);
        echo "
";
        
        $__internal_e5fbb97890fd97761c68cbf136043a5c08c7ae06a92dc2ac048584ba37f8f1d6->leave($__internal_e5fbb97890fd97761c68cbf136043a5c08c7ae06a92dc2ac048584ba37f8f1d6_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:history_revision_timestamp.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 12,  22 => 11,);
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
/* {{ revision.timestamp | date }}*/
/* */
