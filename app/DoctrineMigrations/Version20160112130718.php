<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160112130718 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D15F8FBA40');
        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D14514C27F');
        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D1C07B6D29');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D15F8FBA40 FOREIGN KEY (selected_app_tab_id) REFERENCES app_tab (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D14514C27F FOREIGN KEY (selected_article_id) REFERENCES article (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1C07B6D29 FOREIGN KEY (article_virtual_currency_id) REFERENCES article (id) ON DELETE SET NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D14514C27F FOREIGN KEY (selected_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D15F8FBA40 FOREIGN KEY (selected_app_tab_id) REFERENCES app_tab (id)');
    }
}
