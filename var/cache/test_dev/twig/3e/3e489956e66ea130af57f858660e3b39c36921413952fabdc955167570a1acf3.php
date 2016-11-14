<?php

/* SonataAdminBundle:Core:dashboard.html.twig */
class __TwigTemplate_3933cdd6f9f8a9f3dd1fbd1fd5d10b6878195d343af217fb87567a1a1c017bf0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'breadcrumb' => array($this, 'block_breadcrumb'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "SonataAdminBundle:Core:dashboard.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_690229bc7439fcc8aa1b75e95fda4b604518db0791012cc8949236f6e05d0690 = $this->env->getExtension("native_profiler");
        $__internal_690229bc7439fcc8aa1b75e95fda4b604518db0791012cc8949236f6e05d0690->enter($__internal_690229bc7439fcc8aa1b75e95fda4b604518db0791012cc8949236f6e05d0690_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle:Core:dashboard.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_690229bc7439fcc8aa1b75e95fda4b604518db0791012cc8949236f6e05d0690->leave($__internal_690229bc7439fcc8aa1b75e95fda4b604518db0791012cc8949236f6e05d0690_prof);

    }

    // line 14
    public function block_title($context, array $blocks = array())
    {
        $__internal_0f844ddbad4325544e6e6365a89ab3c1a6629bb02f8da93a3a42babf84b8419b = $this->env->getExtension("native_profiler");
        $__internal_0f844ddbad4325544e6e6365a89ab3c1a6629bb02f8da93a3a42babf84b8419b->enter($__internal_0f844ddbad4325544e6e6365a89ab3c1a6629bb02f8da93a3a42babf84b8419b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("title_dashboard", array(), "SonataAdminBundle"), "html", null, true);
        
        $__internal_0f844ddbad4325544e6e6365a89ab3c1a6629bb02f8da93a3a42babf84b8419b->leave($__internal_0f844ddbad4325544e6e6365a89ab3c1a6629bb02f8da93a3a42babf84b8419b_prof);

    }

    // line 15
    public function block_breadcrumb($context, array $blocks = array())
    {
        $__internal_569d53658adcc759d1e5c6c1b71b727a1aa7b290ce3946937e212bb4fcdec9be = $this->env->getExtension("native_profiler");
        $__internal_569d53658adcc759d1e5c6c1b71b727a1aa7b290ce3946937e212bb4fcdec9be->enter($__internal_569d53658adcc759d1e5c6c1b71b727a1aa7b290ce3946937e212bb4fcdec9be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "breadcrumb"));

        
        $__internal_569d53658adcc759d1e5c6c1b71b727a1aa7b290ce3946937e212bb4fcdec9be->leave($__internal_569d53658adcc759d1e5c6c1b71b727a1aa7b290ce3946937e212bb4fcdec9be_prof);

    }

    // line 16
    public function block_content($context, array $blocks = array())
    {
        $__internal_ad9506c855a3e9c6088816245f4e2d144a18785ff05b50d88ca7f51e9d7c0373 = $this->env->getExtension("native_profiler");
        $__internal_ad9506c855a3e9c6088816245f4e2d144a18785ff05b50d88ca7f51e9d7c0373->enter($__internal_ad9506c855a3e9c6088816245f4e2d144a18785ff05b50d88ca7f51e9d7c0373_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 17
        echo "
    ";
        // line 18
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.dashboard.top", array("admin_pool" => (isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")))));
        echo "

    ";
        // line 20
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "top", array())) > 0)) {
            // line 21
            echo "        <div class=\"row\">
            ";
            // line 22
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "top", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 23
                echo "                <div class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "class", array()), "html", null, true);
                echo "\">
                    ";
                // line 24
                echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                echo "
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 27
            echo "        </div>
    ";
        }
        // line 29
        echo "
    <div class=\"row\">
        ";
        // line 31
        $context["has_center"] = false;
        // line 32
        echo "
        <div class=\"";
        // line 33
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "center", array())) > 0)) {
            echo "col-md-4";
        } else {
            echo "col-md-6";
        }
        echo "\">
            ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "left", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 35
            echo "                ";
            echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "        </div>

        ";
        // line 39
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "center", array())) > 0)) {
            // line 40
            echo "            <div class=\"col-md-4\">
                ";
            // line 41
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "center", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 42
                echo "                    ";
                echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                echo "
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 44
            echo "            </div>
        ";
        }
        // line 46
        echo "
        <div class=\"";
        // line 47
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "center", array())) > 0)) {
            echo "col-md-4";
        } else {
            echo "col-md-6";
        }
        echo "\">
            ";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "right", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
            // line 49
            echo "                ";
            echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
            echo "
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "        </div>
    </div>

    ";
        // line 54
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "bottom", array())) > 0)) {
            // line 55
            echo "        <div class=\"row\">
            ";
            // line 56
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["blocks"]) ? $context["blocks"] : $this->getContext($context, "blocks")), "bottom", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["block"]) {
                // line 57
                echo "                <div class=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["block"], "class", array()), "html", null, true);
                echo "\">
                    ";
                // line 58
                echo call_user_func_array($this->env->getFunction('sonata_block_render')->getCallable(), array(array("type" => $this->getAttribute($context["block"], "type", array()), "settings" => $this->getAttribute($context["block"], "settings", array()))));
                echo "
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['block'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 61
            echo "        </div>
    ";
        }
        // line 63
        echo "


    ";
        // line 66
        echo call_user_func_array($this->env->getFunction('sonata_block_render_event')->getCallable(), array("sonata.admin.dashboard.bottom", array("admin_pool" => (isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")))));
        echo "

";
        
        $__internal_ad9506c855a3e9c6088816245f4e2d144a18785ff05b50d88ca7f51e9d7c0373->leave($__internal_ad9506c855a3e9c6088816245f4e2d144a18785ff05b50d88ca7f51e9d7c0373_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:Core:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  216 => 66,  211 => 63,  207 => 61,  198 => 58,  193 => 57,  189 => 56,  186 => 55,  184 => 54,  179 => 51,  170 => 49,  166 => 48,  158 => 47,  155 => 46,  151 => 44,  142 => 42,  138 => 41,  135 => 40,  133 => 39,  129 => 37,  120 => 35,  116 => 34,  108 => 33,  105 => 32,  103 => 31,  99 => 29,  95 => 27,  86 => 24,  81 => 23,  77 => 22,  74 => 21,  72 => 20,  67 => 18,  64 => 17,  58 => 16,  47 => 15,  35 => 14,  20 => 12,);
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
/* {% block title %}{{ 'title_dashboard'|trans({}, 'SonataAdminBundle') }}{% endblock%}*/
/* {% block breadcrumb %}{% endblock %}*/
/* {% block content %}*/
/* */
/*     {{ sonata_block_render_event('sonata.admin.dashboard.top', { 'admin_pool': admin_pool }) }}*/
/* */
/*     {% if blocks.top|length > 0 %}*/
/*         <div class="row">*/
/*             {% for block in blocks.top %}*/
/*                 <div class="{{ block.class }}">*/
/*                     {{ sonata_block_render({ 'type': block.type, 'settings': block.settings}) }}*/
/*                 </div>*/
/*             {% endfor %}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/*     <div class="row">*/
/*         {% set has_center = false %}*/
/* */
/*         <div class="{% if blocks.center|length > 0 %}col-md-4{% else %}col-md-6{% endif %}">*/
/*             {% for block in blocks.left %}*/
/*                 {{ sonata_block_render({ 'type': block.type, 'settings': block.settings}) }}*/
/*             {% endfor %}*/
/*         </div>*/
/* */
/*         {% if blocks.center|length > 0 %}*/
/*             <div class="col-md-4">*/
/*                 {% for block in blocks.center %}*/
/*                     {{ sonata_block_render({ 'type': block.type, 'settings': block.settings}) }}*/
/*                 {% endfor %}*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         <div class="{% if blocks.center|length > 0 %}col-md-4{% else %}col-md-6{% endif %}">*/
/*             {% for block in blocks.right %}*/
/*                 {{ sonata_block_render({ 'type': block.type, 'settings': block.settings}) }}*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* */
/*     {% if blocks.bottom|length > 0 %}*/
/*         <div class="row">*/
/*             {% for block in blocks.bottom %}*/
/*                 <div class="{{ block.class }}">*/
/*                     {{ sonata_block_render({ 'type': block.type, 'settings': block.settings}) }}*/
/*                 </div>*/
/*             {% endfor %}*/
/*         </div>*/
/*     {% endif %}*/
/* */
/* */
/* */
/*     {{ sonata_block_render_event('sonata.admin.dashboard.bottom', { 'admin_pool': admin_pool }) }}*/
/* */
/* {% endblock %}*/
/* */
