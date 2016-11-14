<?php

/* AppBundle:Others/Default/Legal:legal_layout.html.twig */
class __TwigTemplate_3ce84b79d60c69e7e0b351b8434779c57bbb081709793a0ef039dc26318ca0ab extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "AppBundle:Others/Default/Legal:legal_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'legal_txt' => array($this, 'block_legal_txt'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_964cf00915fedab68d82645acd16a0dc172d488ce785251e3ebfc81eede7d698 = $this->env->getExtension("native_profiler");
        $__internal_964cf00915fedab68d82645acd16a0dc172d488ce785251e3ebfc81eede7d698->enter($__internal_964cf00915fedab68d82645acd16a0dc172d488ce785251e3ebfc81eede7d698_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/Legal:legal_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_964cf00915fedab68d82645acd16a0dc172d488ce785251e3ebfc81eede7d698->leave($__internal_964cf00915fedab68d82645acd16a0dc172d488ce785251e3ebfc81eede7d698_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_0e5512675572924449684ccfc0b157e143bc72442a200fb7c13d02dd4fbfa6d5 = $this->env->getExtension("native_profiler");
        $__internal_0e5512675572924449684ccfc0b157e143bc72442a200fb7c13d02dd4fbfa6d5->enter($__internal_0e5512675572924449684ccfc0b157e143bc72442a200fb7c13d02dd4fbfa6d5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_0e5512675572924449684ccfc0b157e143bc72442a200fb7c13d02dd4fbfa6d5->leave($__internal_0e5512675572924449684ccfc0b157e143bc72442a200fb7c13d02dd4fbfa6d5_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_289b8fd6cf77529fa7b4165a33b9704ac18a43b4a29f46ac4a1483d754788626 = $this->env->getExtension("native_profiler");
        $__internal_289b8fd6cf77529fa7b4165a33b9704ac18a43b4a29f46ac4a1483d754788626->enter($__internal_289b8fd6cf77529fa7b4165a33b9704ac18a43b4a29f46ac4a1483d754788626_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <div class=\"container voffset3\">
        ";
        // line 5
        $this->displayBlock('legal_txt', $context, $blocks);
        // line 6
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_289b8fd6cf77529fa7b4165a33b9704ac18a43b4a29f46ac4a1483d754788626->leave($__internal_289b8fd6cf77529fa7b4165a33b9704ac18a43b4a29f46ac4a1483d754788626_prof);

    }

    // line 5
    public function block_legal_txt($context, array $blocks = array())
    {
        $__internal_7f2d15f461d5f1a82370de82c4f8cafc14607f340ad61009f9451f4a2be7b862 = $this->env->getExtension("native_profiler");
        $__internal_7f2d15f461d5f1a82370de82c4f8cafc14607f340ad61009f9451f4a2be7b862->enter($__internal_7f2d15f461d5f1a82370de82c4f8cafc14607f340ad61009f9451f4a2be7b862_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "legal_txt"));

        echo "";
        
        $__internal_7f2d15f461d5f1a82370de82c4f8cafc14607f340ad61009f9451f4a2be7b862->leave($__internal_7f2d15f461d5f1a82370de82c4f8cafc14607f340ad61009f9451f4a2be7b862_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/Legal:legal_layout.html.twig";
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
/*         {% block legal_txt '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
