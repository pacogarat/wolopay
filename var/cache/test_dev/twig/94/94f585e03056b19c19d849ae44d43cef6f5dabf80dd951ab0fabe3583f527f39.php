<?php

/* SonataBlockBundle:Block:block_base.html.twig */
class __TwigTemplate_267a68e904d0a88255ee71f79160d3da46314473099186d604bb1d28d90481b2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_af69d8a8e0230045d769d8bef14a63e0253d6415ef28fd1c9fd80cec866d9b97 = $this->env->getExtension("native_profiler");
        $__internal_af69d8a8e0230045d769d8bef14a63e0253d6415ef28fd1c9fd80cec866d9b97->enter($__internal_af69d8a8e0230045d769d8bef14a63e0253d6415ef28fd1c9fd80cec866d9b97_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_base.html.twig"));

        // line 11
        echo "<div id=\"cms-block-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
        echo "\" class=\"cms-block cms-block-element\">
    ";
        // line 12
        $this->displayBlock('block', $context, $blocks);
        // line 13
        echo "</div>
";
        
        $__internal_af69d8a8e0230045d769d8bef14a63e0253d6415ef28fd1c9fd80cec866d9b97->leave($__internal_af69d8a8e0230045d769d8bef14a63e0253d6415ef28fd1c9fd80cec866d9b97_prof);

    }

    // line 12
    public function block_block($context, array $blocks = array())
    {
        $__internal_2196d07b0210278e65c350783ed77d7670d63a6b6763e62760528f332da38cbe = $this->env->getExtension("native_profiler");
        $__internal_2196d07b0210278e65c350783ed77d7670d63a6b6763e62760528f332da38cbe->enter($__internal_2196d07b0210278e65c350783ed77d7670d63a6b6763e62760528f332da38cbe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        echo "EMPTY CONTENT";
        
        $__internal_2196d07b0210278e65c350783ed77d7670d63a6b6763e62760528f332da38cbe->leave($__internal_2196d07b0210278e65c350783ed77d7670d63a6b6763e62760528f332da38cbe_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 12,  30 => 13,  28 => 12,  23 => 11,);
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
/* <div id="cms-block-{{ block.id }}" class="cms-block cms-block-element">*/
/*     {% block block %}EMPTY CONTENT{% endblock %}*/
/* </div>*/
/* */
