<?php

/* AppBundle:PDF/partials:extra_concepts.html.twig */
class __TwigTemplate_9a47b1cea5a995d0d9df1c458a85195e02cc1499b9a4d58adbb514694b0fd7b5 extends Twig_Template
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
        $__internal_49c719165f38dc572f1540d6450c92f497a8709501d76c978bc43edf38a0c96a = $this->env->getExtension("native_profiler");
        $__internal_49c719165f38dc572f1540d6450c92f497a8709501d76c978bc43edf38a0c96a->enter($__internal_49c719165f38dc572f1540d6450c92f497a8709501d76c978bc43edf38a0c96a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/partials:extra_concepts.html.twig"));

        // line 2
        echo "
";
        // line 3
        $context["extraConceptsN"] = 0;
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extraConcepts"]) ? $context["extraConcepts"] : $this->getContext($context, "extraConcepts")));
        foreach ($context['_seq'] as $context["_key"] => $context["concept"]) {
            // line 5
            echo "    <tr>
        <td>
            ";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute($context["concept"], "name", array()), "html", null, true);
            echo "
            ";
            // line 8
            if ($this->getAttribute($context["concept"], "description", array())) {
                // line 9
                echo "                ";
                $context["extraConceptsN"] = ((isset($context["extraConceptsN"]) ? $context["extraConceptsN"] : $this->getContext($context, "extraConceptsN")) + 1);
                // line 10
                echo "                ";
                ob_start();
                // line 11
                echo "                    (";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["extraConceptsN"]) ? $context["extraConceptsN"] : $this->getContext($context, "extraConceptsN"))));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    echo "*";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                echo ")
                ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 13
                echo "
            ";
            }
            // line 15
            echo "        </td>
        <td>
            ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["concept"], "moneyInClientCurrency", array()), "currency", array()), "id", array()), "html", null, true);
            echo "
        </td>
        <td class=\"num\">
            ";
            // line 20
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["concept"], "moneyInClientCurrency", array()), "amount", array()), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["concept"], "moneyInClientCurrency", array()), "currency", array()), "symbol", array()), "html", null, true);
            echo "
        </td>
    </tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['concept'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_49c719165f38dc572f1540d6450c92f497a8709501d76c978bc43edf38a0c96a->leave($__internal_49c719165f38dc572f1540d6450c92f497a8709501d76c978bc43edf38a0c96a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/partials:extra_concepts.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 20,  68 => 17,  64 => 15,  60 => 13,  47 => 11,  44 => 10,  41 => 9,  39 => 8,  35 => 7,  31 => 5,  27 => 4,  25 => 3,  22 => 2,);
    }
}
/* {# concept \AppBundle\Command\Billing\BillingClientOwesInjectConcept #}*/
/* */
/* {% set extraConceptsN = 0 %}*/
/* {% for concept in extraConcepts %}*/
/*     <tr>*/
/*         <td>*/
/*             {{ concept.name }}*/
/*             {% if concept.description %}*/
/*                 {% set extraConceptsN = extraConceptsN + 1 %}*/
/*                 {% spaceless %}*/
/*                     ({% for i in 1..extraConceptsN %}*{% endfor %})*/
/*                 {% endspaceless %}*/
/* */
/*             {% endif %}*/
/*         </td>*/
/*         <td>*/
/*             {{ concept.moneyInClientCurrency.currency.id }}*/
/*         </td>*/
/*         <td class="num">*/
/*             {{ concept.moneyInClientCurrency.amount | number_format(2,'.', ',') }} {{ concept.moneyInClientCurrency.currency.symbol }}*/
/*         </td>*/
/*     </tr>*/
/* {% endfor %}*/
