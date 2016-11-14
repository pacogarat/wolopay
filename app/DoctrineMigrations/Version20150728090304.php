<?php

namespace Application\Migrations;

use AppBundle\Entity\AppShopHasAppTab;
use AppBundle\Helper\UtilHelper;
use AppBundle\Service\AppService;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150728090304 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F13A05411');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D119909DC0');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available DROP FOREIGN KEY FK_16577B854CB598DB');
        $this->addSql('CREATE TABLE transaction_has_app_tabs_available (transaction_id VARCHAR(100) NOT NULL, apptab_id INT NOT NULL, INDEX IDX_F41AD7B72FC0CB0F (transaction_id), INDEX IDX_F41AD7B7D1E7F272 (apptab_id), PRIMARY KEY(transaction_id, apptab_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_has_app_tabs (id INT AUTO_INCREMENT NOT NULL, app_shop_id INT NOT NULL, app_tab_id INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_BAA375FAA04B4490 (app_shop_id), INDEX IDX_BAA375FA680FFEA3 (app_tab_id), UNIQUE INDEX APP_SHOP_HAS_TAB_UNIQUE (app_shop_id, app_tab_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_shop_app_tab_has_articles (appshophasapptab_id INT NOT NULL, article_id VARCHAR(255) NOT NULL, INDEX IDX_3FC35AA5458ACBAD (appshophasapptab_id), INDEX IDX_3FC35AA57294869C (article_id), PRIMARY KEY(appshophasapptab_id, article_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_tab (id INT AUTO_INCREMENT NOT NULL, app_id VARCHAR(255) NOT NULL, name_label_id INT DEFAULT NULL, description_label_id INT DEFAULT NULL, image INT DEFAULT NULL, name VARCHAR(45) DEFAULT NULL, name_unique VARCHAR(45) DEFAULT NULL, active TINYINT(1) DEFAULT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_5D91F0CB7987212D (app_id), INDEX IDX_5D91F0CB1F68DAF7 (name_label_id), INDEX IDX_5D91F0CB868ACD1D (description_label_id), INDEX IDX_5D91F0CBC53D045F (image), UNIQUE INDEX APP_HAS_TAB_UNIQUE (name_unique, app_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_tab_has_pay_categories (apptab_id INT NOT NULL, paycategory_id VARCHAR(255) NOT NULL, INDEX IDX_ACE890A7D1E7F272 (apptab_id), INDEX IDX_ACE890A728935E32 (paycategory_id), PRIMARY KEY(apptab_id, paycategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_tab_has_article_categories (apptab_id INT NOT NULL, articlecategory_id VARCHAR(255) NOT NULL, INDEX IDX_42DDF937D1E7F272 (apptab_id), INDEX IDX_42DDF9374DD4BC1B (articlecategory_id), PRIMARY KEY(apptab_id, articlecategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_has_app_tabs_available ADD CONSTRAINT FK_F41AD7B72FC0CB0F FOREIGN KEY (transaction_id) REFERENCES `transaction` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_app_tabs_available ADD CONSTRAINT FK_F41AD7B7D1E7F272 FOREIGN KEY (apptab_id) REFERENCES app_tab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_has_app_tabs ADD CONSTRAINT FK_BAA375FAA04B4490 FOREIGN KEY (app_shop_id) REFERENCES app_shop (id)');
        $this->addSql('ALTER TABLE app_shop_has_app_tabs ADD CONSTRAINT FK_BAA375FA680FFEA3 FOREIGN KEY (app_tab_id) REFERENCES app_tab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_app_tab_has_articles ADD CONSTRAINT FK_3FC35AA5458ACBAD FOREIGN KEY (appshophasapptab_id) REFERENCES app_shop_has_app_tabs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_shop_app_tab_has_articles ADD CONSTRAINT FK_3FC35AA57294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CB7987212D FOREIGN KEY (app_id) REFERENCES app (id)');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CB1F68DAF7 FOREIGN KEY (name_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CB868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE app_tab ADD CONSTRAINT FK_5D91F0CBC53D045F FOREIGN KEY (image) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE app_tab_has_pay_categories ADD CONSTRAINT FK_ACE890A7D1E7F272 FOREIGN KEY (apptab_id) REFERENCES app_tab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_tab_has_pay_categories ADD CONSTRAINT FK_ACE890A728935E32 FOREIGN KEY (paycategory_id) REFERENCES pay_catergory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_tab_has_article_categories ADD CONSTRAINT FK_42DDF937D1E7F272 FOREIGN KEY (apptab_id) REFERENCES app_tab (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE app_tab_has_article_categories ADD CONSTRAINT FK_42DDF9374DD4BC1B FOREIGN KEY (articlecategory_id) REFERENCES article_category (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tab_category');
        $this->addSql('DROP TABLE transaction_has_tab_categories_available');
        $this->addSql('ALTER TABLE client ADD on_create_app_can_customize_app_tabs TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A5488C5F785');
        $this->addSql('DROP INDEX IDX_4D729A5488C5F785 ON pay_method_has_provider');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP article_category_id');
        $this->addSql('ALTER TABLE app ADD can_customize_app_tabs TINYINT(1) DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_723705D119909DC0 ON transaction');
        $this->addSql('ALTER TABLE transaction ADD selected_app_tab_id INT DEFAULT NULL, DROP selected_tab_category_id');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D15F8FBA40 FOREIGN KEY (selected_app_tab_id) REFERENCES app_tab (id)');
        $this->addSql('CREATE INDEX IDX_723705D15F8FBA40 ON transaction (selected_app_tab_id)');
        $this->addSql('DROP INDEX IDX_D7C2F02F13A05411 ON pay_method');
        $this->addSql('ALTER TABLE pay_method CHANGE tab_category_id article_category_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F88C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('CREATE INDEX IDX_D7C2F02F88C5F785 ON pay_method (article_category_id)');
        $this->addSql('CREATE INDEX pay_method_id_pay_category ON pay_method (id, article_category_id)');
        $this->addSql('CREATE INDEX index_app_shop_has_articles__app_shop_id_article_id ON app_shop_has_articles (app_shop_id, article_id)');

    }

    public function postUp(Schema $schema)
    {
        return "not needed anymore";
        /** @var AppService $appService */
        $appService = $this->container->get('app.app');
        /** @var EntityManager $em */
        $em = $this->container->get('doctrine.orm.entity_manager');
        $apps = $em->getRepository("AppBundle:App")->findAll();
        foreach ($apps as $app)
        {
            $app->getClient()
                ->setOnCreateAppActiveByDefault(true)
                ->setOnCreateAppCanCustomizeAppTabs(true)
            ;

            $appService->addDefaultTabs($app);
            $app->setCanCustomizeAppTabs(true);
            $em->flush();

            $em->refresh($app);

            foreach ($app->getappShops() as $appShop)
            {
                foreach ($app->getAppTabs() as $appTab)
                {
                    $appShopHasTab = new AppShopHasAppTab();
                    $appShopHasTab
                        ->setAppTab($appTab)
                        ->setAppShop($appShop)
                    ;

                    $appShopHasArticles = $em->getRepository("AppBundle:AppShopHasArticle")->findBy(['appShop'=>$appShop]);
                    foreach ($appShopHasArticles as $appShopHasArticle)
                    {
                        if (in_array($appShopHasArticle->getArticle()->getArticleCategory()->getId(), UtilHelper::getIdsArrayFromObjects($appTab->getArticleCategories())))
                            $appShopHasTab->addArticle($appShopHasArticle->getArticle());
                    }

                    $em->persist($appShopHasTab);
                }

            }
        }
        $em->flush();

    }



    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_shop_app_tab_has_articles DROP FOREIGN KEY FK_3FC35AA5458ACBAD');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D15F8FBA40');
        $this->addSql('ALTER TABLE transaction_has_app_tabs_available DROP FOREIGN KEY FK_F41AD7B7D1E7F272');
        $this->addSql('ALTER TABLE app_shop_has_app_tabs DROP FOREIGN KEY FK_BAA375FA680FFEA3');
        $this->addSql('ALTER TABLE app_tab_has_pay_categories DROP FOREIGN KEY FK_ACE890A7D1E7F272');
        $this->addSql('ALTER TABLE app_tab_has_article_categories DROP FOREIGN KEY FK_42DDF937D1E7F272');
        $this->addSql('CREATE TABLE tab_category (id VARCHAR(255) NOT NULL, description_label_id INT NOT NULL, name VARCHAR(45) NOT NULL, class VARCHAR(45) NOT NULL, `order` INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D654A95E868ACD1D (description_label_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_has_tab_categories_available (transaction_id VARCHAR(100) NOT NULL, tabcategory_id VARCHAR(255) NOT NULL, INDEX IDX_16577B852FC0CB0F (transaction_id), INDEX IDX_16577B854CB598DB (tabcategory_id), PRIMARY KEY(transaction_id, tabcategory_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tab_category ADD CONSTRAINT FK_D654A95E868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available ADD CONSTRAINT FK_16577B854CB598DB FOREIGN KEY (tabcategory_id) REFERENCES tab_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction_has_tab_categories_available ADD CONSTRAINT FK_16577B852FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE transaction_has_app_tabs_available');
        $this->addSql('DROP TABLE app_shop_has_app_tabs');
        $this->addSql('DROP TABLE app_shop_app_tab_has_articles');
        $this->addSql('DROP TABLE app_tab');
        $this->addSql('DROP TABLE app_tab_has_pay_categories');
        $this->addSql('DROP TABLE app_tab_has_article_categories');
        $this->addSql('ALTER TABLE app DROP can_customize_app_tabs');
        $this->addSql('ALTER TABLE client DROP on_create_app_can_customize_app_tabs');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F88C5F785');
        $this->addSql('DROP INDEX IDX_D7C2F02F88C5F785 ON pay_method');
        $this->addSql('ALTER TABLE pay_method CHANGE article_category_id tab_category_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F13A05411 FOREIGN KEY (tab_category_id) REFERENCES tab_category (id)');
        $this->addSql('CREATE INDEX IDX_D7C2F02F13A05411 ON pay_method (tab_category_id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD article_category_id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A5488C5F785 FOREIGN KEY (article_category_id) REFERENCES article_category (id)');
        $this->addSql('CREATE INDEX IDX_4D729A5488C5F785 ON pay_method_has_provider (article_category_id)');
        $this->addSql('DROP INDEX IDX_723705D15F8FBA40 ON transaction');
        $this->addSql('ALTER TABLE transaction ADD selected_tab_category_id VARCHAR(255) DEFAULT NULL, DROP selected_app_tab_id');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D119909DC0 FOREIGN KEY (selected_tab_category_id) REFERENCES tab_category (id)');
        $this->addSql('CREATE INDEX IDX_723705D119909DC0 ON transaction (selected_tab_category_id)');
        $this->addSql('DROP INDEX pay_method_id_pay_category ON pay_method');
        $this->addSql('DROP INDEX index_app_shop_has_articles__app_shop_id_article_id ON app_shop_has_articles');


    }
}
