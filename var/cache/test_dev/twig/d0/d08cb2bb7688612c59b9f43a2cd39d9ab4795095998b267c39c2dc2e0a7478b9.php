<?php

/* AppBundle:Others/Default/FAQ:faq_it.html.twig */
class __TwigTemplate_b732b62dde5b625d46bd67d3624aeea5bbd7cdd8e758e33f3df15c3f9d3b3691 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_it.html.twig", 1);
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
        $__internal_d98ba6297657e407642ee539628b0db4138d9d7ced8c75fedcd459c8e033f7b4 = $this->env->getExtension("native_profiler");
        $__internal_d98ba6297657e407642ee539628b0db4138d9d7ced8c75fedcd459c8e033f7b4->enter($__internal_d98ba6297657e407642ee539628b0db4138d9d7ced8c75fedcd459c8e033f7b4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_it.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_d98ba6297657e407642ee539628b0db4138d9d7ced8c75fedcd459c8e033f7b4->leave($__internal_d98ba6297657e407642ee539628b0db4138d9d7ced8c75fedcd459c8e033f7b4_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_56f6993a9049f9c6ec84824540903176ee498a1ee8559ffe00e43a0f7e1d15ca = $this->env->getExtension("native_profiler");
        $__internal_56f6993a9049f9c6ec84824540903176ee498a1ee8559ffe00e43a0f7e1d15ca->enter($__internal_56f6993a9049f9c6ec84824540903176ee498a1ee8559ffe00e43a0f7e1d15ca_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Domande Frequenti";
        
        $__internal_56f6993a9049f9c6ec84824540903176ee498a1ee8559ffe00e43a0f7e1d15ca->leave($__internal_56f6993a9049f9c6ec84824540903176ee498a1ee8559ffe00e43a0f7e1d15ca_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_4d499e71a93b545516311c6e2a03bffa6fcac51d6d77a7aab2d95322b9de324f = $this->env->getExtension("native_profiler");
        $__internal_4d499e71a93b545516311c6e2a03bffa6fcac51d6d77a7aab2d95322b9de324f->enter($__internal_4d499e71a93b545516311c6e2a03bffa6fcac51d6d77a7aab2d95322b9de324f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Domande Frequenti</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Ho inviato un SMS, ma non ho ricevuto risposta</h3>
    <p>
        ci possono essere svariati motivi:
    <ul>
        <li> Non hai scritto correttamente il testo, o lo hai inviato ad un numero sbagliato; verifica, e se trovi un errore, reinvialo.</li>
        <li> Hai una carta prepagata e non hai saldo sufficiente.</li>
        <li> Il tuo numero di cellulare è in una \"lista nera\" del nostro sistema, o perché è stato richiesto dal titolare del contratto, o perché sono state registrate varie fatture precedenti non pagate.</li>
        <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, viene bloccato di default e per poterlo usare devi contattare il servizio clienti e richiedere l'attivazione.</li>
        <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, sotto richiesta del titolare del contratto. </li>
        <li> Il tuo operatore non permette l'uso dei servizi premium (molti operatori virtuali non lo permettono). Devi scegliere un altra modalità di pagamento.</li>
        <li> Certi operatori non permettono l'uso di SMS Premium in contratti aziendali, oppure l'accesso deve essere inviato al numero con uno zero davanti. Per esempioal 025522. </li>
    </ul>
    </p>

    <p> Se il tuo caso non è nessuno di quelli precedenti, visita il nostro centro assistenza e compila il modulo indicando il numero di telefono dal quale hai provato. Analizzeremo il tutto e ti contatteremo per darti delle spiegazioni.
    </p>

    <h3 id=\"cant_call\">Non riesco a chiamare il numero di telefono che appare sullo schermo.</h3>
    <p>
        Come con gli SMS, esistono vari motivi:
    <ul>
        <li> Non lo hai composto correttamente; verificalo, e riprova.</li>
        <li> Hai una carta prepagata e non hai saldo sufficiente.</li>
        <li> Il tuo numero di cellulare è in una \"lista nera\" del nostro sistema, o perché è stato richiesto dal titolare del contratto, o perché sono state registrate varie fatture precedenti non pagate.</li>
        <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, viene bloccato di default e per poterlo usare devi contattare il servizio clienti e richiedere l'attivazione.</li>
        <li> Anche molte aziende bloccano l'accesso ai servizi premium, sia da linea fissa che da mobile.</li>
        <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, sotto richiesta del titolare del contratto. </li>
        <li> Il tuo operatore non permette l'uso dei servizi premium (molti operatori virtuali non lo permettono). Devi scegliere un altra modalità di pagamento.</li>
        <li> Certi operatori non permettono l'uso dei servizi Premium in contratti aziendali; se è questo il caso, sarà il titolare del contratto a dover sollicitare l'attivazione.</li>
    </ul>
    </p>
    <p>
        Se credi che non sia causato da nessuno dei sopracitati motivi, visita il nostro centro assistenza e compila il modulo indicando il numero di telefono dal quale hai provato. Analizzeremo il tutto e ti contatteremo per darti delle spiegazioni.
    </p>
    <h3 id=\"paypal_doesnt_work\"> Ho pagato con PayPal, però non appaiono i crediti nel mio conto.</h3>
    <p>
        Devi inviare a  support@wolopay.net il codice della transazione, sia di Wolopay, sia di PayPal, e una prova dell'avvenuto pagamento. Una volta verificati i dati, ci metteremo in contatto col gioco per informarli dell'accaduto e sollecitare l'operazione.
    </p>

    <h3 id=\"code_sms\">Ho inviato un SMS (o chiamato per telefono) e mi hanno dato un codice. Dove lo metto?</h3>
    <p>
        Se hai inviato un sms con la parola chiave, o hai chiamato al solito telefono del gioco, ma senza aver ancora iniziato l'acquisto in quest'ultimo, non possiamo collegare il tuo messaggio (o chiamata) a nessuna operazione, per cui, non possiamo inviare notifiche al gioco per richiedere l'aggiunta dei tuoi crediti. Devi entrare nel gioco, sezione ricarica account, selezionare la modalità di pagamento, e nelle istruzioni, non inviare l'SMS né chiamare. Nel secondo passaggio, potrai inserire il codice, ma dovrai farlo una sola volta.
    </p>

    <h3 id=\"code_pre_inserted\">Avevo un codice, e, inserendolo, mi dicono che è già stato utilizzato</h3>
    <p>
        Visita il nostro centro assistenza, inserisci i dati richiesti incluso codice e la tua email, e verificheremo che il codice non sia stato usato (se sì, dove e quando). Ti invieremo poi la soluzione via mail (un codice nuovo).
    </p>

";
        
        $__internal_4d499e71a93b545516311c6e2a03bffa6fcac51d6d77a7aab2d95322b9de324f->leave($__internal_4d499e71a93b545516311c6e2a03bffa6fcac51d6d77a7aab2d95322b9de324f_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_it.html.twig";
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
/* {% block title %}FAQ, Domande Frequenti{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Domande Frequenti</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Ho inviato un SMS, ma non ho ricevuto risposta</h3>*/
/*     <p>*/
/*         ci possono essere svariati motivi:*/
/*     <ul>*/
/*         <li> Non hai scritto correttamente il testo, o lo hai inviato ad un numero sbagliato; verifica, e se trovi un errore, reinvialo.</li>*/
/*         <li> Hai una carta prepagata e non hai saldo sufficiente.</li>*/
/*         <li> Il tuo numero di cellulare è in una "lista nera" del nostro sistema, o perché è stato richiesto dal titolare del contratto, o perché sono state registrate varie fatture precedenti non pagate.</li>*/
/*         <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, viene bloccato di default e per poterlo usare devi contattare il servizio clienti e richiedere l'attivazione.</li>*/
/*         <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, sotto richiesta del titolare del contratto. </li>*/
/*         <li> Il tuo operatore non permette l'uso dei servizi premium (molti operatori virtuali non lo permettono). Devi scegliere un altra modalità di pagamento.</li>*/
/*         <li> Certi operatori non permettono l'uso di SMS Premium in contratti aziendali, oppure l'accesso deve essere inviato al numero con uno zero davanti. Per esempioal 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Se il tuo caso non è nessuno di quelli precedenti, visita il nostro centro assistenza e compila il modulo indicando il numero di telefono dal quale hai provato. Analizzeremo il tutto e ti contatteremo per darti delle spiegazioni.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Non riesco a chiamare il numero di telefono che appare sullo schermo.</h3>*/
/*     <p>*/
/*         Come con gli SMS, esistono vari motivi:*/
/*     <ul>*/
/*         <li> Non lo hai composto correttamente; verificalo, e riprova.</li>*/
/*         <li> Hai una carta prepagata e non hai saldo sufficiente.</li>*/
/*         <li> Il tuo numero di cellulare è in una "lista nera" del nostro sistema, o perché è stato richiesto dal titolare del contratto, o perché sono state registrate varie fatture precedenti non pagate.</li>*/
/*         <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, viene bloccato di default e per poterlo usare devi contattare il servizio clienti e richiedere l'attivazione.</li>*/
/*         <li> Anche molte aziende bloccano l'accesso ai servizi premium, sia da linea fissa che da mobile.</li>*/
/*         <li> Il tuo operatore ha bloccato l'accesso ai servizi premium, sotto richiesta del titolare del contratto. </li>*/
/*         <li> Il tuo operatore non permette l'uso dei servizi premium (molti operatori virtuali non lo permettono). Devi scegliere un altra modalità di pagamento.</li>*/
/*         <li> Certi operatori non permettono l'uso dei servizi Premium in contratti aziendali; se è questo il caso, sarà il titolare del contratto a dover sollicitare l'attivazione.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Se credi che non sia causato da nessuno dei sopracitati motivi, visita il nostro centro assistenza e compila il modulo indicando il numero di telefono dal quale hai provato. Analizzeremo il tutto e ti contatteremo per darti delle spiegazioni.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> Ho pagato con PayPal, però non appaiono i crediti nel mio conto.</h3>*/
/*     <p>*/
/*         Devi inviare a  support@wolopay.net il codice della transazione, sia di Wolopay, sia di PayPal, e una prova dell'avvenuto pagamento. Una volta verificati i dati, ci metteremo in contatto col gioco per informarli dell'accaduto e sollecitare l'operazione.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">Ho inviato un SMS (o chiamato per telefono) e mi hanno dato un codice. Dove lo metto?</h3>*/
/*     <p>*/
/*         Se hai inviato un sms con la parola chiave, o hai chiamato al solito telefono del gioco, ma senza aver ancora iniziato l'acquisto in quest'ultimo, non possiamo collegare il tuo messaggio (o chiamata) a nessuna operazione, per cui, non possiamo inviare notifiche al gioco per richiedere l'aggiunta dei tuoi crediti. Devi entrare nel gioco, sezione ricarica account, selezionare la modalità di pagamento, e nelle istruzioni, non inviare l'SMS né chiamare. Nel secondo passaggio, potrai inserire il codice, ma dovrai farlo una sola volta.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Avevo un codice, e, inserendolo, mi dicono che è già stato utilizzato</h3>*/
/*     <p>*/
/*         Visita il nostro centro assistenza, inserisci i dati richiesti incluso codice e la tua email, e verificheremo che il codice non sia stato usato (se sì, dove e quando). Ti invieremo poi la soluzione via mail (un codice nuovo).*/
/*     </p>*/
/* */
/* {% endblock %}*/
