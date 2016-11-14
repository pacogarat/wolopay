<?php

/* FOSUserBundle:Registration:register.html.twig */
class __TwigTemplate_fd85550556a11921ee7ed24093c25cb390d4669642761c11aa535afa457e4b08 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Registration:register.html.twig", 1);
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
        $__internal_fa105b36ca1b24bea1417c336e4b4d8177e5d107767ce78ba8c2ac555001228c = $this->env->getExtension("native_profiler");
        $__internal_fa105b36ca1b24bea1417c336e4b4d8177e5d107767ce78ba8c2ac555001228c->enter($__internal_fa105b36ca1b24bea1417c336e4b4d8177e5d107767ce78ba8c2ac555001228c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Registration:register.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_fa105b36ca1b24bea1417c336e4b4d8177e5d107767ce78ba8c2ac555001228c->leave($__internal_fa105b36ca1b24bea1417c336e4b4d8177e5d107767ce78ba8c2ac555001228c_prof);

    }

    // line 3
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_0feb7285a9ccf0ec44b4817b1edcd493be62102ae10c7810f74165e6ce176208 = $this->env->getExtension("native_profiler");
        $__internal_0feb7285a9ccf0ec44b4817b1edcd493be62102ae10c7810f74165e6ce176208->enter($__internal_0feb7285a9ccf0ec44b4817b1edcd493be62102ae10c7810f74165e6ce176208_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 4
        $this->loadTemplate("FOSUserBundle:Registration:register_content.html.twig", "FOSUserBundle:Registration:register.html.twig", 4)->display($context);
        
        $__internal_0feb7285a9ccf0ec44b4817b1edcd493be62102ae10c7810f74165e6ce176208->leave($__internal_0feb7285a9ccf0ec44b4817b1edcd493be62102ae10c7810f74165e6ce176208_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Registration:register.html.twig";
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
/* {% include "FOSUserBundle:Registration:register_content.html.twig" %}*/
/* {% endblock fos_user_content %}*/
/* */
