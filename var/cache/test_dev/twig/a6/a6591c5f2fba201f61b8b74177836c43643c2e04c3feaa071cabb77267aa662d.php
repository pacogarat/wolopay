<?php

/* BraincraftedBootstrapBundle::flash.html.twig */
class __TwigTemplate_ad96af7e7719c0c1e3bb1adacc84df25ce6a3d57ef98b2e9a5f41bd516175ace extends Twig_Template
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
        $__internal_a1cedc74c3a697ce6d004f7f33dfc2c015a3b8878567c4776261b08c1ceee8ab = $this->env->getExtension("native_profiler");
        $__internal_a1cedc74c3a697ce6d004f7f33dfc2c015a3b8878567c4776261b08c1ceee8ab->enter($__internal_a1cedc74c3a697ce6d004f7f33dfc2c015a3b8878567c4776261b08c1ceee8ab_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "BraincraftedBootstrapBundle::flash.html.twig"));

        // line 1
        if ( !array_key_exists("translation_domain", $context)) {
            // line 2
            echo "    ";
            $context["translation_domain"] = null;
        }
        // line 4
        if ( !array_key_exists("close", $context)) {
            // line 5
            echo "    ";
            $context["close"] = false;
        }
        // line 7
        echo "
";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "alert"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 9
            echo "    <div class=\"alert alert-warning";
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo " alert-dismissible";
            }
            echo "\">
        ";
            // line 10
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            }
            // line 11
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["flashMessage"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "
";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "danger"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 16
            echo "    <div class=\"alert alert-danger";
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo " alert-dismissible";
            }
            echo "\">
        ";
            // line 17
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            }
            // line 18
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["flashMessage"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 21
        echo "
";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "info"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 23
            echo "    <div class=\"alert alert-info";
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo " alert-dismissible";
            }
            echo "\">
        ";
            // line 24
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            }
            // line 25
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["flashMessage"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "
";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "get", array(0 => "success"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
            // line 30
            echo "    <div class=\"alert alert-success";
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo " alert-dismissible";
            }
            echo "\">
        ";
            // line 31
            if ((isset($context["close"]) ? $context["close"] : $this->getContext($context, "close"))) {
                echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            }
            // line 32
            echo "        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["flashMessage"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "
    </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_a1cedc74c3a697ce6d004f7f33dfc2c015a3b8878567c4776261b08c1ceee8ab->leave($__internal_a1cedc74c3a697ce6d004f7f33dfc2c015a3b8878567c4776261b08c1ceee8ab_prof);

    }

    public function getTemplateName()
    {
        return "BraincraftedBootstrapBundle::flash.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 32,  132 => 31,  125 => 30,  121 => 29,  118 => 28,  108 => 25,  104 => 24,  97 => 23,  93 => 22,  90 => 21,  80 => 18,  76 => 17,  69 => 16,  65 => 15,  62 => 14,  52 => 11,  48 => 10,  41 => 9,  37 => 8,  34 => 7,  30 => 5,  28 => 4,  24 => 2,  22 => 1,);
    }
}
/* {% if translation_domain is not defined %}*/
/*     {% set translation_domain = null %}*/
/* {% endif %}*/
/* {% if close is not defined %}*/
/*     {% set close = false %}*/
/* {% endif %}*/
/* */
/* {% for flashMessage in app.session.flashbag.get('alert') %}*/
/*     <div class="alert alert-warning{% if close %} alert-dismissible{% endif %}">*/
/*         {% if close %}<button type="button" class="close" data-dismiss="alert">&times;</button>{% endif %}*/
/*         {{ flashMessage|trans({}, translation_domain) }}*/
/*     </div>*/
/* {% endfor %}*/
/* */
/* {% for flashMessage in app.session.flashbag.get('danger') %}*/
/*     <div class="alert alert-danger{% if close %} alert-dismissible{% endif %}">*/
/*         {% if close %}<button type="button" class="close" data-dismiss="alert">&times;</button>{% endif %}*/
/*         {{ flashMessage|trans({}, translation_domain) }}*/
/*     </div>*/
/* {% endfor %}*/
/* */
/* {% for flashMessage in app.session.flashbag.get('info') %}*/
/*     <div class="alert alert-info{% if close %} alert-dismissible{% endif %}">*/
/*         {% if close %}<button type="button" class="close" data-dismiss="alert">&times;</button>{% endif %}*/
/*         {{ flashMessage|trans({}, translation_domain) }}*/
/*     </div>*/
/* {% endfor %}*/
/* */
/* {% for flashMessage in app.session.flashbag.get('success') %}*/
/*     <div class="alert alert-success{% if close %} alert-dismissible{% endif %}">*/
/*         {% if close %}<button type="button" class="close" data-dismiss="alert">&times;</button>{% endif %}*/
/*         {{ flashMessage|trans({}, translation_domain) }}*/
/*     </div>*/
/* {% endfor %}*/
/* */
