<?php

/* AppBundle:AppShop/Shop/partials:pending_box.html.twig */
class __TwigTemplate_bd273859e528937fa354052e9739073287dc9254265d8c733c2850d6d9fded85 extends Twig_Template
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
        $__internal_9f170a475436b6989f9acc3fd71b37f03b2d0a0ae2dc97264da83a5229047478 = $this->env->getExtension("native_profiler");
        $__internal_9f170a475436b6989f9acc3fd71b37f03b2d0a0ae2dc97264da83a5229047478->enter($__internal_9f170a475436b6989f9acc3fd71b37f03b2d0a0ae2dc97264da83a5229047478_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:pending_box.html.twig"));

        // line 1
        echo "<div id=\"pending-box\" class=\"finished-box\">

    <div class=\"text\">
        <h2>{[{ 'pending.title' | translate }]}</h2>
        <span translate=\"pending.desc\" translate-values=\"{[{ {reason: status.transaction.reason} }]}\"></span>
    </div>

</div>";
        
        $__internal_9f170a475436b6989f9acc3fd71b37f03b2d0a0ae2dc97264da83a5229047478->leave($__internal_9f170a475436b6989f9acc3fd71b37f03b2d0a0ae2dc97264da83a5229047478_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials:pending_box.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <div id="pending-box" class="finished-box">*/
/* */
/*     <div class="text">*/
/*         <h2>{[{ 'pending.title' | translate }]}</h2>*/
/*         <span translate="pending.desc" translate-values="{[{ {reason: status.transaction.reason} }]}"></span>*/
/*     </div>*/
/* */
/* </div>*/
