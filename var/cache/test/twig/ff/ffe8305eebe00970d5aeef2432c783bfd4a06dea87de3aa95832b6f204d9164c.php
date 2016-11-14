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
        $__internal_53037c62dabe63fbbb03565a33b960391f19cb984365277dcd7abff0609ce041 = $this->env->getExtension("native_profiler");
        $__internal_53037c62dabe63fbbb03565a33b960391f19cb984365277dcd7abff0609ce041->enter($__internal_53037c62dabe63fbbb03565a33b960391f19cb984365277dcd7abff0609ce041_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Documentation/Main:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_53037c62dabe63fbbb03565a33b960391f19cb984365277dcd7abff0609ce041->leave($__internal_53037c62dabe63fbbb03565a33b960391f19cb984365277dcd7abff0609ce041_prof);

    }

    // line 2
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_e06a610f38e9cfc8bfab2965f7c76c5d3481e2330890176a0d6590cb48742695 = $this->env->getExtension("native_profiler");
        $__internal_e06a610f38e9cfc8bfab2965f7c76c5d3481e2330890176a0d6590cb48742695->enter($__internal_e06a610f38e9cfc8bfab2965f7c76c5d3481e2330890176a0d6590cb48742695_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        // line 3
        echo "    ";
        echo (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content"));
        echo "
";
        
        $__internal_e06a610f38e9cfc8bfab2965f7c76c5d3481e2330890176a0d6590cb48742695->leave($__internal_e06a610f38e9cfc8bfab2965f7c76c5d3481e2330890176a0d6590cb48742695_prof);

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
