<?php

/* AppBundle:Others/Default/LegalNotice:legal_notice_en.html.twig */
class __TwigTemplate_02ef4c484eb0c0d89bcdbb7fe1385b06473224ab748099184c11c402015157b4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig", "AppBundle:Others/Default/LegalNotice:legal_notice_en.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_22f867c2db00aab7e4fa011e6db9cdc5122d3949e0145449ec4b60933445df22 = $this->env->getExtension("native_profiler");
        $__internal_22f867c2db00aab7e4fa011e6db9cdc5122d3949e0145449ec4b60933445df22->enter($__internal_22f867c2db00aab7e4fa011e6db9cdc5122d3949e0145449ec4b60933445df22_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/LegalNotice:legal_notice_en.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_22f867c2db00aab7e4fa011e6db9cdc5122d3949e0145449ec4b60933445df22->leave($__internal_22f867c2db00aab7e4fa011e6db9cdc5122d3949e0145449ec4b60933445df22_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_c434df99cb8566310529b78e3342001d66f0dadd712cae32efb866373502057b = $this->env->getExtension("native_profiler");
        $__internal_c434df99cb8566310529b78e3342001d66f0dadd712cae32efb866373502057b->enter($__internal_c434df99cb8566310529b78e3342001d66f0dadd712cae32efb866373502057b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Legal Notice";
        
        $__internal_c434df99cb8566310529b78e3342001d66f0dadd712cae32efb866373502057b->leave($__internal_c434df99cb8566310529b78e3342001d66f0dadd712cae32efb866373502057b_prof);

    }

    // line 3
    public function block_page($context, array $blocks = array())
    {
        $__internal_cbbcbad25adf5aa10c6820ad5a13bcb032ac83cd12590824aeb15d736ab03811 = $this->env->getExtension("native_profiler");
        $__internal_cbbcbad25adf5aa10c6820ad5a13bcb032ac83cd12590824aeb15d736ab03811->enter($__internal_cbbcbad25adf5aa10c6820ad5a13bcb032ac83cd12590824aeb15d736ab03811_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 4
        echo "
    <h1>LEGAL NOTICE</h1>

    This website is owned and managed by Wolopay, SL, whose address, registration details and tax number are the following:
    <br><br>
    <ul>
        <li>Business address: Comandante Zorita nº 4, entreplanta of Madrid (CP 28020), Spain</li>
        <li>E-mail address: info@wolopay.com</li>
        <li>Registration details: Commercial Registry of Madrid (Tomo 33535, Sección 8, Folio 72, Hoja M-603647)</li>
        <li>Tax Number: ES B-87282299</li>
    </ul>
    <br>
    All elements of this website, including designs, text, images and source code are protected by intellectual property rights of international scope. None of them, jointly or individually, may be reproduced, distributed, publicly communicated or transformed in any way without explicit permission from the owner.<br><br>
    Through this website you may be able to link to other websites which are not under the control of Wolopay. Wolopay has no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.<br><br>
    In no event will Wolopay be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.<br><br>
    Every effort is made to keep this website up and running smoothly. However, Wolopay takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.<br><br>

";
        
        $__internal_cbbcbad25adf5aa10c6820ad5a13bcb032ac83cd12590824aeb15d736ab03811->leave($__internal_cbbcbad25adf5aa10c6820ad5a13bcb032ac83cd12590824aeb15d736ab03811_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/LegalNotice:legal_notice_en.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 4,  47 => 3,  35 => 2,  11 => 1,);
    }
}
/* {% extends "AppBundle:Others/Default/LegalNotice:legal_notice_layout.html.twig" %}*/
/* {% block title %}Legal Notice{% endblock %}*/
/* {% block page %}*/
/* */
/*     <h1>LEGAL NOTICE</h1>*/
/* */
/*     This website is owned and managed by Wolopay, SL, whose address, registration details and tax number are the following:*/
/*     <br><br>*/
/*     <ul>*/
/*         <li>Business address: Comandante Zorita nº 4, entreplanta of Madrid (CP 28020), Spain</li>*/
/*         <li>E-mail address: info@wolopay.com</li>*/
/*         <li>Registration details: Commercial Registry of Madrid (Tomo 33535, Sección 8, Folio 72, Hoja M-603647)</li>*/
/*         <li>Tax Number: ES B-87282299</li>*/
/*     </ul>*/
/*     <br>*/
/*     All elements of this website, including designs, text, images and source code are protected by intellectual property rights of international scope. None of them, jointly or individually, may be reproduced, distributed, publicly communicated or transformed in any way without explicit permission from the owner.<br><br>*/
/*     Through this website you may be able to link to other websites which are not under the control of Wolopay. Wolopay has no control over the nature, content and availability of those sites. The inclusion of any links does not necessarily imply a recommendation or endorse the views expressed within them.<br><br>*/
/*     In no event will Wolopay be liable for any loss or damage including without limitation, indirect or consequential loss or damage, or any loss or damage whatsoever arising from loss of data or profits arising out of, or in connection with, the use of this website.<br><br>*/
/*     Every effort is made to keep this website up and running smoothly. However, Wolopay takes no responsibility for, and will not be liable for, the website being temporarily unavailable due to technical issues beyond our control.<br><br>*/
/* */
/* {% endblock %}*/
