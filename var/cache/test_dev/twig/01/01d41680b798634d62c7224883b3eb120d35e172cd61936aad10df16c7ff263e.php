<?php

/* SonataBlockBundle:Block:block_core_text.html.twig */
class __TwigTemplate_2dd7f67265085f1dc7cdac30f52ed6967848ff1d4b61b898b68c5d431558e12e extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataBlockBundle:Block:block_core_text.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ed9e1d44b84b7d2eaea3743cfbe300352390eb8e5ba05cba5f107e1d58add3e1 = $this->env->getExtension("native_profiler");
        $__internal_ed9e1d44b84b7d2eaea3743cfbe300352390eb8e5ba05cba5f107e1d58add3e1->enter($__internal_ed9e1d44b84b7d2eaea3743cfbe300352390eb8e5ba05cba5f107e1d58add3e1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_core_text.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ed9e1d44b84b7d2eaea3743cfbe300352390eb8e5ba05cba5f107e1d58add3e1->leave($__internal_ed9e1d44b84b7d2eaea3743cfbe300352390eb8e5ba05cba5f107e1d58add3e1_prof);

    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        $__internal_2399b92203db6af4a2d5e67c5400bcfdf58adb0dcc3afecada7125e130b47246 = $this->env->getExtension("native_profiler");
        $__internal_2399b92203db6af4a2d5e67c5400bcfdf58adb0dcc3afecada7125e130b47246->enter($__internal_2399b92203db6af4a2d5e67c5400bcfdf58adb0dcc3afecada7125e130b47246_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 15
        echo "    ";
        echo $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "content", array());
        echo "
";
        
        $__internal_2399b92203db6af4a2d5e67c5400bcfdf58adb0dcc3afecada7125e130b47246->leave($__internal_2399b92203db6af4a2d5e67c5400bcfdf58adb0dcc3afecada7125e130b47246_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_core_text.html.twig";
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
/*     {{ settings.content|raw }}*/
/* {% endblock %}*/
/* */
