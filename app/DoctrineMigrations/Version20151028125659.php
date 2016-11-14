<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151028125659 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_user CHANGE country_id country_id VARCHAR(2) NOT NULL');

        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3F92F3E70');
        $this->addSql('DROP INDEX IDX_A3C664D3F92F3E70 ON subscription');
        $this->addSql('ALTER TABLE subscription DROP country_id');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription ADD country_id VARCHAR(2) NOT NULL DEFAULT "ES"');
        $this->addSql('UPDATE subscription, payment_detail, `transaction`  SET subscription.country_id= IF(transaction.country_detected_id IS NULL, "ES", transaction.country_detected_id) WHERE payment_detail.id=subscription.payment_detail_id AND payment_detail.transaction_id=transaction.id');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_A3C664D3F92F3E70 ON subscription (country_id)');
    }
}
