<?php

/* SonataMediaBundle:Provider:thumbnail.html.twig */
class __TwigTemplate_6c46125df55ffdc13b1c5754ab6c4396106ef1cbc9bf086eb8e27802ccdfeb8b extends Twig_Template
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
        $__internal_99cddbca7c03dfa1bdacaba4e52df1a9dd8a380f17e880f41977bec7dc9d649c = $this->env->getExtension("native_profiler");
        $__internal_99cddbca7c03dfa1bdacaba4e52df1a9dd8a380f17e880f41977bec7dc9d649c->enter($__internal_99cddbca7c03dfa1bdacaba4e52df1a9dd8a380f17e880f41977bec7dc9d649c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Provider:thumbnail.html.twig"));

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
        
        $__internal_99cddbca7c03dfa1bdacaba4e52df1a9dd8a380f17e880f41977bec7dc9d649c->leave($__internal_99cddbca7c03dfa1bdacaba4e52df1a9dd8a380f17e880f41977bec7dc9d649c_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Provider:thumbnail.html.twig";
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
/* <img {% for name, value in options %}{{name}}="{{value}}" {% endfor %} />*/
/* */
