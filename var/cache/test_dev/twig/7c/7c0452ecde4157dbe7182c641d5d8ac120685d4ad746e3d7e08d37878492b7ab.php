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
        $__internal_fa8055073a02e93675ca18d5e66f9fee97c8dbc96ef2aa9d8ba42e7cf313a963 = $this->env->getExtension("native_profiler");
        $__internal_fa8055073a02e93675ca18d5e66f9fee97c8dbc96ef2aa9d8ba42e7cf313a963->enter($__internal_fa8055073a02e93675ca18d5e66f9fee97c8dbc96ef2aa9d8ba42e7cf313a963_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Core:user_block.html.twig"));

        // line 1
        $this->displayBlock('user_block', $context, $blocks);
        
        $__internal_fa8055073a02e93675ca18d5e66f9fee97c8dbc96ef2aa9d8ba42e7cf313a963->leave($__internal_fa8055073a02e93675ca18d5e66f9fee97c8dbc96ef2aa9d8ba42e7cf313a963_prof);

    }

    public function block_user_block($context, array $blocks = array())
    {
        $__internal_d58c70403b41b392f0afaaf85bd22845110b5196818a8154e7993e16a8cfa2cf = $this->env->getExtension("native_profiler");
        $__internal_d58c70403b41b392f0afaaf85bd22845110b5196818a8154e7993e16a8cfa2cf->enter($__internal_d58c70403b41b392f0afaaf85bd22845110b5196818a8154e7993e16a8cfa2cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "user_block"));

        
        $__internal_d58c70403b41b392f0afaaf85bd22845110b5196818a8154e7993e16a8cfa2cf->leave($__internal_d58c70403b41b392f0afaaf85bd22845110b5196818a8154e7993e16a8cfa2cf_prof);

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
