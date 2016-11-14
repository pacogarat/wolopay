<?php

/* AppBundle:Others/Default/FAQ:faq_pt.html.twig */
class __TwigTemplate_3c589e6ecd3269f45d89cb991d007204223b5395c99fc9043d3a2ec99134fa21 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_pt.html.twig", 1);
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
        $__internal_e45dd1b4b32939d39078c1da7790d4bb0c8ceb0c39b334458532c74aa46af5db = $this->env->getExtension("native_profiler");
        $__internal_e45dd1b4b32939d39078c1da7790d4bb0c8ceb0c39b334458532c74aa46af5db->enter($__internal_e45dd1b4b32939d39078c1da7790d4bb0c8ceb0c39b334458532c74aa46af5db_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_pt.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e45dd1b4b32939d39078c1da7790d4bb0c8ceb0c39b334458532c74aa46af5db->leave($__internal_e45dd1b4b32939d39078c1da7790d4bb0c8ceb0c39b334458532c74aa46af5db_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_494f0843d4383947798295614f365ca7aa740f1e839f9253a4a88e79524df66c = $this->env->getExtension("native_profiler");
        $__internal_494f0843d4383947798295614f365ca7aa740f1e839f9253a4a88e79524df66c->enter($__internal_494f0843d4383947798295614f365ca7aa740f1e839f9253a4a88e79524df66c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Perguntas Formuladas Frequentemente";
        
        $__internal_494f0843d4383947798295614f365ca7aa740f1e839f9253a4a88e79524df66c->leave($__internal_494f0843d4383947798295614f365ca7aa740f1e839f9253a4a88e79524df66c_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_aae8741306464109e7cf0586a631968b578a34014ba32e57864c0f74acdce577 = $this->env->getExtension("native_profiler");
        $__internal_aae8741306464109e7cf0586a631968b578a34014ba32e57864c0f74acdce577->enter($__internal_aae8741306464109e7cf0586a631968b578a34014ba32e57864c0f74acdce577_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Perguntas Frequentes</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">Enviei um SMS, mas não recebi a resposta.</h3>
    <p>
        Pode haver vários motivos para isso:
    <ul>
        <li> Não ter escrito o texto corretamente, ou enviar ao número errado; verifique e se havia algo mal, e envie novamente. </li>
        <li> Ser pré-pago e não ter saldo suficiente.</li>
        <li> Ter o número do seu celular em uma “lista negra” em nosso sistema, ou por solicitação do titular do contrato ou porque sua linha registrou não pagamentos em faturas anteriores.</li>
        <li> Possuir o acesso aos serviços Premium bloqueado em sua operadora, geralmente ele vem bloqueado de forma padrão e neste caso o usuário de conectar-se com a central de atendimento ao cliente e solicitar a ativação.</li>
        <li> Ter bloqueado o acesso aos serviços premium devido à solicitação do titular do contrato. </li>
        <li> Sua operador não permitir o uso dos serviços Premium (muitas operadores virtuais não permitem). Você deverá escolher outro método de pagamento.</li>
        <li> Algumas operadoras não permitirem o uso de SMS Premium em contratos empresariais, si este é o caso, o titular do contrato deve solicitar sua ativação. </li>
    </ul>
    </p>

    <p> Se você acredita que não é por nenhum dos motivos anteriores, visite a nossa central de Suporte e preencha o formulário indicando o número de celular utilizado. Verificaremos o seu caso e entraremos em contato para explicar-lhe o que aconteceu.
    </p>

    <h3 id=\"cant_call\">Não consegui ligar para o número que aparecia na minha tela.</h3>
    <p>
        Assim como o SMS, podem haver vários motivos:
    <ul>
        <li> Não teclar corretamente, verifique e tente novamente.</li>
        <li> Ser pré-pago e não ter saldo suficiente.</li>
        <li> Ter o número do seu celular em uma “lista negra” em nosso sistema, ou por solicitação do titular do contrato ou porque sua linha registrou não pagamentos em faturas anteriores.</li>
        <li> Possuir o acesso aos serviços Premium bloqueado em sua operadora, geralmente ele vem bloqueado de forma padrão e neste caso o usuário de conectar-se com a central de atendimento ao cliente e solicitar a ativação.</li>
        <li> Muitas empresas também bloqueiam o acesso a serviços premium de seus usuários, tanto de linhas fixa como móveis.</li>
        <li> Ter bloqueado o acesso aos serviços premium devido à solicitação do titular do contrato. </li>
        <li> Sua operador não permitir o uso dos serviços Premium (muitas operadores virtuais não permitem). Você deverá escolher outro método de pagamento.</li>
        <li> Algunas operadoras no permiten el uso de servicios Premium en contratos de empresa; si es el caso, el titular del contrato es quien debe solicitar su activación.</li>
    </ul>
    </p>
    <p>
        Se você acredita que não é por nenhum dos motivos anteriores, visite a nossa central de Suporte e preencha o formulário indicando o número de celular utilizado. Verificaremos o seu caso e entraremos em contato para explicar-lhe o que aconteceu.
    </p>
    <h3 id=\"paypal_doesnt_work\"> Paguei com PayPal, mas os créditos não aparecem na minha conta.</h3>
    <p>
        Será necessário que você nos envie a support@wolopay.net o identificador da transação, tanto de Wolopay como de PayPal, assim como o comprovante de pagamento de PayPal. Assim que os dados forem verificados entraremos em contato para informá-lo sobre o ocorrido e que a sua transação seja processada.
    </p>

    <h3 id=\"code_sms\">Enviei um SMS (ou liguei por telefone) e tenho um código. Onde utilizá-lo?</h3>
    <p>
        Se você enviou um SMS com uma palavra chave, ou ligou ao telefone habitual do jogo, mas sem haver iniciado a compra do mesmo, não podemos vincular suas mensagem (ou chamada) à nenhuma transação, e por isso, não podemos notificar ao jogo para que os créditos sejam somados. Você deve entrar no jogo, ir à sessão de recarregar a conta, selecionar a forma de pagamento e as instruções, não enviar SMSM nem ligar, no segundo passo, o código deverá ser incluído, neste caso apenas um vez.
    </p>

    <h3 id=\"code_pre_inserted\">Tinha um código e ao inseri-lo diz que já foi utilizado.</h3>
    <p>
        Visite nossa central de suporte, introduza os dados requeridos incluindo o código e seu e-mail, e comprovaremos se o código foi utilizado (e onde e quando), caso contrário, lhe daremos a solução por e-mail (um código novo).
    </p>


";
        
        $__internal_aae8741306464109e7cf0586a631968b578a34014ba32e57864c0f74acdce577->leave($__internal_aae8741306464109e7cf0586a631968b578a34014ba32e57864c0f74acdce577_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_pt.html.twig";
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
/* {% block title %}FAQ, Perguntas Formuladas Frequentemente{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Perguntas Frequentes</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">Enviei um SMS, mas não recebi a resposta.</h3>*/
/*     <p>*/
/*         Pode haver vários motivos para isso:*/
/*     <ul>*/
/*         <li> Não ter escrito o texto corretamente, ou enviar ao número errado; verifique e se havia algo mal, e envie novamente. </li>*/
/*         <li> Ser pré-pago e não ter saldo suficiente.</li>*/
/*         <li> Ter o número do seu celular em uma “lista negra” em nosso sistema, ou por solicitação do titular do contrato ou porque sua linha registrou não pagamentos em faturas anteriores.</li>*/
/*         <li> Possuir o acesso aos serviços Premium bloqueado em sua operadora, geralmente ele vem bloqueado de forma padrão e neste caso o usuário de conectar-se com a central de atendimento ao cliente e solicitar a ativação.</li>*/
/*         <li> Ter bloqueado o acesso aos serviços premium devido à solicitação do titular do contrato. </li>*/
/*         <li> Sua operador não permitir o uso dos serviços Premium (muitas operadores virtuais não permitem). Você deverá escolher outro método de pagamento.</li>*/
/*         <li> Algumas operadoras não permitirem o uso de SMS Premium em contratos empresariais, si este é o caso, o titular do contrato deve solicitar sua ativação. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Se você acredita que não é por nenhum dos motivos anteriores, visite a nossa central de Suporte e preencha o formulário indicando o número de celular utilizado. Verificaremos o seu caso e entraremos em contato para explicar-lhe o que aconteceu.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Não consegui ligar para o número que aparecia na minha tela.</h3>*/
/*     <p>*/
/*         Assim como o SMS, podem haver vários motivos:*/
/*     <ul>*/
/*         <li> Não teclar corretamente, verifique e tente novamente.</li>*/
/*         <li> Ser pré-pago e não ter saldo suficiente.</li>*/
/*         <li> Ter o número do seu celular em uma “lista negra” em nosso sistema, ou por solicitação do titular do contrato ou porque sua linha registrou não pagamentos em faturas anteriores.</li>*/
/*         <li> Possuir o acesso aos serviços Premium bloqueado em sua operadora, geralmente ele vem bloqueado de forma padrão e neste caso o usuário de conectar-se com a central de atendimento ao cliente e solicitar a ativação.</li>*/
/*         <li> Muitas empresas também bloqueiam o acesso a serviços premium de seus usuários, tanto de linhas fixa como móveis.</li>*/
/*         <li> Ter bloqueado o acesso aos serviços premium devido à solicitação do titular do contrato. </li>*/
/*         <li> Sua operador não permitir o uso dos serviços Premium (muitas operadores virtuais não permitem). Você deverá escolher outro método de pagamento.</li>*/
/*         <li> Algunas operadoras no permiten el uso de servicios Premium en contratos de empresa; si es el caso, el titular del contrato es quien debe solicitar su activación.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Se você acredita que não é por nenhum dos motivos anteriores, visite a nossa central de Suporte e preencha o formulário indicando o número de celular utilizado. Verificaremos o seu caso e entraremos em contato para explicar-lhe o que aconteceu.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> Paguei com PayPal, mas os créditos não aparecem na minha conta.</h3>*/
/*     <p>*/
/*         Será necessário que você nos envie a support@wolopay.net o identificador da transação, tanto de Wolopay como de PayPal, assim como o comprovante de pagamento de PayPal. Assim que os dados forem verificados entraremos em contato para informá-lo sobre o ocorrido e que a sua transação seja processada.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">Enviei um SMS (ou liguei por telefone) e tenho um código. Onde utilizá-lo?</h3>*/
/*     <p>*/
/*         Se você enviou um SMS com uma palavra chave, ou ligou ao telefone habitual do jogo, mas sem haver iniciado a compra do mesmo, não podemos vincular suas mensagem (ou chamada) à nenhuma transação, e por isso, não podemos notificar ao jogo para que os créditos sejam somados. Você deve entrar no jogo, ir à sessão de recarregar a conta, selecionar a forma de pagamento e as instruções, não enviar SMSM nem ligar, no segundo passo, o código deverá ser incluído, neste caso apenas um vez.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Tinha um código e ao inseri-lo diz que já foi utilizado.</h3>*/
/*     <p>*/
/*         Visite nossa central de suporte, introduza os dados requeridos incluindo o código e seu e-mail, e comprovaremos se o código foi utilizado (e onde e quando), caso contrário, lhe daremos a solução por e-mail (um código novo).*/
/*     </p>*/
/* */
/* */
/* {% endblock %}*/
