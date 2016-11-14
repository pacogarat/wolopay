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
        $__internal_55fea6b4e9a67a0e83b46122863a44f1b431b3d28d31eb99b5cbdf8ab6a05a98 = $this->env->getExtension("native_profiler");
        $__internal_55fea6b4e9a67a0e83b46122863a44f1b431b3d28d31eb99b5cbdf8ab6a05a98->enter($__internal_55fea6b4e9a67a0e83b46122863a44f1b431b3d28d31eb99b5cbdf8ab6a05a98_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:email.txt.twig"));

        // line 2
        $this->displayBlock('subject', $context, $blocks);
        // line 7
        $this->displayBlock('body_text', $context, $blocks);
        // line 12
        $this->displayBlock('body_html', $context, $blocks);
        
        $__internal_55fea6b4e9a67a0e83b46122863a44f1b431b3d28d31eb99b5cbdf8ab6a05a98->leave($__internal_55fea6b4e9a67a0e83b46122863a44f1b431b3d28d31eb99b5cbdf8ab6a05a98_prof);

    }

    // line 2
    public function block_subject($context, array $blocks = array())
    {
        $__internal_4eb53edbe34eb9e4d35d8c81d8c330ee799c89e6cb425831640b8d998d123ff1 = $this->env->getExtension("native_profiler");
        $__internal_4eb53edbe34eb9e4d35d8c81d8c330ee799c89e6cb425831640b8d998d123ff1->enter($__internal_4eb53edbe34eb9e4d35d8c81d8c330ee799c89e6cb425831640b8d998d123ff1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "subject"));

        // line 4
        echo $this->env->getExtension('translator')->trans("registration.email.subject", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_4eb53edbe34eb9e4d35d8c81d8c330ee799c89e6cb425831640b8d998d123ff1->leave($__internal_4eb53edbe34eb9e4d35d8c81d8c330ee799c89e6cb425831640b8d998d123ff1_prof);

    }

    // line 7
    public function block_body_text($context, array $blocks = array())
    {
        $__internal_ce297222eed46bd1dbf5f8cda4cf2a0f35881faa205cef449e6c308566415067 = $this->env->getExtension("native_profiler");
        $__internal_ce297222eed46bd1dbf5f8cda4cf2a0f35881faa205cef449e6c308566415067->enter($__internal_ce297222eed46bd1dbf5f8cda4cf2a0f35881faa205cef449e6c308566415067_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_text"));

        // line 9
        echo $this->env->getExtension('translator')->trans("registration.email.message", array("%username%" => $this->getAttribute((isset($context["user"]) ? $context["user"] : $this->getContext($context, "user")), "username", array()), "%confirmationUrl%" => (isset($context["confirmationUrl"]) ? $context["confirmationUrl"] : $this->getContext($context, "confirmationUrl"))), "FOSUserBundle");
        echo "
";
        
        $__internal_ce297222eed46bd1dbf5f8cda4cf2a0f35881faa205cef449e6c308566415067->leave($__internal_ce297222eed46bd1dbf5f8cda4cf2a0f35881faa205cef449e6c308566415067_prof);

    }

    // line 12
    public function block_body_html($context, array $blocks = array())
    {
        $__internal_d1c7876a4ec68d27c626f7fb70ee64542dac6c381e750c1927cd942554fff8a7 = $this->env->getExtension("native_profiler");
        $__internal_d1c7876a4ec68d27c626f7fb70ee64542dac6c381e750c1927cd942554fff8a7->enter($__internal_d1c7876a4ec68d27c626f7fb70ee64542dac6c381e750c1927cd942554fff8a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body_html"));

        
        $__internal_d1c7876a4ec68d27c626f7fb70ee64542dac6c381e750c1927cd942554fff8a7->leave($__internal_d1c7876a4ec68d27c626f7fb70ee64542dac6c381e750c1927cd942554fff8a7_prof);

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
