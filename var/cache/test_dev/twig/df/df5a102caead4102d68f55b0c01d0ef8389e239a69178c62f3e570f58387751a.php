<?php

/* SonataMediaBundle:Block:block_gallery.html.twig */
class __TwigTemplate_5ee540812f05edb484eafaa5c685feffe1a9fb610c14308a5d3e65a78dc6a97e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 11
        $this->parent = $this->loadTemplate("SonataBlockBundle:Block:block_base.html.twig", "SonataMediaBundle:Block:block_gallery.html.twig", 11);
        $this->blocks = array(
            'block' => array($this, 'block_block'),
            'element_indicator' => array($this, 'block_element_indicator'),
            'element_display' => array($this, 'block_element_display'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataBlockBundle:Block:block_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_d186a88145b3cbce1c1b484ac125d81dfed94b03e9bf9d0026e16686adddde18 = $this->env->getExtension("native_profiler");
        $__internal_d186a88145b3cbce1c1b484ac125d81dfed94b03e9bf9d0026e16686adddde18->enter($__internal_d186a88145b3cbce1c1b484ac125d81dfed94b03e9bf9d0026e16686adddde18_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataMediaBundle:Block:block_gallery.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d186a88145b3cbce1c1b484ac125d81dfed94b03e9bf9d0026e16686adddde18->leave($__internal_d186a88145b3cbce1c1b484ac125d81dfed94b03e9bf9d0026e16686adddde18_prof);

    }

    // line 13
    public function block_block($context, array $blocks = array())
    {
        $__internal_6d2e9aae7bb77f91e45387ac9358ccec44ca9e77e2c3895007ddea50845ced80 = $this->env->getExtension("native_profiler");
        $__internal_6d2e9aae7bb77f91e45387ac9358ccec44ca9e77e2c3895007ddea50845ced80->enter($__internal_6d2e9aae7bb77f91e45387ac9358ccec44ca9e77e2c3895007ddea50845ced80_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "block"));

        // line 14
        echo "    ";
        if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "format", array())) {
            // line 15
            echo "        ";
            if ($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array())) {
                // line 16
                echo "            <h3 class=\"sonata-media-block-media-title\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "title", array()), "html", null, true);
                echo "</h3>
        ";
            }
            // line 18
            echo "
        ";
            // line 19
            echo "<div class='alert alert-default alert-info'>
    <strong>This is the gallery media block. Feel free to override it.</strong>
    <div>This file can be found in <code>{$this->getTemplateName()}</code>.</div>
</div>";            // line 20
            echo "
        <div id=\"carousel-";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo "\" class=\"carousel slide sonata-media-block-gallery-container\"
             data-interval=\"";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "pauseTime", array()), "html", null, true);
            echo "\"
             ";
            // line 23
            if (($this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "startPaused", array()) != 1)) {
                echo "data-ride=\"carousel\"";
            }
            // line 24
            echo "                >

            <!-- Indicators -->
            <ol class=\"carousel-indicators\">
                ";
            // line 28
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["elements"]) ? $context["elements"] : $this->getContext($context, "elements")));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 29
                echo "                    ";
                $this->displayBlock("element_indicator", $context, $blocks);
                echo "
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 31
            echo "            </ol>

            <!-- Wrapper for slides -->
            <div class=\"carousel-inner\">
                ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["elements"]) ? $context["elements"] : $this->getContext($context, "elements")));
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
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                // line 36
                echo "                    ";
                $this->displayBlock("element_display", $context, $blocks);
                echo "
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 38
            echo "            </div>

            <!-- Controls -->
            <a class=\"left carousel-control\" href=\"#carousel-";
            // line 41
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo "\" data-slide=\"prev\">
                <span class=\"glyphicon glyphicon-chevron-left\"></span>
            </a>
            <a class=\"right carousel-control\" href=\"#carousel-";
            // line 44
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
            echo "\" data-slide=\"next\">
                <span class=\"glyphicon glyphicon-chevron-right\"></span>
            </a>
        </div>
    ";
        }
        
        $__internal_6d2e9aae7bb77f91e45387ac9358ccec44ca9e77e2c3895007ddea50845ced80->leave($__internal_6d2e9aae7bb77f91e45387ac9358ccec44ca9e77e2c3895007ddea50845ced80_prof);

    }

    // line 51
    public function block_element_indicator($context, array $blocks = array())
    {
        $__internal_fe2c80c02874b4c7a20bc4252ffe9b84a5dc99434f50a97862571e0772672264 = $this->env->getExtension("native_profiler");
        $__internal_fe2c80c02874b4c7a20bc4252ffe9b84a5dc99434f50a97862571e0772672264->enter($__internal_fe2c80c02874b4c7a20bc4252ffe9b84a5dc99434f50a97862571e0772672264_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "element_indicator"));

        // line 52
        echo "    <li data-target=\"#carousel-";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : $this->getContext($context, "block")), "id", array()), "html", null, true);
        echo "\" data-slide-to=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "index0", array()), "html", null, true);
        echo "\"";
        if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "first", array())) {
            echo " class=\"active\"";
        }
        echo "></li>
";
        
        $__internal_fe2c80c02874b4c7a20bc4252ffe9b84a5dc99434f50a97862571e0772672264->leave($__internal_fe2c80c02874b4c7a20bc4252ffe9b84a5dc99434f50a97862571e0772672264_prof);

    }

    // line 55
    public function block_element_display($context, array $blocks = array())
    {
        $__internal_b9d0c24a8475896c11415284666c7b3fabfd9d2704028bda7c32d443f4017408 = $this->env->getExtension("native_profiler");
        $__internal_b9d0c24a8475896c11415284666c7b3fabfd9d2704028bda7c32d443f4017408->enter($__internal_b9d0c24a8475896c11415284666c7b3fabfd9d2704028bda7c32d443f4017408_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "element_display"));

        // line 56
        echo "    <div class=\"item";
        if ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : $this->getContext($context, "loop")), "first", array())) {
            echo " active";
        }
        echo "\">
        ";
        // line 57
        echo $this->env->getExtension('sonata_media')->media($this->getAttribute((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), "media", array()), $this->getAttribute((isset($context["settings"]) ? $context["settings"] : $this->getContext($context, "settings")), "format", array()), array());
        // line 58
        echo "        <div class=\"carousel-caption\">
            <h4>";
        // line 59
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), "title", array()), "html", null, true);
        echo "</h4>
            <p>";
        // line 60
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["element"]) ? $context["element"] : $this->getContext($context, "element")), "caption", array()), "html", null, true);
        echo "</p>
        </div>
    </div>
";
        
        $__internal_b9d0c24a8475896c11415284666c7b3fabfd9d2704028bda7c32d443f4017408->leave($__internal_b9d0c24a8475896c11415284666c7b3fabfd9d2704028bda7c32d443f4017408_prof);

    }

    public function getTemplateName()
    {
        return "SonataMediaBundle:Block:block_gallery.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  224 => 60,  220 => 59,  217 => 58,  215 => 57,  208 => 56,  202 => 55,  186 => 52,  180 => 51,  167 => 44,  161 => 41,  156 => 38,  139 => 36,  122 => 35,  116 => 31,  99 => 29,  82 => 28,  76 => 24,  72 => 23,  68 => 22,  64 => 21,  61 => 20,  57 => 19,  54 => 18,  48 => 16,  45 => 15,  42 => 14,  36 => 13,  11 => 11,);
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
/* {% extends 'SonataBlockBundle:Block:block_base.html.twig' %}*/
/* */
/* {% block block %}*/
/*     {% if settings.format %}*/
/*         {% if settings.title %}*/
/*             <h3 class="sonata-media-block-media-title">{{ settings.title }}</h3>*/
/*         {% endif %}*/
/* */
/*         {% sonata_template_box 'sonata_template_box_media_gallery_block' 'SonataMediaBundle' %}*/
/* */
/*         <div id="carousel-{{ block.id }}" class="carousel slide sonata-media-block-gallery-container"*/
/*              data-interval="{{ settings.pauseTime }}"*/
/*              {% if settings.startPaused != 1 %}data-ride="carousel"{% endif %}*/
/*                 >*/
/* */
/*             <!-- Indicators -->*/
/*             <ol class="carousel-indicators">*/
/*                 {% for element in elements %}*/
/*                     {{ block('element_indicator') }}*/
/*                 {% endfor %}*/
/*             </ol>*/
/* */
/*             <!-- Wrapper for slides -->*/
/*             <div class="carousel-inner">*/
/*                 {% for element in elements %}*/
/*                     {{ block('element_display') }}*/
/*                 {% endfor %}*/
/*             </div>*/
/* */
/*             <!-- Controls -->*/
/*             <a class="left carousel-control" href="#carousel-{{ block.id }}" data-slide="prev">*/
/*                 <span class="glyphicon glyphicon-chevron-left"></span>*/
/*             </a>*/
/*             <a class="right carousel-control" href="#carousel-{{ block.id }}" data-slide="next">*/
/*                 <span class="glyphicon glyphicon-chevron-right"></span>*/
/*             </a>*/
/*         </div>*/
/*     {% endif %}*/
/* {% endblock %}*/
/* */
/* {% block element_indicator %}*/
/*     <li data-target="#carousel-{{ block.id }}" data-slide-to="{{ loop.index0 }}"{% if loop.first %} class="active"{% endif %}></li>*/
/* {% endblock element_indicator %}*/
/* */
/* {% block element_display %}*/
/*     <div class="item{% if loop.first %} active{% endif %}">*/
/*         {% media element.media, settings.format %}*/
/*         <div class="carousel-caption">*/
/*             <h4>{{ element.title }}</h4>*/
/*             <p>{{ element.caption }}</p>*/
/*         </div>*/
/*     </div>*/
/* {% endblock element_display %}*/
