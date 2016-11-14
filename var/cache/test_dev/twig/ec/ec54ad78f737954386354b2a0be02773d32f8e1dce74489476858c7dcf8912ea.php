<?php

/* :Error:custom.html.twig */
class __TwigTemplate_464986949dd1e02d280908be0940e7524181d0f009cf1d3e1b651cd1ccb1cfee extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", ":Error:custom.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0a4159ff8a868a9bda95f4b870dff44eaad7e8160970afe89227427009978cdf = $this->env->getExtension("native_profiler");
        $__internal_0a4159ff8a868a9bda95f4b870dff44eaad7e8160970afe89227427009978cdf->enter($__internal_0a4159ff8a868a9bda95f4b870dff44eaad7e8160970afe89227427009978cdf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", ":Error:custom.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0a4159ff8a868a9bda95f4b870dff44eaad7e8160970afe89227427009978cdf->leave($__internal_0a4159ff8a868a9bda95f4b870dff44eaad7e8160970afe89227427009978cdf_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_d456ac1bc0ef9fd2f4c980536f987e3bc0516b130700a5da06bb204e03ddfe88 = $this->env->getExtension("native_profiler");
        $__internal_d456ac1bc0ef9fd2f4c980536f987e3bc0516b130700a5da06bb204e03ddfe88->enter($__internal_d456ac1bc0ef9fd2f4c980536f987e3bc0516b130700a5da06bb204e03ddfe88_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <div style=\"text-align: center\">
        <h1 style=\"position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;\">";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(((array_key_exists("error_message", $context)) ? (_twig_default_filter((isset($context["error_message"]) ? $context["error_message"] : $this->getContext($context, "error_message")), "error")) : ("error"))), "html", null, true);
        echo "</h1>
    </div>
";
        
        $__internal_d456ac1bc0ef9fd2f4c980536f987e3bc0516b130700a5da06bb204e03ddfe88->leave($__internal_d456ac1bc0ef9fd2f4c980536f987e3bc0516b130700a5da06bb204e03ddfe88_prof);

    }

    public function getTemplateName()
    {
        return ":Error:custom.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends '::base.html.twig' %}*/
/* */
/* {% block body %}*/
/*     <div style="text-align: center">*/
/*         <h1 style="position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;">{{ error_message | default('error') | trans  }}</h1>*/
/*     </div>*/
/* {% endblock %}*/
