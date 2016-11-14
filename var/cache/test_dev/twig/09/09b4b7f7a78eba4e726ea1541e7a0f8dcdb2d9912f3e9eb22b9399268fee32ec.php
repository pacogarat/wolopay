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
        $__internal_f77951a63d107c8a2ce97a11810a3c6bb1a888c3fff3c0ff38999a620387ec82 = $this->env->getExtension("native_profiler");
        $__internal_f77951a63d107c8a2ce97a11810a3c6bb1a888c3fff3c0ff38999a620387ec82->enter($__internal_f77951a63d107c8a2ce97a11810a3c6bb1a888c3fff3c0ff38999a620387ec82_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle::ajax_layout.html.twig"));

        // line 11
        echo "
";
        // line 12
        $this->displayBlock('content', $context, $blocks);
        
        $__internal_f77951a63d107c8a2ce97a11810a3c6bb1a888c3fff3c0ff38999a620387ec82->leave($__internal_f77951a63d107c8a2ce97a11810a3c6bb1a888c3fff3c0ff38999a620387ec82_prof);

    }

    public function block_content($context, array $blocks = array())
    {
        $__internal_a3932437ca3ed939b8ca35e9f845d02a65fd7f96b66c9773939ef411f67ddae1 = $this->env->getExtension("native_profiler");
        $__internal_a3932437ca3ed939b8ca35e9f845d02a65fd7f96b66c9773939ef411f67ddae1->enter($__internal_a3932437ca3ed939b8ca35e9f845d02a65fd7f96b66c9773939ef411f67ddae1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

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
        
        $__internal_a3932437ca3ed939b8ca35e9f845d02a65fd7f96b66c9773939ef411f67ddae1->leave($__internal_a3932437ca3ed939b8ca35e9f845d02a65fd7f96b66c9773939ef411f67ddae1_prof);

    }

    // line 16
    public function block_preview($context, array $blocks = array())
    {
        $__internal_d788ab9a801210597f86316a9ab602c821f52a8c0d04f6550a10ba424fbc1384 = $this->env->getExtension("native_profiler");
        $__internal_d788ab9a801210597f86316a9ab602c821f52a8c0d04f6550a10ba424fbc1384->enter($__internal_d788ab9a801210597f86316a9ab602c821f52a8c0d04f6550a10ba424fbc1384_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "preview"));

        
        $__internal_d788ab9a801210597f86316a9ab602c821f52a8c0d04f6550a10ba424fbc1384->leave($__internal_d788ab9a801210597f86316a9ab602c821f52a8c0d04f6550a10ba424fbc1384_prof);

    }

    // line 17
    public function block_form($context, array $blocks = array())
    {
        $__internal_3e6cffb6216b50a767e34d8d9d43c3b10377a66564bd9330497f933d029fdfa7 = $this->env->getExtension("native_profiler");
        $__internal_3e6cffb6216b50a767e34d8d9d43c3b10377a66564bd9330497f933d029fdfa7->enter($__internal_3e6cffb6216b50a767e34d8d9d43c3b10377a66564bd9330497f933d029fdfa7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        
        $__internal_3e6cffb6216b50a767e34d8d9d43c3b10377a66564bd9330497f933d029fdfa7->leave($__internal_3e6cffb6216b50a767e34d8d9d43c3b10377a66564bd9330497f933d029fdfa7_prof);

    }

    // line 18
    public function block_list($context, array $blocks = array())
    {
        $__internal_003830b06133ee802bfac2dbd589ff45655e7a75e65fa153d8bc082c36ea58b2 = $this->env->getExtension("native_profiler");
        $__internal_003830b06133ee802bfac2dbd589ff45655e7a75e65fa153d8bc082c36ea58b2->enter($__internal_003830b06133ee802bfac2dbd589ff45655e7a75e65fa153d8bc082c36ea58b2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "list"));

        
        $__internal_003830b06133ee802bfac2dbd589ff45655e7a75e65fa153d8bc082c36ea58b2->leave($__internal_003830b06133ee802bfac2dbd589ff45655e7a75e65fa153d8bc082c36ea58b2_prof);

    }

    // line 19
    public function block_show($context, array $blocks = array())
    {
        $__internal_7bf433455d7cd75fc12b66c094a50cf3713da40f57aa6e1051f770ddc2f26abb = $this->env->getExtension("native_profiler");
        $__internal_7bf433455d7cd75fc12b66c094a50cf3713da40f57aa6e1051f770ddc2f26abb->enter($__internal_7bf433455d7cd75fc12b66c094a50cf3713da40f57aa6e1051f770ddc2f26abb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "show"));

        
        $__internal_7bf433455d7cd75fc12b66c094a50cf3713da40f57aa6e1051f770ddc2f26abb->leave($__internal_7bf433455d7cd75fc12b66c094a50cf3713da40f57aa6e1051f770ddc2f26abb_prof);

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
