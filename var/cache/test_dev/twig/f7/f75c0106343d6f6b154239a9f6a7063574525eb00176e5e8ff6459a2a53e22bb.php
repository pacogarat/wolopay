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
        $__internal_4926c30ecde5366a9b02218e48c1c420a4359204831a6a46dbb91f2fa628d459 = $this->env->getExtension("native_profiler");
        $__internal_4926c30ecde5366a9b02218e48c1c420a4359204831a6a46dbb91f2fa628d459->enter($__internal_4926c30ecde5366a9b02218e48c1c420a4359204831a6a46dbb91f2fa628d459_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/billingClientOwes:document_for_client_taxes_for_gateways.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4926c30ecde5366a9b02218e48c1c420a4359204831a6a46dbb91f2fa628d459->leave($__internal_4926c30ecde5366a9b02218e48c1c420a4359204831a6a46dbb91f2fa628d459_prof);

    }

    // line 5
    public function block_body($context, array $blocks = array())
    {
        $__internal_c356a3d1dc37e766422d5998786c6aba2d3f25b24c5dc2d778747ca063ca442d = $this->env->getExtension("native_profiler");
        $__internal_c356a3d1dc37e766422d5998786c6aba2d3f25b24c5dc2d778747ca063ca442d->enter($__internal_c356a3d1dc37e766422d5998786c6aba2d3f25b24c5dc2d778747ca063ca442d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

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
        
        $__internal_c356a3d1dc37e766422d5998786c6aba2d3f25b24c5dc2d778747ca063ca442d->leave($__internal_c356a3d1dc37e766422d5998786c6aba2d3f25b24c5dc2d778747ca063ca442d_prof);

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
