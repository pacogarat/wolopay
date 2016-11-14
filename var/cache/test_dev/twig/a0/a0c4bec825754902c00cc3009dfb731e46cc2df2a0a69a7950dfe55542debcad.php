<?php

/* :Sonata:media_widgets.html.twig */
class __TwigTemplate_7baf8de7274a87ef1f4d448a7f7f6720e0b251ffab3f024873c2219e8128c6a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sonata_media_type_widget' => array($this, 'block_sonata_media_type_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_aa47bb4d425b3300d2919701a23a15efbb4d52e3aef67ddc72e06935cc6dae77 = $this->env->getExtension("native_profiler");
        $__internal_aa47bb4d425b3300d2919701a23a15efbb4d52e3aef67ddc72e06935cc6dae77->enter($__internal_aa47bb4d425b3300d2919701a23a15efbb4d52e3aef67ddc72e06935cc6dae77_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", ":Sonata:media_widgets.html.twig"));

        // line 1
        $this->displayBlock('sonata_media_type_widget', $context, $blocks);
        
        $__internal_aa47bb4d425b3300d2919701a23a15efbb4d52e3aef67ddc72e06935cc6dae77->leave($__internal_aa47bb4d425b3300d2919701a23a15efbb4d52e3aef67ddc72e06935cc6dae77_prof);

    }

    public function block_sonata_media_type_widget($context, array $blocks = array())
    {
        $__internal_501df8fc417bcc9a0b458eb9643ab38fe785d8d6500155ea8a03482fb19642a5 = $this->env->getExtension("native_profiler");
        $__internal_501df8fc417bcc9a0b458eb9643ab38fe785d8d6500155ea8a03482fb19642a5->enter($__internal_501df8fc417bcc9a0b458eb9643ab38fe785d8d6500155ea8a03482fb19642a5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_media_type_widget"));

        // line 2
        echo "    <div style=\"display: inline-block;\">
        <div class=\"col-md-12\" style=\"padding-bottom: 20px\">
            <div class=\"pull-left\" style=\"max-width: 50%; \">
                ";
        // line 5
        if ((( !twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value"))) && $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "providerReference", array())) && $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))) {
            // line 6
            echo "                    <div class=\"pull-left\" style=\"margin-right: 5px\">
                        ";
            // line 7
            echo $this->env->getExtension('sonata_media')->thumbnail((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "admin", array("class" => "img-polaroid media-object"));
            // line 8
            echo "                    </div>
                    <div class=\"pull-left\" style=\"margin-right: 5px;max-width: 60%;overflow: hidden;\">
                        ";
            // line 10
            if ((array_key_exists("sonata_admin_enabled", $context) && (isset($context["sonata_admin_enabled"]) ? $context["sonata_admin_enabled"] : $this->getContext($context, "sonata_admin_enabled")))) {
                // line 11
                echo "                            <a href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("admin_sonata_media_media_edit", array("id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))), "html", null, true);
                echo "\"><strong style=\"white-space: nowrap\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "name", array()), "html", null, true);
                echo "</strong></a>
                        ";
            } else {
                // line 13
                echo "                            <strong>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "name", array()), "html", null, true);
                echo "</strong>
                        ";
            }
            // line 15
            echo "                        <br />

                        <div style=\"\">
                            <span type=\"label\" style=\"white-space: nowrap;\">";
            // line 18
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "providerName", array()), array(), "SonataMediaBundle"), "html", null, true);
            echo "</span> ~ ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "context", array()), "html", null, true);
            echo "
                            <br>
                            <a href=\"";
            // line 20
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("sonata_media_download", array("id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "id", array()))), "html", null, true);
            echo "\" download  style=\"white-space: nowrap;\"><i class=\"fa fa-download\"></i>
                                Download ";
            // line 21
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "name", array()), "html", null, true);
            echo "
                            </a>
                        </div>

                    </div>
                ";
        } else {
            // line 27
            echo "                    <div class=\"pull-left\" style=\"margin-right: 5px\">

                        <strong>";
            // line 29
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("no_linked_media", array(), "SonataMediaBundle"), "html", null, true);
            echo "</strong> <br />
                        <span type=\"label\">";
            // line 30
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "provider", array(), "array"), array(), "SonataMediaBundle"), "html", null, true);
            echo " ~ ";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "context", array(), "array"), array(), "SonataMediaBundle"), "html", null, true);
            echo "</span>
                        <br><br>
                    </div>
                ";
        }
        // line 34
        echo "
                <br>
            </div>

            <div class=\"pull-left\" style=\"max-width: 30%\">
                ";
        // line 39
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
            </div>
        </div>
    </div>
";
        
        $__internal_501df8fc417bcc9a0b458eb9643ab38fe785d8d6500155ea8a03482fb19642a5->leave($__internal_501df8fc417bcc9a0b458eb9643ab38fe785d8d6500155ea8a03482fb19642a5_prof);

    }

    public function getTemplateName()
    {
        return ":Sonata:media_widgets.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  116 => 39,  109 => 34,  100 => 30,  96 => 29,  92 => 27,  83 => 21,  79 => 20,  72 => 18,  67 => 15,  61 => 13,  53 => 11,  51 => 10,  47 => 8,  45 => 7,  42 => 6,  40 => 5,  35 => 2,  23 => 1,);
    }
}
/* {% block sonata_media_type_widget %}*/
/*     <div style="display: inline-block;">*/
/*         <div class="col-md-12" style="padding-bottom: 20px">*/
/*             <div class="pull-left" style="max-width: 50%; ">*/
/*                 {% if value is not empty and value.providerReference and value.id %}*/
/*                     <div class="pull-left" style="margin-right: 5px">*/
/*                         {% thumbnail value, 'admin' with {'class': 'img-polaroid media-object'} %}*/
/*                     </div>*/
/*                     <div class="pull-left" style="margin-right: 5px;max-width: 60%;overflow: hidden;">*/
/*                         {% if sonata_admin_enabled is defined and sonata_admin_enabled  %}*/
/*                             <a href="{{ url('admin_sonata_media_media_edit', {id: value.id}) }}"><strong style="white-space: nowrap">{{ value.name }}</strong></a>*/
/*                         {% else %}*/
/*                             <strong>{{ value.name }}</strong>*/
/*                         {% endif %}*/
/*                         <br />*/
/* */
/*                         <div style="">*/
/*                             <span type="label" style="white-space: nowrap;">{{ value.providerName|trans({}, 'SonataMediaBundle') }}</span> ~ {{ value.context }}*/
/*                             <br>*/
/*                             <a href="{{ path('sonata_media_download', {'id': value.id }) }}" download  style="white-space: nowrap;"><i class="fa fa-download"></i>*/
/*                                 Download {{value.name}}*/
/*                             </a>*/
/*                         </div>*/
/* */
/*                     </div>*/
/*                 {% else %}*/
/*                     <div class="pull-left" style="margin-right: 5px">*/
/* */
/*                         <strong>{{ 'no_linked_media'|trans({}, 'SonataMediaBundle') }}</strong> <br />*/
/*                         <span type="label">{{ form.vars['provider']|trans({}, 'SonataMediaBundle') }} ~ {{ form.vars['context']|trans({}, 'SonataMediaBundle') }}</span>*/
/*                         <br><br>*/
/*                     </div>*/
/*                 {% endif %}*/
/* */
/*                 <br>*/
/*             </div>*/
/* */
/*             <div class="pull-left" style="max-width: 30%">*/
/*                 {{ block('form_widget') }}*/
/*             </div>*/
/*         </div>*/
/*     </div>*/
/* {% endblock sonata_media_type_widget %}*/
/* */
