<?php

/* AppBundle:AppShop/PaymentRequirements:steamId.html.twig */
class __TwigTemplate_f0e01f26c0d2bea4fec3caa7244cb400adc6e57a0d902598ecf46bc76f8e95dd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_form_full_screen.html.twig", "AppBundle:AppShop/PaymentRequirements:steamId.html.twig", 1);
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
        $__internal_1d3580589f10ba6990b6aab926058090ea5cba9164f7c777c7c7447229c860d1 = $this->env->getExtension("native_profiler");
        $__internal_1d3580589f10ba6990b6aab926058090ea5cba9164f7c777c7c7447229c860d1->enter($__internal_1d3580589f10ba6990b6aab926058090ea5cba9164f7c777c7c7447229c860d1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:steamId.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1d3580589f10ba6990b6aab926058090ea5cba9164f7c777c7c7447229c860d1->leave($__internal_1d3580589f10ba6990b6aab926058090ea5cba9164f7c777c7c7447229c860d1_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_8bdadfa9682c4fb09e66ab2cc51bc2f9021d9002af7619ded179082ad61dd2f5 = $this->env->getExtension("native_profiler");
        $__internal_8bdadfa9682c4fb09e66ab2cc51bc2f9021d9002af7619ded179082ad61dd2f5->enter($__internal_8bdadfa9682c4fb09e66ab2cc51bc2f9021d9002af7619ded179082ad61dd2f5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.title"), "html", null, true);
        
        $__internal_8bdadfa9682c4fb09e66ab2cc51bc2f9021d9002af7619ded179082ad61dd2f5->leave($__internal_8bdadfa9682c4fb09e66ab2cc51bc2f9021d9002af7619ded179082ad61dd2f5_prof);

    }

    // line 3
    public function block_header_right($context, array $blocks = array())
    {
        $__internal_229496ee388d1f7ef83c1b70beded5e1e860e2aed2bc77aabf7b0e90b6b64e81 = $this->env->getExtension("native_profiler");
        $__internal_229496ee388d1f7ef83c1b70beded5e1e860e2aed2bc77aabf7b0e90b6b64e81->enter($__internal_229496ee388d1f7ef83c1b70beded5e1e860e2aed2bc77aabf7b0e90b6b64e81_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header_right"));

        // line 4
        echo "    <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\">
";
        
        $__internal_229496ee388d1f7ef83c1b70beded5e1e860e2aed2bc77aabf7b0e90b6b64e81->leave($__internal_229496ee388d1f7ef83c1b70beded5e1e860e2aed2bc77aabf7b0e90b6b64e81_prof);

    }

    // line 6
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_b5c2e0a31ab3a65fd5b2a1b111730ba63aa3617ae95d76e432af48ef25d57510 = $this->env->getExtension("native_profiler");
        $__internal_b5c2e0a31ab3a65fd5b2a1b111730ba63aa3617ae95d76e432af48ef25d57510->enter($__internal_b5c2e0a31ab3a65fd5b2a1b111730ba63aa3617ae95d76e432af48ef25d57510_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 7
        echo "
    <h1>
        ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_steam_id_type.title"), "html", null, true);
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
    <div class=\"row\">
        <div class=\"form-group text-right\">
            <button type=\"submit\" class=\"btn btn-primary\">";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.submit.label"), "html", null, true);
        echo "</button>
        </div>
    </div>
    ";
        // line 19
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

    <div style=\"padding-top: 20px\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_steam_id_type.desc"), "html", null, true);
        echo "</div>

";
        
        $__internal_b5c2e0a31ab3a65fd5b2a1b111730ba63aa3617ae95d76e432af48ef25d57510->leave($__internal_b5c2e0a31ab3a65fd5b2a1b111730ba63aa3617ae95d76e432af48ef25d57510_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/PaymentRequirements:steamId.html.twig";
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
/*         {{ 'form.gamer_steam_id_type.title' | trans }}*/
/*     </h1>*/
/* */
/*     {{ form_start(form) }}*/
/*     {{ form_widget(form) }}*/
/*     <div class="row">*/
/*         <div class="form-group text-right">*/
/*             <button type="submit" class="btn btn-primary">{{'form.gamer_email_type.submit.label' | trans }}</button>*/
/*         </div>*/
/*     </div>*/
/*     {{ form_end(form) }}*/
/* */
/*     <div style="padding-top: 20px">{{ 'form.gamer_steam_id_type.desc' | trans }}</div>*/
/* */
/* {% endblock %}*/
