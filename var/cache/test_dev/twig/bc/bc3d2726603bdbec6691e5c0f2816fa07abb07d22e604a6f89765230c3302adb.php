<?php

/* AppBundle:Others/Widgets:selectPMPC.html.twig */
class __TwigTemplate_805a4f9941858de2f458729feff4728bd4139bdef2b67e2cef419e3beb3d33d1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f0fdeb6b3c3c0daa13e05bf4a69cd68545dd8ecd6b5079760a26ea48b4ad425a = $this->env->getExtension("native_profiler");
        $__internal_f0fdeb6b3c3c0daa13e05bf4a69cd68545dd8ecd6b5079760a26ea48b4ad425a->enter($__internal_f0fdeb6b3c3c0daa13e05bf4a69cd68545dd8ecd6b5079760a26ea48b4ad425a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Widgets:selectPMPC.html.twig"));

        // line 1
        echo "<html>
<head>
    <style>
        #widget{
            border: 1px solid #ccc;
            height: 63px;
            overflow: hidden;
            -webkit-border-radius: 25px;
            -moz-border-radius: 25px;
            border-radius: 25px;
            -webkit-box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);
        }
        #pay-methods{
            height: 63px;
            overflow: hidden;
            z-index: -1;
            background: #fff;
        }

        #large{
            width: 9999px;
            position: relative;
            -webkit-transition: left 0.5s ease; /* For Safari 3.1 to 6.0 */
            transition: left 0.5s ease;
            left: 0;
        }
        .pay-method{
            float: left;
            height: 63px;
            border-right: 1px dashed #ccc;
            cursor: pointer;
            z-index: 1;
        }
        .pay-method:hover{
            background: #C7FFB3; /* Old browsers */
        }

        #widget .left, #widget .right{
            width: 65px;
            height: 63px;
            z-index: 3;
            cursor: pointer;
        }

        #widget .left{
            float: left;
            background: url('";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/widgets/arrow_left.png"), "html", null, true);
        echo "') center no-repeat #eee;
            border-right: 1px solid #ccc;
        }

        #widget .right{
            float: right;
            background: url('";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/app_shop/img/widgets/arrow_right.png"), "html", null, true);
        echo "') center no-repeat #eee;
            border-left: 1px solid #ccc;
        }
    </style>
    <script>
        var position = 0,
            move = 131,
            number = ";
        // line 62
        echo twig_escape_filter($this->env, twig_length_filter($this->env, (isset($context["pmpcs"]) ? $context["pmpcs"] : $this->getContext($context, "pmpcs"))), "html", null, true);
        echo "
        ;

        function moveCarousel(increase)
        {
            var pmWidth = document.getElementById('pay-methods').offsetWidth;
            var extra = pmWidth % move > 110  ? -1 : 0;

            if (increase && position < 0)
                position+= move;
            else if (!increase && (position > ((-1*move * (number + extra)) + (Math.floor(pmWidth/move)*move))))
                position-= move;

            document.getElementById('large').style.left = position+'px';
        }

        function openNewTab(id)
        {
            window.open(\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("widget_select_pmpc", array("transaction_id" => $this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "id", array()))), "html", null, true);
        echo "/\"+id);
        }

    </script>
</head>
<body>
    <div id=\"widget\">
        <div class=\"left\" onclick=\"moveCarousel(true)\"></div>
        <div class=\"right\" onclick=\"moveCarousel(false)\"></div>
        <div id=\"pay-methods\">
            <div id=\"large\">
            ";
        // line 91
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["pmpcs"]) ? $context["pmpcs"] : $this->getContext($context, "pmpcs")));
        foreach ($context['_seq'] as $context["_key"] => $context["pmpc"]) {
            // line 92
            echo "                <div class=\"pay-method\" onclick=\"openNewTab(";
            echo twig_escape_filter($this->env, $this->getAttribute($context["pmpc"], "id", array()), "html", null, true);
            echo ")\"><img src=\"";
            echo $this->env->getExtension('sonata_media')->path($this->getAttribute($this->getAttribute($context["pmpc"], "payMethod", array()), "imgIcon", array()), "shop");
            echo "\"></div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pmpc'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        echo "            </div>
        </div>

    </div>
</body>
</html>";
        
        $__internal_f0fdeb6b3c3c0daa13e05bf4a69cd68545dd8ecd6b5079760a26ea48b4ad425a->leave($__internal_f0fdeb6b3c3c0daa13e05bf4a69cd68545dd8ecd6b5079760a26ea48b4ad425a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Widgets:selectPMPC.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 94,  130 => 92,  126 => 91,  112 => 80,  91 => 62,  81 => 55,  72 => 49,  22 => 1,);
    }
}
/* <html>*/
/* <head>*/
/*     <style>*/
/*         #widget{*/
/*             border: 1px solid #ccc;*/
/*             height: 63px;*/
/*             overflow: hidden;*/
/*             -webkit-border-radius: 25px;*/
/*             -moz-border-radius: 25px;*/
/*             border-radius: 25px;*/
/*             -webkit-box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);*/
/*             -moz-box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);*/
/*             box-shadow: 0px 0px 30px -10px rgba(0,0,0,0.75);*/
/*         }*/
/*         #pay-methods{*/
/*             height: 63px;*/
/*             overflow: hidden;*/
/*             z-index: -1;*/
/*             background: #fff;*/
/*         }*/
/* */
/*         #large{*/
/*             width: 9999px;*/
/*             position: relative;*/
/*             -webkit-transition: left 0.5s ease; /* For Safari 3.1 to 6.0 *//* */
/*             transition: left 0.5s ease;*/
/*             left: 0;*/
/*         }*/
/*         .pay-method{*/
/*             float: left;*/
/*             height: 63px;*/
/*             border-right: 1px dashed #ccc;*/
/*             cursor: pointer;*/
/*             z-index: 1;*/
/*         }*/
/*         .pay-method:hover{*/
/*             background: #C7FFB3; /* Old browsers *//* */
/*         }*/
/* */
/*         #widget .left, #widget .right{*/
/*             width: 65px;*/
/*             height: 63px;*/
/*             z-index: 3;*/
/*             cursor: pointer;*/
/*         }*/
/* */
/*         #widget .left{*/
/*             float: left;*/
/*             background: url('{{asset('bundles/app/app_shop/img/widgets/arrow_left.png')}}') center no-repeat #eee;*/
/*             border-right: 1px solid #ccc;*/
/*         }*/
/* */
/*         #widget .right{*/
/*             float: right;*/
/*             background: url('{{asset('bundles/app/app_shop/img/widgets/arrow_right.png')}}') center no-repeat #eee;*/
/*             border-left: 1px solid #ccc;*/
/*         }*/
/*     </style>*/
/*     <script>*/
/*         var position = 0,*/
/*             move = 131,*/
/*             number = {{ pmpcs | length }}*/
/*         ;*/
/* */
/*         function moveCarousel(increase)*/
/*         {*/
/*             var pmWidth = document.getElementById('pay-methods').offsetWidth;*/
/*             var extra = pmWidth % move > 110  ? -1 : 0;*/
/* */
/*             if (increase && position < 0)*/
/*                 position+= move;*/
/*             else if (!increase && (position > ((-1*move * (number + extra)) + (Math.floor(pmWidth/move)*move))))*/
/*                 position-= move;*/
/* */
/*             document.getElementById('large').style.left = position+'px';*/
/*         }*/
/* */
/*         function openNewTab(id)*/
/*         {*/
/*             window.open("{{ url('widget_select_pmpc', {'transaction_id': transaction.id}) }}/"+id);*/
/*         }*/
/* */
/*     </script>*/
/* </head>*/
/* <body>*/
/*     <div id="widget">*/
/*         <div class="left" onclick="moveCarousel(true)"></div>*/
/*         <div class="right" onclick="moveCarousel(false)"></div>*/
/*         <div id="pay-methods">*/
/*             <div id="large">*/
/*             {% for pmpc in pmpcs  %}*/
/*                 <div class="pay-method" onclick="openNewTab({{pmpc.id}})"><img src="{% path pmpc.payMethod.imgIcon, 'shop' %}"></div>*/
/*             {% endfor %}*/
/*             </div>*/
/*         </div>*/
/* */
/*     </div>*/
/* </body>*/
/* </html>*/
