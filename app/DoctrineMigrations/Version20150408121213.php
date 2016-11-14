<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150408121213 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider ADD active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE pay_method ADD active TINYINT(1) NOT NULL');

        $this->addSql('UPDATE pay_method SET active = 1');
        $this->addSql('UPDATE pay_method_has_provider SET active = 1');
        $this->addSql('UPDATE pay_method_provider_has_country SET active = 1');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_pmpc_has_sms (appshoparticlehaspmpc_id INT NOT NULL, sms_id INT NOT NULL, INDEX IDX_11378A55BD5C7E60 (sms_id), INDEX IDX_11378A55109AC217 (appshoparticlehaspmpc_id), PRIMARY KEY(appshoparticlehaspmpc_id, sms_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD CONSTRAINT FK_11378A55109AC217 FOREIGN KEY (appshoparticlehaspmpc_id) REFERENCES app_shop_article_has_pmpc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD CONSTRAINT FK_11378A55BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pay_method DROP active');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP active');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP active');
    }
}
