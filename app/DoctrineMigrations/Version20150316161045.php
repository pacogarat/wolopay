<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150316161045 extends AbstractMigration
{

    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE continent (id VARCHAR(50) NOT NULL, name VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('CREATE TABLE offer_programmer (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, offer_img INT DEFAULT NULL, name VARCHAR(200) NOT NULL, offer_from DATETIME DEFAULT NULL, offer_to DATETIME DEFAULT NULL, local_time TINYINT(1) NOT NULL, limit_purchases INT DEFAULT NULL, limit_per_user INT DEFAULT NULL, pretty_price TINYINT(1) DEFAULT NULL, number_extra_percent DOUBLE PRECISION DEFAULT NULL, amount_percent_discount DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_DD9C0F7D7987212D (app_id), INDEX IDX_DD9C0F7D1F68DAF7 (name_label_id), INDEX IDX_DD9C0F7D868ACD1D (description_label_id), INDEX IDX_DD9C0F7D97F7A934 (offer_img), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_programmer_has_articles (offerprogrammer_id INT NOT NULL, article_id VARCHAR(255) NOT NULL, INDEX IDX_24E4D14A57FC357 (offerprogrammer_id), INDEX IDX_24E4D147294869C (article_id), PRIMARY KEY(offerprogrammer_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_programmer_has_countries (offerprogrammer_id INT NOT NULL, country_id VARCHAR(2) NOT NULL, INDEX IDX_46845C6A57FC357 (offerprogrammer_id), INDEX IDX_46845C6F92F3E70 (country_id), PRIMARY KEY(offerprogrammer_id, country_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_programmer_has_app_shops (offerprogrammer_id INT NOT NULL, appshop_id INT NOT NULL, INDEX IDX_ACA74425A57FC357 (offerprogrammer_id), INDEX IDX_ACA7442551264EDE (appshop_id), PRIMARY KEY(offerprogrammer_id, appshop_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_programmer ADD CONSTRAINT FK_DD9C0F7D7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE offer_programmer ADD CONSTRAINT FK_DD9C0F7D1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programmer ADD CONSTRAINT FK_DD9C0F7D868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programmer ADD CONSTRAINT FK_DD9C0F7D97F7A934 FOREIGN KEY (offer_img) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE offer_programmer_has_articles ADD CONSTRAINT FK_24E4D14A57FC357 FOREIGN KEY (offerprogrammer_id) REFERENCES offer_programmer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_articles ADD CONSTRAINT FK_24E4D147294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_countries ADD CONSTRAINT FK_46845C6A57FC357 FOREIGN KEY (offerprogrammer_id) REFERENCES offer_programmer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_countries ADD CONSTRAINT FK_46845C6F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_app_shops ADD CONSTRAINT FK_ACA74425A57FC357 FOREIGN KEY (offerprogrammer_id) REFERENCES offer_programmer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_app_shops ADD CONSTRAINT FK_ACA7442551264EDE FOREIGN KEY (appshop_id) REFERENCES app_shop (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE offer_programer');
        $this->addSql('ALTER TABLE country ADD continent_id VARCHAR(50) NOT NULL');

        $this->addSql('
        insert into continent values
        ("europe", "Europe", NOW()),
        ("africa", "Africa", NOW()),
        ("asia", "Asia", NOW()),
        ("north_america", "North America", NOW()),
        ("south_america", "South America", NOW()),
        ("australia", "Australia", NOW());

        update country set continent_id = "europe" where code >199 AND code <300;
        update country set continent_id = "south_america" where code >699 AND code <800;
        update country set continent_id = "north_america" where code >299 AND code <400;
        update country set continent_id = "asia" where code >399 AND code <500;
        update country set continent_id = "australia" where code >499 AND code <600;
        update country set continent_id = "europe" where continent_id is null OR continent_id = "" ;

        ');

        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B015197F7A934');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B015153C674EE');
        $this->addSql('delete from offer');
        $this->addSql('ALTER TABLE offer ADD app_shop_has_article_id INT NOT NULL, ADD image INT DEFAULT NULL, ADD name_label_id INT DEFAULT NULL, ADD offer_programmer_id INT NOT NULL, ADD number DOUBLE PRECISION DEFAULT NULL, ADD amount DOUBLE PRECISION NOT NULL, ADD created_at DATETIME NOT NULL, DROP id, DROP name, DROP photo_url, DROP multiply_number, DROP percent_discount, DROP price_discount');
        $this->addSql('ALTER TABLE offer ADD PRIMARY KEY (app_shop_has_article_id)');
        $this->addSql('ALTER TABLE offer DROP PRIMARY KEY');

        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EC53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E4449FD4E FOREIGN KEY (offer_programmer_id) REFERENCES offer_programmer (id)');
        $this->addSql('CREATE INDEX IDX_29D6873EC53D045F ON offer (image)');
        $this->addSql('CREATE INDEX IDX_29D6873E1F68DAF7 ON offer (name_label_id)');
        $this->addSql('CREATE INDEX IDX_29D6873E4449FD4E ON offer (offer_programmer_id)');


        $this->addSql('DROP INDEX IDX_129B015153C674EE ON app_shop_has_articles');
        $this->addSql('DROP INDEX IDX_129B015197F7A934 ON app_shop_has_articles');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD image INT DEFAULT NULL, DROP offer_img, DROP offer_id');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B0151C53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_129B0151C53D045F ON app_shop_has_articles (image)');

        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966921F4C77 FOREIGN KEY (continent_id) REFERENCES continent (id)');
        $this->addSql('CREATE INDEX IDX_5373C966921F4C77 ON country (continent_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966921F4C77');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E4449FD4E');
        $this->addSql('ALTER TABLE offer_programmer_has_articles DROP FOREIGN KEY FK_24E4D14A57FC357');
        $this->addSql('ALTER TABLE offer_programmer_has_countries DROP FOREIGN KEY FK_46845C6A57FC357');
        $this->addSql('ALTER TABLE offer_programmer_has_app_shops DROP FOREIGN KEY FK_ACA74425A57FC357');
        $this->addSql('CREATE TABLE offer_programer (id INT AUTO_INCREMENT NOT NULL, offer_img INT DEFAULT NULL, name_label_id INT DEFAULT NULL, offer_id INT NOT NULL, article_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description_label_id INT DEFAULT NULL, app_shop_id INT DEFAULT NULL, country_id VARCHAR(2) DEFAULT NULL COLLATE utf8_unicode_ci, offer_from DATETIME DEFAULT NULL, offer_to DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX OFFER_PROGRAMER_UNIQUE_ (article_id, app_shop_id, country_id), INDEX IDX_D513CBF47294869C (article_id), INDEX IDX_D513CBF4F92F3E70 (country_id), INDEX IDX_D513CBF4A04B4490 (app_shop_id), INDEX IDX_D513CBF41F68DAF7 (name_label_id), INDEX IDX_D513CBF4868ACD1D (description_label_id), INDEX IDX_D513CBF453C674EE (offer_id), INDEX IDX_D513CBF497F7A934 (offer_img), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF497F7A934 FOREIGN KEY (offer_img) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF41F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF453C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF47294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4A04B4490 FOREIGN KEY (app_shop_id) REFERENCES app_shop (id)');
        $this->addSql('ALTER TABLE offer_programer ADD CONSTRAINT FK_D513CBF4F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('DROP TABLE continent');
        $this->addSql('DROP TABLE offer_programmer');
        $this->addSql('DROP TABLE offer_programmer_has_articles');
        $this->addSql('DROP TABLE offer_programmer_has_countries');
        $this->addSql('DROP TABLE offer_programmer_has_app_shops');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B0151C53D045F');
        $this->addSql('DROP INDEX IDX_129B0151C53D045F ON app_shop_has_articles');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD offer_id INT DEFAULT NULL, CHANGE image offer_img INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B015197F7A934 FOREIGN KEY (offer_img) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B015153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('CREATE INDEX IDX_129B015153C674EE ON app_shop_has_articles (offer_id)');
        $this->addSql('CREATE INDEX IDX_129B015197F7A934 ON app_shop_has_articles (offer_img)');
        $this->addSql('DROP INDEX IDX_5373C966921F4C77 ON country');
        $this->addSql('ALTER TABLE country DROP continent_id');
        $this->addSql('DROP INDEX IDX_29D6873EC53D045F ON offer');
        $this->addSql('DROP INDEX IDX_29D6873E1F68DAF7 ON offer');
        $this->addSql('DROP INDEX IDX_29D6873E4449FD4E ON offer');
        $this->addSql('ALTER TABLE offer DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE offer ADD id INT AUTO_INCREMENT NOT NULL, ADD name VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci, ADD photo_url VARCHAR(75) DEFAULT NULL COLLATE utf8_unicode_ci, ADD percent_discount DOUBLE PRECISION DEFAULT NULL, ADD price_discount DOUBLE PRECISION DEFAULT NULL, DROP app_shop_has_article_id, DROP image, DROP name_label_id, DROP offer_programmer_id, DROP amount, DROP created_at, CHANGE number multiply_number DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD PRIMARY KEY (id)');
    }
}
