<?php

/* AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig */
class __TwigTemplate_3b50c2810fc35943381751430b1ef929c19c3f9cb9acbb5758f541f6ba9f31ab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_51e3efa8e5320b6f8b31391f7ca8eef5ec6222423f4394747f3c03964249113e = $this->env->getExtension("native_profiler");
        $__internal_51e3efa8e5320b6f8b31391f7ca8eef5ec6222423f4394747f3c03964249113e->enter($__internal_51e3efa8e5320b6f8b31391f7ca8eef5ec6222423f4394747f3c03964249113e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_51e3efa8e5320b6f8b31391f7ca8eef5ec6222423f4394747f3c03964249113e->leave($__internal_51e3efa8e5320b6f8b31391f7ca8eef5ec6222423f4394747f3c03964249113e_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_683ff4a0b265494d22bfbc97d28c009b035a8c17befaa1cc254b1c26155749a8 = $this->env->getExtension("native_profiler");
        $__internal_683ff4a0b265494d22bfbc97d28c009b035a8c17befaa1cc254b1c26155749a8->enter($__internal_683ff4a0b265494d22bfbc97d28c009b035a8c17befaa1cc254b1c26155749a8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_683ff4a0b265494d22bfbc97d28c009b035a8c17befaa1cc254b1c26155749a8->leave($__internal_683ff4a0b265494d22bfbc97d28c009b035a8c17befaa1cc254b1c26155749a8_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_a6c279d47646cb92f687879fc45d7b354683311bfc0796549a58e0a4f8ac0d1c = $this->env->getExtension("native_profiler");
        $__internal_a6c279d47646cb92f687879fc45d7b354683311bfc0796549a58e0a4f8ac0d1c->enter($__internal_a6c279d47646cb92f687879fc45d7b354683311bfc0796549a58e0a4f8ac0d1c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <style>
        body{
            font-size: 1.6em;
        }
        h1{
            margin: 40px 0;
        }

    </style>
    <div class=\"container voffset3\">
        ";
        // line 14
        $this->displayBlock('page', $context, $blocks);
        // line 15
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_a6c279d47646cb92f687879fc45d7b354683311bfc0796549a58e0a4f8ac0d1c->leave($__internal_a6c279d47646cb92f687879fc45d7b354683311bfc0796549a58e0a4f8ac0d1c_prof);

    }

    // line 14
    public function block_page($context, array $blocks = array())
    {
        $__internal_b444c7e5196010fa18bd26a85e6a8a9c9d8425b62e5f5d3f143dd598eabc9f6a = $this->env->getExtension("native_profiler");
        $__internal_b444c7e5196010fa18bd26a85e6a8a9c9d8425b62e5f5d3f143dd598eabc9f6a->enter($__internal_b444c7e5196010fa18bd26a85e6a8a9c9d8425b62e5f5d3f143dd598eabc9f6a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_b444c7e5196010fa18bd26a85e6a8a9c9d8425b62e5f5d3f143dd598eabc9f6a->leave($__internal_b444c7e5196010fa18bd26a85e6a8a9c9d8425b62e5f5d3f143dd598eabc9f6a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 14,  67 => 15,  65 => 14,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block title %}{% endblock %}*/
/* {% block page_container %}*/
/*     <style>*/
/*         body{*/
/*             font-size: 1.6em;*/
/*         }*/
/*         h1{*/
/*             margin: 40px 0;*/
/*         }*/
/* */
/*     </style>*/
/*     <div class="container voffset3">*/
/*         {% block page '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
