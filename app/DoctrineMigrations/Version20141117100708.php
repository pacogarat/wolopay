<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141117100708 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE purchase ADD provider_tax_amount DOUBLE PRECISION NOT NULL, ADD provider_tax_amount_minimal DOUBLE PRECISION NOT NULL, DROP amount_tax_amount, DROP amount_tax_amount_minimal');
        $this->addSql('ALTER TABLE pay_method_provider_has_country CHANGE `default` `default` TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_provider_has_country CHANGE `default` `default` TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE purchase ADD amount_tax_amount DOUBLE PRECISION NOT NULL, ADD amount_tax_amount_minimal DOUBLE PRECISION NOT NULL, DROP provider_tax_amount, DROP provider_tax_amount_minimal');
    }
}
