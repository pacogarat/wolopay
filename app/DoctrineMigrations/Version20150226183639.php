<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150226183639 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F51FD67EA');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available DROP FOREIGN KEY FK_E7BD6D26A31E0FF2');

        $this->addSql('CREATE TABLE tab_category (id VARCHAR(255) NOT NULL, description_label_id INT NOT NULL, name VARCHAR(45) NOT NULL, class VARCHAR(45) NOT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D654A95E868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('
            INSERT INTO tab_category
            SELECT *
            FROM   method_catergory
        ');

        $this->addSql('CREATE TABLE transaction_has_tab_categories_available (transaction_id VARCHAR(100) NOT NULL, tabcategory_id VARCHAR(255) NOT NULL, INDEX IDX_16577B852FC0CB0F (transaction_id), INDEX IDX_16577B854CB598DB (tabcategory_id), PRIMARY KEY(transaction_id, tabcategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('
            INSERT INTO transaction_has_tab_categories_available
            SELECT *
            FROM   transaction_has_methods_categories_available
        ');

        $this->addSql('ALTER TABLE tab_category ADD CONSTRAINT FK_D654A95E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available ADD CONSTRAINT FK_16577B852FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available ADD CONSTRAINT FK_16577B854CB598DB FOREIGN KEY (tabcategory_id) REFERENCES tab_category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE method_catergory');
        $this->addSql('DROP TABLE transaction_has_methods_categories_available');
        $this->addSql('ALTER TABLE purchase_notification CHANGE payment_detail_has_article_id payment_detail_has_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD selected_tab_category_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D119909DC0 FOREIGN KEY (selected_tab_category_id) REFERENCES tab_category (id)');
        $this->addSql('CREATE INDEX IDX_723705D119909DC0 ON transaction (selected_tab_category_id)');
        $this->addSql('DROP INDEX IDX_D7C2F02F51FD67EA ON pay_method');
        $this->addSql('ALTER TABLE pay_method CHANGE method_category_id tab_category_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F13A05411 FOREIGN KEY (tab_category_id) REFERENCES tab_category (id)');
        $this->addSql('CREATE INDEX IDX_D7C2F02F13A05411 ON pay_method (tab_category_id)');

        $this->addSql('CREATE TABLE transaction_has_pay_methods_available (transaction_id VARCHAR(100) NOT NULL, paymethod_id INT NOT NULL, INDEX IDX_FA21D8AD2FC0CB0F (transaction_id), INDEX IDX_FA21D8AD3B188DF8 (paymethod_id), PRIMARY KEY(transaction_id, paymethod_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');

        $this->addSql('ALTER TABLE transaction_has_pay_methods_available ADD CONSTRAINT FK_FA21D8AD2FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_pay_methods_available ADD CONSTRAINT FK_FA21D8AD3B188DF8 FOREIGN KEY (paymethod_id) REFERENCES pay_method (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE transaction_has_providers_available');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D119909DC0');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available DROP FOREIGN KEY FK_16577B854CB598DB');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F13A05411');
        $this->addSql('CREATE TABLE method_catergory (id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, description_label_id INT NOT NULL, name VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci, class VARCHAR(45) NOT NULL COLLATE utf8_unicode_ci, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_93E7D4F9868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_methods_categories_available (transaction_id VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, methodcategory_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, INDEX IDX_E7BD6D262FC0CB0F (transaction_id), INDEX IDX_E7BD6D26A31E0FF2 (methodcategory_id), PRIMARY KEY(transaction_id, methodcategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE method_catergory ADD CONSTRAINT FK_93E7D4F9868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available ADD CONSTRAINT FK_E7BD6D26A31E0FF2 FOREIGN KEY (methodcategory_id) REFERENCES method_catergory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_methods_categories_available ADD CONSTRAINT FK_E7BD6D262FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tab_category');
        $this->addSql('DROP TABLE transaction_has_tab_categories_available');
        $this->addSql('DROP INDEX IDX_D7C2F02F13A05411 ON pay_method');
        $this->addSql('ALTER TABLE pay_method CHANGE tab_category_id method_category_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F51FD67EA FOREIGN KEY (method_category_id) REFERENCES method_catergory (id)');
        $this->addSql('CREATE INDEX IDX_D7C2F02F51FD67EA ON pay_method (method_category_id)');
        $this->addSql('ALTER TABLE purchase_notification CHANGE payment_detail_has_article_id payment_detail_has_article_id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_723705D119909DC0 ON `transaction`');
        $this->addSql('ALTER TABLE `transaction` DROP selected_tab_category_id');

        $this->addSql('CREATE TABLE transaction_has_providers_available (transaction_id VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, provider_id INT NOT NULL, INDEX IDX_ACE91AB82FC0CB0F (transaction_id), INDEX IDX_ACE91AB8A53A8AA (provider_id), PRIMARY KEY(transaction_id, provider_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_has_providers_available ADD CONSTRAINT FK_ACE91AB8A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_providers_available ADD CONSTRAINT FK_ACE91AB82FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE transaction_has_pay_methods_available');
    }
}
