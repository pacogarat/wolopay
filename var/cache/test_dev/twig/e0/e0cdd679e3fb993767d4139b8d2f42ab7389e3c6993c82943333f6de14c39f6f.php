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
        $__internal_b9953322dfc807516568df57437e38abe5387f8ab49c19333ee724aef5e70ae5 = $this->env->getExtension("native_profiler");
        $__internal_b9953322dfc807516568df57437e38abe5387f8ab49c19333ee724aef5e70ae5->enter($__internal_b9953322dfc807516568df57437e38abe5387f8ab49c19333ee724aef5e70ae5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@App/Others/Default/FAQ/faq_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_b9953322dfc807516568df57437e38abe5387f8ab49c19333ee724aef5e70ae5->leave($__internal_b9953322dfc807516568df57437e38abe5387f8ab49c19333ee724aef5e70ae5_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_4653a78b128458257e2fe3fa657603a65b1db149224672c842b6136d4c97bb83 = $this->env->getExtension("native_profiler");
        $__internal_4653a78b128458257e2fe3fa657603a65b1db149224672c842b6136d4c97bb83->enter($__internal_4653a78b128458257e2fe3fa657603a65b1db149224672c842b6136d4c97bb83_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_4653a78b128458257e2fe3fa657603a65b1db149224672c842b6136d4c97bb83->leave($__internal_4653a78b128458257e2fe3fa657603a65b1db149224672c842b6136d4c97bb83_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_816846ce553c1e85ca581e49729b646c33f3b183ab43f9ca685d8e5fa40a6348 = $this->env->getExtension("native_profiler");
        $__internal_816846ce553c1e85ca581e49729b646c33f3b183ab43f9ca685d8e5fa40a6348->enter($__internal_816846ce553c1e85ca581e49729b646c33f3b183ab43f9ca685d8e5fa40a6348_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <div class=\"container voffset3\">
        ";
        // line 5
        $this->displayBlock('faq_txt', $context, $blocks);
        // line 6
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_816846ce553c1e85ca581e49729b646c33f3b183ab43f9ca685d8e5fa40a6348->leave($__internal_816846ce553c1e85ca581e49729b646c33f3b183ab43f9ca685d8e5fa40a6348_prof);

    }

    // line 5
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_33a96c8b3e8839adcbb52ab8be637f253a9ef57246f705ed7bb02760b7da201c = $this->env->getExtension("native_profiler");
        $__internal_33a96c8b3e8839adcbb52ab8be637f253a9ef57246f705ed7bb02760b7da201c->enter($__internal_33a96c8b3e8839adcbb52ab8be637f253a9ef57246f705ed7bb02760b7da201c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        echo "";
        
        $__internal_33a96c8b3e8839adcbb52ab8be637f253a9ef57246f705ed7bb02760b7da201c->leave($__internal_33a96c8b3e8839adcbb52ab8be637f253a9ef57246f705ed7bb02760b7da201c_prof);

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
