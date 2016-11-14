<?php

/* AppBundle:Others/Default/FAQ:faq_ja.html.twig */
class __TwigTemplate_e8dbe71c7c69e0154fb8d50fb4bb910dd2c52bf940484ad1ca3ebe164a879869 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_ja.html.twig", 1);
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
        $__internal_9a31b5940a9fb25b0be2c7d928e6323ed2b58e9cce0b363720d7374518f14114 = $this->env->getExtension("native_profiler");
        $__internal_9a31b5940a9fb25b0be2c7d928e6323ed2b58e9cce0b363720d7374518f14114->enter($__internal_9a31b5940a9fb25b0be2c7d928e6323ed2b58e9cce0b363720d7374518f14114_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_ja.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9a31b5940a9fb25b0be2c7d928e6323ed2b58e9cce0b363720d7374518f14114->leave($__internal_9a31b5940a9fb25b0be2c7d928e6323ed2b58e9cce0b363720d7374518f14114_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_605cf49ac6e25ac1bd8645d330604774e87e168a9a358500e3bdd9b30a4141a4 = $this->env->getExtension("native_profiler");
        $__internal_605cf49ac6e25ac1bd8645d330604774e87e168a9a358500e3bdd9b30a4141a4->enter($__internal_605cf49ac6e25ac1bd8645d330604774e87e168a9a358500e3bdd9b30a4141a4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ、よくあるご質問";
        
        $__internal_605cf49ac6e25ac1bd8645d330604774e87e168a9a358500e3bdd9b30a4141a4->leave($__internal_605cf49ac6e25ac1bd8645d330604774e87e168a9a358500e3bdd9b30a4141a4_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_ab9d448eb6696174bc9ea1cef20204114cd35d7c24761a73872854e9b6cd658f = $this->env->getExtension("native_profiler");
        $__internal_ab9d448eb6696174bc9ea1cef20204114cd35d7c24761a73872854e9b6cd658f->enter($__internal_ab9d448eb6696174bc9ea1cef20204114cd35d7c24761a73872854e9b6cd658f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ、よくあるご質問</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">SMSを送っても、返事が届きませんでした</h3>
    <p>
        この問題は、いくつかの原因が考えられます:
    <ul>
        <li> 正しくテキストを入力しなかった、もしくは正しくない番号に送信した可能性があります。こちらをご確認いただいた後、再度お試しください。</li>
        <li> プリペイドユーザーのため残金が残っていない可能性があります。</li>
        <li> -　私たちのシステムにお使いの携帯番号が\"ブラックリスト\"に登録されている、契約者の要望によって、または未払いの請求書がある可能性がございます。</li>
        <li> 通信会社の規定設定でSMS有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>
        <li> 契約者の要望により、SMS有料サービスへのアクセスがブロックされている可能性があります。</li>
        <li> 通信会社が有料サービスの利用を認めていない可能性があります。別の支払い方法を選択いただく必要があります。</li>
        <li> いくつかの通信会社は、SMS有料サービスを承認していません。また、番号の頭にゼロを加える必要がある通信会社もございますので、ご注意ください。例えば、025522など。 </li>
    </ul>
    </p>

    <p> 上記のいずれの理由にも該当しない場合、サポートセンターにアクセスし、ご利用の携帯番号などフォームの項目を入力して送信してください。お問い合わせ内容を十分検討し、個別対応でご説明させていただきます。
    </p>

    <h3 id=\"cant_call\">画面に表示された番号に電話が出来なかった</h3>
    <p>
        SMSと同様、いくつかの原因が考えられます:
    <ul>
        <li> 正しく入力されなかった可能性があります。ご確認頂き、再度お試しください。</li>
        <li> プリペイドユーザーのため残金が残っていない可能性があります。</li>
        <li> 私たちのシステムにお使いの携帯番号が\"ブラックリスト\"に登録されている、契約者の要望によって、または未払いの請求書がある可能性がございます。</li>
        <li> 通信会社の規定設定でSMS有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>
        <li> 通信会社の規定設定で携帯電話及び固定電話を使用した有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>
        <li> 契約者の要望により、SMS有料サービスへのアクセスがブロックされている可能性があります。</li>
        <li> 通信会社が有料サービスの利用を認めていない可能性があります。別の支払い方法を選択いただく必要があります。</li>
        <li> いくつかの通信会社は、電話決済を承認していません。また、番号の頭にゼロを加える必要がある通信会社もございますので、ご注意ください。</li>
    </ul>
    </p>
    <p>
        上記のいずれの理由にも該当しない場合、サポートセンターにアクセスし、ご利用の携帯番号などフォームの項目を入力して送信してください。お問い合わせ内容を十分検討し、個別対応でご説明させていただきます。
    </p>
    <h3 id=\"paypal_doesnt_work\"> PayPalで支払いを完了させたのに、アカウントにクレジットが表示されません。</h3>
    <p>
        support@wolopay.netにWolopayまたはPayPalの決済IDと領収書を送付してください。確認次第、何が起きたのかをご報告と決済の処理を行います。
    </p>

    <h3 id=\"code_sms\">SMSを送信(または電話)をして、コードを受け取りました。どこに入力すればいいんですか？</h3>
    <p>
        購入前にユーザー名を使ってSMSを送信、または、ゲームの通常の連絡先番号に電話をした場合、メッセージまたは電話を決済に割り当てることができず、ゲーム側にクレジットを追加することができません。ゲームにアクセスし、アカウントチャージの項目、決済方法の選択をし、指示の時点ではSMSを送信したり電話はせずに、第2ステップでコードを一度だけ入力してください。
    </p>

    <h3 id=\"code_pre_inserted\">持っていたコードを入力すると、もう使用済みであると表示された</h3>
    <p>
        弊社サポートセンターにアクセスしていただき、コードやメールアドレスなどの必須項目をご入力ください。 コードがどこから、いつ使用されたかどうかをこちらで確認し、メールを通して解決方法(通常は新しいコードの送信)をご連絡させていただきます。
    </p>

";
        
        $__internal_ab9d448eb6696174bc9ea1cef20204114cd35d7c24761a73872854e9b6cd658f->leave($__internal_ab9d448eb6696174bc9ea1cef20204114cd35d7c24761a73872854e9b6cd658f_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_ja.html.twig";
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
/* {% block title %}FAQ、よくあるご質問{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ、よくあるご質問</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">SMSを送っても、返事が届きませんでした</h3>*/
/*     <p>*/
/*         この問題は、いくつかの原因が考えられます:*/
/*     <ul>*/
/*         <li> 正しくテキストを入力しなかった、もしくは正しくない番号に送信した可能性があります。こちらをご確認いただいた後、再度お試しください。</li>*/
/*         <li> プリペイドユーザーのため残金が残っていない可能性があります。</li>*/
/*         <li> -　私たちのシステムにお使いの携帯番号が"ブラックリスト"に登録されている、契約者の要望によって、または未払いの請求書がある可能性がございます。</li>*/
/*         <li> 通信会社の規定設定でSMS有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>*/
/*         <li> 契約者の要望により、SMS有料サービスへのアクセスがブロックされている可能性があります。</li>*/
/*         <li> 通信会社が有料サービスの利用を認めていない可能性があります。別の支払い方法を選択いただく必要があります。</li>*/
/*         <li> いくつかの通信会社は、SMS有料サービスを承認していません。また、番号の頭にゼロを加える必要がある通信会社もございますので、ご注意ください。例えば、025522など。 </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> 上記のいずれの理由にも該当しない場合、サポートセンターにアクセスし、ご利用の携帯番号などフォームの項目を入力して送信してください。お問い合わせ内容を十分検討し、個別対応でご説明させていただきます。*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">画面に表示された番号に電話が出来なかった</h3>*/
/*     <p>*/
/*         SMSと同様、いくつかの原因が考えられます:*/
/*     <ul>*/
/*         <li> 正しく入力されなかった可能性があります。ご確認頂き、再度お試しください。</li>*/
/*         <li> プリペイドユーザーのため残金が残っていない可能性があります。</li>*/
/*         <li> 私たちのシステムにお使いの携帯番号が"ブラックリスト"に登録されている、契約者の要望によって、または未払いの請求書がある可能性がございます。</li>*/
/*         <li> 通信会社の規定設定でSMS有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>*/
/*         <li> 通信会社の規定設定で携帯電話及び固定電話を使用した有料サービスへのアクセスがブロックされている可能性があります。カスタマーサービスにご連絡頂き、有効にしてください。</li>*/
/*         <li> 契約者の要望により、SMS有料サービスへのアクセスがブロックされている可能性があります。</li>*/
/*         <li> 通信会社が有料サービスの利用を認めていない可能性があります。別の支払い方法を選択いただく必要があります。</li>*/
/*         <li> いくつかの通信会社は、電話決済を承認していません。また、番号の頭にゼロを加える必要がある通信会社もございますので、ご注意ください。</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         上記のいずれの理由にも該当しない場合、サポートセンターにアクセスし、ご利用の携帯番号などフォームの項目を入力して送信してください。お問い合わせ内容を十分検討し、個別対応でご説明させていただきます。*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> PayPalで支払いを完了させたのに、アカウントにクレジットが表示されません。</h3>*/
/*     <p>*/
/*         support@wolopay.netにWolopayまたはPayPalの決済IDと領収書を送付してください。確認次第、何が起きたのかをご報告と決済の処理を行います。*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">SMSを送信(または電話)をして、コードを受け取りました。どこに入力すればいいんですか？</h3>*/
/*     <p>*/
/*         購入前にユーザー名を使ってSMSを送信、または、ゲームの通常の連絡先番号に電話をした場合、メッセージまたは電話を決済に割り当てることができず、ゲーム側にクレジットを追加することができません。ゲームにアクセスし、アカウントチャージの項目、決済方法の選択をし、指示の時点ではSMSを送信したり電話はせずに、第2ステップでコードを一度だけ入力してください。*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">持っていたコードを入力すると、もう使用済みであると表示された</h3>*/
/*     <p>*/
/*         弊社サポートセンターにアクセスしていただき、コードやメールアドレスなどの必須項目をご入力ください。 コードがどこから、いつ使用されたかどうかをこちらで確認し、メールを通して解決方法(通常は新しいコードの送信)をご連絡させていただきます。*/
/*     </p>*/
/* */
/* {% endblock %}*/
