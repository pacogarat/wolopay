<?php

namespace AppBundle\Controller\PaymentHosted;

use AppBundle\Entity\Enum\CreditCardEnum;
use AppBundle\Entity\Transaction;
use AppBundle\Payment\Util\PaymentProcessService;
use Doctrine\ORM\EntityManagerInterface;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

/**
 * @Route("/credit-card")
 */
class CreditCardController extends AbstractPaymentHosted
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var PaymentProcessService
     * @Inject("shop.payment.payment_process")
     */
    public $paymentProcessService;

    /**
     * @var \Guzzle\Service\Client
     * @Inject("guzzle.client")
     */
    public $guzzle;

    /**
     * @var Router
     * @Inject("router")
     */
    public $router;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    const LOG_NAME = 'voice_vo_vt_code';

    /**
     * @Route("/credit_card/{_locale}/{transaction_id}/{payment_process_id}", name="hosted_credit_card" )
     * @ParamConverter("transaction", class="AppBundle:Transaction", options={"id" = "transaction_id"})
     * @Security("has_role('ROLE_TRANSACTION_PAYMENT_CHECK_IN')")
     * @Template()
     */
    public function creditCardAction(Request $request, Transaction $transaction,
            $payment_process_id, $_locale)
    {
        $this->addSpecialLogByPayMethod(self::LOG_NAME, 'i');

        $paymentObject = $this->paymentProcessService->getPaymentProcessObjectById($payment_process_id);

        $details = $paymentObject->getPaymentDetail();
        $pmpc = $this->paymentProcessService->getPayMethodProviderHasCountry($paymentObject);

        $formsNameAvailable = $details->getExtraDataCreditCardsAvailable() ?: CreditCardEnum::getAll();

        $formsAvailable = [];
        $selectedName = '';

        foreach ($formsNameAvailable as $formName)
        {
            $formNameType = "\\AppBundle\\Form\\Type\\CreditCards\\{$formName}Type";
            $objName = "\\AppBundle\\Entity\\NotPersisted\\CreditCards\\$formName";
            $obj = new $objName();
            $form = $this->createForm(new $formNameType(), $obj);

            if ($request->request->get($form->getName()))
            {
                $selectedName = $formName;

                $form->submit($request->request->get($form->getName()));

                if ($form->isValid()) {

                    try{
                        $request = $this->guzzle->post($details->getExtraDataCreditEndUrl(), null, serialize($obj));
                        $response = $request->send();
                        echo $response->getBody(true);die;

                    }catch (BadResponseException $e){
                        $this->logger->addError("Bad Response exception ".$e->getResponse()->getBody(true));
                        echo $e->getResponse()->getBody(true);
                    }



                    return $this->redirectToRoute('task_success');
                }
            }

            $formsAvailable[] = [
                'name'           => $formName,
                'obj'            => $obj,
                'form'           => $form,
                'form_view'      => $form->createView(),
            ];

        }

        return [
            'beforeSelected' => $selectedName,
            'paymentProcess' => $paymentObject,
            'formsAvailable' => $formsAvailable,
            'appp'           => $transaction->getApp(),
            'formsNameAvailable' => $formsNameAvailable,
        ];
    }

    protected function addSpecialLogByPayMethod($idServicePaymentMethod, $action='in', $subfolder = '')
    {
        parent::addSpecialLogByPayMethod($idServicePaymentMethod, $action, '/credit_card'.$subfolder);
    }
}
