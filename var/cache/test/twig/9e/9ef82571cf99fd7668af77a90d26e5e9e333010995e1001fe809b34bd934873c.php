<?php

/* WebProfilerBundle:Profiler:toolbar_redirect.html.twig */
class __TwigTemplate_9ad9becc2fb7f65db14d1ad7ee7b73a7c0062658dfbc1f26dbe26d5593b24bdf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "WebProfilerBundle:Profiler:toolbar_redirect.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_283d55213cf5599e68f8e100fd439b277b2089c4b256a0b2c980d3dfb0c3c6db = $this->env->getExtension("native_profiler");
        $__internal_283d55213cf5599e68f8e100fd439b277b2089c4b256a0b2c980d3dfb0c3c6db->enter($__internal_283d55213cf5599e68f8e100fd439b277b2089c4b256a0b2c980d3dfb0c3c6db_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Profiler:toolbar_redirect.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_283d55213cf5599e68f8e100fd439b277b2089c4b256a0b2c980d3dfb0c3c6db->leave($__internal_283d55213cf5599e68f8e100fd439b277b2089c4b256a0b2c980d3dfb0c3c6db_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_2c25b9a2febc8e8a8e4f5ef8742289647955f33aa5350a67b22bd1fd61e18eb2 = $this->env->getExtension("native_profiler");
        $__internal_2c25b9a2febc8e8a8e4f5ef8742289647955f33aa5350a67b22bd1fd61e18eb2->enter($__internal_2c25b9a2febc8e8a8e4f5ef8742289647955f33aa5350a67b22bd1fd61e18eb2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Redirection Intercepted";
        
        $__internal_2c25b9a2febc8e8a8e4f5ef8742289647955f33aa5350a67b22bd1fd61e18eb2->leave($__internal_2c25b9a2febc8e8a8e4f5ef8742289647955f33aa5350a67b22bd1fd61e18eb2_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_6fac02ac6398ac0248cf8a963ffd48b1f7ce2a16377e75ce6eb440f9498e408d = $this->env->getExtension("native_profiler");
        $__internal_6fac02ac6398ac0248cf8a963ffd48b1f7ce2a16377e75ce6eb440f9498e408d->enter($__internal_6fac02ac6398ac0248cf8a963ffd48b1f7ce2a16377e75ce6eb440f9498e408d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "    <div class=\"sf-reset\">
        <div class=\"block-exception\">
            <h1>This request redirects to <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, (isset($context["location"]) ? $context["location"] : $this->getContext($context, "location")), "html", null, true);
        echo "</a>.</h1>

            <p>
                <small>
                    The redirect was intercepted by the web debug toolbar to help debugging.
                    For more information, see the \"intercept-redirects\" option of the Profiler.
                </small>
            </p>
        </div>
    </div>
";
        
        $__internal_6fac02ac6398ac0248cf8a963ffd48b1f7ce2a16377e75ce6eb440f9498e408d->leave($__internal_6fac02ac6398ac0248cf8a963ffd48b1f7ce2a16377e75ce6eb440f9498e408d_prof);

    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar_redirect.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 8,  53 => 6,  47 => 5,  35 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block title 'Redirection Intercepted' %}*/
/* */
/* {% block body %}*/
/*     <div class="sf-reset">*/
/*         <div class="block-exception">*/
/*             <h1>This request redirects to <a href="{{ location }}">{{ location }}</a>.</h1>*/
/* */
/*             <p>*/
/*                 <small>*/
/*                     The redirect was intercepted by the web debug toolbar to help debugging.*/
/*                     For more information, see the "intercept-redirects" option of the Profiler.*/
/*                 </small>*/
/*             </p>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
