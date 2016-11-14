<?php

/* AppBundle:AppShop/Shop/widget:index_js_dynamic.html.twig */
class __TwigTemplate_a4d81451acb42022ed56c45fa46710cddc2e3f85da7f73e4da5d931cd5c4c45f extends Twig_Template
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
        $__internal_e06fedd407b2c81cf1796457fea929e104eb82b923aabc51b6e165890474ec48 = $this->env->getExtension("native_profiler");
        $__internal_e06fedd407b2c81cf1796457fea929e104eb82b923aabc51b6e165890474ec48->enter($__internal_e06fedd407b2c81cf1796457fea929e104eb82b923aabc51b6e165890474ec48_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/widget:index_js_dynamic.html.twig"));

        // line 1
        echo "
var injectInto = '.wolo-shop';

var elements = document.getElementsByClassName(injectInto.substr(1));

if (!elements[0])
    new Error(\"A element with selector \"+injectInto+\" must be exist\");

var container = elements[0];

function loadCss(url)
{
    if (document.getElementById(url))
        return;

    var link  = document.createElement('link');
    link.id   = url;
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = url;
    link.media = 'all';
    container.parentElement.appendChild(link);
}

";
        // line 25
        $context["themeTemplateAdd"] = "loadCss(\"URL_TO_REPLACE\");";
        // line 26
        $this->loadTemplate("@App/AppShop/Shop/partials/load_theme_available.html.twig", "AppBundle:AppShop/Shop/widget:index_js_dynamic.html.twig", 26)->display($context);
        // line 27
        echo "
";
        // line 28
        $this->loadTemplate("@App/AppShop/Shop/partials_js/properties_default.html.twig", "AppBundle:AppShop/Shop/widget:index_js_dynamic.html.twig", 28)->display($context);
        // line 29
        echo "
var l_lang;

";
        // line 32
        if ($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "countryDetected", array())) {
            // line 33
            echo "
    l_lang = '";
            // line 34
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "countryDetected", array()), "language", array()), "id", array()), "html", null, true);
            echo "';

";
        }
        // line 37
        echo "
";
        
        $__internal_e06fedd407b2c81cf1796457fea929e104eb82b923aabc51b6e165890474ec48->leave($__internal_e06fedd407b2c81cf1796457fea929e104eb82b923aabc51b6e165890474ec48_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/widget:index_js_dynamic.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 37,  67 => 34,  64 => 33,  62 => 32,  57 => 29,  55 => 28,  52 => 27,  50 => 26,  48 => 25,  22 => 1,);
    }
}
/* */
/* var injectInto = '.wolo-shop';*/
/* */
/* var elements = document.getElementsByClassName(injectInto.substr(1));*/
/* */
/* if (!elements[0])*/
/*     new Error("A element with selector "+injectInto+" must be exist");*/
/* */
/* var container = elements[0];*/
/* */
/* function loadCss(url)*/
/* {*/
/*     if (document.getElementById(url))*/
/*         return;*/
/* */
/*     var link  = document.createElement('link');*/
/*     link.id   = url;*/
/*     link.rel  = 'stylesheet';*/
/*     link.type = 'text/css';*/
/*     link.href = url;*/
/*     link.media = 'all';*/
/*     container.parentElement.appendChild(link);*/
/* }*/
/* */
/* {% set themeTemplateAdd = "loadCss(\"URL_TO_REPLACE\");" %}*/
/* {% include('@App/AppShop/Shop/partials/load_theme_available.html.twig') %}*/
/* */
/* {% include '@App/AppShop/Shop/partials_js/properties_default.html.twig' %}*/
/* */
/* var l_lang;*/
/* */
/* {% if transaction.countryDetected %}*/
/* */
/*     l_lang = '{{ transaction.countryDetected.language.id }}';*/
/* */
/* {% endif %}*/
/* */
/* */
