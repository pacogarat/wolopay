<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150519114558 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD country_detected_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1CAEC104B FOREIGN KEY (country_detected_id) REFERENCES country (id)');
        $this->addSql("UPDATE `transaction` SET country_detected_id = 'ES' WHERE country_detected_id IS NULL;");
        $this->addSql('CREATE INDEX IDX_723705D1CAEC104B ON transaction (country_detected_id)');
        $this->addSql("UPDATE `currency` SET `exchange_rate_eur`='0.00004', `exchange_rate_usd`='0.00005', `exchange_rate_gbp`='0.00003' WHERE `id`='VND';");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1CAEC104B');
        $this->addSql('DROP INDEX IDX_723705D1CAEC104B ON transaction');
        $this->addSql('ALTER TABLE transaction DROP country_detected_id');
    }
}
