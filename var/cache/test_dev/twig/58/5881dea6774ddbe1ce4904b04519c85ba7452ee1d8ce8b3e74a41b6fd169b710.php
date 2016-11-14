<?php

/* AppBundle:AppShop/Payment/email:payment_completed.html.twig */
class __TwigTemplate_829bb2935fea3fe8b83ed988e07d9c84908f25585774fd061354b692b5ca836b extends Twig_Template
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
        $__internal_3b2d03badb65ee743234ad7a9cce20845f2ef3dd98af2d1167b4508192cd7a99 = $this->env->getExtension("native_profiler");
        $__internal_3b2d03badb65ee743234ad7a9cce20845f2ef3dd98af2d1167b4508192cd7a99->enter($__internal_3b2d03badb65ee743234ad7a9cce20845f2ef3dd98af2d1167b4508192cd7a99_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Payment/email:payment_completed.html.twig"));

        // line 2
        echo "<html xmlns=\"http://www.w3.org/1999/xhtml\"><head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>
        ";
        // line 6
        if ($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "usedAppProviderCredentials", array())) {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "name", array()), "html", null, true);
            echo "
        ";
        } else {
            // line 9
            echo "            Wolopay
        ";
        }
        // line 11
        echo "    </title>
    <style type=\"text/css\">
        /* Client-specific Styles */
        #outlook a {padding:0;} /* Force Outlook to provide a \"view in browser\" menu link. */
        body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
        /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
        .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
        .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ */
        #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
        img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
        a img {border:none;}
        .image_fix {display:block;}
        p {margin: 0px 0px !important;}

        table td {border-collapse: collapse;}
        table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
        /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*/
        /*STYLES*/
        table[class=full] { width: 100%; clear: both; }

        /*################################################*/
        /*IPAD STYLES*/
        /*################################################*/
        @media only screen and (max-width: 640px) {
            a[href^=\"tel\"], a[href^=\"sms\"] {
                text-decoration: none;
                color: #ffffff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^=\"tel\"], .mobile_link a[href^=\"sms\"] {
                text-decoration: default;
                color: #ffffff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 440px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
            table[class=\"sthide\"]{display: none!important;}
            img[class=\"bigimage\"]{width: 420px!important;height:219px!important;}
            img[class=\"col2img\"]{width: 420px!important;height:258px!important;}
            img[class=\"image-banner\"]{width: 440px!important;height:106px!important;}
            td[class=\"menu\"]{text-align:center !important; padding: 0 0 10px 0 !important;}
            td[class=\"logo\"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}
            img[class=\"logo\"]{padding:0!important;margin: 0 auto !important;}

        }
        /*##############################################*/
        /*IPHONE STYLES*/
        /*##############################################*/
        @media only screen and (max-width: 480px) {
            a[href^=\"tel\"], a[href^=\"sms\"] {
                text-decoration: none;
                color: #ffffff; /* or whatever your want */
                pointer-events: none;
                cursor: default;
            }
            .mobile_link a[href^=\"tel\"], .mobile_link a[href^=\"sms\"] {
                text-decoration: default;
                color: #ffffff !important;
                pointer-events: auto;
                cursor: default;
            }
            table[class=devicewidth] {width: 280px!important;text-align:center!important;}
            table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
            table[class=\"sthide\"]{display: none!important;}
            img[class=\"bigimage\"]{width: 260px!important;height:136px!important;}
            img[class=\"col2img\"]{width: 260px!important;height:160px!important;}
            img[class=\"image-banner\"]{width: 280px!important;height:68px!important;}

        }
    </style>


</head>
<body>
<div class=\"block\">
    <!-- Start of preheader -->
    <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"preheader\">
        <tbody>
        <tr>
            <td width=\"100%\">
                <table width=\"580\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                    <tbody>
                    <!-- Spacing -->
                    <tr>
                        <td width=\"100%\" height=\"5\"></td>
                    </tr>
                    <!-- Spacing -->
                    <tr>
                        <td align=\"right\" valign=\"middle\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999\" st-content=\"preheader\">
                            ";
        // line 103
        echo "                        </td>
                    </tr>
                    <!-- Spacing -->
                    <tr>
                        <td width=\"100%\" height=\"5\"></td>
                    </tr>
                    <!-- Spacing -->
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- End of preheader -->
</div>
<div class=\"block\">
    <!-- start of header -->
    <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"header\">
        <tbody>
        <tr>
            <td>
                <table width=\"580\" bgcolor=\"#cccccc\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\" hlitebg=\"edit\" shadow=\"edit\">
                    <tbody>
                    <tr>
                        <td>
                            <!-- logo -->
                            <table width=\"280\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"left\" class=\"devicewidth\">
                                <tbody>
                                <tr>
                                    <td valign=\"middle\" width=\"270\" style=\"padding: 10px 0 10px 20px;\" class=\"logo\">
                                        <div class=\"imgpop\">
                                            ";
        // line 134
        if ($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "usedAppProviderCredentials", array())) {
            // line 135
            echo "                                                <img src=\"";
            echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
            echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "logo", array()), "email");
            echo "\" alt=\"logo\" border=\"0\" style=\"display:block; border:none; outline:none; text-decoration:none;\" st-image=\"edit\" class=\"logo\">
                                            ";
        } else {
            // line 137
            echo "                                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/logo_200x50.png"), "html", null, true);
            echo "\" alt=\"logo\" border=\"0\" style=\"display:block; border:none; outline:none; text-decoration:none;\" st-image=\"edit\" class=\"logo\">
                                            ";
        }
        // line 139
        echo "
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- End of logo -->
                            <!-- menu -->
                            <table width=\"280\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"right\" class=\"devicewidth\">
                                <tbody>
                                <tr>
                                    <td align=\"right\" valign=\"middle\" width=\"270\" style=\"padding: 10px 0 10px 20px;\" class=\"logo\">
                                        <div class=\"imgpop\" style=\"padding-right: 10px\">

                                            ";
        // line 153
        if ($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "usedAppProviderCredentials", array())) {
            // line 154
            echo "                                                <span style=\"color: #fff; font-size: 13px; line-height: 11px;\">
                                                    ";
            // line 155
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "client", array()), "nameCompany", array()), "html", null, true);
            echo "<br>
                                                    ";
            // line 156
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "client", array()), "vatNumber", array()), "html", null, true);
            echo "<br>
                                                    ";
            // line 157
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "client", array()), "address", array()), "html", null, true);
            echo "<br>
                                                    ";
            // line 158
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "client", array()), "postalCode", array()), "html", null, true);
            echo "<br>
                                                </span>
                                            ";
        } else {
            // line 161
            echo "                                                <img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("/bundles/app/app_shop/img/payment/email/datos-wolopay.png"), "html", null, true);
            echo "\" alt=\"logo\" border=\"0\" style=\"display:block; border:none; outline:none; text-decoration:none;\" st-image=\"edit\" class=\"logo\">
                                            ";
        }
        // line 163
        echo "                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- End of Menu -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- end of header -->
</div>





<div class=\"block\">
<!-- Start of 2-columns -->
<table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"2columns\">
<tbody>
<tr>
<td>
<table bgcolor=\"#ffffff\" width=\"580\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\" modulebg=\"edit\">
<tbody>
<tr>
    <td width=\"100%\" height=\"20\"></td>
</tr>
<tr>
<td>
<table width=\"540\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
<tbody>
<tr>
<td>
<table width=\"260\" align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
    <tbody>

    <tr>
        <td>
            <!-- start of text content table -->
            <table width=\"260\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\">
                <tbody>
                <!-- datos -->
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 212
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.transaction_id"), "html", null, true);
        echo "
                    </td>
                </tr>

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 218
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "transaction", array()), "id", array()), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 230
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.date"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 235
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "createdAt", array())), "html", null, true);
        echo "
                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 246
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.web_page"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        <a href=\"#\">";
        // line 251
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "urlHomeSite", array()), "html", null, true);
        echo "</a>

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 263
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.merchant"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 268
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "app", array()), "name", array()), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 280
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.payment_type"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 285
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans(("completed.payment_type_category." . $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "payment", array()), "type", array())), array(), "shop"), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 297
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.product"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 302
        echo twig_escape_filter($this->env, (isset($context["product"]) ? $context["product"] : $this->getContext($context, "product")), "html", null, true);
        echo "
                    </td>
                </tr>

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 308
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer.id"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 313
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "gamer", array()), "id", array()), "html", null, true);
        echo "
                    </td>
                </tr>
                <!-- end datos -->

                <!-- content -->

                <!-- end of content -->

                </tbody>
            </table>
        </td>
    </tr>
    <!-- end of text content table -->
    </tbody>
</table>
<!-- end of left column -->
<!-- spacing for mobile devices-->
<table align=\"left\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"mobilespacing\">
    <tbody>
    <tr>
        <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
    </tr>
    </tbody>
</table>
<!-- end of for mobile devices-->

<table width=\"260\" align=\"right\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidth\">
    <tbody>

    <tr>
        <td>
            <!-- start of text content table -->
            <table width=\"260\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\">
                <tbody>
                <!-- datos -->
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 351
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.payment_status"), "html", null, true);
        echo "
                    </td>
                </tr>

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 357
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.completed"), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 369
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.your_ip"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 374
        echo twig_escape_filter($this->env, (isset($context["ip"]) ? $context["ip"] : $this->getContext($context, "ip")), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 386
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.n_articles"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        1

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 403
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.pay_method"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 408
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "payMethod", array()), "name", array()), "html", null, true);
        echo "
                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 419
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.country"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 424
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "countryGamer", array()), "name", array()), "html", null, true);
        echo "
                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 435
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.price_before_tax"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 440
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["beforeTaxes"]) ? $context["beforeTaxes"] : $this->getContext($context, "beforeTaxes")), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "currency", array()), "id", array()), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 452
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.taxes"), "html", null, true);
        echo "
                    </td>
                </tr>
                <tr>
                    <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;\" st-title=\"2col-title1\">
                        ";
        // line 457
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, ($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "amountTotal", array()) - (isset($context["beforeTaxes"]) ? $context["beforeTaxes"] : $this->getContext($context, "beforeTaxes"))), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "currency", array()), "id", array()), "html", null, true);
        echo "

                    </td>
                </tr>
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"5\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                <!-- end datos -->
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"15\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->
                <!-- content -->

                <!-- end of content -->
                <!-- Spacing -->
                <tr>
                    <td width=\"100%\" height=\"15\" style=\"font-size:1px; line-height:1px; mso-line-height-rule: exactly;\">&nbsp;</td>
                </tr>
                <!-- /Spacing -->

                </tbody>
            </table>
        </td>
    </tr>
    <!-- end of text content table -->
    </tbody>
</table>

</td>
</tr>
</tbody>
</table>
</td>
</tr>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<!-- End of 2-columns -->
</div>
<div class=\"block\">
    <!-- start of left image -->
    <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"leftimage\">
        <tbody>
        <tr>
            <td>
                <table bgcolor=\"#ffffff\" width=\"580\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\" modulebg=\"edit\">
                    <tbody>

                    <tr>
                        <td>
                            <table width=\"540\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\">
                                <tbody>
                                <tr>
                                    <td>
                                        <!-- start of text content table -->

                                        <!-- mobile spacing -->

                                        <!-- mobile spacing -->
                                        <!-- start of right column -->
                                        <table width=\"540\" align=\"center\" border=\"0\" bgcolor=\"#cccccc\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\">
                                            <tbody>
                                            <!-- title -->
                                            <tr>
                                                <td style=\"font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #666666; padding-top: 5px; text-align:center;line-height: 20px;\" st-title=\"leftimage-title\">
                                                    ";
        // line 531
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.total_price"), "html", null, true);
        echo "
                                                </td>
                                            </tr>
                                            <!-- end of title -->


                                            <!-- Spacing -->
                                            <tr>
                                                <td width=\"100%\" height=\"10\"></td>
                                            </tr>
                                            <!-- button -->
                                            <tr>
                                                <td>
                                                    <table height=\"30\" width=\"100%\" align=\"center\" valign=\"middle\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tablet-button\" st-button=\"edit\">
                                                        <tbody>
                                                        <tr>
                                                            <td width=\"auto\" align=\"center\" valign=\"middle\" height=\"30\" style=\" background-color:#f38200; background-clip: padding-box;font-size:15px; font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300; padding-left:18px; padding-right:18px;\">

                                                                           <span style=\"color: #ffffff; font-weight: 300;\">
                                                                              <span style=\"color: #ffffff; text-align:center;text-decoration: none;\" href=\"#\">";
        // line 550
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "amountTotal", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "currency", array()), "id", array()), "html", null, true);
        echo "</span>
                                                                           </span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <!-- /button -->
                                            </tbody>
                                        </table>
                                        <!-- end of right column -->
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <table width=\"200\" align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"devicewidthinner\">
                                <tbody>
                                <!-- image -->
                                <tr>
                                    <td width=\"200\" align=\"center\">
                                        <img src=\"";
        // line 572
        echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["purchase"]) ? $context["purchase"] : $this->getContext($context, "purchase")), "payMethod", array()), "imgIcon", array()), "shop");
        echo "\" alt=\"\" border=\"0\" style=\"display:block; border:none; outline:none; text-decoration:none;\">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- end of left image -->
</div>


<div class=\"block\">
    <!-- Start of preheader -->
    <table width=\"100%\" bgcolor=\"#f6f4f5\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"backgroundTable\" st-sortable=\"postfooter\">
        <tbody>
        <tr>
            <td width=\"100%\">
                <table width=\"580\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" class=\"devicewidth\">
                    <tbody>
                    <!-- Spacing -->
                    <tr>
                        <td width=\"100%\" height=\"5\"></td>
                    </tr>
                    <!-- Spacing -->
                    <tr>
                        <td align=\"center\" valign=\"middle\" style=\"font-family: Helvetica, arial, sans-serif; font-size: 12px;color: #999999\" st-content=\"preheader\">
                            <a class=\"hlite\" href=\"#\" style=\"text-decoration: none; color: #f38200\">";
        // line 605
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("payment.gamer_email.any_troubles"), "html", null, true);
        echo "</a>
                        </td>
                    </tr>
                    <!-- Spacing -->
                    <tr>
                        <td width=\"100%\" height=\"5\"></td>
                    </tr>
                    <!-- Spacing -->
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- End of preheader -->
</div>

</body></html>





";
        
        $__internal_3b2d03badb65ee743234ad7a9cce20845f2ef3dd98af2d1167b4508192cd7a99->leave($__internal_3b2d03badb65ee743234ad7a9cce20845f2ef3dd98af2d1167b4508192cd7a99_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Payment/email:payment_completed.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  767 => 605,  730 => 572,  703 => 550,  681 => 531,  602 => 457,  594 => 452,  577 => 440,  569 => 435,  555 => 424,  547 => 419,  533 => 408,  525 => 403,  505 => 386,  490 => 374,  482 => 369,  467 => 357,  458 => 351,  417 => 313,  409 => 308,  400 => 302,  392 => 297,  377 => 285,  369 => 280,  354 => 268,  346 => 263,  331 => 251,  323 => 246,  309 => 235,  301 => 230,  286 => 218,  277 => 212,  226 => 163,  220 => 161,  214 => 158,  210 => 157,  206 => 156,  202 => 155,  199 => 154,  197 => 153,  181 => 139,  175 => 137,  168 => 135,  166 => 134,  133 => 103,  40 => 11,  36 => 9,  30 => 7,  28 => 6,  22 => 2,);
    }
}
/* {# purchase \AppBundle\Entity\Purchase #}*/
/* <html xmlns="http://www.w3.org/1999/xhtml"><head>*/
/*     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/*     <title>*/
/*         {% if purchase.usedAppProviderCredentials %}*/
/*             {{ purchase.app.name }}*/
/*         {% else %}*/
/*             Wolopay*/
/*         {% endif %}*/
/*     </title>*/
/*     <style type="text/css">*/
/*         /* Client-specific Styles *//* */
/*         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. *//* */
/*         body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}*/
/*         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. *//* */
/*         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width *//* */
/*         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} /* Force Hotmail to display normal line spacing.  More on that: http://www.emailonacid.com/forum/viewthread/43/ *//* */
/*         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}*/
/*         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}*/
/*         a img {border:none;}*/
/*         .image_fix {display:block;}*/
/*         p {margin: 0px 0px !important;}*/
/* */
/*         table td {border-collapse: collapse;}*/
/*         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }*/
/*         /*a {color: #e95353;text-decoration: none;text-decoration:none!important;}*//* */
/*         /*STYLES*//* */
/*         table[class=full] { width: 100%; clear: both; }*/
/* */
/*         /*################################################*//* */
/*         /*IPAD STYLES*//* */
/*         /*################################################*//* */
/*         @media only screen and (max-width: 640px) {*/
/*             a[href^="tel"], a[href^="sms"] {*/
/*                 text-decoration: none;*/
/*                 color: #ffffff; /* or whatever your want *//* */
/*                 pointer-events: none;*/
/*                 cursor: default;*/
/*             }*/
/*             .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {*/
/*                 text-decoration: default;*/
/*                 color: #ffffff !important;*/
/*                 pointer-events: auto;*/
/*                 cursor: default;*/
/*             }*/
/*             table[class=devicewidth] {width: 440px!important;text-align:center!important;}*/
/*             table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}*/
/*             table[class="sthide"]{display: none!important;}*/
/*             img[class="bigimage"]{width: 420px!important;height:219px!important;}*/
/*             img[class="col2img"]{width: 420px!important;height:258px!important;}*/
/*             img[class="image-banner"]{width: 440px!important;height:106px!important;}*/
/*             td[class="menu"]{text-align:center !important; padding: 0 0 10px 0 !important;}*/
/*             td[class="logo"]{padding:10px 0 5px 0!important;margin: 0 auto !important;}*/
/*             img[class="logo"]{padding:0!important;margin: 0 auto !important;}*/
/* */
/*         }*/
/*         /*##############################################*//* */
/*         /*IPHONE STYLES*//* */
/*         /*##############################################*//* */
/*         @media only screen and (max-width: 480px) {*/
/*             a[href^="tel"], a[href^="sms"] {*/
/*                 text-decoration: none;*/
/*                 color: #ffffff; /* or whatever your want *//* */
/*                 pointer-events: none;*/
/*                 cursor: default;*/
/*             }*/
/*             .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {*/
/*                 text-decoration: default;*/
/*                 color: #ffffff !important;*/
/*                 pointer-events: auto;*/
/*                 cursor: default;*/
/*             }*/
/*             table[class=devicewidth] {width: 280px!important;text-align:center!important;}*/
/*             table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}*/
/*             table[class="sthide"]{display: none!important;}*/
/*             img[class="bigimage"]{width: 260px!important;height:136px!important;}*/
/*             img[class="col2img"]{width: 260px!important;height:160px!important;}*/
/*             img[class="image-banner"]{width: 280px!important;height:68px!important;}*/
/* */
/*         }*/
/*     </style>*/
/* */
/* */
/* </head>*/
/* <body>*/
/* <div class="block">*/
/*     <!-- Start of preheader -->*/
/*     <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader">*/
/*         <tbody>*/
/*         <tr>*/
/*             <td width="100%">*/
/*                 <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">*/
/*                     <tbody>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td width="100%" height="5"></td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td align="right" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 10px;color: #999999" st-content="preheader">*/
/*                             {#<a class="hlite" href="#" style="text-decoration: none; color: #0db9ea">{{ 'payment.gamer_email.dont_read_well' | trans }}</a>#}*/
/*                         </td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td width="100%" height="5"></td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     </tbody>*/
/*                 </table>*/
/*             </td>*/
/*         </tr>*/
/*         </tbody>*/
/*     </table>*/
/*     <!-- End of preheader -->*/
/* </div>*/
/* <div class="block">*/
/*     <!-- start of header -->*/
/*     <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">*/
/*         <tbody>*/
/*         <tr>*/
/*             <td>*/
/*                 <table width="580" bgcolor="#cccccc" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" hlitebg="edit" shadow="edit">*/
/*                     <tbody>*/
/*                     <tr>*/
/*                         <td>*/
/*                             <!-- logo -->*/
/*                             <table width="280" cellpadding="0" cellspacing="0" border="0" align="left" class="devicewidth">*/
/*                                 <tbody>*/
/*                                 <tr>*/
/*                                     <td valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">*/
/*                                         <div class="imgpop">*/
/*                                             {% if purchase.usedAppProviderCredentials %}*/
/*                                                 <img src="{{domain_main}}{% path purchase.app.logo, 'email' %}" alt="logo" border="0" style="display:block; border:none; outline:none; text-decoration:none;" st-image="edit" class="logo">*/
/*                                             {% else %}*/
/*                                                 <img src="{{ asset('img/logo_200x50.png') }}" alt="logo" border="0" style="display:block; border:none; outline:none; text-decoration:none;" st-image="edit" class="logo">*/
/*                                             {% endif %}*/
/* */
/*                                         </div>*/
/*                                     </td>*/
/*                                 </tr>*/
/*                                 </tbody>*/
/*                             </table>*/
/*                             <!-- End of logo -->*/
/*                             <!-- menu -->*/
/*                             <table width="280" cellpadding="0" cellspacing="0" border="0" align="right" class="devicewidth">*/
/*                                 <tbody>*/
/*                                 <tr>*/
/*                                     <td align="right" valign="middle" width="270" style="padding: 10px 0 10px 20px;" class="logo">*/
/*                                         <div class="imgpop" style="padding-right: 10px">*/
/* */
/*                                             {% if purchase.usedAppProviderCredentials %}*/
/*                                                 <span style="color: #fff; font-size: 13px; line-height: 11px;">*/
/*                                                     {{ purchase.app.client.nameCompany }}<br>*/
/*                                                     {{ purchase.app.client.vatNumber }}<br>*/
/*                                                     {{ purchase.app.client.address }}<br>*/
/*                                                     {{ purchase.app.client.postalCode }}<br>*/
/*                                                 </span>*/
/*                                             {% else %}*/
/*                                                 <img src="{{ asset('/bundles/app/app_shop/img/payment/email/datos-wolopay.png') }}" alt="logo" border="0" style="display:block; border:none; outline:none; text-decoration:none;" st-image="edit" class="logo">*/
/*                                             {% endif %}*/
/*                                         </div>*/
/*                                     </td>*/
/*                                 </tr>*/
/*                                 </tbody>*/
/*                             </table>*/
/*                             <!-- End of Menu -->*/
/*                         </td>*/
/*                     </tr>*/
/*                     </tbody>*/
/*                 </table>*/
/*             </td>*/
/*         </tr>*/
/*         </tbody>*/
/*     </table>*/
/*     <!-- end of header -->*/
/* </div>*/
/* */
/* */
/* */
/* */
/* */
/* <div class="block">*/
/* <!-- Start of 2-columns -->*/
/* <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="2columns">*/
/* <tbody>*/
/* <tr>*/
/* <td>*/
/* <table bgcolor="#ffffff" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" modulebg="edit">*/
/* <tbody>*/
/* <tr>*/
/*     <td width="100%" height="20"></td>*/
/* </tr>*/
/* <tr>*/
/* <td>*/
/* <table width="540" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">*/
/* <tbody>*/
/* <tr>*/
/* <td>*/
/* <table width="260" align="left" border="0" cellpadding="0" cellspacing="0" class="devicewidth">*/
/*     <tbody>*/
/* */
/*     <tr>*/
/*         <td>*/
/*             <!-- start of text content table -->*/
/*             <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">*/
/*                 <tbody>*/
/*                 <!-- datos -->*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.transaction_id' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.transaction.id }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.date' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.createdAt | date }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.web_page' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         <a href="#">{{ purchase.app.urlHomeSite }}</a>*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.merchant' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.app.name }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.payment_type' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ ('completed.payment_type_category.' ~ purchase.payment.type) | trans({}, 'shop') }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.product' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ product }}*/
/*                     </td>*/
/*                 </tr>*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer.id' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.gamer.id }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- end datos -->*/
/* */
/*                 <!-- content -->*/
/* */
/*                 <!-- end of content -->*/
/* */
/*                 </tbody>*/
/*             </table>*/
/*         </td>*/
/*     </tr>*/
/*     <!-- end of text content table -->*/
/*     </tbody>*/
/* </table>*/
/* <!-- end of left column -->*/
/* <!-- spacing for mobile devices-->*/
/* <table align="left" border="0" cellpadding="0" cellspacing="0" class="mobilespacing">*/
/*     <tbody>*/
/*     <tr>*/
/*         <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*     </tr>*/
/*     </tbody>*/
/* </table>*/
/* <!-- end of for mobile devices-->*/
/* */
/* <table width="260" align="right" border="0" cellpadding="0" cellspacing="0" class="devicewidth">*/
/*     <tbody>*/
/* */
/*     <tr>*/
/*         <td>*/
/*             <!-- start of text content table -->*/
/*             <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">*/
/*                 <tbody>*/
/*                 <!-- datos -->*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.payment_status' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.completed' | trans }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.your_ip' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ ip }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.n_articles' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         1*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.pay_method' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.payMethod.name }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.country' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ purchase.countryGamer.name }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.price_before_tax' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ beforeTaxes | number_format(2, '.', ',') }} {{purchase.currency.id}}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 14px;background-color: #f6f6f6; color: #333333; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ 'payment.gamer_email.taxes' | trans }}*/
/*                     </td>*/
/*                 </tr>*/
/*                 <tr>*/
/*                     <td style="font-family: Helvetica, arial, sans-serif; font-size: 13px; color: #95a5a6; text-align:center;line-height: 20px;" st-title="2col-title1">*/
/*                         {{ (purchase.amountTotal - beforeTaxes) |number_format(2, '.', ',') }} {{ purchase.currency.id }}*/
/* */
/*                     </td>*/
/*                 </tr>*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="5" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 <!-- end datos -->*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/*                 <!-- content -->*/
/* */
/*                 <!-- end of content -->*/
/*                 <!-- Spacing -->*/
/*                 <tr>*/
/*                     <td width="100%" height="15" style="font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>*/
/*                 </tr>*/
/*                 <!-- /Spacing -->*/
/* */
/*                 </tbody>*/
/*             </table>*/
/*         </td>*/
/*     </tr>*/
/*     <!-- end of text content table -->*/
/*     </tbody>*/
/* </table>*/
/* */
/* </td>*/
/* </tr>*/
/* </tbody>*/
/* </table>*/
/* </td>*/
/* </tr>*/
/* */
/* </tbody>*/
/* </table>*/
/* </td>*/
/* </tr>*/
/* </tbody>*/
/* </table>*/
/* <!-- End of 2-columns -->*/
/* </div>*/
/* <div class="block">*/
/*     <!-- start of left image -->*/
/*     <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="leftimage">*/
/*         <tbody>*/
/*         <tr>*/
/*             <td>*/
/*                 <table bgcolor="#ffffff" width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" modulebg="edit">*/
/*                     <tbody>*/
/* */
/*                     <tr>*/
/*                         <td>*/
/*                             <table width="540" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">*/
/*                                 <tbody>*/
/*                                 <tr>*/
/*                                     <td>*/
/*                                         <!-- start of text content table -->*/
/* */
/*                                         <!-- mobile spacing -->*/
/* */
/*                                         <!-- mobile spacing -->*/
/*                                         <!-- start of right column -->*/
/*                                         <table width="540" align="center" border="0" bgcolor="#cccccc" cellpadding="0" cellspacing="0" class="devicewidthinner">*/
/*                                             <tbody>*/
/*                                             <!-- title -->*/
/*                                             <tr>*/
/*                                                 <td style="font-family: Helvetica, arial, sans-serif; font-size: 18px; color: #666666; padding-top: 5px; text-align:center;line-height: 20px;" st-title="leftimage-title">*/
/*                                                     {{ 'payment.gamer_email.total_price' | trans }}*/
/*                                                 </td>*/
/*                                             </tr>*/
/*                                             <!-- end of title -->*/
/* */
/* */
/*                                             <!-- Spacing -->*/
/*                                             <tr>*/
/*                                                 <td width="100%" height="10"></td>*/
/*                                             </tr>*/
/*                                             <!-- button -->*/
/*                                             <tr>*/
/*                                                 <td>*/
/*                                                     <table height="30" width="100%" align="center" valign="middle" border="0" cellpadding="0" cellspacing="0" class="tablet-button" st-button="edit">*/
/*                                                         <tbody>*/
/*                                                         <tr>*/
/*                                                             <td width="auto" align="center" valign="middle" height="30" style=" background-color:#f38200; background-clip: padding-box;font-size:15px; font-family:Helvetica, arial, sans-serif; text-align:center;  color:#ffffff; font-weight: 300; padding-left:18px; padding-right:18px;">*/
/* */
/*                                                                            <span style="color: #ffffff; font-weight: 300;">*/
/*                                                                               <span style="color: #ffffff; text-align:center;text-decoration: none;" href="#">{{ purchase.amountTotal }} {{ purchase.currency.id }}</span>*/
/*                                                                            </span>*/
/*                                                             </td>*/
/*                                                         </tr>*/
/*                                                         </tbody>*/
/*                                                     </table>*/
/*                                                 </td>*/
/*                                             </tr>*/
/*                                             <!-- /button -->*/
/*                                             </tbody>*/
/*                                         </table>*/
/*                                         <!-- end of right column -->*/
/*                                     </td>*/
/*                                 </tr>*/
/*                                 </tbody>*/
/*                             </table>*/
/* */
/*                             <table width="200" align="center" border="0" cellpadding="0" cellspacing="0" class="devicewidthinner">*/
/*                                 <tbody>*/
/*                                 <!-- image -->*/
/*                                 <tr>*/
/*                                     <td width="200" align="center">*/
/*                                         <img src="{{ domain_main }}{% path purchase.payMethod.imgIcon, 'shop' %}" alt="" border="0" style="display:block; border:none; outline:none; text-decoration:none;">*/
/*                                     </td>*/
/*                                 </tr>*/
/*                                 </tbody>*/
/*                             </table>*/
/*                         </td>*/
/*                     </tr>*/
/* */
/*                     </tbody>*/
/*                 </table>*/
/*             </td>*/
/*         </tr>*/
/*         </tbody>*/
/*     </table>*/
/*     <!-- end of left image -->*/
/* </div>*/
/* */
/* */
/* <div class="block">*/
/*     <!-- Start of preheader -->*/
/*     <table width="100%" bgcolor="#f6f4f5" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="postfooter">*/
/*         <tbody>*/
/*         <tr>*/
/*             <td width="100%">*/
/*                 <table width="580" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">*/
/*                     <tbody>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td width="100%" height="5"></td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td align="center" valign="middle" style="font-family: Helvetica, arial, sans-serif; font-size: 12px;color: #999999" st-content="preheader">*/
/*                             <a class="hlite" href="#" style="text-decoration: none; color: #f38200">{{ 'payment.gamer_email.any_troubles' | trans }}</a>*/
/*                         </td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     <tr>*/
/*                         <td width="100%" height="5"></td>*/
/*                     </tr>*/
/*                     <!-- Spacing -->*/
/*                     </tbody>*/
/*                 </table>*/
/*             </td>*/
/*         </tr>*/
/*         </tbody>*/
/*     </table>*/
/*     <!-- End of preheader -->*/
/* </div>*/
/* */
/* </body></html>*/
/* */
/* */
/* */
/* */
/* */
/* */
