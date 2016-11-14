<?php

/* FOSUserBundle:Resetting:checkEmail.html.twig */
class __TwigTemplate_83e892c690af54c951b197fa5552b19432d02f1678eff26b0635ca8654f95063 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Resetting:checkEmail.html.twig", 1);
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
        $__internal_83f4b52dcbfcab9cf93a85b7c4dde44f0429d8809ca98dd47bf767656111014c = $this->env->getExtension("native_profiler");
        $__internal_83f4b52dcbfcab9cf93a85b7c4dde44f0429d8809ca98dd47bf767656111014c->enter($__internal_83f4b52dcbfcab9cf93a85b7c4dde44f0429d8809ca98dd47bf767656111014c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:checkEmail.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_83f4b52dcbfcab9cf93a85b7c4dde44f0429d8809ca98dd47bf767656111014c->leave($__internal_83f4b52dcbfcab9cf93a85b7c4dde44f0429d8809ca98dd47bf767656111014c_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_09e6c2a5a834c6446494581f8413f32ab8b6274844bb872b1ab2cbe2e0613b64 = $this->env->getExtension("native_profiler");
        $__internal_09e6c2a5a834c6446494581f8413f32ab8b6274844bb872b1ab2cbe2e0613b64->enter($__internal_09e6c2a5a834c6446494581f8413f32ab8b6274844bb872b1ab2cbe2e0613b64_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "<p>
";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.check_email", array("%email%" => (isset($context["email"]) ? $context["email"] : $this->getContext($context, "email"))), "FOSUserBundle"), "html", null, true);
        echo "
</p>
";
        
        $__internal_09e6c2a5a834c6446494581f8413f32ab8b6274844bb872b1ab2cbe2e0613b64->leave($__internal_09e6c2a5a834c6446494581f8413f32ab8b6274844bb872b1ab2cbe2e0613b64_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:checkEmail.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 7,  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/* <p>*/
/* {{ 'resetting.check_email'|trans({'%email%': email}) }}*/
/* </p>*/
/* {% endblock %}*/
/* */
