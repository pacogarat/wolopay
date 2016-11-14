<?php

namespace AppBundle\Controller\Others;

use AppBundle\Form\Type\ClientInitType;
use AppBundle\Form\Type\ContactSimpleType;
use AppBundle\Util\WSSEUtil;
use Guzzle\Http\Client;
use Guzzle\Http\Exception\BadResponseException;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DefaultController extends Controller
{
    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Route("/{_locale}", requirements={"_locale" = "(en|es)"}, defaults={"_locale" = "en"}, options={"url_call_to_cache_after_deploy"="always"}, name="home")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new ContactSimpleType(), null);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();

                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact from home')
                    ->setFrom($this->container->getParameter('email_app'))
                    ->setTo($this->container->getParameter('email_support_gamer'))
                    ->setBody('Name: '.$data['name']."\nEmail:".$data['email']."\n\nMessage:".$data['message'])
                ;
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->set('success','email_was_sent');
            }
        }

        $em = $this->getDoctrine()->getManager();
        $jobs = $em->getRepository("AppBundle:Job")->findAll();

        $response = new Response($this->renderView('@App/Others/Default/index.html.twig', [
            'contactFrom' => $form->createView(),
            'jobs'        => $jobs,
        ]));

        if ($request->getMethod() === 'POST')
            $response->setPrivate();
        else {
            $response->setPublic();
            $time = 60 * 60 * 24 * 2 ;
            $response->setMaxAge($time);
            $response->setSharedMaxAge($time);
        }

        return $response;
    }

    /**
     * @Route("/try-control-panel", name="try_control_panel")
     */
    public function adminViewpAction(Request $request)
    {
        if ($this->container->getParameter('is_production'))
            throw new AccessDeniedException('');

        $clientUser = $this->getDoctrine()->getRepository("AppBundle:ClientUser")->findOneBy(['name' => 'DemoUser']);
        $token = new UsernamePasswordToken($clientUser, $clientUser->getPassword(), 'main', $clientUser->getRoles());

        $this->get('security.token_storage')->setToken($token);

        return $this->redirectToRoute('admin_home');
    }

    /**
     * @Route("/{_locale}/sign-up", requirements={"_locale" = "(en|es)"}, defaults={"_locale" = "en"}, name="singup", options={"url_call_to_cache_after_deploy"="always"} )
     * @Template()
     * @Cache(expires="+2 days", public=true)
     */
    public function singUpAction(Request $request)
    {
        $form = $this->createForm(new ClientInitType(), null, ['em' => $this->getDoctrine()]);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $data = $form->getData();

                $body = '';

                foreach ($data as $key=>$value)
                    $body .= "$key: $value\n";

                $message = \Swift_Message::newInstance()
                    ->setSubject('Sign up, company: '.$data['companyName'])
                    ->setFrom($this->container->getParameter('email_app'))
                    ->setTo($this->container->getParameter('email_info_wolopay'))
                    ->setBody($body)
                ;
                $this->get('mailer')->send($message);
                $this->get('session')->getFlashBag()->set('success','email_was_sent_and_we_will_contact');

                $message = \Swift_Message::newInstance()
                    ->setSubject('Sign up, company: '.$data['companyName'])
                    ->setFrom($this->container->getParameter('email_app'))
                    ->setTo($data['email'])
                    ->setBody(
                        <<<EOT
Dear Customer<br><br>

We’re glad to know that you’re interested in Wolopay. We’ll check your request and validate the data.<br>
Once we make sure we can give you the service, we’ll contact you with your user and password. In the meanwhile, you can take a look to the documentation, or contact us in this same mail with any doubt you may have.<br><br>

Welcome to the best storefront management and payment aggregator in the world. Welcome to Wolopay
EOT
            )
                ;
                $this->get('mailer')->send($message);

                $form = $this->createForm(new ClientInitType(), null, ['em' => $this->getDoctrine()]);
            }
        }

        return array(
            'singupFrom' => $form->createView()
        );
    }

    /**
     * @param $route
     * @param $params
     * @return \Guzzle\Http\Message\RequestInterface
     */
    private function getRequestExample($route, $params)
    {
        $appId = 'app_543210417b510';
        $secret = '123472b02668b6d817f65ab83f1b7b53a1ba4993';

        $headers = [
            'X-WSSE' => WSSEUtil::generateHeaderWSSE($appId, $secret)
        ];

        return $this->guzzle->post('https://sandbox.wolopay.com'. $this->generateUrl($route), $headers, $params);
    }

    /**
     * @Route("/{_locale}/example", defaults={"_locale" = "en", "lightbox" = false}, name="example", options={"url_call_to_cache_after_deploy"="always"})
     * @Route("/{_locale}/example-light-box", defaults={"_locale" = "en", "lightbox" = true}, name="example_light_box", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function exampleAction(Request $request, $_locale, $lightbox)
    {
        $params = [
            'gamer_id' => 'shop',
            'test' => '1',
            'default_language' => 'en',
        ];

        if (!$lightbox)
        {
            $params['theme'] = 'Berserk Modular without background';
            $params['gamer_id'] .= '_no_lightbox';
        }

        $params['selected_article_id'] = '322ebad8-18e9-11e5-aed9-00259068f82e';

        $request   = $this->getRequestExample('api_transaction_create_transaction', $params);
        try{
            $response  = $request->send();
        }catch (BadResponseException $e){
            $this->get('logger')->addError($e->getResponse()->getBody(true));
            throw $e;
        }

        $obj = json_decode($response->getBody(true));

        return $this->redirect($obj->url);
    }

    /**
     * @Route("/{_locale}/example-payment-widget", options={"expose" = true}, defaults={"_locale" = "en"}, name="example_payment_widget", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function examplePaymentWidgetAction(Request $request, $_locale)
    {
        $params= [
            'gamer_id' => 'shop',
            'amount' => '49.56',
            'currency' => 'EUR',
            'article_title' => 'Incredible article',
            'article_description' => 'The best article of the world',
            'country' => 'es'
        ];

        $request   = $this->getRequestExample('api_transaction_create_transaction_custom_widget', $params);
        $response  = $request->send();
        $obj = json_decode($response->getBody(true));

        return $this->redirect($obj->url);
    }

    /**
     * @Route("/{_locale}/legal", options={"expose" = true}, defaults={"_locale" = "en"}, name="legal", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function legalAction(Request $request, $_locale)
    {
        if (!$this->get('templating')->exists("AppBundle:Others/Default/Legal:legal_$_locale.html.twig"))
            return new Response($this->renderView("AppBundle:Others/Default/Legal:legal_en.html.twig"));

        return new Response($this->renderView("AppBundle:Others/Default/Legal:legal_$_locale.html.twig"));
    }

    /**
     * @Route("/{_locale}/FAQ", options={"expose" = true, "url_call_to_cache_after_deploy"="always"}, defaults={"_locale" = "en"}, name="faq")
     * @Cache(expires="+2 days", public=true)
     */
    public function faqAction(Request $request, $_locale)
    {
        if (!$this->get('templating')->exists("AppBundle:Others/Default/FAQ:faq_$_locale.html.twig"))
            return new Response($this->renderView("AppBundle:Others/Default/FAQ:faq_en.html.twig"));

        return new Response($this->renderView("AppBundle:Others/Default/FAQ:faq_$_locale.html.twig"));
    }

    /**
     * @Route("/{_locale}/legal-notice", defaults={"_locale" = "en"}, name="legal_notice", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function legalNoticeAction(Request $request, $_locale)
    {
        if (!$this->get('templating')->exists("AppBundle:Others/Default/LegalNotice:legal_notice_$_locale.html.twig"))
            return new Response($this->renderView("AppBundle:Others/Default/LegalNotice:legal_notice_en.html.twig"));

        return new Response($this->renderView("AppBundle:Others/Default/LegalNotice:legal_notice_$_locale.html.twig"));
    }

    /**
     * @Route("/{_locale}/terms-&-conditions", defaults={"_locale" = "en"}, name="terms_conditions", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function termsConditionsAction(Request $request, $_locale)
    {
        if (!$this->get('templating')->exists("AppBundle:Others/Default/termsConditions:terms_conditions_$_locale.html.twig"))
            return new Response($this->renderView("AppBundle:Others/Default/termsConditions:terms_conditions_en.html.twig"));

        return new Response($this->renderView("AppBundle:Others/Default/termsConditions:terms_conditions_$_locale.html.twig"));
    }

    /**
     * @Route("/{_locale}/privacy-policy", defaults={"_locale" = "en"}, name="privacy_policy", options={"url_call_to_cache_after_deploy"="always"})
     * @Cache(expires="+2 days", public=true)
     */
    public function privacyPolicyAction(Request $request, $_locale)
    {
        if (!$this->get('templating')->exists("AppBundle:Others/Default/PrivacyPolicy:privacy_policy_$_locale.html.twig"))
            return new Response($this->renderView("AppBundle:Others/Default/PrivacyPolicy:privacy_policy_en.html.twig"));

        return new Response($this->renderView("AppBundle:Others/Default/PrivacyPolicy:privacy_policy_$_locale.html.twig"));
    }

    /**
     * @Route("/parser")
     * @Template()
     */
//    public function parserAction()
//    {
//        include __DIR__.'/pepe.php';
//
//        $es =  Yaml::dump($idi["es"]);
//        $en =  Yaml::dump($idi["en"]);
//
//        file_put_contents(__DIR__ . '/../Resources/translations/home.es.yml', $es);
//        file_put_contents(__DIR__ . '/../Resources/translations/home.en.yml', $en);
//
//    }
}
