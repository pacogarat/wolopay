<?php

namespace AppBundle\Controller\Others;

use Lexik\Bundle\TranslationBundle\Entity\TransUnit;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/translations")
 */
class TranslationsAngularController extends Controller
{
    /**
     * @Route("/g/{domainName}/{language}.json", name="translations_domain_language")
     */
    public function translationByDomainAndLanguageAction($domainName, $language)
    {
        $js_arr=array();
        $arr = explode(",",$domainName);
        foreach ($arr as $value){
            $js_arr=array_merge($js_arr, $this->getTranslationsFromDomainAndLanguage($value, $language));
        }

        return new JsonResponse($js_arr);
    }

    /**
     * @Route("/shop/{domainName}/{language}.json", name="translations_shop_common", options={"expose"=true})
     */
    public function shopCommonAction($domainName, $language)
    {
//        $locales = $this->container->getParameter('locale_available');
        $translations = $this->getTranslationsFromDomainAndLanguage('shop', $language);
        $result = array_merge($translations, $this->getTranslationsFromDomainAndLanguage($domainName, $language));

        return new JsonResponse($result);
    }

    private function getTranslationsFromDomainAndLanguage($domain, $language)
    {
        /** @var TransUnit[] $translations */
        $translations = $this->getDoctrine()->getRepository('LexikTranslationBundle:TransUnit')->getAllByLocaleAndDomain($language, $domain);

        $result = array();
        foreach ($translations as $translation)
        {
            $result[$translation['key']] = $translation['translations'][0]['content'];
        }

        return  $result;
    }

    private function createResponse($js)
    {
        return new Response($js, 200, array('Content-Type' => 'text/javascript'));
    }

    private function javascriptVar($language, $translations)
    {
        return 'var translations'.strtoupper($language).' = '. json_encode($translations) . ";\n" ;
    }
}
