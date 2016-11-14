<?php

/* AppBundle:PDF/headers:standard.html.twig */
class __TwigTemplate_e20f37e12f4d81a1743689c7af26180d38800be80f815649164caffc12bc6fd9 extends Twig_Template
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
        $__internal_325cca4b2e961815ef4a33c1ee5fd7d4325f6a547b89cca33fe37093760238a3 = $this->env->getExtension("native_profiler");
        $__internal_325cca4b2e961815ef4a33c1ee5fd7d4325f6a547b89cca33fe37093760238a3->enter($__internal_325cca4b2e961815ef4a33c1ee5fd7d4325f6a547b89cca33fe37093760238a3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PDF/headers:standard.html.twig"));

        // line 2
        echo "<!DOCTYPE html>
<html><head>

    <script>
        function subst() {
            var vars={};
            var x=document.location.search.substring(1).split('&');
            for(var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}
            var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];
            for(var i in x) {
                var y = document.getElementsByClassName(x[i]);
                for(var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];
            }
        }
    </script>
</head>
<body onload=\"subst()\">
<div class=\"section\"></div>
<table style=\"border-bottom: 1px solid black; width: 100%;font-weight: bold; margin-bottom: 10px;padding-bottom: 3px; height: 30px;\">
    <tr>
        <td>";
        // line 22
        echo twig_escape_filter($this->env, ((array_key_exists("title", $context)) ? (_twig_default_filter((isset($context["title"]) ? $context["title"] : $this->getContext($context, "title")), "")) : ("")), "html", null, true);
        echo "</td>
        <td> </td>
        <td style=\"text-align:right\">
            Page <span class=\"page\">[page]</span> of <span class=\"topage\"></span>
        </td>
    </tr>
</table>
</body></html>";
        
        $__internal_325cca4b2e961815ef4a33c1ee5fd7d4325f6a547b89cca33fe37093760238a3->leave($__internal_325cca4b2e961815ef4a33c1ee5fd7d4325f6a547b89cca33fe37093760238a3_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PDF/headers:standard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 22,  22 => 2,);
    }
}
/* {# client \AppBundle\Entity\Company #}*/
/* <!DOCTYPE html>*/
/* <html><head>*/
/* */
/*     <script>*/
/*         function subst() {*/
/*             var vars={};*/
/*             var x=document.location.search.substring(1).split('&');*/
/*             for(var i in x) {var z=x[i].split('=',2);vars[z[0]] = unescape(z[1]);}*/
/*             var x=['frompage','topage','page','webpage','section','subsection','subsubsection'];*/
/*             for(var i in x) {*/
/*                 var y = document.getElementsByClassName(x[i]);*/
/*                 for(var j=0; j<y.length; ++j) y[j].textContent = vars[x[i]];*/
/*             }*/
/*         }*/
/*     </script>*/
/* </head>*/
/* <body onload="subst()">*/
/* <div class="section"></div>*/
/* <table style="border-bottom: 1px solid black; width: 100%;font-weight: bold; margin-bottom: 10px;padding-bottom: 3px; height: 30px;">*/
/*     <tr>*/
/*         <td>{{ title | default('') }}</td>*/
/*         <td> </td>*/
/*         <td style="text-align:right">*/
/*             Page <span class="page">[page]</span> of <span class="topage"></span>*/
/*         </td>*/
/*     </tr>*/
/* </table>*/
/* </body></html>*/
