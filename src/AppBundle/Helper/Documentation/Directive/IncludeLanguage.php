<?php


namespace AppBundle\Helper\Documentation\Directive;


use Gregwar\RST\Directive;
use Gregwar\RST\LaTeX\Nodes\ParagraphNode;
use Gregwar\RST\Parser;

class IncludeLanguage extends Directive
{
    /** @var  string */
    private $sourceFolder;

    /** @var array */
    protected $languagesAvailable;

    function __construct($sourceFolder, $languagesAvailable=['php'])
    {
        $this->sourceFolder = $sourceFolder;
        $this->languagesAvailable = $languagesAvailable;
    }

    /**
     * Get the directive name
     */
    public function getName()
    {
        return 'includeLanguage';
    }

    public function processNode(Parser $parser, $variable, $data, array $options)
    {
        if (isset($options['language']))
            return new ParagraphNode($this->getHighLightSyntax($data, $options['language']));

        return new ParagraphNode($this->getAllLanguages($data));
    }

    private function getAllLanguages($data)
    {
        $stringCode = '';
        $tabs = '';
        $first = true;

        foreach ($this->languagesAvailable as $language)
        {
            $id = $data.$language;
            $tabs .= '<button type="button" onclick="selectLanguage(\''.$id.'\')" class="btn-success btn btn-default '.($first ? 'active': '').'">'. $language . '</button>';
            $stringCode .= "<div id='$id' class='$data' style='".($first ? '': 'display:none')."'>".$this->getHighLightSyntax($data, $language).'</div>';
            $first = false;
        }

        $tabs = "<div class='btn-group lang-btn-group' role='group'>$tabs</div>";

        return $tabs.$stringCode;
    }

    private function getHighLightSyntax($filePath, $language)
    {
        $source = file_get_contents($this->sourceFolder.$filePath.".$language" );

        switch ($language)
        {
//            case 'php':
//                $stringCode = highlight_string($source, true);
//                break;
            default:
                $geshi = new \GeSHi($source, $language);
                $stringCode = $geshi->parse_code();

        }
        return $stringCode;
    }
}