<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160126112831 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles');
        $this->addSql('CREATE UNIQUE INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles (article_id, payment_detail_id, offer_programmer_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles');
        $this->addSql('CREATE UNIQUE INDEX PAYMENT_DET_UNIQUE_ ON payment_detail_has_articles (article_id, payment_detail_id)');
    }
}
