<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151126154900 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_idc_black_friday.less', 'IDC Black Friday', now(), '1', '0', '1', '1', '0')");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_cronix_black_friday.less', 'Cronix Black Friday', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`id`, `css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES (NULL, 'theme_berserk_black_friday.less', 'Berserk Black Friday', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`id`, `css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES (NULL, 'theme_korner_black_friday.less', 'Korner Black Friday', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_ragnarok_black_friday.less', 'Ragnarok Black Friday', now(), '1', '0', '1', '1', '0');");
        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`, `public`, `product_rows`, `pay_method_rows`, `modular`) VALUES ('theme_battle_space_black_friday.less', 'Battle Space Black Friday', now(), '1', '0', '1', '1', '0');");
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
