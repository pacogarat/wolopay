<?php

/* AppBundle:Documentation/Main:index.html.twig */
class __TwigTemplate_53f71de06f8b0bcfbcf0a46a82b2b5b00b99338bec0543e6dc3577b11e9dd851 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Documentation/documentation_layout.html.twig", "AppBundle:Documentation/Main:index.html.twig", 1);
        $this->blocks = array(
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Documentation/documentation_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7d1ef8a51bb410469056f61cabfdc87562a4fed30610a883aae34d6fb04264f6 = $this->env->getExtension("native_profiler");
        $__internal_7d1ef8a51bb410469056f61cabfdc87562a4fed30610a883aae34d6fb04264f6->enter($__internal_7d1ef8a51bb410469056f61cabfdc87562a4fed30610a883aae34d6fb04264f6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Documentation/Main:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7d1ef8a51bb410469056f61cabfdc87562a4fed30610a883aae34d6fb04264f6->leave($__internal_7d1ef8a51bb410469056f61cabfdc87562a4fed30610a883aae34d6fb04264f6_prof);

    }

    // line 2
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_56beba4e7227b660fa65b3a31a351d30fef8306860ad8e99a2dda7c679567be8 = $this->env->getExtension("native_profiler");
        $__internal_56beba4e7227b660fa65b3a31a351d30fef8306860ad8e99a2dda7c679567be8->enter($__internal_56beba4e7227b660fa65b3a31a351d30fef8306860ad8e99a2dda7c679567be8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        // line 3
        echo "    ";
        echo (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content"));
        echo "
";
        
        $__internal_56beba4e7227b660fa65b3a31a351d30fef8306860ad8e99a2dda7c679567be8->leave($__internal_56beba4e7227b660fa65b3a31a351d30fef8306860ad8e99a2dda7c679567be8_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Documentation/Main:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends "@App/Documentation/documentation_layout.html.twig" %}*/
/* {% block main_content %}*/
/*     {{ content | raw }}*/
/* {% endblock %}*/
