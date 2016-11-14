<?php

/* AppBundle:Others/Demo:index.html.twig */
class __TwigTemplate_4f1190d4a411eee29b0954a18d017c1200ec62fc7bb69ee1cf005fc568a1693f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/AppShop/layout_secondary.html.twig", "AppBundle:Others/Demo:index.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/AppShop/layout_secondary.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_2803c4f96e2fcade3b70193af4074598a29a813400b8bfa0f229c2842a9d9d6c = $this->env->getExtension("native_profiler");
        $__internal_2803c4f96e2fcade3b70193af4074598a29a813400b8bfa0f229c2842a9d9d6c->enter($__internal_2803c4f96e2fcade3b70193af4074598a29a813400b8bfa0f229c2842a9d9d6c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Demo:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2803c4f96e2fcade3b70193af4074598a29a813400b8bfa0f229c2842a9d9d6c->leave($__internal_2803c4f96e2fcade3b70193af4074598a29a813400b8bfa0f229c2842a9d9d6c_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_a06645c9dc6c195ef6775e84ee439bf57c19b18f12fa640f65d0105c375a5825 = $this->env->getExtension("native_profiler");
        $__internal_a06645c9dc6c195ef6775e84ee439bf57c19b18f12fa640f65d0105c375a5825->enter($__internal_a06645c9dc6c195ef6775e84ee439bf57c19b18f12fa640f65d0105c375a5825_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Demo";
        
        $__internal_a06645c9dc6c195ef6775e84ee439bf57c19b18f12fa640f65d0105c375a5825->leave($__internal_a06645c9dc6c195ef6775e84ee439bf57c19b18f12fa640f65d0105c375a5825_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_e24332163fe5ad0a328db7abd3b344aaf4853105fbfb25598e0f4ff865ff4ffd = $this->env->getExtension("native_profiler");
        $__internal_e24332163fe5ad0a328db7abd3b344aaf4853105fbfb25598e0f4ff865ff4ffd->enter($__internal_e24332163fe5ad0a328db7abd3b344aaf4853105fbfb25598e0f4ff865ff4ffd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 5
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>
        .form-group{
            margin-bottom: 7px;
        }
    </style>
";
        
        $__internal_e24332163fe5ad0a328db7abd3b344aaf4853105fbfb25598e0f4ff865ff4ffd->leave($__internal_e24332163fe5ad0a328db7abd3b344aaf4853105fbfb25598e0f4ff865ff4ffd_prof);

    }

    // line 13
    public function block_page($context, array $blocks = array())
    {
        $__internal_f3644a45f7e9a25cb6298d64add9fb69ad6e7191a6ff6acd0aa06c878028d2d4 = $this->env->getExtension("native_profiler");
        $__internal_f3644a45f7e9a25cb6298d64add9fb69ad6e7191a6ff6acd0aa06c878028d2d4->enter($__internal_f3644a45f7e9a25cb6298d64add9fb69ad6e7191a6ff6acd0aa06c878028d2d4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 14
        echo "    <form id=\"demo_form\" method=\"post\" action=\"\" role=\"form\" target=\"_blank\">

        ";
        // line 16
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "

        <div class=\"row\">
            <div class=\"form-group col-md-12 text-right\" >
                <button type=\"submit\" class=\"btn btn-primary btn-lg\" onclick=\"sendMobile()\"><span class=\"glyphicon glyphicon-phone\"></span> Mobile</button>
                <button type=\"submit\" class=\"btn btn-primary btn-lg\" onclick=\"sendTablet()\"><span class=\"glyphicon glyphicon-resize-horizontal\"></span> Tablet</button>
                <button type=\"submit\" class=\"btn btn-primary btn-lg\" onclick=\"sendPc()\"><span class=\"glyphicon glyphicon-fullscreen\"></span> Computer</button>
            </div>
        </div>
    ";
        // line 25
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
    <script>
        var winRef;

        function loadWindow(width, height, id)
        {
//            if (!winRef || winRef.close)
//                winRef = window.open(\"\", \"pay_demo\", \"height=\"+height+\",width=\"+width);
//            else{
//                winRef.resizeTo(width, height);
//                winRef.focus()
//            }

            winRef = window.open(\"\", id, \"height=\"+height+\",width=\"+width);
        }

        function sendMobile()
        {
            var id=\"pay_demo\"+Math.floor((Math.random() * 10000) + 1);
            \$('#demo_form').attr(\"target\", id);
            loadWindow(375, 667, id);
        }
        function sendTablet()
        {
            var id=\"pay_demo\"+Math.floor((Math.random() * 10000) + 1);
            \$('#demo_form').attr(\"target\", id);
            loadWindow(768, 1024, id);
        }
        function sendPc()
        {
            \$('#demo_form').attr(\"target\", \"_blank\");
        }
    </script>
";
        
        $__internal_f3644a45f7e9a25cb6298d64add9fb69ad6e7191a6ff6acd0aa06c878028d2d4->leave($__internal_f3644a45f7e9a25cb6298d64add9fb69ad6e7191a6ff6acd0aa06c878028d2d4_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Demo:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 25,  79 => 16,  75 => 14,  69 => 13,  54 => 5,  48 => 4,  36 => 2,  11 => 1,);
    }
}
/* {% extends "@App/AppShop/layout_secondary.html.twig" %}*/
/* {% block title %}Demo{% endblock %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/*     <style>*/
/*         .form-group{*/
/*             margin-bottom: 7px;*/
/*         }*/
/*     </style>*/
/* {% endblock %}*/
/* */
/* {% block page %}*/
/*     <form id="demo_form" method="post" action="" role="form" target="_blank">*/
/* */
/*         {{ form_widget(form) }}*/
/* */
/*         <div class="row">*/
/*             <div class="form-group col-md-12 text-right" >*/
/*                 <button type="submit" class="btn btn-primary btn-lg" onclick="sendMobile()"><span class="glyphicon glyphicon-phone"></span> Mobile</button>*/
/*                 <button type="submit" class="btn btn-primary btn-lg" onclick="sendTablet()"><span class="glyphicon glyphicon-resize-horizontal"></span> Tablet</button>*/
/*                 <button type="submit" class="btn btn-primary btn-lg" onclick="sendPc()"><span class="glyphicon glyphicon-fullscreen"></span> Computer</button>*/
/*             </div>*/
/*         </div>*/
/*     {{ form_end(form) }}*/
/*     <script>*/
/*         var winRef;*/
/* */
/*         function loadWindow(width, height, id)*/
/*         {*/
/* //            if (!winRef || winRef.close)*/
/* //                winRef = window.open("", "pay_demo", "height="+height+",width="+width);*/
/* //            else{*/
/* //                winRef.resizeTo(width, height);*/
/* //                winRef.focus()*/
/* //            }*/
/* */
/*             winRef = window.open("", id, "height="+height+",width="+width);*/
/*         }*/
/* */
/*         function sendMobile()*/
/*         {*/
/*             var id="pay_demo"+Math.floor((Math.random() * 10000) + 1);*/
/*             $('#demo_form').attr("target", id);*/
/*             loadWindow(375, 667, id);*/
/*         }*/
/*         function sendTablet()*/
/*         {*/
/*             var id="pay_demo"+Math.floor((Math.random() * 10000) + 1);*/
/*             $('#demo_form').attr("target", id);*/
/*             loadWindow(768, 1024, id);*/
/*         }*/
/*         function sendPc()*/
/*         {*/
/*             $('#demo_form').attr("target", "_blank");*/
/*         }*/
/*     </script>*/
/* {% endblock %}*/
