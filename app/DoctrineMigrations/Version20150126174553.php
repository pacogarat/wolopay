<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150126174553 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country ADD apply_vat TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase CHANGE vat vat DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE provider ADD free_vat TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP apply_vat');
        $this->addSql('ALTER TABLE purchase CHANGE vat vat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE provider DROP free_vat');
    }
}
