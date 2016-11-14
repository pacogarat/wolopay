<?php

namespace AppBundle\Util;



/**
 * Class ApiRequestCommand
 * @package AppBundle\Command
 */
class WSSEUtil
{
    /**
     * @param $username
     * @param $secret
     * @return array
     */
    static public function generateHeaderWSSE($username, $secret)
    {
        $nonce = md5(rand().uniqid(), true);
        $created = gmdate(DATE_ISO8601, time()-1);

        $digest = base64_encode(sha1($nonce.$created.$secret,true));
        $b64nonce = base64_encode($nonce);

        return  sprintf('UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $username,
            $digest,
            $b64nonce,
            $created
        );
    }

} 