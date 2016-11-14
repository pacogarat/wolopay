<?php

/* AppBundle:Partials:captcha_horizontal.html.twig */
class __TwigTemplate_3c707b80747a1994b4b44cee813efb5469dfb0af8e9ca416700f8248813bff89 extends Twig_Template
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
        $__internal_4fad0d4d173432c2bea6d4f844a78a7e03d3de9ec67242f59d57033bff714942 = $this->env->getExtension("native_profiler");
        $__internal_4fad0d4d173432c2bea6d4f844a78a7e03d3de9ec67242f59d57033bff714942->enter($__internal_4fad0d4d173432c2bea6d4f844a78a7e03d3de9ec67242f59d57033bff714942_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Partials:captcha_horizontal.html.twig"));

        // line 1
        $this->displayBlock('captcha_widget', $context, $blocks);
        
        $__internal_4fad0d4d173432c2bea6d4f844a78a7e03d3de9ec67242f59d57033bff714942->leave($__internal_4fad0d4d173432c2bea6d4f844a78a7e03d3de9ec67242f59d57033bff714942_prof);

    }

    public function block_captcha_widget($context, array $blocks = array())
    {
        $__internal_96aa71ff721ea21ef7016b3d7f4bfc057d4bed04e35ecaab192681f8805abc2a = $this->env->getExtension("native_profiler");
        $__internal_96aa71ff721ea21ef7016b3d7f4bfc057d4bed04e35ecaab192681f8805abc2a->enter($__internal_96aa71ff721ea21ef7016b3d7f4bfc057d4bed04e35ecaab192681f8805abc2a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "captcha_widget"));

        // line 2
        echo "    ";
        ob_start();
        // line 3
        echo "        <div class=\"row-fluid\">
            <div class=\"fixed\" style=\"width: 100px\">
                <img src=\"";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["captcha_code"]) ? $context["captcha_code"] : $this->getContext($context, "captcha_code")), "html", null, true);
        echo "\" title=\"captcha\" width=\"";
        echo twig_escape_filter($this->env, (isset($context["captcha_width"]) ? $context["captcha_width"] : $this->getContext($context, "captcha_width")), "html", null, true);
        echo "\" height=\"";
        echo twig_escape_filter($this->env, (isset($context["captcha_height"]) ? $context["captcha_height"] : $this->getContext($context, "captcha_height")), "html", null, true);
        echo "\" style=\"border: 1px solid #ccc; float: left\" />
            </div>
            <div class=\"hero-unit filler\">
                ";
        // line 8
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget', array("attr" => array("style" => "float:left; margin-left:10px; width: 150px")));
        echo "
            </div>
        </div>
        <div style=\"clear: both\"></div>

    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_96aa71ff721ea21ef7016b3d7f4bfc057d4bed04e35ecaab192681f8805abc2a->leave($__internal_96aa71ff721ea21ef7016b3d7f4bfc057d4bed04e35ecaab192681f8805abc2a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Partials:captcha_horizontal.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  52 => 8,  42 => 5,  38 => 3,  35 => 2,  23 => 1,);
    }
}
/* {% block captcha_widget %}*/
/*     {% spaceless %}*/
/*         <div class="row-fluid">*/
/*             <div class="fixed" style="width: 100px">*/
/*                 <img src="{{ captcha_code }}" title="captcha" width="{{ captcha_width }}" height="{{ captcha_height }}" style="border: 1px solid #ccc; float: left" />*/
/*             </div>*/
/*             <div class="hero-unit filler">*/
/*                 {{ form_widget(form,{'attr': {'style': 'float:left; margin-left:10px; width: 150px'}}) }}*/
/*             </div>*/
/*         </div>*/
/*         <div style="clear: both"></div>*/
/* */
/*     {% endspaceless %}*/
/* {% endblock %}*/
