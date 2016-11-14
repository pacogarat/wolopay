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
        $__internal_d79569bab51a5db614a83cf8a6063468ad42606b91769eec38651c9264c98255 = $this->env->getExtension("native_profiler");
        $__internal_d79569bab51a5db614a83cf8a6063468ad42606b91769eec38651c9264c98255->enter($__internal_d79569bab51a5db614a83cf8a6063468ad42606b91769eec38651c9264c98255_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Support:gamer.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d79569bab51a5db614a83cf8a6063468ad42606b91769eec38651c9264c98255->leave($__internal_d79569bab51a5db614a83cf8a6063468ad42606b91769eec38651c9264c98255_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_373976f8ef3fcbeb163d36e675f7bbc392df122c4b8f4853b021680a7807f2be = $this->env->getExtension("native_profiler");
        $__internal_373976f8ef3fcbeb163d36e675f7bbc392df122c4b8f4853b021680a7807f2be->enter($__internal_373976f8ef3fcbeb163d36e675f7bbc392df122c4b8f4853b021680a7807f2be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("support.title"), "html", null, true);
        
        $__internal_373976f8ef3fcbeb163d36e675f7bbc392df122c4b8f4853b021680a7807f2be->leave($__internal_373976f8ef3fcbeb163d36e675f7bbc392df122c4b8f4853b021680a7807f2be_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_4c4aed941360cd6491432a3e619f1b2e705e7e083db1204769495f7ee1a4baa4 = $this->env->getExtension("native_profiler");
        $__internal_4c4aed941360cd6491432a3e619f1b2e705e7e083db1204769495f7ee1a4baa4->enter($__internal_4c4aed941360cd6491432a3e619f1b2e705e7e083db1204769495f7ee1a4baa4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_4c4aed941360cd6491432a3e619f1b2e705e7e083db1204769495f7ee1a4baa4->leave($__internal_4c4aed941360cd6491432a3e619f1b2e705e7e083db1204769495f7ee1a4baa4_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_840f9fad2f29c934784cfeb50768b0fc0cfee1cb4e8b7ab4b0a660e6f1f37316 = $this->env->getExtension("native_profiler");
        $__internal_840f9fad2f29c934784cfeb50768b0fc0cfee1cb4e8b7ab4b0a660e6f1f37316->enter($__internal_840f9fad2f29c934784cfeb50768b0fc0cfee1cb4e8b7ab4b0a660e6f1f37316_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

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
        
        $__internal_840f9fad2f29c934784cfeb50768b0fc0cfee1cb4e8b7ab4b0a660e6f1f37316->leave($__internal_840f9fad2f29c934784cfeb50768b0fc0cfee1cb4e8b7ab4b0a660e6f1f37316_prof);

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
