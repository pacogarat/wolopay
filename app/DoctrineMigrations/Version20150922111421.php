<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150922111421 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop DROP FOREIGN KEY FK_A9446902C343B13');
        $this->addSql('ALTER TABLE app_shop ADD CONSTRAINT FK_A9446902C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C343B13');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C343B13 FOREIGN KEY (tutorial_promo_code_id) REFERENCES promo_code (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE single_free_payment DROP FOREIGN KEY FK_F537983C2FAE4625');
        $this->addSql('ALTER TABLE single_free_payment ADD CONSTRAINT FK_F537983C2FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) ON DELETE SET NULL');

        $this->addSql('ALTER TABLE promo_code_has_gamers DROP FOREIGN KEY FK_230966F72FAE4625');
        $this->addSql('ALTER TABLE promo_code_has_gamers DROP FOREIGN KEY FK_230966F72F43A116');
        $this->addSql('ALTER TABLE promo_code_has_gamers ADD CONSTRAINT FK_230966F72FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promo_code_has_gamers ADD CONSTRAINT FK_230966F72F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id) ON DELETE CASCADE');

        $this->addSql('ALTER TABLE promo_code_used_by_gamer DROP FOREIGN KEY FK_5961A3392FAE4625');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A3392FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id) ON DELETE CASCADE');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }
}
