<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150914103608 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE offer_programmer_has_articles_extra (offerprogrammer_id INT NOT NULL, article_id VARCHAR(255) NOT NULL, INDEX IDX_876CC6ECA57FC357 (offerprogrammer_id), INDEX IDX_876CC6EC7294869C (article_id), PRIMARY KEY(offerprogrammer_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer_programmer_has_articles_extra ADD CONSTRAINT FK_876CC6ECA57FC357 FOREIGN KEY (offerprogrammer_id) REFERENCES offer_programmer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_programmer_has_articles_extra ADD CONSTRAINT FK_876CC6EC7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE offer_programmer_has_articles_extra');
    }
}
