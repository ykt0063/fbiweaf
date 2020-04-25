<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
require_once( __DIR__."/init.inc.php" );
header("Cache-control: private");
use report\user\Auth;
use report\response\ReturnHandler;

$host=strtoupper($_SERVER["HTTP_HOST"]);
if (strcmp(substr($host,0,4), 'WWW.') == 0) {
    $host=substr($host,4,strlen($host)-4);
    header("Location: https://" . $host . $_SERVER["REQUEST_URI"], true, 301);
    exit;
}
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    //Tell the browser to redirect to the HTTPS URL.
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    //Prevent the rest of the script from executing.
    exit;
}


$parAry = array();

if( isset($_GET['p1']) ){
    $tmpAry = explode ("/", isset($_GET['p1'])?$_GET['p1']:'');
    $parcount = 0;
    foreach( $tmpAry as $index => $value )
    {
        $value = trim($value);
        if( $value != null && $value != '' ){
            $parAry[$parcount] = $value;
            $parcount++;
        }
    }
    unset($index);
    unset($value);
}

if( empty($parAry[0]) ){
    $parAry[0] = 'index';
}


switch ($parAry[0]){
    case 'logout':
        Auth::logout();
        header("Location:".WEB_SITE_URL);
        exit();
        break;
//     case 'assets':
//         if (isset($parAry[1])&&isset($parAry[2])&& (isset($parAry[1])=='images')){
//             $fPath=WEB_ASSET_URL."images/main/".$parAry[2];
//             echo "<img src='data:image/png;base64,".base64_encode(file_get_contents($fPath))."'>";
//         }
//         exit();
//         break;
    case 'ajax':
        if(!isset($parAry[1])){
            ReturnHandler::response(98);
            exit();
        }
        
        $ajaxPath = __DIR__."/ajax/";
        if(!is_file($ajaxPath.$parAry[1].".php")){
            ReturnHandler::response(98);
            exit();
        }
        
        require_once($ajaxPath.$parAry[1].".php" );
        exit();
        break;
    case 'search':
        if(!isset($parAry[1])){
            ReturnHandler::response(98);
            exit();
        }
        
        $searchPath = __DIR__."/search/";
        if(!is_file($searchPath.$parAry[1].".php")){
            ReturnHandler::response(98);
            exit();
        }
        
        require_once($searchPath.$parAry[1].".php" );
        exit();
        break;
    case 'favicon.ico':
        exit();
        break;
    default:
        $defaultPath = __DIR__."/view/";
        if(!is_file($defaultPath.$parAry[0].".php")){
            $parAry[1] = '頁面不存在';
            require_once($defaultPath."errorPage.php" );
            exit();
        }
        
        // if(in_array($parAry[0], $proxyFunList) && !Auth::isProxy()){
        //     $parAry[1] = '身份錯誤，無法操作';
        //     require_once($defaultPath."errorPage.php" );
        //     exit();
        // }
        
        //判斷是否需要登入
        if(in_array($parAry[0], $needLoginPage) && !Auth::isLogin()){
            $parAry[0] = 'login';
            //$parAry[0] = 'index';
        }
        
        require_once($defaultPath.$parAry[0].".php" );
        exit();
        break;
}

?>
