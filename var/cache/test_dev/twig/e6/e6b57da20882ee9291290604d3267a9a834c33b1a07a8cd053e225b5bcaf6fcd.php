<?php

/* AppBundle:Others/Default:contactSimpleForm.html.twig */
class __TwigTemplate_ea800115f386e3286afa70310f4aefc0c813a84cc585ffda0c4b17d113b5bfd1 extends Twig_Template
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
        $__internal_88cdf4d1f701335a6be0548c3ddfd6c3006726369740ac6378743fed251aa9c3 = $this->env->getExtension("native_profiler");
        $__internal_88cdf4d1f701335a6be0548c3ddfd6c3006726369740ac6378743fed251aa9c3->enter($__internal_88cdf4d1f701335a6be0548c3ddfd6c3006726369740ac6378743fed251aa9c3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default:contactSimpleForm.html.twig"));

        // line 2
        echo "<form method=\"post\" action=\"#\" id=\"form-contact\" class=\"contact-form row\" >
    ";
        // line 3
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
    <div>
        <div class=\"half\">
            <div class=\"row\">
                <div class=\"col-md-4\">
                    ";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'errors');
        echo "
                    ";
        // line 9
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'widget');
        echo "
                </div>
                <div class=\"col-md-4\">
                    ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'errors');
        echo "
                    ";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'widget');
        echo "
                </div>
                <div class=\"col-md-4\">
                    ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "phone", array()), 'errors');
        echo "
                    ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "phone", array()), 'widget');
        echo "
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-12\">
                    ";
        // line 22
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "message", array()), 'errors');
        echo "
                    ";
        // line 23
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "message", array()), 'widget');
        echo "
                </div>
            </div>
            <div class=\"row\">
                <div class=\"col-md-4 col-md-offset-4\">
                    <label></label>
                    <button type=\"submit\" data-toggle=\"modal\" data-target=\"#alertModal\" class=\"btn btn-primary btn-block btn-xl\">Send <i class=\"ion-android-arrow-forward\"></i></button>
                </div>
            </div>
        </div>

    </div>

    ";
        // line 36
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "

</form>";
        
        $__internal_88cdf4d1f701335a6be0548c3ddfd6c3006726369740ac6378743fed251aa9c3->leave($__internal_88cdf4d1f701335a6be0548c3ddfd6c3006726369740ac6378743fed251aa9c3_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default:contactSimpleForm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 36,  69 => 23,  65 => 22,  57 => 17,  53 => 16,  47 => 13,  43 => 12,  37 => 9,  33 => 8,  25 => 3,  22 => 2,);
    }
}
/* {% trans_default_domain "default" %}*/
/* <form method="post" action="#" id="form-contact" class="contact-form row" >*/
/*     {{ form_errors(form) }}*/
/*     <div>*/
/*         <div class="half">*/
/*             <div class="row">*/
/*                 <div class="col-md-4">*/
/*                     {{ form_errors(form.name) }}*/
/*                     {{ form_widget(form.name) }}*/
/*                 </div>*/
/*                 <div class="col-md-4">*/
/*                     {{ form_errors(form.email) }}*/
/*                     {{ form_widget(form.email) }}*/
/*                 </div>*/
/*                 <div class="col-md-4">*/
/*                     {{ form_errors(form.phone) }}*/
/*                     {{ form_widget(form.phone) }}*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="col-md-12">*/
/*                     {{ form_errors(form.message) }}*/
/*                     {{ form_widget(form.message) }}*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row">*/
/*                 <div class="col-md-4 col-md-offset-4">*/
/*                     <label></label>*/
/*                     <button type="submit" data-toggle="modal" data-target="#alertModal" class="btn btn-primary btn-block btn-xl">Send <i class="ion-android-arrow-forward"></i></button>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/* */
/*     </div>*/
/* */
/*     {{ form_rest(form) }}*/
/* */
/* </form>*/
