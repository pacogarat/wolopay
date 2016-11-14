<?php

/* AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig */
class __TwigTemplate_d66d2ca06cc80a41523b2e09eea48b25968496a7ba0e2f0288ae1340e13d0f19 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/PrivacyPolicy/privacy_policy_layout.html.twig", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Others/Default/PrivacyPolicy/privacy_policy_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9283432a1e254a5aca3b6693f44b458683844f1f38f863765373bf4780ac5f79 = $this->env->getExtension("native_profiler");
        $__internal_9283432a1e254a5aca3b6693f44b458683844f1f38f863765373bf4780ac5f79->enter($__internal_9283432a1e254a5aca3b6693f44b458683844f1f38f863765373bf4780ac5f79_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9283432a1e254a5aca3b6693f44b458683844f1f38f863765373bf4780ac5f79->leave($__internal_9283432a1e254a5aca3b6693f44b458683844f1f38f863765373bf4780ac5f79_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_1028c10b3c5f8a6e8440cf483533012e43da10344df2666fcbb8518d31c83ac0 = $this->env->getExtension("native_profiler");
        $__internal_1028c10b3c5f8a6e8440cf483533012e43da10344df2666fcbb8518d31c83ac0->enter($__internal_1028c10b3c5f8a6e8440cf483533012e43da10344df2666fcbb8518d31c83ac0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Legal Notice";
        
        $__internal_1028c10b3c5f8a6e8440cf483533012e43da10344df2666fcbb8518d31c83ac0->leave($__internal_1028c10b3c5f8a6e8440cf483533012e43da10344df2666fcbb8518d31c83ac0_prof);

    }

    // line 3
    public function block_page($context, array $blocks = array())
    {
        $__internal_244818eb854fef1e2f19946e929b8b135605f29822755b9b13d9a386a9d8e32c = $this->env->getExtension("native_profiler");
        $__internal_244818eb854fef1e2f19946e929b8b135605f29822755b9b13d9a386a9d8e32c->enter($__internal_244818eb854fef1e2f19946e929b8b135605f29822755b9b13d9a386a9d8e32c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 4
        echo "
    <h1>PRIVACY POLICY</h1>

    <h3>1. COOKIES</h3>
    By visiting this website, the user consents to store cookies on his/her device. A cookie is a file of information sent by a website and kept by the browser and is used to store and retrieve information regarding navigation on the device.<br><br>
    In this regard, the user authorizes Wolopay, SL to store and retrieve data using cookies in his/her browser, needed to manage the user session, save user preferences or collect usage statistics, amongst other things.<br><br>
    The types of cookies that may be used on this website, and the purpose thereof and, if applicable, third party cookies used (service providers) are:

    <br><br>

    <ul>
        <li>Cookies strictly necessary to provide the services requested by the user on the website. If these cookies are disabled, the user will be unable to properly interact with our content and services.</li>
        <li>Analytical Cookies (for monitoring and statistical analysis of user behavior as a whole), advertising cookies (to manage advertising space such as the frequency with which the ads are displayed) and behavioral cookies (to manage advertising space based on the specific profile). If these cookies are disabled, the website will continue to operate, but we will not be able to personalize the ads according to your specific interests.</li>
    </ul>

    <br>

    You can learn how to configure the installation or uninstall cookies through the help section of your browser. If you need further assistance please send an email to info@wolopay.com.

    <h3>2. DATA PROTECTION</h3>

    The information collected by Wolopay, SL of the website users, either through the cookies mechanism or any other similar device, such as an eventual electronic form, will be treated with the utmost confidentiality.<br><br>
    If any personal data are collected, in compliance with the provisions of applicable regulations we hereby inform you that these shall be incorporated in an automatized file owned by Wolopay, SL duly registered at the relevant Data Protection Authority.<br><br>
    Said personal data will be used exclusively for providing you the services requested and for marketing purposes, and may be communicated to third parties belonging to Wolopay group of companies, business partners or service providers. By requesting us services and disclosing us your personal data you hereby consent and agree to the previously described treatment and communication of such.<br><br>
    Users may revoke such consent and exercise their rights of access, rectification, cancellation and opposition by sending an email to info@wolopay.com attaching a scanned copy of a valid ID.


    <h3>3. AMENDMENTS</h3>

    Wolopay, SL may at any time amend this Privacy Policy by posting the amended version on the relevant section of this website and a notice on its main page. By using this website after such posting you agree to be bound by the new terms. Check this page regularly to keep abreast of any changes.

";
        
        $__internal_244818eb854fef1e2f19946e929b8b135605f29822755b9b13d9a386a9d8e32c->leave($__internal_244818eb854fef1e2f19946e929b8b135605f29822755b9b13d9a386a9d8e32c_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig";
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
/* {% extends "@App/Others/Default/PrivacyPolicy/privacy_policy_layout.html.twig" %}*/
/* {% block title %}Legal Notice{% endblock %}*/
/* {% block page %}*/
/* */
/*     <h1>PRIVACY POLICY</h1>*/
/* */
/*     <h3>1. COOKIES</h3>*/
/*     By visiting this website, the user consents to store cookies on his/her device. A cookie is a file of information sent by a website and kept by the browser and is used to store and retrieve information regarding navigation on the device.<br><br>*/
/*     In this regard, the user authorizes Wolopay, SL to store and retrieve data using cookies in his/her browser, needed to manage the user session, save user preferences or collect usage statistics, amongst other things.<br><br>*/
/*     The types of cookies that may be used on this website, and the purpose thereof and, if applicable, third party cookies used (service providers) are:*/
/* */
/*     <br><br>*/
/* */
/*     <ul>*/
/*         <li>Cookies strictly necessary to provide the services requested by the user on the website. If these cookies are disabled, the user will be unable to properly interact with our content and services.</li>*/
/*         <li>Analytical Cookies (for monitoring and statistical analysis of user behavior as a whole), advertising cookies (to manage advertising space such as the frequency with which the ads are displayed) and behavioral cookies (to manage advertising space based on the specific profile). If these cookies are disabled, the website will continue to operate, but we will not be able to personalize the ads according to your specific interests.</li>*/
/*     </ul>*/
/* */
/*     <br>*/
/* */
/*     You can learn how to configure the installation or uninstall cookies through the help section of your browser. If you need further assistance please send an email to info@wolopay.com.*/
/* */
/*     <h3>2. DATA PROTECTION</h3>*/
/* */
/*     The information collected by Wolopay, SL of the website users, either through the cookies mechanism or any other similar device, such as an eventual electronic form, will be treated with the utmost confidentiality.<br><br>*/
/*     If any personal data are collected, in compliance with the provisions of applicable regulations we hereby inform you that these shall be incorporated in an automatized file owned by Wolopay, SL duly registered at the relevant Data Protection Authority.<br><br>*/
/*     Said personal data will be used exclusively for providing you the services requested and for marketing purposes, and may be communicated to third parties belonging to Wolopay group of companies, business partners or service providers. By requesting us services and disclosing us your personal data you hereby consent and agree to the previously described treatment and communication of such.<br><br>*/
/*     Users may revoke such consent and exercise their rights of access, rectification, cancellation and opposition by sending an email to info@wolopay.com attaching a scanned copy of a valid ID.*/
/* */
/* */
/*     <h3>3. AMENDMENTS</h3>*/
/* */
/*     Wolopay, SL may at any time amend this Privacy Policy by posting the amended version on the relevant section of this website and a notice on its main page. By using this website after such posting you agree to be bound by the new terms. Check this page regularly to keep abreast of any changes.*/
/* */
/* {% endblock %}*/
