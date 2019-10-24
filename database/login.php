<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    $sql_login  =   "SELECT `user`.user_id, `user`.user_fname, `user`.user_lname FROM `user` WHERE user_email = '".$_POST['email']."' AND user_password = '".md5($_POST['password'])."'";
    $db_login   =   $MsDb->Query($sql_login);
    $numr_login =   $MsDb->NumRows($db_login);
    if($numr_login==0){
        echo "Error";
    }else{
        $res_login =   $MsDb->Result($db_login);
        $_SESSION['User_id']        =   $res_login['user_id'];
        $_SESSION['User_fname']     =   $res_login['user_fname'];
        $_SESSION['User_lname']     =   $res_login['user_lname'];
        echo "Success";
    }
?>
