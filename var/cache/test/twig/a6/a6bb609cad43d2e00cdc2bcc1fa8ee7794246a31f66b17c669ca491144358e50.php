<?php

/* AppBundle:Others/Default/FAQ:faq_cz.html.twig */
class __TwigTemplate_275dfcbb005b407da699e99e744f1988b2de7b8d100b0c56f7886a7afe731e75 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_cz.html.twig", 1);
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
        $__internal_7e6cc475db3580613d53b5ace1348670ccf351f1b7a2b4b0215f04079dabba37 = $this->env->getExtension("native_profiler");
        $__internal_7e6cc475db3580613d53b5ace1348670ccf351f1b7a2b4b0215f04079dabba37->enter($__internal_7e6cc475db3580613d53b5ace1348670ccf351f1b7a2b4b0215f04079dabba37_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_cz.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_7e6cc475db3580613d53b5ace1348670ccf351f1b7a2b4b0215f04079dabba37->leave($__internal_7e6cc475db3580613d53b5ace1348670ccf351f1b7a2b4b0215f04079dabba37_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_ea628c5446d8f5aab6c7081d9d492dbdbbf206babc999812abc2da7c168a0e6f = $this->env->getExtension("native_profiler");
        $__internal_ea628c5446d8f5aab6c7081d9d492dbdbbf206babc999812abc2da7c168a0e6f->enter($__internal_ea628c5446d8f5aab6c7081d9d492dbdbbf206babc999812abc2da7c168a0e6f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Často kladené otázky";
        
        $__internal_ea628c5446d8f5aab6c7081d9d492dbdbbf206babc999812abc2da7c168a0e6f->leave($__internal_ea628c5446d8f5aab6c7081d9d492dbdbbf206babc999812abc2da7c168a0e6f_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_0499cf2ba27f4e04faced5ae95275abdf33af258e790a56979006c2e92ebca86 = $this->env->getExtension("native_profiler");
        $__internal_0499cf2ba27f4e04faced5ae95275abdf33af258e790a56979006c2e92ebca86->enter($__internal_0499cf2ba27f4e04faced5ae95275abdf33af258e790a56979006c2e92ebca86_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Často kladené otázky</h2>
    <h3 class=\"voffset4\">Poslal/a jsem SMS, ale neobdržel/a žádnou odpověď</h3>
    <p class=\"voffset3\">
        Za tímto chováním může stát několik důvodů:
    <ul>
        <li> Překlepli jste se v textu, popřípadě zaslali zprávu na špatné číslo; zkontrolujte to prosím a pokud se jedná o tento případ, zašlete to prosím znovu.</li>
        <li> Nemáte dostatečný kredit na vaší předplacené kartě.</li>
        <li> Vaše číslo je na \"seznamu zakázaných\" v našem systému, protože buď vlastník smlouvy o to požádal, nebo protože nás operátor upozornil, že předešlá faktura nebyla zaplacena.</li>
        <li> Nemůžete z vaší linky používat služby spojené s prémiovými SMS, protože tyto druhy služeb nejsou v základu aktivované. Musíte zkontaktovat svého operátora, aby je aktivoval.</li>
        <li> Operátor zablokoval služby spojené s prémiovými SMS u vaší linky, protože vlastník smlouvy o to zažádal.</li>
        <li> Služby spojené s prémiovými SMS nejsou u vašeho operátora dostupné (hodně malých virtuálních operátorů je neumožňuje)</li>
        <li> Někteří operátoři neumožňují používat služby spojené s prémiovými SMS pod \"firemními smlouvami\", popřípadě se přístup provádí pomocí připojení čísla nula před dané číslo, takže například místo čísla 25522 byste měli na zaslání zprávy využít číslo 025522. </li>
    </ul>
    </p>

    <p> Pokud věříte, že váš případ není žadný ze zmíněných, navštivte prosím naše centrum podpory, vyplňte formulář, kde zahrnete mobilní telefonní číslo, ze kterého jste službu zkoušeli. Podíváme se na problém a zkontaktujeme vás, abychom vám poskytli vysvětlení problému.
    </p>

    <h3>Nešlo mi zavolat na telefonní číslo, které se objevilo v instrukcích</h3>
    <p>
        Pokud jde o SMS, může zde být několik důvodů pro takové chování:
    <ul>
        <li> Překlepli jste se při zadávání čísla. Zkontrolujte to a zkuste to znovu.</li>
        <li> Nemáte dostatečný kredit na předplacené kartě.</li>
        <li> Vaše číslo je na \"seznamu zakázaných\" v našem systému, protože buď vlastník smlouvy o to požádal, nebo protože nás operátor upozornil, že předešlá faktura nebyla zaplacena.</li>
        <li> Nemůžete z vaší linky používat služby spojené s prémiovými SMS, protože tyto druhy služeb nejsou v základu aktivované. Musíte zkontaktovat svého operátora, aby je aktivoval.</li>
        <li> Mnoho společností blokuje přístup k prémiovým službám pro své uživatele, ať už se jedná o uživatele pevných linek, nebo mobilních telefonů.</li>
        <li> Operátor zablokoval prémiové služby u vaší linky, protože vlastník smlouvy o to zažádal.</li>
        <li> Prémiové služby nejsou u vašeho operátora dostupné (mnoho malých virtuálních operátorů je neumožňuje)</li>
        <li> Někteří operátoři neumožňují využívání prémiových služeb v rámci \"firemnách smluv\", pokud je to tento případ, držitel smlouvy je tím, který musí požádat o jejich aktivaci.</li>
    </ul>
    </p>
    <p>
        Pokud věříte, že váš případ není žadný ze zmíněných, navštivte prosím naše centrum podpory, vyplňte formulář, kde zahrnete mobilní telefonní číslo, ze kterého jste službu zkoušeli. Podíváme se na problém a zkontaktujeme vás, abychom vám poskytli vysvětlení problému.
    </p>
    <h3>Zaplatil jsem přes PayPal, ale kredity nejsou na mém účtu</h3>
    <p>
        Potřebujeme od vás, abyste poslali na support@wolopay.net identifikátor transakce, obě ID transakcí z wolopay a z PayPal, spolu s důkazem pozdější platby. Jakmile zkontrolujeme informace, zkontaktujeme se s vývojáři hry, abychom poskytli informace o problému a oni mohli přistoupit k dokončení transakce.
    </p>

    <h3>Odelal/a jsem SMS (či uskutečnil/a hovor) a mám kód. Kam ho musím zadat?</h3>
    <p>
        Pokud jste odeslal/a SMS s klíčovým slovem, popřípadě zavolal/a na běžné telefonní číslo hry, ale bez zahájení nákupu uvnitř hry, nemůžeme přiřadit vaši zprávu (či hovor) k transakci, a proto nemůžeme upozornit hru, aby vám přidala kredity. Musíte vstoupit do hry, přejít do sekce s kredity, vybrat platební metodu a zatímco se nacházíte v návodu, neodesílejte novou SMS a neprovádějte nový hovor. Klikněte na pokračovat a v druhém kroku budete moci zadat kód (pouze jednou!).
    </p>

    <h3>Mám kód a po jeho vložení je mi řečeno, že byl již použitý</h3>
    <p>
        Navštivte naše centrum podpory, vložte požadované informace včetně kódu a vašeho emailu. My se podíváme, jestli byl kód použit (pokud ano, tak kde a kdy), a pokud ne, poskytneme vám řešení přes email (nový kód).
    </p>

";
        
        $__internal_0499cf2ba27f4e04faced5ae95275abdf33af258e790a56979006c2e92ebca86->leave($__internal_0499cf2ba27f4e04faced5ae95275abdf33af258e790a56979006c2e92ebca86_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_cz.html.twig";
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
/*     <h2 class="text-center">FAQ, Často kladené otázky</h2>*/
/*     <h3 class="voffset4">Poslal/a jsem SMS, ale neobdržel/a žádnou odpověď</h3>*/
/*     <p class="voffset3">*/
/*         Za tímto chováním může stát několik důvodů:*/
/*     <ul>*/
/*         <li> Překlepli jste se v textu, popřípadě zaslali zprávu na špatné číslo; zkontrolujte to prosím a pokud se jedná o tento případ, zašlete to prosím znovu.</li>*/
/*         <li> Nemáte dostatečný kredit na vaší předplacené kartě.</li>*/
/*         <li> Vaše číslo je na "seznamu zakázaných" v našem systému, protože buď vlastník smlouvy o to požádal, nebo protože nás operátor upozornil, že předešlá faktura nebyla zaplacena.</li>*/
/*         <li> Nemůžete z vaší linky používat služby spojené s prémiovými SMS, protože tyto druhy služeb nejsou v základu aktivované. Musíte zkontaktovat svého operátora, aby je aktivoval.</li>*/
/*         <li> Operátor zablokoval služby spojené s prémiovými SMS u vaší linky, protože vlastník smlouvy o to zažádal.</li>*/
/*         <li> Služby spojené s prémiovými SMS nejsou u vašeho operátora dostupné (hodně malých virtuálních operátorů je neumožňuje)</li>*/
/*         <li> Někteří operátoři neumožňují používat služby spojené s prémiovými SMS pod "firemními smlouvami", popřípadě se přístup provádí pomocí připojení čísla nula před dané číslo, takže například místo čísla 25522 byste měli na zaslání zprávy využít číslo 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Pokud věříte, že váš případ není žadný ze zmíněných, navštivte prosím naše centrum podpory, vyplňte formulář, kde zahrnete mobilní telefonní číslo, ze kterého jste službu zkoušeli. Podíváme se na problém a zkontaktujeme vás, abychom vám poskytli vysvětlení problému.*/
/*     </p>*/
/* */
/*     <h3>Nešlo mi zavolat na telefonní číslo, které se objevilo v instrukcích</h3>*/
/*     <p>*/
/*         Pokud jde o SMS, může zde být několik důvodů pro takové chování:*/
/*     <ul>*/
/*         <li> Překlepli jste se při zadávání čísla. Zkontrolujte to a zkuste to znovu.</li>*/
/*         <li> Nemáte dostatečný kredit na předplacené kartě.</li>*/
/*         <li> Vaše číslo je na "seznamu zakázaných" v našem systému, protože buď vlastník smlouvy o to požádal, nebo protože nás operátor upozornil, že předešlá faktura nebyla zaplacena.</li>*/
/*         <li> Nemůžete z vaší linky používat služby spojené s prémiovými SMS, protože tyto druhy služeb nejsou v základu aktivované. Musíte zkontaktovat svého operátora, aby je aktivoval.</li>*/
/*         <li> Mnoho společností blokuje přístup k prémiovým službám pro své uživatele, ať už se jedná o uživatele pevných linek, nebo mobilních telefonů.</li>*/
/*         <li> Operátor zablokoval prémiové služby u vaší linky, protože vlastník smlouvy o to zažádal.</li>*/
/*         <li> Prémiové služby nejsou u vašeho operátora dostupné (mnoho malých virtuálních operátorů je neumožňuje)</li>*/
/*         <li> Někteří operátoři neumožňují využívání prémiových služeb v rámci "firemnách smluv", pokud je to tento případ, držitel smlouvy je tím, který musí požádat o jejich aktivaci.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Pokud věříte, že váš případ není žadný ze zmíněných, navštivte prosím naše centrum podpory, vyplňte formulář, kde zahrnete mobilní telefonní číslo, ze kterého jste službu zkoušeli. Podíváme se na problém a zkontaktujeme vás, abychom vám poskytli vysvětlení problému.*/
/*     </p>*/
/*     <h3>Zaplatil jsem přes PayPal, ale kredity nejsou na mém účtu</h3>*/
/*     <p>*/
/*         Potřebujeme od vás, abyste poslali na support@wolopay.net identifikátor transakce, obě ID transakcí z wolopay a z PayPal, spolu s důkazem pozdější platby. Jakmile zkontrolujeme informace, zkontaktujeme se s vývojáři hry, abychom poskytli informace o problému a oni mohli přistoupit k dokončení transakce.*/
/*     </p>*/
/* */
/*     <h3>Odelal/a jsem SMS (či uskutečnil/a hovor) a mám kód. Kam ho musím zadat?</h3>*/
/*     <p>*/
/*         Pokud jste odeslal/a SMS s klíčovým slovem, popřípadě zavolal/a na běžné telefonní číslo hry, ale bez zahájení nákupu uvnitř hry, nemůžeme přiřadit vaši zprávu (či hovor) k transakci, a proto nemůžeme upozornit hru, aby vám přidala kredity. Musíte vstoupit do hry, přejít do sekce s kredity, vybrat platební metodu a zatímco se nacházíte v návodu, neodesílejte novou SMS a neprovádějte nový hovor. Klikněte na pokračovat a v druhém kroku budete moci zadat kód (pouze jednou!).*/
/*     </p>*/
/* */
/*     <h3>Mám kód a po jeho vložení je mi řečeno, že byl již použitý</h3>*/
/*     <p>*/
/*         Navštivte naše centrum podpory, vložte požadované informace včetně kódu a vašeho emailu. My se podíváme, jestli byl kód použit (pokud ano, tak kde a kdy), a pokud ne, poskytneme vám řešení přes email (nový kód).*/
/*     </p>*/
/* */
/* {% endblock %}*/
