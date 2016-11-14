<?php

namespace AppBundle\Helper;

/**
 * @deprecated Not used, u must use UtilHelper:prettyprice()
 */
class PricesHelper
{
    const FORMAT_INTEGER = 'int';
    const FORMAT_B = '99';
    const FORMAT_A = '95';

/*
    $type values:
    0-> integer currency
    1-> fractional currency rounded to -1+#.099, #.5 or #.99
    2-> fractional currency rounded to  -1+#.095, #.45 or #.95
*/

    static function prettyPrice($quantity, $roundType, $decimalPlaces = null)
    {
        if ($decimalPlaces === 0)
            return self::integerRound($quantity);

        switch ($roundType){
            case self::FORMAT_INTEGER:
                $result = self::integerRound($quantity);
                break;
            case self::FORMAT_B:
                $result = self::floatRoundb($quantity);
                break;
            case self::FORMAT_A:
            default:
                $result = self::floatRoundA($quantity);
        }

        if ($decimalPlaces)
        {
            $multiplyBy = pow(10, $decimalPlaces);
            return floor($result * $multiplyBy ) / $multiplyBy;
        }

        return $result;
    }

    /*Attract input quantity to -1+#.095, #.45 or #.95*/
    /*Examples:
    floatRoundA(15.97)->15.95
    floatRoundA(15.51)->15.45
    floatRoundA(15.05)->14.95
    */
    static protected function floatRoundA($quantity)
    {
        $temp = ceil(-1+$quantity*100)/100;
        $decimalPart = abs(ceil(-1+$temp)-$temp);

        if ($decimalPart<0.4)
        {
            $temp = ceil(-1+$temp);
        }
        else if($decimalPart<0.6)
        {
            $temp = ceil(-1+$temp)+0.5;
        }
        else
        {
            $temp = ceil(-1+$temp)+1;
        }


        $temp = $temp -0.05;

        if($temp<0)
        {
            $temp = 0.5;
        }


        $temp = sprintf("%01.2f", $temp);
        return $temp;
    }



    /*Attract input quantity to -1+#.099, #.5 or #.99*/
    /*Examples:
    floatRoundB(15.97)->15.99
    floatRoundB(15.51)->15.5
    floatRoundB(15.05)->14.99
    */
    static protected function floatRoundB($quantity)
    {
        $temp = floor($quantity*100)/100;
        $decimalPart = abs(floor($temp)-$temp);

        if ($decimalPart<0.15)
        {
            $temp = floor($temp)-0.01;
        }
        else if($decimalPart<0.55)
        {
            $temp = floor($temp)+0.5;
        }
        else
        {
            $temp = floor($temp)+0.99;
        }


        $temp = sprintf("%01.2f", $temp);
        return $temp;
    }


    /*Attract INTEGER input quantity to ##0##, ##5##, #+1|0## based in the number of digits of quantity*/
    /*
    Examples
    integerRound(17)=17
    integerRound(172)=170 <-rounded to 0
    integerRound(176)=175 <-rounded to 5
    integerRound(178)=180 <-rounded to 0
    */
    static protected function integerRound($quantity)
    {
        $quantity = round($quantity);
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

        return ($freePart+$converted)*pow(10,$nFreeDigits-1);
    }
} 