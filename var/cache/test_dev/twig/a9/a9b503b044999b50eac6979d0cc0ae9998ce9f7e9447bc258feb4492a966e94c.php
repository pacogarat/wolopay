<?php

/* AppBundle:PDF:invoice_layout.html.twig */
class __TwigTemplate_89b8966b5a3723b6703bbb09b54514eba8a29d45986f61f33195253cd0b2df1c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 5
        $this->parent = $this->loadTemplate("base_pdf.html.twig", "AppBundle:PDF:invoice_layout.html.twig", 5);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base_pdf.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_69711069c4a031765b5d97cfd3fbbae0a5fa13542a09fb247684fd8037ba9ea2 = $this->env->getExtension("native_profiler");
        $__internal_69711069c4a031765b5d97cfd3fbbae0a5fa13542a09fb247684fd8037ba9ea2->enter($__internal_69711069c4a031765b5d97cfd3fbbae0a5fa13542a09fb247684fd8037ba9ea2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF:invoice_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_69711069c4a031765b5d97cfd3fbbae0a5fa13542a09fb247684fd8037ba9ea2->leave($__internal_69711069c4a031765b5d97cfd3fbbae0a5fa13542a09fb247684fd8037ba9ea2_prof);

    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        $__internal_9100f6dbdfae3c69a85af5301744f97349b395d4f9610d15d90b02f0c66ae869 = $this->env->getExtension("native_profiler");
        $__internal_9100f6dbdfae3c69a85af5301744f97349b395d4f9610d15d90b02f0c66ae869->enter($__internal_9100f6dbdfae3c69a85af5301744f97349b395d4f9610d15d90b02f0c66ae869_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "<div>
    <div style=\"clear: both;\">
        <table style=\"width: 100%;\">
            <tr>
                <td style=\"width: 70%;\">
                    ";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "nameCompany", array()), "html", null, true);
        echo "<br>
                    CIF: ";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "cif", array()), "html", null, true);
        echo "<br>
                    ";
        // line 14
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "address", array()), "html", null, true);
        echo "<br>
                    ";
        // line 15
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "country", array()), "name", array()), "html", null, true);
        echo " PC: ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "postalCode", array()), "html", null, true);
        echo "
                </td>
                <td style=\"text-align: center; padding-right: 50px\">
                    <img src=\"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["kernel_root_dir"]) ? $context["kernel_root_dir"] : $this->getContext($context, "kernel_root_dir")), "html", null, true);
        echo "/../web";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "logo", array()), "pdf");
        echo "\" style=\"clear: both;\">
                </td>
            </tr>
        </table>
    </div>
    <div style=\"padding: 50px 0 100px 0\">

        ";
        // line 26
        echo "        <table>
            <tr>
                <td style=\"width: 55%;font-weight: bold; font-size: 1.2em\">
                    ";
        // line 29
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyTo", array()), "nameCompany", array()), "html", null, true);
        echo "<br>
                    Attn. Finance Department<br>
                    ";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyTo", array()), "address", array()), "html", null, true);
        echo "<br>
                    ";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyTo", array()), "postalCode", array()), "html", null, true);
        echo "<br>
                    ";
        // line 33
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyTo", array()), "country", array()), "name", array()), "html", null, true);
        echo "
                </td>
                <td>
                    <table style=\"width: 100%\">
                        <tr>
                            <td>Invoice Number:</td>
                            <td class=\"extra_padding\">";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "invoiceNumber", array()), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Invoice Date:</td>
                            <td class=\"extra_padding\">";
        // line 43
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "createdAt", array())), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td class=\"extra_padding\">";
        // line 47
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "title", array()), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>Period:</td>
                            <td class=\"extra_padding\">";
        // line 51
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "referenceDate", array()), "M Y"), "html", null, true);
        echo "</td>
                        </tr>
                        <tr>
                            <td>VAT Number:</td>
                            <td class=\"extra_padding\">";
        // line 55
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyTo", array()), "vatNumber", array()), "html", null, true);
        echo "</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
    ";
        // line 63
        $this->displayBlock('page', $context, $blocks);
        
        $__internal_9100f6dbdfae3c69a85af5301744f97349b395d4f9610d15d90b02f0c66ae869->leave($__internal_9100f6dbdfae3c69a85af5301744f97349b395d4f9610d15d90b02f0c66ae869_prof);

    }

    public function block_page($context, array $blocks = array())
    {
        $__internal_cae6909223d5b364afbab018ff5d417de61403ee4936d9c2e5943aef3dc84ddd = $this->env->getExtension("native_profiler");
        $__internal_cae6909223d5b364afbab018ff5d417de61403ee4936d9c2e5943aef3dc84ddd->enter($__internal_cae6909223d5b364afbab018ff5d417de61403ee4936d9c2e5943aef3dc84ddd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_cae6909223d5b364afbab018ff5d417de61403ee4936d9c2e5943aef3dc84ddd->leave($__internal_cae6909223d5b364afbab018ff5d417de61403ee4936d9c2e5943aef3dc84ddd_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF:invoice_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  146 => 63,  135 => 55,  128 => 51,  121 => 47,  114 => 43,  107 => 39,  98 => 33,  94 => 32,  90 => 31,  85 => 29,  80 => 26,  68 => 18,  60 => 15,  56 => 14,  52 => 13,  48 => 12,  41 => 7,  35 => 6,  11 => 5,);
    }
}
/* {# client \AppBundle\Entity\Client #}*/
/* {# finInvoice \AppBundle\Entity\FinInvoice #}*/
/* {# storageCurrencies \AppBundle\Entity\NotPersisted\StorageCurrencyMoney #}*/
/* {# money \AppBundle\Entity\NotPersisted\Money #}*/
/* {% extends 'base_pdf.html.twig' %}*/
/* {% block body %}*/
/* <div>*/
/*     <div style="clear: both;">*/
/*         <table style="width: 100%;">*/
/*             <tr>*/
/*                 <td style="width: 70%;">*/
/*                     {{ finInvoice.companyFrom.nameCompany }}<br>*/
/*                     CIF: {{ finInvoice.companyFrom.cif }}<br>*/
/*                     {{ finInvoice.companyFrom.address }}<br>*/
/*                     {{ finInvoice.companyFrom.country.name }} PC: {{ finInvoice.companyFrom.postalCode }}*/
/*                 </td>*/
/*                 <td style="text-align: center; padding-right: 50px">*/
/*                     <img src="{{kernel_root_dir}}/../web{% path finInvoice.companyFrom.logo, 'pdf' %}" style="clear: both;">*/
/*                 </td>*/
/*             </tr>*/
/*         </table>*/
/*     </div>*/
/*     <div style="padding: 50px 0 100px 0">*/
/* */
/*         {#Client details#}*/
/*         <table>*/
/*             <tr>*/
/*                 <td style="width: 55%;font-weight: bold; font-size: 1.2em">*/
/*                     {{ finInvoice.companyTo.nameCompany }}<br>*/
/*                     Attn. Finance Department<br>*/
/*                     {{ finInvoice.companyTo.address }}<br>*/
/*                     {{ finInvoice.companyTo.postalCode }}<br>*/
/*                     {{ finInvoice.companyTo.country.name }}*/
/*                 </td>*/
/*                 <td>*/
/*                     <table style="width: 100%">*/
/*                         <tr>*/
/*                             <td>Invoice Number:</td>*/
/*                             <td class="extra_padding">{{ finInvoice.invoiceNumber }}</td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td>Invoice Date:</td>*/
/*                             <td class="extra_padding">{{ finInvoice.createdAt |date }}</td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td>Description:</td>*/
/*                             <td class="extra_padding">{{ finInvoice.title }}</td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td>Period:</td>*/
/*                             <td class="extra_padding">{{ finInvoice.referenceDate | date('M Y') }}</td>*/
/*                         </tr>*/
/*                         <tr>*/
/*                             <td>VAT Number:</td>*/
/*                             <td class="extra_padding">{{ finInvoice.companyTo.vatNumber }}</td>*/
/*                         </tr>*/
/*                     </table>*/
/*                 </td>*/
/*             </tr>*/
/*         </table>*/
/* */
/*     </div>*/
/*     {% block page '' %}*/
/* {% endblock %}*/
