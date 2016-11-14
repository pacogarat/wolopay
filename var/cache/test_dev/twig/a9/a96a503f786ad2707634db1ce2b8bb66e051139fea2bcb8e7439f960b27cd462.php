<?php

/* AppBundle:PaymentHosted/generic:genericPurchaseByPin.html.twig */
class __TwigTemplate_31ee21976be94da553ca4e3ad761bbc7b8d46e5487a537b781d42075d4a1bcfe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/PaymentHosted/layout_pay_method_hosted.html.twig", "AppBundle:PaymentHosted/generic:genericPurchaseByPin.html.twig", 1);
        $this->blocks = array(
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/PaymentHosted/layout_pay_method_hosted.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3a594f659b79f288a9697f140a4e364a705b02025767b7b321064cbf10192bb1 = $this->env->getExtension("native_profiler");
        $__internal_3a594f659b79f288a9697f140a4e364a705b02025767b7b321064cbf10192bb1->enter($__internal_3a594f659b79f288a9697f140a4e364a705b02025767b7b321064cbf10192bb1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/generic:genericPurchaseByPin.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3a594f659b79f288a9697f140a4e364a705b02025767b7b321064cbf10192bb1->leave($__internal_3a594f659b79f288a9697f140a4e364a705b02025767b7b321064cbf10192bb1_prof);

    }

    // line 2
    public function block_page($context, array $blocks = array())
    {
        $__internal_66fc52c000b6a7f1514ab75c39d8d867f1fc16c1b1441358c767625f9a8dca04 = $this->env->getExtension("native_profiler");
        $__internal_66fc52c000b6a7f1514ab75c39d8d867f1fc16c1b1441358c767625f9a8dca04->enter($__internal_66fc52c000b6a7f1514ab75c39d8d867f1fc16c1b1441358c767625f9a8dca04_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 3
        echo "
    <div class=\"row voffset3\">
        <div class=\"col-md-12\">
            <h1>";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("generic_pin.title"), "html", null, true);
        echo " <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\"></h1>

            ";
        // line 8
        echo $this->env->getExtension('translator')->trans("generic_pin.description", array("%article%" => (isset($context["articleName"]) ? $context["articleName"] : $this->getContext($context, "articleName"))));
        echo "

            <div>

                <div class=\"row voffset3\">
                    <div class=\"col-md-12\">
                        ";
        // line 14
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
                            ";
        // line 15
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "

                            <div class=\"input-group\" >
                                <span class=\"input-group-btn\">
                                    <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic.submit"), "html", null, true);
        echo "\">
                                </span>
                            </div>

                        ";
        // line 23
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
                    </div>
                </div>

            </div>

            <div class=\"voffset5\">
                ";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("generic_pin.legal_text", array("%amount%" => $this->getAttribute((isset($context["appShopHasArticle"]) ? $context["appShopHasArticle"] : $this->getContext($context, "appShopHasArticle")), "currentAmount", array()), "%currency%" => $this->getAttribute($this->getAttribute((isset($context["pmpc"]) ? $context["pmpc"] : $this->getContext($context, "pmpc")), "currency", array()), "symbol", array()))), "html", null, true);
        echo "
            </div>
        </div>
    </div>


";
        
        $__internal_66fc52c000b6a7f1514ab75c39d8d867f1fc16c1b1441358c767625f9a8dca04->leave($__internal_66fc52c000b6a7f1514ab75c39d8d867f1fc16c1b1441358c767625f9a8dca04_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PaymentHosted/generic:genericPurchaseByPin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 30,  79 => 23,  72 => 19,  65 => 15,  61 => 14,  52 => 8,  45 => 6,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends '@App/PaymentHosted/layout_pay_method_hosted.html.twig' %}*/
/* {% block page %}*/
/* */
/*     <div class="row voffset3">*/
/*         <div class="col-md-12">*/
/*             <h1>{{ 'generic_pin.title' | trans }} <img src="{% path pmpc.payMethod.imgIcon, 'shop' %}"></h1>*/
/* */
/*             {{ 'generic_pin.description' | trans({'%article%' : articleName }) | raw}}*/
/* */
/*             <div>*/
/* */
/*                 <div class="row voffset3">*/
/*                     <div class="col-md-12">*/
/*                         {{ form_start(form) }}*/
/*                             {{ form_widget(form) }}*/
/* */
/*                             <div class="input-group" >*/
/*                                 <span class="input-group-btn">*/
/*                                     <input type="submit" class="btn btn-primary" value="{{ 'form.generic.submit' | trans }}">*/
/*                                 </span>*/
/*                             </div>*/
/* */
/*                         {{ form_end(form) }}*/
/*                     </div>*/
/*                 </div>*/
/* */
/*             </div>*/
/* */
/*             <div class="voffset5">*/
/*                 {{ 'generic_pin.legal_text' | trans({'%amount%' : appShopHasArticle.currentAmount, '%currency%' : pmpc.currency.symbol}) }}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/* {% endblock %}*/
