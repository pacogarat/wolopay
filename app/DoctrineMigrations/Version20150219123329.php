<?php

namespace Application\Migrations;

use AppBundle\Entity\Enum\PaymentServiceCategoryEnum;
use AppBundle\Entity\Enum\PayMethodEnum;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150219123329 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /** @var \Doctrine\ORM\EntityManager $em */
        $em=$this->container->get('doctrine.orm.default_entity_manager');

        $stmt=$em->getConnection()->prepare('
            select * from pay_method_has_provider
            inner join pay_method on (pay_method.id = pay_method_has_provider.pay_method_id)
        ');
        $stmt->execute();
        $pmpAllArr = $stmt->fetchAll();

        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $em->getConnection()->exec('ALTER TABLE pay_method ADD img_icon INT NOT NULL, ADD description_label_id INT DEFAULT NULL, ADD name VARCHAR(45) NOT NULL');
        $this->addSql('UPDATE pay_method set img_icon = (select min(id) from media__media);');
        $migration = [];
        $idSMS=null;
        foreach ($pmpAllArr as $pmp)
        {
            $name = $pmp['name'];
            if (in_array($pmp['payment_service_category_id'],[PaymentServiceCategoryEnum::FORTUNO_IPN, PaymentServiceCategoryEnum::NVIA_SMS_IPN]))
                $name=PayMethodEnum::SMS_NAME;

            if ($name==PayMethodEnum::SMS_NAME && $idSMS)
            {
                $migration[]=[$pmp['pay_method_id'], $idSMS];
                continue;
            }

            if (!$name)
                $name = $pmp['payment_service_category_id'];

            $sql = 'INSERT INTO `pay_method`
                (
                `method_category_id`,
                `pay_category_id`,
                `created_at`,
                `img_icon`,
                `description_label_id`,
                `name`)
                VALUES
                (
                "'.$pmp['method_category_id'].'",
                "'.$pmp['pay_category_id'].'",
                NOW(),
                '.$pmp['img_icon'].',
                '.($pmp['description_label_id'] ? $pmp['description_label_id'] : 'NULL').',
                "'.$name.'");
            ';

            $em->getConnection()->exec($sql);
            $migration[]=[$pmp['pay_method_id'], $em->getConnection()->lastInsertId()];

            if ($name=PayMethodEnum::SMS_NAME && !$idSMS)
            {
                $idSMS=$em->getConnection()->lastInsertId();
            }
        }

        //Now we need modify all Old paymethods ids
        foreach ($migration as $now)
        {
            $this->addSql('update payment_detail set pay_method_id = '.$now[1].' where pay_method_id= '.$now[0]);
            $this->addSql('update pay_method_has_provider set pay_method_id = '.$now[1].' where pay_method_id= '.$now[0]);
        }

        $this->addSql('ALTER TABLE purchase ADD pay_method_id INT NOT NULL');


        foreach ($migration as $now)
        {
            $this->addSql('update payment_detail set pay_method_id = '.$now[1].' where pay_method_id= '.$now[0]);
        }

        $this->addSql('
            update purchase
            join payment on (payment.id = purchase.payment_id)
            join payment_detail on (payment_detail.id = payment.id)
            set purchase.pay_method_id = payment_detail.pay_method_id ;
        ');

        $this->addSql('ALTER TABLE article_amount ADD amount_owned_currency DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54868ACD1D');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP FOREIGN KEY FK_4D729A54AB85D8E3');
        $this->addSql('DROP INDEX IDX_4D729A54AB85D8E3 ON pay_method_has_provider');
        $this->addSql('DROP INDEX IDX_4D729A54868ACD1D ON pay_method_has_provider');
        $this->addSql('DROP INDEX PMP_UNIQUE ON pay_method_has_provider');
        $this->addSql('ALTER TABLE pay_method_has_provider DROP description_label_id, DROP img_icon');
        $this->addSql('CREATE UNIQUE INDEX PMP_UNIQUE ON pay_method_has_provider (pay_method_id, provider_id)');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B51FD67EA');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BCA12280B');
        $this->addSql('DROP INDEX IDX_6117D13BCA12280B ON purchase');
        $this->addSql('DROP INDEX IDX_6117D13B51FD67EA ON purchase');
        $this->addSql('ALTER TABLE purchase DROP method_category_id, DROP pay_category_id');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B3486861B FOREIGN KEY (pay_method_id) REFERENCES pay_method (id)');
        $this->addSql('CREATE INDEX IDX_6117D13B3486861B ON purchase (pay_method_id)');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02FAB85D8E3 FOREIGN KEY (img_icon) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE pay_method ADD CONSTRAINT FK_D7C2F02F868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('CREATE INDEX IDX_D7C2F02FAB85D8E3 ON pay_method (img_icon)');
        $this->addSql('CREATE INDEX IDX_D7C2F02F868ACD1D ON pay_method (description_label_id)');

        $this->addSql('delete from pay_method where name is null or name = "";');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_amount DROP amount_owned_currency');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02FAB85D8E3');
        $this->addSql('ALTER TABLE pay_method DROP FOREIGN KEY FK_D7C2F02F868ACD1D');
        $this->addSql('DROP INDEX IDX_D7C2F02FAB85D8E3 ON pay_method');
        $this->addSql('DROP INDEX IDX_D7C2F02F868ACD1D ON pay_method');
        $this->addSql('ALTER TABLE pay_method DROP img_icon, DROP description_label_id, DROP name');
        $this->addSql('DROP INDEX PMP_UNIQUE ON pay_method_has_provider');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD description_label_id INT DEFAULT NULL, ADD img_icon INT NOT NULL');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54868ACD1D FOREIGN KEY (description_label_id) REFERENCES lexik_trans_unit (id)');
        $this->addSql('ALTER TABLE pay_method_has_provider ADD CONSTRAINT FK_4D729A54AB85D8E3 FOREIGN KEY (img_icon) REFERENCES media__media (id)');
        $this->addSql('CREATE INDEX IDX_4D729A54AB85D8E3 ON pay_method_has_provider (img_icon)');
        $this->addSql('CREATE INDEX IDX_4D729A54868ACD1D ON pay_method_has_provider (description_label_id)');
        $this->addSql('CREATE UNIQUE INDEX PMP_UNIQUE ON pay_method_has_provider (pay_method_id, provider_id, payment_service_category_id)');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B3486861B');
        $this->addSql('DROP INDEX IDX_6117D13B3486861B ON purchase');
        $this->addSql('ALTER TABLE purchase ADD method_category_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD pay_category_id VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP pay_method_id');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B51FD67EA FOREIGN KEY (method_category_id) REFERENCES method_catergory (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BCA12280B FOREIGN KEY (pay_category_id) REFERENCES pay_catergory (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BCA12280B ON purchase (pay_category_id)');
        $this->addSql('CREATE INDEX IDX_6117D13B51FD67EA ON purchase (method_category_id)');
    }
}
