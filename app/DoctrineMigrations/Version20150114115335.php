<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150114115335 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop ADD paymethods_default_order TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD `order` INT NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD paymethods_default_order TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop DROP paymethods_default_order');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP `order`');
        $this->addSql('ALTER TABLE `transaction` DROP paymethods_default_order');
    }
}
