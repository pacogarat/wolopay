<?php


namespace AppBundle\Helper\Documentation;

class ParserOverride extends \Gregwar\RST\Parser
{
    function __construct($directives = [])
    {
        parent::__construct();
        foreach ($directives as $directive)
            $this->registerDirective($directive);
    }
} 