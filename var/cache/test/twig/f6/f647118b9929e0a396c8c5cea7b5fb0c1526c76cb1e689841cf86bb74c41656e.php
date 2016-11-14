<?php

/* AppBundle:ClientAdmin/Default/includes:footer.html.twig */
class __TwigTemplate_76d1af91b3bc27be8171af86a60cbd31da09990165482fd6d4db95ac061a7e61 extends Twig_Template
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
        $__internal_08e773cf4160657488284d7d1156eae7db5428cb89fe57ed020f2653dde940df = $this->env->getExtension("native_profiler");
        $__internal_08e773cf4160657488284d7d1156eae7db5428cb89fe57ed020f2653dde940df->enter($__internal_08e773cf4160657488284d7d1156eae7db5428cb89fe57ed020f2653dde940df_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:ClientAdmin/Default/includes:footer.html.twig"));

        // line 1
        echo "<!-- PAGE FOOTER -->
<div class=\"row\">
    <div class=\"col-xs-12 col-sm-6\">
        <span class=\"txt-color-white\">Wolopay © 2014-2015 <img src=\"/img/wolopay.gif\" class=\"hidden-phone hidden-tablet\" width=\"25\" height=\"25\"></span>
    </div>

    <div class=\"col-xs-6 col-sm-6 text-right hidden-xs\">
        <div class=\"txt-color-white inline-block\">
            <i class=\"txt-color-blueLight hidden-mobile\"><span data-translate=\"last_account_activity\"></span> <i class=\"fa fa-clock-o\"></i>
                <strong>";
        // line 10
        echo twig_escape_filter($this->env, (isset($context["last_login_hours"]) ? $context["last_login_hours"] : $this->getContext($context, "last_login_hours")), "html", null, true);
        echo " hours</strong>
            </i>
        </div>
    </div>
</div>
<!-- END PAGE FOOTER -->";
        
        $__internal_08e773cf4160657488284d7d1156eae7db5428cb89fe57ed020f2653dde940df->leave($__internal_08e773cf4160657488284d7d1156eae7db5428cb89fe57ed020f2653dde940df_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:ClientAdmin/Default/includes:footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 10,  22 => 1,);
    }
}
/* <!-- PAGE FOOTER -->*/
/* <div class="row">*/
/*     <div class="col-xs-12 col-sm-6">*/
/*         <span class="txt-color-white">Wolopay © 2014-2015 <img src="/img/wolopay.gif" class="hidden-phone hidden-tablet" width="25" height="25"></span>*/
/*     </div>*/
/* */
/*     <div class="col-xs-6 col-sm-6 text-right hidden-xs">*/
/*         <div class="txt-color-white inline-block">*/
/*             <i class="txt-color-blueLight hidden-mobile"><span data-translate="last_account_activity"></span> <i class="fa fa-clock-o"></i>*/
/*                 <strong>{{last_login_hours}} hours</strong>*/
/*             </i>*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <!-- END PAGE FOOTER -->*/
