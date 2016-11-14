<?php

/* FOSUserBundle:Registration:confirmed.html.twig */
class __TwigTemplate_e88423b478f5ecf6c718f8c52eefbbf1c4028259991d2d7fa75665a53ca34bfd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Registration:confirmed.html.twig", 1);
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
        $__internal_be7a7f1c21edcad0dcafea11c26d4c6ebe6ecf8f0d64b75182edef5392e09cca = $this->env->getExtension("native_profiler");
        $__internal_be7a7f1c21edcad0dcafea11c26d4c6ebe6ecf8f0d64b75182edef5392e09cca->enter($__internal_be7a7f1c21edcad0dcafea11c26d4c6ebe6ecf8f0d64b75182edef5392e09cca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:confirmed.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_be7a7f1c21edcad0dcafea11c26d4c6ebe6ecf8f0d64b75182edef5392e09cca->leave($__internal_be7a7f1c21edcad0dcafea11c26d4c6ebe6ecf8f0d64b75182edef5392e09cca_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_06fc437d5e6dfe6fe8851277d7cc68156a020a0dab58ff3ff82b1ff56fe2cfd6 = $this->env->getExtension("native_profiler");
        $__internal_06fc437d5e6dfe6fe8851277d7cc68156a020a0dab58ff3ff82b1ff56fe2cfd6->enter($__internal_06fc437d5e6dfe6fe8851277d7cc68156a020a0dab58ff3ff82b1ff56fe2cfd6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "    <p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("registration.confirmed", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array())), "FOSUserBundle"), "html", null, true);
        echo "</p>
    ";
        // line 7
        if ((isset($context["targetUrl"]) ? $context["targetUrl"] : $this->getContext($context, "targetUrl"))) {
            // line 8
            echo "    <p><a href=\"";
            echo twig_escape_filter($this->env, (isset($context["targetUrl"]) ? $context["targetUrl"] : $this->getContext($context, "targetUrl")), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("registration.back", array(), "FOSUserBundle"), "html", null, true);
            echo "</a></p>
    ";
        }
        
        $__internal_06fc437d5e6dfe6fe8851277d7cc68156a020a0dab58ff3ff82b1ff56fe2cfd6->leave($__internal_06fc437d5e6dfe6fe8851277d7cc68156a020a0dab58ff3ff82b1ff56fe2cfd6_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:confirmed.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 8,  45 => 7,  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/*     <p>{{ 'registration.confirmed'|trans({'%username%': user.username}) }}</p>*/
/*     {% if targetUrl %}*/
/*     <p><a href="{{ targetUrl }}">{{ 'registration.back'|trans }}</a></p>*/
/*     {% endif %}*/
/* {% endblock fos_user_content %}*/
/* */
