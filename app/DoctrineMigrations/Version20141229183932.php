<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141229183932 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE purchase_purchasenotification');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE purchase_purchasenotification (purchase_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, purchasenotification_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_2F1850F0558FBEB9 (purchase_id), INDEX IDX_2F1850F0BEBDDF47 (purchasenotification_id), PRIMARY KEY(purchase_id, purchasenotification_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE purchase_purchasenotification ADD CONSTRAINT FK_2F1850F0558FBEB9 FOREIGN KEY (purchase_id) REFERENCES purchase (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase_purchasenotification ADD CONSTRAINT FK_2F1850F0BEBDDF47 FOREIGN KEY (purchasenotification_id) REFERENCES purchase_notification (id) ON DELETE CASCADE');
    }
}
