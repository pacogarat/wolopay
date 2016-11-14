<?php

/* AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig */
class __TwigTemplate_dc74a61aa142304efcd9190c34b03cffcba9762821c6413fce1b564cddca8400 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig", 1);
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
        $__internal_4703db4e3e00fc2b30ec3e66ea6d5dedb424f30f00a5b7a312fd917c0d04223e = $this->env->getExtension("native_profiler");
        $__internal_4703db4e3e00fc2b30ec3e66ea6d5dedb424f30f00a5b7a312fd917c0d04223e->enter($__internal_4703db4e3e00fc2b30ec3e66ea6d5dedb424f30f00a5b7a312fd917c0d04223e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4703db4e3e00fc2b30ec3e66ea6d5dedb424f30f00a5b7a312fd917c0d04223e->leave($__internal_4703db4e3e00fc2b30ec3e66ea6d5dedb424f30f00a5b7a312fd917c0d04223e_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_baa57b6c0fe1c02557119054fad61b2672da320902fde916fd17d7c2e2043199 = $this->env->getExtension("native_profiler");
        $__internal_baa57b6c0fe1c02557119054fad61b2672da320902fde916fd17d7c2e2043199->enter($__internal_baa57b6c0fe1c02557119054fad61b2672da320902fde916fd17d7c2e2043199_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_baa57b6c0fe1c02557119054fad61b2672da320902fde916fd17d7c2e2043199->leave($__internal_baa57b6c0fe1c02557119054fad61b2672da320902fde916fd17d7c2e2043199_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_dfef5544300b69518718567284d52bb88f14503d6fdeabe994bf1104784d762e = $this->env->getExtension("native_profiler");
        $__internal_dfef5544300b69518718567284d52bb88f14503d6fdeabe994bf1104784d762e->enter($__internal_dfef5544300b69518718567284d52bb88f14503d6fdeabe994bf1104784d762e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

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
        
        $__internal_dfef5544300b69518718567284d52bb88f14503d6fdeabe994bf1104784d762e->leave($__internal_dfef5544300b69518718567284d52bb88f14503d6fdeabe994bf1104784d762e_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_57326c4414ff31b72a6634b7999031ba5506d7c2d8d6c7ce8e8843e1b4cd9832 = $this->env->getExtension("native_profiler");
        $__internal_57326c4414ff31b72a6634b7999031ba5506d7c2d8d6c7ce8e8843e1b4cd9832->enter($__internal_57326c4414ff31b72a6634b7999031ba5506d7c2d8d6c7ce8e8843e1b4cd9832_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_57326c4414ff31b72a6634b7999031ba5506d7c2d8d6c7ce8e8843e1b4cd9832->leave($__internal_57326c4414ff31b72a6634b7999031ba5506d7c2d8d6c7ce8e8843e1b4cd9832_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig";
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
