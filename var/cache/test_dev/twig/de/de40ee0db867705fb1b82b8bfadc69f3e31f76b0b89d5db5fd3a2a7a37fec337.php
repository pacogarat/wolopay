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
        $__internal_24a716ce68a14c58e2985ef9977753ef995eb4d069c9aecac7b1632b23117b30 = $this->env->getExtension("native_profiler");
        $__internal_24a716ce68a14c58e2985ef9977753ef995eb4d069c9aecac7b1632b23117b30->enter($__internal_24a716ce68a14c58e2985ef9977753ef995eb4d069c9aecac7b1632b23117b30_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:expired_box.html.twig"));

        // line 1
        echo "<div id=\"expired-box\" class=\"finished-box\">

    <div class=\"text\">
        <h2>{[{ 'expired.title' | translate }]}</h2>

        {[{ 'expired.desc' | translate }]}
    </div>

</div>";
        
        $__internal_24a716ce68a14c58e2985ef9977753ef995eb4d069c9aecac7b1632b23117b30->leave($__internal_24a716ce68a14c58e2985ef9977753ef995eb4d069c9aecac7b1632b23117b30_prof);

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
