<?php


namespace AppBundle\Tests\E2E\WolopaySDK;


use AppBundle\Tests\Lib\FunctionalTestCase;


class AbstractWolopaySDK extends FunctionalTestCase
{
    /**
     * @return WolopayApiWrapper
     */
    protected function getApiWolopayObjectDemo ()
    {
        $app = $this->getApp();
        $appCredentials = $app->getAppApiHasCredential();

        $domain = $this->container->getParameter('domain_main') . '/api/v1';
        $wolopayApi = new WolopayApiWrapper($appCredentials->getCodeKey(), $appCredentials->getSecretKey(), $domain);

        return $wolopayApi;
    }
} 