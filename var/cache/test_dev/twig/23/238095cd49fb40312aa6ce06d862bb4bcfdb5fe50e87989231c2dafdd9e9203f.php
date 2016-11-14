<?php

/* FOSUserBundle:Profile:edit_content.html.twig */
class __TwigTemplate_21b9a1371ee117e3380c3d502de2d39d09de05c31b0db4ffe20d12a74a75542f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2ae2f6d8f40bb7b3f6fc86dd2a5d3e5b50d186499b31a13c0439c64460b5499c = $this->env->getExtension("native_profiler");
        $__internal_2ae2f6d8f40bb7b3f6fc86dd2a5d3e5b50d186499b31a13c0439c64460b5499c->enter($__internal_2ae2f6d8f40bb7b3f6fc86dd2a5d3e5b50d186499b31a13c0439c64460b5499c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Profile:edit_content.html.twig"));

        // line 2
        echo "
<form action=\"";
        // line 3
        echo $this->env->getExtension('routing')->getPath("fos_user_profile_edit");
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_profile_edit\">
    ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
    <div>
        <input type=\"submit\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("profile.edit.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
    </div>
</form>
";
        
        $__internal_2ae2f6d8f40bb7b3f6fc86dd2a5d3e5b50d186499b31a13c0439c64460b5499c->leave($__internal_2ae2f6d8f40bb7b3f6fc86dd2a5d3e5b50d186499b31a13c0439c64460b5499c_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Profile:edit_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 6,  31 => 4,  25 => 3,  22 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* <form action="{{ path('fos_user_profile_edit') }}" {{ form_enctype(form) }} method="POST" class="fos_user_profile_edit">*/
/*     {{ form_widget(form) }}*/
/*     <div>*/
/*         <input type="submit" value="{{ 'profile.edit.submit'|trans }}" />*/
/*     </div>*/
/* </form>*/
/* */
