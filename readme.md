composer require symfony/apache-pack

php bin/console cache:clear
php bin/console cache:clear --no-warmup --env=prod
php bin/console assets:install

очистка кеша на сервере
/opt/php72/bin/php bin/console cache:clear
/opt/php72/bin/php bin/console cache:clear --no-warmup --env=prod

php bin/console make:crud Customer

php bin/console make:crud Company -n --format=annotation --with-write

php bin/console doctrine:mapping:import App\Entity annotation --path=src/Entity --filter="Company"

обновить базу данных согластно entity
php bin/console doctrine:schema:create
Создать базу данных
php bin/console doctrine:database:create

git pull

git reset --hard

git clone https://Fagot@bitbucket.org/Fagot/belstroi.by.git
git clone https://Fagot@bitbucket.org/Fagot/belstroi.by.git idei.by

chown -R www-data:www-data var

---- все доступные пути шаблонов
php bin/console debug:twig
php bin/console debug:router


composer update tetranz/select2entity-bundle

инстал composer
/opt/php72/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --filename=composer
php -r "unlink('composer-setup.php');"
