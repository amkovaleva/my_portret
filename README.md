<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![build](https://github.com/yiisoft/yii2-app-basic/workflows/build/badge.svg)](https://github.com/yiisoft/yii2-app-basic/actions?query=workflow%3Abuild)

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------
### Развернуть проект:

1. Выгрузить из гита
2. Создать базу данных. Если нужно подправить config/db.php.
3. composer update
4. ./yii migrate --migrationNamespaces=Da\\User\\Migration
Если будет ругаться на m211114_182855_add_admin_user - ничего страшного. Выполнится в пункте 6.
5. ./yii migrate --migrationPath=@yii/rbac/migrations
6. ./yii migrate
7. Не за быть дать доступ на запись в дирректории runtime, web/assets, web/uploads

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this project template using the following command:

~~~
composer create-project --prefer-dist yiisoft/yii2-app-basic basic
~~~

Now you should be able to access the application through the following URL, assuming `basic` is the directory
directly under the Web root.

~~~
http://localhost/basic/web/
~~~

### Install from an Archive File

Extract the archive file downloaded from [yiiframework.com](http://www.yiiframework.com/download/) to
a directory named `basic` that is directly under the Web root.

Set cookie validation key in `config/web.php` file to some random secret string:

```php
'request' => [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey' => '<secret random string goes here>',
],
```

You can then access the application through the following URL:

~~~
http://localhost/basic/web/
~~~


### Install with Docker

Update your vendor packages

    docker-compose run --rm php composer update --prefer-dist
    
Run the installation triggers (creating cookie validation code)

    docker-compose run --rm php composer install    
    
Start the container

    docker-compose up -d
    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.
- Refer to the README in the `tests` directory for information specific to basic application tests.


TESTING
-------

Tests are located in `tests` directory. They are developed with [Codeception PHP Testing Framework](http://codeception.com/).
By default there are 3 test suites:

- `unit`
- `functional`
- `acceptance`

Tests can be executed by running

```
vendor/bin/codecept run
```

The command above will execute unit and functional tests. Unit tests are testing the system components, while functional
tests are for testing user interaction. Acceptance tests are disabled by default as they require additional setup since
they perform testing in real browser. 


### Running  acceptance tests

To execute acceptance tests do the following:  

1. Rename `tests/acceptance.suite.yml.example` to `tests/acceptance.suite.yml` to enable suite configuration

2. Replace `codeception/base` package in `composer.json` with `codeception/codeception` to install full featured
   version of Codeception

3. Update dependencies with Composer 

    ```
    composer update  
    ```

4. Download [Selenium Server](http://www.seleniumhq.org/download/) and launch it:

    ```
    java -jar ~/selenium-server-standalone-x.xx.x.jar
    ```

    In case of using Selenium Server 3.0 with Firefox browser since v48 or Google Chrome since v53 you must download [GeckoDriver](https://github.com/mozilla/geckodriver/releases) or [ChromeDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads) and launch Selenium with it:

    ```
    # for Firefox
    java -jar -Dwebdriver.gecko.driver=~/geckodriver ~/selenium-server-standalone-3.xx.x.jar
    
    # for Google Chrome
    java -jar -Dwebdriver.chrome.driver=~/chromedriver ~/selenium-server-standalone-3.xx.x.jar
    ``` 
    
    As an alternative way you can use already configured Docker container with older versions of Selenium and Firefox:
    
    ```
    docker run --net=host selenium/standalone-firefox:2.53.0
    ```

5. (Optional) Create `yii2basic_test` database and update it by applying migrations if you have them.

   ```
   tests/bin/yii migrate
   ```

   The database configuration can be found at `config/test_db.php`.


6. Start web server:

    ```
    tests/bin/yii serve
    ```

7. Now you can run all available tests

   ```
   # run all available tests
   vendor/bin/codecept run

   # run acceptance tests
   vendor/bin/codecept run acceptance

   # run only unit and functional tests
   vendor/bin/codecept run unit,functional
   ```

### Code coverage support

By default, code coverage is disabled in `codeception.yml` configuration file, you should uncomment needed rows to be able
to collect code coverage. You can run your tests and collect coverage with the following command:

```
#collect coverage for all tests
vendor/bin/codecept run --coverage --coverage-html --coverage-xml

#collect coverage only for unit tests
vendor/bin/codecept run unit --coverage --coverage-html --coverage-xml

#collect coverage for unit and functional tests
vendor/bin/codecept run functional,unit --coverage --coverage-html --coverage-xml
```

You can see code coverage output under the `tests/_output` directory.


ОБНОВЛЕНИЕ ПРОДАКШЕНА
-----------------------

ВАЖНО!!!
изображения в папке web/uploads/orders/ сайтов не хранятся в гите =>
перед обновлением нужно сделать их бэкап!!

1. Перейти на хостинг
```
ssh alinas8h_ssh@alinas8h.beget.tech
   ```
и ввести пароль от ssh.

На консоли должна появиться строка, начинающаяся с alinas8h_ssh@ikarus2:

2. В корне (видны папки с сайтами) выкачать проект (если нет папки my_portret)
```
git clone https://github.com/amkovaleva/my_portret.git
   ```

3. перейти в папку проекта
```
   cd my_portret
```

4. Если пропущен пункт 2 или были коммиты (с push), то обновляемся
```
   git fetch
   git pull
```

5. Заменяем конфиги (если пропущен пункт 2)
```
   cd config/
   rm db.php
   cp db.php.prod db.php
```

```
rm web.php
cp web.php.prod.en web.php
```

```
cd ../web/
rm index.php
cp index.php.prod  index.php
```

6. обновить модули (если были изменения в composer.json) или вгружали проект с нуля (пункт 2)
выполняется из папки my_portret
```	

cd folder - переход в папку folder
cd ../ - переход в родительскую директорию 
      
rm vendor 

composer-php7.4 install
```

7. Если нужно програть миграции
   1) Сделать бэкап базы данных
   - https://ikarus2.beget.com/phpMyAdmin/
     alinas8h_sql и пароль
   - экспорт
   - выбрать Обычный - отображать все возможные настройки
   - выбрать Добавить выражение CREATE DATABASE / USE
   - вперед => должен скачаться файл
   - Положить этот файл в корень сайта (у себя на компьютере) - заменить portrait.sql
   - сделать коммит и пуш

   2) перейти в папку my_portret
```	
      cd folder - переход в папку folder
```
```
      cd ../ - переход в родительскую директорию
```

   3) php7.4 yii migrate

7. сделать бэкап фото заказов
```
   rm orders_en.zip
   rm orders_ru.zip
   zip -r orders_en.zip sekatski.com/public_html/uploads/orders/
   zip -r orders_ru.zip sekatsky.ru/public_html/uploads/orders/
```

8. удобнее в менеджере заменить содержимое.
   - удалить в sekatski.com все кроме папки public_html
   - скопировать в sekatski.com из my_portret все кроме web  и .git
   - скопировать в sekatski.com/public_html из my_portret/web

   - Аналогично скопировать sekatski.com в sekatsky.ru
   - заменить конфиг
```
rm sekatsky.ru/config/web.php
cp sekatsky.ru/config/web.php.prod.ru sekatsky.ru/config/web.php
```

   - скопировать архивы обратно и распокавать

9. Не забываем обновить права на дирректрии

```
chmod 766 -R sekatski.com/public_html/uploads/
chmod 766 -R sekatski.com/public_html/assets/
chmod 766 -R sekatski.com/runtime/
```

```
chmod 766 -R sekatsky.ru/public_html/uploads/
chmod 766 -R sekatsky.ru/public_html/assets/
chmod 766 -R sekatsky.ru/runtime/
```
