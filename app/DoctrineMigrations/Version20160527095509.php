<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160527095509 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase ADD last_update_at DATETIME NOT NULL, ADD last_updated_at_unix INT NOT NULL');
        $this->addSql('UPDATE purchase npurch LEFT JOIN  purchase parentPurch  ON npurch.extra_cost_from_parent_id=parentPurch.id SET parentPurch.last_update_at  =  npurch.created_at, parentPurch.last_updated_at_unix= npurch.created_at_unix WHERE npurch.extra_cost_from_parent_id IS NOT NULL');
        $this->addSql('UPDATE purchase p SET p.amount_game=p.amount_total, p.amount_provider=0 WHERE p.amount_total<0 AND partial_payment IS NULL');
        $this->addSql('ALTER TABLE purchase CHANGE last_update_at last_update_at DATETIME DEFAULT NULL, CHANGE last_updated_at_unix last_updated_at_unix INT DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase DROP last_update_at, DROP last_updated_at_unix');
        $this->addSql('UPDATE purchase p SET p.amount_game=(p.amount_total, p.amount_provider=0 WHERE p.amount_total<0 AND partial_payment IS NULL');
        $this->addSql('UPDATE purchase p INNER JOIN purchase t2 ON t2.id=p.extra_cost_from_parent_id SET  p.amount_game = -1*(t2.amount_game + t2.amount_wolo), p.amount_provider = -1*t2.amount_provider WHERE p.amount_total<0 AND (p.partial_payment IS NULL)');

    }
}
