<?php

/* BraincraftedBootstrapBundle:Bootstrap:bootstrap.less.twig */
class __TwigTemplate_9658f2e9a7e7dc42cd183387fd876fa4a5682d7c06215ac79210f8ffbd17e9a0 extends Twig_Template
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
        $__internal_83f9f7afd5fb39815da1d98395155f308225a340deaf16bfbc7511721b3b02a8 = $this->env->getExtension("native_profiler");
        $__internal_83f9f7afd5fb39815da1d98395155f308225a340deaf16bfbc7511721b3b02a8->enter($__internal_83f9f7afd5fb39815da1d98395155f308225a340deaf16bfbc7511721b3b02a8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "BraincraftedBootstrapBundle:Bootstrap:bootstrap.less.twig"));

        // line 1
        echo "/*!
 * Bootstrap v3.0.0
 *
 * Copyright 2013 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world by @mdo and @fat.
 */

// Core variables and mixins
@import \"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/variables.less\";
@import \"";
        // line 13
        echo twig_escape_filter($this->env, (isset($context["variables_file"]) ? $context["variables_file"] : $this->getContext($context, "variables_file")), "html", null, true);
        echo "\";
@import \"";
        // line 14
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/mixins.less\";

// Reset
@import \"";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/normalize.less\";
@import \"";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/print.less\";

// Core CSS
@import \"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/scaffolding.less\";
@import \"";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/type.less\";
@import \"";
        // line 23
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/code.less\";
@import \"";
        // line 24
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/grid.less\";
@import \"";
        // line 25
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/tables.less\";
@import \"";
        // line 26
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/forms.less\";
@import \"";
        // line 27
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/buttons.less\";

// Components
@import \"";
        // line 30
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/component-animations.less\";
@import \"";
        // line 31
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/glyphicons.less\";
@import \"";
        // line 32
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/dropdowns.less\";
@import \"";
        // line 33
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/button-groups.less\";
@import \"";
        // line 34
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/input-groups.less\";
@import \"";
        // line 35
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/navs.less\";
@import \"";
        // line 36
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/navbar.less\";
@import \"";
        // line 37
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/breadcrumbs.less\";
@import \"";
        // line 38
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/pagination.less\";
@import \"";
        // line 39
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/pager.less\";
@import \"";
        // line 40
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/labels.less\";
@import \"";
        // line 41
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/badges.less\";
@import \"";
        // line 42
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/jumbotron.less\";
@import \"";
        // line 43
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/thumbnails.less\";
@import \"";
        // line 44
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/alerts.less\";
@import \"";
        // line 45
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/progress-bars.less\";
@import \"";
        // line 46
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/media.less\";
@import \"";
        // line 47
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/list-group.less\";
@import \"";
        // line 48
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/panels.less\";
@import \"";
        // line 49
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/wells.less\";
@import \"";
        // line 50
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/close.less\";
@import \"";
        // line 51
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/responsive-embed.less\";

// Components w/ JavaScript
@import \"";
        // line 54
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/modals.less\";
@import \"";
        // line 55
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/tooltip.less\";
@import \"";
        // line 56
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/popovers.less\";
@import \"";
        // line 57
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/carousel.less\";

// Utility classes
@import \"";
        // line 60
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/utilities.less\";
@import \"";
        // line 61
        echo twig_escape_filter($this->env, (isset($context["assets_dir"]) ? $context["assets_dir"] : $this->getContext($context, "assets_dir")), "html", null, true);
        echo "less/responsive-utilities.less\";
";
        
        $__internal_83f9f7afd5fb39815da1d98395155f308225a340deaf16bfbc7511721b3b02a8->leave($__internal_83f9f7afd5fb39815da1d98395155f308225a340deaf16bfbc7511721b3b02a8_prof);

    }

    public function getTemplateName()
    {
        return "BraincraftedBootstrapBundle:Bootstrap:bootstrap.less.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  201 => 61,  197 => 60,  191 => 57,  187 => 56,  183 => 55,  179 => 54,  173 => 51,  169 => 50,  165 => 49,  161 => 48,  157 => 47,  153 => 46,  149 => 45,  145 => 44,  141 => 43,  137 => 42,  133 => 41,  129 => 40,  125 => 39,  121 => 38,  117 => 37,  113 => 36,  109 => 35,  105 => 34,  101 => 33,  97 => 32,  93 => 31,  89 => 30,  83 => 27,  79 => 26,  75 => 25,  71 => 24,  67 => 23,  63 => 22,  59 => 21,  53 => 18,  49 => 17,  43 => 14,  39 => 13,  35 => 12,  22 => 1,);
    }
}
/* /*!*/
/*  * Bootstrap v3.0.0*/
/*  **/
/*  * Copyright 2013 Twitter, Inc*/
/*  * Licensed under the Apache License v2.0*/
/*  * http://www.apache.org/licenses/LICENSE-2.0*/
/*  **/
/*  * Designed and built with all the love in the world by @mdo and @fat.*/
/*  *//* */
/* */
/* // Core variables and mixins*/
/* @import "{{ assets_dir }}less/variables.less";*/
/* @import "{{ variables_file }}";*/
/* @import "{{ assets_dir }}less/mixins.less";*/
/* */
/* // Reset*/
/* @import "{{ assets_dir }}less/normalize.less";*/
/* @import "{{ assets_dir }}less/print.less";*/
/* */
/* // Core CSS*/
/* @import "{{ assets_dir }}less/scaffolding.less";*/
/* @import "{{ assets_dir }}less/type.less";*/
/* @import "{{ assets_dir }}less/code.less";*/
/* @import "{{ assets_dir }}less/grid.less";*/
/* @import "{{ assets_dir }}less/tables.less";*/
/* @import "{{ assets_dir }}less/forms.less";*/
/* @import "{{ assets_dir }}less/buttons.less";*/
/* */
/* // Components*/
/* @import "{{ assets_dir }}less/component-animations.less";*/
/* @import "{{ assets_dir }}less/glyphicons.less";*/
/* @import "{{ assets_dir }}less/dropdowns.less";*/
/* @import "{{ assets_dir }}less/button-groups.less";*/
/* @import "{{ assets_dir }}less/input-groups.less";*/
/* @import "{{ assets_dir }}less/navs.less";*/
/* @import "{{ assets_dir }}less/navbar.less";*/
/* @import "{{ assets_dir }}less/breadcrumbs.less";*/
/* @import "{{ assets_dir }}less/pagination.less";*/
/* @import "{{ assets_dir }}less/pager.less";*/
/* @import "{{ assets_dir }}less/labels.less";*/
/* @import "{{ assets_dir }}less/badges.less";*/
/* @import "{{ assets_dir }}less/jumbotron.less";*/
/* @import "{{ assets_dir }}less/thumbnails.less";*/
/* @import "{{ assets_dir }}less/alerts.less";*/
/* @import "{{ assets_dir }}less/progress-bars.less";*/
/* @import "{{ assets_dir }}less/media.less";*/
/* @import "{{ assets_dir }}less/list-group.less";*/
/* @import "{{ assets_dir }}less/panels.less";*/
/* @import "{{ assets_dir }}less/wells.less";*/
/* @import "{{ assets_dir }}less/close.less";*/
/* @import "{{ assets_dir }}less/responsive-embed.less";*/
/* */
/* // Components w/ JavaScript*/
/* @import "{{ assets_dir }}less/modals.less";*/
/* @import "{{ assets_dir }}less/tooltip.less";*/
/* @import "{{ assets_dir }}less/popovers.less";*/
/* @import "{{ assets_dir }}less/carousel.less";*/
/* */
/* // Utility classes*/
/* @import "{{ assets_dir }}less/utilities.less";*/
/* @import "{{ assets_dir }}less/responsive-utilities.less";*/
/* */
