<?php session_start(); //Session Start
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    date_default_timezone_set('Asia/Bangkok');
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . date("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // Noi Cache
    require_once '../config/wbsclass.php'; // import function
    $MsDb = new MSClass(); // Connenct MySql
    if($_POST['type']=="add"){
        $sql    =   "INSERT INTO `restaurant_menu` ( `restaurant_id`, `Menu_name`, `Menu_price`) VALUES ('".$_POST['res_id']."', '".$_POST['menu_name']."', '".$_POST['menu_price']."');";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="config"){
        $sql    =   "UPDATE `restaurant_menu` SET `Menu_Name` = '".$_POST['Menu_Name']."',`Menu_Price` = '".$_POST['Menu_Price']."' WHERE `restaurant_menu`.`Menu_id` = '".$_POST['Menu_id']."'";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }else if($_POST['type']=="del"){
        $sql    =   "DELETE FROM `restaurant_menu` WHERE `restaurant_menu`.`Menu_id` = '".$_POST['Menu_id']."'";
        $db    =   $MsDb->Query($sql);
        if($db){
            echo "Success";
        }else{
            echo "Error_Query";
        }
    }
