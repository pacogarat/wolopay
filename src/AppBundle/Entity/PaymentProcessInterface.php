<?php


namespace AppBundle\Entity;


interface PaymentProcessInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param PaymentStatusCategory $statusCategory
     * @return $this
     */
    public function setStatusCategory(\AppBundle\Entity\PaymentStatusCategory $statusCategory);

    /**
     * Get statusCategory
     *
     * @return \AppBundle\Entity\PaymentStatusCategory
     */
    public function getStatusCategory();

    /**
     * Set transactionExternalId
     *
     * @param string $transactionExternalId
     * @return $this
     */
    public function setTransactionExternalId($transactionExternalId);

    /**
     * Get transactionExternalId
     *
     * @return string
     */
    public function getTransactionExternalId();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set paymentDetail
     *
     * @param \AppBundle\Entity\PaymentDetail $paymentDetail
     * @return Payment
     */
    public function setPaymentDetail(\AppBundle\Entity\PaymentDetail $paymentDetail);

    /**
     * Get paymentDetail
     *
     * @return \AppBundle\Entity\PaymentDetail
     */
    public function getPaymentDetail();

    /**
     * Set request
     *
     * @param $url
     * @param array $params
     * @param null $subRequest
     * @return $this
     */
    public function setRequest($url, $params = [], $subRequest=null);

    /**
     * Get request
     *
     * @return array
     */
    public function getRequest();

    /**
     * Set responses
     *
     * @param array $responses
     * @return $this
     */
    public function addResponse($responses);

    /**
     * Get responses
     *
     * @return array
     */
    public function getResponses();

    /**
     * Get responses
     *
     * @param $response
     * @return array
     */
    public function addResponseSubRequestLast($response);

    /**
     * @return string
     */
    public function getIp();

    /**
     * @param App $app
     * @return $this
     */
    public function setApp(App $app);

    /**
     * @return App
     */
    public function getApp();

    /**
     * @param Gamer $gamer
     * @return $this
     */
    public function setGamer(Gamer $gamer);

    /**
     * @return Gamer
     */
    public function getGamer();

} 