<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160609082011 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shop_css ADD has_cart TINYINT(1) NOT NULL, ADD template_layout VARCHAR(50) DEFAULT NULL, ADD template_products VARCHAR(50) DEFAULT NULL, ADD template_pay_methods VARCHAR(50) DEFAULT NULL');
        $this->addSql('
       INSERT INTO `shop_css`
            (
                css_url, name, created_at, active, public, product_rows, pay_method_rows, modular, has_categories, template_layout, template_products, template_pay_methods, has_cart
            )
       VALUES
            (
               "theme_early_access_modular.less", "Early access modular", now(), 1, 1, 1, 1, 1, 0, null, null, null, 0
            );

        ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shop_css DROP has_cart, DROP template_layout, DROP template_products, DROP template_pay_methods');
    }
}
