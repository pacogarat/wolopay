<?php

/* SonataMediaBundle:Gallery:view.html.twig */
class __TwigTemplate_0edab2417ca69886c082f5e55994e37178778c3f0b29cbf13830b6f28c582948 extends Twig_Template
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
        $__internal_3e6f376fdf12925ee992fe8ee911c924bafc542484536bad0c22a1861fdb0279 = $this->env->getExtension("native_profiler");
        $__internal_3e6f376fdf12925ee992fe8ee911c924bafc542484536bad0c22a1861fdb0279->enter($__internal_3e6f376fdf12925ee992fe8ee911c924bafc542484536bad0c22a1861fdb0279_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Gallery:view.html.twig"));

        // line 11
        echo "
";
        // line 12
        echo "<div class='alert alert-default alert-info'>
    <strong>This is the gallery view template. Feel free to override it.</strong>
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
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : $this->getContext($context, "gallery")), "name", array()), "html", null, true);
        echo "</h1>

<div class=\"sonata-media-gallery-media-list\">
    ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : $this->getContext($context, "gallery")), "GalleryHasMedias", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["galleryHasMedia"]) {
            // line 24
            echo "        <div class=\"media sonata-media-gallery-media-item\">
            <a class=\"pull-left sonata-media-gallery-media-item-link\" href=\"";
            // line 25
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_view", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier($this->getAttribute($context["galleryHasMedia"], "media", array())))), "html", null, true);
            echo "\">
                ";
            // line 26
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($context["galleryHasMedia"], "media", array()), $this->getAttribute((isset($context["gallery"]) ? $context["gallery"] : $this->getContext($context, "gallery")), "defaultFormat", array()), array("class" => "media-object"));
            // line 27
            echo "            </a>
            <div class=\"media-body\">
                <h4 class=\"media-heading\">";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["galleryHasMedia"], "media", array()), "name", array()), "html", null, true);
            echo "</h4>
                <p>";
            // line 30
            echo $this->getAttribute($this->getAttribute($context["galleryHasMedia"], "media", array()), "description", array());
            echo "</p>
            </div>
        </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['galleryHasMedia'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "</div>
";
        
        $__internal_3e6f376fdf12925ee992fe8ee911c924bafc542484536bad0c22a1861fdb0279->leave($__internal_3e6f376fdf12925ee992fe8ee911c924bafc542484536bad0c22a1861fdb0279_prof);

    }

    // line 14
    public function block_sonata_page_breadcrumb($context, array $blocks = array())
    {
        $__internal_f510828aabfd092e31d71e360401d1adeb053e229d81d74f6106456593ce5751 = $this->env->getExtension("native_profiler");
        $__internal_f510828aabfd092e31d71e360401d1adeb053e229d81d74f6106456593ce5751->enter($__internal_f510828aabfd092e31d71e360401d1adeb053e229d81d74f6106456593ce5751_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_page_breadcrumb"));

        // line 15
        echo "    <div class=\"row-fluid clearfix\">
        ";
        // line 16
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("breadcrumb", array("context" => "gallery_view", "gallery" => (isset($context["gallery"]) ? $context["gallery"] : $this->getContext($context, "gallery")), "current_uri" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "requestUri", array()))));
        echo "
    </div>
";
        
        $__internal_f510828aabfd092e31d71e360401d1adeb053e229d81d74f6106456593ce5751->leave($__internal_f510828aabfd092e31d71e360401d1adeb053e229d81d74f6106456593ce5751_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Gallery:view.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 16,  89 => 15,  83 => 14,  75 => 34,  65 => 30,  61 => 29,  57 => 27,  55 => 26,  51 => 25,  48 => 24,  44 => 23,  38 => 20,  35 => 19,  33 => 14,  30 => 13,  26 => 12,  23 => 11,);
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
/* {% sonata_template_box 'This is the gallery view template. Feel free to override it.' %}*/
/* */
/* {% block sonata_page_breadcrumb %}*/
/*     <div class="row-fluid clearfix">*/
/*         {{ sonata_block_render_event('breadcrumb', { 'context': 'gallery_view', 'gallery': gallery, 'current_uri': app.request.requestUri }) }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* <h1>{{ gallery.name }}</h1>*/
/* */
/* <div class="sonata-media-gallery-media-list">*/
/*     {% for galleryHasMedia in gallery.GalleryHasMedias %}*/
/*         <div class="media sonata-media-gallery-media-item">*/
/*             <a class="pull-left sonata-media-gallery-media-item-link" href="{{ url('sonata_media_view', {'id': galleryHasMedia.media|sonata_urlsafeid }) }}">*/
/*                 {% thumbnail galleryHasMedia.media, gallery.defaultFormat with {'class': 'media-object'} %}*/
/*             </a>*/
/*             <div class="media-body">*/
/*                 <h4 class="media-heading">{{ galleryHasMedia.media.name }}</h4>*/
/*                 <p>{{ galleryHasMedia.media.description|raw }}</p>*/
/*             </div>*/
/*         </div>*/
/*     {% endfor %}*/
/* </div>*/
/* */
