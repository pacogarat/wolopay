<?php

/* AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig */
class __TwigTemplate_9144b2c67164b9f1ce5557160a11b1bd0fc3e5ed11a6a8a24da422df2a9c500d extends Twig_Template
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
        return $this->loadTemplate((((twig_round($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "amountTotal", array())) == 0)) ? ("@App/PDF/summary_layout.html.twig") : ("@App/PDF/invoice_layout.html.twig")), "AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig", 6);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9ff26a8556051183cb8d9e681adf5efd7e852935f7fa89af3f17eb4f04cbca62 = $this->env->getExtension("native_profiler");
        $__internal_9ff26a8556051183cb8d9e681adf5efd7e852935f7fa89af3f17eb4f04cbca62->enter($__internal_9ff26a8556051183cb8d9e681adf5efd7e852935f7fa89af3f17eb4f04cbca62_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9ff26a8556051183cb8d9e681adf5efd7e852935f7fa89af3f17eb4f04cbca62->leave($__internal_9ff26a8556051183cb8d9e681adf5efd7e852935f7fa89af3f17eb4f04cbca62_prof);

    }

    // line 8
    public function block_page($context, array $blocks = array())
    {
        $__internal_0832d3a9615b80923a68bdba5641e2b539d71a016fa63445371dc2758b2d6032 = $this->env->getExtension("native_profiler");
        $__internal_0832d3a9615b80923a68bdba5641e2b539d71a016fa63445371dc2758b2d6032->enter($__internal_0832d3a9615b80923a68bdba5641e2b539d71a016fa63445371dc2758b2d6032_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

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
                Monthly Fees
            </td>
            <td>
                ";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "woloPack", array()), "currency", array()), "id", array()), "html", null, true);
        echo "
            </td>
            <td class=\"num\">
                ";
        // line 32
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "woloPack", array()), "amountTotal", array()), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "
            </td>
        </tr>
        ";
        // line 35
        if ((isset($context["woloGatewayFeeSum"]) ? $context["woloGatewayFeeSum"] : $this->getContext($context, "woloGatewayFeeSum"))) {
            // line 36
            echo "            <tr>
                <td>
                    Gateways minimal fee
                </td>
                <td>
                    ";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "id", array()), "html", null, true);
            echo "
                </td>
                <td class=\"num\">
                    ";
            // line 44
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["woloGatewayFeeSum"]) ? $context["woloGatewayFeeSum"] : $this->getContext($context, "woloGatewayFeeSum")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
                </td>
            </tr>
        ";
        }
        // line 48
        echo "
        ";
        // line 49
        $this->loadTemplate("@App/PDF/partials/extra_concepts.html.twig", "AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig", 49)->display($context);
        // line 50
        echo "
        ";
        // line 51
        if ((isset($context["monthlyWoloIva"]) ? $context["monthlyWoloIva"] : $this->getContext($context, "monthlyWoloIva"))) {
            // line 52
            echo "            <tr>
                <td>
                    VAT ";
            // line 54
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "country", array()), "vat", array()), "html", null, true);
            echo "% over ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["monthlyWoloIvaOver"]) ? $context["monthlyWoloIvaOver"] : $this->getContext($context, "monthlyWoloIvaOver")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "woloPack", array()), "currency", array()), "id", array()), "html", null, true);
            echo "
                </td>
                <td>
                    ";
            // line 57
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "id", array()), "html", null, true);
            echo "
                </td>
                <td class=\"num\">
                    ";
            // line 60
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["monthlyWoloIva"]) ? $context["monthlyWoloIva"] : $this->getContext($context, "monthlyWoloIva")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
                </td>
            </tr>
        ";
        }
        // line 64
        echo "        <tr>
            <td class=\"borderTop\">
                Invoice Total Including VAT
            </td>
            <td class=\"borderTop\">
                ";
        // line 69
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "id", array()), "html", null, true);
        echo "
            </td>
            <td class=\"num borderTop\">
                ";
        // line 72
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "amountTotal", array()), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "
            </td>
        </tr>
    </table>

    <div style=\"padding-top: 50px\">
        ";
        // line 78
        $this->loadTemplate("@App/PDF/partials/deposit_details.html.twig", "AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig", 78)->display($context);
        // line 79
        echo "    </div>

    ";
        // line 81
        if ((isset($context["woloGatewayFeeSum"]) ? $context["woloGatewayFeeSum"] : $this->getContext($context, "woloGatewayFeeSum"))) {
            // line 82
            echo "        <div style=\"padding-top: 50px\">
            <div class=\"h3\">
                Gateway generated Turnover DETAIL
            </div>
            <div>
                <table style=\"font-size: 0.8em; width: 50%\" cellspacing=\"0\" cellpadding=\"4\">
                    <tr>
                        <th>
                            Transactions
                        </th>
                        <th>
                            Provider Gateway
                        </th>
                        <th>
                            Gross
                        </th>
                    </tr>
                    ";
            // line 99
            $context["grossTotal"] = 0;
            // line 100
            echo "                    ";
            $context["vatTotal"] = 0;
            // line 101
            echo "                    ";
            $context["payMethodsTotal"] = 0;
            // line 102
            echo "                    ";
            $context["wolopayTotal"] = 0;
            // line 103
            echo "                    ";
            $context["transactionTotal"] = 0;
            // line 104
            echo "
                    ";
            // line 105
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["storageCurrencies"]) ? $context["storageCurrencies"] : $this->getContext($context, "storageCurrencies")));
            foreach ($context['_seq'] as $context["payMethodName"] => $context["money"]) {
                // line 106
                echo "                        ";
                $context["wolopayTotal"] = ((isset($context["wolopayTotal"]) ? $context["wolopayTotal"] : $this->getContext($context, "wolopayTotal")) + $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_wolo_in_client_currency", array(), "array"));
                // line 107
                echo "                        ";
                $context["transactionTotal"] = ((isset($context["transactionTotal"]) ? $context["transactionTotal"] : $this->getContext($context, "transactionTotal")) + twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "transactions", array(), "array")));
                // line 108
                echo "                        <tr >
                            <td class=\"num\">";
                // line 109
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "transactions", array(), "array")), "html", null, true);
                echo "</td>
                            <td>";
                // line 110
                echo twig_escape_filter($this->env, $context["payMethodName"], "html", null, true);
                echo "</td>
                            <td class=\"num\">";
                // line 111
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["money"], "extraData", array()), "amount_wolo_in_client_currency", array(), "array"), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
                echo "</td>
                        </tr>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['payMethodName'], $context['money'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 114
            echo "                    <tr>
                        <th class=\"borderTop num\">";
            // line 115
            echo twig_escape_filter($this->env, (isset($context["transactionTotal"]) ? $context["transactionTotal"] : $this->getContext($context, "transactionTotal")), "html", null, true);
            echo "</th>
                        <th class=\"borderTop\"></th>
                        <th class=\"num borderTop\">";
            // line 117
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["wolopayTotal"]) ? $context["wolopayTotal"] : $this->getContext($context, "wolopayTotal")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["client"]) ? $context["client"] : $this->getContext($context, "client")), "currencyEarnings", array()), "symbol", array()), "html", null, true);
            echo "</th>
                    </tr>
                </table>
            </div>
        </div>
    ";
        }
        // line 123
        echo "
    <div style=\"padding-top: 50px\">
        Contact us at ";
        // line 125
        echo twig_escape_filter($this->env, (isset($context["email_billing"]) ? $context["email_billing"] : $this->getContext($context, "email_billing")), "html", null, true);
        echo " for any inquiries regarding this invoice.
    </div>

";
        
        $__internal_0832d3a9615b80923a68bdba5641e2b539d71a016fa63445371dc2758b2d6032->leave($__internal_0832d3a9615b80923a68bdba5641e2b539d71a016fa63445371dc2758b2d6032_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/billingClientOwes:invoice_monthly_wolopay_to_client.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  261 => 125,  257 => 123,  246 => 117,  241 => 115,  238 => 114,  227 => 111,  223 => 110,  219 => 109,  216 => 108,  213 => 107,  210 => 106,  206 => 105,  203 => 104,  200 => 103,  197 => 102,  194 => 101,  191 => 100,  189 => 99,  170 => 82,  168 => 81,  164 => 79,  162 => 78,  151 => 72,  145 => 69,  138 => 64,  129 => 60,  123 => 57,  113 => 54,  109 => 52,  107 => 51,  104 => 50,  102 => 49,  99 => 48,  90 => 44,  84 => 41,  77 => 36,  75 => 35,  67 => 32,  61 => 29,  39 => 9,  33 => 8,  18 => 6,);
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
/*                 Monthly Fees*/
/*             </td>*/
/*             <td>*/
/*                 {{ client.woloPack.currency.id }}*/
/*             </td>*/
/*             <td class="num">*/
/*                 {{ client.woloPack.amountTotal  | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*             </td>*/
/*         </tr>*/
/*         {% if woloGatewayFeeSum %}*/
/*             <tr>*/
/*                 <td>*/
/*                     Gateways minimal fee*/
/*                 </td>*/
/*                 <td>*/
/*                     {{ client.currencyEarnings.id }}*/
/*                 </td>*/
/*                 <td class="num">*/
/*                     {{ woloGatewayFeeSum | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*                 </td>*/
/*             </tr>*/
/*         {% endif %}*/
/* */
/*         {% include '@App/PDF/partials/extra_concepts.html.twig' %}*/
/* */
/*         {% if monthlyWoloIva %}*/
/*             <tr>*/
/*                 <td>*/
/*                     VAT {{ client.country.vat }}% over {{ monthlyWoloIvaOver | number_format(2,'.', ',') }} {{ client.woloPack.currency.id }}*/
/*                 </td>*/
/*                 <td>*/
/*                     {{ client.currencyEarnings.id }}*/
/*                 </td>*/
/*                 <td class="num">*/
/*                     {{ monthlyWoloIva | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/*                 </td>*/
/*             </tr>*/
/*         {% endif %}*/
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
/*     <div style="padding-top: 50px">*/
/*         {% include '@App/PDF/partials/deposit_details.html.twig' %}*/
/*     </div>*/
/* */
/*     {% if woloGatewayFeeSum %}*/
/*         <div style="padding-top: 50px">*/
/*             <div class="h3">*/
/*                 Gateway generated Turnover DETAIL*/
/*             </div>*/
/*             <div>*/
/*                 <table style="font-size: 0.8em; width: 50%" cellspacing="0" cellpadding="4">*/
/*                     <tr>*/
/*                         <th>*/
/*                             Transactions*/
/*                         </th>*/
/*                         <th>*/
/*                             Provider Gateway*/
/*                         </th>*/
/*                         <th>*/
/*                             Gross*/
/*                         </th>*/
/*                     </tr>*/
/*                     {% set grossTotal = 0 %}*/
/*                     {% set vatTotal = 0 %}*/
/*                     {% set payMethodsTotal = 0 %}*/
/*                     {% set wolopayTotal = 0 %}*/
/*                     {% set transactionTotal = 0 %}*/
/* */
/*                     {% for payMethodName, money in storageCurrencies %}*/
/*                         {% set wolopayTotal = wolopayTotal + money.extraData['amount_wolo_in_client_currency'] %}*/
/*                         {% set transactionTotal = transactionTotal + money.extraData['transactions'] | length %}*/
/*                         <tr >*/
/*                             <td class="num">{{ money.extraData['transactions'] | length }}</td>*/
/*                             <td>{{ payMethodName }}</td>*/
/*                             <td class="num">{{ money.extraData['amount_wolo_in_client_currency'] | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</td>*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                     <tr>*/
/*                         <th class="borderTop num">{{ transactionTotal }}</th>*/
/*                         <th class="borderTop"></th>*/
/*                         <th class="num borderTop">{{ wolopayTotal | number_format(2,'.', ',') }} {{ client.currencyEarnings.symbol }}</th>*/
/*                     </tr>*/
/*                 </table>*/
/*             </div>*/
/*         </div>*/
/*     {% endif %}*/
/* */
/*     <div style="padding-top: 50px">*/
/*         Contact us at {{ email_billing }} for any inquiries regarding this invoice.*/
/*     </div>*/
/* */
/* {% endblock %}*/
