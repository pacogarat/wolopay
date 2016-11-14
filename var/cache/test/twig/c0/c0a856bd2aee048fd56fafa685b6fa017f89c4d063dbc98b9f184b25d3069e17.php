<?php

/* TwigBundle:Exception:error.html.twig */
class __TwigTemplate_fbc1334874dc7e3a8d1a55dff9a0ac18a9c2b757e49371396746459809f3030f extends Twig_Template
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
        $__internal_ce0c44a51123ada6b32308d08834c5ad9545b48ea3f2378388fa9471b5cd2ee8 = $this->env->getExtension("native_profiler");
        $__internal_ce0c44a51123ada6b32308d08834c5ad9545b48ea3f2378388fa9471b5cd2ee8->enter($__internal_ce0c44a51123ada6b32308d08834c5ad9545b48ea3f2378388fa9471b5cd2ee8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "TwigBundle:Exception:error.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title></title>
        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0\"/>
        <link href='//fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <title>An Error Occurred: ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo "</title>
        <style>
            body{
                font-family: 'Lobster', cursive;
                color: #eee;
                text-shadow: 2px 2px 1px #333;

                background: url('";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/bg_error.jpg"), "html", null, true);
        echo "') no-repeat center center fixed;
                background-size: 100% 100%;
            }
            h1{
                font-size: 100px;
                text-align: center;
                margin-top: 100px;
            }
            h2{
                text-align: center;
                font-size: 60px;
                margin: 40px;
            }
            #logo{
                text-align: center;
            }
            #logo img{
                margin-top: 100px ;
            }
            html {
                height: 100%
            }
        </style>
    </head>
    <body>


        <h1>";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo "</h1>
        <h2>Oops! Error: ";
        // line 45
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ".</h2>

        <div id=\"logo\">
            <a href=\"";
        // line 48
        echo $this->env->getExtension('routing')->getPath("home");
        echo "\">
                <img src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/logo_500x100.png"), "html", null, true);
        echo "\">
            </a>
        </div>

    </body>
</html>";
        
        $__internal_ce0c44a51123ada6b32308d08834c5ad9545b48ea3f2378388fa9471b5cd2ee8->leave($__internal_ce0c44a51123ada6b32308d08834c5ad9545b48ea3f2378388fa9471b5cd2ee8_prof);

    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 49,  86 => 48,  80 => 45,  76 => 44,  46 => 17,  36 => 10,  29 => 6,  22 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title></title>*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>*/
/*         <link href='//fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>*/
/*         <title>An Error Occurred: {{ status_text }}</title>*/
/*         <style>*/
/*             body{*/
/*                 font-family: 'Lobster', cursive;*/
/*                 color: #eee;*/
/*                 text-shadow: 2px 2px 1px #333;*/
/* */
/*                 background: url('{{ asset('img/bg_error.jpg') }}') no-repeat center center fixed;*/
/*                 background-size: 100% 100%;*/
/*             }*/
/*             h1{*/
/*                 font-size: 100px;*/
/*                 text-align: center;*/
/*                 margin-top: 100px;*/
/*             }*/
/*             h2{*/
/*                 text-align: center;*/
/*                 font-size: 60px;*/
/*                 margin: 40px;*/
/*             }*/
/*             #logo{*/
/*                 text-align: center;*/
/*             }*/
/*             #logo img{*/
/*                 margin-top: 100px ;*/
/*             }*/
/*             html {*/
/*                 height: 100%*/
/*             }*/
/*         </style>*/
/*     </head>*/
/*     <body>*/
/* */
/* */
/*         <h1>{{ status_code }}</h1>*/
/*         <h2>Oops! Error: {{ status_text }}.</h2>*/
/* */
/*         <div id="logo">*/
/*             <a href="{{ path('home')}}">*/
/*                 <img src="{{ asset('img/logo_500x100.png') }}">*/
/*             </a>*/
/*         </div>*/
/* */
/*     </body>*/
/* </html>*/
