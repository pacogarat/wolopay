<?php

/* NelmioApiDocBundle::resource.html.twig */
class __TwigTemplate_2d39ab0ac9de0f1f4c50f8d499380fd81e5624623de8c3f7e1a4803fd4c82142 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("NelmioApiDocBundle::layout.html.twig", "NelmioApiDocBundle::resource.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "NelmioApiDocBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7dcd0fe8f4a098b26293ab82537f0cd1b13636516c01967f5d26ea34e327bc4c = $this->env->getExtension("native_profiler");
        $__internal_7dcd0fe8f4a098b26293ab82537f0cd1b13636516c01967f5d26ea34e327bc4c->enter($__internal_7dcd0fe8f4a098b26293ab82537f0cd1b13636516c01967f5d26ea34e327bc4c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "NelmioApiDocBundle::resource.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7dcd0fe8f4a098b26293ab82537f0cd1b13636516c01967f5d26ea34e327bc4c->leave($__internal_7dcd0fe8f4a098b26293ab82537f0cd1b13636516c01967f5d26ea34e327bc4c_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_2c1f29b5f33b24a80bc6f4425e90bfdcba56f5b7d4e7acd7becbfa31bcd95cb2 = $this->env->getExtension("native_profiler");
        $__internal_2c1f29b5f33b24a80bc6f4425e90bfdcba56f5b7d4e7acd7becbfa31bcd95cb2->enter($__internal_2c1f29b5f33b24a80bc6f4425e90bfdcba56f5b7d4e7acd7becbfa31bcd95cb2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "    <li class=\"resource\">
        <ul class=\"endpoints\">
            <li class=\"endpoint\">
                <ul class=\"operations\">
                    ";
        // line 8
        $this->loadTemplate("NelmioApiDocBundle::method.html.twig", "NelmioApiDocBundle::resource.html.twig", 8)->display($context);
        // line 9
        echo "                </ul>
            </li>
        </ul>
    </li>
";
        
        $__internal_2c1f29b5f33b24a80bc6f4425e90bfdcba56f5b7d4e7acd7becbfa31bcd95cb2->leave($__internal_2c1f29b5f33b24a80bc6f4425e90bfdcba56f5b7d4e7acd7becbfa31bcd95cb2_prof);

    }

    public function getTemplateName()
    {
        return "NelmioApiDocBundle::resource.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  48 => 9,  46 => 8,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends "NelmioApiDocBundle::layout.html.twig" %}*/
/* */
/* {% block content %}*/
/*     <li class="resource">*/
/*         <ul class="endpoints">*/
/*             <li class="endpoint">*/
/*                 <ul class="operations">*/
/*                     {% include 'NelmioApiDocBundle::method.html.twig' %}*/
/*                 </ul>*/
/*             </li>*/
/*         </ul>*/
/*     </li>*/
/* {% endblock content %}*/
/* */
