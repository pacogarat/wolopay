<?php

/* SonataAdminBundle::empty_layout.html.twig */
class __TwigTemplate_05b8f76e47a46fb4b229dcf0f6beb84232df25373c2cd3db2f17e32d2593abb4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
            'sonata_page_content' => array($this, 'block_sonata_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "layout"), "method"), "SonataAdminBundle::empty_layout.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_55855de30efca664dc9d17db655b41422ea1507e7d0951aa4a9571d718183133 = $this->env->getExtension("native_profiler");
        $__internal_55855de30efca664dc9d17db655b41422ea1507e7d0951aa4a9571d718183133->enter($__internal_55855de30efca664dc9d17db655b41422ea1507e7d0951aa4a9571d718183133_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle::empty_layout.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_55855de30efca664dc9d17db655b41422ea1507e7d0951aa4a9571d718183133->leave($__internal_55855de30efca664dc9d17db655b41422ea1507e7d0951aa4a9571d718183133_prof);

    }

    // line 14
    public function block_sonata_header($context, array $blocks = array())
    {
        $__internal_9956af6d2c08eddda4d5bb966b0ca722ee339c2bf6c0d4e542e2426b9129e530 = $this->env->getExtension("native_profiler");
        $__internal_9956af6d2c08eddda4d5bb966b0ca722ee339c2bf6c0d4e542e2426b9129e530->enter($__internal_9956af6d2c08eddda4d5bb966b0ca722ee339c2bf6c0d4e542e2426b9129e530_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_header"));

        
        $__internal_9956af6d2c08eddda4d5bb966b0ca722ee339c2bf6c0d4e542e2426b9129e530->leave($__internal_9956af6d2c08eddda4d5bb966b0ca722ee339c2bf6c0d4e542e2426b9129e530_prof);

    }

    // line 15
    public function block_sonata_left_side($context, array $blocks = array())
    {
        $__internal_4d9c293810075d4ec952ebead2869696153525e82228c294e34a36a42122d465 = $this->env->getExtension("native_profiler");
        $__internal_4d9c293810075d4ec952ebead2869696153525e82228c294e34a36a42122d465->enter($__internal_4d9c293810075d4ec952ebead2869696153525e82228c294e34a36a42122d465_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_left_side"));

        
        $__internal_4d9c293810075d4ec952ebead2869696153525e82228c294e34a36a42122d465->leave($__internal_4d9c293810075d4ec952ebead2869696153525e82228c294e34a36a42122d465_prof);

    }

    // line 16
    public function block_sonata_nav($context, array $blocks = array())
    {
        $__internal_3a06b4226ac4a324798b301ab0fafe2f48294d9333c3bc78e469b0d86c6d0fd3 = $this->env->getExtension("native_profiler");
        $__internal_3a06b4226ac4a324798b301ab0fafe2f48294d9333c3bc78e469b0d86c6d0fd3->enter($__internal_3a06b4226ac4a324798b301ab0fafe2f48294d9333c3bc78e469b0d86c6d0fd3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_nav"));

        
        $__internal_3a06b4226ac4a324798b301ab0fafe2f48294d9333c3bc78e469b0d86c6d0fd3->leave($__internal_3a06b4226ac4a324798b301ab0fafe2f48294d9333c3bc78e469b0d86c6d0fd3_prof);

    }

    // line 17
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        $__internal_5e0ea1398d525a69941a724e2ec70ce1ff676ba33aae8504946f770f654b2823 = $this->env->getExtension("native_profiler");
        $__internal_5e0ea1398d525a69941a724e2ec70ce1ff676ba33aae8504946f770f654b2823->enter($__internal_5e0ea1398d525a69941a724e2ec70ce1ff676ba33aae8504946f770f654b2823_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_breadcrumb"));

        
        $__internal_5e0ea1398d525a69941a724e2ec70ce1ff676ba33aae8504946f770f654b2823->leave($__internal_5e0ea1398d525a69941a724e2ec70ce1ff676ba33aae8504946f770f654b2823_prof);

    }

    // line 19
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_c34cb84812037145a497854391c48548e60b46636a0fb99c036c3e0ea3677516 = $this->env->getExtension("native_profiler");
        $__internal_c34cb84812037145a497854391c48548e60b46636a0fb99c036c3e0ea3677516->enter($__internal_c34cb84812037145a497854391c48548e60b46636a0fb99c036c3e0ea3677516_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 20
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <style>
        .content {
            margin: 0px;
            padding: 0px;
        }
    </style>

";
        
        $__internal_c34cb84812037145a497854391c48548e60b46636a0fb99c036c3e0ea3677516->leave($__internal_c34cb84812037145a497854391c48548e60b46636a0fb99c036c3e0ea3677516_prof);

    }

    // line 31
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        $__internal_4dbad956e04efb41c2ac0fc45dd6f846f74ef0843a758390dc64f50e88813aa4 = $this->env->getExtension("native_profiler");
        $__internal_4dbad956e04efb41c2ac0fc45dd6f846f74ef0843a758390dc64f50e88813aa4->enter($__internal_4dbad956e04efb41c2ac0fc45dd6f846f74ef0843a758390dc64f50e88813aa4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_wrapper"));

        // line 32
        echo "    ";
        $this->displayBlock('sonata_page_content', $context, $blocks);
        
        $__internal_4dbad956e04efb41c2ac0fc45dd6f846f74ef0843a758390dc64f50e88813aa4->leave($__internal_4dbad956e04efb41c2ac0fc45dd6f846f74ef0843a758390dc64f50e88813aa4_prof);

    }

    public function block_sonata_page_content($context, array $blocks = array())
    {
        $__internal_aa614d1ad34911481eab02f1936f24a86d736c00b46c6e7681133e7a7d177830 = $this->env->getExtension("native_profiler");
        $__internal_aa614d1ad34911481eab02f1936f24a86d736c00b46c6e7681133e7a7d177830->enter($__internal_aa614d1ad34911481eab02f1936f24a86d736c00b46c6e7681133e7a7d177830_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_page_content"));

        // line 33
        echo "        ";
        $this->displayParentBlock("sonata_page_content", $context, $blocks);
        echo "
    ";
        
        $__internal_aa614d1ad34911481eab02f1936f24a86d736c00b46c6e7681133e7a7d177830->leave($__internal_aa614d1ad34911481eab02f1936f24a86d736c00b46c6e7681133e7a7d177830_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::empty_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 33,  113 => 32,  107 => 31,  89 => 20,  83 => 19,  72 => 17,  61 => 16,  50 => 15,  39 => 14,  24 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends admin_pool.getTemplate('layout') %}*/
/* */
/* {% block sonata_header %}{% endblock %}*/
/* {% block sonata_left_side %}{% endblock %}*/
/* {% block sonata_nav %}{% endblock %}*/
/* {% block sonata_breadcrumb %}{% endblock %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/* */
/*     <style>*/
/*         .content {*/
/*             margin: 0px;*/
/*             padding: 0px;*/
/*         }*/
/*     </style>*/
/* */
/* {% endblock %}*/
/* */
/* {% block sonata_wrapper %}*/
/*     {% block sonata_page_content %}*/
/*         {{ parent() }}*/
/*     {% endblock %}*/
/* {% endblock %}*/
/* */
