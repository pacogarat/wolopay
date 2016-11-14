<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160125111832 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE item_tab (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, image INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, name_unique VARCHAR(45) DEFAULT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_94F6383E7987212D (app_id), INDEX IDX_94F6383E1F68DAF7 (name_label_id), INDEX IDX_94F6383E868ACD1D (description_label_id), INDEX IDX_94F6383EC53D045F (image), UNIQUE INDEX ITEM_TAB_NAME_UNIQUE (name_unique, app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_detail_article_has_given_articles (id INT AUTO_INCREMENT NOT NULL, payment_detail_has_article_id INT NOT NULL, article_id VARCHAR(255) NOT NULL, remaining_for_user_history LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', gacha_initial_date DATETIME DEFAULT NULL, gacha_step INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FE7FB92EE127364A (payment_detail_has_article_id), INDEX IDX_FE7FB92E7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_has_random_articles (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, possible_article_id VARCHAR(255) NOT NULL, INDEX IDX_C733E0637294869C (article_id), INDEX IDX_C733E06375ED30C0 (possible_article_id), UNIQUE INDEX RAND_HAS_ARTICLE_ (article_id, possible_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_gacha_has_articles (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, possible_article_id VARCHAR(255) NOT NULL, best_article INT DEFAULT NULL, `order` INT NOT NULL, amount_to_give INT NOT NULL, INDEX IDX_210035D87294869C (article_id), INDEX IDX_210035D875ED30C0 (possible_article_id), UNIQUE INDEX GACHA_HAS_ARTICLE_ (article_id, possible_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_has_categories (item_id INT NOT NULL, itemtab_id INT NOT NULL, INDEX IDX_CD5C180F126F525E (item_id), INDEX IDX_CD5C180F2D93646F (itemtab_id), PRIMARY KEY(item_id, itemtab_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_special_type (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_pack_has_articles (id INT AUTO_INCREMENT NOT NULL, article_id VARCHAR(255) NOT NULL, included_article_id VARCHAR(255) NOT NULL, give_n_times INT NOT NULL, give_every_n_days INT DEFAULT NULL, `order` INT DEFAULT NULL, delay_n_days_before_first INT DEFAULT NULL, INDEX IDX_985B230C7294869C (article_id), INDEX IDX_985B230CCD47DBB5 (included_article_id), UNIQUE INDEX PACK_HAS_ARTICLE_ (article_id, included_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_tab ADD CONSTRAINT FK_94F6383E7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE item_tab ADD CONSTRAINT FK_94F6383E1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE item_tab ADD CONSTRAINT FK_94F6383E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE item_tab ADD CONSTRAINT FK_94F6383EC53D045F FOREIGN KEY (image) REFERENCES media__media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE payment_detail_article_has_given_articles ADD CONSTRAINT FK_FE7FB92EE127364A FOREIGN KEY (payment_detail_has_article_id) REFERENCES payment_detail_has_articles (id)');
        $this->addSql('ALTER TABLE payment_detail_article_has_given_articles ADD CONSTRAINT FK_FE7FB92E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_has_random_articles ADD CONSTRAINT FK_C733E0637294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_has_random_articles ADD CONSTRAINT FK_C733E06375ED30C0 FOREIGN KEY (possible_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_gacha_has_articles ADD CONSTRAINT FK_210035D87294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_gacha_has_articles ADD CONSTRAINT FK_210035D875ED30C0 FOREIGN KEY (possible_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE item_has_categories ADD CONSTRAINT FK_CD5C180F126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_has_categories ADD CONSTRAINT FK_CD5C180F2D93646F FOREIGN KEY (itemtab_id) REFERENCES item_tab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_pack_has_articles ADD CONSTRAINT FK_985B230C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_pack_has_articles ADD CONSTRAINT FK_985B230CCD47DBB5 FOREIGN KEY (included_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `transaction` ADD has_cart TINYINT(1) DEFAULT NULL, ADD has_categories TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_tab DROP FOREIGN KEY FK_5D91F0CBC53D045F');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CBC53D045F FOREIGN KEY (image) REFERENCES media__media (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE article ADD hours_to_reset_gacha INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shop_css ADD has_categories TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE purchase_notification ADD payment_detail_article_has_given_article_id INT DEFAULT NULL, ADD number_of_payment_detail_has_article INT NOT NULL, ADD min_delay DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase_notification ADD CONSTRAINT FK_7B4E816A37D424AF FOREIGN KEY (payment_detail_article_has_given_article_id) REFERENCES payment_detail_article_has_given_articles (id)');
        $this->addSql('CREATE INDEX IDX_7B4E816A37D424AF ON purchase_notification (payment_detail_article_has_given_article_id)');
        $this->addSql('ALTER TABLE app_shop ADD has_cart TINYINT(1) DEFAULT NULL, ADD has_categories TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD special_type_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E1D40D006 FOREIGN KEY (special_type_id) REFERENCES article_special_type (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E1D40D006 ON item (special_type_id)');

        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`, `has_categories`) VALUES ('theme_berserk_modular.less', 'Berserk modular', now(), '1', '0', '1', '1', '1', '1');");
        $this->addSql("
          INSERT INTO `article_special_type` VALUES ('gacha_box','gacha box',now()),('gacha_step','gacha step',now()),('pack','pack',now())
        ");

        $this->addSql("UPDATE `pay_method_has_provider` set active = 0 WHERE payment_service_category_id = '".PaymentServiceCategoryEnum::NVIA_PROMO_CODE."'");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE item_has_categories DROP FOREIGN KEY FK_CD5C180F2D93646F');
        $this->addSql('ALTER TABLE purchase_notification DROP FOREIGN KEY FK_7B4E816A37D424AF');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E1D40D006');
        $this->addSql('DROP TABLE item_tab');
        $this->addSql('DROP TABLE payment_detail_article_has_given_articles');
        $this->addSql('DROP TABLE article_has_random_articles');
        $this->addSql('DROP TABLE article_gacha_has_articles');
        $this->addSql('DROP TABLE item_has_categories');
        $this->addSql('DROP TABLE article_special_type');
        $this->addSql('DROP TABLE article_pack_has_articles');
        $this->addSql('ALTER TABLE app_shop DROP has_cart, DROP has_categories');
        $this->addSql('ALTER TABLE app_tab DROP FOREIGN KEY FK_5D91F0CBC53D045F');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CBC53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE article DROP hours_to_reset_gacha');
        $this->addSql('DROP INDEX idx_5c0f152b82f1baf4 ON client_user');
        $this->addSql('CREATE INDEX FK_5C0F152B82F1BAF4 ON client_user (language_id)');
        $this->addSql('DROP INDEX IDX_1F1B251E1D40D006 ON item');
        $this->addSql('ALTER TABLE item DROP special_type_id');
        $this->addSql('DROP INDEX IDX_7B4E816A37D424AF ON purchase_notification');
        $this->addSql('ALTER TABLE purchase_notification DROP payment_detail_article_has_given_article_id, DROP number_of_payment_detail_has_article, DROP min_delay');
        $this->addSql('ALTER TABLE shop_css DROP has_categories');
        $this->addSql('ALTER TABLE `transaction` DROP has_cart, DROP has_categories');
    }
}
