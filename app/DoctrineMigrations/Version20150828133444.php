<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150828133444 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_has_blacklistedCountries (app_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) NOT NULL, INDEX IDX_2DC22B137987212D (app_id), INDEX IDX_2DC22B13F92F3E70 (country_id), PRIMARY KEY(app_id, country_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_blacklistedCountries ADD CONSTRAINT FK_2DC22B137987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_blacklistedCountries ADD CONSTRAINT FK_2DC22B13F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql("INSERT INTO transaction_status_category (id, `name`, created_at)VALUES(800, 'Blacklisted country', NOW())"); //BLACKLISTED_COUNTRY
        $this->addSql("INSERT INTO country(id,currency_id,language_id,`name`,`order`, created_at, vat, continent_id, cost_of_living, vat_category_id, local_name, utc_offset, utc_dst_offset)VALUES('XZ', 'EUR', 'en', 'LOCALHOST',  'order', NOW(), '0', 'Other', '1', 'none',  'localhost', '+0:00', '+0:00')");
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD tab_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('UPDATE payment_detail_has_articles pda,app_shop_has_articles asha,app_shop ash,app_shop_has_app_tabs ashat,app_tab appt,app_shop_app_tab_has_articles asatha SET pda.tab_name=appt.name WHERE  pda.app_shop_has_article_id = asha.id AND ash.id=asha.app_shop_id AND ashat.app_shop_id=ash.id  AND  appt.id=ashat.app_tab_id AND asatha.appshophasapptab_id=ashat.id AND asatha.article_id=pda.article_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE app_has_blacklistedCountries');
        $this->addSql('DELETE FROM transaction_status_category WHERE id=800');
        $this->addSql('DELETE FROM country WHERE id=XZ');
        $this->addSql('ALTER TABLE payment_detail_has_articles DROP tab_name');
    }
}
