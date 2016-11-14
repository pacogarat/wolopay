<?php

/* AppBundle:AppShop/Shop:gamerUpdateData.html.twig */
class __TwigTemplate_4ef1c0f2ce261223a565442579c5df919e2a7e5844b98f2e4b87d302750bb2fe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_form_full_screen.html.twig", "AppBundle:AppShop/Shop:gamerUpdateData.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_form_full_screen.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f319cd19b405fe7061c4ffe19e0bfb744818720e2fd472062e2f09c179fe0ca3 = $this->env->getExtension("native_profiler");
        $__internal_f319cd19b405fe7061c4ffe19e0bfb744818720e2fd472062e2f09c179fe0ca3->enter($__internal_f319cd19b405fe7061c4ffe19e0bfb744818720e2fd472062e2f09c179fe0ca3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop:gamerUpdateData.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f319cd19b405fe7061c4ffe19e0bfb744818720e2fd472062e2f09c179fe0ca3->leave($__internal_f319cd19b405fe7061c4ffe19e0bfb744818720e2fd472062e2f09c179fe0ca3_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_0e6b914ed7063b03c33dfbac2c019be3f5b35f13af03b71ae1ac47e93db8c500 = $this->env->getExtension("native_profiler");
        $__internal_0e6b914ed7063b03c33dfbac2c019be3f5b35f13af03b71ae1ac47e93db8c500->enter($__internal_0e6b914ed7063b03c33dfbac2c019be3f5b35f13af03b71ae1ac47e93db8c500_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_data.title"), "html", null, true);
        
        $__internal_0e6b914ed7063b03c33dfbac2c019be3f5b35f13af03b71ae1ac47e93db8c500->leave($__internal_0e6b914ed7063b03c33dfbac2c019be3f5b35f13af03b71ae1ac47e93db8c500_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_b4e31b220f30cb81e82973ce7c77ea0d629c42f4b915835c9249ef91d7deff77 = $this->env->getExtension("native_profiler");
        $__internal_b4e31b220f30cb81e82973ce7c77ea0d629c42f4b915835c9249ef91d7deff77->enter($__internal_b4e31b220f30cb81e82973ce7c77ea0d629c42f4b915835c9249ef91d7deff77_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "
    <h1>
        ";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.gamer_data.title"), "html", null, true);
        echo "
    </h1>

    ";
        // line 9
        $this->loadTemplate("@App/Partials/flash_msgs.html.twig", "AppBundle:AppShop/Shop:gamerUpdateData.html.twig", 9)->display($context);
        // line 10
        echo "
    ";
        // line 11
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
    ";
        // line 12
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "

    <div class=\"form-group text-right voffset4\">
        <button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\">";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic.submit"), "html", null, true);
        echo "</button>
    </div>

    ";
        // line 18
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "

";
        
        $__internal_b4e31b220f30cb81e82973ce7c77ea0d629c42f4b915835c9249ef91d7deff77->leave($__internal_b4e31b220f30cb81e82973ce7c77ea0d629c42f4b915835c9249ef91d7deff77_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop:gamerUpdateData.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  84 => 18,  78 => 15,  72 => 12,  68 => 11,  65 => 10,  63 => 9,  57 => 6,  53 => 4,  47 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends "::base_form_full_screen.html.twig" %}*/
/* {% block title %}{{ 'form.gamer_data.title' | trans }}{% endblock %}*/
/* {% block page_container %}*/
/* */
/*     <h1>*/
/*         {{ 'form.gamer_data.title' | trans }}*/
/*     </h1>*/
/* */
/*     {% include '@App/Partials/flash_msgs.html.twig' %}*/
/* */
/*     {{ form_start(form) }}*/
/*     {{ form_widget(form) }}*/
/* */
/*     <div class="form-group text-right voffset4">*/
/*         <button type="submit" class="btn btn-primary btn-lg btn-block">{{'form.generic.submit' | trans }}</button>*/
/*     </div>*/
/* */
/*     {{ form_end(form) }}*/
/* */
/* {% endblock %}*/
