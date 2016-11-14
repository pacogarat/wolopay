<?php

/* AppBundle:AppShop/Shop/partials:expired_box.html.twig */
class __TwigTemplate_8f73ff3cf1887b71c80f4175c99f6a4dee4f42b4dbc9a960edd2345ae1a63099 extends Twig_Template
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
        $__internal_1a26ecf0e708fb03736d464bb913934832bc3086ba093e86e72a1220ed20a2ba = $this->env->getExtension("native_profiler");
        $__internal_1a26ecf0e708fb03736d464bb913934832bc3086ba093e86e72a1220ed20a2ba->enter($__internal_1a26ecf0e708fb03736d464bb913934832bc3086ba093e86e72a1220ed20a2ba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:expired_box.html.twig"));

        // line 1
        echo "<div id=\"expired-box\" class=\"finished-box\">

    <div class=\"text\">
        <h2>{[{ 'expired.title' | translate }]}</h2>

        {[{ 'expired.desc' | translate }]}
    </div>

</div>";
        
        $__internal_1a26ecf0e708fb03736d464bb913934832bc3086ba093e86e72a1220ed20a2ba->leave($__internal_1a26ecf0e708fb03736d464bb913934832bc3086ba093e86e72a1220ed20a2ba_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:AppShop/Shop/partials:expired_box.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <div id="expired-box" class="finished-box">*/
/* */
/*     <div class="text">*/
/*         <h2>{[{ 'expired.title' | translate }]}</h2>*/
/* */
/*         {[{ 'expired.desc' | translate }]}*/
/*     </div>*/
/* */
/* </div>*/
