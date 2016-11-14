<?php

/* AppBundle:PDF/partials:extra_concepts_desc.html.twig */
class __TwigTemplate_509c220a200a77fa79daf020963e85f1b40949e49050d1f29bbc1e54546ca1ad extends Twig_Template
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
        $__internal_c473f2c9383629e855fa3864d7b0e3d5e7290c1285334c072d958ac0937d3413 = $this->env->getExtension("native_profiler");
        $__internal_c473f2c9383629e855fa3864d7b0e3d5e7290c1285334c072d958ac0937d3413->enter($__internal_c473f2c9383629e855fa3864d7b0e3d5e7290c1285334c072d958ac0937d3413_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/partials:extra_concepts_desc.html.twig"));

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
            echo "
    ";
            // line 6
            if ($this->getAttribute($context["concept"], "description", array())) {
                // line 7
                echo "        ";
                $context["extraConceptsN"] = ((isset($context["extraConceptsN"]) ? $context["extraConceptsN"] : $this->getContext($context, "extraConceptsN")) + 1);
                // line 8
                echo "
        ";
                // line 9
                ob_start();
                // line 10
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(range(1, (isset($context["extraConceptsN"]) ? $context["extraConceptsN"] : $this->getContext($context, "extraConceptsN"))));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    echo "*";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 11
                echo "        ";
                echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
                // line 12
                echo "        ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["concept"], "description", array()), "html", null, true);
                echo "<br>
    ";
            }
            // line 14
            echo "
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['concept'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "
";
        // line 17
        if (((isset($context["extraConceptsN"]) ? $context["extraConceptsN"] : $this->getContext($context, "extraConceptsN")) > 0)) {
            // line 18
            echo "    <br>
";
        }
        
        $__internal_c473f2c9383629e855fa3864d7b0e3d5e7290c1285334c072d958ac0937d3413->leave($__internal_c473f2c9383629e855fa3864d7b0e3d5e7290c1285334c072d958ac0937d3413_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/partials:extra_concepts_desc.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 18,  73 => 17,  70 => 16,  63 => 14,  57 => 12,  54 => 11,  44 => 10,  42 => 9,  39 => 8,  36 => 7,  34 => 6,  31 => 5,  27 => 4,  25 => 3,  22 => 2,);
    }
}
/* {# concept \AppBundle\Command\Billing\BillingClientOwesInjectConcept #}*/
/* */
/* {% set extraConceptsN = 0 %}*/
/* {% for concept in extraConcepts %}*/
/* */
/*     {% if concept.description %}*/
/*         {% set extraConceptsN = extraConceptsN + 1 %}*/
/* */
/*         {% spaceless %}*/
/*             {% for i in 1..extraConceptsN %}*{% endfor %}*/
/*         {% endspaceless %}*/
/*         {{ concept.description }}<br>*/
/*     {% endif %}*/
/* */
/* {% endfor %}*/
/* */
/* {% if extraConceptsN > 0 %}*/
/*     <br>*/
/* {% endif %}*/
