<?php

/* AppBundle:Others/Default/FAQ:faq_ro.html.twig */
class __TwigTemplate_5d1d5fccc9d4e9285a2823a774bd1c5651af2499002cce90bb0c25876a9afa25 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_ro.html.twig", 1);
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
        $__internal_d6c22d0a589a2d33ac21cf2bc77e7198480c28aaa5649f5f27f1237a4c2b8147 = $this->env->getExtension("native_profiler");
        $__internal_d6c22d0a589a2d33ac21cf2bc77e7198480c28aaa5649f5f27f1237a4c2b8147->enter($__internal_d6c22d0a589a2d33ac21cf2bc77e7198480c28aaa5649f5f27f1237a4c2b8147_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_ro.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d6c22d0a589a2d33ac21cf2bc77e7198480c28aaa5649f5f27f1237a4c2b8147->leave($__internal_d6c22d0a589a2d33ac21cf2bc77e7198480c28aaa5649f5f27f1237a4c2b8147_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_51a988147c9cdde4c07b1860c47696a3fd3afb3593fc91cfb15bb5ff7de708f8 = $this->env->getExtension("native_profiler");
        $__internal_51a988147c9cdde4c07b1860c47696a3fd3afb3593fc91cfb15bb5ff7de708f8->enter($__internal_51a988147c9cdde4c07b1860c47696a3fd3afb3593fc91cfb15bb5ff7de708f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Întrebări frecvente";
        
        $__internal_51a988147c9cdde4c07b1860c47696a3fd3afb3593fc91cfb15bb5ff7de708f8->leave($__internal_51a988147c9cdde4c07b1860c47696a3fd3afb3593fc91cfb15bb5ff7de708f8_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_1cf8b26c12eb55c56fb77a516d518e27fda9ba4271e42a276e24280d7613093d = $this->env->getExtension("native_profiler");
        $__internal_1cf8b26c12eb55c56fb77a516d518e27fda9ba4271e42a276e24280d7613093d->enter($__internal_1cf8b26c12eb55c56fb77a516d518e27fda9ba4271e42a276e24280d7613093d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Întrebări frecvente</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Am trimis un SMS, dar nu am primit nici un răspuns</h3>
    <p>
        pot exista mai multe motive pentru acest lucru:
    <ul>
        <li> Nu ați scris textul corect, sau l-ați trimis către un număr greșit; verificați, în cazul în care s-a produs o anumită eroare, retrimiteți mesajul.</li>
        <li> Utilizați o cartelă PrePay și nu aveți credit suficient.</li>
        <li> Numărul dvs. de mobil este inclus într-o \"listă neagră\" în sistemul nostru, fie la solicitarea titularului contractului, fie pentru că pentru acest număr s-au înregistrat neplăți pentru facturile anterioare.</li>
        <li> Aveți blocat accesul la serviciul premium de către operatorul dvs., acesta fiind blocat în mod implicit iar pentru a-l putea utiliza, trebuie să contactați operatorul dvs. de telefonie mobilă și să solicitați activarea acestuia.</li>
        <li> Aveți blocat accesul la serviciul premium de către operatorul dvs. la solicitarea din partea titularului contractului. </li>
        <li> Operatorul dvs. nu permite utilizarea serviciilor premium (mulți operatori virtuali nu permit acest lucru). Trebuie să alegeți o altă modalitate de plată.</li>
        <li> Anumiți operatori nu permit utilizarea de SMS-uri Premium, sau accesul se realizează prin trimiterea către numărul respectiv cu un zero în față. De exemplu, 025522. </li>
    </ul>
    </p>

    <p> Dacă credeți că nici unul dintre motivele menționate anterior nu corespunde cazului dvs., vizitați secțiunea Suport și completați formularul indicând  numărul de mobil utilizat. Vom verifica cazul dvs. și vă vom contacta pentru a vă oferi o explicație cu privire la ceea ce s-a întâmplat.
    </p>

    <h3 id=\"cant_call\">Nu am putut suna la numărul de telefon apărut pe ecran.</h3>
    <p>
        La fel ca și în cazul SMS-urilor, pot exista diferite motive:
    <ul>
        <li> Nu ați tastat corect; verificați și încercați din nou.</li>
        <li> Utilizați o cartelă PrePay și nu aveți credit suficient.</li>
        <li> Numărul dvs. de mobil este inclus într-o \"listă neagră\" în sistemul nostru, fie la solicitarea titularului contractului, fie pentru că pentru acest număr s-au înregistrat neplăți pentru facturile anterioare.</li>
        <li> Aveți blocat accesul la serviciul premium de către operatorul dvs., acesta fiind blocat în mod implicit iar pentru a-l putea utiliza, trebuie să contactați operatorul dvs. de telefonie mobilă și să solicitați activarea acestuia.</li>
        <li> De asemenea multe companii blochează accesul la serviciile premium pentru utilizatorii săi, atât pentru cei de telefonie fixă cât și pentru cei de telefonie mobilă.</li>
        <li> Aveți blocat accesul la serviciul premium de către operatorul dvs. la solicitarea din partea titularului contractului. </li>
        <li> Operatorul dvs. nu permite utilizarea serviciilor premium (mulți operatori virtuali nu permit acest lucru). Trebuie să alegeți o altă modalitate de plată.</li>
        <li> Anumiți operatori nu permit utilizarea de servicii premium în contractele pentru persoane juridide; în acest caz, titularul contractului trebuie să solicite activarea acestuia.</li>
    </ul>
    </p>
    <p>
        Dacă credeți că nici unul dintre motivele menționate anterior nu corespunde cazului dvs., vizitați secțiunea Suport și completați formularul indicând  numărul de mobil utilizat. Vom verifica cazul dvs. și vă vom contacta pentru a vă oferi o explicație cu privire la ceea ce s-a întâmplat.
    </p>
    <h3 id=\"paypal_doesnt_work\"> Am efectuat plata prin intermediul PayPal, dar nu îmi apar creditele în cont.</h3>
    <p>
        Este necesar să ne trimiteți către support@wolopay.net identificatorul tranzacției, atât cel de Wolopay cât și cel de PayPal, precum și dovada de plată a acestuia. După ce vom verifica informațiile, ne vom pune în contact cu jocul pentru a informa despre cele întamplate și pentru a procesa tranzacția.
    </p>

    <h3 id=\"code_sms\">Am trimis un SMS (sau am realizat un apel telefonic), și dispun de un cod. Cum procedez în continuare?</h3>
    <p>
        Dacă ați trimis un SMS cu alias-ul dvs., sau ați sunat la numărul de  telefon al jocului, fără a începe procesul de achiziționare cu acesta, nu putem atribui mesajul dvs. (sau apelul) nici unei tranzacții, prin urmare, nu putem notifica jocul pentru a vă adăuga creditele. Trebuie să începeți sesiunea în joc, intrati în secțiunea pentru a reîncărca contul, selectați metoda de plată, iar în instrucțiuni nu trimiteți SMS nici nu sunați, în cea de-a doua etapă, puteți introduce codul, însă o singură dată.
    </p>

    <h3 id=\"code_pre_inserted\">Aveam un cod, iar după ce l-am introdus, am fost notificat că a fost deja folosit.</h3>
    <p>
        Vizitați sectiunea Suport, introduceți datele necesare, inclusiv codul și e-mail-ul dvs., și vom verifica dacă s-a utilizat codul (unde și când), iar dacă nu, vă vom da o soluție prin e-mail (un nou cod).
    </p>


";
        
        $__internal_1cf8b26c12eb55c56fb77a516d518e27fda9ba4271e42a276e24280d7613093d->leave($__internal_1cf8b26c12eb55c56fb77a516d518e27fda9ba4271e42a276e24280d7613093d_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_ro.html.twig";
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
/* {% block title %}FAQ, Întrebări frecvente{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Întrebări frecvente</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Am trimis un SMS, dar nu am primit nici un răspuns</h3>*/
/*     <p>*/
/*         pot exista mai multe motive pentru acest lucru:*/
/*     <ul>*/
/*         <li> Nu ați scris textul corect, sau l-ați trimis către un număr greșit; verificați, în cazul în care s-a produs o anumită eroare, retrimiteți mesajul.</li>*/
/*         <li> Utilizați o cartelă PrePay și nu aveți credit suficient.</li>*/
/*         <li> Numărul dvs. de mobil este inclus într-o "listă neagră" în sistemul nostru, fie la solicitarea titularului contractului, fie pentru că pentru acest număr s-au înregistrat neplăți pentru facturile anterioare.</li>*/
/*         <li> Aveți blocat accesul la serviciul premium de către operatorul dvs., acesta fiind blocat în mod implicit iar pentru a-l putea utiliza, trebuie să contactați operatorul dvs. de telefonie mobilă și să solicitați activarea acestuia.</li>*/
/*         <li> Aveți blocat accesul la serviciul premium de către operatorul dvs. la solicitarea din partea titularului contractului. </li>*/
/*         <li> Operatorul dvs. nu permite utilizarea serviciilor premium (mulți operatori virtuali nu permit acest lucru). Trebuie să alegeți o altă modalitate de plată.</li>*/
/*         <li> Anumiți operatori nu permit utilizarea de SMS-uri Premium, sau accesul se realizează prin trimiterea către numărul respectiv cu un zero în față. De exemplu, 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Dacă credeți că nici unul dintre motivele menționate anterior nu corespunde cazului dvs., vizitați secțiunea Suport și completați formularul indicând  numărul de mobil utilizat. Vom verifica cazul dvs. și vă vom contacta pentru a vă oferi o explicație cu privire la ceea ce s-a întâmplat.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Nu am putut suna la numărul de telefon apărut pe ecran.</h3>*/
/*     <p>*/
/*         La fel ca și în cazul SMS-urilor, pot exista diferite motive:*/
/*     <ul>*/
/*         <li> Nu ați tastat corect; verificați și încercați din nou.</li>*/
/*         <li> Utilizați o cartelă PrePay și nu aveți credit suficient.</li>*/
/*         <li> Numărul dvs. de mobil este inclus într-o "listă neagră" în sistemul nostru, fie la solicitarea titularului contractului, fie pentru că pentru acest număr s-au înregistrat neplăți pentru facturile anterioare.</li>*/
/*         <li> Aveți blocat accesul la serviciul premium de către operatorul dvs., acesta fiind blocat în mod implicit iar pentru a-l putea utiliza, trebuie să contactați operatorul dvs. de telefonie mobilă și să solicitați activarea acestuia.</li>*/
/*         <li> De asemenea multe companii blochează accesul la serviciile premium pentru utilizatorii săi, atât pentru cei de telefonie fixă cât și pentru cei de telefonie mobilă.</li>*/
/*         <li> Aveți blocat accesul la serviciul premium de către operatorul dvs. la solicitarea din partea titularului contractului. </li>*/
/*         <li> Operatorul dvs. nu permite utilizarea serviciilor premium (mulți operatori virtuali nu permit acest lucru). Trebuie să alegeți o altă modalitate de plată.</li>*/
/*         <li> Anumiți operatori nu permit utilizarea de servicii premium în contractele pentru persoane juridide; în acest caz, titularul contractului trebuie să solicite activarea acestuia.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Dacă credeți că nici unul dintre motivele menționate anterior nu corespunde cazului dvs., vizitați secțiunea Suport și completați formularul indicând  numărul de mobil utilizat. Vom verifica cazul dvs. și vă vom contacta pentru a vă oferi o explicație cu privire la ceea ce s-a întâmplat.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> Am efectuat plata prin intermediul PayPal, dar nu îmi apar creditele în cont.</h3>*/
/*     <p>*/
/*         Este necesar să ne trimiteți către support@wolopay.net identificatorul tranzacției, atât cel de Wolopay cât și cel de PayPal, precum și dovada de plată a acestuia. După ce vom verifica informațiile, ne vom pune în contact cu jocul pentru a informa despre cele întamplate și pentru a procesa tranzacția.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">Am trimis un SMS (sau am realizat un apel telefonic), și dispun de un cod. Cum procedez în continuare?</h3>*/
/*     <p>*/
/*         Dacă ați trimis un SMS cu alias-ul dvs., sau ați sunat la numărul de  telefon al jocului, fără a începe procesul de achiziționare cu acesta, nu putem atribui mesajul dvs. (sau apelul) nici unei tranzacții, prin urmare, nu putem notifica jocul pentru a vă adăuga creditele. Trebuie să începeți sesiunea în joc, intrati în secțiunea pentru a reîncărca contul, selectați metoda de plată, iar în instrucțiuni nu trimiteți SMS nici nu sunați, în cea de-a doua etapă, puteți introduce codul, însă o singură dată.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Aveam un cod, iar după ce l-am introdus, am fost notificat că a fost deja folosit.</h3>*/
/*     <p>*/
/*         Vizitați sectiunea Suport, introduceți datele necesare, inclusiv codul și e-mail-ul dvs., și vom verifica dacă s-a utilizat codul (unde și când), iar dacă nu, vă vom da o soluție prin e-mail (un nou cod).*/
/*     </p>*/
/* */
/* */
/* {% endblock %}*/
