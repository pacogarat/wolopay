<?php

/* SonataMediaBundle:MediaAdmin:select_provider.html.twig */
class __TwigTemplate_7a07ccadbabb2a43bc86e055e3ba2de7a249104791d753e080830adb52949010 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:action.html.twig", "SonataMediaBundle:MediaAdmin:select_provider.html.twig", 12);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:action.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cfabf0ec49a71cd37e9240ac123e1375a948df4e46394df1e890dfdee6d70b7d = $this->env->getExtension("native_profiler");
        $__internal_cfabf0ec49a71cd37e9240ac123e1375a948df4e46394df1e890dfdee6d70b7d->enter($__internal_cfabf0ec49a71cd37e9240ac123e1375a948df4e46394df1e890dfdee6d70b7d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:MediaAdmin:select_provider.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cfabf0ec49a71cd37e9240ac123e1375a948df4e46394df1e890dfdee6d70b7d->leave($__internal_cfabf0ec49a71cd37e9240ac123e1375a948df4e46394df1e890dfdee6d70b7d_prof);

    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        $__internal_69fe64a2ae955a319aab7a859a4b03b9b13a4503ad1718edd0f32776ae9c10a7 = $this->env->getExtension("native_profiler");
        $__internal_69fe64a2ae955a319aab7a859a4b03b9b13a4503ad1718edd0f32776ae9c10a7->enter($__internal_69fe64a2ae955a319aab7a859a4b03b9b13a4503ad1718edd0f32776ae9c10a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_select_provider", array(), "SonataMediaBundle"), "html", null, true);
        
        $__internal_69fe64a2ae955a319aab7a859a4b03b9b13a4503ad1718edd0f32776ae9c10a7->leave($__internal_69fe64a2ae955a319aab7a859a4b03b9b13a4503ad1718edd0f32776ae9c10a7_prof);

    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        $__internal_929efb01b5cf254d4464ae4abe4b2e18d9ba8174658e39aad349e72345766f8d = $this->env->getExtension("native_profiler");
        $__internal_929efb01b5cf254d4464ae4abe4b2e18d9ba8174658e39aad349e72345766f8d->enter($__internal_929efb01b5cf254d4464ae4abe4b2e18d9ba8174658e39aad349e72345766f8d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 17
        echo "    <div class=\"box box-success\">
        <div class=\"box-header\">
            <h3 class=\"box-title\">
                ";
        // line 20
        $this->displayBlock("title", $context, $blocks);
        echo "
            </h3>
        </div>
        <div class=\"box-body\">
            ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["providers"]) ? $context["providers"] : $this->getContext($context, "providers")));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["code"] => $context["provider"]) {
            // line 25
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create", 1 => array("provider" => $this->getAttribute($context["provider"], "name", array()))), "method"), "html", null, true);
            echo "\"
                   class=\"btn btn-app\"
                   data-toggle=\"tooltip\"
                   data-placement=\"top\"
                   title=\"";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "description", array()), array(), (($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array()), "SonataMediaBundle")) : ("SonataMediaBundle"))), "html", null, true);
            echo "\"
                        >
                    ";
            // line 31
            if ( !$this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "image", array())) {
                // line 32
                echo "                        <i class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "option", array(0 => "class"), "method"), "html", null, true);
                echo "\"></i>
                    ";
            } else {
                // line 34
                echo "                        <img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "image", array())), "html", null, true);
                echo "\" style=\"max-height: 20px; max-width: 100px;\"/>
                        <br />
                    ";
            }
            // line 37
            echo "                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array()), "title", array()), array(), (($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($context["provider"], "providerMetadata", array(), "any", false, true), "domain", array()), "SonataMediaBundle")) : ("SonataMediaBundle"))), "html", null, true);
            echo "
                </a>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 40
            echo "                <span class=\"alert alert-info\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_provider_available", array(), "SonataMediaBundle"), "html", null, true);
            echo "</span>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['code'], $context['provider'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 42
        echo "        </div>
    </div>
";
        
        $__internal_929efb01b5cf254d4464ae4abe4b2e18d9ba8174658e39aad349e72345766f8d->leave($__internal_929efb01b5cf254d4464ae4abe4b2e18d9ba8174658e39aad349e72345766f8d_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:select_provider.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 42,  107 => 40,  98 => 37,  91 => 34,  85 => 32,  83 => 31,  78 => 29,  70 => 25,  65 => 24,  58 => 20,  53 => 17,  47 => 16,  35 => 14,  11 => 12,);
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
/* {% extends 'SonataAdminBundle:CRUD:action.html.twig' %}*/
/* */
/* {% block title %}{{ 'title_select_provider'|trans({}, 'SonataMediaBundle') }}{% endblock %}*/
/* */
/* {% block content %}*/
/*     <div class="box box-success">*/
/*         <div class="box-header">*/
/*             <h3 class="box-title">*/
/*                 {{ block('title') }}*/
/*             </h3>*/
/*         </div>*/
/*         <div class="box-body">*/
/*             {% for code, provider in providers %}*/
/*                 <a href="{{ admin.generateUrl('create', {'provider': provider.name}) }}"*/
/*                    class="btn btn-app"*/
/*                    data-toggle="tooltip"*/
/*                    data-placement="top"*/
/*                    title="{{ provider.providerMetadata.description|trans({}, provider.providerMetadata.domain|default('SonataMediaBundle')) }}"*/
/*                         >*/
/*                     {% if not provider.providerMetadata.image %}*/
/*                         <i class="{{ provider.providerMetadata.option('class') }}"></i>*/
/*                     {% else %}*/
/*                         <img src="{{ asset(provider.providerMetadata.image) }}" style="max-height: 20px; max-width: 100px;"/>*/
/*                         <br />*/
/*                     {% endif %}*/
/*                     {{ provider.providerMetadata.title|trans({}, provider.providerMetadata.domain|default('SonataMediaBundle')) }}*/
/*                 </a>*/
/*             {% else %}*/
/*                 <span class="alert alert-info">{{ 'no_provider_available'|trans({}, 'SonataMediaBundle') }}</span>*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
