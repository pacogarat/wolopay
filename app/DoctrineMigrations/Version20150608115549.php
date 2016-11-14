<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\VatCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150608115549 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country CHANGE vat_category_id vat_category_id VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE vat_category CHANGE id id VARCHAR(30) NOT NULL');
        $this->addSql('INSERT INTO vat_category VALUES ("'.VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID.'", "Vat from buyer country", NOW())');
        $this->addSql('UPDATE country SET vat_category_id = "'.VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID.'" where vat_category_id = "vat_from_buyer_count" ');
        $this->addSql('Delete from vat_category where id = "vat_from_buyer_count" ');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country CHANGE vat_category_id vat_category_id VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE vat_category CHANGE id id VARCHAR(20) NOT NULL');
    }
}
