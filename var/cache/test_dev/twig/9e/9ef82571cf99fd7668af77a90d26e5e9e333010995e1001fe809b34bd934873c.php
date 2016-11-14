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
        $__internal_3217fe18fe119c82078f161c13f1a78cd526ac80c57252a63ced7214bde130a8 = $this->env->getExtension("native_profiler");
        $__internal_3217fe18fe119c82078f161c13f1a78cd526ac80c57252a63ced7214bde130a8->enter($__internal_3217fe18fe119c82078f161c13f1a78cd526ac80c57252a63ced7214bde130a8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "WebProfilerBundle:Profiler:toolbar_redirect.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3217fe18fe119c82078f161c13f1a78cd526ac80c57252a63ced7214bde130a8->leave($__internal_3217fe18fe119c82078f161c13f1a78cd526ac80c57252a63ced7214bde130a8_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_bb8020f10cc0376b9574f3c5625018cd17ddd38e76c1682769702c30d79a310d = $this->env->getExtension("native_profiler");
        $__internal_bb8020f10cc0376b9574f3c5625018cd17ddd38e76c1682769702c30d79a310d->enter($__internal_bb8020f10cc0376b9574f3c5625018cd17ddd38e76c1682769702c30d79a310d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Redirection Intercepted";
        
        $__internal_bb8020f10cc0376b9574f3c5625018cd17ddd38e76c1682769702c30d79a310d->leave($__internal_bb8020f10cc0376b9574f3c5625018cd17ddd38e76c1682769702c30d79a310d_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_0f9fd5279235f5ad6c96e6de50ba0a1b78584f3d8af6ede4591a5d6bd35e1fa1 = $this->env->getExtension("native_profiler");
        $__internal_0f9fd5279235f5ad6c96e6de50ba0a1b78584f3d8af6ede4591a5d6bd35e1fa1->enter($__internal_0f9fd5279235f5ad6c96e6de50ba0a1b78584f3d8af6ede4591a5d6bd35e1fa1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_0f9fd5279235f5ad6c96e6de50ba0a1b78584f3d8af6ede4591a5d6bd35e1fa1->leave($__internal_0f9fd5279235f5ad6c96e6de50ba0a1b78584f3d8af6ede4591a5d6bd35e1fa1_prof);

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
