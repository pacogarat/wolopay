<?php

namespace Application\Migrations;

use AppBundle\Command\BusinessIntelligentSyncCommand;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\ProviderEnum;
use AppBundle\Entity\Purchase;
use AppBundle\Payment\Actions\PurchaseExtraCost;
use AppBundle\Payment\Bean\PurchaseExtraCostBean;
use AppBundle\Payment\Event\PaymentCancelledEvent;
use AppBundle\Service\PurchaseManager;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151118094301 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase ADD extra_cost_from_parent_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BD3E8CD62 FOREIGN KEY (extra_cost_from_parent_id) REFERENCES purchase (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BD3E8CD62 ON purchase (extra_cost_from_parent_id)');
    }

    public function postUp(Schema $schema)
    {
        // Only execute one time
        return;

        /** @var PurchaseManager $purchaseManager */
        $purchaseManager = $this->container->get('app.purchase_manager');

        /** @var PurchaseExtraCost $purchaseExtraCost */
        $purchaseExtraCost = $this->container->get('shop.payment.purchase_extra_cost');
        /** @var BusinessIntelligentSyncCommand $business */
        $business = $this->container->get('shop_app.business_intelligent');

        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $iterableResult = $em->createQuery('SELECT p FROM AppBundle:Purchase p WHERE p.wasCanceled = 1')->iterate();

        $batchSize = 20;
        $i = 0;



        foreach ($iterableResult as $row)
        {
            /** @var Purchase $purchase */
            $purchase = $row[0];

            $newPurchase = $purchaseManager->savePurchaseWithNegativeValues($purchase);
            $newPurchase->setCreatedAt($purchase->getCreatedAt());
            $em->flush();
            $business->onShopPaymentCancelled(new PaymentCancelledEvent($purchase->getPayment(), null, true, 'Refund', false, $newPurchase));
            $this->write("Purchase ".$purchase->getId()." with negative values successful");
            if ($purchase->getProvider()->getName() === ProviderEnum::ADYEN_NAME)
            {
                $purchaseExtraCost->purchaseExtraCost(new PurchaseExtraCostBean(CurrencyEnum::EURO, -7.5, -7.5, -7.5), $purchase, 'Charge back, commision by Adyen');
                $this->write("Added extra cost by Adyen");
            }

            if (($i % $batchSize) === 0) {
                $em->flush(); // Executes all updates.
                $em->clear(); // Detaches all objects from Doctrine!
            }
            ++$i;
        }

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BD3E8CD62');
        $this->addSql('DROP INDEX IDX_6117D13BD3E8CD62 ON purchase');
        $this->addSql('ALTER TABLE purchase DROP extra_cost_from_parent_id');
    }
}
