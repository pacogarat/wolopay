<?php

/* AppBundle:AppShop/Shop/partials_js:country_detect.html.twig */
class __TwigTemplate_ee8a3286610dd787563d7187c062120690db81bc01c2becb7685806c543f336a extends Twig_Template
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
        $__internal_e8a941fc7272fb0423804ca28213b88a17401b9ea2ece43401ebbd2fadfb6f9b = $this->env->getExtension("native_profiler");
        $__internal_e8a941fc7272fb0423804ca28213b88a17401b9ea2ece43401ebbd2fadfb6f9b->enter($__internal_e8a941fc7272fb0423804ca28213b88a17401b9ea2ece43401ebbd2fadfb6f9b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials_js:country_detect.html.twig"));

        // line 1
        if ($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "countryDetected", array())) {
            // line 2
            echo "
    ";
            // line 3
            $context["lang"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "countryDetected", array()), "language", array()), "id", array());
            // line 4
            echo "
";
        } else {
            // line 6
            echo "
    ";
            // line 7
            if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "preferredLanguage", array())) {
                // line 8
                echo "        ";
                $context["lang"] = twig_slice($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "preferredLanguage", array()), 0, 2);
                // line 9
                echo "    ";
            } else {
                // line 10
                echo "        ";
                $context["lang"] = "en";
                // line 11
                echo "    ";
            }
            // line 12
            echo "
";
        }
        // line 14
        echo "
<script src='//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["lang"]) ? $context["lang"] : $this->getContext($context, "lang")), "html", null, true);
        echo ".js'></script>";
        
        $__internal_e8a941fc7272fb0423804ca28213b88a17401b9ea2ece43401ebbd2fadfb6f9b->leave($__internal_e8a941fc7272fb0423804ca28213b88a17401b9ea2ece43401ebbd2fadfb6f9b_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials_js:country_detect.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 15,  54 => 14,  50 => 12,  47 => 11,  44 => 10,  41 => 9,  38 => 8,  36 => 7,  33 => 6,  29 => 4,  27 => 3,  24 => 2,  22 => 1,);
    }
}
/* {% if transaction.countryDetected %}*/
/* */
/*     {% set lang = transaction.countryDetected.language.id %}*/
/* */
/* {% else %}*/
/* */
/*     {% if app.request.preferredLanguage %}*/
/*         {% set lang = app.request.preferredLanguage | slice(0, 2) %}*/
/*     {% else %}*/
/*         {% set lang = 'en' %}*/
/*     {% endif %}*/
/* */
/* {% endif %}*/
/* */
/* <script src='//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_{{lang}}.js'></script>*/
