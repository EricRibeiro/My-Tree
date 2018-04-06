# MyTree
A platform meant to encourage people and institutions to help save the world through reforestation.

### Install

In the project folder, execute:

    composer install

This will install the project dependencies.

### Modules

To list the existing modules just execute this one in the root folder:

    ./vendor/bin/zf.php modules

And to create your own module:

    ./vendor/bin/zf.php create module MODULE-NAME

### PHP CLI Server

The simplest way to get started if you are using PHP 5.4 or above is to start the internal PHP cli-server in the root directory:

    php -S 0.0.0.0:8080 -t public/ public/index.php

This will start the cli-server on port 8080, and bind it to all network
interfaces.