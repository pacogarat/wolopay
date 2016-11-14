<?php

/* SonataAdminBundle:CRUD:base_list_inner_row.html.twig */
class __TwigTemplate_d9a688c51db1e9334e247032d95a1f2bc0a9cbad19ed83fdfe2f62dedb47bf28 extends Twig_Template
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
        $__internal_28bd545b1dce4e5732f0115ff838d441e8dad80388d5a7e0a66f1a29baedc2af = $this->env->getExtension("native_profiler");
        $__internal_28bd545b1dce4e5732f0115ff838d441e8dad80388d5a7e0a66f1a29baedc2af->enter($__internal_28bd545b1dce4e5732f0115ff838d441e8dad80388d5a7e0a66f1a29baedc2af_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_list_inner_row.html.twig"));

        // line 11
        echo "
";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "list", array()), "elements", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["field_description"]) {
            // line 13
            echo "    ";
            if ((($this->getAttribute($context["field_description"], "name", array()) == "_action") && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "isXmlHttpRequest", array()))) {
                // line 14
                echo "        ";
                // line 15
                echo "    ";
            } elseif ((($this->getAttribute($context["field_description"], "getOption", array(0 => "ajax_hidden"), "method") == true) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "isXmlHttpRequest", array()))) {
                // line 16
                echo "        ";
                // line 17
                echo "    ";
            } else {
                // line 18
                echo "        ";
                echo $this->env->getExtension('sonata_admin')->renderListElement($this->env, (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), $context["field_description"]);
                echo "
    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field_description'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_28bd545b1dce4e5732f0115ff838d441e8dad80388d5a7e0a66f1a29baedc2af->leave($__internal_28bd545b1dce4e5732f0115ff838d441e8dad80388d5a7e0a66f1a29baedc2af_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_list_inner_row.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 18,  39 => 17,  37 => 16,  34 => 15,  32 => 14,  29 => 13,  25 => 12,  22 => 11,);
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
/* */
/* {% for field_description in admin.list.elements %}*/
/*     {% if field_description.name == '_action' and app.request.isXmlHttpRequest %}*/
/*         {# Action buttons disabled in ajax view! #}*/
/*     {% elseif field_description.getOption('ajax_hidden') == true and app.request.isXmlHttpRequest %}*/
/*         {# Disable fields with 'ajax_hidden' option set to true #}*/
/*     {% else %}*/
/*         {{ object|render_list_element(field_description) }}*/
/*     {% endif %}*/
/* {% endfor %}*/
