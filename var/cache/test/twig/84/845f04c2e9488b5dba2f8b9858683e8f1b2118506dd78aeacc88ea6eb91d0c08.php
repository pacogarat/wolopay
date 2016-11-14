<?php

/* SonataAdminBundle:CRUD:edit_file.html.twig */
class __TwigTemplate_8448e5c4157b1d6f245eb909e140dcbfe3302de5eed918b7678ac8433f51e6da extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:edit_file.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_76702ceb245a28c83046d45e79a106a5d75608f7c275c9162e45866780e78de4 = $this->env->getExtension("native_profiler");
        $__internal_76702ceb245a28c83046d45e79a106a5d75608f7c275c9162e45866780e78de4->enter($__internal_76702ceb245a28c83046d45e79a106a5d75608f7c275c9162e45866780e78de4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:edit_file.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_76702ceb245a28c83046d45e79a106a5d75608f7c275c9162e45866780e78de4->leave($__internal_76702ceb245a28c83046d45e79a106a5d75608f7c275c9162e45866780e78de4_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_5bdb4e0191982f3a84315400b1e6874713a54359c0e65964aa2926f7eac69907 = $this->env->getExtension("native_profiler");
        $__internal_5bdb4e0191982f3a84315400b1e6874713a54359c0e65964aa2926f7eac69907->enter($__internal_5bdb4e0191982f3a84315400b1e6874713a54359c0e65964aa2926f7eac69907_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["field_element"]) ? $context["field_element"] : $this->getContext($context, "field_element")), 'widget', array("attr" => array("class" => "title")));
        
        $__internal_5bdb4e0191982f3a84315400b1e6874713a54359c0e65964aa2926f7eac69907->leave($__internal_5bdb4e0191982f3a84315400b1e6874713a54359c0e65964aa2926f7eac69907_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:edit_file.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 14,  18 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends base_template %}*/
/* */
/* {% block field %}{{ form_widget(field_element, {'attr': {'class' : 'title'}}) }}{% endblock %}*/
/* */
