<?php

/* AppBundle:PDF:summary_layout.html.twig */
class __TwigTemplate_78e12297b4233d0cbcfb36dc7b0286ac797dcc6570dee6bd5cd16414c323ee5f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 5
        $this->parent = $this->loadTemplate("base_pdf.html.twig", "AppBundle:PDF:summary_layout.html.twig", 5);
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
        $__internal_a9d16b07c5f68dd6e497a4d23e6a4db2fcda8312176b6173191f4dd0b0c67d99 = $this->env->getExtension("native_profiler");
        $__internal_a9d16b07c5f68dd6e497a4d23e6a4db2fcda8312176b6173191f4dd0b0c67d99->enter($__internal_a9d16b07c5f68dd6e497a4d23e6a4db2fcda8312176b6173191f4dd0b0c67d99_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF:summary_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a9d16b07c5f68dd6e497a4d23e6a4db2fcda8312176b6173191f4dd0b0c67d99->leave($__internal_a9d16b07c5f68dd6e497a4d23e6a4db2fcda8312176b6173191f4dd0b0c67d99_prof);

    }

    // line 6
    public function block_body($context, array $blocks = array())
    {
        $__internal_823b2b84025a0b205fe359adc87a138df5aeb4522bc3ce66fce2d2b130ca74aa = $this->env->getExtension("native_profiler");
        $__internal_823b2b84025a0b205fe359adc87a138df5aeb4522bc3ce66fce2d2b130ca74aa->enter($__internal_823b2b84025a0b205fe359adc87a138df5aeb4522bc3ce66fce2d2b130ca74aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "<div>
    <div style=\"clear: both;\">
        <table style=\"width: 100%;\">
            <tr>
                <td style=\"text-align: center; padding-right: 50px\">
                    <img src=\"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["kernel_root_dir"]) ? $context["kernel_root_dir"] : $this->getContext($context, "kernel_root_dir")), "html", null, true);
        echo "/../web";
        echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["finInvoice"]) ? $context["finInvoice"] : $this->getContext($context, "finInvoice")), "companyFrom", array()), "logo", array()), "pdf");
        echo "\" style=\"clear: both;\">
                </td>
            </tr>
        </table>
    </div>
    <div style=\"padding: 10px 0 100px 0\">

    </div>
    ";
        // line 20
        $this->displayBlock('page', $context, $blocks);
        
        $__internal_823b2b84025a0b205fe359adc87a138df5aeb4522bc3ce66fce2d2b130ca74aa->leave($__internal_823b2b84025a0b205fe359adc87a138df5aeb4522bc3ce66fce2d2b130ca74aa_prof);

    }

    public function block_page($context, array $blocks = array())
    {
        $__internal_0253f3a8b4058443ee06c422f0ce70ae71688b2aae2563edf4a4fdf1ad657370 = $this->env->getExtension("native_profiler");
        $__internal_0253f3a8b4058443ee06c422f0ce70ae71688b2aae2563edf4a4fdf1ad657370->enter($__internal_0253f3a8b4058443ee06c422f0ce70ae71688b2aae2563edf4a4fdf1ad657370_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_0253f3a8b4058443ee06c422f0ce70ae71688b2aae2563edf4a4fdf1ad657370->leave($__internal_0253f3a8b4058443ee06c422f0ce70ae71688b2aae2563edf4a4fdf1ad657370_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF:summary_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 20,  48 => 12,  41 => 7,  35 => 6,  11 => 5,);
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
/*                 <td style="text-align: center; padding-right: 50px">*/
/*                     <img src="{{kernel_root_dir}}/../web{% path finInvoice.companyFrom.logo, 'pdf' %}" style="clear: both;">*/
/*                 </td>*/
/*             </tr>*/
/*         </table>*/
/*     </div>*/
/*     <div style="padding: 10px 0 100px 0">*/
/* */
/*     </div>*/
/*     {% block page '' %}*/
/* {% endblock %}*/
