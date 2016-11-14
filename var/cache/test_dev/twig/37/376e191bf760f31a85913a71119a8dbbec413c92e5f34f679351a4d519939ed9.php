<?php

/* SonataAdminBundle:CRUD:list__batch.html.twig */
class __TwigTemplate_27e1a5f6b22898c4569eeb2fc3d9deaca8853731f50ca6be3cdcdca2adf3920b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list__batch.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9fded9434d8ce9b46e0573e5146a386364f8c56dc15544fd02a490b8cbad6561 = $this->env->getExtension("native_profiler");
        $__internal_9fded9434d8ce9b46e0573e5146a386364f8c56dc15544fd02a490b8cbad6561->enter($__internal_9fded9434d8ce9b46e0573e5146a386364f8c56dc15544fd02a490b8cbad6561_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list__batch.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9fded9434d8ce9b46e0573e5146a386364f8c56dc15544fd02a490b8cbad6561->leave($__internal_9fded9434d8ce9b46e0573e5146a386364f8c56dc15544fd02a490b8cbad6561_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_36b3342c8198b1e4939eaba02137c09338999b968369ccf8296a7baec637a402 = $this->env->getExtension("native_profiler");
        $__internal_36b3342c8198b1e4939eaba02137c09338999b968369ccf8296a7baec637a402->enter($__internal_36b3342c8198b1e4939eaba02137c09338999b968369ccf8296a7baec637a402_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <input type=\"checkbox\" name=\"idx[]\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\">
";
        
        $__internal_36b3342c8198b1e4939eaba02137c09338999b968369ccf8296a7baec637a402->leave($__internal_36b3342c8198b1e4939eaba02137c09338999b968369ccf8296a7baec637a402_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list__batch.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 15,  33 => 14,  18 => 12,);
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
/* {% extends admin.getTemplate('base_list_field') %}*/
/* */
/* {% block field %}*/
/*     <input type="checkbox" name="idx[]" value="{{ admin.id(object) }}">*/
/* {% endblock %}*/
/* */
