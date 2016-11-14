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
        $__internal_836be3ea3426529119acfe69e4ed2cf97b042efa5575d91cb880895abb19a234 = $this->env->getExtension("native_profiler");
        $__internal_836be3ea3426529119acfe69e4ed2cf97b042efa5575d91cb880895abb19a234->enter($__internal_836be3ea3426529119acfe69e4ed2cf97b042efa5575d91cb880895abb19a234_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/Legal:legal_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_836be3ea3426529119acfe69e4ed2cf97b042efa5575d91cb880895abb19a234->leave($__internal_836be3ea3426529119acfe69e4ed2cf97b042efa5575d91cb880895abb19a234_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_2d8f5c562076e7f27eeea373a5ff2cbf3bb71f833cce824ed32649bfeca39494 = $this->env->getExtension("native_profiler");
        $__internal_2d8f5c562076e7f27eeea373a5ff2cbf3bb71f833cce824ed32649bfeca39494->enter($__internal_2d8f5c562076e7f27eeea373a5ff2cbf3bb71f833cce824ed32649bfeca39494_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_2d8f5c562076e7f27eeea373a5ff2cbf3bb71f833cce824ed32649bfeca39494->leave($__internal_2d8f5c562076e7f27eeea373a5ff2cbf3bb71f833cce824ed32649bfeca39494_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_43e42e0a377ea8a8235f36e88eef04106b171394beb0f112f547312ec7f00b2a = $this->env->getExtension("native_profiler");
        $__internal_43e42e0a377ea8a8235f36e88eef04106b171394beb0f112f547312ec7f00b2a->enter($__internal_43e42e0a377ea8a8235f36e88eef04106b171394beb0f112f547312ec7f00b2a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <div class=\"container voffset3\">
        ";
        // line 5
        $this->displayBlock('legal_txt', $context, $blocks);
        // line 6
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_43e42e0a377ea8a8235f36e88eef04106b171394beb0f112f547312ec7f00b2a->leave($__internal_43e42e0a377ea8a8235f36e88eef04106b171394beb0f112f547312ec7f00b2a_prof);

    }

    // line 5
    public function block_legal_txt($context, array $blocks = array())
    {
        $__internal_adf0633ba44354e1a4a6e7ce133a3ed209ab055991eca0e4623ecb891a9ff285 = $this->env->getExtension("native_profiler");
        $__internal_adf0633ba44354e1a4a6e7ce133a3ed209ab055991eca0e4623ecb891a9ff285->enter($__internal_adf0633ba44354e1a4a6e7ce133a3ed209ab055991eca0e4623ecb891a9ff285_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "legal_txt"));

        echo "";
        
        $__internal_adf0633ba44354e1a4a6e7ce133a3ed209ab055991eca0e4623ecb891a9ff285->leave($__internal_adf0633ba44354e1a4a6e7ce133a3ed209ab055991eca0e4623ecb891a9ff285_prof);

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
