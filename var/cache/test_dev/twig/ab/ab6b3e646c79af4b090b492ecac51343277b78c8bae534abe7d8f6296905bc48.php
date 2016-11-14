<?php

/* SonataBlockBundle:Block:block_core_action.html.twig */
class __TwigTemplate_9ef91960aa0a271ac8a20735dc022dc9697e2462073625322a2fa99157eb0553 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataBlockBundle:Block:block_core_action.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_6ce1d06473a0927d866641b4191c5704f63ed17c95ea7d718f45be58bad20f4f = $this->env->getExtension("native_profiler");
        $__internal_6ce1d06473a0927d866641b4191c5704f63ed17c95ea7d718f45be58bad20f4f->enter($__internal_6ce1d06473a0927d866641b4191c5704f63ed17c95ea7d718f45be58bad20f4f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataBlockBundle:Block:block_core_action.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6ce1d06473a0927d866641b4191c5704f63ed17c95ea7d718f45be58bad20f4f->leave($__internal_6ce1d06473a0927d866641b4191c5704f63ed17c95ea7d718f45be58bad20f4f_prof);

    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        $__internal_6d4712b5bc988429c7c868f291d1ce143bbc08162ead685b80c6600a1d6da126 = $this->env->getExtension("native_profiler");
        $__internal_6d4712b5bc988429c7c868f291d1ce143bbc08162ead685b80c6600a1d6da126->enter($__internal_6d4712b5bc988429c7c868f291d1ce143bbc08162ead685b80c6600a1d6da126_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 15
        echo "    ";
        echo (isset($context["content"]) ? $context["content"] : $this->getContext($context, "content"));
        echo "
";
        
        $__internal_6d4712b5bc988429c7c868f291d1ce143bbc08162ead685b80c6600a1d6da126->leave($__internal_6d4712b5bc988429c7c868f291d1ce143bbc08162ead685b80c6600a1d6da126_prof);

    }

    public function getTemplateName()
    {
        return "SonataBlockBundle:Block:block_core_action.html.twig";
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
/* {% extends sonata_block.templates.block_base %}*/
/* */
/* {% block block %}*/
/*     {{ content|raw }}*/
/* {% endblock %}*/
/* */
