<?php

/* BraincraftedBootstrapBundle::layout.html.twig */
class __TwigTemplate_fa9cff81d1177e5d66e4cfc070ddb815e9a27e14495a10305e89752fbfa540f3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_959a36a62c92236c7d259046a0b7a4e25cb973947223ea631f88a1be2de5eb15 = $this->env->getExtension("native_profiler");
        $__internal_959a36a62c92236c7d259046a0b7a4e25cb973947223ea631f88a1be2de5eb15->enter($__internal_959a36a62c92236c7d259046a0b7a4e25cb973947223ea631f88a1be2de5eb15_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "BraincraftedBootstrapBundle::layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>

<head>

<title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

<!-- Bootstrap -->
<link href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("/css/bootstrap.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"screen\">

";
        // line 12
        $this->displayBlock('head', $context, $blocks);
        // line 13
        echo "
</head>

<body>

";
        // line 18
        $this->displayBlock('body', $context, $blocks);
        // line 19
        echo "
<!-- JavaScript plugins (requires jQuery) -->
<script src=\"//code.jquery.com/jquery.js\"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("/js/bootstrap.js"), "html", null, true);
        echo "\"></script>

<!-- Optionally enable responsive features in IE8 -->
<script src=\"js/respond.js\"></script>

</body>
</html>
";
        
        $__internal_959a36a62c92236c7d259046a0b7a4e25cb973947223ea631f88a1be2de5eb15->leave($__internal_959a36a62c92236c7d259046a0b7a4e25cb973947223ea631f88a1be2de5eb15_prof);

    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        $__internal_cba2d8fd9e699e778fb86ff0bdd4b4a566f0acd1ba6771abf95b41dbd339e315 = $this->env->getExtension("native_profiler");
        $__internal_cba2d8fd9e699e778fb86ff0bdd4b4a566f0acd1ba6771abf95b41dbd339e315->enter($__internal_cba2d8fd9e699e778fb86ff0bdd4b4a566f0acd1ba6771abf95b41dbd339e315_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "BraincraftedBootstrapBundle by Florian Eckerstorfer";
        
        $__internal_cba2d8fd9e699e778fb86ff0bdd4b4a566f0acd1ba6771abf95b41dbd339e315->leave($__internal_cba2d8fd9e699e778fb86ff0bdd4b4a566f0acd1ba6771abf95b41dbd339e315_prof);

    }

    // line 12
    public function block_head($context, array $blocks = array())
    {
        $__internal_e30f59f9c12d3de3fd428c9f87882e5d3461494dfe0e64dafbb06c7a5edb04f6 = $this->env->getExtension("native_profiler");
        $__internal_e30f59f9c12d3de3fd428c9f87882e5d3461494dfe0e64dafbb06c7a5edb04f6->enter($__internal_e30f59f9c12d3de3fd428c9f87882e5d3461494dfe0e64dafbb06c7a5edb04f6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        
        $__internal_e30f59f9c12d3de3fd428c9f87882e5d3461494dfe0e64dafbb06c7a5edb04f6->leave($__internal_e30f59f9c12d3de3fd428c9f87882e5d3461494dfe0e64dafbb06c7a5edb04f6_prof);

    }

    // line 18
    public function block_body($context, array $blocks = array())
    {
        $__internal_918f746ae58e63176dbd19e58a312d3eceead581aaed559ae142bface5385674 = $this->env->getExtension("native_profiler");
        $__internal_918f746ae58e63176dbd19e58a312d3eceead581aaed559ae142bface5385674->enter($__internal_918f746ae58e63176dbd19e58a312d3eceead581aaed559ae142bface5385674_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_918f746ae58e63176dbd19e58a312d3eceead581aaed559ae142bface5385674->leave($__internal_918f746ae58e63176dbd19e58a312d3eceead581aaed559ae142bface5385674_prof);

    }

    public function getTemplateName()
    {
        return "BraincraftedBootstrapBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 18,  88 => 12,  76 => 6,  61 => 23,  55 => 19,  53 => 18,  46 => 13,  44 => 12,  39 => 10,  32 => 6,  25 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* */
/* <head>*/
/* */
/* <title>{% block title %}BraincraftedBootstrapBundle by Florian Eckerstorfer{% endblock title %}</title>*/
/* <meta name="viewport" content="width=device-width, initial-scale=1.0">*/
/* */
/* <!-- Bootstrap -->*/
/* <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" media="screen">*/
/* */
/* {% block head %}{% endblock %}*/
/* */
/* </head>*/
/* */
/* <body>*/
/* */
/* {% block body %}{% endblock body %}*/
/* */
/* <!-- JavaScript plugins (requires jQuery) -->*/
/* <script src="//code.jquery.com/jquery.js"></script>*/
/* <!-- Include all compiled plugins (below), or include individual files as needed -->*/
/* <script src="{{ asset('/js/bootstrap.js') }}"></script>*/
/* */
/* <!-- Optionally enable responsive features in IE8 -->*/
/* <script src="js/respond.js"></script>*/
/* */
/* </body>*/
/* </html>*/
/* */
