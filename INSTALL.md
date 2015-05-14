## Requirements

In order to install this API, your system must have:

- **[TDB 335.58](https://github.com/TrinityCore/TrinityCore/releases/)** or newer
- **PHP 5.4** or newer
- **Mcrypt PHP Extension**

If you are installing it from sources you will also need:

- **[Composer](https://getcomposer.org/)**
- **[Laravel](http://laravel.com)**

You may also need:

- OpenSSL PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension

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
 
## 2) Configure the API

- Open **.env** with a text editor and set properly DB_* parameters, example:

`DB_HOST=localhost`

`DB_WORLD=world`

`DB_CHARACTERS=characters`

`DB_AUTH=auth`

`DB_USERNAME=root`

`DB_PASSWORD=yourpassword`

Note: you **do not need** to set all databases, just set the database that you need.

- If for some reasons the API is not able to read from .env file, you have to configure database manually in **config/database.php** file.

- Ensure that the entire folder TC-JSON-API (including all its files and subfolders) have the proper file permissions.

If everything is ok you should be able to correctly open [http://localhost/TC-JSON-API/public/index.php](http://localhost/TC-JSON-API/public/index.php).

From now on you can perform HTTP requests to the API at **http://localhost/TC-JSON-API/public/**.

Check [our documentation](https://github.com/ShinDarth/TC-JSON-API/wiki) to see all possible requests.
