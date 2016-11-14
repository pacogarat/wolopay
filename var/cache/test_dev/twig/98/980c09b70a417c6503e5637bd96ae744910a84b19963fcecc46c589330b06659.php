<?php

/* SonataCoreBundle:Form:datepicker.html.twig */
class __TwigTemplate_9524edca61d48785cb1ee5d8236eb197f09e783649ca52b9dc3d83b99e595f73 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_type_date_picker_widget_html' => array($this, 'block_sonata_type_date_picker_widget_html'),
            'sonata_type_date_picker_widget' => array($this, 'block_sonata_type_date_picker_widget'),
            'sonata_type_datetime_picker_widget_html' => array($this, 'block_sonata_type_datetime_picker_widget_html'),
            'sonata_type_datetime_picker_widget' => array($this, 'block_sonata_type_datetime_picker_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2981d3dc49cf97f469f38a487f28770e7b269a31a5be3b38d2ea775dbb3e8d73 = $this->env->getExtension("native_profiler");
        $__internal_2981d3dc49cf97f469f38a487f28770e7b269a31a5be3b38d2ea775dbb3e8d73->enter($__internal_2981d3dc49cf97f469f38a487f28770e7b269a31a5be3b38d2ea775dbb3e8d73_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataCoreBundle:Form:datepicker.html.twig"));

        // line 11
        $this->displayBlock('sonata_type_date_picker_widget_html', $context, $blocks);
        // line 22
        echo "
";
        // line 23
        $this->displayBlock('sonata_type_date_picker_widget', $context, $blocks);
        // line 39
        echo "
";
        // line 40
        $this->displayBlock('sonata_type_datetime_picker_widget_html', $context, $blocks);
        // line 51
        echo "
";
        // line 52
        $this->displayBlock('sonata_type_datetime_picker_widget', $context, $blocks);
        
        $__internal_2981d3dc49cf97f469f38a487f28770e7b269a31a5be3b38d2ea775dbb3e8d73->leave($__internal_2981d3dc49cf97f469f38a487f28770e7b269a31a5be3b38d2ea775dbb3e8d73_prof);

    }

    // line 11
    public function block_sonata_type_date_picker_widget_html($context, array $blocks = array())
    {
        $__internal_5a3c09cb73b75c8223da3604767ec2ab690781f86f6219bec090ae489f6bb55a = $this->env->getExtension("native_profiler");
        $__internal_5a3c09cb73b75c8223da3604767ec2ab690781f86f6219bec090ae489f6bb55a->enter($__internal_5a3c09cb73b75c8223da3604767ec2ab690781f86f6219bec090ae489f6bb55a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_type_date_picker_widget_html"));

        // line 12
        echo "    ";
        if ((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) {
            // line 13
            echo "        <div class='input-group date' id='dp_";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "'>
    ";
        }
        // line 15
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("data-date-format" => (isset($context["moment_format"]) ? $context["moment_format"] : $this->getContext($context, "moment_format"))));
        // line 16
        echo "    ";
        $this->displayBlock("date_widget", $context, $blocks);
        echo "
    ";
        // line 17
        if ((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) {
            // line 18
            echo "            <span class=\"input-group-addon\"><span class=\"fa fa-calendar\"></span></span>
        </div>
    ";
        }
        
        $__internal_5a3c09cb73b75c8223da3604767ec2ab690781f86f6219bec090ae489f6bb55a->leave($__internal_5a3c09cb73b75c8223da3604767ec2ab690781f86f6219bec090ae489f6bb55a_prof);

    }

    // line 23
    public function block_sonata_type_date_picker_widget($context, array $blocks = array())
    {
        $__internal_1dea2ef516ed45a9f2e1b4ef2bb37b1b2aa187e35c7b09183f032b10cf0d6003 = $this->env->getExtension("native_profiler");
        $__internal_1dea2ef516ed45a9f2e1b4ef2bb37b1b2aa187e35c7b09183f032b10cf0d6003->enter($__internal_1dea2ef516ed45a9f2e1b4ef2bb37b1b2aa187e35c7b09183f032b10cf0d6003_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_type_date_picker_widget"));

        // line 24
        echo "    ";
        ob_start();
        // line 25
        echo "        ";
        if ((isset($context["wrap_fields_with_addons"]) ? $context["wrap_fields_with_addons"] : $this->getContext($context, "wrap_fields_with_addons"))) {
            // line 26
            echo "            <div class=\"input-group\">
                ";
            // line 27
            $this->displayBlock("sonata_type_date_picker_widget_html", $context, $blocks);
            echo "
            </div>
        ";
        } else {
            // line 30
            echo "            ";
            $this->displayBlock("sonata_type_date_picker_widget_html", $context, $blocks);
            echo "
        ";
        }
        // line 32
        echo "        <script type=\"text/javascript\">
            jQuery(function (\$) {
                \$('#";
        // line 34
        echo (((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) ? ("dp_") : (""));
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "').datetimepicker(";
        echo twig_jsonencode_filter((isset($context["dp_options"]) ? $context["dp_options"] : $this->getContext($context, "dp_options")));
        echo ");
            });
        </script>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_1dea2ef516ed45a9f2e1b4ef2bb37b1b2aa187e35c7b09183f032b10cf0d6003->leave($__internal_1dea2ef516ed45a9f2e1b4ef2bb37b1b2aa187e35c7b09183f032b10cf0d6003_prof);

    }

    // line 40
    public function block_sonata_type_datetime_picker_widget_html($context, array $blocks = array())
    {
        $__internal_471f8b2e69c8feaab56f3288676525b42a2be6543b3876d1a5f0a8d333050755 = $this->env->getExtension("native_profiler");
        $__internal_471f8b2e69c8feaab56f3288676525b42a2be6543b3876d1a5f0a8d333050755->enter($__internal_471f8b2e69c8feaab56f3288676525b42a2be6543b3876d1a5f0a8d333050755_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_type_datetime_picker_widget_html"));

        // line 41
        echo "    ";
        if ((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) {
            // line 42
            echo "        <div class='input-group date' id='dtp_";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "'>
    ";
        }
        // line 44
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("data-date-format" => (isset($context["moment_format"]) ? $context["moment_format"] : $this->getContext($context, "moment_format"))));
        // line 45
        echo "    ";
        $this->displayBlock("datetime_widget", $context, $blocks);
        echo "
    ";
        // line 46
        if ((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) {
            // line 47
            echo "          <span class=\"input-group-addon\"><span class=\"fa fa-calendar\"></span></span>
        </div>
    ";
        }
        
        $__internal_471f8b2e69c8feaab56f3288676525b42a2be6543b3876d1a5f0a8d333050755->leave($__internal_471f8b2e69c8feaab56f3288676525b42a2be6543b3876d1a5f0a8d333050755_prof);

    }

    // line 52
    public function block_sonata_type_datetime_picker_widget($context, array $blocks = array())
    {
        $__internal_76a1918318788fbddc50737fa2c1ee334745cc8d289389e128597eed0da54192 = $this->env->getExtension("native_profiler");
        $__internal_76a1918318788fbddc50737fa2c1ee334745cc8d289389e128597eed0da54192->enter($__internal_76a1918318788fbddc50737fa2c1ee334745cc8d289389e128597eed0da54192_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_type_datetime_picker_widget"));

        // line 53
        echo "    ";
        ob_start();
        // line 54
        echo "        ";
        if ((isset($context["wrap_fields_with_addons"]) ? $context["wrap_fields_with_addons"] : $this->getContext($context, "wrap_fields_with_addons"))) {
            // line 55
            echo "            <div class=\"input-group\">
                ";
            // line 56
            $this->displayBlock("sonata_type_datetime_picker_widget_html", $context, $blocks);
            echo "
            </div>
        ";
        } else {
            // line 59
            echo "            ";
            $this->displayBlock("sonata_type_datetime_picker_widget_html", $context, $blocks);
            echo "
        ";
        }
        // line 61
        echo "        <script type=\"text/javascript\">
            jQuery(function (\$) {
                \$('#";
        // line 63
        echo (((isset($context["datepicker_use_button"]) ? $context["datepicker_use_button"] : $this->getContext($context, "datepicker_use_button"))) ? ("dtp_") : (""));
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "').datetimepicker(";
        echo twig_jsonencode_filter((isset($context["dp_options"]) ? $context["dp_options"] : $this->getContext($context, "dp_options")));
        echo ");
            });
        </script>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_76a1918318788fbddc50737fa2c1ee334745cc8d289389e128597eed0da54192->leave($__internal_76a1918318788fbddc50737fa2c1ee334745cc8d289389e128597eed0da54192_prof);

    }

    public function getTemplateName()
    {
        return "SonataCoreBundle:Form:datepicker.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  195 => 63,  191 => 61,  185 => 59,  179 => 56,  176 => 55,  173 => 54,  170 => 53,  164 => 52,  154 => 47,  152 => 46,  147 => 45,  144 => 44,  138 => 42,  135 => 41,  129 => 40,  114 => 34,  110 => 32,  104 => 30,  98 => 27,  95 => 26,  92 => 25,  89 => 24,  83 => 23,  73 => 18,  71 => 17,  66 => 16,  63 => 15,  57 => 13,  54 => 12,  48 => 11,  41 => 52,  38 => 51,  36 => 40,  33 => 39,  31 => 23,  28 => 22,  26 => 11,);
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
/* {% block sonata_type_date_picker_widget_html %}*/
/*     {% if datepicker_use_button %}*/
/*         <div class='input-group date' id='dp_{{ id }}'>*/
/*     {% endif %}*/
/*     {% set attr = attr|merge({'data-date-format': moment_format}) %}*/
/*     {{ block('date_widget') }}*/
/*     {% if datepicker_use_button %}*/
/*             <span class="input-group-addon"><span class="fa fa-calendar"></span></span>*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock sonata_type_date_picker_widget_html %}*/
/* */
/* {% block sonata_type_date_picker_widget %}*/
/*     {% spaceless %}*/
/*         {% if wrap_fields_with_addons %}*/
/*             <div class="input-group">*/
/*                 {{ block('sonata_type_date_picker_widget_html') }}*/
/*             </div>*/
/*         {% else %}*/
/*             {{ block('sonata_type_date_picker_widget_html') }}*/
/*         {% endif %}*/
/*         <script type="text/javascript">*/
/*             jQuery(function ($) {*/
/*                 $('#{{ datepicker_use_button ? 'dp_' : '' }}{{ id }}').datetimepicker({{ dp_options|json_encode|raw }});*/
/*             });*/
/*         </script>*/
/*     {% endspaceless %}*/
/* {% endblock sonata_type_date_picker_widget %}*/
/* */
/* {% block sonata_type_datetime_picker_widget_html %}*/
/*     {% if datepicker_use_button %}*/
/*         <div class='input-group date' id='dtp_{{ id }}'>*/
/*     {% endif %}*/
/*     {% set attr = attr|merge({'data-date-format': moment_format}) %}*/
/*     {{ block('datetime_widget') }}*/
/*     {% if datepicker_use_button %}*/
/*           <span class="input-group-addon"><span class="fa fa-calendar"></span></span>*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock sonata_type_datetime_picker_widget_html %}*/
/* */
/* {% block sonata_type_datetime_picker_widget %}*/
/*     {% spaceless %}*/
/*         {% if wrap_fields_with_addons %}*/
/*             <div class="input-group">*/
/*                 {{ block('sonata_type_datetime_picker_widget_html') }}*/
/*             </div>*/
/*         {% else %}*/
/*             {{ block('sonata_type_datetime_picker_widget_html') }}*/
/*         {% endif %}*/
/*         <script type="text/javascript">*/
/*             jQuery(function ($) {*/
/*                 $('#{{ datepicker_use_button ? 'dtp_' : '' }}{{ id }}').datetimepicker({{ dp_options|json_encode|raw }});*/
/*             });*/
/*         </script>*/
/*     {% endspaceless %}*/
/* {% endblock sonata_type_datetime_picker_widget %}*/
/* */
