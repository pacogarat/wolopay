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
        $__internal_1c1de35caeb79a87e60be8b5dfc61121b7e5f6b095fdf2a75c5f0f11d45aa51e = $this->env->getExtension("native_profiler");
        $__internal_1c1de35caeb79a87e60be8b5dfc61121b7e5f6b095fdf2a75c5f0f11d45aa51e->enter($__internal_1c1de35caeb79a87e60be8b5dfc61121b7e5f6b095fdf2a75c5f0f11d45aa51e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/PaymentHosted/layout_pay_method_hosted.html.twig"));

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
        
        $__internal_1c1de35caeb79a87e60be8b5dfc61121b7e5f6b095fdf2a75c5f0f11d45aa51e->leave($__internal_1c1de35caeb79a87e60be8b5dfc61121b7e5f6b095fdf2a75c5f0f11d45aa51e_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_54490516d1d4e058b9cd6eabf6738b3ee0567ada9411ab26be60fb081f65549d = $this->env->getExtension("native_profiler");
        $__internal_54490516d1d4e058b9cd6eabf6738b3ee0567ada9411ab26be60fb081f65549d->enter($__internal_54490516d1d4e058b9cd6eabf6738b3ee0567ada9411ab26be60fb081f65549d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_54490516d1d4e058b9cd6eabf6738b3ee0567ada9411ab26be60fb081f65549d->leave($__internal_54490516d1d4e058b9cd6eabf6738b3ee0567ada9411ab26be60fb081f65549d_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_de25834bf4a1e483b4e8d74dbdd127e636fc4d19cb71324a6c1edb3bbd6c843d = $this->env->getExtension("native_profiler");
        $__internal_de25834bf4a1e483b4e8d74dbdd127e636fc4d19cb71324a6c1edb3bbd6c843d->enter($__internal_de25834bf4a1e483b4e8d74dbdd127e636fc4d19cb71324a6c1edb3bbd6c843d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_de25834bf4a1e483b4e8d74dbdd127e636fc4d19cb71324a6c1edb3bbd6c843d->leave($__internal_de25834bf4a1e483b4e8d74dbdd127e636fc4d19cb71324a6c1edb3bbd6c843d_prof);

    }

    // line 19
    public function block_page($context, array $blocks = array())
    {
        $__internal_9646948f269e812ffd3103698393efc821aa25c1a17b81d87a72d5304e592e4a = $this->env->getExtension("native_profiler");
        $__internal_9646948f269e812ffd3103698393efc821aa25c1a17b81d87a72d5304e592e4a->enter($__internal_9646948f269e812ffd3103698393efc821aa25c1a17b81d87a72d5304e592e4a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        
        $__internal_9646948f269e812ffd3103698393efc821aa25c1a17b81d87a72d5304e592e4a->leave($__internal_9646948f269e812ffd3103698393efc821aa25c1a17b81d87a72d5304e592e4a_prof);

    }

    // line 23
    public function block_sponsors($context, array $blocks = array())
    {
        $__internal_66bcfce3c61ba172885efa2f5b9cef27039f56038045550d59f9e35579c39067 = $this->env->getExtension("native_profiler");
        $__internal_66bcfce3c61ba172885efa2f5b9cef27039f56038045550d59f9e35579c39067->enter($__internal_66bcfce3c61ba172885efa2f5b9cef27039f56038045550d59f9e35579c39067_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sponsors"));

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
        
        $__internal_66bcfce3c61ba172885efa2f5b9cef27039f56038045550d59f9e35579c39067->leave($__internal_66bcfce3c61ba172885efa2f5b9cef27039f56038045550d59f9e35579c39067_prof);

    }

    // line 35
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_c91ab2b67ff35f4e56fda02e269b9bd8dabfcee9807331486ae9e9f33d8b5cf8 = $this->env->getExtension("native_profiler");
        $__internal_c91ab2b67ff35f4e56fda02e269b9bd8dabfcee9807331486ae9e9f33d8b5cf8->enter($__internal_c91ab2b67ff35f4e56fda02e269b9bd8dabfcee9807331486ae9e9f33d8b5cf8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_c91ab2b67ff35f4e56fda02e269b9bd8dabfcee9807331486ae9e9f33d8b5cf8->leave($__internal_c91ab2b67ff35f4e56fda02e269b9bd8dabfcee9807331486ae9e9f33d8b5cf8_prof);

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
