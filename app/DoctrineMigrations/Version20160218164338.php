<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160218164338 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider ADD external_store VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD external_store VARCHAR(255) DEFAULT NULL, ADD force_generic_pmpc VARCHAR(255) DEFAULT NULL, ADD has_pay_methods_section TINYINT(1) NOT NULL');
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::FACEBOOK_IPN."','Facebook', NOW())");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider DROP external_store');
        $this->addSql('ALTER TABLE `transaction` DROP external_store, DROP force_generic_pmpc, DROP has_pay_methods_section');
    }
}
