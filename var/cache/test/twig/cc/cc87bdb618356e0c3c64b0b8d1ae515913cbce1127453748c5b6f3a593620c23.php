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
        $__internal_4ded5f004bf7a0e86e293261d24af2961b91cf333765c1ced6cedbc4b150da35 = $this->env->getExtension("native_profiler");
        $__internal_4ded5f004bf7a0e86e293261d24af2961b91cf333765c1ced6cedbc4b150da35->enter($__internal_4ded5f004bf7a0e86e293261d24af2961b91cf333765c1ced6cedbc4b150da35_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4ded5f004bf7a0e86e293261d24af2961b91cf333765c1ced6cedbc4b150da35->leave($__internal_4ded5f004bf7a0e86e293261d24af2961b91cf333765c1ced6cedbc4b150da35_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_ed783df97155335d78322d1ca3101facd72af3a436ac24cbcf6f9b3cc36c7add = $this->env->getExtension("native_profiler");
        $__internal_ed783df97155335d78322d1ca3101facd72af3a436ac24cbcf6f9b3cc36c7add->enter($__internal_ed783df97155335d78322d1ca3101facd72af3a436ac24cbcf6f9b3cc36c7add_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Legal Notice";
        
        $__internal_ed783df97155335d78322d1ca3101facd72af3a436ac24cbcf6f9b3cc36c7add->leave($__internal_ed783df97155335d78322d1ca3101facd72af3a436ac24cbcf6f9b3cc36c7add_prof);

    }

    // line 3
    public function block_page($context, array $blocks = array())
    {
        $__internal_047c9cf8e54ef88879fa3fb958b3d91f62efdd52b0b7f2101c9bf20d7a8a563e = $this->env->getExtension("native_profiler");
        $__internal_047c9cf8e54ef88879fa3fb958b3d91f62efdd52b0b7f2101c9bf20d7a8a563e->enter($__internal_047c9cf8e54ef88879fa3fb958b3d91f62efdd52b0b7f2101c9bf20d7a8a563e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

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
        
        $__internal_047c9cf8e54ef88879fa3fb958b3d91f62efdd52b0b7f2101c9bf20d7a8a563e->leave($__internal_047c9cf8e54ef88879fa3fb958b3d91f62efdd52b0b7f2101c9bf20d7a8a563e_prof);

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
