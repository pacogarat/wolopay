<?php


namespace AppBundle\Admin;

use AppBundle\Entity\App;
use Ibrows\SonataTranslationBundle\Admin\ORMTranslationAdmin;
use Lexik\Bundle\TranslationBundle\Entity\Translation;
use Lexik\Bundle\TranslationBundle\Model\TransUnit;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TranslationAdmin extends ORMTranslationAdmin
{
    use ContainerAwareTrait;

    protected function getDefaultDomain()
    {
        if (isset($_GET['pcode']) && isset($_SESSION['app_id']) && in_array($_GET['pcode'], ['nvia_shop_app.admin.article', 'nvia_shop_app.admin.item']) )
        {
            $appId=$_SESSION['app_id'];

            $om = $this->modelManager->getEntityManager('AppBundle\Entity\App');
            /** @var App $app */
            if ($app = $om->getRepository("AppBundle:App")->find($appId))
            {
                return $app->getTranslationDomain();
            }
        }

        return parent::getDefaultDomain();
    }

    /**
     * @param TransUnit $object
     * @return mixed|void
     */
    public function prePersist($object)
    {
        foreach (['en'] as $locale)
        {
            $translation = new Translation();
            $translation->setLocale($locale);
            $translation->setContent('TO BE DEFINED');
            $object->addTranslation($translation);
        }

    }

}