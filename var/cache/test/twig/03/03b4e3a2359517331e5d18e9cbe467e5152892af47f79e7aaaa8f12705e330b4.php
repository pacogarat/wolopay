<?php

/* SonataAdminBundle:Block:block_search_result.html.twig */
class __TwigTemplate_e0d434ab507266f822691f84204c9df2dd93ea69b60372f48ae75273f7ce1bcb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'block' => array($this, 'block_block'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute($this->getAttribute((isset($context["sonata_block"]) ? $context["sonata_block"] : $this->getContext($context, "sonata_block")), "templates", array()), "block_base", array()), "SonataAdminBundle:Block:block_search_result.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_10d1e5ea289c9bfe97e08c9ed9c511b17b56eea1c8af6ebe78bb4a0fd1414b0c = $this->env->getExtension("native_profiler");
        $__internal_10d1e5ea289c9bfe97e08c9ed9c511b17b56eea1c8af6ebe78bb4a0fd1414b0c->enter($__internal_10d1e5ea289c9bfe97e08c9ed9c511b17b56eea1c8af6ebe78bb4a0fd1414b0c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Block:block_search_result.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_10d1e5ea289c9bfe97e08c9ed9c511b17b56eea1c8af6ebe78bb4a0fd1414b0c->leave($__internal_10d1e5ea289c9bfe97e08c9ed9c511b17b56eea1c8af6ebe78bb4a0fd1414b0c_prof);

    }

    // line 14
    public function block_block($context, array $blocks = array())
    {
        $__internal_48175fff48a556cbd2c073344707bad0daa950a259df130025a47906cca63d46 = $this->env->getExtension("native_profiler");
        $__internal_48175fff48a556cbd2c073344707bad0daa950a259df130025a47906cca63d46->enter($__internal_48175fff48a556cbd2c073344707bad0daa950a259df130025a47906cca63d46_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 15
        echo "    <div class=\"col-md-3\">
        <div>
            <h4>
                ";
        // line 18
        if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "list"), "method")) {
            // line 19
            echo "                    <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "list"), "method"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "label", array()), array(), $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "translationdomain", array())), "html", null, true);
            echo "</a>
                ";
        } else {
            // line 21
            echo "                    ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "label", array()), array(), $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "translationdomain", array())), "html", null, true);
            echo "
                ";
        }
        // line 23
        echo "
                ";
        // line 24
        if (((isset($context["pager"]) ? $context["pager"] : $this->getContext($context, "pager")) && ($this->getAttribute((isset($context["pager"]) ? $context["pager"] : $this->getContext($context, "pager")), "getNbResults", array(), "method") > 0))) {
            // line 25
            echo "                    <span class=\"label label-info\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["pager"]) ? $context["pager"] : $this->getContext($context, "pager")), "getNbResults", array(), "method"), "html", null, true);
            echo "</span>
                ";
        }
        // line 27
        echo "            </h4>
        </div>

        <ul>
            ";
        // line 31
        if ((isset($context["pager"]) ? $context["pager"] : $this->getContext($context, "pager"))) {
            // line 32
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["pager"]) ? $context["pager"] : $this->getContext($context, "pager")), "getResults", array(), "method"));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["result"]) {
                // line 33
                echo "                    ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "edit"), "method")) {
                    // line 34
                    echo "                        <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateObjectUrl", array(0 => "edit", 1 => $context["result"]), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "toString", array(0 => $context["result"]), "method"), "html", null, true);
                    echo "</a></li>
                    ";
                } else {
                    // line 36
                    echo "                        <li><i>";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "toString", array(0 => $context["result"]), "method"), "html", null, true);
                    echo "</i></li>
                    ";
                }
                // line 38
                echo "                ";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 39
                echo "                    ";
                if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "create"), "method")) {
                    // line 40
                    echo "                        <li><i>";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_results_found", array(), "SonataAdminBundle"), "html", null, true);
                    echo " ~ <a href=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("add_new_entry", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</a></i></li>
                    ";
                } else {
                    // line 42
                    echo "                        <li><i>";
                    echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_results_found", array(), "SonataAdminBundle"), "html", null, true);
                    echo "</i></li>
                    ";
                }
                // line 44
                echo "                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['result'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            echo "            ";
        } else {
            // line 46
            echo "                ";
            if ($this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "hasRoute", array(0 => "create"), "method")) {
                // line 47
                echo "                    <li><i>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_results_found", array(), "SonataAdminBundle"), "html", null, true);
                echo " ~ <a href=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : $this->getContext($context, "admin")), "generateUrl", array(0 => "create"), "method"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("add_new_entry", array(), "SonataAdminBundle"), "html", null, true);
                echo "</a></i></li>
                ";
            } else {
                // line 49
                echo "                    <li><i>";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_results_found", array(), "SonataAdminBundle"), "html", null, true);
                echo "</i></li>
                ";
            }
            // line 51
            echo "            ";
        }
        // line 52
        echo "        </ul>
    </div>
";
        
        $__internal_48175fff48a556cbd2c073344707bad0daa950a259df130025a47906cca63d46->leave($__internal_48175fff48a556cbd2c073344707bad0daa950a259df130025a47906cca63d46_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Block:block_search_result.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 52,  154 => 51,  148 => 49,  138 => 47,  135 => 46,  132 => 45,  126 => 44,  120 => 42,  110 => 40,  107 => 39,  102 => 38,  96 => 36,  88 => 34,  85 => 33,  79 => 32,  77 => 31,  71 => 27,  65 => 25,  63 => 24,  60 => 23,  54 => 21,  46 => 19,  44 => 18,  39 => 15,  33 => 14,  18 => 12,);
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
/* {% extends sonata_block.templates.block_base %}*/
/* */
/* {% block block %}*/
/*     <div class="col-md-3">*/
/*         <div>*/
/*             <h4>*/
/*                 {% if admin.hasRoute('list') %}*/
/*                     <a href="{{ admin.generateUrl('list') }}">{{ admin.label|trans({}, admin.translationdomain) }}</a>*/
/*                 {% else %}*/
/*                     {{ admin.label|trans({}, admin.translationdomain) }}*/
/*                 {% endif %}*/
/* */
/*                 {% if pager and pager.getNbResults() > 0 %}*/
/*                     <span class="label label-info">{{ pager.getNbResults() }}</span>*/
/*                 {% endif %}*/
/*             </h4>*/
/*         </div>*/
/* */
/*         <ul>*/
/*             {% if pager %}*/
/*                 {% for result in pager.getResults() %}*/
/*                     {% if admin.hasRoute('edit') %}*/
/*                         <li><a href="{{ admin.generateObjectUrl('edit', result) }}">{{ admin.toString(result) }}</a></li>*/
/*                     {% else %}*/
/*                         <li><i>{{ admin.toString(result) }}</i></li>*/
/*                     {% endif %}*/
/*                 {% else %}*/
/*                     {% if admin.hasRoute('create') %}*/
/*                         <li><i>{{ 'no_results_found'|trans({}, 'SonataAdminBundle') }} ~ <a href="{{ admin.generateUrl('create') }}">{{ 'add_new_entry'|trans({}, 'SonataAdminBundle') }}</a></i></li>*/
/*                     {% else %}*/
/*                         <li><i>{{ 'no_results_found'|trans({}, 'SonataAdminBundle') }}</i></li>*/
/*                     {% endif %}*/
/*                 {% endfor %}*/
/*             {% else %}*/
/*                 {% if admin.hasRoute('create') %}*/
/*                     <li><i>{{ 'no_results_found'|trans({}, 'SonataAdminBundle') }} ~ <a href="{{ admin.generateUrl('create') }}">{{ 'add_new_entry'|trans({}, 'SonataAdminBundle') }}</a></i></li>*/
/*                 {% else %}*/
/*                     <li><i>{{ 'no_results_found'|trans({}, 'SonataAdminBundle') }}</i></li>*/
/*                 {% endif %}*/
/*             {% endif %}*/
/*         </ul>*/
/*     </div>*/
/* {% endblock %}*/
/* */
