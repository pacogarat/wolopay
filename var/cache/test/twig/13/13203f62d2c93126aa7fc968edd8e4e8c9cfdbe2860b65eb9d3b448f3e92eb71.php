<?php

/* AppBundle:Others/Default/FAQ:faq_es.html.twig */
class __TwigTemplate_c399029a39b172861ab0f69031cf9321972f22ac1a628864f85e1bff709718e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_es.html.twig", 1);
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
        $__internal_2391a3e811eaa6c097b05233b6b5091e6108d516793ce66c3879f68943f06296 = $this->env->getExtension("native_profiler");
        $__internal_2391a3e811eaa6c097b05233b6b5091e6108d516793ce66c3879f68943f06296->enter($__internal_2391a3e811eaa6c097b05233b6b5091e6108d516793ce66c3879f68943f06296_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_es.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_2391a3e811eaa6c097b05233b6b5091e6108d516793ce66c3879f68943f06296->leave($__internal_2391a3e811eaa6c097b05233b6b5091e6108d516793ce66c3879f68943f06296_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_883bd7b434630c6a92f69e1dd7804d0b7263c6b1ef5275bf70a8d04053d40e54 = $this->env->getExtension("native_profiler");
        $__internal_883bd7b434630c6a92f69e1dd7804d0b7263c6b1ef5275bf70a8d04053d40e54->enter($__internal_883bd7b434630c6a92f69e1dd7804d0b7263c6b1ef5275bf70a8d04053d40e54_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Preguntas Formuladas Frecuentemente";
        
        $__internal_883bd7b434630c6a92f69e1dd7804d0b7263c6b1ef5275bf70a8d04053d40e54->leave($__internal_883bd7b434630c6a92f69e1dd7804d0b7263c6b1ef5275bf70a8d04053d40e54_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_3c55a239361dc7461c27a8eccbef0ddb3aea4b7ade5b73c45431b0024736e278 = $this->env->getExtension("native_profiler");
        $__internal_3c55a239361dc7461c27a8eccbef0ddb3aea4b7ade5b73c45431b0024736e278->enter($__internal_3c55a239361dc7461c27a8eccbef0ddb3aea4b7ade5b73c45431b0024736e278_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Preguntas Frecuentes</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">He enviado un SMS, pero no me ha llegado respuesta</h3>
    <p>
        puede haber varios motivos para ello:
    <ul>
        <li> No has escrito correctamente el texto, o lo has enviado a un número erróneo; verifícalo, y si estaba mal, vuelve a enviarlo.</li>
        <li> Eres prepago y no tienes saldo suficiente.</li>
        <li> Tu número de móvil está en una \"lista negra\" en nuestro sistema, bien porque lo haya solicitado el titular del contrato, bien porque tu línea haya registrado impagos de factura anteriores.</li>
        <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues viene bloqueado por defecto y para usarlo tienes que contactar con el centro de atención al cliente y solicitar su activación.</li>
        <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues lo ha solicitado el titular del contrato. </li>
        <li> Tu operadora no permite el uso de servicios premium (muchas operadoras virtuales no lo permiten). Tienes que elegir otro medio de pago.</li>
        <li> Algunas operadoras no permiten el uso de SMS Premium en contratos de empresa, o bien el acceso se hace enviando al número con un cero delante. Por ejemplo, al 025522. </li>
    </ul>
    </p>

    <p> Si crees que no es por ninguno de los anteriores motivos, visita nuestro centro de soporte y rellena el formulario indicando el número de móvil desde el que has probado. Revisaremos el caso y nos pondremos en contacto contigo para darte una explicación de lo ocurrido.
    </p>

    <h3 id=\"cant_call\">No he podido llamar al número de teléfono que aparecía en pantalla.</h3>
    <p>
        Al igual que con el SMS, puede haber varios motivos:
    <ul>
        <li> No has tecleado correctamente; verifícalo, y vuelve a intentarlo.</li>
        <li> Eres prepago y no tienes saldo suficiente.</li>
        <li> Tu número de móvil está en una \"lista negra\" en nuestro sistema, bien porque lo haya solicitado el titular del contrato, bien porque tu línea haya registrado impagos de factura anteriores.</li>
        <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues viene bloqueado por defecto y para usarlo tienes que contactar con el centro de atención al cliente y solicitar su activación.</li>
        <li> Muchas empresas también bloquean el acceso a los servicios premium a sus usuarios, tanto desde líneas fijas como desde móviles.</li>
        <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues lo ha solicitado el titular del contrato. </li>
        <li> Tu operadora no permite el uso de servicios premium (muchas operadoras virtuales no lo permiten). Tienes que elegir otro medio de pago.</li>
        <li> Algunas operadoras no permiten el uso de servicios Premium en contratos de empresa; si es el caso, el titular del contrato es quien debe solicitar su activación.</li>
    </ul>
    </p>
    <p>
        Si crees que no es por ninguno de los anteriores motivos, visita nuestro centro de soporte y rellena el formulario indicando el número de teléfono desde el que has probado. Revisaremos el caso y nos pondremos en contacto contigo para darte una explicación de lo ocurrido.
    </p>
    <h3 id=\"paypal_doesnt_work\"> He pagado con PayPal, pero no me aparecen los créditos  en  mi cuenta.</h3>
    <p>
        Necesitamos que nos envíes a  support@wolopay.net el identificador de la transacción, tanto de Wolopay, como el de PayPal, así como el justificante del pago de este último. Una vez verifiquemos los datos, nos pondremos en contacto con el juego para informar de lo ocurrido y que procesen tu transacción.
    </p>

    <h3 id=\"code_sms\">He enviado un SMS (o llamado por teléfono), y tengo un código. ¿Dónde lo meto?</h3>
    <p>
        Si has enviado un SMS con el alias, o has llamado al teléfono habitual del juego, pero sin haber iniciado la compra en el mismo, no podemos asignar tu mensaje (o llamada) a ninguna transacción, y por tanto, no podemos notificar al juego para que sume tus créditos. Tienes que entrar en el juego, ir a la sección de recargar la cuenta, seleccionar el medio de pago, y en las instrucciones, no enviar el SMS ni llamar, y en el segundo paso, podrás introducir el código, eso sí, una sola vez.
    </p>

    <h3 id=\"code_pre_inserted\">Tenía un código, y al insertarlo, me dice que ya ha sido utilizado</h3>
    <p>
        Visita nuestro centro de soporte, introduce los datos requeridos incluyendo el código y tu mail,  y comprobaremos si se utilizó el código (y donde y cuando), y si no, te daremos solución via email (un código nuevo).
    </p>

";
        
        $__internal_3c55a239361dc7461c27a8eccbef0ddb3aea4b7ade5b73c45431b0024736e278->leave($__internal_3c55a239361dc7461c27a8eccbef0ddb3aea4b7ade5b73c45431b0024736e278_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_es.html.twig";
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
/* {% block title %}FAQ, Preguntas Formuladas Frecuentemente{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Preguntas Frecuentes</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">He enviado un SMS, pero no me ha llegado respuesta</h3>*/
/*     <p>*/
/*         puede haber varios motivos para ello:*/
/*     <ul>*/
/*         <li> No has escrito correctamente el texto, o lo has enviado a un número erróneo; verifícalo, y si estaba mal, vuelve a enviarlo.</li>*/
/*         <li> Eres prepago y no tienes saldo suficiente.</li>*/
/*         <li> Tu número de móvil está en una "lista negra" en nuestro sistema, bien porque lo haya solicitado el titular del contrato, bien porque tu línea haya registrado impagos de factura anteriores.</li>*/
/*         <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues viene bloqueado por defecto y para usarlo tienes que contactar con el centro de atención al cliente y solicitar su activación.</li>*/
/*         <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues lo ha solicitado el titular del contrato. </li>*/
/*         <li> Tu operadora no permite el uso de servicios premium (muchas operadoras virtuales no lo permiten). Tienes que elegir otro medio de pago.</li>*/
/*         <li> Algunas operadoras no permiten el uso de SMS Premium en contratos de empresa, o bien el acceso se hace enviando al número con un cero delante. Por ejemplo, al 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Si crees que no es por ninguno de los anteriores motivos, visita nuestro centro de soporte y rellena el formulario indicando el número de móvil desde el que has probado. Revisaremos el caso y nos pondremos en contacto contigo para darte una explicación de lo ocurrido.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">No he podido llamar al número de teléfono que aparecía en pantalla.</h3>*/
/*     <p>*/
/*         Al igual que con el SMS, puede haber varios motivos:*/
/*     <ul>*/
/*         <li> No has tecleado correctamente; verifícalo, y vuelve a intentarlo.</li>*/
/*         <li> Eres prepago y no tienes saldo suficiente.</li>*/
/*         <li> Tu número de móvil está en una "lista negra" en nuestro sistema, bien porque lo haya solicitado el titular del contrato, bien porque tu línea haya registrado impagos de factura anteriores.</li>*/
/*         <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues viene bloqueado por defecto y para usarlo tienes que contactar con el centro de atención al cliente y solicitar su activación.</li>*/
/*         <li> Muchas empresas también bloquean el acceso a los servicios premium a sus usuarios, tanto desde líneas fijas como desde móviles.</li>*/
/*         <li> Tienes bloqueado el acceso a los servicios premium en tu operadora, pues lo ha solicitado el titular del contrato. </li>*/
/*         <li> Tu operadora no permite el uso de servicios premium (muchas operadoras virtuales no lo permiten). Tienes que elegir otro medio de pago.</li>*/
/*         <li> Algunas operadoras no permiten el uso de servicios Premium en contratos de empresa; si es el caso, el titular del contrato es quien debe solicitar su activación.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Si crees que no es por ninguno de los anteriores motivos, visita nuestro centro de soporte y rellena el formulario indicando el número de teléfono desde el que has probado. Revisaremos el caso y nos pondremos en contacto contigo para darte una explicación de lo ocurrido.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> He pagado con PayPal, pero no me aparecen los créditos  en  mi cuenta.</h3>*/
/*     <p>*/
/*         Necesitamos que nos envíes a  support@wolopay.net el identificador de la transacción, tanto de Wolopay, como el de PayPal, así como el justificante del pago de este último. Una vez verifiquemos los datos, nos pondremos en contacto con el juego para informar de lo ocurrido y que procesen tu transacción.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">He enviado un SMS (o llamado por teléfono), y tengo un código. ¿Dónde lo meto?</h3>*/
/*     <p>*/
/*         Si has enviado un SMS con el alias, o has llamado al teléfono habitual del juego, pero sin haber iniciado la compra en el mismo, no podemos asignar tu mensaje (o llamada) a ninguna transacción, y por tanto, no podemos notificar al juego para que sume tus créditos. Tienes que entrar en el juego, ir a la sección de recargar la cuenta, seleccionar el medio de pago, y en las instrucciones, no enviar el SMS ni llamar, y en el segundo paso, podrás introducir el código, eso sí, una sola vez.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">Tenía un código, y al insertarlo, me dice que ya ha sido utilizado</h3>*/
/*     <p>*/
/*         Visita nuestro centro de soporte, introduce los datos requeridos incluyendo el código y tu mail,  y comprobaremos si se utilizó el código (y donde y cuando), y si no, te daremos solución via email (un código nuevo).*/
/*     </p>*/
/* */
/* {% endblock %}*/
