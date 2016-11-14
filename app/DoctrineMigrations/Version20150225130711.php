<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150225130711 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE single_custom_payment (id VARCHAR(255) NOT NULL, article_title VARCHAR(255) DEFAULT NULL, article_description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE single_custom_payment ADD CONSTRAINT FK_F845B2BCBF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD can_be_custom_transaction TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD custom_currency_id VARCHAR(3) DEFAULT NULL, ADD custom_pay_method_id INT DEFAULT NULL, ADD custom_amount DOUBLE PRECISION DEFAULT NULL, ADD custom_article_title VARCHAR(255) DEFAULT NULL, ADD custom_article_description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1E1834BC FOREIGN KEY (custom_currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1BE98C8E0 FOREIGN KEY (custom_pay_method_id) REFERENCES pay_method (id)');
        $this->addSql('CREATE INDEX IDX_723705D1E1834BC ON transaction (custom_currency_id)');
        $this->addSql('CREATE INDEX IDX_723705D1BE98C8E0 ON transaction (custom_pay_method_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE single_custom_payment');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP can_be_custom_transaction');
        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D1E1834BC');
        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D1BE98C8E0');
        $this->addSql('DROP INDEX IDX_723705D1E1834BC ON `transaction`');
        $this->addSql('DROP INDEX IDX_723705D1BE98C8E0 ON `transaction`');
        $this->addSql('ALTER TABLE `transaction` DROP custom_currency_id, DROP custom_pay_method_id, DROP custom_amount, DROP custom_article_title, DROP custom_article_description');
    }
}
