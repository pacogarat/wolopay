<?php

/* LexikTranslationBundle:Translation:overview.html.twig */
class __TwigTemplate_f48b75aafe53e06767e95b1cac774f269b1b0133bac348b2f86618b944863c46 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'toolbar' => array($this, 'block_toolbar'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "LexikTranslationBundle:Translation:overview.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cbd6847400e383004e46e36ea71b5c67e0411455749424583ed6b4d1a7a376d5 = $this->env->getExtension("native_profiler");
        $__internal_cbd6847400e383004e46e36ea71b5c67e0411455749424583ed6b4d1a7a376d5->enter($__internal_cbd6847400e383004e46e36ea71b5c67e0411455749424583ed6b4d1a7a376d5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "LexikTranslationBundle:Translation:overview.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cbd6847400e383004e46e36ea71b5c67e0411455749424583ed6b4d1a7a376d5->leave($__internal_cbd6847400e383004e46e36ea71b5c67e0411455749424583ed6b4d1a7a376d5_prof);

    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_37af29684915b22e93279cd127ccb0494ab1b18dd310573e6ed6e76cc77ac71f = $this->env->getExtension("native_profiler");
        $__internal_37af29684915b22e93279cd127ccb0494ab1b18dd310573e6ed6e76cc77ac71f->enter($__internal_37af29684915b22e93279cd127ccb0494ab1b18dd310573e6ed6e76cc77ac71f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/css/translation.css"), "html", null, true);
        echo "\">
";
        
        $__internal_37af29684915b22e93279cd127ccb0494ab1b18dd310573e6ed6e76cc77ac71f->leave($__internal_37af29684915b22e93279cd127ccb0494ab1b18dd310573e6ed6e76cc77ac71f_prof);

    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        $__internal_242e0e0e4fb30431f0d35cd5c9c4f147870d22eb64b54760314d8dc3940b4998 = $this->env->getExtension("native_profiler");
        $__internal_242e0e0e4fb30431f0d35cd5c9c4f147870d22eb64b54760314d8dc3940b4998->enter($__internal_242e0e0e4fb30431f0d35cd5c9c4f147870d22eb64b54760314d8dc3940b4998_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.page_title", array(), "LexikTranslationBundle"), "html", null, true);
        
        $__internal_242e0e0e4fb30431f0d35cd5c9c4f147870d22eb64b54760314d8dc3940b4998->leave($__internal_242e0e0e4fb30431f0d35cd5c9c4f147870d22eb64b54760314d8dc3940b4998_prof);

    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        $__internal_ada9085fa4833219726aa00db816e2141bbdf9de196bcf3db97540b2a91b3598 = $this->env->getExtension("native_profiler");
        $__internal_ada9085fa4833219726aa00db816e2141bbdf9de196bcf3db97540b2a91b3598->enter($__internal_ada9085fa4833219726aa00db816e2141bbdf9de196bcf3db97540b2a91b3598_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 13
        echo "    <div class=\"container\">
        ";
        // line 14
        $this->displayBlock('toolbar', $context, $blocks);
        // line 27
        echo "
        <p>";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.msg_latest_translation", array("%date%" => twig_date_format_filter($this->env, (isset($context["latestTrans"]) ? $context["latestTrans"] : $this->getContext($context, "latestTrans")), "Y-m-d H:i")), "LexikTranslationBundle"), "html", null, true);
        echo "</p>

        <div id=\"translation-overview\">
            <div class=\"row margin-row\">
                <div class=\"col-md-12\">
                    ";
        // line 33
        if ( !twig_length_filter($this->env, (isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")))) {
            // line 34
            echo "                        <div class=\"alert alert-info\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.no_stats", array(), "LexikTranslationBundle"), "html", null, true);
            echo "</div>
                    ";
        } else {
            // line 36
            echo "                        <table class=\"table table-bordered table-striped table-overview\">
                            <thead>
                                <tr>
                                    <th class=\"sortable col-0\">
                                        ";
            // line 40
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.domain", array(), "LexikTranslationBundle"), "html", null, true);
            echo "
                                    </th>
                                    ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["locales"]) ? $context["locales"] : $this->getContext($context, "locales")));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["locale"]) {
                // line 43
                echo "                                        <th class=\"sortable col-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                echo "\">
                                            ";
                // line 44
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, $context["locale"]), "html", null, true);
                echo "
                                        </th>
                                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['locale'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 47
            echo "                                </tr>
                            </thead>
                            <tbody>
                            ";
            // line 50
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["domains"]) ? $context["domains"] : $this->getContext($context, "domains")));
            foreach ($context['_seq'] as $context["_key"] => $context["domain"]) {
                // line 51
                echo "                                <tr columns=\"columns\">
                                    <td>";
                // line 52
                echo twig_escape_filter($this->env, $context["domain"], "html", null, true);
                echo "</td>
                                    ";
                // line 53
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["locales"]) ? $context["locales"] : $this->getContext($context, "locales")));
                foreach ($context['_seq'] as $context["_key"] => $context["locale"]) {
                    // line 54
                    echo "                                        <td class=\"text-center\">
                                            <span class=\"text ";
                    // line 55
                    echo ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")), $context["domain"], array(), "array"), $context["locale"], array(), "array"), "completed", array(), "array") == 100)) ? ("text-success") : ("text-danger"));
                    echo "\">
                                                ";
                    // line 56
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")), $context["domain"], array(), "array"), $context["locale"], array(), "array"), "translated", array(), "array"), "html", null, true);
                    echo " / ";
                    echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : null), $context["domain"], array(), "array", false, true), $context["locale"], array(), "array", false, true), "keys", array(), "array", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : null), $context["domain"], array(), "array", false, true), $context["locale"], array(), "array", false, true), "keys", array(), "array"), 0)) : (0)), "html", null, true);
                    echo "
                                            </span>
                                            <div class=\"progress\">
                                                <div class=\"progress-bar ";
                    // line 59
                    echo ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")), $context["domain"], array(), "array"), $context["locale"], array(), "array"), "completed", array(), "array") == 100)) ? ("progress-bar-success") : ("progress-bar-danger"));
                    echo "\"
                                                     role=\"progressbar\"
                                                     aria-valuenow=\"";
                    // line 61
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")), $context["domain"], array(), "array"), $context["locale"], array(), "array"), "completed", array(), "array"), "html", null, true);
                    echo "\"
                                                     aria-valuemin=\"0\"
                                                     aria-valuemax=\"100\"
                                                     style=\"width: ";
                    // line 64
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["stats"]) ? $context["stats"] : $this->getContext($context, "stats")), $context["domain"], array(), "array"), $context["locale"], array(), "array"), "completed", array(), "array"), "html", null, true);
                    echo "%\">
                                                </div>
                                            </div>
                                        </td>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['locale'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 69
                echo "                                </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['domain'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 71
            echo "                            </tbody>
                        </table>
                    ";
        }
        // line 74
        echo "                </div>
            </div>
        </div>

    </div>
";
        
        $__internal_ada9085fa4833219726aa00db816e2141bbdf9de196bcf3db97540b2a91b3598->leave($__internal_ada9085fa4833219726aa00db816e2141bbdf9de196bcf3db97540b2a91b3598_prof);

    }

    // line 14
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_762d3b09f674b4198460e548ba316c8eb2068bca1421bb0cb38cf6a85efcd271 = $this->env->getExtension("native_profiler");
        $__internal_762d3b09f674b4198460e548ba316c8eb2068bca1421bb0cb38cf6a85efcd271->enter($__internal_762d3b09f674b4198460e548ba316c8eb2068bca1421bb0cb38cf6a85efcd271_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 15
        echo "            <div class=\"page-header\">
                <h1>
                    ";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.page_title", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                    <div class=\"pull-right\">
                        <a href=\"";
        // line 19
        echo $this->env->getExtension('routing')->getPath("lexik_translation_grid");
        echo "\" role=\"button\" class=\"btn btn-primary\">
                            <span class=\"glyphicon glyphicon-th\"></span>
                            ";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("overview.show_grid", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                        </a>
                    </div>
                </h1>
            </div>
        ";
        
        $__internal_762d3b09f674b4198460e548ba316c8eb2068bca1421bb0cb38cf6a85efcd271->leave($__internal_762d3b09f674b4198460e548ba316c8eb2068bca1421bb0cb38cf6a85efcd271_prof);

    }

    // line 81
    public function block_javascript_footer($context, array $blocks = array())
    {
        $__internal_22988fe1f72382010d09416ce922adf92b2cc06120ac2cc244950d8cf708db0d = $this->env->getExtension("native_profiler");
        $__internal_22988fe1f72382010d09416ce922adf92b2cc06120ac2cc244950d8cf708db0d->enter($__internal_22988fe1f72382010d09416ce922adf92b2cc06120ac2cc244950d8cf708db0d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_footer"));

        // line 82
        echo "    ";
        $this->displayParentBlock("javascript_footer", $context, $blocks);
        echo "
    <script src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/js/translation.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_22988fe1f72382010d09416ce922adf92b2cc06120ac2cc244950d8cf708db0d->leave($__internal_22988fe1f72382010d09416ce922adf92b2cc06120ac2cc244950d8cf708db0d_prof);

    }

    public function getTemplateName()
    {
        return "LexikTranslationBundle:Translation:overview.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  274 => 83,  269 => 82,  263 => 81,  250 => 21,  245 => 19,  240 => 17,  236 => 15,  230 => 14,  218 => 74,  213 => 71,  206 => 69,  195 => 64,  189 => 61,  184 => 59,  176 => 56,  172 => 55,  169 => 54,  165 => 53,  161 => 52,  158 => 51,  154 => 50,  149 => 47,  132 => 44,  127 => 43,  110 => 42,  105 => 40,  99 => 36,  93 => 34,  91 => 33,  83 => 28,  80 => 27,  78 => 14,  75 => 13,  69 => 12,  57 => 10,  48 => 7,  43 => 6,  37 => 5,  22 => 1,);
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
/* {% block title %}{{ 'overview.page_title'|trans }}{% endblock %}*/
/* */
/* {% block content %}*/
/*     <div class="container">*/
/*         {% block toolbar %}*/
/*             <div class="page-header">*/
/*                 <h1>*/
/*                     {{ 'overview.page_title'|trans }}*/
/*                     <div class="pull-right">*/
/*                         <a href="{{ path('lexik_translation_grid') }}" role="button" class="btn btn-primary">*/
/*                             <span class="glyphicon glyphicon-th"></span>*/
/*                             {{ 'overview.show_grid'|trans }}*/
/*                         </a>*/
/*                     </div>*/
/*                 </h1>*/
/*             </div>*/
/*         {% endblock toolbar %}*/
/* */
/*         <p>{{ 'overview.msg_latest_translation'|trans({'%date%': latestTrans|date('Y-m-d H:i')}) }}</p>*/
/* */
/*         <div id="translation-overview">*/
/*             <div class="row margin-row">*/
/*                 <div class="col-md-12">*/
/*                     {% if  not stats|length %}*/
/*                         <div class="alert alert-info">{{ 'overview.no_stats'|trans }}</div>*/
/*                     {% else %}*/
/*                         <table class="table table-bordered table-striped table-overview">*/
/*                             <thead>*/
/*                                 <tr>*/
/*                                     <th class="sortable col-0">*/
/*                                         {{ 'overview.domain'|trans }}*/
/*                                     </th>*/
/*                                     {% for locale in locales %}*/
/*                                         <th class="sortable col-{{ loop.index }}">*/
/*                                             {{ locale|upper }}*/
/*                                         </th>*/
/*                                     {% endfor %}*/
/*                                 </tr>*/
/*                             </thead>*/
/*                             <tbody>*/
/*                             {% for domain in domains %}*/
/*                                 <tr columns="columns">*/
/*                                     <td>{{ domain }}</td>*/
/*                                     {% for locale in locales %}*/
/*                                         <td class="text-center">*/
/*                                             <span class="text {{ stats[domain][locale]['completed'] == 100 ? 'text-success' : 'text-danger' }}">*/
/*                                                 {{ stats[domain][locale]['translated'] }} / {{ stats[domain][locale]['keys']|default(0) }}*/
/*                                             </span>*/
/*                                             <div class="progress">*/
/*                                                 <div class="progress-bar {{ stats[domain][locale]['completed'] == 100 ? 'progress-bar-success' : 'progress-bar-danger' }}"*/
/*                                                      role="progressbar"*/
/*                                                      aria-valuenow="{{ stats[domain][locale]['completed'] }}"*/
/*                                                      aria-valuemin="0"*/
/*                                                      aria-valuemax="100"*/
/*                                                      style="width: {{ stats[domain][locale]['completed'] }}%">*/
/*                                                 </div>*/
/*                                             </div>*/
/*                                         </td>*/
/*                                     {% endfor %}*/
/*                                 </tr>*/
/*                             {% endfor %}*/
/*                             </tbody>*/
/*                         </table>*/
/*                     {% endif %}*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/* */
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block javascript_footer %}*/
/*     {{ parent() }}*/
/*     <script src="{{ asset('bundles/lexiktranslation/js/translation.js') }}"></script>*/
/* {% endblock %}*/
/* */
