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
        $__internal_346f6382ec684baa907089fe42a7032705cbc125512e4493f55968066607b11f = $this->env->getExtension("native_profiler");
        $__internal_346f6382ec684baa907089fe42a7032705cbc125512e4493f55968066607b11f->enter($__internal_346f6382ec684baa907089fe42a7032705cbc125512e4493f55968066607b11f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:email.txt.twig"));

        // line 2
        $this->displayBlock('subject', $context, $blocks);
        // line 7
        $this->displayBlock('body_text', $context, $blocks);
        // line 12
        $this->displayBlock('body_html', $context, $blocks);
        
        $__internal_346f6382ec684baa907089fe42a7032705cbc125512e4493f55968066607b11f->leave($__internal_346f6382ec684baa907089fe42a7032705cbc125512e4493f55968066607b11f_prof);

    }

    // line 2
    public function block_subject($context, array $blocks = array())
    {
        $__internal_80d2f633c5a36040f097b3b42d9be9c72370467b4a252b39176c7a94a57f8326 = $this->env->getExtension("native_profiler");
        $__internal_80d2f633c5a36040f097b3b42d9be9c72370467b4a252b39176c7a94a57f8326->enter($__internal_80d2f633c5a36040f097b3b42d9be9c72370467b4a252b39176c7a94a57f8326_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "subject"));

        // line 4
        echo $this->env->getExtension('translator')->trans("resetting.email.subject", array(), "FOSUserBundle");
        echo "
";
        
        $__internal_80d2f633c5a36040f097b3b42d9be9c72370467b4a252b39176c7a94a57f8326->leave($__internal_80d2f633c5a36040f097b3b42d9be9c72370467b4a252b39176c7a94a57f8326_prof);

    }

    // line 7
    public function block_body_text($context, array $blocks = array())
    {
        $__internal_e4334cc21ca537c9e773ccb2b0a268b275060d4405b37d3c4041e4a8317763f2 = $this->env->getExtension("native_profiler");
        $__internal_e4334cc21ca537c9e773ccb2b0a268b275060d4405b37d3c4041e4a8317763f2->enter($__internal_e4334cc21ca537c9e773ccb2b0a268b275060d4405b37d3c4041e4a8317763f2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_text"));

        // line 9
        echo $this->env->getExtension('translator')->trans("resetting.email.message", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_e4334cc21ca537c9e773ccb2b0a268b275060d4405b37d3c4041e4a8317763f2->leave($__internal_e4334cc21ca537c9e773ccb2b0a268b275060d4405b37d3c4041e4a8317763f2_prof);

    }

    // line 12
    public function block_body_html($context, array $blocks = array())
    {
        $__internal_6233b770dfa9f5584fb8d2372ea30aaa9d5752071cb95265e35017c28154531b = $this->env->getExtension("native_profiler");
        $__internal_6233b770dfa9f5584fb8d2372ea30aaa9d5752071cb95265e35017c28154531b->enter($__internal_6233b770dfa9f5584fb8d2372ea30aaa9d5752071cb95265e35017c28154531b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_html"));

        
        $__internal_6233b770dfa9f5584fb8d2372ea30aaa9d5752071cb95265e35017c28154531b->leave($__internal_6233b770dfa9f5584fb8d2372ea30aaa9d5752071cb95265e35017c28154531b_prof);

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
