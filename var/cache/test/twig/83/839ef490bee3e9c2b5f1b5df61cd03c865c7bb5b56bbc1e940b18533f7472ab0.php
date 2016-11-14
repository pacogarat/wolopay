<?php

/* AppBundle:AppShop/Shop/partials_js:properties_default.html.twig */
class __TwigTemplate_0b2951c08c0223a1f6d2561d5d92f940ed119f8337ee3e193ef02cf92ad9f4c3 extends Twig_Template
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
        $__internal_1be57d059abc2053a9aa122246b68b3764b4c2a0443997c8e310ead33a692fc5 = $this->env->getExtension("native_profiler");
        $__internal_1be57d059abc2053a9aa122246b68b3764b4c2a0443997c8e310ead33a692fc5->enter($__internal_1be57d059abc2053a9aa122246b68b3764b4c2a0443997c8e310ead33a692fc5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials_js:properties_default.html.twig"));

        // line 1
        echo "var jwt = '";
        echo twig_escape_filter($this->env, (isset($context["jwtString"]) ? $context["jwtString"] : $this->getContext($context, "jwtString")), "html", null, true);
        echo "';

var propertiesDefault = {
    language: ";
        // line 4
        echo $this->env->getExtension('jms_serializer')->serialize((isset($context["languageDefault"]) ? $context["languageDefault"] : $this->getContext($context, "languageDefault")), "json");
        echo ",
    languages: ";
        // line 5
        echo $this->env->getExtension('jms_serializer')->serialize((isset($context["languages"]) ? $context["languages"] : $this->getContext($context, "languages")), "json");
        echo ",
    transactionId: '";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "id", array()), "html", null, true);
        echo "',
    nodeServer : '";
        // line 7
        echo twig_escape_filter($this->env, (isset($context["nodeServer"]) ? $context["nodeServer"] : $this->getContext($context, "nodeServer")), "html", null, true);
        echo "',
    d: ";
        // line 8
        echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "debug", array()), "json");
        echo ",
    domainMain: '";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
        echo "',
    shoppingCartMaxItems: ";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["shopping_cart_max_items"]) ? $context["shopping_cart_max_items"] : $this->getContext($context, "shopping_cart_max_items")), "html", null, true);
        echo ",
    app: ";
        // line 11
        echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "json", (isset($context["appSerializeContext"]) ? $context["appSerializeContext"] : $this->getContext($context, "appSerializeContext")));
        echo ",
    v: '";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["assets_version"]) ? $context["assets_version"] : $this->getContext($context, "assets_version")), "html", null, true);
        echo "'

    ";
        // line 14
        if ( !array_key_exists("completed", $context)) {
            // line 15
            echo "        ,articleSelected :";
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "selectedArticle", array()), "json", (isset($context["articleSerializeContext"]) ? $context["articleSerializeContext"] : $this->getContext($context, "articleSerializeContext")));
            echo ",
        country :";
            // line 16
            echo $this->env->getExtension('jms_serializer')->serialize((isset($context["countryDefault"]) ? $context["countryDefault"] : $this->getContext($context, "countryDefault")), "json");
            echo ",
        countries :";
            // line 17
            echo $this->env->getExtension('jms_serializer')->serialize((isset($context["countriesAvailable"]) ? $context["countriesAvailable"] : $this->getContext($context, "countriesAvailable")), "json");
            echo ",
        articleTab :";
            // line 18
            echo $this->env->getExtension('jms_serializer')->serialize((isset($context["articleTabDefault"]) ? $context["articleTabDefault"] : $this->getContext($context, "articleTabDefault")), "json", (isset($context["appTabContext"]) ? $context["appTabContext"] : $this->getContext($context, "appTabContext")));
            echo ",
        appId:'";
            // line 19
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "id", array()), "html", null, true);
            echo "',
        gamerId:'";
            // line 20
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "gamer", array()), "id", array()), "html", null, true);
            echo "',
        gamerExternalId:'";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "gamer", array()), "gamerExternalId", array()), "html", null, true);
            echo "',
        levelCategoryId:";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "levelCategory", array()), "id", array()), "html", null, true);
            echo ",
        tutorialEnabled:";
            // line 23
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "tutorialEnabled", array()), "json");
            echo ",
        tutorialPromoCode:";
            // line 24
            echo $this->env->getExtension('jms_serializer')->serialize((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "tutorialPromoCode", array(), "any", false, true), "code", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user", array(), "any", false, true), "tutorialPromoCode", array(), "any", false, true), "code", array()), null)) : (null)), "json");
            echo ",
        fixedCountry:";
            // line 25
            echo $this->env->getExtension('jms_serializer')->serialize((isset($context["fixedCountry"]) ? $context["fixedCountry"] : $this->getContext($context, "fixedCountry")), "json");
            echo ",
        returnUrl:";
            // line 26
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "return", array()), "json");
            echo ",
        isModule:";
            // line 27
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["shopCss"]) ? $context["shopCss"] : $this->getContext($context, "shopCss")), "modular", array()), "json");
            echo ",
        productsRows:";
            // line 28
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shopCss"]) ? $context["shopCss"] : $this->getContext($context, "shopCss")), "productRows", array()), "html", null, true);
            echo ",
        payMethodsRows:";
            // line 29
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["shopCss"]) ? $context["shopCss"] : $this->getContext($context, "shopCss")), "payMethodRows", array()), "html", null, true);
            echo ",
        firstPayMethods:";
            // line 30
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "firstPayMethods", array()), "json");
            echo ",
        fixedLanguage: ";
            // line 31
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "fixedLanguage", array()), "json");
            echo ",
        hasCategories: ";
            // line 32
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "hasCategories", array()), "json");
            echo ",
        hasCart: ";
            // line 33
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "hasCart", array()), "json");
            echo ",
        hasPayMethodsSection: ";
            // line 34
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "hasPayMethodsSection", array()), "json");
            echo ",
        externalStore: ";
            // line 35
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "externalStore", array()), "json");
            echo ",
        forceGenericPMPC: ";
            // line 36
            if ($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "forceGenericPMPC", array())) {
                echo "{id: ";
                echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "forceGenericPMPC", array()), "json");
                echo " } ";
            } else {
                echo " null ";
            }
            echo ",
        gamerWallet: ";
            // line 37
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "gamer", array()), "currentWallet", array(0 => true), "method"), "json", (isset($context["gamerWalletSerializeContext"]) ? $context["gamerWalletSerializeContext"] : $this->getContext($context, "gamerWalletSerializeContext")));
            echo ",
        walletConf: ";
            // line 38
            echo $this->env->getExtension('jms_serializer')->serialize((isset($context["walletConfExtractProperties"]) ? $context["walletConfExtractProperties"] : $this->getContext($context, "walletConfExtractProperties")), "json", (isset($context["walletConfSerializeContext"]) ? $context["walletConfSerializeContext"] : $this->getContext($context, "walletConfSerializeContext")));
            echo ",
        isModule:";
            // line 39
            echo $this->env->getExtension('jms_serializer')->serialize($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "json");
            echo "
    ";
        }
        // line 41
        echo "
} ;

";
        
        $__internal_1be57d059abc2053a9aa122246b68b3764b4c2a0443997c8e310ead33a692fc5->leave($__internal_1be57d059abc2053a9aa122246b68b3764b4c2a0443997c8e310ead33a692fc5_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials_js:properties_default.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 41,  171 => 39,  167 => 38,  163 => 37,  153 => 36,  149 => 35,  145 => 34,  141 => 33,  137 => 32,  133 => 31,  129 => 30,  125 => 29,  121 => 28,  117 => 27,  113 => 26,  109 => 25,  105 => 24,  101 => 23,  97 => 22,  93 => 21,  89 => 20,  85 => 19,  81 => 18,  77 => 17,  73 => 16,  68 => 15,  66 => 14,  61 => 12,  57 => 11,  53 => 10,  49 => 9,  45 => 8,  41 => 7,  37 => 6,  33 => 5,  29 => 4,  22 => 1,);
    }
}
/* var jwt = '{{ jwtString }}';*/
/* */
/* var propertiesDefault = {*/
/*     language: {{ languageDefault | serialize('json') | raw   }},*/
/*     languages: {{ languages | serialize('json') | raw  }},*/
/*     transactionId: '{{ app.user.id }}',*/
/*     nodeServer : '{{nodeServer}}',*/
/*     d: {{ app.debug | serialize('json') | raw  }},*/
/*     domainMain: '{{ domain_main }}',*/
/*     shoppingCartMaxItems: {{shopping_cart_max_items}},*/
/*     app: {{ app.user.app | serialize('json', appSerializeContext) | raw }},*/
/*     v: '{{ assets_version }}'*/
/* */
/*     {% if completed is not defined %}*/
/*         ,articleSelected :{{ app.user.selectedArticle | serialize('json', articleSerializeContext) | raw  }},*/
/*         country :{{ countryDefault | serialize('json') | raw   }},*/
/*         countries :{{ countriesAvailable | serialize('json') | raw   }},*/
/*         articleTab :{{ articleTabDefault | serialize('json', appTabContext) | raw }},*/
/*         appId:'{{ app.user.app.id }}',*/
/*         gamerId:'{{ transaction.gamer.id }}',*/
/*         gamerExternalId:'{{ transaction.gamer.gamerExternalId }}',*/
/*         levelCategoryId:{{ app.user.levelCategory.id }},*/
/*         tutorialEnabled:{{ app.user.tutorialEnabled | serialize('json') | raw }},*/
/*         tutorialPromoCode:{{ app.user.tutorialPromoCode.code | default(null) | serialize('json') | raw   }},*/
/*         fixedCountry:{{ fixedCountry | serialize('json') | raw  }},*/
/*         returnUrl:{{ app.user.return | serialize('json') | raw  }},*/
/*         isModule:{{ shopCss.modular | serialize('json') | raw }},*/
/*         productsRows:{{ shopCss.productRows }},*/
/*         payMethodsRows:{{ shopCss.payMethodRows }},*/
/*         firstPayMethods:{{ transaction.firstPayMethods | serialize('json') | raw }},*/
/*         fixedLanguage: {{ transaction.fixedLanguage | serialize('json') | raw }},*/
/*         hasCategories: {{ transaction.hasCategories | serialize('json') | raw }},*/
/*         hasCart: {{ transaction.hasCart | serialize('json') | raw }},*/
/*         hasPayMethodsSection: {{ transaction.hasPayMethodsSection | serialize('json') | raw }},*/
/*         externalStore: {{ transaction.externalStore | serialize('json') | raw }},*/
/*         forceGenericPMPC: {% if transaction.forceGenericPMPC %}{id: {{ transaction.forceGenericPMPC | serialize('json') | raw }} } {% else %} null {% endif %},*/
/*         gamerWallet: {{ transaction.gamer.currentWallet(true) | serialize('json', gamerWalletSerializeContext) | raw   }},*/
/*         walletConf: {{ walletConfExtractProperties| serialize('json', walletConfSerializeContext) | raw  }},*/
/*         isModule:{{ app.user.app | serialize('json') | raw }}*/
/*     {% endif %}*/
/* */
/* } ;*/
/* */
/* */
