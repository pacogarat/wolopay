<?php

/* AppBundle:Sonata:media_widgets_show.html.twig */
class __TwigTemplate_0272a0a2c9a28d4914e6a24e8f2c2d99313c5b9c3f81a75a718ed53f39b69e18 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("SonataAdminBundle:CRUD:base_show_field.html.twig", "AppBundle:Sonata:media_widgets_show.html.twig", 1);
        $this->blocks = array(
            'field' => array($this, 'block_field'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SonataAdminBundle:CRUD:base_show_field.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_f3944cb50f7f167846d2932e96267055e5a786bbc8ff32043eb4b1db55ec0ae9 = $this->env->getExtension("native_profiler");
        $__internal_f3944cb50f7f167846d2932e96267055e5a786bbc8ff32043eb4b1db55ec0ae9->enter($__internal_f3944cb50f7f167846d2932e96267055e5a786bbc8ff32043eb4b1db55ec0ae9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Sonata:media_widgets_show.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f3944cb50f7f167846d2932e96267055e5a786bbc8ff32043eb4b1db55ec0ae9->leave($__internal_f3944cb50f7f167846d2932e96267055e5a786bbc8ff32043eb4b1db55ec0ae9_prof);

    }

    // line 3
    public function block_field($context, array $blocks = array())
    {
        $__internal_eb0e1497ffadaf9037fa47c6a921bf8c6f9a92ed501c5aa727f352fa8018329d = $this->env->getExtension("native_profiler");
        $__internal_eb0e1497ffadaf9037fa47c6a921bf8c6f9a92ed501c5aa727f352fa8018329d->enter($__internal_eb0e1497ffadaf9037fa47c6a921bf8c6f9a92ed501c5aa727f352fa8018329d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "field"));

        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "
        ";
        // line 6
        if ((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) {
            // line 7
            echo "            <div class=\"pull-left\" style=\"margin-right: 20px\">
                <a href=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))), "html", null, true);
            echo "\" download>
                    ";
            // line 9
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "admin", array("class" => "img-polaroid media-object"));
            // line 10
            echo "                </a>
            </div>
            <div style=\"padding-top: 20px\">
                <a href=\"";
            // line 13
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))), "html", null, true);
            echo "\" download>
                    <i class=\"fa fa-download\"></i>
                    Download ";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "name", array()), "html", null, true);
            echo "
                </a>
            </div>
            ";
            // line 18
            if ((array_key_exists("sonata_admin_enabled", $context) && (isset($context["sonata_admin_enabled"]) ? $context["sonata_admin_enabled"] : $this->getContext($context, "sonata_admin_enabled")))) {
                // line 19
                echo "            <div style=\"padding-top: 20px\">
                <a href=\"";
                // line 20
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_sonata_media_media_edit", array("id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))), "html", null, true);
                echo "\">
                    <i class=\"fa fa-info-circle\"></i>
                    More info about this file ";
                // line 22
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "name", array()), "html", null, true);
                echo "
                </a>

            </div>
            ";
            }
            // line 27
            echo "        ";
        } else {
            // line 28
            echo "            No data
        ";
        }
        // line 30
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_eb0e1497ffadaf9037fa47c6a921bf8c6f9a92ed501c5aa727f352fa8018329d->leave($__internal_eb0e1497ffadaf9037fa47c6a921bf8c6f9a92ed501c5aa727f352fa8018329d_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Sonata:media_widgets_show.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  98 => 30,  94 => 28,  91 => 27,  83 => 22,  78 => 20,  75 => 19,  73 => 18,  67 => 15,  62 => 13,  57 => 10,  55 => 9,  51 => 8,  48 => 7,  46 => 6,  43 => 5,  40 => 4,  34 => 3,  11 => 1,);
    }
}
/* {% extends 'SonataAdminBundle:CRUD:base_show_field.html.twig' %}*/
/* */
/* {% block field %}*/
/*     {% spaceless %}*/
/* */
/*         {% if value %}*/
/*             <div class="pull-left" style="margin-right: 20px">*/
/*                 <a href="{{ path('sonata_media_download', {'id': value.id }) }}" download>*/
/*                     {% thumbnail value, 'admin' with {'class': 'img-polaroid media-object'} %}*/
/*                 </a>*/
/*             </div>*/
/*             <div style="padding-top: 20px">*/
/*                 <a href="{{ path('sonata_media_download', {'id': value.id }) }}" download>*/
/*                     <i class="fa fa-download"></i>*/
/*                     Download {{value.name}}*/
/*                 </a>*/
/*             </div>*/
/*             {% if sonata_admin_enabled is defined and sonata_admin_enabled %}*/
/*             <div style="padding-top: 20px">*/
/*                 <a href="{{ url('admin_sonata_media_media_edit', {id: value.id}) }}">*/
/*                     <i class="fa fa-info-circle"></i>*/
/*                     More info about this file {{ value.name }}*/
/*                 </a>*/
/* */
/*             </div>*/
/*             {% endif %}*/
/*         {% else %}*/
/*             No data*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock %}*/
/* */
