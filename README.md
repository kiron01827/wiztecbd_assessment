## Event Booking System Instructions

## Cloning Project

Clone the project from the git repository into the "htdocs" folder where Xampp is installed.

## Create the ".env" file

Make a Copy of the ".env.example" file and rename it ".env" file.

## Create, import and link the database

Create a mysql database named 'event_booking_system' and import the 'event_booking_system.sql' file (provided in the project root directory) into the databse. Then link up the database into .env file.

## Update the dependencies

run the commands from the root directory of the project
```shell
composer update
```
```shell
npm install
```
```shell
npm run dev
```
## Check the website

Check the website on the browser "http://localhost/wiztecbd_assessment/"

Or,

run the command and hit the IP URl
```shell
php artisan serve
```
