<?php

/* SonataAdminBundle:CRUD:list_array.html.twig */
class __TwigTemplate_10f836c49c77aed0962c447eb270c2176e269a8c94451a7e07fab4c4641ad64c extends Twig_Template
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
        return $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "base_list_field"), "method"), "SonataAdminBundle:CRUD:list_array.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f8d42e7a60f5544834ea545481bf5a3a54848f3ba890d559413146702f564438 = $this->env->getExtension("native_profiler");
        $__internal_f8d42e7a60f5544834ea545481bf5a3a54848f3ba890d559413146702f564438->enter($__internal_f8d42e7a60f5544834ea545481bf5a3a54848f3ba890d559413146702f564438_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:list_array.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f8d42e7a60f5544834ea545481bf5a3a54848f3ba890d559413146702f564438->leave($__internal_f8d42e7a60f5544834ea545481bf5a3a54848f3ba890d559413146702f564438_prof);

    }

    // line 14
    public function block_field($context, array $blocks = array())
    {
        $__internal_509ad32c618f07d17597dfd5458f6b72cc79d2eed8313d9210b326c27f40b661 = $this->env->getExtension("native_profiler");
        $__internal_509ad32c618f07d17597dfd5458f6b72cc79d2eed8313d9210b326c27f40b661->enter($__internal_509ad32c618f07d17597dfd5458f6b72cc79d2eed8313d9210b326c27f40b661_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 15
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")));
        foreach ($context['_seq'] as $context["key"] => $context["val"]) {
            // line 16
            echo "        [";
            echo twig_escape_filter($this->env, $context["key"], "html", null, true);
            echo " => ";
            echo twig_escape_filter($this->env, $context["val"], "html", null, true);
            echo "]
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['val'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_509ad32c618f07d17597dfd5458f6b72cc79d2eed8313d9210b326c27f40b661->leave($__internal_509ad32c618f07d17597dfd5458f6b72cc79d2eed8313d9210b326c27f40b661_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:list_array.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 16,  39 => 15,  33 => 14,  18 => 12,);
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
/*     {% for key, val in value %}*/
/*         [{{ key }} => {{ val }}]*/
/*     {% endfor %}*/
/* {% endblock %}*/
/* */
