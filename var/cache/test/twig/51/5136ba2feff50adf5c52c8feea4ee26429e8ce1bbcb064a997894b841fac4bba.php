<?php

/* AppBundle:AppShop/Shop:finished.html.twig */
class __TwigTemplate_3e2a2f46514245fff7b68f70450e9f9e252a8492838983b8a65d031c383a7bc9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/AppShop/layout_shop.html.twig", "AppBundle:AppShop/Shop:finished.html.twig", 1);
        $this->blocks = array(
            'javascript_end_body_before_exe' => array($this, 'block_javascript_end_body_before_exe'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/AppShop/layout_shop.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_57441038cb24db4de67c1916f4261e02854fed44acc094c30c140f3647a32e89 = $this->env->getExtension("native_profiler");
        $__internal_57441038cb24db4de67c1916f4261e02854fed44acc094c30c140f3647a32e89->enter($__internal_57441038cb24db4de67c1916f4261e02854fed44acc094c30c140f3647a32e89_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop:finished.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_57441038cb24db4de67c1916f4261e02854fed44acc094c30c140f3647a32e89->leave($__internal_57441038cb24db4de67c1916f4261e02854fed44acc094c30c140f3647a32e89_prof);

    }

    // line 3
    public function block_javascript_end_body_before_exe($context, array $blocks = array())
    {
        $__internal_2d92afbe2302995906fbbb2f8e1180c711667b17aaa52a6ee3c96faa8db6ae71 = $this->env->getExtension("native_profiler");
        $__internal_2d92afbe2302995906fbbb2f8e1180c711667b17aaa52a6ee3c96faa8db6ae71->enter($__internal_2d92afbe2302995906fbbb2f8e1180c711667b17aaa52a6ee3c96faa8db6ae71_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_end_body_before_exe"));

        // line 4
        echo "
    <script>
        propertiesDefault.appId= '";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "id", array()), "html", null, true);
        echo "';
    </script>

";
        
        $__internal_2d92afbe2302995906fbbb2f8e1180c711667b17aaa52a6ee3c96faa8db6ae71->leave($__internal_2d92afbe2302995906fbbb2f8e1180c711667b17aaa52a6ee3c96faa8db6ae71_prof);

    }

    // line 11
    public function block_page($context, array $blocks = array())
    {
        $__internal_e52087ad62dff7060819ea0c549b912953486ce54da9305adf2ce1c86b54ad9a = $this->env->getExtension("native_profiler");
        $__internal_e52087ad62dff7060819ea0c549b912953486ce54da9305adf2ce1c86b54ad9a->enter($__internal_e52087ad62dff7060819ea0c549b912953486ce54da9305adf2ce1c86b54ad9a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 12
        echo "
    <div data-ng-controller=\"FinishedCtrl\">
    </div>

";
        
        $__internal_e52087ad62dff7060819ea0c549b912953486ce54da9305adf2ce1c86b54ad9a->leave($__internal_e52087ad62dff7060819ea0c549b912953486ce54da9305adf2ce1c86b54ad9a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop:finished.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 12,  56 => 11,  45 => 6,  41 => 4,  35 => 3,  11 => 1,);
    }
}
/* {% extends '@App/AppShop/layout_shop.html.twig' %}*/
/* */
/* {% block javascript_end_body_before_exe %}*/
/* */
/*     <script>*/
/*         propertiesDefault.appId= '{{ app.user.app.id }}';*/
/*     </script>*/
/* */
/* {% endblock %}*/
/* */
/* {% block page %}*/
/* */
/*     <div data-ng-controller="FinishedCtrl">*/
/*     </div>*/
/* */
/* {% endblock %}*/
