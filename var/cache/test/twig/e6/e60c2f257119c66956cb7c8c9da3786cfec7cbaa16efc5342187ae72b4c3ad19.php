<?php

/* SonataCoreBundle:Form:colorpicker.html.twig */
class __TwigTemplate_5763760cbdba52fcc437754bd59ecbdd39134686dab3874bd86f8c0514a18602 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_type_color_selector_widget' => array($this, 'block_sonata_type_color_selector_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4ef93d69a52cbea883eeccc8d540ebb6752d938c1633fe28e5b8e983c8851b5a = $this->env->getExtension("native_profiler");
        $__internal_4ef93d69a52cbea883eeccc8d540ebb6752d938c1633fe28e5b8e983c8851b5a->enter($__internal_4ef93d69a52cbea883eeccc8d540ebb6752d938c1633fe28e5b8e983c8851b5a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataCoreBundle:Form:colorpicker.html.twig"));

        // line 11
        $this->displayBlock('sonata_type_color_selector_widget', $context, $blocks);
        
        $__internal_4ef93d69a52cbea883eeccc8d540ebb6752d938c1633fe28e5b8e983c8851b5a->leave($__internal_4ef93d69a52cbea883eeccc8d540ebb6752d938c1633fe28e5b8e983c8851b5a_prof);

    }

    public function block_sonata_type_color_selector_widget($context, array $blocks = array())
    {
        $__internal_898afb5a6911cbb83763de557e9c80f8551e0e43d4ddaad1d72c50a30bfc1540 = $this->env->getExtension("native_profiler");
        $__internal_898afb5a6911cbb83763de557e9c80f8551e0e43d4ddaad1d72c50a30bfc1540->enter($__internal_898afb5a6911cbb83763de557e9c80f8551e0e43d4ddaad1d72c50a30bfc1540_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_type_color_selector_widget"));

        // line 12
        echo "    ";
        $this->displayBlock("choice_widget", $context, $blocks);
        echo "
    ";
        // line 13
        ob_start();
        // line 14
        echo "        <script type=\"text/javascript\">
            jQuery(function (\$) {
                var select2FormatColorSelect = function format(state) {
                    if (!state.id || state.disabled) {
                        return state.text;
                    }

                    return ' <i class=\"fa fa-square\" style=\"color: '+ state.id +'\"></i> ' + state.text;
                };

                \$('#";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "').select2({
                    formatResult:    select2FormatColorSelect,
                    formatSelection: select2FormatColorSelect,
                    width:           '100%',
                    escapeMarkup:    function(m) { return m; }
                });
            });
        </script>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_898afb5a6911cbb83763de557e9c80f8551e0e43d4ddaad1d72c50a30bfc1540->leave($__internal_898afb5a6911cbb83763de557e9c80f8551e0e43d4ddaad1d72c50a30bfc1540_prof);

    }

    public function getTemplateName()
    {
        return "SonataCoreBundle:Form:colorpicker.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  54 => 24,  42 => 14,  40 => 13,  35 => 12,  23 => 11,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* {% block sonata_type_color_selector_widget %}*/
/*     {{ block('choice_widget') }}*/
/*     {% spaceless %}*/
/*         <script type="text/javascript">*/
/*             jQuery(function ($) {*/
/*                 var select2FormatColorSelect = function format(state) {*/
/*                     if (!state.id || state.disabled) {*/
/*                         return state.text;*/
/*                     }*/
/* */
/*                     return ' <i class="fa fa-square" style="color: '+ state.id +'"></i> ' + state.text;*/
/*                 };*/
/* */
/*                 $('#{{ id }}').select2({*/
/*                     formatResult:    select2FormatColorSelect,*/
/*                     formatSelection: select2FormatColorSelect,*/
/*                     width:           '100%',*/
/*                     escapeMarkup:    function(m) { return m; }*/
/*                 });*/
/*             });*/
/*         </script>*/
/*     {% endspaceless %}*/
/* {% endblock sonata_type_color_selector_widget %}*/
/* */
