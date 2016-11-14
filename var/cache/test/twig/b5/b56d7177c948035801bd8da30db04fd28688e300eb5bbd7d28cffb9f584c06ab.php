<?php

/* @App/Documentation/documentation_layout.html.twig */
class __TwigTemplate_59635bdd927fa0eca387a0c4a33011ff17671c2c339857c5b50606b3f21496bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/Documentation/documentation_layout.html.twig", 1);
        $this->blocks = array(
            'head_extra' => array($this, 'block_head_extra'),
            'javascrips_extra' => array($this, 'block_javascrips_extra'),
            'page_container' => array($this, 'block_page_container'),
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_948fb974b4703d71b489991640acdf219857da22cf513a64828291b0ca6da0b4 = $this->env->getExtension("native_profiler");
        $__internal_948fb974b4703d71b489991640acdf219857da22cf513a64828291b0ca6da0b4->enter($__internal_948fb974b4703d71b489991640acdf219857da22cf513a64828291b0ca6da0b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/Documentation/documentation_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_948fb974b4703d71b489991640acdf219857da22cf513a64828291b0ca6da0b4->leave($__internal_948fb974b4703d71b489991640acdf219857da22cf513a64828291b0ca6da0b4_prof);

    }

    // line 2
    public function block_head_extra($context, array $blocks = array())
    {
        $__internal_5b05094ae996a38241fcf1ffa553bb3e3a356b0d16ffb7aa44d3098a3ddc44ae = $this->env->getExtension("native_profiler");
        $__internal_5b05094ae996a38241fcf1ffa553bb3e3a356b0d16ffb7aa44d3098a3ddc44ae->enter($__internal_5b05094ae996a38241fcf1ffa553bb3e3a356b0d16ffb7aa44d3098a3ddc44ae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head_extra"));

        // line 3
        echo "    ";
        // line 4
        echo "        ";
        // line 5
        echo "    ";
        // line 6
        echo "        ";
        // line 7
        echo "    ";
        // line 8
        echo "    <style>
        /*html { overflow-y: hidden; }*/
        body{
            background: url('";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("/bundles/app/documentation/img/background_repeat.png"), "html", null, true);
        echo "') repeat;
        }
        .tocify-container{
            margin-top: 50px;
        }
        .tocify-container li:not(.active)::before, .tocify-container li.active::before{
            font-family: 'Glyphicons Halflings';
            font-weight: normal;
            font-style: normal;
            text-decoration: inherit;
            position: absolute;
            margin-top: 9px;
            margin-left: -5px;
        }
        .tocify-container li:not(.active)::before{
            content: '\\e080';
            color: #444;
        }

        .tocify-container li.active::before{
            content: '\\e124';
            color: #fc9702;
            text-shadow: 1px 2px 0 #555;
        }

        .tocify-container li.main::before{
            content: '\\e144';
            color: #444;
        }

        .tocify-container li.active{
            background: rgba(252, 151, 2, 0.1);
        }
        .tocify-container li.active a, .tocify-container li:hover a, .tocify-container li:focus a, .tocify-container li a:hover, .tocify-container li a:focus{
            background: none !important;
        }
        .tocify-container li{
            padding-left: 20px !important;
        }
        @media only screen and (min-width : 992px) {
            .tocify-container{
                position: fixed;
            }
            .col-main{
                padding-left: 30px;
                background: rgba(255, 255, 255, 0.55);
                border-left: 1px dashed #ccc;
            }
        }



        .tocify-subheader, .tocify-like-subheader{
            padding-left: 20px;
        }
        div.generic-doc{
            font-size: 17px;
        }

        div.generic-doc h1{
            color: #FD9800;
            text-shadow: 1px 1px 1px #000;
            border-bottom: 1px solid #999;
            margin: 100px 0 30px;
            display: inline-block;
            clear: both;
        }

        div.generic-doc  h2, div.generic-doc  h3, div.generic-doc  h4, div.generic-doc h5{
            margin: 70px 0 30px;
        }
        .navbar-default {
            background-color: rgba(255,255,255,0.8);
            border-color: rgba(35, 35, 35, 0.1) !important;
        }
        .navbar-default .nav > li > a{
            color: #444 !important;
        }
        #col-menu a{
            color: #222;
            text-decoration: underline;
        }
        #toc a{
            color: #222;
            text-decoration: none;
        }

        .lang-btn-group{
            margin-top: 20px;
        }

        .lang-btn-group button{
            -webkit-border-radius: 5px !important;
            -webkit-border-bottom-right-radius: 0 !important;
            -webkit-border-bottom-left-radius: 0 !important;
            -moz-border-radius: 5px !important;
            -moz-border-radius-bottomright: 0 !important;
            -moz-border-radius-bottomleft: 0 !important;
            border-radius: 5px !important;
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        pre{
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
            margin-bottom: 30px;
        }


    </style>
";
        
        $__internal_5b05094ae996a38241fcf1ffa553bb3e3a356b0d16ffb7aa44d3098a3ddc44ae->leave($__internal_5b05094ae996a38241fcf1ffa553bb3e3a356b0d16ffb7aa44d3098a3ddc44ae_prof);

    }

    // line 123
    public function block_javascrips_extra($context, array $blocks = array())
    {
        $__internal_7ed0c37e78e2469e9b240dbe5131a4de548e0abe9febca971a88b24fa4d89cf4 = $this->env->getExtension("native_profiler");
        $__internal_7ed0c37e78e2469e9b240dbe5131a4de548e0abe9febca971a88b24fa4d89cf4->enter($__internal_7ed0c37e78e2469e9b240dbe5131a4de548e0abe9febca971a88b24fa4d89cf4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascrips_extra"));

        // line 124
        echo "    <script src=\"//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js\"></script>
    ";
        // line 125
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "18c6d89_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_18c6d89_0") : $this->env->getExtension('asset')->getAssetUrl("js/18c6d89_jquery-ui-1.9.1.custom.min_1.js");
            // line 129
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
    ";
            // asset "18c6d89_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_18c6d89_1") : $this->env->getExtension('asset')->getAssetUrl("js/18c6d89_jquery.tocify.min_2.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
    ";
        } else {
            // asset "18c6d89"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_18c6d89") : $this->env->getExtension('asset')->getAssetUrl("js/18c6d89.js");
            echo "        <script type=\"text/javascript\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
    ";
        }
        unset($context["asset_url"]);
        // line 131
        echo "    <script>
        \$(function() {

            \$('.generic-doc table').wrap( \"<div class='table-responsive'></div>\" );
            \$('.generic-doc table').addClass('table table-striped')

            //Calls the tocify method on your HTML div.
            \$('";
        // line 138
        echo twig_escape_filter($this->env, (isset($context["injectTocJquerySelector"]) ? $context["injectTocJquerySelector"] : $this->getContext($context, "injectTocJquerySelector")), "html", null, true);
        echo "').append(
                '<div id=\"toc\" class=\"tocify-like-subheader\"></div>'
            );

            function setColMenuWidth()
            {
                \$(\"#toc\").width(\$('#col-menu').width()-40);
            }
            setColMenuWidth();

            \$(\"#toc\").tocify({ selectors: \"";
        // line 148
        echo twig_escape_filter($this->env, ((array_key_exists("tocHeaders", $context)) ? (_twig_default_filter((isset($context["tocHeaders"]) ? $context["tocHeaders"] : $this->getContext($context, "tocHeaders")), "h1,h2,h3,h4")) : ("h1,h2,h3,h4")), "html", null, true);
        echo "\"});

            \$( window ).resize(function() {
                setColMenuWidth();
            });
        });
    </script>
";
        
        $__internal_7ed0c37e78e2469e9b240dbe5131a4de548e0abe9febca971a88b24fa4d89cf4->leave($__internal_7ed0c37e78e2469e9b240dbe5131a4de548e0abe9febca971a88b24fa4d89cf4_prof);

    }

    // line 156
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_5ef183636c1bb50cd39a26b35fe1716571277a048e4d45e71678aa576edf311f = $this->env->getExtension("native_profiler");
        $__internal_5ef183636c1bb50cd39a26b35fe1716571277a048e4d45e71678aa576edf311f->enter($__internal_5ef183636c1bb50cd39a26b35fe1716571277a048e4d45e71678aa576edf311f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 157
        echo "
    <div class=\"container-fluid\">
        ";
        // line 159
        $this->loadTemplate("@App/Others/Default/partials/home_header.html.twig", "@App/Documentation/documentation_layout.html.twig", 159)->display($context);
        // line 160
        echo "        <div class=\"row\" style=\"margin-top: 30px\">
            <div class=\"col-md-3\" id=\"col-menu\">
                <div style=\"overflow: hidden;\">
                    <div class=\"tocify-container\">
                        <ul class=\"tocify-header nav nav-list\">
                            <li id=\"in-short\" class=\"main\">
                                <a href=\"";
        // line 166
        echo $this->env->getExtension('routing')->getPath("documentation_inshort");
        echo "#InShort\">In Short (for the impatient)</a>
                            </li>
                            <li id=\"step-by-step\" class=\"main\">
                                <a href=\"";
        // line 169
        echo $this->env->getExtension('routing')->getPath("documentation_index");
        echo "#GettingStarted\">Step by step</a>
                            </li>
                            <li id=\"api\" class=\"main\">
                                <a href=\"";
        // line 172
        echo $this->env->getExtension('routing')->getPath("api_doc");
        echo "\">Api</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=\"col-md-9 col-main\">
                ";
        // line 179
        $this->displayBlock('main_content', $context, $blocks);
        // line 180
        echo "            </div>
        </div>
    </div>

";
        
        $__internal_5ef183636c1bb50cd39a26b35fe1716571277a048e4d45e71678aa576edf311f->leave($__internal_5ef183636c1bb50cd39a26b35fe1716571277a048e4d45e71678aa576edf311f_prof);

    }

    // line 179
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_1470ac3923ddc3ccc01d63e3b9fd73088b2db0d5e379c91d5376b30fa793c0df = $this->env->getExtension("native_profiler");
        $__internal_1470ac3923ddc3ccc01d63e3b9fd73088b2db0d5e379c91d5376b30fa793c0df->enter($__internal_1470ac3923ddc3ccc01d63e3b9fd73088b2db0d5e379c91d5376b30fa793c0df_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        echo "";
        
        $__internal_1470ac3923ddc3ccc01d63e3b9fd73088b2db0d5e379c91d5376b30fa793c0df->leave($__internal_1470ac3923ddc3ccc01d63e3b9fd73088b2db0d5e379c91d5376b30fa793c0df_prof);

    }

    public function getTemplateName()
    {
        return "@App/Documentation/documentation_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  302 => 179,  291 => 180,  289 => 179,  279 => 172,  273 => 169,  267 => 166,  259 => 160,  257 => 159,  253 => 157,  247 => 156,  232 => 148,  219 => 138,  210 => 131,  190 => 129,  186 => 125,  183 => 124,  177 => 123,  58 => 11,  53 => 8,  51 => 7,  49 => 6,  47 => 5,  45 => 4,  43 => 3,  37 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block head_extra %}*/
/*     {#{% stylesheets#}*/
/*         {#"bower_components/jquery.tocify.js/src/stylesheets/jquery.tocify.css"#}*/
/*     {#%}#}*/
/*         {#<link rel="stylesheet" href="{{ asset_url }}" media="screen" />#}*/
/*     {#{% endstylesheets %}#}*/
/*     <style>*/
/*         /*html { overflow-y: hidden; }*//* */
/*         body{*/
/*             background: url('{{asset('/bundles/app/documentation/img/background_repeat.png')}}') repeat;*/
/*         }*/
/*         .tocify-container{*/
/*             margin-top: 50px;*/
/*         }*/
/*         .tocify-container li:not(.active)::before, .tocify-container li.active::before{*/
/*             font-family: 'Glyphicons Halflings';*/
/*             font-weight: normal;*/
/*             font-style: normal;*/
/*             text-decoration: inherit;*/
/*             position: absolute;*/
/*             margin-top: 9px;*/
/*             margin-left: -5px;*/
/*         }*/
/*         .tocify-container li:not(.active)::before{*/
/*             content: '\e080';*/
/*             color: #444;*/
/*         }*/
/* */
/*         .tocify-container li.active::before{*/
/*             content: '\e124';*/
/*             color: #fc9702;*/
/*             text-shadow: 1px 2px 0 #555;*/
/*         }*/
/* */
/*         .tocify-container li.main::before{*/
/*             content: '\e144';*/
/*             color: #444;*/
/*         }*/
/* */
/*         .tocify-container li.active{*/
/*             background: rgba(252, 151, 2, 0.1);*/
/*         }*/
/*         .tocify-container li.active a, .tocify-container li:hover a, .tocify-container li:focus a, .tocify-container li a:hover, .tocify-container li a:focus{*/
/*             background: none !important;*/
/*         }*/
/*         .tocify-container li{*/
/*             padding-left: 20px !important;*/
/*         }*/
/*         @media only screen and (min-width : 992px) {*/
/*             .tocify-container{*/
/*                 position: fixed;*/
/*             }*/
/*             .col-main{*/
/*                 padding-left: 30px;*/
/*                 background: rgba(255, 255, 255, 0.55);*/
/*                 border-left: 1px dashed #ccc;*/
/*             }*/
/*         }*/
/* */
/* */
/* */
/*         .tocify-subheader, .tocify-like-subheader{*/
/*             padding-left: 20px;*/
/*         }*/
/*         div.generic-doc{*/
/*             font-size: 17px;*/
/*         }*/
/* */
/*         div.generic-doc h1{*/
/*             color: #FD9800;*/
/*             text-shadow: 1px 1px 1px #000;*/
/*             border-bottom: 1px solid #999;*/
/*             margin: 100px 0 30px;*/
/*             display: inline-block;*/
/*             clear: both;*/
/*         }*/
/* */
/*         div.generic-doc  h2, div.generic-doc  h3, div.generic-doc  h4, div.generic-doc h5{*/
/*             margin: 70px 0 30px;*/
/*         }*/
/*         .navbar-default {*/
/*             background-color: rgba(255,255,255,0.8);*/
/*             border-color: rgba(35, 35, 35, 0.1) !important;*/
/*         }*/
/*         .navbar-default .nav > li > a{*/
/*             color: #444 !important;*/
/*         }*/
/*         #col-menu a{*/
/*             color: #222;*/
/*             text-decoration: underline;*/
/*         }*/
/*         #toc a{*/
/*             color: #222;*/
/*             text-decoration: none;*/
/*         }*/
/* */
/*         .lang-btn-group{*/
/*             margin-top: 20px;*/
/*         }*/
/* */
/*         .lang-btn-group button{*/
/*             -webkit-border-radius: 5px !important;*/
/*             -webkit-border-bottom-right-radius: 0 !important;*/
/*             -webkit-border-bottom-left-radius: 0 !important;*/
/*             -moz-border-radius: 5px !important;*/
/*             -moz-border-radius-bottomright: 0 !important;*/
/*             -moz-border-radius-bottomleft: 0 !important;*/
/*             border-radius: 5px !important;*/
/*             border-bottom-right-radius: 0 !important;*/
/*             border-bottom-left-radius: 0 !important;*/
/*         }*/
/* */
/*         pre{*/
/*             border-top-left-radius: 0 !important;*/
/*             border-top-right-radius: 0 !important;*/
/*             margin-bottom: 30px;*/
/*         }*/
/* */
/* */
/*     </style>*/
/* {% endblock %}*/
/* {% block javascrips_extra %}*/
/*     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>*/
/*     {% javascripts*/
/*         'bower_components/jquery.tocify.js/libs/jqueryui/jquery-ui-1.9.1.custom.min.js'*/
/*         'bower_components/jquery.tocify.js/src/javascripts/jquery.tocify.min.js'*/
/*     %}*/
/*         <script type="text/javascript" src="{{ asset_url }}"></script>*/
/*     {% endjavascripts %}*/
/*     <script>*/
/*         $(function() {*/
/* */
/*             $('.generic-doc table').wrap( "<div class='table-responsive'></div>" );*/
/*             $('.generic-doc table').addClass('table table-striped')*/
/* */
/*             //Calls the tocify method on your HTML div.*/
/*             $('{{injectTocJquerySelector}}').append(*/
/*                 '<div id="toc" class="tocify-like-subheader"></div>'*/
/*             );*/
/* */
/*             function setColMenuWidth()*/
/*             {*/
/*                 $("#toc").width($('#col-menu').width()-40);*/
/*             }*/
/*             setColMenuWidth();*/
/* */
/*             $("#toc").tocify({ selectors: "{{ tocHeaders | default('h1,h2,h3,h4') }}"});*/
/* */
/*             $( window ).resize(function() {*/
/*                 setColMenuWidth();*/
/*             });*/
/*         });*/
/*     </script>*/
/* {% endblock %}*/
/* {% block page_container %}*/
/* */
/*     <div class="container-fluid">*/
/*         {% include '@App/Others/Default/partials/home_header.html.twig' %}*/
/*         <div class="row" style="margin-top: 30px">*/
/*             <div class="col-md-3" id="col-menu">*/
/*                 <div style="overflow: hidden;">*/
/*                     <div class="tocify-container">*/
/*                         <ul class="tocify-header nav nav-list">*/
/*                             <li id="in-short" class="main">*/
/*                                 <a href="{{path('documentation_inshort')}}#InShort">In Short (for the impatient)</a>*/
/*                             </li>*/
/*                             <li id="step-by-step" class="main">*/
/*                                 <a href="{{path('documentation_index')}}#GettingStarted">Step by step</a>*/
/*                             </li>*/
/*                             <li id="api" class="main">*/
/*                                 <a href="{{path('api_doc')}}">Api</a>*/
/*                             </li>*/
/*                         </ul>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             <div class="col-md-9 col-main">*/
/*                 {% block main_content '' %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock %}*/
