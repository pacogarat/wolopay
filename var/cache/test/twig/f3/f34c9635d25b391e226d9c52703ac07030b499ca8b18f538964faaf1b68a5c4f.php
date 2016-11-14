<?php

/* ::base_form_full_screen.html.twig */
class __TwigTemplate_134767a17bf15deb9fb66f964b9815c96347efd44fe1a20f8131025d8ad5cac2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base.html.twig", "::base_form_full_screen.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'head_extra' => array($this, 'block_head_extra'),
            'body' => array($this, 'block_body'),
            'header_right' => array($this, 'block_header_right'),
            'page_container' => array($this, 'block_page_container'),
            'javascripts' => array($this, 'block_javascripts'),
            'javascrips_extra' => array($this, 'block_javascrips_extra'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_049a34241f3b159b4e8bd11b4fc67bde5756ef9c68ddca5645d858e96903c05e = $this->env->getExtension("native_profiler");
        $__internal_049a34241f3b159b4e8bd11b4fc67bde5756ef9c68ddca5645d858e96903c05e->enter($__internal_049a34241f3b159b4e8bd11b4fc67bde5756ef9c68ddca5645d858e96903c05e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base_form_full_screen.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_049a34241f3b159b4e8bd11b4fc67bde5756ef9c68ddca5645d858e96903c05e->leave($__internal_049a34241f3b159b4e8bd11b4fc67bde5756ef9c68ddca5645d858e96903c05e_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_3f28a0d738a349083ca871f3a22734742d42aa5c7122dfd0f0d8767c99c99433 = $this->env->getExtension("native_profiler");
        $__internal_3f28a0d738a349083ca871f3a22734742d42aa5c7122dfd0f0d8767c99c99433->enter($__internal_3f28a0d738a349083ca871f3a22734742d42aa5c7122dfd0f0d8767c99c99433_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">

    ";
        // line 6
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "1376e32_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32_0") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32_bootstrap_extra_1.css");
            // line 9
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "1376e32"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 11
        echo "    <style>
        @font-face {
            font-family: \"custom_font\";
            src: url('";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/themes/default/fonts/pro_light.eot"), "html", null, true);
        echo "');
            src: url('";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/themes/default/fonts/pro_light.eot"), "html", null, true);
        echo "') format('embedded-opentype'),
            url('";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/themes/default/fonts/pro_light.woff2"), "html", null, true);
        echo "') format('woff2'),
            url('";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/themes/default/fonts/pro_light.woff"), "html", null, true);
        echo "') format('woff'),
            url('";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/themes/default/fonts/pro_light.ttf"), "html", null, true);
        echo "') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        body{
            background: url('";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/form_basic/background.jpg"), "html", null, true);
        echo "');
            font-family: 'custom_font';
            font-size: 1.9em;
        }
        .main{
            margin: 15px auto 20px;
        }
        .main h1{
            margin-top: 0;
            border-bottom: 1px dashed #999;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        label{
            color: #222;
            text-shadow: 1px 1px 1px #fff;
        }
        input, select, textarea{
            border-color: #999 !important;
            background-color: rgba(255, 255, 255, 0.7);
            color: #333 !important;
        }
        .height-adjust-content{
            /* Internet Explorer 10 */
            display:-ms-flexbox;
            -ms-flex-pack:center;
            -ms-flex-align:center;

            /* Firefox */
            display:-moz-box;
            -moz-box-pack:center;
            -moz-box-align:center;

            /* Safari, Opera, and Chrome */
            display:-webkit-box;
            -webkit-box-pack:center;
            -webkit-box-align:center;

            /* W3C */
            display:box;
            box-pack:center;
            box-align:center;

            text-align: center;
            vertical-align: middle;
        }
        @media(min-width:768px) {
            .col-form{
                background: rgba(255, 255, 255, 0.43);
                padding: 40px;
                border: 1px solid #999;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
            }

            input, select, textarea{
                -webkit-border-radius: 20px !important;
                -moz-border-radius: 20px !important;
                border-radius: 20px !important;
            }
        }


    </style>

    ";
        // line 89
        $this->displayBlock('head_extra', $context, $blocks);
        // line 90
        echo "
";
        
        $__internal_3f28a0d738a349083ca871f3a22734742d42aa5c7122dfd0f0d8767c99c99433->leave($__internal_3f28a0d738a349083ca871f3a22734742d42aa5c7122dfd0f0d8767c99c99433_prof);

    }

    // line 89
    public function block_head_extra($context, array $blocks = array())
    {
        $__internal_a6f0124e171aad606fb4e140916513f20272aee9e94e651879f5634e8e761e01 = $this->env->getExtension("native_profiler");
        $__internal_a6f0124e171aad606fb4e140916513f20272aee9e94e651879f5634e8e761e01->enter($__internal_a6f0124e171aad606fb4e140916513f20272aee9e94e651879f5634e8e761e01_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head_extra"));

        echo "";
        
        $__internal_a6f0124e171aad606fb4e140916513f20272aee9e94e651879f5634e8e761e01->leave($__internal_a6f0124e171aad606fb4e140916513f20272aee9e94e651879f5634e8e761e01_prof);

    }

    // line 93
    public function block_body($context, array $blocks = array())
    {
        $__internal_32bd3c4148105d62e9003ea3313ebe5b31828854d2acb2accd4d59774da64de2 = $this->env->getExtension("native_profiler");
        $__internal_32bd3c4148105d62e9003ea3313ebe5b31828854d2acb2accd4d59774da64de2->enter($__internal_32bd3c4148105d62e9003ea3313ebe5b31828854d2acb2accd4d59774da64de2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 94
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-6 hidden-xs hidden-sm\">
                <img src=\"";
        // line 97
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/form_basic/wolo_logo.png"), "html", null, true);
        echo "\">
            </div>
            <div class=\"col-md-6 hidden-xs hidden-sm height-adjust-content\" style=\"height: 139px;\">
                ";
        // line 100
        $this->displayBlock('header_right', $context, $blocks);
        // line 101
        echo "            </div>
        </div>
    </div>
    <div id=\"separator\" style=\"background: url(";
        // line 104
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/form_basic/separator.png"), "html", null, true);
        echo ") center no-repeat; height: 84px\">
    </div>
    <div class=\"main container\">
        <div class=\"row\">
            <div class=\"col-md-5 col-form\">
                    ";
        // line 109
        $this->displayBlock('page_container', $context, $blocks);
        // line 110
        echo "            </div>
            <div class=\"col-md-offset-1 col-md-6 hidden-xs hidden-sm\" style=\"background: url('";
        // line 111
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/form_basic/img_fill.png"), "html", null, true);
        echo "') no-repeat center top; min-height: 600px\">

            </div>
        </div>
    </div>
";
        
        $__internal_32bd3c4148105d62e9003ea3313ebe5b31828854d2acb2accd4d59774da64de2->leave($__internal_32bd3c4148105d62e9003ea3313ebe5b31828854d2acb2accd4d59774da64de2_prof);

    }

    // line 100
    public function block_header_right($context, array $blocks = array())
    {
        $__internal_7dd7aec6efa0da0c1470f5b5a3936d7e07945cbdb8f0b1a8baa4ce83b54c91cf = $this->env->getExtension("native_profiler");
        $__internal_7dd7aec6efa0da0c1470f5b5a3936d7e07945cbdb8f0b1a8baa4ce83b54c91cf->enter($__internal_7dd7aec6efa0da0c1470f5b5a3936d7e07945cbdb8f0b1a8baa4ce83b54c91cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header_right"));

        echo "";
        
        $__internal_7dd7aec6efa0da0c1470f5b5a3936d7e07945cbdb8f0b1a8baa4ce83b54c91cf->leave($__internal_7dd7aec6efa0da0c1470f5b5a3936d7e07945cbdb8f0b1a8baa4ce83b54c91cf_prof);

    }

    // line 109
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_bed1f2cd3ea9dc96621e31cc19d0eede1cb729c33c42c16dfd0e5c141413203e = $this->env->getExtension("native_profiler");
        $__internal_bed1f2cd3ea9dc96621e31cc19d0eede1cb729c33c42c16dfd0e5c141413203e->enter($__internal_bed1f2cd3ea9dc96621e31cc19d0eede1cb729c33c42c16dfd0e5c141413203e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        echo "";
        
        $__internal_bed1f2cd3ea9dc96621e31cc19d0eede1cb729c33c42c16dfd0e5c141413203e->leave($__internal_bed1f2cd3ea9dc96621e31cc19d0eede1cb729c33c42c16dfd0e5c141413203e_prof);

    }

    // line 118
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_4b3177760eac1ec59bbe2d49fc9ee5521b961fbe01da649adc75d8788037e7b5 = $this->env->getExtension("native_profiler");
        $__internal_4b3177760eac1ec59bbe2d49fc9ee5521b961fbe01da649adc75d8788037e7b5->enter($__internal_4b3177760eac1ec59bbe2d49fc9ee5521b961fbe01da649adc75d8788037e7b5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 119
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    ";
        // line 120
        $this->displayBlock('javascrips_extra', $context, $blocks);
        
        $__internal_4b3177760eac1ec59bbe2d49fc9ee5521b961fbe01da649adc75d8788037e7b5->leave($__internal_4b3177760eac1ec59bbe2d49fc9ee5521b961fbe01da649adc75d8788037e7b5_prof);

    }

    public function block_javascrips_extra($context, array $blocks = array())
    {
        $__internal_5baeab1355d23c73db3c07c56fd631eb104ddae9840371ff76fa559ad1ad6e49 = $this->env->getExtension("native_profiler");
        $__internal_5baeab1355d23c73db3c07c56fd631eb104ddae9840371ff76fa559ad1ad6e49->enter($__internal_5baeab1355d23c73db3c07c56fd631eb104ddae9840371ff76fa559ad1ad6e49_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascrips_extra"));

        echo "";
        
        $__internal_5baeab1355d23c73db3c07c56fd631eb104ddae9840371ff76fa559ad1ad6e49->leave($__internal_5baeab1355d23c73db3c07c56fd631eb104ddae9840371ff76fa559ad1ad6e49_prof);

    }

    public function getTemplateName()
    {
        return "::base_form_full_screen.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  272 => 120,  269 => 119,  263 => 118,  251 => 109,  239 => 100,  226 => 111,  223 => 110,  221 => 109,  213 => 104,  208 => 101,  206 => 100,  200 => 97,  195 => 94,  189 => 93,  177 => 89,  169 => 90,  167 => 89,  98 => 23,  90 => 18,  86 => 17,  82 => 16,  78 => 15,  74 => 14,  69 => 11,  55 => 9,  51 => 6,  46 => 3,  40 => 2,  11 => 1,);
    }
}
/* {% extends "::base.html.twig" %}*/
/* {% block stylesheets %}*/
/* */
/*     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">*/
/* */
/*     {% stylesheets*/
/*         "css_glob/bootstrap_extra.css"*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/*     <style>*/
/*         @font-face {*/
/*             font-family: "custom_font";*/
/*             src: url('{{ asset('bundles/app/app_shop/themes/default/fonts/pro_light.eot') }}');*/
/*             src: url('{{ asset('bundles/app/app_shop/themes/default/fonts/pro_light.eot')}}') format('embedded-opentype'),*/
/*             url('{{ asset('bundles/app/app_shop/themes/default/fonts/pro_light.woff2')}}') format('woff2'),*/
/*             url('{{ asset('bundles/app/app_shop/themes/default/fonts/pro_light.woff')}}') format('woff'),*/
/*             url('{{ asset('bundles/app/app_shop/themes/default/fonts/pro_light.ttf')}}') format('truetype');*/
/*             font-weight: normal;*/
/*             font-style: normal;*/
/*         }*/
/*         body{*/
/*             background: url('{{ asset('img/form_basic/background.jpg') }}');*/
/*             font-family: 'custom_font';*/
/*             font-size: 1.9em;*/
/*         }*/
/*         .main{*/
/*             margin: 15px auto 20px;*/
/*         }*/
/*         .main h1{*/
/*             margin-top: 0;*/
/*             border-bottom: 1px dashed #999;*/
/*             padding-bottom: 15px;*/
/*             margin-bottom: 30px;*/
/*         }*/
/*         label{*/
/*             color: #222;*/
/*             text-shadow: 1px 1px 1px #fff;*/
/*         }*/
/*         input, select, textarea{*/
/*             border-color: #999 !important;*/
/*             background-color: rgba(255, 255, 255, 0.7);*/
/*             color: #333 !important;*/
/*         }*/
/*         .height-adjust-content{*/
/*             /* Internet Explorer 10 *//* */
/*             display:-ms-flexbox;*/
/*             -ms-flex-pack:center;*/
/*             -ms-flex-align:center;*/
/* */
/*             /* Firefox *//* */
/*             display:-moz-box;*/
/*             -moz-box-pack:center;*/
/*             -moz-box-align:center;*/
/* */
/*             /* Safari, Opera, and Chrome *//* */
/*             display:-webkit-box;*/
/*             -webkit-box-pack:center;*/
/*             -webkit-box-align:center;*/
/* */
/*             /* W3C *//* */
/*             display:box;*/
/*             box-pack:center;*/
/*             box-align:center;*/
/* */
/*             text-align: center;*/
/*             vertical-align: middle;*/
/*         }*/
/*         @media(min-width:768px) {*/
/*             .col-form{*/
/*                 background: rgba(255, 255, 255, 0.43);*/
/*                 padding: 40px;*/
/*                 border: 1px solid #999;*/
/*                 -webkit-border-radius: 20px;*/
/*                 -moz-border-radius: 20px;*/
/*                 border-radius: 20px;*/
/*             }*/
/* */
/*             input, select, textarea{*/
/*                 -webkit-border-radius: 20px !important;*/
/*                 -moz-border-radius: 20px !important;*/
/*                 border-radius: 20px !important;*/
/*             }*/
/*         }*/
/* */
/* */
/*     </style>*/
/* */
/*     {% block head_extra '' %}*/
/* */
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-md-6 hidden-xs hidden-sm">*/
/*                 <img src="{{ asset('img/form_basic/wolo_logo.png') }}">*/
/*             </div>*/
/*             <div class="col-md-6 hidden-xs hidden-sm height-adjust-content" style="height: 139px;">*/
/*                 {% block header_right '' %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div id="separator" style="background: url({{ asset('img/form_basic/separator.png') }}) center no-repeat; height: 84px">*/
/*     </div>*/
/*     <div class="main container">*/
/*         <div class="row">*/
/*             <div class="col-md-5 col-form">*/
/*                     {% block page_container '' %}*/
/*             </div>*/
/*             <div class="col-md-offset-1 col-md-6 hidden-xs hidden-sm" style="background: url('{{ asset('img/form_basic/img_fill.png') }}') no-repeat center top; min-height: 600px">*/
/* */
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block javascripts %}*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/*     {% block javascrips_extra '' %}*/
/* {% endblock %}*/
/* */
