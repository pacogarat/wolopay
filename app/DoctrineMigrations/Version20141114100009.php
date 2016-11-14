<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141114100009 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql("INSERT INTO `transaction_status_category` VALUES (1,'Begin','2014-11-13 17:09:50'),(25,'Shopping','2014-11-13 17:09:50'),(50,'Processing Payment','2014-11-13 17:09:50'),(100,'Pending Payment','2014-11-13 17:09:50'),(200,'Completed','2014-11-13 17:09:50'),(500,'Failed','2014-11-13 17:09:50'),(1000,'Expired','2014-11-13 17:09:50');");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DELETE FROM `transaction_status_category`');
    }
}
