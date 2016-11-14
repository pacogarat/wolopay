<?php

/* AppBundle:AppShop/PaymentRequirements:genericRequirements.html.twig */
class __TwigTemplate_6901789f78b598fdd043379d509b2ed6f78a400a7e13ff4a6cba862c01859554 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_form_full_screen.html.twig", "AppBundle:AppShop/PaymentRequirements:genericRequirements.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'header_right' => array($this, 'block_header_right'),
            'page_container' => array($this, 'block_page_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_form_full_screen.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4a12d1b75c003e582f70cbc265214711486eae4b090336eb9782ab0bb5796fe4 = $this->env->getExtension("native_profiler");
        $__internal_4a12d1b75c003e582f70cbc265214711486eae4b090336eb9782ab0bb5796fe4->enter($__internal_4a12d1b75c003e582f70cbc265214711486eae4b090336eb9782ab0bb5796fe4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:genericRequirements.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4a12d1b75c003e582f70cbc265214711486eae4b090336eb9782ab0bb5796fe4->leave($__internal_4a12d1b75c003e582f70cbc265214711486eae4b090336eb9782ab0bb5796fe4_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_fd18289661977f05ab0f8ce2d031aedef5b812e71ca77c20b827404777c6b070 = $this->env->getExtension("native_profiler");
        $__internal_fd18289661977f05ab0f8ce2d031aedef5b812e71ca77c20b827404777c6b070->enter($__internal_fd18289661977f05ab0f8ce2d031aedef5b812e71ca77c20b827404777c6b070_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.title"), "html", null, true);
        
        $__internal_fd18289661977f05ab0f8ce2d031aedef5b812e71ca77c20b827404777c6b070->leave($__internal_fd18289661977f05ab0f8ce2d031aedef5b812e71ca77c20b827404777c6b070_prof);

    }

    // line 3
    public function block_header_right($context, array $blocks = array())
    {
        $__internal_12b92bb1c028ade6acfa8ff7295cd1729105d61cbcfb759c7e287321de6ad039 = $this->env->getExtension("native_profiler");
        $__internal_12b92bb1c028ade6acfa8ff7295cd1729105d61cbcfb759c7e287321de6ad039->enter($__internal_12b92bb1c028ade6acfa8ff7295cd1729105d61cbcfb759c7e287321de6ad039_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header_right"));

        // line 4
        echo "    <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\">
";
        
        $__internal_12b92bb1c028ade6acfa8ff7295cd1729105d61cbcfb759c7e287321de6ad039->leave($__internal_12b92bb1c028ade6acfa8ff7295cd1729105d61cbcfb759c7e287321de6ad039_prof);

    }

    // line 6
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_d031a281c61aee95fcc4d85a93ea7e6b7d0dcf9bcddc99fb22acfd7109b39b69 = $this->env->getExtension("native_profiler");
        $__internal_d031a281c61aee95fcc4d85a93ea7e6b7d0dcf9bcddc99fb22acfd7109b39b69->enter($__internal_d031a281c61aee95fcc4d85a93ea7e6b7d0dcf9bcddc99fb22acfd7109b39b69_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 7
        echo "
    <h1>
        ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.title"), "html", null, true);
        echo "
    </h1>

    ";
        // line 12
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
    ";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "

    <div class=\"form-group text-right voffset4\">
        <button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\">";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.submit.label"), "html", null, true);
        echo "</button>
    </div>

    ";
        // line 19
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

    <div style=\"padding-top: 20px\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.desc"), "html", null, true);
        echo "</div>

";
        
        $__internal_d031a281c61aee95fcc4d85a93ea7e6b7d0dcf9bcddc99fb22acfd7109b39b69->leave($__internal_d031a281c61aee95fcc4d85a93ea7e6b7d0dcf9bcddc99fb22acfd7109b39b69_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/PaymentRequirements:genericRequirements.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  101 => 21,  96 => 19,  90 => 16,  84 => 13,  80 => 12,  74 => 9,  70 => 7,  64 => 6,  54 => 4,  48 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_form_full_screen.html.twig" %}*/
/* {% block title %}{{ 'form.generic_requirements.title' | trans }}{% endblock %}*/
/* {% block header_right %}*/
/*     <img src="{% path pmpc.payMethod.imgIcon, 'shop' %}">*/
/* {% endblock %}*/
/* {% block page_container %}*/
/* */
/*     <h1>*/
/*         {{ 'form.generic_requirements.title' | trans }}*/
/*     </h1>*/
/* */
/*     {{ form_start(form) }}*/
/*     {{ form_widget(form) }}*/
/* */
/*     <div class="form-group text-right voffset4">*/
/*         <button type="submit" class="btn btn-primary btn-lg btn-block">{{'form.gamer_email_type.submit.label' | trans }}</button>*/
/*     </div>*/
/* */
/*     {{ form_end(form) }}*/
/* */
/*     <div style="padding-top: 20px">{{ 'form.generic_requirements.desc' | trans }}</div>*/
/* */
/* {% endblock %}*/
