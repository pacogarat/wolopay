<?php

namespace AppBundle\Controller\AppShop;

use AppBundle\Entity\EmailGamerSupport;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\EmailGamerSupportType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/support")
 */
class SupportController extends Controller
{
    /**
     * @Route("/{_locale}/{transaction_id}", name="support_gamer" , options={"expose" = true})
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Template()
     */
    public function gamerAction(Request $request, Transaction $transaction)
    {
        $obj = new EmailGamerSupport();
        $obj
            ->setTransaction($transaction)
            ->setEmail($transaction->getGamer()->getEmail())
            ->setName($transaction->getGamer()->getName())
        ;

        $em= $this->getDoctrine()->getManager();

        $form = $this->createForm(new EmailGamerSupportType(), $obj, ['em' => $em]);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {

                $transaction->getGamer()->setName($obj->getName());
                $em->persist($obj);
                $em->flush();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Support '.$obj->getSubject().', transaction '.$obj->getTransaction()->getId())
                    ->setFrom($this->container->getParameter('email_app'))
                    ->setTo($this->container->getParameter('email_support_gamer'))
                    ->setBody("
Information:\n\n

    Name: ".$obj->getName()."\n
    Email: ".$obj->getEmail()."\n
    subject: ".$obj->getSubject()."\n
    comment: ".$obj->getComment()."\n\n

Transaction:\n\n

    transaction: ".$obj->getTransaction()->getId()."\n
    transaction state: ".$obj->getTransaction()->getStatusCategory()->getName()."\n
    Game: ".$obj->getTransaction()->getApp()->getName()."\n
    theme: ".$obj->getTransaction()->getCss()->getName()."\n
    shop level: ".$obj->getTransaction()->getLevelCategory()->getName()."\n\n

Information about user:\n\n

    GamerId: ".$obj->getTransaction()->getGamer()->getId()."\n
    GamerExternalId: ".$obj->getTransaction()->getGamer()->getGamerExternalId()."\n

                    ")
                ;
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->set('success','form.support.gamer.success');
            }
        }

        return array(
            'contactFrom' => $form->createView(),
            'transaction' => $transaction,
        );
    }

}
