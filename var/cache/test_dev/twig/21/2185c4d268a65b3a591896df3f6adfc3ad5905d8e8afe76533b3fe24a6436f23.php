<?php

/* SonataMediaBundle:MediaAdmin:edit.html.twig */
class __TwigTemplate_77614043eb718e18e60943bb2a999e69163e219a6565e1c139acae6a0c599da4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 12
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_edit.html.twig", "SonataMediaBundle:MediaAdmin:edit.html.twig", 12);
        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_admin_content' => array($this, 'block_sonata_admin_content'),
            'sonata_media_show_reference' => array($this, 'block_sonata_media_show_reference'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_edit.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cf418c8eac3c19d5e92800b56d008402144415f5c0c58f960f1e013833f56923 = $this->env->getExtension("native_profiler");
        $__internal_cf418c8eac3c19d5e92800b56d008402144415f5c0c58f960f1e013833f56923->enter($__internal_cf418c8eac3c19d5e92800b56d008402144415f5c0c58f960f1e013833f56923_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:MediaAdmin:edit.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cf418c8eac3c19d5e92800b56d008402144415f5c0c58f960f1e013833f56923->leave($__internal_cf418c8eac3c19d5e92800b56d008402144415f5c0c58f960f1e013833f56923_prof);

    }

    // line 14
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_f5f19e0ef5b29d67b3487c7f48598d38bbad00a1e91c015356500b3c1211238a = $this->env->getExtension("native_profiler");
        $__internal_f5f19e0ef5b29d67b3487c7f48598d38bbad00a1e91c015356500b3c1211238a->enter($__internal_f5f19e0ef5b29d67b3487c7f48598d38bbad00a1e91c015356500b3c1211238a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 15
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "
    <style>
        button.btn.btn-sm.btn-default.pixlr-link {
            margin-bottom: 0;
        }
    </style>
";
        
        $__internal_f5f19e0ef5b29d67b3487c7f48598d38bbad00a1e91c015356500b3c1211238a->leave($__internal_f5f19e0ef5b29d67b3487c7f48598d38bbad00a1e91c015356500b3c1211238a_prof);

    }

    // line 23
    public function block_sonata_admin_content($context, array $blocks = array())
    {
        $__internal_3ca199f1ac5baee8b8c4356331e9ec4e145dfb393da5d7018ddddd4fe7205bb1 = $this->env->getExtension("native_profiler");
        $__internal_3ca199f1ac5baee8b8c4356331e9ec4e145dfb393da5d7018ddddd4fe7205bb1->enter($__internal_3ca199f1ac5baee8b8c4356331e9ec4e145dfb393da5d7018ddddd4fe7205bb1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_admin_content"));

        // line 24
        echo "
    <div class=\"row\">
        ";
        // line 26
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "id", array())) {
            // line 27
            echo "            <div class=\"col-md-6\">
                ";
            // line 28
            $this->displayBlock('sonata_media_show_reference', $context, $blocks);
            // line 103
            echo "            </div>
        ";
        }
        // line 105
        echo "
        <div class=\"col-md-6\">
            ";
        // line 108
        echo "            ";
        $this->displayParentBlock("sonata_admin_content", $context, $blocks);
        echo "
        </div>
    </div>

    ";
        // line 112
        if (($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pixlr", array()) && $this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pixlr", array()), "isEditable", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
            // line 113
            echo "        <div class=\"modal fade\" id=\"pixlr-modal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "\" aria-hidden=\"true\">
            <div class=\"modal-dialog modal-lg\">
                <div class=\"modal-content\">
                    <div class=\"modal-header\">
                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                        <h4 class=\"modal-title\" id=\"myModalLabel\">";
            // line 118
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "</h4>
                    </div>
                    <div class=\"modal-body\" id=\"pixlr-modal-body\">
                    </div>
                </div>
            </div>
        </div>

        <script type=\"text/javascript\">
            window.closeModal = function() {
                jQuery('#pixlr-modal').modal('hide');
            }

            jQuery('button.pixlr-link').on('click', function(e) {
                e.preventDefault();
                var url = jQuery(this).attr('data-href');
                jQuery(\"#pixlr-modal-body\").html('<iframe width=\"100%\" height=\"100%\" frameborder=\"0\" scrolling=\"no\" allowtransparency=\"true\" src=\"'+url+'\"></iframe>');
            });

            Admin.setup_list_modal(jQuery('#pixlr-modal'));
        </script>
    ";
        }
        // line 140
        echo "

";
        
        $__internal_3ca199f1ac5baee8b8c4356331e9ec4e145dfb393da5d7018ddddd4fe7205bb1->leave($__internal_3ca199f1ac5baee8b8c4356331e9ec4e145dfb393da5d7018ddddd4fe7205bb1_prof);

    }

    // line 28
    public function block_sonata_media_show_reference($context, array $blocks = array())
    {
        $__internal_99c820dac40fc513d8968b5c1b6fc3f5fcf28001d6242c5ed0f7f5f074d30cf0 = $this->env->getExtension("native_profiler");
        $__internal_99c820dac40fc513d8968b5c1b6fc3f5fcf28001d6242c5ed0f7f5f074d30cf0->enter($__internal_99c820dac40fc513d8968b5c1b6fc3f5fcf28001d6242c5ed0f7f5f074d30cf0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_media_show_reference"));

        // line 29
        echo "                    <div class=\"box box-primary\">
                        <div class=\"box-header\">
                            <h3 class=\"box-title\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title.media_preview", array(), "SonataMediaBundle"), "html", null, true);
        echo "</h3>
                            ";
        // line 32
        if (($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pixlr", array()) && $this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pixlr", array()), "isEditable", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"))) {
            // line 33
            echo "                                <div class=\"box-tools pull-right\">
                                    <button class=\"btn btn-sm btn-default pixlr-link\"
                                            data-href=\"";
            // line 35
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_pixlr_open_editor", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "html", null, true);
            echo "\"
                                            data-toggle=\"modal\"
                                            data-target=\"#pixlr-modal\"
                                            >
                                        <i class=\"fa fa-pencil-square-o\"></i> ";
            // line 39
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.edit_with_pixlr", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                    </button>
                                </div>
                            ";
        }
        // line 43
        echo "
                        </div>
                        <div class=\"box-body table-responsive\">

                            <center> <!-- yeah, center is still awesome ;) -->
                                ";
        // line 48
        echo $this->env->getExtension('sonata_media')->media((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "reference", array("width" => null, "height" => null, "class" => "img-responsive img-rounded"));
        // line 49
        echo "                            </center>

                            <table class=\"table\">
                                <tr>
                                    <th>";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.size", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>";
        // line 54
        echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "width", array()));
        echo "px x ";
        echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "height", array()));
        echo "px
                                        ";
        // line 55
        if (($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "size", array()) > 0)) {
            echo "(";
            echo $this->env->getExtension('sonata_intl_number')->formatDecimal($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "size", array()));
            echo "o)";
        }
        echo "</td>
                                <tr>
                                <tr>
                                    <th>";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.content_type", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "contenttype", array()), "html", null, true);
        echo "</td>
                                <tr>
                                <tr>
                                    <th>";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.cdn", array(), "SonataMediaBundle"), "html", null, true);
        echo "</th>
                                    <td>
                                        ";
        // line 64
        if ($this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "cdnisflushable", array())) {
            // line 65
            echo "                                            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.to_be_flushed", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                        ";
        } else {
            // line 67
            echo "                                            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.flushed_at", array(), "SonataMediaBundle"), "html", null, true);
            echo "
                                            ";
            // line 68
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "cdnflushat", array())), "html", null, true);
            echo "
                                        ";
        }
        // line 70
        echo "                                    </td>
                                <tr>
                                <tr>
                                    <th><a href=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.protected_download_url", array(), "SonataMediaBundle"), "html", null, true);
        echo "</a></th>
                                    <td>
                                        <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->env->getExtension('sonata_admin')->getUrlsafeIdentifier((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))))), "html", null, true);
        echo "\" />
                                        <span class=\"label label-warning\">";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label.protected_download_url_notice", array(), "SonataMediaBundle"), "html", null, true);
        echo "</span> ";
        echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pool", array()), "downloadSecurity", array(0 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object"))), "method"), "description", array());
        echo "
                                    </td>
                                <tr>
                                <tr>
                                    <th>
                                        <a href=\"";
        // line 81
        echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "reference");
        echo "\" target=\"_blank\">reference</a>
                                    </th>
                                    <td>
                                        <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
        // line 84
        echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "reference");
        echo "\" />
                                    </td>
                                </tr>

                                ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["sonata_media"]) ? $context["sonata_media"] : $this->getContext($context, "sonata_media")), "pool", array()), "formatNamesByContext", array(0 => $this->getAttribute((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), "context", array())), "method"));
        foreach ($context['_seq'] as $context["name"] => $context["format"]) {
            // line 89
            echo "                                    <tr>
                                        <th>
                                            <a href=\"";
            // line 91
            echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), $context["name"]);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
            echo "</a>
                                        </th>
                                        <td>
                                            <input type=\"text\" class=\"form-control\" onClick=\"this.select();\" readonly=\"readonly\" value=\"";
            // line 94
            echo $this->env->getExtension('sonata_media')->path((isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), $context["name"]);
            echo "\" />
                                        </td>
                                    </tr>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['name'], $context['format'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "                            </table>
                        </div>

                    </div>
                ";
        
        $__internal_99c820dac40fc513d8968b5c1b6fc3f5fcf28001d6242c5ed0f7f5f074d30cf0->leave($__internal_99c820dac40fc513d8968b5c1b6fc3f5fcf28001d6242c5ed0f7f5f074d30cf0_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:MediaAdmin:edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  302 => 98,  292 => 94,  284 => 91,  280 => 89,  276 => 88,  269 => 84,  263 => 81,  253 => 76,  249 => 75,  242 => 73,  237 => 70,  232 => 68,  227 => 67,  221 => 65,  219 => 64,  214 => 62,  208 => 59,  204 => 58,  194 => 55,  188 => 54,  184 => 53,  178 => 49,  176 => 48,  169 => 43,  162 => 39,  155 => 35,  151 => 33,  149 => 32,  145 => 31,  141 => 29,  135 => 28,  126 => 140,  101 => 118,  92 => 113,  90 => 112,  82 => 108,  78 => 105,  74 => 103,  72 => 28,  69 => 27,  67 => 26,  63 => 24,  57 => 23,  42 => 15,  36 => 14,  11 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends 'SonataAdminBundle:CRUD:base_edit.html.twig' %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/*     <style>*/
/*         button.btn.btn-sm.btn-default.pixlr-link {*/
/*             margin-bottom: 0;*/
/*         }*/
/*     </style>*/
/* {% endblock %}*/
/* */
/* {% block sonata_admin_content %}*/
/* */
/*     <div class="row">*/
/*         {% if object.id %}*/
/*             <div class="col-md-6">*/
/*                 {% block sonata_media_show_reference %}*/
/*                     <div class="box box-primary">*/
/*                         <div class="box-header">*/
/*                             <h3 class="box-title">{{ 'title.media_preview'|trans({}, 'SonataMediaBundle') }}</h3>*/
/*                             {% if sonata_media.pixlr and sonata_media.pixlr.isEditable(object) %}*/
/*                                 <div class="box-tools pull-right">*/
/*                                     <button class="btn btn-sm btn-default pixlr-link"*/
/*                                             data-href="{{ path('sonata_media_pixlr_open_editor', { 'id': object|sonata_urlsafeid }) }}"*/
/*                                             data-toggle="modal"*/
/*                                             data-target="#pixlr-modal"*/
/*                                             >*/
/*                                         <i class="fa fa-pencil-square-o"></i> {{ "label.edit_with_pixlr"|trans({}, "SonataMediaBundle") }}*/
/*                                     </button>*/
/*                                 </div>*/
/*                             {% endif %}*/
/* */
/*                         </div>*/
/*                         <div class="box-body table-responsive">*/
/* */
/*                             <center> <!-- yeah, center is still awesome ;) -->*/
/*                                 {% media object, 'reference' with {'width': null, 'height': null, 'class': 'img-responsive img-rounded'} %}*/
/*                             </center>*/
/* */
/*                             <table class="table">*/
/*                                 <tr>*/
/*                                     <th>{{ 'label.size'|trans({}, 'SonataMediaBundle') }}</th>*/
/*                                     <td>{{ object.width|number_format_decimal }}px x {{ object.height|number_format_decimal }}px*/
/*                                         {% if object.size > 0 %}({{ object.size|number_format_decimal }}o){% endif %}</td>*/
/*                                 <tr>*/
/*                                 <tr>*/
/*                                     <th>{{ 'label.content_type'|trans({}, 'SonataMediaBundle') }}</th>*/
/*                                     <td>{{ object.contenttype }}</td>*/
/*                                 <tr>*/
/*                                 <tr>*/
/*                                     <th>{{ 'label.cdn'|trans({}, 'SonataMediaBundle') }}</th>*/
/*                                     <td>*/
/*                                         {% if object.cdnisflushable %}*/
/*                                             {{ 'label.to_be_flushed'|trans({}, 'SonataMediaBundle') }}*/
/*                                         {% else %}*/
/*                                             {{ 'label.flushed_at'|trans({}, 'SonataMediaBundle') }}*/
/*                                             {{ object.cdnflushat|date }}*/
/*                                         {% endif %}*/
/*                                     </td>*/
/*                                 <tr>*/
/*                                 <tr>*/
/*                                     <th><a href="{{ path('sonata_media_download', {'id': object|sonata_urlsafeid }) }}">{{ 'label.protected_download_url'|trans({}, 'SonataMediaBundle') }}</a></th>*/
/*                                     <td>*/
/*                                         <input type="text" class="form-control" onClick="this.select();" readonly="readonly" value="{{ path('sonata_media_download', {'id': object|sonata_urlsafeid }) }}" />*/
/*                                         <span class="label label-warning">{{ 'label.protected_download_url_notice'|trans({}, 'SonataMediaBundle') }}</span> {{ sonata_media.pool.downloadSecurity(object).description|raw }}*/
/*                                     </td>*/
/*                                 <tr>*/
/*                                 <tr>*/
/*                                     <th>*/
/*                                         <a href="{% path object, 'reference' %}" target="_blank">reference</a>*/
/*                                     </th>*/
/*                                     <td>*/
/*                                         <input type="text" class="form-control" onClick="this.select();" readonly="readonly" value="{% path object, 'reference' %}" />*/
/*                                     </td>*/
/*                                 </tr>*/
/* */
/*                                 {% for name, format in sonata_media.pool.formatNamesByContext(object.context) %}*/
/*                                     <tr>*/
/*                                         <th>*/
/*                                             <a href="{% path object, name %}" target="_blank">{{ name }}</a>*/
/*                                         </th>*/
/*                                         <td>*/
/*                                             <input type="text" class="form-control" onClick="this.select();" readonly="readonly" value="{% path object, name %}" />*/
/*                                         </td>*/
/*                                     </tr>*/
/*                                 {% endfor %}*/
/*                             </table>*/
/*                         </div>*/
/* */
/*                     </div>*/
/*                 {% endblock sonata_media_show_reference %}*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         <div class="col-md-6">*/
/*             {# Renders the form #}*/
/*             {{ parent() }}*/
/*         </div>*/
/*     </div>*/
/* */
/*     {% if sonata_media.pixlr and sonata_media.pixlr.isEditable(object) %}*/
/*         <div class="modal fade" id="pixlr-modal" tabindex="-1" role="dialog" aria-labelledby="{{ "label.edit_with_pixlr"|trans({}, "SonataMediaBundle")}}" aria-hidden="true">*/
/*             <div class="modal-dialog modal-lg">*/
/*                 <div class="modal-content">*/
/*                     <div class="modal-header">*/
/*                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>*/
/*                         <h4 class="modal-title" id="myModalLabel">{{ "label.edit_with_pixlr"|trans({}, "SonataMediaBundle")}}</h4>*/
/*                     </div>*/
/*                     <div class="modal-body" id="pixlr-modal-body">*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/* */
/*         <script type="text/javascript">*/
/*             window.closeModal = function() {*/
/*                 jQuery('#pixlr-modal').modal('hide');*/
/*             }*/
/* */
/*             jQuery('button.pixlr-link').on('click', function(e) {*/
/*                 e.preventDefault();*/
/*                 var url = jQuery(this).attr('data-href');*/
/*                 jQuery("#pixlr-modal-body").html('<iframe width="100%" height="100%" frameborder="0" scrolling="no" allowtransparency="true" src="'+url+'"></iframe>');*/
/*             });*/
/* */
/*             Admin.setup_list_modal(jQuery('#pixlr-modal'));*/
/*         </script>*/
/*     {% endif %}*/
/* */
/* */
/* {% endblock sonata_admin_content %}*/
/* */
