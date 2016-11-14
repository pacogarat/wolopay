<?php

/* AppBundle:Others/Default/FAQ:faq_en.html.twig */
class __TwigTemplate_f7c8e66c74958e08e354eb98ff38d3d3768fbdeb57fa531f912a8b3c8174a492 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_en.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'faq_txt' => array($this, 'block_faq_txt'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Others/Default/FAQ/faq_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_cdb3dc0520f07967df2096bd2accba32a255efcd5c2bc405e3447b26624cdf96 = $this->env->getExtension("native_profiler");
        $__internal_cdb3dc0520f07967df2096bd2accba32a255efcd5c2bc405e3447b26624cdf96->enter($__internal_cdb3dc0520f07967df2096bd2accba32a255efcd5c2bc405e3447b26624cdf96_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_en.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cdb3dc0520f07967df2096bd2accba32a255efcd5c2bc405e3447b26624cdf96->leave($__internal_cdb3dc0520f07967df2096bd2accba32a255efcd5c2bc405e3447b26624cdf96_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_01f13766545425793e078beeba874bbc7fdc30ec2227334260ea7e455a3a781c = $this->env->getExtension("native_profiler");
        $__internal_01f13766545425793e078beeba874bbc7fdc30ec2227334260ea7e455a3a781c->enter($__internal_01f13766545425793e078beeba874bbc7fdc30ec2227334260ea7e455a3a781c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Frequently asked Questions";
        
        $__internal_01f13766545425793e078beeba874bbc7fdc30ec2227334260ea7e455a3a781c->leave($__internal_01f13766545425793e078beeba874bbc7fdc30ec2227334260ea7e455a3a781c_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_23d85568dbb24ec93de5499099e256dd48df2ed82c62a7a39497d3aab89b6972 = $this->env->getExtension("native_profiler");
        $__internal_23d85568dbb24ec93de5499099e256dd48df2ed82c62a7a39497d3aab89b6972->enter($__internal_23d85568dbb24ec93de5499099e256dd48df2ed82c62a7a39497d3aab89b6972_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">Frequently Answered Questions</h2>
    <h3 class=\"voffset4\">I've sent an SMS, but I haven't received any answer</h3>
    <p class=\"voffset3\">
        There may be some reasons for this behavior:
    <ul>
        <li> You have mistyped the text, or have sent the message to a wrong number; please check it, and if it was the case, please send it again.</li>
        <li> You don't have enough credit in your prepaid card.</li>
        <li> Your number is \"blacklisted\" in our system, whether because the owner of the contract has requested it, whether because we've notified by the operator that a previous invoice has not been paid.</li>
        <li> You can't access premium SMS services from your line, because those kind of services are not activated by default. You have to contact your operator for their activation.</li>
        <li> Operator has blocked premium SMS services in you line, because the holder of the contract has requested so.</li>
        <li> Premium SMS services are not available in your operator (many small MVNOs, that is, virtual operators, don't allow them)</li>
        <li> Some operators don't allow Premium SMS services to be used in \"company contracts\", or the access is done prepending a leading zero to the number, that is, you'd have to send to 025522. </li>
    </ul>
    </p>

    <p> If you believe your case is none of the aboe, please visit our support center, fill in the form including the mobile phone number from which you tried. We'll check the problem and put in contact with you to give an explanation of the problem.
    </p>

    <h3>I haven't been able to call the phone number that appeared in the instructions.</h3>
    <p>
        As for SMS, there may be some reasons for this behavior:
    <ul>
        <li> You have mistyped the number, please check and try again.</li>
        <li> You don't have enough credit in your prepaid card.</li>
        <li> Your number is \"blacklisted\" in our system, whether because the owner of the contract has requested it, whether because we've notified by the operator that a previous invoice has not been paid.</li>
        <li> You can't access premium SMS services from your line, because those kind of services are not activated by default. You have to contact your operator for their activation.</li>
        <li> Many companies block the access to premium services to their users, both from landlines as well as from mobile phones.</li>
        <li> Operator has blocked premium services in you line, because the holder of the contract has requested so. </li>
        <li> Premium services are not available in your operator (many small MVNOs, that is, virtual operators, don't allow them)</li>
        <li> Some operators don't allow Premium services to be used in \"company contracts\", if it's the case, the holder of the contract is the one who has to ask for their activation.</li>
    </ul>
    </p>
    <p>
        If you believe your case is none of the aboe, please visit our support center, fill in the form including the phone number from which you tried. We'll check the problem and put in contact with you to give an explanation of the problem.
    </p>
    <h3>I've paid with payPal, but the credits are not in my account.</h3>
    <p>
        We need you to send us to support@wolopay.net the identifier of the transaction, both wolopay's and PayPals transaction IDs, along with the proof of payment of the latter. Once we check the information, we'll put in contact with the game to inform about the issue so they proceed to finalize the transaction.
    </p>

    <h3>I've sent an SMS (or made a call), and I have a code. Where do I have to enter it?</h3>
    <p>
        If you've sent an SMS with the keyword, or you've called the usual game phone number, but without having initiated the purchase inside it, we can't assign your message (or call) to a transaction, and therefore, we can't notify the game so that they add your credits. You have to enter the game, go to the credit area, select the payment method, and while in the instructions, don't send a new SMS or make a new call. Click continue, and in the second step, you'll be able to enter the code (only once!).
    </p>

    <h3>I had a code, and when inserting it, I'm told that it has been used</h3>
    <p>
        Visit our support center, enter the required information including the code and your mail, and we'll check if the code was used (if so, where and when), and if not, we''ll give you a solution via email (a new code).
    </p>

";
        
        $__internal_23d85568dbb24ec93de5499099e256dd48df2ed82c62a7a39497d3aab89b6972->leave($__internal_23d85568dbb24ec93de5499099e256dd48df2ed82c62a7a39497d3aab89b6972_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_en.html.twig";
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
/* {% extends "@App/Others/Default/FAQ/faq_layout.html.twig" %}*/
/* {% block title %}FAQ, Frequently asked Questions{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">Frequently Answered Questions</h2>*/
/*     <h3 class="voffset4">I've sent an SMS, but I haven't received any answer</h3>*/
/*     <p class="voffset3">*/
/*         There may be some reasons for this behavior:*/
/*     <ul>*/
/*         <li> You have mistyped the text, or have sent the message to a wrong number; please check it, and if it was the case, please send it again.</li>*/
/*         <li> You don't have enough credit in your prepaid card.</li>*/
/*         <li> Your number is "blacklisted" in our system, whether because the owner of the contract has requested it, whether because we've notified by the operator that a previous invoice has not been paid.</li>*/
/*         <li> You can't access premium SMS services from your line, because those kind of services are not activated by default. You have to contact your operator for their activation.</li>*/
/*         <li> Operator has blocked premium SMS services in you line, because the holder of the contract has requested so.</li>*/
/*         <li> Premium SMS services are not available in your operator (many small MVNOs, that is, virtual operators, don't allow them)</li>*/
/*         <li> Some operators don't allow Premium SMS services to be used in "company contracts", or the access is done prepending a leading zero to the number, that is, you'd have to send to 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> If you believe your case is none of the aboe, please visit our support center, fill in the form including the mobile phone number from which you tried. We'll check the problem and put in contact with you to give an explanation of the problem.*/
/*     </p>*/
/* */
/*     <h3>I haven't been able to call the phone number that appeared in the instructions.</h3>*/
/*     <p>*/
/*         As for SMS, there may be some reasons for this behavior:*/
/*     <ul>*/
/*         <li> You have mistyped the number, please check and try again.</li>*/
/*         <li> You don't have enough credit in your prepaid card.</li>*/
/*         <li> Your number is "blacklisted" in our system, whether because the owner of the contract has requested it, whether because we've notified by the operator that a previous invoice has not been paid.</li>*/
/*         <li> You can't access premium SMS services from your line, because those kind of services are not activated by default. You have to contact your operator for their activation.</li>*/
/*         <li> Many companies block the access to premium services to their users, both from landlines as well as from mobile phones.</li>*/
/*         <li> Operator has blocked premium services in you line, because the holder of the contract has requested so. </li>*/
/*         <li> Premium services are not available in your operator (many small MVNOs, that is, virtual operators, don't allow them)</li>*/
/*         <li> Some operators don't allow Premium services to be used in "company contracts", if it's the case, the holder of the contract is the one who has to ask for their activation.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         If you believe your case is none of the aboe, please visit our support center, fill in the form including the phone number from which you tried. We'll check the problem and put in contact with you to give an explanation of the problem.*/
/*     </p>*/
/*     <h3>I've paid with payPal, but the credits are not in my account.</h3>*/
/*     <p>*/
/*         We need you to send us to support@wolopay.net the identifier of the transaction, both wolopay's and PayPals transaction IDs, along with the proof of payment of the latter. Once we check the information, we'll put in contact with the game to inform about the issue so they proceed to finalize the transaction.*/
/*     </p>*/
/* */
/*     <h3>I've sent an SMS (or made a call), and I have a code. Where do I have to enter it?</h3>*/
/*     <p>*/
/*         If you've sent an SMS with the keyword, or you've called the usual game phone number, but without having initiated the purchase inside it, we can't assign your message (or call) to a transaction, and therefore, we can't notify the game so that they add your credits. You have to enter the game, go to the credit area, select the payment method, and while in the instructions, don't send a new SMS or make a new call. Click continue, and in the second step, you'll be able to enter the code (only once!).*/
/*     </p>*/
/* */
/*     <h3>I had a code, and when inserting it, I'm told that it has been used</h3>*/
/*     <p>*/
/*         Visit our support center, enter the required information including the code and your mail, and we'll check if the code was used (if so, where and when), and if not, we''ll give you a solution via email (a new code).*/
/*     </p>*/
/* */
/* {% endblock %}*/
