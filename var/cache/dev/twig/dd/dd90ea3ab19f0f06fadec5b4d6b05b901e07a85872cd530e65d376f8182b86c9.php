<?php

/* TwigBundle:Exception:exception_full.html.twig */
class __TwigTemplate_a51d47131a93d1f3475aba2169ee2fea5476c3f2f65fcecbc4914d5f1346b3d1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "TwigBundle:Exception:exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
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
        $__internal_b52d0764c4b647ae23ae8573eaa82aa60bd7d573339418d309456032980952c0 = $this->env->getExtension("native_profiler");
        $__internal_b52d0764c4b647ae23ae8573eaa82aa60bd7d573339418d309456032980952c0->enter($__internal_b52d0764c4b647ae23ae8573eaa82aa60bd7d573339418d309456032980952c0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b52d0764c4b647ae23ae8573eaa82aa60bd7d573339418d309456032980952c0->leave($__internal_b52d0764c4b647ae23ae8573eaa82aa60bd7d573339418d309456032980952c0_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_9df39f9a52d7f8cc35b216c4af2ebbaaadae07e2ab005c2491076ee03a9c66d9 = $this->env->getExtension("native_profiler");
        $__internal_9df39f9a52d7f8cc35b216c4af2ebbaaadae07e2ab005c2491076ee03a9c66d9->enter($__internal_9df39f9a52d7f8cc35b216c4af2ebbaaadae07e2ab005c2491076ee03a9c66d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_9df39f9a52d7f8cc35b216c4af2ebbaaadae07e2ab005c2491076ee03a9c66d9->leave($__internal_9df39f9a52d7f8cc35b216c4af2ebbaaadae07e2ab005c2491076ee03a9c66d9_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_8664877775ddf19024028baa754ee0f4d3a10f8a40be17ad45edf6e0c4524a7d = $this->env->getExtension("native_profiler");
        $__internal_8664877775ddf19024028baa754ee0f4d3a10f8a40be17ad45edf6e0c4524a7d->enter($__internal_8664877775ddf19024028baa754ee0f4d3a10f8a40be17ad45edf6e0c4524a7d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_8664877775ddf19024028baa754ee0f4d3a10f8a40be17ad45edf6e0c4524a7d->leave($__internal_8664877775ddf19024028baa754ee0f4d3a10f8a40be17ad45edf6e0c4524a7d_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_d04d234e5c81a2b8577f39721686f4402ce178cac4851e1647a782caed5c9b53 = $this->env->getExtension("native_profiler");
        $__internal_d04d234e5c81a2b8577f39721686f4402ce178cac4851e1647a782caed5c9b53->enter($__internal_d04d234e5c81a2b8577f39721686f4402ce178cac4851e1647a782caed5c9b53_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "TwigBundle:Exception:exception_full.html.twig", 12)->display($context);
        
        $__internal_d04d234e5c81a2b8577f39721686f4402ce178cac4851e1647a782caed5c9b53->leave($__internal_d04d234e5c81a2b8577f39721686f4402ce178cac4851e1647a782caed5c9b53_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
