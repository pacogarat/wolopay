<?php


namespace AppBundle\Service\OverrideThirdBundles;


use Lexik\Bundle\TranslationBundle\Util\DataGrid\DataGridRequestHandler;
use Symfony\Component\HttpFoundation\Request;

class LexikDataGridRequestHandler extends DataGridRequestHandler
{
    /**
     * Returns an array with the trans unit for the current page and the total of trans units
     *
     * @param Request $request
     * @return array
     */
    public function getPage(Request $request)
    {
        $request->query->set('rows', 100);

        if (!$request->get('_only_show_empty_values'))
            return parent::getPage($request);

        $this->storage->get();
    }



} 