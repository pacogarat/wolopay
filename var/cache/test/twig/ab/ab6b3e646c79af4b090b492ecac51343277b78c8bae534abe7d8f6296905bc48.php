<?php

/* SonataBlockBundle:Block:block_core_action.html.twig */
class __TwigTemplate_9ef91960aa0a271ac8a20735dc022dc9697e2462073625322a2fa99157eb0553 extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataBlockBundle:Block:block_core_action.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_df56f1f21df79883decd2dd2ac2dd95f4013ca616352a94d2d87e14165f9dbae = $this->env->getExtension("native_profiler");
        $__internal_df56f1f21df79883decd2dd2ac2dd95f4013ca616352a94d2d87e14165f9dbae->enter($__internal_df56f1f21df79883decd2dd2ac2dd95f4013ca616352a94d2d87e14165f9dbae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_core_action.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_df56f1f21df79883decd2dd2ac2dd95f4013ca616352a94d2d87e14165f9dbae->leave($__internal_df56f1f21df79883decd2dd2ac2dd95f4013ca616352a94d2d87e14165f9dbae_prof);

    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        $__internal_aa7af2784fc9f11843f26b46c575e82200ceed33250b61d9c156e6f952c93235 = $this->env->getExtension("native_profiler");
        $__internal_aa7af2784fc9f11843f26b46c575e82200ceed33250b61d9c156e6f952c93235->enter($__internal_aa7af2784fc9f11843f26b46c575e82200ceed33250b61d9c156e6f952c93235_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 15
        echo "    ";
        echo (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content"));
        echo "
";
        
        $__internal_aa7af2784fc9f11843f26b46c575e82200ceed33250b61d9c156e6f952c93235->leave($__internal_aa7af2784fc9f11843f26b46c575e82200ceed33250b61d9c156e6f952c93235_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_core_action.html.twig";
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
/*     {{ content|raw }}*/
/* {% endblock %}*/
/* */
