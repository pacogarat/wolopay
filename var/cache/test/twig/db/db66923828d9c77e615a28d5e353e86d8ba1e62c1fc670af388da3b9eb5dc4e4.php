<?php

/* SonataAdminBundle:CRUD:action.html.twig */
class __TwigTemplate_eab053318e1e94dd843c260e7f7b816743c0dc6d02e640abec1f30e510a2e329 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'tab_menu' => array($this, 'block_tab_menu'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:action.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_91271535d430961c8d754294e118fc1dbcd1bb1c979ff1824b4f84498d3986ca = $this->env->getExtension("native_profiler");
        $__internal_91271535d430961c8d754294e118fc1dbcd1bb1c979ff1824b4f84498d3986ca->enter($__internal_91271535d430961c8d754294e118fc1dbcd1bb1c979ff1824b4f84498d3986ca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:action.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_91271535d430961c8d754294e118fc1dbcd1bb1c979ff1824b4f84498d3986ca->leave($__internal_91271535d430961c8d754294e118fc1dbcd1bb1c979ff1824b4f84498d3986ca_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_107ea756af3151f91363e71a900b7eb2ccd5cf92775f2945f91f81fe637155f1 = $this->env->getExtension("native_profiler");
        $__internal_107ea756af3151f91363e71a900b7eb2ccd5cf92775f2945f91f81fe637155f1->enter($__internal_107ea756af3151f91363e71a900b7eb2ccd5cf92775f2945f91f81fe637155f1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:action.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:action.html.twig", 16)->display($context);
        echo "</li>
";
        
        $__internal_107ea756af3151f91363e71a900b7eb2ccd5cf92775f2945f91f81fe637155f1->leave($__internal_107ea756af3151f91363e71a900b7eb2ccd5cf92775f2945f91f81fe637155f1_prof);

    }

    // line 19
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_1195d981d5dbbd9eb256e86e299df6410bd9c97d47052ab0898fc6b8b7dc8fe3 = $this->env->getExtension("native_profiler");
        $__internal_1195d981d5dbbd9eb256e86e299df6410bd9c97d47052ab0898fc6b8b7dc8fe3->enter($__internal_1195d981d5dbbd9eb256e86e299df6410bd9c97d47052ab0898fc6b8b7dc8fe3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        // line 20
        echo "    ";
        if (array_key_exists("action", $context)) {
            // line 21
            echo "        ";
            echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
            echo "
    ";
        }
        
        $__internal_1195d981d5dbbd9eb256e86e299df6410bd9c97d47052ab0898fc6b8b7dc8fe3->leave($__internal_1195d981d5dbbd9eb256e86e299df6410bd9c97d47052ab0898fc6b8b7dc8fe3_prof);

    }

    // line 25
    public function block_content($context, array $blocks = array())
    {
        $__internal_09f42fef0637584c11e2083d68433a2ea0ac4d5d25611d8188ab60e223c1636e = $this->env->getExtension("native_profiler");
        $__internal_09f42fef0637584c11e2083d68433a2ea0ac4d5d25611d8188ab60e223c1636e->enter($__internal_09f42fef0637584c11e2083d68433a2ea0ac4d5d25611d8188ab60e223c1636e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 26
        echo "
    Redefine the content block in your action template

";
        
        $__internal_09f42fef0637584c11e2083d68433a2ea0ac4d5d25611d8188ab60e223c1636e->leave($__internal_09f42fef0637584c11e2083d68433a2ea0ac4d5d25611d8188ab60e223c1636e_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 26,  75 => 25,  64 => 21,  61 => 20,  55 => 19,  46 => 16,  41 => 15,  35 => 14,  20 => 12,);
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
/* {% extends base_template %}*/
/* */
/* {% block actions %}*/
/*     <li>{% include 'SonataAdminBundle:Button:create_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block tab_menu %}*/
/*     {% if action is defined %}*/
/*         {{ knp_menu_render(admin.sidemenu(action), {'currentClass' : 'active', 'template': admin_pool.getTemplate('tab_menu_template')}, 'twig') }}*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* */
/*     Redefine the content block in your action template*/
/* */
/* {% endblock %}*/
/* */
