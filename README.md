Cinnebar
========

Layout for web development using PHPUnit, Flight, RedBeanPHP and Boilerplate stuff.

Todo
----

Write complete documentation for installation:

* Download from github
* Composer
* Database creation
* Setup virtual host
* Install controller


Features
--------

* Multilingual
* Role based access control

Installation
------------

Create a database.

Copy the _config.examle.php_ in app/config and name it config.php.

Open it with a text editor and make changes as you fancy, e.g. enter the login information for the database(s) used. Do not forget to choose a install passcode that is not the default one.

In your project directory do:

composer install

In directory public create a folder upload and make it writeable for PHP.

Point your browser to http://example.com/install and follow the instructions.

Start writing template, models and controllers until you have a shiny new application handy.


Docs
----

I have to write documentation and examples about helpers and conventions, maybe:

* Url::build
* Gravatar::src
* Flight::textile


Notes to self
-------------

The following is more of a note to myself.


Composer
--------

I use [Composer](http://getcomposer.org/).

The following requires you to have composer.phar installed and in your $PATH.
There must also already be a composer.json file in your project directory.

On your command line do this to install your project:

cd /path/to/project

composer install

On your command line do this to update your project:

cd /path/to/project

composer update

RedBeanPHP
----------

I enjoy [RedBeanPHP](http://redbeanphp.com/) as a ORM, so it is included as require-dev when you install via composer. Nevertheless the really used RedBeanPHP is in /src/lib/redbean because RedBeans composer does not offer a compiled version. Instead it offers a redbean.inc.php file which does not have all the stuff from the compiled version.


Tests
-----

Make a copy of _setup.example.php_ in tests/ and name it setup.php. Open that file and edit the login information for a test database. Do _not_ use your production database for testing, because the database will be nuked before testing.

I use [PHPUnit](http://phpunit.de/).

On your command line do this to run all tests:

cd /path/to/project/tests

../vendor/bin/phpunit .

Problems
--------

Today i noticed that a case-sensitive server would not find my classes in src. So i went ahead and changed the folder and filenames as needed. But Git for Mac ignored my changes. I googled a tip where to change the ignorecase flag for the mac here http://www.garron.me/en/bits/git-ignorecase-rename-lowercase-uppercase.html and did so. After a commit i noticed that now i had both folder, the one lowercase and the other uppercase. I reverted the change in the .git/config file and had some trouble because now all my folders where gone. As a git dummy i tried revert, but messed that up. How to avoid this? Is this only on a Mac? Does it happen only when ignorecase is set to false after folders have already been created? No answer for a dancer.



Website
-------

Feel free to visit [sah-company.com](http://sah-company.com).