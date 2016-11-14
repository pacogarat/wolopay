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
        $__internal_d299f799f93d6d36b04c07256bc18b6b83eb8783d6d54a2c6158e7944bf0d3e6 = $this->env->getExtension("native_profiler");
        $__internal_d299f799f93d6d36b04c07256bc18b6b83eb8783d6d54a2c6158e7944bf0d3e6->enter($__internal_d299f799f93d6d36b04c07256bc18b6b83eb8783d6d54a2c6158e7944bf0d3e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop:finished.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d299f799f93d6d36b04c07256bc18b6b83eb8783d6d54a2c6158e7944bf0d3e6->leave($__internal_d299f799f93d6d36b04c07256bc18b6b83eb8783d6d54a2c6158e7944bf0d3e6_prof);

    }

    // line 3
    public function block_javascript_end_body_before_exe($context, array $blocks = array())
    {
        $__internal_2c40a7a85b93ded79dd93ae1b9b009c1559dc75a96bd5a72d929c92eb4f700d3 = $this->env->getExtension("native_profiler");
        $__internal_2c40a7a85b93ded79dd93ae1b9b009c1559dc75a96bd5a72d929c92eb4f700d3->enter($__internal_2c40a7a85b93ded79dd93ae1b9b009c1559dc75a96bd5a72d929c92eb4f700d3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_end_body_before_exe"));

        // line 4
        echo "
    <script>
        propertiesDefault.appId= '";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "user", array()), "app", array()), "id", array()), "html", null, true);
        echo "';
    </script>

";
        
        $__internal_2c40a7a85b93ded79dd93ae1b9b009c1559dc75a96bd5a72d929c92eb4f700d3->leave($__internal_2c40a7a85b93ded79dd93ae1b9b009c1559dc75a96bd5a72d929c92eb4f700d3_prof);

    }

    // line 11
    public function block_page($context, array $blocks = array())
    {
        $__internal_fa8a60c286c0d8dd8b5a023dc5fba324fa63d3f9ebc66e56e58b661a70839b3c = $this->env->getExtension("native_profiler");
        $__internal_fa8a60c286c0d8dd8b5a023dc5fba324fa63d3f9ebc66e56e58b661a70839b3c->enter($__internal_fa8a60c286c0d8dd8b5a023dc5fba324fa63d3f9ebc66e56e58b661a70839b3c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 12
        echo "
    <div data-ng-controller=\"FinishedCtrl\">
    </div>

";
        
        $__internal_fa8a60c286c0d8dd8b5a023dc5fba324fa63d3f9ebc66e56e58b661a70839b3c->leave($__internal_fa8a60c286c0d8dd8b5a023dc5fba324fa63d3f9ebc66e56e58b661a70839b3c_prof);

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
