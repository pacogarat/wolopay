<?php

/* IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig */
class __TwigTemplate_77ec995fc7755db30fd1802490497332878b104ea343776b7ff2c3a15dcb953a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_73aa5a0d2cfca87222ea49cef3be1b13bd43460cc9949ceb1ff7aa894099d5e6 = $this->env->getExtension("native_profiler");
        $__internal_73aa5a0d2cfca87222ea49cef3be1b13bd43460cc9949ceb1ff7aa894099d5e6->enter($__internal_73aa5a0d2cfca87222ea49cef3be1b13bd43460cc9949ceb1ff7aa894099d5e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig"));

        // line 1
        echo "<a class=\"sonata-action-element\" href=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "clear_cache"), "method"), "html", null, true);
        echo "\">
    <i class=\"fa fa-refresh\"></i>";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("action.clear_cache", array(), "IbrowsSonataTranslationBundle"), "html", null, true);
        echo "
</a>";
        
        $__internal_73aa5a0d2cfca87222ea49cef3be1b13bd43460cc9949ceb1ff7aa894099d5e6->leave($__internal_73aa5a0d2cfca87222ea49cef3be1b13bd43460cc9949ceb1ff7aa894099d5e6_prof);

    }

    public function getTemplateName()
    {
        return "IbrowsSonataTranslationBundle:Core:clear_cache_button.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 2,  22 => 1,);
    }
}
/* <a class="sonata-action-element" href="{{ admin.generateUrl('clear_cache') }}">*/
/*     <i class="fa fa-refresh"></i>{{ 'action.clear_cache'|trans({}, 'IbrowsSonataTranslationBundle') }}*/
/* </a>*/
