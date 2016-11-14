<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150408165129 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_has_pay_method_provider_country (pay_method_provider_has_country_id INT NOT NULL, app_id VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT NULL, INDEX IDX_C6F7816073DBD337 (pay_method_provider_has_country_id), INDEX IDX_C6F781607987212D (app_id), PRIMARY KEY(pay_method_provider_has_country_id, app_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country ADD CONSTRAINT FK_C6F7816073DBD337 FOREIGN KEY (pay_method_provider_has_country_id) REFERENCES pay_method_provider_has_country (id)');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country ADD CONSTRAINT FK_C6F781607987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('DROP TABLE app_has_paymethod_provider_country');
        $this->addSql('ALTER TABLE country CHANGE cost_of_living cost_of_living DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE app CHANGE active active TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_has_paymethod_provider_country (app_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, paymethodproviderhascountry_id INT NOT NULL, INDEX IDX_39DED44C7987212D (app_id), INDEX IDX_39DED44C436F2135 (paymethodproviderhascountry_id), PRIMARY KEY(app_id, paymethodproviderhascountry_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country ADD CONSTRAINT FK_39DED44C436F2135 FOREIGN KEY (paymethodproviderhascountry_id) REFERENCES pay_method_provider_has_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_paymethod_provider_country ADD CONSTRAINT FK_39DED44C7987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE app_has_pay_method_provider_country');
        $this->addSql('ALTER TABLE app CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE country CHANGE cost_of_living cost_of_living DOUBLE PRECISION DEFAULT \'1\' NOT NULL');
    }
}
