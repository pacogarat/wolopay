<?php


namespace AppBundle\Payment\PayMethod\Exceptions;


use AppBundle\Entity\App;
use AppBundle\Entity\Provider;
use AppBundle\Interfaces\SendCustomEmailOnErrorInterface;

class PayMethodOnlyAvailableWithProviderClientCredentialsException extends AbstractConfigurationRequiredPayMethodException implements SendCustomEmailOnErrorInterface
{
    private $emailTo;
    private $subject;
    private $content;

    public function __construct(App $app, Provider $provider)
    {
        $this->emailTo = $app->getTechnicalEmail();
        $this->subject = 'An error ocurred in '.$app->getName().' with gateway '.$provider->getName();

        $this->content = '
        Warning an error ocurred in '.$app->getName().', The provider <b>'.$provider->getName().'</b> is enabled but your credentials in gateway sections are empty<br>
        You can make two things<br><br>

        1- Insert your client credentials<br>
        Go to https://wolopay.com/admin in the top click in gear icon -> select provider and write your credentials<br><br>

        2- deactivate the paymethods<br>
        Go to https://wolopay.com/admin in left menu click in menu configuration / Wizard -> Step 5 , deactive all paymethods related with the issue
        <br><br>
        ';
    }

    /**
     * @return string|array
     */
    public function getEmailTo()
    {
        return $this->emailTo;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getContentHTML()
    {
        return $this->content;
    }
}