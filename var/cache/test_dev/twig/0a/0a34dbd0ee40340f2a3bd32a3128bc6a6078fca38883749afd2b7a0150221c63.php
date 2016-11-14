<?php

/* GregwarCaptchaBundle::captcha.html.twig */
class __TwigTemplate_763e2a10052a82c5836436d5e2706492dc8e3a4e4d4e62a2fa4bbecfd1da4b5c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'captcha_widget' => array($this, 'block_captcha_widget'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_994680552a3f5fe934bbea727594416792978aafa2d547074699798f25e896ec = $this->env->getExtension("native_profiler");
        $__internal_994680552a3f5fe934bbea727594416792978aafa2d547074699798f25e896ec->enter($__internal_994680552a3f5fe934bbea727594416792978aafa2d547074699798f25e896ec_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "GregwarCaptchaBundle::captcha.html.twig"));

        // line 1
        $this->displayBlock('captcha_widget', $context, $blocks);
        
        $__internal_994680552a3f5fe934bbea727594416792978aafa2d547074699798f25e896ec->leave($__internal_994680552a3f5fe934bbea727594416792978aafa2d547074699798f25e896ec_prof);

    }

    public function block_captcha_widget($context, array $blocks = array())
    {
        $__internal_9294c6809dc9542509f1778e11033b50968d0375e2c22faef0aea7474822086f = $this->env->getExtension("native_profiler");
        $__internal_9294c6809dc9542509f1778e11033b50968d0375e2c22faef0aea7474822086f->enter($__internal_9294c6809dc9542509f1778e11033b50968d0375e2c22faef0aea7474822086f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "captcha_widget"));

        // line 2
        if ((isset($context["is_human"]) ? $context["is_human"] : $this->getContext($context, "is_human"))) {
            // line 3
            echo "-
";
        } else {
            // line 5
            ob_start();
            // line 6
            echo "    <img id=\"";
            echo twig_escape_filter($this->env, (isset($context["image_id"]) ? $context["image_id"] : $this->getContext($context, "image_id")), "html", null, true);
            echo "\" src=\"";
            echo twig_escape_filter($this->env, (isset($context["captcha_code"]) ? $context["captcha_code"] : $this->getContext($context, "captcha_code")), "html", null, true);
            echo "\" alt=\"\" title=\"captcha\" width=\"";
            echo twig_escape_filter($this->env, (isset($context["captcha_width"]) ? $context["captcha_width"] : $this->getContext($context, "captcha_width")), "html", null, true);
            echo "\" height=\"";
            echo twig_escape_filter($this->env, (isset($context["captcha_height"]) ? $context["captcha_height"] : $this->getContext($context, "captcha_height")), "html", null, true);
            echo "\" />
    ";
            // line 7
            if ((isset($context["reload"]) ? $context["reload"] : $this->getContext($context, "reload"))) {
                // line 8
                echo "    <script type=\"text/javascript\">
        function reload_";
                // line 9
                echo twig_escape_filter($this->env, (isset($context["image_id"]) ? $context["image_id"] : $this->getContext($context, "image_id")), "html", null, true);
                echo "() {
            var img = document.getElementById('";
                // line 10
                echo twig_escape_filter($this->env, (isset($context["image_id"]) ? $context["image_id"] : $this->getContext($context, "image_id")), "html", null, true);
                echo "');
            img.src = '";
                // line 11
                echo twig_escape_filter($this->env, (isset($context["captcha_code"]) ? $context["captcha_code"] : $this->getContext($context, "captcha_code")), "html", null, true);
                echo "?n=' + (new Date()).getTime();
        }
    </script>
    <a class=\"captcha_reload\" href=\"javascript:reload_";
                // line 14
                echo twig_escape_filter($this->env, (isset($context["image_id"]) ? $context["image_id"] : $this->getContext($context, "image_id")), "html", null, true);
                echo "();\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Renew", array(), "gregwar_captcha"), "html", null, true);
                echo "</a>
    ";
            }
            // line 16
            echo "    ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "
";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        }
        
        $__internal_9294c6809dc9542509f1778e11033b50968d0375e2c22faef0aea7474822086f->leave($__internal_9294c6809dc9542509f1778e11033b50968d0375e2c22faef0aea7474822086f_prof);

    }

    public function getTemplateName()
    {
        return "GregwarCaptchaBundle::captcha.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  80 => 16,  73 => 14,  67 => 11,  63 => 10,  59 => 9,  56 => 8,  54 => 7,  43 => 6,  41 => 5,  37 => 3,  35 => 2,  23 => 1,);
    }
}
/* {% block captcha_widget %}*/
/* {% if is_human %}*/
/* -*/
/* {% else %}*/
/* {% spaceless %}*/
/*     <img id="{{ image_id }}" src="{{ captcha_code }}" alt="" title="captcha" width="{{ captcha_width }}" height="{{ captcha_height }}" />*/
/*     {% if reload %}*/
/*     <script type="text/javascript">*/
/*         function reload_{{ image_id }}() {*/
/*             var img = document.getElementById('{{ image_id }}');*/
/*             img.src = '{{ captcha_code }}?n=' + (new Date()).getTime();*/
/*         }*/
/*     </script>*/
/*     <a class="captcha_reload" href="javascript:reload_{{ image_id }}();">{{ 'Renew'|trans({}, 'gregwar_captcha') }}</a>*/
/*     {% endif %}*/
/*     {{ form_widget(form) }}*/
/* {% endspaceless %}*/
/* {% endif %}*/
/* {% endblock %}*/
/* */
