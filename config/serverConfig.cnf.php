<?php

// $apiConfig = $serverConfig['apiInfo'];

define('SERVER_ID', "testAPI");
define('ENVIRONMENT', "dev");

//站台識別名稱
define("IDENTIFY_NAME", "開發機");

//管端API執行網址
define("API_URL", "http://testapi.boyainc.com/");


//執行程式路徑
define("PHP_EXE_PATH", "");

//排程執行路徑
define("CRONTAB_EXE_PATH", PHP_EXE_PATH." "."");

//執行程式路徑(系統排成專用)
define("PHP_EXE_PATH_SYSTEM", "");

//排程執行路徑(系統排成專用)
define("CRONTAB_EXE_PATH_SYSTEM", PHP_EXE_PATH_SYSTEM." "."");

define("LOG_PATH", "");

//後台上傳圖檔的ＵＲＬ目錄位置(public/upload底下)，若為ＣＤＮ必須注意路徑
define("IMG_URL", "");

//預設mysql db與redis主機資料
$redisInfoAry = [['ip'=>'192.168.0.16','port'=>6379]];

//mysql
// define('MYSQL_SERVER', '10.10.2.152');
// define('MYSQL_USER', 'peteryang');
// define('MYSQL_PASSWORD', 'MjjL4s#ybx8G');
// define('MYSQL_DB_NAME', 'sa_report');//sa_payment
// // define('MYSQL_DB_NAME_PAY', 'sa_payment');//sa_payment

define('MYSQL_SERVER_LOC', '192.168.0.16');
define('MYSQL_USER_LOC', 'peter');
define('MYSQL_PASSWORD_LOC', '12345678');
define('MYSQL_DB_NAME_LOC', 'test');//sa_payment

define('MYSQL_SERVER', '127.0.0.1');
//define('MYSQL_SERVER', '61.63.20.28');
//define('MYSQL_SERVER', 'sinesc.2999.tw');
define('MYSQL_USER', 'fbi');
define('MYSQL_PASSWORD', 'Fbi@0688');
define('MYSQL_DB_NAME', 'fbi');//sa_payment
define('TRANSFee',150);
define('SEVENFee',60);
define ('FREEQUOTA',1000000);
define("QRCODE_URL", '');
define("BILLING_URL", '');

define('LOTTERY_API_VENDOR_KEYS', ['AAAA','51HD']);


define("PROXY_NOT_ALLOWED_LOGIN", TRUE);

//站點唯一編號
define("WEB_SITE_ID", "1");
//TITLE
define('WEB_SITE_TITLE', '');

//FOR三竹資料
define('SMS_API_URL','https://smsapi.mitake.com.tw/');
// define('SMS_USER','30926675');
// define('SMS_PWD','Peter101');
define('SMS_USER','27623233');
define('SMS_PWD','Fbi@27623233');
