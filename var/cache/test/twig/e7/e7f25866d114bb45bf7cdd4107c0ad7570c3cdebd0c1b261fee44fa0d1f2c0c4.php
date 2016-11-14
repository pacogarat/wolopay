<?php

/* IbrowsSonataTranslationBundle::translation_layout.html.twig */
class __TwigTemplate_fe4bad3228315a45098cc15d8297f79be633086088b05ab66639a9ee32716b5c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "originalTemplate", array(0 => "layout"), "method"), "IbrowsSonataTranslationBundle::translation_layout.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e0dda37ffa0f9fb653dfe43234ec0a40461748a1ba4e6f11741d1676ef9981e6 = $this->env->getExtension("native_profiler");
        $__internal_e0dda37ffa0f9fb653dfe43234ec0a40461748a1ba4e6f11741d1676ef9981e6->enter($__internal_e0dda37ffa0f9fb653dfe43234ec0a40461748a1ba4e6f11741d1676ef9981e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle::translation_layout.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e0dda37ffa0f9fb653dfe43234ec0a40461748a1ba4e6f11741d1676ef9981e6->leave($__internal_e0dda37ffa0f9fb653dfe43234ec0a40461748a1ba4e6f11741d1676ef9981e6_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_1605b7f76de088d8c6f755bbd74cd63a1305a07de45192679bfb5fefb1e15bab = $this->env->getExtension("native_profiler");
        $__internal_1605b7f76de088d8c6f755bbd74cd63a1305a07de45192679bfb5fefb1e15bab->enter($__internal_1605b7f76de088d8c6f755bbd74cd63a1305a07de45192679bfb5fefb1e15bab_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 4
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ibrowssonatatranslation/bootstrap-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_1605b7f76de088d8c6f755bbd74cd63a1305a07de45192679bfb5fefb1e15bab->leave($__internal_1605b7f76de088d8c6f755bbd74cd63a1305a07de45192679bfb5fefb1e15bab_prof);

    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_7cb271fb39f80db3292cda66bde03bf7b4f97e2a9d8d2bf1c2ca925d2957ac83 = $this->env->getExtension("native_profiler");
        $__internal_7cb271fb39f80db3292cda66bde03bf7b4f97e2a9d8d2bf1c2ca925d2957ac83->enter($__internal_7cb271fb39f80db3292cda66bde03bf7b4f97e2a9d8d2bf1c2ca925d2957ac83_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 10
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ibrowssonatatranslation/bootstrap-editable/js/bootstrap-editable.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
        
        $__internal_7cb271fb39f80db3292cda66bde03bf7b4f97e2a9d8d2bf1c2ca925d2957ac83->leave($__internal_7cb271fb39f80db3292cda66bde03bf7b4f97e2a9d8d2bf1c2ca925d2957ac83_prof);

    }

    public function getTemplateName()
    {
        return "IbrowsSonataTranslationBundle::translation_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 12,  60 => 10,  54 => 9,  45 => 6,  40 => 4,  34 => 3,  19 => 1,);
    }
}
/* {% extends admin.originalTemplate('layout') %}*/
/* */
/* {% block stylesheets %}*/
/* {{ parent() }}*/
/* */
/* <link rel="stylesheet" href="{{ asset('bundles/ibrowssonatatranslation/bootstrap-editable/css/bootstrap-editable.css') }}" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block javascripts %}*/
/* {{ parent() }}*/
/* */
/* <script src="{{ asset('bundles/ibrowssonatatranslation/bootstrap-editable/js/bootstrap-editable.min.js') }}" type="text/javascript"></script>*/
/* {% endblock %}*/
/* */
