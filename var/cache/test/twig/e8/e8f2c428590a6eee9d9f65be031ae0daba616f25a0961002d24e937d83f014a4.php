<?php

/* @App/PaymentHosted/layout_pay_method_hosted.html.twig */
class __TwigTemplate_e5259b4c78f4469ec639e7da26749896a3fcc8e0c58ef22738d07a0bdea8b428 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'page' => array($this, 'block_page'),
            'sponsors' => array($this, 'block_sponsors'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_975dff074d8db85ff0877167a50bb881cf077b74b4156dbc47e1a77dddd66283 = $this->env->getExtension("native_profiler");
        $__internal_975dff074d8db85ff0877167a50bb881cf077b74b4156dbc47e1a77dddd66283->enter($__internal_975dff074d8db85ff0877167a50bb881cf077b74b4156dbc47e1a77dddd66283_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/PaymentHosted/layout_pay_method_hosted.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">
    ";
        // line 9
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "1376e32_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32_0") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32_bootstrap_extra_1.css");
            // line 12
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\">
    ";
        } else {
            // asset "1376e32"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\">
    ";
        }
        unset($context["asset_url"]);
        // line 14
        echo "</head>
<body>
<div class=\"container voffset3\">
    <div class=\"row\">
        <div class=\"col-md-12\">
            ";
        // line 19
        $this->displayBlock('page', $context, $blocks);
        // line 20
        echo "        </div>

    </div>
    ";
        // line 23
        $this->displayBlock('sponsors', $context, $blocks);
        // line 34
        echo "</div>
";
        // line 35
        $this->displayBlock('javascripts', $context, $blocks);
        // line 36
        echo "</body>
</html>
";
        
        $__internal_975dff074d8db85ff0877167a50bb881cf077b74b4156dbc47e1a77dddd66283->leave($__internal_975dff074d8db85ff0877167a50bb881cf077b74b4156dbc47e1a77dddd66283_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_c3602835a673a1ea8d1883d96e2846941ead8330aa2aff53861c2ddc75d83968 = $this->env->getExtension("native_profiler");
        $__internal_c3602835a673a1ea8d1883d96e2846941ead8330aa2aff53861c2ddc75d83968->enter($__internal_c3602835a673a1ea8d1883d96e2846941ead8330aa2aff53861c2ddc75d83968_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_c3602835a673a1ea8d1883d96e2846941ead8330aa2aff53861c2ddc75d83968->leave($__internal_c3602835a673a1ea8d1883d96e2846941ead8330aa2aff53861c2ddc75d83968_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_f2b32454135fd0445c07793ea1d4f45500b35298e4195d4cabb9d0c2bf1f29f3 = $this->env->getExtension("native_profiler");
        $__internal_f2b32454135fd0445c07793ea1d4f45500b35298e4195d4cabb9d0c2bf1f29f3->enter($__internal_f2b32454135fd0445c07793ea1d4f45500b35298e4195d4cabb9d0c2bf1f29f3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_f2b32454135fd0445c07793ea1d4f45500b35298e4195d4cabb9d0c2bf1f29f3->leave($__internal_f2b32454135fd0445c07793ea1d4f45500b35298e4195d4cabb9d0c2bf1f29f3_prof);

    }

    // line 19
    public function block_page($context, array $blocks = array())
    {
        $__internal_23c7eba5f0033375f36ee99c6c64abab15e31c7bb491f070ba590c2689c27855 = $this->env->getExtension("native_profiler");
        $__internal_23c7eba5f0033375f36ee99c6c64abab15e31c7bb491f070ba590c2689c27855->enter($__internal_23c7eba5f0033375f36ee99c6c64abab15e31c7bb491f070ba590c2689c27855_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        
        $__internal_23c7eba5f0033375f36ee99c6c64abab15e31c7bb491f070ba590c2689c27855->leave($__internal_23c7eba5f0033375f36ee99c6c64abab15e31c7bb491f070ba590c2689c27855_prof);

    }

    // line 23
    public function block_sponsors($context, array $blocks = array())
    {
        $__internal_6423b30b776332cd8ccd7c76a7261f22bd8b661f025c404496817521fb592c4c = $this->env->getExtension("native_profiler");
        $__internal_6423b30b776332cd8ccd7c76a7261f22bd8b661f025c404496817521fb592c4c->enter($__internal_6423b30b776332cd8ccd7c76a7261f22bd8b661f025c404496817521fb592c4c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sponsors"));

        // line 24
        echo "
        <div class=\"row voffset5\">
            <div class=\"col-sm-3 col-sm-offset-3\">
                <img src=\"";
        // line 27
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute((isset($context["appp"]) ? $context["appp"] : $this->getContext($context, "appp")), "logo", array()), "shop_done");
        echo "\">
            </div>
            <div class=\"col-sm-5\">
                <img src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/logo_200x50.png"), "html", null, true);
        echo "\">
            </div>
        </div>
    ";
        
        $__internal_6423b30b776332cd8ccd7c76a7261f22bd8b661f025c404496817521fb592c4c->leave($__internal_6423b30b776332cd8ccd7c76a7261f22bd8b661f025c404496817521fb592c4c_prof);

    }

    // line 35
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_e3354ccb1a4e51d7e1abf09d0680e32098c71c54b27ad8cbbf43399021d42590 = $this->env->getExtension("native_profiler");
        $__internal_e3354ccb1a4e51d7e1abf09d0680e32098c71c54b27ad8cbbf43399021d42590->enter($__internal_e3354ccb1a4e51d7e1abf09d0680e32098c71c54b27ad8cbbf43399021d42590_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_e3354ccb1a4e51d7e1abf09d0680e32098c71c54b27ad8cbbf43399021d42590->leave($__internal_e3354ccb1a4e51d7e1abf09d0680e32098c71c54b27ad8cbbf43399021d42590_prof);

    }

    public function getTemplateName()
    {
        return "@App/PaymentHosted/layout_pay_method_hosted.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  155 => 35,  144 => 30,  138 => 27,  133 => 24,  127 => 23,  116 => 19,  105 => 6,  93 => 5,  84 => 36,  82 => 35,  79 => 34,  77 => 23,  72 => 20,  70 => 19,  63 => 14,  49 => 12,  45 => 9,  39 => 7,  37 => 6,  33 => 5,  27 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="UTF-8" />*/
/*     <title>{% block title %}Welcome!{% endblock %}</title>*/
/*     {% block stylesheets %}{% endblock %}*/
/*     <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">*/
/*     <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">*/
/*     {% stylesheets*/
/*         "css_glob/bootstrap_extra.css"*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}">*/
/*     {% endstylesheets %}*/
/* </head>*/
/* <body>*/
/* <div class="container voffset3">*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*             {% block page %}{% endblock %}*/
/*         </div>*/
/* */
/*     </div>*/
/*     {% block sponsors %}*/
/* */
/*         <div class="row voffset5">*/
/*             <div class="col-sm-3 col-sm-offset-3">*/
/*                 <img src="{% path appp.logo, 'shop_done' %}">*/
/*             </div>*/
/*             <div class="col-sm-5">*/
/*                 <img src="{{ asset('img/logo_200x50.png') }}">*/
/*             </div>*/
/*         </div>*/
/*     {% endblock %}*/
/* </div>*/
/* {% block javascripts %}{% endblock %}*/
/* </body>*/
/* </html>*/
/* */
