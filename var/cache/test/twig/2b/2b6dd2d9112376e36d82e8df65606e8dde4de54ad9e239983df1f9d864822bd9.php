<?php

/* AppBundle:Others/Default/FAQ:faq_de.html.twig */
class __TwigTemplate_db02e2d501f931dd48ad9f2dbd7be43ed67b175672282fd641981104f6c6c3a9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_de.html.twig", 1);
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
        $__internal_4f7fdcce36e2235b60dfe75d037afa1273911c81d522b2a4c74898004663ee79 = $this->env->getExtension("native_profiler");
        $__internal_4f7fdcce36e2235b60dfe75d037afa1273911c81d522b2a4c74898004663ee79->enter($__internal_4f7fdcce36e2235b60dfe75d037afa1273911c81d522b2a4c74898004663ee79_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_de.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4f7fdcce36e2235b60dfe75d037afa1273911c81d522b2a4c74898004663ee79->leave($__internal_4f7fdcce36e2235b60dfe75d037afa1273911c81d522b2a4c74898004663ee79_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_fca4da130bcfc384b76377e0383cffc11473c3b81e7612b78c9e5bc3d5635bf3 = $this->env->getExtension("native_profiler");
        $__internal_fca4da130bcfc384b76377e0383cffc11473c3b81e7612b78c9e5bc3d5635bf3->enter($__internal_fca4da130bcfc384b76377e0383cffc11473c3b81e7612b78c9e5bc3d5635bf3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Často kladené otázky";
        
        $__internal_fca4da130bcfc384b76377e0383cffc11473c3b81e7612b78c9e5bc3d5635bf3->leave($__internal_fca4da130bcfc384b76377e0383cffc11473c3b81e7612b78c9e5bc3d5635bf3_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_b60088f5ed9fd3026ddc0a08d80f31d5f4d6a411166f36bb2036640c8611a9ae = $this->env->getExtension("native_profiler");
        $__internal_b60088f5ed9fd3026ddc0a08d80f31d5f4d6a411166f36bb2036640c8611a9ae->enter($__internal_b60088f5ed9fd3026ddc0a08d80f31d5f4d6a411166f36bb2036640c8611a9ae_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Häufig gestellte Fragen</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Ich habe eine SMS geschickt, aber keine Antwort erhalten.</h3>
    <p>
        Dafür kann es mehrere Gründe geben:
    <ul>
        <li> Du hast den Text falsch geschrieben oder du hast ihn an eine falsche Nummer gesendet; überprüfe das und wenn etwas falsch war, versuche es erneut. </li>
        <li> Du benutzt Prepaid und hast nicht genügend Guthaben.</li>
        <li> Deine Handynummer steht in unserem System auf einer \"Schwarzen Liste\". Entweder weil das der Vertragspartner es so eingefordert hat oder weil dein Anbieter ausstehende Zahlungen vorheriger Rechnungen vermerkt hat.</li>
        <li> Der Zugang zu Premium Services ist von deinem Anbieter standardmäßig gesperrt und um diese freizugeben, musst du den Kundenservice deines Anbieters kontaktieren.</li>
        <li> Der Zugang zu den Premium Services deines Anbieters ist gesperrt, da der Vertragspartner dies so eingefordert hat. </li>
        <li> Dein Anbieter erlaubt die Nutzung von Premium Services nicht (viele virtuelle Anbieter erlauben das nicht). Du musst ein anderes Zahlungsmittel auswählen.</li>
        <li> Einige Anbieter erlauben die Verwendung des SMS Premium Services in Geschäftsverträgen nicht oder der Zugang muss durch das Anfügen einer 0 hergestellt werden. Zum Beispiel so: 025522. </li>
    </ul>
    </p>

    <p> Wenn du denkst, dass keines dieser Motive zutrifft, geh auf unsere Support Seite, fülle das Formular aus und gib die Telefonnummer an, mit der du es probiert hast. Wir überprüfen den Fall und kontaktieren dich wieder, um dir das Problem zu erklären.
    </p>

    <h3 id=\"cant_call\">Ich konnte die Nummer, die auf dem Bildschirm angezeigt wurde, nicht anrufen.</h3>
    <p>
        Ähnlich, wie mit SMS, kann das verschiedene Gründe haben:
    <ul>
        <li> Du hast die Nummer nicht exakt eingetippt; überprüfe das und versuche es erneut.</li>
        <li> Du benutzt Prepaid und nicht genügend Guthaben.</li>
        <li> Deine Handynummer steht in unserem System auf einer \"Schwarzen Liste\". Entweder weil das der Vertragspartner es so eingefordert hat oder weil dein Anbieter ausstehende Zahlungen vorheriger Rechnungen vermerkt hat.</li>
        <li> Der Zugang zu Premium Services ist von deinem Anbieter standardmäßig gesperrt und um diese freizugeben, musst du den Kundenservice deines Anbieters kontaktieren.</li>
        <li> Viele Unternehmen sperren den Zugang ihrer User zu Premium Services, von Festnetzen, ebenso wie von Handys.</li>
        <li> Der Zugang zu Premium Services ist bei deinem Anbieter gesperrt, da es der Vertragspartner, so eingefordert hat.</li>
        <li> Dein Anbieter erlaubt die Nutzung von Premium Services nicht (viele virtuelle Anbieter erlauben das nicht). Du musst ein anderes Zahlungsmittel auswählen.</li>
        <li> Einige Anbieter erlauben die Verwendung des SMS Premium Services in Geschäftsverträgen nicht; sollte das der Fall sein, ist der Vertragspartner dafür verantwortlich, die Aktivierung anzufordern.</li>
    </ul>
    </p>
    <p>
        Wenn du denkst, dass keines dieser Motive zutrifft, geh auf unsere Support Seite, fülle das Formular aus und gib die Telefonnummer an, mit der du es probiert hast. Wir überprüfen den Fall und kontaktieren dich wieder, um dir das Problem zu erklären.
    </p>
    <h3 id=\"paypal_doesnt_work\"> Ich habe mit PayPal bezahlt, aber die Credits erscheinen nicht auf meinem Konto.</h3>
    <p>
        Bitte sende eine Zahlungsbestätigung an support@wolopay.net, als Belg für diese letzte Zahlung. Sobald wir die Daten ausgewertet haben, kontaktieren wir das Spiel und informieren darüber, was passiert ist.
    </p>

    <h3 id=\"code_sms\">Ich habe eine SMS geschickt (oder über Telefon angerufen) und einen Code erhalten. Wo gebe ich diesen ein?</h3>
    <p>
        Wenn du eine SMS mit dem angegebenen Wort (Alias) geschickt oder die im Spiel angegebene Telefonnummer angerufen hast, aber keinen Einkauf angegebenen hast, können wir deine Nachricht (oder Anruf) keiner Transkation zuordnen und deshalb können wir das Spiel auch nicht darüber informieren, deine Credits auf dein Konto zu buchen. Du musst in das Spiel auf die Option \"Konto aufladen\" gehen, das Zahlungsmittel auswählen und entgegen der Anleitungen, weder SMS senden, noch anrufen und erst im zweiten Schritt den Code eingeben (einmalig).
    </p>

    <h3 id=\"code_pre_inserted\">Ich hatte einen Code, aber als ich ihn eingegeben habe, erschien die Nachricht, dass dieser bereits benutzt wurde.</h3>
    <p>
        Komm in auf unsere Supportseite, gibt die erforderlichen Daten, den Code und deine E-Mail Adresse an. Wir überprüfen, ob (wann und wo) der Code benutzt wurde und wenn dem nicht so ist, senden wir dir per Mail eine Lösung (und einen neuen Code) zu.
    </p>

";
        
        $__internal_b60088f5ed9fd3026ddc0a08d80f31d5f4d6a411166f36bb2036640c8611a9ae->leave($__internal_b60088f5ed9fd3026ddc0a08d80f31d5f4d6a411166f36bb2036640c8611a9ae_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_de.html.twig";
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
/* {% block title %}FAQ, Často kladené otázky{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Häufig gestellte Fragen</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Ich habe eine SMS geschickt, aber keine Antwort erhalten.</h3>*/
/*     <p>*/
/*         Dafür kann es mehrere Gründe geben:*/
/*     <ul>*/
/*         <li> Du hast den Text falsch geschrieben oder du hast ihn an eine falsche Nummer gesendet; überprüfe das und wenn etwas falsch war, versuche es erneut. </li>*/
/*         <li> Du benutzt Prepaid und hast nicht genügend Guthaben.</li>*/
/*         <li> Deine Handynummer steht in unserem System auf einer "Schwarzen Liste". Entweder weil das der Vertragspartner es so eingefordert hat oder weil dein Anbieter ausstehende Zahlungen vorheriger Rechnungen vermerkt hat.</li>*/
/*         <li> Der Zugang zu Premium Services ist von deinem Anbieter standardmäßig gesperrt und um diese freizugeben, musst du den Kundenservice deines Anbieters kontaktieren.</li>*/
/*         <li> Der Zugang zu den Premium Services deines Anbieters ist gesperrt, da der Vertragspartner dies so eingefordert hat. </li>*/
/*         <li> Dein Anbieter erlaubt die Nutzung von Premium Services nicht (viele virtuelle Anbieter erlauben das nicht). Du musst ein anderes Zahlungsmittel auswählen.</li>*/
/*         <li> Einige Anbieter erlauben die Verwendung des SMS Premium Services in Geschäftsverträgen nicht oder der Zugang muss durch das Anfügen einer 0 hergestellt werden. Zum Beispiel so: 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Wenn du denkst, dass keines dieser Motive zutrifft, geh auf unsere Support Seite, fülle das Formular aus und gib die Telefonnummer an, mit der du es probiert hast. Wir überprüfen den Fall und kontaktieren dich wieder, um dir das Problem zu erklären.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Ich konnte die Nummer, die auf dem Bildschirm angezeigt wurde, nicht anrufen.</h3>*/
/*     <p>*/
/*         Ähnlich, wie mit SMS, kann das verschiedene Gründe haben:*/
/*     <ul>*/
/*         <li> Du hast die Nummer nicht exakt eingetippt; überprüfe das und versuche es erneut.</li>*/
/*         <li> Du benutzt Prepaid und nicht genügend Guthaben.</li>*/
/*         <li> Deine Handynummer steht in unserem System auf einer "Schwarzen Liste". Entweder weil das der Vertragspartner es so eingefordert hat oder weil dein Anbieter ausstehende Zahlungen vorheriger Rechnungen vermerkt hat.</li>*/
/*         <li> Der Zugang zu Premium Services ist von deinem Anbieter standardmäßig gesperrt und um diese freizugeben, musst du den Kundenservice deines Anbieters kontaktieren.</li>*/
/*         <li> Viele Unternehmen sperren den Zugang ihrer User zu Premium Services, von Festnetzen, ebenso wie von Handys.</li>*/
/*         <li> Der Zugang zu Premium Services ist bei deinem Anbieter gesperrt, da es der Vertragspartner, so eingefordert hat.</li>*/
/*         <li> Dein Anbieter erlaubt die Nutzung von Premium Services nicht (viele virtuelle Anbieter erlauben das nicht). Du musst ein anderes Zahlungsmittel auswählen.</li>*/
/*         <li> Einige Anbieter erlauben die Verwendung des SMS Premium Services in Geschäftsverträgen nicht; sollte das der Fall sein, ist der Vertragspartner dafür verantwortlich, die Aktivierung anzufordern.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Wenn du denkst, dass keines dieser Motive zutrifft, geh auf unsere Support Seite, fülle das Formular aus und gib die Telefonnummer an, mit der du es probiert hast. Wir überprüfen den Fall und kontaktieren dich wieder, um dir das Problem zu erklären.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> Ich habe mit PayPal bezahlt, aber die Credits erscheinen nicht auf meinem Konto.</h3>*/
/*     <p>*/
/*         Bitte sende eine Zahlungsbestätigung an support@wolopay.net, als Belg für diese letzte Zahlung. Sobald wir die Daten ausgewertet haben, kontaktieren wir das Spiel und informieren darüber, was passiert ist.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">Ich habe eine SMS geschickt (oder über Telefon angerufen) und einen Code erhalten. Wo gebe ich diesen ein?</h3>*/
/*     <p>*/
/*         Wenn du eine SMS mit dem angegebenen Wort (Alias) geschickt oder die im Spiel angegebene Telefonnummer angerufen hast, aber keinen Einkauf angegebenen hast, können wir deine Nachricht (oder Anruf) keiner Transkation zuordnen und deshalb können wir das Spiel auch nicht darüber informieren, deine Credits auf dein Konto zu buchen. Du musst in das Spiel auf die Option "Konto aufladen" gehen, das Zahlungsmittel auswählen und entgegen der Anleitungen, weder SMS senden, noch anrufen und erst im zweiten Schritt den Code eingeben (einmalig).*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Ich hatte einen Code, aber als ich ihn eingegeben habe, erschien die Nachricht, dass dieser bereits benutzt wurde.</h3>*/
/*     <p>*/
/*         Komm in auf unsere Supportseite, gibt die erforderlichen Daten, den Code und deine E-Mail Adresse an. Wir überprüfen, ob (wann und wo) der Code benutzt wurde und wenn dem nicht so ist, senden wir dir per Mail eine Lösung (und einen neuen Code) zu.*/
/*     </p>*/
/* */
/* {% endblock %}*/
