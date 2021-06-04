# Build a Simple REST API in PHP

This example shows how to build a simple REST API in core PHP.

This code builds a simple Rest API in PHP, making use of an existing project and its objective is to show only a simple API returning a list with the records of each movement, sorted from the highest result to the lowest.

Please read [Coding Challenge](Coding Challenge - Tecnofit.pdf) to learn more about REST API challenge.



### Prerequisites

- [PHP](https://www.php.net/downloads.php)
- [MySQL](https://www.mysql.com/downloads/)
- [Composer](http://getcomposer.org/)
- [Postman](https://www.postman.com/downloads/)

## Getting Started



### Configure the application

Create the database and user for the project.

```php
mysql -u root -p
CREATE DATABASE tecnofit CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'user_test'@'localhost' identified by 'rest_api_password';
GRANT ALL on tecnofit.* to 'user_test'@'localhost';
quit
```

Create the `tecnofit` database tables.

```php
mysql -u user_test -p;
// Enter your password
use tecnofit;

CREATE TABLE `user` (
`id` int NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `movement` (
`id` int NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
);

CREATE TABLE `personal_record` (
`id` int NOT NULL AUTO_INCREMENT,
`user_id` int NOT NULL,
`movement_id` int NOT NULL,
`value` FLOAT NOT NULL,
`date` DATETIME NOT NULL,
PRIMARY KEY (`id`)
);

ALTER TABLE `personal_record` ADD CONSTRAINT `personal_record_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);
ALTER TABLE `personal_record` ADD CONSTRAINT `personal_record_fk1` FOREIGN KEY (`movement_id`) REFERENCES `movement`(`id`);

INSERT INTO `user` (id,name) VALUES
(1,'Joao'),
(2,'Jose'),
(3,'Paulo');

INSERT INTO movement (id,name) VALUES
(1,'Deadlift'),
(2,'Back Squat'),
(3,'Bench Press');

INSERT INTO personal_record (id,user_id,movement_id,value,`date`) VALUES
(1,1,1,100.0,'2021-01-01 00:00:00.0'),
(2,1,1,180.0,'2021-01-02 00:00:00.0'),
(3,1,1,150.0,'2021-01-03 00:00:00.0'),
(4,1,1,110.0,'2021-01-04 00:00:00.0'),
(5,2,1,110.0,'2021-01-04 00:00:00.0'),
(6,2,1,140.0,'2021-01-05 00:00:00.0'),
(7,2,1,190.0,'2021-01-06 00:00:00.0'),
(8,3,1,170.0,'2021-01-01 00:00:00.0'),
(9,3,1,120.0,'2021-01-02 00:00:00.0'),
(10,3,1,130.0,'2021-01-03 00:00:00.0'),
(11,1,2,130.0,'2021-01-03 00:00:00.0'),
(12,2,2,130.0,'2021-01-03 00:00:00.0'),
(13,3,2,125.0,'2021-01-03 00:00:00.0'),
(14,1,2,110.0,'2021-01-05 00:00:00.0'),
(15,1,2,100.0,'2021-01-01 00:00:00.0'),
(16,2,2,120.0,'2021-01-01 00:00:00.0'),
(17,3,2,120.0,'2021-01-01 00:00:00.0');

```

Copy `.env.example` to `.env` file and enter your database deatils.

```bash
cp .env.example .env
```

## Development

Install the project dependencies and start the PHP server:

```bash
composer install
```

```bash
php -S localhost:8008 -t ranking
```

## Your APIs

| API               |    CRUD    |                                Description |
| :---------------- | :--------: | -----------------------------------------: |
| GET /ranking        |  **READ**  |        Get all records from `personal_records` table merged with `movement` and `user` tables|

Test the API endpoints using [Postman](https://www.postman.com/).

## License

See [License](./LICENSE)
