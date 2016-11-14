<?php

/* LexikTranslationBundle:Translation:new.html.twig */
class __TwigTemplate_306e894ee87bd6b809060be8ebc75cccd6a152c6063f232f365a9853c067bbe3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["layout"]) ? $context["layout"] : $this->getContext($context, "layout")), "LexikTranslationBundle:Translation:new.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_b7dd6315c6f361bbe5e39705d147b3ec4934fecfa7a0d3163af5947993d82c2a = $this->env->getExtension("native_profiler");
        $__internal_b7dd6315c6f361bbe5e39705d147b3ec4934fecfa7a0d3163af5947993d82c2a->enter($__internal_b7dd6315c6f361bbe5e39705d147b3ec4934fecfa7a0d3163af5947993d82c2a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "LexikTranslationBundle:Translation:new.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b7dd6315c6f361bbe5e39705d147b3ec4934fecfa7a0d3163af5947993d82c2a->leave($__internal_b7dd6315c6f361bbe5e39705d147b3ec4934fecfa7a0d3163af5947993d82c2a_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_dd13212a98d5f95641e6dee60c89116ade566dcb239287dd18a80215fcc5936e = $this->env->getExtension("native_profiler");
        $__internal_dd13212a98d5f95641e6dee60c89116ade566dcb239287dd18a80215fcc5936e->enter($__internal_dd13212a98d5f95641e6dee60c89116ade566dcb239287dd18a80215fcc5936e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-md-12\">
                <h3>";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.add_translation", array(), "LexikTranslationBundle"), "html", null, true);
        echo "</h3>
                <hr />
            </div>

            <div class=\"col-md-6\">

                ";
        // line 13
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start', array("action" => $this->env->getExtension('routing')->getPath("lexik_translation_new"), "method" => "POST", "attr" => array("class" => "form form-vertical")));
        echo "

                <div class=\"form-group\">
                    ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "key", array()), 'label');
        echo "
                    ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "key", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                    <span class=\"text-danger\">";
        // line 18
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "key", array()), 'errors');
        echo "</span>
                </div>

                <div class=\"form-group\">
                    ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "domain", array()), 'label');
        echo "
                    ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "domain", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                    <span class=\"text-danger\">";
        // line 24
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "domain", array()), 'errors');
        echo "</span>
                </div>

                <div class=\"form-group\">
                    ";
        // line 28
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "translations", array()), 'label');
        echo "
                </div>

                <div class=\"form-group\">
                    ";
        // line 32
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "translations", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["translation"]) {
            // line 33
            echo "                        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["translation"], 'label');
            echo "
                        ";
            // line 34
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["translation"], "content", array()), 'widget', array("attr" => array("class" => "form-control")));
            echo "
                        <span class=\"text-danger\">";
            // line 35
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["translation"], "content", array()), 'errors');
            echo "</span>
                        ";
            // line 36
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["translation"], "locale", array()), 'widget');
            echo "
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['translation'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "                </div>

                <div class=\"form-group\">
                    <a href=\"";
        // line 41
        echo $this->env->getExtension('routing')->getPath("lexik_translation_grid");
        echo "\" class=\"btn btn-default\">
                        <span class=\"glyphicon glyphicon-arrow-left\"></span>
                        ";
        // line 43
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("translations.back_to_list", array(), "LexikTranslationBundle"), "html", null, true);
        echo "
                    </a>

                    <div class=\"btn-group pull-right\">
                        ";
        // line 47
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "save", array()), 'widget', array("attr" => array("id" => "trans-unit-submit", "name" => "trans-unit-submit", "class" => "btn btn-primary")));
        echo "
                        ";
        // line 48
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "save_add", array()), 'widget', array("attr" => array("id" => "trans-unit-submit-2", "name" => "trans-unit-submit-2", "class" => "btn btn-primary")));
        echo "
                    </div>
                </div>

                ";
        // line 52
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

            </div>
        </div>
    </div>
";
        
        $__internal_dd13212a98d5f95641e6dee60c89116ade566dcb239287dd18a80215fcc5936e->leave($__internal_dd13212a98d5f95641e6dee60c89116ade566dcb239287dd18a80215fcc5936e_prof);

    }

    public function getTemplateName()
    {
        return "LexikTranslationBundle:Translation:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 52,  142 => 48,  138 => 47,  131 => 43,  126 => 41,  121 => 38,  113 => 36,  109 => 35,  105 => 34,  100 => 33,  96 => 32,  89 => 28,  82 => 24,  78 => 23,  74 => 22,  67 => 18,  63 => 17,  59 => 16,  53 => 13,  44 => 7,  39 => 4,  33 => 3,  18 => 1,);
    }
}
/* {% extends layout %}*/
/* */
/* {% block content %}*/
/*     <div class="container">*/
/*         <div class="row">*/
/*             <div class="col-md-12">*/
/*                 <h3>{{ 'translations.add_translation'|trans({}, 'LexikTranslationBundle') }}</h3>*/
/*                 <hr />*/
/*             </div>*/
/* */
/*             <div class="col-md-6">*/
/* */
/*                 {{ form_start(form, {'action': path('lexik_translation_new'), 'method': 'POST', 'attr': {'class': 'form form-vertical'}}) }}*/
/* */
/*                 <div class="form-group">*/
/*                     {{ form_label(form.key) }}*/
/*                     {{ form_widget(form.key, { 'attr': {'class': 'form-control'} }) }}*/
/*                     <span class="text-danger">{{ form_errors(form.key) }}</span>*/
/*                 </div>*/
/* */
/*                 <div class="form-group">*/
/*                     {{ form_label(form.domain) }}*/
/*                     {{ form_widget(form.domain, { 'attr': {'class': 'form-control'} }) }}*/
/*                     <span class="text-danger">{{ form_errors(form.domain) }}</span>*/
/*                 </div>*/
/* */
/*                 <div class="form-group">*/
/*                     {{ form_label(form.translations) }}*/
/*                 </div>*/
/* */
/*                 <div class="form-group">*/
/*                     {% for translation in form.translations %}*/
/*                         {{ form_label(translation) }}*/
/*                         {{ form_widget(translation.content, { 'attr': {'class': 'form-control'} }) }}*/
/*                         <span class="text-danger">{{ form_errors(translation.content) }}</span>*/
/*                         {{ form_widget(translation.locale) }}*/
/*                     {% endfor %}*/
/*                 </div>*/
/* */
/*                 <div class="form-group">*/
/*                     <a href="{{ path('lexik_translation_grid') }}" class="btn btn-default">*/
/*                         <span class="glyphicon glyphicon-arrow-left"></span>*/
/*                         {{ 'translations.back_to_list'|trans({}, 'LexikTranslationBundle') }}*/
/*                     </a>*/
/* */
/*                     <div class="btn-group pull-right">*/
/*                         {{ form_widget(form.save, { 'attr': {'id': 'trans-unit-submit', 'name': 'trans-unit-submit', 'class': 'btn btn-primary'} }) }}*/
/*                         {{ form_widget(form.save_add, { 'attr': {'id': 'trans-unit-submit-2', 'name': 'trans-unit-submit-2', 'class': 'btn btn-primary'} }) }}*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 {{ form_end(form) }}*/
/* */
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
