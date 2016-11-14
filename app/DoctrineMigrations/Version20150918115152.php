<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150918115152 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_has_articles_extra (article_source VARCHAR(255) NOT NULL, article_target VARCHAR(255) NOT NULL, INDEX IDX_F8DEDC9B354DE8F3 (article_source), INDEX IDX_F8DEDC9B2CA8B87C (article_target), PRIMARY KEY(article_source, article_target)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_has_articles_extra ADD CONSTRAINT FK_F8DEDC9B354DE8F3 FOREIGN KEY (article_source) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_has_articles_extra ADD CONSTRAINT FK_F8DEDC9B2CA8B87C FOREIGN KEY (article_target) REFERENCES article (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE article_has_articles_extra');
    }
}
