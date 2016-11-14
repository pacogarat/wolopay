<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150828080505 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase CHANGE amount_tax_paid_by_provider amount_tax_paid_by_provider DOUBLE PRECISION DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app CHANGE notification_retries_on_failure notification_retries_on_failure INT DEFAULT 25 NOT NULL');
        $this->addSql('ALTER TABLE article CHANGE show_when_stock_under_n show_when_stock_under_n INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE purchase CHANGE amount_tax_paid_by_provider amount_tax_paid_by_provider DOUBLE PRECISION NOT NULL');
    }
}
