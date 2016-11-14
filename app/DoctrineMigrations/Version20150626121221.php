<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150626121221 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE level_category ADD app_id VARCHAR(255) DEFAULT NULL, ADD is_generic TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE level_category ADD CONSTRAINT FK_8BE5BC117987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('CREATE INDEX IDX_8BE5BC117987212D ON level_category (app_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE level_category DROP FOREIGN KEY FK_8BE5BC117987212D');
        $this->addSql('DROP INDEX IDX_8BE5BC117987212D ON level_category');
        $this->addSql('ALTER TABLE level_category DROP app_id, DROP is_generic');
    }
}
