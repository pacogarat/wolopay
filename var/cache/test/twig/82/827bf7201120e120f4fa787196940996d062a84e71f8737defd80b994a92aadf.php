<?php

/* AppBundle:Sonata/Transaction:transaction_log.html.twig */
class __TwigTemplate_18460d189d310a20d90569398cfffc0a18a10cc559e35ad8211b8973ba6257d4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "AppBundle:Sonata/Transaction:transaction_log.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3edc83058a08b7c75049f090047d8fa632b256193b562a53092d6da0d7b44676 = $this->env->getExtension("native_profiler");
        $__internal_3edc83058a08b7c75049f090047d8fa632b256193b562a53092d6da0d7b44676->enter($__internal_3edc83058a08b7c75049f090047d8fa632b256193b562a53092d6da0d7b44676_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Transaction:transaction_log.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3edc83058a08b7c75049f090047d8fa632b256193b562a53092d6da0d7b44676->leave($__internal_3edc83058a08b7c75049f090047d8fa632b256193b562a53092d6da0d7b44676_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_e453cc167db119842ec0fc57b63042d952a794cecb78e29036c868561f5b69fb = $this->env->getExtension("native_profiler");
        $__internal_e453cc167db119842ec0fc57b63042d952a794cecb78e29036c868561f5b69fb->enter($__internal_e453cc167db119842ec0fc57b63042d952a794cecb78e29036c868561f5b69fb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "



    ";
        // line 8
        if (twig_test_empty((isset($context["lines"]) ? $context["lines"] : $this->getContext($context, "lines")))) {
            // line 9
            echo "
        Log is empty or is old

    ";
        } else {
            // line 13
            echo "
        <h1>Transaction id: ";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array()), "html", null, true);
            echo "</h1>
        <h2>Status: ";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "statusCategory", array()), "name", array()), "html", null, true);
            echo "</h2>
        <style>
            .sonata-ba-content label{
                margin: 0 10px;

            }
        </style>
        <div style=\"padding: 15px\">
            <label style=\"cursor: pointer; font-weight: normal;color: green\" onclick=\"visibleType(\$('#debug').is(':checked'), 'debug');\">Debug <input data-type-log=\"debug\" checked type=\"checkbox\"></label>
            <label style=\"cursor: pointer; font-weight: normal;color: blue\" onclick=\"visibleType(\$('#debug').is(':checked'), 'debug');\">Info <input data-type-log=\"info\" checked type=\"checkbox\"></label>
            <label style=\"cursor: pointer; font-weight: normal;color: red\" onclick=\"visibleType(\$('#debug').is(':checked'), 'debug');\">Error <input data-type-log=\"error\" checked type=\"checkbox\"></label>
            <label style=\"cursor: pointer; font-weight: bold;color: red; \" onclick=\"visibleType(\$('#debug').is(':checked'), 'debug');\">Critical <input data-type-log=\"critical\" checked type=\"checkbox\"></label>

        </div>

        <div style=\"overflow-x: scroll\">
            ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["lines"]) ? $context["lines"] : $this->getContext($context, "lines")));
            foreach ($context['_seq'] as $context["_key"] => $context["line"]) {
                // line 32
                echo "                <div style=\"border-bottom: 1px solid #ccc ;padding: 3px 0; width: 100%; white-space: nowrap;\">
                    ";
                // line 33
                echo $context["line"];
                echo "
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['line'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "        </div>
    ";
        }
        // line 38
        echo "
    <script>

        \$(\"input\").on('ifChanged', function (event) {
            visibleType(event.target.checked, event.target.attributes['data-type-log'].textContent);
        });

        function visibleType(state, className)
        {
            if (state)
                \$('.'+className+'').parent().show();
            else
                \$('.'+className+'').parent().hide();
        }
    </script>

";
        
        $__internal_e453cc167db119842ec0fc57b63042d952a794cecb78e29036c868561f5b69fb->leave($__internal_e453cc167db119842ec0fc57b63042d952a794cecb78e29036c868561f5b69fb_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Transaction:transaction_log.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 38,  96 => 36,  87 => 33,  84 => 32,  80 => 31,  61 => 15,  57 => 14,  54 => 13,  48 => 9,  46 => 8,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:action.html.twig' %}*/
/* */
/* {% block content %}*/
/* */
/* */
/* */
/* */
/*     {% if lines is empty %}*/
/* */
/*         Log is empty or is old*/
/* */
/*     {% else %}*/
/* */
/*         <h1>Transaction id: {{ object.id }}</h1>*/
/*         <h2>Status: {{ object.statusCategory.name }}</h2>*/
/*         <style>*/
/*             .sonata-ba-content label{*/
/*                 margin: 0 10px;*/
/* */
/*             }*/
/*         </style>*/
/*         <div style="padding: 15px">*/
/*             <label style="cursor: pointer; font-weight: normal;color: green" onclick="visibleType($('#debug').is(':checked'), 'debug');">Debug <input data-type-log="debug" checked type="checkbox"></label>*/
/*             <label style="cursor: pointer; font-weight: normal;color: blue" onclick="visibleType($('#debug').is(':checked'), 'debug');">Info <input data-type-log="info" checked type="checkbox"></label>*/
/*             <label style="cursor: pointer; font-weight: normal;color: red" onclick="visibleType($('#debug').is(':checked'), 'debug');">Error <input data-type-log="error" checked type="checkbox"></label>*/
/*             <label style="cursor: pointer; font-weight: bold;color: red; " onclick="visibleType($('#debug').is(':checked'), 'debug');">Critical <input data-type-log="critical" checked type="checkbox"></label>*/
/* */
/*         </div>*/
/* */
/*         <div style="overflow-x: scroll">*/
/*             {% for line in lines %}*/
/*                 <div style="border-bottom: 1px solid #ccc ;padding: 3px 0; width: 100%; white-space: nowrap;">*/
/*                     {{ line | raw }}*/
/*                 </div>*/
/*             {% endfor %}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/*     <script>*/
/* */
/*         $("input").on('ifChanged', function (event) {*/
/*             visibleType(event.target.checked, event.target.attributes['data-type-log'].textContent);*/
/*         });*/
/* */
/*         function visibleType(state, className)*/
/*         {*/
/*             if (state)*/
/*                 $('.'+className+'').parent().show();*/
/*             else*/
/*                 $('.'+className+'').parent().hide();*/
/*         }*/
/*     </script>*/
/* */
/* {% endblock %}*/
