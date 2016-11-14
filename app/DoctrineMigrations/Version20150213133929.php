<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150213133929 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD test TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE purchase ADD test TINYINT(1) NOT NULL');
        $this->addSql('
            update purchase
            inner join gamer on (gamer.id = purchase.gamer_id)
            set test=1 where gamer.gamer_external_id like \'DEMO%\';
         ');

        $this->addSql('
            update `transaction`
            inner join gamer on (gamer.id = `transaction`.gamer_id)
            set test=1 where gamer.gamer_external_id like \'DEMO%\';
        ');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase DROP test');
        $this->addSql('ALTER TABLE `transaction` DROP test');
    }
}
