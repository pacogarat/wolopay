<?php

/* AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig */
class __TwigTemplate_85cad442a43d7fde261b88d3cbde0ea1acf608b016124009f5e8d469ff505183 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 4
        $this->parent = $this->loadTemplate("base_pdf.html.twig", "AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig", 4);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base_pdf.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_31d09d9137e89ded317b4688b1dc034c1e2e90a3d28e179c723b4a11b60a9167 = $this->env->getExtension("native_profiler");
        $__internal_31d09d9137e89ded317b4688b1dc034c1e2e90a3d28e179c723b4a11b60a9167->enter($__internal_31d09d9137e89ded317b4688b1dc034c1e2e90a3d28e179c723b4a11b60a9167_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_31d09d9137e89ded317b4688b1dc034c1e2e90a3d28e179c723b4a11b60a9167->leave($__internal_31d09d9137e89ded317b4688b1dc034c1e2e90a3d28e179c723b4a11b60a9167_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_e948bc23da421e687d2a2b9a4c71877a199bc5ad534a2cf13540e05f3e33b2cc = $this->env->getExtension("native_profiler");
        $__internal_e948bc23da421e687d2a2b9a4c71877a199bc5ad534a2cf13540e05f3e33b2cc->enter($__internal_e948bc23da421e687d2a2b9a4c71877a199bc5ad534a2cf13540e05f3e33b2cc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 6
        echo "
    <div style=\"margin-bottom: 20px\">
        <table style=\"clear: both;\" cellspacing=\"0\" cellpadding=\"2\">
            <tr>
                <td>
                    You can find below the approximate amounts that  you have to pay as “taxes” to the corresponding authorities, for the sales have been collected and not paid by Wolopay.
                    It’s your responsibility to pay these taxes in time.
                </td>
                <td>
                    <img src=\"";
        // line 15
        echo twig_escape_filter($this->env, (isset($context["kernel_root_dir"]) ? $context["kernel_root_dir"] : $this->getContext($context, "kernel_root_dir")), "html", null, true);
        echo "/../web/img/logo_200x50.png\" style=\"clear: both;\">
                </td>
            </tr>
        </table>


        <div class=\"h3\" style=\"margin-top: 30px\">You must pay this taxes for month: ";
        // line 21
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, (isset($context["referenceDate"]) ? $context["referenceDate"] : $this->getContext($context, "referenceDate")), "F Y"), "html", null, true);
        echo " </div>

    </div>

    ";
        // line 25
        $this->loadTemplate("@App/PDF/partials/taxes_for_gateways.html.twig", "AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig", 25)->display($context);
        
        $__internal_e948bc23da421e687d2a2b9a4c71877a199bc5ad534a2cf13540e05f3e33b2cc->leave($__internal_e948bc23da421e687d2a2b9a4c71877a199bc5ad534a2cf13540e05f3e33b2cc_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 25,  60 => 21,  51 => 15,  40 => 6,  34 => 5,  11 => 4,);
    }
}
/* {# client \AppBundle\Entity\Client #}*/
/* {# wolopay \AppBundle\Entity\Client #}*/
/* {# referenceDate \DateTime #}*/
/* {% extends 'base_pdf.html.twig' %}*/
/* {% block body %}*/
/* */
/*     <div style="margin-bottom: 20px">*/
/*         <table style="clear: both;" cellspacing="0" cellpadding="2">*/
/*             <tr>*/
/*                 <td>*/
/*                     You can find below the approximate amounts that  you have to pay as “taxes” to the corresponding authorities, for the sales have been collected and not paid by Wolopay.*/
/*                     It’s your responsibility to pay these taxes in time.*/
/*                 </td>*/
/*                 <td>*/
/*                     <img src="{{kernel_root_dir}}/../web/img/logo_200x50.png" style="clear: both;">*/
/*                 </td>*/
/*             </tr>*/
/*         </table>*/
/* */
/* */
/*         <div class="h3" style="margin-top: 30px">You must pay this taxes for month: {{ referenceDate | date("F Y") }} </div>*/
/* */
/*     </div>*/
/* */
/*     {% include '@App/PDF/partials/taxes_for_gateways.html.twig' %}*/
/* {% endblock %}*/
