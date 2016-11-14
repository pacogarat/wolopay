<?php

/* AppBundle:Sonata/Article:import_via_csv.html.twig */
class __TwigTemplate_5c4b1ac9c350a15405a347144173e37ec440c772b8d6dc49ec8f2427b43cfa76 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "AppBundle:Sonata/Article:import_via_csv.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e065d2a57f16b5aa7f6433bbc5985d6d2c3cb1a1f9348b600b1bd891dff70e28 = $this->env->getExtension("native_profiler");
        $__internal_e065d2a57f16b5aa7f6433bbc5985d6d2c3cb1a1f9348b600b1bd891dff70e28->enter($__internal_e065d2a57f16b5aa7f6433bbc5985d6d2c3cb1a1f9348b600b1bd891dff70e28_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata/Article:import_via_csv.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e065d2a57f16b5aa7f6433bbc5985d6d2c3cb1a1f9348b600b1bd891dff70e28->leave($__internal_e065d2a57f16b5aa7f6433bbc5985d6d2c3cb1a1f9348b600b1bd891dff70e28_prof);

    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        $__internal_94d7ac7b41da17f854dd2b42371c897b782a33bd3cb7ef7b74f62c94eb59b534 = $this->env->getExtension("native_profiler");
        $__internal_94d7ac7b41da17f854dd2b42371c897b782a33bd3cb7ef7b74f62c94eb59b534->enter($__internal_94d7ac7b41da17f854dd2b42371c897b782a33bd3cb7ef7b74f62c94eb59b534_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 4
        echo "
";
        // line 5
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
    <br><br>
<p>
    Before execute this query, (<b>Replace idJuego, IdItem values, m.IdCategoria = 1 Simple payment , 2 subscription, 3 promotional code</b>)
    <br>If it is SMS or voice it won't be inserted his paymethods
</p>
<code>
    <pre>
SELECT
    a.cantidad, ',', apc.Precio, ',', apc.MonedaReal, ',', p.ShortName, ',', replace(m.descripcion, ',',' '), ',', p.Name, ','
    , m.IdCategoria, ',', i.description, ',', SMS.ShortCode, ',', SMS.Precio, ',', SMS.Moneda, ',', Operadora.ShortName
FROM
    MedioPago m
    inner join MedioPagoConcreto mpc on (m.idMedioPago = mpc.idMedioPago)
    inner join ArticuloMedioPagoConcreto apc on (apc.idMedioConcreto = mpc.idMedioConcreto)
    inner join Articulo a on (a.IdArticulo = apc.IdArticulo)
    inner join Item i on (i.IdItem= a.IdItem)
    inner join Pais p on (p.CodigoPais = m.CodigoPais)
    left join SMS on (SMS.idMedioPago = m.idMedioPago)
    left join SMS_Operadora on (SMS_Operadora.idMedioPago = SMS.idMedioPago)
    left join Operadora on (Operadora.IdOperadora = SMS_Operadora.IdOperadora)
where
    mpc.IdJuego=<b>22</b> And a.IdItem=<b>38</b> And m.IdCategoria=<b>1</b>

    order by cantidad;
    </pre>
</code>

";
        
        $__internal_94d7ac7b41da17f854dd2b42371c897b782a33bd3cb7ef7b74f62c94eb59b534->leave($__internal_94d7ac7b41da17f854dd2b42371c897b782a33bd3cb7ef7b74f62c94eb59b534_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata/Article:import_via_csv.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:action.html.twig' %}*/
/* */
/* {% block content %}*/
/* */
/* {{ form(form) }}*/
/*     <br><br>*/
/* <p>*/
/*     Before execute this query, (<b>Replace idJuego, IdItem values, m.IdCategoria = 1 Simple payment , 2 subscription, 3 promotional code</b>)*/
/*     <br>If it is SMS or voice it won't be inserted his paymethods*/
/* </p>*/
/* <code>*/
/*     <pre>*/
/* SELECT*/
/*     a.cantidad, ',', apc.Precio, ',', apc.MonedaReal, ',', p.ShortName, ',', replace(m.descripcion, ',',' '), ',', p.Name, ','*/
/*     , m.IdCategoria, ',', i.description, ',', SMS.ShortCode, ',', SMS.Precio, ',', SMS.Moneda, ',', Operadora.ShortName*/
/* FROM*/
/*     MedioPago m*/
/*     inner join MedioPagoConcreto mpc on (m.idMedioPago = mpc.idMedioPago)*/
/*     inner join ArticuloMedioPagoConcreto apc on (apc.idMedioConcreto = mpc.idMedioConcreto)*/
/*     inner join Articulo a on (a.IdArticulo = apc.IdArticulo)*/
/*     inner join Item i on (i.IdItem= a.IdItem)*/
/*     inner join Pais p on (p.CodigoPais = m.CodigoPais)*/
/*     left join SMS on (SMS.idMedioPago = m.idMedioPago)*/
/*     left join SMS_Operadora on (SMS_Operadora.idMedioPago = SMS.idMedioPago)*/
/*     left join Operadora on (Operadora.IdOperadora = SMS_Operadora.IdOperadora)*/
/* where*/
/*     mpc.IdJuego=<b>22</b> And a.IdItem=<b>38</b> And m.IdCategoria=<b>1</b>*/
/* */
/*     order by cantidad;*/
/*     </pre>*/
/* </code>*/
/* */
/* {% endblock %}*/
