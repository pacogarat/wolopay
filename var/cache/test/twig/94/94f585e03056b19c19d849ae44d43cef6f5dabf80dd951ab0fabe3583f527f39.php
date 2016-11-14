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
        $__internal_84413ce6039c8a40429a552337b2cf49ab130fcfd071e2ae75a11f10a617fe0b = $this->env->getExtension("native_profiler");
        $__internal_84413ce6039c8a40429a552337b2cf49ab130fcfd071e2ae75a11f10a617fe0b->enter($__internal_84413ce6039c8a40429a552337b2cf49ab130fcfd071e2ae75a11f10a617fe0b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_base.html.twig"));

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
        
        $__internal_84413ce6039c8a40429a552337b2cf49ab130fcfd071e2ae75a11f10a617fe0b->leave($__internal_84413ce6039c8a40429a552337b2cf49ab130fcfd071e2ae75a11f10a617fe0b_prof);

    }

    // line 12
    public function block_block($context, array $blocks = array())
    {
        $__internal_e8a66b9408293f6633c3e98960533412a2c20d2550ff1bd007b836437b18e904 = $this->env->getExtension("native_profiler");
        $__internal_e8a66b9408293f6633c3e98960533412a2c20d2550ff1bd007b836437b18e904->enter($__internal_e8a66b9408293f6633c3e98960533412a2c20d2550ff1bd007b836437b18e904_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        echo "EMPTY CONTENT";
        
        $__internal_e8a66b9408293f6633c3e98960533412a2c20d2550ff1bd007b836437b18e904->leave($__internal_e8a66b9408293f6633c3e98960533412a2c20d2550ff1bd007b836437b18e904_prof);

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
