# php-web-app

## Install

[XAMPP](https://www.apachefriends.org/index.html) is a completely free, easy to install Apache distribution containing MariaDB, PHP, and Perl.


## Setup

1. First of, go to the directory where you installed your XAMPP (Commonly in C:\xampp). From there, go to the htdocs folder (Commonly in C:\xampp\htdocs) and create a folder named "php-web-app"

2. Copy the source code to that folder.

3. Let's now open your XAMPP control panel. Your Apache and mySQL by clicking the "Start" button on the actions column. You should see a random PID(s) and the default port number. Apache is the name of our web server wherein it will handle all the files as well as serve as the communication to the web browser and MySQL is our database which will store all of our information.

4. Open up your web browser and in the address bar, type localhost. You should see the menu of your XAMPP.

5. Try typing localhost/php-web-app. It should display the website.

## Setup database

1. Access `http://localhost/phpmyadmin`

2. Create a new database with the name `php-web-app-db`

3. Create a users table with 3 columns
```
Format: Column Name - Type - Length - Null Property - Other Properties
id - INT - N/A - Not Null - Auto Increment
username - varchar - 50 - Not null
password - varchar - 50 - Not null
```

4. Create a list table with 7 columns
```
id - INT - N/A - Not Null - Auto Increment
details - text - Not null
date_posted - varchar - 30 - Not null
time_posted - Time - Not null
date_edited - varchar - 30 - Not null
time_edited - Time - Not null
public - varchar - 5 - Not null
```