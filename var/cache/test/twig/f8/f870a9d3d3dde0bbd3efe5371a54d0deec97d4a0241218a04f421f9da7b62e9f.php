<?php

/* LexikTranslationBundle::layout.html.twig */
class __TwigTemplate_e4583cd34b70c08abfbfa297e6e476e2e442cb35882a4d88f3b27ce2f7b16c5d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'flash_message' => array($this, 'block_flash_message'),
            'content' => array($this, 'block_content'),
            'javascript_footer' => array($this, 'block_javascript_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_7232d713d46c5844bee0c771e68bf55a55d6871b680f6433b9e72a45c7b68c5b = $this->env->getExtension("native_profiler");
        $__internal_7232d713d46c5844bee0c771e68bf55a55d6871b680f6433b9e72a45c7b68c5b->enter($__internal_7232d713d46c5844bee0c771e68bf55a55d6871b680f6433b9e72a45c7b68c5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "LexikTranslationBundle::layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 10
        echo "    </head>
    <body>
        ";
        // line 12
        $this->displayBlock('flash_message', $context, $blocks);
        // line 28
        echo "
        ";
        // line 29
        $this->displayBlock('content', $context, $blocks);
        // line 30
        echo "
        ";
        // line 31
        $this->displayBlock('javascript_footer', $context, $blocks);
        // line 36
        echo "    </body>
</html>
";
        
        $__internal_7232d713d46c5844bee0c771e68bf55a55d6871b680f6433b9e72a45c7b68c5b->leave($__internal_7232d713d46c5844bee0c771e68bf55a55d6871b680f6433b9e72a45c7b68c5b_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_d4d6bc513427fbe78ab0b9440117de40d989fa323b4a3266f7fcdb9ecf54a8a6 = $this->env->getExtension("native_profiler");
        $__internal_d4d6bc513427fbe78ab0b9440117de40d989fa323b4a3266f7fcdb9ecf54a8a6->enter($__internal_d4d6bc513427fbe78ab0b9440117de40d989fa323b4a3266f7fcdb9ecf54a8a6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        
        $__internal_d4d6bc513427fbe78ab0b9440117de40d989fa323b4a3266f7fcdb9ecf54a8a6->leave($__internal_d4d6bc513427fbe78ab0b9440117de40d989fa323b4a3266f7fcdb9ecf54a8a6_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_89f013979bc03005844b039b239629a2cba87a767ee9b6da9ec66c658190040f = $this->env->getExtension("native_profiler");
        $__internal_89f013979bc03005844b039b239629a2cba87a767ee9b6da9ec66c658190040f->enter($__internal_89f013979bc03005844b039b239629a2cba87a767ee9b6da9ec66c658190040f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 7
        echo "            <link rel=\"stylesheet\" href=\"//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css\">
            <link rel=\"stylesheet\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/ng-table/ng-table.min.css"), "html", null, true);
        echo "\">
        ";
        
        $__internal_89f013979bc03005844b039b239629a2cba87a767ee9b6da9ec66c658190040f->leave($__internal_89f013979bc03005844b039b239629a2cba87a767ee9b6da9ec66c658190040f_prof);

    }

    // line 12
    public function block_flash_message($context, array $blocks = array())
    {
        $__internal_97c10c78daf4696468aaeb150f3ae83e4cc826fcbd71b47508e88290e11fdbd4 = $this->env->getExtension("native_profiler");
        $__internal_97c10c78daf4696468aaeb150f3ae83e4cc826fcbd71b47508e88290e11fdbd4->enter($__internal_97c10c78daf4696468aaeb150f3ae83e4cc826fcbd71b47508e88290e11fdbd4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "flash_message"));

        // line 13
        echo "            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-md-12\">
                        ";
        // line 16
        $context["flashes"] = $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method");
        // line 17
        echo "                        ";
        if ((twig_length_filter($this->env, (isset($context["flashes"]) ? $context["flashes"] : $this->getContext($context, "flashes"))) > 0)) {
            // line 18
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["flashes"]) ? $context["flashes"] : $this->getContext($context, "flashes")));
            foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
                // line 19
                echo "                                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 20
                    echo "                                    <div class=\"alert alert-";
                    echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                    echo "</div>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 22
                echo "                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "                        ";
        }
        // line 24
        echo "                    </div>
                </div>
            </div>
        ";
        
        $__internal_97c10c78daf4696468aaeb150f3ae83e4cc826fcbd71b47508e88290e11fdbd4->leave($__internal_97c10c78daf4696468aaeb150f3ae83e4cc826fcbd71b47508e88290e11fdbd4_prof);

    }

    // line 29
    public function block_content($context, array $blocks = array())
    {
        $__internal_23628b6cbc4ac9566a8203d7bad99ef19916657b1a934d47b81785576a008a22 = $this->env->getExtension("native_profiler");
        $__internal_23628b6cbc4ac9566a8203d7bad99ef19916657b1a934d47b81785576a008a22->enter($__internal_23628b6cbc4ac9566a8203d7bad99ef19916657b1a934d47b81785576a008a22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        echo "";
        
        $__internal_23628b6cbc4ac9566a8203d7bad99ef19916657b1a934d47b81785576a008a22->leave($__internal_23628b6cbc4ac9566a8203d7bad99ef19916657b1a934d47b81785576a008a22_prof);

    }

    // line 31
    public function block_javascript_footer($context, array $blocks = array())
    {
        $__internal_5ce992eb20530fd1ed3b45832919991211d9f91d31428d89ea625601e24d02f0 = $this->env->getExtension("native_profiler");
        $__internal_5ce992eb20530fd1ed3b45832919991211d9f91d31428d89ea625601e24d02f0->enter($__internal_5ce992eb20530fd1ed3b45832919991211d9f91d31428d89ea625601e24d02f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascript_footer"));

        // line 32
        echo "            <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
            <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js\"></script>
            <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/lexiktranslation/ng-table/ng-table.min.js"), "html", null, true);
        echo "\"></script>
        ";
        
        $__internal_5ce992eb20530fd1ed3b45832919991211d9f91d31428d89ea625601e24d02f0->leave($__internal_5ce992eb20530fd1ed3b45832919991211d9f91d31428d89ea625601e24d02f0_prof);

    }

    public function getTemplateName()
    {
        return "LexikTranslationBundle::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  171 => 34,  167 => 32,  161 => 31,  149 => 29,  139 => 24,  136 => 23,  130 => 22,  119 => 20,  114 => 19,  109 => 18,  106 => 17,  104 => 16,  99 => 13,  93 => 12,  84 => 8,  81 => 7,  75 => 6,  64 => 5,  55 => 36,  53 => 31,  50 => 30,  48 => 29,  45 => 28,  43 => 12,  39 => 10,  37 => 6,  33 => 5,  27 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />*/
/*         <title>{% block title %}{% endblock %}</title>*/
/*         {% block stylesheets %}*/
/*             <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">*/
/*             <link rel="stylesheet" href="{{ asset('bundles/lexiktranslation/ng-table/ng-table.min.css') }}">*/
/*         {% endblock %}*/
/*     </head>*/
/*     <body>*/
/*         {% block flash_message %}*/
/*             <div class="container">*/
/*                 <div class="row">*/
/*                     <div class="col-md-12">*/
/*                         {% set flashes = app.session.flashbag.all() %}*/
/*                         {% if flashes | length > 0 %}*/
/*                             {% for type, messages in flashes %}*/
/*                                 {% for message in messages %}*/
/*                                     <div class="alert alert-{{ type }}">{{ message }}</div>*/
/*                                 {% endfor %}*/
/*                             {% endfor %}*/
/*                         {% endif %}*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         {% endblock flash_message %}*/
/* */
/*         {% block content '' %}*/
/* */
/*         {% block javascript_footer %}*/
/*             <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>*/
/*             <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js"></script>*/
/*             <script src="{{ asset('bundles/lexiktranslation/ng-table/ng-table.min.js') }}"></script>*/
/*         {% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
