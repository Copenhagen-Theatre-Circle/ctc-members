#!/bin/bash

# The purpose of this script is to enable easy installation of the necessary components to run the app locally.
# The prerequisite to running this is having PHP version 7.1 installed, the script should take care of the rest.
# Also make sure to configure the .env file with the connection to the local DB instance of MySQL.

output=$(php composer.phar --version 2>&1)

# Check if composer installed
if [ $? -ne 0 ]; then
    echo "Composer doesn't seem to be installed, installing now..."
    # Run installation (from here: https://getcomposer.org/download/)
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
else
    echo "Composer installed, version: $output"
fi

php composer.phar dump-autoload
php composer.phar install --no-scripts
php composer.phar update
php artisan key:generate
php artisan migrate
php artisan db:seed

# After the above steps have been executed once, you only need the below command to start the local app server at any time.
# (The server will run in hot reload mode)
php artisan serve

