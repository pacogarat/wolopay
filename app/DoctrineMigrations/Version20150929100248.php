<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150929100248 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gamer ADD birthdate DATETIME DEFAULT NULL, ADD gender INT DEFAULT NULL, CHANGE external_publisher_id external_affiliate_id VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE gamer ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('CREATE TABLE affiliate (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, affiliate_id VARCHAR(255) NOT NULL, name VARCHAR(100) DEFAULT NULL, has_paymethod TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_597AA5CF19EB6921 (client_id), UNIQUE INDEX AFFILIATE_UNIQUE_ (affiliate_id, client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE TABLE affiliate_has_pmp (affiliate_id INT NOT NULL, paymethodhasprovider_id INT NOT NULL, INDEX IDX_42C1435C9F12C49A (affiliate_id), INDEX IDX_42C1435C98F3A1A (paymethodhasprovider_id), PRIMARY KEY(affiliate_id, paymethodhasprovider_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE affiliate_has_pmp ADD CONSTRAINT FK_42C1435C9F12C49A FOREIGN KEY (affiliate_id) REFERENCES affiliate (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE affiliate_has_pmp ADD CONSTRAINT FK_42C1435C98F3A1A FOREIGN KEY (paymethodhasprovider_id) REFERENCES pay_method_has_provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app ADD url_notification_new_gamer VARCHAR(255) DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE gamer DROP birthdate, DROP gender, CHANGE external_affiliate_id external_publisher_id VARCHAR(200) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE gamer DROP updated_at');
        $this->addSql('DROP TABLE affiliate');
        $this->addSql('DROP TABLE affiliate_has_pmp');
        $this->addSql('ALTER TABLE app DROP url_notification_new_gamer');
    }
}
