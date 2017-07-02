## Requirements

In order to install this API, your system must have:

- **[TDB 335.59](https://github.com/TrinityCore/TrinityCore/releases/)** or newer
- **PHP 5.5.9** or newer
- **OpenSSL PHP Extension**
- **PDO PHP Extension**
- **Mbstring PHP Extensionn**
- **Tokenizer PHP Extension**
- **PHP Sqlite driver (php5-sqlite)**

If you are installing it from sources you will also need:

- **[Composer](https://getcomposer.org/)**
- **[Laravel](http://laravel.com)**

### Installing requirements on Ubuntu 16.04

To install the requirements you can type the following command on the terminal:

`sudo apt install php-xml php-mbstring php-sqlite3`

`sudo service apache2 restart`

## 1) [Easy] Get full version archive of latest release

- Download latest "Full" version zip archive: https://github.com/ShinDarth/TC-JSON-API/releases/
- Extract "TC-JSON-API" folder inside your server web directory
- Go to 2)

## 1) [Developer] Install latest version from sources

- Install all the required software. If you don't have Laravel yet, after you have installed composer, just run:

`composer global require "laravel/installer=~1.1"`

- Clone the TC-JSON-API inside your server web directory:

`git clone https://github.com/ShinDarth/TC-JSON-API.git`

if you don't have [git](http://git-scm.com/) installed, you can [download it directly](https://github.com/ShinDarth/TC-JSON-API/archive/master.zip).

- Move inside the TC-JSON-API and run composer install:

`cd TC-JSON-API`

`composer install`

- Copy the file **.env.example** to **.env**

- Automatic encryption key generation:

`php artisan key:generate`

- Generate key for auth:

`php artisan jwt:generate`

## 2) Configure the API

- Create a new database that will contain all **dbc** data and import the file achievements.sql (in storage/database/achievements.sql) which contains all the dbc data of achievements.

- Open **.env** with a text editor and set properly DB_* parameters, example:

`DB_HOST=localhost`

`DB_WORLD=world`

`DB_CHARACTERS=characters`

`DB_AUTH=auth`

`DB_DBC=dbc`

`DB_USERNAME=root`

`DB_PASSWORD=yourpassword`

Note: **setting all databases is not mandatory**, just set the databases that you need.

- Run the follow command to generate the users table

`php artisan migrate`

If everything is ok you should be able to correctly open [http://localhost/TC-JSON-API/public/index.php](http://localhost/TC-JSON-API/public/index.php).

From now on you can perform HTTP requests to the API at **http://localhost/TC-JSON-API/public/index.php/**.

Check [our documentation](https://github.com/ShinDarth/TC-JSON-API/wiki) to see all possible requests.

## Enabling Debug mode

`APP_ENV=production`

`APP_DEBUG=false`

Replace with:

`APP_ENV=local`

`APP_DEBUG=true`

Now you can see error messages in your browser & logs too.

**Be careful! Do not use debug mode on production server.**

## Developing environment

You really don't need install apache or nginx on your local PC for developing, that easily to use integrated web server.
Go to root project directory and run CLI command:
`php artisan serve`

## Troubleshooting

- Ensure that the entire folder TC-JSON-API (including all its files and subfolders) have the proper file permissions.

- If you get white page or any error, check **storage/logs** to understand what happens.

- If for some reasons the API is not able to read from .env file, you have to configure database manually in **config/database.php** file.
