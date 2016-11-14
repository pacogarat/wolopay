<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141203102338 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `transaction` DROP FOREIGN KEY FK_723705D1C343B13');
        $this->addSql('ALTER TABLE single_free_payment DROP FOREIGN KEY FK_F537983C3D8C939E');
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902C343B13');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP FOREIGN KEY FK_5961A339D0C07AFF');
//        $this->addSql('DROP INDEX code_unique ON promo_code');

        $this->addSql('ALTER TABLE promo_code ADD id INT ');
        $this->addSql('ALTER TABLE promo_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE promo_code MODIFY id INT AUTO_INCREMENT PRIMARY KEY');

        $this->addSql('ALTER TABLE app_shop CHANGE tutorial_promo_code_id tutorial_promo_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (id)');

        $this->addSql('ALTER TABLE `transaction` CHANGE tutorial_promo_code_id tutorial_promo_code_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `transaction` ADD CONSTRAINT FK_723705D1C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (id)');

        $this->addSql('DROP INDEX IDX_F537983C3D8C939E ON single_free_payment');
        $this->addSql('ALTER TABLE single_free_payment ADD promo_code_id INT DEFAULT NULL, DROP promo_code');
        $this->addSql('ALTER TABLE single_free_payment ADD CONSTRAINT FK_F537983C2FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');
        $this->addSql('CREATE INDEX IDX_F537983C2FAE4625 ON single_free_payment (promo_code_id)');

        $this->addSql('DROP INDEX IDX_5961A339D0C07AFF ON promo_code_used_by_gamer');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD promo_code_id INT DEFAULT NULL, DROP promo_id');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A3392FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');
        $this->addSql('CREATE INDEX IDX_5961A3392FAE4625 ON promo_code_used_by_gamer (promo_code_id)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP INDEX UNIQ_5961A3392F43A116, ADD INDEX IDX_5961A3392F43A116 (gamer_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902C343B13');
        $this->addSql('ALTER TABLE app_shop CHANGE tutorial_promo_code_id tutorial_promo_code_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE promo_code DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE promo_code DROP id');
        $this->addSql('CREATE UNIQUE INDEX code_unique ON promo_code (code)');
        $this->addSql('ALTER TABLE promo_code ADD PRIMARY KEY (code)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP FOREIGN KEY FK_5961A3392FAE4625');
        $this->addSql('DROP INDEX IDX_5961A3392FAE4625 ON promo_code_used_by_gamer');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD promo_id VARCHAR(255) DEFAULT NULL, DROP promo_code_id');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A339D0C07AFF FOREIGN KEY (promo_id) REFERENCES promo_code (code)');
        $this->addSql('CREATE INDEX IDX_5961A339D0C07AFF ON promo_code_used_by_gamer (promo_id)');
        $this->addSql('ALTER TABLE single_free_payment DROP FOREIGN KEY FK_F537983C2FAE4625');
        $this->addSql('DROP INDEX IDX_F537983C2FAE4625 ON single_free_payment');
        $this->addSql('ALTER TABLE single_free_payment ADD promo_code VARCHAR(255) DEFAULT NULL, DROP promo_code_id');
        $this->addSql('ALTER TABLE single_free_payment ADD CONSTRAINT FK_F537983C3D8C939E FOREIGN KEY (promo_code) REFERENCES promo_code (code)');
        $this->addSql('CREATE INDEX IDX_F537983C3D8C939E ON single_free_payment (promo_code)');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C343B13');
        $this->addSql('ALTER TABLE transaction CHANGE tutorial_promo_code_id tutorial_promo_code_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP INDEX IDX_5961A3392F43A116, ADD UNIQUE INDEX UNIQ_5961A3392F43A116 (gamer_id)');
    }
}
