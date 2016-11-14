<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141119112748 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE article_pmpc_has_sms (articlehaspmpc_id INT NOT NULL, sms_id INT NOT NULL, INDEX IDX_11378A55CE97B6F0 (articlehaspmpc_id), INDEX IDX_11378A55BD5C7E60 (sms_id), PRIMARY KEY(articlehaspmpc_id, sms_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD CONSTRAINT FK_11378A55CE97B6F0 FOREIGN KEY (articlehaspmpc_id) REFERENCES article_has_pmpc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_pmpc_has_sms ADD CONSTRAINT FK_11378A55BD5C7E60 FOREIGN KEY (sms_id) REFERENCES sms (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voice DROP INDEX UNIQ_E7FB583BE562B43C, ADD INDEX IDX_E7FB583BE562B43C (pay_method_provider_country_id)');
        $this->addSql('ALTER TABLE payment_detail ADD voice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment_detail ADD CONSTRAINT FK_B3EE4051672336E FOREIGN KEY (voice_id) REFERENCES voice (id)');
        $this->addSql('CREATE INDEX IDX_B3EE4051672336E ON payment_detail (voice_id)');
        $this->addSql('ALTER TABLE article_has_pmpc ADD voice_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_has_pmpc ADD CONSTRAINT FK_F94441D31672336E FOREIGN KEY (voice_id) REFERENCES voice (id)');
        $this->addSql('CREATE INDEX IDX_F94441D31672336E ON article_has_pmpc (voice_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE article_pmpc_has_sms');
        $this->addSql('ALTER TABLE article_has_pmpc DROP FOREIGN KEY FK_F94441D31672336E');
        $this->addSql('DROP INDEX IDX_F94441D31672336E ON article_has_pmpc');
        $this->addSql('ALTER TABLE article_has_pmpc DROP voice_id');
        $this->addSql('ALTER TABLE payment_detail DROP FOREIGN KEY FK_B3EE4051672336E');
        $this->addSql('DROP INDEX IDX_B3EE4051672336E ON payment_detail');
        $this->addSql('ALTER TABLE payment_detail DROP voice_id');
        $this->addSql('ALTER TABLE voice DROP INDEX IDX_E7FB583BE562B43C, ADD UNIQUE INDEX UNIQ_E7FB583BE562B43C (pay_method_provider_country_id)');
    }
}
