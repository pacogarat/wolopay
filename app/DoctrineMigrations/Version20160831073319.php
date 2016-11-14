<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160831073319 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_document (id INT AUTO_INCREMENT NOT NULL, document INT DEFAULT NULL, app_id VARCHAR(255) NOT NULL, monthly_app_report_id INT DEFAULT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D0E9EADBD8698A76 (document), INDEX IDX_D0E9EADB7987212D (app_id), INDEX IDX_D0E9EADB2B82529 (monthly_app_report_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monthly_app_report (id INT AUTO_INCREMENT NOT NULL, currency_id VARCHAR(3) NOT NULL, document INT DEFAULT NULL, report_number VARCHAR(50) NOT NULL, year INT NOT NULL, month INT NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, amount_total NUMERIC(10, 2) NOT NULL, amount_taxes NUMERIC(10, 2) NOT NULL, amount_provider NUMERIC(10, 2) NOT NULL, amount_wolo NUMERIC(10, 2) NOT NULL, amount_app NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E8317A8138248176 (currency_id), INDEX IDX_E8317A81D8698A76 (document), UNIQUE INDEX MONTH_REPORT_UNIQUE_ (report_number, year, month), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADBD8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADB7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADB2B82529 FOREIGN KEY (monthly_app_report_id) REFERENCES monthly_app_report (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE monthly_app_report ADD CONSTRAINT FK_E8317A8138248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE monthly_app_report ADD CONSTRAINT FK_E8317A81D8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE app ADD document INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app ADD CONSTRAINT FK_C96E70CFD8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_C96E70CFD8698A76 ON app (document)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_document DROP FOREIGN KEY FK_D0E9EADB2B82529');
        $this->addSql('DROP TABLE app_document');
        $this->addSql('DROP TABLE monthly_app_report');
        $this->addSql('ALTER TABLE app DROP FOREIGN KEY FK_C96E70CFD8698A76');
        $this->addSql('DROP INDEX IDX_C96E70CFD8698A76 ON app');
        $this->addSql('ALTER TABLE app DROP document');
    }
}
