<?php

/* SonataBlockBundle:Block:block_core_menu.html.twig */
class __TwigTemplate_d3c21554b280d823802c7dde025557b391b7597cdf4dd7224e5000c38838d978 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataBlockBundle:Block:block_core_menu.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_040274f40d800050cc59afbfe2cc567130db5a3caffb0e3142667e5bb1ae2316 = $this->env->getExtension("native_profiler");
        $__internal_040274f40d800050cc59afbfe2cc567130db5a3caffb0e3142667e5bb1ae2316->enter($__internal_040274f40d800050cc59afbfe2cc567130db5a3caffb0e3142667e5bb1ae2316_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_core_menu.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_040274f40d800050cc59afbfe2cc567130db5a3caffb0e3142667e5bb1ae2316->leave($__internal_040274f40d800050cc59afbfe2cc567130db5a3caffb0e3142667e5bb1ae2316_prof);

    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        $__internal_699e37ddeef0b5223d601f986508daf47618bf87a2bc017edbe59272d481fce7 = $this->env->getExtension("native_profiler");
        $__internal_699e37ddeef0b5223d601f986508daf47618bf87a2bc017edbe59272d481fce7->enter($__internal_699e37ddeef0b5223d601f986508daf47618bf87a2bc017edbe59272d481fce7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 15
        echo "    ";
        echo $this->env->getExtension('knp_menu')->render((isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu")), (isset($context["menu_options"]) ? $context["menu_options"] : $this->getContext($context, "menu_options")));
        echo "
";
        
        $__internal_699e37ddeef0b5223d601f986508daf47618bf87a2bc017edbe59272d481fce7->leave($__internal_699e37ddeef0b5223d601f986508daf47618bf87a2bc017edbe59272d481fce7_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_core_menu.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 15,  33 => 14,  18 => 12,);
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
/* {% extends sonata_block.templates.block_base %}*/
/* */
/* {% block block %}*/
/*     {{ knp_menu_render(menu, menu_options) }}*/
/* {% endblock %}*/
/* */
