<?php

/* AppBundle:Others/Default/partials:home_header.html.twig */
class __TwigTemplate_241dc0a3995cfe177837c4c3438db36b75c6576538f88cfa18bf7fb975ee3d9b extends Twig_Template
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
        $__internal_24c8c9262983ee2e003c774281d57f7810e76735d9e3cef68e984401aa9327db = $this->env->getExtension("native_profiler");
        $__internal_24c8c9262983ee2e003c774281d57f7810e76735d9e3cef68e984401aa9327db->enter($__internal_24c8c9262983ee2e003c774281d57f7810e76735d9e3cef68e984401aa9327db_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/partials:home_header.html.twig"));

        // line 1
        echo "<style>
    #logo {
        margin-top:-10px;
    }

    .navbar-default {
        border-color: rgba(35, 35, 35, 0.05);
        font-family: 'Questrial', 'Helvetica Neue', Arial, sans-serif;
        -webkit-transition: all .4s;
        -moz-transition: all .4s;
        transition: all .4s;
    }
    .navbar-default .navbar-toggle:focus,
    .navbar-default .navbar-toggle:hover {
        background-color: #fda82c;
        color: #f7f7f7 !important;
    }
    .navbar-default .navbar-toggle,
    .navbar-default .navbar-collapse {
        border-color: transparent;
    }
    .navbar-default .nav > li.btn-singup > a {
        background: #fc9702;
        color: #f7f7f7 !important;
    }
    .navbar-default .nav > li.btn-singup > a:hover {
        background: #fda82c;
        color: #f7f7f7;
    }
    .navbar-default .nav > li.btn-login > a {
        background: rgba(0, 0, 0, 0.2);
        color: #fc9702;
    }
    .navbar-default .nav > li.btn-login > a:hover {
        background: rgba(0, 0, 0, 0.1);
        color: #858e9c !important;
    }
    .navbar-default .nav > li > a,
    .navbar-default .nav > li > a:focus {
        text-transform: uppercase;
        font-size: 13px;
        font-weight: 700;
    }
    .navbar-default.affix .nav > li > a,
    .navbar-default.affix .nav > li > a:focus {
        color: #858e9c;
    }
    .navbar-default .nav > li > a:hover,
    .navbar-default .nav > li > a:focus:hover {
        color: #fc9702;
    }
    .navbar-default .nav > li.active > a,
    .navbar-default .nav > li.active > a:focus {
        color: #fc9702 !important;
        background-color: transparent;
    }
    .navbar-default .nav > li.active > a:hover,
    .navbar-default .nav > li.active > a:focus:hover {
        background-color: transparent;
    }

</style>
<nav id=\"topNav\" class=\"navbar navbar-default navbar-fixed-top\">
    <div class=\"container-fluid\">
        <div class=\"navbar-header\">
            <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-navbar\">
                <span class=\"sr-only\">Wolopay Toggle navigation</span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
                <span class=\"icon-bar\"></span>
            </button>
            <a id=\"logo\" class=\"navbar-brand page-scroll\" href=\"";
        // line 72
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#intro\"><img src=\"/bundles/app/default/images/wolopay-logo.png\"></a>
        </div>
        <div class=\"navbar-collapse collapse\" id=\"bs-navbar\">
            <ul class=\"nav navbar-nav\">
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 77
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#tryit\">Try it!</a>
                </li>
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 80
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#features\">Features</a>
                </li>
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 83
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#pricing\">Pricing</a>
                </li>
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 86
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#company\">About Us / Company</a>
                </li>
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 89
        echo $this->env->getExtension('routing')->getPath("documentation_inshort");
        echo "\">Developers</a>
                </li>
                <li>
                    <a class=\"page-scroll\" href=\"";
        // line 92
        echo $this->env->getExtension('routing')->getPath("home");
        echo "#contact\">Contact</a>
                </li>
            </ul>
            <ul class=\"nav navbar-nav navbar-right\">
                <li class=\"btn-login\">
                    <a class=\"page-scroll\" title=\"Wolopay Log In\" href=\"";
        // line 97
        echo $this->env->getExtension('routing')->getPath("admin_home");
        echo "\">Log in</a>
                </li>
                <li class=\"btn-singup\">
                    <a class=\"page-scroll\" title=\"Wolopay Sign Up\" href=\"";
        // line 100
        echo $this->env->getExtension('routing')->getPath("singup");
        echo "\">Sing up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>";
        
        $__internal_24c8c9262983ee2e003c774281d57f7810e76735d9e3cef68e984401aa9327db->leave($__internal_24c8c9262983ee2e003c774281d57f7810e76735d9e3cef68e984401aa9327db_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/partials:home_header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 100,  141 => 97,  133 => 92,  127 => 89,  121 => 86,  115 => 83,  109 => 80,  103 => 77,  95 => 72,  22 => 1,);
    }
}
/* <style>*/
/*     #logo {*/
/*         margin-top:-10px;*/
/*     }*/
/* */
/*     .navbar-default {*/
/*         border-color: rgba(35, 35, 35, 0.05);*/
/*         font-family: 'Questrial', 'Helvetica Neue', Arial, sans-serif;*/
/*         -webkit-transition: all .4s;*/
/*         -moz-transition: all .4s;*/
/*         transition: all .4s;*/
/*     }*/
/*     .navbar-default .navbar-toggle:focus,*/
/*     .navbar-default .navbar-toggle:hover {*/
/*         background-color: #fda82c;*/
/*         color: #f7f7f7 !important;*/
/*     }*/
/*     .navbar-default .navbar-toggle,*/
/*     .navbar-default .navbar-collapse {*/
/*         border-color: transparent;*/
/*     }*/
/*     .navbar-default .nav > li.btn-singup > a {*/
/*         background: #fc9702;*/
/*         color: #f7f7f7 !important;*/
/*     }*/
/*     .navbar-default .nav > li.btn-singup > a:hover {*/
/*         background: #fda82c;*/
/*         color: #f7f7f7;*/
/*     }*/
/*     .navbar-default .nav > li.btn-login > a {*/
/*         background: rgba(0, 0, 0, 0.2);*/
/*         color: #fc9702;*/
/*     }*/
/*     .navbar-default .nav > li.btn-login > a:hover {*/
/*         background: rgba(0, 0, 0, 0.1);*/
/*         color: #858e9c !important;*/
/*     }*/
/*     .navbar-default .nav > li > a,*/
/*     .navbar-default .nav > li > a:focus {*/
/*         text-transform: uppercase;*/
/*         font-size: 13px;*/
/*         font-weight: 700;*/
/*     }*/
/*     .navbar-default.affix .nav > li > a,*/
/*     .navbar-default.affix .nav > li > a:focus {*/
/*         color: #858e9c;*/
/*     }*/
/*     .navbar-default .nav > li > a:hover,*/
/*     .navbar-default .nav > li > a:focus:hover {*/
/*         color: #fc9702;*/
/*     }*/
/*     .navbar-default .nav > li.active > a,*/
/*     .navbar-default .nav > li.active > a:focus {*/
/*         color: #fc9702 !important;*/
/*         background-color: transparent;*/
/*     }*/
/*     .navbar-default .nav > li.active > a:hover,*/
/*     .navbar-default .nav > li.active > a:focus:hover {*/
/*         background-color: transparent;*/
/*     }*/
/* */
/* </style>*/
/* <nav id="topNav" class="navbar navbar-default navbar-fixed-top">*/
/*     <div class="container-fluid">*/
/*         <div class="navbar-header">*/
/*             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">*/
/*                 <span class="sr-only">Wolopay Toggle navigation</span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*                 <span class="icon-bar"></span>*/
/*             </button>*/
/*             <a id="logo" class="navbar-brand page-scroll" href="{{ path('home') }}#intro"><img src="/bundles/app/default/images/wolopay-logo.png"></a>*/
/*         </div>*/
/*         <div class="navbar-collapse collapse" id="bs-navbar">*/
/*             <ul class="nav navbar-nav">*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('home') }}#tryit">Try it!</a>*/
/*                 </li>*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('home') }}#features">Features</a>*/
/*                 </li>*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('home') }}#pricing">Pricing</a>*/
/*                 </li>*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('home') }}#company">About Us / Company</a>*/
/*                 </li>*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('documentation_inshort') }}">Developers</a>*/
/*                 </li>*/
/*                 <li>*/
/*                     <a class="page-scroll" href="{{ path('home') }}#contact">Contact</a>*/
/*                 </li>*/
/*             </ul>*/
/*             <ul class="nav navbar-nav navbar-right">*/
/*                 <li class="btn-login">*/
/*                     <a class="page-scroll" title="Wolopay Log In" href="{{ path('admin_home') }}">Log in</a>*/
/*                 </li>*/
/*                 <li class="btn-singup">*/
/*                     <a class="page-scroll" title="Wolopay Sign Up" href="{{ path('singup') }}">Sing up</a>*/
/*                 </li>*/
/*             </ul>*/
/*         </div>*/
/*     </div>*/
/* </nav>*/
