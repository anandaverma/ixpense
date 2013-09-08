ixpense - simple web based expense management system
====================================================

http://ixpense.apverma.com

iXpense is built on the idea that expense management can be more intuitive, efficient, easy and useful. And anybody can use it.

Note: This resource has been created by Ananda Prakash Verma (http://www.apverma.com)

Installation Requirements:

iXpense is purely written in Yii PHP framework ver 1.1.8. So it can run on any apache/php/mysql server, which fulfills the below version requirements. But I prefer to use XAMPP server 1.1.7 which contains 

Apache 2.2.21
MySQL 5.5.16
PHP 5.3.8
phpMyAdmin 3.4.5
FileZilla FTP Server 0.9.39
Tomcat 7.0.21 (with mod_proxy_ajp as connector)


Instruction for Installation: 

1. Extract the zip file into your web root directory. If you are using XAMPP(windows) with default installation then your web root directory might be C:\xampp\htdocs\ 

2. Make sure that you have both the folders a) iXpense & b) Yii in your web root directory

3. Import the database schema file SQL Schema.txt, present in the same folder, using phpMyAdmin http://localhost/phpmyadmin 

4. Create a database user in your mysql database and change the database configuration settings in C:\xampp\htdocs\ixpense\protected\config\main.php

'db'=>array(

              'connectionString' => 'mysql:host=localhost;dbname=ixpense',  // your host name & database name

              'emulatePrepare' => true,

              'username' => 'username',         //your database username

              'password' => 'password',         //your database password

              'charset' => 'utf8',

            ), 

Done: Open the web browser and type the relevant URL e.g. http://localhost/ixpense
