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
        $__internal_626c1e36f3590bb2af8a9b8ce982241a7dd9b49e8eeaf9939503958b3243231c = $this->env->getExtension("native_profiler");
        $__internal_626c1e36f3590bb2af8a9b8ce982241a7dd9b49e8eeaf9939503958b3243231c->enter($__internal_626c1e36f3590bb2af8a9b8ce982241a7dd9b49e8eeaf9939503958b3243231c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:new.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_626c1e36f3590bb2af8a9b8ce982241a7dd9b49e8eeaf9939503958b3243231c->leave($__internal_626c1e36f3590bb2af8a9b8ce982241a7dd9b49e8eeaf9939503958b3243231c_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_4ad7c76399ea1a899c0da666dc04ec058213de0523bef8c01a9a566fce28b8de = $this->env->getExtension("native_profiler");
        $__internal_4ad7c76399ea1a899c0da666dc04ec058213de0523bef8c01a9a566fce28b8de->enter($__internal_4ad7c76399ea1a899c0da666dc04ec058213de0523bef8c01a9a566fce28b8de_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Group:new_content.html.twig", "FOSUserBundle:Group:new.html.twig", 4)->display($context);
        
        $__internal_4ad7c76399ea1a899c0da666dc04ec058213de0523bef8c01a9a566fce28b8de->leave($__internal_4ad7c76399ea1a899c0da666dc04ec058213de0523bef8c01a9a566fce28b8de_prof);

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
