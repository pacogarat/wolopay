<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\CommissionBaseEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150520162335 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method_has_provider ADD fee_currency_id VARCHAR(3) DEFAULT NULL, ADD price_sent_net TINYINT(1) NOT NULL, ADD fee_calculated_with_net TINYINT(1) NOT NULL, CHANGE fee_extra_each_payment fee_provider_fixed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54B1F9EF18 FOREIGN KEY (fee_currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_4D729A54B1F9EF18 ON pay_method_has_provider (fee_currency_id)');
        $this->addSql('ALTER TABLE app ADD comission_currency_id VARCHAR(3), ADD comission_base VARCHAR(25) NOT NULL DEFAULT "'.CommissionBaseEnum::WOLOPAYNET.'", ADD commission_min DOUBLE PRECISION, ADD commission_max DOUBLE PRECISION, ADD commission_percent DOUBLE PRECISION, ADD commission_fixed_fee DOUBLE PRECISION, CHANGE pg_tax_percent tax_percent_applicable DOUBLE PRECISION NOT NULL DEFAULT 5');
        $this->addSql('UPDATE app SET comission_currency_id = "EUR"');
        $this->addSql('ALTER TABLE app ADD CONSTRAINT FK_C96E70CF8F1BAD85 FOREIGN KEY (comission_currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_C96E70CF8F1BAD85 ON app (comission_currency_id)');
        $this->addSql('ALTER TABLE purchase ADD tax_percent DOUBLE PRECISION , ADD amount_tax DOUBLE PRECISION , ADD amount_before_taxes DOUBLE PRECISION , ADD amount_wolo DOUBLE PRECISION , ADD provider_fee_percent DOUBLE PRECISION , ADD provider_real_fee_percent DOUBLE PRECISION , ADD provider_fixed_fee_amount DOUBLE PRECISION ');
        $this->addSql('UPDATE purchase SET tax_percent = vat, amount_tax = amount_total * vat / 100, amount_before_taxes = amount_total - (amount_total * vat / 100), amount_wolo = amount_pg, provider_fee_percent = 0, provider_real_fee_percent = 0, provider_fixed_fee_amount = 0');
        $this->addSql('ALTER TABLE purchase MODIFY tax_percent DOUBLE PRECISION NOT NULL, MODIFY amount_tax DOUBLE PRECISION NOT NULL, MODIFY amount_before_taxes DOUBLE PRECISION NOT NULL, MODIFY amount_wolo DOUBLE PRECISION NOT NULL, MODIFY provider_fee_percent DOUBLE PRECISION NOT NULL, MODIFY provider_real_fee_percent DOUBLE PRECISION NOT NULL, MODIFY provider_fixed_fee_amount DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase DROP amount_pg, DROP provider_tax_percent, DROP provider_tax_amount, DROP vat');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD fee_currency_id VARCHAR(3) DEFAULT NULL, ADD price_sent_net TINYINT(1) DEFAULT NULL, ADD fee_calculated_with_net TINYINT(1) DEFAULT NULL, CHANGE fee_extra_each_payment fee_provider_fixed DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country ADD CONSTRAINT FK_4BF4E18CB1F9EF18 FOREIGN KEY (fee_currency_id) REFERENCES currency (id)');
        $this->addSql('CREATE INDEX IDX_4BF4E18CB1F9EF18 ON pay_method_provider_has_country (fee_currency_id)');
        $this->addSql('ALTER TABLE gamer ADD external_publisher_id VARCHAR(200) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app DROP FOREIGN KEY FK_C96E70CF8F1BAD85');
        $this->addSql('DROP INDEX IDX_C96E70CF8F1BAD85 ON app');
        $this->addSql('ALTER TABLE app ADD pg_tax_percent DOUBLE PRECISION NOT NULL, DROP comission_currency_id, DROP tax_percent_applicable, DROP comission_base, DROP commission_min, DROP commission_max, DROP commission_percent, DROP commission_fixed_fee');
        $this->addSql('ALTER TABLE gamer DROP external_publisher_id');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54B1F9EF18');
        $this->addSql('DROP INDEX IDX_4D729A54B1F9EF18 ON pay_method_has_provider');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP fee_currency_id, DROP price_sent_net, DROP fee_calculated_with_net, CHANGE fee_provider_fixed fee_extra_each_payment DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP FOREIGN KEY FK_4BF4E18CB1F9EF18');
        $this->addSql('DROP INDEX IDX_4BF4E18CB1F9EF18 ON pay_method_provider_has_country');
        $this->addSql('ALTER TABLE pay_method_provider_has_country DROP fee_currency_id, DROP price_sent_net, DROP fee_calculated_with_net, CHANGE fee_provider_fixed fee_extra_each_payment DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD amount_pg DOUBLE PRECISION NOT NULL, ADD provider_tax_percent DOUBLE PRECISION NOT NULL, ADD provider_tax_amount DOUBLE PRECISION NOT NULL, ADD vat DOUBLE PRECISION DEFAULT NULL, DROP tax_percent, DROP tax_amount, DROP amount_before_taxes, DROP amount_wolo, DROP provider_fee_percent, DROP provider_real_fee_percent, DROP provider_fee_amount, DROP provider_fixed_fee_amount');
    }
}
