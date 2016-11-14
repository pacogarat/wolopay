<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150305163620 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD country_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F92F3E70 ON transaction (country_id)');

        $this->addSql('CREATE TABLE transaction_temp (id INT AUTO_INCREMENT NOT NULL, custom_currency_id VARCHAR(3) NOT NULL, custom_pay_method_id INT DEFAULT NULL, country_id VARCHAR(2) DEFAULT NULL, gamer_id VARCHAR(255) NOT NULL, custom_amount DOUBLE PRECISION NOT NULL, custom_article_title VARCHAR(255) DEFAULT NULL, custom_article_description LONGTEXT DEFAULT NULL, custom_param VARCHAR(125) DEFAULT NULL, test TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_E910BB6BE1834BC (custom_currency_id), INDEX IDX_E910BB6BBE98C8E0 (custom_pay_method_id), INDEX IDX_E910BB6BF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6BE1834BC FOREIGN KEY (custom_currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6BBE98C8E0 FOREIGN KEY (custom_pay_method_id) REFERENCES pay_method (id)');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');

        $this->addSql('ALTER TABLE transaction_temp ADD app_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6B7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('CREATE INDEX IDX_E910BB6B7987212D ON transaction_temp (app_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE transaction_temp');

        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D1F92F3E70');
        $this->addSql('DROP INDEX IDX_723705D1F92F3E70 ON `transaction`');
        $this->addSql('ALTER TABLE `transaction` DROP country_id');

        $this->addSql('ALTER TABLE transaction_temp DROP FOREIGN KEY FK_E910BB6B7987212D');
        $this->addSql('DROP INDEX IDX_E910BB6B7987212D ON transaction_temp');
        $this->addSql('ALTER TABLE transaction_temp DROP app_id');

        $this->addSql('ALTER TABLE transaction_temp DROP FOREIGN KEY FK_E910BB6B7987212D');
        $this->addSql('DROP INDEX IDX_E910BB6B7987212D ON transaction_temp');
        $this->addSql('ALTER TABLE transaction_temp DROP app_id');
    }
}
