<?php

/* FOSUserBundle:Registration:checkEmail.html.twig */
class __TwigTemplate_934270b4486e35eab1912aab6b78c1ba20cf13f5f32113335324d88121f12454 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Registration:checkEmail.html.twig", 1);
        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_3301a73cb27b50bf2598fc7c8f07823c6021f4312230138bd52a0ad9af98619a = $this->env->getExtension("native_profiler");
        $__internal_3301a73cb27b50bf2598fc7c8f07823c6021f4312230138bd52a0ad9af98619a->enter($__internal_3301a73cb27b50bf2598fc7c8f07823c6021f4312230138bd52a0ad9af98619a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:checkEmail.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_3301a73cb27b50bf2598fc7c8f07823c6021f4312230138bd52a0ad9af98619a->leave($__internal_3301a73cb27b50bf2598fc7c8f07823c6021f4312230138bd52a0ad9af98619a_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_599dcb9f37a4cac5379b092f05466e7592b884209b2c57e6d44d7f833644ad96 = $this->env->getExtension("native_profiler");
        $__internal_599dcb9f37a4cac5379b092f05466e7592b884209b2c57e6d44d7f833644ad96->enter($__internal_599dcb9f37a4cac5379b092f05466e7592b884209b2c57e6d44d7f833644ad96_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "    <p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("registration.check_email", array("%email%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "email", array())), "FOSUserBundle"), "html", null, true);
        echo "</p>
";
        
        $__internal_599dcb9f37a4cac5379b092f05466e7592b884209b2c57e6d44d7f833644ad96->leave($__internal_599dcb9f37a4cac5379b092f05466e7592b884209b2c57e6d44d7f833644ad96_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:checkEmail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/*     <p>{{ 'registration.check_email'|trans({'%email%': user.email}) }}</p>*/
/* {% endblock fos_user_content %}*/
/* */
