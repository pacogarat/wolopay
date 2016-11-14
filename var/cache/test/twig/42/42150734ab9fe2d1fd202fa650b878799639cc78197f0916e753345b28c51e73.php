<?php

/* AppBundle:AppShop:layout_shop.html.twig */
class __TwigTemplate_ff6f1ff87f3d197eea058ac0da309717eb21f8b86e4b683835e81d65ed453b3d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'header' => array($this, 'block_header'),
            'javascript_end_body_before_exe' => array($this, 'block_javascript_end_body_before_exe'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_eb55ee9431b527cfb48b02643d8a23a508d8f8dc31caf31b43a1215cfdce0cea = $this->env->getExtension("native_profiler");
        $__internal_eb55ee9431b527cfb48b02643d8a23a508d8f8dc31caf31b43a1215cfdce0cea->enter($__internal_eb55ee9431b527cfb48b02643d8a23a508d8f8dc31caf31b43a1215cfdce0cea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop:layout_shop.html.twig"));

        // line 2
        echo "<!DOCTYPE html>
<html>
<head>
    <title>Wolopay</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\"/>
    <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/favicon.ico"), "html", null, true);
        echo "\">
    <link rel=\"icon\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/favicon.ico")), "html", null, true);
        echo "\" />

    ";
        // line 12
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "ce25196_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ce25196_0") : $this->env->getExtension('asset')->getAssetUrl("css/ce25196_theme_iframe_1.css");
            // line 15
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "ce25196"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_ce25196") : $this->env->getExtension('asset')->getAssetUrl("css/ce25196.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 17
        echo "    ";
        echo twig_include($this->env, $context, "@App/AppShop/Shop/partials/load_theme_available.html.twig");
        echo "

    ";
        // line 19
        $this->displayBlock('header', $context, $blocks);
        // line 20
        echo "
</head>

<body>

    ";
        // line 25
        $this->loadTemplate("@App/AppShop/Shop/partials/shop_body.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 25)->display(array_merge($context, array("box_windows" => $this->renderBlock("box_windows", $context, $blocks), "top_options" => $this->renderBlock("top_options", $context, $blocks), "menu" => $this->renderBlock("menu", $context, $blocks), "page" => $this->renderBlock("page", $context, $blocks), "extra_footer" => $this->renderBlock("extra_footer", $context, $blocks))));
        // line 29
        echo "
    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js\"></script>
    <script async src=\"//cdn.socket.io/socket.io-1.1.0.js\"></script>

    ";
        // line 34
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "0a8308c_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0a8308c_0") : $this->env->getExtension('asset')->getAssetUrl("js/angular-animate.min.js_angular-animate.min.js_1.map");
            // line 35
            echo "    ";
        } else {
            // asset "0a8308c"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_0a8308c") : $this->env->getExtension('asset')->getAssetUrl("js/angular-animate.min.js.map");
            echo "    ";
        }
        unset($context["asset_url"]);
        // line 36
        echo "
    <script>
        function loadScript(url)
        {
            var head = document.getElementsByTagName('head')[0];
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = url;
            head.appendChild(script);
        }

        ";
        // line 47
        $this->loadTemplate("@App/AppShop/Shop/partials_js/properties_default.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 47)->display($context);
        // line 48
        echo "
        ";
        // line 49
        if (($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "externalStore", array()) == twig_constant("AppBundle\\Entity\\Enum\\ExternalStoreEnum::FACEBOOK"))) {
            // line 50
            echo "            ";
            $this->loadTemplate("@App/AppShop/Shop/external_stores/facebook_static.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 50)->display($context);
            // line 51
            echo "        ";
        }
        // line 52
        echo "
    </script>
    ";
        // line 54
        $this->loadTemplate("@App/AppShop/Shop/partials_js/country_detect.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 54)->display($context);
        // line 55
        echo "
    ";
        // line 56
        $this->displayBlock('javascript_end_body_before_exe', $context, $blocks);
        // line 57
        echo "
    ";
        // line 58
        $this->loadTemplate("@App/AppShop/Shop/partials_js/load_libraries.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 58)->display($context);
        // line 59
        echo "

    ";
        // line 61
        $this->loadTemplate("@App/Partials/analitycs_by_gamer_id.html.twig", "AppBundle:AppShop:layout_shop.html.twig", 61)->display(array_merge($context, array("transaction" => $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()))));
        // line 62
        echo "
    <script>
        \$(document).ready(function(){
            angular.element(document).ready(function() {
                angular.bootstrap(document, ['shopApp']);
            });
        });
    </script>

</body>
</html>";
        
        $__internal_eb55ee9431b527cfb48b02643d8a23a508d8f8dc31caf31b43a1215cfdce0cea->leave($__internal_eb55ee9431b527cfb48b02643d8a23a508d8f8dc31caf31b43a1215cfdce0cea_prof);

    }

    // line 19
    public function block_header($context, array $blocks = array())
    {
        $__internal_58009b415d4254713a79202d37700697e49320f6eadb10004144775e3a7874ac = $this->env->getExtension("native_profiler");
        $__internal_58009b415d4254713a79202d37700697e49320f6eadb10004144775e3a7874ac->enter($__internal_58009b415d4254713a79202d37700697e49320f6eadb10004144775e3a7874ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header"));

        echo "";
        
        $__internal_58009b415d4254713a79202d37700697e49320f6eadb10004144775e3a7874ac->leave($__internal_58009b415d4254713a79202d37700697e49320f6eadb10004144775e3a7874ac_prof);

    }

    // line 56
    public function block_javascript_end_body_before_exe($context, array $blocks = array())
    {
        $__internal_9ce99fcff9f37ba58049c6509a8a124b72bd7db84b02f8d6b4fe1179059e1992 = $this->env->getExtension("native_profiler");
        $__internal_9ce99fcff9f37ba58049c6509a8a124b72bd7db84b02f8d6b4fe1179059e1992->enter($__internal_9ce99fcff9f37ba58049c6509a8a124b72bd7db84b02f8d6b4fe1179059e1992_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_end_body_before_exe"));

        echo "";
        
        $__internal_9ce99fcff9f37ba58049c6509a8a124b72bd7db84b02f8d6b4fe1179059e1992->leave($__internal_9ce99fcff9f37ba58049c6509a8a124b72bd7db84b02f8d6b4fe1179059e1992_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop:layout_shop.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 56,  161 => 19,  144 => 62,  142 => 61,  138 => 59,  136 => 58,  133 => 57,  131 => 56,  128 => 55,  126 => 54,  122 => 52,  119 => 51,  116 => 50,  114 => 49,  111 => 48,  109 => 47,  96 => 36,  88 => 35,  84 => 34,  77 => 29,  75 => 25,  68 => 20,  66 => 19,  60 => 17,  46 => 15,  42 => 12,  37 => 10,  33 => 9,  24 => 2,);
    }
}
/* {# transaction \AppBundle\Entity\Transaction #}*/
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <title>Wolopay</title>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>*/
/*     <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">*/
/*     <link rel="icon" href="{{ absolute_url(asset('img/favicon.ico')) }}" />*/
/* */
/*     {% stylesheets*/
/*         '@AppBundle/Resources/public/app_shop/themes/theme_iframe.less'*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/*     {{ include('@App/AppShop/Shop/partials/load_theme_available.html.twig') }}*/
/* */
/*     {% block header '' %}*/
/* */
/* </head>*/
/* */
/* <body>*/
/* */
/*     {% include '@App/AppShop/Shop/partials/shop_body.html.twig' with*/
/*         {'box_windows': block('box_windows'), 'top_options': block('top_options'),*/
/*         'menu': block('menu'),'page': block('page'),'extra_footer': block('extra_footer')*/
/*     } %}*/
/* */
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>*/
/*     <script async src="//cdn.socket.io/socket.io-1.1.0.js"></script>*/
/* */
/*     {% javascripts 'bower_components/angular-animate/angular-animate.min.js.map' output='js/angular-animate.min.js.map'%}*/
/*     {% endjavascripts %}*/
/* */
/*     <script>*/
/*         function loadScript(url)*/
/*         {*/
/*             var head = document.getElementsByTagName('head')[0];*/
/*             var script = document.createElement('script');*/
/*             script.type = 'text/javascript';*/
/*             script.src = url;*/
/*             head.appendChild(script);*/
/*         }*/
/* */
/*         {% include '@App/AppShop/Shop/partials_js/properties_default.html.twig' %}*/
/* */
/*         {% if transaction.externalStore == constant('AppBundle\\Entity\\Enum\\ExternalStoreEnum::FACEBOOK') %}*/
/*             {% include '@App/AppShop/Shop/external_stores/facebook_static.html.twig' %}*/
/*         {% endif %}*/
/* */
/*     </script>*/
/*     {% include '@App/AppShop/Shop/partials_js/country_detect.html.twig' %}*/
/* */
/*     {% block javascript_end_body_before_exe '' %}*/
/* */
/*     {% include '@App/AppShop/Shop/partials_js/load_libraries.html.twig' %}*/
/* */
/* */
/*     {% include '@App/Partials/analitycs_by_gamer_id.html.twig' with {'transaction': app.user } %}*/
/* */
/*     <script>*/
/*         $(document).ready(function(){*/
/*             angular.element(document).ready(function() {*/
/*                 angular.bootstrap(document, ['shopApp']);*/
/*             });*/
/*         });*/
/*     </script>*/
/* */
/* </body>*/
/* </html>*/
