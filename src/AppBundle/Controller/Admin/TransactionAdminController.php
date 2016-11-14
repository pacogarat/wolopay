<?php


namespace AppBundle\Controller\Admin;


use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransactionAdminController extends CRUDController
{
    public function logAction($id)
    {
        $em=$this->getDoctrine()->getManager();

        if (!$transaction = $em->getRepository("AppBundle:Transaction")->find($id))
            throw new NotFoundHttpException(sprintf('unable to find the object with id : %s', $id));

        $file = $this->container->getParameter('kernel.logs_dir').'/'. $transaction->getLogFilePath();


        $lines = [];

        if (file_exists($file))
        {
            $lines = file($file);

            foreach ($lines as $key=>$line)
            {

                $lines[$key] = substr($line, 0, 21);
                $line=substr($line, 21);

                if (preg_match("/^.*?\.DEBUG/",$line))
                    $lines[$key].= "<span class='debug' style='color: green'>$line</span>";

                else if (preg_match("/^.*?\.INFO/",$line))
                    $lines[$key].= "<span class='info' style='color: blue'>$line</span>";

                else if (preg_match("/^.*?\.ERROR/",$line))
                    $lines[$key].= "<span class='error' style='color: red'>$line</span>";

                else if (preg_match("/^.*?\.(CRITICAL|ALERT|EMERGENCY)/",$line))
                    $lines[$key].= "<span class='critical' style='color: red;font-weight: bold'>$line</span>";
                else
                    $lines[$key].= "<span class='unknown'>$line</span>";
            }

        }

        return $this->render('@App/Sonata/Transaction/transaction_log.html.twig', array(
                'action'   => 'log',
                'object'   => $transaction,
                'lines'   => $lines,
            ));
    }


} 