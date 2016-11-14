<?php

/* FOSUserBundle:Resetting:reset_content.html.twig */
class __TwigTemplate_0781a59a47c35d018d7504b7bcc1a47eaa50b2cd63ad2a1e5c6a689147d85305 extends Twig_Template
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
        $__internal_f568da070c27daa46291ee711b5d35258cc98cfde4677e941b1e73187b50e386 = $this->env->getExtension("native_profiler");
        $__internal_f568da070c27daa46291ee711b5d35258cc98cfde4677e941b1e73187b50e386->enter($__internal_f568da070c27daa46291ee711b5d35258cc98cfde4677e941b1e73187b50e386_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Resetting:reset_content.html.twig"));

        // line 2
        echo "
<form action=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("fos_user_resetting_reset", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))), "html", null, true);
        echo "\" ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'enctype');
        echo " method=\"POST\" class=\"fos_user_resetting_reset\">
    ";
        // line 4
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
    <div>
        <input type=\"submit\" value=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("resetting.reset.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" />
    </div>
</form>
";
        
        $__internal_f568da070c27daa46291ee711b5d35258cc98cfde4677e941b1e73187b50e386->leave($__internal_f568da070c27daa46291ee711b5d35258cc98cfde4677e941b1e73187b50e386_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Resetting:reset_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 6,  31 => 4,  25 => 3,  22 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* <form action="{{ path('fos_user_resetting_reset', {'token': token}) }}" {{ form_enctype(form) }} method="POST" class="fos_user_resetting_reset">*/
/*     {{ form_widget(form) }}*/
/*     <div>*/
/*         <input type="submit" value="{{ 'resetting.reset.submit'|trans }}" />*/
/*     </div>*/
/* </form>*/
/* */
