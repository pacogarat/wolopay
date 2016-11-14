<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150910080809 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE app_has_blacklistedCountries');
        $this->addSql('CREATE TABLE app_has_blacklisted_countries (app_id VARCHAR(255) NOT NULL, country_id VARCHAR(2) NOT NULL, INDEX IDX_730E732B7987212D (app_id), INDEX IDX_730E732BF92F3E70 (country_id), PRIMARY KEY(app_id, country_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_blacklisted_countries ADD CONSTRAINT FK_730E732B7987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_blacklisted_countries ADD CONSTRAINT FK_730E732BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app ADD blacklisted_ips LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE gamer ADD blacklisted TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('DROP TABLE app_has_blacklisted_countries');
        $this->addSql('ALTER TABLE app DROP blacklisted_ips');
        $this->addSql('ALTER TABLE gamer DROP blacklisted');
    }
}
