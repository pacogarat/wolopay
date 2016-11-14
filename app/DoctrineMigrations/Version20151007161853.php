<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151007161853 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_has_provider_client_credentials (id INT AUTO_INCREMENT NOT NULL, provider_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, details LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F2ACFB09A53A8AA (provider_id), INDEX IDX_F2ACFB097987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_provider_client_credentials ADD CONSTRAINT FK_F2ACFB09A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE app_has_provider_client_credentials ADD CONSTRAINT FK_F2ACFB097987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE purchase ADD reason VARCHAR(255) DEFAULT NULL, CHANGE payment_id payment_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_detail ADD used_app_provider_credentials TINYINT(1) NOT NULL, ADD use_provider_client_credentials TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX subscription_transaction_external_id_UNIQUE ON subscription (transaction_external_id)');
        $this->addSql('ALTER TABLE client_user_notification CHANGE type type VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE provider ADD has_client_credentials TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
    }
}
