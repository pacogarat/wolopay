<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141104115120 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE payment (id VARCHAR(255) NOT NULL, state_category_id INT NOT NULL, payment_detail_id VARCHAR(255) NOT NULL, app_id VARCHAR(255) NOT NULL, gamer_id INT NOT NULL, amount DOUBLE PRECISION DEFAULT NULL, transaction_external_id VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_6D28840DD962B9BF (state_category_id), INDEX IDX_6D28840D9BF92C93 (payment_detail_id), INDEX IDX_6D28840D7987212D (app_id), INDEX IDX_6D28840D2F43A116 (gamer_id), UNIQUE INDEX transaction_external_id_UNIQUE (transaction_external_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_eventuality_payment (id VARCHAR(255) NOT NULL, subscription_eventuality_id VARCHAR(255) NOT NULL, INDEX IDX_CEB04FEE2D97D5D (subscription_eventuality_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase_notification (id VARCHAR(255) NOT NULL, payment_detail_has_article_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, attempts INT NOT NULL, transaction_suffix VARCHAR(10) DEFAULT NULL, was_received TINYINT(1) DEFAULT NULL, is_ready_to_notify TINYINT(1) DEFAULT NULL, is_subscription TINYINT(1) DEFAULT NULL, requests LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_7B4E816AE127364A (payment_detail_has_article_id), INDEX IDX_7B4E816A7987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase_has_purchase_notification (purchasenotification_id VARCHAR(255) NOT NULL, purchase_id VARCHAR(255) NOT NULL, INDEX IDX_7C35EDE6BEBDDF47 (purchasenotification_id), INDEX IDX_7C35EDE6558FBEB9 (purchase_id), PRIMARY KEY(purchasenotification_id, purchase_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo_code (code VARCHAR(255) NOT NULL, promo_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, article_id VARCHAR(255) NOT NULL, count_n_time_used INT NOT NULL, value DOUBLE PRECISION DEFAULT NULL, isPercent TINYINT(1) DEFAULT NULL, n_uses_per_user INT NOT NULL, n_total_uses INT DEFAULT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3D8C939ED0C07AFF (promo_id), INDEX IDX_3D8C939E7987212D (app_id), INDEX IDX_3D8C939E7294869C (article_id), UNIQUE INDEX code_unique (code), PRIMARY KEY(code)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, level_category_id INT NOT NULL, shop_css_id INT NOT NULL, tutorial_promo_code_id VARCHAR(255) DEFAULT NULL, tutorial_eanbled TINYINT(1) DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, value_lower INT NOT NULL, value_higher INT NOT NULL, first_offer TINYINT(1) DEFAULT NULL, INDEX IDX_A94469027987212D (app_id), INDEX IDX_A9446902E3B5FBBF (level_category_id), INDEX IDX_A9446902E4F8739A (shop_css_id), INDEX IDX_A9446902C343B13 (tutorial_promo_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms_code (name VARCHAR(45) NOT NULL, sms_operator_id INT NOT NULL, currency_id VARCHAR(3) NOT NULL, amount DOUBLE PRECISION NOT NULL, usedAt DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, mobile VARCHAR(25) NOT NULL, INDEX IDX_CC38ACCE81C6B038 (sms_operator_id), INDEX IDX_CC38ACCE38248176 (currency_id), PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, description_label_id INT DEFAULT NULL, name VARCHAR(45) NOT NULL, photo_url VARCHAR(75) DEFAULT NULL, multiply_number DOUBLE PRECISION DEFAULT NULL, percent_discount DOUBLE PRECISION DEFAULT NULL, price_discount DOUBLE PRECISION DEFAULT NULL, INDEX IDX_29D6873E868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_css (id INT AUTO_INCREMENT NOT NULL, css_url VARCHAR(255) NOT NULL, name VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_has_articles (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) NOT NULL, app_shop_id INT NOT NULL, article_amount_id INT DEFAULT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, offer_id INT DEFAULT NULL, offer_img INT DEFAULT NULL, sms_alias VARCHAR(20) DEFAULT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_129B01517294869C (article_id), INDEX IDX_129B0151F92F3E70 (country_id), INDEX IDX_129B0151A04B4490 (app_shop_id), INDEX IDX_129B0151418426BC (article_amount_id), INDEX IDX_129B01511F68DAF7 (name_label_id), INDEX IDX_129B0151868ACD1D (description_label_id), INDEX IDX_129B015153C674EE (offer_id), INDEX IDX_129B015197F7A934 (offer_img), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_detail (id VARCHAR(255) NOT NULL, sms_id INT DEFAULT NULL, pay_method_id INT NOT NULL, provider_id INT NOT NULL, country_id VARCHAR(2) NOT NULL, currency_id VARCHAR(3) NOT NULL, transaction_id VARCHAR(100) DEFAULT NULL, language_id VARCHAR(2) NOT NULL, amount DOUBLE PRECISION NOT NULL, security_random_ipn_id VARCHAR(255) DEFAULT NULL, security_random_done_id VARCHAR(255) DEFAULT NULL, security_random_cancel_id VARCHAR(255) DEFAULT NULL, INDEX IDX_B3EE405BD5C7E60 (sms_id), INDEX IDX_B3EE4053486861B (pay_method_id), INDEX IDX_B3EE405A53A8AA (provider_id), INDEX IDX_B3EE405F92F3E70 (country_id), INDEX IDX_B3EE40538248176 (currency_id), INDEX IDX_B3EE4052FC0CB0F (transaction_id), INDEX IDX_B3EE40582F1BAF4 (language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id VARCHAR(255) NOT NULL, state_category_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, gamer_id INT NOT NULL, payment_detail_id VARCHAR(255) NOT NULL, transaction_external_id VARCHAR(255) DEFAULT NULL, request LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', responses LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', amount_for_each_payment DOUBLE PRECISION NOT NULL, amount_for_each_payment_to_complete DOUBLE PRECISION NOT NULL, n_pn_complete_payments INT NOT NULL, total_amount DOUBLE PRECISION NOT NULL, ip VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, INDEX IDX_A3C664D3D962B9BF (state_category_id), INDEX IDX_A3C664D37987212D (app_id), INDEX IDX_A3C664D32F43A116 (gamer_id), INDEX IDX_A3C664D39BF92C93 (payment_detail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email_gamer_support (id INT AUTO_INCREMENT NOT NULL, transation_id VARCHAR(100) NOT NULL, subject VARCHAR(45) NOT NULL, name VARCHAR(45) NOT NULL, mobile VARCHAR(45) NOT NULL, email VARCHAR(145) NOT NULL, comment LONGTEXT NOT NULL, INDEX IDX_DE8183A25814BBD1 (transation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_amount (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) NOT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_E466E7C27294869C (article_id), INDEX IDX_E466E7C2F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app (id VARCHAR(255) NOT NULL, client_id INT NOT NULL, logo INT NOT NULL, name VARCHAR(45) NOT NULL, url_home_site VARCHAR(255) NOT NULL, url_notification_payment VARCHAR(255) NOT NULL, url_notification_subscription VARCHAR(255) DEFAULT NULL, url_extra VARCHAR(255) DEFAULT NULL, translations_domain VARCHAR(100) NOT NULL, pg_tax_percent DOUBLE PRECISION NOT NULL, sms_alias VARCHAR(20) DEFAULT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_C96E70CF19EB6921 (client_id), INDEX IDX_C96E70CFE48E9A13 (logo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_has_paymethod_provider_country (app_id VARCHAR(255) NOT NULL, paymethodproviderhascountry_id INT NOT NULL, INDEX IDX_39DED44C7987212D (app_id), INDEX IDX_39DED44C436F2135 (paymethodproviderhascountry_id), PRIMARY KEY(app_id, paymethodproviderhascountry_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `transaction` (id VARCHAR(100) NOT NULL, app_api_crendetials_id INT NOT NULL, language_id VARCHAR(2) DEFAULT NULL, gamer_id INT NOT NULL, state_category_id INT NOT NULL, selected_article_id VARCHAR(255) DEFAULT NULL, app_id VARCHAR(255) NOT NULL, level_category_id INT NOT NULL, shop_css_id INT NOT NULL, tutorial_promo_code_id VARCHAR(255) DEFAULT NULL, tutorial_eanbled TINYINT(1) DEFAULT NULL, fixed_country TINYINT(1) NOT NULL, value_current INT NOT NULL, custom_param VARCHAR(125) DEFAULT NULL, `return` VARCHAR(255) DEFAULT NULL, expire_at DATETIME DEFAULT NULL, expired_at DATETIME DEFAULT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, value_lower INT NOT NULL, value_higher INT NOT NULL, first_offer TINYINT(1) DEFAULT NULL, INDEX IDX_723705D14A677644 (app_api_crendetials_id), INDEX IDX_723705D182F1BAF4 (language_id), INDEX IDX_723705D12F43A116 (gamer_id), INDEX IDX_723705D1D962B9BF (state_category_id), INDEX IDX_723705D14514C27F (selected_article_id), INDEX IDX_723705D17987212D (app_id), INDEX IDX_723705D1E3B5FBBF (level_category_id), INDEX IDX_723705D1E4F8739A (shop_css_id), INDEX IDX_723705D1C343B13 (tutorial_promo_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_countries_available (transaction_id VARCHAR(100) NOT NULL, country_id VARCHAR(2) NOT NULL, INDEX IDX_B59AF40C2FC0CB0F (transaction_id), INDEX IDX_B59AF40CF92F3E70 (country_id), PRIMARY KEY(transaction_id, country_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_methods_categories_available (transaction_id VARCHAR(100) NOT NULL, methodcategory_id VARCHAR(255) NOT NULL, INDEX IDX_E7BD6D262FC0CB0F (transaction_id), INDEX IDX_E7BD6D26A31E0FF2 (methodcategory_id), PRIMARY KEY(transaction_id, methodcategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_providers_available (transaction_id VARCHAR(100) NOT NULL, provider_id INT NOT NULL, INDEX IDX_ACE91AB82FC0CB0F (transaction_id), INDEX IDX_ACE91AB8A53A8AA (provider_id), PRIMARY KEY(transaction_id, provider_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_articles_available (transaction_id VARCHAR(100) NOT NULL, article_id VARCHAR(255) NOT NULL, INDEX IDX_2A8161892FC0CB0F (transaction_id), INDEX IDX_2A8161897294869C (article_id), PRIMARY KEY(transaction_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id VARCHAR(255) NOT NULL, transaction_id VARCHAR(100) NOT NULL, provider_id INT NOT NULL, pay_category_id VARCHAR(255) NOT NULL, method_category_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) NOT NULL, currency_id VARCHAR(3) NOT NULL, gamer_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, payment_id VARCHAR(255) NOT NULL, was_canceled TINYINT(1) NOT NULL, partial_payment VARCHAR(45) DEFAULT NULL, amount_total DOUBLE PRECISION NOT NULL, amount_pg DOUBLE PRECISION NOT NULL, amount_provider DOUBLE PRECISION NOT NULL, amount_game DOUBLE PRECISION NOT NULL, provider_tax_percent DOUBLE PRECISION NOT NULL, amount_tax_amount DOUBLE PRECISION NOT NULL, amount_tax_amount_minimal DOUBLE PRECISION NOT NULL, exchange_rate_eur DOUBLE PRECISION NOT NULL, exchange_rate_usd DOUBLE PRECISION NOT NULL, exchange_rate_gbp DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, created_at_unix INT NOT NULL, INDEX IDX_6117D13B2FC0CB0F (transaction_id), INDEX IDX_6117D13BA53A8AA (provider_id), INDEX IDX_6117D13BCA12280B (pay_category_id), INDEX IDX_6117D13B51FD67EA (method_category_id), INDEX IDX_6117D13BF92F3E70 (country_id), INDEX IDX_6117D13B38248176 (currency_id), INDEX IDX_6117D13B2F43A116 (gamer_id), INDEX IDX_6117D13B7987212D (app_id), UNIQUE INDEX UNIQ_6117D13B4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase_purchasenotification (purchase_id VARCHAR(255) NOT NULL, purchasenotification_id VARCHAR(255) NOT NULL, INDEX IDX_2F1850F0558FBEB9 (purchase_id), INDEX IDX_2F1850F0BEBDDF47 (purchasenotification_id), PRIMARY KEY(purchase_id, purchasenotification_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE single_payment (id VARCHAR(255) NOT NULL, request LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', responses LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', ip VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voice_code (name VARCHAR(45) NOT NULL, currency_id VARCHAR(3) NOT NULL, amount DOUBLE PRECISION NOT NULL, usedAt DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, number VARCHAR(25) NOT NULL, INDEX IDX_5AD6174338248176 (currency_id), PRIMARY KEY(name)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id VARCHAR(255) NOT NULL, article_category_id VARCHAR(255) NOT NULL, image INT DEFAULT NULL, item_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, number INT DEFAULT NULL, n_purchases_per_client INT DEFAULT NULL, periodicity INT DEFAULT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_23A0E6688C5F785 (article_category_id), INDEX IDX_23A0E66C53D045F (image), INDEX IDX_23A0E66126F525E (item_id), INDEX IDX_23A0E667987212D (app_id), INDEX IDX_23A0E661F68DAF7 (name_label_id), INDEX IDX_23A0E66868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_category (id INT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription_eventuality (id VARCHAR(255) NOT NULL, subscription_id VARCHAR(255) NOT NULL, total_amount DOUBLE PRECISION NOT NULL, n_purchases INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, end_at DATETIME DEFAULT NULL, INDEX IDX_EC3A83759A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, name_label_id INT NOT NULL, description_label_id INT NOT NULL, image INT NOT NULL, name VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_1F1B251E7987212D (app_id), INDEX IDX_1F1B251E1F68DAF7 (name_label_id), INDEX IDX_1F1B251E868ACD1D (description_label_id), INDEX IDX_1F1B251EC53D045F (image), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_programer (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) DEFAULT NULL, app_shop_id INT DEFAULT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, offer_id INT NOT NULL, offer_img INT DEFAULT NULL, offer_from DATETIME DEFAULT NULL, offer_to DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_D513CBF47294869C (article_id), INDEX IDX_D513CBF4F92F3E70 (country_id), INDEX IDX_D513CBF4A04B4490 (app_shop_id), INDEX IDX_D513CBF41F68DAF7 (name_label_id), INDEX IDX_D513CBF4868ACD1D (description_label_id), INDEX IDX_D513CBF453C674EE (offer_id), INDEX IDX_D513CBF497F7A934 (offer_img), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_has_pmpc (id INT AUTO_INCREMENT NOT NULL, pay_method_country_has_country_id INT NOT NULL, article_id VARCHAR(255) NOT NULL, `order` INT NOT NULL, active TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_F94441D38695F4F1 (pay_method_country_has_country_id), INDEX IDX_F94441D37294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_status_category (id INT NOT NULL, name VARCHAR(75) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_detail_has_articles (id INT AUTO_INCREMENT NOT NULL, payment_detail_id VARCHAR(255) NOT NULL, article_id VARCHAR(255) NOT NULL, app_shop_has_article_id INT DEFAULT NULL, items_number INT NOT NULL, quantity INT NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_20A0B99C9BF92C93 (payment_detail_id), INDEX IDX_20A0B99C7294869C (article_id), INDEX IDX_20A0B99C5AC996CC (app_shop_has_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, name VARCHAR(45) NOT NULL, INDEX IDX_B0139AFB7987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_service_category (id VARCHAR(255) NOT NULL, name VARCHAR(75) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE single_free_payment (id VARCHAR(255) NOT NULL, promo_code VARCHAR(255) DEFAULT NULL, INDEX IDX_F537983C3D8C939E (promo_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_status_category (id INT NOT NULL, name VARCHAR(75) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gamer (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, gamer_external_id VARCHAR(45) NOT NULL, purchases_number INT NOT NULL, purchases_average DOUBLE PRECISION DEFAULT NULL, currency VARCHAR(3) DEFAULT NULL, medio_pago_mas_usado_unknown INT DEFAULT NULL, numMediosPago_unknown INT DEFAULT NULL, purchaseLastId_unknown DATETIME DEFAULT NULL, pais_MPMasUsado_unknown VARCHAR(2) DEFAULT NULL, INDEX IDX_88241BA77987212D (app_id), INDEX IDX_88241BA7FDC4C5BD (pais_MPMasUsado_unknown), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promo_code_used_by_gamer (id INT AUTO_INCREMENT NOT NULL, gamer_id INT DEFAULT NULL, promo_id VARCHAR(255) DEFAULT NULL, used_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_5961A3392F43A116 (gamer_id), INDEX IDX_5961A339D0C07AFF (promo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms (id INT AUTO_INCREMENT NOT NULL, pay_method_provider_country_id INT NOT NULL, operator_id INT NOT NULL, sms_logic_category_id VARCHAR(255) NOT NULL, mobile_text_sing_up_label_id INT DEFAULT NULL, legal_text_label_id INT DEFAULT NULL, check_box_label_id INT DEFAULT NULL, alias_default VARCHAR(20) NOT NULL, short_number VARCHAR(10) DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_B0A93A77E562B43C (pay_method_provider_country_id), INDEX IDX_B0A93A77584598A3 (operator_id), INDEX IDX_B0A93A771CBED403 (sms_logic_category_id), INDEX IDX_B0A93A77788321EB (mobile_text_sing_up_label_id), INDEX IDX_B0A93A776AF9AB15 (legal_text_label_id), INDEX IDX_B0A93A771B4CC096 (check_box_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms_has_sms_alias (sms_alias_id INT NOT NULL, sms INT NOT NULL, INDEX IDX_E57A022E38A06BE3 (sms_alias_id), INDEX IDX_E57A022EB0A93A77 (sms), PRIMARY KEY(sms_alias_id, sms)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voice (id INT AUTO_INCREMENT NOT NULL, pay_method_provider_country_id INT NOT NULL, number VARCHAR(20) NOT NULL, amount DOUBLE PRECISION NOT NULL, call_max_duration INT NOT NULL, call_legal_duration INT NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E7FB583BE562B43C (pay_method_provider_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pay_method_has_provider (id INT AUTO_INCREMENT NOT NULL, pay_method_id INT NOT NULL, provider_id INT NOT NULL, payment_service_category_id VARCHAR(255) NOT NULL, img_icon INT NOT NULL, description_label_id INT DEFAULT NULL, fee_provider_percent INT DEFAULT NULL, fee_extra_each_payment DOUBLE PRECISION DEFAULT NULL, fee_provider_minimal DOUBLE PRECISION DEFAULT NULL, is_iframe TINYINT(1) NOT NULL, is_ajax TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_4D729A543486861B (pay_method_id), INDEX IDX_4D729A54A53A8AA (provider_id), INDEX IDX_4D729A544CC4A381 (payment_service_category_id), INDEX IDX_4D729A54AB85D8E3 (img_icon), INDEX IDX_4D729A54868ACD1D (description_label_id), UNIQUE INDEX PMP_UNIQUE (pay_method_id, provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms_operator (id INT AUTO_INCREMENT NOT NULL, country_id VARCHAR(2) NOT NULL, img_icon INT NOT NULL, name VARCHAR(45) NOT NULL, short_name VARCHAR(5) DEFAULT NULL, INDEX IDX_B1508680F92F3E70 (country_id), INDEX IDX_B1508680AB85D8E3 (img_icon), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pay_method_provider_has_country (id INT AUTO_INCREMENT NOT NULL, country_id VARCHAR(2) NOT NULL, currency_id VARCHAR(3) NOT NULL, pay_method_has_provider_id INT NOT NULL, text_label_id INT DEFAULT NULL, `default` TINYINT(1) NOT NULL, keyword VARCHAR(25) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_4BF4E18CF92F3E70 (country_id), INDEX IDX_4BF4E18C38248176 (currency_id), INDEX IDX_4BF4E18C38513191 (pay_method_has_provider_id), INDEX IDX_4BF4E18C85FBA32B (text_label_id), UNIQUE INDEX PMPC_UNIQUE_ (country_id, pay_method_has_provider_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms_alias (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) DEFAULT NULL, alias VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider (id INT NOT NULL, name VARCHAR(75) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_currencies_available (provider_id INT NOT NULL, currency_id VARCHAR(3) NOT NULL, INDEX IDX_D4B46C2BA53A8AA (provider_id), INDEX IDX_D4B46C2B38248176 (currency_id), PRIMARY KEY(provider_id, currency_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pay_method (id INT AUTO_INCREMENT NOT NULL, method_category_id VARCHAR(255) NOT NULL, pay_category_id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D7C2F02F51FD67EA (method_category_id), INDEX IDX_D7C2F02FCA12280B (pay_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sms_logic_category (id VARCHAR(255) NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pay_catergory (id VARCHAR(255) NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE method_catergory (id VARCHAR(255) NOT NULL, description_label_id INT NOT NULL, name VARCHAR(45) NOT NULL, class VARCHAR(45) NOT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_93E7D4F9868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, country_id VARCHAR(2) NOT NULL, name_company VARCHAR(45) NOT NULL, cif VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, discr VARCHAR(255) NOT NULL, INDEX IDX_4FBF094FF92F3E70 (country_id), UNIQUE INDEX CIF_UNIQUE (cif), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_user_notification (id INT AUTO_INCREMENT NOT NULL, client_user_id INT NOT NULL, title VARCHAR(45) DEFAULT NULL, message LONGTEXT NOT NULL, unread TINYINT(1) DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_15D3E8D9F55397E8 (client_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_user (id INT AUTO_INCREMENT NOT NULL, client_id INT, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, UNIQUE INDEX UNIQ_5C0F152B92FC23A8 (username_canonical), UNIQUE INDEX UNIQ_5C0F152BA0D96FBF (email_canonical), INDEX IDX_5C0F152B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, description VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id VARCHAR(2) NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id VARCHAR(3) NOT NULL, name VARCHAR(50) NOT NULL, symbol VARCHAR(3) NOT NULL, exchange_rate_eur DOUBLE PRECISION NOT NULL, exchange_rate_usd DOUBLE PRECISION NOT NULL, exchange_rate_gbp DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_user_has_apps (id INT AUTO_INCREMENT NOT NULL, client_user_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, role VARCHAR(45) DEFAULT NULL, INDEX IDX_DA7B7B31F55397E8 (client_user_id), INDEX IDX_DA7B7B317987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_api_credentials (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, code_key VARCHAR(45) NOT NULL, secret_key VARCHAR(100) NOT NULL, server_key VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_CAA887097987212D (app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_trans_unit (id INT AUTO_INCREMENT NOT NULL, key_name VARCHAR(255) NOT NULL, domain VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX key_domain_idx (key_name, domain), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_trans_unit_translations (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, trans_unit_id INT DEFAULT NULL, locale VARCHAR(10) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_B0AA394493CB796C (file_id), INDEX IDX_B0AA3944C3C583C9 (trans_unit_id), UNIQUE INDEX trans_unit_locale_idx (trans_unit_id, locale), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lexik_translation_file (id INT AUTO_INCREMENT NOT NULL, domain VARCHAR(255) NOT NULL, locale VARCHAR(10) NOT NULL, extention VARCHAR(10) NOT NULL, path VARCHAR(255) NOT NULL, hash VARCHAR(255) NOT NULL, UNIQUE INDEX hash_idx (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_80D4C5414E7AF8F (gallery_id), INDEX IDX_80D4C541EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL, provider_metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, context VARCHAR(64) NOT NULL, default_format VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql("CREATE TABLE `country` (`id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,`currency_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL,`language_id` varchar(2) COLLATE utf8_unicode_ci NOT NULL,`name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,`code` int(11) NOT NULL,`order` int(11) NOT NULL,`created_at` datetime NOT NULL, INDEX IDX_5373C96638248176 (currency_id), INDEX IDX_5373C96682F1BAF4 (language_id),PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

        $this->addSql("INSERT INTO `method_catergory` VALUES ('free',4,'Free','type-free',5,'2014-11-04 12:09:52'),('phone',3,'Phone','type-phone',3,'2014-11-04 12:09:52'),('single_payment',1,'Unique Payment','type-articles',1,'2014-11-04 12:09:52'),('subscription',2,'Subscription','type-subscriptions',2,'2014-11-04 12:09:52');");
        $this->addSql("INSERT INTO `pay_catergory` VALUES ('credit_card','Credit Card'),('mobile','Mobile'),('prepaid_card','Prepaid card'),('promo_code','Promo code'),('provider_method','Special provider method'),('voice','Voice');");
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('shop.payment.nvia_promo_code_pay_method','Nvia promo code','2014-11-11 17:25:37'),('shop.payment.nvia_sms_ipn_pay_method','Nvia SMS','2014-11-11 17:25:37'),('shop.payment.nvia_voice_ipn_pay_method','Nvia Voice','2014-11-11 17:25:37'),('shop.payment.paypal_ipn_pay_method','Paypal Ipn','2014-11-11 17:25:37'),('shop.payment.paypal_ipn_subscription_pay_method','Paypal subscription','2014-11-11 17:25:37'),('shop.payment.paysafecard_ipn_pay_method','PaySafeCard','2014-11-11 17:25:37'),('shop.payment.rixty_ipn_pay_method','Rixty','2014-11-11 17:25:37'),('shop.payment.ukash_ipn_pay_method','Ukash Ipn','2014-11-11 17:25:37')");
        $this->addSql("INSERT INTO `payment_status_category` VALUES (1,'Begin','2014-11-04 12:09:52'),(5,'Processing','2014-11-04 12:09:52'),(30,'Pending','2014-11-04 12:09:52'),(200,'Completed','2014-11-04 12:09:52'),(201,'Subscription Active','2014-11-04 12:09:52'),(300,'Completed','2014-11-04 12:09:52'),(302,'Refunded','2014-11-04 12:09:52'),(500,'Failed','2014-11-04 12:09:52'),(501,'Blocked','2014-11-04 12:09:52');");
        $this->addSql("INSERT INTO `shop_css` VALUES (1,'theme_default.less','Standard','2014-11-04 12:09:54'),(2,'theme_wood.less','Wood','2014-11-04 12:09:54'),(3,'theme_berserk.less','Berserk','2014-11-04 12:09:54'),(4,'theme_tron.less','Tron','2014-11-04 12:09:54'),(5,'theme_paper.less','Paper','2014-11-04 12:09:54');");
        $this->addSql("INSERT INTO `level_category` VALUES (1,'Rookie'),(2,'Medium'),(3,'Expert')");
        $this->addSql("INSERT INTO `sms_logic_category` VALUES ('mo_+_mt_with_code','Mo + Mt + Code');");
        $this->addSql("INSERT INTO `lexik_trans_unit` VALUES (1,'article_categories.single.description','shop','2014-11-04 12:09:52','2014-11-04 12:09:52'),(2,'article_categories.subscription.description','shop','2014-11-04 12:09:52','2014-11-04 12:09:52'),(3,'article_categories.phone.description','shop','2014-11-04 12:09:52','2014-11-04 12:09:52'),(4,'article_categories.free.description','shop','2014-11-04 12:09:52','2014-11-04 12:09:52'),(5,'pay_method.standard.description','shop','2014-11-04 12:09:52','2014-11-04 12:09:52'),(6,'sms.mobile_text_sing_up.write_pin','sms','2014-11-04 12:09:52','2014-11-04 12:09:52'),(7,'sms.legal_text.standard','sms','2014-11-04 12:09:52','2014-11-04 12:09:52');");
        $this->addSql("INSERT INTO `lexik_trans_unit_translations` VALUES (1,NULL,1,'en','Single Payments','2014-11-04 12:09:52','2014-11-04 12:09:52'),(2,NULL,1,'es','Pagos únicos','2014-11-04 12:09:52','2014-11-04 12:09:52'),(3,NULL,2,'en','Subscription','2014-11-04 12:09:52','2014-11-04 12:09:52'),(4,NULL,2,'es','Subscripciones','2014-11-04 12:09:52','2014-11-04 12:09:52'),(5,NULL,3,'en','Phone Payments','2014-11-04 12:09:52','2014-11-04 12:09:52'),(6,NULL,3,'es','Pagos con teléfono','2014-11-04 12:09:52','2014-11-04 12:09:52'),(7,NULL,4,'en','Free purchases','2014-11-04 12:09:52','2014-11-04 12:09:52'),(8,NULL,4,'es','Compras gratuitos','2014-11-04 12:09:52','2014-11-04 12:09:52'),(9,NULL,5,'en','Its a cool provider','2014-11-04 12:09:52','2014-11-04 12:09:52'),(10,NULL,5,'es','Es una forma de pago muy buena!','2014-11-04 12:09:52','2014-11-04 12:09:52'),(11,NULL,6,'en','Write #PIN# in website to continue','2014-11-04 12:09:52','2014-11-04 12:09:52'),(12,NULL,6,'es','Introduce #PIN# en la web para continuar','2014-11-04 12:09:52','2014-11-04 12:09:52'),(13,NULL,7,'en','This is not a subscription service. The amount of the message is %amount% %currency% tax included. A.T.S. SA Apdo. Correos 18070 Madrid 28080. informacion@atssa.es. Customer Atn. 902501737','2014-11-04 12:09:52','2014-11-04 12:09:52'),(14,NULL,7,'es','Esto no es un servicio de suscripción. El precio del mensaje es %amount% %currency% impuestos incluidos. A.T.S. S.A. Apdo. Correos 18070 Madrid 28080. informacion@atssa.es. Atn. Cliente: 902501737','2014-11-04 12:09:52','2014-11-04 12:09:52')");

        $this->addSql("INSERT INTO `article_category` VALUES ('free','Free','2014-11-04 12:09:52'),('single_payment','Single Payment','2014-11-04 12:09:52'),('subscription','Subscription Payment','2014-11-04 12:09:52')");

        $this->addSql("INSERT INTO `language` VALUES ('en','English'),('es','Español')
        ,('ru','русский язык')
        ,('fr','le français')
        ,('hu','magyar')
        ,('it','Italiano')
        ,('ro','Daco-Romanian')
        ,('de','Deutsch')
        ,('pl','język polski')
        ,('pt','português')
        ,('zam','Malayalam')
        ,('th','Siamese')
        ,('vi','Tiếng Việt')
        ,('tr','Türkçe')
        ,('el','ελληνικά')
        ,('bg','български език')
        ,('cs','čeština')
        "
           );

        $this->addSql("insert into `country` (`id`,`name`, `currency_id`, `code`, language_id, `order`, `created_at`) values
('DF','Other','EUR','0','en',999,'2014-11-11 11:58:49'),
('CA','Canada','CAD','302','en',1,'2014-11-11 11:58:49'),
('RU','Russia','RUB','250','ru',1,'2014-11-11 11:58:49'),
('US','United States','USD','310','en',1,'2014-11-11 11:58:49'),
('ZA','South Africa','ZAR','655','en',1,'2014-11-11 11:58:49'),
('GR','Greece','EUR','202','el',1,'2014-11-11 11:58:49'),
('BE','Belgium','EUR','206','fr',1,'2014-11-11 11:58:49'),
('FR','France','EUR','208','fr',1,'2014-11-11 11:58:49'),
('ES','España','EUR','214','es',1,'2014-11-11 11:58:49'),
('HU','Hungary','HUF','216','hu',1,'2014-11-11 11:58:49'),
('IT','Italy','EUR','222','it',1,'2014-11-11 11:58:49'),
('RO','Romania','EUR','226','ro',1,'2014-11-11 11:58:49'),
('CH','Switzerland','CHF','228','de',1,'2014-11-11 11:58:49'),
('GB','United Kingdom','GBP','234','en',1,'2014-11-11 11:58:49'),
('PL','Poland','PLN','260','pl',1,'2014-11-11 11:58:49'),
('PE','Perú','PEN','716','es',1,'2014-11-11 11:58:49'),
('MX','México','MXN','334','es',1,'2014-11-11 11:58:49'),
('AR','Argentina','ARS','722','es',1,'2014-11-11 11:58:49'),
('BR','Brazil','BRL','724','pt',1,'2014-11-11 11:58:49'),
('CL','Chile','CLP','730','es',1,'2014-11-11 11:58:49'),
('CO','Colombia','COP','732','es',1,'2014-11-11 11:58:49'),
('VE','Venezuela','VEF','734','es',1,'2014-11-11 11:58:49'),
('MY','Malaysia','MYR','502','zam',1,'2014-11-11 11:58:49'),
('SG','Singapore','SGD','525','en',1,'2014-11-11 11:58:49'),
('TH','Thailand','THB','520','th',1,'2014-11-11 11:58:49'),
('VN','Vietnam','VND','452','vi',1,'2014-11-11 11:58:49'),
('TR','Turkey','TRY','286','tr',1,'2014-11-11 11:58:49'),
('MA','Morocco','MAD','604','fr',1,'2014-11-11 11:58:49'),
('PT','Portugal','EUR','268','pt',1,'2014-11-11 11:58:49'),
('LU','Luxembourg','EUR','270','fr',1,'2014-11-11 11:58:49'),
('CY','Cyprus','EUR','280','el',1,'2014-11-11 11:58:49'),
('BG','Bulgaria','BGN','284','bg',1,'2014-11-11 11:58:49'),
('UA','Ukraine','UAH','255','ru',1,'2014-11-11 11:58:49'),
('CZ','Czech Republic','CZK','230','cs',1,'2014-11-11 11:58:49'),
('GT','Guatemala','GTQ','704','es',1,'2014-11-11 11:58:49'),
('SV','El Salvador','USD','706','es',1,'2014-11-11 11:58:49'),
('HN','Honduras','HNL','708','es',1,'2014-11-11 11:58:49'),
('NI','Nicaragua','NIO','710','es',1,'2014-11-11 11:58:49'),
('CR','Costa Rica','CRC','712','es',1,'2014-11-11 11:58:49'),
('PA','Panama','PAB','714','es',1,'2014-11-11 11:58:49'),
('BO','Bolivia','BOB','736','es',1,'2014-11-11 11:58:49'),
('EC','Ecuador','USD','740','es',1,'2014-11-11 11:58:49'),
('PY','Paraguay','PYG','744','es',1,'2014-11-11 11:58:49'),
('UY','Uruguay','UYU','748','es',1,'2014-11-11 11:58:49'),
('PR','Puerto Rico','USD','330','es',1,'2014-11-11 11:58:49'),
('DO','Republica Dominicana','DOP','370','es',1,'2014-11-11 11:58:49');");

        $this->addSql("INSERT INTO `currency` VALUES ('ARS','ARGENTINE_PESO','$',0.0735,0.123,0.0724,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('BGN','BULGARIAN_LEV','$',0.3997,0.6895,0.406,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('CLP','CHILEAN_PESO','$',0.0011,0.0018,0.0011,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('COP','COLOMBIAN_PESO','$',0.0003,0.0005,0.0003,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('CZK','CZECH_KORUNA','$',0.0281,0.0495,0.0291,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('EUR','EURO','€',0.7825,1.3572,0.7993,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('GBP','POUND_STERLING','£',1,1.6981,1,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('HUF','HUNGARIAN_FORINT','$',0.0025,0.0044,0.0026,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('MAD','MOROCCAN_DIRHAM','$',0.071,0.1211,0.0713,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('MXN','MEXICAN_PESO','$',0.0459,0.0767,0.0452,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('MYR','MALAYSIAN_RINGGIT','$',0.1878,0.3101,0.1826,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('PEN','PERUVIAN_SOL','$',0.2146,0.358,0.2108,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('PLN','POLISH_ZLOTY','$',0.1853,0.3276,0.1929,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('PYG','PARAGUAYAN_GUARANI','$',0.0001,0.0002,0.0001,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('RUB','RUSSIAN_RUBLE','$',0.0143,0.0289,0.017,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('SGD','SINGAPORE_DOLLAR','$',0.4847,0.7995,0.4708,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('TRY','TURKISH_LIRA','$',0.2808,0.4663,0.2746,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('UAH','UKRAINIAN_HRYVNIA','$',0.0483,0.0851,0.0501,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('USD','DOLLAR','$',0.6252,1,0.5889,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('VND','VIETNAMESE_DONG','$',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42'),('ZAR','SOUTH_AFRICAN_RAND','$',0.0565,0.0931,0.0548,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('CAD','Canadian dollar','$',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('CHF','Swiss franc','CHF',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('BRL','Brazilian real','R$',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('VEF','Venezuelan bolívar','Bs.',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('GTQ','Guatemalan quetzal','Q',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('THB','Thai baht','฿',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('HNL','Honduran lempira','L',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')

        ,('NIO','Nicaraguan córdoba',' 	C$',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('CRC','Costa Rican colon','₡',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('PAB','Panamanian balboa','B/.',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('BOB','Boliviano','Bs.',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('UYU','Uruguayan peso','\$U',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')
        ,('DOP','Dominican peso','RD$',0,0,0,'2014-11-04 12:09:52','2014-11-04 12:26:42')




        ;");

        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DD962B9BF FOREIGN KEY (state_category_id) REFERENCES payment_status_category (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D9BF92C93 FOREIGN KEY (payment_detail_id) REFERENCES payment_detail (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D2F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE subscription_eventuality_payment ADD CONSTRAINT FK_CEB04FEE2D97D5D FOREIGN KEY (subscription_eventuality_id) REFERENCES subscription_eventuality (id)');
        $this->addSql('ALTER TABLE subscription_eventuality_payment ADD CONSTRAINT FK_CEB04FEBF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase_notification ADD CONSTRAINT FK_7B4E816AE127364A FOREIGN KEY (payment_detail_has_article_id) REFERENCES payment_detail_has_articles (id)');
        $this->addSql('ALTER TABLE purchase_notification ADD CONSTRAINT FK_7B4E816A7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE purchase_has_purchase_notification ADD CONSTRAINT FK_7C35EDE6BEBDDF47 FOREIGN KEY (purchasenotification_id) REFERENCES purchase_notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase_has_purchase_notification ADD CONSTRAINT FK_7C35EDE6558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939ED0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939E7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A94469027987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902E3B5FBBF FOREIGN KEY (level_category_id) REFERENCES level_category (id)');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902E4F8739A FOREIGN KEY (shop_css_id) REFERENCES shop_css (id)');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE sms_code ADD CONSTRAINT FK_CC38ACCE81C6B038 FOREIGN KEY (sms_operator_id) REFERENCES sms_operator (id)');
        $this->addSql('ALTER TABLE sms_code ADD CONSTRAINT FK_CC38ACCE38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B01517294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151A04B4490 FOREIGN KEY (app_shop_id) REFERENCES app_shop (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151418426BC FOREIGN KEY (article_amount_id) REFERENCES article_amount (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B01511F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B015153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B015197F7A934 FOREIGN KEY (offer_img) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE405BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE4053486861B FOREIGN KEY (pay_method_id) REFERENCES pay_method (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE405A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE405F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE40538248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE4052FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id)');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE40582F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3D962B9BF FOREIGN KEY (state_category_id) REFERENCES payment_status_category (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D37987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D32F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D39BF92C93 FOREIGN KEY (payment_detail_id) REFERENCES payment_detail (id)');
        $this->addSql('ALTER TABLE email_gamer_support ADD CONSTRAINT FK_DE8183A25814BBD1 FOREIGN KEY (transation_id) REFERENCES `transaction` (id)');
        $this->addSql('ALTER TABLE article_amount ADD CONSTRAINT FK_E466E7C27294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_amount ADD CONSTRAINT FK_E466E7C2F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE app ADD CONSTRAINT FK_C96E70CF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE app ADD CONSTRAINT FK_C96E70CFE48E9A13 FOREIGN KEY (logo) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country ADD CONSTRAINT FK_39DED44C7987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country ADD CONSTRAINT FK_39DED44C436F2135 FOREIGN KEY (paymethodproviderhascountry_id) REFERENCES pay_method_provider_has_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D14A677644 FOREIGN KEY (app_api_crendetials_id) REFERENCES app_api_credentials (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D182F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D12F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1D962B9BF FOREIGN KEY (state_category_id) REFERENCES transaction_status_category (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D14514C27F FOREIGN KEY (selected_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D17987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1E3B5FBBF FOREIGN KEY (level_category_id) REFERENCES level_category (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1E4F8739A FOREIGN KEY (shop_css_id) REFERENCES shop_css (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE transaction_has_countries_available ADD CONSTRAINT FK_B59AF40C2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_countries_available ADD CONSTRAINT FK_B59AF40CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available ADD CONSTRAINT FK_E7BD6D262FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available ADD CONSTRAINT FK_E7BD6D26A31E0FF2 FOREIGN KEY (methodcategory_id) REFERENCES method_catergory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_providers_available ADD CONSTRAINT FK_ACE91AB82FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_providers_available ADD CONSTRAINT FK_ACE91AB8A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_articles_available ADD CONSTRAINT FK_2A8161892FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_articles_available ADD CONSTRAINT FK_2A8161897294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BCA12280B FOREIGN KEY (pay_category_id) REFERENCES pay_catergory (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B51FD67EA FOREIGN KEY (method_category_id) REFERENCES method_catergory (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B2F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE purchase_purchasenotification ADD CONSTRAINT FK_2F1850F0558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase_purchasenotification ADD CONSTRAINT FK_2F1850F0BEBDDF47 FOREIGN KEY (purchasenotification_id) REFERENCES purchase_notification (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE single_payment ADD CONSTRAINT FK_D732994EBF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voice_code ADD CONSTRAINT FK_5AD6174338248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6688C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66126F525E FOREIGN KEY (item_id) REFERENCES item (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E667987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E661F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE subscription_eventuality ADD CONSTRAINT FK_EC3A83759A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EC53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF47294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4A04B4490 FOREIGN KEY (app_shop_id) REFERENCES app_shop (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF41F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF453C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF497F7A934 FOREIGN KEY (offer_img) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D38695F4F1 FOREIGN KEY (pay_method_country_has_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D37294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C9BF92C93 FOREIGN KEY (payment_detail_id) REFERENCES payment_detail (id)');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFB7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE single_free_payment ADD CONSTRAINT FK_F537983C3D8C939E FOREIGN KEY (promo_code) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE single_free_payment ADD CONSTRAINT FK_F537983CBF396750 FOREIGN KEY (id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA77987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA7FDC4C5BD FOREIGN KEY (pais_MPMasUsado_unknown) REFERENCES country (id)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A3392F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A339D0C07AFF FOREIGN KEY (promo_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A77E562B43C FOREIGN KEY (pay_method_provider_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A77584598A3 FOREIGN KEY (operator_id) REFERENCES sms_operator (id)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A771CBED403 FOREIGN KEY (sms_logic_category_id) REFERENCES sms_logic_category (id)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A77788321EB FOREIGN KEY (mobile_text_sing_up_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A776AF9AB15 FOREIGN KEY (legal_text_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE sms ADD CONSTRAINT FK_B0A93A771B4CC096 FOREIGN KEY (check_box_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE sms_has_sms_alias ADD CONSTRAINT FK_E57A022E38A06BE3 FOREIGN KEY (sms_alias_id) REFERENCES sms (id)');
        $this->addSql('ALTER TABLE sms_has_sms_alias ADD CONSTRAINT FK_E57A022EB0A93A77 FOREIGN KEY (sms) REFERENCES sms_alias (id)');
        $this->addSql('ALTER TABLE voice ADD CONSTRAINT FK_E7FB583BE562B43C FOREIGN KEY (pay_method_provider_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A543486861B FOREIGN KEY (pay_method_id) REFERENCES pay_method (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A544CC4A381 FOREIGN KEY (payment_service_category_id) REFERENCES payment_service_category (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54AB85D8E3 FOREIGN KEY (img_icon) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE sms_operator ADD CONSTRAINT FK_B1508680F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE sms_operator ADD CONSTRAINT FK_B1508680AB85D8E3 FOREIGN KEY (img_icon) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD CONSTRAINT FK_4BF4E18CF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD CONSTRAINT FK_4BF4E18C38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD CONSTRAINT FK_4BF4E18C38513191 FOREIGN KEY (pay_method_has_provider_id) REFERENCES pay_method_has_provider (id)');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD CONSTRAINT FK_4BF4E18C85FBA32B FOREIGN KEY (text_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CBF396750 FOREIGN KEY (id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_currencies_available ADD CONSTRAINT FK_D4B46C2BA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE provider_currencies_available ADD CONSTRAINT FK_D4B46C2B38248176 FOREIGN KEY (currency_id) REFERENCES currency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F51FD67EA FOREIGN KEY (method_category_id) REFERENCES method_catergory (id)');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02FCA12280B FOREIGN KEY (pay_category_id) REFERENCES pay_catergory (id)');
        $this->addSql('ALTER TABLE method_catergory ADD CONSTRAINT FK_93E7D4F9868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96638248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C96682F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('ALTER TABLE client_user_notification ADD CONSTRAINT FK_15D3E8D9F55397E8 FOREIGN KEY (client_user_id) REFERENCES client_user (id)');
        $this->addSql('ALTER TABLE client_user ADD CONSTRAINT FK_5C0F152B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455BF396750 FOREIGN KEY (id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_user_has_apps ADD CONSTRAINT FK_DA7B7B31F55397E8 FOREIGN KEY (client_user_id) REFERENCES client_user (id)');
        $this->addSql('ALTER TABLE client_user_has_apps ADD CONSTRAINT FK_DA7B7B317987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_api_credentials ADD CONSTRAINT FK_CAA887097987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations ADD CONSTRAINT FK_B0AA394493CB796C FOREIGN KEY (file_id) REFERENCES lexik_translation_file (id)');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations ADD CONSTRAINT FK_B0AA3944C3C583C9 FOREIGN KEY (trans_unit_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C5414E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C541EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');

        $this->addSql('CREATE TABLE role_admin_category (id VARCHAR(255) NOT NULL, name VARCHAR(75) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_user_has_apps ADD role_admin_category VARCHAR(255) NOT NULL, DROP role');
        $this->addSql('ALTER TABLE client_user_has_apps ADD CONSTRAINT FK_DA7B7B31CDC3E1F9 FOREIGN KEY (role_admin_category) REFERENCES role_admin_category (id)');
        $this->addSql('CREATE INDEX IDX_DA7B7B31FB652DF1 ON client_user_has_apps (role_admin_category)');




    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscription_eventuality_payment DROP FOREIGN KEY FK_CEB04FEBF396750');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B4C3A3BB');
        $this->addSql('ALTER TABLE single_payment DROP FOREIGN KEY FK_D732994EBF396750');
        $this->addSql('ALTER TABLE single_free_payment DROP FOREIGN KEY FK_F537983CBF396750');
        $this->addSql('ALTER TABLE purchase_has_purchase_notification DROP FOREIGN KEY FK_7C35EDE6BEBDDF47');
        $this->addSql('ALTER TABLE purchase_purchasenotification DROP FOREIGN KEY FK_2F1850F0BEBDDF47');
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902C343B13');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C343B13');
        $this->addSql('ALTER TABLE single_free_payment DROP FOREIGN KEY FK_F537983C3D8C939E');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP FOREIGN KEY FK_5961A339D0C07AFF');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151A04B4490');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF4A04B4490');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B015153C674EE');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF453C674EE');
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902E4F8739A');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E4F8739A');
        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C5AC996CC');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D9BF92C93');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D39BF92C93');
        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C9BF92C93');
        $this->addSql('ALTER TABLE subscription_eventuality DROP FOREIGN KEY FK_EC3A83759A1887DC');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151418426BC');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D7987212D');
        $this->addSql('ALTER TABLE purchase_notification DROP FOREIGN KEY FK_7B4E816A7987212D');
        $this->addSql('ALTER TABLE promo_code DROP FOREIGN KEY FK_3D8C939E7987212D');
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A94469027987212D');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D37987212D');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country DROP FOREIGN KEY FK_39DED44C7987212D');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D17987212D');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B7987212D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E667987212D');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7987212D');
        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFB7987212D');
        $this->addSql('ALTER TABLE gamer DROP FOREIGN KEY FK_88241BA77987212D');
        $this->addSql('ALTER TABLE client_user_has_apps DROP FOREIGN KEY FK_DA7B7B317987212D');
        $this->addSql('ALTER TABLE app_api_credentials DROP FOREIGN KEY FK_CAA887097987212D');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE4052FC0CB0F');
        $this->addSql('ALTER TABLE email_gamer_support DROP FOREIGN KEY FK_DE8183A25814BBD1');
        $this->addSql('ALTER TABLE transaction_has_countries_available DROP FOREIGN KEY FK_B59AF40C2FC0CB0F');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available DROP FOREIGN KEY FK_E7BD6D262FC0CB0F');
        $this->addSql('ALTER TABLE transaction_has_providers_available DROP FOREIGN KEY FK_ACE91AB82FC0CB0F');
        $this->addSql('ALTER TABLE transaction_has_articles_available DROP FOREIGN KEY FK_2A8161892FC0CB0F');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B2FC0CB0F');
        $this->addSql('ALTER TABLE purchase_has_purchase_notification DROP FOREIGN KEY FK_7C35EDE6558FBEB9');
        $this->addSql('ALTER TABLE purchase_purchasenotification DROP FOREIGN KEY FK_2F1850F0558FBEB9');
        $this->addSql('ALTER TABLE promo_code DROP FOREIGN KEY FK_3D8C939E7294869C');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B01517294869C');
        $this->addSql('ALTER TABLE article_amount DROP FOREIGN KEY FK_E466E7C27294869C');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D14514C27F');
        $this->addSql('ALTER TABLE transaction_has_articles_available DROP FOREIGN KEY FK_2A8161897294869C');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF47294869C');
        $this->addSql('ALTER TABLE article_has_pmpc DROP FOREIGN KEY FK_F94441D37294869C');
        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C7294869C');
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902E3B5FBBF');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1E3B5FBBF');
        $this->addSql('ALTER TABLE subscription_eventuality_payment DROP FOREIGN KEY FK_CEB04FEE2D97D5D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66126F525E');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DD962B9BF');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3D962B9BF');
        $this->addSql('ALTER TABLE purchase_notification DROP FOREIGN KEY FK_7B4E816AE127364A');
        $this->addSql('ALTER TABLE promo_code DROP FOREIGN KEY FK_3D8C939ED0C07AFF');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6688C5F785');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A544CC4A381');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1D962B9BF');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D2F43A116');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D32F43A116');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D12F43A116');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B2F43A116');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP FOREIGN KEY FK_5961A3392F43A116');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE405BD5C7E60');
        $this->addSql('ALTER TABLE sms_has_sms_alias DROP FOREIGN KEY FK_E57A022E38A06BE3');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP FOREIGN KEY FK_4BF4E18C38513191');
        $this->addSql('ALTER TABLE sms_code DROP FOREIGN KEY FK_CC38ACCE81C6B038');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A77584598A3');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country DROP FOREIGN KEY FK_39DED44C436F2135');
        $this->addSql('ALTER TABLE article_has_pmpc DROP FOREIGN KEY FK_F94441D38695F4F1');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A77E562B43C');
        $this->addSql('ALTER TABLE voice DROP FOREIGN KEY FK_E7FB583BE562B43C');
        $this->addSql('ALTER TABLE sms_has_sms_alias DROP FOREIGN KEY FK_E57A022EB0A93A77');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE405A53A8AA');
        $this->addSql('ALTER TABLE transaction_has_providers_available DROP FOREIGN KEY FK_ACE91AB8A53A8AA');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BA53A8AA');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54A53A8AA');
        $this->addSql('ALTER TABLE provider_currencies_available DROP FOREIGN KEY FK_D4B46C2BA53A8AA');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE4053486861B');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A543486861B');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A771CBED403');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BCA12280B');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02FCA12280B');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available DROP FOREIGN KEY FK_E7BD6D26A31E0FF2');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B51FD67EA');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F51FD67EA');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CBF396750');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455BF396750');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151F92F3E70');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE405F92F3E70');
        $this->addSql('ALTER TABLE article_amount DROP FOREIGN KEY FK_E466E7C2F92F3E70');
        $this->addSql('ALTER TABLE transaction_has_countries_available DROP FOREIGN KEY FK_B59AF40CF92F3E70');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BF92F3E70');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF4F92F3E70');
        $this->addSql('ALTER TABLE gamer DROP FOREIGN KEY FK_88241BA7FDC4C5BD');
        $this->addSql('ALTER TABLE sms_operator DROP FOREIGN KEY FK_B1508680F92F3E70');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP FOREIGN KEY FK_4BF4E18CF92F3E70');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF92F3E70');
        $this->addSql('ALTER TABLE client_user_notification DROP FOREIGN KEY FK_15D3E8D9F55397E8');
        $this->addSql('ALTER TABLE client_user_has_apps DROP FOREIGN KEY FK_DA7B7B31F55397E8');
        $this->addSql('ALTER TABLE app DROP FOREIGN KEY FK_C96E70CF19EB6921');
        $this->addSql('ALTER TABLE client_user DROP FOREIGN KEY FK_5C0F152B19EB6921');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE40582F1BAF4');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D182F1BAF4');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C96682F1BAF4');
        $this->addSql('ALTER TABLE sms_code DROP FOREIGN KEY FK_CC38ACCE38248176');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE40538248176');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B38248176');
        $this->addSql('ALTER TABLE voice_code DROP FOREIGN KEY FK_5AD6174338248176');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP FOREIGN KEY FK_4BF4E18C38248176');
        $this->addSql('ALTER TABLE provider_currencies_available DROP FOREIGN KEY FK_D4B46C2B38248176');
        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C96638248176');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D14A677644');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E868ACD1D');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B01511F68DAF7');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151868ACD1D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E661F68DAF7');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66868ACD1D');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E1F68DAF7');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E868ACD1D');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF41F68DAF7');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF4868ACD1D');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A77788321EB');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A776AF9AB15');
        $this->addSql('ALTER TABLE sms DROP FOREIGN KEY FK_B0A93A771B4CC096');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54868ACD1D');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP FOREIGN KEY FK_4BF4E18C85FBA32B');
        $this->addSql('ALTER TABLE method_catergory DROP FOREIGN KEY FK_93E7D4F9868ACD1D');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations DROP FOREIGN KEY FK_B0AA3944C3C583C9');
        $this->addSql('ALTER TABLE lexik_trans_unit_translations DROP FOREIGN KEY FK_B0AA394493CB796C');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B015197F7A934');
        $this->addSql('ALTER TABLE app DROP FOREIGN KEY FK_C96E70CFE48E9A13');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C53D045F');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EC53D045F');
        $this->addSql('ALTER TABLE offer_programer DROP FOREIGN KEY FK_D513CBF497F7A934');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54AB85D8E3');
        $this->addSql('ALTER TABLE sms_operator DROP FOREIGN KEY FK_B1508680AB85D8E3');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C541EA9FDD75');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C5414E7AF8F');

        $this->addSql('ALTER TABLE client_user_has_apps DROP FOREIGN KEY FK_DA7B7B31CDC3E1F9');
        $this->addSql('ALTER TABLE client_user_has_apps ADD role VARCHAR(45) DEFAULT NULL, DROP role_admin_category');


        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE subscription_eventuality_payment');
        $this->addSql('DROP TABLE purchase_notification');
        $this->addSql('DROP TABLE purchase_has_purchase_notification');
        $this->addSql('DROP TABLE promo_code');
        $this->addSql('DROP TABLE app_shop');
        $this->addSql('DROP TABLE sms_code');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE shop_css');
        $this->addSql('DROP TABLE app_shop_has_articles');
        $this->addSql('DROP TABLE payment_detail');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE email_gamer_support');
        $this->addSql('DROP TABLE article_amount');
        $this->addSql('DROP TABLE app');
        $this->addSql('DROP TABLE app_has_paymethod_provider_country');
        $this->addSql('DROP TABLE `transaction`');
        $this->addSql('DROP TABLE transaction_has_countries_available');
        $this->addSql('DROP TABLE transaction_has_methods_categories_available');
        $this->addSql('DROP TABLE transaction_has_providers_available');
        $this->addSql('DROP TABLE transaction_has_articles_available');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE purchase_purchasenotification');
        $this->addSql('DROP TABLE single_payment');
        $this->addSql('DROP TABLE voice_code');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE level_category');
        $this->addSql('DROP TABLE subscription_eventuality');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE offer_programer');
        $this->addSql('DROP TABLE article_has_pmpc');
        $this->addSql('DROP TABLE payment_status_category');
        $this->addSql('DROP TABLE payment_detail_has_articles');
        $this->addSql('DROP TABLE promo');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE payment_service_category');
        $this->addSql('DROP TABLE single_free_payment');
        $this->addSql('DROP TABLE transaction_status_category');
        $this->addSql('DROP TABLE gamer');
        $this->addSql('DROP TABLE promo_code_used_by_gamer');
        $this->addSql('DROP TABLE sms');
        $this->addSql('DROP TABLE sms_has_sms_alias');
        $this->addSql('DROP TABLE voice');
        $this->addSql('DROP TABLE pay_method_has_provider');
        $this->addSql('DROP TABLE sms_operator');
        $this->addSql('DROP TABLE pay_method_provider_has_country');
        $this->addSql('DROP TABLE sms_alias');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE provider_currencies_available');
        $this->addSql('DROP TABLE pay_method');
        $this->addSql('DROP TABLE sms_logic_category');
        $this->addSql('DROP TABLE pay_catergory');
        $this->addSql('DROP TABLE method_catergory');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE client_user_notification');
        $this->addSql('DROP TABLE client_user');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE client_user_has_apps');
        $this->addSql('DROP TABLE app_api_credentials');
        $this->addSql('DROP TABLE lexik_trans_unit');
        $this->addSql('DROP TABLE lexik_trans_unit_translations');
        $this->addSql('DROP TABLE lexik_translation_file');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('DROP TABLE media__gallery');


        $this->addSql('DROP TABLE role_admin_category');


    }
}
