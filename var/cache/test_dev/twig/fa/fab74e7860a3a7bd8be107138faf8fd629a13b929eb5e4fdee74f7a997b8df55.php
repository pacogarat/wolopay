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
        $__internal_5299448f041c908f427a437c094b5ae1e81b69c545be928a14294c283dfa1232 = $this->env->getExtension("native_profiler");
        $__internal_5299448f041c908f427a437c094b5ae1e81b69c545be928a14294c283dfa1232->enter($__internal_5299448f041c908f427a437c094b5ae1e81b69c545be928a14294c283dfa1232_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "NelmioApiDocBundle::resource.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5299448f041c908f427a437c094b5ae1e81b69c545be928a14294c283dfa1232->leave($__internal_5299448f041c908f427a437c094b5ae1e81b69c545be928a14294c283dfa1232_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_d44c5fada415dba61579ff40a9c92f9f053a923b3bcab121c5bc72a4ee56230d = $this->env->getExtension("native_profiler");
        $__internal_d44c5fada415dba61579ff40a9c92f9f053a923b3bcab121c5bc72a4ee56230d->enter($__internal_d44c5fada415dba61579ff40a9c92f9f053a923b3bcab121c5bc72a4ee56230d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

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
        
        $__internal_d44c5fada415dba61579ff40a9c92f9f053a923b3bcab121c5bc72a4ee56230d->leave($__internal_d44c5fada415dba61579ff40a9c92f9f053a923b3bcab121c5bc72a4ee56230d_prof);

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
