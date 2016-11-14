<?php


namespace AppBundle\Helper;


use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class UtilHelper {

    CONST SALT ='L.-tP9/6w.8;j?R9';

    static public function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static public function nTimesCallback($callback ,$nTimes)
    {
        while ($nTimes > 0)
        {
            $callback($nTimes);
            $nTimes--;
        }
    }

    static public function removePortFromUrlIfExist($url)
    {
        return preg_replace("/\:[0-9]{2,4}/", '', $url);
    }

    static public function maxLengthString($string, $length)
    {
        if(strlen($string) >= $length)
            $string = substr($string, 0, $length - 3).'...';

        return $string;
    }

    /**
     * @param ConstraintViolationListInterface $errors
     *
     * @return array
     */
    static public function errorsGetStringArrayApi($errors)
    {
        $texts = array();
        foreach ($errors as $error)
        {
            $texts[]=$error->getMessage();
        }

        return $texts;
    }

    static public function getPortFromUrlIfExist($url)
    {
        preg_match("/\:([0-9]{2,4})/", $url, $matches);

        if (!$matches[1])
            return null;

        return $matches[1];
    }

    /**
     * @param array $entities
     * @param string $quotesSymbol
     * @param string $id
     * @return string
     */
    static public function parseIdEntitiesToCSV($entities, $quotesSymbol='',$id='id')
    {
        if (!$entities)
            return null;

        $text = '';

        $accessor = PropertyAccess::createPropertyAccessor();

        foreach ($entities  as $entity)
            $text.=','.$quotesSymbol.$accessor->getValue($entity, $id).$quotesSymbol;

        $text = substr($text, 1);

        return $text;
    }

    /**
     * @param $ids
     * @param $repository
     * @param $em
     * @param string $errorMsgFrom
     * @throws \Exception
     * @return array
     */
    static public function getObjectsFromCSV($ids, $repository, $em, $errorMsgFrom='Invalid id: %s')
    {
        if (!$ids)
            return [];

        $ids = explode(',',$ids);

        $result = [];
        foreach ($ids as $id)
        {
            if (!$value = $em->getRepository($repository)->find($id))
                throw new \Exception(sprintf($errorMsgFrom, (string) $id));

            $result[] = $value;
        }

        return $result;
    }

    /**
     * @param $objs
     * @return array
     */
    static public function getIdsArrayFromObjects($objs)
    {
        $result = [];
        foreach ($objs as $obj)
            $result[] = $obj->getId();

        return $result;
    }

    static public function str_putcsv($input, $delimiter = ',', $enclosure = '"')
    {
        // Open a memory "file" for read/write...
        $fp = fopen('php://temp', 'r+');
        // ... write the $input array to the "file" using fputcsv()...
        fputcsv($fp, $input, $delimiter, $enclosure);
        // ... rewind the "file" so we can read what we just wrote...
        rewind($fp);
        // ... read the entire line into a variable...
        $data = fread($fp, 1048576);
        // ... close the "file"...
        fclose($fp);
        // ... and return the $data to the caller, with the trailing newline from fgets() removed.
        return rtrim($data, "\n");
    }

    static public function prettyPrice($amount, $decimalPlaces = null, $roundTo = 0.95)
    {
        if ($decimalPlaces === 0)
            return self::roundToInt($amount);

        $decimalPart = round(abs($amount - floor($amount)),2);

        if ($amount <= 1) {
            $amount = round($amount, 2);
        }elseif ($amount <= 10){
            $roundTo = 0.05;
            $amount = self::my_ceiling3($amount,$roundTo);
        }elseif ($amount <= 25){
            $roundTo = 0.25;
            $amount = self::my_ceiling3($amount,$roundTo);
        }elseif ($amount <= 300){

            $roundTo = 0.95; //redondeo al .95 mas cercano
            if ( ($decimalPart<>$roundTo) && ($decimalPart<>0) && ($decimalPart<>0.99) ){

                if ( abs($roundTo-$decimalPart) < ($roundTo/2) ){
                    $amount=floor($amount)+$roundTo;
                }else{
                    $amount=floor($amount)-1+$roundTo;
                }
            }

        }else{
            $amount=self::roundToInt($amount);
        }


        if ($decimalPlaces)
        {
            $multiplyBy = pow(10, $decimalPlaces);
            return round($amount * $multiplyBy ) / $multiplyBy;
        }

        return $amount;
    }

    static function my_ceiling3($amount, $roundTo)
    {
        $decimalPart = round(abs($amount - floor($amount)),2);
    
        if ($decimalPart == $roundTo) return $amount;
        if ($decimalPart==0)return $amount;
        if ($decimalPart==0.99) return $amount;
        if ($decimalPart==0.95) return $amount;
    
        $rest = floor(($decimalPart * 100) / ($roundTo * 100));
        $newR1 = $rest * $roundTo;
        $newR2 = ($rest + 1) * $roundTo;
        $diff1 = abs($decimalPart - $newR1);
        $diff2 = abs($decimalPart - $newR2);
        if ($diff1 > $diff2)
            $def = $newR2;
        else
            $def =  $newR1;
    
        if ($def==0.00) $def= -0.05;
        if ($def==1.00) $def= 0.95;
    
        $amount = floor($amount) + $def;
    
    
    
        return $amount;
    }

    static function roundToInt($x)
    {
        $quantity = round($x);
        $nod = ceil(log10($quantity));
        $nFreeDigits = ceil($nod/2);
        $freePart = intval($quantity/(pow(10,($nFreeDigits-1))));

        $parametrized = -$freePart+$quantity/pow(10,($nFreeDigits-1));
        $converted=0;
        if ($parametrized>=0.25 && $parametrized<0.65)
        {
            $converted=0.5;

        }else if ($parametrized>=0.65)
        {
            $freePart = $freePart + 1;
        }
        $temp= ($freePart+$converted)*pow(10,$nFreeDigits-1);
        return $temp;
    }

    // decbin32
    // In order to simplify working with IP addresses (in binary) and their
    // netmasks, it is easier to ensure that the binary strings are padded
    // with zeros out to 32 characters - IP addresses are 32 bit numbers
    static public function decbin32 ($dec) {
        return str_pad(decbin($dec), 32, '0', STR_PAD_LEFT);
    }

    // ip_in_range
    // This function takes 2 arguments, an IP address and a "range" in several
    // different formats.
    // Network ranges can be specified as:
    // 1. Wildcard format:     1.2.3.*
    // 2. CIDR format:         1.2.3/24  1.2.3.0/24 OR  1.2.3.4/255.255.255.0
    // 3. Start-End IP format: 1.2.3.0-1.2.3.255
    // The function will return true if the supplied IP is within the range.
    // Note little validation is done on the range inputs - it expects you to
    // use one of the above 3 formats.
    static public function ipv4_in_range($ip, $range) {
        if (strpos($range, '/') !== false) {
            // $range is in IP/NETMASK format
            list($range, $netmask) = explode('/', $range, 2);
            if (strpos($netmask, '.') !== false) {
                // $netmask is a 255.255.0.0 format
                $netmask = str_replace('*', '0', $netmask);
                $netmask_dec = ip2long($netmask);
                return ( (ip2long($ip) & $netmask_dec) == (ip2long($range) & $netmask_dec) );
            } else {
                // $netmask is a CIDR size block
                // fix the range argument
                $x = explode('.', $range);
                while(count($x)<4) $x[] = '0';
                list($a,$b,$c,$d) = $x;
                $range = sprintf("%u.%u.%u.%u", empty($a)?'0':$a, empty($b)?'0':$b,empty($c)?'0':$c,empty($d)?'0':$d);
                $range_dec = ip2long($range);
                $ip_dec = ip2long($ip);

                # Strategy 1 - Create the netmask with 'netmask' 1s and then fill it to 32 with 0s
                #$netmask_dec = bindec(str_pad('', $netmask, '1') . str_pad('', 32-$netmask, '0'));

                # Strategy 2 - Use math to create it
                $wildcard_dec = pow(2, (32-$netmask)) - 1;
                $netmask_dec = ~ $wildcard_dec;

                return (($ip_dec & $netmask_dec) == ($range_dec & $netmask_dec));
            }
        } else {
            // range might be 255.255.*.* or 1.2.3.0-1.2.3.255
            if (strpos($range, '*') !==false) { // a.b.*.* format
                // Just convert to A-B format by setting * to 0 for A and 255 for B
                $lower = str_replace('*', '0', $range);
                $upper = str_replace('*', '255', $range);
                $range = "$lower-$upper";
            }

            if (strpos($range, '-')!==false) { // A-B format
                list($lower, $upper) = explode('-', $range, 2);
                $lower_dec = (float)sprintf("%u",ip2long($lower));
                $upper_dec = (float)sprintf("%u",ip2long($upper));
                $ip_dec = (float)sprintf("%u",ip2long($ip));
                return ( ($ip_dec>=$lower_dec) && ($ip_dec<=$upper_dec) );
            }

            return false;
        }

    }

    /**
     * @param $checkedIP
     * @param array $array_of_ips
     * @return bool
     */
    static public function ipv4_in_array($checkedIP, array $array_of_ips){
        if (in_array($checkedIP, $array_of_ips)) {
            return true;
        }
        foreach($array_of_ips as $ipInArray){
            if (UtilHelper::ipv4_in_range($checkedIP, $ipInArray))
                return true;
        }
        return false;
    }


    static function is0GetNull($val)
    {
        if (!$val || $val == 0 || $val == '0')
            return null;

        return $val;
    }

    static public function startsWith($haystack, $needle)
    {
        return (substr($haystack, 0, strlen($needle)) === $needle);
    }

    static public function endsWith($haystack, $needle)
    {
        return substr($haystack, -strlen($needle))===$needle;
    }

    static public function encrypt($text)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, self::SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

    static public function decrypt($text)
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, self::SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

    static public function getValueFromPrivateProperty($class, $obj, $propertyName)
    {
        $class = new \ReflectionClass($class);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($obj);
    }

    /**
     * @param $obj
     * @return \Doctrine\ORM\EntityManagerInterface
     */
    static public function getEntityManagerFromPersistentCollection($obj)
    {
        return self::getValueFromPrivateProperty("\\Doctrine\\ORM\\PersistentCollection", $obj, "em");
    }

    static public function toDateStrStats($dateFormat='months'){
        $dateFormatStr = "";
        if ($dateFormat=='days')
            $dateFormatStr.= "'%Y-%m-%d'";
        else if ($dateFormat=='weeks')
            $dateFormatStr.= "'%x, %v'";
        else if ($dateFormat=='weekdays')
            $dateFormatStr.= "'%w'";
        else if ($dateFormat=='hours')
            $dateFormatStr.= "'%k'";
        else // months default
            $dateFormatStr.= "'%Y-%m'";

        return $dateFormatStr;
    }

    static public function dateQueryStr($field, $offset, &$dateFormat, &$dateFormatStr, \DateTime $dateFromObj, \DateTime $dateToObj){
        $diff=date_diff($dateFromObj, $dateToObj);
        if (($diff->d < 7) ){
            $horas = ($diff->d*24)+ ($diff->h);
            $nDiff = ceil($horas/30);
            $dateFormat = '2hours';
            $dateFormatStr = "'%k'";

            $nStr0 = " DATE_FORMAT(DATE_ADD($field, $offset, 'hour'),'%Y-%m-%d ') ";
            $nStr1 = "  FLOOR( DATE_FORMAT(DATE_ADD($field, $offset, 'hour'),$dateFormatStr)/$nDiff) * $nDiff ";
            $nStr2 = "  (FLOOR( DATE_FORMAT(DATE_ADD($field, $offset, 'hour'),$dateFormatStr)/$nDiff) * $nDiff)+1 ";
            $nStr = "MYCONCAT($nStr0, $nStr1,':00:00 - ',$nStr2,':00:00') ";
        } else{
            $nStr = " CONCAT(DATE_FORMAT(DATE_ADD ($field, $offset, 'hour'), $dateFormatStr), 'h') ";
        }
    return $nStr;
    }

}