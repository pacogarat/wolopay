<?php

/* SonataAdminBundle::ajax_layout.html.twig */
class __TwigTemplate_0f21ee5506d95fc13bcd453ec90f84ec32a38f3b4898e4a87e9d4b89c4da0bbd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
            'preview' => array($this, 'block_preview'),
            'form' => array($this, 'block_form'),
            'list' => array($this, 'block_list'),
            'show' => array($this, 'block_show'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9cd9e434512fde56e317bcccea71889183769f120f202aff2be86cd3670b20e6 = $this->env->getExtension("native_profiler");
        $__internal_9cd9e434512fde56e317bcccea71889183769f120f202aff2be86cd3670b20e6->enter($__internal_9cd9e434512fde56e317bcccea71889183769f120f202aff2be86cd3670b20e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle::ajax_layout.html.twig"));

        // line 11
        echo "
";
        // line 12
        $this->displayBlock('content', $context, $blocks);
        
        $__internal_9cd9e434512fde56e317bcccea71889183769f120f202aff2be86cd3670b20e6->leave($__internal_9cd9e434512fde56e317bcccea71889183769f120f202aff2be86cd3670b20e6_prof);

    }

    public function block_content($context, array $blocks = array())
    {
        $__internal_5eb2621947a9d53674f53133e2c9477dae4235e241329db6c88e4b7721e4a74d = $this->env->getExtension("native_profiler");
        $__internal_5eb2621947a9d53674f53133e2c9477dae4235e241329db6c88e4b7721e4a74d->enter($__internal_5eb2621947a9d53674f53133e2c9477dae4235e241329db6c88e4b7721e4a74d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 13
        echo "    ";
        $context["_list_table"] = trim($this->renderBlock("list_table", $context, $blocks));
        // line 14
        echo "    ";
        $context["_list_filters"] = trim($this->renderBlock("list_filters", $context, $blocks));
        // line 15
        echo "
    ";
        // line 16
        $this->displayBlock('preview', $context, $blocks);
        // line 17
        echo "    ";
        $this->displayBlock('form', $context, $blocks);
        // line 18
        echo "    ";
        $this->displayBlock('list', $context, $blocks);
        // line 19
        echo "    ";
        $this->displayBlock('show', $context, $blocks);
        // line 20
        echo "
    ";
        // line 21
        if (((twig_length_filter($this->env, (isset($context["_list_table"]) ? $context["_list_table"] : $this->getContext($context, "_list_table"))) > 0) || (twig_length_filter($this->env, (isset($context["_list_filters"]) ? $context["_list_filters"] : $this->getContext($context, "_list_filters"))) > 0))) {
            // line 22
            echo "        <div class=\"row\">
            <div class=\"sonata-ba-list ";
            // line 23
            if ((isset($context["_list_filters"]) ? $context["_list_filters"] : $this->getContext($context, "_list_filters"))) {
                echo "col-md-10";
            } else {
                echo "col-md-12";
            }
            echo "\">
                ";
            // line 24
            echo (isset($context["_list_table"]) ? $context["_list_table"] : $this->getContext($context, "_list_table"));
            echo "
            </div>
            ";
            // line 26
            if ((isset($context["_list_filters"]) ? $context["_list_filters"] : $this->getContext($context, "_list_filters"))) {
                // line 27
                echo "                <div class=\"sonata-ba-filter col-md-2\">
                    ";
                // line 28
                echo (isset($context["_list_filters"]) ? $context["_list_filters"] : $this->getContext($context, "_list_filters"));
                echo "
                </div>
            ";
            }
            // line 31
            echo "        </div>
    ";
        }
        // line 33
        echo "
";
        
        $__internal_5eb2621947a9d53674f53133e2c9477dae4235e241329db6c88e4b7721e4a74d->leave($__internal_5eb2621947a9d53674f53133e2c9477dae4235e241329db6c88e4b7721e4a74d_prof);

    }

    // line 16
    public function block_preview($context, array $blocks = array())
    {
        $__internal_b3e1af7be1c488a546abe440d5f0e5db61e0f5622d67d3f7a7ca6eeb3e8db6b9 = $this->env->getExtension("native_profiler");
        $__internal_b3e1af7be1c488a546abe440d5f0e5db61e0f5622d67d3f7a7ca6eeb3e8db6b9->enter($__internal_b3e1af7be1c488a546abe440d5f0e5db61e0f5622d67d3f7a7ca6eeb3e8db6b9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "preview"));

        
        $__internal_b3e1af7be1c488a546abe440d5f0e5db61e0f5622d67d3f7a7ca6eeb3e8db6b9->leave($__internal_b3e1af7be1c488a546abe440d5f0e5db61e0f5622d67d3f7a7ca6eeb3e8db6b9_prof);

    }

    // line 17
    public function block_form($context, array $blocks = array())
    {
        $__internal_7872d41d3c191ba9a0df4f609f3db409b3a63f96ada3826e5831e14968d54b5b = $this->env->getExtension("native_profiler");
        $__internal_7872d41d3c191ba9a0df4f609f3db409b3a63f96ada3826e5831e14968d54b5b->enter($__internal_7872d41d3c191ba9a0df4f609f3db409b3a63f96ada3826e5831e14968d54b5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        
        $__internal_7872d41d3c191ba9a0df4f609f3db409b3a63f96ada3826e5831e14968d54b5b->leave($__internal_7872d41d3c191ba9a0df4f609f3db409b3a63f96ada3826e5831e14968d54b5b_prof);

    }

    // line 18
    public function block_list($context, array $blocks = array())
    {
        $__internal_0e4bf5b71a243d4e8703efc1ee1d2dc4d42683ce45d8b50e52830271c05a80d9 = $this->env->getExtension("native_profiler");
        $__internal_0e4bf5b71a243d4e8703efc1ee1d2dc4d42683ce45d8b50e52830271c05a80d9->enter($__internal_0e4bf5b71a243d4e8703efc1ee1d2dc4d42683ce45d8b50e52830271c05a80d9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "list"));

        
        $__internal_0e4bf5b71a243d4e8703efc1ee1d2dc4d42683ce45d8b50e52830271c05a80d9->leave($__internal_0e4bf5b71a243d4e8703efc1ee1d2dc4d42683ce45d8b50e52830271c05a80d9_prof);

    }

    // line 19
    public function block_show($context, array $blocks = array())
    {
        $__internal_7304e826aff808cf1cb0f08a3450c995733cb2db177f3fe322d813664a06b559 = $this->env->getExtension("native_profiler");
        $__internal_7304e826aff808cf1cb0f08a3450c995733cb2db177f3fe322d813664a06b559->enter($__internal_7304e826aff808cf1cb0f08a3450c995733cb2db177f3fe322d813664a06b559_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "show"));

        
        $__internal_7304e826aff808cf1cb0f08a3450c995733cb2db177f3fe322d813664a06b559->leave($__internal_7304e826aff808cf1cb0f08a3450c995733cb2db177f3fe322d813664a06b559_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::ajax_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  139 => 19,  128 => 18,  117 => 17,  106 => 16,  98 => 33,  94 => 31,  88 => 28,  85 => 27,  83 => 26,  78 => 24,  70 => 23,  67 => 22,  65 => 21,  62 => 20,  59 => 19,  56 => 18,  53 => 17,  51 => 16,  48 => 15,  45 => 14,  42 => 13,  30 => 12,  27 => 11,);
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
/* {% block content %}*/
/*     {% set _list_table   = block('list_table')|trim %}*/
/*     {% set _list_filters = block('list_filters')|trim %}*/
/* */
/*     {% block preview %}{% endblock %}*/
/*     {% block form %}{% endblock %}*/
/*     {% block list %}{% endblock %}*/
/*     {% block show %}{% endblock %}*/
/* */
/*     {% if _list_table|length > 0 or _list_filters|length > 0 %}*/
/*         <div class="row">*/
/*             <div class="sonata-ba-list {% if _list_filters %}col-md-10{% else %}col-md-12{% endif %}">*/
/*                 {{ _list_table|raw }}*/
/*             </div>*/
/*             {% if _list_filters %}*/
/*                 <div class="sonata-ba-filter col-md-2">*/
/*                     {{ _list_filters|raw }}*/
/*                 </div>*/
/*             {% endif %}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/* {% endblock %}*/
/* */
