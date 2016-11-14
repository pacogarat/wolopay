<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150529132704 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop_article_has_pmpc DROP FOREIGN KEY FK_C045519D73DBD337;');
        $this->addSql('ALTER TABLE app_shop_article_has_pmpc ADD CONSTRAINT FK_C045519D73DBD337 FOREIGN KEY (pay_method_provider_has_country_id) REFERENCES pay_method_provider_has_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country DROP FOREIGN KEY FK_C6F7816073DBD337');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country DROP FOREIGN KEY FK_C6F781607987212D');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country ADD CONSTRAINT FK_C6F7816073DBD337 FOREIGN KEY (pay_method_provider_has_country_id) REFERENCES pay_method_provider_has_country (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_has_pay_method_provider_country ADD CONSTRAINT FK_C6F781607987212D FOREIGN KEY (app_id) REFERENCES app (id) ON DELETE CASCADE');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app CHANGE url_notification_extra url_extra VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase_notification DROP is_extra');
    }
}
