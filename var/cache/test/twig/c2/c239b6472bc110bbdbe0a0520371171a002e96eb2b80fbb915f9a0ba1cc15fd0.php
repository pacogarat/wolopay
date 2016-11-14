<?php

/* FOSUserBundle:Registration:email.txt.twig */
class __TwigTemplate_768adf6c6b0e00337b0643e418e216060daba8d5251794ebd22c0612c44e929d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'subject' => array($this, 'block_subject'),
            'body_text' => array($this, 'block_body_text'),
            'body_html' => array($this, 'block_body_html'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_495cc7d7da12c05a46485649d761d3d6a14d601911ccd9bbc052c92781f31ffe = $this->env->getExtension("native_profiler");
        $__internal_495cc7d7da12c05a46485649d761d3d6a14d601911ccd9bbc052c92781f31ffe->enter($__internal_495cc7d7da12c05a46485649d761d3d6a14d601911ccd9bbc052c92781f31ffe_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:email.txt.twig"));

        // line 2
        $this->displayBlock('subject', $context, $blocks);
        // line 7
        $this->displayBlock('body_text', $context, $blocks);
        // line 12
        $this->displayBlock('body_html', $context, $blocks);
        
        $__internal_495cc7d7da12c05a46485649d761d3d6a14d601911ccd9bbc052c92781f31ffe->leave($__internal_495cc7d7da12c05a46485649d761d3d6a14d601911ccd9bbc052c92781f31ffe_prof);

    }

    // line 2
    public function block_subject($context, array $blocks = array())
    {
        $__internal_1216758ad9b2b9e5bd9320eb5a6f4d1b08277d41e2e7eb113bd587874d9fd262 = $this->env->getExtension("native_profiler");
        $__internal_1216758ad9b2b9e5bd9320eb5a6f4d1b08277d41e2e7eb113bd587874d9fd262->enter($__internal_1216758ad9b2b9e5bd9320eb5a6f4d1b08277d41e2e7eb113bd587874d9fd262_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "subject"));

        // line 4
        echo $this->env->getExtension('translator')->trans("registration.email.subject", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_1216758ad9b2b9e5bd9320eb5a6f4d1b08277d41e2e7eb113bd587874d9fd262->leave($__internal_1216758ad9b2b9e5bd9320eb5a6f4d1b08277d41e2e7eb113bd587874d9fd262_prof);

    }

    // line 7
    public function block_body_text($context, array $blocks = array())
    {
        $__internal_ae98fb492feea21baec3a4f4a20bd1e06d2a4a8f95782bdfde420122526b00b8 = $this->env->getExtension("native_profiler");
        $__internal_ae98fb492feea21baec3a4f4a20bd1e06d2a4a8f95782bdfde420122526b00b8->enter($__internal_ae98fb492feea21baec3a4f4a20bd1e06d2a4a8f95782bdfde420122526b00b8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_text"));

        // line 9
        echo $this->env->getExtension('translator')->trans("registration.email.message", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_ae98fb492feea21baec3a4f4a20bd1e06d2a4a8f95782bdfde420122526b00b8->leave($__internal_ae98fb492feea21baec3a4f4a20bd1e06d2a4a8f95782bdfde420122526b00b8_prof);

    }

    // line 12
    public function block_body_html($context, array $blocks = array())
    {
        $__internal_08103a8a6c1d1c17734729bd6412d4438f982eccf0dc71e53d4dddd585f341f4 = $this->env->getExtension("native_profiler");
        $__internal_08103a8a6c1d1c17734729bd6412d4438f982eccf0dc71e53d4dddd585f341f4->enter($__internal_08103a8a6c1d1c17734729bd6412d4438f982eccf0dc71e53d4dddd585f341f4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_html"));

        
        $__internal_08103a8a6c1d1c17734729bd6412d4438f982eccf0dc71e53d4dddd585f341f4->leave($__internal_08103a8a6c1d1c17734729bd6412d4438f982eccf0dc71e53d4dddd585f341f4_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:email.txt.twig";
    }

    public function getDebugInfo()
    {
        return array (  66 => 12,  57 => 9,  51 => 7,  42 => 4,  36 => 2,  29 => 12,  27 => 7,  25 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* {% block subject %}*/
/* {% autoescape false %}*/
/* {{ 'registration.email.subject'|trans({'%username%': user.username, '%confirmationUrl%': confirmationUrl}) }}*/
/* {% endautoescape %}*/
/* {% endblock %}*/
/* {% block body_text %}*/
/* {% autoescape false %}*/
/* {{ 'registration.email.message'|trans({'%username%': user.username, '%confirmationUrl%': confirmationUrl}) }}*/
/* {% endautoescape %}*/
/* {% endblock %}*/
/* {% block body_html %}{% endblock %}*/
/* */
