<?php

/* AppBundle:PaymentHosted/NviaPayMethods/Voice:logicVoVtCode.html.twig */
class __TwigTemplate_915c0fb796160db7212219183f37d6148c09da9e2c257eaa93c90af6145fddea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/PaymentHosted/NviaPayMethods/layout_nvia_methods.html.twig", "AppBundle:PaymentHosted/NviaPayMethods/Voice:logicVoVtCode.html.twig", 1);
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
        $__internal_d551db7fe695122f3a4c04a3a2a5b6fd8fcf3e5d676a533957135be87dcda2a4 = $this->env->getExtension("native_profiler");
        $__internal_d551db7fe695122f3a4c04a3a2a5b6fd8fcf3e5d676a533957135be87dcda2a4->enter($__internal_d551db7fe695122f3a4c04a3a2a5b6fd8fcf3e5d676a533957135be87dcda2a4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/NviaPayMethods/Voice:logicVoVtCode.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d551db7fe695122f3a4c04a3a2a5b6fd8fcf3e5d676a533957135be87dcda2a4->leave($__internal_d551db7fe695122f3a4c04a3a2a5b6fd8fcf3e5d676a533957135be87dcda2a4_prof);

    }

    // line 2
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_b7694568465acd825b7f50d2d769a5cb8b188b064e8ff0c084cc88534fbca794 = $this->env->getExtension("native_profiler");
        $__internal_b7694568465acd825b7f50d2d769a5cb8b188b064e8ff0c084cc88534fbca794->enter($__internal_b7694568465acd825b7f50d2d769a5cb8b188b064e8ff0c084cc88534fbca794_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 3
        echo "    <style>
        .container{
            background: url(";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/nvia_pay_methods/telephone_operator.jpg"), "html", null, true);
        echo ") no-repeat top right;
        }
    </style>
    ";
        // line 8
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
";
        
        $__internal_b7694568465acd825b7f50d2d769a5cb8b188b064e8ff0c084cc88534fbca794->leave($__internal_b7694568465acd825b7f50d2d769a5cb8b188b064e8ff0c084cc88534fbca794_prof);

    }

    // line 10
    public function block_page($context, array $blocks = array())
    {
        $__internal_7fa62a0d8337f862551e79eb6317e232536cc4147918c90122d2e4416c6927da = $this->env->getExtension("native_profiler");
        $__internal_7fa62a0d8337f862551e79eb6317e232536cc4147918c90122d2e4416c6927da->enter($__internal_7fa62a0d8337f862551e79eb6317e232536cc4147918c90122d2e4416c6927da_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 11
        echo "
    <div class=\"row voffset3\">
        <div class=\"col-md-12\">
            <h1>";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.title"), "html", null, true);
        echo " <img src=\"";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["voice"]) ? $context["voice"] : $this->getContext($context, "voice")), "payMethodProviderHasCountry", array()), "payMethodHasProvider", array()), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\"></h1>
            <h3>";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.follow_instructions"), "html", null, true);
        echo "</h3>
            <blockquote class=\"voffset3\">
                <span class=\"text-info\">";
        // line 17
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.step_1"), "html", null, true);
        echo ".</span>
                ";
        // line 18
        echo $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.step_1_desc", array("%article%" => (isset($context["articleName"]) ? $context["articleName"] : $this->getContext($context, "articleName"))));
        echo "
            </blockquote>
            <div class=\"voffset4\">
                <h3>";
        // line 21
        echo $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.sing_up_text", array("%number%" => (("<span class=\"text-info\">" . $this->getAttribute((isset($context["voice"]) ? $context["voice"] : $this->getContext($context, "voice")), "number", array())) . "</span>")));
        echo "</h3>
            </div>
            <div>
                <blockquote>
                    <span class=\"text-info\">";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.step_2"), "html", null, true);
        echo ".</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.step_2_desc"), "html", null, true);
        echo "
                </blockquote>

                <div class=\"row voffset3\">
                    <form id=\"app_shop_form_type_sms_code_code\" class=\"form-inline\" method=\"post\" role=\"form\">
                        <div class=\"col-md-5\">
                            <div class=\"input-group\" >
                                ";
        // line 32
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "code", array()), 'widget', array("attr" => array("class" => "form-control")));
        echo "
                                <span class=\"input-group-btn\">
                                    <input type=\"submit\" class=\"btn btn-primary\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic.submit"), "html", null, true);
        echo "\">
                                </span>
                            </div>
                        </div>
                        <div class=\"text-danger\">
                            ";
        // line 39
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "code", array()), 'errors');
        echo "
                        </div>

                        ";
        // line 42
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
                    </form>
                    <div class=\"text-danger\">";
        // line 44
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "</div>
                </div>

            </div>

            <div class=\"voffset5\">
                ";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("voice.logic_vo_vt_code.legal_text", array("%amount%" => $this->getAttribute((isset($context["voice"]) ? $context["voice"] : $this->getContext($context, "voice")), "amount", array()), "%number%" => $this->getAttribute((isset($context["voice"]) ? $context["voice"] : $this->getContext($context, "voice")), "number", array()), "%currency%" => $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["voice"]) ? $context["voice"] : $this->getContext($context, "voice")), "payMethodProviderHasCountry", array()), "currency", array()), "symbol", array()))), "html", null, true);
        echo "
            </div>
        </div>
    </div>


";
        
        $__internal_7fa62a0d8337f862551e79eb6317e232536cc4147918c90122d2e4416c6927da->leave($__internal_7fa62a0d8337f862551e79eb6317e232536cc4147918c90122d2e4416c6927da_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PaymentHosted/NviaPayMethods/Voice:logicVoVtCode.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 50,  135 => 44,  130 => 42,  124 => 39,  116 => 34,  111 => 32,  99 => 25,  92 => 21,  86 => 18,  82 => 17,  77 => 15,  71 => 14,  66 => 11,  60 => 10,  51 => 8,  45 => 5,  41 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends '@App/PaymentHosted/NviaPayMethods/layout_nvia_methods.html.twig' %}*/
/* {% block stylesheets %}*/
/*     <style>*/
/*         .container{*/
/*             background: url({{asset('bundles/app/app_shop/img/nvia_pay_methods/telephone_operator.jpg')}}) no-repeat top right;*/
/*         }*/
/*     </style>*/
/*     {{ parent() }}*/
/* {% endblock %}*/
/* {% block page %}*/
/* */
/*     <div class="row voffset3">*/
/*         <div class="col-md-12">*/
/*             <h1>{{ 'voice.logic_vo_vt_code.title' | trans }} <img src="{% path voice.payMethodProviderHasCountry.payMethodHasProvider.payMethod.imgIcon, 'shop' %}"></h1>*/
/*             <h3>{{'voice.follow_instructions' | trans }}</h3>*/
/*             <blockquote class="voffset3">*/
/*                 <span class="text-info">{{ 'voice.logic_vo_vt_code.step_1' | trans }}.</span>*/
/*                 {{ 'voice.logic_vo_vt_code.step_1_desc' | trans({'%article%' : articleName }) | raw}}*/
/*             </blockquote>*/
/*             <div class="voffset4">*/
/*                 <h3>{{ 'voice.logic_vo_vt_code.sing_up_text' | trans({'%number%' : '<span class="text-info">' ~ voice.number ~ '</span>'}) | raw }}</h3>*/
/*             </div>*/
/*             <div>*/
/*                 <blockquote>*/
/*                     <span class="text-info">{{ 'voice.logic_vo_vt_code.step_2' | trans }}.</span> {{ 'voice.logic_vo_vt_code.step_2_desc' | trans }}*/
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
/* */
/*                         {{ form_rest(form) }}*/
/*                     </form>*/
/*                     <div class="text-danger">{{ form_errors(form) }}</div>*/
/*                 </div>*/
/* */
/*             </div>*/
/* */
/*             <div class="voffset5">*/
/*                 {{ 'voice.logic_vo_vt_code.legal_text' | trans({'%amount%' : voice.amount, '%number%' : voice.number, '%currency%' : voice.payMethodProviderHasCountry.currency.symbol}) }}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/* {% endblock %}*/
