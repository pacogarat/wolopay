<?php

/* AppBundle:Others/Default/FAQ:faq_pl.html.twig */
class __TwigTemplate_b55244c587b5334341687c25460cdbcb3abc02d00eee03ee69db051cf46d5b18 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_pl.html.twig", 1);
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
        $__internal_cb7b15969e237b67dda0599d2ae65c033ca99af5c014610ac3c667d03cece26a = $this->env->getExtension("native_profiler");
        $__internal_cb7b15969e237b67dda0599d2ae65c033ca99af5c014610ac3c667d03cece26a->enter($__internal_cb7b15969e237b67dda0599d2ae65c033ca99af5c014610ac3c667d03cece26a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_pl.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cb7b15969e237b67dda0599d2ae65c033ca99af5c014610ac3c667d03cece26a->leave($__internal_cb7b15969e237b67dda0599d2ae65c033ca99af5c014610ac3c667d03cece26a_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_60b668f5e0adeda83f68b5dde41ef6347a5e33c19cf3d0fde2316981e31a4fff = $this->env->getExtension("native_profiler");
        $__internal_60b668f5e0adeda83f68b5dde41ef6347a5e33c19cf3d0fde2316981e31a4fff->enter($__internal_60b668f5e0adeda83f68b5dde41ef6347a5e33c19cf3d0fde2316981e31a4fff_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Najczęściej Zadawane Pytania";
        
        $__internal_60b668f5e0adeda83f68b5dde41ef6347a5e33c19cf3d0fde2316981e31a4fff->leave($__internal_60b668f5e0adeda83f68b5dde41ef6347a5e33c19cf3d0fde2316981e31a4fff_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_6d0b0f243a6c4a173e3f3aa041c49c9db6bba4c42277deaf0ee7016d69af795e = $this->env->getExtension("native_profiler");
        $__internal_6d0b0f243a6c4a173e3f3aa041c49c9db6bba4c42277deaf0ee7016d69af795e->enter($__internal_6d0b0f243a6c4a173e3f3aa041c49c9db6bba4c42277deaf0ee7016d69af795e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Najczęściej Zadawane Pytania</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Wysłałem wiadomość SMS, ale nie otrzymałem odpowiedzi.</h3>
    <p>
        Może istnieć kilka powodów:
    <ul>
        <li> Tekst, który wysłałeś nie był poprawny, lub wysłałeś go na niewłaściwy numer; sprawdź, jeżeli wiadomość nie była wysłana poprawnie, prosimy o jej ponowne wysłanie.</li>
        <li> Nie posiadasz wystarczających środków na swojej karcie prepaid.</li>
        <li> Twój numer telefonu komórkowego znajduje się na \"czarnej liście\" w naszym systemie, może to być spowodowane wnioskiem zleceniobiorcy, lub Twój operator powiadomił o nieopłaconym rachunku.</li>
        <li> Nie posiadasz dostępu do usług premium, ponieważ jest on zablokowany domyślnie. Aby móc z niego korzystać należy skontaktować się z centrum obsługi klienta i wysłać wniosek o aktywację. </li>
        <li> Operator zablokował usługę SMS premium Twojej linii, ponieważ tak zażądał wykonawca umowy.  </li>
        <li> Twój operator nie zezwala na korzystanie z usługi premium (wielu operatorów wirtualnych nie zezwala na tę funkcję). Należy wybrać inną metodę płatności.</li>
        <li> Wielu operatorów nie zezwala na usługę Premium SMS z umowami firm lub dostęp został wysłany z zerem na początku. Na przykład 025522.</li>
    </ul>
    </p>

    <p> Jeżeli uważasz, że sprawa ta nie dotyczy żadnego z powyższych powodów, odwiedź nasze Centrum Wsparcia i wypełnij formularz wskazując numer telefonu komórkowego, z którego wykonałeś próbę. Przeanalizujemy ten incydent i skontaktujemy się z Tobą, aby poinformować Cię o rezultacie.
    </p>

    <h3 id=\"cant_call\">Nie mogłem zadzwonić pod numer telefonu, który wyświetlił się na ekranie.</h3>
    <p>
        Tak samo jak w przypadku SMS, może istnieć kilka powodów:
    <ul>
        <li> Numer nie został wpisany poprawnie, proszę sprawdzić i spróbować ponownie.</li>
        <li> Nie posiadasz wystarczających środków na swojej karcie prepaid.</li>
        <li> Twój numer telefonu komórkowego znajduje się na \"czarnej liście\" w naszym systemie, może to być spowodowane wnioskiem zleceniobiorcy, lub Twój operator powiadomił o nieopłaconym rachunku.</li>
        <li> Nie posiadasz dostępu do usług premium, ponieważ jest on zablokowany domyślnie. Aby móc z niego korzystać należy skontaktować się z centrum obsługi klienta i wysłać wniosek o aktywację.</li>
        <li> Wiele firm również blokuje dostęp do usług premium swoim użytkownikom, zarówno z telefonów stacjonarnych jak również z telefonów komórkowych.</li>
        <li> Operator zablokował usługę SMS premium Twojej linii, ponieważ tak zażądał wykonawca umowy.</li>
        <li> Twój operator nie zezwala na korzystanie z usługi premium (wielu operatorów wirtualnych nie zezwala na tę funkcję). Należy wybrać inną metodę płatności.</li>
        <li> Wielu operatorów nie zezwala na usługę Premium SMS z umowami firm; jeżeli tak jest w tym przypadku, osoba uprawniona powinna wysłać wniosek o aktywację.</li>
    </ul>
    </p>
    <p>
        Jeżeli uważasz, że sprawa ta nie dotyczy żadnego z powyższych powodów, odwiedź nasze Centrum Wsparcia i wypełnij formularz wskazując numer telefonu komórkowego, z którego wykonałeś próbę. Przeanalizujemy ten incydent i skontaktujemy się z Tobą, aby poinformować Cię o rezultacie.
    </p>
    <h3 id=\"paypal_doesnt_work\"> Dokonałem płatności przez PayPal, ale kredyty nie pojawiły się na moim koncie.</h3>
    <p>
        Prosimy o przesłanie identyfikatora transakcji na support@wolopay.net, zarówno z Wolopay jak i PayPal, wraz z dowodem ostatniej wpłaty. Po zweryfikowaniu informacji, skontaktujemy się z grą, aby poinformować o problemie i sfinalizować transakcję.

    <h3 id=\"code_sms\">Wysłałem SMS (lub wykonałem połączenie) i otrzymałem kod. Gdzie należy go wprowadzić?</h3>
    <p>
        Jeżeli wysłałeś sms ze słowem klucz lub jeżeli lub zadzwoniłeś na numer telefonu gry, nie wskazując zakupu, nie możemy przypisać Twojej wiadomości (lub połączenia) do żadnej transakcji, a tym samym nie możemy zawiadomić gry, aby dodała Twoje kredyty. Musisz zalogować się do gry, przejść do sekcji kredytu i wybrać metodę płatności, a podczas instrukcji, nie wysyłaj SMS ani nie wykonuj połączeń. W drugim etapie będziesz mógł wprowadzić jednorazowo wprowadzić kod.
    </p>

    <h3 id=\"code_pre_inserted\">Otrzymałem kod i po jego wprowadzeniu pojawiła się informacja, że kod został już wykorzystany.</h3>
    <p>
        Odwiedź nasze centrum pomocy technicznej, wprowadź wymagane informacje, wraz z kodem, email a my sprawdzimy czy kod został wysłany (kiedy i gdzie), a jeżeli nie, zaoferujemy Ci inne rozwiązanie.
    </p>


";
        
        $__internal_6d0b0f243a6c4a173e3f3aa041c49c9db6bba4c42277deaf0ee7016d69af795e->leave($__internal_6d0b0f243a6c4a173e3f3aa041c49c9db6bba4c42277deaf0ee7016d69af795e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_pl.html.twig";
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
/* {% block title %}FAQ, Najczęściej Zadawane Pytania{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Najczęściej Zadawane Pytania</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Wysłałem wiadomość SMS, ale nie otrzymałem odpowiedzi.</h3>*/
/*     <p>*/
/*         Może istnieć kilka powodów:*/
/*     <ul>*/
/*         <li> Tekst, który wysłałeś nie był poprawny, lub wysłałeś go na niewłaściwy numer; sprawdź, jeżeli wiadomość nie była wysłana poprawnie, prosimy o jej ponowne wysłanie.</li>*/
/*         <li> Nie posiadasz wystarczających środków na swojej karcie prepaid.</li>*/
/*         <li> Twój numer telefonu komórkowego znajduje się na "czarnej liście" w naszym systemie, może to być spowodowane wnioskiem zleceniobiorcy, lub Twój operator powiadomił o nieopłaconym rachunku.</li>*/
/*         <li> Nie posiadasz dostępu do usług premium, ponieważ jest on zablokowany domyślnie. Aby móc z niego korzystać należy skontaktować się z centrum obsługi klienta i wysłać wniosek o aktywację. </li>*/
/*         <li> Operator zablokował usługę SMS premium Twojej linii, ponieważ tak zażądał wykonawca umowy.  </li>*/
/*         <li> Twój operator nie zezwala na korzystanie z usługi premium (wielu operatorów wirtualnych nie zezwala na tę funkcję). Należy wybrać inną metodę płatności.</li>*/
/*         <li> Wielu operatorów nie zezwala na usługę Premium SMS z umowami firm lub dostęp został wysłany z zerem na początku. Na przykład 025522.</li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Jeżeli uważasz, że sprawa ta nie dotyczy żadnego z powyższych powodów, odwiedź nasze Centrum Wsparcia i wypełnij formularz wskazując numer telefonu komórkowego, z którego wykonałeś próbę. Przeanalizujemy ten incydent i skontaktujemy się z Tobą, aby poinformować Cię o rezultacie.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Nie mogłem zadzwonić pod numer telefonu, który wyświetlił się na ekranie.</h3>*/
/*     <p>*/
/*         Tak samo jak w przypadku SMS, może istnieć kilka powodów:*/
/*     <ul>*/
/*         <li> Numer nie został wpisany poprawnie, proszę sprawdzić i spróbować ponownie.</li>*/
/*         <li> Nie posiadasz wystarczających środków na swojej karcie prepaid.</li>*/
/*         <li> Twój numer telefonu komórkowego znajduje się na "czarnej liście" w naszym systemie, może to być spowodowane wnioskiem zleceniobiorcy, lub Twój operator powiadomił o nieopłaconym rachunku.</li>*/
/*         <li> Nie posiadasz dostępu do usług premium, ponieważ jest on zablokowany domyślnie. Aby móc z niego korzystać należy skontaktować się z centrum obsługi klienta i wysłać wniosek o aktywację.</li>*/
/*         <li> Wiele firm również blokuje dostęp do usług premium swoim użytkownikom, zarówno z telefonów stacjonarnych jak również z telefonów komórkowych.</li>*/
/*         <li> Operator zablokował usługę SMS premium Twojej linii, ponieważ tak zażądał wykonawca umowy.</li>*/
/*         <li> Twój operator nie zezwala na korzystanie z usługi premium (wielu operatorów wirtualnych nie zezwala na tę funkcję). Należy wybrać inną metodę płatności.</li>*/
/*         <li> Wielu operatorów nie zezwala na usługę Premium SMS z umowami firm; jeżeli tak jest w tym przypadku, osoba uprawniona powinna wysłać wniosek o aktywację.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Jeżeli uważasz, że sprawa ta nie dotyczy żadnego z powyższych powodów, odwiedź nasze Centrum Wsparcia i wypełnij formularz wskazując numer telefonu komórkowego, z którego wykonałeś próbę. Przeanalizujemy ten incydent i skontaktujemy się z Tobą, aby poinformować Cię o rezultacie.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> Dokonałem płatności przez PayPal, ale kredyty nie pojawiły się na moim koncie.</h3>*/
/*     <p>*/
/*         Prosimy o przesłanie identyfikatora transakcji na support@wolopay.net, zarówno z Wolopay jak i PayPal, wraz z dowodem ostatniej wpłaty. Po zweryfikowaniu informacji, skontaktujemy się z grą, aby poinformować o problemie i sfinalizować transakcję.*/
/* */
/*     <h3 id="code_sms">Wysłałem SMS (lub wykonałem połączenie) i otrzymałem kod. Gdzie należy go wprowadzić?</h3>*/
/*     <p>*/
/*         Jeżeli wysłałeś sms ze słowem klucz lub jeżeli lub zadzwoniłeś na numer telefonu gry, nie wskazując zakupu, nie możemy przypisać Twojej wiadomości (lub połączenia) do żadnej transakcji, a tym samym nie możemy zawiadomić gry, aby dodała Twoje kredyty. Musisz zalogować się do gry, przejść do sekcji kredytu i wybrać metodę płatności, a podczas instrukcji, nie wysyłaj SMS ani nie wykonuj połączeń. W drugim etapie będziesz mógł wprowadzić jednorazowo wprowadzić kod.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Otrzymałem kod i po jego wprowadzeniu pojawiła się informacja, że kod został już wykorzystany.</h3>*/
/*     <p>*/
/*         Odwiedź nasze centrum pomocy technicznej, wprowadź wymagane informacje, wraz z kodem, email a my sprawdzimy czy kod został wysłany (kiedy i gdzie), a jeżeli nie, zaoferujemy Ci inne rozwiązanie.*/
/*     </p>*/
/* */
/* */
/* {% endblock %}*/
