# Symfony2 Blog

This is a blog written in symfony2. It includes a gallery and a way of embedding galleries and images within blog posts.

It also includes a simple Paypal shop, which is currently a work in progress.

Mostly this project is just for me to learn symfony2, but maybe someone will find it useful.

The project is forked from here: https://github.com/dsyph3r/symblog
An excellent symfony2 tutorial which was the basis for this project.

## Installing and configuring

 1. Clone the repository
 2. cd into the project directory and run 'php setup' to create the config/param files and install vendors and assets.
 3. Add your db details to the file 'app/config/parameters.ini'.
 4. Run 'php setup' again to create the db, create the schema and load fixtures.
 5. Add your mail account details to 'app/config/parameters.ini' to receive contact emails from the site.
 6. If you're using the Shop bundle, add your paypal email address to 'src/Blogger/ShopBundle/Resources/config/config.yml'
 
### If you have trouble with the setup script
 
 1. Rename 'app/config/parameters.ini.dist' to 'app/config/parameters.ini' and add your parameters
 2. Rename 'src/Blogger/BlogBundle/Resources/config/config.yml.dist' to 'src/Blogger/BlogBundle/Resources/config/config.yml' and add your parameters
 3. Rename 'src/Blogger/ShopBundle/Resources/config/config.yml.dist' to 'src/Blogger/ShopBundle/Resources/config/config.yml' and add your parameters
 4. Run 'php bin/vendors install' to install all the required vendors
 5. Install the assets with 'php app/console assets:install web' or  'php app/console assets:install web --symlink'
 6. Create the database with 'php app/console doctrine:database:create'
 7. Create the schema with 'php app/console doctrine:schema:create'
 8. Load fixtures with 'php app/console doctrine:fixtures:load'


Original symblog tutorial readme below.

==============================================================

# symblog tutorial - Creating a blog in Symfony2

## Introduction

This project is the documentation source for the symblog tutorial located at
http://tutorial.symblog.co.uk

Full details of this project can be found at the
[symblog tutorial](http://tutorial.symblog.co.uk) site.

The demo site for this project can be found at http://symblog.co.uk

## Installing

 1. Clone the repository
 2. Rename 'app/config/parameters.ini.dist' to 'app/config/parameters.ini'
 3. Run 'php bin/vendors install' to install all the required vendors
 4. Install the assets with 'php app/console assets:install web'
 5. Create the database with 'php app/console doctrine:database:create'
 6. Update schema with 'php app/console doctrine:schema:create'
 7. Load fixtures with 'php app/console doctrine:fixtures:load'

## Updating to Symfony 2.0.4

If you already have a clone of the repo you will need to update your vendors by running

```
$ php bin/vendors install
$ php app/console cache:clear
```

More information can be found on the [Symfony 2 blog](http://symfony.com/blog)

