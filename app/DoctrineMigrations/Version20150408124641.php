<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150408124641 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sms ADD active TINYINT(1) NOT NULL');
        $this->addSql('UPDATE sms SET active = 1');

        $this->addSql('ALTER TABLE sms CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method CHANGE active active TINYINT(1) DEFAULT NULL');

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sms DROP active');
    }
}
