<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160330172039 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DELETE FROM fin_invoice');
        $this->addSql('UPDATE client_deposit set used_until_at = null');
        $this->addSql('ALTER TABLE fin_invoice ADD external_company_not_wolopay INT NOT NULL, ADD extra_concepts LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14BB993D3A9 FOREIGN KEY (external_company_not_wolopay) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_EBBAB14BB993D3A9 ON fin_invoice (external_company_not_wolopay)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL COLLATE utf8_unicode_ci, object_class VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, field VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci, foreign_key VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci, content LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), INDEX translations_lookup_idx (locale, object_class, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fin_invoice DROP FOREIGN KEY FK_EBBAB14BB993D3A9');
        $this->addSql('DROP INDEX IDX_EBBAB14BB993D3A9 ON fin_invoice');
        $this->addSql('ALTER TABLE fin_invoice DROP external_company_not_wolopay, DROP extra_concepts');
    }
}
