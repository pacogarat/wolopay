<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\CountryEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160229155006 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country ADD standard TINYINT(1) DEFAULT NULL');
        $this->addSql('UPDATE country SET standard = 1');

        $arr = CountryEnum::$OTHERS_ALL;
        $arr[] = CountryEnum::PROXY;

        foreach ($arr as &$p)
            $p = "'$p'";
        $this->addSql('UPDATE country SET standard = 0 WHERE id in ('.implode(',', $arr).') ');

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE country DROP standard');
    }
}
