<?php


namespace AppBundle\Controller\ClientAdmin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AbstractController extends Controller
{
    protected function getRows(Request $request)
    {
        $rows = $request->query->getInt('rows', 50);

        if ($rows > 50)
            throw new BadRequestHttpException('Max rows available are 50');

        return $rows;
    }
} 