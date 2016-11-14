<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150522125655 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase CHANGE tax_percent tax_percent DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE country CHANGE vat_category_id vat_category_id VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE price_sent_net price_sent_net TINYINT(1) DEFAULT NULL, CHANGE fee_calculated_with_net fee_calculated_with_net TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country CHANGE vat_category_id vat_category_id VARCHAR(20) DEFAULT \'none\' NOT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE price_sent_net price_sent_net TINYINT(1) NOT NULL, CHANGE fee_calculated_with_net fee_calculated_with_net TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE purchase CHANGE tax_percent tax_percent DOUBLE PRECISION NOT NULL');
    }
}
