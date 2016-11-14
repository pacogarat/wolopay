<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141202163000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE promo_code_has_gamers (promo_code_id VARCHAR(255) NOT NULL, gamer_id INT NOT NULL, INDEX IDX_230966F72FAE4625 (promo_code_id), INDEX IDX_230966F72F43A116 (gamer_id), PRIMARY KEY(promo_code_id, gamer_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE promo_code_has_gamers ADD CONSTRAINT FK_230966F72FAE4625 FOREIGN KEY (promo_code_id) REFERENCES promo_code (code)');
        $this->addSql('ALTER TABLE promo_code_has_gamers ADD CONSTRAINT FK_230966F72F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE gamer DROP FOREIGN KEY FK_88241BA7FDC4C5BD');
        $this->addSql('DROP INDEX IDX_88241BA7FDC4C5BD ON gamer');
        $this->addSql('ALTER TABLE gamer ADD email VARCHAR(200) DEFAULT NULL, ADD name VARCHAR(100) DEFAULT NULL, ADD surname VARCHAR(200) DEFAULT NULL, DROP purchases_number, DROP purchases_average, DROP currency, DROP medio_pago_mas_usado_unknown, DROP numMediosPago_unknown, DROP pais_MPMasUsado_unknown, CHANGE purchaselastid_unknown created DATETIME DEFAULT NULL');
        $this->addSql("INSERT INTO `payment_service_category` VALUES ('shop.payment.xsolla_ipn_pay_method','Xsolla','2014-23-11 17:25:37')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('DROP TABLE promo_code_has_gamers');
        $this->addSql('ALTER TABLE gamer ADD purchases_number INT NOT NULL, ADD purchases_average DOUBLE PRECISION DEFAULT NULL, ADD currency VARCHAR(3) DEFAULT NULL, ADD medio_pago_mas_usado_unknown INT DEFAULT NULL, ADD numMediosPago_unknown INT DEFAULT NULL, ADD pais_MPMasUsado_unknown VARCHAR(2) DEFAULT NULL, DROP email, DROP name, DROP surname, CHANGE created purchaseLastId_unknown DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA7FDC4C5BD FOREIGN KEY (pais_MPMasUsado_unknown) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_88241BA7FDC4C5BD ON gamer (pais_MPMasUsado_unknown)');
        $this->addSql("delete from `payment_service_category` where id='shop.payment.xsolla_ipn_pay_method'");
    }
}
