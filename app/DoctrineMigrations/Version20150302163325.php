<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150302163325 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX PROMO_CODE_UNIQUE_ ON promo_code (code, app_id)');
        $this->addSql('CREATE UNIQUE INDEX SMS_CODE_UNIQUE_ ON sms_code (external_transaction_id)');
        $this->addSql('CREATE UNIQUE INDEX ASHA_UNIQUE_ ON app_shop_has_articles (article_id, app_shop_id, country_id)');
        $this->addSql('CREATE UNIQUE INDEX COUNTRY_CODE_ ON country (code)');
        $this->addSql('CREATE UNIQUE INDEX APP_API_CREDENTIALS_UNIQUE_ ON app_api_credentials (code_key)');
        $this->addSql('CREATE UNIQUE INDEX AA_UNIQUE_ ON article_amount (article_id, country_id)');
        $this->addSql('CREATE UNIQUE INDEX SMS_OPERATOR_UNIQUE_ ON sms_operator (country_id, short_name)');
        $this->addSql('CREATE UNIQUE INDEX CLIENT_USER_U_UNIQUE_ ON client_user (username)');
        $this->addSql('CREATE UNIQUE INDEX CLIENT_USER_E_UNIQUE_ ON client_user (email)');
        $this->addSql('CREATE UNIQUE INDEX OFFER_PROGRAMER_UNIQUE_ ON offer_programer (article_id, app_shop_id, country_id)');
        $this->addSql('CREATE UNIQUE INDEX AHPMPC_UNIQUE_ ON article_has_pmpc (pay_method_country_has_country_id, article_id)');
        $this->addSql('CREATE UNIQUE INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles (article_id, payment_detail_id)');
        $this->addSql('CREATE UNIQUE INDEX GAMER_UNIQUE_ ON gamer (gamer_external_id, app_id)');
        $this->addSql('CREATE UNIQUE INDEX SMS_UNIQUE_ ON sms (pay_method_provider_country_id, short_number, operator_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX APP_API_CREDENTIALS_UNIQUE_ ON app_api_credentials');
        $this->addSql('DROP INDEX ASHA_UNIQUE_ ON app_shop_has_articles');
        $this->addSql('DROP INDEX AA_UNIQUE_ ON article_amount');
        $this->addSql('DROP INDEX AHPMPC_UNIQUE_ ON article_has_pmpc');
        $this->addSql('DROP INDEX CLIENT_USER_U_UNIQUE_ ON client_user');
        $this->addSql('DROP INDEX CLIENT_USER_E_UNIQUE_ ON client_user');
        $this->addSql('DROP INDEX COUNTRY_CODE_ ON country');
        $this->addSql('DROP INDEX GAMER_UNIQUE_ ON gamer');
        $this->addSql('DROP INDEX OFFER_PROGRAMER_UNIQUE_ ON offer_programer');
        $this->addSql('DROP INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles');
        $this->addSql('DROP INDEX PROMO_CODE_UNIQUE_ ON promo_code');
        $this->addSql('DROP INDEX SMS_UNIQUE_ ON sms');
        $this->addSql('DROP INDEX SMS_CODE_UNIQUE_ ON sms_code');
        $this->addSql('DROP INDEX SMS_OPERATOR_UNIQUE_ ON sms_operator');
    }
}
