<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160714102128 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`, `has_categories`, `has_cart`, `template_layout`, `template_products`, `template_pay_methods`, `products_img_format`, `pay_methods_img_format`) VALUES ('theme_early_access_wom_modular.less','Early Access WOM Modular', NOW(),'1','1','1','1','1','0','0',NULL,'early_access_wom_products_list.html',NULL,'_shop_tooltip',NULL)");
        $this->addSql('CREATE TABLE client_api_credential (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, code_key VARCHAR(45) NOT NULL, secret_key VARCHAR(100) NOT NULL, server_key VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E31623D519EB6921 (client_id), UNIQUE INDEX CLIENT_API_CREDENTIALS_UNIQUE_ (code_key), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD gamer_ip VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE gamer ADD registration_date_in_game DATETIME DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client_api_credential');
        $this->addSql('ALTER TABLE `transaction` DROP gamer_ip');
        $this->addSql('ALTER TABLE gamer DROP registration_date_in_game');
    }
}
