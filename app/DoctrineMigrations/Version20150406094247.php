<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\ArticleCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150406094247 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151418426BC');
        $this->addSql('ALTER TABLE article_pmpc_has_sms DROP FOREIGN KEY FK_11378A55CE97B6F0');
        $this->addSql('CREATE TABLE ext_translations (id INT AUTO_INCREMENT NOT NULL, locale VARCHAR(8) NOT NULL, object_class VARCHAR(255) NOT NULL, field VARCHAR(32) NOT NULL, foreign_key VARCHAR(64) NOT NULL, content LONGTEXT DEFAULT NULL, INDEX translations_lookup_idx (locale, object_class, foreign_key), UNIQUE INDEX lookup_unique_idx (locale, object_class, field, foreign_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_article_has_pmpc (id INT AUTO_INCREMENT NOT NULL, pay_method_provider_has_country_id INT NOT NULL, app_shop_has_article_id INT NOT NULL, voice_id INT DEFAULT NULL, `order` INT NOT NULL, active TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_C045519D73DBD337 (pay_method_provider_has_country_id), INDEX IDX_C045519D5AC996CC (app_shop_has_article_id), INDEX IDX_C045519D1672336E (voice_id), UNIQUE INDEX ASAHPMPC_UNIQUE_ (pay_method_provider_has_country_id, app_shop_has_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_css_has_apps (shopcss_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, INDEX IDX_C64BE1A72C74E3D6 (shopcss_id), INDEX IDX_C64BE1A77987212D (app_id), PRIMARY KEY(shopcss_id, app_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_has_languages (app_id VARCHAR(255) NOT NULL, language_id VARCHAR(2) NOT NULL, INDEX IDX_1B09FC9A7987212D (app_id), INDEX IDX_1B09FC9A82F1BAF4 (language_id), PRIMARY KEY(app_id, language_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        // manual
//        $this->addSql('INSERT INTO app_shop_article_has_pmpc SELECT * FROM article_has_pmpc');

        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D73DBD337 FOREIGN KEY (pay_method_provider_has_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D1672336E FOREIGN KEY (voice_id) REFERENCES voice (id)');
        $this->addSql('ALTER TABLE shop_css_has_apps ADD CONSTRAINT FK_C64BE1A72C74E3D6 FOREIGN KEY (shopcss_id) REFERENCES shop_css (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shop_css_has_apps ADD CONSTRAINT FK_C64BE1A77987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_languages ADD CONSTRAINT FK_1B09FC9A7987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_languages ADD CONSTRAINT FK_1B09FC9A82F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id) ON DELETE CASCADE');

        $this->addSql('CREATE TABLE app_shop_articles_pmpc_has_sms (appshoparticlehaspmpc_id INT NOT NULL, sms_id INT NOT NULL, INDEX IDX_40F6CF07109AC217 (appshoparticlehaspmpc_id), INDEX IDX_40F6CF07BD5C7E60 (sms_id), PRIMARY KEY(appshoparticlehaspmpc_id, sms_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_shop_articles_pmpc_has_sms ADD CONSTRAINT FK_40F6CF07109AC217 FOREIGN KEY (appshoparticlehaspmpc_id) REFERENCES app_shop_article_has_pmpc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_articles_pmpc_has_sms ADD CONSTRAINT FK_40F6CF07BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id) ON DELETE CASCADE');

//        $this->addSql('CREATE INDEX IDX_11378A55109AC217 ON article_pmpc_has_sms (appshoparticlehaspmpc_id)');
//        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD PRIMARY KEY (appshoparticlehaspmpc_id, sms_id)');
        $this->addSql('ALTER TABLE app_shop ADD active TINYINT(1) NOT NULL');

//        $this->addSql('UPDATE app_shop_has_articles set offer_id = null');
        $this->addSql('DROP TABLE offer');
        $this->addSql('CREATE TABLE offer (app_shop_has_article_id INT NOT NULL, image INT DEFAULT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, offer_programmer_id INT NOT NULL, items_quantity DOUBLE PRECISION DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_29D6873EC53D045F (image), INDEX IDX_29D6873E1F68DAF7 (name_label_id), INDEX IDX_29D6873E868ACD1D (description_label_id), INDEX IDX_29D6873E4449FD4E (offer_programmer_id), PRIMARY KEY(app_shop_has_article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EC53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E4449FD4E FOREIGN KEY (offer_programmer_id) REFERENCES offer_programmer (id)');

//        $this->addSql('DROP INDEX FK_29D6873E5AC996CC ON offer');
        $this->addSql('ALTER TABLE shop_css ADD public TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE country ADD cost_of_living DOUBLE PRECISION NOT NULL DEFAULT 1');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD article_category_id VARCHAR(255) NOT NULL');

        $this->addSql('UPDATE shop_css set public = 1');
        $this->addSql('UPDATE pay_method_has_provider set article_category_id = "'.ArticleCategoryEnum::SINGLE_PAYMENT_ID.'"');

        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A5488C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('CREATE INDEX IDX_4D729A5488C5F785 ON pay_method_has_provider (article_category_id)');
        $this->addSql('DROP INDEX IDX_129B0151418426BC ON app_shop_has_articles');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD amount DOUBLE PRECISION NOT NULL, ADD active TINYINT(1) NOT NULL, DROP article_amount_id');

        // manual
        $this->addSql('UPDATE app_shop_has_articles a set a.amount = (select amount from article_amount a2 where a.country_id = a2.country_id AND a.article_id = a2.article_id)');

        $this->addSql('ALTER TABLE article ADD amount_standard DOUBLE PRECISION DEFAULT NULL, CHANGE number quantity INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD unitary_price_country_id VARCHAR(2) DEFAULT NULL, ADD unitary_price DOUBLE PRECISION DEFAULT NULL, ADD active TINYINT(1) NOT NULL, CHANGE name name VARCHAR(45) DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E8AAAB6A0 FOREIGN KEY (unitary_price_country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E8AAAB6A0 ON item (unitary_price_country_id)');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD items_quantity INT NOT NULL, ADD articles_quantity INT NOT NULL, DROP items_number, DROP quantity');

        // manual
        $this->addSql('UPDATE app_shop_article_has_pmpc SET active=1 ');
        $this->addSql('UPDATE item SET active=1');
        $this->addSql('UPDATE article SET active=1');
        $this->addSql('UPDATE app_shop SET active=1');


        $this->addSql('ALTER TABLE offer_programmer CHANGE number_extra_percent quantity_extra_percent DOUBLE PRECISION DEFAULT NULL');

        $this->addSql('UPDATE country SET cost_of_living = "1.6925189991" WHERE id = "DE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.7908148005" WHERE id = "AR" ');
        $this->addSql('UPDATE country SET cost_of_living = "2.1754499293" WHERE id = "AU" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.491091932"  WHERE id = "BE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3263634789" WHERE id = "BO" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.4518753843" WHERE id = "BR" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.7053545475" WHERE id = "CA" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.581843675" WHERE id = "CL" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.2786262361" WHERE id = "CO" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.5972788856" WHERE id = "CR" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.2531743523" WHERE id = "EC" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.1908321423" WHERE id = "EG" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.2880739832" WHERE id = "SV" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.8002383009" WHERE id = "FI" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.624023388" WHERE id = "FR" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.7091848622" WHERE id = "GR" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3803624197" WHERE id = "GT" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.6594800199" WHERE id = "HN" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3429277317" WHERE id = "IN" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.7948328193" WHERE id = "GB" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3941095831" WHERE id = "IQ" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.7490322226" WHERE id = "IE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3429277317" WHERE id = "IN" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.3023871558" WHERE id = "IT" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.5659514267" WHERE id = "JP" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.6707810376" WHERE id = "MY" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.2801260038" WHERE id = "MA" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.4871938771" WHERE id = "MX" ');
        $this->addSql('UPDATE country SET cost_of_living = "2.2659848603" WHERE id = "NO" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.474346622" WHERE id = "PA" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.4386183946" WHERE id = "PE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.6041097676" WHERE id = "PO" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.8087105025" WHERE id = "PT" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.7623599486" WHERE id = "CZ" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3674909774" WHERE id = "DO" ');
        $this->addSql('UPDATE country SET cost_of_living = "1.2534262647" WHERE id = "SG" ');
        $this->addSql('UPDATE country SET cost_of_living = "2.4205234603" WHERE id = "SE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3596969908" WHERE id = "TW" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.7210876838" WHERE id = "TR" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3080377638" WHERE id = "UA" ');
        $this->addSql('UPDATE country SET cost_of_living = "2.1813578865" WHERE id = "US" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.6089039608" WHERE id = "UY" ');
        $this->addSql('UPDATE country SET cost_of_living = "2.1813578865" WHERE id = "US" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.3665203329" WHERE id = "VE" ');
        $this->addSql('UPDATE country SET cost_of_living = "0.2731572208" WHERE id = "VN" ');

        $this->addSql('ALTER TABLE payment_detail_has_articles ADD offer_programmer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C4449FD4E FOREIGN KEY (offer_programmer_id) REFERENCES offer_programmer (id)');
        $this->addSql('CREATE INDEX IDX_20A0B99C4449FD4E ON payment_detail_has_articles (offer_programmer_id)');

        $this->addSql('ALTER TABLE offer_programmer ADD times_used INT NOT NULL');
        $this->addSql('INSERT INTO `continent`(id,`name`,created_at) VALUES ("other","Other",NOW())');
        $this->addSql('UPDATE country SET continent_id = "other" where id = "DF" ');


        $this->addSql('DROP TABLE article_amount');
        $this->addSql('DROP TABLE article_has_pmpc');
        $this->addSql('DROP TABLE article_pmpc_has_sms');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_pmpc_has_sms DROP FOREIGN KEY FK_11378A55109AC217');
        $this->addSql('CREATE TABLE article_amount (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, country_id VARCHAR(2) NOT NULL COLLATE utf8_unicode_ci, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, amount_owned_currency DOUBLE PRECISION DEFAULT NULL, UNIQUE INDEX AA_UNIQUE_ (article_id, country_id), INDEX IDX_E466E7C27294869C (article_id), INDEX IDX_E466E7C2F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_has_pmpc (id INT AUTO_INCREMENT NOT NULL, voice_id INT DEFAULT NULL, article_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, pay_method_country_has_country_id INT NOT NULL, `order` INT NOT NULL, active TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX AHPMPC_UNIQUE_ (pay_method_country_has_country_id, article_id), INDEX IDX_F94441D38695F4F1 (pay_method_country_has_country_id), INDEX IDX_F94441D37294869C (article_id), INDEX IDX_F94441D31672336E (voice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_amount ADD CONSTRAINT FK_E466E7C27294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_amount ADD CONSTRAINT FK_E466E7C2F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D31672336E FOREIGN KEY (voice_id) REFERENCES voice (id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D37294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D38695F4F1 FOREIGN KEY (pay_method_country_has_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('DROP TABLE ext_translations');
        $this->addSql('DROP TABLE app_shop_article_has_pmpc');
        $this->addSql('DROP TABLE shop_css_has_apps');
        $this->addSql('DROP TABLE app_has_languages');
        $this->addSql('ALTER TABLE app_shop DROP active');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD article_amount_id INT DEFAULT NULL, DROP amount, DROP active');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151418426BC FOREIGN KEY (article_amount_id) REFERENCES article_amount (id)');
        $this->addSql('CREATE INDEX IDX_129B0151418426BC ON app_shop_has_articles (article_amount_id)');
        $this->addSql('ALTER TABLE article DROP amount_standard, CHANGE quantity number INT DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_11378A55109AC217 ON article_pmpc_has_sms');
        $this->addSql('ALTER TABLE article_pmpc_has_sms DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE article_pmpc_has_sms CHANGE appshoparticlehaspmpc_id articlehaspmpc_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD CONSTRAINT FK_11378A55CE97B6F0 FOREIGN KEY (articlehaspmpc_id) REFERENCES article_has_pmpc (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_11378A55CE97B6F0 ON article_pmpc_has_sms (articlehaspmpc_id)');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD PRIMARY KEY (articlehaspmpc_id, sms_id)');
        $this->addSql('ALTER TABLE country DROP cost_of_living');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E8AAAB6A0');
        $this->addSql('DROP INDEX IDX_1F1B251E8AAAB6A0 ON item');
        $this->addSql('ALTER TABLE item DROP unitary_price_country_id, DROP unitary_price, DROP active, CHANGE name name VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE offer DROP INDEX primary, ADD INDEX FK_29D6873E5AC996CC (app_shop_has_article_id)');
        $this->addSql('ALTER TABLE offer CHANGE items_quantity number DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A5488C5F785');
        $this->addSql('DROP INDEX IDX_4D729A5488C5F785 ON pay_method_has_provider');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP article_category_id');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD items_number INT NOT NULL, ADD quantity INT NOT NULL, DROP items_quantity, DROP articles_quantity');
        $this->addSql('ALTER TABLE shop_css DROP public');

        $this->addSql('ALTER TABLE offer_programmer CHANGE quantity_extra_percent number_extra_percent DOUBLE PRECISION DEFAULT NULL');

        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C4449FD4E');
        $this->addSql('DROP INDEX IDX_20A0B99C4449FD4E ON payment_detail_has_articles');
        $this->addSql('ALTER TABLE payment_detail_has_articles DROP offer_programmer_id');

        $this->addSql('ALTER TABLE offer_programmer DROP times_used');
    }
}
