#! /bin/bash

wget -O phpmyadmin.zip 'https://files.phpmyadmin.net/phpMyAdmin/4.7.4/phpMyAdmin-4.7.4-all-languages.zip'
unzip phpmyadmin.zip

mv -T phpMyAdmin-4.7.4-all-languages phpmyadmin
