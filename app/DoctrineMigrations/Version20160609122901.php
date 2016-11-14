<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160609122901 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app CHANGE comission_currency_id comission_currency_id VARCHAR(3) DEFAULT \'EUR\' COLLATE utf8_unicode_ci,  CHANGE commission_min commission_min DOUBLE PRECISION DEFAULT \'0.1\', CHANGE commission_max commission_max DOUBLE PRECISION DEFAULT \'0.1\', CHANGE commission_percent commission_percent DOUBLE PRECISION DEFAULT NULL, CHANGE commission_fixed_fee commission_fixed_fee DOUBLE PRECISION DEFAULT \'0.1\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app CHANGE comission_currency_id comission_currency_id VARCHAR(3) DEFAULT NULL, CHANGE commission_min commission_min DOUBLE PRECISION DEFAULT NULL, CHANGE commission_max commission_max DOUBLE PRECISION DEFAULT NULL, CHANGE commission_percent commission_percent DOUBLE PRECISION DEFAULT \'5\', CHANGE commission_fixed_fee commission_fixed_fee DOUBLE PRECISION DEFAULT NULL');
    }

}