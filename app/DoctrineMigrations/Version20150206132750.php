<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150206132750 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_DOTPAY_IPN."','Xsolla dotpay',now())");
//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_3PAY_IPN."','Xsolla 3pay',now())");
//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_DURMALIRA_IPN."','Xsolla durma lira',now())");
//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_MANGIR_KART_IPN."','Xsolla mangir kart',now())");
//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_PAYBYME_IPN."','Xsolla pay by me',now())");
//        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::XSOLLA_WEBMONEY_IPN."','Xsolla Web money',now())");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }
}
