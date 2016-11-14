<?php

/* AppBundle:Others/Default/FAQ:faq_tr.html.twig */
class __TwigTemplate_bfec1ce003d73273f8760b7099648bb4e70d2dd2fae0b698229794f82cc55ac7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_tr.html.twig", 1);
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
        $__internal_5cb9235bc186acc7c5efed779a4e5b276f1c4a49e4438db1f4d289cb6df1a0cc = $this->env->getExtension("native_profiler");
        $__internal_5cb9235bc186acc7c5efed779a4e5b276f1c4a49e4438db1f4d289cb6df1a0cc->enter($__internal_5cb9235bc186acc7c5efed779a4e5b276f1c4a49e4438db1f4d289cb6df1a0cc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_tr.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5cb9235bc186acc7c5efed779a4e5b276f1c4a49e4438db1f4d289cb6df1a0cc->leave($__internal_5cb9235bc186acc7c5efed779a4e5b276f1c4a49e4438db1f4d289cb6df1a0cc_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_d064bba74811e1d59e6431f60dcb56af35386943bb3cc7857742a5c0734b7ee1 = $this->env->getExtension("native_profiler");
        $__internal_d064bba74811e1d59e6431f60dcb56af35386943bb3cc7857742a5c0734b7ee1->enter($__internal_d064bba74811e1d59e6431f60dcb56af35386943bb3cc7857742a5c0734b7ee1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Sıkça sorulan sorular";
        
        $__internal_d064bba74811e1d59e6431f60dcb56af35386943bb3cc7857742a5c0734b7ee1->leave($__internal_d064bba74811e1d59e6431f60dcb56af35386943bb3cc7857742a5c0734b7ee1_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_7ee03a1fb365f45155b761386b20b613eb1ee1d922591cc22c706ad059de1c0e = $this->env->getExtension("native_profiler");
        $__internal_7ee03a1fb365f45155b761386b20b613eb1ee1d922591cc22c706ad059de1c0e->enter($__internal_7ee03a1fb365f45155b761386b20b613eb1ee1d922591cc22c706ad059de1c0e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">SSS, SIKÇA SORULAN SORULAR</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Bir SMS yolladım fakat cevap gelmedi</h3>
    <p>
        Bunun nedeni birkaç sebepten dolayı olabilir:
    <ul>
        <li> Mesajı doğru olarak yazmamış ya da numaranızı yanlış girmiş olabilirsiniz; Girdiğiniz bilgileri kontrol edin ve doğru yazıldıklarından emin olduktan sonra tekrar yollayın.</li>
        <li> Ön ödemeli hattınızda yeterli bakiye bulunmuyor olabilir.</li>
        <li> Numaranız sistemimizde “kara listede” bulunuyor olabilir, sözleşme sahibinin isteği olabilir ya da operatörünüz tarafından önceki dönemlere ait ödenmemiş faturanız bulunuyor olabilir.</li>
        <li> Operatörünüzde Premium SMS servislerden yararlanma seçeneğini engellemiş olabilirsiniz. Bu servisi kullanabilmek için müşteri hizmetlerini aramanız ve aktifleşmesini talep etmeniz gerekir.</li>
        <li> Premium SMS servisleriniz operatörünüz tarafından engellenmiş olabilir. </li>
        <li> Operatörünüz Premium SMS servisini desteklemiyor olabilir (birçok sanal operatörler bunu desteklemez). Başka bir ödeme yöntemi seçmeniz gerekir.</li>
        <li> Bazı operatörler şirket sözleşmeleriyle Premium SMS servisinin kullanımına izin vermezler. Erişim, telefon numaralarına başında bir sıfırla yıllanır. Örneğin 025522. </li>
    </ul>
    </p>

    <p> Eğer yukarıdaki seçeneklerden herhangi biri nedeniyle gerçekleşmiş bir sorun olduğunu düşünmüyorsanız, destek bölümümüzü ziyaret edin ve işlemi gerçekleştirmek istediğiniz telefon numarasını da yazarak formu doldurun. Hatanız incelenip sizle tekrardan iletişime geçilecektir.
    </p>

    <h3 id=\"cant_call\">Ekranda görünen telefon numarasını arayamadım.</h3>
    <p>
        SMS sorununda olduğu gibi birkaç nedenden kaynaklanıyor olabilir:
    <ul>
        <li> Doğru olarak yazılmamışsa; kontrol edin ve tekrar deneyin.</li>
        <li> Ön ödemeli hattınızda krediniz bulunmuyor olabilir.</li>
        <li> Numaranız sistemimizde “kara listede” bulunuyor olabilir, sözleşme sahibinin isteği olabilir ya da operatörünüz tarafından önceki dönemlere ait ödenmemiş faturanız bulunuyor olabilir.</li>
        <li> Operatörünüzde Premium SMS servislerden yararlanma seçeneğini engellemiş olabilirsiniz. Bu servisi kullanabilmek için müşteri hizmetlerini aramanız ve aktifleşmesini talep etmeniz gerekir.</li>
        <li> Birçok şirket kullanıcıların Premium servislerini, ev veya mobil telefonları için de geçerli olacak şekilde engeller.</li>
        <li> Premium SMS servisleriniz operatörünüz tarafından engellenmiş olabilir. </li>
        <li> Operatörünüz Premium SMS servisini desteklemiyor olabilir (birçok sanal operatörler bunu desteklemez). Başka bir ödeme yöntemi seçmeniz gerekir.</li>
        <li> Bazı operatörler şirket sözleşmeleriyle Premium SMS servisinin kullanımına izin vermezler; Eğer hatanın nedeni buysa kullanıcıların bu engeli kaldırmaları gerekir.</li>
    </ul>
    </p>
    <p>
        Eğer yukarıdaki seçeneklerden herhangi biri nedeniyle gerçekleşmiş bir sorun olduğunu düşünmüyorsanız, destek bölümümüzü ziyaret edin ve işlemi gerçekleştirmek istediğiniz telefon numarasını da yazarak formu doldurun. Hatanız incelenip sizle tekrardan iletişime geçilecektir.
    </p>
    <h3 id=\"paypal_doesnt_work\"> PayPal ile ödeme yaptım fakat kredilerim hesabımda görünmüyor.</h3>
    <p>
        Böyle bir durumda PayPal ya da Wolopay işlem kimliğini ve bahsedilen son ödeme belgesini support@wolopay.net adresine mail yollaman gerekir. Bilgilerinin doğruluğu incelendikten sonra oyunla irtibat kurup yaşanan sorunu belirteceğiz ve işleminizin gerçekleşmesini sağlayacağız.
    </p>

    <h3 id=\"code_sms\">Bir SMS yolladım (veya telefonla aradım) ve bir kod geldi. Bu kodu nereye yazmalıyım?</h3>
    <p>
        Anahtar kelime ile SMS yollayıp (ya da oyunun telefon numarasını aradıysanız) satın alma işlemi başlatmadıysanız, bu mesaj (ya da arama) üzerinden hiçbir işlem yapamayız. Ayrıca oyunla irtibata geçip kredilerinizin yüklenmesini sağlayamayız. Böyle bir durumda oyuna girdikten sonra yükleme işlemlerinin olduğu bölüme girmeniz gerekir. Ödeme şeklini ve talimatları seçtikten sonra herhangi bir mesaj ya da arama yapmadan ikinci adıma geçin. Bu bölümde daha önceden almış olduğunuz kodu girin. (sadece bir kez)
    </p>

    <h3 id=\"code_pre_inserted\">Sahip olduğum kodu girdiğimde daha önceden kullanılmış oluğu uyarısını aldım</h3>
    <p>
        Destek bölümümüzü ziyaret ederek istenilen belgelerle beraber kodu ve mail adresinizin de yazarak iletişime geçin. Kod bilgilerinizi kontrol ederek nerede ve ne zaman kullanıldığını belirledikten sonra size çözümün nasıl olacağını mail yoluyla bildireceğiz.
    </p>


";
        
        $__internal_7ee03a1fb365f45155b761386b20b613eb1ee1d922591cc22c706ad059de1c0e->leave($__internal_7ee03a1fb365f45155b761386b20b613eb1ee1d922591cc22c706ad059de1c0e_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_tr.html.twig";
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
/* {% block title %}FAQ, Sıkça sorulan sorular{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">SSS, SIKÇA SORULAN SORULAR</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Bir SMS yolladım fakat cevap gelmedi</h3>*/
/*     <p>*/
/*         Bunun nedeni birkaç sebepten dolayı olabilir:*/
/*     <ul>*/
/*         <li> Mesajı doğru olarak yazmamış ya da numaranızı yanlış girmiş olabilirsiniz; Girdiğiniz bilgileri kontrol edin ve doğru yazıldıklarından emin olduktan sonra tekrar yollayın.</li>*/
/*         <li> Ön ödemeli hattınızda yeterli bakiye bulunmuyor olabilir.</li>*/
/*         <li> Numaranız sistemimizde “kara listede” bulunuyor olabilir, sözleşme sahibinin isteği olabilir ya da operatörünüz tarafından önceki dönemlere ait ödenmemiş faturanız bulunuyor olabilir.</li>*/
/*         <li> Operatörünüzde Premium SMS servislerden yararlanma seçeneğini engellemiş olabilirsiniz. Bu servisi kullanabilmek için müşteri hizmetlerini aramanız ve aktifleşmesini talep etmeniz gerekir.</li>*/
/*         <li> Premium SMS servisleriniz operatörünüz tarafından engellenmiş olabilir. </li>*/
/*         <li> Operatörünüz Premium SMS servisini desteklemiyor olabilir (birçok sanal operatörler bunu desteklemez). Başka bir ödeme yöntemi seçmeniz gerekir.</li>*/
/*         <li> Bazı operatörler şirket sözleşmeleriyle Premium SMS servisinin kullanımına izin vermezler. Erişim, telefon numaralarına başında bir sıfırla yıllanır. Örneğin 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Eğer yukarıdaki seçeneklerden herhangi biri nedeniyle gerçekleşmiş bir sorun olduğunu düşünmüyorsanız, destek bölümümüzü ziyaret edin ve işlemi gerçekleştirmek istediğiniz telefon numarasını da yazarak formu doldurun. Hatanız incelenip sizle tekrardan iletişime geçilecektir.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Ekranda görünen telefon numarasını arayamadım.</h3>*/
/*     <p>*/
/*         SMS sorununda olduğu gibi birkaç nedenden kaynaklanıyor olabilir:*/
/*     <ul>*/
/*         <li> Doğru olarak yazılmamışsa; kontrol edin ve tekrar deneyin.</li>*/
/*         <li> Ön ödemeli hattınızda krediniz bulunmuyor olabilir.</li>*/
/*         <li> Numaranız sistemimizde “kara listede” bulunuyor olabilir, sözleşme sahibinin isteği olabilir ya da operatörünüz tarafından önceki dönemlere ait ödenmemiş faturanız bulunuyor olabilir.</li>*/
/*         <li> Operatörünüzde Premium SMS servislerden yararlanma seçeneğini engellemiş olabilirsiniz. Bu servisi kullanabilmek için müşteri hizmetlerini aramanız ve aktifleşmesini talep etmeniz gerekir.</li>*/
/*         <li> Birçok şirket kullanıcıların Premium servislerini, ev veya mobil telefonları için de geçerli olacak şekilde engeller.</li>*/
/*         <li> Premium SMS servisleriniz operatörünüz tarafından engellenmiş olabilir. </li>*/
/*         <li> Operatörünüz Premium SMS servisini desteklemiyor olabilir (birçok sanal operatörler bunu desteklemez). Başka bir ödeme yöntemi seçmeniz gerekir.</li>*/
/*         <li> Bazı operatörler şirket sözleşmeleriyle Premium SMS servisinin kullanımına izin vermezler; Eğer hatanın nedeni buysa kullanıcıların bu engeli kaldırmaları gerekir.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Eğer yukarıdaki seçeneklerden herhangi biri nedeniyle gerçekleşmiş bir sorun olduğunu düşünmüyorsanız, destek bölümümüzü ziyaret edin ve işlemi gerçekleştirmek istediğiniz telefon numarasını da yazarak formu doldurun. Hatanız incelenip sizle tekrardan iletişime geçilecektir.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> PayPal ile ödeme yaptım fakat kredilerim hesabımda görünmüyor.</h3>*/
/*     <p>*/
/*         Böyle bir durumda PayPal ya da Wolopay işlem kimliğini ve bahsedilen son ödeme belgesini support@wolopay.net adresine mail yollaman gerekir. Bilgilerinin doğruluğu incelendikten sonra oyunla irtibat kurup yaşanan sorunu belirteceğiz ve işleminizin gerçekleşmesini sağlayacağız.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">Bir SMS yolladım (veya telefonla aradım) ve bir kod geldi. Bu kodu nereye yazmalıyım?</h3>*/
/*     <p>*/
/*         Anahtar kelime ile SMS yollayıp (ya da oyunun telefon numarasını aradıysanız) satın alma işlemi başlatmadıysanız, bu mesaj (ya da arama) üzerinden hiçbir işlem yapamayız. Ayrıca oyunla irtibata geçip kredilerinizin yüklenmesini sağlayamayız. Böyle bir durumda oyuna girdikten sonra yükleme işlemlerinin olduğu bölüme girmeniz gerekir. Ödeme şeklini ve talimatları seçtikten sonra herhangi bir mesaj ya da arama yapmadan ikinci adıma geçin. Bu bölümde daha önceden almış olduğunuz kodu girin. (sadece bir kez)*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Sahip olduğum kodu girdiğimde daha önceden kullanılmış oluğu uyarısını aldım</h3>*/
/*     <p>*/
/*         Destek bölümümüzü ziyaret ederek istenilen belgelerle beraber kodu ve mail adresinizin de yazarak iletişime geçin. Kod bilgilerinizi kontrol ederek nerede ve ne zaman kullanıldığını belirledikten sonra size çözümün nasıl olacağını mail yoluyla bildireceğiz.*/
/*     </p>*/
/* */
/* */
/* {% endblock %}*/
