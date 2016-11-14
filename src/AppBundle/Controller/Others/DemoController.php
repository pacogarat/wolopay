<?php

namespace AppBundle\Controller\Others;


use AppBundle\Entity\App;
use AppBundle\Entity\Transaction;
use AppBundle\Form\Type\TransactionDemoExtendsType;
use AppBundle\Form\Type\TransactionDemoType;
use AppBundle\Helper\UtilHelper;
use AppBundle\Util\WSSEUtil;
use Doctrine\ORM\EntityManagerInterface;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Service\Client;
use JMS\DiExtraBundle\Annotation\Inject;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Router;

class DemoController extends Controller
{
    /**
     * @Inject("router")
     * @var Router
     */
    private $router;

    /**
     * @Inject("guzzle.client")
     * @var Client
     */
    public $guzzle;

    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManagerInterface
     */
    public $em;

    /**
     * @Route("/demo", name="demo_index" )
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $obj = new Transaction();

        $demo = $this->em->getRepository("AppBundle:App")->findOneBy(['name'=>'demo']);
        // default

        $form = $this->createForm(new TransactionDemoType(), $obj, ['app'=>$demo, 'em' => $this->getDoctrine()->getManager()]);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) 
            {
                return $this->sendForm($form, $obj, $this->em->getRepository("AppBundle:App")->findOneBy(['name'=> 'Demo']));
            }

        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/demo_test", name="test_demo" )
     */
    public function testAction(Request $request)
    {
        $obj = new Transaction();

        $form = $this->createForm(new TransactionDemoExtendsType(), $obj, ['em' => $this->getDoctrine()->getManager()]);

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isValid())
            {
                return $this->sendForm($form, $obj, $obj->getApp());
            }
        }

        return $this->render('@App/Others/Demo/index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Doing a request like client
     *
     * @param Form $form
     * @param Transaction $obj
     * @param App $app
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    private function sendForm($form, $obj, $app)
    {
        if (!$appShop = $this->em->getRepository("AppBundle:AppShop")->findOneByAppIdAndLevelCategory($app->getId(), $obj->getLevelCategory()->getId()))
            return new BadRequestHttpException("Shop to level ".$appShop->getLevelCategory()->getName()." is inactive");

        $params = [
            'gamer_id'                 => $obj->getGamer()->getGamerExternalId(),
            'gamer_level'              => $appShop->getValueLower(),
            'default_language'         => ($obj->getLanguageDefault() ? $obj->getLanguageDefault()->getId() : null),
            'theme'                    => ($obj->getCss() ? $obj->getCss()->getName() : null),
            'countries'                => UtilHelper::parseIdEntitiesToCSV($obj->getCountriesAvailable()),
            'tab_categories'           => UtilHelper::parseIdEntitiesToCSV($obj->getAppTabsAvailable(), '', 'name_unique'),
            'articles'                 => UtilHelper::parseIdEntitiesToCSV($obj->getArticlesAvailable()),
            'pay_methods'              => UtilHelper::parseIdEntitiesToCSV($obj->getPayMethodsAvailable()),
            'fixed_country'            => $obj->getFixedCountry() ? '1' : '0',
            'fixed_language'           => $obj->getFixedLanguage()? '1' : '0',
            'selected_article_id'      => $obj->getSelectedArticle() ? $obj->getSelectedArticle()->getId() : null,
            'selected_tab_category_id' => $obj->getSelectedAppTab() ? $obj->getSelectedAppTab()->getNameUnique() : null,
            'tutorial_enabled'         => $obj->getTutorialEnabled()? '1' : '0',
            'custom_param'             => $obj->getCustomParam(),
            'return'                   => $obj->getReturn(),
            'first_pay_methods'        => ($obj->getFirstPayMethods()? '1' : '0'),
            'test'                     => true,
            'external_store'           => $obj->getExternalStore(),
        ];

        if ($obj->getGamer()->getEmail())
            $params['gamer_email'] = $obj->getGamer()->getEmail();

        if ($obj->getSelectedArticle())
            $params['selected_article_id'] = $obj->getSelectedArticle()->getId();

        if ($obj->getUrlNotification())
            $params['url_notification'] = $obj->getUrlNotification();

        $appDemoCredentials = $app->getAppApiHasCredential();
        $headers = [
            'X-WSSE' => WSSEUtil::generateHeaderWSSE($appDemoCredentials->getCodeKey(), $appDemoCredentials->getSecretKey())
        ];

//        print_r($headers);

        try {
            $request   = $this->guzzle->post($this->container->getParameter('domain_main'). $this->router->generate('api_transaction_create_transaction'), $headers, $params);
            $response  = $request->send();
        } catch (ClientErrorResponseException $exception) {
//             echo 'Server Error: '.$exception->getResponse()->getBody(true).', status code:'.$exception->getResponse()->getStatusCode();die;
            $form->addError(new FormError('Server Error: '.$exception->getResponse()->getBody(true).', status code:'.$exception->getResponse()->getStatusCode()));
            return $this->render('@App/Others/Demo/index.html.twig', ['form' => $form->createView()]);

        } catch (BadResponseException $exception) {

            if ($this->getParameter('kernel.environment') === 'dev')
                echo $exception->getResponse()->getBody(true);

            throw new $exception;
        }

//        echo $response->getBody(true);die;

        $obj = json_decode($response->getBody(true));

//        echo $response->getBody($obj->url);die;

        return new RedirectResponse($obj->url);
    }
}
