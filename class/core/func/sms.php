<?php
$funConfigArr = $funConfigArr +  array(
    'sendMessage' => array(
        'class' => 'api\user\sendSms',
        'fun' => 'sendMessage',
    ),
    'verify' => array(
        'class' => 'api\user\sendSms',
        'fun' => 'verify',
    ),
);