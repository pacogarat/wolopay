<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150812140701 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country ADD local_name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE language ADD local_name VARCHAR(55) NOT NULL');
        $this->addSql('ALTER TABLE country ADD utc_offset VARCHAR(100) DEFAULT NULL, ADD utc_dst_offset VARCHAR(100) DEFAULT NULL, CHANGE local_name local_name VARCHAR(55) DEFAULT NULL');
        $this->addSql('ALTER TABLE language CHANGE local_name local_name VARCHAR(55) DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP local_name');
        $this->addSql('ALTER TABLE language DROP local_name');
        $this->addSql('ALTER TABLE country DROP utc_offset, DROP utc_dst_offset, CHANGE local_name local_name VARCHAR(45) NOT NULL');
        $this->addSql('ALTER TABLE language CHANGE local_name local_name VARCHAR(55) NOT NULL');
    }
}
