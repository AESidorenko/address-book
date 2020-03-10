# Address book
### Demo application, author Anton E. Sidorenko, 10.03.2020

## Requirements
1. PHP version: 7.0, php7.0-intl, php7.0-sqlite3 extension required

2. SQLite version: 3.0+

3. composer

* _Project uses Symfony 3.4 framework - it will be installed by composer_
* _Recommended php.ini value for upload_max_filesize > 5M_   

## Installation & run

* Clone this repository:
```shell script
git clone https://github.com/AESidorenko/address-book.git
```

* Go to the project root directory:
```shell script
cd address-book
```  

* Run deploy script:
```shell script
sh bin/deploy.sh
```

* Configure and start your web server, e.g. for symfony local web server run:
```shell script
symfony server:start
```

* Open project site in your browser:
http://127.0.0.1:8000