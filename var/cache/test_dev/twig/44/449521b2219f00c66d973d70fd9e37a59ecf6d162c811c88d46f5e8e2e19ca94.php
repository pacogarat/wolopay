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
        $__internal_96028d3b49d20144945d05390960dadb5bc30f1513ef9f59ec0aaf236c16d887 = $this->env->getExtension("native_profiler");
        $__internal_96028d3b49d20144945d05390960dadb5bc30f1513ef9f59ec0aaf236c16d887->enter($__internal_96028d3b49d20144945d05390960dadb5bc30f1513ef9f59ec0aaf236c16d887_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:genericRequirements.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_96028d3b49d20144945d05390960dadb5bc30f1513ef9f59ec0aaf236c16d887->leave($__internal_96028d3b49d20144945d05390960dadb5bc30f1513ef9f59ec0aaf236c16d887_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_cd38b3e7882ba7f930a3fb6a7b75d1a8e63070376d3b6a1ca25c927097af6352 = $this->env->getExtension("native_profiler");
        $__internal_cd38b3e7882ba7f930a3fb6a7b75d1a8e63070376d3b6a1ca25c927097af6352->enter($__internal_cd38b3e7882ba7f930a3fb6a7b75d1a8e63070376d3b6a1ca25c927097af6352_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.title"), "html", null, true);
        
        $__internal_cd38b3e7882ba7f930a3fb6a7b75d1a8e63070376d3b6a1ca25c927097af6352->leave($__internal_cd38b3e7882ba7f930a3fb6a7b75d1a8e63070376d3b6a1ca25c927097af6352_prof);

    }

    // line 3
    public function block_header_right($context, array $blocks = array())
    {
        $__internal_3b1db3d594591824bccc584985e25139eeed0333783de206a29b1fabef6f53bf = $this->env->getExtension("native_profiler");
        $__internal_3b1db3d594591824bccc584985e25139eeed0333783de206a29b1fabef6f53bf->enter($__internal_3b1db3d594591824bccc584985e25139eeed0333783de206a29b1fabef6f53bf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header_right"));

        // line 4
        echo "    <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\">
";
        
        $__internal_3b1db3d594591824bccc584985e25139eeed0333783de206a29b1fabef6f53bf->leave($__internal_3b1db3d594591824bccc584985e25139eeed0333783de206a29b1fabef6f53bf_prof);

    }

    // line 6
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_9bff8c5caa1c8c6726bcedffb2ebdcdad3ad9f6894955c5d65ea064a21a2ebf2 = $this->env->getExtension("native_profiler");
        $__internal_9bff8c5caa1c8c6726bcedffb2ebdcdad3ad9f6894955c5d65ea064a21a2ebf2->enter($__internal_9bff8c5caa1c8c6726bcedffb2ebdcdad3ad9f6894955c5d65ea064a21a2ebf2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

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
        
        $__internal_9bff8c5caa1c8c6726bcedffb2ebdcdad3ad9f6894955c5d65ea064a21a2ebf2->leave($__internal_9bff8c5caa1c8c6726bcedffb2ebdcdad3ad9f6894955c5d65ea064a21a2ebf2_prof);

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
