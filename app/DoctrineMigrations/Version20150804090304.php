<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\CountryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150804090304 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("
          INSERT INTO `country`
                (`id`,
                `vat_category_id`,
                `currency_id`,
                `continent_id`,
                `language_id`,
                `name`,
                `code`,
                `order`,
                `vat`,
                `cost_of_living`,
                `time_zone`,
                `created_at`
                )

          VALUES
          ('XA','none','USD','other','en','Other',-1,9999,51,1,NULL,'2015-08-04 14:16:18'),
          ('XB','vat_from_buyer_country','EUR','europe','en','Europe', 200,999,21,1,'Europe/Berlin','2015-08-04 14:16:18'),
          ('XD','none','USD','australia','en','Australia',500,9999,12,1,'Australia/Sydney','2015-08-04 14:16:18'),
          ('XE','none','USD','north_america','en','North America',300,999,21,1,'America/New_York','2015-08-04 14:16:18'),
          ('XF','none','USD','asia','en','Asia',499,999,21,1,'Asia/Singapore','2015-08-04 14:16:18'),
          ('ZW','none','USD','africa','en','Zimbabwe',600,1,21,0.5,'Africa/Nairobi','2015-08-04 14:16:18');
        ");

        $this->addSql("update purchase set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");

        $this->addSql("update transaction set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
//        $this->addSql("update transaction set custom_country_id = '".CountryEnum::OTHER."' WHERE custom_country_id = 'DF' ");
        $this->addSql("update transaction set country_detected_id = '".CountryEnum::OTHER."' WHERE country_detected_id = 'DF' ");
        $this->addSql("update transaction set country_virtual_currency_id = '".CountryEnum::OTHER."' WHERE country_virtual_currency_id = 'DF' ");
        $this->addSql("update transaction_has_countries_available set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");

        $this->addSql("update transaction_temp set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
//        $this->addSql("update transaction_temp set custom_country = '".CountryEnum::OTHER."' WHERE custom_country = 'DF' ");

        $this->addSql("update app_shop_has_articles set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update pay_method_provider_has_country set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update payment_detail set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update app_has_countries set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update company set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
//        $this->addSql("update provider set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update item set unitary_price_country_id = '".CountryEnum::OTHER."' WHERE unitary_price_country_id = 'DF' ");
        $this->addSql("update offer_programmer_has_countries set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");
        $this->addSql("update sms_operator set country_id = '".CountryEnum::OTHER."' WHERE country_id = 'DF' ");

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1F92F3E70');
        $this->addSql('DROP INDEX IDX_723705D1F92F3E70 ON transaction');
        $this->addSql('ALTER TABLE transaction CHANGE country_id custom_country_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C6D002DA FOREIGN KEY (custom_country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_723705D1C6D002DA ON transaction (custom_country_id)');
        $this->addSql('ALTER TABLE transaction_temp DROP FOREIGN KEY FK_E910BB6BF92F3E70');
        $this->addSql('DROP INDEX IDX_E910BB6BF92F3E70 ON transaction_temp');
        $this->addSql('ALTER TABLE transaction_temp CHANGE country_id custom_country_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6BC6D002DA FOREIGN KEY (custom_country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_E910BB6BC6D002DA ON transaction_temp (custom_country_id)');
        $this->addSql('ALTER TABLE provider CHANGE active active TINYINT(1) NOT NULL');

        $this->addSql('DELETE from country WHERE id = "DF"');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE provider CHANGE active active TINYINT(1) DEFAULT \'1\' NOT NULL');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C6D002DA');
        $this->addSql('DROP INDEX IDX_723705D1C6D002DA ON transaction');
        $this->addSql('ALTER TABLE transaction CHANGE custom_country_id country_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_723705D1F92F3E70 ON transaction (country_id)');
        $this->addSql('ALTER TABLE transaction_temp DROP FOREIGN KEY FK_E910BB6BC6D002DA');
        $this->addSql('DROP INDEX IDX_E910BB6BC6D002DA ON transaction_temp');
        $this->addSql('ALTER TABLE transaction_temp CHANGE custom_country_id country_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction_temp ADD CONSTRAINT FK_E910BB6BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_E910BB6BF92F3E70 ON transaction_temp (country_id)');
    }
}
