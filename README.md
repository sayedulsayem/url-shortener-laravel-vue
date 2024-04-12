# URL Shortener Laravel Vue
A basic URL shortener project with laravel and vue

## Requirements
- PHP >= 8.1
- Laravel <= 10.0
- MySQL
- Composer

## Setup instructions
### Clone repository
```bash
git clone git@github.com:sayedulsayem/url-shortener-laravel-vue.git
cd url-shortener-laravel-vue
```
### Install dependency
```bash
composer install
```
### Copy `.env.example` to `.env` file
```bash
cp .env.example .env
```
### Connect Database
- Create a database in your mysql. e.g. url-shortener-laravel-vue
- Or use database dumped provided with project.
- Place database credentials in you `.env` file
```env
DB_DATABASE=url-shortener-laravel-vue
DB_USERNAME=<DATABASE-USER> # This is database user name
DB_PASSWORD=<DATABASE-PASSWORD> # This is database password
GOOGLE_SAFE_BROWSING_API_KEY=<API_KEY> # This is for google safe browsing API, without this the safe browsing won't be check
```
### Run database migration
```bash
php artisan migrate
```
or
```bash
php artisan migrate --seed
```
to automatically create a login user
### Generate App key
```bash
php artisan key:generate
```
### Run Application
```bash
php artisan serve
```

### Use
The default login email will be `sayem@gmail.com`
and the default password will be `sayem`

### Some explanations
- about the short url, The short url can generated with username prefix which is nearest feature to work from some folder.