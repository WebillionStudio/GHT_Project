<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $check_email     =   $MsDb->NumRows($MsDb->Query("SELECT * FROM `user` WHERE user_email = '".$_POST['email']."'"));
    if($check_email==0){
        $sql_register   =   "INSERT INTO `user` (`user_email`, `user_fname`, `user_lname`, `user_password`) VALUES ('".$_POST['email']."', '".$_POST['fname']."', '".$_POST['lname']."', '".md5($_POST['pass'])."')";
        $db_register    =   $MsDb->Query($sql_register);
        if($db_register){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else{
        echo "Error_Email";
    }
?>
