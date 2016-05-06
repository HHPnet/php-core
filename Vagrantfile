# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.

$script = <<SCRIPT
sudo apt-get update
sudo apt-get install -y php5-cli php5-dev php-pear libsasl2-dev libpcre3-dev
sudo mkdir -p /usr/local/openssl/include/openssl/
sudo ln -s /usr/include/openssl/evp.h /usr/local/openssl/include/openssl/evp.h
sudo mkdir -p /usr/local/openssl/lib/
sudo ln -s /usr/lib/x86_64-linux-gnu/libssl.a /usr/local/openssl/lib/libssl.a
sudo ln -s /usr/lib/x86_64-linux-gnu/libssl.so /usr/local/openssl/lib/
sudo pecl install mongodb
sudo echo "extension=mongodb.so" >> `php --ini | grep "Loaded Configuration" | sed -e "s|.*:\s*||"`
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '92102166af5abdb03f49ce52a40591073a7b859a86e8ff13338cf7db58a19f7844fbc0bb79b2773bf30791e935dbd938') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
sudo chmod a+x /usr/local/bin/composer
SCRIPT

Vagrant.configure(2) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.network "forwarded_port", guest: 80, host: 8080

  config.vm.provision "shell", inline: $script
end
