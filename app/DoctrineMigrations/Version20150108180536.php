<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150108180536 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country ADD vat DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE sms_operator CHANGE short_name short_name VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD vat DOUBLE PRECISION NOT NULL');

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(true, 'cant revert');
    }
}
