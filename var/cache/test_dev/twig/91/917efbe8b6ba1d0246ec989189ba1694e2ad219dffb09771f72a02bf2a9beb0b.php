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
        $__internal_7227a1689f4af18c6a69ae1ea6987ace10202725d55532cf0b9619bf661bddb9 = $this->env->getExtension("native_profiler");
        $__internal_7227a1689f4af18c6a69ae1ea6987ace10202725d55532cf0b9619bf661bddb9->enter($__internal_7227a1689f4af18c6a69ae1ea6987ace10202725d55532cf0b9619bf661bddb9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Demo:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7227a1689f4af18c6a69ae1ea6987ace10202725d55532cf0b9619bf661bddb9->leave($__internal_7227a1689f4af18c6a69ae1ea6987ace10202725d55532cf0b9619bf661bddb9_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_482707a4202d857dcd29e8d2f348118e7e9e6a8e9be9882d3306fc3f839b9601 = $this->env->getExtension("native_profiler");
        $__internal_482707a4202d857dcd29e8d2f348118e7e9e6a8e9be9882d3306fc3f839b9601->enter($__internal_482707a4202d857dcd29e8d2f348118e7e9e6a8e9be9882d3306fc3f839b9601_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Demo";
        
        $__internal_482707a4202d857dcd29e8d2f348118e7e9e6a8e9be9882d3306fc3f839b9601->leave($__internal_482707a4202d857dcd29e8d2f348118e7e9e6a8e9be9882d3306fc3f839b9601_prof);

    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_8415ddff1a052dfb75ca6a1f6c90703d619124a641a4e904708a3e2c3dcd30cd = $this->env->getExtension("native_profiler");
        $__internal_8415ddff1a052dfb75ca6a1f6c90703d619124a641a4e904708a3e2c3dcd30cd->enter($__internal_8415ddff1a052dfb75ca6a1f6c90703d619124a641a4e904708a3e2c3dcd30cd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

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
        
        $__internal_8415ddff1a052dfb75ca6a1f6c90703d619124a641a4e904708a3e2c3dcd30cd->leave($__internal_8415ddff1a052dfb75ca6a1f6c90703d619124a641a4e904708a3e2c3dcd30cd_prof);

    }

    // line 13
    public function block_page($context, array $blocks = array())
    {
        $__internal_0eb34d95656b8323d9d6cb7d5a98c9d659053660b12b580a2c8ffa6d8d70fcc0 = $this->env->getExtension("native_profiler");
        $__internal_0eb34d95656b8323d9d6cb7d5a98c9d659053660b12b580a2c8ffa6d8d70fcc0->enter($__internal_0eb34d95656b8323d9d6cb7d5a98c9d659053660b12b580a2c8ffa6d8d70fcc0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

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
        
        $__internal_0eb34d95656b8323d9d6cb7d5a98c9d659053660b12b580a2c8ffa6d8d70fcc0->leave($__internal_0eb34d95656b8323d9d6cb7d5a98c9d659053660b12b580a2c8ffa6d8d70fcc0_prof);

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
