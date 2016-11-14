<?php

/* AppBundle:AppShop/Support:gamer.html.twig */
class __TwigTemplate_64d905b3402799a3a5300b2bf42e9cf08f90fcfa96051c22cdafa5eaccc0fce1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/AppShop/layout_secondary.html.twig", "AppBundle:AppShop/Support:gamer.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/AppShop/layout_secondary.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f23824b812bd203987cf81266994ddb125d0181641e11bf352dae3d2466b2394 = $this->env->getExtension("native_profiler");
        $__internal_f23824b812bd203987cf81266994ddb125d0181641e11bf352dae3d2466b2394->enter($__internal_f23824b812bd203987cf81266994ddb125d0181641e11bf352dae3d2466b2394_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Support:gamer.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f23824b812bd203987cf81266994ddb125d0181641e11bf352dae3d2466b2394->leave($__internal_f23824b812bd203987cf81266994ddb125d0181641e11bf352dae3d2466b2394_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_530ea93046d0d12985ee59819a0a2032cea3d5e8ec72b83939cef5a8f2d85a63 = $this->env->getExtension("native_profiler");
        $__internal_530ea93046d0d12985ee59819a0a2032cea3d5e8ec72b83939cef5a8f2d85a63->enter($__internal_530ea93046d0d12985ee59819a0a2032cea3d5e8ec72b83939cef5a8f2d85a63_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("support.title"), "html", null, true);
        
        $__internal_530ea93046d0d12985ee59819a0a2032cea3d5e8ec72b83939cef5a8f2d85a63->leave($__internal_530ea93046d0d12985ee59819a0a2032cea3d5e8ec72b83939cef5a8f2d85a63_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_2f1c888086fdc3eb1757bd590cf1c3eaca1d1fc85d7d42c80d6dc4311405d35e = $this->env->getExtension("native_profiler");
        $__internal_2f1c888086fdc3eb1757bd590cf1c3eaca1d1fc85d7d42c80d6dc4311405d35e->enter($__internal_2f1c888086fdc3eb1757bd590cf1c3eaca1d1fc85d7d42c80d6dc4311405d35e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_2f1c888086fdc3eb1757bd590cf1c3eaca1d1fc85d7d42c80d6dc4311405d35e->leave($__internal_2f1c888086fdc3eb1757bd590cf1c3eaca1d1fc85d7d42c80d6dc4311405d35e_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_736e284c3fd4bffb120575f2b2016838906f8214d1bfba57e0b3b82b7a91f54e = $this->env->getExtension("native_profiler");
        $__internal_736e284c3fd4bffb120575f2b2016838906f8214d1bfba57e0b3b82b7a91f54e->enter($__internal_736e284c3fd4bffb120575f2b2016838906f8214d1bfba57e0b3b82b7a91f54e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 17
        echo "    <div class=\"col-sm-12 voffset2\">
        ";
        // line 18
        echo nl2br(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("support.description"), "html", null, true));
        echo "
    </div>
    <div class=\"col-sm-12 voffset5\">
        ";
        // line 21
        $this->loadTemplate("@App/AppShop/Support/contact_gamer_form.html.twig", "AppBundle:AppShop/Support:gamer.html.twig", 21)->display(array_merge($context, array("form" => (isset($context["contactFrom"]) ? $context["contactFrom"] : $this->getContext($context, "contactFrom")))));
        // line 22
        echo "    </div>

    ";
        // line 24
        $this->loadTemplate("@App/Partials/analitycs_by_gamer_id.html.twig", "AppBundle:AppShop/Support:gamer.html.twig", 24)->display(array_merge($context, array("transaction" => (isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")))));
        
        $__internal_736e284c3fd4bffb120575f2b2016838906f8214d1bfba57e0b3b82b7a91f54e->leave($__internal_736e284c3fd4bffb120575f2b2016838906f8214d1bfba57e0b3b82b7a91f54e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Support:gamer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 24,  89 => 22,  87 => 21,  81 => 18,  78 => 17,  72 => 16,  54 => 5,  48 => 4,  36 => 2,  11 => 1,);
    }
}
/* {% extends "@App/AppShop/layout_secondary.html.twig" %}*/
/* {% block title %}{{ 'support.title' | trans }}{% endblock %}*/
/* */
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
/* */
/* {% block page %}*/
/*     <div class="col-sm-12 voffset2">*/
/*         {{ 'support.description' | trans | nl2br }}*/
/*     </div>*/
/*     <div class="col-sm-12 voffset5">*/
/*         {% include '@App/AppShop/Support/contact_gamer_form.html.twig' with {'form': contactFrom}  %}*/
/*     </div>*/
/* */
/*     {% include '@App/Partials/analitycs_by_gamer_id.html.twig' with {'transaction': transaction } %}*/
/* {% endblock %}*/
