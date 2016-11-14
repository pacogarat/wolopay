<?php

namespace Application\Migrations;

use AppBundle\Entity\Client;
use AppBundle\Entity\Enum\CurrencyEnum;
use AppBundle\Entity\Enum\FinInvoiceCategoryEnum;
use AppBundle\Entity\Enum\WoloPackEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20151201152801 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_deposit (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, fin_invoice_id INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, amount_limit_cover DOUBLE PRECISION NOT NULL, amount_increase_if_limit_exceed DOUBLE PRECISION NOT NULL, used_at DATETIME NOT NULL, used_until_at DATETIME DEFAULT NULL, INDEX IDX_C7E6D94419EB6921 (client_id), INDEX IDX_C7E6D944CCE46291 (fin_invoice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
//        Manual
        $this->addSql('insert into client_deposit
(client_id, description, amount_limit_cover,amount_increase_if_limit_exceed, used_at)
SELECT c.id, "Init", 1000, 300, now() FROM client c');


        $this->addSql('CREATE TABLE wolo_pack (id VARCHAR(255) NOT NULL, currency VARCHAR(3) NOT NULL, name VARCHAR(45) NOT NULL, amount_total NUMERIC(10, 2) NOT NULL, INDEX IDX_C26D4A9E6956883F (currency), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

//        Manual
        $this->addSql('INSERT INTO wolo_pack (id, currency, name, amount_total) VALUES ("'.WoloPackEnum::STANDARD_ID.'","EUR", "Standard", 150)');

        $this->addSql('CREATE TABLE fin_movement (id INT AUTO_INCREMENT NOT NULL, fin_invoice_id INT NOT NULL, company_from_id INT NOT NULL, company_to_id INT NOT NULL, currency_id VARCHAR(3) NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, amount_total NUMERIC(10, 2) NOT NULL, exchangeToEur DOUBLE PRECISION NOT NULL, remember_until_order_done TINYINT(1) DEFAULT NULL, order_at DATETIME DEFAULT NULL, ordered_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_641957C0CCE46291 (fin_invoice_id), INDEX IDX_641957C0589CC3DC (company_from_id), INDEX IDX_641957C077C4E800 (company_to_id), INDEX IDX_641957C038248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fin_invoice_category (id VARCHAR(25) NOT NULL, name VARCHAR(300) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('INSERT INTO `fin_invoice_category`
            (`id`,
            `name`)
            VALUES
            ("'.FinInvoiceCategoryEnum::CLIENT_INVOICE_MONTHLY_ID.'",
            "Client invoice monthly"),

            ("'.FinInvoiceCategoryEnum::OTHER_ID.'",
            "Other"),

            ("'.FinInvoiceCategoryEnum::PROVIDER_ID.'",
            "Payment Provider")


');

        $this->addSql('CREATE TABLE fin_invoice (id INT AUTO_INCREMENT NOT NULL, fin_invoice_category_id VARCHAR(25) NOT NULL, company_from_id INT NOT NULL, company_to_id INT NOT NULL, currency_id VARCHAR(3) NOT NULL, document INT DEFAULT NULL, invoice_number VARCHAR(50) NOT NULL, title VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, amount_total NUMERIC(10, 2) NOT NULL, watch TINYINT(1) DEFAULT NULL, require_approval TINYINT(1) DEFAULT NULL, approved_at DATETIME DEFAULT NULL, forward_for_client_to_at DATETIME DEFAULT NULL, forwarded_for_client_to_at DATETIME DEFAULT NULL, declined_at DATETIME DEFAULT NULL, reference_date DATETIME NOT NULL, invoice_generator_id VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_EBBAB14BB2B89967 (fin_invoice_category_id), INDEX IDX_EBBAB14B589CC3DC (company_from_id), INDEX IDX_EBBAB14B77C4E800 (company_to_id), INDEX IDX_EBBAB14B38248176 (currency_id), INDEX IDX_EBBAB14BD8698A76 (document), UNIQUE INDEX FIN_INVOICE_UNIQUE_ (invoice_number, company_from_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_deposit ADD CONSTRAINT FK_C7E6D94419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_deposit ADD CONSTRAINT FK_C7E6D944CCE46291 FOREIGN KEY (fin_invoice_id) REFERENCES fin_invoice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE wolo_pack ADD CONSTRAINT FK_C26D4A9E6956883F FOREIGN KEY (currency) REFERENCES currency (id)');


        $this->addSql('ALTER TABLE fin_movement ADD CONSTRAINT FK_641957C0CCE46291 FOREIGN KEY (fin_invoice_id) REFERENCES fin_invoice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fin_movement ADD CONSTRAINT FK_641957C0589CC3DC FOREIGN KEY (company_from_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE fin_movement ADD CONSTRAINT FK_641957C077C4E800 FOREIGN KEY (company_to_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE fin_movement ADD CONSTRAINT FK_641957C038248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14BB2B89967 FOREIGN KEY (fin_invoice_category_id) REFERENCES fin_invoice_category (id)');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14B589CC3DC FOREIGN KEY (company_from_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14B77C4E800 FOREIGN KEY (company_to_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14B38248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE fin_invoice ADD CONSTRAINT FK_EBBAB14BD8698A76 FOREIGN KEY (document) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE client ADD currency_earnings VARCHAR(3) DEFAULT NULL, ADD logo INT DEFAULT NULL, ADD wolo_pack VARCHAR(50) DEFAULT NULL, ADD vat_number VARCHAR(60) DEFAULT NULL, ADD postal_code VARCHAR(10) DEFAULT NULL, ADD address VARCHAR(150) DEFAULT NULL, ADD slug VARCHAR(5) DEFAULT NULL, ADD finance_email VARCHAR(255) DEFAULT NULL, ADD active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C744045567BF8657 FOREIGN KEY (currency_earnings) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455E48E9A13 FOREIGN KEY (logo) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455C26D4A9E FOREIGN KEY (wolo_pack) REFERENCES wolo_pack (id)');

        $this->addSql('CREATE INDEX IDX_C744045567BF8657 ON client (currency_earnings)');
        $this->addSql('CREATE INDEX IDX_C7440455E48E9A13 ON client (logo)');
        $this->addSql('CREATE INDEX IDX_C7440455C26D4A9E ON client (wolo_pack)');

//        added after to work in local
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455989D9B62 ON client (slug)');
    }

    public function postUp(Schema $schema)
    {
        // execute only one time
        return;

        /** @var EntityManagerInterface $em */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $iterableResult = $em->createQuery('SELECT c FROM AppBundle:Client c')->iterate();

        foreach ($iterableResult as $row)
        {
            /** @var Client $client */
            $client = $row[0];

            $client
                ->setSlug(substr(strtoupper(str_replace(' ', '', $client->getNameCompany())), 0, 5))
                ->setVatNumber($client->getCountry()->getId().$client->getCif())
                ->setPostalCode(28230)
                ->setCurrencyEarnings($em->getRepository("AppBundle:Currency")->find(CurrencyEnum::EURO))
                ->setAddress('C/ Pasamar 1-3')
                ->setActive(true)
                ->setFinanceEmail('miguelgd@gmail.com')
                ->setWoloPack($em->getRepository("AppBundle:WoloPack")->find(WoloPackEnum::STANDARD_ID))
            ;

        }
        $em->flush();

        $em->getConnection()->executeQuery('ALTER TABLE client MODIFY currency_earnings VARCHAR(3) NOT NULL, MODIFY logo INT NOT NULL, MODIFY wolo_pack VARCHAR(50) NOT NULL, MODIFY vat_number VARCHAR(60) DEFAULT NULL, MODIFY postal_code VARCHAR(10) DEFAULT NULL, MODIFY address VARCHAR(150) DEFAULT NULL, MODIFY slug VARCHAR(5) NOT NULL, MODIFY finance_email VARCHAR(255) NOT NULL');
        $em->getConnection()->executeQuery('ALTER TABLE client MODIFY slug VARCHAR(5) NOT NULL');
        $em->getConnection()->executeQuery('CREATE UNIQUE INDEX UNIQ_C7440455989D9B62 ON client (slug)');


    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455C26D4A9E');
        $this->addSql('ALTER TABLE fin_invoice DROP FOREIGN KEY FK_EBBAB14BB2B89967');
        $this->addSql('ALTER TABLE client_deposit DROP FOREIGN KEY FK_C7E6D944CCE46291');
        $this->addSql('ALTER TABLE fin_movement DROP FOREIGN KEY FK_641957C0CCE46291');
        $this->addSql('DROP TABLE client_deposit');
        $this->addSql('DROP TABLE wolo_pack');
        $this->addSql('DROP TABLE fin_movement');
        $this->addSql('DROP TABLE fin_invoice_category');
        $this->addSql('DROP TABLE fin_invoice');
        $this->addSql('DROP INDEX UNIQ_C7440455989D9B62 ON client');
        $this->addSql('DROP INDEX IDX_C744045567BF8657 ON client');
        $this->addSql('DROP INDEX IDX_C7440455E48E9A13 ON client');
        $this->addSql('DROP INDEX IDX_C7440455C26D4A9E ON client');
        $this->addSql('ALTER TABLE client DROP currency_earnings, DROP logo, DROP wolo_pack, DROP vat_number, DROP postal_code, DROP address, DROP slug, DROP finance_email, DROP active');
    }
}
