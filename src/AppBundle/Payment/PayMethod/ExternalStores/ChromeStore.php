<?php


namespace AppBundle\Payment\PayMethod\ExternalStores;


use AppBundle\Payment\PayMethod\Interfaces\PayMethodVerifyCredentialsInterface;
use JMS\DiExtraBundle\Annotation\Service;

/**
 * @Service("shop.payment.chrome_store_ipn_pay_method")
 */
class ChromeStore extends AbstractExternalStore implements PayMethodVerifyCredentialsInterface
{
    const PRIVATE_KEY = 'notasecret';


    public function getToken($service_account_name, $key_file_location, $application_name)
    {
        $client = new \Google_Client();
        $client->setApplicationName($application_name);

        $key = file_get_contents($key_file_location);
        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_name,
            array('https://www.googleapis.com/auth/chromewebstore'),
            $key
        );

        $client->setAssertionCredentials($cred);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion($cred);
        }

        $json = json_decode($client->getAccessToken());

        return $json->access_token;
    }

    /**
     * @param array $credentialsArray
     * @return bool
     */
    public function verifyCredentials(array $credentialsArray)
    {

    }

    /** @return array */
    public function getShapeProviderClientCredentials()
    {
        return [
            'application_name'     => null,
            'client_id'            => null,
            'service_account_name' => null, //Email Address
        ];
    }
}