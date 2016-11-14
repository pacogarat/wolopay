<?php

/* IbrowsSonataTranslationBundle:CRUD:list.html.twig */
class __TwigTemplate_2038dfb3055560a9b0d41f8f0dc8258952cdbe1b3f69244339ddd7f0b4d025a1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:list.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 1);
        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:list.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_924f1183617e47abb9d53f0b7f8b9927a6a4acf5a33015dedf985a1e5f458353 = $this->env->getExtension("native_profiler");
        $__internal_924f1183617e47abb9d53f0b7f8b9927a6a4acf5a33015dedf985a1e5f458353->enter($__internal_924f1183617e47abb9d53f0b7f8b9927a6a4acf5a33015dedf985a1e5f458353_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle:CRUD:list.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_924f1183617e47abb9d53f0b7f8b9927a6a4acf5a33015dedf985a1e5f458353->leave($__internal_924f1183617e47abb9d53f0b7f8b9927a6a4acf5a33015dedf985a1e5f458353_prof);

    }

    // line 3
    public function block_actions($context, array $blocks = array())
    {
        $__internal_25911c6cab428caec3ea73a17531ae3f306d4b4d7f189806241b9f5eaca2b6e5 = $this->env->getExtension("native_profiler");
        $__internal_25911c6cab428caec3ea73a17531ae3f306d4b4d7f189806241b9f5eaca2b6e5->enter($__internal_25911c6cab428caec3ea73a17531ae3f306d4b4d7f189806241b9f5eaca2b6e5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <li>";
        $this->loadTemplate("IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 5)->display($context);
        echo "</li>
        ";
        // line 6
        if (($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "create"), "method") && $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "isGranted", array(0 => "CREATE"), "method"))) {
            // line 7
            echo "            <li>";
            $this->loadTemplate("SonataAdminBundle:Core:create_button.html.twig", "IbrowsSonataTranslationBundle:CRUD:list.html.twig", 7)->display($context);
            echo "</li>
        ";
        }
        // line 9
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_25911c6cab428caec3ea73a17531ae3f306d4b4d7f189806241b9f5eaca2b6e5->leave($__internal_25911c6cab428caec3ea73a17531ae3f306d4b4d7f189806241b9f5eaca2b6e5_prof);

    }

    public function getTemplateName()
    {
        return "IbrowsSonataTranslationBundle:CRUD:list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 9,  50 => 7,  48 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:list.html.twig' %}*/
/* */
/* {% block actions %}*/
/*     {% spaceless %}*/
/*         <li>{% include 'IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig' %}</li>*/
/*         {% if admin.hasRoute('create') and admin.isGranted('CREATE')%}*/
/*             <li>{% include 'SonataAdminBundle:Core:create_button.html.twig' %}</li>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock %}*/
