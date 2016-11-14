<?php

/* AppBundle:AppShop/Shop/partials:completed_box.html.twig */
class __TwigTemplate_ebb4fa4d0e1dc42ceccde22de0a5af83fd119fdd482897313335a1bed3d1163b extends Twig_Template
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
        $__internal_4264635c9b47088bc8578eda948213c30fbff6d6398e394f0b3ffb1ed7310c0a = $this->env->getExtension("native_profiler");
        $__internal_4264635c9b47088bc8578eda948213c30fbff6d6398e394f0b3ffb1ed7310c0a->enter($__internal_4264635c9b47088bc8578eda948213c30fbff6d6398e394f0b3ffb1ed7310c0a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:completed_box.html.twig"));

        // line 1
        echo "<div id=\"completed-box\" class=\"finished-box\">

    <div>

        <div class=\"text\">
            <h2>{[{ 'completed.title' | translate }]}</h2>

            {[{ 'completed.desc' | translate }]}
        </div>

        <table>
            <tbody>
                <tr>
                    <th>{[{ 'completed.game_web' | translate }]}:</th>
                    <td>{[{ options.app.url_home_site }]}</td>

                    <th>{[{ 'completed.ip' | translate }]}:</th>
                    <td>{[{ status.payment_process.ip }]}</td>
                </tr>
                <tr>
                    <th>{[{ 'completed.merchant' | translate }]}:</th>
                    <td>{[{ options.app.name }]}</td>

                    <th>{[{ 'completed.transaction_id' | translate }]}:</th>
                    <td>{[{ options.transactionId }]}</td>
                </tr>

                <tr>
                    <th>{[{ 'completed.payment_status' | translate }]}:</th>
                    <td>{[{ text.payment_status | translate }]}</td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>{[{ 'completed.payment_type' | translate }]}:</th>
                    <td>{[{ text.payment_type | translate }]}</td>

                    <th>{[{ 'completed.provider' | translate }]}:</th>
                    <td>{[{ status.payment_process.payment_detail.pay_method.name }]}</td>

                </tr>
                <tr>

                    <th>{[{ 'completed.product' | translate }]}:</th>
                    <td>
                        <ul>
                            <li ng-repeat=\"articlePurchased in status.payment_process.payment_detail.payment_detail_has_articles \">
                                <b translate=\"units\" translate-values=\"{[{ {units: (articlePurchased.articles_quantity) } }]}\"></b>
                                <span translate=\"{[{ articlePurchased.name.key }]}\" translate-values=\"{[{ {number : articlePurchased.items_quantity} }]}\"></span>
                            </li>
                        </ul>
                    </td>
                    <th></th>
                    <td></td>
                </tr>
            </tbody>
            <tr class=\"price\">
                <th> </th>
                <td> </td>
                <th>{[{ 'completed.amount' | translate }]}:</th>
                <td class=\"total\">{[{ status.payment_process.payment_detail.amount }]} {[{ status.payment_process.payment_detail.currency.symbol }]}</td>

            </tr>
        </table>

    </div>
    <div id=\"imgs-related-box\">

        <img src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-src=\"{[{ asset( status.payment_process.payment_detail.pay_method.img, false) }]}\" style=\"float: right\">
        <img src=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("/img/1x1.png")), "html", null, true);
        echo "\" ng-src=\"{[{ asset( options.app.logo.img, false) }]}\" style=\"float: left\">

    </div>


</div>";
        
        $__internal_4264635c9b47088bc8578eda948213c30fbff6d6398e394f0b3ffb1ed7310c0a->leave($__internal_4264635c9b47088bc8578eda948213c30fbff6d6398e394f0b3ffb1ed7310c0a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials:completed_box.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 70,  92 => 69,  22 => 1,);
    }
}
/* <div id="completed-box" class="finished-box">*/
/* */
/*     <div>*/
/* */
/*         <div class="text">*/
/*             <h2>{[{ 'completed.title' | translate }]}</h2>*/
/* */
/*             {[{ 'completed.desc' | translate }]}*/
/*         </div>*/
/* */
/*         <table>*/
/*             <tbody>*/
/*                 <tr>*/
/*                     <th>{[{ 'completed.game_web' | translate }]}:</th>*/
/*                     <td>{[{ options.app.url_home_site }]}</td>*/
/* */
/*                     <th>{[{ 'completed.ip' | translate }]}:</th>*/
/*                     <td>{[{ status.payment_process.ip }]}</td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <th>{[{ 'completed.merchant' | translate }]}:</th>*/
/*                     <td>{[{ options.app.name }]}</td>*/
/* */
/*                     <th>{[{ 'completed.transaction_id' | translate }]}:</th>*/
/*                     <td>{[{ options.transactionId }]}</td>*/
/*                 </tr>*/
/* */
/*                 <tr>*/
/*                     <th>{[{ 'completed.payment_status' | translate }]}:</th>*/
/*                     <td>{[{ text.payment_status | translate }]}</td>*/
/*                     <th></th>*/
/*                     <td></td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <th>{[{ 'completed.payment_type' | translate }]}:</th>*/
/*                     <td>{[{ text.payment_type | translate }]}</td>*/
/* */
/*                     <th>{[{ 'completed.provider' | translate }]}:</th>*/
/*                     <td>{[{ status.payment_process.payment_detail.pay_method.name }]}</td>*/
/* */
/*                 </tr>*/
/*                 <tr>*/
/* */
/*                     <th>{[{ 'completed.product' | translate }]}:</th>*/
/*                     <td>*/
/*                         <ul>*/
/*                             <li ng-repeat="articlePurchased in status.payment_process.payment_detail.payment_detail_has_articles ">*/
/*                                 <b translate="units" translate-values="{[{ {units: (articlePurchased.articles_quantity) } }]}"></b>*/
/*                                 <span translate="{[{ articlePurchased.name.key }]}" translate-values="{[{ {number : articlePurchased.items_quantity} }]}"></span>*/
/*                             </li>*/
/*                         </ul>*/
/*                     </td>*/
/*                     <th></th>*/
/*                     <td></td>*/
/*                 </tr>*/
/*             </tbody>*/
/*             <tr class="price">*/
/*                 <th> </th>*/
/*                 <td> </td>*/
/*                 <th>{[{ 'completed.amount' | translate }]}:</th>*/
/*                 <td class="total">{[{ status.payment_process.payment_detail.amount }]} {[{ status.payment_process.payment_detail.currency.symbol }]}</td>*/
/* */
/*             </tr>*/
/*         </table>*/
/* */
/*     </div>*/
/*     <div id="imgs-related-box">*/
/* */
/*         <img src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-src="{[{ asset( status.payment_process.payment_detail.pay_method.img, false) }]}" style="float: right">*/
/*         <img src="{{ absolute_url(asset('/img/1x1.png')) }}" ng-src="{[{ asset( options.app.logo.img, false) }]}" style="float: left">*/
/* */
/*     </div>*/
/* */
/* */
/* </div>*/
