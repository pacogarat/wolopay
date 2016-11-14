<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150115102836 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `shop_css` (`css_url`, `name`, `created_at`, `active`) VALUES ('theme_ragnarok.less', 'Ragnarok', NOW(), '1');
                ,('theme_korner.less', 'Korner', NOW(), '1'");

        $this->addSql("INSERT INTO `payment_service_category` (`id`) VALUES ('shop.payment.xsolla_subscription_ipn_pay_method')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }
}
