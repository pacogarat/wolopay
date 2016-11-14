<?php

/* @App/Others/Default/FAQ/faq_layout.html.twig */
class __TwigTemplate_16ba75a721d300068ed33f80ead45dd16bb7538f3439a800f896245ed265e6a0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "@App/Others/Default/FAQ/faq_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'faq_txt' => array($this, 'block_faq_txt'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_8b46e7d6786e32218d1e08f5307fcb1c843fb2f681b39504567f28646d4888da = $this->env->getExtension("native_profiler");
        $__internal_8b46e7d6786e32218d1e08f5307fcb1c843fb2f681b39504567f28646d4888da->enter($__internal_8b46e7d6786e32218d1e08f5307fcb1c843fb2f681b39504567f28646d4888da_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/Others/Default/FAQ/faq_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_8b46e7d6786e32218d1e08f5307fcb1c843fb2f681b39504567f28646d4888da->leave($__internal_8b46e7d6786e32218d1e08f5307fcb1c843fb2f681b39504567f28646d4888da_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_2a1c87e45002acda67b58b27b73936c085a1a1ce8934cfe7aefc1986fc836fd7 = $this->env->getExtension("native_profiler");
        $__internal_2a1c87e45002acda67b58b27b73936c085a1a1ce8934cfe7aefc1986fc836fd7->enter($__internal_2a1c87e45002acda67b58b27b73936c085a1a1ce8934cfe7aefc1986fc836fd7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_2a1c87e45002acda67b58b27b73936c085a1a1ce8934cfe7aefc1986fc836fd7->leave($__internal_2a1c87e45002acda67b58b27b73936c085a1a1ce8934cfe7aefc1986fc836fd7_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_1e20f3c030447f06dbb0a21ce90bfc808271ed8e83c22d93823d07e18e150299 = $this->env->getExtension("native_profiler");
        $__internal_1e20f3c030447f06dbb0a21ce90bfc808271ed8e83c22d93823d07e18e150299->enter($__internal_1e20f3c030447f06dbb0a21ce90bfc808271ed8e83c22d93823d07e18e150299_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <div class=\"container voffset3\">
        ";
        // line 5
        $this->displayBlock('faq_txt', $context, $blocks);
        // line 6
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_1e20f3c030447f06dbb0a21ce90bfc808271ed8e83c22d93823d07e18e150299->leave($__internal_1e20f3c030447f06dbb0a21ce90bfc808271ed8e83c22d93823d07e18e150299_prof);

    }

    // line 5
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_fd1366785dc89c28872b199852d44f7e200953e21661c723fdbd91d636cc4e30 = $this->env->getExtension("native_profiler");
        $__internal_fd1366785dc89c28872b199852d44f7e200953e21661c723fdbd91d636cc4e30->enter($__internal_fd1366785dc89c28872b199852d44f7e200953e21661c723fdbd91d636cc4e30_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        echo "";
        
        $__internal_fd1366785dc89c28872b199852d44f7e200953e21661c723fdbd91d636cc4e30->leave($__internal_fd1366785dc89c28872b199852d44f7e200953e21661c723fdbd91d636cc4e30_prof);

    }

    public function getTemplateName()
    {
        return "@App/Others/Default/FAQ/faq_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 5,  58 => 6,  56 => 5,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block title %}{% endblock %}*/
/* {% block page_container %}*/
/*     <div class="container voffset3">*/
/*         {% block faq_txt '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
