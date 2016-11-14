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
        $__internal_f645ff43cb1dafc7db7ed5677f881b416ab388af0ecc3948e6d1c128218d7890 = $this->env->getExtension("native_profiler");
        $__internal_f645ff43cb1dafc7db7ed5677f881b416ab388af0ecc3948e6d1c128218d7890->enter($__internal_f645ff43cb1dafc7db7ed5677f881b416ab388af0ecc3948e6d1c128218d7890_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/PaymentRequirements:layout_payment_requirements.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f645ff43cb1dafc7db7ed5677f881b416ab388af0ecc3948e6d1c128218d7890->leave($__internal_f645ff43cb1dafc7db7ed5677f881b416ab388af0ecc3948e6d1c128218d7890_prof);

    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        $__internal_3bfc8c8df418edd41de6d93bb054b03047cf3c81fa3b3a75a461f43a7c8881eb = $this->env->getExtension("native_profiler");
        $__internal_3bfc8c8df418edd41de6d93bb054b03047cf3c81fa3b3a75a461f43a7c8881eb->enter($__internal_3bfc8c8df418edd41de6d93bb054b03047cf3c81fa3b3a75a461f43a7c8881eb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_email_type.title"), "html", null, true);
        
        $__internal_3bfc8c8df418edd41de6d93bb054b03047cf3c81fa3b3a75a461f43a7c8881eb->leave($__internal_3bfc8c8df418edd41de6d93bb054b03047cf3c81fa3b3a75a461f43a7c8881eb_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_9409573ab9d74ea27f387aef477455df4b729d427d6b25ea63ab521af36f2010 = $this->env->getExtension("native_profiler");
        $__internal_9409573ab9d74ea27f387aef477455df4b729d427d6b25ea63ab521af36f2010->enter($__internal_9409573ab9d74ea27f387aef477455df4b729d427d6b25ea63ab521af36f2010_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_9409573ab9d74ea27f387aef477455df4b729d427d6b25ea63ab521af36f2010->leave($__internal_9409573ab9d74ea27f387aef477455df4b729d427d6b25ea63ab521af36f2010_prof);

    }

    // line 15
    public function block_page($context, array $blocks = array())
    {
        $__internal_dfa88a3a1b8d8992742cb40370d04549e7702d12db69e4b2b47a5cfe5e302cee = $this->env->getExtension("native_profiler");
        $__internal_dfa88a3a1b8d8992742cb40370d04549e7702d12db69e4b2b47a5cfe5e302cee->enter($__internal_dfa88a3a1b8d8992742cb40370d04549e7702d12db69e4b2b47a5cfe5e302cee_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

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
        
        $__internal_dfa88a3a1b8d8992742cb40370d04549e7702d12db69e4b2b47a5cfe5e302cee->leave($__internal_dfa88a3a1b8d8992742cb40370d04549e7702d12db69e4b2b47a5cfe5e302cee_prof);

    }

    // line 19
    public function block_title_desc($context, array $blocks = array())
    {
        $__internal_2431c87244236aecf787d581d7424f3803ae0db100786f4205b1b3e8126bd20c = $this->env->getExtension("native_profiler");
        $__internal_2431c87244236aecf787d581d7424f3803ae0db100786f4205b1b3e8126bd20c->enter($__internal_2431c87244236aecf787d581d7424f3803ae0db100786f4205b1b3e8126bd20c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title_desc"));

        echo "";
        
        $__internal_2431c87244236aecf787d581d7424f3803ae0db100786f4205b1b3e8126bd20c->leave($__internal_2431c87244236aecf787d581d7424f3803ae0db100786f4205b1b3e8126bd20c_prof);

    }

    // line 22
    public function block_page_main($context, array $blocks = array())
    {
        $__internal_560413cf3c60eacd8db8b852ee9731d244ec5062e5f9b42353b5df70ce0c9024 = $this->env->getExtension("native_profiler");
        $__internal_560413cf3c60eacd8db8b852ee9731d244ec5062e5f9b42353b5df70ce0c9024->enter($__internal_560413cf3c60eacd8db8b852ee9731d244ec5062e5f9b42353b5df70ce0c9024_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_main"));

        echo "";
        
        $__internal_560413cf3c60eacd8db8b852ee9731d244ec5062e5f9b42353b5df70ce0c9024->leave($__internal_560413cf3c60eacd8db8b852ee9731d244ec5062e5f9b42353b5df70ce0c9024_prof);

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
