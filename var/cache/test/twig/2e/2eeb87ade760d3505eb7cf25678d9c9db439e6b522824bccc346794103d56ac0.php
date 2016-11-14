<?php

/* AppBundle:AppShop/PaymentRequirements:layout_payment_requirements.html.twig */
class __TwigTemplate_d1e48f396f3a1b694925b75905d2bf25818598f7b75822ee9b7dc67172a1724e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 2
        $this->parent = $this->loadTemplate("@App/AppShop/layout_secondary.html.twig", "AppBundle:AppShop/PaymentRequirements:layout_payment_requirements.html.twig", 2);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'page' => array($this, 'block_page'),
            'title_desc' => array($this, 'block_title_desc'),
            'page_main' => array($this, 'block_page_main'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/AppShop/layout_secondary.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ad74685ff83e1bda7788962a6e4eec230cd36c20dc1f5bf814fdb2d233e9ecfa = $this->env->getExtension("native_profiler");
        $__internal_ad74685ff83e1bda7788962a6e4eec230cd36c20dc1f5bf814fdb2d233e9ecfa->enter($__internal_ad74685ff83e1bda7788962a6e4eec230cd36c20dc1f5bf814fdb2d233e9ecfa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:layout_payment_requirements.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ad74685ff83e1bda7788962a6e4eec230cd36c20dc1f5bf814fdb2d233e9ecfa->leave($__internal_ad74685ff83e1bda7788962a6e4eec230cd36c20dc1f5bf814fdb2d233e9ecfa_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_60f2e24992ac54092f51825d23d781ad16b0f30167ee5f0b60908dc5bbf15cd3 = $this->env->getExtension("native_profiler");
        $__internal_60f2e24992ac54092f51825d23d781ad16b0f30167ee5f0b60908dc5bbf15cd3->enter($__internal_60f2e24992ac54092f51825d23d781ad16b0f30167ee5f0b60908dc5bbf15cd3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.title"), "html", null, true);
        
        $__internal_60f2e24992ac54092f51825d23d781ad16b0f30167ee5f0b60908dc5bbf15cd3->leave($__internal_60f2e24992ac54092f51825d23d781ad16b0f30167ee5f0b60908dc5bbf15cd3_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_d449aa2bc4508747e13210d82a49ed0d5ff66a514957eba4f6fb7acb6d9c1932 = $this->env->getExtension("native_profiler");
        $__internal_d449aa2bc4508747e13210d82a49ed0d5ff66a514957eba4f6fb7acb6d9c1932->enter($__internal_d449aa2bc4508747e13210d82a49ed0d5ff66a514957eba4f6fb7acb6d9c1932_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>
        .form-group{
            margin-bottom: 7px;
        }
        .alert{
            margin: 0px 20px 20px 20px;
        }
    </style>
";
        
        $__internal_d449aa2bc4508747e13210d82a49ed0d5ff66a514957eba4f6fb7acb6d9c1932->leave($__internal_d449aa2bc4508747e13210d82a49ed0d5ff66a514957eba4f6fb7acb6d9c1932_prof);

    }

    // line 15
    public function block_page($context, array $blocks = array())
    {
        $__internal_43f239f9392c144bcd59bb8e7dd05a082cb54796340e781a9b508f7bd211a5c7 = $this->env->getExtension("native_profiler");
        $__internal_43f239f9392c144bcd59bb8e7dd05a082cb54796340e781a9b508f7bd211a5c7->enter($__internal_43f239f9392c144bcd59bb8e7dd05a082cb54796340e781a9b508f7bd211a5c7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 16
        echo "    <div class=\"row\">
        <div class=\"col-md-12\">
            <div class=\"col-sm-12 voffset2\">
                ";
        // line 19
        $this->displayBlock('title_desc', $context, $blocks);
        // line 20
        echo "            </div>
            <div style=\"max-width: 700px; margin: 0 auto\">
                ";
        // line 22
        $this->displayBlock('page_main', $context, $blocks);
        // line 23
        echo "            </div>
        </div>
    </div>
    <div class=\"row\" style=\"margin-top: 40px\">
        <div class=\"col-sd-6\">
            ";
        // line 28
        if ($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "app", array()), "logo", array())) {
            // line 29
            echo "                <img src=\"";
            echo twig_escape_filter($this->env, (isset($context["domain_main"]) ? $context["domain_main"] : $this->getContext($context, "domain_main")), "html", null, true);
            echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "app", array()), "logo", array()), "shopping");
            echo "\">
            ";
        }
        // line 31
        echo "        </div>
    </div>

";
        
        $__internal_43f239f9392c144bcd59bb8e7dd05a082cb54796340e781a9b508f7bd211a5c7->leave($__internal_43f239f9392c144bcd59bb8e7dd05a082cb54796340e781a9b508f7bd211a5c7_prof);

    }

    // line 19
    public function block_title_desc($context, array $blocks = array())
    {
        $__internal_21b66751f227c19aca21aef6e9a4c3c7eef95846a96ee75db92c80f6f0465f2c = $this->env->getExtension("native_profiler");
        $__internal_21b66751f227c19aca21aef6e9a4c3c7eef95846a96ee75db92c80f6f0465f2c->enter($__internal_21b66751f227c19aca21aef6e9a4c3c7eef95846a96ee75db92c80f6f0465f2c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title_desc"));

        echo "";
        
        $__internal_21b66751f227c19aca21aef6e9a4c3c7eef95846a96ee75db92c80f6f0465f2c->leave($__internal_21b66751f227c19aca21aef6e9a4c3c7eef95846a96ee75db92c80f6f0465f2c_prof);

    }

    // line 22
    public function block_page_main($context, array $blocks = array())
    {
        $__internal_449cb6aae7b8770fe161cdb45d1b491fe68713aab42b6c4eecbbfad66ae5ecb0 = $this->env->getExtension("native_profiler");
        $__internal_449cb6aae7b8770fe161cdb45d1b491fe68713aab42b6c4eecbbfad66ae5ecb0->enter($__internal_449cb6aae7b8770fe161cdb45d1b491fe68713aab42b6c4eecbbfad66ae5ecb0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_main"));

        echo "";
        
        $__internal_449cb6aae7b8770fe161cdb45d1b491fe68713aab42b6c4eecbbfad66ae5ecb0->leave($__internal_449cb6aae7b8770fe161cdb45d1b491fe68713aab42b6c4eecbbfad66ae5ecb0_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/PaymentRequirements:layout_payment_requirements.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  131 => 22,  119 => 19,  109 => 31,  102 => 29,  100 => 28,  93 => 23,  91 => 22,  87 => 20,  85 => 19,  80 => 16,  74 => 15,  56 => 5,  50 => 4,  38 => 3,  11 => 2,);
    }
}
/* {# pmpc \AppBundle\Entity\PayMethodProviderHasCountry #}*/
/* {% extends "@App/AppShop/layout_secondary.html.twig" %}*/
/* {% block title %}{{ 'form.gamer_email_type.title' | trans }}{% endblock %}*/
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/*     <style>*/
/*         .form-group{*/
/*             margin-bottom: 7px;*/
/*         }*/
/*         .alert{*/
/*             margin: 0px 20px 20px 20px;*/
/*         }*/
/*     </style>*/
/* {% endblock %}*/
/* {% block page %}*/
/*     <div class="row">*/
/*         <div class="col-md-12">*/
/*             <div class="col-sm-12 voffset2">*/
/*                 {% block title_desc '' %}*/
/*             </div>*/
/*             <div style="max-width: 700px; margin: 0 auto">*/
/*                 {% block page_main '' %}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/*     <div class="row" style="margin-top: 40px">*/
/*         <div class="col-sd-6">*/
/*             {% if (transaction.app.logo) %}*/
/*                 <img src="{{domain_main}}{% path transaction.app.logo, 'shopping' %}">*/
/*             {% endif %}*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock %}*/
