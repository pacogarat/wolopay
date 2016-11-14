<?php

/* @App/AppShop/layout_secondary.html.twig */
class __TwigTemplate_911085e2e2cadacaad06f95c277e6486500cef12a93b339312d73481213eb0e2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/AppShop/layout_secondary.html.twig", 1);
        $this->blocks = array(
            'page_container' => array($this, 'block_page_container'),
            'title' => array($this, 'block_title'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_69d9baf73e97a816cfc5d8c7de52a9a040b6a0523de5990cff3870cee20d7fd4 = $this->env->getExtension("native_profiler");
        $__internal_69d9baf73e97a816cfc5d8c7de52a9a040b6a0523de5990cff3870cee20d7fd4->enter($__internal_69d9baf73e97a816cfc5d8c7de52a9a040b6a0523de5990cff3870cee20d7fd4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/AppShop/layout_secondary.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_69d9baf73e97a816cfc5d8c7de52a9a040b6a0523de5990cff3870cee20d7fd4->leave($__internal_69d9baf73e97a816cfc5d8c7de52a9a040b6a0523de5990cff3870cee20d7fd4_prof);

    }

    // line 2
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_e0bde857216a1cbb66d89c1b2874c24a289402c96b8e47f88478744aa746ae74 = $this->env->getExtension("native_profiler");
        $__internal_e0bde857216a1cbb66d89c1b2874c24a289402c96b8e47f88478744aa746ae74->enter($__internal_e0bde857216a1cbb66d89c1b2874c24a289402c96b8e47f88478744aa746ae74_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 3
        echo "        <div class=\"container\">

            <div class=\"row voffset2\">
                <div class=\"col-sm-6\" >
                    <h2>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</h2>
                </div>
                <div class=\"col-sm-3 col-sm-offset-2\" >
                    <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("img/logo_180x40.png")), "html", null, true);
        echo "\" style=\"margin: 17px 0 0 0\">
                </div>
            </div>
            <div class=\"row voffset3\">
                ";
        // line 14
        $this->loadTemplate("@App/Partials/flash_msgs.html.twig", "@App/AppShop/layout_secondary.html.twig", 14)->display($context);
        // line 15
        echo "            </div>
            ";
        // line 16
        $this->displayBlock('page', $context, $blocks);
        // line 17
        echo "        </div>

";
        
        $__internal_e0bde857216a1cbb66d89c1b2874c24a289402c96b8e47f88478744aa746ae74->leave($__internal_e0bde857216a1cbb66d89c1b2874c24a289402c96b8e47f88478744aa746ae74_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_f8b861cea89d07fb1b07c435d9ce3031df1d4930b0b62dfe1f706992b90b0b0a = $this->env->getExtension("native_profiler");
        $__internal_f8b861cea89d07fb1b07c435d9ce3031df1d4930b0b62dfe1f706992b90b0b0a->enter($__internal_f8b861cea89d07fb1b07c435d9ce3031df1d4930b0b62dfe1f706992b90b0b0a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "";
        
        $__internal_f8b861cea89d07fb1b07c435d9ce3031df1d4930b0b62dfe1f706992b90b0b0a->leave($__internal_f8b861cea89d07fb1b07c435d9ce3031df1d4930b0b62dfe1f706992b90b0b0a_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_1f2b11223237c456a9203162a8bc2854c1a6490116318fb52026b3280402243b = $this->env->getExtension("native_profiler");
        $__internal_1f2b11223237c456a9203162a8bc2854c1a6490116318fb52026b3280402243b->enter($__internal_1f2b11223237c456a9203162a8bc2854c1a6490116318fb52026b3280402243b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_1f2b11223237c456a9203162a8bc2854c1a6490116318fb52026b3280402243b->leave($__internal_1f2b11223237c456a9203162a8bc2854c1a6490116318fb52026b3280402243b_prof);

    }

    public function getTemplateName()
    {
        return "@App/AppShop/layout_secondary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 16,  77 => 7,  68 => 17,  66 => 16,  63 => 15,  61 => 14,  54 => 10,  48 => 7,  42 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block page_container %}*/
/*         <div class="container">*/
/* */
/*             <div class="row voffset2">*/
/*                 <div class="col-sm-6" >*/
/*                     <h2>{% block title '' %}</h2>*/
/*                 </div>*/
/*                 <div class="col-sm-3 col-sm-offset-2" >*/
/*                     <img src="{{ absolute_url(asset('img/logo_180x40.png')) }}" style="margin: 17px 0 0 0">*/
/*                 </div>*/
/*             </div>*/
/*             <div class="row voffset3">*/
/*                 {% include '@App/Partials/flash_msgs.html.twig' %}*/
/*             </div>*/
/*             {% block page '' %}*/
/*         </div>*/
/* */
/* {% endblock %}*/
/* */
