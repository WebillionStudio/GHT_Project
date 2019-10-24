<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql    =   "SELECT `user_password` FROM `user` WHERE `user_id` = '".$_SESSION['User_id']."'";
    $db     =   $MsDb->Query($sql);
    $res    =   $MsDb->Result($db);
    if(trim($res['user_password'])==md5(trim($_POST['pass']))){
        echo "Success";
    }else{
        echo "Error";
    }
?>
