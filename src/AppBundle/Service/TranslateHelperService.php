<?php


namespace AppBundle\Service;

use AppBundle\Entity\App;
use AppBundle\Entity\Article;
use AppBundle\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\Service;
use Lexik\Bundle\TranslationBundle\Manager\TransUnitManager;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * @Service("app.translate_helper")
 */
class TranslateHelperService
{
    /**
     * @var EntityManagerInterface
     * @Inject("doctrine.orm.default_entity_manager")
     */
    public $em;

    /**
     * @var Logger
     * @Inject("logger")
     */
    public $logger;

    /**
     * @var TransUnitManager
     * @Inject("lexik_translation.trans_unit.manager")
     */
    public $transLexik;

    public function setLabelArticleFromRequest(Request $request, Article $article, $prefix= 'name_label_', $property='name_label', $key = 'article.title.', $deleteIfEmpty = true)
    {
        $this->setLabelsFromObj($request, $article->getApp(), $article, $prefix, $property, $key, $deleteIfEmpty);
    }

    public function setLabelItemFromRequest(Request $request, Item $item, $prefix= 'name_label_', $property='name_label', $key = 'item.title.')
    {
        $this->setLabelsFromObj($request, $item->getApp(), $item, $prefix, $property, $key, false, '');
    }

    private function setLabelsFromObj(Request $request, App $app, $obj, $prefix= 'name_label_', $property='name_label', $key = 'article.title', $deleteIfEmpty = true, $defaultText = null)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        if ($request->get($prefix.'en', $defaultText) !== null)
        {
            foreach ($app->getLanguages() as $language)
            {
                $transKey = $prefix.$language->getId();

                /** @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit */
                $trans = $accessor->getValue($obj, $property);

                if ($request->request->get($prefix.$language->getId(), $defaultText) !== null)
                {
                    if (!$trans)
                    {
                        $trans = $this->transLexik->create($key . uniqid(),  $app->getTranslationDomain());
                        $accessor->setValue($obj, $property, $trans);
                    }

                    if ($trans->hasTranslation($language->getId()))
                    {

                        $this->transLexik->updateTranslation($trans, $language->getId(), $request->request->get($transKey, $defaultText));
                    }else{

                        $this->transLexik->addTranslation($trans, $language->getId(), $request->request->get($transKey, $defaultText));
                    }

                }else{

                    if ($trans)
                        $this->transLexik->deleteTranslation($trans, $language->getId());
                }
            }
        }else{

            if ($deleteIfEmpty)
            {
                /** @var \Lexik\Bundle\TranslationBundle\Entity\TransUnit */
                $trans = $accessor->getValue($obj, $property);

                if ($trans)
                {
                    $this->em->remove( $trans );
                    $accessor->setValue($obj, $property, null);
                }
            }
        }
    }
} 