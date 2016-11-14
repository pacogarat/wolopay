<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160722070852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("UPDATE  `payment_service_category` set `name` ='SteamWeb' WHERE id = 'shop.payment.steam_web_ipn_pay_method'");
        $this->addSql("INSERT into `payment_service_category` (`id`, `name`, `created_at`) values('shop.payment.steam_client_ipn_pay_method','Steam',NOW())");
        $this->addSql('ALTER TABLE pay_method_has_provider ADD is_server2server TINYINT(1) DEFAULT NULL');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pay_method_has_provider DROP is_server2server');

    }
}
