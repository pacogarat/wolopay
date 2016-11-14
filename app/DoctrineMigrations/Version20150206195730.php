<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150206195730 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX PMP_UNIQUE ON pay_method_has_provider');
        $this->addSql('CREATE UNIQUE INDEX PMP_UNIQUE ON pay_method_has_provider (pay_method_id, provider_id, payment_service_category_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX PMP_UNIQUE ON pay_method_has_provider');
        $this->addSql('CREATE UNIQUE INDEX PMP_UNIQUE ON pay_method_has_provider (pay_method_id, provider_id)');
    }
}
