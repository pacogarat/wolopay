<?php

/* AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig */
class __TwigTemplate_dc74a61aa142304efcd9190c34b03cffcba9762821c6413fce1b564cddca8400 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("::base_bootstrap.html.twig", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page_container' => array($this, 'block_page_container'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base_bootstrap.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2f2d12ef0d255764a92981c8458f5f9235c16a945fa73928c0244de11725beeb = $this->env->getExtension("native_profiler");
        $__internal_2f2d12ef0d255764a92981c8458f5f9235c16a945fa73928c0244de11725beeb->enter($__internal_2f2d12ef0d255764a92981c8458f5f9235c16a945fa73928c0244de11725beeb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2f2d12ef0d255764a92981c8458f5f9235c16a945fa73928c0244de11725beeb->leave($__internal_2f2d12ef0d255764a92981c8458f5f9235c16a945fa73928c0244de11725beeb_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_358b2741376ac54fe6060682956914444ddd0c8c40b1176a2983e3b38546d8a3 = $this->env->getExtension("native_profiler");
        $__internal_358b2741376ac54fe6060682956914444ddd0c8c40b1176a2983e3b38546d8a3->enter($__internal_358b2741376ac54fe6060682956914444ddd0c8c40b1176a2983e3b38546d8a3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_358b2741376ac54fe6060682956914444ddd0c8c40b1176a2983e3b38546d8a3->leave($__internal_358b2741376ac54fe6060682956914444ddd0c8c40b1176a2983e3b38546d8a3_prof);

    }

    // line 3
    public function block_page_container($context, array $blocks = array())
    {
        $__internal_7e93b115177c15a141ac8f445527b8fe8cb66fb52ab503392480c4da6d90dd39 = $this->env->getExtension("native_profiler");
        $__internal_7e93b115177c15a141ac8f445527b8fe8cb66fb52ab503392480c4da6d90dd39->enter($__internal_7e93b115177c15a141ac8f445527b8fe8cb66fb52ab503392480c4da6d90dd39_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page_container"));

        // line 4
        echo "    <style>
        body{
            font-size: 1.6em;
        }
        h1{
            margin: 40px 0;
        }
        h3{
            margin: 30px 0 30px;
        }
    </style>
    <div class=\"container voffset3\">
        ";
        // line 16
        $this->displayBlock('page', $context, $blocks);
        // line 17
        echo "    </div>
    <div class=\"voffset3\"></div>
";
        
        $__internal_7e93b115177c15a141ac8f445527b8fe8cb66fb52ab503392480c4da6d90dd39->leave($__internal_7e93b115177c15a141ac8f445527b8fe8cb66fb52ab503392480c4da6d90dd39_prof);

    }

    // line 16
    public function block_page($context, array $blocks = array())
    {
        $__internal_4919bf772050939ba2a4e4fc4141b006d89df1dd7b338ef8356ce1ec4d7f6da4 = $this->env->getExtension("native_profiler");
        $__internal_4919bf772050939ba2a4e4fc4141b006d89df1dd7b338ef8356ce1ec4d7f6da4->enter($__internal_4919bf772050939ba2a4e4fc4141b006d89df1dd7b338ef8356ce1ec4d7f6da4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        echo "";
        
        $__internal_4919bf772050939ba2a4e4fc4141b006d89df1dd7b338ef8356ce1ec4d7f6da4->leave($__internal_4919bf772050939ba2a4e4fc4141b006d89df1dd7b338ef8356ce1ec4d7f6da4_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 16,  69 => 17,  67 => 16,  53 => 4,  47 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends "::base_bootstrap.html.twig" %}*/
/* {% block title %}{% endblock %}*/
/* {% block page_container %}*/
/*     <style>*/
/*         body{*/
/*             font-size: 1.6em;*/
/*         }*/
/*         h1{*/
/*             margin: 40px 0;*/
/*         }*/
/*         h3{*/
/*             margin: 30px 0 30px;*/
/*         }*/
/*     </style>*/
/*     <div class="container voffset3">*/
/*         {% block page '' %}*/
/*     </div>*/
/*     <div class="voffset3"></div>*/
/* {% endblock %}*/
