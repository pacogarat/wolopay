<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160425114311 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE payment_detail_extra_cost (payment_detail_id VARCHAR(255) NOT NULL, name VARCHAR(45) NOT NULL, currency_id VARCHAR(3) NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, INDEX IDX_1BD7A1C59BF92C93 (payment_detail_id), INDEX IDX_1BD7A1C538248176 (currency_id), PRIMARY KEY(payment_detail_id, name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_detail_extra_cost ADD CONSTRAINT FK_1BD7A1C59BF92C93 FOREIGN KEY (payment_detail_id) REFERENCES payment_detail (id)');
        $this->addSql('ALTER TABLE payment_detail_extra_cost ADD CONSTRAINT FK_1BD7A1C538248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE payment_detail ADD country_configured_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE40565A751F6 FOREIGN KEY (country_configured_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_B3EE40565A751F6 ON payment_detail (country_configured_id)');
        $this->addSql('ALTER TABLE app ADD pay_methods_add_fee_to_final_amount TINYINT(1) DEFAULT NULL, ADD tax_to_final_amount TINYINT(1) DEFAULT NULL, ADD wolopay_fee_to_final_amount TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD country_configured_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('UPDATE purchase SET country_configured_id = country_id ');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B65A751F6 FOREIGN KEY (country_configured_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_6117D13B65A751F6 ON purchase (country_configured_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE payment_detail_extra_cost');
        $this->addSql('ALTER TABLE app DROP pay_methods_add_fee_to_final_amount, DROP tax_to_final_amount, DROP wolopay_fee_to_final_amount');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE40565A751F6');
        $this->addSql('DROP INDEX IDX_B3EE40565A751F6 ON payment_detail');
        $this->addSql('ALTER TABLE payment_detail DROP country_configured_id');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B65A751F6');
        $this->addSql('DROP INDEX IDX_6117D13B65A751F6 ON purchase');
        $this->addSql('ALTER TABLE purchase DROP country_configured_id');
    }
}
