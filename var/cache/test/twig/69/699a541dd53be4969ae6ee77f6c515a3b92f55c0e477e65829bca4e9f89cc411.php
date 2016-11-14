<?php

/* AppBundle:Documentation:generic.html.twig */
class __TwigTemplate_ce465701970615ccee5b20bd6041b603c8648cd9033ebc56814614228634e73f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Documentation/documentation_layout.html.twig", "AppBundle:Documentation:generic.html.twig", 1);
        $this->blocks = array(
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Documentation/documentation_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_01583f3657efc02f98df8516d5e7ec065a1e17ed0bcf48bf857bfa4661e90e82 = $this->env->getExtension("native_profiler");
        $__internal_01583f3657efc02f98df8516d5e7ec065a1e17ed0bcf48bf857bfa4661e90e82->enter($__internal_01583f3657efc02f98df8516d5e7ec065a1e17ed0bcf48bf857bfa4661e90e82_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Documentation:generic.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_01583f3657efc02f98df8516d5e7ec065a1e17ed0bcf48bf857bfa4661e90e82->leave($__internal_01583f3657efc02f98df8516d5e7ec065a1e17ed0bcf48bf857bfa4661e90e82_prof);

    }

    // line 2
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_60be939b3efeefaca62d0dbca48442469b05c71e4e36486e971236b944fc3c29 = $this->env->getExtension("native_profiler");
        $__internal_60be939b3efeefaca62d0dbca48442469b05c71e4e36486e971236b944fc3c29->enter($__internal_60be939b3efeefaca62d0dbca48442469b05c71e4e36486e971236b944fc3c29_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        // line 3
        echo "    <div class=\"generic-doc\">
        ";
        // line 4
        echo (isset($context["main_content"]) ? $context["main_content"] : $this->getContext($context, "main_content"));
        echo "
    </div>
";
        
        $__internal_60be939b3efeefaca62d0dbca48442469b05c71e4e36486e971236b944fc3c29->leave($__internal_60be939b3efeefaca62d0dbca48442469b05c71e4e36486e971236b944fc3c29_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Documentation:generic.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 4,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends "@App/Documentation/documentation_layout.html.twig" %}*/
/* {% block main_content %}*/
/*     <div class="generic-doc">*/
/*         {{ main_content | raw }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
