<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150623185516 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE promo_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency ADD decimal_places INT NOT NULL');
        $this->addSql('ALTER TABLE promo ADD promo_type_id INT DEFAULT NULL, ADD n_uses_per_user INT NOT NULL, ADD n_total_uses INT DEFAULT NULL, ADD count_n_time_used INT NOT NULL, ADD begin_at DATETIME DEFAULT NULL, ADD end_at DATETIME DEFAULT NULL, ADD created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE promo ADD CONSTRAINT FK_B0139AFBCD3834A1 FOREIGN KEY (promo_type_id) REFERENCES promo_type (id)');
        $this->addSql('CREATE INDEX IDX_B0139AFBCD3834A1 ON promo (promo_type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE promo DROP FOREIGN KEY FK_B0139AFBCD3834A1');
        $this->addSql('DROP TABLE promo_type');
        $this->addSql('ALTER TABLE currency DROP decimal_places');
        $this->addSql('DROP INDEX IDX_B0139AFBCD3834A1 ON promo');
        $this->addSql('ALTER TABLE promo DROP promo_type_id, DROP n_uses_per_user, DROP n_total_uses, DROP count_n_time_used, DROP begin_at, DROP end_at, DROP created_at');
    }
}
