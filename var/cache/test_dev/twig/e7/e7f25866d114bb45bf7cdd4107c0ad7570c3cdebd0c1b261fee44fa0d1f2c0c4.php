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
        $__internal_e58da682679906e6813f0ef4e7f219e090c74b4935fce62d4108dcff4dec3bbf = $this->env->getExtension("native_profiler");
        $__internal_e58da682679906e6813f0ef4e7f219e090c74b4935fce62d4108dcff4dec3bbf->enter($__internal_e58da682679906e6813f0ef4e7f219e090c74b4935fce62d4108dcff4dec3bbf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "IbrowsSonataTranslationBundle::translation_layout.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e58da682679906e6813f0ef4e7f219e090c74b4935fce62d4108dcff4dec3bbf->leave($__internal_e58da682679906e6813f0ef4e7f219e090c74b4935fce62d4108dcff4dec3bbf_prof);

    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_82d3a6a62511722cd35c91470f996212e4dadbcde2a085b255bf093ce76ea2db = $this->env->getExtension("native_profiler");
        $__internal_82d3a6a62511722cd35c91470f996212e4dadbcde2a085b255bf093ce76ea2db->enter($__internal_82d3a6a62511722cd35c91470f996212e4dadbcde2a085b255bf093ce76ea2db_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 4
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

<link rel=\"stylesheet\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ibrowssonatatranslation/bootstrap-editable/css/bootstrap-editable.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_82d3a6a62511722cd35c91470f996212e4dadbcde2a085b255bf093ce76ea2db->leave($__internal_82d3a6a62511722cd35c91470f996212e4dadbcde2a085b255bf093ce76ea2db_prof);

    }

    // line 9
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_935de6ffdfaa4d4c05add4d6ed2ccc4a7c44a9da9b3aee13cdf58029060a340a = $this->env->getExtension("native_profiler");
        $__internal_935de6ffdfaa4d4c05add4d6ed2ccc4a7c44a9da9b3aee13cdf58029060a340a->enter($__internal_935de6ffdfaa4d4c05add4d6ed2ccc4a7c44a9da9b3aee13cdf58029060a340a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 10
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

<script src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/ibrowssonatatranslation/bootstrap-editable/js/bootstrap-editable.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
";
        
        $__internal_935de6ffdfaa4d4c05add4d6ed2ccc4a7c44a9da9b3aee13cdf58029060a340a->leave($__internal_935de6ffdfaa4d4c05add4d6ed2ccc4a7c44a9da9b3aee13cdf58029060a340a_prof);

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
