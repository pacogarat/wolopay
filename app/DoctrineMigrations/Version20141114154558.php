<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141114154558 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql("INSERT INTO `role_admin_category` VALUES ('ROLE_ACCOUNTING','Accounting','2014-11-14 12:48:38'),('ROLE_DEVELOPER','Developer','2014-11-14 12:48:38'),('ROLE_MARKETING','Marketing','2014-11-14 12:48:38'),('ROLE_OWNER','Owner','2014-11-14 12:48:38'),('ROLE_SUPPORT','Support','2014-11-14 12:48:38');");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DELETE FROM role_admin_category');
    }
}
