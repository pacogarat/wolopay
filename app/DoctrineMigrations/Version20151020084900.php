<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151020084900 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_idc_halloween.less', 'IDC Halloween', now(), '1', '0', '1', '1', '0')");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_cronix_halloween.less', 'Cronix Halloween', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`id`, `css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES (NULL, 'theme_berserk_halloween.less', 'Berserk Halloween', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`id`, `css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES (NULL, 'theme_korner_halloween.less', 'Korner Halloween', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_ragnarok_halloween.less', 'Rangnarok Halloween', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_battle_space.less', 'Battle Space', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`id`, `css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES (NULL, 'theme_battle_space_halloween.less', 'Battler space Halloween', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_berserk_hallowen.less', 'Berserk Halloween', now(), '1', '0', '1', '1', '0');");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }
}
