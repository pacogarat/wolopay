<?php

/* SonataMediaBundle:Provider:view_image.html.twig */
class __TwigTemplate_174e56e98998c6a5c5b3ec75c6efc5e6aab9db6d3322713b7dc87321a19ec4bf extends Twig_Template
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
        $__internal_7b9b781d9291040d6bd96151c52cb7152fa48d61245e93021a2cdde47b2bb1e4 = $this->env->getExtension("native_profiler");
        $__internal_7b9b781d9291040d6bd96151c52cb7152fa48d61245e93021a2cdde47b2bb1e4->enter($__internal_7b9b781d9291040d6bd96151c52cb7152fa48d61245e93021a2cdde47b2bb1e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Provider:view_image.html.twig"));

        // line 11
        echo "
<img ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")));
        foreach ($context['_seq'] as $context["name"] => $context["value"]) {
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["value"], "html", null, true);
            echo "\" ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo " />
";
        
        $__internal_7b9b781d9291040d6bd96151c52cb7152fa48d61245e93021a2cdde47b2bb1e4->leave($__internal_7b9b781d9291040d6bd96151c52cb7152fa48d61245e93021a2cdde47b2bb1e4_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Provider:view_image.html.twig";
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
/* <img {% for name, value in options %}{{ name }}="{{ value }}" {% endfor %} />*/
/* */
