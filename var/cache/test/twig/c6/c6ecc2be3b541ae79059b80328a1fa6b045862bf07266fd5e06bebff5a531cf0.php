<?php

/* AppBundle:PaymentHosted/NviaPayMethods/SMS:logicMoMtCode.html.twig */
class __TwigTemplate_997c1af6f4a0bf7cf774740ac1ca87edc6954a50d6ba2e82fab38c7e0cab794c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/PaymentHosted/NviaPayMethods/layout_nvia_methods.html.twig", "AppBundle:PaymentHosted/NviaPayMethods/SMS:logicMoMtCode.html.twig", 1);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/PaymentHosted/NviaPayMethods/layout_nvia_methods.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_90afa0c8be017c7103ae87f690d69ae8f9cc8d19d9051cbd2ea637e2d80213c6 = $this->env->getExtension("native_profiler");
        $__internal_90afa0c8be017c7103ae87f690d69ae8f9cc8d19d9051cbd2ea637e2d80213c6->enter($__internal_90afa0c8be017c7103ae87f690d69ae8f9cc8d19d9051cbd2ea637e2d80213c6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/NviaPayMethods/SMS:logicMoMtCode.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_90afa0c8be017c7103ae87f690d69ae8f9cc8d19d9051cbd2ea637e2d80213c6->leave($__internal_90afa0c8be017c7103ae87f690d69ae8f9cc8d19d9051cbd2ea637e2d80213c6_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_10a7b33baf5d1d8525da7bc82824101afeb925fb8fdd0b6281048c59c820b82e = $this->env->getExtension("native_profiler");
        $__internal_10a7b33baf5d1d8525da7bc82824101afeb925fb8fdd0b6281048c59c820b82e->enter($__internal_10a7b33baf5d1d8525da7bc82824101afeb925fb8fdd0b6281048c59c820b82e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "    <style>
        .container{
            background: url(";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/nvia_pay_methods/phone.jpg"), "html", null, true);
        echo ") no-repeat top right;
        }
    </style>
    ";
        // line 8
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
        
        $__internal_10a7b33baf5d1d8525da7bc82824101afeb925fb8fdd0b6281048c59c820b82e->leave($__internal_10a7b33baf5d1d8525da7bc82824101afeb925fb8fdd0b6281048c59c820b82e_prof);

    }

    // line 10
    public function block_page($context, array $blocks = array())
    {
        $__internal_08447a4b36cbac26b5409b1d9aa0b3a4bda65cac36ba5d1edcffcc31790f15b9 = $this->env->getExtension("native_profiler");
        $__internal_08447a4b36cbac26b5409b1d9aa0b3a4bda65cac36ba5d1edcffcc31790f15b9->enter($__internal_08447a4b36cbac26b5409b1d9aa0b3a4bda65cac36ba5d1edcffcc31790f15b9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 11
        echo "
    <div class=\"row voffset3\">
        <div class=\"col-md-12\">
            <h1>";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.title"), "html", null, true);
        echo " </h1>
            <h3>";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.follow_instructions"), "html", null, true);
        echo "</h3>
            <blockquote class=\"voffset3\">
                <span class=\"text-info\">";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_1"), "html", null, true);
        echo ".</span> ";
        echo $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_1_desc", array("%article%" => (isset($context["articleName"]) ? $context["articleName"] : $this->getContext($context, "articleName"))));
        echo "
            </blockquote>
            <div class=\"\">
                <h3>";
        // line 20
        echo $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.sing_up_text", array("%number%" => (("<span class=\"text-info\">" . $this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "shortNumber", array())) . "</span>"), "%text%" => (("<span class=\"text-info\"> " . (isset($context["alias"]) ? $context["alias"] : $this->getContext($context, "alias"))) . "</span>")));
        echo "</h3>
            </div>
            <div>
                <blockquote>
                    <span class=\"text-info\">";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_2"), "html", null, true);
        echo ".</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_2_desc"), "html", null, true);
        echo "
                </blockquote>

                <div class=\"row voffset3\">
                    <form id=\"app_shop_form_type_sms_code_code\" class=\"form-inline\" method=\"post\" role=\"form\">
                        <div class=\"col-md-5\">
                            <div class=\"input-group\" >
                                ";
        // line 31
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "code", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                                <span class=\"input-group-btn\">
                                    <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic.submit"), "html", null, true);
        echo "\">
                                </span>
                            </div>
                        </div>
                        <div class=\"text-danger\">
                            ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "code", array()), 'errors');
        echo "
                        </div>
                        ";
        // line 40
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
                    </form>
                    <div class=\"text-danger\">";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "</div>
                </div>


            </div>
            <div class=\"voffset4\">
                ";
        // line 48
        echo $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "legalTextLabel", array()), "key", array()), array("%number%" => $this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "shortNumber", array()), "%amount%" => $this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "amount", array()), "%currency%" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "payMethodProviderHasCountry", array()), "currency", array()), "symbol", array())), $this->getAttribute($this->getAttribute((isset($context["sms"]) ? $context["sms"] : $this->getContext($context, "sms")), "legalTextLabel", array()), "domain", array()));
        echo "
            </div>
        </div>
    </div>

";
        
        $__internal_08447a4b36cbac26b5409b1d9aa0b3a4bda65cac36ba5d1edcffcc31790f15b9->leave($__internal_08447a4b36cbac26b5409b1d9aa0b3a4bda65cac36ba5d1edcffcc31790f15b9_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PaymentHosted/NviaPayMethods/SMS:logicMoMtCode.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 48,  130 => 42,  125 => 40,  120 => 38,  112 => 33,  107 => 31,  95 => 24,  88 => 20,  80 => 17,  75 => 15,  71 => 14,  66 => 11,  60 => 10,  51 => 8,  45 => 5,  41 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends '@App/PaymentHosted/NviaPayMethods/layout_nvia_methods.html.twig' %}*/
/* {% block stylesheets %}*/
/*     <style>*/
/*         .container{*/
/*             background: url({{asset('bundles/app/app_shop/img/nvia_pay_methods/phone.jpg')}}) no-repeat top right;*/
/*         }*/
/*     </style>*/
/*     {{ parent() }}*/
/* {% endblock %}*/
/* {% block page %}*/
/* */
/*     <div class="row voffset3">*/
/*         <div class="col-md-12">*/
/*             <h1>{{ 'sms.logic_mo_mt_code.title' | trans }} </h1>*/
/*             <h3>{{'sms.follow_instructions' | trans }}</h3>*/
/*             <blockquote class="voffset3">*/
/*                 <span class="text-info">{{ 'sms.logic_mo_mt_code.step_1' | trans }}.</span> {{ 'sms.logic_mo_mt_code.step_1_desc' | trans({'%article%' : articleName }) | raw }}*/
/*             </blockquote>*/
/*             <div class="">*/
/*                 <h3>{{ 'sms.logic_mo_mt_code.sing_up_text' | trans({'%number%' : '<span class="text-info">' ~ sms.shortNumber ~ '</span>', '%text%' : '<span class="text-info"> ' ~ alias ~ '</span>'}) | raw }}</h3>*/
/*             </div>*/
/*             <div>*/
/*                 <blockquote>*/
/*                     <span class="text-info">{{ 'sms.logic_mo_mt_code.step_2' | trans }}.</span> {{ 'sms.logic_mo_mt_code.step_2_desc' | trans }}*/
/*                 </blockquote>*/
/* */
/*                 <div class="row voffset3">*/
/*                     <form id="app_shop_form_type_sms_code_code" class="form-inline" method="post" role="form">*/
/*                         <div class="col-md-5">*/
/*                             <div class="input-group" >*/
/*                                 {{ form_widget(form.code, {'attr': {'class': 'form-control'}}) }}*/
/*                                 <span class="input-group-btn">*/
/*                                     <input type="submit" class="btn btn-primary" value="{{ 'form.generic.submit' | trans }}">*/
/*                                 </span>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="text-danger">*/
/*                             {{ form_errors(form.code) }}*/
/*                         </div>*/
/*                         {{ form_rest(form) }}*/
/*                     </form>*/
/*                     <div class="text-danger">{{ form_errors(form) }}</div>*/
/*                 </div>*/
/* */
/* */
/*             </div>*/
/*             <div class="voffset4">*/
/*                 {{ sms.legalTextLabel.key | trans({'%number%' : sms.shortNumber, '%amount%' : sms.amount, '%currency%' : sms.payMethodProviderHasCountry.currency.symbol}, sms.legalTextLabel.domain) | raw }}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock %}*/
