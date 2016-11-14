<?php

/* SonataMediaBundle:Extra:pixlr_editor.html.twig */
class __TwigTemplate_b6043c10748cc21bba27c4405bb07f905d2313ea98b8c0de4ed9fa144821cc06 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle::empty_layout.html.twig", "SonataMediaBundle:Extra:pixlr_editor.html.twig", 12);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::empty_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c3f11cd51315713397a6b93bacb39d256fc4bac0a90a5d8f6f3877249da862b4 = $this->env->getExtension("native_profiler");
        $__internal_c3f11cd51315713397a6b93bacb39d256fc4bac0a90a5d8f6f3877249da862b4->enter($__internal_c3f11cd51315713397a6b93bacb39d256fc4bac0a90a5d8f6f3877249da862b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Extra:pixlr_editor.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c3f11cd51315713397a6b93bacb39d256fc4bac0a90a5d8f6f3877249da862b4->leave($__internal_c3f11cd51315713397a6b93bacb39d256fc4bac0a90a5d8f6f3877249da862b4_prof);

    }

    // line 15
    public function block_title($context, array $blocks = array())
    {
        $__internal_138dc5c0d95b986ec6763e4831eeafd174b002cec853055bfa53e90d654816fb = $this->env->getExtension("native_profiler");
        $__internal_138dc5c0d95b986ec6763e4831eeafd174b002cec853055bfa53e90d654816fb->enter($__internal_138dc5c0d95b986ec6763e4831eeafd174b002cec853055bfa53e90d654816fb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Pixlr Editor";
        
        $__internal_138dc5c0d95b986ec6763e4831eeafd174b002cec853055bfa53e90d654816fb->leave($__internal_138dc5c0d95b986ec6763e4831eeafd174b002cec853055bfa53e90d654816fb_prof);

    }

    // line 17
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_34dea2ef99504e442c04648c39c8d088bf0107638958ba10f5046cf24125e7ab = $this->env->getExtension("native_profiler");
        $__internal_34dea2ef99504e442c04648c39c8d088bf0107638958ba10f5046cf24125e7ab->enter($__internal_34dea2ef99504e442c04648c39c8d088bf0107638958ba10f5046cf24125e7ab_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 18
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>
        .header {
            text-align: center;
            background: none repeat scroll 0 0 #222222;
            border-bottom: 5px solid #B6B6B6;
            padding: 15px 0;
        }

        a.pixlr-box {
            text-align: center;
            width: 230px;
            float: left;
            margin: 30px;
            margin-left: 35px;
            margin-right: 35px;

            padding: 30px;
            text-decoration: none;

            color: #B6B6B6;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            border:9px solid #B6B6B6;
            background-color:#222222;
        }

        a.pixlr-box:hover {
            color: #222222;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            border:9px solid #222222;
            background-color:#B6B6B6;
            text-decoration: none;
        }

        .centered {
            float: none;
            margin: 0 auto;
        }
    </style>
";
        
        $__internal_34dea2ef99504e442c04648c39c8d088bf0107638958ba10f5046cf24125e7ab->leave($__internal_34dea2ef99504e442c04648c39c8d088bf0107638958ba10f5046cf24125e7ab_prof);

    }

    // line 64
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        $__internal_5aaa6632cf1360a8f83b2edf014e3df34c93e92fc756615cb08ca0845962f1d4 = $this->env->getExtension("native_profiler");
        $__internal_5aaa6632cf1360a8f83b2edf014e3df34c93e92fc756615cb08ca0845962f1d4->enter($__internal_5aaa6632cf1360a8f83b2edf014e3df34c93e92fc756615cb08ca0845962f1d4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_wrapper"));

        // line 65
        echo "    <section class=\"content\">
        <div class=\"row header\">
           <div class=\"col-sm-12\">
               <img src=\"";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/sonatamedia/extra/pixlr/pixlr.png"), "html", null, true);
        echo "\" alt=\"Pixlr\"/>
           </div>
       </div>

        <div class=\"row\">
            <div class=\"col-sm-6 centered\">
                <div class=\"row\">
                    <div class=\"col-sm-6\">
                        <a href=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_pixlr_edit", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media"))), "mode" => "express")), "html", null, true);
        echo "\" class=\"pixlr-box\">
                            <img src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/sonatamedia/extra/pixlr/express_128.png"), "html", null, true);
        echo "\" alt=\"Pixlr Express\"/>
                            ";
        // line 78
        echo $this->env->getExtension('translator')->trans("label.pixlr_express_editor", array(), "SonataMediaBundle");
        echo "
                        </a>
                    </div>
                    <div class=\"col-sm-6\">
                        <a href=\"";
        // line 82
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("sonata_media_pixlr_edit", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["media"]) ? $context["media"] : $this->getContext($context, "media"))), "mode" => "editor")), "html", null, true);
        echo "\" class=\"pixlr-box\">
                            <img src=\"";
        // line 83
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/sonatamedia/extra/pixlr/editor_128.png"), "html", null, true);
        echo "\" alt=\"Pixlr Editor\"/>
                            ";
        // line 84
        echo $this->env->getExtension('translator')->trans("label.pixlr_advanced_editor", array(), "SonataMediaBundle");
        echo "
                        </a>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-sm-12 centered\">
                        <div class=\"alert alert-warning\">
                            ";
        // line 91
        echo $this->env->getExtension('translator')->trans("label.pixlr_warning", array(), "SonataMediaBundle");
        echo "
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
";
        
        $__internal_5aaa6632cf1360a8f83b2edf014e3df34c93e92fc756615cb08ca0845962f1d4->leave($__internal_5aaa6632cf1360a8f83b2edf014e3df34c93e92fc756615cb08ca0845962f1d4_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Extra:pixlr_editor.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 91,  151 => 84,  147 => 83,  143 => 82,  136 => 78,  132 => 77,  128 => 76,  117 => 68,  112 => 65,  106 => 64,  54 => 18,  48 => 17,  36 => 15,  11 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends "SonataAdminBundle::empty_layout.html.twig" %}*/
/* */
/* */
/* {% block title %}Pixlr Editor{% endblock title %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/*     <style>*/
/*         .header {*/
/*             text-align: center;*/
/*             background: none repeat scroll 0 0 #222222;*/
/*             border-bottom: 5px solid #B6B6B6;*/
/*             padding: 15px 0;*/
/*         }*/
/* */
/*         a.pixlr-box {*/
/*             text-align: center;*/
/*             width: 230px;*/
/*             float: left;*/
/*             margin: 30px;*/
/*             margin-left: 35px;*/
/*             margin-right: 35px;*/
/* */
/*             padding: 30px;*/
/*             text-decoration: none;*/
/* */
/*             color: #B6B6B6;*/
/*             -webkit-border-radius: 20px;*/
/*             -moz-border-radius: 20px;*/
/*             border-radius: 20px;*/
/*             border:9px solid #B6B6B6;*/
/*             background-color:#222222;*/
/*         }*/
/* */
/*         a.pixlr-box:hover {*/
/*             color: #222222;*/
/*             -webkit-border-radius: 20px;*/
/*             -moz-border-radius: 20px;*/
/*             border-radius: 20px;*/
/*             border:9px solid #222222;*/
/*             background-color:#B6B6B6;*/
/*             text-decoration: none;*/
/*         }*/
/* */
/*         .centered {*/
/*             float: none;*/
/*             margin: 0 auto;*/
/*         }*/
/*     </style>*/
/* {% endblock stylesheets %}*/
/* */
/* */
/* {% block sonata_wrapper %}*/
/*     <section class="content">*/
/*         <div class="row header">*/
/*            <div class="col-sm-12">*/
/*                <img src="{{ asset('bundles/sonatamedia/extra/pixlr/pixlr.png')}}" alt="Pixlr"/>*/
/*            </div>*/
/*        </div>*/
/* */
/*         <div class="row">*/
/*             <div class="col-sm-6 centered">*/
/*                 <div class="row">*/
/*                     <div class="col-sm-6">*/
/*                         <a href="{{ url('sonata_media_pixlr_edit', {'id': media|sonata_urlsafeid , 'mode': 'express'}) }}" class="pixlr-box">*/
/*                             <img src="{{ asset('bundles/sonatamedia/extra/pixlr/express_128.png')}}" alt="Pixlr Express"/>*/
/*                             {{ "label.pixlr_express_editor"|trans({}, "SonataMediaBundle")|raw }}*/
/*                         </a>*/
/*                     </div>*/
/*                     <div class="col-sm-6">*/
/*                         <a href="{{ url('sonata_media_pixlr_edit', {'id': media|sonata_urlsafeid , 'mode': 'editor'}) }}" class="pixlr-box">*/
/*                             <img src="{{ asset('bundles/sonatamedia/extra/pixlr/editor_128.png')}}" alt="Pixlr Editor"/>*/
/*                             {{ "label.pixlr_advanced_editor"|trans({}, "SonataMediaBundle")|raw }}*/
/*                         </a>*/
/*                     </div>*/
/*                 </div>*/
/*                 <div class="row">*/
/*                     <div class="col-sm-12 centered">*/
/*                         <div class="alert alert-warning">*/
/*                             {{ "label.pixlr_warning"|trans({}, "SonataMediaBundle")|raw }}*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </section>*/
/* {% endblock %}*/
/* */
