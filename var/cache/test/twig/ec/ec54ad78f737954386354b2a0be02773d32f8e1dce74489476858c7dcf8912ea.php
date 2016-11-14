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
        $__internal_736a6376645a41f27de61a2b8cce25d709c026fb1998d78a6b184a1426498f52 = $this->env->getExtension("native_profiler");
        $__internal_736a6376645a41f27de61a2b8cce25d709c026fb1998d78a6b184a1426498f52->enter($__internal_736a6376645a41f27de61a2b8cce25d709c026fb1998d78a6b184a1426498f52_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", ":Error:custom.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_736a6376645a41f27de61a2b8cce25d709c026fb1998d78a6b184a1426498f52->leave($__internal_736a6376645a41f27de61a2b8cce25d709c026fb1998d78a6b184a1426498f52_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_6e9e60f08487ff25dfab8f214332567aef500ef5a5aad25baf74b6eee48fa400 = $this->env->getExtension("native_profiler");
        $__internal_6e9e60f08487ff25dfab8f214332567aef500ef5a5aad25baf74b6eee48fa400->enter($__internal_6e9e60f08487ff25dfab8f214332567aef500ef5a5aad25baf74b6eee48fa400_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <div style=\"text-align: center\">
        <h1 style=\"position: fixed;text-align: center;width: 100%;text-shadow: 1px 2px 0 #ccc;\">";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(((array_key_exists("error_message", $context)) ? (_twig_default_filter((isset($context["error_message"]) ? $context["error_message"] : $this->getContext($context, "error_message")), "error")) : ("error"))), "html", null, true);
        echo "</h1>
    </div>
";
        
        $__internal_6e9e60f08487ff25dfab8f214332567aef500ef5a5aad25baf74b6eee48fa400->leave($__internal_6e9e60f08487ff25dfab8f214332567aef500ef5a5aad25baf74b6eee48fa400_prof);

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
