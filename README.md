# About

Note: This project uses SQLite by default to simplify installation and demo.

#### Features:

* User registration & login (Laravel Breeze)

* Post CRUD (only the author can edit/delete) via Policies

* Comments (logged-in users only; only the comment author can delete)

* Categories with Many-to-Many relation

* Keyword search on post title & body (?q=) + category filter (?category=slug)

* Form Request validation; sanitized output to mitigate XSS

* Pagination; Blade + Tailwind UI


## Download repository:
SSH: git@github.com:improger/ict.git

HTTPS: https://github.com/improger/ict.git


### Clone

ssh: git clone git@github.com:improger/ict.git ict

https: git clone https://github.com/improger/ict.git ict

cd ict

cp .env.example .env

### Install
* composer install
* php artisan key:generate
* php artisan migrate --seed
* npm install

### create the SQLite database file
* touch database/database.sqlite

### choose your web server group: www-data (Ubuntu/Debian), _www (macOS)
* WEB_GROUP=www-data

### give your user and the web group ownership
* sudo chown -R "$USER:$WEB_GROUP" storage bootstrap/cache database

### make dirs/files group-writable (no 777)
* sudo find storage bootstrap/cache -type d -exec chmod 775 {} \;
* sudo find storage bootstrap/cache -type f -exec chmod 664 {} \;

### SQLite database file
* touch database/database.sqlite
* sudo chown "$USER:$WEB_GROUP" database/database.sqlite
* chmod 664 database/database.sqlite

### Run
* php artisan serve
* npm run build
