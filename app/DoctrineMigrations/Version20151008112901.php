<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151008112901 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_has_provider_credentials (id INT AUTO_INCREMENT NOT NULL, provider_id INT NOT NULL, client_id INT NOT NULL, details LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5E12BE9BA53A8AA (provider_id), INDEX IDX_5E12BE9B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_has_provider_credentials ADD CONSTRAINT FK_5E12BE9BA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE client_has_provider_credentials ADD CONSTRAINT FK_5E12BE9B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('DROP TABLE app_has_provider_client_credentials');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_has_provider_client_credentials (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, provider_id INT NOT NULL, details LONGTEXT NOT NULL COLLATE utf8_unicode_ci COMMENT \'(DC2Type:json_array)\', updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F2ACFB09A53A8AA (provider_id), INDEX IDX_F2ACFB097987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_provider_client_credentials ADD CONSTRAINT FK_F2ACFB097987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_has_provider_client_credentials ADD CONSTRAINT FK_F2ACFB09A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('DROP TABLE client_has_provider_credentials');
    }
}
