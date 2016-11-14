<?php

/* AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig */
class __TwigTemplate_3b50c2810fc35943381751430b1ef929c19c3f9cb9acbb5758f541f6ba9f31ab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig", 1);
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
        $__internal_9a7aea6664c28fd8751e9a3c43325fd7703d9c83ef6879a62b5dc51903c1577d = $this->env->getExtension("native_profiler");
        $__internal_9a7aea6664c28fd8751e9a3c43325fd7703d9c83ef6879a62b5dc51903c1577d->enter($__internal_9a7aea6664c28fd8751e9a3c43325fd7703d9c83ef6879a62b5dc51903c1577d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9a7aea6664c28fd8751e9a3c43325fd7703d9c83ef6879a62b5dc51903c1577d->leave($__internal_9a7aea6664c28fd8751e9a3c43325fd7703d9c83ef6879a62b5dc51903c1577d_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_e53f3be1f5f044a54ab3aaa2e09f45bdb57292f487bc277661617aaf3d5f242c = $this->env->getExtension("native_profiler");
        $__internal_e53f3be1f5f044a54ab3aaa2e09f45bdb57292f487bc277661617aaf3d5f242c->enter($__internal_e53f3be1f5f044a54ab3aaa2e09f45bdb57292f487bc277661617aaf3d5f242c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_e53f3be1f5f044a54ab3aaa2e09f45bdb57292f487bc277661617aaf3d5f242c->leave($__internal_e53f3be1f5f044a54ab3aaa2e09f45bdb57292f487bc277661617aaf3d5f242c_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_2ab1238b610d11e6ea8bd5d3bf860488cab960e50a43698570781aa57c3a2f8f = $this->env->getExtension("native_profiler");
        $__internal_2ab1238b610d11e6ea8bd5d3bf860488cab960e50a43698570781aa57c3a2f8f->enter($__internal_2ab1238b610d11e6ea8bd5d3bf860488cab960e50a43698570781aa57c3a2f8f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <style>
        body{
            font-size: 1.6em;
        }
        h1{
            margin: 40px 0;
        }

    </style>
    <div class=\"container voffset3\">
        ";
        // line 14
        $this->displayBlock('page', $context, $blocks);
        // line 15
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_2ab1238b610d11e6ea8bd5d3bf860488cab960e50a43698570781aa57c3a2f8f->leave($__internal_2ab1238b610d11e6ea8bd5d3bf860488cab960e50a43698570781aa57c3a2f8f_prof);

    }

    // line 14
    public function block_page($context, array $blocks = array())
    {
        $__internal_727ee44fbe21354ece7f2d8dc29264add342d2ed00ceca02810aa7ba00f49734 = $this->env->getExtension("native_profiler");
        $__internal_727ee44fbe21354ece7f2d8dc29264add342d2ed00ceca02810aa7ba00f49734->enter($__internal_727ee44fbe21354ece7f2d8dc29264add342d2ed00ceca02810aa7ba00f49734_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_727ee44fbe21354ece7f2d8dc29264add342d2ed00ceca02810aa7ba00f49734->leave($__internal_727ee44fbe21354ece7f2d8dc29264add342d2ed00ceca02810aa7ba00f49734_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 14,  67 => 15,  65 => 14,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
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
/* */
/*     </style>*/
/*     <div class="container voffset3">*/
/*         {% block page '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
