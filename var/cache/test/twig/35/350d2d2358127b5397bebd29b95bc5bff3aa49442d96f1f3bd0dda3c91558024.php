<?php

/* AppBundle:Partials:flash_msgs.html.twig */
class __TwigTemplate_14c28c2d586f744ab7c6ed7db44649096b5483ac53dc545c4ebc6cc5d5599bb0 extends Twig_Template
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
        $__internal_8c26eec4aecb92ee2c08727d60e08bea28b06412783273381c2a6e622a47ba20 = $this->env->getExtension("native_profiler");
        $__internal_8c26eec4aecb92ee2c08727d60e08bea28b06412783273381c2a6e622a47ba20->enter($__internal_8c26eec4aecb92ee2c08727d60e08bea28b06412783273381c2a6e622a47ba20_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Partials:flash_msgs.html.twig"));

        // line 1
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
        foreach ($context['_seq'] as $context["type"] => $context["flashMessages"]) {
            // line 2
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["flashMessages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["flashMessage"]) {
                // line 3
                echo "        <div class=\"alert alert-";
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo "\">
            ";
                // line 4
                echo $this->env->getExtension('translator')->trans($context["flashMessage"], array());
                echo "
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flashMessage'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['flashMessages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_8c26eec4aecb92ee2c08727d60e08bea28b06412783273381c2a6e622a47ba20->leave($__internal_8c26eec4aecb92ee2c08727d60e08bea28b06412783273381c2a6e622a47ba20_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Partials:flash_msgs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  36 => 4,  31 => 3,  26 => 2,  22 => 1,);
    }
}
/* {% for type, flashMessages in app.session.flashbag.all() %}*/
/*     {% for flashMessage in flashMessages %}*/
/*         <div class="alert alert-{{ type }}">*/
/*             {{ flashMessage | trans({}) | raw }}*/
/*         </div>*/
/*     {% endfor %}*/
/* {% endfor %}*/
