<?php

/* SonataMediaBundle:Provider:view_vimeo.html.twig */
class __TwigTemplate_38ad798a4eaf362cc52b11eab91ba69c7a02d55e80a023721503e1f9ef03189b extends Twig_Template
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
        $__internal_25e1c31f06389cd0d7f1e23f3eba7723087890daf10a2c1ae3dad2b922278e38 = $this->env->getExtension("native_profiler");
        $__internal_25e1c31f06389cd0d7f1e23f3eba7723087890daf10a2c1ae3dad2b922278e38->enter($__internal_25e1c31f06389cd0d7f1e23f3eba7723087890daf10a2c1ae3dad2b922278e38_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Provider:view_vimeo.html.twig"));

        // line 11
        echo "

<iframe
    id=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "id", array()), "html", null, true);
        echo "\"
    src=\"//player.vimeo.com/video/";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "providerreference", array()), "html", null, true);
        echo "?";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "src", array()), "html", null, true);
        echo "\"
    width=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "width", array()), "html", null, true);
        echo "\"
    height=\"";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "height", array()), "html", null, true);
        echo "\"
    frameborder=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")), "frameborder", array()), "html", null, true);
        echo "\">
</iframe>
";
        
        $__internal_25e1c31f06389cd0d7f1e23f3eba7723087890daf10a2c1ae3dad2b922278e38->leave($__internal_25e1c31f06389cd0d7f1e23f3eba7723087890daf10a2c1ae3dad2b922278e38_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Provider:view_vimeo.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 18,  41 => 17,  37 => 16,  31 => 15,  27 => 14,  22 => 11,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* */
/* <iframe*/
/*     id="{{ options.id }}"*/
/*     src="//player.vimeo.com/video/{{ media.providerreference }}?{{ options.src }}"*/
/*     width="{{ options.width }}"*/
/*     height="{{ options.height }}"*/
/*     frameborder="{{ options.frameborder }}">*/
/* </iframe>*/
/* */
