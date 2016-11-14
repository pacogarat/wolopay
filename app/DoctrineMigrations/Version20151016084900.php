<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151016084900 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client_user CHANGE language_id language_id VARCHAR(2) NOT NULL');
        $this->addSql('ALTER TABLE payment_detail ADD security_random_refund_id VARCHAR(255) DEFAULT NULL, DROP use_provider_client_credentials');
        $this->addSql('ALTER TABLE app CHANGE notification_retries_on_failure notification_retries_on_failure INT NOT NULL');
        $this->addSql('ALTER TABLE article CHANGE show_when_stock_under_n show_when_stock_under_n INT NOT NULL');
        $this->addSql('ALTER TABLE provider ADD virtual_currency_exchange_currency VARCHAR(3) DEFAULT NULL, ADD virtual_currency_exchange_amount DOUBLE PRECISION DEFAULT NULL, ADD refund_enabled TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CEB635B97 FOREIGN KEY (virtual_currency_exchange_currency) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_92C4739CEB635B97 ON provider (virtual_currency_exchange_currency)');
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::CHERRY_CREDITS_IPN."','Cherry Credits', NOW())");
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::G2A_IPN."','G2APay', NOW())");
        $this->addSql('ALTER TABLE purchase ADD cancel_in_process TINYINT(1) DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_5C0F152B82F1BAF4 ON client_user (language_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app CHANGE notification_retries_on_failure notification_retries_on_failure INT DEFAULT 25 NOT NULL');
        $this->addSql('ALTER TABLE article CHANGE show_when_stock_under_n show_when_stock_under_n INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE client_user CHANGE language_id language_id VARCHAR(2) DEFAULT \'en\' NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('DROP INDEX idx_5c0f152b82f1baf4 ON client_user');
        $this->addSql('CREATE INDEX FK_5C0F152B82F1BAF4 ON client_user (language_id)');
        $this->addSql('ALTER TABLE payment_detail ADD use_provider_client_credentials TINYINT(1) DEFAULT NULL, DROP security_random_refund_id');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CEB635B97');
        $this->addSql('DROP INDEX IDX_92C4739CEB635B97 ON provider');
        $this->addSql('ALTER TABLE provider DROP virtual_currency_exchange_currency, DROP virtual_currency_exchange_amount, DROP refund_enabled');
        $this->addSql('ALTER TABLE purchase DROP cancel_in_process');
    }
}
