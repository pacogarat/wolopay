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
        $__internal_41c5a47ac47b303d3ccbb76f98338f2afeae9add66b045a8ede482f1024536a8 = $this->env->getExtension("native_profiler");
        $__internal_41c5a47ac47b303d3ccbb76f98338f2afeae9add66b045a8ede482f1024536a8->enter($__internal_41c5a47ac47b303d3ccbb76f98338f2afeae9add66b045a8ede482f1024536a8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list__batch.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_41c5a47ac47b303d3ccbb76f98338f2afeae9add66b045a8ede482f1024536a8->leave($__internal_41c5a47ac47b303d3ccbb76f98338f2afeae9add66b045a8ede482f1024536a8_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_f3df03bf3de25a11839a897faad8bcdf2a3d042939400bc0634a03bf7a4a6774 = $this->env->getExtension("native_profiler");
        $__internal_f3df03bf3de25a11839a897faad8bcdf2a3d042939400bc0634a03bf7a4a6774->enter($__internal_f3df03bf3de25a11839a897faad8bcdf2a3d042939400bc0634a03bf7a4a6774_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    <input type=\"checkbox\" name=\"idx[]\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "id", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "html", null, true);
        echo "\">
";
        
        $__internal_f3df03bf3de25a11839a897faad8bcdf2a3d042939400bc0634a03bf7a4a6774->leave($__internal_f3df03bf3de25a11839a897faad8bcdf2a3d042939400bc0634a03bf7a4a6774_prof);

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
