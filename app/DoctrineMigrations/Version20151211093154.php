<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151211093154 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_provider_credential_has_apps (clienthasprovidercredential_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, INDEX IDX_6340160F2276EBC (clienthasprovidercredential_id), INDEX IDX_6340160F7987212D (app_id), PRIMARY KEY(clienthasprovidercredential_id, app_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_provider_credential_has_apps ADD CONSTRAINT FK_6340160F2276EBC FOREIGN KEY (clienthasprovidercredential_id) REFERENCES client_has_provider_credentials (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_provider_credential_has_apps ADD CONSTRAINT FK_6340160F7987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client CHANGE wolo_pack wolo_pack VARCHAR(50) NOT NULL, CHANGE currency_earnings currency_earnings VARCHAR(3) NOT NULL, CHANGE logo logo INT NOT NULL, CHANGE slug slug VARCHAR(5) NOT NULL, CHANGE finance_email finance_email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE gamer ADD steam_id VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE client_deposit CHANGE amount_balance amount_balance DOUBLE PRECISION NOT NULL, CHANGE amount_balance_requirement amount_balance_requirement DOUBLE PRECISION NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client_provider_credential_has_apps');
        $this->addSql('ALTER TABLE client CHANGE currency_earnings currency_earnings VARCHAR(3) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE logo logo INT DEFAULT NULL, CHANGE wolo_pack wolo_pack VARCHAR(50) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE slug slug VARCHAR(5) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE finance_email finance_email VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE client_deposit CHANGE amount_balance amount_balance DOUBLE PRECISION DEFAULT \'500\' NOT NULL, CHANGE amount_balance_requirement amount_balance_requirement DOUBLE PRECISION DEFAULT \'500\' NOT NULL');
        $this->addSql('ALTER TABLE gamer DROP steam_id');
    }
}
