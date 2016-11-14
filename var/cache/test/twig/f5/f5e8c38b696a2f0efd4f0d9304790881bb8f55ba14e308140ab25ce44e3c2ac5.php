<?php

/* AppBundle:AppShop/Shop:index.html.twig */
class __TwigTemplate_b06c19dff79f660c6433d333fd255beb721410721759b3d819b2e184715c8863 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'top_options' => array($this, 'block_top_options'),
            'box_windows' => array($this, 'block_box_windows'),
            'page' => array($this, 'block_page'),
            'extra_footer' => array($this, 'block_extra_footer'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 2
        return $this->loadTemplate(((array_key_exists("htmlTemplate", $context)) ? ("@App/AppShop/Shop/widget/shop_only_html.html.twig") : ("@App/AppShop/layout_shop.html.twig")), "AppBundle:AppShop/Shop:index.html.twig", 2);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_62edd737e1b4aa2ba7df4c7427d0406f602af9bb8acdeaf08f4ba243b9551d60 = $this->env->getExtension("native_profiler");
        $__internal_62edd737e1b4aa2ba7df4c7427d0406f602af9bb8acdeaf08f4ba243b9551d60->enter($__internal_62edd737e1b4aa2ba7df4c7427d0406f602af9bb8acdeaf08f4ba243b9551d60_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop:index.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_62edd737e1b4aa2ba7df4c7427d0406f602af9bb8acdeaf08f4ba243b9551d60->leave($__internal_62edd737e1b4aa2ba7df4c7427d0406f602af9bb8acdeaf08f4ba243b9551d60_prof);

    }

    // line 4
    public function block_menu($context, array $blocks = array())
    {
        $__internal_0d8bfd25a0a15be7c225e3d363af03e65f92c71860781703e988d94539df4047 = $this->env->getExtension("native_profiler");
        $__internal_0d8bfd25a0a15be7c225e3d363af03e65f92c71860781703e988d94539df4047->enter($__internal_0d8bfd25a0a15be7c225e3d363af03e65f92c71860781703e988d94539df4047_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 5
        echo "
    <div class=\"article-tab\" data-ng-controller=\"ArticleTabCtrl\" ng-style=\"{'visibility': \$root.current.walletOpen ? 'hidden':'visible'}\">
        <div id=\"cat-{[{articleTab.app_tab.name_unique}]}\" class=\"tab\" data-ng-repeat=\"articleTab in current.articleTabs\" ng-class=\"current.articleTab.id == articleTab.id ? 'tab-on' : 'tab-off'\" data-ng-click=\"switchArticleTab(articleTab)\">
            <span ng-if=\"(\$root.isModule || (!\$root.isModule && !articleTab.app_tab.image.img )) && articleTab.app_tab.name_label.key\">
                {[{ articleTab.app_tab.name_label.key | translate }]}
            </span>
            <img class=\"tab-icon\" src=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-src=\"{[{ asset(articleTab.app_tab.image.img) }]}\" ng-if=\"articleTab.app_tab.image\"/>
            <div ng-if=\"articleTab.app_tab.description_label.key\">
                <div tooltip class=\"tooltip\">
                    <span translate=\"{[{ articleTab.app_tab.description_label.key }]}\"></span>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_0d8bfd25a0a15be7c225e3d363af03e65f92c71860781703e988d94539df4047->leave($__internal_0d8bfd25a0a15be7c225e3d363af03e65f92c71860781703e988d94539df4047_prof);

    }

    // line 21
    public function block_top_options($context, array $blocks = array())
    {
        $__internal_d20c45374d263352f4ddbf8120aa53c54d06114421863ed903d921646cb1afa8 = $this->env->getExtension("native_profiler");
        $__internal_d20c45374d263352f4ddbf8120aa53c54d06114421863ed903d921646cb1afa8->enter($__internal_d20c45374d263352f4ddbf8120aa53c54d06114421863ed903d921646cb1afa8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "top_options"));

        // line 22
        echo "    <div class=\"tab-mock countries\" ng-if=\"!current.fixedCountry\" >

        <select id=\"input-country\" ng-model=\"current.country\" data-ng-change=\"changeCountry()\" chosen ng-options=\"country.local_name for country in current.countries track by country.id\" style=\"width: 100%;\">
        </select>

    </div>

";
        
        $__internal_d20c45374d263352f4ddbf8120aa53c54d06114421863ed903d921646cb1afa8->leave($__internal_d20c45374d263352f4ddbf8120aa53c54d06114421863ed903d921646cb1afa8_prof);

    }

    // line 31
    public function block_box_windows($context, array $blocks = array())
    {
        $__internal_995cef03f5e61edaca6e57cd40f48ce0edbd990b6e8461a4ea8a837c230de4da = $this->env->getExtension("native_profiler");
        $__internal_995cef03f5e61edaca6e57cd40f48ce0edbd990b6e8461a4ea8a837c230de4da->enter($__internal_995cef03f5e61edaca6e57cd40f48ce0edbd990b6e8461a4ea8a837c230de4da_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "box_windows"));

        // line 32
        echo "
    <div data-ng-controller=\"PayMethodsFixedAmountCtrl\" data-ng-if=\"current.state == 'select_pay_method_fixed_amount'\" class=\" box-window-container\" >
        <div data-ng-if=\"selectSayMethodFixedAmount\" >
            <div class=\"box-window-background\"></div>
            <div id=\"sms-operator\" class=\"box-window\"  >
                <div class=\"container\">
                    <div class=\"close\" data-ng-click=\"close()\"></div>
                    <h3>{[{ 'sms.select_operator.title' | translate }]}</h3>

                    <div class=\"content\">
                        <div class=\"list\">
                            <div ng-class=\"{'selected': current.payMethodFixedAmount.id == payMethodFixed.id }\" data-ng-repeat=\"payMethodFixed in current.payMethodFixedAmounts\" ng-click=\"selectPayMethodFixed(payMethodFixed)\">
                                <img id=\"sms-operator-{[{ payMethodFixed.operator.short_name }]}\" src=\"";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/1x1.png"), "html", null, true);
        echo "\" ng-src=\"{[{ asset(payMethodFixed.operator.img) }]}\" alt=\"{[{payMethodFixed.operator.name}]}\"  >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div  data-ng-if=\"current.inProvider==true\" class=\" box-window-container\" >

        <div class=\"box-window-background\"></div>
        <div id=\"waiting-payment\" class=\"box-window \" >
            <div class=\"container\">
                <div class=\"close\" data-ng-click=\"current.inProvider=false\" ></div>
                <h3>{[{ 'waiting_payment_confirmation' | translate }]}</h3>
                <div style=\"margin: 40px 0 50px; \">
                    <div style=\"font-size: 1.4em\">{[{ 'waiting_payment_confirmation_desc' | translate }]}</div>
                    <div style=\"text-align: center; margin-top: 30px; background: #fff; border: 2px solid #000;border-radius: 100px; display: inline-block;\">
                        <img src=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/wolopay.gif")), "html", null, true);
        echo "\">
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div data-ng-controller=\"FeedbackCtrl\" class=\" \"  >
        <div data-ng-if=\"feedback\" class=\"box-window-container\">
            <div class=\"box-window-background\"></div>
            <div id=\"feedback\" class=\"box-window\" >

                <div class=\"container\">
                    <div class=\"close\" data-ng-click=\"\$root.feedback = false\" ></div>
                    <h3>{[{ 'feedback.title_window' | translate }]}</h3>
                    <div class=\"content\">
                        <form ng-submit=\"send()\">
                            <h4 style=\"margin-top: 10px\">{[{ 'feedback.select_a_main_problem' | translate }]}</h4>
                            <table>
                                <tr data-ng-repeat=\"reason in reasonTypes\">
                                    <td><img ng-src=\"{[{ '/bundles/app/app_shop/img/icons/feedback/' + reason.img }]}\"> <input type=\"radio\" id=\"reason_type_{[{reason.id}]}\" required name=\"reason_type\" ng-model=\"\$parent.\$parent.reasonType\" ng-value=\"reason\"></td>
                                    <td><label for=\"reason_type_{[{reason.id}]}\"> {[{ 'feedback.options.'+reason.id | translate }]}</label> </td>
                                </tr>
                            </table>

                            <div ng-if=\"reasonType.id == 'it_crash_on_pay'\">
                                <h4>{[{ 'feedback.select_the_pay_method_u_will_pay' | translate }]}</h4>
                                <div data-ng-repeat=\"filterByTabs in payMethods | unique:'tab_category'\">

                                    <h5>{[{ filterByTabs.tab_category.name }]}</h5>
                                    <span data-ng-repeat=\"pm in payMethods | unique:'id' | filter: { tab_category: filterByTabs.tab_category }\">
                                        <input type=\"checkbox\" ng-model=\"pm.active\">
                                        <img ng-src=\"{[{asset(pm.img)}]}\" width=\"50\" height=\"30\" ng-click=\"pm.active=true\">
                                    </span>

                                </div>
                            </div>

                            <div ng-if=\"reasonType.id == 'i_didnt_found_a_valid_payment_method'\">
                                <h4>{[{ 'feedback.pay_method_u_will_pay' | translate }]}</h4>
                                <textarea ng-model=\"\$parent.\$parent.pay_method_u_will_be_paid\">{[{reasonType.id}]}</textarea>
                            </div>

                            <div>
                                <h4>{[{ 'feedback.suggestion' | translate }]}</h4>
                                <textarea ng-model=\"\$parent.suggestion\"></textarea>
                            </div>
                            <button type=\"submit\">{[{ 'feedback.send' | translate }]}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div data-ng-if=\"current.state == 'write_a_valid_code'\"   data-ng-controller=\"PromoCodeCtrl\" class=\"box-window-container\">
        <div class=\"box-window-background\"></div>
        <div id=\"promo-code\" class=\"box-window fade \" >
            <div class=\"container\">
                <div class=\"close\" data-ng-click=\"close()\"></div>
                <h3>{[{ 'promo_code.title' | translate }]}</h3>

                <div class=\"content\">
                    <form ng-submit=\"submit()\">
                        <input type=\"text\" id=\"promo-code-input\" ng-model=\"code\" placeholder=\"{[{ 'promo_code.title' | translate }]}\"> <input type=\"submit\" value=\"{[{ 'promo_code.submit' | translate }]}\">
                    </form>
                    <div ng-if=\"current.code\">
                        ";
        // line 135
        echo "                        ";
        // line 136
        echo "                    </div>
                </div>
            </div>
        </div>
    </div>


    <div data-ng-if=\"current.tutorialEnabled\" class=\"fade\" data-ng-controller=\"TutorialCtrl\">
        <div id=\"arrow-box\">
            <img id=\"arrow\" src=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" >
            <div>{[{ text | translate : '{code : current.tutorialPromoCode}' }]}</div>
        </div>
    </div>
";
        
        $__internal_995cef03f5e61edaca6e57cd40f48ce0edbd990b6e8461a4ea8a837c230de4da->leave($__internal_995cef03f5e61edaca6e57cd40f48ce0edbd990b6e8461a4ea8a837c230de4da_prof);

    }

    // line 151
    public function block_page($context, array $blocks = array())
    {
        $__internal_a10ce4561ff4a113104964570e2b1900f1fc553e5ba972b526dff8d3f18704d7 = $this->env->getExtension("native_profiler");
        $__internal_a10ce4561ff4a113104964570e2b1900f1fc553e5ba972b526dff8d3f18704d7->enter($__internal_a10ce4561ff4a113104964570e2b1900f1fc553e5ba972b526dff8d3f18704d7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 152
        echo "
    <div class=\"section\" id=\"section_1\">
        <div class=\"section-custom\">
            <div class=\"section-products-paymethods ";
        // line 155
        if ($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "app", array()), "walletIsEnabled", array())) {
            echo "wallet_enabled";
        }
        echo "\">
                <div class=\"before-first\">
                    <div class=\"left\"></div>
                    <div class=\"rigth\"></div>
                </div>
                <div ng-if=\"firstPayMethods\" class=\"height-animation\">
                    <div ng-include=\"asset('/bundles/app/app_shop/js/views/partials/pay_methods_list.html')\" ></div>
                    <div class=\"before-second\"><div class=\"left\"></div><div class=\"right\"></div></div>
                    <div ng-include=\"asset('/bundles/app/app_shop/js/views/partials/products_list.html')\"></div>
                </div>

                <div ng-if=\"!firstPayMethods\" class=\"height-animation\">
                    <div ng-include=\"asset('/bundles/app/app_shop/js/views/partials/products_list.html')\"></div>
                    <div class=\"before-second\"><div class=\"left\"></div><div class=\"right\"></div></div>
                    <div ng-include=\"asset('/bundles/app/app_shop/js/views/partials/pay_methods_list.html')\"></div>
                </div>
                <div class=\"before-register\">
                    <div class=\"left\"></div>
                    <div class=\"rigth\"></div>
                </div>
            </div>

            <div class=\"register-cash\" data-ng-controller=\"RegisterCashCtrl\">

                <div class=\"box-product-selected\">
                    <div data-ng-if=\"\$root.current.walletOpen \">
                        <div class=\"product-selected\">
                            <div ng-if=\"\$root.options.walletConf.wallet_in_real_money\">
                                <span id=\"total_amount\">{[{ \$root.current.newDeposit.amount | currency : \$root.current.country.currency.symbol : \$root.current.country.currency.decimal_places }]}</span>
                                <span class=\"currency_id\">({[{ \$root.current.country.currency.id }]})</span>
                            </div>
                            <div ng-if=\"!\$root.options.walletConf.wallet_in_real_money\">
                                <span id=\"total_amount\">{[{ calculateVirtualAmount(current.newDeposit.amountVirtual) | currency : \$root.current.country.currency.symbol : \$root.current.country.currency.decimal_places }]}</span>
                                <span class=\"currency_id\">({[{ \$root.current.country.currency.id }]})</span>
                            </div>
                        </div>
                    </div>
                    <div data-ng-if=\"!\$root.current.walletOpen \">

                        <div class=\"product-selected\" data-ng-if=\"\$root.current.real_cart_price.articles_quantity > 0 && current.articlePMPCA\">
                            <div>
                                <span id=\"total_amount\">{[{ \$root.current.real_cart_price.amount | currency : \$root.current.real_cart_price.currency.symbol : \$root.current.real_cart_price.currency.decimal_places }]}</span>  <span class=\"currency_id\">({[{ \$root.current.real_cart_price.currency.id }]})</span>
                            </div>
                        </div>
                        <div class=\"product-selected\" data-ng-if=\"current.appShopHasArticle != null  && current.articlePMPCA != null\">
                            <div data-ng-if=\"current.appShopHasArticle.amount !== null && current.appShopHasArticle.amount_range == null && !current.articlePMPCA.temp_force_price\">
                                <span id=\"total_amount\">{[{ current.appShopHasArticle.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                                <span ng-include=\"asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')\" ng-init=\"separator=true; periodicity = current.appShopHasArticle.article.periodicity\"></span>
                            </div>
                            <div data-ng-if=\"current.appShopHasArticle.amount === null && current.articlePMPCA.voice.amount != null && !current.articlePMPCA.temp_force_price \">
                                <span id=\"total_amount\">{[{ current.articlePMPCA.voice.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                                <span ng-include=\"asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')\" ng-init=\"separator=true; periodicity = current.appShopHasArticle.article.periodicity\"></span>
                            </div>
                            <div data-ng-if=\"current.appShopHasArticle.amount_range && current.payMethodFixedAmount == null && current.articlePMPCA.pay_category.id == 'mobile' && !current.articlePMPCA.temp_force_price \">
                                <span id=\"total_amount\">{[{ current.appShopHasArticle.amount_range.min | number }]} - {[{ current.appShopHasArticle.amount_range.max | number }]} </span> {[{ current.appShopHasArticle.local_currency.symbol }]} <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                            </div>
                            <div data-ng-if=\"current.appShopHasArticle.amount_range && current.payMethodFixedAmount != null && current.articlePMPCA.pay_category.id == 'mobile' && !current.articlePMPCA.temp_force_price \">
                                <span id=\"total_amount\">{[{ current.payMethodFixedAmount.amount | currency : appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                            </div>
                            ";
        // line 215
        echo "                            <div data-ng-if=\"current.articlePMPCA.temp_force_price\">
                                <span id=\"total_amount\">{[{ current.articlePMPCA.temp_force_price | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places}]}</span>  <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                                <span ng-include=\"asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')\" ng-init=\"separator=true; periodicity = current.appShopHasArticle.article.periodicity\"></span>
                            </div>
                            <div data-ng-if=\"!current.articlePMPCA.temp_force_price && current.appShopHasArticle.amount_range && current.articlePMPCA.pay_category.id != 'mobile'\">
                                <span id=\"total_amount\" ng-if=\"current.appShopHasArticle.offer.amount\">{[{ current.appShopHasArticle.offer.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>
                                <span id=\"total_amount\" ng-if=\"!current.appShopHasArticle.offer.amount\">{[{ current.appShopHasArticle.current_amount_without_offer | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places}]}</span>
                                <span class=\"currency_id\">({[{ current.appShopHasArticle.local_currency.id }]})</span>
                            </div>
                        </div>

                        <div class=\"product-selected\" data-ng-if=\"(current.appShopHasArticle != null || current.cart.length > 0) && current.articlePMPCA == null\">
                            {[{ 'select_paymethod' | translate }]}
                        </div>
                        <div class=\"product-selected\" data-ng-if=\"current.appShopHasArticle == null && current.cart.length == 0\">
                            {[{ 'select_article' | translate }]}
                        </div>
                    </div>
                </div>
                <div id=\"button-actions\">
                    <div class=\"left\">
                        <div class=\"cart\" ng-if=\"\$root.hasCart && !\$root.current.walletOpen\">
                            <span><b>{[{ \$root.current.real_cart_price.articles_quantity || '0' }]}</b></span>
                            <img src=\"";
        // line 238
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-click=\"\$root.cartOpen = true\">
                        </div>
                        <div class=\"cart-summary\" ng-controller=\"ShoppingCartCtrl\" ng-if=\"cartOpen && !\$root.current.walletOpen\">
                            <div class=\"close\" data-ng-click=\"\$root.cartOpen = false\"></div>
                            <div ng-if=\"current.cart.length <= 0\" style=\"text-align: center\">
                                <span translate=\"cart.empty\"></span>
                            </div>
                            <div ng-if=\"\$root.hasCart && \$root.current.cart.length > 0\">
                                <h2 translate=\"cart.title\"></h2>
                                <table>
                                    <tbody>
                                    <tr ng-repeat=\"paymentDetailHasArticle in \$root.current.real_cart_price.payment_detail_has_articles\">
                                        <td class=\"count\" translate=\"units\" translate-values=\"{[{ {units: (paymentDetailHasArticle.articles_quantity) } }]}\"></td>
                                        <td class=\"num\">{[{ paymentDetailHasArticle.amount | currency : \$root.current.real_cart_price.currency.symbol : \$root.current.real_cart_price.currency.decimal_places }]}</td>
                                        <td>
                                            <span class=\"btn-plus\" ng-if=\"addCartVisible(getAppShopHasArticleFromCart(paymentDetailHasArticle.id))\" ng-click=\"addCart(getAppShopHasArticleFromCart(paymentDetailHasArticle.id), \$event)\">+</span>
                                            <span class=\"btn-minus\" ng-click=\"removeCart(getAppShopHasArticleFromCart(paymentDetailHasArticle.id), \$event)\">-</span>
                                        </td>

                                        <td>
                                            <span translate=\"{[{(getAppShopHasArticleFromCart(paymentDetailHasArticle.id)).name_label.key}]}\" translate-values=\"{[{ {number: (paymentDetailHasArticle.items_quantity | number) } }]}\"></span>
                                            <span ng-if=\"!(getAppShopHasArticleFromCart(paymentDetailHasArticle.id)).name_label.key\" translate=\"{[{ paymentDetailHasArticle.name_label.key }]}\" translate-values=\"{[{ {number: (paymentDetailHasArticle.items_quantity | number) } }]}\"></span>
                                        </td>
                                        <td class=\"num\">+ {[{ (paymentDetailHasArticle.amount * paymentDetailHasArticle.articles_quantity) | currency : \$root.current.real_cart_price.currency.symbol : \$root.current.real_cart_price.currency.decimal_places }]}</td>
                                    </tr>

                                    <tr ng-repeat=\"extraCost in \$root.current.real_cart_price.payment_detail_extra_costs\">
                                        <td colspan=\"3\"></td>
                                        <td style=\"padding: 10px 4px\">{[{ extraCost.name }]}</td>
                                        <td class=\"num\">+ {[{ extraCost.amount | currency: extraCost.currency.symbol : extraCost.currency.decimal_places }]}</td>
                                    </tr>

                                    </tbody>
                                    <tfoot>
                                    <tr>

                                        <td colspan=\"4\" class=\"clear-cart\">
                                            <button type=\"button\" translate=\"cart.clear\" ng-click=\"clearCart()\"></button>
                                        </td>

                                        <td class=\"total num\">
                                            {[{ \$root.current.real_cart_price.amount | currency : \$root.current.real_cart_price.currency.symbol : \$root.current.real_cart_price.currency.decimal_places }]}</span>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class=\"mid\" ng-class=\"{'disabled': !isReady(), 'continue': isReady() }\">
                        <div class=\"pay-button\" ng-click=\"buy()\" >
                            <div class=\"pay-button-text\">{[{ 'continue' | translate }]}</div>
                        </div>
                    </div>
                    <div class=\"right\">
                        <div class=\"wallet\" ng-if=\"\$root.options.walletConf.wallet_is_enabled\">
                            <div class=\"circle\">
                                <img src=\"";
        // line 295
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\">
                            </div>
                            <div class=\"actions\">
                                <span class=\"btn-plus\" ng-click=\"toggleWallet()\">
                                    {[{ 'wallet.deposit_money' | translate }]}
                                </span>
                            </div>
                            <div class=\"amount\">
                                <div ng-if=\"\$root.options.walletConf.wallet_in_real_money\">
                                    <span>{[{ \$root.options.gamerWallet.amount_in_real_money | currency : (\$root.options.gamerWallet.currencyReal.symbol || \$root.current.real_cart_price.currency.symbol ) : (\$root.options.gamerWallet.currencyReal.decimal_places || \$root.current.real_cart_price.currency.decimal_places)  }]}</span>
                                </div>
                                <div ng-if=\"!\$root.options.walletConf.wallet_in_real_money\">
                                    <span>{[{ \$root.options.gamerWallet.amount_in_virtual_money | currency :\$root.options.walletConf.wallet_virtual_money_symbol  }]}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_a10ce4561ff4a113104964570e2b1900f1fc553e5ba972b526dff8d3f18704d7->leave($__internal_a10ce4561ff4a113104964570e2b1900f1fc553e5ba972b526dff8d3f18704d7_prof);

    }

    // line 319
    public function block_extra_footer($context, array $blocks = array())
    {
        $__internal_6280729f397a1f99680576388fdce4180c1d0f422bd095d3e94de802b8eb78b7 = $this->env->getExtension("native_profiler");
        $__internal_6280729f397a1f99680576388fdce4180c1d0f422bd095d3e94de802b8eb78b7->enter($__internal_6280729f397a1f99680576388fdce4180c1d0f422bd095d3e94de802b8eb78b7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "extra_footer"));

        // line 320
        echo "    <li ng-if=\"\$root.current.state !== 'completed'\" data-ng-click=\"current.tutorialEnabled = !current.tutorialEnabled \">{[{ 'footer.tutorial' | translate }]}</li>
    <li data-ng-click=\"\$root.feedback = !\$root.feedback\">{[{ 'footer.feedback' | translate }]}</li>
    <li id=\"coupon_code\" ng-if=\"\$root.current.state !== 'completed'\" data-ng-click=\"current.state = 'write_a_valid_code'\">{[{ 'footer.promo_code' | translate }]}</li>
";
        
        $__internal_6280729f397a1f99680576388fdce4180c1d0f422bd095d3e94de802b8eb78b7->leave($__internal_6280729f397a1f99680576388fdce4180c1d0f422bd095d3e94de802b8eb78b7_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  424 => 320,  418 => 319,  388 => 295,  328 => 238,  303 => 215,  239 => 155,  234 => 152,  228 => 151,  216 => 145,  205 => 136,  203 => 135,  130 => 64,  107 => 44,  93 => 32,  87 => 31,  73 => 22,  67 => 21,  51 => 11,  43 => 5,  37 => 4,  22 => 2,);
    }
}
/* {# transaction \AppBundle\Entity\Transaction #}*/
/* {% extends htmlTemplate is defined ? '@App/AppShop/Shop/widget/shop_only_html.html.twig' : '@App/AppShop/layout_shop.html.twig' %}*/
/* */
/* {% block menu %}*/
/* */
/*     <div class="article-tab" data-ng-controller="ArticleTabCtrl" ng-style="{'visibility': $root.current.walletOpen ? 'hidden':'visible'}">*/
/*         <div id="cat-{[{articleTab.app_tab.name_unique}]}" class="tab" data-ng-repeat="articleTab in current.articleTabs" ng-class="current.articleTab.id == articleTab.id ? 'tab-on' : 'tab-off'" data-ng-click="switchArticleTab(articleTab)">*/
/*             <span ng-if="($root.isModule || (!$root.isModule && !articleTab.app_tab.image.img )) && articleTab.app_tab.name_label.key">*/
/*                 {[{ articleTab.app_tab.name_label.key | translate }]}*/
/*             </span>*/
/*             <img class="tab-icon" src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-src="{[{ asset(articleTab.app_tab.image.img) }]}" ng-if="articleTab.app_tab.image"/>*/
/*             <div ng-if="articleTab.app_tab.description_label.key">*/
/*                 <div tooltip class="tooltip">*/
/*                     <span translate="{[{ articleTab.app_tab.description_label.key }]}"></span>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block top_options %}*/
/*     <div class="tab-mock countries" ng-if="!current.fixedCountry" >*/
/* */
/*         <select id="input-country" ng-model="current.country" data-ng-change="changeCountry()" chosen ng-options="country.local_name for country in current.countries track by country.id" style="width: 100%;">*/
/*         </select>*/
/* */
/*     </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block box_windows %}*/
/* */
/*     <div data-ng-controller="PayMethodsFixedAmountCtrl" data-ng-if="current.state == 'select_pay_method_fixed_amount'" class=" box-window-container" >*/
/*         <div data-ng-if="selectSayMethodFixedAmount" >*/
/*             <div class="box-window-background"></div>*/
/*             <div id="sms-operator" class="box-window"  >*/
/*                 <div class="container">*/
/*                     <div class="close" data-ng-click="close()"></div>*/
/*                     <h3>{[{ 'sms.select_operator.title' | translate }]}</h3>*/
/* */
/*                     <div class="content">*/
/*                         <div class="list">*/
/*                             <div ng-class="{'selected': current.payMethodFixedAmount.id == payMethodFixed.id }" data-ng-repeat="payMethodFixed in current.payMethodFixedAmounts" ng-click="selectPayMethodFixed(payMethodFixed)">*/
/*                                 <img id="sms-operator-{[{ payMethodFixed.operator.short_name }]}" src="{{ asset("img/1x1.png") }}" ng-src="{[{ asset(payMethodFixed.operator.img) }]}" alt="{[{payMethodFixed.operator.name}]}"  >*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/*     <div  data-ng-if="current.inProvider==true" class=" box-window-container" >*/
/* */
/*         <div class="box-window-background"></div>*/
/*         <div id="waiting-payment" class="box-window " >*/
/*             <div class="container">*/
/*                 <div class="close" data-ng-click="current.inProvider=false" ></div>*/
/*                 <h3>{[{ 'waiting_payment_confirmation' | translate }]}</h3>*/
/*                 <div style="margin: 40px 0 50px; ">*/
/*                     <div style="font-size: 1.4em">{[{ 'waiting_payment_confirmation_desc' | translate }]}</div>*/
/*                     <div style="text-align: center; margin-top: 30px; background: #fff; border: 2px solid #000;border-radius: 100px; display: inline-block;">*/
/*                         <img src="{{ absolute_url(asset('img/wolopay.gif')) }}">*/
/*                     </div>*/
/* */
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/* */
/*     </div>*/
/* */
/* */
/*     <div data-ng-controller="FeedbackCtrl" class=" "  >*/
/*         <div data-ng-if="feedback" class="box-window-container">*/
/*             <div class="box-window-background"></div>*/
/*             <div id="feedback" class="box-window" >*/
/* */
/*                 <div class="container">*/
/*                     <div class="close" data-ng-click="$root.feedback = false" ></div>*/
/*                     <h3>{[{ 'feedback.title_window' | translate }]}</h3>*/
/*                     <div class="content">*/
/*                         <form ng-submit="send()">*/
/*                             <h4 style="margin-top: 10px">{[{ 'feedback.select_a_main_problem' | translate }]}</h4>*/
/*                             <table>*/
/*                                 <tr data-ng-repeat="reason in reasonTypes">*/
/*                                     <td><img ng-src="{[{ '/bundles/app/app_shop/img/icons/feedback/' + reason.img }]}"> <input type="radio" id="reason_type_{[{reason.id}]}" required name="reason_type" ng-model="$parent.$parent.reasonType" ng-value="reason"></td>*/
/*                                     <td><label for="reason_type_{[{reason.id}]}"> {[{ 'feedback.options.'+reason.id | translate }]}</label> </td>*/
/*                                 </tr>*/
/*                             </table>*/
/* */
/*                             <div ng-if="reasonType.id == 'it_crash_on_pay'">*/
/*                                 <h4>{[{ 'feedback.select_the_pay_method_u_will_pay' | translate }]}</h4>*/
/*                                 <div data-ng-repeat="filterByTabs in payMethods | unique:'tab_category'">*/
/* */
/*                                     <h5>{[{ filterByTabs.tab_category.name }]}</h5>*/
/*                                     <span data-ng-repeat="pm in payMethods | unique:'id' | filter: { tab_category: filterByTabs.tab_category }">*/
/*                                         <input type="checkbox" ng-model="pm.active">*/
/*                                         <img ng-src="{[{asset(pm.img)}]}" width="50" height="30" ng-click="pm.active=true">*/
/*                                     </span>*/
/* */
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div ng-if="reasonType.id == 'i_didnt_found_a_valid_payment_method'">*/
/*                                 <h4>{[{ 'feedback.pay_method_u_will_pay' | translate }]}</h4>*/
/*                                 <textarea ng-model="$parent.$parent.pay_method_u_will_be_paid">{[{reasonType.id}]}</textarea>*/
/*                             </div>*/
/* */
/*                             <div>*/
/*                                 <h4>{[{ 'feedback.suggestion' | translate }]}</h4>*/
/*                                 <textarea ng-model="$parent.suggestion"></textarea>*/
/*                             </div>*/
/*                             <button type="submit">{[{ 'feedback.send' | translate }]}</button>*/
/*                         </form>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/*     <div data-ng-if="current.state == 'write_a_valid_code'"   data-ng-controller="PromoCodeCtrl" class="box-window-container">*/
/*         <div class="box-window-background"></div>*/
/*         <div id="promo-code" class="box-window fade " >*/
/*             <div class="container">*/
/*                 <div class="close" data-ng-click="close()"></div>*/
/*                 <h3>{[{ 'promo_code.title' | translate }]}</h3>*/
/* */
/*                 <div class="content">*/
/*                     <form ng-submit="submit()">*/
/*                         <input type="text" id="promo-code-input" ng-model="code" placeholder="{[{ 'promo_code.title' | translate }]}"> <input type="submit" value="{[{ 'promo_code.submit' | translate }]}">*/
/*                     </form>*/
/*                     <div ng-if="current.code">*/
/*                         {#<h2>{[{ 'promo_code.title_won' | translate }]}</h2>#}*/
/*                         {#<img src="{{ asset("img/1x1.png") }}" ng-src="{[{ current.code.article.img }]}" >#}*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/*     <div data-ng-if="current.tutorialEnabled" class="fade" data-ng-controller="TutorialCtrl">*/
/*         <div id="arrow-box">*/
/*             <img id="arrow" src="{{ absolute_url(asset('/img/1x1.png')) }}" >*/
/*             <div>{[{ text | translate : '{code : current.tutorialPromoCode}' }]}</div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block page %}*/
/* */
/*     <div class="section" id="section_1">*/
/*         <div class="section-custom">*/
/*             <div class="section-products-paymethods {% if transaction.app.walletIsEnabled %}wallet_enabled{% endif %}">*/
/*                 <div class="before-first">*/
/*                     <div class="left"></div>*/
/*                     <div class="rigth"></div>*/
/*                 </div>*/
/*                 <div ng-if="firstPayMethods" class="height-animation">*/
/*                     <div ng-include="asset('/bundles/app/app_shop/js/views/partials/pay_methods_list.html')" ></div>*/
/*                     <div class="before-second"><div class="left"></div><div class="right"></div></div>*/
/*                     <div ng-include="asset('/bundles/app/app_shop/js/views/partials/products_list.html')"></div>*/
/*                 </div>*/
/* */
/*                 <div ng-if="!firstPayMethods" class="height-animation">*/
/*                     <div ng-include="asset('/bundles/app/app_shop/js/views/partials/products_list.html')"></div>*/
/*                     <div class="before-second"><div class="left"></div><div class="right"></div></div>*/
/*                     <div ng-include="asset('/bundles/app/app_shop/js/views/partials/pay_methods_list.html')"></div>*/
/*                 </div>*/
/*                 <div class="before-register">*/
/*                     <div class="left"></div>*/
/*                     <div class="rigth"></div>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="register-cash" data-ng-controller="RegisterCashCtrl">*/
/* */
/*                 <div class="box-product-selected">*/
/*                     <div data-ng-if="$root.current.walletOpen ">*/
/*                         <div class="product-selected">*/
/*                             <div ng-if="$root.options.walletConf.wallet_in_real_money">*/
/*                                 <span id="total_amount">{[{ $root.current.newDeposit.amount | currency : $root.current.country.currency.symbol : $root.current.country.currency.decimal_places }]}</span>*/
/*                                 <span class="currency_id">({[{ $root.current.country.currency.id }]})</span>*/
/*                             </div>*/
/*                             <div ng-if="!$root.options.walletConf.wallet_in_real_money">*/
/*                                 <span id="total_amount">{[{ calculateVirtualAmount(current.newDeposit.amountVirtual) | currency : $root.current.country.currency.symbol : $root.current.country.currency.decimal_places }]}</span>*/
/*                                 <span class="currency_id">({[{ $root.current.country.currency.id }]})</span>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div data-ng-if="!$root.current.walletOpen ">*/
/* */
/*                         <div class="product-selected" data-ng-if="$root.current.real_cart_price.articles_quantity > 0 && current.articlePMPCA">*/
/*                             <div>*/
/*                                 <span id="total_amount">{[{ $root.current.real_cart_price.amount | currency : $root.current.real_cart_price.currency.symbol : $root.current.real_cart_price.currency.decimal_places }]}</span>  <span class="currency_id">({[{ $root.current.real_cart_price.currency.id }]})</span>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="product-selected" data-ng-if="current.appShopHasArticle != null  && current.articlePMPCA != null">*/
/*                             <div data-ng-if="current.appShopHasArticle.amount !== null && current.appShopHasArticle.amount_range == null && !current.articlePMPCA.temp_force_price">*/
/*                                 <span id="total_amount">{[{ current.appShopHasArticle.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                                 <span ng-include="asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')" ng-init="separator=true; periodicity = current.appShopHasArticle.article.periodicity"></span>*/
/*                             </div>*/
/*                             <div data-ng-if="current.appShopHasArticle.amount === null && current.articlePMPCA.voice.amount != null && !current.articlePMPCA.temp_force_price ">*/
/*                                 <span id="total_amount">{[{ current.articlePMPCA.voice.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                                 <span ng-include="asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')" ng-init="separator=true; periodicity = current.appShopHasArticle.article.periodicity"></span>*/
/*                             </div>*/
/*                             <div data-ng-if="current.appShopHasArticle.amount_range && current.payMethodFixedAmount == null && current.articlePMPCA.pay_category.id == 'mobile' && !current.articlePMPCA.temp_force_price ">*/
/*                                 <span id="total_amount">{[{ current.appShopHasArticle.amount_range.min | number }]} - {[{ current.appShopHasArticle.amount_range.max | number }]} </span> {[{ current.appShopHasArticle.local_currency.symbol }]} <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                             </div>*/
/*                             <div data-ng-if="current.appShopHasArticle.amount_range && current.payMethodFixedAmount != null && current.articlePMPCA.pay_category.id == 'mobile' && !current.articlePMPCA.temp_force_price ">*/
/*                                 <span id="total_amount">{[{ current.payMethodFixedAmount.amount | currency : appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>  <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                             </div>*/
/*                             {# Override all #}*/
/*                             <div data-ng-if="current.articlePMPCA.temp_force_price">*/
/*                                 <span id="total_amount">{[{ current.articlePMPCA.temp_force_price | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places}]}</span>  <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                                 <span ng-include="asset('/bundles/app/app_shop/js/views/partials/article_periodicity.html')" ng-init="separator=true; periodicity = current.appShopHasArticle.article.periodicity"></span>*/
/*                             </div>*/
/*                             <div data-ng-if="!current.articlePMPCA.temp_force_price && current.appShopHasArticle.amount_range && current.articlePMPCA.pay_category.id != 'mobile'">*/
/*                                 <span id="total_amount" ng-if="current.appShopHasArticle.offer.amount">{[{ current.appShopHasArticle.offer.amount | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places }]}</span>*/
/*                                 <span id="total_amount" ng-if="!current.appShopHasArticle.offer.amount">{[{ current.appShopHasArticle.current_amount_without_offer | currency : current.appShopHasArticle.local_currency.symbol : current.appShopHasArticle.local_currency.decimal_places}]}</span>*/
/*                                 <span class="currency_id">({[{ current.appShopHasArticle.local_currency.id }]})</span>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                         <div class="product-selected" data-ng-if="(current.appShopHasArticle != null || current.cart.length > 0) && current.articlePMPCA == null">*/
/*                             {[{ 'select_paymethod' | translate }]}*/
/*                         </div>*/
/*                         <div class="product-selected" data-ng-if="current.appShopHasArticle == null && current.cart.length == 0">*/
/*                             {[{ 'select_article' | translate }]}*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div id="button-actions">*/
/*                     <div class="left">*/
/*                         <div class="cart" ng-if="$root.hasCart && !$root.current.walletOpen">*/
/*                             <span><b>{[{ $root.current.real_cart_price.articles_quantity || '0' }]}</b></span>*/
/*                             <img src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-click="$root.cartOpen = true">*/
/*                         </div>*/
/*                         <div class="cart-summary" ng-controller="ShoppingCartCtrl" ng-if="cartOpen && !$root.current.walletOpen">*/
/*                             <div class="close" data-ng-click="$root.cartOpen = false"></div>*/
/*                             <div ng-if="current.cart.length <= 0" style="text-align: center">*/
/*                                 <span translate="cart.empty"></span>*/
/*                             </div>*/
/*                             <div ng-if="$root.hasCart && $root.current.cart.length > 0">*/
/*                                 <h2 translate="cart.title"></h2>*/
/*                                 <table>*/
/*                                     <tbody>*/
/*                                     <tr ng-repeat="paymentDetailHasArticle in $root.current.real_cart_price.payment_detail_has_articles">*/
/*                                         <td class="count" translate="units" translate-values="{[{ {units: (paymentDetailHasArticle.articles_quantity) } }]}"></td>*/
/*                                         <td class="num">{[{ paymentDetailHasArticle.amount | currency : $root.current.real_cart_price.currency.symbol : $root.current.real_cart_price.currency.decimal_places }]}</td>*/
/*                                         <td>*/
/*                                             <span class="btn-plus" ng-if="addCartVisible(getAppShopHasArticleFromCart(paymentDetailHasArticle.id))" ng-click="addCart(getAppShopHasArticleFromCart(paymentDetailHasArticle.id), $event)">+</span>*/
/*                                             <span class="btn-minus" ng-click="removeCart(getAppShopHasArticleFromCart(paymentDetailHasArticle.id), $event)">-</span>*/
/*                                         </td>*/
/* */
/*                                         <td>*/
/*                                             <span translate="{[{(getAppShopHasArticleFromCart(paymentDetailHasArticle.id)).name_label.key}]}" translate-values="{[{ {number: (paymentDetailHasArticle.items_quantity | number) } }]}"></span>*/
/*                                             <span ng-if="!(getAppShopHasArticleFromCart(paymentDetailHasArticle.id)).name_label.key" translate="{[{ paymentDetailHasArticle.name_label.key }]}" translate-values="{[{ {number: (paymentDetailHasArticle.items_quantity | number) } }]}"></span>*/
/*                                         </td>*/
/*                                         <td class="num">+ {[{ (paymentDetailHasArticle.amount * paymentDetailHasArticle.articles_quantity) | currency : $root.current.real_cart_price.currency.symbol : $root.current.real_cart_price.currency.decimal_places }]}</td>*/
/*                                     </tr>*/
/* */
/*                                     <tr ng-repeat="extraCost in $root.current.real_cart_price.payment_detail_extra_costs">*/
/*                                         <td colspan="3"></td>*/
/*                                         <td style="padding: 10px 4px">{[{ extraCost.name }]}</td>*/
/*                                         <td class="num">+ {[{ extraCost.amount | currency: extraCost.currency.symbol : extraCost.currency.decimal_places }]}</td>*/
/*                                     </tr>*/
/* */
/*                                     </tbody>*/
/*                                     <tfoot>*/
/*                                     <tr>*/
/* */
/*                                         <td colspan="4" class="clear-cart">*/
/*                                             <button type="button" translate="cart.clear" ng-click="clearCart()"></button>*/
/*                                         </td>*/
/* */
/*                                         <td class="total num">*/
/*                                             {[{ $root.current.real_cart_price.amount | currency : $root.current.real_cart_price.currency.symbol : $root.current.real_cart_price.currency.decimal_places }]}</span>*/
/*                                         </td>*/
/*                                     </tr>*/
/*                                     </tfoot>*/
/*                                 </table>*/
/*                             </div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="mid" ng-class="{'disabled': !isReady(), 'continue': isReady() }">*/
/*                         <div class="pay-button" ng-click="buy()" >*/
/*                             <div class="pay-button-text">{[{ 'continue' | translate }]}</div>*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="right">*/
/*                         <div class="wallet" ng-if="$root.options.walletConf.wallet_is_enabled">*/
/*                             <div class="circle">*/
/*                                 <img src="{{ absolute_url(asset('/img/1x1.png')) }}">*/
/*                             </div>*/
/*                             <div class="actions">*/
/*                                 <span class="btn-plus" ng-click="toggleWallet()">*/
/*                                     {[{ 'wallet.deposit_money' | translate }]}*/
/*                                 </span>*/
/*                             </div>*/
/*                             <div class="amount">*/
/*                                 <div ng-if="$root.options.walletConf.wallet_in_real_money">*/
/*                                     <span>{[{ $root.options.gamerWallet.amount_in_real_money | currency : ($root.options.gamerWallet.currencyReal.symbol || $root.current.real_cart_price.currency.symbol ) : ($root.options.gamerWallet.currencyReal.decimal_places || $root.current.real_cart_price.currency.decimal_places)  }]}</span>*/
/*                                 </div>*/
/*                                 <div ng-if="!$root.options.walletConf.wallet_in_real_money">*/
/*                                     <span>{[{ $root.options.gamerWallet.amount_in_virtual_money | currency :$root.options.walletConf.wallet_virtual_money_symbol  }]}</span>*/
/*                                 </div>*/
/*                             </div>*/
/*                         </div>*/
/* */
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block extra_footer %}*/
/*     <li ng-if="$root.current.state !== 'completed'" data-ng-click="current.tutorialEnabled = !current.tutorialEnabled ">{[{ 'footer.tutorial' | translate }]}</li>*/
/*     <li data-ng-click="$root.feedback = !$root.feedback">{[{ 'footer.feedback' | translate }]}</li>*/
/*     <li id="coupon_code" ng-if="$root.current.state !== 'completed'" data-ng-click="current.state = 'write_a_valid_code'">{[{ 'footer.promo_code' | translate }]}</li>*/
/* {% endblock %}*/
