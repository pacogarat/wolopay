<?php

/* AppBundle:Partials:analitycs_by_gamer_id.html.twig */
class __TwigTemplate_daba7946d32144576016afc34200617561893fecd4a336a6c076663f026a04dd extends Twig_Template
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
        $__internal_095bbe5237bd5f79db35bc8078434f1e8882619741616696f79d123069eda06e = $this->env->getExtension("native_profiler");
        $__internal_095bbe5237bd5f79db35bc8078434f1e8882619741616696f79d123069eda06e->enter($__internal_095bbe5237bd5f79db35bc8078434f1e8882619741616696f79d123069eda06e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Partials:analitycs_by_gamer_id.html.twig"));

        // line 1
        echo "
";
        // line 2
        if (((isset($context["analitycs"]) ? $context["analitycs"] : $this->getContext($context, "analitycs")) && ($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "test", array()) == false))) {
            // line 3
            echo "<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '";
            // line 9
            echo twig_escape_filter($this->env, (isset($context["analitycs"]) ? $context["analitycs"] : $this->getContext($context, "analitycs")), "html", null, true);
            echo "', {
        'storage': 'none',
        'userId': '";
            // line 11
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "gamer", array()), "id", array()), "html", null, true);
            echo "',
        'clientId': '";
            // line 12
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "gamer", array()), "id", array()), "html", null, true);
            echo "'
    });
    ga('send', 'screenview', {
        'appName': '";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "app", array()), "name", array()), "html", null, true);
            echo "',
        'appId': '";
            // line 16
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "app", array()), "id", array()), "html", null, true);
            echo "',
        'css': '";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "css", array()), "name", array()), "html", null, true);
            echo "',
        'level': '";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["transaction"]) ? $context["transaction"] : $this->getContext($context, "transaction")), "levelCategory", array()), "name", array()), "html", null, true);
            echo "'
    });

    ga('send', 'pageview');


</script>
";
        }
        
        $__internal_095bbe5237bd5f79db35bc8078434f1e8882619741616696f79d123069eda06e->leave($__internal_095bbe5237bd5f79db35bc8078434f1e8882619741616696f79d123069eda06e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Partials:analitycs_by_gamer_id.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 18,  58 => 17,  54 => 16,  50 => 15,  44 => 12,  40 => 11,  35 => 9,  27 => 3,  25 => 2,  22 => 1,);
    }
}
/* */
/* {% if analitycs and transaction.test == false %}*/
/* <script>*/
/*     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){*/
/*         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),*/
/*             m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)*/
/*     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');*/
/* */
/*     ga('create', '{{ analitycs }}', {*/
/*         'storage': 'none',*/
/*         'userId': '{{ transaction.gamer.id }}',*/
/*         'clientId': '{{ transaction.gamer.id }}'*/
/*     });*/
/*     ga('send', 'screenview', {*/
/*         'appName': '{{ transaction.app.name }}',*/
/*         'appId': '{{ transaction.app.id }}',*/
/*         'css': '{{ transaction.css.name }}',*/
/*         'level': '{{ transaction.levelCategory.name }}'*/
/*     });*/
/* */
/*     ga('send', 'pageview');*/
/* */
/* */
/* </script>*/
/* {% endif %}*/
/* */
