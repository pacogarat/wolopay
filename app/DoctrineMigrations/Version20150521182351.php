<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\VatCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150521182351 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vat_category (id VARCHAR(20) NOT NULL, name VARCHAR(45) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('INSERT into vat_category values ("'.VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID.'","Vat from buyer country", NOW()),("'.VatCategoryEnum::NONE_ID.'","None", NOW()) ');
        $this->addSql('ALTER TABLE country ADD vat_category_id VARCHAR(20) NOT NULL DEFAULT "'.VatCategoryEnum::NONE_ID.'"');
        $this->addSql('UPDATE country SET vat_category_id = "'.VatCategoryEnum::VAT_FROM_BUYER_COUNTRY_ID.' where apply_vat = 1" ');
        $this->addSql('ALTER TABLE country DROP apply_vat');
        $this->addSql('ALTER TABLE country ADD CONSTRAINT FK_5373C966AFC49C87 FOREIGN KEY (vat_category_id) REFERENCES vat_category (id)');
        $this->addSql('CREATE INDEX IDX_5373C966AFC49C87 ON country (vat_category_id)');
        $this->addSql('ALTER TABLE app CHANGE tax_percent_applicable tax_percent_applicable DOUBLE PRECISION NOT NULL, CHANGE comission_base comission_base VARCHAR(25) NOT NULL');
        $this->addSql('ALTER TABLE purchase CHANGE provider_fixed_fee_amount provider_fixed_fee_amount DOUBLE PRECISION NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP FOREIGN KEY FK_5373C966AFC49C87');
        $this->addSql('DROP TABLE vat_category');
        $this->addSql('ALTER TABLE app CHANGE tax_percent_applicable tax_percent_applicable DOUBLE PRECISION DEFAULT \'5\' NOT NULL, CHANGE comission_base comission_base VARCHAR(25) DEFAULT \'wolopay_net\' NOT NULL');
        $this->addSql('DROP INDEX IDX_5373C966AFC49C87 ON country');
        $this->addSql('ALTER TABLE country ADD apply_vat TINYINT(1) DEFAULT NULL, DROP vat_category_id');
        $this->addSql('ALTER TABLE purchase CHANGE provider_fixed_fee_amount provider_fixed_fee_amount DOUBLE PRECISION DEFAULT NULL');
    }
}
