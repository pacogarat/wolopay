<?php

/* ::base.html.twig */
class __TwigTemplate_f808c0fa9018b3d573e57acb364eeb3e89c498fa64cb9d48f6b130f560acc18e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_bc34fa12b9c72cb9f56f0dc73958f0afd4a0502e74cc0263b9279f001c7b2d63 = $this->env->getExtension("native_profiler");
        $__internal_bc34fa12b9c72cb9f56f0dc73958f0afd4a0502e74cc0263b9279f001c7b2d63->enter($__internal_bc34fa12b9c72cb9f56f0dc73958f0afd4a0502e74cc0263b9279f001c7b2d63_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\"/>
    </head>
    <body>
        ";
        // line 12
        $this->displayBlock('body', $context, $blocks);
        // line 13
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 14
        echo "    </body>
</html>
";
        
        $__internal_bc34fa12b9c72cb9f56f0dc73958f0afd4a0502e74cc0263b9279f001c7b2d63->leave($__internal_bc34fa12b9c72cb9f56f0dc73958f0afd4a0502e74cc0263b9279f001c7b2d63_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_c3f8d442e2015da96b651d0cf03b3863367f97be59a52f02610bda3a1ad0cbed = $this->env->getExtension("native_profiler");
        $__internal_c3f8d442e2015da96b651d0cf03b3863367f97be59a52f02610bda3a1ad0cbed->enter($__internal_c3f8d442e2015da96b651d0cf03b3863367f97be59a52f02610bda3a1ad0cbed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Wolopay!";
        
        $__internal_c3f8d442e2015da96b651d0cf03b3863367f97be59a52f02610bda3a1ad0cbed->leave($__internal_c3f8d442e2015da96b651d0cf03b3863367f97be59a52f02610bda3a1ad0cbed_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_19bc07c339d5685e730ce3ca68be338a04dd9431b3d5cc254ccb5a13f139ffd9 = $this->env->getExtension("native_profiler");
        $__internal_19bc07c339d5685e730ce3ca68be338a04dd9431b3d5cc254ccb5a13f139ffd9->enter($__internal_19bc07c339d5685e730ce3ca68be338a04dd9431b3d5cc254ccb5a13f139ffd9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_19bc07c339d5685e730ce3ca68be338a04dd9431b3d5cc254ccb5a13f139ffd9->leave($__internal_19bc07c339d5685e730ce3ca68be338a04dd9431b3d5cc254ccb5a13f139ffd9_prof);

    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        $__internal_94c53e4cdaf503fc96de1747766f30ea24c0cdd0ded0a661039f3c484eaf0ddd = $this->env->getExtension("native_profiler");
        $__internal_94c53e4cdaf503fc96de1747766f30ea24c0cdd0ded0a661039f3c484eaf0ddd->enter($__internal_94c53e4cdaf503fc96de1747766f30ea24c0cdd0ded0a661039f3c484eaf0ddd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_94c53e4cdaf503fc96de1747766f30ea24c0cdd0ded0a661039f3c484eaf0ddd->leave($__internal_94c53e4cdaf503fc96de1747766f30ea24c0cdd0ded0a661039f3c484eaf0ddd_prof);

    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_9e6658634d86760a7bca2219bbb2f59fa652a196a280c8768778e7b1e1fb5ba0 = $this->env->getExtension("native_profiler");
        $__internal_9e6658634d86760a7bca2219bbb2f59fa652a196a280c8768778e7b1e1fb5ba0->enter($__internal_9e6658634d86760a7bca2219bbb2f59fa652a196a280c8768778e7b1e1fb5ba0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_9e6658634d86760a7bca2219bbb2f59fa652a196a280c8768778e7b1e1fb5ba0->leave($__internal_9e6658634d86760a7bca2219bbb2f59fa652a196a280c8768778e7b1e1fb5ba0_prof);

    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 13,  84 => 12,  73 => 6,  61 => 5,  52 => 14,  49 => 13,  47 => 12,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title>{% block title %}Wolopay!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*         <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*         <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>*/
/*     </head>*/
/*     <body>*/
/*         {% block body %}{% endblock %}*/
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
