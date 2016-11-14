<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150204165003 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sms_code ADD external_transaction_id VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE fee_provider_percent fee_provider_percent DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country CHANGE fee_provider_percent fee_provider_percent DOUBLE PRECISION DEFAULT NULL');
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::FORTUNO_IPN."', 'Fortuno', now())");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE fee_provider_percent fee_provider_percent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country CHANGE fee_provider_percent fee_provider_percent INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sms_code DROP external_transaction_id');
    }
}
