<?php

/* AppBundle:AppShop/Shop/external_stores:facebook_static.html.twig */
class __TwigTemplate_be36666951bade571756ff9da9f88e5dd29382b2ed00b7824ea7e0b9645e9afc extends Twig_Template
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
        $__internal_de95fb30cbe22597588e0cddfce86dc9e1b7f32e95ed5ab4feadde65fcfb2fe4 = $this->env->getExtension("native_profiler");
        $__internal_de95fb30cbe22597588e0cddfce86dc9e1b7f32e95ed5ab4feadde65fcfb2fe4->enter($__internal_de95fb30cbe22597588e0cddfce86dc9e1b7f32e95ed5ab4feadde65fcfb2fe4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/external_stores:facebook_static.html.twig"));

        // line 1
        echo "

";
        // line 3
        if ((isset($context["loadedByJs"]) ? $context["loadedByJs"] : $this->getContext($context, "loadedByJs"))) {
            // line 4
            echo "
    ";
            // line 5
            echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://code.jquery.com/jquery-1.11.0.min.js");
            echo "
    ";
            // line 6
            echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://connect.facebook.net/en_US/sdk.js");
            echo "
    ";
            // line 7
            echo $this->env->getExtension('app_inject_external_content')->injectExternalContentFilter("https://www.parsecdn.com/js/parse-1.2.18.min.js");
            echo "

";
        } else {
            // line 10
            echo "
    loadScript('https://connect.facebook.net/en_US/sdk.js');
    loadScript('https://www.parsecdn.com/js/parse-1.2.18.min.js');

";
        }
        // line 15
        echo "
propertiesDefault.facebook = { app_id: '";
        // line 16
        echo twig_escape_filter($this->env, (isset($context["facebook_app_id"]) ? $context["facebook_app_id"] : $this->getContext($context, "facebook_app_id")), "html", null, true);
        echo "' };


";
        
        $__internal_de95fb30cbe22597588e0cddfce86dc9e1b7f32e95ed5ab4feadde65fcfb2fe4->leave($__internal_de95fb30cbe22597588e0cddfce86dc9e1b7f32e95ed5ab4feadde65fcfb2fe4_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/external_stores:facebook_static.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 16,  52 => 15,  45 => 10,  39 => 7,  35 => 6,  31 => 5,  28 => 4,  26 => 3,  22 => 1,);
    }
}
/* */
/* */
/* {% if loadedByJs %}*/
/* */
/*     {{ 'https://code.jquery.com/jquery-1.11.0.min.js' | injectExternalContent | raw }}*/
/*     {{ 'https://connect.facebook.net/en_US/sdk.js' | injectExternalContent | raw }}*/
/*     {{ 'https://www.parsecdn.com/js/parse-1.2.18.min.js' | injectExternalContent | raw }}*/
/* */
/* {% else %}*/
/* */
/*     loadScript('https://connect.facebook.net/en_US/sdk.js');*/
/*     loadScript('https://www.parsecdn.com/js/parse-1.2.18.min.js');*/
/* */
/* {% endif %}*/
/* */
/* propertiesDefault.facebook = { app_id: '{{ facebook_app_id }}' };*/
/* */
/* */
/* */
