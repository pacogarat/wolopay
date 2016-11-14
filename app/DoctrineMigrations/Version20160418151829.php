<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160418151829 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop_articles_pmpc_has_sms DROP FOREIGN KEY FK_40F6CF07109AC217');
        $this->addSql('CREATE TABLE app_shop_articles_has_sms (appshophasarticle_id INT NOT NULL, sms_id INT NOT NULL, INDEX IDX_F80D1362646C24E0 (appshophasarticle_id), INDEX IDX_F80D1362BD5C7E60 (sms_id), PRIMARY KEY(appshophasarticle_id, sms_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_articles_has_voices (appshophasarticle_id INT NOT NULL, voice_id INT NOT NULL, INDEX IDX_25F244BE646C24E0 (appshophasarticle_id), INDEX IDX_25F244BE1672336E (voice_id), PRIMARY KEY(appshophasarticle_id, voice_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_shop_articles_has_sms ADD CONSTRAINT FK_F80D1362646C24E0 FOREIGN KEY (appshophasarticle_id) REFERENCES app_shop_has_articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_articles_has_sms ADD CONSTRAINT FK_F80D1362BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_articles_has_voices ADD CONSTRAINT FK_25F244BE646C24E0 FOREIGN KEY (appshophasarticle_id) REFERENCES app_shop_has_articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_articles_has_voices ADD CONSTRAINT FK_25F244BE1672336E FOREIGN KEY (voice_id) REFERENCES voice (id) ON DELETE CASCADE');

        // ADD SMS
        $this->addSql("
            Insert app_shop_articles_has_sms (appshophasarticle_id, sms_id)
            SELECT  asahpmpc.app_shop_has_article_id, asahpmpcsms.sms_id
            FROM app_shop_article_has_pmpc asahpmpc
            inner join app_shop_articles_pmpc_has_sms asahpmpcsms on  (asahpmpc.id = asahpmpcsms.appshoparticlehaspmpc_id)
        ");

        // ADD VOICE
        $this->addSql("
            Insert app_shop_articles_has_voices (appshophasarticle_id, voice_id)
            SELECT  app_shop_has_article_id, voice_id
            FROM app_shop_article_has_pmpc asahpmpc
            WHERE voice_id IS NOT NULL
        ");

        $this->addSql('DROP TABLE app_shop_article_has_pmpc');
        $this->addSql('DROP TABLE app_shop_articles_pmpc_has_sms');
        $this->addSql('ALTER TABLE app ADD pay_methods_max_fee_provider_percent DOUBLE PRECISION DEFAULT NULL, ADD pretty_price_is_enabled TINYINT(1) DEFAULT NULL, ADD cost_of_live_is_enabled TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_shop_article_has_pmpc (id INT AUTO_INCREMENT NOT NULL, pay_method_provider_has_country_id INT NOT NULL, voice_id INT DEFAULT NULL, app_shop_has_article_id INT NOT NULL, `order` INT NOT NULL, active TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX ASAHPMPC_UNIQUE_ (pay_method_provider_has_country_id, app_shop_has_article_id), INDEX IDX_C045519D73DBD337 (pay_method_provider_has_country_id), INDEX IDX_C045519D5AC996CC (app_shop_has_article_id), INDEX IDX_C045519D1672336E (voice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_articles_pmpc_has_sms (appshoparticlehaspmpc_id INT NOT NULL, sms_id INT NOT NULL, INDEX IDX_40F6CF07109AC217 (appshoparticlehaspmpc_id), INDEX IDX_40F6CF07BD5C7E60 (sms_id), PRIMARY KEY(appshoparticlehaspmpc_id, sms_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D73DBD337 FOREIGN KEY (pay_method_provider_has_country_id) REFERENCES pay_method_provider_has_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D1672336E FOREIGN KEY (voice_id) REFERENCES voice (id)');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
        $this->addSql('ALTER TABLE app_shop_articles_pmpc_has_sms ADD CONSTRAINT FK_40F6CF07BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_articles_pmpc_has_sms ADD CONSTRAINT FK_40F6CF07109AC217 FOREIGN KEY (appshoparticlehaspmpc_id) REFERENCES app_shop_article_has_pmpc (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE app_shop_articles_has_sms');
        $this->addSql('DROP TABLE app_shop_articles_has_voices');
        $this->addSql('ALTER TABLE app DROP pay_methods_max_fee_provider_percent, DROP pretty_price_is_enabled, DROP cost_of_live_is_enabled');
    }
}
