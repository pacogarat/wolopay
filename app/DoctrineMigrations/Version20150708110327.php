<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150708110327 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article ADD description_short_label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6643D1D1F FOREIGN KEY (description_short_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6643D1D1F ON article (description_short_label_id)');
        $this->addSql('ALTER TABLE offer ADD description_short_label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E43D1D1F FOREIGN KEY (description_short_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E43D1D1F ON offer (description_short_label_id)');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD description_short_label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_shop_has_articles ADD CONSTRAINT FK_129B015143D1D1F FOREIGN KEY (description_short_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_129B015143D1D1F ON app_shop_has_articles (description_short_label_id)');
        $this->addSql('ALTER TABLE item ADD description_short_label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251E43D1D1F FOREIGN KEY (description_short_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_1F1B251E43D1D1F ON item (description_short_label_id)');
        $this->addSql('ALTER TABLE offer_programmer ADD description_short_label_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer_programmer ADD CONSTRAINT FK_DD9C0F7D43D1D1F FOREIGN KEY (description_short_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_DD9C0F7D43D1D1F ON offer_programmer (description_short_label_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop_has_articles DROP FOREIGN KEY FK_129B015143D1D1F');
        $this->addSql('DROP INDEX IDX_129B015143D1D1F ON app_shop_has_articles');
        $this->addSql('ALTER TABLE app_shop_has_articles DROP description_short_label_id');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6643D1D1F');
        $this->addSql('DROP INDEX IDX_23A0E6643D1D1F ON article');
        $this->addSql('ALTER TABLE article DROP description_short_label_id');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E43D1D1F');
        $this->addSql('DROP INDEX IDX_1F1B251E43D1D1F ON item');
        $this->addSql('ALTER TABLE item DROP description_short_label_id');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E43D1D1F');
        $this->addSql('DROP INDEX IDX_29D6873E43D1D1F ON offer');
        $this->addSql('ALTER TABLE offer DROP description_short_label_id');
        $this->addSql('ALTER TABLE offer_programmer DROP FOREIGN KEY FK_DD9C0F7D43D1D1F');
        $this->addSql('DROP INDEX IDX_DD9C0F7D43D1D1F ON offer_programmer');
        $this->addSql('ALTER TABLE offer_programmer DROP description_short_label_id');
    }
}
