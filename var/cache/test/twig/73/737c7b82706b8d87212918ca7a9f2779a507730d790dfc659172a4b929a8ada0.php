<?php

/* FOSUserBundle:Security:login.html.twig */
class __TwigTemplate_86dc9b86b32d49e401331f2273e8dc5e0ffd8663546f29a1dd1e4435f051688a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("FOSUserBundle::layout.html.twig", "FOSUserBundle:Security:login.html.twig", 1);
        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "FOSUserBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_673d8022298c151830f2e9c106afaecffc7922322412878ed397f3f88ffae7c7 = $this->env->getExtension("native_profiler");
        $__internal_673d8022298c151830f2e9c106afaecffc7922322412878ed397f3f88ffae7c7->enter($__internal_673d8022298c151830f2e9c106afaecffc7922322412878ed397f3f88ffae7c7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Security:login.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_673d8022298c151830f2e9c106afaecffc7922322412878ed397f3f88ffae7c7->leave($__internal_673d8022298c151830f2e9c106afaecffc7922322412878ed397f3f88ffae7c7_prof);

    }

    // line 5
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_95737d00712256fd0afbd67ecff139f40a0da7af6134958613c50aa5025a127e = $this->env->getExtension("native_profiler");
        $__internal_95737d00712256fd0afbd67ecff139f40a0da7af6134958613c50aa5025a127e->enter($__internal_95737d00712256fd0afbd67ecff139f40a0da7af6134958613c50aa5025a127e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 6
        echo "    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #eee;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }
        .form-signin .checkbox {
            font-weight: normal;
        }
        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }
        .form-signin .form-control:focus {
            z-index: 2;
        }
        .form-signin input[type=\"text\"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type=\"password\"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        form, input{
            text-align: center;
        }

    </style>

    <div class=\"container col-md-4 col-md-offset-4 voffset3\">

        ";
        // line 55
        if ((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error"))) {
            // line 56
            echo "            <div class=\"alert alert-danger text-center\">
                <div>";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageKey", array()), $this->getAttribute((isset($context["error"]) ? $context["error"] : $this->getContext($context, "error")), "messageData", array()), "security"), "html", null, true);
            echo "</div>
            </div>
        ";
        }
        // line 60
        echo "

        <form class=\"form-signin\" action=\"";
        // line 62
        echo $this->env->getExtension('routing')->getPath("fos_user_security_check");
        echo "\" method=\"post\" role=\"form\">
            
            <h2 class=\"form-signin-heading\">";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("layout.login", array(), "FOSUserBundle"), "html", null, true);
        echo "</h2>
            <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : $this->getContext($context, "last_username")), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "\" required autofocus>
            <input type=\"password\" class=\"form-control\" placeholder=\"";
        // line 66
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "\" id=\"password\" name=\"_password\"  required>

            <label class=\"checkbox\" for=\"remember_me\">
                <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\"> ";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "
            </label>
            <button class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "</button>
            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
        // line 72
        echo twig_escape_filter($this->env, (isset($context["csrf_token"]) ? $context["csrf_token"] : $this->getContext($context, "csrf_token")), "html", null, true);
        echo "\" />

            <img src=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("img/logo_200x50.png"), "html", null, true);
        echo "\" style=\"margin-top: 50px\">
        </form>

    </div> <!-- /container -->


";
        
        $__internal_95737d00712256fd0afbd67ecff139f40a0da7af6134958613c50aa5025a127e->leave($__internal_95737d00712256fd0afbd67ecff139f40a0da7af6134958613c50aa5025a127e_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Security:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 74,  136 => 72,  132 => 71,  127 => 69,  121 => 66,  115 => 65,  111 => 64,  106 => 62,  102 => 60,  96 => 57,  93 => 56,  91 => 55,  40 => 6,  34 => 5,  11 => 1,);
    }
}
/* {% extends "FOSUserBundle::layout.html.twig" %}*/
/* */
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* {% block fos_user_content %}*/
/*     <style>*/
/*         body {*/
/*             padding-top: 40px;*/
/*             padding-bottom: 40px;*/
/*             background-color: #eee;*/
/*         }*/
/* */
/*         .form-signin {*/
/*             max-width: 330px;*/
/*             padding: 15px;*/
/*             margin: 0 auto;*/
/*         }*/
/*         .form-signin .form-signin-heading,*/
/*         .form-signin .checkbox {*/
/*             margin-bottom: 10px;*/
/*         }*/
/*         .form-signin .checkbox {*/
/*             font-weight: normal;*/
/*         }*/
/*         .form-signin .form-control {*/
/*             position: relative;*/
/*             height: auto;*/
/*             -webkit-box-sizing: border-box;*/
/*             -moz-box-sizing: border-box;*/
/*             box-sizing: border-box;*/
/*             padding: 10px;*/
/*             font-size: 16px;*/
/*         }*/
/*         .form-signin .form-control:focus {*/
/*             z-index: 2;*/
/*         }*/
/*         .form-signin input[type="text"] {*/
/*             margin-bottom: -1px;*/
/*             border-bottom-right-radius: 0;*/
/*             border-bottom-left-radius: 0;*/
/*         }*/
/*         .form-signin input[type="password"] {*/
/*             margin-bottom: 10px;*/
/*             border-top-left-radius: 0;*/
/*             border-top-right-radius: 0;*/
/*         }*/
/*         form, input{*/
/*             text-align: center;*/
/*         }*/
/* */
/*     </style>*/
/* */
/*     <div class="container col-md-4 col-md-offset-4 voffset3">*/
/* */
/*         {% if error %}*/
/*             <div class="alert alert-danger text-center">*/
/*                 <div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>*/
/*             </div>*/
/*         {% endif %}*/
/* */
/* */
/*         <form class="form-signin" action="{{ path("fos_user_security_check") }}" method="post" role="form">*/
/*             */
/*             <h2 class="form-signin-heading">{{ 'layout.login'|trans({}, 'FOSUserBundle') }}</h2>*/
/*             <input type="text" id="username" name="_username" value="{{ last_username }}" class="form-control" placeholder="{{ 'security.login.username'|trans({},'FOSUserBundle') }}" required autofocus>*/
/*             <input type="password" class="form-control" placeholder="{{ 'security.login.password'|trans({},'FOSUserBundle') }}" id="password" name="_password"  required>*/
/* */
/*             <label class="checkbox" for="remember_me">*/
/*                 <input type="checkbox" id="remember_me" name="_remember_me" value="on"> {{ 'security.login.remember_me'|trans }}*/
/*             </label>*/
/*             <button class="btn btn-lg btn-primary btn-block" type="submit">{{ 'security.login.submit'|trans }}</button>*/
/*             <input type="hidden" name="_csrf_token" value="{{ csrf_token }}" />*/
/* */
/*             <img src="{{ asset("img/logo_200x50.png") }}" style="margin-top: 50px">*/
/*         </form>*/
/* */
/*     </div> <!-- /container -->*/
/* */
/* */
/* {% endblock fos_user_content %}*/
