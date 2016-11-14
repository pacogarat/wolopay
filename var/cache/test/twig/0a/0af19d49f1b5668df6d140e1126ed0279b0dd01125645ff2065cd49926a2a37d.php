<?php

/* base_pdf.html.twig */
class __TwigTemplate_60f60d3765647325710a554bca8fb2c1a92d3a94a7fabd34421c5207685e3a07 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_df9085d585ebc307e5be883f2b49d118947f2dca2d55524111d724619d6223b4 = $this->env->getExtension("native_profiler");
        $__internal_df9085d585ebc307e5be883f2b49d118947f2dca2d55524111d724619d6223b4->enter($__internal_df9085d585ebc307e5be883f2b49d118947f2dca2d55524111d724619d6223b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base_pdf.html.twig"));

        // line 5
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\">
    <style>
        body{
            font-size: 13px;
        }

        .extra_padding{
            padding-left: 20px;
        }

        th{
            text-align: center;
        }

        table .num{
            text-align: right;
        }

        table .borderTop{
            border-top: 1px solid #333;
            padding-top: 10px;
        }

        .h1{
            font-weight: bold;
            font-size: 1.4em;
        }

        .h2{
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .h3{
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        div.page {
            overflow: hidden;
            page-break-before: always;
        }

    </style>

</head>
<body >
    <div style=\"padding-top: 30px\">
        ";
        // line 58
        $this->displayBlock('body', $context, $blocks);
        // line 59
        echo "    </div>
</body>
</html>";
        
        $__internal_df9085d585ebc307e5be883f2b49d118947f2dca2d55524111d724619d6223b4->leave($__internal_df9085d585ebc307e5be883f2b49d118947f2dca2d55524111d724619d6223b4_prof);

    }

    // line 58
    public function block_body($context, array $blocks = array())
    {
        $__internal_b3a54717f1be293357a8a354e15dbf762e90f25a4b85af73b953479f54b73a10 = $this->env->getExtension("native_profiler");
        $__internal_b3a54717f1be293357a8a354e15dbf762e90f25a4b85af73b953479f54b73a10->enter($__internal_b3a54717f1be293357a8a354e15dbf762e90f25a4b85af73b953479f54b73a10_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        echo "";
        
        $__internal_b3a54717f1be293357a8a354e15dbf762e90f25a4b85af73b953479f54b73a10->leave($__internal_b3a54717f1be293357a8a354e15dbf762e90f25a4b85af73b953479f54b73a10_prof);

    }

    public function getTemplateName()
    {
        return "base_pdf.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  89 => 58,  80 => 59,  78 => 58,  23 => 5,);
    }
}
/* {# client \AppBundle\Entity\Client #}*/
/* {# finInvoice \AppBundle\Entity\FinInvoice #}*/
/* {# storageCurrencies \AppBundle\Entity\NotPersisted\StorageCurrencyMoney #}*/
/* {# money \AppBundle\Entity\NotPersisted\Money #}*/
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="UTF-8">*/
/*     <style>*/
/*         body{*/
/*             font-size: 13px;*/
/*         }*/
/* */
/*         .extra_padding{*/
/*             padding-left: 20px;*/
/*         }*/
/* */
/*         th{*/
/*             text-align: center;*/
/*         }*/
/* */
/*         table .num{*/
/*             text-align: right;*/
/*         }*/
/* */
/*         table .borderTop{*/
/*             border-top: 1px solid #333;*/
/*             padding-top: 10px;*/
/*         }*/
/* */
/*         .h1{*/
/*             font-weight: bold;*/
/*             font-size: 1.4em;*/
/*         }*/
/* */
/*         .h2{*/
/*             font-weight: bold;*/
/*             font-size: 1.2em;*/
/*             margin-bottom: 10px;*/
/*         }*/
/* */
/*         .h3{*/
/*             font-weight: bold;*/
/*             font-size: 1.1em;*/
/*             margin-bottom: 10px;*/
/*         }*/
/* */
/*         div.page {*/
/*             overflow: hidden;*/
/*             page-break-before: always;*/
/*         }*/
/* */
/*     </style>*/
/* */
/* </head>*/
/* <body >*/
/*     <div style="padding-top: 30px">*/
/*         {% block body '' %}*/
/*     </div>*/
/* </body>*/
/* </html>*/
