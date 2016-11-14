<?php

/* AppBundle:Others/Default/FAQ:faq_fr.html.twig */
class __TwigTemplate_f48928c7d952f72453f6b3d8b383f8bc3a96977db68a5c4dd1fe6f942a668b63 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/Others/Default/FAQ/faq_layout.html.twig", "AppBundle:Others/Default/FAQ:faq_fr.html.twig", 1);
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
        $__internal_c1fe67d7befb335bda6e0f6321f215afc6f216adc4db24455671bb3b0533f803 = $this->env->getExtension("native_profiler");
        $__internal_c1fe67d7befb335bda6e0f6321f215afc6f216adc4db24455671bb3b0533f803->enter($__internal_c1fe67d7befb335bda6e0f6321f215afc6f216adc4db24455671bb3b0533f803_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Default/FAQ:faq_fr.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_c1fe67d7befb335bda6e0f6321f215afc6f216adc4db24455671bb3b0533f803->leave($__internal_c1fe67d7befb335bda6e0f6321f215afc6f216adc4db24455671bb3b0533f803_prof);

    }

    // line 2
    public function block_title($context, array $blocks = array())
    {
        $__internal_ee05639151cb1985f42476e93bf90f86b0547088bc86b4db537fd186f903230b = $this->env->getExtension("native_profiler");
        $__internal_ee05639151cb1985f42476e93bf90f86b0547088bc86b4db537fd186f903230b->enter($__internal_ee05639151cb1985f42476e93bf90f86b0547088bc86b4db537fd186f903230b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "FAQ, Foire Aux Questions";
        
        $__internal_ee05639151cb1985f42476e93bf90f86b0547088bc86b4db537fd186f903230b->leave($__internal_ee05639151cb1985f42476e93bf90f86b0547088bc86b4db537fd186f903230b_prof);

    }

    // line 3
    public function block_faq_txt($context, array $blocks = array())
    {
        $__internal_785730c6153c404bee8a12e990d692b1faff08c5650973b26de59c2576ad6bc2 = $this->env->getExtension("native_profiler");
        $__internal_785730c6153c404bee8a12e990d692b1faff08c5650973b26de59c2576ad6bc2->enter($__internal_785730c6153c404bee8a12e990d692b1faff08c5650973b26de59c2576ad6bc2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "faq_txt"));

        // line 4
        echo "
    <h2 class=\"text-center\">FAQ, Foire Aux Questions</h2>

    <h3 class=\"voffset4\" id=\"sms_not_sendt\">J’ai envoyé un SMS, mais je n’ai pas reçu de réponse</h3>
    <p>
        Il peut y avoir plusieurs raisons à cela :
    <ul>
        <li> Vous n’avez pas écrit correctement le texte, ou vous l’avez envoyé à un mauvais numéro ; vérifiez, et s’il était erroné, renvoyez-le.</li>
        <li> Vous avez une carte prépayée et vous n’avez pas assez de crédit.</li>
        <li> Votre numéro de portable est sur une « liste noire » dans notre système, soit parce que le titulaire du contrat l’a demandé, soit parce que des factures impayées sont enregistrées pour votre ligne.</li>
        <li> Vous n’avez pas accès aux services premium de votre opérateur, car ces services sont bloqués par défaut. Pour les utiliser, vous devez contacter le centre d’attention à la clientèle et demander leur activation.</li>
        <li> L’opérateur vous a bloqué l’accès aux services premium suite à la demande du titulaire du contrat. </li>
        <li> Votre opérateur ne permet pas l’utilisation des services premium (beaucoup d’opérateurs virtuels ne le permettent pas). Vous devez choisir une autre méthode de paiement.</li>
        <li> Certains opérateurs ne permettent pas l’utilisation des SMS Premium pour les contrats d’entreprise, ou l’accès se fait en ajoutant un zéro au numéro communiqué. Par exemple au 025522. </li>
    </ul>
    </p>

    <p> Si vous pensez que ce n’est pour aucune de ces raisons, dirigez-vous sur la page de notre centre d’assistance et remplissez le formulaire en indiquant le numéro de portable avec lequel vous avez essayé. Nous vérifierons le problème et nous vous contacterons pour vous expliquer ce qu’il s’est passé.
    </p>

    <h3 id=\"cant_call\">Je n’ai pas pu appeler le numéro de téléphone indiqué à l’écran.</h3>
    <p>
        De la même manière que pour le SMS, il peut y avoir plusieurs raisons à cela :
    <ul>
        <li> Vous n’avez pas tapé le bon numéro : vérifiez et essayez de nouveau.</li>
        <li> Vous avez une carte prépayée et vous n’avez pas assez de crédit.</li>
        <li> Votre numéro de portable est sur une « liste noire » dans notre système, soit parce que le titulaire du contrat l’a demandé, soit parce que des factures impayées sont enregistrées pour votre ligne.</li>
        <li> Vous n’avez pas accès aux services premium de votre opérateur, car ces services sont bloqués par défaut. Pour les utiliser, vous devez contacter le centre d’attention à la clientèle et demander leur activation.</li>
        <li> Beaucoup d’entreprises bloquent l’accès aux services premium à leurs utilisateurs, depuis des lignes fixes et mobiles.</li>
        <li> L’opérateur vous a bloqué l’accès aux services premium suite à la demande du titulaire du contrat. </li>
        <li> Votre opérateur ne permet pas l’utilisation des services premium (beaucoup d’opérateurs virtuels ne le permettent pas). Vous devez choisir une autre méthode de paiement.</li>
        <li> Certains opérateurs ne permettent pas l’utilisation des services Premium aux contrats d’entreprise : si c’est le cas, le titulaire du contrat doit en demander l’activation.</li>
    </ul>
    </p>
    <p>
        Si vous pensez que ce n’est pour aucune de ces raisons, dirigez-vous sur la page de notre centre d’assistance et remplissez le formulaire en indiquant le numéro de portable avec lequel vous avez essayé. Nous vérifierons le problème et nous vous contacterons pour vous expliquer ce qu’il s’est passé.
    </p>
    <h3 id=\"paypal_doesnt_work\"> J’ai payé avec PayPal, mais je ne vois pas les crédits sur mon compte.</h3>
    <p>
        Vous devez nous envoyer le numéro d’identification de la transaction de Wolopay et de Paypal à l’adresse support@wolopay.net ainsi que le justificatif de paiement de ce dernier. Une fois que nous aurons vérifié les données, nous contacterons le jeu pour les informer de ce qu’il s’est passé et pour qu’ils effectuent la transaction.
    </p>

    <h3 id=\"code_sms\">J’ai envoyé un SMS (ou téléphoné) et j’ai un code. Où puis-je le mettre ?</h3>
    <p>
        Si vous avez envoyé un SMS avec le mot clé ou que vous avez appelé au numéro habituel du jeu, mais sans avoir initié un achat dans ce dernier, nous ne pouvons assigner votre message (ou appel) a aucune transaction et nous ne pouvons donc pas communiquer au jeu de vous ajouter les crédits. Vous devez entrer dans le jeu, aller dans la section paiement, sélectionner le moyen de paiement et au moment des instructions, n’envoyez pas de nouveau SMS ou n’effectuez pas de nouvel appel. Lors de la deuxième étape, vous pourrez saisir le code, une fois seulement.
    </p>

    <h3 id=\"code_pre_inserted\">J’avais un code et en le saisissant, on me dit qu’il a déjà été utilisé</h3>
    <p>
        Dirigez-vous vers notre centre d’assistance, saisissez les informations demandées y compris le code et votre adresse email et nous vérifierons si le code a été utilisé (ainsi que où et quand), et si non, nous vous donnerons une solution par email (un nouveau code).
    </p>

";
        
        $__internal_785730c6153c404bee8a12e990d692b1faff08c5650973b26de59c2576ad6bc2->leave($__internal_785730c6153c404bee8a12e990d692b1faff08c5650973b26de59c2576ad6bc2_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Default/FAQ:faq_fr.html.twig";
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
/* {% block title %}FAQ, Foire Aux Questions{% endblock %}*/
/* {% block faq_txt %}*/
/* */
/*     <h2 class="text-center">FAQ, Foire Aux Questions</h2>*/
/* */
/*     <h3 class="voffset4" id="sms_not_sendt">J’ai envoyé un SMS, mais je n’ai pas reçu de réponse</h3>*/
/*     <p>*/
/*         Il peut y avoir plusieurs raisons à cela :*/
/*     <ul>*/
/*         <li> Vous n’avez pas écrit correctement le texte, ou vous l’avez envoyé à un mauvais numéro ; vérifiez, et s’il était erroné, renvoyez-le.</li>*/
/*         <li> Vous avez une carte prépayée et vous n’avez pas assez de crédit.</li>*/
/*         <li> Votre numéro de portable est sur une « liste noire » dans notre système, soit parce que le titulaire du contrat l’a demandé, soit parce que des factures impayées sont enregistrées pour votre ligne.</li>*/
/*         <li> Vous n’avez pas accès aux services premium de votre opérateur, car ces services sont bloqués par défaut. Pour les utiliser, vous devez contacter le centre d’attention à la clientèle et demander leur activation.</li>*/
/*         <li> L’opérateur vous a bloqué l’accès aux services premium suite à la demande du titulaire du contrat. </li>*/
/*         <li> Votre opérateur ne permet pas l’utilisation des services premium (beaucoup d’opérateurs virtuels ne le permettent pas). Vous devez choisir une autre méthode de paiement.</li>*/
/*         <li> Certains opérateurs ne permettent pas l’utilisation des SMS Premium pour les contrats d’entreprise, ou l’accès se fait en ajoutant un zéro au numéro communiqué. Par exemple au 025522. </li>*/
/*     </ul>*/
/*     </p>*/
/* */
/*     <p> Si vous pensez que ce n’est pour aucune de ces raisons, dirigez-vous sur la page de notre centre d’assistance et remplissez le formulaire en indiquant le numéro de portable avec lequel vous avez essayé. Nous vérifierons le problème et nous vous contacterons pour vous expliquer ce qu’il s’est passé.*/
/*     </p>*/
/* */
/*     <h3 id="cant_call">Je n’ai pas pu appeler le numéro de téléphone indiqué à l’écran.</h3>*/
/*     <p>*/
/*         De la même manière que pour le SMS, il peut y avoir plusieurs raisons à cela :*/
/*     <ul>*/
/*         <li> Vous n’avez pas tapé le bon numéro : vérifiez et essayez de nouveau.</li>*/
/*         <li> Vous avez une carte prépayée et vous n’avez pas assez de crédit.</li>*/
/*         <li> Votre numéro de portable est sur une « liste noire » dans notre système, soit parce que le titulaire du contrat l’a demandé, soit parce que des factures impayées sont enregistrées pour votre ligne.</li>*/
/*         <li> Vous n’avez pas accès aux services premium de votre opérateur, car ces services sont bloqués par défaut. Pour les utiliser, vous devez contacter le centre d’attention à la clientèle et demander leur activation.</li>*/
/*         <li> Beaucoup d’entreprises bloquent l’accès aux services premium à leurs utilisateurs, depuis des lignes fixes et mobiles.</li>*/
/*         <li> L’opérateur vous a bloqué l’accès aux services premium suite à la demande du titulaire du contrat. </li>*/
/*         <li> Votre opérateur ne permet pas l’utilisation des services premium (beaucoup d’opérateurs virtuels ne le permettent pas). Vous devez choisir une autre méthode de paiement.</li>*/
/*         <li> Certains opérateurs ne permettent pas l’utilisation des services Premium aux contrats d’entreprise : si c’est le cas, le titulaire du contrat doit en demander l’activation.</li>*/
/*     </ul>*/
/*     </p>*/
/*     <p>*/
/*         Si vous pensez que ce n’est pour aucune de ces raisons, dirigez-vous sur la page de notre centre d’assistance et remplissez le formulaire en indiquant le numéro de portable avec lequel vous avez essayé. Nous vérifierons le problème et nous vous contacterons pour vous expliquer ce qu’il s’est passé.*/
/*     </p>*/
/*     <h3 id="paypal_doesnt_work"> J’ai payé avec PayPal, mais je ne vois pas les crédits sur mon compte.</h3>*/
/*     <p>*/
/*         Vous devez nous envoyer le numéro d’identification de la transaction de Wolopay et de Paypal à l’adresse support@wolopay.net ainsi que le justificatif de paiement de ce dernier. Une fois que nous aurons vérifié les données, nous contacterons le jeu pour les informer de ce qu’il s’est passé et pour qu’ils effectuent la transaction.*/
/*     </p>*/
/* */
/*     <h3 id="code_sms">J’ai envoyé un SMS (ou téléphoné) et j’ai un code. Où puis-je le mettre ?</h3>*/
/*     <p>*/
/*         Si vous avez envoyé un SMS avec le mot clé ou que vous avez appelé au numéro habituel du jeu, mais sans avoir initié un achat dans ce dernier, nous ne pouvons assigner votre message (ou appel) a aucune transaction et nous ne pouvons donc pas communiquer au jeu de vous ajouter les crédits. Vous devez entrer dans le jeu, aller dans la section paiement, sélectionner le moyen de paiement et au moment des instructions, n’envoyez pas de nouveau SMS ou n’effectuez pas de nouvel appel. Lors de la deuxième étape, vous pourrez saisir le code, une fois seulement.*/
/*     </p>*/
/* */
/*     <h3 id="code_pre_inserted">J’avais un code et en le saisissant, on me dit qu’il a déjà été utilisé</h3>*/
/*     <p>*/
/*         Dirigez-vous vers notre centre d’assistance, saisissez les informations demandées y compris le code et votre adresse email et nous vérifierons si le code a été utilisé (ainsi que où et quand), et si non, nous vous donnerons une solution par email (un nouveau code).*/
/*     </p>*/
/* */
/* {% endblock %}*/
