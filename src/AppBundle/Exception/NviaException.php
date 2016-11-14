<?php

namespace AppBundle\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;

class NviaException extends \Exception implements ExceptionInterface
{
    const APP_DOESNT_EXIST = 501;
    const API_CODE_KEY_DOESNT_EXIST = 501;
    const API_HAVENT_PERMISSION_APP = 502;
    const API_HAVENT_ARTICLES_FOR_THIS_TRANSACTIONS= 503;

    const SHOPS_NOT_AVAIBLE_FOR_LEVEL = 601;

    const ARTICLE_HAVENT_AMOUNT = 701;
    const ARTICLE_INVALID_NUMBER_SHOPS= 702;


    const INVALID_TO_THIS_APP = 700;
    const INVALID_IP_COUNTRY = 720;
    const MESSAGE_INVALID_IP_COUNTRY = 'You cant buy from your country';

    const SERVICE_DOESNT_EXIST = 703;

    const BLACKLISTED_COUNTRY = 901;
    const BLACKLISTED_USER = 902;
    const BLACKLISTED_IP = 903;

    const PAYMENT_CANT_GENERATE_PAYMENT= 1000;
    const VERIFY_PAYMENT_INVALID= 2000;

    const TRANSACTION_HAVE_STATE_COMPLETE_BUT_DOESNT_PAYMENT= 1010;

    const PROXY_NOT_ALLOWED_CODE = 9999;

    // Generic error
    const INVALID_UNKNOWN= 5090;

    const MESSAGE_STANDARD = 'Contact with Wolopay support';


}