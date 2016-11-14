<?php

/* ::sonata_layout.html.twig */
class __TwigTemplate_4ea066a75d05cb0bc9d17995bf5e25406db07158ea18060b7f254cbe40292d1d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle::standard_layout.html.twig", "::sonata_layout.html.twig", 1);
        $this->blocks = array(
            'side_bar_before_nav' => array($this, 'block_side_bar_before_nav'),
            'javascripts' => array($this, 'block_javascripts'),
            'stylesheets' => array($this, 'block_stylesheets'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle::standard_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d8131e7b648739c0a9a88cf2663afdf17c8e8bb2a2760c8abea60fe2c9a197bf = $this->env->getExtension("native_profiler");
        $__internal_d8131e7b648739c0a9a88cf2663afdf17c8e8bb2a2760c8abea60fe2c9a197bf->enter($__internal_d8131e7b648739c0a9a88cf2663afdf17c8e8bb2a2760c8abea60fe2c9a197bf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "::sonata_layout.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d8131e7b648739c0a9a88cf2663afdf17c8e8bb2a2760c8abea60fe2c9a197bf->leave($__internal_d8131e7b648739c0a9a88cf2663afdf17c8e8bb2a2760c8abea60fe2c9a197bf_prof);

    }

    // line 2
    public function block_side_bar_before_nav($context, array $blocks = array())
    {
        $__internal_bd746b10f52d30624d8e1c9e767261673a697de1fa3ae5dd8ecb06f05b3570dc = $this->env->getExtension("native_profiler");
        $__internal_bd746b10f52d30624d8e1c9e767261673a697de1fa3ae5dd8ecb06f05b3570dc->enter($__internal_bd746b10f52d30624d8e1c9e767261673a697de1fa3ae5dd8ecb06f05b3570dc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "side_bar_before_nav"));

        // line 3
        echo "    ";
        if ($this->env->getExtension('security')->isGranted("ROLE_SONATA_STATS_INTERNAL_ALL")) {
            // line 4
            echo "
        <ul class=\"sidebar-menu\">
            <li class=\"treeview\">
                <a href=\"#\">
                    <i class=\"fa fa-bar-chart-o\"></i><span> Stats</span> <i class=\"fa pull-right fa-angle-left\"></i>
                </a>
                <ul class=\"treeview-menu\">
                    <li>
                        <a href=\"";
            // line 12
            echo $this->env->getExtension('routing')->getPath("stats_pay_to_clients_summary");
            echo "\">
                            <i class=\"fa fa-angle-double-right\"></i><span> Stats to pay clients</span>
                        </a>
                    </li>
                    <li>
                        <a href=\"";
            // line 17
            echo $this->env->getExtension('routing')->getPath("stats_vat_index");
            echo "\">
                            <i class=\"fa fa-angle-double-right\"></i><span> Stats Vat</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    ";
        }
        // line 25
        echo "    ";
        if ($this->env->getExtension('security')->isGranted("ROLE_SONATA_BILLING_INVOICES_PENDING_ALL")) {
            // line 26
            echo "        <ul class=\"sidebar-menu\">
            <li class=\"treeview-menu\" style=\"display: block\">
                <a href=\"";
            // line 28
            echo $this->env->getExtension('routing')->getPath("billing_invoices_pending_list");
            echo "\">
                    <i class=\"fa fa-bar-chart-o\"></i><span> Pending invoices (";
            // line 29
            echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('http_kernel')->controller("AppBundle:Admin/BillingInvoiceAdmin:count"));
            echo ")</span> <i class=\"fa pull-right fa-angle-left\"></i>
                </a>
            </li>
        </ul>
    ";
        }
        
        $__internal_bd746b10f52d30624d8e1c9e767261673a697de1fa3ae5dd8ecb06f05b3570dc->leave($__internal_bd746b10f52d30624d8e1c9e767261673a697de1fa3ae5dd8ecb06f05b3570dc_prof);

    }

    // line 37
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_b4e3b9899f328c2f308720b4dbf45cc64c2eb43e5f580f98a062ba57af1f6d8b = $this->env->getExtension("native_profiler");
        $__internal_b4e3b9899f328c2f308720b4dbf45cc64c2eb43e5f580f98a062ba57af1f6d8b->enter($__internal_b4e3b9899f328c2f308720b4dbf45cc64c2eb43e5f580f98a062ba57af1f6d8b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 38
        echo "
    ";
        // line 39
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <script>
        \$(document).on(\"keypress\",\".select2-input\",function(event){

            if (event.ctrlKey || event.metaKey || event.shiftKey) {
                var id =\$(this).parents(\"div[class*='select2-container']\").attr(\"id\").replace(\"s2id_\",\"\");
                var element =\$(\"#\"+id);
                if (event.which == 97){
                    var selected = [];
                    element.find(\"option\").each(function(i,e){
                        selected[selected.length]=\$(e).attr(\"value\");
                    });
                    element.select2(\"val\", selected);
                } else if (event.which == 100){
                    element.select2(\"val\", \"\");
                }
            }
        });
    </script>

";
        
        $__internal_b4e3b9899f328c2f308720b4dbf45cc64c2eb43e5f580f98a062ba57af1f6d8b->leave($__internal_b4e3b9899f328c2f308720b4dbf45cc64c2eb43e5f580f98a062ba57af1f6d8b_prof);

    }

    // line 62
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_c52591c5c31e01025fc6c6bb7e158174329e11580e0807db6ac6e76a990c0eaf = $this->env->getExtension("native_profiler");
        $__internal_c52591c5c31e01025fc6c6bb7e158174329e11580e0807db6ac6e76a990c0eaf->enter($__internal_c52591c5c31e01025fc6c6bb7e158174329e11580e0807db6ac6e76a990c0eaf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 63
        echo "
    ";
        // line 64
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>

        table .form-control, table .input-group .form-control{
            width: auto !important;
        }
        .mosaic-inner-box-default{
            text-align: center;
        }
        .mosaic-inner-box-default img{
            width: auto !important;
        }
        .sonata-medium-date div.select2-container{
            width: auto !important;
        }
        
    </style>

";
        
        $__internal_c52591c5c31e01025fc6c6bb7e158174329e11580e0807db6ac6e76a990c0eaf->leave($__internal_c52591c5c31e01025fc6c6bb7e158174329e11580e0807db6ac6e76a990c0eaf_prof);

    }

    public function getTemplateName()
    {
        return "::sonata_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 64,  142 => 63,  136 => 62,  107 => 39,  104 => 38,  98 => 37,  85 => 29,  81 => 28,  77 => 26,  74 => 25,  63 => 17,  55 => 12,  45 => 4,  42 => 3,  36 => 2,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle::standard_layout.html.twig' %}*/
/* {% block side_bar_before_nav %}*/
/*     {% if is_granted('ROLE_SONATA_STATS_INTERNAL_ALL') %}*/
/* */
/*         <ul class="sidebar-menu">*/
/*             <li class="treeview">*/
/*                 <a href="#">*/
/*                     <i class="fa fa-bar-chart-o"></i><span> Stats</span> <i class="fa pull-right fa-angle-left"></i>*/
/*                 </a>*/
/*                 <ul class="treeview-menu">*/
/*                     <li>*/
/*                         <a href="{{ path('stats_pay_to_clients_summary') }}">*/
/*                             <i class="fa fa-angle-double-right"></i><span> Stats to pay clients</span>*/
/*                         </a>*/
/*                     </li>*/
/*                     <li>*/
/*                         <a href="{{ path('stats_vat_index') }}">*/
/*                             <i class="fa fa-angle-double-right"></i><span> Stats Vat</span>*/
/*                         </a>*/
/*                     </li>*/
/*                 </ul>*/
/*             </li>*/
/*         </ul>*/
/*     {% endif %}*/
/*     {% if is_granted('ROLE_SONATA_BILLING_INVOICES_PENDING_ALL') %}*/
/*         <ul class="sidebar-menu">*/
/*             <li class="treeview-menu" style="display: block">*/
/*                 <a href="{{ path('billing_invoices_pending_list') }}">*/
/*                     <i class="fa fa-bar-chart-o"></i><span> Pending invoices ({{ render(controller('AppBundle:Admin/BillingInvoiceAdmin:count')) }})</span> <i class="fa pull-right fa-angle-left"></i>*/
/*                 </a>*/
/*             </li>*/
/*         </ul>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
/* */
/* {% block javascripts %}*/
/* */
/*     {{ parent() }}*/
/* */
/*     <script>*/
/*         $(document).on("keypress",".select2-input",function(event){*/
/* */
/*             if (event.ctrlKey || event.metaKey || event.shiftKey) {*/
/*                 var id =$(this).parents("div[class*='select2-container']").attr("id").replace("s2id_","");*/
/*                 var element =$("#"+id);*/
/*                 if (event.which == 97){*/
/*                     var selected = [];*/
/*                     element.find("option").each(function(i,e){*/
/*                         selected[selected.length]=$(e).attr("value");*/
/*                     });*/
/*                     element.select2("val", selected);*/
/*                 } else if (event.which == 100){*/
/*                     element.select2("val", "");*/
/*                 }*/
/*             }*/
/*         });*/
/*     </script>*/
/* */
/* {% endblock %}*/
/* */
/* {% block stylesheets %}*/
/* */
/*     {{ parent() }}*/
/*     <style>*/
/* */
/*         table .form-control, table .input-group .form-control{*/
/*             width: auto !important;*/
/*         }*/
/*         .mosaic-inner-box-default{*/
/*             text-align: center;*/
/*         }*/
/*         .mosaic-inner-box-default img{*/
/*             width: auto !important;*/
/*         }*/
/*         .sonata-medium-date div.select2-container{*/
/*             width: auto !important;*/
/*         }*/
/*         */
/*     </style>*/
/* */
/* {% endblock %}*/
