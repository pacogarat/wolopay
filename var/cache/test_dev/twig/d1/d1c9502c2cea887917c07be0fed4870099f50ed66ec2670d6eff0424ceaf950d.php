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
        $__internal_48317560ea6ac6cb0daa624789429f4ad3e7a6cf72bc6c041e08db42b891180f = $this->env->getExtension("native_profiler");
        $__internal_48317560ea6ac6cb0daa624789429f4ad3e7a6cf72bc6c041e08db42b891180f->enter($__internal_48317560ea6ac6cb0daa624789429f4ad3e7a6cf72bc6c041e08db42b891180f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:history_revision_timestamp.html.twig"));

        // line 11
        echo "
";
        // line 12
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "timestamp", array())), "html", null, true);
        echo "
";
        
        $__internal_48317560ea6ac6cb0daa624789429f4ad3e7a6cf72bc6c041e08db42b891180f->leave($__internal_48317560ea6ac6cb0daa624789429f4ad3e7a6cf72bc6c041e08db42b891180f_prof);

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
