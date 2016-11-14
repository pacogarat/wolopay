<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151216114641 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_document (id INT AUTO_INCREMENT NOT NULL, document INT DEFAULT NULL, client_id INT NOT NULL, fin_invoice_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_F68FBAB3D8698A76 (document), INDEX IDX_F68FBAB319EB6921 (client_id), INDEX IDX_F68FBAB3CCE46291 (fin_invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_document ADD CONSTRAINT FK_F68FBAB3D8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE client_document ADD CONSTRAINT FK_F68FBAB319EB6921 FOREIGN KEY (client_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE client_document ADD CONSTRAINT FK_F68FBAB3CCE46291 FOREIGN KEY (fin_invoice_id) REFERENCES fin_invoice (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client_document');
        $this->addSql('DROP INDEX UNIQ_C7440455989D9B62 ON client');
    }
}
