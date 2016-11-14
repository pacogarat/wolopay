<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PayCategoryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150220134847 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `pay_catergory` VALUES ('".PayCategoryEnum::CASH_ID."','Cash'),('".PayCategoryEnum::BANK_TRANSFER_ID."','Bank Transfer');");
        $this->addSql('ALTER TABLE pay_method_has_provider ADD extra_options LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD is_our_implementation TINYINT(1) DEFAULT NULL');
        $this->addSql('update pay_method_has_provider set  is_our_implementation = 0');
        $this->addSql('update pay_method_has_provider
            inner join provider on (pay_method_has_provider.provider_id = provider.id)
            set  is_our_implementation = 1
            where provider.name=\'Nvia\' or provider.name=\'Fortuno\'
        ');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider DROP extra_options');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP is_our_implementation');
    }
}
