<?php

/* FOSUserBundle:Resetting:email.txt.twig */
class __TwigTemplate_a0b3e33ab846f115c2c5fc3ea68e9b06b98e178d433790f9a691a00d38c10c42 extends Twig_Template
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
        $__internal_29f02dbf292e6044d0c8ece2daf19afcbf8766a25415375386d445ec79fbd356 = $this->env->getExtension("native_profiler");
        $__internal_29f02dbf292e6044d0c8ece2daf19afcbf8766a25415375386d445ec79fbd356->enter($__internal_29f02dbf292e6044d0c8ece2daf19afcbf8766a25415375386d445ec79fbd356_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:email.txt.twig"));

        // line 2
        $this->displayBlock('subject', $context, $blocks);
        // line 7
        $this->displayBlock('body_text', $context, $blocks);
        // line 12
        $this->displayBlock('body_html', $context, $blocks);
        
        $__internal_29f02dbf292e6044d0c8ece2daf19afcbf8766a25415375386d445ec79fbd356->leave($__internal_29f02dbf292e6044d0c8ece2daf19afcbf8766a25415375386d445ec79fbd356_prof);

    }

    // line 2
    public function block_subject($context, array $blocks = array())
    {
        $__internal_57b0042ba4467ba9d11dc6bc0e8515eb68a77f48d25a6339be0b4d572dc57ccf = $this->env->getExtension("native_profiler");
        $__internal_57b0042ba4467ba9d11dc6bc0e8515eb68a77f48d25a6339be0b4d572dc57ccf->enter($__internal_57b0042ba4467ba9d11dc6bc0e8515eb68a77f48d25a6339be0b4d572dc57ccf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "subject"));

        // line 4
        echo $this->env->getExtension('translator')->trans("resetting.email.subject", array(), "FOSUserBundle");
        echo "
";
        
        $__internal_57b0042ba4467ba9d11dc6bc0e8515eb68a77f48d25a6339be0b4d572dc57ccf->leave($__internal_57b0042ba4467ba9d11dc6bc0e8515eb68a77f48d25a6339be0b4d572dc57ccf_prof);

    }

    // line 7
    public function block_body_text($context, array $blocks = array())
    {
        $__internal_7e616aac6a649eb1dbffe4f99cc74765a272f1da52384b5b4b8dfc3a6a8342f0 = $this->env->getExtension("native_profiler");
        $__internal_7e616aac6a649eb1dbffe4f99cc74765a272f1da52384b5b4b8dfc3a6a8342f0->enter($__internal_7e616aac6a649eb1dbffe4f99cc74765a272f1da52384b5b4b8dfc3a6a8342f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_text"));

        // line 9
        echo $this->env->getExtension('translator')->trans("resetting.email.message", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_7e616aac6a649eb1dbffe4f99cc74765a272f1da52384b5b4b8dfc3a6a8342f0->leave($__internal_7e616aac6a649eb1dbffe4f99cc74765a272f1da52384b5b4b8dfc3a6a8342f0_prof);

    }

    // line 12
    public function block_body_html($context, array $blocks = array())
    {
        $__internal_90fb1cf52db8b1942c2d9d4897643cf3fae1693755d7d87d0f8a698ff29acddf = $this->env->getExtension("native_profiler");
        $__internal_90fb1cf52db8b1942c2d9d4897643cf3fae1693755d7d87d0f8a698ff29acddf->enter($__internal_90fb1cf52db8b1942c2d9d4897643cf3fae1693755d7d87d0f8a698ff29acddf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_html"));

        
        $__internal_90fb1cf52db8b1942c2d9d4897643cf3fae1693755d7d87d0f8a698ff29acddf->leave($__internal_90fb1cf52db8b1942c2d9d4897643cf3fae1693755d7d87d0f8a698ff29acddf_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:email.txt.twig";
    }

    public function getDebugInfo()
    {
        return array (  66 => 12,  57 => 9,  51 => 7,  42 => 4,  36 => 2,  29 => 12,  27 => 7,  25 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* {% block subject %}*/
/* {% autoescape false %}*/
/* {{ 'resetting.email.subject'|trans }}*/
/* {% endautoescape %}*/
/* {% endblock %}*/
/* {% block body_text %}*/
/* {% autoescape false %}*/
/* {{ 'resetting.email.message'|trans({'%username%': user.username, '%confirmationUrl%': confirmationUrl}) }}*/
/* {% endautoescape %}*/
/* {% endblock %}*/
/* {% block body_html %}{% endblock %}*/
/* */
