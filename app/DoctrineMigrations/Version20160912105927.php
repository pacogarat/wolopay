<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160912105927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_document DROP FOREIGN KEY FK_D0E9EADB2B82529');
        $this->addSql('DROP TABLE app_document');
        $this->addSql('DROP TABLE monthly_app_report');
        $this->addSql('ALTER TABLE client_api_credential ADD CONSTRAINT FK_E31623D519EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE app CHANGE comission_currency_id comission_currency_id VARCHAR(3) DEFAULT NULL, CHANGE commission_min commission_min DOUBLE PRECISION DEFAULT NULL, CHANGE commission_max commission_max DOUBLE PRECISION DEFAULT NULL, CHANGE commission_fixed_fee commission_fixed_fee DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE article CHANGE external_article_id external_article_id VARCHAR(256) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_document (id INT AUTO_INCREMENT NOT NULL, monthly_app_report_id INT DEFAULT NULL, app_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, document INT DEFAULT NULL, title VARCHAR(150) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_D0E9EADBD8698A76 (document), INDEX IDX_D0E9EADB7987212D (app_id), INDEX IDX_D0E9EADB2B82529 (monthly_app_report_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE monthly_app_report (id INT AUTO_INCREMENT NOT NULL, document INT DEFAULT NULL, currency_id VARCHAR(3) NOT NULL COLLATE utf8_unicode_ci, report_number VARCHAR(50) NOT NULL COLLATE utf8_unicode_ci, year INT NOT NULL, month INT NOT NULL, title VARCHAR(150) NOT NULL COLLATE utf8_unicode_ci, description LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, amount_total NUMERIC(10, 2) NOT NULL, amount_taxes NUMERIC(10, 2) NOT NULL, amount_provider NUMERIC(10, 2) NOT NULL, amount_wolo NUMERIC(10, 2) NOT NULL, amount_app NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX MONTH_REPORT_UNIQUE_ (report_number, year, month), INDEX IDX_E8317A8138248176 (currency_id), INDEX IDX_E8317A81D8698A76 (document), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADB2B82529 FOREIGN KEY (monthly_app_report_id) REFERENCES monthly_app_report (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADB7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_document ADD CONSTRAINT FK_D0E9EADBD8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE monthly_app_report ADD CONSTRAINT FK_E8317A81D8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE monthly_app_report ADD CONSTRAINT FK_E8317A8138248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE app CHANGE comission_currency_id comission_currency_id VARCHAR(3) DEFAULT \'EUR\' COLLATE utf8_unicode_ci, CHANGE commission_min commission_min DOUBLE PRECISION DEFAULT \'0.1\', CHANGE commission_max commission_max DOUBLE PRECISION DEFAULT \'0.1\', CHANGE commission_fixed_fee commission_fixed_fee DOUBLE PRECISION DEFAULT \'0.1\'');
        $this->addSql('ALTER TABLE article CHANGE external_article_id external_article_id VARCHAR(45) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE client_api_credential DROP FOREIGN KEY FK_E31623D519EB6921');
    }
}
