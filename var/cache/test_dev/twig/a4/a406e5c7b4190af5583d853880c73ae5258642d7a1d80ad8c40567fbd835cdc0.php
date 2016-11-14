<?php

/* SonataAdminBundle:CRUD:base_history.html.twig */
class __TwigTemplate_5c905d9fb3b99eb2a2d0760e944749b7391f8051089a1e8996acff9130b3e2f0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'actions' => array($this, 'block_actions'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:CRUD:base_history.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ebba1a84ce17da7e570b25b993f27a3de2385fc2889f678c2e653445e3e0c6a2 = $this->env->getExtension("native_profiler");
        $__internal_ebba1a84ce17da7e570b25b993f27a3de2385fc2889f678c2e653445e3e0c6a2->enter($__internal_ebba1a84ce17da7e570b25b993f27a3de2385fc2889f678c2e653445e3e0c6a2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:CRUD:base_history.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ebba1a84ce17da7e570b25b993f27a3de2385fc2889f678c2e653445e3e0c6a2->leave($__internal_ebba1a84ce17da7e570b25b993f27a3de2385fc2889f678c2e653445e3e0c6a2_prof);

    }

    // line 14
    public function block_actions($context, array $blocks = array())
    {
        $__internal_1a32afefb00946d4939b15e535d2ae06a191735304415a83222b259d30812fa0 = $this->env->getExtension("native_profiler");
        $__internal_1a32afefb00946d4939b15e535d2ae06a191735304415a83222b259d30812fa0->enter($__internal_1a32afefb00946d4939b15e535d2ae06a191735304415a83222b259d30812fa0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "actions"));

        // line 15
        echo "    <li>";
        $this->loadTemplate("SonataAdminBundle:Button:edit_button.html.twig", "SonataAdminBundle:CRUD:base_history.html.twig", 15)->display($context);
        echo "</li>
    <li>";
        // line 16
        $this->loadTemplate("SonataAdminBundle:Button:acl_button.html.twig", "SonataAdminBundle:CRUD:base_history.html.twig", 16)->display($context);
        echo "</li>
    <li>";
        // line 17
        $this->loadTemplate("SonataAdminBundle:Button:show_button.html.twig", "SonataAdminBundle:CRUD:base_history.html.twig", 17)->display($context);
        echo "</li>
    <li>";
        // line 18
        $this->loadTemplate("SonataAdminBundle:Button:list_button.html.twig", "SonataAdminBundle:CRUD:base_history.html.twig", 18)->display($context);
        echo "</li>
";
        
        $__internal_1a32afefb00946d4939b15e535d2ae06a191735304415a83222b259d30812fa0->leave($__internal_1a32afefb00946d4939b15e535d2ae06a191735304415a83222b259d30812fa0_prof);

    }

    // line 21
    public function block_content($context, array $blocks = array())
    {
        $__internal_14e30790b665eb4c78e73ab15940c5c6b71120fceb1bf19630b39223d17574c9 = $this->env->getExtension("native_profiler");
        $__internal_14e30790b665eb4c78e73ab15940c5c6b71120fceb1bf19630b39223d17574c9->enter($__internal_14e30790b665eb4c78e73ab15940c5c6b71120fceb1bf19630b39223d17574c9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 22
        echo "
    <div class=\"col-md-5\">
        <table class=\"table\" id=\"revisions\">
            <thead>
                <tr>
                    <th>";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_revision", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_timestamp", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_username", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_action", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                    <th>";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("td_compare", array(), "SonataAdminBundle"), "html", null, true);
        echo "</th>
                </tr>
            </thead>
            <tbody>
                ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["revisions"]) ? $context["revisions"] : $this->getContext($context, "revisions")));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["revision"]) {
            // line 36
            echo "                    <tr class=\"";
            if ((((isset($context["currentRevision"]) ? $context["currentRevision"] : $this->getContext($context, "currentRevision")) != false) && ($this->getAttribute($context["revision"], "rev", array()) == $this->getAttribute((isset($context["currentRevision"]) ? $context["currentRevision"] : $this->getContext($context, "currentRevision")), "rev", array())))) {
                echo "current-revision";
            }
            echo "\">
                        <td>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($context["revision"], "rev", array()), "html", null, true);
            echo "</td>
                        <td>";
            // line 38
            $this->loadTemplate($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "getTemplate", array(0 => "history_revision_timestamp"), "method"), "SonataAdminBundle:CRUD:base_history.html.twig", 38)->display($context);
            echo "</td>
                        <td>";
            // line 39
            echo twig_escape_filter($this->env, $this->getAttribute($context["revision"], "username", array()), "html", null, true);
            echo "</td>
                        <td><a href=\"";
            // line 40
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "history_view_revision", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), 2 => array("revision" => $this->getAttribute($context["revision"], "rev", array()))), "method"), "html", null, true);
            echo "\" class=\"revision-link\" rel=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["revision"], "rev", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_view_revision", array(), "SonataAdminBundle"), "html", null, true);
            echo "</a></td>
                        <td>
                            ";
            // line 42
            if ((((isset($context["currentRevision"]) ? $context["currentRevision"] : $this->getContext($context, "currentRevision")) == false) || ($this->getAttribute($context["revision"], "rev", array()) == $this->getAttribute((isset($context["currentRevision"]) ? $context["currentRevision"] : $this->getContext($context, "currentRevision")), "rev", array())))) {
                // line 43
                echo "                                /
                            ";
            } else {
                // line 45
                echo "                                <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "history_compare_revisions", 1 => (isset($context["object"]) ? $context["object"] : $this->getContext($context, "object")), 2 => array("base_revision" => $this->getAttribute((isset($context["currentRevision"]) ? $context["currentRevision"] : $this->getContext($context, "currentRevision")), "rev", array()), "compare_revision" => $this->getAttribute($context["revision"], "rev", array()))), "method"), "html", null, true);
                echo "\" class=\"revision-compare-link\" rel=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["revision"], "rev", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("label_compare_revision", array(), "SonataAdminBundle"), "html", null, true);
                echo "</a>
                            ";
            }
            // line 47
            echo "                        </td>
                    </tr>
                ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['revision'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "            </tbody>
        </table>
    </div>
    <div id=\"revision-detail\" class=\"col-md-7 revision-detail\">

    </div>

    <script>
        jQuery(document).ready(function() {

            jQuery('a.revision-link, a.revision-compare-link').bind('click', function(event) {
                event.stopPropagation();
                event.preventDefault();

                action = jQuery(this).hasClass('revision-link')
                    ? 'show'
                    : 'compare';

                jQuery('#revision-detail').html('');

                if(action == 'show'){
                    jQuery('table#revisions tbody tr').removeClass('current');
                    jQuery(this).parent('').removeClass('current');
                }

                jQuery.ajax({
                    url: jQuery(this).attr('href'),
                    dataType: 'html',
                    success: function(data) {
                        jQuery('#revision-detail').html(data);
                    }
                });

                return false;
            });

        });
    </script>
";
        
        $__internal_14e30790b665eb4c78e73ab15940c5c6b71120fceb1bf19630b39223d17574c9->leave($__internal_14e30790b665eb4c78e73ab15940c5c6b71120fceb1bf19630b39223d17574c9_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_history.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 50,  159 => 47,  149 => 45,  145 => 43,  143 => 42,  134 => 40,  130 => 39,  126 => 38,  122 => 37,  115 => 36,  98 => 35,  91 => 31,  87 => 30,  83 => 29,  79 => 28,  75 => 27,  68 => 22,  62 => 21,  53 => 18,  49 => 17,  45 => 16,  40 => 15,  34 => 14,  19 => 12,);
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
/* {% extends base_template %}*/
/* */
/* {% block actions %}*/
/*     <li>{% include 'SonataAdminBundle:Button:edit_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:acl_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:show_button.html.twig' %}</li>*/
/*     <li>{% include 'SonataAdminBundle:Button:list_button.html.twig' %}</li>*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* */
/*     <div class="col-md-5">*/
/*         <table class="table" id="revisions">*/
/*             <thead>*/
/*                 <tr>*/
/*                     <th>{{ "td_revision"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                     <th>{{ "td_timestamp"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                     <th>{{ "td_username"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                     <th>{{ "td_action"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                     <th>{{ "td_compare"|trans({}, 'SonataAdminBundle') }}</th>*/
/*                 </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*                 {% for revision in revisions %}*/
/*                     <tr class="{% if (currentRevision != false and revision.rev == currentRevision.rev) %}current-revision{% endif %}">*/
/*                         <td>{{ revision.rev}}</td>*/
/*                         <td>{% include admin.getTemplate('history_revision_timestamp') %}</td>*/
/*                         <td>{{ revision.username}}</td>*/
/*                         <td><a href="{{ admin.generateObjectUrl('history_view_revision', object, {'revision': revision.rev }) }}" class="revision-link" rel="{{ revision.rev }}">{{ "label_view_revision"|trans({}, 'SonataAdminBundle') }}</a></td>*/
/*                         <td>*/
/*                             {% if (currentRevision == false or revision.rev == currentRevision.rev) %}*/
/*                                 /*/
/*                             {% else %}*/
/*                                 <a href="{{ admin.generateObjectUrl('history_compare_revisions', object, {'base_revision': currentRevision.rev, 'compare_revision': revision.rev }) }}" class="revision-compare-link" rel="{{ revision.rev }}">{{ "label_compare_revision"|trans({}, 'SonataAdminBundle') }}</a>*/
/*                             {% endif %}*/
/*                         </td>*/
/*                     </tr>*/
/*                 {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     </div>*/
/*     <div id="revision-detail" class="col-md-7 revision-detail">*/
/* */
/*     </div>*/
/* */
/*     <script>*/
/*         jQuery(document).ready(function() {*/
/* */
/*             jQuery('a.revision-link, a.revision-compare-link').bind('click', function(event) {*/
/*                 event.stopPropagation();*/
/*                 event.preventDefault();*/
/* */
/*                 action = jQuery(this).hasClass('revision-link')*/
/*                     ? 'show'*/
/*                     : 'compare';*/
/* */
/*                 jQuery('#revision-detail').html('');*/
/* */
/*                 if(action == 'show'){*/
/*                     jQuery('table#revisions tbody tr').removeClass('current');*/
/*                     jQuery(this).parent('').removeClass('current');*/
/*                 }*/
/* */
/*                 jQuery.ajax({*/
/*                     url: jQuery(this).attr('href'),*/
/*                     dataType: 'html',*/
/*                     success: function(data) {*/
/*                         jQuery('#revision-detail').html(data);*/
/*                     }*/
/*                 });*/
/* */
/*                 return false;*/
/*             });*/
/* */
/*         });*/
/*     </script>*/
/* {% endblock %}*/
/* */
