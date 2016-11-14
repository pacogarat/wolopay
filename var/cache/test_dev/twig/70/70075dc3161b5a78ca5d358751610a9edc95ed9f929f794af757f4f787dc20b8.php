<?php

/* FOSUserBundle:Group:new.html.twig */
class __TwigTemplate_66f0b70cbbdfa9eb10881a01b86f019e68f0dfdc7b4858a7db1ef1834b7734a0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Group:new.html.twig", 1);
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
        $__internal_0f7aa13e4fa8e434a49d2f13755c9668314edd36a53e5d9a3f25ea309c01e954 = $this->env->getExtension("native_profiler");
        $__internal_0f7aa13e4fa8e434a49d2f13755c9668314edd36a53e5d9a3f25ea309c01e954->enter($__internal_0f7aa13e4fa8e434a49d2f13755c9668314edd36a53e5d9a3f25ea309c01e954_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0f7aa13e4fa8e434a49d2f13755c9668314edd36a53e5d9a3f25ea309c01e954->leave($__internal_0f7aa13e4fa8e434a49d2f13755c9668314edd36a53e5d9a3f25ea309c01e954_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_dbe5b9ce91e067330dc22f19c97d575a508ded8a98936de2224fbc6a392c4897 = $this->env->getExtension("native_profiler");
        $__internal_dbe5b9ce91e067330dc22f19c97d575a508ded8a98936de2224fbc6a392c4897->enter($__internal_dbe5b9ce91e067330dc22f19c97d575a508ded8a98936de2224fbc6a392c4897_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:new_content.html.twig", "FOSUserBundle:Group:new.html.twig", 4)->display($context);
        
        $__internal_dbe5b9ce91e067330dc22f19c97d575a508ded8a98936de2224fbc6a392c4897->leave($__internal_dbe5b9ce91e067330dc22f19c97d575a508ded8a98936de2224fbc6a392c4897_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:new.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% block fos_user_content %}*/
/* {% include "FOSUserBundle:Group:new_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
