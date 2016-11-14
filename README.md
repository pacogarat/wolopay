![picture alt](https://wolopay.com/img/logo_500x100.png)

Install
=======

        git clone --recursive repository_domain

OR

        git clone domain
        cd doc/examples/lib
        git submodule init
        git submodule update

And

        composer install (ETC)

PDF Generator (wkhtmltopdf)
Install from http://wkhtmltopdf.org/downloads.html

We use ide PHPStorm

- Auto complete use Symfony 2 plugin
- To open files from browser need to install remote call plugin: http://plugins.intellij.net/plugin/?idea&id=6027
- Markdown Navigator

Rare troubles
=============

- If country have only article and this article have a property "N Purchases Per Client" and gamer exceed this limit,
that shop show a warning saying this shop doesn't contain any articles

PHP unit
========

Required selenium to test E2E
java -jar /var/www/wolopay/selenium-server-standalone-2.42.2.jar  -Dwebdriver.chrome.driver="/var/www/wolopay/chromedriver" -p 4444

        phpunit --configuration phpunit.xml --testsuite unit --testsuite functional --process-isolation
        phpunit --configuration phpunit.xml --testsuite local --process-isolation
        phpunit --configuration phpunit.xml --testsuite local --process-isolation --exclude-group=E2E
        phpunit --configuration phpunit.xml --testsuite E2E --process-isolation

multi process # DOESN'T WORK

        bin/paratest --phpunit=bin/phpunit --configuration=phpunit.xml
        bin/paratest --phpunit=bin/phpunit --configuration=phpunit.xml --exclude-group=E2E -f

Fastest way and execute all local
---------------------------------

find tests/ -name "*Test.php" | ./bin/fastest -p 3 "bin/phpunit --exclude=E2E {};" &&  phpunit --configuration phpunit.xml --testsuite local --group=E2E

Max speed Testing
-----------------

Use memory like a folder

        sudo mkfs -q /dev/ram1 8192
        sudo mkdir -p /ramcache
        sudo mount /dev/ram1 /ramcache
        sudo df -H | grep ramcache
        sudo chmod 777 -R /ramcache

Load all datafixtures
---------------------

php bin/console doctrine:fixtures:load --fixtures=/var/www/sym2_pay_gateway/src/Nvia/AppShopBundle/DataFixtures/ORM --fixtures=/var/www/sym2_pay_gateway/src/Nvia/PayMethodConfigBundle/DataFixtures/ORM --fixtures=/var/www/sym2_pay_gateway/src/Nvia/CommonBundle/DataFixtures/ORM --fixtures=/var/www/sym2_pay_gateway/src/Nvia/ApiBundle/DataFixtures/ORM  --fixtures=/var/www/sym2_pay_gateway/src/Nvia/AppShopBundle/DataFixtures/Specific


Summary Deploy
--------------

** This section is outdated see jenkins conf **

cp app/config/parameters.yml.dist app/config/parameters.yml

composer install --prefer-dist

bin/paratest -f --phpunit=bin/phpunit --configuration=phpunit.xml --exclude-group=E2E

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
php bin/console doctrine:fixtures:load --no-interaction

php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:migrations:migrate 20141104105120 --no-interaction

cap deploy:migrations

Commands to Develop
===================

php bin/console assetic:watch
cd node_app && node index.js

Vagrant
=======

**Vagrant have performance problems, too slow at this moment**

user: root
password: root

mysql
user: root
pasword: root


It appears your machine doesn't support NFS
apt-get install nfs-kernel-server

