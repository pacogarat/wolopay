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
        $__internal_398d3df12ceeb798f17e6f61461c3382f7bb779eb3fa3ab6394977ea5a1e479b = $this->env->getExtension("native_profiler");
        $__internal_398d3df12ceeb798f17e6f61461c3382f7bb779eb3fa3ab6394977ea5a1e479b->enter($__internal_398d3df12ceeb798f17e6f61461c3382f7bb779eb3fa3ab6394977ea5a1e479b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:action.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_398d3df12ceeb798f17e6f61461c3382f7bb779eb3fa3ab6394977ea5a1e479b->leave($__internal_398d3df12ceeb798f17e6f61461c3382f7bb779eb3fa3ab6394977ea5a1e479b_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_c0dbcef773abb881b55ced7b6dc57c0ed6db49a414d7eae9e05d569ce82bf463 = $this->env->getExtension("native_profiler");
        $__internal_c0dbcef773abb881b55ced7b6dc57c0ed6db49a414d7eae9e05d569ce82bf463->enter($__internal_c0dbcef773abb881b55ced7b6dc57c0ed6db49a414d7eae9e05d569ce82bf463_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:create_button.html.twig", "SonataAdminBundle:CRUD:action.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:action.html.twig", 16)->display($context);
        echo "</li>
";
        
        $__internal_c0dbcef773abb881b55ced7b6dc57c0ed6db49a414d7eae9e05d569ce82bf463->leave($__internal_c0dbcef773abb881b55ced7b6dc57c0ed6db49a414d7eae9e05d569ce82bf463_prof);

    }

    // line 19
    public function block_tab_menu($context, array $blocks = array())
    {
        $__internal_b5fbd38c55bd36b4ebc545a1735182820a65faec8d39ab1fffa8b69f4ed5fe04 = $this->env->getExtension("native_profiler");
        $__internal_b5fbd38c55bd36b4ebc545a1735182820a65faec8d39ab1fffa8b69f4ed5fe04->enter($__internal_b5fbd38c55bd36b4ebc545a1735182820a65faec8d39ab1fffa8b69f4ed5fe04_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "tab_menu"));

        // line 20
        echo "    ";
        if (array_key_exists("action", $context)) {
            // line 21
            echo "        ";
            echo $this->env->getExtension('knp_menu')->render($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "sidemenu", array(0 => (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action"))), "method"), array("currentClass" => "active", "template" => $this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "tab_menu_template"), "method")), "twig");
            echo "
    ";
        }
        
        $__internal_b5fbd38c55bd36b4ebc545a1735182820a65faec8d39ab1fffa8b69f4ed5fe04->leave($__internal_b5fbd38c55bd36b4ebc545a1735182820a65faec8d39ab1fffa8b69f4ed5fe04_prof);

    }

    // line 25
    public function block_content($context, array $blocks = array())
    {
        $__internal_c4db927bf823b48a78ff3eec4e49ff34d03bb639de38711ba6052f663e7a0219 = $this->env->getExtension("native_profiler");
        $__internal_c4db927bf823b48a78ff3eec4e49ff34d03bb639de38711ba6052f663e7a0219->enter($__internal_c4db927bf823b48a78ff3eec4e49ff34d03bb639de38711ba6052f663e7a0219_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 26
        echo "
    Redefine the content block in your action template

";
        
        $__internal_c4db927bf823b48a78ff3eec4e49ff34d03bb639de38711ba6052f663e7a0219->leave($__internal_c4db927bf823b48a78ff3eec4e49ff34d03bb639de38711ba6052f663e7a0219_prof);

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
