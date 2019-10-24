<?php session_start(); //Session Start
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    if($_POST['type']=="add"){
        $sql    =   "INSERT INTO `restaurant_bookmark` (`user_id`, `restaurant_id`, `bookmark_modify`) VALUES ('".$_SESSION['User_id']."', '".$_POST['res_id']."', '".date('Y-m-d H:i:s')."')";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="del"){
        $sql    =   "DELETE FROM `restaurant_bookmark` WHERE `restaurant_bookmark`.`bookmark_id` = '".$_POST['book_id']."'";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }
?>