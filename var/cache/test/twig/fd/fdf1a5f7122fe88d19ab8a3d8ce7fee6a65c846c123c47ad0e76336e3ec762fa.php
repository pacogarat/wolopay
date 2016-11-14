<?php

/* @LexikTranslation/Translation/grid.html.twig */
class __TwigTemplate_7d0c5df2f917daba02cc359b071e97d25141f350c3fa3584896db7fad12d324d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'toolbar' => array($this, 'block_toolbar'),
            'data_grid' => array($this, 'block_data_grid'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "@LexikTranslation/Translation/grid.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_1e7c0959c52b303053187cc91eb5191595347cf9a042318a0a2d2b3863fd58e7 = $this->env->getExtension("native_profiler");
        $__internal_1e7c0959c52b303053187cc91eb5191595347cf9a042318a0a2d2b3863fd58e7->enter($__internal_1e7c0959c52b303053187cc91eb5191595347cf9a042318a0a2d2b3863fd58e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@LexikTranslation/Translation/grid.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1e7c0959c52b303053187cc91eb5191595347cf9a042318a0a2d2b3863fd58e7->leave($__internal_1e7c0959c52b303053187cc91eb5191595347cf9a042318a0a2d2b3863fd58e7_prof);

    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_f1503cff7d82534313cafda5923ba4e54e1d49a7a2dc59ef91860ec0d97fd2d9 = $this->env->getExtension("native_profiler");
        $__internal_f1503cff7d82534313cafda5923ba4e54e1d49a7a2dc59ef91860ec0d97fd2d9->enter($__internal_f1503cff7d82534313cafda5923ba4e54e1d49a7a2dc59ef91860ec0d97fd2d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/css/translation.css"), "html", null, true);
        echo "\">
";
        
        $__internal_f1503cff7d82534313cafda5923ba4e54e1d49a7a2dc59ef91860ec0d97fd2d9->leave($__internal_f1503cff7d82534313cafda5923ba4e54e1d49a7a2dc59ef91860ec0d97fd2d9_prof);

    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        $__internal_975d180069d6aaaf14132e253913193654c56f4c14cab91ff2b7fae52c1cebb4 = $this->env->getExtension("native_profiler");
        $__internal_975d180069d6aaaf14132e253913193654c56f4c14cab91ff2b7fae52c1cebb4->enter($__internal_975d180069d6aaaf14132e253913193654c56f4c14cab91ff2b7fae52c1cebb4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.page_title", array(), "LexikTranslationBundle"), "html", null, true);
        
        $__internal_975d180069d6aaaf14132e253913193654c56f4c14cab91ff2b7fae52c1cebb4->leave($__internal_975d180069d6aaaf14132e253913193654c56f4c14cab91ff2b7fae52c1cebb4_prof);

    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        $__internal_330657bb0f495ac9739f25375fc3b9335f1385d7b3d521995200ef7bfee703e0 = $this->env->getExtension("native_profiler");
        $__internal_330657bb0f495ac9739f25375fc3b9335f1385d7b3d521995200ef7bfee703e0->enter($__internal_330657bb0f495ac9739f25375fc3b9335f1385d7b3d521995200ef7bfee703e0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 13
        echo "    <div class=\"container\">
        ";
        // line 14
        $this->displayBlock('toolbar', $context, $blocks);
        // line 31
        echo "
        ";
        // line 32
        $this->displayBlock('data_grid', $context, $blocks);
        // line 35
        echo "    </div>
";
        
        $__internal_330657bb0f495ac9739f25375fc3b9335f1385d7b3d521995200ef7bfee703e0->leave($__internal_330657bb0f495ac9739f25375fc3b9335f1385d7b3d521995200ef7bfee703e0_prof);

    }

    // line 14
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_116b2949cdd7af30424f1f63f6aac44fc2c3f25641a89682d9d62b35d0814d04 = $this->env->getExtension("native_profiler");
        $__internal_116b2949cdd7af30424f1f63f6aac44fc2c3f25641a89682d9d62b35d0814d04->enter($__internal_116b2949cdd7af30424f1f63f6aac44fc2c3f25641a89682d9d62b35d0814d04_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 15
        echo "            <div class=\"page-header\">
                <h1>
                    ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.page_title", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                    <div class=\"pull-right\">
                        <a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("lexik_translation_new");
        echo "\" role=\"button\" class=\"btn btn-success\">
                            <span class=\"glyphicon glyphicon-plus\"></span>
                            ";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.new_translation", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                        </a>
                        <a href=\"";
        // line 23
        echo $this->env->getExtension('routing')->getPath("lexik_translation_overview");
        echo "\" role=\"button\" class=\"btn btn-primary\">
                            <span class=\"glyphicon glyphicon-tasks\"></span>
                            ";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.page_title", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                        </a>
                    </div>
                </h1>
            </div>
        ";
        
        $__internal_116b2949cdd7af30424f1f63f6aac44fc2c3f25641a89682d9d62b35d0814d04->leave($__internal_116b2949cdd7af30424f1f63f6aac44fc2c3f25641a89682d9d62b35d0814d04_prof);

    }

    // line 32
    public function block_data_grid($context, array $blocks = array())
    {
        $__internal_fa01ad3cc703c46214b517f001c39a1cd60b035b0e653ab62810eeaf70dcbb03 = $this->env->getExtension("native_profiler");
        $__internal_fa01ad3cc703c46214b517f001c39a1cd60b035b0e653ab62810eeaf70dcbb03->enter($__internal_fa01ad3cc703c46214b517f001c39a1cd60b035b0e653ab62810eeaf70dcbb03_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "data_grid"));

        // line 33
        echo "            ";
        $this->loadTemplate("LexikTranslationBundle:Translation:_ngGrid.html.twig", "@LexikTranslation/Translation/grid.html.twig", 33)->display($context);
        // line 34
        echo "        ";
        
        $__internal_fa01ad3cc703c46214b517f001c39a1cd60b035b0e653ab62810eeaf70dcbb03->leave($__internal_fa01ad3cc703c46214b517f001c39a1cd60b035b0e653ab62810eeaf70dcbb03_prof);

    }

    // line 38
    public function block_javascript_footer($context, array $blocks = array())
    {
        $__internal_7604c1c112fdd5b03a38445ddaa4b80bdaf5ba738a1985da4d066fad4f425a27 = $this->env->getExtension("native_profiler");
        $__internal_7604c1c112fdd5b03a38445ddaa4b80bdaf5ba738a1985da4d066fad4f425a27->enter($__internal_7604c1c112fdd5b03a38445ddaa4b80bdaf5ba738a1985da4d066fad4f425a27_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_footer"));

        // line 39
        echo "    ";
        $this->displayParentBlock("javascript_footer", $context, $blocks);
        echo "
    <script>
        var translationCfg = {
            locales: ";
        // line 42
        echo twig_jsonencode_filter((isset($context["locales"]) ? $context["locales"] : $this->getContext($context, "locales")));
        echo ",
            inputType: '";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["inputType"]) ? $context["inputType"] : $this->getContext($context, "inputType")), "html", null, true);
        echo "',
            rows: ";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["gridListNRows"]) ? $context["gridListNRows"] : $this->getContext($context, "gridListNRows")), "html", null, true);
        echo ",
            autoCacheClean: ";
        // line 45
        echo (((isset($context["autoCacheClean"]) ? $context["autoCacheClean"] : $this->getContext($context, "autoCacheClean"))) ? ("true") : ("false"));
        echo ",
            profilerTokens: ";
        // line 46
        echo (( !(null === (isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")))) ? (twig_jsonencode_filter((isset($context["tokens"]) ? $context["tokens"] : $this->getContext($context, "tokens")))) : ("null"));
        echo ",
            toggleSimilar: '";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["toggleSimilar"]) ? $context["toggleSimilar"] : $this->getContext($context, "toggleSimilar")), "html", null, true);
        echo "',
            domainSearchDefault: '";
        // line 48
        echo twig_escape_filter($this->env, (isset($context["domainSearchDefault"]) ? $context["domainSearchDefault"] : $this->getContext($context, "domainSearchDefault")), "html", null, true);
        echo "',
            keySearchDefault: '";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["keySearchDefault"]) ? $context["keySearchDefault"] : $this->getContext($context, "keySearchDefault")), "html", null, true);
        echo "',
            url: {
                list: '";
        // line 51
        echo $this->env->getExtension('routing')->getPath("lexik_translation_list");
        echo "',
                listByToken: '";
        // line 52
        echo $this->env->getExtension('routing')->getPath("lexik_translation_profiler", array("token" => "-token-"));
        echo "',
                update: '";
        // line 53
        echo $this->env->getExtension('routing')->getPath("lexik_translation_update", array("id" => "-id-"));
        echo "',
                delete: '";
        // line 54
        echo $this->env->getExtension('routing')->getPath("lexik_translation_delete", array("id" => "-id-"));
        echo "',
                deleteLocale: '";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("lexik_translation_delete_locale", array("id" => "-id-", "locale" => "-locale-")), "html", null, true);
        echo "',
                invalidateCache: '";
        // line 56
        echo $this->env->getExtension('routing')->getPath("lexik_translation_invalidate_cache");
        echo "'
            },
            label: {
                hideCol: '";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.show_hide_columns", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                toggleAllCol: '";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.toggle_all_columns", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                invalidateCache: '";
        // line 61
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.invalidate_cache", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                allTranslations: '";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.all_translations", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                profiler: '";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.profiler", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                dataSource: '";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.data_source", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                latestProfiles: '";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.latest_profiles", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                profile: '";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.profile", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                saveRow: '";
        // line 67
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.save_row", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                domain: '";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.domain", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                key: '";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.key", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                save: '";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.save", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                updateSuccess: '";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.successfully_updated", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                updateFail: '";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.update_failed", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                deleteSuccess: '";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.successfully_deleted", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                deleteFail: '";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.delete_failed", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                noTranslations: '";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.no_translations", array(), "LexikTranslationBundle"), "html", null, true);
        echo "',
                showOnlyPendingTranslations: '";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.show_only_pending_translations", array(), "LexikTranslationBundle"), "html", null, true);
        echo "'
            }
        };
    </script>
    <script src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/js/translation.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_7604c1c112fdd5b03a38445ddaa4b80bdaf5ba738a1985da4d066fad4f425a27->leave($__internal_7604c1c112fdd5b03a38445ddaa4b80bdaf5ba738a1985da4d066fad4f425a27_prof);

    }

    public function getTemplateName()
    {
        return "@LexikTranslation/Translation/grid.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  300 => 80,  293 => 76,  289 => 75,  285 => 74,  281 => 73,  277 => 72,  273 => 71,  269 => 70,  265 => 69,  261 => 68,  257 => 67,  253 => 66,  249 => 65,  245 => 64,  241 => 63,  237 => 62,  233 => 61,  229 => 60,  225 => 59,  219 => 56,  215 => 55,  211 => 54,  207 => 53,  203 => 52,  199 => 51,  194 => 49,  190 => 48,  186 => 47,  182 => 46,  178 => 45,  174 => 44,  170 => 43,  166 => 42,  159 => 39,  153 => 38,  146 => 34,  143 => 33,  137 => 32,  124 => 25,  119 => 23,  114 => 21,  109 => 19,  104 => 17,  100 => 15,  94 => 14,  86 => 35,  84 => 32,  81 => 31,  79 => 14,  76 => 13,  70 => 12,  58 => 10,  49 => 7,  44 => 6,  38 => 5,  23 => 1,);
    }
}
/* {% extends layout %}*/
/* */
/* {% trans_default_domain 'LexikTranslationBundle' %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/*     <link rel="stylesheet" href="{{ asset('bundles/lexiktranslation/css/translation.css') }}">*/
/* {% endblock %}*/
/* */
/* {% block title %}{{ 'translations.page_title'|trans({}, 'LexikTranslationBundle') }}{% endblock %}*/
/* */
/* {% block content %}*/
/*     <div class="container">*/
/*         {% block toolbar %}*/
/*             <div class="page-header">*/
/*                 <h1>*/
/*                     {{ 'translations.page_title'|trans({}, 'LexikTranslationBundle') }}*/
/*                     <div class="pull-right">*/
/*                         <a href="{{ path('lexik_translation_new') }}" role="button" class="btn btn-success">*/
/*                             <span class="glyphicon glyphicon-plus"></span>*/
/*                             {{ 'translations.new_translation'|trans({}, 'LexikTranslationBundle') }}*/
/*                         </a>*/
/*                         <a href="{{ path('lexik_translation_overview') }}" role="button" class="btn btn-primary">*/
/*                             <span class="glyphicon glyphicon-tasks"></span>*/
/*                             {{ 'overview.page_title'|trans({}, 'LexikTranslationBundle') }}*/
/*                         </a>*/
/*                     </div>*/
/*                 </h1>*/
/*             </div>*/
/*         {% endblock toolbar %}*/
/* */
/*         {% block data_grid %}*/
/*             {% include 'LexikTranslationBundle:Translation:_ngGrid.html.twig' %}*/
/*         {% endblock data_grid %}*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block javascript_footer %}*/
/*     {{ parent() }}*/
/*     <script>*/
/*         var translationCfg = {*/
/*             locales: {{ locales | json_encode | raw }},*/
/*             inputType: '{{ inputType }}',*/
/*             rows: {{gridListNRows}},*/
/*             autoCacheClean: {{ autoCacheClean ? 'true' : 'false' }},*/
/*             profilerTokens: {{ tokens is not null ? (tokens | json_encode | raw) : 'null' }},*/
/*             toggleSimilar: '{{ toggleSimilar }}',*/
/*             domainSearchDefault: '{{ domainSearchDefault }}',*/
/*             keySearchDefault: '{{ keySearchDefault }}',*/
/*             url: {*/
/*                 list: '{{ path('lexik_translation_list') }}',*/
/*                 listByToken: '{{ path('lexik_translation_profiler', {'token': '-token-'}) }}',*/
/*                 update: '{{ path('lexik_translation_update', {'id': '-id-'}) }}',*/
/*                 delete: '{{ path('lexik_translation_delete', {'id': '-id-'}) }}',*/
/*                 deleteLocale: '{{ path('lexik_translation_delete_locale', {'id': '-id-', 'locale': '-locale-'}) }}',*/
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
/*                 updateSuccess: '{{ 'translations.successfully_updated'|trans }}',*/
/*                 updateFail: '{{ 'translations.update_failed'|trans }}',*/
/*                 deleteSuccess: '{{ 'translations.successfully_deleted'|trans }}',*/
/*                 deleteFail: '{{ 'translations.delete_failed'|trans }}',*/
/*                 noTranslations: '{{ 'translations.no_translations'|trans }}',*/
/*                 showOnlyPendingTranslations: '{{ 'translations.show_only_pending_translations'|trans }}'*/
/*             }*/
/*         };*/
/*     </script>*/
/*     <script src="{{ asset('bundles/lexiktranslation/js/translation.js') }}"></script>*/
/* {% endblock %}*/
/* */
