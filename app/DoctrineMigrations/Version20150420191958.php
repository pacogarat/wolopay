<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150420191958 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription ADD need_make_request_payment TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD need_make_request_payment TINYINT(1) DEFAULT NULL');

        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::ADYEN_IPN."','Adyen single',NOW())");
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::ADYEN_SUBSCRIPTION_IPN."','Adyen subscription',NOW())");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider DROP need_make_request_payment');
        $this->addSql('ALTER TABLE subscription DROP need_make_request_payment');
    }
}
