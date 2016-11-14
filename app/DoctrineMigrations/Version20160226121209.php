<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160226121209 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C5AC996CC');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE payment_detail_has_articles DROP FOREIGN KEY FK_20A0B99C5AC996CC');
        $this->addSql('ALTER TABLE payment_detail_has_articles ADD CONSTRAINT FK_20A0B99C5AC996CC FOREIGN KEY (app_shop_has_article_id) REFERENCES app_shop_has_articles (id)');
    }
}
