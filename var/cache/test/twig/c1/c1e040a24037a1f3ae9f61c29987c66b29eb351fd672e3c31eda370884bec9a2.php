<?php

/* AppBundle:AppShop/Shop/partials:shop_body.html.twig */
class __TwigTemplate_9707758626ccf146fb24a53bcd1f3cf16506476b083c0384e8d428a2cb3da905 extends Twig_Template
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
        $__internal_2408bbebd03b56adcb4ba89bbd52d31a8cfb3cccff08b23cc6e10fc5e73db189 = $this->env->getExtension("native_profiler");
        $__internal_2408bbebd03b56adcb4ba89bbd52d31a8cfb3cccff08b23cc6e10fc5e73db189->enter($__internal_2408bbebd03b56adcb4ba89bbd52d31a8cfb3cccff08b23cc6e10fc5e73db189_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:shop_body.html.twig"));

        // line 1
        echo "<div data-ng-controller=\"ActionsCtrl\" ng-class=\"{'has-mouse': device.hasMouse }\" class=\"wolo-container background font\" >
    <div class=\"ready\" style=\"visibility: hidden\">
        ";
        // line 3
        echo (isset($context["box_windows"]) ? $context["box_windows"] : $this->getContext($context, "box_windows"));
        echo "

        <div class=\"tooltip \"  id=\"tooltip\" >
            <div class=\"tooltip-content\"></div>
        </div>
        <div id=\"msg-container\" data-ng-controller=\"MessagesCtrl\" class=\"\"  >
            <div data-ng-repeat=\"error in errors\" class=\"error fade\">
                <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\"  ng-click=\"removeError(error)\">
                {[{ error.msg | translate }]}
            </div>
            <div data-ng-repeat=\"info in infos\" class=\"info fade\">
                <img src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-click=\"removeInfo(error)\">
                {[{ info.msg | translate }]}
            </div>
            <div data-ng-repeat=\"warning in warnings\" class=\"warning fade\">
                <img src=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-click=\"removeWarning(error)\">
                {[{ warning.msg | translate }]}
            </div>
        </div>

        <div class=\"header\" id=\"header\"></div>

        <div id=\"wrapper\" class=\"\"  >
            <div id=\"iframe-box\">
                <div id=\"iframe-overlay\">
                    <img src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/wolopay.gif", null, true)), "html", null, true);
        echo "\" width=\"100\" height=\"100\">
                    <span>&spades; Loading &spades;</span>
                </div>
                <iframe id=\"iframe\" src=\"\" wmode=\"transparent\"></iframe>

                <div class=\"top\">
                    <div class=\"center\"></div>
                    <div class=\"left\"><img src=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ></div>
                    <div class=\"right\"><img src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ></div>
                    <div class=\"close\"><img src=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\"  ng-click=\"closeIframe()\"></div>
                </div>
                <div id=\"iframe-box-content\" >
                    <div class=\"side-left\"><div></div></div>
                    <div class=\"side-right\"><div></div></div>
                </div>
                <div class=\"bottom\">
                    <div class=\"center\"></div>
                    <div class=\"left\"><img src=\"";
        // line 45
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ></div>
                    <div class=\"right\"><img src=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ></div>
                </div>

            </div>

            <div id=\"tab-menu\" data-ng-controller=\"MenuListCtrl\">
                <div id=\"top-options\">
                    ";
        // line 53
        echo (isset($context["top_options"]) ? $context["top_options"] : $this->getContext($context, "top_options"));
        echo "
                    <div class=\"tab-mock languages\" ng-if=\"!\$root.options.fixedLanguage\">

                        <select id=\"input-language\" ng-model=\"current.language\" data-ng-change=\"switchLanguage()\" chosen ng-options=\"language.local_name for language in current.languages track by language.id\">
                        </select>

                    </div>
                </div>

                ";
        // line 62
        echo (isset($context["menu"]) ? $context["menu"] : $this->getContext($context, "menu"));
        echo "

            </div>

            <div id=\"container-main\">
                <div data-ng-controller=\"TransactionStatusCtrl\">
                    <div ng-include=\"asset('/bundles/app/app_shop/js/views/partials/gacha_animations/gacha_box.html')\"></div>
                    ";
        // line 69
        echo twig_include($this->env, $context, "@App/AppShop/Shop/partials/completed_box.html.twig");
        echo "
                    ";
        // line 70
        echo twig_include($this->env, $context, "@App/AppShop/Shop/partials/expired_box.html.twig");
        echo "
                    ";
        // line 71
        echo twig_include($this->env, $context, "@App/AppShop/Shop/partials/pending_box.html.twig");
        echo "
                </div>

                ";
        // line 74
        echo (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page"));
        echo "

            </div>
            <div id=\"footer\" data-ng-controller=\"FooterCtrl\">
                <ul>
                    <li ng-click=\"legalTerms()\">{[{ 'footer.legal_terms' | translate }]}</li>
                    <li ng-click=\"askCenter()\">{[{ 'footer.support_center' | translate }]}</li>
                    <li ng-click=\"faq()\">{[{ 'footer.faq' | translate }]}</li>
                    ";
        // line 82
        echo (isset($context["extra_footer"]) ? $context["extra_footer"] : $this->getContext($context, "extra_footer"));
        echo "
                    <li ng-click=\"gamerUpdateData()\" class=\"user\"><img src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/gamer.png")), "html", null, true);
        echo "\"></li>
                </ul>
                <div><img src=\"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/icon_rapidssl.gif")), "html", null, true);
        echo "\" width=\"90\" height=\"50\"></div>
            </div>
        </div>
    </div>
</div>

";
        
        $__internal_2408bbebd03b56adcb4ba89bbd52d31a8cfb3cccff08b23cc6e10fc5e73db189->leave($__internal_2408bbebd03b56adcb4ba89bbd52d31a8cfb3cccff08b23cc6e10fc5e73db189_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials:shop_body.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 85,  157 => 83,  153 => 82,  142 => 74,  136 => 71,  132 => 70,  128 => 69,  118 => 62,  106 => 53,  96 => 46,  92 => 45,  81 => 37,  77 => 36,  73 => 35,  63 => 28,  50 => 18,  43 => 14,  36 => 10,  26 => 3,  22 => 1,);
    }
}
/* <div data-ng-controller="ActionsCtrl" ng-class="{'has-mouse': device.hasMouse }" class="wolo-container background font" >*/
/*     <div class="ready" style="visibility: hidden">*/
/*         {{ box_windows | raw }}*/
/* */
/*         <div class="tooltip "  id="tooltip" >*/
/*             <div class="tooltip-content"></div>*/
/*         </div>*/
/*         <div id="msg-container" data-ng-controller="MessagesCtrl" class=""  >*/
/*             <div data-ng-repeat="error in errors" class="error fade">*/
/*                 <img src="{{ absolute_url(asset('/img/1x1.png')) }}"  ng-click="removeError(error)">*/
/*                 {[{ error.msg | translate }]}*/
/*             </div>*/
/*             <div data-ng-repeat="info in infos" class="info fade">*/
/*                 <img src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-click="removeInfo(error)">*/
/*                 {[{ info.msg | translate }]}*/
/*             </div>*/
/*             <div data-ng-repeat="warning in warnings" class="warning fade">*/
/*                 <img src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-click="removeWarning(error)">*/
/*                 {[{ warning.msg | translate }]}*/
/*             </div>*/
/*         </div>*/
/* */
/*         <div class="header" id="header"></div>*/
/* */
/*         <div id="wrapper" class=""  >*/
/*             <div id="iframe-box">*/
/*                 <div id="iframe-overlay">*/
/*                     <img src="{{ absolute_url(asset('img/wolopay.gif', absolute=true)) }}" width="100" height="100">*/
/*                     <span>&spades; Loading &spades;</span>*/
/*                 </div>*/
/*                 <iframe id="iframe" src="" wmode="transparent"></iframe>*/
/* */
/*                 <div class="top">*/
/*                     <div class="center"></div>*/
/*                     <div class="left"><img src="{{ absolute_url(asset('/img/1x1.png')) }}" ></div>*/
/*                     <div class="right"><img src="{{ absolute_url(asset('/img/1x1.png')) }}" ></div>*/
/*                     <div class="close"><img src="{{ absolute_url(asset('/img/1x1.png')) }}"  ng-click="closeIframe()"></div>*/
/*                 </div>*/
/*                 <div id="iframe-box-content" >*/
/*                     <div class="side-left"><div></div></div>*/
/*                     <div class="side-right"><div></div></div>*/
/*                 </div>*/
/*                 <div class="bottom">*/
/*                     <div class="center"></div>*/
/*                     <div class="left"><img src="{{ absolute_url(asset('/img/1x1.png')) }}" ></div>*/
/*                     <div class="right"><img src="{{ absolute_url(asset('/img/1x1.png')) }}" ></div>*/
/*                 </div>*/
/* */
/*             </div>*/
/* */
/*             <div id="tab-menu" data-ng-controller="MenuListCtrl">*/
/*                 <div id="top-options">*/
/*                     {{ top_options | raw }}*/
/*                     <div class="tab-mock languages" ng-if="!$root.options.fixedLanguage">*/
/* */
/*                         <select id="input-language" ng-model="current.language" data-ng-change="switchLanguage()" chosen ng-options="language.local_name for language in current.languages track by language.id">*/
/*                         </select>*/
/* */
/*                     </div>*/
/*                 </div>*/
/* */
/*                 {{ menu | raw }}*/
/* */
/*             </div>*/
/* */
/*             <div id="container-main">*/
/*                 <div data-ng-controller="TransactionStatusCtrl">*/
/*                     <div ng-include="asset('/bundles/app/app_shop/js/views/partials/gacha_animations/gacha_box.html')"></div>*/
/*                     {{ include('@App/AppShop/Shop/partials/completed_box.html.twig') }}*/
/*                     {{ include('@App/AppShop/Shop/partials/expired_box.html.twig') }}*/
/*                     {{ include('@App/AppShop/Shop/partials/pending_box.html.twig') }}*/
/*                 </div>*/
/* */
/*                 {{ page | raw }}*/
/* */
/*             </div>*/
/*             <div id="footer" data-ng-controller="FooterCtrl">*/
/*                 <ul>*/
/*                     <li ng-click="legalTerms()">{[{ 'footer.legal_terms' | translate }]}</li>*/
/*                     <li ng-click="askCenter()">{[{ 'footer.support_center' | translate }]}</li>*/
/*                     <li ng-click="faq()">{[{ 'footer.faq' | translate }]}</li>*/
/*                     {{ extra_footer | raw }}*/
/*                     <li ng-click="gamerUpdateData()" class="user"><img src="{{ absolute_url(asset('bundles/app/app_shop/img/gamer.png'))}}"></li>*/
/*                 </ul>*/
/*                 <div><img src="{{ absolute_url(asset('bundles/app/app_shop/img/icon_rapidssl.gif'))}}" width="90" height="50"></div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* */
/* */
