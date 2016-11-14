<?php

/* FOSUserBundle:Group:show_content.html.twig */
class __TwigTemplate_404387871ba09d87f9a3fe3c03907576c5f04ddc3b8f1c187ed1ab16126e4b6a extends Twig_Template
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
        $__internal_2e28f17f704d95204f24c7f7fefd101c33f4d6af7bc24edd12d6db52047cadbb = $this->env->getExtension("native_profiler");
        $__internal_2e28f17f704d95204f24c7f7fefd101c33f4d6af7bc24edd12d6db52047cadbb->enter($__internal_2e28f17f704d95204f24c7f7fefd101c33f4d6af7bc24edd12d6db52047cadbb_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle:Group:show_content.html.twig"));

        // line 2
        echo "
<div class=\"fos_user_group_show\">
    <p>";
        // line 4
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("group.show.name", array(), "FOSUserBundle"), "html", null, true);
        echo ": ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["group"]) ? $context["group"] : $this->getContext($context, "group")), "getName", array(), "method"), "html", null, true);
        echo "</p>
</div>
";
        
        $__internal_2e28f17f704d95204f24c7f7fefd101c33f4d6af7bc24edd12d6db52047cadbb->leave($__internal_2e28f17f704d95204f24c7f7fefd101c33f4d6af7bc24edd12d6db52047cadbb_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle:Group:show_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 4,  22 => 2,);
    }
}
/* {% trans_default_domain 'FOSUserBundle' %}*/
/* */
/* <div class="fos_user_group_show">*/
/*     <p>{{ 'group.show.name'|trans }}: {{ group.getName() }}</p>*/
/* </div>*/
/* */
