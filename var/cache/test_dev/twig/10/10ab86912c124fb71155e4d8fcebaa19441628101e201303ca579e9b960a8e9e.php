<?php

/* AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig */
class __TwigTemplate_8b48cef9757da30bae02bc14f9004ff1a433ba5635170a3e1b8568c0e7bd13b5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 6
        return $this->loadTemplate((((twig_round($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "amountTotal", array())) == 0)) ? ("@App/PDF/summary_layout.html.twig") : ("@App/PDF/invoice_layout.html.twig")), "AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig", 6);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_a72d7364c63f8a95747d38de21a0299e5017eae95bf6ebc24eb91ab6808181e4 = $this->env->getExtension("native_profiler");
        $__internal_a72d7364c63f8a95747d38de21a0299e5017eae95bf6ebc24eb91ab6808181e4->enter($__internal_a72d7364c63f8a95747d38de21a0299e5017eae95bf6ebc24eb91ab6808181e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a72d7364c63f8a95747d38de21a0299e5017eae95bf6ebc24eb91ab6808181e4->leave($__internal_a72d7364c63f8a95747d38de21a0299e5017eae95bf6ebc24eb91ab6808181e4_prof);

    }

    // line 8
    public function block_page($context, array $blocks = array())
    {
        $__internal_90c9e935cc5deec99da0b625fb581faee4b96b169f4b4f3d27de8befe8476bb3 = $this->env->getExtension("native_profiler");
        $__internal_90c9e935cc5deec99da0b625fb581faee4b96b169f4b4f3d27de8befe8476bb3->enter($__internal_90c9e935cc5deec99da0b625fb581faee4b96b169f4b4f3d27de8befe8476bb3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 9
        echo "
    <div class=\"h2\">Summary (overview of final calculation)</div>
    <table style=\"width: 70%;\" cellspacing=\"0\" cellpadding=\"2\">

        <tr>
            <th style=\"text-align: left\">
                Concept
            </th>
            <th style=\"text-align: left\">
                Currency
            </th>
            <th style=\"text-align: right\">
                Total
            </th>
        </tr>
        <tr>
            <td>
                Generated Turnover
            </td>
            <td>
                ";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "id", array()), "html", null, true);
        echo "
            </td>
            <td class=\"num\">
                ";
        // line 32
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["profit4apps"]) ? $context["profit4apps"] : $this->getContext($context, "profit4apps")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "
            </td>
        </tr>

        ";
        // line 36
        $this->loadTemplate("@App/PDF/partials/extra_concepts.html.twig", "AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig", 36)->display($context);
        // line 37
        echo "
        ";
        // line 38
        if ((isset($context["profitIva"]) ? $context["profitIva"] : $this->getContext($context, "profitIva"))) {
            // line 39
            echo "            <tr>
                <td>
                    VAT ";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "country", array()), "vat", array()), "html", null, true);
            echo "% over ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["profitTotal"]) ? $context["profitTotal"] : $this->getContext($context, "profitTotal")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
                </td>
                <td>
                    ";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "id", array()), "html", null, true);
            echo "
                </td>
                <td class=\"num\">
                    ";
            // line 47
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["profitIva"]) ? $context["profitIva"] : $this->getContext($context, "profitIva")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
                </td>
            </tr>
        ";
        }
        // line 51
        echo "
        <tr>
            <td class=\"borderTop\">
                Invoice Total Including VAT
            </td>
            <td class=\"borderTop\">
                ";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "id", array()), "html", null, true);
        echo "
            </td>
            <td class=\"num borderTop\">
                ";
        // line 60
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "amountTotal", array()), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "
            </td>
        </tr>
    </table>

    <div style=\"padding-top: 100px\">
        ";
        // line 66
        $this->loadTemplate("@App/PDF/partials/deposit_details.html.twig", "AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig", 66)->display($context);
        // line 67
        echo "    </div>


    <div style=\"padding-top: 100px\">
        <em>Contact us at ";
        // line 71
        echo twig_escape_filter($this->env, (isset($context["email_finance"]) ? $context["email_finance"] : $this->getContext($context, "email_finance")), "html", null, true);
        echo " for any inquiries regarding this invoice.</em>
    </div>

<div class=\"page\">
    <div style=\"padding-top: 100px\">
        <div class=\"h3\">
            Generated Turnover DETAIL
        </div>
        <div>
            <table style=\"font-size: 0.8em; width: 100%\" cellspacing=\"0\" cellpadding=\"4\">
                <tr>
                    <th>
                        Currency
                   </th>
                    <th>
                        Transactions
                    </th>
                    <th>
                        Gross
                    </th>
                    <th>
                        Currency
                    </th>
                    <th>
                        Exchange Rate
                    </th>
                    <th>
                        Gross in EUR
                    </th>
                    <th>
                        VAT
                    </th>
                    <th>
                        PayMethods
                    </th>
                    <th>
                        Wolopay
                    </th>
                    <th>
                        Net turnover
                    </th>
                </tr>
                ";
        // line 113
        $context["grossTotal"] = 0;
        // line 114
        echo "                ";
        $context["vatTotal"] = 0;
        // line 115
        echo "                ";
        $context["payMethodsTotal"] = 0;
        // line 116
        echo "                ";
        $context["wolopayTotal"] = 0;
        // line 117
        echo "                ";
        $context["transactionTotal"] = 0;
        // line 118
        echo "
                ";
        // line 119
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["storageCurrencies"]) ? $context["storageCurrencies"] : $this->getContext($context, "storageCurrencies")));
        foreach ($context['_seq'] as $context["_key"] => $context["money"]) {
            // line 120
            echo "                    ";
            $context["grossTotal"] = ((isset($context["grossTotal"]) ? $context["grossTotal"] : $this->getContext($context, "grossTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_total_in_client_currency", array(), "array"));
            // line 121
            echo "                    ";
            $context["vatTotal"] = ((isset($context["vatTotal"]) ? $context["vatTotal"] : $this->getContext($context, "vatTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_tax_in_client_currency", array(), "array"));
            // line 122
            echo "                    ";
            $context["payMethodsTotal"] = ((isset($context["payMethodsTotal"]) ? $context["payMethodsTotal"] : $this->getContext($context, "payMethodsTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_provider_in_client_currency", array(), "array"));
            // line 123
            echo "                    ";
            $context["wolopayTotal"] = ((isset($context["wolopayTotal"]) ? $context["wolopayTotal"] : $this->getContext($context, "wolopayTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_wolo_in_client_currency", array(), "array"));
            // line 124
            echo "                    ";
            $context["transactionTotal"] = ((isset($context["transactionTotal"]) ? $context["transactionTotal"] : $this->getContext($context, "transactionTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "n_transactions", array(), "array"));
            // line 125
            echo "                <tr >
                    <td>Transactions in ";
            // line 126
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "currency", array()), "id", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 127
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "n_transactions", array(), "array"), 0, ".", ","), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 128
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_total", array(), "array"), 2, ".", ","), "html", null, true);
            echo "</td>
                    <td>";
            // line 129
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "currency", array()), "id", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 130
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "exchange_ratio", array(), "array"), 4, ".", ","), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 131
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_total_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 132
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_tax_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 133
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_provider_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 134
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_wolo_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</td>
                    <td class=\"num\">";
            // line 135
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_game_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</td>
                </tr>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['money'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 138
        echo "                <tr>
                    <th class=\"borderTop\"></th>
                    <th class=\"borderTop num\">";
        // line 140
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["transactionTotal"]) ? $context["transactionTotal"] : $this->getContext($context, "transactionTotal")), 2, ".", ","), "html", null, true);
        echo "</th>
                    <th class=\"borderTop\"></th>
                    <th class=\"borderTop\"></th>
                    <th class=\"borderTop\"></th>
                    <th class=\"num borderTop\">";
        // line 144
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["grossTotal"]) ? $context["grossTotal"] : $this->getContext($context, "grossTotal")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
        echo "</th>
                    <th class=\"num borderTop\">";
        // line 145
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["vatTotal"]) ? $context["vatTotal"] : $this->getContext($context, "vatTotal")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
        echo "</th>
                    <th class=\"num borderTop\">";
        // line 146
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["payMethodsTotal"]) ? $context["payMethodsTotal"] : $this->getContext($context, "payMethodsTotal")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
        echo "</th>
                    <th class=\"num borderTop\">";
        // line 147
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["wolopayTotal"]) ? $context["wolopayTotal"] : $this->getContext($context, "wolopayTotal")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
        echo "</th>
                    <th class=\"num borderTop\">";
        // line 148
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["profit4apps"]) ? $context["profit4apps"] : $this->getContext($context, "profit4apps")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
        echo "</th>

                </tr>
            </table>
        </div>
    </div>
</div>
";
        
        $__internal_90c9e935cc5deec99da0b625fb581faee4b96b169f4b4f3d27de8befe8476bb3->leave($__internal_90c9e935cc5deec99da0b625fb581faee4b96b169f4b4f3d27de8befe8476bb3_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/billingClientOwes:invoice_monthly_client_to_wolopay.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  319 => 148,  313 => 147,  307 => 146,  301 => 145,  295 => 144,  288 => 140,  284 => 138,  273 => 135,  267 => 134,  261 => 133,  255 => 132,  249 => 131,  245 => 130,  241 => 129,  237 => 128,  233 => 127,  229 => 126,  226 => 125,  223 => 124,  220 => 123,  217 => 122,  214 => 121,  211 => 120,  207 => 119,  204 => 118,  201 => 117,  198 => 116,  195 => 115,  192 => 114,  190 => 113,  145 => 71,  139 => 67,  137 => 66,  126 => 60,  120 => 57,  112 => 51,  103 => 47,  97 => 44,  87 => 41,  83 => 39,  81 => 38,  78 => 37,  76 => 36,  67 => 32,  61 => 29,  39 => 9,  33 => 8,  18 => 6,);
    }
}
/* {# client \AppBundle\Entity\Client #}*/
/* {# finInvoice \AppBundle\Entity\FinInvoice #}*/
/* {# storageCurrencies \AppBundle\Entity\NotPersisted\StorageCurrencyMoney #}*/
/* {# money \AppBundle\Entity\NotPersisted\Money #}*/
/* */
/* {% extends finInvoice.amountTotal|round == 0 ? '@App/PDF/summary_layout.html.twig' : '@App/PDF/invoice_layout.html.twig' %}*/
/* */
/* {% block page %}*/
/* */
/*     <div class="h2">Summary (overview of final calculation)</div>*/
/*     <table style="width: 70%;" cellspacing="0" cellpadding="2">*/
/* */
/*         <tr>*/
/*             <th style="text-align: left">*/
/*                 Concept*/
/*             </th>*/
/*             <th style="text-align: left">*/
/*                 Currency*/
/*             </th>*/
/*             <th style="text-align: right">*/
/*                 Total*/
/*             </th>*/
/*         </tr>*/
/*         <tr>*/
/*             <td>*/
/*                 Generated Turnover*/
/*             </td>*/
/*             <td>*/
/*                 {{ client.currencyEarnings.id }}*/
/*             </td>*/
/*             <td class="num">*/
/*                 {{ profit4apps | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*             </td>*/
/*         </tr>*/
/* */
/*         {% include '@App/PDF/partials/extra_concepts.html.twig' %}*/
/* */
/*         {% if profitIva %}*/
/*             <tr>*/
/*                 <td>*/
/*                     VAT {{ client.country.vat }}% over {{ profitTotal | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*                 </td>*/
/*                 <td>*/
/*                     {{ client.currencyEarnings.id }}*/
/*                 </td>*/
/*                 <td class="num">*/
/*                     {{ profitIva  | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*                 </td>*/
/*             </tr>*/
/*         {% endif %}*/
/* */
/*         <tr>*/
/*             <td class="borderTop">*/
/*                 Invoice Total Including VAT*/
/*             </td>*/
/*             <td class="borderTop">*/
/*                 {{ finInvoice.currency.id }}*/
/*             </td>*/
/*             <td class="num borderTop">*/
/*                 {{ finInvoice.amountTotal  | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*             </td>*/
/*         </tr>*/
/*     </table>*/
/* */
/*     <div style="padding-top: 100px">*/
/*         {% include '@App/PDF/partials/deposit_details.html.twig' %}*/
/*     </div>*/
/* */
/* */
/*     <div style="padding-top: 100px">*/
/*         <em>Contact us at {{ email_finance }} for any inquiries regarding this invoice.</em>*/
/*     </div>*/
/* */
/* <div class="page">*/
/*     <div style="padding-top: 100px">*/
/*         <div class="h3">*/
/*             Generated Turnover DETAIL*/
/*         </div>*/
/*         <div>*/
/*             <table style="font-size: 0.8em; width: 100%" cellspacing="0" cellpadding="4">*/
/*                 <tr>*/
/*                     <th>*/
/*                         Currency*/
/*                    </th>*/
/*                     <th>*/
/*                         Transactions*/
/*                     </th>*/
/*                     <th>*/
/*                         Gross*/
/*                     </th>*/
/*                     <th>*/
/*                         Currency*/
/*                     </th>*/
/*                     <th>*/
/*                         Exchange Rate*/
/*                     </th>*/
/*                     <th>*/
/*                         Gross in EUR*/
/*                     </th>*/
/*                     <th>*/
/*                         VAT*/
/*                     </th>*/
/*                     <th>*/
/*                         PayMethods*/
/*                     </th>*/
/*                     <th>*/
/*                         Wolopay*/
/*                     </th>*/
/*                     <th>*/
/*                         Net turnover*/
/*                     </th>*/
/*                 </tr>*/
/*                 {% set grossTotal = 0 %}*/
/*                 {% set vatTotal = 0 %}*/
/*                 {% set payMethodsTotal = 0 %}*/
/*                 {% set wolopayTotal = 0 %}*/
/*                 {% set transactionTotal = 0 %}*/
/* */
/*                 {% for money in storageCurrencies %}*/
/*                     {% set grossTotal = grossTotal + money.extraData['amount_total_in_client_currency'] %}*/
/*                     {% set vatTotal = vatTotal + money.extraData['amount_tax_in_client_currency'] %}*/
/*                     {% set payMethodsTotal = payMethodsTotal + money.extraData['amount_provider_in_client_currency'] %}*/
/*                     {% set wolopayTotal = wolopayTotal + money.extraData['amount_wolo_in_client_currency'] %}*/
/*                     {% set transactionTotal = transactionTotal + money.extraData['n_transactions'] %}*/
/*                 <tr >*/
/*                     <td>Transactions in {{ money.currency.id }}</td>*/
/*                     <td class="num">{{ money.extraData['n_transactions'] | number_format(0,'.', ',') }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_total'] | number_format(2,'.', ',') }}</td>*/
/*                     <td>{{ money.currency.id }}</td>*/
/*                     <td class="num">{{ money.extraData['exchange_ratio'] | number_format(4,'.', ',') }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_total_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_tax_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_provider_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_wolo_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                     <td class="num">{{ money.extraData['amount_game_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                 </tr>*/
/*                 {% endfor %}*/
/*                 <tr>*/
/*                     <th class="borderTop"></th>*/
/*                     <th class="borderTop num">{{ transactionTotal | number_format(2,'.', ',') }}</th>*/
/*                     <th class="borderTop"></th>*/
/*                     <th class="borderTop"></th>*/
/*                     <th class="borderTop"></th>*/
/*                     <th class="num borderTop">{{ grossTotal | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/*                     <th class="num borderTop">{{ vatTotal | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/*                     <th class="num borderTop">{{ payMethodsTotal | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/*                     <th class="num borderTop">{{ wolopayTotal | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/*                     <th class="num borderTop">{{ profit4apps | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/* */
/*                 </tr>*/
/*             </table>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* {% endblock %}*/
