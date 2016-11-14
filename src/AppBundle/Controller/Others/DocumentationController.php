<?php

namespace AppBundle\Controller\Others;


use AppBundle\Helper\Documentation\Directive\IncludeLanguage;
use AppBundle\Helper\Documentation\ParserOverride;
use Doctrine\ORM\EntityManager;
use Gregwar\RST\Document;
use JMS\DiExtraBundle\Annotation\Inject;
use Monolog\Logger;
use Nelmio\ApiDocBundle\Controller\ApiDocController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/doc")
 */
class DocumentationController extends ApiDocController
{
    /**
     * @Inject("doctrine.orm.default_entity_manager")
     * @var EntityManager
     */
    public $em;

    /**
     * @Inject("logger")
     * @var Logger
     */
    public $logger;

    /** @Inject("%kernel.root_dir%")   */
    public $rootDir;

    /**
     * @Inject("templating")
     * @var TwigEngine
     */
    public $templating;

    /**
     * @Route("/index", name="documentation_index", options={"url_call_to_cache_after_deploy"="always"} )
     * @Cache(expires="+2 days", public=true)
     */
    public function indexDocumentationAction(Request $request)
    {
        return $this->render('@App/Documentation/generic.html.twig', [
                'main_content' => $this->getRSTConverter('index.rst'),
                'injectTocJquerySelector' => '#step-by-step',
            ]);
    }

    /**
     * @Route("/inshort", name="documentation_inshort", options={"url_call_to_cache_after_deploy"="always"} )
     * @Cache(expires="+2 days", public=true)
     */
    public function inshortAction(Request $request)
    {
        return $this->render('@App/Documentation/generic.html.twig', [
            'main_content' => $this->getRSTConverter('inshort.rst'),
            'injectTocJquerySelector' => '#in-short',
        ]);
    }


    private function getRSTConverter($search)
    {
        $sourceFolder = $this->rootDir.'/../doc/public';

        $finder = new Finder();
        $finder->files()->in($sourceFolder);
        $finder->files()->name($search);

        $extraDirectives = [
            new IncludeLanguage($sourceFolder)
        ];

        $parser = new ParserOverride($extraDirectives);

        $html = '';

        /** @var SplFileInfo $file */
        foreach ($finder as $file)
        {
            /** @var Document $document */
            $document = $parser->parse($file->getContents());
            $html .= (string) $document;
        }

        return $html;
    }

    /**
     * @Route("/api/{view}", defaults={"view"= "default"}, name="api_doc", options={"url_call_to_cache_after_deploy"="always"} )
     * @Cache(expires="+2 days", public=true)
     */
    public function apiAction($view)
    {
        return parent::indexAction($view);
    }

}
