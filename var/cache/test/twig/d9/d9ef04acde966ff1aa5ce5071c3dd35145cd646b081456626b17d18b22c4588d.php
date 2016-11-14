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
        $__internal_f1459ada5d1e1f3d8975a6059554b72dfad0ef8b217cebdedeb3eb7091f60da3 = $this->env->getExtension("native_profiler");
        $__internal_f1459ada5d1e1f3d8975a6059554b72dfad0ef8b217cebdedeb3eb7091f60da3->enter($__internal_f1459ada5d1e1f3d8975a6059554b72dfad0ef8b217cebdedeb3eb7091f60da3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "BraincraftedBootstrapBundle::layout.html.twig"));

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
        
        $__internal_f1459ada5d1e1f3d8975a6059554b72dfad0ef8b217cebdedeb3eb7091f60da3->leave($__internal_f1459ada5d1e1f3d8975a6059554b72dfad0ef8b217cebdedeb3eb7091f60da3_prof);

    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        $__internal_e61d7a4cca304cf3b00713470411541a55f08ba3a4530abfe0bd5dac075aec7f = $this->env->getExtension("native_profiler");
        $__internal_e61d7a4cca304cf3b00713470411541a55f08ba3a4530abfe0bd5dac075aec7f->enter($__internal_e61d7a4cca304cf3b00713470411541a55f08ba3a4530abfe0bd5dac075aec7f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "BraincraftedBootstrapBundle by Florian Eckerstorfer";
        
        $__internal_e61d7a4cca304cf3b00713470411541a55f08ba3a4530abfe0bd5dac075aec7f->leave($__internal_e61d7a4cca304cf3b00713470411541a55f08ba3a4530abfe0bd5dac075aec7f_prof);

    }

    // line 12
    public function block_head($context, array $blocks = array())
    {
        $__internal_e3d6ea0fc734b10b81ea2377d7cdff712957547112a5e7b5d13f1d3f5b9ce287 = $this->env->getExtension("native_profiler");
        $__internal_e3d6ea0fc734b10b81ea2377d7cdff712957547112a5e7b5d13f1d3f5b9ce287->enter($__internal_e3d6ea0fc734b10b81ea2377d7cdff712957547112a5e7b5d13f1d3f5b9ce287_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        
        $__internal_e3d6ea0fc734b10b81ea2377d7cdff712957547112a5e7b5d13f1d3f5b9ce287->leave($__internal_e3d6ea0fc734b10b81ea2377d7cdff712957547112a5e7b5d13f1d3f5b9ce287_prof);

    }

    // line 18
    public function block_body($context, array $blocks = array())
    {
        $__internal_be841c679b6c9081ae94742d4678cd5aa39c393161721b7fbe70da91deec7881 = $this->env->getExtension("native_profiler");
        $__internal_be841c679b6c9081ae94742d4678cd5aa39c393161721b7fbe70da91deec7881->enter($__internal_be841c679b6c9081ae94742d4678cd5aa39c393161721b7fbe70da91deec7881_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_be841c679b6c9081ae94742d4678cd5aa39c393161721b7fbe70da91deec7881->leave($__internal_be841c679b6c9081ae94742d4678cd5aa39c393161721b7fbe70da91deec7881_prof);

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
