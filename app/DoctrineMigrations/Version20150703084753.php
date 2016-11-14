<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150703084753 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_notification ADD has_only_one_attempt TINYINT(1) DEFAULT NULL, ADD cancel_payment_if_notification_fail TINYINT(1) DEFAULT NULL, ADD is_async TINYINT(1) DEFAULT NULL');
        $this->addSql('UPDATE purchase_notification set is_async = 1 ');
        $this->addSql('ALTER TABLE country ADD time_zone VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer_programmer ADD offset INT DEFAULT NULL');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP time_zone');
        $this->addSql('ALTER TABLE offer_programmer DROP offset');
        $this->addSql('ALTER TABLE purchase_notification DROP has_only_one_attempt, DROP cancel_payment_if_notification_fail, DROP is_async');
    }
}
