<?php

/* SonataMediaBundle:Media:view.html.twig */
class __TwigTemplate_702a266004f6817e22db7fb41d54ad5f80b8bb55bf92a2ef860cbdad84acd19f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_page_breadcrumb' => array($this, 'block_sonata_page_breadcrumb'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_093eb98ee19bfba248d987f78786b208f1e51392bfaa0aebde1a079a07dcfc1d = $this->env->getExtension("native_profiler");
        $__internal_093eb98ee19bfba248d987f78786b208f1e51392bfaa0aebde1a079a07dcfc1d->enter($__internal_093eb98ee19bfba248d987f78786b208f1e51392bfaa0aebde1a079a07dcfc1d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Media:view.html.twig"));

        // line 11
        echo "
";
        // line 12
        echo "<div class='alert alert-default alert-info'>
    <strong>This is the media view template. Feel free to override it.</strong>
    <div>This file can be found in <code>{$this->getTemplateName()}</code>.</div>
</div>";        // line 13
        echo "
";
        // line 14
        $this->displayBlock('sonata_page_breadcrumb', $context, $blocks);
        // line 19
        echo "
<h1>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "name", array()), "html", null, true);
        echo "</h1>

<div>
    ";
        // line 23
        echo $this->env->getExtension('sonata_media')->media((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), (isset($context["format"]) ? $context["format"] : $this->getContext($context, "format")), array());
        // line 24
        echo "</div>

<h2>Information</h2>
<ul>
    <li>Size : ";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "size", array()), "html", null, true);
        echo "</li>
    <li>Width : ";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "width", array()), "html", null, true);
        echo "</li>
    <li>Height : ";
        // line 30
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "height", array()), "html", null, true);
        echo "</li>
    <li>Content Type : ";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "contenttype", array()), "html", null, true);
        echo "</li>
    <li>Copyright : ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "copyright", array()), "html", null, true);
        echo "</li>
    <li>Author name : ";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "authorname", array()), "html", null, true);
        echo "</li>
    <li>CDN : ";
        // line 34
        if ($this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "cdnisflushable", array())) {
            echo "to be flushed";
        } else {
            echo " last flush at ";
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "cdnflushat", array())), "html", null, true);
            echo " ";
        }
        echo "</li>
</ul>

<h2>Formats</h2>
<ul>
    <li><a href=\"";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_view", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media"))), "format" => "reference")), "html", null, true);
        echo "\">reference</a></li>

    ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["formats"]) ? $context["formats"] : $this->getContext($context, "formats")));
        foreach ($context['_seq'] as $context["name"] => $context["format"]) {
            // line 42
            echo "        <li><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_view", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media"))), "format" => $context["name"])), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "</a></li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['format'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 44
        echo "</ul>
";
        
        $__internal_093eb98ee19bfba248d987f78786b208f1e51392bfaa0aebde1a079a07dcfc1d->leave($__internal_093eb98ee19bfba248d987f78786b208f1e51392bfaa0aebde1a079a07dcfc1d_prof);

    }

    // line 14
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        $__internal_e63ae85c3f856fa0ed9683eb08154974733b760e940d84d06220a7a7d07cdaf4 = $this->env->getExtension("native_profiler");
        $__internal_e63ae85c3f856fa0ed9683eb08154974733b760e940d84d06220a7a7d07cdaf4->enter($__internal_e63ae85c3f856fa0ed9683eb08154974733b760e940d84d06220a7a7d07cdaf4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_page_breadcrumb"));

        // line 15
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 16
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "media_view", "media" => (isset($context["media"]) ? $context["media"] : $this->getContext($context, "media")), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
        
        $__internal_e63ae85c3f856fa0ed9683eb08154974733b760e940d84d06220a7a7d07cdaf4->leave($__internal_e63ae85c3f856fa0ed9683eb08154974733b760e940d84d06220a7a7d07cdaf4_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Media:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 16,  124 => 15,  118 => 14,  110 => 44,  99 => 42,  95 => 41,  90 => 39,  76 => 34,  72 => 33,  68 => 32,  64 => 31,  60 => 30,  56 => 29,  52 => 28,  46 => 24,  44 => 23,  38 => 20,  35 => 19,  33 => 14,  30 => 13,  26 => 12,  23 => 11,);
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
/* {% sonata_template_box 'This is the media view template. Feel free to override it.' %}*/
/* */
/* {% block sonata_page_breadcrumb %}*/
/*     <div class="row-fluid clearfix">*/
/*         {{ sonata_block_render_event('breadcrumb', { 'context': 'media_view', 'media': media, 'current_uri': app.request.requestUri }) }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* <h1>{{ media.name }}</h1>*/
/* */
/* <div>*/
/*     {% media media, format %}*/
/* </div>*/
/* */
/* <h2>Information</h2>*/
/* <ul>*/
/*     <li>Size : {{ media.size }}</li>*/
/*     <li>Width : {{ media.width }}</li>*/
/*     <li>Height : {{ media.height }}</li>*/
/*     <li>Content Type : {{ media.contenttype }}</li>*/
/*     <li>Copyright : {{ media.copyright }}</li>*/
/*     <li>Author name : {{ media.authorname }}</li>*/
/*     <li>CDN : {% if media.cdnisflushable %}to be flushed{% else %} last flush at {{ media.cdnflushat|date}} {% endif %}</li>*/
/* </ul>*/
/* */
/* <h2>Formats</h2>*/
/* <ul>*/
/*     <li><a href="{{ url('sonata_media_view', { 'id' : media|sonata_urlsafeid , 'format' : 'reference'}) }}">reference</a></li>*/
/* */
/*     {% for name, format in formats %}*/
/*         <li><a href="{{ url('sonata_media_view', { 'id' : media|sonata_urlsafeid , 'format' : name}) }}">{{ name }}</a></li>*/
/*     {% endfor %}*/
/* </ul>*/
/* */
