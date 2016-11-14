<?php


namespace AppBundle\Helper;


class StatsHelper {

    static public function getColors()
    {
        $colors = ["#7cb5ec", '#EE9A49', "#90ee7e", "#888888", "#aaeeee", "#eeaaee",
            "#337324", "#DF5353", "#aaeeee", "#6467e9", "#b71be7", "#00FF4E", "#4f966e", "#fe3673", "#995929",
            "#d39adb", "#ff0066", "#9e786f", "#09436e", "#4d3c26", "#ee7f71", "#363b55", "#b32ae4", "#ed92dc",
            "#b78346", "#fc894f", "#f6c283", "#ea4a2c", "#f6f2cf", "#48572e", "#c99451", "#19d0fd", "#908772",
            "#e47a22", "#edf83d", "#4ad6bc", "#f77dd7",

            "#00ffff","#f0ffff","#f5f5dc","#000000","#0000ff","#a52a2a","#00ffff","#00008b","#008b8b","#a9a9a9","#006400","#bdb76b",
            "#8b008b","#556b2f","#ff8c00","#9932cc","#8b0000","#e9967a","#9400d3","#ff00ff","#ffd700","#008000","#4b0082",
            "#f0e68c","#add8e6","#e0ffff","#90ee90","#d3d3d3","#ffb6c1","#ffffe0","#00ff00","#ff00ff","#800000","#000080",
            "#808000","#ffa500","#ffc0cb","#800080","#800080","#ff0000","#c0c0c0","#ffffff","#ffff00"
        ];

        return array_merge(
            $colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,
            $colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors,$colors
        );
    }

    static public function fillAllStats(array $data, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat = 'months', $offsetHours=2, $emptyValue=0)
    {
        if ($dateFormat == 'weekdays')
        {

            return
                self::normalFormat(
                    self::weekDayAvgBetweenDates(
                        self::keyWeekDayIntegerChangeToString( self::fillAllStatsByInt($data, 0, 6) ),
                        $dateFrom,
                        $dateTo
                    )
                );

        }elseif ($dateFormat == 'hours')
        {
            return
                self::hoursFormatKey(
                    self::weekHoursAvgBetweenDates(
                        self::fillAllStatsByInt($data, 0, 23),
                        $dateFrom,
                        $dateTo
                    )
                );


        }else

            return
                self::normalFormat(
                    self::fillAllStatsByDateToAndDateFrom( $data, $dateFrom, $dateTo, $dateFormat , $offsetHours, $emptyValue)
                );
    }

    static private function fillAllStatsByInt(array $data, $fromInt, $toInt, $offsetHours= 0)
    {
        for ($i=$fromInt; $i <= $toInt ; $i++)
        {
            if (!isset($data[$i]))
                $data[ $i ]=0;
        }

        $result = [];

        foreach ($data as $i => $value)
        {
            $num = (int) $i +$offsetHours;
//            echo "$num WW $offsetHours -- ";

            if ($num > 23)
                $num -= 24;

//            echo "$num KK \n";

            $result[ $num ] = $value;
        }


        ksort($result);

        return $result;
    }

    static private function keyWeekDayIntegerChangeToString(array $data)
    {
        $result = [];
        foreach ($data as $key=> $row)
            $result[date('D', strtotime("Sunday +{$key} days"))] = $row;

        // change order
        $copy=$result['Sun'];
        array_splice($result,0, 1);
        $result['Sun']=$copy;

        return $result;
    }

    static private function weekHoursAvgBetweenDates(array $data, \DateTime $dateFrom, \DateTime $dateTo)
    {
        $result = [];

        foreach ($data as $key=> $row)
        {
            $count = self::countHoursByName($key, $dateFrom, $dateTo);
            $result[$key] = !$count ? 0 : $row / $count;
        }

        return $result;
    }

    static private function hoursFormatKey(array $data)
    {
        $result = [];

        foreach ($data as $key=> $row)
        {
            $result[] = [ sprintf("%02d", $key) => $row ] ;
        }

        return $result;
    }

    /**
     * Used to keep order js in client because object not save the order of his keys
     *
     * @param array $data
     * @return array
     */
    static public function normalFormat(array $data)
    {
        $result = [];

        foreach ($data as $key=> $row)
        {
            $result[] = [ $key => $row ] ;
        }

        return $result;
    }

    /**
     * @param $hour
     * @param \DateTime $start
     * @param \DateTime $end
     * @return int
     */
    static public function countHoursByName($hour, \DateTime $start, \DateTime $end)
    {
        $count = 0;
        $interval = new \DateInterval('PT1H');
        $period = new \DatePeriod($start, $interval, $end);

        foreach($period as $day){
            if($day->format('H') == $hour){
                $count ++;
            }
        }

        return $count;
    }

    static private function weekDayAvgBetweenDates(array $data, \DateTime $dateFrom, \DateTime $dateTo)
    {
        $result = [];

        foreach ($data as $key=> $row)
        {
            $count = self::countDaysByName($key, $dateFrom, $dateTo);
            $result[$key] = !$count ? 0 : $row / $count;
        }


        return $result;
    }

    static private function fillAllStatsByDateToAndDateFrom(array $data, \DateTime $dateFrom, \DateTime $dateTo, $dateFormat = 'months', $offsetHours=2, $emptyValue=0)
    {
        $dateF = clone $dateFrom;
        $dateT = clone $dateTo;

        $dateF->modify("+$offsetHours hours");
        $dateT->modify("+$offsetHours hours");

        $format = 'Y-m';

        if ($dateFormat == 'days')
            $format = 'Y-m-d';
        else if ($dateFormat == 'weeks' )
            $format = 'o, W';

        $increment = "+1 $dateFormat";

        while (true)
        {
            if (!isset($data[$dateF->format($format)]))
                $data[$dateF->format($format)]= $emptyValue;

            if($dateF->format($format) === $dateT->format($format) || $dateF->getTimestamp() >= $dateT->getTimestamp())
                break;

            $dateF->modify($increment);
        }

        ksort($data);

        return $data;
    }



    /**
     * @param String $dayName eg 'Mon', 'Tue' etc
     * @param \DateTime $start
     * @param \DateTime $end
     * @return int
     */
    static public function countDaysByName($dayName, \DateTime $start, \DateTime $end)
    {
        $count = 0;
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);

        foreach($period as $day){
            if($day->format('D') === ucfirst(substr($dayName, 0, 3))){
                $count ++;
            }
        }
        return $count;
    }

    static public function sumAllTogetherGroupedByFirstKey(array $array)
    {
        $result = [];

        foreach ($array as $key => $arr)
        {
            $result[$key] = self::sumSimpleRecursive($arr);
        }

        return $result;
    }

    static public function sumAllGroupSubArray(array $array)
    {
        $result = [];

        foreach ($array as $arr)
        {
            foreach ($arr as $key => $value)
            {
                if (isset($result[$key]))
                    $result[$key]+=$value;
                else
                    $result[$key]=$value;
            }
        }

        return $result;
    }

    static public function takeFirstItemAsKeyAndSecondItemAsValue(array $array)
    {
        $result = [];
        foreach ($array as $arra)
        {
            $arr = array_values($arra);
            $result[$arr[0]] = $arr[1];
        }

        return $result;
    }

    static public function sumAllGroupSubArrayByKey(array $array,$keyCompare)
    {
        $result = [];

        foreach ($array as $arr)
        {
            foreach ($arr[$keyCompare] as $key => $value)
            {
                if (is_array($value))
                {
                    foreach ($value as $keyIn => $valueIn)
                    {
                        if (isset($result[$keyIn]))
                            $result[$keyIn]+=$valueIn;
                        else
                            $result[$keyIn]=$valueIn;
                    }

                    continue;
                }

                if (isset($result[$key]))
                    $result[$key]+=$value;
                else
                    $result[$key]=$value;
            }
        }

        return $result;
    }

    static public function sumArrayKeyByKey(array $array, $key)
    {
        $result = 0 ;

        foreach ($array as $arr)
        {
            if (isset($arr[$key]))
                $result+=$arr[$key];
        }

        return $result;
    }

    static public function createArrayKeyFromArray(array $array, $fieldKey, $valueKey)
    {
        $result = [];

        foreach ($array as $data)
        {
            $value = $data[$valueKey];
            if ($valueKey == 'num')
                $value = (float) $value;

            $result[$data[$fieldKey]]=$value;
        }

        return $result;
    }

    static public function ifExistKeyPrefix(array $array, $prefix){

        $result = [];
        $values = array_keys($array);

        foreach ($values as $value)
        {
            if (strpos($value, $prefix) !== false)
                $result[]= $value;
        }

        return $result;
    }

    /**
     * @param array $array
     * @return int|number
     */
    static public function sumSimpleRecursive(array $array)
    {
        $sum = 0;
        foreach ($array as $arr)
        {
            $sum += array_sum($arr);
        }
        return $sum;
    }

} 