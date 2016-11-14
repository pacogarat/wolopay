<?php

/* AppBundle:AppShop/Support:contact_gamer_form.html.twig */
class __TwigTemplate_53e4fe5718038a06edf815e1d35041094973af394ad1b654bf7560ec9bdb53f4 extends Twig_Template
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
        $__internal_8a704ee974e364e1e44b9f7c8ea6ee644b12d1900d33f49541045399199e7929 = $this->env->getExtension("native_profiler");
        $__internal_8a704ee974e364e1e44b9f7c8ea6ee644b12d1900d33f49541045399199e7929->enter($__internal_8a704ee974e364e1e44b9f7c8ea6ee644b12d1900d33f49541045399199e7929_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Support:contact_gamer_form.html.twig"));

        // line 1
        echo "<form method=\"post\" action=\"#\" id=\"formu\" role=\"form\">
    ";
        // line 2
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "

    <div class=\"row\">
        <div class=\"form-group col-sm-6\" >
            ";
        // line 6
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "transaction", array()), 'row');
        echo "
        </div>

        <div class=\"form-group col-sm-6\">
            ";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "name", array()), 'row');
        echo "
        </div>

    </div>

    <div class=\"row\">
        <div class=\"form-group col-sm-6\">
            ";
        // line 17
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "mobile", array()), 'row');
        echo "
        </div>
        <div class=\"form-group col-sm-6\">
            ";
        // line 20
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "email", array()), 'row');
        echo "
        </div>
    </div>

    <div class=\"row\">

        <div class=\"form-group col-sm-6\">
            ";
        // line 27
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "subject", array()), 'row');
        echo "
        </div>

        <div class=\"form-group col-sm-6\">
            ";
        // line 31
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "captcha", array()), 'row');
        echo "
        </div>
    </div>

    <div class=\"row\">
        <div class=\"form-group col-sm-12\">
            ";
        // line 37
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "comment", array()), 'row', array("attr" => array("class" => "form-control", "style" => "height:80px")));
        echo "
        </div>
    </div>

    <div class=\"row\">
        ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
    </div>

    <div class=\"row\">
        <div class=\"form-group col-sm-3 col-sm-offset-9\">
            <button type=\"submit\" class=\"btn btn-primary\">";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.support.gamer.submit.label"), "html", null, true);
        echo "</button>
        </div>
    </div>

</form>";
        
        $__internal_8a704ee974e364e1e44b9f7c8ea6ee644b12d1900d33f49541045399199e7929->leave($__internal_8a704ee974e364e1e44b9f7c8ea6ee644b12d1900d33f49541045399199e7929_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Support:contact_gamer_form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 47,  89 => 42,  81 => 37,  72 => 31,  65 => 27,  55 => 20,  49 => 17,  39 => 10,  32 => 6,  25 => 2,  22 => 1,);
    }
}
/* <form method="post" action="#" id="formu" role="form">*/
/*     {{ form_errors(form) }}*/
/* */
/*     <div class="row">*/
/*         <div class="form-group col-sm-6" >*/
/*             {{ form_row(form.transaction ) }}*/
/*         </div>*/
/* */
/*         <div class="form-group col-sm-6">*/
/*             {{ form_row(form.name ) }}*/
/*         </div>*/
/* */
/*     </div>*/
/* */
/*     <div class="row">*/
/*         <div class="form-group col-sm-6">*/
/*             {{ form_row(form.mobile ) }}*/
/*         </div>*/
/*         <div class="form-group col-sm-6">*/
/*             {{ form_row(form.email ) }}*/
/*         </div>*/
/*     </div>*/
/* */
/*     <div class="row">*/
/* */
/*         <div class="form-group col-sm-6">*/
/*             {{ form_row(form.subject ) }}*/
/*         </div>*/
/* */
/*         <div class="form-group col-sm-6">*/
/*             {{ form_row(form.captcha ) }}*/
/*         </div>*/
/*     </div>*/
/* */
/*     <div class="row">*/
/*         <div class="form-group col-sm-12">*/
/*             {{ form_row(form.comment, { 'attr': {'class': 'form-control', 'style': 'height:80px'} } ) }}*/
/*         </div>*/
/*     </div>*/
/* */
/*     <div class="row">*/
/*         {{ form_rest(form) }}*/
/*     </div>*/
/* */
/*     <div class="row">*/
/*         <div class="form-group col-sm-3 col-sm-offset-9">*/
/*             <button type="submit" class="btn btn-primary">{{'form.support.gamer.submit.label' | trans }}</button>*/
/*         </div>*/
/*     </div>*/
/* */
/* </form>*/
