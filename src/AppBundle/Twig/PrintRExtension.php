<?php


namespace AppBundle\Twig;


class PrintRExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('print_r', array($this, 'printRFilter')),
        );
    }

    public function printRFilter($array)
    {
        return print_r($array, true);
    }

    public function getName()
    {
        return 'app_print_r';
    }
}