<?php

/* FOSUserBundle::layout.html.twig */
class __TwigTemplate_1778f46196d365d912e4f2f4600da34df903ef0bffdb2c61343feb8c75671480 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'fos_user_content' => array($this, 'block_fos_user_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_897adb2f304b3b93dd6c3a30cfd3ef94f502471169700d3ee562c3efb611f3f1 = $this->env->getExtension("native_profiler");
        $__internal_897adb2f304b3b93dd6c3a30cfd3ef94f502471169700d3ee562c3efb611f3f1->enter($__internal_897adb2f304b3b93dd6c3a30cfd3ef94f502471169700d3ee562c3efb611f3f1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "FOSUserBundle::layout.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"UTF-8\" />
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no\"/>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\">

    ";
        // line 9
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "1376e32_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32_0") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32_bootstrap_extra_1.css");
            // line 12
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        } else {
            // asset "1376e32"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_1376e32") : $this->env->getExtension('asset')->getAssetUrl("css/1376e32.css");
            echo "        <link rel=\"stylesheet\" href=\"";
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" media=\"screen\" />
    ";
        }
        unset($context["asset_url"]);
        // line 14
        echo "</head>
<body>

";
        // line 18
        echo "    ";
        // line 19
        echo "        ";
        // line 20
        echo "        ";
        // line 21
        echo "            ";
        // line 22
        echo "        ";
        // line 23
        echo "    ";
        // line 24
        echo "        ";
        // line 25
        echo "    ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "session", array()), "flashbag", array()), "all", array(), "method"));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 28
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 29
                echo "        <div class=\"flash-";
                echo twig_escape_filter($this->env, $context["type"], "html", null, true);
                echo "\">
            ";
                // line 30
                echo twig_escape_filter($this->env, $context["message"], "html", null, true);
                echo "
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 34
        echo "<div>
    ";
        // line 35
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 37
        echo "</div>
</body>
</html>
";
        
        $__internal_897adb2f304b3b93dd6c3a30cfd3ef94f502471169700d3ee562c3efb611f3f1->leave($__internal_897adb2f304b3b93dd6c3a30cfd3ef94f502471169700d3ee562c3efb611f3f1_prof);

    }

    // line 35
    public function block_fos_user_content($context, array $blocks = array())
    {
        $__internal_d184481dd568ba8c5e308699e6efa6da3e0b86acf51b51a6f823a9712a9416b1 = $this->env->getExtension("native_profiler");
        $__internal_d184481dd568ba8c5e308699e6efa6da3e0b86acf51b51a6f823a9712a9416b1->enter($__internal_d184481dd568ba8c5e308699e6efa6da3e0b86acf51b51a6f823a9712a9416b1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "fos_user_content"));

        // line 36
        echo "    ";
        
        $__internal_d184481dd568ba8c5e308699e6efa6da3e0b86acf51b51a6f823a9712a9416b1->leave($__internal_d184481dd568ba8c5e308699e6efa6da3e0b86acf51b51a6f823a9712a9416b1_prof);

    }

    public function getTemplateName()
    {
        return "FOSUserBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 36,  114 => 35,  104 => 37,  102 => 35,  99 => 34,  86 => 30,  81 => 29,  76 => 28,  72 => 27,  70 => 25,  68 => 24,  66 => 23,  64 => 22,  62 => 21,  60 => 20,  58 => 19,  56 => 18,  51 => 14,  37 => 12,  33 => 9,  23 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="UTF-8" />*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>*/
/*     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">*/
/* */
/*     {% stylesheets*/
/*         "css_glob/bootstrap_extra.css"*/
/*     %}*/
/*         <link rel="stylesheet" href="{{ asset_url }}" media="screen" />*/
/*     {% endstylesheets %}*/
/* </head>*/
/* <body>*/
/* */
/* {#<div>#}*/
/*     {#{% if is_granted("IS_AUTHENTICATED_REMEMBERED") %}#}*/
/*         {#{{ 'layout.logged_in_as'|trans({'%username%': app.user.username}, 'FOSUserBundle') }} |#}*/
/*         {#<a href="{{ path('fos_user_security_logout') }}">#}*/
/*             {#{{ 'layout.logout'|trans({}, 'FOSUserBundle') }}#}*/
/*         {#</a>#}*/
/*     {#{% else %}#}*/
/*         {#<a href="{{ path('fos_user_security_login') }}">{{ 'layout.login'|trans({}, 'FOSUserBundle') }}</a>#}*/
/*     {#{% endif %}#}*/
/* {#</div>#}*/
/* {% for type, messages in app.session.flashbag.all() %}*/
/*     {% for message in messages %}*/
/*         <div class="flash-{{ type }}">*/
/*             {{ message }}*/
/*         </div>*/
/*     {% endfor %}*/
/* {% endfor %}*/
/* <div>*/
/*     {% block fos_user_content %}*/
/*     {% endblock fos_user_content %}*/
/* </div>*/
/* </body>*/
/* </html>*/
/* */
