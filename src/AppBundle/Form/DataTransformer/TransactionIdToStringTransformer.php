<?php


namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Transaction;
use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;
use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @Service("shop.form.data_transformer.transaction_id")
 * @Tag("form.type", attributes={"alias" = "transaction_text"})
 */
class TransactionIdToStringTransformer implements DataTransformerInterface
{
    /** @var  EntityManager */
    protected $em;

    /**
     * @InjectParams({
     *      "entityManager" = @Inject("doctrine.orm.default_entity_manager")
     * })
     */
    function __construct($entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * Transforms an object (issue) to a string (number).
     *
     * @param  Transaction $obj
     * @return string
     */
    public function transform($obj)
    {
        if (null === $obj  ) {
            return "";
        }

        return $obj->getId();
    }

    /**
     * @param  string $id
     *
     * @return Transaction
     */
    public function reverseTransform($id)
    {
        return $this->em->getRepository("AppBundle:Transaction")->find($id);
    }
} 