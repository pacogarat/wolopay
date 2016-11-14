<?php

/* AppBundle:Others/Default:singUp.html.twig */
class __TwigTemplate_36e2593093021d856596959a614c0e527eb80ca85c6842b5153c1052add78057 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_form_full_screen.html.twig", "AppBundle:Others/Default:singUp.html.twig", 1);
        $this->blocks = array(
            'page_container' => array($this, 'block_page_container'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_form_full_screen.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d9a2e987f18f403b4b29a64d4a02c5165778c25b06b40d6d066609e8f966f49a = $this->env->getExtension("native_profiler");
        $__internal_d9a2e987f18f403b4b29a64d4a02c5165778c25b06b40d6d066609e8f966f49a->enter($__internal_d9a2e987f18f403b4b29a64d4a02c5165778c25b06b40d6d066609e8f966f49a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default:singUp.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d9a2e987f18f403b4b29a64d4a02c5165778c25b06b40d6d066609e8f966f49a->leave($__internal_d9a2e987f18f403b4b29a64d4a02c5165778c25b06b40d6d066609e8f966f49a_prof);

    }

    // line 2
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_f2d0d51788ce8edcd71afb238c3b08fc7e73842311107731fd4953054fb31d41 = $this->env->getExtension("native_profiler");
        $__internal_f2d0d51788ce8edcd71afb238c3b08fc7e73842311107731fd4953054fb31d41->enter($__internal_f2d0d51788ce8edcd71afb238c3b08fc7e73842311107731fd4953054fb31d41_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 3
        echo "    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }
    </style>

    ";
        // line 11
        $this->loadTemplate("@App/Partials/flash_msgs.html.twig", "AppBundle:Others/Default:singUp.html.twig", 11)->display($context);
        // line 12
        echo "    ";
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["singupFrom"]) ? $context["singupFrom"] : $this->getContext($context, "singupFrom")), 'form_start');
        echo "
    ";
        // line 13
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["singupFrom"]) ? $context["singupFrom"] : $this->getContext($context, "singupFrom")), 'widget');
        echo "
    <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\" style=\"margin-top: 40px\">Sing up</button>
    ";
        // line 15
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["singupFrom"]) ? $context["singupFrom"] : $this->getContext($context, "singupFrom")), 'form_end');
        echo "


";
        
        $__internal_f2d0d51788ce8edcd71afb238c3b08fc7e73842311107731fd4953054fb31d41->leave($__internal_f2d0d51788ce8edcd71afb238c3b08fc7e73842311107731fd4953054fb31d41_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default:singUp.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 15,  57 => 13,  52 => 12,  50 => 11,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends "::base_form_full_screen.html.twig" %}*/
/* {% block page_container %}*/
/*     <style>*/
/*         body {*/
/*             padding-top: 40px;*/
/*             padding-bottom: 40px;*/
/*             background-color: #eee;*/
/*         }*/
/*     </style>*/
/* */
/*     {% include '@App/Partials/flash_msgs.html.twig' %}*/
/*     {{ form_start(singupFrom) }}*/
/*     {{ form_widget(singupFrom) }}*/
/*     <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top: 40px">Sing up</button>*/
/*     {{ form_end(singupFrom) }}*/
/* */
/* */
/* {% endblock %}*/
/* */
