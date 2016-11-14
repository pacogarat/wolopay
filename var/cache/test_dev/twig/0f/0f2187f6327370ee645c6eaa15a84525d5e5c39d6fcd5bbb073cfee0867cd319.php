<?php

/* @App/Others/Default/termsConditions/terms_conditions_layout.html.twig */
class __TwigTemplate_96c3aa7fda54a44702a88719b3d95ae4a06236c8d160550c2dbb703eac80213a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_db6b8ad83b28422b85116085f3fc6b4d986817e129917fa9e78fd7a7fb7f017e = $this->env->getExtension("native_profiler");
        $__internal_db6b8ad83b28422b85116085f3fc6b4d986817e129917fa9e78fd7a7fb7f017e->enter($__internal_db6b8ad83b28422b85116085f3fc6b4d986817e129917fa9e78fd7a7fb7f017e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_db6b8ad83b28422b85116085f3fc6b4d986817e129917fa9e78fd7a7fb7f017e->leave($__internal_db6b8ad83b28422b85116085f3fc6b4d986817e129917fa9e78fd7a7fb7f017e_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_31e8619ce439606dd3d6e567cf80c86e2c84b1ed1c45fc0f47dfb958a3aca93c = $this->env->getExtension("native_profiler");
        $__internal_31e8619ce439606dd3d6e567cf80c86e2c84b1ed1c45fc0f47dfb958a3aca93c->enter($__internal_31e8619ce439606dd3d6e567cf80c86e2c84b1ed1c45fc0f47dfb958a3aca93c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_31e8619ce439606dd3d6e567cf80c86e2c84b1ed1c45fc0f47dfb958a3aca93c->leave($__internal_31e8619ce439606dd3d6e567cf80c86e2c84b1ed1c45fc0f47dfb958a3aca93c_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_2509f77cba49250ee87e7ec055828ea283b05a341b86033eb355c1de21f729e5 = $this->env->getExtension("native_profiler");
        $__internal_2509f77cba49250ee87e7ec055828ea283b05a341b86033eb355c1de21f729e5->enter($__internal_2509f77cba49250ee87e7ec055828ea283b05a341b86033eb355c1de21f729e5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <style>
        body{
            font-size: 1.6em;
        }
        h1{
            margin: 40px 0;
        }
        h3{
            margin: 30px 0 30px;
        }
    </style>
    <div class=\"container voffset3\">
        ";
        // line 16
        $this->displayBlock('page', $context, $blocks);
        // line 17
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_2509f77cba49250ee87e7ec055828ea283b05a341b86033eb355c1de21f729e5->leave($__internal_2509f77cba49250ee87e7ec055828ea283b05a341b86033eb355c1de21f729e5_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_d744e24e57ee8d50d9e9a41efd0372a1d6b918ae3fa7a99b5a6362f700984916 = $this->env->getExtension("native_profiler");
        $__internal_d744e24e57ee8d50d9e9a41efd0372a1d6b918ae3fa7a99b5a6362f700984916->enter($__internal_d744e24e57ee8d50d9e9a41efd0372a1d6b918ae3fa7a99b5a6362f700984916_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_d744e24e57ee8d50d9e9a41efd0372a1d6b918ae3fa7a99b5a6362f700984916->leave($__internal_d744e24e57ee8d50d9e9a41efd0372a1d6b918ae3fa7a99b5a6362f700984916_prof);

    }

    public function getTemplateName()
    {
        return "@App/Others/Default/termsConditions/terms_conditions_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 16,  69 => 17,  67 => 16,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block title %}{% endblock %}*/
/* {% block page_container %}*/
/*     <style>*/
/*         body{*/
/*             font-size: 1.6em;*/
/*         }*/
/*         h1{*/
/*             margin: 40px 0;*/
/*         }*/
/*         h3{*/
/*             margin: 30px 0 30px;*/
/*         }*/
/*     </style>*/
/*     <div class="container voffset3">*/
/*         {% block page '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
