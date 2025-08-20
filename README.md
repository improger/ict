# About

Note: This project uses SQLite by default to simplify installation and demo.

#### Features:

* User registration & login (Laravel Breeze)

* Post CRUD (only the author can edit/delete) via Policies

* Comments (logged-in users only; only the comment author can delete)

* Categories with Many-to-Many relation

* Keyword search on post title & body

* Form Request validation; sanitized output to mitigate XSS

* Pagination; Blade + Tailwind UI




### Clone repository

```bash
git clone https://github.com/improger/ict.git ict
```

### create .env file
```bash
cd ict
cp .env.example .env
```


### Install
```bash
composer install
php artisan key:generate
npm install
```

### create the SQLite database file
```bash
touch database/database.sqlite
```

### create database tables with seeders
```bash
php artisan migrate --seed
```

### choose your web server group: www-data (Ubuntu/Debian), _www (macOS)
* WEB_GROUP=www-data

### give your user and the web group ownership
```bash
sudo chown -R "$USER:$WEB_GROUP" storage bootstrap/cache database
````

### make dirs/files group-writable (no 777)
```bash
sudo find storage bootstrap/cache -type d -exec chmod 775 {} \;
sudo find storage bootstrap/cache -type f -exec chmod 664 {} \;
```

### permissions for SQLite
```bash
sudo chown "$USER:$WEB_GROUP" database/database.sqlite
chmod 664 database/database.sqlite
```

### Run
```bash
php artisan serve
npm run build
```

### Login credentials:
Login: ict@example.com

Password: password
