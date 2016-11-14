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
        $__internal_cf84205e2b2ce4c766d51a70b8da424f8a4ac82116d2bc519fb5cb92903e5983 = $this->env->getExtension("native_profiler");
        $__internal_cf84205e2b2ce4c766d51a70b8da424f8a4ac82116d2bc519fb5cb92903e5983->enter($__internal_cf84205e2b2ce4c766d51a70b8da424f8a4ac82116d2bc519fb5cb92903e5983_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::base.html.twig"));

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
        
        $__internal_cf84205e2b2ce4c766d51a70b8da424f8a4ac82116d2bc519fb5cb92903e5983->leave($__internal_cf84205e2b2ce4c766d51a70b8da424f8a4ac82116d2bc519fb5cb92903e5983_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_eaccd9650f8f208695d414394c46db87e6376b0bddbfb309bac61d744176a9c0 = $this->env->getExtension("native_profiler");
        $__internal_eaccd9650f8f208695d414394c46db87e6376b0bddbfb309bac61d744176a9c0->enter($__internal_eaccd9650f8f208695d414394c46db87e6376b0bddbfb309bac61d744176a9c0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Wolopay!";
        
        $__internal_eaccd9650f8f208695d414394c46db87e6376b0bddbfb309bac61d744176a9c0->leave($__internal_eaccd9650f8f208695d414394c46db87e6376b0bddbfb309bac61d744176a9c0_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_a45b0d9022f5a098a468c4f8c52d2eece0dacd271b1bb2e656f8192e1044b3a1 = $this->env->getExtension("native_profiler");
        $__internal_a45b0d9022f5a098a468c4f8c52d2eece0dacd271b1bb2e656f8192e1044b3a1->enter($__internal_a45b0d9022f5a098a468c4f8c52d2eece0dacd271b1bb2e656f8192e1044b3a1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_a45b0d9022f5a098a468c4f8c52d2eece0dacd271b1bb2e656f8192e1044b3a1->leave($__internal_a45b0d9022f5a098a468c4f8c52d2eece0dacd271b1bb2e656f8192e1044b3a1_prof);

    }

    // line 12
    public function block_body($context, array $blocks = array())
    {
        $__internal_e2e492b89732900d63af094ab3e897090ee1f7a2205b0f34cdb4b74ba7577e5f = $this->env->getExtension("native_profiler");
        $__internal_e2e492b89732900d63af094ab3e897090ee1f7a2205b0f34cdb4b74ba7577e5f->enter($__internal_e2e492b89732900d63af094ab3e897090ee1f7a2205b0f34cdb4b74ba7577e5f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_e2e492b89732900d63af094ab3e897090ee1f7a2205b0f34cdb4b74ba7577e5f->leave($__internal_e2e492b89732900d63af094ab3e897090ee1f7a2205b0f34cdb4b74ba7577e5f_prof);

    }

    // line 13
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_a64a6129cad8de042186b8938234f1ddaff820ceaaca08598c1a4c9d55da4bee = $this->env->getExtension("native_profiler");
        $__internal_a64a6129cad8de042186b8938234f1ddaff820ceaaca08598c1a4c9d55da4bee->enter($__internal_a64a6129cad8de042186b8938234f1ddaff820ceaaca08598c1a4c9d55da4bee_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_a64a6129cad8de042186b8938234f1ddaff820ceaaca08598c1a4c9d55da4bee->leave($__internal_a64a6129cad8de042186b8938234f1ddaff820ceaaca08598c1a4c9d55da4bee_prof);

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
