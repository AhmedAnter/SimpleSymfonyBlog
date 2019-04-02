This is a very simple blog application building with Symfony PHP framework version 4.

Please follow these steps to get all things work and shine like a star.

- First, make sure you have the following in your machine installed and running correctly:
(php, mysql, web server and composer)

- Open terminal and change directory to wherever your workspace folder

- Run this command to clone the repository:
$ git clone https://github.com/AhmedAnter/SimpleSymfonyBlog.git

- Change directory to the app directory and run this command to install the dependencies:
$ composer install

- Run this command to start the server:
$ php bin/console server:run

- Run these commands to create the database and tables:
$ php bin/console doctrine:database:create
$ php bin/console doctrine:schema:update --force

- Run these commands to load a fake data into the database:
$ php bin/console doctrine:fixtures:load
and enter yes

Well done! you finished and everything is ok.
Now, you go to http://localhost:8000 and happy browsing ^_^