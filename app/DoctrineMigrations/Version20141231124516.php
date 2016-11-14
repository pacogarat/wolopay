<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141231124516 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sms CHANGE short_number short_number VARCHAR(10) NOT NULL');


        $this->addSql('ALTER TABLE `promo_code`
            DROP FOREIGN KEY `FK_3D8C939ED0C07AFF`,
            DROP FOREIGN KEY `FK_3D8C939E7987212D`,
            DROP FOREIGN KEY `FK_3D8C939E7294869C`;');

        $this->addSql('ALTER TABLE `promo_code`
    DROP INDEX `IDX_3D8C939E7294869C` ,
    DROP INDEX `IDX_3D8C939E7987212D` ,
    DROP INDEX `IDX_3D8C939ED0C07AFF` ;
');

        $this->addSql('ALTER TABLE `promo_code_has_gamers`
DROP FOREIGN KEY `FK_230966F72FAE4625`;
');
        $this->addSql('ALTER TABLE `promo_code_used_by_gamer`
DROP FOREIGN KEY `FK_5961A3392FAE4625`;
');
        
        $this->addSql('ALTER TABLE `promo_code` 
DROP INDEX `code_unique` ;
');

        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939ED0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939E7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE promo_code ADD CONSTRAINT FK_3D8C939E7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE INDEX IDX_3D8C939ED0C07AFF ON promo_code (promo_id)');
        $this->addSql('CREATE INDEX IDX_3D8C939E7987212D ON promo_code (app_id)');
        $this->addSql('CREATE INDEX IDX_3D8C939E7294869C ON promo_code (article_id)');
        $this->addSql('ALTER TABLE promo_code_has_gamers CHANGE promo_code_id promo_code_id INT NOT NULL');
        $this->addSql('ALTER TABLE promo_code_has_gamers ADD CONSTRAINT FK_230966F72FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');
        $this->addSql('ALTER TABLE promo_code_used_by_gamer ADD CONSTRAINT FK_5961A3392FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (id)');

    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(true, 'Cant do rollback.');
    }
}
