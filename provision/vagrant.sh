#!/bin/bash
echo "MC Vagrant Provision Script"

export DEBIAN_FRONTEND=noninteractive

echo "Adding NodeJS Repository"
curl -sL https://deb.nodesource.com/setup_4.x | sudo -E bash -

echo "Updating Apt"
apt-get update

echo "Installing Apache"
apt-get install -y apache2

echo "Installing PHP"
apt-get install -y php5 php5-gd php5-mcrypt php5-memcached php5-pgsql php5-curl

echo "Installing XDebug (PHP Debugger)"
apt-get install -y php5-dev libpcre3-dev php-pear
pecl install xdebug
ln -s /etc/php5/mods-available/xdebug.ini /etc/php5/apache2/conf.d/20-xdebug.ini
ln -s /etc/php5/mods-available/xdebug.ini /etc/php5/cli/conf.d/20-xdebug.ini

echo "Installing PostgreSQL"
apt-get install -y postgresql postgresql-contrib

echo "Installing Memcached"
apt-get install -y memcached

echo "Installing NodeJS"
apt-get install -y nodejs

echo "Installing Composer"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer config --global github-oauth.github.com 2c1891d5a8962b23bbd3253d31b6004dc04e789b

echo "Installing Gulp"
npm install gulp --global

echo "Creating symbolic links"
chmod 777 /vagrant/provision/vagrant_links/usr/local/bin/reload_links
/vagrant/provision/vagrant_links/usr/local/bin/reload_links

echo "Configuring Apache"
ln -s /vagrant /var/www/laravel
a2enmod rewrite
service apache2 restart

echo "Configuring PostgreSQL"
sudo -u postgres bash -c "psql -c \"CREATE USER vagrant WITH PASSWORD 'vagrant';\""
sudo -u postgres bash -c "psql -c \"CREATE DATABASE vagrant OWNER vagrant;\""

echo "Configuring Laravel"
if [ ! -f /var/www/laravel/.env ]; then
    ln -s /vagrant/provision/vagrant.env /var/www/laravel/.env
fi
chown -R vagrant:vagrant /var/www/laravel
chmod -R 775 /var/www/laravel/storage
cd /var/www/laravel
composer install
php artisan migrate --seed