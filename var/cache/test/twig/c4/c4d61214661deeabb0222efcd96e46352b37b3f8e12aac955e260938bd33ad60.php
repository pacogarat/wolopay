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
        $__internal_ad614892b319eb6138642873cdfa2b72eedd849bb97f7d1295a17fcf8f5f2a8c = $this->env->getExtension("native_profiler");
        $__internal_ad614892b319eb6138642873cdfa2b72eedd849bb97f7d1295a17fcf8f5f2a8c->enter($__internal_ad614892b319eb6138642873cdfa2b72eedd849bb97f7d1295a17fcf8f5f2a8c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:checkEmail.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ad614892b319eb6138642873cdfa2b72eedd849bb97f7d1295a17fcf8f5f2a8c->leave($__internal_ad614892b319eb6138642873cdfa2b72eedd849bb97f7d1295a17fcf8f5f2a8c_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_998e76d21afca3dd35c11409ba82e6145388d11a12d402bb7e6486fb3b8c93be = $this->env->getExtension("native_profiler");
        $__internal_998e76d21afca3dd35c11409ba82e6145388d11a12d402bb7e6486fb3b8c93be->enter($__internal_998e76d21afca3dd35c11409ba82e6145388d11a12d402bb7e6486fb3b8c93be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "    <p>";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("registration.check_email", array("%email%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "email", array())), "FOSUserBundle"), "html", null, true);
        echo "</p>
";
        
        $__internal_998e76d21afca3dd35c11409ba82e6145388d11a12d402bb7e6486fb3b8c93be->leave($__internal_998e76d21afca3dd35c11409ba82e6145388d11a12d402bb7e6486fb3b8c93be_prof);

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
