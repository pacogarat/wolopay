<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150630131712 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction ADD article_virtual_currency_id VARCHAR(255) DEFAULT NULL, ADD country_virtual_currency_id VARCHAR(2) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C07B6D29 FOREIGN KEY (article_virtual_currency_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1D2638D5D FOREIGN KEY (country_virtual_currency_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_723705D1C07B6D29 ON transaction (article_virtual_currency_id)');
        $this->addSql('CREATE INDEX IDX_723705D1D2638D5D ON transaction (country_virtual_currency_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C07B6D29');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1D2638D5D');
        $this->addSql('DROP INDEX IDX_723705D1C07B6D29 ON transaction');
        $this->addSql('DROP INDEX IDX_723705D1D2638D5D ON transaction');
        $this->addSql('ALTER TABLE transaction DROP article_virtual_currency_id, DROP country_virtual_currency_id');
    }
}
