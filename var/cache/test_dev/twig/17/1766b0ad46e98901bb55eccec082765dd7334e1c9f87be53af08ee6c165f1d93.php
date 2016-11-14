<?php

/* AppBundle:AppShop/PaymentRequirements:email.html.twig */
class __TwigTemplate_2b7b5ff77dc83d0f9b1c90ff1e57ba57611dd57fe18384c29f2eee4fd42736a7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_form_full_screen.html.twig", "AppBundle:AppShop/PaymentRequirements:email.html.twig", 1);
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
        $__internal_674636c7a74c5a0e383b0b7684cf94b397816e739b68794051676a902c05981f = $this->env->getExtension("native_profiler");
        $__internal_674636c7a74c5a0e383b0b7684cf94b397816e739b68794051676a902c05981f->enter($__internal_674636c7a74c5a0e383b0b7684cf94b397816e739b68794051676a902c05981f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:email.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_674636c7a74c5a0e383b0b7684cf94b397816e739b68794051676a902c05981f->leave($__internal_674636c7a74c5a0e383b0b7684cf94b397816e739b68794051676a902c05981f_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_9d2565e303acddb7495b99a45cdecee3563d78e2f469d320e4d067ed1628f2b7 = $this->env->getExtension("native_profiler");
        $__internal_9d2565e303acddb7495b99a45cdecee3563d78e2f469d320e4d067ed1628f2b7->enter($__internal_9d2565e303acddb7495b99a45cdecee3563d78e2f469d320e4d067ed1628f2b7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic_requirements.title"), "html", null, true);
        
        $__internal_9d2565e303acddb7495b99a45cdecee3563d78e2f469d320e4d067ed1628f2b7->leave($__internal_9d2565e303acddb7495b99a45cdecee3563d78e2f469d320e4d067ed1628f2b7_prof);

    }

    // line 3
    public function block_header_right($context, array $blocks = array())
    {
        $__internal_5e6332c51025e9649970ec4eb90422932bd5341185ff8b99d1a8f2cd0f8dcfdb = $this->env->getExtension("native_profiler");
        $__internal_5e6332c51025e9649970ec4eb90422932bd5341185ff8b99d1a8f2cd0f8dcfdb->enter($__internal_5e6332c51025e9649970ec4eb90422932bd5341185ff8b99d1a8f2cd0f8dcfdb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "header_right"));

        // line 4
        echo "    <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\">
";
        
        $__internal_5e6332c51025e9649970ec4eb90422932bd5341185ff8b99d1a8f2cd0f8dcfdb->leave($__internal_5e6332c51025e9649970ec4eb90422932bd5341185ff8b99d1a8f2cd0f8dcfdb_prof);

    }

    // line 6
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_05202cd06df02d38016cd151a7086d8228aab56fc3f0ae3fd43af857b81a2b60 = $this->env->getExtension("native_profiler");
        $__internal_05202cd06df02d38016cd151a7086d8228aab56fc3f0ae3fd43af857b81a2b60->enter($__internal_05202cd06df02d38016cd151a7086d8228aab56fc3f0ae3fd43af857b81a2b60_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 7
        echo "
    <h1>
        ";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.title"), "html", null, true);
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
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.desc"), "html", null, true);
        echo "</div>

";
        
        $__internal_05202cd06df02d38016cd151a7086d8228aab56fc3f0ae3fd43af857b81a2b60->leave($__internal_05202cd06df02d38016cd151a7086d8228aab56fc3f0ae3fd43af857b81a2b60_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/PaymentRequirements:email.html.twig";
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
/*         {{ 'form.gamer_email_type.title' | trans }}*/
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
/*     <div style="padding-top: 20px">{{ 'form.gamer_email_type.desc' | trans }}</div>*/
/* */
/* {% endblock %}*/
