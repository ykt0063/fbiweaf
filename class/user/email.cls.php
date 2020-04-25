<?php
namespace report\user;

use Mail;
use PEAR;

require_once "Mail.php";
class email{
    public static function sendMail1($email,$msg){
        
        mail($email,"密碼資料",$msg);
    }
    public static function sendMail($email,$msg){
        
        $from = "support@fbiweaf.com";
        $to = $email;
        $subject = "密碼資料!";
        $body = $msg;
        
        $host = "61.63.20.24";
        $port = "25";
        $username = "support@fbiweaf.com";
        $password = "Fbiweaf0688";
        
        $headers = array ('From' => $from,
            'To' => $to,
            'Subject' => $subject,
            'Content-Type'  => 'text/html; charset=UTF-8'
        );
        $smtp = Mail::factory('smtp',
            array ('host' => $host,
                'port' => $port,
                'auth' => true,
                'username' => $username,
                'password' => $password));
            
            $mail = $smtp->send($to, $headers, $body);
            
            if (PEAR::isError($mail)) {
                echo("<p>" . $mail->getMessage() . "</p>");
            } else {
                //echo("<p>Message successfully sent!</p>");
            }
    }
}