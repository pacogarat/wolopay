<?php

/* AppBundle:PDF/partials:taxes_for_gateways.html.twig */
class __TwigTemplate_cdb39231d2d32147087394e074ca266352c6e9f02266368cbea6e212b515d0e6 extends Twig_Template
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
        $__internal_b3d97167db50d19c0537ecd3fc9f720f6cc90cb31180a6320f907d734d5926dc = $this->env->getExtension("native_profiler");
        $__internal_b3d97167db50d19c0537ecd3fc9f720f6cc90cb31180a6320f907d734d5926dc->enter($__internal_b3d97167db50d19c0537ecd3fc9f720f6cc90cb31180a6320f907d734d5926dc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/partials:taxes_for_gateways.html.twig"));

        // line 1
        echo "<style>
    .lll td {
        border-bottom: 1px solid  #808080
    }
</style>

<table style=\"font-size: 0.8em; width: 60%; margin-top: 25px\" cellspacing=\"0\" cellpadding=\"4\"
       xmlns=\"http://www.w3.org/1999/html\" xmlns=\"http://www.w3.org/1999/html\">
    <tr>
        <th style=\"text-align: left\">
            Country
        </th>
        <th style=\"text-align: left\">
            Currency
        </th>
        <th style=\"text-align: right\">
            Amount tax
        </th>
    </tr>
    ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["storageWoloGatewayByCountry"]) ? $context["storageWoloGatewayByCountry"] : $this->getContext($context, "storageWoloGatewayByCountry")));
        foreach ($context['_seq'] as $context["_key"] => $context["country"]) {
            // line 21
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["country"], "currencies", array()));
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
            foreach ($context['_seq'] as $context["_key"] => $context["obj"]) {
                // line 22
                echo "            ";
                if (($this->getAttribute($context["loop"], "first", array()) == true)) {
                    // line 23
                    echo "                    <tr class=\"lll\" ><td></td><td></td><td></td></tr>
            ";
                }
                // line 25
                echo "            <tr >
                <td>";
                // line 26
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["country"], "country", array()), "name", array()), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["country"], "country", array()), "vat", array()), "html", null, true);
                echo "%) </td>
                <td>";
                // line 27
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["obj"], "currency", array()), "name", array()), "html", null, true);
                echo " (";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["obj"], "currency", array()), "id", array()), "html", null, true);
                echo ") </td>
                <td class=\"num\">";
                // line 28
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["obj"], "value", array()), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["obj"], "currency", array()), "symbol", array()), "html", null, true);
                echo "</td>
            </tr>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['obj'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['country'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "</table>";
        
        $__internal_b3d97167db50d19c0537ecd3fc9f720f6cc90cb31180a6320f907d734d5926dc->leave($__internal_b3d97167db50d19c0537ecd3fc9f720f6cc90cb31180a6320f907d734d5926dc_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/partials:taxes_for_gateways.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 32,  106 => 31,  87 => 28,  81 => 27,  75 => 26,  72 => 25,  68 => 23,  65 => 22,  47 => 21,  43 => 20,  22 => 1,);
    }
}
/* <style>*/
/*     .lll td {*/
/*         border-bottom: 1px solid  #808080*/
/*     }*/
/* </style>*/
/* */
/* <table style="font-size: 0.8em; width: 60%; margin-top: 25px" cellspacing="0" cellpadding="4"*/
/*        xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">*/
/*     <tr>*/
/*         <th style="text-align: left">*/
/*             Country*/
/*         </th>*/
/*         <th style="text-align: left">*/
/*             Currency*/
/*         </th>*/
/*         <th style="text-align: right">*/
/*             Amount tax*/
/*         </th>*/
/*     </tr>*/
/*     {% for country in storageWoloGatewayByCountry %}*/
/*         {% for obj in country.currencies %}*/
/*             {% if loop.first == true %}*/
/*                     <tr class="lll" ><td></td><td></td><td></td></tr>*/
/*             {% endif %}*/
/*             <tr >*/
/*                 <td>{{ country.country.name }} ({{ country.country.vat }}%) </td>*/
/*                 <td>{{ obj.currency.name }} ({{ obj.currency.id }}) </td>*/
/*                 <td class="num">{{ obj.value | number_format(2,'.', ',') }} {{ obj.currency.symbol }}</td>*/
/*             </tr>*/
/*         {% endfor %}*/
/*     {% endfor %}*/
/* </table>*/
