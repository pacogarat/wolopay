<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150903103424 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_user ADD language_id VARCHAR(2) NOT NULL DEFAULT "en" ');
        $this->addSql('ALTER TABLE client_user ADD CONSTRAINT FK_5C0F152B82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE client_user_notification ADD type VARCHAR(10) NOT NULL DEFAULT "info" ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_user DROP FOREIGN KEY FK_5C0F152B82F1BAF4');
        $this->addSql('ALTER TABLE client_user DROP language_id');
        $this->addSql('ALTER TABLE client_user_notification DROP type');
    }
}
