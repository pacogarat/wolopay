<?php


namespace AppBundle\Form\DataTransformer;


use AppBundle\Entity\App;
use AppBundle\Entity\AppTab;
use AppBundle\Helper\UtilHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;


class AppTabTransformer extends IdToStringGenericTransformer
{
    /** @var  App */
    protected $app;

    public function __construct(App $app, EntityManagerInterface $om, $repository = null, $property=null)
    {
        parent::__construct($om, $repository, $property);
        $this->app = $app;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param AppTab $appTab
     * @return string
     */
    public function transform($appTab)
    {
        if (!$appTab) {
            return '';
        }

        return $appTab->getNameUnique();
    }

    /**
     * Transforms a string (number) to an object (issue).
     *
     * @param  string $string
     *
     * @return null
     *
     * @throws TransformationFailedException if object (issue) is not found.
     */
    public function reverseTransform($string)
    {
        if (!$string)
            return null;

       if (!$result = $this->om->getRepository("AppBundle:AppTab")->findOneByAppIdAndNameUnique($this->app->getId(), $string))
       {
           throw new TransformationFailedException(sprintf(
               'An issue with "%s" does not exist',
               $string
           ));
       }

        return $result;
    }
} 