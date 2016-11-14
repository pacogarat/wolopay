<?php

if (!function_exists('unless'))
{
    function unless (&$var, $default=null)
    {
        return isset($var) ? $var : $default;
    };
}