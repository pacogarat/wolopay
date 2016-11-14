<?php


namespace AppBundle\Payment\PayMethod\Interact;


use AppBundle\Entity\AppShopHasArticle;
use AppBundle\Entity\PaymentDetail;
use AppBundle\Entity\PaymentDetailHasArticles;
use AppBundle\Entity\PaymentProcessInterface;
use AppBundle\Entity\SingleCustomPayment;
use AppBundle\Service\ArticleService;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Translator;

/**
 * Interact class is used like event, his main function is to pass information from controller to services.
 * but it can also be used to avoid the repetition of basic logic
 *
 * Class PaymentPrepareInteract
 * @package AppBundle\Payment\PayMethod\Interact
 */
class PaymentPrepareInteract extends AbstractInteract
{
    /**
     * @var PaymentProcessInterface
     */
    protected $paymentProcess;

    /**
     * @var AppShopHasArticle[]
     */
    protected $appShopHasArticles;

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Request
     */
    protected $requestToDo;

    protected $subRequestDone;

    /**
     * @var String
     */
    protected $urlOk;

    /**
     * @var String
     */
    protected $urlKo;

    /**
     * @var String
     */
    protected $urlIpn;

    /**
     * @var Response
     */
    protected $responseToDo;

    function __construct(PaymentProcessInterface $paymentProcess, array $sha, Request $request, $translator, $urlIpn, $urlOk, $urlKo, Logger $logger)
    {
        $this->paymentProcess     = $paymentProcess;
        $this->appShopHasArticles = $sha;
        $this->request            = $request;
        $this->translator         = $translator;

        $this->urlOk  = $urlOk;
        $this->urlKo  = $urlKo;
        $this->urlIpn = $urlIpn;

        parent::__construct($logger);
    }

    /**
     * @return PaymentProcessInterface
     */
    public function getPaymentProcess()
    {
        return $this->paymentProcess;
    }

    /**
     * @return float
     */
    public function getAmountFloat()
    {
        return $this->getPaymentProcess()->getPaymentDetail()->getAmount();
    }

    /**
     * @return string
     */
    public function getCurrencyPaymentISO()
    {
        return $this->getPaymentProcess()->getPaymentDetail()->getCurrency()->getId();
    }

    /**
     * @return \AppBundle\Entity\AppShopHasArticle[]
     */
    public function getAppShopHasArticles()
    {
        return $this->appShopHasArticles;
    }

    public function getDescLabelTranslation(PaymentDetailHasArticles $paymentDetailHasArticles)
    {
        if ($this->paymentProcess instanceof SingleCustomPayment)
            return $this->paymentProcess->getArticleDescription();

        return ArticleService::getTranslationBasic($paymentDetailHasArticles->getDescriptionCurrentLabel(),
            $paymentDetailHasArticles->getItemsQuantity(),
            $this->paymentProcess->getPaymentDetail()->getLanguage()->getId());
    }

    public function getNameTranslation(PaymentDetailHasArticles $paymentDetailHasArticles)
    {
        if ($this->paymentProcess instanceof SingleCustomPayment)
            return $this->paymentProcess->getArticleTitle();

        return ArticleService::getTranslationBasic($paymentDetailHasArticles->getNameCurrentLabel(),
            $paymentDetailHasArticles->getItemsQuantity(),
            $this->paymentProcess->getPaymentDetail()->getLanguage()->getId()
        );
    }

    public function getNameAllTranslations(PaymentDetail $paymentDetails)
    {
        if ($this->paymentProcess instanceof SingleCustomPayment)
            return $this->paymentProcess->getArticleTitle();

        $name = '';

        foreach ($paymentDetails->getPaymentDetailHasArticles() as $ppdha)
        {
            $name .= $ppdha->getArticlesQuantity().'units - '. $this->getNameTranslation($ppdha). ', ';
        }

        $name = substr($name, 0, -2);

        return $name;
    }

    public function setRequestResult($url, $method = 'GET', $params = array())
    {
        $this->requestToDo = Request::create($url, $method, $params);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequestToDo()
    {
        return $this->requestToDo;
    }

    /**
     * @return String
     */
    public function getUrlIpn()
    {
        return $this->urlIpn;
    }

    /**
     * @return String
     */
    public function getUrlKo()
    {
        return $this->urlKo;
    }

    /**
     * @return String
     */
    public function getUrlOk()
    {
        return $this->urlOk;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }



    /**
     * @param $responseBody
     * @param int $httpCode
     * @param bool $responseIsjson
     * @param bool $responseIsXml
     * @return $this
     */
    public function setSubRequestDoneResponse($responseBody, $httpCode=200, $responseIsjson=false, $responseIsXml = false)
    {
        $finalBody =  $responseBody;

        try{
            if ($responseIsXml)
            {
                $dom = new \DOMDocument;
                $dom->preserveWhiteSpace = FALSE;
                $dom->loadXML($responseBody);
                $dom->formatOutput = TRUE;
                $finalBody = "\n".$dom->saveXml();

            }else if ($responseIsjson){

                $finalBody = json_decode($responseBody);
            }

        }catch (\Exception $e){
            $this->logger->addError("Invalid format response body");
        }

        $this->subRequestDone['response'] = $finalBody;
        $this->subRequestDone['httpCode'] = $httpCode;

        $this->logger->addInfo("Sub request response status: $httpCode, response body: ".$responseBody);

        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getSubRequestDone()
    {
        return $this->subRequestDone;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getResponseToDo()
    {
        return $this->responseToDo;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Response $responseToDo
     * @return $this
     */
    public function setResponseToDo($responseToDo)
    {
        $this->responseToDo = $responseToDo;
        return $this;
    }



} 