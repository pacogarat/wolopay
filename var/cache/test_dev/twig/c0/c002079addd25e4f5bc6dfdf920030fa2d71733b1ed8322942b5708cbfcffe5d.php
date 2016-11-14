<?php

/* AppBundle:AppShop/Shop/widget:shop_only_html.html.twig */
class __TwigTemplate_eb53847b2c090dc23866ce875efc3e868a9178e0f23f9d1aa55cbff064f92b92 extends Twig_Template
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
        $__internal_04c2146bea0894a687ca729c4e17c24ccdac90a8d19e7e12d73084a26367b02a = $this->env->getExtension("native_profiler");
        $__internal_04c2146bea0894a687ca729c4e17c24ccdac90a8d19e7e12d73084a26367b02a->enter($__internal_04c2146bea0894a687ca729c4e17c24ccdac90a8d19e7e12d73084a26367b02a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/widget:shop_only_html.html.twig"));

        // line 2
        echo "
    ";
        // line 3
        $this->loadTemplate("@App/AppShop/Shop/partials/shop_body.html.twig", "AppBundle:AppShop/Shop/widget:shop_only_html.html.twig", 3)->display(array_merge($context, array("box_windows" => $this->renderBlock("box_windows", $context, $blocks), "top_options" => $this->renderBlock("top_options", $context, $blocks), "menu" => $this->renderBlock("menu", $context, $blocks), "page" => $this->renderBlock("page", $context, $blocks), "extra_footer" => $this->renderBlock("extra_footer", $context, $blocks))));
        
        $__internal_04c2146bea0894a687ca729c4e17c24ccdac90a8d19e7e12d73084a26367b02a->leave($__internal_04c2146bea0894a687ca729c4e17c24ccdac90a8d19e7e12d73084a26367b02a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/widget:shop_only_html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 3,  22 => 2,);
    }
}
/* {# transaction \AppBundle\Entity\Transaction #}*/
/* */
/*     {% include '@App/AppShop/Shop/partials/shop_body.html.twig' with*/
/*         {'box_windows': block('box_windows'), 'top_options': block('top_options'),*/
/*         'menu': block('menu'),'page': block('page'),'extra_footer': block('extra_footer')*/
/*     } %}*/
/* */
