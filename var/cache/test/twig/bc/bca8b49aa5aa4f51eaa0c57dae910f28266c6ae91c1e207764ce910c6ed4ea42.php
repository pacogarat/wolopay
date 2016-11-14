<?php

/* AppBundle:Others/TranslationInHouse:translationInHouse.html.twig */
class __TwigTemplate_5b915c4a95ec24c2fdd87e2bed1d18b62af89aa49328433cc8fe9a476980a228 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@LexikTranslation/Translation/grid.html.twig", "AppBundle:Others/TranslationInHouse:translationInHouse.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@LexikTranslation/Translation/grid.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_71d19039e42f0945b0d547b932b4cdb889fc3c4504c9a7a050ad1024e86e9fc1 = $this->env->getExtension("native_profiler");
        $__internal_71d19039e42f0945b0d547b932b4cdb889fc3c4504c9a7a050ad1024e86e9fc1->enter($__internal_71d19039e42f0945b0d547b932b4cdb889fc3c4504c9a7a050ad1024e86e9fc1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/TranslationInHouse:translationInHouse.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_71d19039e42f0945b0d547b932b4cdb889fc3c4504c9a7a050ad1024e86e9fc1->leave($__internal_71d19039e42f0945b0d547b932b4cdb889fc3c4504c9a7a050ad1024e86e9fc1_prof);

    }

    // line 2
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_de584ced17c2e44ece638a0ab1cb7e4956cb9b821b04dcc404d35f66eaf8280b = $this->env->getExtension("native_profiler");
        $__internal_de584ced17c2e44ece638a0ab1cb7e4956cb9b821b04dcc404d35f66eaf8280b->enter($__internal_de584ced17c2e44ece638a0ab1cb7e4956cb9b821b04dcc404d35f66eaf8280b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 3
        echo "

    ";
        // line 5
        $this->displayParentBlock("toolbar", $context, $blocks);
        echo "
    <label for=\"toggle-all-columns\" class=\"locale ng-binding\">
        <input type=\"checkbox\" id=\"toggle-all-columns\" ng-model=\"onlyEmptyValues\" checked=\"checked\"> Show only empty values
    </label>
";
        
        $__internal_de584ced17c2e44ece638a0ab1cb7e4956cb9b821b04dcc404d35f66eaf8280b->leave($__internal_de584ced17c2e44ece638a0ab1cb7e4956cb9b821b04dcc404d35f66eaf8280b_prof);

    }

    // line 11
    public function block_javascript_footer($context, array $blocks = array())
    {
        $__internal_f95862f16c46cdc0b379a17eecc0ba0e5a6c94a10de53c7085d21e49480da835 = $this->env->getExtension("native_profiler");
        $__internal_f95862f16c46cdc0b379a17eecc0ba0e5a6c94a10de53c7085d21e49480da835->enter($__internal_f95862f16c46cdc0b379a17eecc0ba0e5a6c94a10de53c7085d21e49480da835_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_footer"));

        // line 12
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js\"></script>
    <script src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/ng-table/ng-table.min.js"), "html", null, true);
        echo "\"></script>

    <script>
        var translationCfg = {
            locales: ";
        // line 18
        echo twig_jsonencode_filter((isset($context["locales"]) ? $context["locales"] : $this->getContext($context, "locales")));
        echo ",
            inputType: '";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["inputType"]) ? $context["inputType"] : $this->getContext($context, "inputType")), "html", null, true);
        echo "',
            autoCacheClean: ";
        // line 20
        echo (((isset($context["autoCacheClean"]) ? $context["autoCacheClean"] : $this->getContext($context, "autoCacheClean"))) ? ("true") : ("false"));
        echo ",
            profilerTokens: ";
        // line 21
        echo (( !(null === (isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")))) ? (twig_jsonencode_filter((isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")))) : ("null"));
        echo ",
            toggleSimilar: '";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["toggleSimilar"]) ? $context["toggleSimilar"] : $this->getContext($context, "toggleSimilar")), "html", null, true);
        echo "',
            url: {
                list: '";
        // line 24
        echo $this->env->getExtension('routing')->getPath("lexik_translation_list");
        echo "',
                listByToken: '";
        // line 25
        echo $this->env->getExtension('routing')->getPath("lexik_translation_profiler", array("token" => "-token-"));
        echo "',
                update: '";
        // line 26
        echo $this->env->getExtension('routing')->getPath("lexik_translation_update", array("id" => "-id-"));
        echo "',
                invalidateCache: '";
        // line 27
        echo $this->env->getExtension('routing')->getPath("lexik_translation_invalidate_cache");
        echo "'
            },
            label: {
                hideCol: '";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.show_hide_columns"), "html", null, true);
        echo "',
                toggleAllCol: '";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.toggle_all_columns"), "html", null, true);
        echo "',
                invalidateCache: '";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.invalidate_cache"), "html", null, true);
        echo "',
                allTranslations: '";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.all_translations"), "html", null, true);
        echo "',
                profiler: '";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.profiler"), "html", null, true);
        echo "',
                dataSource: '";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.data_source"), "html", null, true);
        echo "',
                latestProfiles: '";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.latest_profiles"), "html", null, true);
        echo "',
                profile: '";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.profile"), "html", null, true);
        echo "',
                saveRow: '";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.save_row"), "html", null, true);
        echo "',
                domain: '";
        // line 39
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.domain"), "html", null, true);
        echo "',
                key: '";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.key"), "html", null, true);
        echo "',
                save: '";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.save"), "html", null, true);
        echo "',
                successMsg: '";
        // line 42
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.succesfully_updated"), "html", null, true);
        echo "',
                errorMsg: '";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.update_failed"), "html", null, true);
        echo "',
                noTranslations: '";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.no_translations"), "html", null, true);
        echo "'
            }
        };
    </script>
    <script src=\"";
        // line 48
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/js/translation.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/translationInHouse/js/lexik.js"), "html", null, true);
        echo "\"></script>

";
        
        $__internal_f95862f16c46cdc0b379a17eecc0ba0e5a6c94a10de53c7085d21e49480da835->leave($__internal_f95862f16c46cdc0b379a17eecc0ba0e5a6c94a10de53c7085d21e49480da835_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/TranslationInHouse:translationInHouse.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  180 => 49,  176 => 48,  169 => 44,  165 => 43,  161 => 42,  157 => 41,  153 => 40,  149 => 39,  145 => 38,  141 => 37,  137 => 36,  133 => 35,  129 => 34,  125 => 33,  121 => 32,  117 => 31,  113 => 30,  107 => 27,  103 => 26,  99 => 25,  95 => 24,  90 => 22,  86 => 21,  82 => 20,  78 => 19,  74 => 18,  67 => 14,  63 => 12,  57 => 11,  45 => 5,  41 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends '@LexikTranslation/Translation/grid.html.twig' %}*/
/* {% block toolbar %}*/
/* */
/* */
/*     {{ parent() }}*/
/*     <label for="toggle-all-columns" class="locale ng-binding">*/
/*         <input type="checkbox" id="toggle-all-columns" ng-model="onlyEmptyValues" checked="checked"> Show only empty values*/
/*     </label>*/
/* {% endblock %}*/
/* */
/* {% block javascript_footer %}*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js"></script>*/
/*     <script src="{{ asset('bundles/lexiktranslation/ng-table/ng-table.min.js') }}"></script>*/
/* */
/*     <script>*/
/*         var translationCfg = {*/
/*             locales: {{ locales | json_encode | raw }},*/
/*             inputType: '{{ inputType }}',*/
/*             autoCacheClean: {{ autoCacheClean ? 'true' : 'false' }},*/
/*             profilerTokens: {{ tokens is not null ? (tokens | json_encode | raw) : 'null' }},*/
/*             toggleSimilar: '{{ toggleSimilar }}',*/
/*             url: {*/
/*                 list: '{{ path('lexik_translation_list') }}',*/
/*                 listByToken: '{{ path('lexik_translation_profiler', {'token': '-token-'}) }}',*/
/*                 update: '{{ path('lexik_translation_update', {'id': '-id-'}) }}',*/
/*                 invalidateCache: '{{ path('lexik_translation_invalidate_cache') }}'*/
/*             },*/
/*             label: {*/
/*                 hideCol: '{{ 'translations.show_hide_columns'|trans }}',*/
/*                 toggleAllCol: '{{ 'translations.toggle_all_columns'|trans }}',*/
/*                 invalidateCache: '{{ 'translations.invalidate_cache'|trans }}',*/
/*                 allTranslations: '{{ 'translations.all_translations'|trans }}',*/
/*                 profiler: '{{ 'translations.profiler'|trans }}',*/
/*                 dataSource: '{{ 'translations.data_source'|trans }}',*/
/*                 latestProfiles: '{{ 'translations.latest_profiles'|trans }}',*/
/*                 profile: '{{ 'translations.profile'|trans }}',*/
/*                 saveRow: '{{ 'translations.save_row'|trans }}',*/
/*                 domain: '{{ 'translations.domain'|trans }}',*/
/*                 key: '{{ 'translations.key'|trans }}',*/
/*                 save: '{{ 'translations.save'|trans }}',*/
/*                 successMsg: '{{ 'translations.succesfully_updated'|trans }}',*/
/*                 errorMsg: '{{ 'translations.update_failed'|trans }}',*/
/*                 noTranslations: '{{ 'translations.no_translations'|trans }}'*/
/*             }*/
/*         };*/
/*     </script>*/
/*     <script src="{{ asset('bundles/lexiktranslation/js/translation.js') }}"></script>*/
/*     <script src="{{ asset('bundles/app/translationInHouse/js/lexik.js') }}"></script>*/
/* */
/* {% endblock %}*/
