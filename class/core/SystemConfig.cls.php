<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\config;

class SystemConfig {
    
    //控端管理端資料相關API URL
    public static $sa_administrator_ApiUrl = "http://dev_sa.giga69.co/administrator/";
    
    //控端金流資料相關API URL
    public static $sa_information_ApiUrl = "http://dev_sa.giga69.co/information/";
    
    //控端資訊資料相關API URL
    public static $sa_payment_ApiUrl = "http://dev_sa.giga69.co/payment/";
    
    //控端報表資料相關API URL
    public static $sa_report_ApiUrl = "http://dev_sa.giga69.co/report/";
    
    //控端彩票相關API URL
    public static $sa_lottery_ApiUrl = "http://dev_sa.giga69.co/lottery/";

    //測試用管理端token
    public static $adminToken = "000000000000000000000000000000";
    
    //測試用代理端token
    public static $proxyToken = "111111111111111111111111111111";
    
    //目前站台語系 cn:簡體中文 tw:繁體中文 en:英文
    public static $lang = "cn";
    
    //會員裝置代碼 1:客户端 2:Web 3:iOS 4:Android
    public static $config_deviceCnfAry = array(
                                            1   =>  '大网',     
                                            2   =>  '小网',
                                            3   =>  'iOS',
                                            4   =>  'Android',
                                            5   =>  'Mobile小网',
                                        );
    
    //網站類型 前台後台
    public static $webSiteTypeAry = array(
                                            1,  //前台後台
                                            2   //後台後台
                                        );
    
    //PES key
    public static $pesKey = "wioerz&!e99!dio@";
    
    //AES key
    public static $aesKey   = "isdf@$523#dsfsdf";//16 Character Key
    public static $aesIV    = "iros238UjeiU7847";
    
    //控端代碼
    public static $defaultSAUid = "999999999999999999";
    
    //預設管理端代碼
    public static $defaultAdminUid = "100000000000000000";
    
    //預設代理端代碼
    public static $defaultProxyUid = "200000000000000000";
    
    //用戶資料幾秒在reids失效 USER_INFO_EXPIRES_SEC
    public static $userInfoExpiresSec = 60*60*24;
    
    //用戶登入後session的有效時間 TOKEN_EXPIRES_SEC
    public static $tokenExpiresSec = 60*60*3;
    
    //試玩用戶給多少錢試玩
    public static $freeTrialPrice = 500;
    
    //線上用戶有效秒數
    public static $onlineUserExpiresSec = 5*60;
    
    //預設提現限制 充值的幾%,1點=0.01% 目前預設投注必須是充值的兩倍 20000 = 200%
    public static $defaultWithdrawPercent = 5000;
    
    //每分鐘同一個IP只能多少用戶註冊
    public static $registerLimitMemberCount = 5;
    
    //用戶登入幾次錯誤, 封鎖用戶帳號
    public static $loginErrorLockCount = 5;
    
    //公司IP
    public static $officialIPArr = array(
                                        '118.193.141.97',
                                        '114.34.203.239',
                                        '59.124.220.84',
                                        '192.168.250.254',
                                        '192.168.0.*',
                                    );
    
    //簡訊驗證每日每一個號碼可以送出幾次
    public static $phoneVerificationDayCount = 5;
    
    //每則驗證簡訊時效秒數
    public static $phoneVerificationCodeExpiresSec = 60*60;
    
    
    //搜尋日期不能超過三個月
    public static $searchLimitSec = 86400*90;
    
    
}