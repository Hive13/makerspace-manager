#!/bin/bash

cmd_exists () {
  type "$1" >/dev/null 2>/dev/null
}

if [[ $EUID -ne 0 ]]; then
   echo "This script must be run as root" 1>&2
   exit 1
fi

if(! cmd_exists php); then
    echo "Installing PHP"
    apt-get install -y php5
fi

if(! cmd_exists node); then
    echo "Installing NodeJS"
    apt-get install -y nodejs
    if(! cmd_exists node); then
            if(cmd_exists nodejs); then
                echo "Setting symlink"
                ln -s /usr/bin/nodejs /usr/bin/node
            fi
    fi
fi

if(! cmd_exists gulp); then
    echo "Installing Gulp"
    npm install gulp --global
fi

if(! cmd_exists composer); then
    echo "Installing Composer"
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

echo "Running composer install"
composer install

echo "Running NPM install"
npm install

echo "Copying .env file"
cp .env.example .env

echo "Generating app key"
php artisan key:generate