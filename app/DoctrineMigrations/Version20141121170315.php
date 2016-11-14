<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141121170315 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE sms_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE sms_code CHANGE name code VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE sms_code ADD PRIMARY KEY (code)');
        $this->addSql('ALTER TABLE voice_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE voice_code CHANGE name code VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE voice_code ADD PRIMARY KEY (code)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE sms_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE sms_code CHANGE code name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE sms_code ADD PRIMARY KEY (name)');
        $this->addSql('ALTER TABLE voice_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE voice_code CHANGE code name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE voice_code ADD PRIMARY KEY (name)');
    }
}
