
```
  _    _           _              _   _____      _        _                  
 | |  | |         | |            | | |  __ \    | |      | |                 
 | |__| | __ _ ___| |__   ___  __| | | |__) |__ | |_ __ _| |_ ___   ___  ___ 
 |  __  |/ _` / __| '_ \ / _ \/ _` | |  ___/ _ \| __/ _` | __/ _ \ / _ \/ __|
 | |  | | (_| \__ \ | | |  __/ (_| | | |  | (_) | || (_| | || (_) |  __/\__ \
 |_|  |_|\__,_|___/_| |_|\___|\__,_| |_|   \___/ \__\__,_|\__\___/ \___||___/
 ```
                                                                            


![PHP Composer](https://github.com/cstringer17/HashedPotatoes/workflows/PHP%20Composer/badge.svg)

# Password Playground in PHP

To get our project running run the following MYSQL script in a MYSQL installation [MYSQL File](./mysql/userRegisterTable.sql)

After that you can run the PHP Files, maybe start with [Register Page](./pages/register.php)



## Installation

First clone the repository


`git clone https://github.com/cstringer17/HashedPotatoes.git`

Then cd into the root folder and run the following composer command to install the dependencies
Download composer here: https://getcomposer.org/download/

`composer install`

### Database setup

The following script sets up the mysql database with all the users and tables

mysql/userRegisterTable.sql

### hCaptcha Setup

As we use captcha on this web application there are a few changes that need to be done to get this to work in local development the following instructions taken from the hCaptcha Developer Docs will get it running:


> Modern browsers have strict CORS and CORB rules, so opening a file:// URI that loads hCaptcha will not work. Loading hCaptcha from http://localhost/ will encounter the same issue on some browsers. The hCaptcha API also prohibits 'localhost' and '127.0.0.1' as supplied hostnames.
> The simplest way to circumvent these issues is to add a hosts entry. For example:

`127.0.0.1 test.mydomain.com`

> Place this in /etc/hosts on Linux, /private/etc/hosts on Mac OS X, or C:\Windows\System32\Drivers\etc\hosts on Windows.
> You can then access your local server via http://test.mydomain.com, and everything will work as expected.

Quoted from https://docs.hcaptcha.com/#localdev


### Running the web server
In VSCode you can use the following extension to run the php webserver

https://github.com/brapifra/vscode-phpserver

As we changed the host file in the hCaptcha setup you will need to point the extension to the domain name given above:

![image](https://github.com/cstringer17/hashedpotatoes/blob/master/docs/web-server-config.png?raw=true)

### PHP Sodium configuration

The application uses the PHP sodium library to encrypt passwords, this however needs to be enables in the php.ini file inside your php installation. Add the following line to that file

`extension=php_sodium.dll`




created by @cstringer17 and @FlicT1337
