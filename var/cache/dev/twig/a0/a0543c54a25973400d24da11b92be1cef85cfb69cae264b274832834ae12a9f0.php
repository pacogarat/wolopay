<?php

/* GuzzleBundle::debug.html.twig */
class __TwigTemplate_ffb633ab1a3a0d6388fb2b85d17b927080852df1c69f8be7f623ad516acaa1da extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig", "GuzzleBundle::debug.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'head' => array($this, 'block_head'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2a39d8cb21db9260b767ebb8cc42d70b795200c8ddcb66586d929d21f84a9c2f = $this->env->getExtension("native_profiler");
        $__internal_2a39d8cb21db9260b767ebb8cc42d70b795200c8ddcb66586d929d21f84a9c2f->enter($__internal_2a39d8cb21db9260b767ebb8cc42d70b795200c8ddcb66586d929d21f84a9c2f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GuzzleBundle::debug.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2a39d8cb21db9260b767ebb8cc42d70b795200c8ddcb66586d929d21f84a9c2f->leave($__internal_2a39d8cb21db9260b767ebb8cc42d70b795200c8ddcb66586d929d21f84a9c2f_prof);

    }

    // line 4
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_cd6677284027c888d290de4123c52c98b0a192f1cfd8b96f68809a7ac6e308e7 = $this->env->getExtension("native_profiler");
        $__internal_cd6677284027c888d290de4123c52c98b0a192f1cfd8b96f68809a7ac6e308e7->enter($__internal_cd6677284027c888d290de4123c52c98b0a192f1cfd8b96f68809a7ac6e308e7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        // line 5
        echo "
    ";
        // line 6
        if (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "callCount", array()) == 0)) {
            // line 7
            echo "        ";
            $context["color"] = "grey";
            // line 8
            echo "    ";
        } elseif (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "errorCount", array()) > 0)) {
            // line 9
            echo "        ";
            $context["color"] = "red";
            // line 10
            echo "    ";
        } else {
            // line 11
            echo "        ";
            $context["color"] = "green";
            // line 12
            echo "    ";
        }
        // line 13
        echo "
    ";
        // line 14
        ob_start();
        // line 15
        echo "        <img width=\"18\"
             height=\"28\"
             alt=\"Guzzle\"
             src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAcCAYAAABsxO8nAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9wJFA0kAmx9x5QAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAsRJREFUOMvdlL1vXUUQxc+ZXV/HJCSiQRRBdOHDEYVrR5Gf3vWHrMjPtHTQ5m9IRQtI/AE0NDS2sYSc5+cPCSwUKVKE5BRBKD1ShEgsEM593pmh2Wvte3kE6kxz9652f3PmzNwLvLLBdrGwsPAGyTkRaQAYACVZkUyDweDe/wJ1Op2eiGzFGEESIQSYGcwMAODup7u7u6/9J6jb7T6cmpq6XlXVdRG5TDK6u6rqM1X9xszmRGQ2pfRrVVX3qqr6dGNj4/gF0PLy8o/T09M3tre3OZ5pbW1tXVU3U0pz/X7/59XVVQ8hIMb44ebm5sP2nAAAyQsvUf02SZAc5vebqorhcHjc6/XeHQEBeK6qk2sn/zAzkEzZr5OU0klKCSml+yOglNJTd58IOjs7g6rC3U8BwMwigGMz+0VVL7fnIgCo6pOmabCysrKVWz/j7n8COBsOhx+TRIzxBAD6/f6DxcXF70h+nlLCOOiZmUFVeyTbks7bH2PEzs7OSXtpMBh80e12ZwB8NgIys6chBLg7Wq/cHdlkmBnquva8t7W3t/eRiNwv7Yj5kpsZRKQ0Ga26lBJIfk/yfQDrnU6n0zTNkxDCKKj8VEqYmSGEgJQSjo6ObuWv4CcAKyQPyk7HfPnvdqOUKyJQ1XNluYtBRC4AuFruS87srbHt8yXxG8lHAJpSfbu6KCIY96lVV8JJXnL3d0IId0miruvZc5CI/KuMcXgI4UqM8drh4eHvuaOzZWnPW0/GSyshOU4BXCwUflAq4qTs7g4RGW9AjDFWWd0PJN8rPZqZVJaIjMxTvvy6u7fz97W7r5dzdGmSNyGEF0DufiWEMJ3XjbtXpaLZcqJLv8wMMUbUdf1mVnQHwLW6rp3ktyLy6Hyi5+fnr4rIbRF5bGZ/5Z+YAJgRkbdCCGl/f//LNtnS0tJNVf3E3R8cHBx8hVc7/gEz5WHvMjpIQQAAAABJRU5ErkJggg==\"/>
        <span class=\"sf-toolbar-status sf-toolbar-status-";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["color"]) ? $context["color"] : $this->getContext($context, "color")), "html", null, true);
        echo "\">
            ";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "callCount", array()), "html", null, true);
        echo "
        </span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 23
        echo "
    ";
        // line 24
        ob_start();
        // line 25
        echo "
        <div class=\"sf-toolbar-info-piece\">
            <b>API Calls</b>
            <span>";
        // line 28
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "callCount", array()), "html", null, true);
        echo "</span>
        </div>

        <div class=\"sf-toolbar-info-piece\">
            <b>Total time</b>
            ";
        // line 33
        if (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "totalTime", array()) > 1)) {
            // line 34
            echo "                <span>";
            echo twig_escape_filter($this->env, sprintf("%0.2f", $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "totalTime", array())), "html", null, true);
            echo " s</span>
            ";
        } else {
            // line 36
            echo "                <span>";
            echo twig_escape_filter($this->env, sprintf("%0.0f", ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "totalTime", array()) * 1000)), "html", null, true);
            echo " ms</span>
            ";
        }
        // line 38
        echo "        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 40
        echo "
    ";
        // line 41
        $this->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig", "GuzzleBundle::debug.html.twig", 41)->display(array_merge($context, array("link" => (isset($context["profiler_url"]) ? $context["profiler_url"] : $this->getContext($context, "profiler_url")))));
        
        $__internal_cd6677284027c888d290de4123c52c98b0a192f1cfd8b96f68809a7ac6e308e7->leave($__internal_cd6677284027c888d290de4123c52c98b0a192f1cfd8b96f68809a7ac6e308e7_prof);

    }

    // line 45
    public function block_menu($context, array $blocks = array())
    {
        $__internal_d4e097367faba435fdd2fceebeefc3fefe8b2573c43c5c598ec0efb0bfb0c757 = $this->env->getExtension("native_profiler");
        $__internal_d4e097367faba435fdd2fceebeefc3fefe8b2573c43c5c598ec0efb0bfb0c757->enter($__internal_d4e097367faba435fdd2fceebeefc3fefe8b2573c43c5c598ec0efb0bfb0c757_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 46
        echo "
    <span class=\"label\">
        <span class=\"icon\">
            <img src=\"data:image/png;base64,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\"
                 alt=\"\"/>
        </span>
        <strong>Guzzle</strong>
        <span class=\"count\">
            <span>";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "callCount", array()), "html", null, true);
        echo "</span>
        </span>
    </span>
";
        
        $__internal_d4e097367faba435fdd2fceebeefc3fefe8b2573c43c5c598ec0efb0bfb0c757->leave($__internal_d4e097367faba435fdd2fceebeefc3fefe8b2573c43c5c598ec0efb0bfb0c757_prof);

    }

    // line 60
    public function block_head($context, array $blocks = array())
    {
        $__internal_67ce5095f81c80ecea1bba08491f0799f8a8367bfabb40bb6484b88d8b546d98 = $this->env->getExtension("native_profiler");
        $__internal_67ce5095f81c80ecea1bba08491f0799f8a8367bfabb40bb6484b88d8b546d98->enter($__internal_67ce5095f81c80ecea1bba08491f0799f8a8367bfabb40bb6484b88d8b546d98_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 61
        echo "
    ";
        // line 62
        $this->displayParentBlock("head", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/guzzle/css/main.css"), "html", null, true);
        echo "\" />
    <script src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/guzzle/js/jquery.min.js"), "html", null, true);
        echo "\"></script>
";
        
        $__internal_67ce5095f81c80ecea1bba08491f0799f8a8367bfabb40bb6484b88d8b546d98->leave($__internal_67ce5095f81c80ecea1bba08491f0799f8a8367bfabb40bb6484b88d8b546d98_prof);

    }

    // line 68
    public function block_panel($context, array $blocks = array())
    {
        $__internal_8cdf4a2bb686890d717c87fb15a38cc1b541f02ec22570343fb7cc755245354a = $this->env->getExtension("native_profiler");
        $__internal_8cdf4a2bb686890d717c87fb15a38cc1b541f02ec22570343fb7cc755245354a->enter($__internal_8cdf4a2bb686890d717c87fb15a38cc1b541f02ec22570343fb7cc755245354a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 69
        echo "
    <h2>Logs</h2>

    ";
        // line 72
        $this->loadTemplate("GuzzleBundle::profiler.html.twig", "GuzzleBundle::debug.html.twig", 72)->display(array_merge($context, array("collector" => (isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")))));
        
        $__internal_8cdf4a2bb686890d717c87fb15a38cc1b541f02ec22570343fb7cc755245354a->leave($__internal_8cdf4a2bb686890d717c87fb15a38cc1b541f02ec22570343fb7cc755245354a_prof);

    }

    public function getTemplateName()
    {
        return "GuzzleBundle::debug.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 72,  193 => 69,  187 => 68,  178 => 65,  174 => 64,  169 => 62,  166 => 61,  160 => 60,  149 => 54,  139 => 46,  133 => 45,  126 => 41,  123 => 40,  119 => 38,  113 => 36,  107 => 34,  105 => 33,  97 => 28,  92 => 25,  90 => 24,  87 => 23,  81 => 20,  77 => 19,  71 => 15,  69 => 14,  66 => 13,  63 => 12,  60 => 11,  57 => 10,  54 => 9,  51 => 8,  48 => 7,  46 => 6,  43 => 5,  37 => 4,  11 => 1,);
    }
}
/* {% extends "WebProfilerBundle:Profiler:layout.html.twig" %}*/
/* */
/* */
/* {% block toolbar %}*/
/* */
/*     {% if collector.callCount == 0 %}*/
/*         {% set color = 'grey' %}*/
/*     {% elseif collector.errorCount > 0 %}*/
/*         {% set color = 'red' %}*/
/*     {% else %}*/
/*         {% set color = 'green' %}*/
/*     {% endif %}*/
/* */
/*     {% set icon %}*/
/*         <img width="18"*/
/*              height="28"*/
/*              alt="Guzzle"*/
/*              src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAAcCAYAAABsxO8nAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAOxAAADsQBlSsOGwAAAAd0SU1FB9wJFA0kAmx9x5QAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAsRJREFUOMvdlL1vXUUQxc+ZXV/HJCSiQRRBdOHDEYVrR5Gf3vWHrMjPtHTQ5m9IRQtI/AE0NDS2sYSc5+cPCSwUKVKE5BRBKD1ShEgsEM593pmh2Wvte3kE6kxz9652f3PmzNwLvLLBdrGwsPAGyTkRaQAYACVZkUyDweDe/wJ1Op2eiGzFGEESIQSYGcwMAODup7u7u6/9J6jb7T6cmpq6XlXVdRG5TDK6u6rqM1X9xszmRGQ2pfRrVVX3qqr6dGNj4/gF0PLy8o/T09M3tre3OZ5pbW1tXVU3U0pz/X7/59XVVQ8hIMb44ebm5sP2nAAAyQsvUf02SZAc5vebqorhcHjc6/XeHQEBeK6qk2sn/zAzkEzZr5OU0klKCSml+yOglNJTd58IOjs7g6rC3U8BwMwigGMz+0VVL7fnIgCo6pOmabCysrKVWz/j7n8COBsOhx+TRIzxBAD6/f6DxcXF70h+nlLCOOiZmUFVeyTbks7bH2PEzs7OSXtpMBh80e12ZwB8NgIys6chBLg7Wq/cHdlkmBnquva8t7W3t/eRiNwv7Yj5kpsZRKQ0Ga26lBJIfk/yfQDrnU6n0zTNkxDCKKj8VEqYmSGEgJQSjo6ObuWv4CcAKyQPyk7HfPnvdqOUKyJQ1XNluYtBRC4AuFruS87srbHt8yXxG8lHAJpSfbu6KCIY96lVV8JJXnL3d0IId0miruvZc5CI/KuMcXgI4UqM8drh4eHvuaOzZWnPW0/GSyshOU4BXCwUflAq4qTs7g4RGW9AjDFWWd0PJN8rPZqZVJaIjMxTvvy6u7fz97W7r5dzdGmSNyGEF0DufiWEMJ3XjbtXpaLZcqJLv8wMMUbUdf1mVnQHwLW6rp3ktyLy6Hyi5+fnr4rIbRF5bGZ/5Z+YAJgRkbdCCGl/f//LNtnS0tJNVf3E3R8cHBx8hVc7/gEz5WHvMjpIQQAAAABJRU5ErkJggg=="/>*/
/*         <span class="sf-toolbar-status sf-toolbar-status-{{ color }}">*/
/*             {{ collector.callCount }}*/
/*         </span>*/
/*     {% endset %}*/
/* */
/*     {% set text %}*/
/* */
/*         <div class="sf-toolbar-info-piece">*/
/*             <b>API Calls</b>*/
/*             <span>{{ collector.callCount }}</span>*/
/*         </div>*/
/* */
/*         <div class="sf-toolbar-info-piece">*/
/*             <b>Total time</b>*/
/*             {% if collector.totalTime > 1.0 %}*/
/*                 <span>{{ '%0.2f'|format(collector.totalTime) }} s</span>*/
/*             {% else %}*/
/*                 <span>{{ '%0.0f'|format(collector.totalTime * 1000) }} ms</span>*/
/*             {% endif %}*/
/*         </div>*/
/*     {% endset %}*/
/* */
/*     {% include "WebProfilerBundle:Profiler:toolbar_item.html.twig" with { "link": profiler_url } %}*/
/* {% endblock %}*/
/* */
/* */
/* {% block menu %}*/
/* */
/*     <span class="label">*/
/*         <span class="icon">*/
/*             <img src="data:image/png;base64,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"*/
/*                  alt=""/>*/
/*         </span>*/
/*         <strong>Guzzle</strong>*/
/*         <span class="count">*/
/*             <span>{{ collector.callCount }}</span>*/
/*         </span>*/
/*     </span>*/
/* {% endblock %}*/
/* */
/* */
/* {% block head %}*/
/* */
/*     {{ parent() }}*/
/* */
/*     <link rel="stylesheet" href="{{ asset('bundles/guzzle/css/main.css') }}" />*/
/*     <script src="{{ asset('bundles/guzzle/js/jquery.min.js') }}"></script>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/* */
/*     <h2>Logs</h2>*/
/* */
/*     {% include 'GuzzleBundle::profiler.html.twig' with { 'collector': collector } %}*/
/* {% endblock %}*/
/* */
