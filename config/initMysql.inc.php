<?php
use core\db\MysqliClass;
use core\main\Main;
use core\tool\Timer;

Main::$timer = new core\tool\Timer(5);
Main::$timer->start();

//mysql init
Main::$mysql = new MysqliClass( MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME );//connect db : sa_report
// Main::$mysql_pay = new MysqliClass( MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB_NAME_PAY ); //connect db: sa_payment
//Main::$mysql_loc = new MysqliClass( MYSQL_SERVER_LOC, MYSQL_USER_LOC, MYSQL_PASSWORD_LOC, MYSQL_DB_NAME_LOC); //connect db: sa_payment
?>
