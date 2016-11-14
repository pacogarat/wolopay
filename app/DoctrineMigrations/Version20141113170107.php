<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141113170107 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE is_iframe is_iframe TINYINT(1) DEFAULT NULL, CHANGE is_ajax is_ajax TINYINT(1) DEFAULT NULL');
        $this->addSql('insert into shop_css values (null, "theme_torofun.less","Torofun", now())');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE is_iframe is_iframe TINYINT(1) NOT NULL, CHANGE is_ajax is_ajax TINYINT(1) NOT NULL');
        $this->addSql('delete from shop_css where css_url = "theme_torofun.less"');
    }
}
