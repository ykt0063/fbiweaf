<?php
use report\organization\Personal;
use report\user\Session;
if ($menuId==100||$menuId=='9a'){
    $name = Session::get('name');
    $str = "<br><br><h3 align=\"center\"><font face=\"標楷體\">歡迎 ".$name." 蒞臨會員專區</font></h3><br>";
    echo $str;
    $menuId='9a';
}

// $weekNoTag = Session::get('weekNoTag');
// if (!$weekNoTag && ($menuId==100)){
//     $name = Session::get('name');
//     $account = Session::get('account');
//     $weekNo = Session::get('weekNo');
//     $weekNo1=isset($g['WeekNo'])?$g['WeekNo']:'';
//     if ($weekNo1!=''){
//         $object=array(
//             'weekNoTag' => true,
//             'weekNo' => $weekNo1
//         );
//         Session::save($object);
//     }
//     else{
//         $strList = Personal::GetBonusReport0($account,$weekNo1);
//         $str = "<br><br><h3 align=\"center\"><font face=\"標楷體\">歡迎 ".$name." 蒞臨會員專區</font></h3><br>";
//         echo $str;
//         echo "<h3 align=\"center\">".$strList."</h3>";
//     }
// }