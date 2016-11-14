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
        $__internal_e328261fd408a4506a4f8d6879c3bd474c085f7b69e71d1a45526f60880f88a7 = $this->env->getExtension("native_profiler");
        $__internal_e328261fd408a4506a4f8d6879c3bd474c085f7b69e71d1a45526f60880f88a7->enter($__internal_e328261fd408a4506a4f8d6879c3bd474c085f7b69e71d1a45526f60880f88a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:AppShop/Shop/partials:pending_box.html.twig"));

        // line 1
        echo "<div id=\"pending-box\" class=\"finished-box\">

    <div class=\"text\">
        <h2>{[{ 'pending.title' | translate }]}</h2>
        <span translate=\"pending.desc\" translate-values=\"{[{ {reason: status.transaction.reason} }]}\"></span>
    </div>

</div>";
        
        $__internal_e328261fd408a4506a4f8d6879c3bd474c085f7b69e71d1a45526f60880f88a7->leave($__internal_e328261fd408a4506a4f8d6879c3bd474c085f7b69e71d1a45526f60880f88a7_prof);

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
