<?php

/* AppBundle:AppShop/Shop/widget:index_js_static.html.twig */
class __TwigTemplate_5b3d79760b545be50dc8ad3b0f08f7bd3e59cf222bcd4db0140f9bd0b1cc8e18 extends Twig_Template
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
        $__internal_f05e787ecf5320d1b8b7432d6a0ca3acc147a4a93e4748605fd1f33626a588b6 = $this->env->getExtension("native_profiler");
        $__internal_f05e787ecf5320d1b8b7432d6a0ca3acc147a4a93e4748605fd1f33626a588b6->enter($__internal_f05e787ecf5320d1b8b7432d6a0ca3acc147a4a93e4748605fd1f33626a588b6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/widget:index_js_static.html.twig"));

        // line 2
        echo "
    // preload
    container.innerHTML = \"<div style='background: #FFFFCC;border: 2px solid #666;-webkit-border-radius: 100px;-moz-border-radius: 100px;border-radius: 100px;-moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;-webkit-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);-moz-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);padding: 30px 20px 15px 20px;text-align:center; width: 130px; margin:10% auto 0 auto'><img src='";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/wolopay.gif")), "html", null, true);
        echo "' width='100' height='100'><div style='padding-bottom:10px; text-shadow: 1px 1px 0 #fff'>♠ <em>Loading</em> ♠</div></div><div style='margin-top: 5%; text-align:center'><img src='";
        echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
        echo "\"+propertiesDefault.app.logo.img+\"'></div>\";

    // change scope from this generic scripts
    var \$Previous= window.\$, jQueryPrevious = window.jQuery, angularPrevious = window.angular, ioPrevious = window.io;
    window.angular = null;
    ";
        // line 9
        echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js");
        echo "
    ";
        // line 10
        echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js");
        echo "
    ";
        // line 11
        echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://cdn.socket.io/socket.io-1.1.0.js");
        echo "



    // lang can be setted in js_dynamic
    if (!l_lang)
    {
        if (navigator.userLanguage) // Explorer
            l_lang = navigator.userLanguage;
        else if (navigator.language) // FF
            l_lang = navigator.language;
        else
            l_lang = \"en\";

        l_lang = l_lang.substring(0,2).toLowerCase();
    }

    var script = '';
    function loadScript(site, callback)
    {
        callback = callback || function(){};
        var r = new XMLHttpRequest();

        r.open(\"GET\", site, true);
        r.onreadystatechange = function () {
            console.log(site, r.readyState , r.status );
            if (r.readyState != 4 || r.status != 200)
                return;

            script+=r.responseText;
            callback(r.responseText);

        };
        r.send();
    }

    loadScript('//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_'+l_lang+'.js', exe(\$, jQuery, angular));

    function exe(\$, jQuery, angular)
    {
        console.log(\"script exec\");

        ";
        // line 53
        $this->loadTemplate("@App/AppShop/Shop/partials_js/load_libraries.html.twig", "AppBundle:AppShop/Shop/widget:index_js_static.html.twig", 53)->display(array_merge($context, array("loadJsTemplate" => "{{ absolute_url(asset_url) | injectExternalContent | raw }}")));
        // line 54
        echo "
        container = \$(container);
        container.load('";
        // line 56
        echo twig_escape_filter($this->env, ((isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")) . "/cache/show_shop.html"), "html", null, true);
        echo "', function(){
            angular.bootstrap(container, ['shopApp']);


            // restore generic scripts
            window.angular = angularPrevious;
            window.\$ = \$Previous;
            window.jQuery = jQueryPrevious;
            window.io = ioPrevious;
        });


    }


    ";
        // line 72
        echo "
";
        
        $__internal_f05e787ecf5320d1b8b7432d6a0ca3acc147a4a93e4748605fd1f33626a588b6->leave($__internal_f05e787ecf5320d1b8b7432d6a0ca3acc147a4a93e4748605fd1f33626a588b6_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/widget:index_js_static.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 72,  95 => 56,  91 => 54,  89 => 53,  44 => 11,  40 => 10,  36 => 9,  26 => 4,  22 => 2,);
    }
}
/* {# transaction \AppBundle\Entity\Transaction #}*/
/* */
/*     // preload*/
/*     container.innerHTML = "<div style='background: #FFFFCC;border: 2px solid #666;-webkit-border-radius: 100px;-moz-border-radius: 100px;border-radius: 100px;-moz-background-clip: padding;-webkit-background-clip: padding-box;background-clip: padding-box;-webkit-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);-moz-box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.25);padding: 30px 20px 15px 20px;text-align:center; width: 130px; margin:10% auto 0 auto'><img src='{{ absolute_url(asset('/img/wolopay.gif')) }}' width='100' height='100'><div style='padding-bottom:10px; text-shadow: 1px 1px 0 #fff'>♠ <em>Loading</em> ♠</div></div><div style='margin-top: 5%; text-align:center'><img src='{{domain_main}}"+propertiesDefault.app.logo.img+"'></div>";*/
/* */
/*     // change scope from this generic scripts*/
/*     var $Previous= window.$, jQueryPrevious = window.jQuery, angularPrevious = window.angular, ioPrevious = window.io;*/
/*     window.angular = null;*/
/*     {{ 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js' | injectExternalContent | raw }}*/
/*     {{ 'https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js' | injectExternalContent | raw }}*/
/*     {{ 'https://cdn.socket.io/socket.io-1.1.0.js' | injectExternalContent | raw }}*/
/* */
/* */
/* */
/*     // lang can be setted in js_dynamic*/
/*     if (!l_lang)*/
/*     {*/
/*         if (navigator.userLanguage) // Explorer*/
/*             l_lang = navigator.userLanguage;*/
/*         else if (navigator.language) // FF*/
/*             l_lang = navigator.language;*/
/*         else*/
/*             l_lang = "en";*/
/* */
/*         l_lang = l_lang.substring(0,2).toLowerCase();*/
/*     }*/
/* */
/*     var script = '';*/
/*     function loadScript(site, callback)*/
/*     {*/
/*         callback = callback || function(){};*/
/*         var r = new XMLHttpRequest();*/
/* */
/*         r.open("GET", site, true);*/
/*         r.onreadystatechange = function () {*/
/*             console.log(site, r.readyState , r.status );*/
/*             if (r.readyState != 4 || r.status != 200)*/
/*                 return;*/
/* */
/*             script+=r.responseText;*/
/*             callback(r.responseText);*/
/* */
/*         };*/
/*         r.send();*/
/*     }*/
/* */
/*     loadScript('//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_'+l_lang+'.js', exe($, jQuery, angular));*/
/* */
/*     function exe($, jQuery, angular)*/
/*     {*/
/*         console.log("script exec");*/
/* */
/*         {% include '@App/AppShop/Shop/partials_js/load_libraries.html.twig' with { loadJsTemplate: '{{ absolute_url(asset_url) | injectExternalContent | raw }}'} %}*/
/* */
/*         container = $(container);*/
/*         container.load('{{ domain_main ~ '/cache/show_shop.html' }}', function(){*/
/*             angular.bootstrap(container, ['shopApp']);*/
/* */
/* */
/*             // restore generic scripts*/
/*             window.angular = angularPrevious;*/
/*             window.$ = $Previous;*/
/*             window.jQuery = jQueryPrevious;*/
/*             window.io = ioPrevious;*/
/*         });*/
/* */
/* */
/*     }*/
/* */
/* */
/*     {#exe();#}*/
/* */
/* */
