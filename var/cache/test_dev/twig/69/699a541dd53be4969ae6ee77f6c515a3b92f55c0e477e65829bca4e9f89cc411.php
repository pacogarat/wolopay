<?php

/* AppBundle:Documentation:generic.html.twig */
class __TwigTemplate_ce465701970615ccee5b20bd6041b603c8648cd9033ebc56814614228634e73f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Documentation/documentation_layout.html.twig", "AppBundle:Documentation:generic.html.twig", 1);
        $this->blocks = array(
            'main_content' => array($this, 'block_main_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Documentation/documentation_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_c23537db86798861d326de3d35b895f9de3afadcc34708c82cec184cd7bd861d = $this->env->getExtension("native_profiler");
        $__internal_c23537db86798861d326de3d35b895f9de3afadcc34708c82cec184cd7bd861d->enter($__internal_c23537db86798861d326de3d35b895f9de3afadcc34708c82cec184cd7bd861d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Documentation:generic.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c23537db86798861d326de3d35b895f9de3afadcc34708c82cec184cd7bd861d->leave($__internal_c23537db86798861d326de3d35b895f9de3afadcc34708c82cec184cd7bd861d_prof);

    }

    // line 2
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_8e3952ff62b5246028c5b56776a0bdf94a80a28405deee171b0a476d884142fc = $this->env->getExtension("native_profiler");
        $__internal_8e3952ff62b5246028c5b56776a0bdf94a80a28405deee171b0a476d884142fc->enter($__internal_8e3952ff62b5246028c5b56776a0bdf94a80a28405deee171b0a476d884142fc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        // line 3
        echo "    <div class=\"generic-doc\">
        ";
        // line 4
        echo (isset($context["main_content"]) ? $context["main_content"] : $this->getContext($context, "main_content"));
        echo "
    </div>
";
        
        $__internal_8e3952ff62b5246028c5b56776a0bdf94a80a28405deee171b0a476d884142fc->leave($__internal_8e3952ff62b5246028c5b56776a0bdf94a80a28405deee171b0a476d884142fc_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Documentation:generic.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 4,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends "@App/Documentation/documentation_layout.html.twig" %}*/
/* {% block main_content %}*/
/*     <div class="generic-doc">*/
/*         {{ main_content | raw }}*/
/*     </div>*/
/* {% endblock %}*/
/* */
