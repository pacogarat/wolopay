<?php

/* AppBundle:Admin/BillingInvoiceAdmin:index.html.twig */
class __TwigTemplate_9a440acf2d047d815ee67cab5a7c94c94f41922249c4a46c1470b04af161aaa2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "AppBundle:Admin/BillingInvoiceAdmin:index.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9abd7d07ccc1b6809912eb2253597fa6d3b143693a3ea2aba115be905638eee6 = $this->env->getExtension("native_profiler");
        $__internal_9abd7d07ccc1b6809912eb2253597fa6d3b143693a3ea2aba115be905638eee6->enter($__internal_9abd7d07ccc1b6809912eb2253597fa6d3b143693a3ea2aba115be905638eee6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Admin/BillingInvoiceAdmin:index.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9abd7d07ccc1b6809912eb2253597fa6d3b143693a3ea2aba115be905638eee6->leave($__internal_9abd7d07ccc1b6809912eb2253597fa6d3b143693a3ea2aba115be905638eee6_prof);

    }

    // line 3
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        $__internal_7d9624069ad6a4dbc08769729604a4e2554a6b5d7f876d545f65bd0997b8f018 = $this->env->getExtension("native_profiler");
        $__internal_7d9624069ad6a4dbc08769729604a4e2554a6b5d7f876d545f65bd0997b8f018->enter($__internal_7d9624069ad6a4dbc08769729604a4e2554a6b5d7f876d545f65bd0997b8f018_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_breadcrumb"));

        // line 4
        echo "    <div class=\"hidden-xs\">

        <ol class=\"nav navbar-top-links breadcrumb\">

            <li>
                <a href=\"#\">Billing</a>
            </li>
            <li class=\"active\">
                <span>Pending invoices</span>
            </li>
        </ol>

    </div>
";
        
        $__internal_7d9624069ad6a4dbc08769729604a4e2554a6b5d7f876d545f65bd0997b8f018->leave($__internal_7d9624069ad6a4dbc08769729604a4e2554a6b5d7f876d545f65bd0997b8f018_prof);

    }

    // line 19
    public function block_content($context, array $blocks = array())
    {
        $__internal_6d1b9e5c19d7a9fd5242ec3d4ed27c49f4bd15a8d55f1863a9d19e92738885b2 = $this->env->getExtension("native_profiler");
        $__internal_6d1b9e5c19d7a9fd5242ec3d4ed27c49f4bd15a8d55f1863a9d19e92738885b2->enter($__internal_6d1b9e5c19d7a9fd5242ec3d4ed27c49f4bd15a8d55f1863a9d19e92738885b2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 20
        echo "    <style>

        .total{
            padding-top: 10px;
            font-size: 2em;
            color: red;
            text-shadow: 1px 0 1px #000;
        }
        .to-pay{
            color: #008000;
        }
        blockquote{
            padding: 0 20px;
        }
        .state.approved{
            background-color: rgba(18, 184, 0, 0.29);
        }
        .state.declined{
            background-color: rgba(255, 0, 0, 0.28);
        }
        .border-less td, .border-less th{
            border:none !important;
        }

        input:required, select:required, textarea:required {
            background-image: url(\"/bundles/app/client_admin/img/asterisk_moremargin.png\");
            background-position: right center;
            background-repeat: no-repeat;
        }

        input:invalid, select:invalid, textarea:invalid {
            background: rgba(255, 0, 0, 0.1);
        }

    </style>
    <section class=\"content\" ng-app=\"billingApp\">
        <div class=\"row\">
        ";
        // line 57
        $context["curretInvoiceClientDate"] = "";
        // line 58
        echo "
        ";
        // line 59
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["invoices"]) ? $context["invoices"] : $this->getContext($context, "invoices")));
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 60
            echo "            ";
            if ((($this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()) . twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "Y-m-d")) != (isset($context["curretInvoiceClientDate"]) ? $context["curretInvoiceClientDate"] : $this->getContext($context, "curretInvoiceClientDate")))) {
                // line 61
                echo "                ";
                $context["curretInvoiceClientDate"] = ($this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()) . twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "Y-m-d"));
                // line 62
                echo "                </div>
                <div class=\"row box box-primary\" id=\"";
                // line 63
                echo twig_escape_filter($this->env, (isset($context["curretInvoiceClientDate"]) ? $context["curretInvoiceClientDate"] : $this->getContext($context, "curretInvoiceClientDate")), "html", null, true);
                echo "\" style=\"padding: 20px\" >
                    <blockquote>
                        <h1>
                            <strong>
                                ";
                // line 67
                if ($this->getAttribute($context["invoice"], "approvedAt", array())) {
                    // line 68
                    echo "                                    <button class=\"btn btn-success disabled\">Approved</button>
                                ";
                } elseif ($this->getAttribute(                // line 69
$context["invoice"], "declinedAt", array())) {
                    // line 70
                    echo "                                    <button class=\"btn btn-danger disabled\">Declined</button>
                                ";
                }
                // line 72
                echo "                            </strong>

                            ";
                // line 74
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "nameCompany", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "M Y"), "html", null, true);
                echo "

                            <div class=\"btn-group pull-right state\" style=\"\" >

                                <button type=\"button\" class=\"btn btn-success\">
                                    <a style=\"color: white;\" href=\"";
                // line 79
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("billing_invoices_pending_approve", array("client_id" => $this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()), "date_reference" => twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "Y-m-d"))), "html", null, true);
                echo "\">
                                        <i class=\"fa fa-thumbs-up\"></i>
                                        Approve
                                    </a>
                                </button>
                                <button type=\"button\" class=\"btn btn-danger\">
                                    <a style=\"color: #fff;\" href=\"";
                // line 85
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("billing_invoices_pending_decline", array("client_id" => $this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()), "date_reference" => twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "Y-m-d"))), "html", null, true);
                echo "\">

                                        <i class=\"fa fa-thumbs-down\"></i>
                                        Decline
                                    </a>
                                </button>
                                <button type=\"button\" class=\"btn btn-warning\" onclick=\"javascript:getExtraConceptDataFromCurrentReference('";
                // line 91
                echo twig_escape_filter($this->env, (isset($context["curretInvoiceClientDate"]) ? $context["curretInvoiceClientDate"] : $this->getContext($context, "curretInvoiceClientDate")), "html", null, true);
                echo "', '";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("billing_invoices_regenerate", array("client_id" => $this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()), "date_reference" => twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "referenceDate", array()), "Y-m-d"))), "html", null, true);
                echo "') \">
                                        <i class=\"fa fa-refresh\"></i>
                                        Regenerate

                                </button>
                            </div>
                        </h1>
                        <em>Created: <b>";
                // line 98
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "createdAt", array())), "html", null, true);
                echo "</b><br>
                            ";
                // line 99
                if ($this->getAttribute($context["invoice"], "approvedAt", array())) {
                    // line 100
                    echo "                                Forward to client: <b>";
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["invoice"], "forwardForClientToAt", array())), "html", null, true);
                    echo "</b>
                            ";
                }
                // line 102
                echo "                        </em>

                    </blockquote>

            ";
            }
            // line 107
            echo "
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"col-xs-8\">
                        <h5>Title: ";
            // line 111
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "title", array()), "html", null, true);
            echo "</h5>
                        <table style=\"margin-top: 10px\">
                            <tr>
                                <th>Invoice ID</th>
                                <td>";
            // line 115
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "invoiceNumber", array()), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th>Company From</th>
                                <td>";
            // line 119
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "companyFrom", array()), "nameCompany", array()), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th>Company To</th>
                                <td>";
            // line 123
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "companyTo", array()), "nameCompany", array()), "html", null, true);
            echo "</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td class=\"total ";
            // line 127
            if (($this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()) == $this->getAttribute($this->getAttribute($context["invoice"], "companyTo", array()), "id", array()))) {
                echo "to-pay";
            }
            echo "\" style=\"font-size: 2em\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["invoice"], "amountTotal", array()), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["invoice"], "currency", array()), "id", array()), "html", null, true);
            echo "</td>
                            </tr>
                        </table>

                    </div>
                    <div class=\"col-xs-3\">
                        <div>
                            <a href=\"";
            // line 134
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->getAttribute($this->getAttribute($context["invoice"], "document", array()), "id", array()))), "html", null, true);
            echo "\" download style=\"white-space: nowrap;\">
                                ";
            // line 135
            echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($context["invoice"], "document", array()), "admin", array("class" => "img-polaroid media-object"));
            // line 136
            echo "                                <br>
                                <i class=\"fa fa-download\"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div ng-controller=\"invoiceCtrl\" ng-init=\"typeOwes = '";
            // line 143
            if (($this->getAttribute($this->getAttribute($context["invoice"], "externalCompanyNotWolopay", array()), "id", array()) == $this->getAttribute($this->getAttribute($context["invoice"], "companyTo", array()), "id", array()))) {
                echo "clientOwesWolopayExtraConcepts";
            } else {
                echo "wolopayOwesClientExtraConcepts";
            }
            echo "'\">
                        <div ng-include=\"'billing_invoice_extra_cost.html'\" ng-init=\"extraConcepts = ";
            // line 144
            echo twig_escape_filter($this->env, twig_jsonencode_filter($this->getAttribute($context["invoice"], "extraConcepts", array())), "html", null, true);
            echo " || []\"></div>
                    </div>
                </div>
            </div>
            ";
            // line 148
            if ((($this->getAttribute($this->getAttribute($context["invoice"], "clientDocuments", array()), "isEmpty", array()) == false) || ($this->getAttribute($this->getAttribute($context["invoice"], "finMovements", array()), "isEmpty", array()) == false))) {
                // line 149
                echo "                <div class=\"col-md-4\">

                    ";
                // line 151
                if (($this->getAttribute($this->getAttribute($context["invoice"], "clientDocuments", array()), "isEmpty", array()) == false)) {
                    // line 152
                    echo "
                        <h3>Documents</h3>
                        <table class=\"table\">
                            <tr>
                                <th>Description</th>
                                <th>Document</th>
                            </tr>
                            ";
                    // line 159
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["invoice"], "clientDocuments", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["clientDocument"]) {
                        // line 160
                        echo "                                ";
                        // line 161
                        echo "                                <tr>
                                    <td>
                                        ";
                        // line 163
                        echo twig_escape_filter($this->env, $this->getAttribute($context["clientDocument"], "title", array()), "html", null, true);
                        echo "
                                    </td>
                                    <td>
                                        <a href=\"";
                        // line 166
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->getAttribute($this->getAttribute($context["clientDocument"], "document", array()), "id", array()))), "html", null, true);
                        echo "\" download style=\"white-space: nowrap;\">
                                            ";
                        // line 167
                        echo $this->env->getExtension('sonata_media')->thumbnail($this->getAttribute($context["clientDocument"], "document", array()), "admin", array("class" => "img-polaroid media-object", "style" => "width: 50px"));
                        // line 168
                        echo "
                                            <i class=\"fa fa-download\"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['clientDocument'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 174
                    echo "                        </table>

                    ";
                }
                // line 177
                echo "                    ";
                if (($this->getAttribute($this->getAttribute($context["invoice"], "finMovements", array()), "isEmpty", array()) == false)) {
                    // line 178
                    echo "
                        <h3>Movements Assoc</h3>
                        <table class=\"table\">
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Total</th>
                            </tr>
                        ";
                    // line 187
                    echo "                        ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["invoice"], "finMovements", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["finMovement"]) {
                        // line 188
                        echo "                            <tr>
                                <td>";
                        // line 189
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["finMovement"], "companyTo", array()), "nameCompany", array()), "html", null, true);
                        echo "</td>
                                <td>";
                        // line 190
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["finMovement"], "companyFrom", array()), "nameCompany", array()), "html", null, true);
                        echo "</td>
                                <td class=\"num total ";
                        // line 191
                        if ($this->getAttribute($context["finMovement"], "isFromWolopay", array())) {
                            echo " to-pay";
                        }
                        echo "\">
                                    ";
                        // line 192
                        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["finMovement"], "amountTotal", array()), 2, ".", ","), "html", null, true);
                        echo " ";
                        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["finMovement"], "currency", array()), "symbol", array()), "html", null, true);
                        echo "
                                </td>
                            </tr>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['finMovement'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 196
                    echo "                        </table>
                    ";
                }
                // line 198
                echo "                </div>
            ";
            }
            // line 200
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 202
        echo "        </div>

        ";
        // line 249
        echo "

        <script type=\"text/ng-template\" id=\"billing_invoice_extra_cost.html\">

            <form >
                <table class=\"table border-less\" style=\"width: 270px; margin-top: 15px\">
                    <tbody ng-repeat=\"extraConcept in extraConcepts\" class=\"form-group\">
                    <tr>
                        <td>
                            <input type=\"text\" class=\"form-control\" ng-model=\"extraConcept.name\" required placeholder=\"name\">
                        </td>
                        <td>
                            <div class=\"btn btn-danger\" ng-click=\"removeExtraConcept(extraConcept)\">
                                Remove
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type=\"number\" class=\"form-control\" ng-model=\"extraConcept.money.amount\" required placeholder=\"amount\" step=\"0.01\"></td>
                        <td>
                            <select class=\"form-control\"  ng-model=\"extraConcept.money.currency.id\" required>
                                <option ng-repeat=\"currency in currencies\" value=\"{{ currency.id }}\" ng-selected=\"extraConcept.money.currency.id == currency.id\">{{ currency.id }}</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=\"2\">
                            <textarea class=\"form-control\" ng-model=\"extraConcept.description\" placeholder=\"Long description\" style=\"width: 270px !important;\">
                            </textarea>
                        </td>
                    </tr>
                    </tbody>
                    <tr>
                        <td colspan=\"2\" style=\"text-align: right\">
                            <div class=\"btn btn-default\" ng-click=\"addExtraConcept()\">
                                <i class=\"fa fa-plus\"></i> Extra concept
                            </div>
                        </td>
                    </tr>
                </table>
                <div class=\"data-extra-cost hidden\" data-type=\"{{typeOwes}}\">{{ extraConcepts }}</div>


            </form>
        </script>
        ";
        echo "
    </section>


";
        
        $__internal_6d1b9e5c19d7a9fd5242ec3d4ed27c49f4bd15a8d55f1863a9d19e92738885b2->leave($__internal_6d1b9e5c19d7a9fd5242ec3d4ed27c49f4bd15a8d55f1863a9d19e92738885b2_prof);

    }

    // line 255
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_493da96f81dd290d2735bb55c1dd319c9fee61007524d56dcf4cd0832dcaa66a = $this->env->getExtension("native_profiler");
        $__internal_493da96f81dd290d2735bb55c1dd319c9fee61007524d56dcf4cd0832dcaa66a->enter($__internal_493da96f81dd290d2735bb55c1dd319c9fee61007524d56dcf4cd0832dcaa66a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 256
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js\"></script>
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_es.js\"></script>
    <script>
        var currencies = ";
        // line 261
        echo $this->env->getExtension('jms_serializer')->serialize((isset($context["currencies"]) ? $context["currencies"] : $this->getContext($context, "currencies")), "json");
        echo ";
    </script>
    ";
        // line 304
        echo "

        <script>
            function getExtraConceptDataFromCurrentReference(idBlock, url)
            {
                var result = true;
                \$('#'+idBlock+' form').each(function( index ) {
                    if (!this.checkValidity())
                        result = false;
                });

                if (result == false)
                {
                    return;
                }

                var extra='?';
                \$('#'+idBlock+' .data-extra-cost').each(function( index ) {
                    extra+= \$(this).data('type') + '=' + encodeURIComponent(\$(this).text()) + '&';
                });

                window.location.href = url + extra;
            }

            var app = angular.module('billingApp', []);
            app.controller('invoiceCtrl', function(\$scope) {
                console.log('angular is loaded');
                \$scope.extraConcepts = [];
                \$scope.currencies = currencies;
                \$scope.addExtraConcept = function()
                {
                    \$scope.extraConcepts.push({money: {currency: {id: 'EUR' }}});
                };

                \$scope.removeExtraConcept = function(item)
                {
                    \$scope.extraConcepts.splice(\$scope.extraConcepts.indexOf(item), 1);
                };
            });
        </script>

    ";
        echo "
";
        
        $__internal_493da96f81dd290d2735bb55c1dd319c9fee61007524d56dcf4cd0832dcaa66a->leave($__internal_493da96f81dd290d2735bb55c1dd319c9fee61007524d56dcf4cd0832dcaa66a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Admin/BillingInvoiceAdmin:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  483 => 304,  478 => 261,  469 => 256,  463 => 255,  406 => 249,  402 => 202,  395 => 200,  391 => 198,  387 => 196,  375 => 192,  369 => 191,  365 => 190,  361 => 189,  358 => 188,  353 => 187,  343 => 178,  340 => 177,  335 => 174,  324 => 168,  322 => 167,  318 => 166,  312 => 163,  308 => 161,  306 => 160,  302 => 159,  293 => 152,  291 => 151,  287 => 149,  285 => 148,  278 => 144,  270 => 143,  261 => 136,  259 => 135,  255 => 134,  239 => 127,  232 => 123,  225 => 119,  218 => 115,  211 => 111,  205 => 107,  198 => 102,  192 => 100,  190 => 99,  186 => 98,  174 => 91,  165 => 85,  156 => 79,  146 => 74,  142 => 72,  138 => 70,  136 => 69,  133 => 68,  131 => 67,  124 => 63,  121 => 62,  118 => 61,  115 => 60,  111 => 59,  108 => 58,  106 => 57,  67 => 20,  61 => 19,  41 => 4,  35 => 3,  20 => 1,);
    }
}
/* {% extends base_template %}*/
/* */
/* {% block sonata_breadcrumb %}*/
/*     <div class="hidden-xs">*/
/* */
/*         <ol class="nav navbar-top-links breadcrumb">*/
/* */
/*             <li>*/
/*                 <a href="#">Billing</a>*/
/*             </li>*/
/*             <li class="active">*/
/*                 <span>Pending invoices</span>*/
/*             </li>*/
/*         </ol>*/
/* */
/*     </div>*/
/* {% endblock sonata_breadcrumb %}*/
/* */
/* {% block content %}*/
/*     <style>*/
/* */
/*         .total{*/
/*             padding-top: 10px;*/
/*             font-size: 2em;*/
/*             color: red;*/
/*             text-shadow: 1px 0 1px #000;*/
/*         }*/
/*         .to-pay{*/
/*             color: #008000;*/
/*         }*/
/*         blockquote{*/
/*             padding: 0 20px;*/
/*         }*/
/*         .state.approved{*/
/*             background-color: rgba(18, 184, 0, 0.29);*/
/*         }*/
/*         .state.declined{*/
/*             background-color: rgba(255, 0, 0, 0.28);*/
/*         }*/
/*         .border-less td, .border-less th{*/
/*             border:none !important;*/
/*         }*/
/* */
/*         input:required, select:required, textarea:required {*/
/*             background-image: url("/bundles/app/client_admin/img/asterisk_moremargin.png");*/
/*             background-position: right center;*/
/*             background-repeat: no-repeat;*/
/*         }*/
/* */
/*         input:invalid, select:invalid, textarea:invalid {*/
/*             background: rgba(255, 0, 0, 0.1);*/
/*         }*/
/* */
/*     </style>*/
/*     <section class="content" ng-app="billingApp">*/
/*         <div class="row">*/
/*         {% set curretInvoiceClientDate = '' %}*/
/* */
/*         {% for invoice in invoices %}*/
/*             {% if invoice.externalCompanyNotWolopay.id ~ (invoice.referenceDate|date('Y-m-d')) != curretInvoiceClientDate %}*/
/*                 {% set curretInvoiceClientDate = invoice.externalCompanyNotWolopay.id ~ (invoice.referenceDate|date('Y-m-d')) %}*/
/*                 </div>*/
/*                 <div class="row box box-primary" id="{{curretInvoiceClientDate}}" style="padding: 20px" >*/
/*                     <blockquote>*/
/*                         <h1>*/
/*                             <strong>*/
/*                                 {% if invoice.approvedAt %}*/
/*                                     <button class="btn btn-success disabled">Approved</button>*/
/*                                 {% elseif invoice.declinedAt %}*/
/*                                     <button class="btn btn-danger disabled">Declined</button>*/
/*                                 {% endif %}*/
/*                             </strong>*/
/* */
/*                             {{ invoice.externalCompanyNotWolopay.nameCompany }} {{ invoice.referenceDate|date('M Y') }}*/
/* */
/*                             <div class="btn-group pull-right state" style="" >*/
/* */
/*                                 <button type="button" class="btn btn-success">*/
/*                                     <a style="color: white;" href="{{ path('billing_invoices_pending_approve', {client_id: invoice.externalCompanyNotWolopay.id, date_reference: invoice.referenceDate |date('Y-m-d') }) }}">*/
/*                                         <i class="fa fa-thumbs-up"></i>*/
/*                                         Approve*/
/*                                     </a>*/
/*                                 </button>*/
/*                                 <button type="button" class="btn btn-danger">*/
/*                                     <a style="color: #fff;" href="{{ path('billing_invoices_pending_decline', {client_id: invoice.externalCompanyNotWolopay.id, date_reference: invoice.referenceDate |date('Y-m-d') }) }}">*/
/* */
/*                                         <i class="fa fa-thumbs-down"></i>*/
/*                                         Decline*/
/*                                     </a>*/
/*                                 </button>*/
/*                                 <button type="button" class="btn btn-warning" onclick="javascript:getExtraConceptDataFromCurrentReference('{{curretInvoiceClientDate}}', '{{ path('billing_invoices_regenerate', {client_id: invoice.externalCompanyNotWolopay.id, date_reference: invoice.referenceDate |date('Y-m-d') }) }}') ">*/
/*                                         <i class="fa fa-refresh"></i>*/
/*                                         Regenerate*/
/* */
/*                                 </button>*/
/*                             </div>*/
/*                         </h1>*/
/*                         <em>Created: <b>{{ invoice.createdAt | date }}</b><br>*/
/*                             {% if invoice.approvedAt %}*/
/*                                 Forward to client: <b>{{ invoice.forwardForClientToAt | date }}</b>*/
/*                             {% endif %}*/
/*                         </em>*/
/* */
/*                     </blockquote>*/
/* */
/*             {% endif %}*/
/* */
/*             <div class="col-md-4">*/
/*                 <div class="row">*/
/*                     <div class="col-xs-8">*/
/*                         <h5>Title: {{ invoice.title }}</h5>*/
/*                         <table style="margin-top: 10px">*/
/*                             <tr>*/
/*                                 <th>Invoice ID</th>*/
/*                                 <td>{{ invoice.invoiceNumber }}</td>*/
/*                             </tr>*/
/*                             <tr>*/
/*                                 <th>Company From</th>*/
/*                                 <td>{{ invoice.companyFrom.nameCompany }}</td>*/
/*                             </tr>*/
/*                             <tr>*/
/*                                 <th>Company To</th>*/
/*                                 <td>{{ invoice.companyTo.nameCompany }}</td>*/
/*                             </tr>*/
/*                             <tr>*/
/*                                 <th>Total</th>*/
/*                                 <td class="total {% if invoice.externalCompanyNotWolopay.id == invoice.companyTo.id %}to-pay{% endif %}" style="font-size: 2em">{{ invoice.amountTotal }} {{ invoice.currency.id }}</td>*/
/*                             </tr>*/
/*                         </table>*/
/* */
/*                     </div>*/
/*                     <div class="col-xs-3">*/
/*                         <div>*/
/*                             <a href="{{ path('sonata_media_download', {'id': invoice.document.id }) }}" download style="white-space: nowrap;">*/
/*                                 {% thumbnail invoice.document, 'admin' with {'class': 'img-polaroid media-object'} %}*/
/*                                 <br>*/
/*                                 <i class="fa fa-download"></i> Download*/
/*                             </a>*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div>*/
/*                     <div ng-controller="invoiceCtrl" ng-init="typeOwes = '{% if invoice.externalCompanyNotWolopay.id == invoice.companyTo.id %}clientOwesWolopayExtraConcepts{% else %}wolopayOwesClientExtraConcepts{% endif %}'">*/
/*                         <div ng-include="'billing_invoice_extra_cost.html'" ng-init="extraConcepts = {{ invoice.extraConcepts | json_encode }} || []"></div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*             {% if invoice.clientDocuments.isEmpty == false or invoice.finMovements.isEmpty == false  %}*/
/*                 <div class="col-md-4">*/
/* */
/*                     {% if invoice.clientDocuments.isEmpty == false %}*/
/* */
/*                         <h3>Documents</h3>*/
/*                         <table class="table">*/
/*                             <tr>*/
/*                                 <th>Description</th>*/
/*                                 <th>Document</th>*/
/*                             </tr>*/
/*                             {% for clientDocument in invoice.clientDocuments %}*/
/*                                 {# clientDocument \AppBundle\Entity\ClientDocument #}*/
/*                                 <tr>*/
/*                                     <td>*/
/*                                         {{ clientDocument.title }}*/
/*                                     </td>*/
/*                                     <td>*/
/*                                         <a href="{{ path('sonata_media_download', {'id': clientDocument.document.id }) }}" download style="white-space: nowrap;">*/
/*                                             {% thumbnail clientDocument.document, 'admin' with {'class': 'img-polaroid media-object', 'style': 'width: 50px' } %}*/
/* */
/*                                             <i class="fa fa-download"></i> Download*/
/*                                         </a>*/
/*                                     </td>*/
/*                                 </tr>*/
/*                             {% endfor %}*/
/*                         </table>*/
/* */
/*                     {% endif %}*/
/*                     {% if invoice.finMovements.isEmpty == false %}*/
/* */
/*                         <h3>Movements Assoc</h3>*/
/*                         <table class="table">*/
/*                             <tr>*/
/*                                 <th>From</th>*/
/*                                 <th>To</th>*/
/*                                 <th>Total</th>*/
/*                             </tr>*/
/*                         {# finMovement \AppBundle\Entity\FinMovement #}*/
/*                         {% for finMovement in invoice.finMovements %}*/
/*                             <tr>*/
/*                                 <td>{{ finMovement.companyTo.nameCompany }}</td>*/
/*                                 <td>{{ finMovement.companyFrom.nameCompany }}</td>*/
/*                                 <td class="num total {% if finMovement.isFromWolopay %} to-pay{% endif %}">*/
/*                                     {{ finMovement.amountTotal | number_format(2,'.', ',') }} {{ finMovement.currency.symbol }}*/
/*                                 </td>*/
/*                             </tr>*/
/*                         {% endfor %}*/
/*                         </table>*/
/*                     {% endif %}*/
/*                 </div>*/
/*             {% endif %}*/
/* */
/*         {% endfor %}*/
/*         </div>*/
/* */
/*         {% verbatim %}*/
/* */
/*         <script type="text/ng-template" id="billing_invoice_extra_cost.html">*/
/* */
/*             <form >*/
/*                 <table class="table border-less" style="width: 270px; margin-top: 15px">*/
/*                     <tbody ng-repeat="extraConcept in extraConcepts" class="form-group">*/
/*                     <tr>*/
/*                         <td>*/
/*                             <input type="text" class="form-control" ng-model="extraConcept.name" required placeholder="name">*/
/*                         </td>*/
/*                         <td>*/
/*                             <div class="btn btn-danger" ng-click="removeExtraConcept(extraConcept)">*/
/*                                 Remove*/
/*                             </div>*/
/*                         </td>*/
/*                     </tr>*/
/*                     <tr>*/
/*                         <td><input type="number" class="form-control" ng-model="extraConcept.money.amount" required placeholder="amount" step="0.01"></td>*/
/*                         <td>*/
/*                             <select class="form-control"  ng-model="extraConcept.money.currency.id" required>*/
/*                                 <option ng-repeat="currency in currencies" value="{{ currency.id }}" ng-selected="extraConcept.money.currency.id == currency.id">{{ currency.id }}</option>*/
/*                             </select>*/
/*                         </td>*/
/*                     </tr>*/
/*                     <tr>*/
/*                         <td colspan="2">*/
/*                             <textarea class="form-control" ng-model="extraConcept.description" placeholder="Long description" style="width: 270px !important;">*/
/*                             </textarea>*/
/*                         </td>*/
/*                     </tr>*/
/*                     </tbody>*/
/*                     <tr>*/
/*                         <td colspan="2" style="text-align: right">*/
/*                             <div class="btn btn-default" ng-click="addExtraConcept()">*/
/*                                 <i class="fa fa-plus"></i> Extra concept*/
/*                             </div>*/
/*                         </td>*/
/*                     </tr>*/
/*                 </table>*/
/*                 <div class="data-extra-cost hidden" data-type="{{typeOwes}}">{{ extraConcepts }}</div>*/
/* */
/* */
/*             </form>*/
/*         </script>*/
/*         {% endverbatim %}*/
/*     </section>*/
/* */
/* */
/* {% endblock %}*/
/* */
/* {% block javascripts %}*/
/*     {{ parent() }}*/
/* */
/*     <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>*/
/*     <script src="//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_es.js"></script>*/
/*     <script>*/
/*         var currencies = {{ currencies | serialize('json') | raw }};*/
/*     </script>*/
/*     {% verbatim %}*/
/* */
/*         <script>*/
/*             function getExtraConceptDataFromCurrentReference(idBlock, url)*/
/*             {*/
/*                 var result = true;*/
/*                 $('#'+idBlock+' form').each(function( index ) {*/
/*                     if (!this.checkValidity())*/
/*                         result = false;*/
/*                 });*/
/* */
/*                 if (result == false)*/
/*                 {*/
/*                     return;*/
/*                 }*/
/* */
/*                 var extra='?';*/
/*                 $('#'+idBlock+' .data-extra-cost').each(function( index ) {*/
/*                     extra+= $(this).data('type') + '=' + encodeURIComponent($(this).text()) + '&';*/
/*                 });*/
/* */
/*                 window.location.href = url + extra;*/
/*             }*/
/* */
/*             var app = angular.module('billingApp', []);*/
/*             app.controller('invoiceCtrl', function($scope) {*/
/*                 console.log('angular is loaded');*/
/*                 $scope.extraConcepts = [];*/
/*                 $scope.currencies = currencies;*/
/*                 $scope.addExtraConcept = function()*/
/*                 {*/
/*                     $scope.extraConcepts.push({money: {currency: {id: 'EUR' }}});*/
/*                 };*/
/* */
/*                 $scope.removeExtraConcept = function(item)*/
/*                 {*/
/*                     $scope.extraConcepts.splice($scope.extraConcepts.indexOf(item), 1);*/
/*                 };*/
/*             });*/
/*         </script>*/
/* */
/*     {% endverbatim %}*/
/* {% endblock %}*/
/* */
