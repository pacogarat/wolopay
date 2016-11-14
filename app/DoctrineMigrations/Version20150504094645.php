<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150504094645 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop CHANGE level_category_id level_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_detail ADD extra_data LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE transaction CHANGE level_category_id level_category_id INT DEFAULT NULL, CHANGE shop_css_id shop_css_id INT DEFAULT NULL, CHANGE fixed_country fixed_country TINYINT(1) DEFAULT NULL, CHANGE value_current value_current INT DEFAULT NULL, CHANGE value_lower value_lower INT DEFAULT NULL, CHANGE value_higher value_higher INT DEFAULT NULL');
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('".PaymentServiceCategoryEnum::NETELLER_IPN."','Neteller single', NOW())");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop CHANGE level_category_id level_category_id INT NOT NULL');
        $this->addSql('ALTER TABLE payment_detail DROP extra_data');
        $this->addSql('ALTER TABLE transaction CHANGE level_category_id level_category_id INT NOT NULL, CHANGE shop_css_id shop_css_id INT NOT NULL, CHANGE fixed_country fixed_country TINYINT(1) NOT NULL, CHANGE value_current value_current INT NOT NULL, CHANGE value_lower value_lower INT NOT NULL, CHANGE value_higher value_higher INT NOT NULL');
    }
}
