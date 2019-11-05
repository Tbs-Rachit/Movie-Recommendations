# Search Movie

## Table of Contents

- [Installation](#installation)
- [Dependencies](#dependencies)
- [Routes](#routes)
    - [Authentication](#authentication)
    - [Password Reset](#password-reset)


### Installation

1. Clone repository
```
$ git clone https://github.com/Tbs-Rachit/Movie-Recommendations.git
```

2. Enter folder
```
$ cd Movie-Recommendations
```

3. Install composer dependencies
```
$ composer install
```

4. Generate APP_KEY
```
$ php artisan key:generate
```

5. Configure .env file, edit file with next command `$ nano .env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=user
DB_PASSWORD=secret
```

6. Run migrations
```
$ php artisan migrate
```
