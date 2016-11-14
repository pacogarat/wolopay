<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150706114202 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shop_css ADD product_rows SMALLINT NOT NULL, ADD pay_method_rows SMALLINT NOT NULL, ADD modular TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE transaction ADD first_pay_methods TINYINT(1) DEFAULT NULL');
        $this->addSql('UPDATE shop_css SET name = \'Jagged\' where name = "Standard"');
        $this->addSql('UPDATE shop_css SET product_rows = 1, pay_method_rows=1');

        $this->addSql('INSERT INTO `shop_css`
(
`css_url`,
`name`,
`created_at`,
`active`,
`public`,
`product_rows`,
`pay_method_rows`)
VALUES
(
"theme_module_blue.less",
"Standard",
Now(),
1,
1,
2,
2)
');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE shop_css DROP product_rows, DROP pay_method_rows, DROP modular');
        $this->addSql('ALTER TABLE transaction DROP first_pay_methods');
    }
}
