<?php

/* AppBundle:PDF/partials:deposit_details.html.twig */
class __TwigTemplate_2624cb502cc993656078bd72d1c3f204142faa7054759b41b19163b535d4f3df extends Twig_Template
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
        $__internal_2ba48561ddc335702420c101e54698d0a1ffc45d0338d63a76a1567a07ada15c = $this->env->getExtension("native_profiler");
        $__internal_2ba48561ddc335702420c101e54698d0a1ffc45d0338d63a76a1567a07ada15c->enter($__internal_2ba48561ddc335702420c101e54698d0a1ffc45d0338d63a76a1567a07ada15c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/partials:deposit_details.html.twig"));

        // line 2
        echo "<div class=\"h2\">Notes</div>

<br>

";
        // line 6
        $this->loadTemplate("@App/PDF/partials/extra_concepts_desc.html.twig", "AppBundle:PDF/partials:deposit_details.html.twig", 6)->display($context);
        // line 7
        echo "
";
        // line 8
        if ((isset($context["balanceRequirementAdded"]) ? $context["balanceRequirementAdded"] : $this->getContext($context, "balanceRequirementAdded"))) {
            // line 9
            echo "    Deposit balance requirement increased: ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["balanceRequirementAdded"]) ? $context["balanceRequirementAdded"] : $this->getContext($context, "balanceRequirementAdded")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "<br><br>
";
        }
        // line 11
        echo "
";
        // line 12
        if ((isset($context["depositExtraPay"]) ? $context["depositExtraPay"] : $this->getContext($context, "depositExtraPay"))) {
            // line 13
            echo "    Deposit adjustment: ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["depositExtraPay"]) ? $context["depositExtraPay"] : $this->getContext($context, "depositExtraPay")), 2, ".", ","), "html", null, true);
            echo "<br>
";
        }
        // line 15
        echo "
Deposit balance: ";
        // line 16
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["deposit"]) ? $context["deposit"] : $this->getContext($context, "deposit")), "amountBalance", array()), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "<br>
Deposit balance requirement: ";
        // line 17
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute((isset($context["deposit"]) ? $context["deposit"] : $this->getContext($context, "deposit")), "amountBalanceRequirement", array()), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
        echo "<br><br>

";
        // line 19
        if ((isset($context["othersInvoices"]) ? $context["othersInvoices"] : $this->getContext($context, "othersInvoices"))) {
            // line 20
            echo "    The total is offset by ";
            echo twig_escape_filter($this->env, (isset($context["othersInvoices"]) ? $context["othersInvoices"] : $this->getContext($context, "othersInvoices")), "html", null, true);
            echo " invoices.<br>
";
        }
        // line 22
        echo "
";
        // line 23
        if (((isset($context["realTotal"]) ? $context["realTotal"] : $this->getContext($context, "realTotal")) > 0)) {
            // line 24
            echo "    We will make a transfer to your account of the amount: ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["realTotal"]) ? $context["realTotal"] : $this->getContext($context, "realTotal")), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
";
        } elseif (        // line 25
(isset($context["othersInvoices"]) ? $context["othersInvoices"] : $this->getContext($context, "othersInvoices"))) {
            // line 26
            echo "    It would be a total of: ";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, 0, 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "currency", array()), "symbol", array()), "html", null, true);
            echo "
";
        }
        
        $__internal_2ba48561ddc335702420c101e54698d0a1ffc45d0338d63a76a1567a07ada15c->leave($__internal_2ba48561ddc335702420c101e54698d0a1ffc45d0338d63a76a1567a07ada15c_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/partials:deposit_details.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 26,  90 => 25,  83 => 24,  81 => 23,  78 => 22,  72 => 20,  70 => 19,  63 => 17,  57 => 16,  54 => 15,  48 => 13,  46 => 12,  43 => 11,  35 => 9,  33 => 8,  30 => 7,  28 => 6,  22 => 2,);
    }
}
/* {# deposit \AppBundle\Entity\ClientDeposit #}*/
/* <div class="h2">Notes</div>*/
/* */
/* <br>*/
/* */
/* {% include '@App/PDF/partials/extra_concepts_desc.html.twig' %}*/
/* */
/* {% if balanceRequirementAdded %}*/
/*     Deposit balance requirement increased: {{ balanceRequirementAdded | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}<br><br>*/
/* {% endif %}*/
/* */
/* {% if depositExtraPay %}*/
/*     Deposit adjustment: {{ depositExtraPay | number_format(2,'.', ',') }}<br>*/
/* {% endif %}*/
/* */
/* Deposit balance: {{ deposit.amountBalance | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}<br>*/
/* Deposit balance requirement: {{ deposit.amountBalanceRequirement | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}<br><br>*/
/* */
/* {% if othersInvoices %}*/
/*     The total is offset by {{ othersInvoices }} invoices.<br>*/
/* {% endif %}*/
/* */
/* {% if realTotal > 0 %}*/
/*     We will make a transfer to your account of the amount: {{ realTotal | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/* {% elseif othersInvoices %}*/
/*     It would be a total of: {{ 0 | number_format(2,'.', ',') }} {{ finInvoice.currency.symbol }}*/
/* {% endif %}*/
/* */
