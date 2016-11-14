<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PurchaseNotificationEventEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160209115621 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_notification CHANGE event event VARCHAR(30) NOT NULL');
        $this->addSql('UPDATE purchase_notification SET event ="'.PurchaseNotificationEventEnum::PAYMENT_COMPLETED.'"');

        $this->addSql("
            INSERT INTO `shop_css`
            (css_url, name, created_at, active, public, product_rows, pay_method_rows, modular, has_categories)
            VALUES
            ('theme_azt_modular.less','AZT',NOW(),1,0,1,1,1,0),
            ('theme_azt_valentines_day_modular.less','azt_valentin',NOW(),1,0,1,1,1,0),
            ('theme_berserk_valentines_day_modular.less','berserk_valentin_module',NOW(),1,0,1,1,1,1),
            ('theme_battle_space_valentines_day.less','battle_space_valentin',NOW(),1,0,1,1,0,0),
            ('theme_cronix_valentines_day.less','cronix_valentin',NOW(),1,0,1,1,0,0),
            ('theme_idc_valentines_day.less','idc_valentin',NOW(),1,0,1,1,0,0),
            ('theme_korner_valentines_day.less','korner_valentin',NOW(),1,0,1,1,0,0),
            ('theme_ragnarok_valentines_day.less','ragnarok_valentin',NOW(),1,0,1,1,0,0),
            ('theme_ragnarok_black_friday.less','theme_ragnarok_black_friday',NOW(),1,0,1,1,0,0),
            ('theme_battle_space_black_friday.less','theme_battle_space_black_friday',NOW(),1,0,1,1,0,0),
            ('theme_battle_space_christmas.less','theme_battle_space_christmas',NOW(),1,0,1,1,0,0),
            ('theme_cronix_black_friday.less','theme_cronix_black_friday',NOW(),1,0,1,1,0,0),
            ('theme_berserk_black_friday.less','theme_berserk_black_friday',NOW(),1,0,1,1,0,0),
            ('theme_idc_black_friday.less','theme_idc_black_friday',NOW(),1,0,1,1,0,0),
            ('theme_korner_black_friday.less','theme_korner_black_friday',NOW(),1,0,1,1,0,0);
        ");
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE purchase_notification CHANGE event event VARCHAR(10) NOT NULL COLLATE utf8_unicode_ci');
    }
}
