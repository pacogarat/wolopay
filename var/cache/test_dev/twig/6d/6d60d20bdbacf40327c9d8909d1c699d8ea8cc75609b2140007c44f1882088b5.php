<?php

/* SonataIntlBundle:CRUD:history_revision_timestamp.html.twig */
class __TwigTemplate_b9280ddbba65f8f57a638b17dcf53d1ed0d898cd70ad415c46b30fcfa33b1d82 extends Twig_Template
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
        $__internal_cf49185de9c6f38b609426864e4c76d48ff762035366e5e9c2c5129097938d22 = $this->env->getExtension("native_profiler");
        $__internal_cf49185de9c6f38b609426864e4c76d48ff762035366e5e9c2c5129097938d22->enter($__internal_cf49185de9c6f38b609426864e4c76d48ff762035366e5e9c2c5129097938d22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataIntlBundle:CRUD:history_revision_timestamp.html.twig"));

        // line 11
        echo "
";
        // line 12
        echo $this->env->getExtension('sonata_intl_datetime')->formatDatetime($this->getAttribute((isset($context["revision"]) ? $context["revision"] : $this->getContext($context, "revision")), "timestamp", array()));
        echo "
";
        
        $__internal_cf49185de9c6f38b609426864e4c76d48ff762035366e5e9c2c5129097938d22->leave($__internal_cf49185de9c6f38b609426864e4c76d48ff762035366e5e9c2c5129097938d22_prof);

    }

    public function getTemplateName()
    {
        return "SonataIntlBundle:CRUD:history_revision_timestamp.html.twig";
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
/* {{ revision.timestamp | format_datetime }}*/
/* */