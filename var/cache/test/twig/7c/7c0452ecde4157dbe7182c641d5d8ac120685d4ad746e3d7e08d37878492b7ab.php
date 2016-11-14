<?php

/* SonataAdminBundle:Core:user_block.html.twig */
class __TwigTemplate_260f136d1992852d2996d24fe130b25cf9660364beedd6312d36a81bbc5f8f18 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'user_block' => array($this, 'block_user_block'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7aa7d3afe0b8d5b5f02125d84e54daa4fefd3aab3654464485683a7711b25b93 = $this->env->getExtension("native_profiler");
        $__internal_7aa7d3afe0b8d5b5f02125d84e54daa4fefd3aab3654464485683a7711b25b93->enter($__internal_7aa7d3afe0b8d5b5f02125d84e54daa4fefd3aab3654464485683a7711b25b93_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Core:user_block.html.twig"));

        // line 1
        $this->displayBlock('user_block', $context, $blocks);
        
        $__internal_7aa7d3afe0b8d5b5f02125d84e54daa4fefd3aab3654464485683a7711b25b93->leave($__internal_7aa7d3afe0b8d5b5f02125d84e54daa4fefd3aab3654464485683a7711b25b93_prof);

    }

    public function block_user_block($context, array $blocks = array())
    {
        $__internal_0e37bdd1b0c82f4e5a9d8e9154e6df784f995cc9e6f796a402daeeb242db6f64 = $this->env->getExtension("native_profiler");
        $__internal_0e37bdd1b0c82f4e5a9d8e9154e6df784f995cc9e6f796a402daeeb242db6f64->enter($__internal_0e37bdd1b0c82f4e5a9d8e9154e6df784f995cc9e6f796a402daeeb242db6f64_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "user_block"));

        
        $__internal_0e37bdd1b0c82f4e5a9d8e9154e6df784f995cc9e6f796a402daeeb242db6f64->leave($__internal_0e37bdd1b0c82f4e5a9d8e9154e6df784f995cc9e6f796a402daeeb242db6f64_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Core:user_block.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }
}
/* {% block user_block %}{# Customize this value #}{% endblock %}*/
/* */
