<?php

/* TwigBundle:Exception:error.xml.twig */
class __TwigTemplate_0d55c35ce3de15f1c76e3b390232e2bd76421baf55ca82a8b775692eb63e03ae extends Twig_Template
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
        $__internal_f656a89fa67d94eb170a3e73f1d2d1cf97afba6a8aa949af2fc05358db3ab17d = $this->env->getExtension("native_profiler");
        $__internal_f656a89fa67d94eb170a3e73f1d2d1cf97afba6a8aa949af2fc05358db3ab17d->enter($__internal_f656a89fa67d94eb170a3e73f1d2d1cf97afba6a8aa949af2fc05358db3ab17d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.xml.twig"));

        // line 1
        echo "<?xml version=\"1.0\" encoding=\"";
        echo twig_escape_filter($this->env, $this->env->getCharset(), "html", null, true);
        echo "\" ?>

<error code=\"";
        // line 3
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo "\" message=\"";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo "\" />
";
        
        $__internal_f656a89fa67d94eb170a3e73f1d2d1cf97afba6a8aa949af2fc05358db3ab17d->leave($__internal_f656a89fa67d94eb170a3e73f1d2d1cf97afba6a8aa949af2fc05358db3ab17d_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.xml.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 3,  22 => 1,);
    }
}
/* <?xml version="1.0" encoding="{{ _charset }}" ?>*/
/* */
/* <error code="{{ status_code }}" message="{{ status_text }}" />*/
/* */
